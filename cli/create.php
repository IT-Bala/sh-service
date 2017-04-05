<?php
# CLI command create 
class create{
	public function controller($fileName){ $msg=BAD_FORMAT(); $c_dir = 'controller'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		$message = "<?php\n#Create your public methods here to access on route.\nclass ".ucfirst($fileName)."{\n\n}\n?>";
		if (file_exists($file)){
		  	$msg = "\033[0;31m".ucfirst($fileName)." ".$c_dir." already exist.\033[0m \n";
		} else {
		  if(is_dir($c_dir) && is_writable($c_dir)){
		  	$fh = fopen($file, 'w');
		    fwrite($fh, $message."\n");
		    $msg = "\033[0;32m".ucfirst($c_dir).' '.ucfirst($fileName).' has been created'."\033[0m \nGo to ".$file." create your methods and access easily.\n";
		    fclose($fh);
		  }else{
		  	$msg = "\033[0;31mPermission denied. coult't create ".$c_dir."  \033[0m \n";
		  }
		}
		return $msg;
	}
	public function model($fileName){ $msg=BAD_FORMAT(); $c_dir = 'model'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		$message = "<?php\n#Create your public methods here to access.\nclass ".ucfirst($fileName)."{\n\n}\n?>";
		if (file_exists($file)){
		  	$msg = "\033[0;31m".ucfirst($fileName)." ".$c_dir." already exist.\033[0m \n";
		} else {
		  if(is_dir($c_dir) && is_writable($c_dir)){
		  	$fh = fopen($file, 'w');
		    fwrite($fh, $message."\n");
		    $msg = "\033[0;32m".ucfirst($c_dir).' '.ucfirst($fileName).' has been created'."\033[0m \nGo to ".$file." create your methods and access easily.\n";
		    fclose($fh);
		  }else{
		  	$msg = "\033[0;31mPermission denied. coult't create ".$c_dir."  \033[0m \n";
		  }
		}
		return $msg;
	}
	public function library($fileName){ $msg=BAD_FORMAT(); $c_dir = 'library'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		$message = "<?php\n#Create your public methods here to access.\nclass ".ucfirst($fileName)."{\n\n}\n?>";
		if (file_exists($file)){
		  	$msg = "\033[0;31m".ucfirst($fileName)." ".$c_dir." already exist.\033[0m \n";
		} else {
		  if(is_dir($c_dir) && is_writable($c_dir)){
		  	$fh = fopen($file, 'w');
		    fwrite($fh, $message."\n");
		    $msg = "\033[0;32m".ucfirst($c_dir).' '.ucfirst($fileName).' has been created'."\033[0m \nGo to ".$file." create your methods and access easily.\n";
		    fclose($fh);
		  }else{
		  	$msg = "\033[0;31mPermission denied. coult't create ".$c_dir."  \033[0m \n";
		  }
		}
		return $msg;
	}
	public function extender($fileName){ $msg=BAD_FORMAT(); $c_dir = 'extender'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		$message = "<?php\nif(!defined('SHA')) die('Access denied!');\n\n/*Http::get('/test',function(){\n echo 'Test page is running...';\n});*/\n?>";
		if (file_exists($file)){
		  	$msg = "\033[0;31m".ucfirst($fileName)." ".$c_dir." already exist.\033[0m \n";
		} else {
		  if(is_dir($c_dir) && is_writable($c_dir)){
		  	$fh = fopen($file, 'w');
		    fwrite($fh, $message."\n");
		    $msg = "\033[0;32m".ucfirst($c_dir).' '.ucfirst($fileName).' has been created'."\033[0m \nGo to ".$file." create your routes and access easily.\n";
		    fclose($fh);
		  }else{
		  	$msg = "\033[0;31mPermission denied. coult't create ".$c_dir."  \033[0m \n";
		  }
		}
		return $msg;
	}
	public function package($fileName){ $msg=BAD_FORMAT(); $c_dir = 'package'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		$message = "<?php\nnamespace package;\nclass ".ucfirst($fileName)."{\n\n}\n?>";
		if (file_exists($file)){
		  	$msg = "\033[0;31m".ucfirst($fileName)." ".$c_dir." already exist.\033[0m \n";
		} else {
		  if(is_dir($c_dir) && is_writable($c_dir)){
		  	$fh = fopen($file, 'w');
		    fwrite($fh, $message."\n");
		    $msg = "\033[0;32m".ucfirst($c_dir).' '.ucfirst($fileName).' has been created'."\033[0m \nGo to ".$file." create your methods and access easily.\n";
		    fclose($fh);
		  }else{
		  	$msg = "\033[0;31mPermission denied. coult't create ".$c_dir."  \033[0m \n";
		  }
		}
		return $msg;
	}
}
