<?php
#==============================================#
define("SHA",false); # Small Http::SH Authentication [Don't remove it]
#==============================================#

#$o = exec("netstat | grep http | wc -l");print_r($o);

require_once 'Http.php';

$app = new Http();


$app->get('/',function($app){ echo $app->json(["Welcome to SH server"]); });

$app->post("/upload",function($app){
	$file = $app->body();
	$app->file_save("uploads/".time(),$file->photo);
	#$app->library('ImageResize',false);	
	#$image = ImageResize::createFromString($app->file_decode($file->photo));	
	#$image->scale(50);
	#$image->save('uploads/image_string.jpg');	
	echo $app->json(["Success"]);
	
});

$app->run();