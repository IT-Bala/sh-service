<?php
if(!defined("SHA")) die("Access denied!");

use package\kdpl;

Http::get('/sha',function($app){ 
	$q= Http::db()->query("select * from tbl_users")->fetchAll();
	echo $app->json($q);	
});

Http::get('/kdpl',function($app){ 
		echo (new kdpl())->bala();
});

Http::routes('GET /sh',['a'=>'User::insert']);

