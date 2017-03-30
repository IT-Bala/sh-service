<?php
if(isset($argv[1]) && $argv[1]!=''){
	if($argv[1] == 'create'){ require_once 'create.php';
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
	}elseif($argv[1] == 'remove'){ require_once 'remove.php';

		if(isset($argv[2]) && $argv[2]!=''){
			$whatAt = explode(":", $argv[2]);
			if(count($whatAt) == 2){
				$type = strtolower($whatAt[0]);
				$typeName = strtolower($whatAt[1]);
				switch ($type) {
					case 'controller':
						echo clean_color(remove::controller($typeName));
					break;
					case 'model':
						echo clean_color(remove::model($typeName));
					break;
					case 'library':
						echo clean_color(remove::library($typeName));
					break;
					case 'extender':
						echo clean_color(remove::extender($typeName));
					break;
					case 'package':
						echo clean_color(remove::package($typeName));
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

	}elseif($argv[1] == 'import'){ require_once 'import.php';
		$import = new import();
		if(isset($argv[2]) && $argv[2]!=''){
			$whatAt = explode(":", $argv[2]);
			if(count($whatAt) == 2){
				$type = strtolower($whatAt[0]);
				$typeName = strtolower($whatAt[1]);
				switch ($type) {
					case 'package':
						echo clean_color($import->package($typeName));
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

	}elseif($argv[1] == '-v'){
			echo clean_color("\033[0;32msh-service framework v1.0.0 \033[0m (\033[0;37mDeveloped @ Soava Lab\033[0m) \n");
	}elseif($argv[1] == '-h'){
		require_once 'commands.php';
	}elseif($argv[1] == 'status'){
		echo clean_color("\033[0;32msh-service is running...\033[0m \n");
	}else{
		echo BAD_FORMAT();
	}
}else{
		require_once 'commands.php';
}
function BAD_FORMAT(){
	return "\033[0;31msh-service bad format command.\033[0m \n";
}
function clean_color($str){
	 $codes = array("\033[0;32m", "\033[0m", "\033[0;31m","\033[0m");
	 $rcodes = array("","","","");
	 if(strtoupper(substr(PHP_OS, 0, 3)) != 'LIN'){
	 	$str = str_replace($codes,$rcodes, $str);
	 } return $str;
}
