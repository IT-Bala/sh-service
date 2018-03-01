<?php
# CLI command remove
require_once 'db.php';
class getSynch{
	
	public function controller($fileName,$dest=NULL,$url=NULL){ $msg=BAD_FORMAT(); $c_dir = 'controller'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		if (file_exists($file)){
			if(is_dir($c_dir) && is_writable($c_dir) && is_readable($file)){  
		  		$fileContent = base64_encode(file_get_contents($file));
				$dest		 = ($dest!=NULL)?$dest:$fileName;
				$data    = json_encode(array("type"=>"model","filename"=>strtolower($fileName),"dest"=>strtolower($dest),"content"=>$fileContent));
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$server_output = curl_exec($ch);
				curl_close ($ch);
				$msg = $server_output."\n";
		    }else{
		  		$msg = "\033[0;31mPermission denied. coult't remove ".$c_dir."  \033[0m \n";
		    }
		} else {
		  $msg = "\033[0;31m".ucfirst($fileName)." ".$c_dir." does not exist.\033[0m \n";
		}
		return $msg;
	}
	public function model($fileName,$dest=NULL,$url=NULL){ $msg=BAD_FORMAT(); $c_dir = 'model'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		if (file_exists($file)){
			if(is_dir($c_dir) && is_writable($c_dir) && is_readable($file)){
				$fileContent = base64_encode(file_get_contents($file));
				$dest		 = ($dest!=NULL)?$dest:$fileName;
				$data    = json_encode(array("type"=>"model","filename"=>strtolower($fileName),"dest"=>strtolower($dest),"content"=>$fileContent));
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$server_output = curl_exec($ch);
				curl_close ($ch);
				$msg = $server_output."\n";
		    }else{
		  		$msg = "\033[0;31mPermission denied. coult't remove ".$c_dir."  \033[0m \n";
		    }
		} else {
		  $msg = "\033[0;31m".ucfirst($fileName)." ".$c_dir." does not exist.\033[0m \n";
		}
		return $msg;
	}
	public function library($fileName,$dest=NULL,$url=NULL){ $msg=BAD_FORMAT(); $c_dir = 'library'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		if (file_exists($file)){
			if(is_dir($c_dir) && is_writable($c_dir) && is_readable($file)){ 
		  		$fileContent = base64_encode(file_get_contents($file));
				$dest		 = ($dest!=NULL)?$dest:$fileName;
				$data    = json_encode(array("type"=>"model","filename"=>strtolower($fileName),"dest"=>strtolower($dest),"content"=>$fileContent));
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$server_output = curl_exec($ch);
				curl_close ($ch);
				$msg = $server_output."\n";
		    }else{
		  		$msg = "\033[0;31mPermission denied. coult't remove ".$c_dir."  \033[0m \n";
		    }
		} else {
		  $msg = "\033[0;31m".ucfirst($fileName)." ".$c_dir." does not exist.\033[0m \n";
		}
		return $msg;
	}
	public function extender($fileName,$dest=NULL,$url=NULL){ $msg=BAD_FORMAT(); $c_dir = 'extender'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		if (file_exists($file)){
			if(is_dir($c_dir) && is_writable($c_dir) && is_readable($file)){ 
		  		$fileContent = base64_encode(file_get_contents($file));
				$dest		 = ($dest!=NULL)?$dest:$fileName;
				$data    = json_encode(array("type"=>"model","filename"=>strtolower($fileName),"dest"=>strtolower($dest),"content"=>$fileContent));
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$server_output = curl_exec($ch);
				curl_close ($ch);
				$msg = $server_output."\n";
		    }else{
		  		$msg = "\033[0;31mPermission denied. coult't remove ".$c_dir."  \033[0m \n";
		    }
		} else {
		  $msg = "\033[0;31m".ucfirst($fileName)." ".$c_dir." does not exist.\033[0m \n";
		}
		return $msg;
	}
	public function package($fileName,$dest=NULL,$url=NULL){ $msg=BAD_FORMAT(); $c_dir = 'package'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		if (file_exists($file)){
			if(is_dir($c_dir) && is_writable($c_dir) && is_readable($file)){ 
		  		$fileContent = base64_encode(file_get_contents($file));
				$dest		 = ($dest!=NULL)?$dest:$fileName;
				$data    = json_encode(array("type"=>"model","filename"=>strtolower($fileName),"dest"=>strtolower($dest),"content"=>$fileContent));
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$server_output = curl_exec($ch);
				curl_close ($ch);
				$msg = $server_output."\n";
		    }else{
		  		$msg = "\033[0;31mPermission denied. coult't remove ".$c_dir."  \033[0m \n";
		    }
		} else {
		  $msg = "\033[0;31m".ucfirst($fileName)." ".$c_dir." does not exist.\033[0m \n";
		}
		return $msg;
	}
	public function module($fileName,$dest=NULL,$url=NULL){ $msg=BAD_FORMAT(); $c_dir = 'modules'; $file = $c_dir.'/'.strtolower($fileName);
		if (file_exists($file)){
			if(is_dir($c_dir) && is_writable($c_dir) && is_readable($file)){ 
		  		
		  		$msg = "\033[0;32m".'Module '.strtolower($fileName).' has been removed permanently'."\033[0m \n";
		    }else{
		  		$msg = "\033[0;31mPermission denied. coult't remove ".$c_dir."  \033[0m \n";
		    }
		} else {
		  $msg = "\033[0;31m".strtolower($fileName)." module does not exist.\033[0m \n";
		}
		return $msg;
	}
	public function api($fileName,$dropTable=NULL,$prompt=NULL){ $msg=BAD_FORMAT(); $c_dir = 'extender/init'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		if (file_exists($file)){
			if(is_dir($c_dir) && is_writable($c_dir) && is_readable($file)){ 
		  		$fileContent = base64_encode(file_get_contents($file));
				$dest		 = ($dest!=NULL)?$dest:$fileName;
				$data    = json_encode(array("type"=>"model","filename"=>strtolower($fileName),"dest"=>strtolower($dest),"content"=>$fileContent));
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$server_output = curl_exec($ch);
				curl_close ($ch);
				$msg = $server_output."\n";
		    }else{
		  		$msg = "\033[0;31mPermission denied. coult't remove ".$c_dir."  \033[0m \n";
		    }
		} else {
		  $msg = "\033[0;31m".ucfirst($fileName)." ".$c_dir." does not exist.\033[0m \n";
		}
  		return $msg;
  	}
   
}
