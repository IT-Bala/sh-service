<?php
require_once 'cli-terminal.php';
$colors = new Colors();
// Test some basic printing with Colors class
echo clean_color($colors->getColoredString("[ Command Options ]", "yellow", "") . "\n\n");

echo clean_color($colors->getColoredString("controller:controllername", "green", "") . "	Create a controller\n");
echo clean_color($colors->getColoredString("model:modelname		", "green", "") . "	Create a model\n");
echo clean_color($colors->getColoredString("library:libraryname	", "green", "") . "	Create a library\n");
echo clean_color($colors->getColoredString("package:packagename	", "green", "") . "	Create a package\n");
echo clean_color($colors->getColoredString("extender:extendername	", "green", "") . "	Create a extender\n");
echo "\n";
function clean_color($str){
	 $codes = array("\033[0;32m", "\033[0m", "\033[0;31m","\033[0m");
	 $rcodes = array("","","","");
	 if(strtoupper(substr(PHP_OS, 0, 3)) != 'LIN'){
	 	$str = str_replace($codes,$rcodes, $str);
	 } return $str;
}
