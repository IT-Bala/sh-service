<?php
if(isset($argv[1]) && $argv[1]!=''){
	if(strtolower($argv[1]) == 'create' || strtolower($argv[1]) == 'mk'){ require_once 'create.php';
		if(isset($argv[2]) && $argv[2]!=''){
			$whatAt = explode(":", $argv[2]);
			if(count($whatAt) == 2){
				$type = strtolower($whatAt[0]);
				$typeName = strtolower($whatAt[1]);
				switch ($type) {
					case 'controller':
						echo clean_color(create::controller($typeName));
					break;
					case 'model':
						echo clean_color(create::model($typeName));
					break;
					case 'library':
						echo clean_color(create::library($typeName));
					break;
					case 'extender':
						echo clean_color(create::extender($typeName));
					break;
					case 'package':
						echo clean_color(create::package($typeName));
					break;
										
					default:
						echo BAD_FORMAT();
					break;
				}
			}else{
				echo BAD_FORMAT();
			}
		}else{
			echo BAD_FORMAT();
		}
	}elseif(strtolower($argv[1]) == 'remote' || strtolower($argv[1]) == '-i'){ require_once 'curl.php';

		if(isset($argv[2]) && $argv[2]!=''){
			$domain = rtrim($argv[2],"/");
			$url = $domain."/service.php";
			$ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $status = curl_exec($ch);
            curl_close ($ch);
			
			function sh_cmd($url){ $baseUrl = $url;
				ob_start();
				$message   =  '$sh :';
				print $message;
				flush();
				ob_flush();
				$cmd  =  strtolower(trim( fgets( STDIN ) ));
				$cmd = str_replace(" ","/",$cmd);
				$url = $url.$cmd;				
				echo curl::get($url);
				#$output = ob_get_contents();
				ob_get_flush();
				sh_cmd($baseUrl);
			}
			
			if($status == 'yes'){ $url = $baseUrl = $url.'?cmd=';
				sh_cmd($url);
			}else{
				echo "Sorry, could not find sh service.";
			}
	 	}
	 
	}elseif(strtolower($argv[1]) == 'remove' || strtolower($argv[1]) == 'rm'){ require_once 'remove.php';

		if(isset($argv[2]) && $argv[2]!=''){
			$whatAt = explode(":", $argv[2]);
			if(count($whatAt) == 2){
				$type = strtolower($whatAt[0]);
				$typeName = strtolower($whatAt[1]);
				$prompt  = (isset($argv[3]))?$argv[3]:NULL;
				switch ($type) {
					case 'controller':
						echo clean_color(remove::controller($typeName,$prompt));
					break;
					case 'model':
						echo clean_color(remove::model($typeName,$prompt));
					break;
					case 'library':
						echo clean_color(remove::library($typeName,$prompt));
					break;
					case 'extender':
						echo clean_color(remove::extender($typeName,$prompt));
					break;
					case 'package':
						echo clean_color(remove::package($typeName,$prompt));
					break;
					case 'module':
						echo clean_color(remove::module($typeName,$prompt));
					break;
										
					default:
						echo BAD_FORMAT();
					break;
				}
			}else{
				echo BAD_FORMAT();	
			}
		}else{
			echo BAD_FORMAT();
		}

	}elseif(strtolower($argv[1]) == 'import' || strtolower($argv[1]) == 'im'){ require_once 'import.php';
		$import = new import();
		if(isset($argv[2]) && $argv[2]!=''){
			$whatAt = explode(":", $argv[2]);
			if(count($whatAt) == 2){
				$type = strtolower($whatAt[0]);
				$typeName = strtolower($whatAt[1]);
				switch ($type) {
					case 'package':
						echo (trim($type)!="" && $typeName)?clean_color($import->package($typeName)):BAD_FORMAT();
					break;
					case 'module':
						echo (trim($type)!="" && $typeName)?clean_color($import->module($typeName)):BAD_FORMAT();
					break;				
					default:
						echo BAD_FORMAT();
					break;
				}
			}else{
				echo BAD_FORMAT();	
			}
		}else{
			echo BAD_FORMAT();
		}

	}elseif(strtolower($argv[1]) == 'compile' || strtolower($argv[1]) == 'exe'){ require_once 'compile.php';
		$compile = new compile();
		if(isset($argv[2]) && $argv[2]!=''){						
				$type = $argv[2];
				switch ($type) {
					case 'extender':
						echo clean_color($compile->extender());
					break;			
					default:
						echo BAD_FORMAT();
					break;
				}
			
		}else{
			echo BAD_FORMAT();
		}

	}elseif(strtolower($argv[1]) == 'explain' || strtolower($argv[1]) == 'exp'){ require_once 'explain.php';
		$explain = new explain();
		if(isset($argv[2]) && $argv[2]!=''){
			$whatAt = explode(":", $argv[2]);
			if(count($whatAt) == 2){
				$type = strtolower($whatAt[0]);
				$typeName = strtolower($whatAt[1]);
				switch ($type) {
					case 'module':
						echo (trim($type)!="" && $typeName)?clean_color($explain->module($typeName)):BAD_FORMAT();
					break;
					case 'extender':
						echo (trim($type)!="" && $typeName)?clean_color($explain->extender($typeName)):BAD_FORMAT();
					break;
					case 'routes':
						echo (trim($type)!="" && $typeName)?clean_color($explain->routes($typeName)):BAD_FORMAT();
					break;		
					default:
						echo BAD_FORMAT();
					break;
				}
			}else{
				echo BAD_FORMAT();	
			}
		}else{
			echo BAD_FORMAT();
		}

	}elseif(strtolower($argv[1]) == 'show' || strtolower($argv[1]) == 'ls' || strtolower($argv[1]) == 'list'){ require_once 'show.php';

		if(isset($argv[2]) && $argv[2]!=''){
				$type = strtolower($argv[2]);
				$typeName = strtolower($argv[2]);
				switch ($type) {
					case 'controllers':
						echo clean_color(show::controller($typeName));
					break;
					case 'models':
						echo clean_color(show::model($typeName));
					break;
					case 'libraries':
						echo clean_color(show::library($typeName));
					break;
					case 'extenders':
						echo clean_color(show::extender($typeName));
					break;
					case 'packages':
						echo clean_color(show::package($typeName));
					break;
					case 'modules':
						echo clean_color(show::module($typeName));
					break;
					case 'modules:live':
						echo clean_color(show::live_module("modules"));
					break;
					case 'packages:live':
						echo clean_color(show::live_package("packages"));
					break;
										
					default:
						echo BAD_FORMAT();
					break;
				}
		}else{
			echo BAD_FORMAT();
		}

	}elseif($argv[1] == 'curl'){ require_once 'curl.php';
		$curl = new curl();
		if(isset($argv[2]) && $argv[2]!=''){
			$whatAt = explode(":", $argv[2]);			
			if(count($whatAt) >=2 ){
				$type = strtolower($whatAt[0]);
				$whatAt = explode($type.":", $argv[2]);
				$typeName = strtolower($whatAt[1]);
				switch ($type) {
					case 'get':
						echo clean_color($curl->get($typeName));
					break;
					case 'post':
						echo clean_color($curl->post($typeName));
					break;											
					default:
						echo BAD_FORMAT();
					break;
				}
			}else{
				echo BAD_FORMAT();	
			}
		}else{
			echo BAD_FORMAT();
		}

	}elseif(strtolower($argv[1]) == 'server' || strtolower($argv[1]) == '-s'){
		
		if(isset($argv[2]) && $argv[2]!=''){
			$whatAt = explode(":", $argv[2]);			
			if(count($whatAt) >=2 ){
				$type = strtolower($whatAt[0]);
				$whatAt = explode($type.":", $argv[2]);
				$port = strtolower($whatAt[1]);
				shell_exec("php -S localhost:".$port);				
			}else{
				echo BAD_FORMAT();	
			}
		}else{
			echo BAD_FORMAT();
		}
			
	}elseif(strtolower($argv[1]) == '-v' || strtolower($argv[1]) == '-version'){
			echo clean_color("\033[0;32msh-service framework v1.0.0 \033[0m (\033[0;37mDeveloped @ Soava Lab\033[0m) \n");
	}elseif(strtolower($argv[1]) == '-h' || strtolower($argv[1]) == '-help'){
		require_once 'commands.php';
	}elseif(strtolower($argv[1]) == 'status'){
		echo clean_color("\033[0;32msh-service is running...\033[0m \n");
	}else{
		echo BAD_FORMAT();
	}
}else{
		require_once 'commands.php';
}
function BAD_FORMAT(){
	return clean_color("\033[0;31msh-service bad format command.\033[0m \n");
}
function clean_color($str){
	 $codes = array("\033[0;32m", "\033[0m", "\033[0;31m","\033[0m","\033[1;33m","\033[0;37m","\033[0;33m");
	 $rcodes = array("","","","","","","");
	 if(strtoupper(substr(PHP_OS, 0, 3)) != 'LIN'){
	 	$str = str_replace($codes,$rcodes, $str);
	 } return $str;
}
function rrmdir($dir){
   if (is_dir($dir)) { 
     $objects = scandir($dir); 
     foreach ($objects as $object) { 
       if ($object != "." && $object != ".."){
         if (is_dir($dir."/".$object))
           rrmdir($dir."/".$object);
         else
           unlink($dir."/".$object); 
       } 
     }
     rmdir($dir); 
   } 
 }
