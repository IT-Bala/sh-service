i. Call html view file:
	Http::html('test'); # View file 
	$app->html('test'); # html/test.php file include

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
	
3. 

	