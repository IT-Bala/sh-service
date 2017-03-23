<?php
require_once 'cli-terminal.php';
$colors = new Colors();
// Test some basic printing with Colors class
echo $colors->getColoredString("[ Command Options ]", "yellow", "") . "\n\n";

echo $colors->getColoredString("controller:controllername", "green", "") . "	Create a controller\n";
echo $colors->getColoredString("model:modelname		", "green", "") . "	Create a model\n";
echo $colors->getColoredString("library:libraryname	", "green", "") . "	Create a library\n";
echo $colors->getColoredString("package:packagename	", "green", "") . "	Create a package\n";
echo $colors->getColoredString("extender:extendername	", "green", "") . "	Create a extender\n";
echo "\n";
