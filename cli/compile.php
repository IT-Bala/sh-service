<?php
# CLI command import 
class compile{
	
	public function extender(){ $msg=BAD_FORMAT(); $c_dir = 'extender'; $init_dir = $c_dir.'/init';
		  
		  if(!is_dir($init_dir)){ $uold = umask(0); mkdir($init_dir,0777,true); umask($uold); }

		  if(is_dir($init_dir) && is_writable($init_dir)){
			  	# Move extender files to init folder routes
		  		$files = glob($c_dir.'/*.php');
				// Identify directories
				$source = $c_dir."/";
				$destination = $init_dir."/";
				// Cycle through all source files
				$delete = [];
				foreach ($files as $file) {
				  if (in_array($file, array(".",".."))) continue;
				  // If we copied this successfully, mark it for deletion
				  echo $file."\n";
				  echo "Moving to ".$init_dir." directory...\n";
				  echo $destination.basename($file)."\n";
				  if (copy($file, $destination.strtolower(basename($file)))){
				    $delete[] = $file;
				  }
				}
				// Begin Find duplicate routes

				/*foreach (glob($destination."*.php") as $file) {
				    $file_handle = fopen($file, "r");
				    while (!feof($file_handle)) {
				        $line = fgets($file_handle);
				        echo $line."\n";
				    }
				    fclose($file_handle);
				}*/
				
				// End Find duplicate routes

				// Delete all successfully-copied files
				foreach ($delete as $file) {
				  unlink($file);
				}
				$msg = "\033[0;32m".ucfirst($c_dir)." has been compiled successfully.\nNow you can access the extender routes without call run('extender'). \033[0m \n";   

		  }else{
		  	$msg = "\033[0;31mPermission denied. coult't import ".$c_dir."  \033[0m \n";
		  }
		
		return $msg;
	}
	public function one($extender){ $msg=BAD_FORMAT(); $c_dir = 'extender'; $init_dir = $c_dir.'/init';
		  
		  if(!is_dir($init_dir)){ $uold = umask(0); mkdir($init_dir,0777,true); umask($uold); }

		  if(is_dir($init_dir) && is_writable($init_dir)){
			  	# Move extender files to init folder routes
		  		$files = glob($c_dir.'/.php');
				// Identify directories
				$file = $c_dir."/".strtolower($extender).".php";
				$destination = $init_dir."/";
				// Cycle through all source files
				
				echo $file."\n";
				echo "Moving to ".$init_dir." directory...\n";
				echo $destination.basename($file)."\n";
				copy($file, $destination.basename($file));

				// Delete all successfully-copied files
				unlink($file);
				$msg = "\033[0;32m".ucfirst($c_dir)." has been compiled successfully.\nNow you can access the extender routes without call run('extender'). \033[0m \n";   

		  }else{
		  	$msg = "\033[0;31mPermission denied. coult't import ".$c_dir."  \033[0m \n";
		  }
		
		return $msg;
	}
}
