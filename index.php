<?php
error_reporting(E_ALL);
ini_set("display_errors", -1);
setlocale(LC_ALL, 'en_US.UTF8');
#==============================================#
define("SHA",false); # Small Http : SH Authentication [ Don't remove it ]
#==============================================#

require 'vendor/autoload.php';

require 'Http.php'; 

$app = new Http();

$app->get('/',function($app){
    #$app->json('Welcome to SH service');
    $q = $app->db->get('users');
    #$q = db()->get('users');
    $app->json($q->result());

});
/*$app->get('/lybrate',function($app){

	for($i=1;$i<10;$i++){
		$j = '{"firstName":"a'.$i.'","mobile":"76950'.$i.'1196","email":"a'.$i.'@yahoo.com","countryCode":"IN","source":"PS-PPV","gender":"male"}';
    	echo Curl::post("https://www.lybrate.com/p/login-signup",$j,true);
    	echo '<br><br>';
	}

});*/

$app->get('/rest/(int):id/(any):demo',function($app){
    #$app->json('Welcome to SH service');
    $q = $app->db->get('users');
    #$q = db()->get('users');
    $app->json($q->result());

});

# (int):id , (string):id , (any):id ,

/*$app->get('/test/(int):id/(string):dell/(any):sheik/(int):me',function($app,$req){
	echo ($req->id);
});*/

# date: 2017-04-01 , 
$app->get('/demo/(date):hello',function($app,$req){
	echo $req->hello;
});



$app->page('/users',function($app,$req){
	$data['app'] = $app;
	$data['req'] = $req;
	$app->html("all-users",$data);

});
$app->get('/users/:id',function($app,$req){
	$data['app'] = $app;
	$data['req'] = $req;
	$app->html("all-users",$data);

});

$app->post('/users/:id',function($app,$req){
	$id = (int)$req->id; if($id==0) $app->json("Invalid argument");
	#$req->session->delete('user_total'); die;
	if($req->session->get('user_total') == ""){ 
		$q  = $app->db->query("SELECT count(id) as total FROM  csv_table");
		$result= $q->result_object();
		$req->session->set('user_total',$result[0]->total); 
	}
    $totalRecords = $req->session->get('user_total');
 
	$paginator = $app->library('Paginator');
	$paginator->itemsPerPage = 30;
	$paginator->total = ($totalRecords/$paginator->itemsPerPage);
	$paginator->_link = 'http://localhost:83/users/';
	
	$currentPage = $req->id-1;
	$limiter     =  $currentPage*$paginator->itemsPerPage;

	//get record from database and show	
	$records = $app->db->query("Select id,email from csv_table LIMIT ".$limiter.", ".$paginator->itemsPerPage);
	foreach($records->result_object() as $obj){
			echo $obj->id.'=>'.$obj->email."<br>";
	}
	//print
	$paginator->paginate($req->id);
	echo 'Records '.$req->id*$paginator->itemsPerPage.' of '.$totalRecords;

});


/*
$app->get('/user/:id',function($app,$req){
	$id = (isset($req->id) && $req->id!='')?$req->id:'1';
    $q = $app->db->get_where('users',['user_id'=>$id]);
    echo json_encode($q->result());
});
*/

# $obj = Curl::get('https://localhost/sh-service/'); 	  # object
# echo   Curl::get('https://localhost/sh-service/',true); # raw
# CMS Routes
#$app->droutes('PAGE/',true); # check routes from database

$app->run(); # Extender
?>
