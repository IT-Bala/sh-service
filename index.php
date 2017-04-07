<?php
error_reporting(E_ALL);
ini_set("display_errors", -1);
setlocale(LC_ALL, 'en_US.UTF8');
#==============================================#
define("SHA",false); # Small Http::SH Authentication [ Don't remove it ]
#==============================================#
# Notes : if you create a project via composer
require 'vendor/autoload.php';
# Notes : if you download directly no need to include above file : vendor/autoload.php

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

$app->run(); # Extender
