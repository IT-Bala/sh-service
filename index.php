<?php
#==============================================#
define("SHA",false); # Small Http::SH Authentication [Don't remove it]
#==============================================#

require_once 'Http.php';

$app = new Http();

$app->get('/',function($app){  $app->json('Welcome to SH service');  });

$app->run(); # Extender