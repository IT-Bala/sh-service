<?php
#==============================================#
define("SHA",false); # Small Http::SH Authentication [Don't remove it]
#==============================================#

require_once 'Http.php';

$app = new Http();

$app->routes('GET /a',function($app){
	$data = array('prabha'=>"php developer");
	echo $app->json($data);
});

$app->get('/Web/service','User::index');

/*$app->post('/user/insert',function($app){
	
	$id = $app->db->insert('tbl_users', [
		'username' => 'foo',
		'email' => 'foo@bar.com',
		'address' => 'adyar',
	]);
	print_r($id);
	
});*/

/*$app->post('/upload',function($app){ $data = array();	
	$response = $app->body();
	if($response->username && $response->photo != NULL){
		$file_path = "uploads/".time();
		$app->create_file($file_path,$response->photo);
		$data = array("message"=>"success");	
	}	
	echo $app->json($data);
});*/

$app->routes('GET /Web',[
	"index"=>function($app){
				$data = array('bala'=>"php developer");
				echo $app->json($data);
	},
	"service"=>'User::test'
	]);

#$app->get('/web',Web::service());

$app->get('/prabha',function($app){
	$data = array('prabha'=>"php developer");
	echo $app->json($data);
});

$app->get('/users',function($app){
	$data = $app->db->select('tbl_users','*');
	
	echo $app->json($data);
});

$app->run();

