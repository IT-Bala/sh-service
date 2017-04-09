<?php
require_once 'cli-terminal.php';
$colors = new Colors();
// Test some basic printing with Colors class
echo clean_color($colors->getColoredString("[ Command Options ]", "yellow", "") . "\n\n");

# Create Command
echo clean_color($colors->getColoredString("[ Options ]", "brown", "") . "\n\n");
echo clean_color($colors->getColoredString("-v , -version			", "green", "") . "	Display the version\n");
echo clean_color($colors->getColoredString("-h , -help			", "green", "") . "	Command Help\n\n");

# Create Command
echo clean_color($colors->getColoredString("[ Create Command ]", "brown", "") . "\n");

echo clean_color($colors->getColoredString("create controller:controllername", "green", "") . "	Create controller\n");
echo clean_color($colors->getColoredString("create model:modelname		", "green", "") . "	Create model\n");
echo clean_color($colors->getColoredString("create library:libraryname	", "green", "") . "	Create library\n");
echo clean_color($colors->getColoredString("create package:packagename	", "green", "") . "	Create package\n");
echo clean_color($colors->getColoredString("create extender:extendername	", "green", "") . "	Create extender\n\n");

# Remove Command
echo clean_color($colors->getColoredString("[ Remove Command ]", "brown", "") . "\n");

echo clean_color($colors->getColoredString("remove controller:controllername", "green", "") . "	Remove controller\n");
echo clean_color($colors->getColoredString("remove model:modelname		", "green", "") . "	Remove model\n");
echo clean_color($colors->getColoredString("remove library:libraryname	", "green", "") . "	Remove library\n");
echo clean_color($colors->getColoredString("remove package:packagename	", "green", "") . "	Remove package\n");
echo clean_color($colors->getColoredString("remove extender:extendername	", "green", "") . "	Remove extender\n");
echo clean_color($colors->getColoredString("remove module:modulename	", "green", "") . "	Remove module\n\n");

# Import Command
echo clean_color($colors->getColoredString("[ Import Command ]", "brown", "") . "\n");

echo clean_color($colors->getColoredString("import package:packagename	", "green", "") . "	Import package\n");
echo clean_color($colors->getColoredString("import module:modulename	", "green", "") . "	Import module\n");
echo "\n";
