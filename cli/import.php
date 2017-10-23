<?php
# CLI command import 
class import{
	var $server_uri; 
	public function __construct(){
		$this->server_uri = 'http://phpbala.in/';
	}
	protected function getHeaders($url)
	{
	  $ch = curl_init($url);
	  curl_setopt( $ch, CURLOPT_NOBODY, true );
	  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, false );
	  curl_setopt( $ch, CURLOPT_HEADER, false );
	  curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
	  curl_setopt( $ch, CURLOPT_MAXREDIRS, 3 );
	  curl_exec( $ch );
	  $headers = curl_getinfo( $ch );
	  curl_close( $ch );

	  return $headers;
	}
	protected function download($url, $path)
	{
	  # open file to write
	  $fp = fopen ($path, 'w+');
	  # start curl
	  $ch = curl_init();
	  curl_setopt( $ch, CURLOPT_URL, $url );
	  # set return transfer to false
	  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, false );
	  curl_setopt( $ch, CURLOPT_BINARYTRANSFER, true );
	  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
	  # increase timeout to download big file
	  curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
	  # write data to local file
	  curl_setopt( $ch, CURLOPT_FILE, $fp );
	  # execute curl
	  curl_exec( $ch );
	  # close curl
	  curl_close( $ch );
	  # close local file
	  fclose( $fp );

	  if (filesize($path) > 0) return true;
	}
	public function package($fileName){ $msg=BAD_FORMAT(); $c_dir = 'package'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		$message = "<?php\nnamespace package;\nclass ".ucfirst($fileName)."{\n\n}\n?>";
		if (file_exists($file)){
		  	$msg = "\033[0;31m".ucfirst($fileName)." ".$c_dir." already exist.\033[0m \n";
		} else { 
		  if(is_dir($c_dir) && is_writable($c_dir)){
		  	# Download from server & extract
			$url = $this->server_uri.$c_dir."/".ucfirst($fileName).".pkg";
			$headers = self::getHeaders($url);
			$path	 = $c_dir."/".ucfirst($fileName).".php";
			if ($headers['http_code'] === 200 and $headers['download_content_length'] < 1024*1024) {
			  if (self::download($url, $path)){
			 	$msg = "\033[0;32m".ucfirst($c_dir).' '.ucfirst($fileName).' has been imported'."\033[0m \nGo to ".$file." create your methods and access easily.\n";   
			  }else{
			  	$msg = "\033[0;31mSorry,coult't import ".$c_dir."  \033[0m \n";
			  }
			}else{
				$msg = "\033[0;31mSorry, Package `".ucfirst($fileName)."` is not available. \033[0m \n";
			}
		  }else{
		  	$msg = "\033[0;31mPermission denied. coult't import ".$c_dir."  \033[0m \n";
		  }
		}
		return $msg;
	}
	public function module($fileName){ $msg=BAD_FORMAT(); $c_dir = 'modules'; $module = $c_dir.'/'.strtolower($fileName);
		if(is_dir($module)){
		  	$msg = "\033[0;31m".$fileName." module already exist.\033[0m \n";
		}else{ 
		  if(!is_dir($c_dir)){ $uold = umask(0); mkdir($c_dir,0777,true); umask($uold); }
		  if(is_dir($c_dir) && is_writable($c_dir)){
		  	# Download from server & extract
			$url = $this->server_uri.$c_dir."/".strtolower($fileName).".zip";
			$headers = self::getHeaders($url);
			$path	 = $c_dir."/".strtolower($fileName).".zip";
			if ($headers['http_code'] === 200 and $headers['download_content_length'] < 1024*1024) {
			  if (self::download($url, $path)){
			  	require_once('unzip/pclzip.lib.php');
				$zipfile = new PclZip($path);
				if ($zipfile -> extract(PCLZIP_OPT_PATH, $c_dir.'/') == 0){
					$msg = "\033[0;31mSorry,coult't import ".$c_dir."  \033[0m \n". $zipfile -> errorInfo(true);
				}else{
					unlink($path);
					$msg = "\033[0;32m".'Module '.strtolower($fileName).' has been imported'."\033[0m \nGo to ".$module." access easily.\n";   
				}
			  }else{
			  		$msg = "\033[0;31mSorry,coult't import ".$c_dir."  \033[0m \n";
			  }
			}else{
					$msg = "\033[0;31mSorry, Module `".strtolower($fileName)."` is not available. \033[0m \n";
			}
		  }else{
		  			$msg = "\033[0;31mPermission denied modules directory. coult't import ".$c_dir."  \033[0m \n";
		  }
		}
		return $msg;
	} 
}
