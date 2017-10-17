<?php
# CLI command show 
class show{
	var $server_uri;
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
		  	$msg = "\033[0;31mModule ".$module." does not exist in ".$c_dir."  \033[0m \n";
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
		  	$msg = "\033[0;31mModule ".$module." does not exist in ".$c_dir."  \033[0m \n";
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
		  	$msg = "\033[0;31mModule ".$module." does not exist in ".$c_dir."  \033[0m \n";
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
		  	$msg = "\033[0;31mModule ".$module." does not exist in ".$c_dir."  \033[0m \n";
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
}
