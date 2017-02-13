<?php 
define("BASE_URL","http://192.168.1.57/practice/small-http/");
define("SH_KEY","API");
define("SH_VALUE","SH");

require_once 'Curl.php';


$url 		 = BASE_URL.'user/insert';
$post_fields = array();
#$rest = new Curl();
#echo Curl::get($url,true);

if(isset($_POST['submit'])){
	$url 		 = BASE_URL.'upload';
	if(isset($_FILES['photo']['name']) && $_FILES['photo']['name']!=''){
	
	$result 	  = array(
						"username"=>$_POST['username'],
						"photo"=>Curl::file_encode('photo')
					);
	echo Curl::post($url,json_encode($result),true);
	}
}
?>
<form method="post" enctype="multipart/form-data">
<input type="file" name="photo" />
<input type="text" name="username" />
<input type="submit" name="submit" />
</form>