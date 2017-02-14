<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
#==============================================#
define("SHA",false); # Small Http::SH Authentication [Don't remove it]
#==============================================#

require 'Http.php';

$app = new Http();

$app->get('/',function($app){  $app->json('Welcome to SH service');  });

$app->run('sh'); # Extender