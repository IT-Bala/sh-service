<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
setlocale(LC_ALL, 'en_US.UTF8');
#==============================================#
define("SHA",false); # Small Http::SH Authentication [Don't remove it]
#==============================================#
require 'Http.php';

$app = new Http();

$app->get('/',function($app){
    $app->json('Welcome to SH service');    
});
# Dynamic Routes
$app->get('/name/:firstname',function($app,$req,$res){
	$res->json(' Firstname : '.$req->firstname);
});
# Without Authendication Links like about, service pages
$app->page('/home',function($app){
    $app->html('home');
});
# To Access Package
/* use \package\Test;
$app->get('/testing',function($app){
    $obj = new Test();
});*/

$app->get('/third_party_api',function($app){ # To Access 3rd party API
		#ACCESS THIRD PARTY API#
		#define("API_KEY", "API");   # If no need remove it
		#define("API_TOKEN", "SHA"); # If no need remove it 
		#ACCESS THIRD PARTY API#
		# $obj = Curl::get('https://localhost/sh-service/'); 	  # object
		# echo   Curl::get('https://localhost/sh-service/',true); # raw
});
# CMS Routes
#$app->droutes('PAGE/',true); # check routes from database

$app->run(['sh','admin']); # Extender

