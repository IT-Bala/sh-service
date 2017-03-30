<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
setlocale(LC_ALL, 'en_US.UTF8');
#==============================================#
define("SHA",false); # Small Http::SH Authentication [Don't remove it]
#==============================================#
require 'autoload.php';
require 'Http.php';

$app = new Http();

$app->get('/',function($app){
    $app->json('Welcome to SH service');    
});

# CMS Routes
#$app->droutes('PAGE/',true); # check routes from database

$app->page('/home',function($app){
    $app->html('home');
});

$app->run(['sh','admin']); # Extender

