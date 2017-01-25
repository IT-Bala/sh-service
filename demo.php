<?php
define("BASE_URL","http://localhost/practice/small-http/");
define("SH_KEY","API");
define("SH_VALUE","SH");
require_once 'Curl.php';
$fields = array('name'=>'balasundar');
echo Curl::post('http://localhost/practice/small-http/a/a',json_encode($fields),true);


$fields = array('name'=>'kutung design');
echo Curl::post('http://localhost/practice/small-http/a/b',json_encode($fields),true);
?>