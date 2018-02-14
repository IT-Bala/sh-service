<?php
# CLI command show 
class show{
	public function controller($module=NULL){ $msg=BAD_FORMAT(); $c_dir = 'controller'; $init_dir = $c_dir.'/*';
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  require_once 'cli-terminal.php';
		  $colors = new Colors();
		  $msg = "\n";
		  if($module!=NULL){
				echo "\n================= ".clean_color($colors->getColoredString("[ ".strtoupper("ALL ".$module."")." ]", "yellow", "") )." =================\n";
				if(is_dir($c_dir)){					
					foreach (glob($init_dir) as $file){
						echo "\n".basename($file)."\n";
					}
				}

		  }else{
		  	$msg = "\033[0;31mController ".$module." does not exist in ".$c_dir."  \033[0m \n";
		  }		
		  return $msg;
	}
	public function model($module=NULL){ $msg=BAD_FORMAT(); $c_dir = 'model'; $init_dir = $c_dir.'/*';
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  require_once 'cli-terminal.php';
		  $colors = new Colors();
		  $msg = "\n";
		  if($module!=NULL){
				echo "\n================= ".clean_color($colors->getColoredString("[ ".strtoupper("ALL ".$module."")." ]", "yellow", "") )." =================\n";
				if(is_dir($c_dir)){					
					foreach (glob($init_dir) as $file){
						echo "\n".basename($file)."\n";
					}
				}

		  }else{
		  	$msg = "\033[0;31mModel ".$module." does not exist in ".$c_dir."  \033[0m \n";
		  }		
		  return $msg;
	}
	public function library($module=NULL){ $msg=BAD_FORMAT(); $c_dir = 'library'; $init_dir = $c_dir.'/*';
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  require_once 'cli-terminal.php';
		  $colors = new Colors();
		  $msg = "\n";
		  if($module!=NULL){
				echo "\n================= ".clean_color($colors->getColoredString("[ ".strtoupper("ALL ".$module."")." ]", "yellow", "") )." =================\n";
				if(is_dir($c_dir)){					
					foreach (glob($init_dir) as $file){
						echo "\n".basename($file)."\n";
					}
				}

		  }else{
		  	$msg = "\033[0;31mLibrary ".$module." does not exist in ".$c_dir."  \033[0m \n";
		  }		
		  return $msg;
	}
	public function package($module=NULL){ $msg=BAD_FORMAT(); $c_dir = 'package'; $init_dir = $c_dir.'/*';
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  require_once 'cli-terminal.php';
		  $colors = new Colors();
		  $msg = "\n";
		  if($module!=NULL){
				echo "\n================= ".clean_color($colors->getColoredString("[ ".strtoupper("ALL ".$module."")." ]", "yellow", "") )." =================\n";
				if(is_dir($c_dir)){					
					foreach (glob($init_dir) as $file){
						echo "\n".basename($file)."\n";
					}
				}

		  }else{
		  	$msg = "\033[0;31mPackage ".$module." does not exist in ".$c_dir."  \033[0m \n";
		  }		
		  return $msg;
	}
	public function extender($module=NULL){ $msg=BAD_FORMAT(); $c_dir = 'extender'; $init_dir = $c_dir.'/.php*';
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  require_once 'cli-terminal.php';
		  $colors = new Colors();
		  $msg = "\n";
		  if($module!=NULL){
				echo "\n================= ".clean_color($colors->getColoredString("[ ".strtoupper("ALL ".$module."")." ]", "yellow", "") )." =================\n";
				if(is_dir($c_dir)){					
					foreach (glob($init_dir) as $file){
						echo "\n".basename($file)."\n";
					}
				}

		  }else{
		  	$msg = "\033[0;31mExtender ".$module." does not exist in ".$c_dir."  \033[0m \n";
		  }		
		  return $msg;
	}
	public function init($module=NULL){ $msg=BAD_FORMAT(); $c_dir = 'extender/init'; $init_dir = $c_dir.'/*';
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  require_once 'cli-terminal.php';
		  $colors = new Colors();
		  $msg = "\n";
		  if($module!=NULL){
				echo "\n================= ".clean_color($colors->getColoredString("[ ".strtoupper("ALL ".$module."")." ]", "yellow", "") )." =================\n";
				if(is_dir($c_dir)){					
					foreach (glob($init_dir) as $file){
						echo "\n".basename($file)."\n";
					}
				}

		  }else{
		  	$msg = "\033[0;31mExtender ".$module." does not exist in ".$c_dir."  \033[0m \n";
		  }		
		  return $msg;
	}

	public function module($module=NULL){ $msg=BAD_FORMAT(); $c_dir = 'modules'; $init_dir = $c_dir.'/*';
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  require_once 'cli-terminal.php';
		  $colors = new Colors();
		  $msg = "\n";
		  if($module!=NULL){
				echo "\n================= ".clean_color($colors->getColoredString("[ ".strtoupper("ALL ".$module."")." ]", "yellow", "") )." =================\n";
				if(is_dir($c_dir)){					
					foreach (glob($init_dir) as $file){
						echo "\n".basename($file)."\n";
					}
				}

		  }else{
		  	$msg = "\033[0;31mModule ".$module." does not exist in ".$c_dir."  \033[0m \n";
		  }		
		  return $msg;
	}
	public function live_module($module=NULL){ $msg=BAD_FORMAT(); $c_dir = 'modules'; $init_dir = $c_dir.'/*';
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  require_once 'cli-terminal.php';
		  $colors = new Colors();
		  $msg = "\n";
		  if($module!=NULL){
			    echo "Please wait loading ... \n";
			  	$url = "http://phpbala.in/import.php?".$c_dir;
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$server_output = curl_exec($ch);
				curl_close ($ch);		
				if($server_output!=""){		
				$json = json_decode($server_output);
				echo "\n================= ".clean_color($colors->getColoredString("".strtoupper("".$json->body->title."")."", "yellow", "") )." =================\n";	
					if(count($json->body->name) > 0){	
						foreach ($json->body->name as $file){
							echo "\n".strtolower(basename($file))."\n";
						}
					}
				}else{
					$msg = "\033[0;31mSorry could not read the ".$module.". please try again.  \033[0m \n";
				}

		  }else{
		  	$msg = "\033[0;31mModule ".$module." does not exist in ".$c_dir."  \033[0m \n";
		  }		
		  return $msg;
	}
	public function live_package($module=NULL){ $msg=BAD_FORMAT(); $c_dir = 'packages'; $init_dir = $c_dir.'/*';
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  require_once 'cli-terminal.php';
		  $colors = new Colors();
		  $msg = "\n";
		  if($module!=NULL){
			  	echo "Please wait loading ... \n";
			  	$url = "http://phpbala.in/import.php?".$c_dir;
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$server_output = curl_exec($ch);
				curl_close ($ch);		
				if($server_output!=""){		
				$json = json_decode($server_output);
				echo "\n================= ".clean_color($colors->getColoredString("".strtoupper("".$json->body->title."")."", "yellow", "") )." =================\n";	
					if(count($json->body->name) > 0){	
						foreach ($json->body->name as $file){
							echo "\n".strtolower(basename($file))."\n";
						}
					}
				}else{
					$msg = "\033[0;31mSorry could not read the ".$module.". please try again.  \033[0m \n";
				}

		  }else{
		  	$msg = "\033[0;31mModule ".$module." does not exist in ".$c_dir."  \033[0m \n";
		  }		
		  return $msg;
	}
}
