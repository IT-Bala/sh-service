<?php
#############################################
	 # DO NOT REMOVE ANYTHONG HERE #
#############################################
#session_start();
define("SH_KEY","API");
define("SH_VALUE","SH");


/* CONTROLLER */
#=================================#
define("CONTROLLER_PATH","controller/");
define("MODEL_PATH","model/");
define("HTML_PATH","html/");
define("LIBRARY_PATH","library/");
define("EXT_PATH","extender/");
define("CMS_PATH","cms/");

#=================================#
define("APPPATH",""); 				 # __DIR__     
define("ENVIRONMENT","");			 # DEVELOPMENT
define("BASEPATH","");				 # APPPATH."/" 
#=================================#

/* DATABASE */
define("HOST","localhost");
define("USERNAME","root");
define("PASSWORD","root");
define("DATABASE","3p-php");
define("DATABASE_TYPE","mysqli");
define("DB_STATUS",true); #

# ADDITIONAL OPTIONS
define("DNS","");
define("DATABASE_PREFIX","");

#############################################
	 # DO NOT REMOVE ANYTHONG HERE #
#############################################
/*echo "<br>";
echo 'max_execution_time:'.ini_get('max_execution_time');
echo "<br>";
echo 'upload_max_filesize:'.ini_get('upload_max_filesize');
echo "<br>";
echo 'post_max_size:'.ini_get('post_max_size');
echo "<br>";
echo 'memory_limit:'.ini_get('memory_limit');
echo "<br>";
echo 'max_input_vars:'.ini_get('max_input_vars');
echo "<br>"; */
