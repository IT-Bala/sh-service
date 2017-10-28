<?php
if(isset($_GET['cmd']) && $_GET['cmd']!=''){
	 $cmd = $_GET['cmd'];
	 $explode = explode("/",$cmd);
	 if(count($explode) > 0){
		if($explode[0] == 'rm' || $explode[0] == 'remove'){
			$cmd = $cmd." y";
		}
	}
	$cmd = str_replace("/"," ",$cmd);
	echo shell_exec("php sh ".$cmd);
	die;
}
echo "yes";
?>
