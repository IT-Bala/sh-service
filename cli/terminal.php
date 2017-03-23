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
						echo create::controller($typeName);
					break;
					case 'model':
						echo create::model($typeName);
					break;
					case 'library':
						echo create::library($typeName);
					break;
					case 'extender':
						echo create::extender($typeName);
					break;
					case 'package':
						echo create::package($typeName);
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
						echo remove::controller($typeName);
					break;
					case 'model':
						echo remove::model($typeName);
					break;
					case 'library':
						echo remove::library($typeName);
					break;
					case 'extender':
						echo remove::extender($typeName);
					break;
					case 'package':
						echo remove::package($typeName);
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
			echo "\033[0;32msh-service framework v1.0.0 \033[0m (\033[0;37mDeveloped @ Soava Lab\033[0m) \n";
	}elseif($argv[1] == '-h'){
		require_once 'commands.php';
	}elseif($argv[1] == 'status'){
		echo "\033[0;32msh-service is running...\033[0m \n";
	}else{
		echo BAD_FORMAT();
	}
}else{
		require_once 'commands.php';
}
function BAD_FORMAT(){
	return "\033[0;31msh-service bad format command.\033[0m \n";
}
