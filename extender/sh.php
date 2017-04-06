<?php
if(!defined("SHA")) die("Access denied!");

Http::get('/sha',function($app){
	$q = Http::db()->query("select * from tbl_users");
	echo $app->json($q->result());
});

Http::routes('GET /sh',['a'=>'User::insert']);


