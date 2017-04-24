<?php
# CLI command import 
class explain{
	var $server_uri;
	public function module($module=NULL){ $msg=BAD_FORMAT(); $c_dir = 'modules'; $init_dir = $c_dir.'/'.$module.'/init.php';
		
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  $msg = "\n";
		  if($module!=NULL){
				$file = $init_dir;
					if(file_exists($file)){
				    	$file_handle = fopen($file, "r");
				    	echo "\n========== MODULE ".$module." ROUTES ==========\n";
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
		
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  $msg = "\n";
		  if($extender!=NULL){
				$file = $init_dir;
				if(file_exists($file)){
					echo "\n========== EXTENDER ".$extender." ROUTES ==========\n";
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

	public function extract_unit($string, $start, $end)
		{
		$pos = stripos($string, $start);
		$str = substr($string, $pos);
		$str_two = substr($str, strlen($start));
		$second_pos = stripos($str_two, $end);
		$str_three = substr($str_two, 0, $second_pos);
		$unit = trim($str_three); // remove whitespaces
		return $unit;
		}
}