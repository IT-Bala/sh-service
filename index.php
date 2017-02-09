<?php
#==============================================#
define("SHA",false); # Small Http::SH Authentication [Don't remove it]
#==============================================#

require_once 'Http.php';

$app = new Http();
$app->get('/',function($app){ echo $app->json(["Welcome to SH server"]); });

$app->get('/cmd',function($app){ echo $app->json(["Welcome to SH CMD 123..."]); });

$app->post("/upload",function($app){
	$file = $app->body();
	$app->file_save("uploads/".time(),$file->photo);
	#$app->library('ImageResize',false);	
	#$image = ImageResize::createFromString($app->file_decode($file->photo));
	#$image->scale(50);
	#$image->save('uploads/image_string.jpg');	
	echo $app->json(["Success"]);
});
$app->run(['sh']); # Extender