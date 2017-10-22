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
echo clean_color($colors->getColoredString("[ Create Command ] create | mk", "brown", "") . "\n");

echo clean_color($colors->getColoredString("create controller:controllername", "green", "") . "	Create controller\n");
echo clean_color($colors->getColoredString("create model:modelname		", "green", "") . "	Create model\n");
echo clean_color($colors->getColoredString("create library:libraryname	", "green", "") . "	Create library\n");
echo clean_color($colors->getColoredString("create package:packagename	", "green", "") . "	Create package\n");
echo clean_color($colors->getColoredString("create extender:extendername	", "green", "") . "	Create extender\n\n");

# Remove Command
echo clean_color($colors->getColoredString("[ Remove Command ] remove | rm", "brown", "") . "\n");

echo clean_color($colors->getColoredString("remove controller:controllername", "green", "") . "	Remove controller\n");
echo clean_color($colors->getColoredString("remove model:modelname		", "green", "") . "	Remove model\n");
echo clean_color($colors->getColoredString("remove library:libraryname	", "green", "") . "	Remove library\n");
echo clean_color($colors->getColoredString("remove package:packagename	", "green", "") . "	Remove package\n");
echo clean_color($colors->getColoredString("remove extender:extendername	", "green", "") . "	Remove extender\n");
echo clean_color($colors->getColoredString("remove module:modulename	", "green", "") . "	Remove module\n\n");

# Show | List Command
echo clean_color($colors->getColoredString("[ List Command ] show | list | ls", "brown", "") . "\n");

echo clean_color($colors->getColoredString("ls controllers			", "green", "") . "	List controller\n");
echo clean_color($colors->getColoredString("ls models 			", "green", "") . "	List model\n");
echo clean_color($colors->getColoredString("ls libraries 			", "green", "") . "	List library\n");
echo clean_color($colors->getColoredString("ls packages 			", "green", "") . "	List package\n");
echo clean_color($colors->getColoredString("ls extenders 			", "green", "") . "	List extender\n");
echo clean_color($colors->getColoredString("ls modules 			", "green", "") . "	List module\n\n");

# Explain Command
echo clean_color($colors->getColoredString("[ Explain Command ] explain | exp", "brown", "") . "\n");

echo clean_color($colors->getColoredString("explain routes:all		", "green", "") . "	Show all routes\n");
echo clean_color($colors->getColoredString("explain routes:get		", "green", "") . "	Show GET routes\n");
echo clean_color($colors->getColoredString("explain routes:post		", "green", "") . "	Show POST routes\n");
echo clean_color($colors->getColoredString("explain routes:put		", "green", "") . "	Show PUT routes\n");
echo clean_color($colors->getColoredString("explain routes:delete		", "green", "") . "	Show DELETE routes\n");
echo clean_color($colors->getColoredString("explain routes:page		", "green", "") . "	Show PAGE routes\n");
echo clean_color($colors->getColoredString("explain extender:extendername	", "green", "") . "	Explain extender routes\n");
echo clean_color($colors->getColoredString("explain module:modulename	", "green", "") . "	Explain module routes\n\n");

# Import Command
echo clean_color($colors->getColoredString("[ Import Command ] import | imp", "brown", "") . "\n");

echo clean_color($colors->getColoredString("import package:packagename	", "green", "") . "	Import package\n");
echo clean_color($colors->getColoredString("import module:modulename	", "green", "") . "	Import module\n\n");

# Curl Command
echo clean_color($colors->getColoredString("[ Curl Command ] curl", "brown", "") . "\n");

echo clean_color($colors->getColoredString("curl get:fullurl		", "green", "") . "	Get url results\n\n");

# Server PORT Command
echo clean_color($colors->getColoredString("[ Server Command ] curl", "brown", "") . "\n");

echo clean_color($colors->getColoredString("server port:8080		", "green", "") . "	Create new server\n");

echo "\n";
