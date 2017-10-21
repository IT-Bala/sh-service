<?php
if(!defined("SHA")) die("Access denied!");
#require_once 'dbc/dbc.php'; # Medoo third party
require_once 'config.php';
require 'autoload.php';
require_once 'Input.php';
require_once 'dbc/DB.php';
class Http{ var $http_method; public $db; protected $route_url=[]; public $next_object=[]; public $middleware; public $pre_url=''; 
	public function Http(){ set_error_handler('getError');
		$this->http_method = $_SERVER['REQUEST_METHOD'];
		try{
			if(DB_STATUS == true){
				/*$this->db = new dbc([
					'database_type' => DATABASE_TYPE,
					'database_name' => DATABASE,
					'server' => HOST,
					'username' => USERNAME,
					'password' => PASSWORD,
					'charset' => 'utf8'
				]); # Medoo third party */ 
				$active_group = 'default';
				$query_builder = TRUE;
				$db['default'] = array(
					'dsn'	=> DNS,
					'hostname' => HOST,
					'username' => USERNAME,
					'password' => PASSWORD,
					'database' => DATABASE,
					'dbdriver' => DATABASE_TYPE,
					'dbprefix' => DATABASE_PREFIX,
					'pconnect' => FALSE,
					'db_debug' => (ENVIRONMENT !== 'production'),
					'cache_on' => FALSE,
					'cachedir' => '',
					'char_set' => 'utf8',
					'dbcollat' => 'utf8_general_ci',
					'swap_pre' => '',
					'encrypt' => FALSE,
					'compress' => FALSE,
					'stricton' => FALSE,
					'failover' => array(),
					'save_queries' => TRUE
				);
				$this->db = self::db(); #DBC($db['default']);
			}
		}catch(Exception $e){
			if($e){
				die(Http::json(["Database Connection failed"]));
			}
		}
		
		$this->input = new Input;
	}
	public function base(){ $args = func_get_args(); $route_args = [];
		if(count($args) >=1){
			$first = $args[0];
			if(is_string($first)){ # for pre url purpose
				$this->pre_url = $args[0];
				if(isset($args[1]) && is_callable($args[1])){ $call = $args[1];
				  $this->middleware($call);	
				}
			}elseif(is_callable($first)){ $call = $first;
				$this->middleware($call);
			}
		}
	}
	public function __call($name,$args){ 
		die('<p align="center">Error : '.$name.'() method is invalid');
	}
	public function routes(){  $args = func_get_args();
		$target=$callback=NULL; $middleware = false; #echo count($args); die;
		if(count($args) == 2){
			$target = $args[0]; $callback = $args[1];
		}else if(count($args) == 3){
			$target = $args[0]; $middleware = $args[1]; $callback = $args[2];
		}
		$pre = (filter_var($target, FILTER_SANITIZE_URL));
		if($pre!='' && is_array($callback)){ # multiple url calls
		 $splitter = explode("/",$pre); 
		 if(count($splitter)>=1){
			 $method = $splitter[0]; $addSlash = (isset($splitter[1]) && $splitter[1]!='')?'/':'';
			 array_shift($splitter);
			 $preUrl = $addSlash.implode("/",$splitter); #die;
			 foreach($callback as $url=>$call_function){
				$subUrl = (filter_var($url, FILTER_SANITIZE_URL));
				if($method == 'PAGE'){
					if($this->http_method == 'GET' || $this->http_method == 'POST' && $callback!=NULL) self::switchPage($preUrl.'/'.$subUrl,$call_function,false);
				 }else{ 
					if($this->http_method == $method && $callback!=NULL) self::switchPage($preUrl.'/'.$subUrl,$call_function,$middleware);
				 }
			 }
		 }else{
			 die($this->setHeader(500,"Bad format of routes")); 
		 }
		}else{ # It may string OR func($app){}			
			$splitter = explode("/",$pre); 
			 if(count($splitter)>=1){
				 $method = $splitter[0]; $addSlash = (isset($splitter[1]) && $splitter[1]!='')?'/':'';
				 array_shift($splitter);
				 $preUrl = $addSlash.implode("/",$splitter); #die;
				 if($method == 'PAGE'){
					if($this->http_method == 'GET' || $this->http_method == 'POST' && $callback!=NULL) self::switchPage($preUrl,$callback,false);
				 }else{
					if($this->http_method == $method && $callback!=NULL) self::switchPage($preUrl,$callback,$middleware);
				 }
			 }
		}
		#die;
	}
	public function db_routes(){ #$datas = $this->db->select("tbl_routes","*");
		$callStack = [];
		if(DB_STATUS == true){
			$datas = $this->db->get_where("tbl_routes",["status"=>"1"]);
			#print_r($datas->result_array());
			foreach($datas->result_array() as $stack){
				$callStack[$stack['route']] = 'cms::'.$stack['type'];
			}
			return $callStack;	
		}else{
			die($this->setHeader(500,"Enble DB_STATUS in config.php"));
		}
	}
	public function getDynamicContent($url,$table){ #$datas = $this->db->select("tbl_routes","*");
		$checkTypes = array('page'=>"tbl_pages",'blog'=>"tbl_blogs",'service'=>"tbl_service");
		$datas = $this->db->query("SELECT p.title,p.content,p.when_created,p.when_updated FROM tbl_routes r INNER JOIN `".$checkTypes[$table]."` p ON r.route_id=p.route_id WHERE r.route = '".$url."' ");
		$datas = $datas->result_array();
		return $datas[0];
	}
	public function db_page(){ #$datas = $this->db->select("tbl_routes","*");
		$callStack = [];
		$datas = $this->db->query("SELECT * FROM tbl_routes r INNER JOIN tbl_pages p ON r.route_id=p.route_id");
		foreach($datas->result_array() as $stack){
			$callStack[$stack['route']] = array('cms::'.$stack['type'],$stack);
		} #echo 'running';
		return $callStack;
	}
	public function db_service(){ #$datas = $this->db->select("tbl_routes","*");
		$callStack = [];
		$datas = $this->db->query("SELECT p.title,p.content,p.when_created FROM tbl_routes r INNER JOIN tbl_service p ON r.route_id=p.route_id");
		foreach($datas->result_array() as $stack){
			$callStack[$stack['route']] = array('cms::'.$stack['type'],$stack);
		}
		return $callStack;
	}
	public function db_blog(){ 
		$callStack = [];
		$datas = $this->db->query("SELECT * FROM tbl_routes r INNER JOIN tbl_blogs p ON r.route_id=p.route_id");
		foreach($datas->result_array() as $stack){
			$callStack[$stack['route']] = array('cms::'.$stack['type'],$stack);
		}
		return $callStack;
	}
	public function droutes($target=NULL,$callback=false){ # CMS
		$pre = (filter_var($target, FILTER_SANITIZE_URL));
		if($pre!='' && $callback==true){  # multiple url calls			
			
			$splitter = explode("/",$pre);
			$method = $splitter[0]; $addSlash = (isset($splitter[1]) && $splitter[1]!='')?'/':'';
			
			$callback = $this->db_routes();
			array_shift($splitter);
			$preUrl = $addSlash.implode("/",$splitter); #die;
			foreach($callback as $url=>$call_function){
				$subUrl = (filter_var($url, FILTER_SANITIZE_URL));
				if($method == 'PAGE'){
					if($this->http_method == 'GET' || $this->http_method == 'POST' && $callback!=NULL) self::switchPage($preUrl.'/'.$subUrl,$call_function,false);
				 }else{
					if($this->http_method == $method && $callback!=NULL) self::switchPage($preUrl.'/'.$subUrl,$call_function);
				 }
			 }
						 
		}
		
	}
	
	public function get(){ $args = func_get_args();
		if($this->http_method == 'GET') self::check_methods('GET',$args);
	}
	public function post(){
		$args = func_get_args();
		if($this->http_method == 'POST') self::check_methods('POST',$args);
	}
	public function put(){
		$args = func_get_args();
		if($this->http_method == 'PUT') self::check_methods('PUT',$args);
	}
	public function delete(){
		$args = func_get_args();
		if($this->http_method == 'DELETE') self::check_methods('DELETE',$args);
	}
	public function page($target=NULL,$callback=NULL){
		$argUrl = (filter_var($target, FILTER_SANITIZE_URL));
		if(($this->http_method == 'GET' || $this->http_method == 'POST') && $callback!=NULL) self::switchPage($argUrl,$callback,false);
	}
	protected function check_methods($method='GET',$args){
		$target=$callback=NULL; $middleware = false; #echo count($args); die;
		if(count($args) == 2){
			$target = $args[0]; $callback = $args[1];
		}else if(count($args) == 3){
			$target = $args[0]; $middleware = $args[1]; $callback = $args[2];
		}
		$argUrl = (filter_var($target, FILTER_SANITIZE_URL));

		if(($this->http_method == 'GET' || $this->http_method == 'POST' || $this->http_method == 'PUT' || $this->http_method == 'DELETE') && $callback!=NULL) self::switchPage($argUrl,$callback,$middleware);
		return new Http;
	}
	public function __next(){
		return true;
	}
	public function url($offset=NULL){
		$returnUrl = self::getCurrentUri();
		if($offset!='' && is_integer($offset)){
			$ex = explode("/", self::getCurrentUri());
			$returnUrl = (isset($ex[$offset]))?$ex[$offset]:'';
		}
		return $returnUrl;
	}
	private static function setHeader($status,$body=""){
		if($status!=""){
			header("HTTP/1.1 ".$status."");
			header("Content-Type: application/json");
			return json_encode(["status"=>$status,"body"=>$body]);
		}
	}
	public function send(){ $status = 200; $content_type = 'application/json';
		$args = func_get_args();
		if(count($args) >0){
				if(count($args) == 1){
					$body = $args[0];
				}elseif(count($args) == 2){
					$status = $args[0]; 
					$body = $args[1];
				}else{
					$status = $args[0]; 
					$body = $args[1];
					$content_type = $args[2];
				}
				header("HTTP/1.1 ".$status."");
				header("Content-Type: ".$content_type);
				$send = json_encode(["status"=>$status,"body"=>$body]);
				die($send);
		}
		
	}
	public function clean_url($str, $replace=array(), $delimiter='-') {
		if($str != ''){
			if( !empty($replace) ) {
				$str = str_replace((array)$replace, ' ', $str);
			   }	   
			   $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
			   $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
			   $clean = strtolower(trim($clean, '-'));
			   $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
			  
			   return $clean;	
		}
   }
	public function file_save($file_path,$file_stream){
		if($file_path != "" && $file_stream != ""){
			$explode = explode(";base64,",$file_stream); # ;base64,
			$data	= explode("/",$explode[0]);
			$extension = $data[1];
			$output_file = $file_path.".".$extension;
			$ifp = fopen($output_file, "wb");	
			fwrite($ifp, base64_decode($explode[1])); 
			fclose($ifp);
		}
	}
	public function file_decode($file_stream){
		if($file_stream != ""){
			$explode = explode(";base64,",$file_stream); # ;base64,
			return base64_decode($explode[1]);
		}
	}
	public static function body(){
		return json_decode(file_get_contents("php://input"));
	}
	public static function json($content,$object=false){
		// application/json
		if($object==true){
			return json_decode(Http::setHeader(200,$content));
		}else{
			die(Http::setHeader(200,$content));
		}
	}
	private function error(){
		
	}
	private function has_duplicate($array){
		 $dupe_array = array();
		 foreach($array as $val){
		  if(++$dupe_array[$val] > 1){
		   return true;
		  }
		 }
		 return false;
	}
	function array_has_dupes($array) {
	   return count($array) !== count(array_unique($array));
	}
	private function get_colon_vars($str){ $colonVar= [];
		if(strpos($str,'/:') !==false){
			$slashColon = explode('/:', $str);
			array_shift($slashColon);
			foreach($slashColon as $value){
				if(strpos($value,'/') !==false){
					$colonVar[] = strstr($value, '/',true);
				}else{
					$colonVar[] = $value;
				}
			} 
		} 
		
		return array_merge($colonVar);
	}
	private function getCurrentUri(){
		$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
		$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
		if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
		$uri = '/' . trim($uri, '/');
		return $uri;
	}
	public function middleware($call=NULL,$route_args=[]){
		if($call!=NULL){
			if(is_string($call)){
					$splitC = explode('::',$call);
					if(count($splitC) == 2){ 
							$controller = $splitC[0]; $method = $splitC[1];
						
							if(file_exists(CONTROLLER_PATH.$controller.'.php')){
								require_once CONTROLLER_PATH.$controller.'.php';
								if (method_exists($controller,$method)){
									$obj = new $controller;
									$middleware_status = $obj->$method();
									#call_user_func($call);
								}else{
									die($this->setHeader(500,"Bad format of calling method"));
								}
							}else{
								die($this->setHeader(500,"Bad format of calling controller"));
							}
							
						}else{
								die($this->setHeader(500,"Bad format of calling controller"));
						}
				}else{ 
					#require_once 'Request.php';
					#require_once 'Response.php';
					# $Request = (object)$route_args
					$middleware_status = $call( $Http = (new Http()) , $Request = (new Request($route_args)), $Response=(new Response));
					#$middleware_status = $call( new Http() , $Request = (new Request()), $Response=(new Response));
				}
				if(!$middleware_status){
						die($this->setHeader(500,"Middleware auth failed"));
				}

		}
	}
	private function switchPage($argUrl,$callback,$middleware=false,$check_auth=true){ 
		# PRE URL SECTION
		if($this->pre_url!=""){
			if($argUrl!='/'){ # not equal to home
				$argUrl = $this->pre_url.$argUrl; # Set pre url : $this->pre_url
			}else{
				$argUrl = $this->pre_url; # Home
			}
		}
		# PRE URL SECTION
		if(isset($this->route_url[$this->http_method]) && in_array($argUrl,$this->route_url[$this->http_method])){
			die($this->setHeader(500,$this->http_method.': Duplicate URL called '.$argUrl.' multiple times called '));
		}else{
			$this->route_url[$this->http_method][] = ['url'=>$argUrl,'method'=>$this->http_method];
			
			if(strpos($argUrl, '/:')!==false || strpos($argUrl, '):')!==false){ # dynamic {name} url
				#$dynamic_route_args=[];
				/* data type base*/
					$DataTyeList = self::dataTypesList();
					$needleDataTye = array(); $rep_pattern = '([a-zA-Z0-9\-\_]+)';
					$argUrl = str_replace("/:","/(basic):",$argUrl);
			        if (preg_match_all('#\b('.implode('|',array_keys($DataTyeList)).')\b#', $argUrl, $match)){
			            $needleDataTye = $match[1]; #print_r($needleDataTye);
			        }
			        $route['url'] = $argUrl;
			        #$findData = array_keys($DataTyeList); print_r($needleDataTye);
			        if(count($needleDataTye) > 0){
				        foreach($needleDataTye as $dType){
				        	$findDataType[] = '('.$dType.')';
				        	$findDataTypeValue[] = $DataTyeList[$dType];
				        } #print_r($findDataTypeValue);
				        #die;
					    /* data type base*/
					    $route_original['url'] = str_replace($findDataType, "", $route['url']);
					    $route['url'] = preg_replace('/\:[a-zA-Z0-9\_\-]+/', '', $route['url']);

					    $argUrl = preg_replace('/\:[a-zA-Z0-9\_\-]+/', '', $argUrl);

					    $pattern = "@^" . str_replace($findDataType, $findDataTypeValue, $argUrl). "$@D";
			        }else{
			        	$pattern = "@^" . preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', $rep_pattern, preg_quote($argUrl)) . "$@D";
			        }
			    #preg_match($pattern, self::getCurrentUri(), $matches);
			    #print_r($matches);
        		$matches = $route_args = Array();
        		if(isset($this->http_method) && preg_match($pattern, self::getCurrentUri(), $matches)){
        			  #array_shift($matches);
        			  #$this->dynamic_route_args[] = $matches;
        			  if($middleware == false){
							if($callback!=NULL) $this->access = $callback;
					  }else{
					  		array_shift($matches); 
	        			    if(count($matches) > 0){
				            	$route_args = array_combine(self::get_colon_vars($route_original['url']),$matches);
	        			  		#print_r($route_args);
				            }
							self::middleware($middleware,$route_args);
							if($callback!=NULL) $this->access = $callback;
					  } 
					  $this->check_auth = $check_auth;
			    }
			}else{ 
				switch($argUrl){
					case self::getCurrentUri():
						if($middleware == false){
							if($callback!=NULL) $this->access = $callback;
						}else{
							self::middleware($middleware);
							if($callback!=NULL) $this->access = $callback;
						}
						$this->check_auth = $check_auth;
					break;
					default:
					
				}
			}
		}
	}
	protected function dataTypesList(){
		return array('basic'=>'([a-zA-Z0-9\-\_]+)','int'=>'([0-9]+)','string'=>'([a-zA-Z0-9\-\_]+)','base64'=>'([a-zA-Z0-9+/]+={0,2}$)','any'=>'([a-zA-Z0-9\-\_\=\@\!\&\$\#]+)');
	}
	public function run($sh=NULL){
		# Modules
		if(is_dir('modules')){
			foreach (glob("modules/*",GLOB_ONLYDIR) as $module_folder){
				foreach (glob($module_folder."/*init.php") as $init_file){
					if(file_exists($init_file)) require_once $init_file;
				}
			}
		}
		# Auto Init Extender
		if(is_dir('extender/init')){ $adminFile = 'extender/init/admin.php';
			foreach (glob("extender/init/*.php") as $ext_file){
				if(file_exists($ext_file) && basename($ext_file)!='admin.php') require_once $ext_file;
			} 
			if(file_exists($adminFile)) require_once $adminFile; # Admin page should be final include
		}
		
		if(is_string($sh)){ $ext_file = EXT_PATH.$sh.'.php';
			if(file_exists($ext_file)) require_once $ext_file;
		}else if(is_array($sh)){
			foreach($sh as $sh_file){ $ext_file = EXT_PATH.$sh_file.'.php';
				if(file_exists($ext_file)) require_once $ext_file;
			}
		}
		switch($this->http_method){
			case ('GET' || 'POST' || 'PUT' || 'DELETE' || 'PAGE'): #echo self::getCurrentUri(); print_r($this->route_url[$this->http_method]);
				if(count($this->route_url) == 0){
					die($this->setHeader(400,"Bad Request"));
				}else{
					$routeCount = count($this->route_url[$this->http_method]); $notMatchCount=0;
					foreach($this->route_url[$this->http_method] as $route){ #echo self::getCurrentUri();#echo $route;
						/* data type base*/
						$DataTyeList = self::dataTypesList();	
						$needleDataTye = $findDataType = array(); $rep_pattern = '([a-zA-Z0-9\-\_]+)';			        
				        #echo $route['url'];
						$route['url'] = str_replace("/:","/(basic):",$route['url']);
				        if (preg_match_all('#\b('.implode('|',array_keys($DataTyeList)).')\b#', $route['url'], $match)){
				            $needleDataTye = $match[1]; #print_r($needleDataTye);
				        }
				        if(count($needleDataTye) > 0){
					        #$findData = array_keys($DataTyeList); print_r($needleDataTye);
					        foreach($needleDataTye as $dType){
					        	$findDataType[] = '('.$dType.')';
					        	$findDataTypeValue[] = $DataTyeList[$dType];
					        } #print_r($findDataType);
					        #die;
						    /* data type base*/
						    $route_original['url'] = str_replace($findDataType, "", $route['url']);
						    $route['url'] = preg_replace('/\:[a-zA-Z0-9\_\-]+/', '', $route['url']);

						    $pattern = "@^" . str_replace($findDataType, $findDataTypeValue, $route['url']). "$@D";
					    }else{
					    	$pattern = "@^" . preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', $rep_pattern, preg_quote($route['url'])) . "$@D";
					    }
						
						
				        /* data type base*/
						#$pattern = "@^" . preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', $rep_pattern, preg_quote($route['url'])) . "$@D";
	        			$matches = $route_args = Array();
	        			if(isset($this->route_url[$this->http_method]) && $route['method']==$this->http_method && preg_match($pattern, self::getCurrentUri(), $matches)){
	        			  array_shift($matches); 

	        			  if(count($matches) > 0){
	        			  		#print_r(self::get_colon_vars($route_original['url'])); #print_r($matches);
				            	$route_args = array_combine(self::get_colon_vars($route_original['url']),$matches);
				            }
				          #die;
						  if((isset($_SERVER['HTTP_'.SH_KEY]) && $_SERVER['HTTP_'.SH_KEY] == SH_VALUE) || SHA==FALSE || $this->check_auth == FALSE){
								$call = $this->access;
								if(is_string($call)){ # Routes
									$splitC = explode('::',$call);
									if($splitC[0] == 'cms'){ # CMS Process
											$cmsFile = CMS_PATH.$splitC[1].'.php';
											if($splitC[1] == 'service'){
												$datas = self::getDynamicContent(substr(self::getCurrentUri(), 1),$splitC[1]);
												$this->json($datas);										
											}else{ 
												if(file_exists($cmsFile)){
													$datas = self::getDynamicContent(substr(self::getCurrentUri(), 1),$splitC[1]);
													extract($datas);
													require_once $cmsFile; die;
												}
											}
									}elseif(count($splitC) == 2){ 
											$controller = $splitC[0]; $method = $splitC[1];
										
											if(file_exists(CONTROLLER_PATH.$controller.'.php')){
												require_once CONTROLLER_PATH.$controller.'.php';
												if (method_exists($controller,$method)){
													$obj = new $controller;
													$obj->$method();
													#call_user_func($call);
												}else{
													die($this->setHeader(500,"Bad format of calling method"));
												}
											}else{
												die($this->setHeader(500,"Bad format of calling controller"));
											}
										
									}else{
											die($this->setHeader(500,"Bad format of calling controller"));
									}
								}elseif(is_array($call)){ # Check $splitC[0] cms::page or normal
									$splitC = explode('::',$call[0]);
									
									if($splitC[0] == 'cms'){ # CMS Process
											$cmsFile = CMS_PATH.$splitC[1].'.php';
											if($splitC[1] == 'service'){
												$this->json($call[1]);
											}else{
												if(file_exists($cmsFile)){
													#extract($call[1]);
													require_once $cmsFile; die;
												}	
											}
									}
								}else{ # Individual
									require_once 'Request.php';
									require_once 'Response.php';
									# $Request = (object)$route_args
									$call( new Http() , $Request = (new Request($route_args)), $Response=(new Response));
									#unset($_GET,$_POST);
								}
						  }else{ #echo $_SERVER['HTTP_'.SH_KEY];
							    if(SHA==true && !isset($_SERVER['HTTP_'.SH_KEY])){
									die($this->setHeader(401,"Unauthorized"));
								}elseif($_SERVER['HTTP_'.SH_KEY] != SH_VALUE){
									die($this->setHeader(401,"Unable to verify your token Value."));	
								}
								
						 }
						}else{ 
							$notMatchCount +=1;
						}
						# End Loop
					} 
					if($routeCount == $notMatchCount){
				    	die($this->setHeader(400,"Bad Request"));
				    }
				}
			break;
			default:
			
		}
	}
	
	public function controller($controller=NULL){
		if(file_exists(CONTROLLER_PATH.$controller.'.php')){
			require_once CONTROLLER_PATH.$controller.'.php';
			if(class_exists($controller)) return new $controller;
		}
	}
	public static function model($model=NULL){
		if(file_exists(MODEL_PATH.$model.'.php')){
			require_once MODEL_PATH.$model.'.php';
			if(class_exists($model)) return new $model;
		}
	}
	public static function view($file=NULL,$args=NULL){
			return self::html($file,$args);
	}
	public static function html($file=NULL){ $args = func_get_args();
			if(count($args)>0 && $args[0]!=''){
				if(isset($args[1]) && $args[1]!=NULL){ 
					extract($args[1]);
				}
				$file = HTML_PATH.$args[0].'.php';
				if(file_exists($file)) require_once $file;
			} return new Http;
	}
	public static function library($class=NULL,$object=true){ $args = func_get_args();
			if(count($args)>0 && $args[0]!=''){
				$file = LIBRARY_PATH.$args[0].'.php';
				if(file_exists($file)) require_once $file;
				if(class_exists($args[0]) && $object==true) return new $args[0];
			}
	}
	public static function db(){
		if(DB_STATUS == true){
			
			$active_group = 'default';
			$query_builder = TRUE;
			$db['default'] = array(
				'dsn'	=> DNS,
				'hostname' => HOST,
				'username' => USERNAME,
				'password' => PASSWORD,
				'database' => DATABASE,
				'dbdriver' => DATABASE_TYPE,
				'dbprefix' => DATABASE_PREFIX,
				'pconnect' => FALSE,
				'db_debug' => (ENVIRONMENT !== 'production'),
				'cache_on' => FALSE,
				'cachedir' => '',
				'char_set' => 'utf8',
				'dbcollat' => 'utf8_general_ci',
				'swap_pre' => '',
				'encrypt' => FALSE,
				'compress' => FALSE,
				'stricton' => FALSE,
				'failover' => array(),
				'save_queries' => TRUE
			);
			return DBC($db['default']);
		}else{ die($this->setHeader(500,"Enble DB_STATUS in config.php")); }
	}
}
function http(){
	return new Http();
}
function db(){
	if(DB_STATUS == true){
		$dbc = new Http();
		return $dbc->db;
	}else{ die($this->setHeader(500,"Enble DB_STATUS in config.php")); }
}
function getError($number, $msg, $file, $line, $vars){
	   $error = debug_backtrace(); #var_dump($error);
	   $msg = (isset($error[0]['file']))?'<pre><div style="margin:auto;"><p align="center">File : '.$error[0]['file'].'<br>':'';
	   $msg .= (isset($error[0]['line']))?'Line : '.$error[0]['line'].'<br>':'';
	   $msg .= (isset($error[0]['args'][1]))?'Error : '.$error[0]['args'][1].'</div></p></pre>':'';
	   die($msg);
}
