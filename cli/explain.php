<?php
# CLI command import 
class explain{
	var $server_uri;
	public function module($module=NULL){ $msg=BAD_FORMAT(); $c_dir = 'modules'; $init_dir = $c_dir.'/'.$module.'/init.php';
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  require_once 'cli-terminal.php';
		  $colors = new Colors();
		  $msg = "\n";
		  if($module!=NULL){
				$file = $init_dir;
					if(file_exists($file)){
				    	$file_handle = fopen($file, "r");
				    	echo "\n================= ".clean_color($colors->getColoredString("[ ".strtoupper("EXTENDER ".$module." ROUTES")." ]", "yellow", "") )." =================\n";
					    while (!feof($file_handle)){
					        $line = fgets($file_handle);
					        #echo $line."\n";
					        if(trim($line) != ""){
					        	if((strpos($line, 'app->get') !== false || strpos($line, 'app->post') !== false || strpos($line, 'app->page') !== false || strpos($line, 'app->put' || strpos($line, 'app->delete') !== false) !== false) or strpos($line, 'Http::get') !== false || strpos($line, 'Http::post') !== false || strpos($line, 'Http::page') !== false || strpos($line, 'Http::put') !== false || strpos($line, 'Http::delete') !== false){

					        		$prefix = explode(',function',$line);
					        		echo "\n".$prefix[0].")\n";#$line."\n";
					        	}
					        	
					        }
					        
					    }
					    fclose($file_handle);

				    }else{
				    	$msg = "\033[0;31mModule $module is not found  \033[0m \n";
				    }

		  }else{
		  	$msg = "\033[0;31mModule ".$module." does not exist in ".$c_dir."  \033[0m \n";
		  }		
		  return $msg;
	}

	public function extender($extender=NULL){ $msg=BAD_FORMAT(); $c_dir = 'extender'; $init_dir = $c_dir.'/'.$extender.'.php';
		  require_once 'cli-terminal.php';
		  $colors = new Colors();
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  $msg = "\n";
		  if($extender!=NULL){
				$file = $init_dir;
				if(file_exists($file)){
					echo "\n================= ".clean_color($colors->getColoredString("[ ".strtoupper("EXTENDER ".$extender." ROUTES")." ]", "yellow", "") )." =================\n";
				    $file_handle = fopen($file, "r");
				    while (!feof($file_handle)) {
				        $line = fgets($file_handle);
				        #echo $line."\n";
				        if(trim($line) != ""){
				        	if((strpos($line, 'app->get') !== false || strpos($line, 'app->post') !== false || strpos($line, 'app->page') !== false || strpos($line, 'app->put' || strpos($line, 'app->delete') !== false) !== false) or strpos($line, 'Http::get') !== false || strpos($line, 'Http::post') !== false || strpos($line, 'Http::page') !== false || strpos($line, 'Http::put') !== false || strpos($line, 'Http::delete') !== false){
				        		
				        		$prefix = explode(',function',$line);
				        		echo "\n".$prefix[0].")\n"; #$line."\n";
				        	}
				        	
				        }
				        
				    }
				    fclose($file_handle);
				 }else{
				    	$msg = "\033[0;31m".ucfirst($c_dir)." $extender is not found \033[0m \n";
				 }

		  }else{
		  	$msg = "\033[0;31mExtender ".$extender." does not exist in ".$c_dir."  \033[0m \n";
		  }
		
		  return $msg;
	}

	public function routes($routes=NULL){ $msg=BAD_FORMAT(); $e_dir = 'extender'; $init_dir = $e_dir.'/*'; $m_dir = 'modules'; $init_m_dir = $m_dir.'/*';
		  require_once 'cli-terminal.php';
		  $colors = new Colors();
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  $routes = strtolower($routes);
		  $msg = "\n"; $routes_types = array("all","get","post","put","delete","page");
		  if($routes!=NULL && in_array($routes, $routes_types)){ $http_routes = [];

		  		# Index Routes List
				$file = 'index.php';
				$file_handle = fopen($file, "r");
			    while (!feof($file_handle)) {
			        $line = fgets($file_handle);
			        #echo $line."\n";
			        if(trim($line) != ""){

			        	if($routes == 'get'){
				        	if((strpos($line, 'app->get') !== false or strpos($line, 'Http::get') !== false)){						        		
				        		$prefix = explode(',function',$line);
				        		$route = "\n".$prefix[0].")\n"; #$line."\n";
				        		$http_routes[$file][] = $route;
				        	}
			        	}else if($routes == 'post'){
				        	if((strpos($line, 'app->post') !== false or strpos($line, 'Http::post') !== false)){						        		
				        		$prefix = explode(',function',$line);
				        		$route = "\n".$prefix[0].")\n"; #$line."\n";
				        		$http_routes[$file][] = $route;
				        	}
			        	}else if($routes == 'put'){
				        	if((strpos($line, 'app->put') !== false or strpos($line, 'Http::put') !== false)){						        		
				        		$prefix = explode(',function',$line);
				        		$route = "\n".$prefix[0].")\n"; #$line."\n";
				        		$http_routes[$file][] = $route;
				        	}
			        	}else if($routes == 'page'){
				        	if((strpos($line, 'app->page') !== false or strpos($line, 'Http::page') !== false)){						        		
				        		$prefix = explode(',function',$line);
				        		$route = "\n".$prefix[0].")\n"; #$line."\n";
				        		$http_routes[$file][] = $route;
				        	}
			        	}else if($routes == 'delete'){
				        	if((strpos($line, 'app->delete') !== false or strpos($line, 'Http::delete') !== false)){						        		
				        		$prefix = explode(',function',$line);
				        		$route = "\n".$prefix[0].")\n"; #$line."\n";
				        		$http_routes[$file][] = $route;
				        	}
			        	}else{
			        		if((strpos($line, 'app->get') !== false || strpos($line, 'app->post') !== false || strpos($line, 'app->page') !== false || strpos($line, 'app->put' || strpos($line, 'app->delete') !== false) !== false) or strpos($line, 'Http::get') !== false || strpos($line, 'Http::post') !== false || strpos($line, 'Http::page') !== false || strpos($line, 'Http::put') !== false || strpos($line, 'Http::delete') !== false){
				        		
				        		$prefix = explode(',function',$line);
				        		$route = "\n".$prefix[0].")\n"; #$line."\n";
				        		$http_routes[$file][] = $route;
				        	}
			        	}
			        	
			        }
			        
			    }
			    fclose($file_handle);

		  		# Exteders Routes List
				if(is_dir($e_dir)){					
					foreach (glob($init_dir) as $file) {
						#echo $file;
						if(is_file($file)){
							$file_handle = fopen($file, "r");
						    while (!feof($file_handle)) {
						        $line = fgets($file_handle);
						        #echo $line."\n";
						        if(trim($line) != ""){

						        	if($routes == 'get'){
							        	if((strpos($line, 'app->get') !== false or strpos($line, 'Http::get') !== false)){						        		
							        		$prefix = explode(',function',$line);
							        		$route = "\n".$prefix[0].")\n"; #$line."\n";
							        		$http_routes[$file][] = $route;
							        	}
						        	}else if($routes == 'post'){
							        	if((strpos($line, 'app->post') !== false or strpos($line, 'Http::post') !== false)){						        		
							        		$prefix = explode(',function',$line);
							        		$route = "\n".$prefix[0].")\n"; #$line."\n";
							        		$http_routes[$file][] = $route;
							        	}
						        	}else if($routes == 'put'){
							        	if((strpos($line, 'app->put') !== false or strpos($line, 'Http::put') !== false)){						        		
							        		$prefix = explode(',function',$line);
							        		$route = "\n".$prefix[0].")\n"; #$line."\n";
							        		$http_routes[$file][] = $route;
							        	}
						        	}else if($routes == 'page'){
							        	if((strpos($line, 'app->page') !== false or strpos($line, 'Http::page') !== false)){						        		
							        		$prefix = explode(',function',$line);
							        		$route = "\n".$prefix[0].")\n"; #$line."\n";
							        		$http_routes[$file][] = $route;
							        	}
						        	}else if($routes == 'delete'){
							        	if((strpos($line, 'app->delete') !== false or strpos($line, 'Http::delete') !== false)){						        		
							        		$prefix = explode(',function',$line);
							        		$route = "\n".$prefix[0].")\n"; #$line."\n";
							        		$http_routes[$file][] = $route;
							        	}
						        	}else{
						        		if((strpos($line, 'app->get') !== false || strpos($line, 'app->post') !== false || strpos($line, 'app->page') !== false || strpos($line, 'app->put' || strpos($line, 'app->delete') !== false) !== false) or strpos($line, 'Http::get') !== false || strpos($line, 'Http::post') !== false || strpos($line, 'Http::page') !== false || strpos($line, 'Http::put') !== false || strpos($line, 'Http::delete') !== false){
							        		
							        		$prefix = explode(',function',$line);
							        		$route = "\n".$prefix[0].")\n"; #$line."\n";
							        		$http_routes[$file][] = $route;
							        	}
						        	}
						        	
						        }
						        
						    }
						    fclose($file_handle);
					    }else if(is_dir($file)){ 
					    	$init_all = $file."/*";
					    	foreach (glob($init_all) as $file) {
					    		if(is_file($file)){
									$file_handle = fopen($file, "r");
								    while (!feof($file_handle)) {
								        $line = fgets($file_handle);
								        #echo $line."\n";
								        if(trim($line) != ""){

								        	if($routes == 'get'){
									        	if((strpos($line, 'app->get') !== false or strpos($line, 'Http::get') !== false)){						        		
									        		$prefix = explode(',function',$line);
									        		$route = "\n".$prefix[0].")\n"; #$line."\n";
									        		$http_routes[$file][] = $route;
									        	}
								        	}else if($routes == 'post'){
									        	if((strpos($line, 'app->post') !== false or strpos($line, 'Http::post') !== false)){						        		
									        		$prefix = explode(',function',$line);
									        		$route = "\n".$prefix[0].")\n"; #$line."\n";
									        		$http_routes[$file][] = $route;
									        	}
								        	}else if($routes == 'put'){
									        	if((strpos($line, 'app->put') !== false or strpos($line, 'Http::put') !== false)){						        		
									        		$prefix = explode(',function',$line);
									        		$route = "\n".$prefix[0].")\n"; #$line."\n";
									        		$http_routes[$file][] = $route;
									        	}
								        	}else if($routes == 'page'){
									        	if((strpos($line, 'app->page') !== false or strpos($line, 'Http::page') !== false)){						        		
									        		$prefix = explode(',function',$line);
									        		$route = "\n".$prefix[0].")\n"; #$line."\n";
									        		$http_routes[$file][] = $route;
									        	}
								        	}else if($routes == 'delete'){
									        	if((strpos($line, 'app->delete') !== false or strpos($line, 'Http::delete') !== false)){						        		
									        		$prefix = explode(',function',$line);
									        		$route = "\n".$prefix[0].")\n"; #$line."\n";
									        		$http_routes[$file][] = $route;
									        	}
								        	}else{
								        		if((strpos($line, 'app->get') !== false || strpos($line, 'app->post') !== false || strpos($line, 'app->page') !== false || strpos($line, 'app->put' || strpos($line, 'app->delete') !== false) !== false) or strpos($line, 'Http::get') !== false || strpos($line, 'Http::post') !== false || strpos($line, 'Http::page') !== false || strpos($line, 'Http::put') !== false || strpos($line, 'Http::delete') !== false){
									        		
									        		$prefix = explode(',function',$line);
									        		$route = "\n".$prefix[0].")\n"; #$line."\n";
									        		$http_routes[$file][] = $route;
									        	}
								        	}
								        	
								        }
								        
								    }
								    fclose($file_handle);
							    }
					    	}
					    }
					} 
				}
				# Modules Routes List
				if(is_dir($m_dir)){					
					foreach (glob($init_m_dir) as $module) {
						#echo basename($module);
						$file = $module."/"."init.php";
						if(file_exists($file)){
						$file_handle = fopen($file, "r");
					    while (!feof($file_handle)) {
					        $line = fgets($file_handle);
					        #echo $line."\n";
					        if(trim($line) != ""){

					        	if($routes == 'get'){
						        	if((strpos($line, 'app->get') !== false or strpos($line, 'Http::get') !== false)){						        		
						        		$prefix = explode(',function',$line);
						        		$route = "\n".$prefix[0].")\n"; #$line."\n";
						        		$http_routes[$file][] = $route;
						        	}
					        	}else if($routes == 'post'){
						        	if((strpos($line, 'app->post') !== false or strpos($line, 'Http::post') !== false)){						        		
						        		$prefix = explode(',function',$line);
						        		$route = "\n".$prefix[0].")\n"; #$line."\n";
						        		$http_routes[$file][] = $route;
						        	}
					        	}else if($routes == 'put'){
						        	if((strpos($line, 'app->put') !== false or strpos($line, 'Http::put') !== false)){						        		
						        		$prefix = explode(',function',$line);
						        		$route = "\n".$prefix[0].")\n"; #$line."\n";
						        		$http_routes[$file][] = $route;
						        	}
					        	}else if($routes == 'page'){
						        	if((strpos($line, 'app->page') !== false or strpos($line, 'Http::page') !== false)){						        		
						        		$prefix = explode(',function',$line);
						        		$route = "\n".$prefix[0].")\n"; #$line."\n";
						        		$http_routes[$file][] = $route;
						        	}
					        	}else if($routes == 'delete'){
						        	if((strpos($line, 'app->delete') !== false or strpos($line, 'Http::delete') !== false)){						        		
						        		$prefix = explode(',function',$line);
						        		$route = "\n".$prefix[0].")\n"; #$line."\n";
						        		$http_routes[$file][] = $route;
						        	}
					        	}else{
					        		if((strpos($line, 'app->get') !== false || strpos($line, 'app->post') !== false || strpos($line, 'app->page') !== false || strpos($line, 'app->put' || strpos($line, 'app->delete') !== false) !== false) or strpos($line, 'Http::get') !== false || strpos($line, 'Http::post') !== false || strpos($line, 'Http::page') !== false || strpos($line, 'Http::put') !== false || strpos($line, 'Http::delete') !== false){
						        		
						        		$prefix = explode(',function',$line);
						        		$route = "\n".$prefix[0].")\n"; #$line."\n";
						        		$http_routes[$file][] = $route;
						        	}
					        	}
					        	
					        }
					        
					    }
					    fclose($file_handle);
					    }
					} 
				}
	
				echo "\n================= ".clean_color($colors->getColoredString("[ ".strtoupper($routes)." ROUTES ]", "yellow", "") )." =================\n\n";
				foreach ($http_routes as $filename => $routes) {
						$fileLength = strlen($filename);
						$equalTo = ""; $fileLength = 50;
						for ($i=0; $i < $fileLength; $i++){
							$equalTo .= '=';
						}
						echo clean_color($colors->getColoredString("\n".$equalTo."\n".$filename."\n".$equalTo, "green", "") );
						foreach ($routes as $url){
							echo $url;
						}
				}
				echo clean_color($colors->getColoredString("\n".$equalTo, "green", "") );

		  }else{
		  	$msg = "\033[0;31mRoutes ".$routes." does not exist in routes  \033[0m \n";
		  }
		
		return $msg;
	}
}
