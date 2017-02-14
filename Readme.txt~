#SH-Web Service is small & fastest php framework developed by phpbala@2016

# index.php file #

Refer config.php file for SH auth
#==============================================#
define("SHA",false); # Small Http::SH Authentication [Don't remove it]
#==============================================#

require_once 'Http.php';

$app = new Http();

$app->get('/',function($app){ echo $app->json(["Welcome to SH server"]); });

# index.php file #

i. Call html view file:
	Http::html('test'); # View file 
	$app->html('header')->html('test'); # html/test.php file include
	$app->view('test');

i. Call model file:
	Http::model('test')->func(); # running
	$app->model('test'); # html/test.php file include

i. Call Controller file:
	$app->routes('POST /parent_url',['sub_url'=>'Class::Method']);
	$app->routes('POST /user',['update'=>'User::update','delete'=>'User::delete']);

1. Image Resizing:
	https://github.com/eventviva/php-image-resize
	
	$file = $app->body();
	$app->library('ImageResize',false);
	$image = ImageResize::createFromString($app->file_decode($file->photo));	
	$image->scale(50); # $image->resize(800, 600); # $image->crop(200, 200);
	$image->save('uploads/image_string.jpg');	
					{OR}
	$app->library('ImageResize',false);
	$image = new ImageResize('uploads/image.jpg');	
	$image->scale(50); # $image->resize(800, 600); # $image->crop(200, 200);
	$image->save('uploads/image.jpg');

2. File Save Concept:
	
	$file = $app->body();
	$file_path = 'uploads/'.time().'-filename'; # Without extension because file map .MP3,.MP4 etc.
	$app->file_save($file_path,$file->photo);
	
3. DATABASE :
	
    Inside of the routes or get,post methods we can call like this : 
	
	$app->db->query(""); OR $app->db()->query("");

4. DB Calling on controller, Model or library file :

	Http::db()->query(""); 	OR  db()->query("");
	
	(OR)

	(new Http)->db->query("");

5. Extender Routes depends ON Module wise:

	The index file end line is $app->run();
	
	$app->run('test'); OR $app->run(['user','member']);

6. Creating get, post, routes urls inside of the extender

	self::get('/demo',function(){ }); OR Http::get('/demo',function(){ });
   

