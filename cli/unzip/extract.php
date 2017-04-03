<html>
<head><title>unzip | electrofriends.com</title>
</head>
<body>
<?php	
require_once('unzip/pclzip.lib.php'); 
$zipfile = new PclZip('friends.zip');
if ($zipfile -> extract() == 0) {
	echo 'Error : ' . $zipfile -> errorInfo(true);
}else{
	echo 'File Extracted!';
} 
?>
</body>
</html>