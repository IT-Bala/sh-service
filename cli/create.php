<?php
# CLI command create 
class create{
	public function controller($fileName){ $msg=BAD_FORMAT(); $c_dir = 'controller'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		$message = "<?php\n#Create your public methods here to access on route.\nclass ".ucfirst($fileName)."{\n\n}\n?>";
		if (file_exists($file)){
		  	$msg = "\033[0;31m".ucfirst($fileName)." ".$c_dir." already exist.\033[0m \n";
		} else {
		  if(is_dir($c_dir) && is_writable($c_dir)){
		  	$fh = fopen($file, 'w');
		    fwrite($fh, $message."\n");
		    $msg = "\033[0;32m".ucfirst($c_dir).' '.ucfirst($fileName).' has been created'."\033[0m \nGo to ".$file." create your methods and access easily.\n";
		    fclose($fh);
		  }else{
		  	$msg = "\033[0;31mPermission denied. coult't create ".$c_dir."  \033[0m \n";
		  }
		}
		return $msg;
	}
	public function model($fileName){ $msg=BAD_FORMAT(); $c_dir = 'model'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		$message = "<?php\n#Create your public methods here to access.\nclass ".ucfirst($fileName)."{\n\n}\n?>";
		if (file_exists($file)){
		  	$msg = "\033[0;31m".ucfirst($fileName)." ".$c_dir." already exist.\033[0m \n";
		} else {
		  if(is_dir($c_dir) && is_writable($c_dir)){
		  	$fh = fopen($file, 'w');
		    fwrite($fh, $message."\n");
		    $msg = "\033[0;32m".ucfirst($c_dir).' '.ucfirst($fileName).' has been created'."\033[0m \nGo to ".$file." create your methods and access easily.\n";
		    fclose($fh);
		  }else{
		  	$msg = "\033[0;31mPermission denied. coult't create ".$c_dir."  \033[0m \n";
		  }
		}
		return $msg;
	}
	public function library($fileName){ $msg=BAD_FORMAT(); $c_dir = 'library'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		$message = "<?php\n#Create your public methods here to access.\nclass ".ucfirst($fileName)."{\n\n}\n?>";
		if (file_exists($file)){
		  	$msg = "\033[0;31m".ucfirst($fileName)." ".$c_dir." already exist.\033[0m \n";
		} else {
		  if(is_dir($c_dir) && is_writable($c_dir)){
		  	$fh = fopen($file, 'w');
		    fwrite($fh, $message."\n");
		    $msg = "\033[0;32m".ucfirst($c_dir).' '.ucfirst($fileName).' has been created'."\033[0m \nGo to ".$file." create your methods and access easily.\n";
		    fclose($fh);
		  }else{
		  	$msg = "\033[0;31mPermission denied. coult't create ".$c_dir."  \033[0m \n";
		  }
		}
		return $msg;
	}
	public function extender($fileName){ $msg=BAD_FORMAT(); $c_dir = 'extender'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		$message = "<?php\nif(!defined('SHA')) die('Access denied!');\n\n/*Http::get('/test',function(){\n echo 'Test page is running...';\n});*/\n?>";
		if (file_exists($file)){
		  	$msg = "\033[0;31m".ucfirst($fileName)." ".$c_dir." already exist.\033[0m \n";
		} else {
		  if(is_dir($c_dir) && is_writable($c_dir)){
		  	$fh = fopen($file, 'w');
		    fwrite($fh, $message."\n");
		    $msg = "\033[0;32m".ucfirst($c_dir).' '.ucfirst($fileName).' has been created'."\033[0m \nGo to ".$file." create your routes and access easily.\n";
		    fclose($fh);
		  }else{
		  	$msg = "\033[0;31mPermission denied. coult't create ".$c_dir."  \033[0m \n";
		  }
		}
		return $msg;
	}
	public function package($fileName){ $msg=BAD_FORMAT(); $c_dir = 'package'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		$message = "<?php\nnamespace package;\nclass ".ucfirst($fileName)."{\n\n}\n?>";
		if (file_exists($file)){
		  	$msg = "\033[0;31m".ucfirst($fileName)." ".$c_dir." already exist.\033[0m \n";
		} else {
		  if(is_dir($c_dir) && is_writable($c_dir)){
		  	$fh = fopen($file, 'w');
		    fwrite($fh, $message."\n");
		    $msg = "\033[0;32m".ucfirst($c_dir).' '.ucfirst($fileName).' has been created'."\033[0m \nGo to ".$file." create your methods and access easily.\n";
		    fclose($fh);
		  }else{
		  	$msg = "\033[0;31mPermission denied. coult't create ".$c_dir."  \033[0m \n";
		  }
		}
		return $msg;
	}
	# Create CRUD API
	public function api($fileName){ $msg=BAD_FORMAT(); $c_dir = 'extender'; $file = $c_dir.'/'.strtolower($fileName.'.php');
		$table = $fileName; $id    = $table.'_id'; $dollar = '$';
		$message = "<?php\nif(!defined('SHA')) die('Access denied!');\n
Http::get('/api/".$table."/init',function(".$dollar."app){
	".$dollar."app->db->query(\"CREATE TABLE IF NOT EXISTS `".$table."`(
		 `".$id."` bigint(20) NOT NULL AUTO_INCREMENT,
		 `title` varchar(100) DEFAULT NULL,
		 `message` varchar(400) DEFAULT NULL,
		 `status` tinyint(4) DEFAULT NULL COMMENT '{0=>inactive,1=>active}',
		 `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		 PRIMARY KEY (`".$id."`),
		 KEY `title` (`title`),
		 KEY `message` (`message`)
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1\");
	
	".$dollar."rmsg = '".ucfirst($table)." CRUD has been inited successfuly.';
	".$dollar."app->json(".$dollar."rmsg);
});
# API ".$table." create
Http::post('/api/".$table."/create',function(".$dollar."app,".$dollar."req){ ".$dollar."rmsg = 'Please fill out required fields.';
	    
	 	".$dollar."body = ".$dollar."req->body();
	 	if(count(".$dollar."body) > 0){
		 	".$dollar."app->db->insert('".$table."',".$dollar."body);
		 	if(".$dollar."app->db->insert_id()!=''){
		 		".$dollar."rmsg = '".ucfirst($table)." has been created successfuly.';
		 	}
	 	}
		".$dollar."app->json(".$dollar."rmsg);
});
# API ".$table." update
Http::post('/api/".$table."/update/:id',function(".$dollar."app,".$dollar."req){ ".$dollar."rmsg = 'Please fill out required fields.';

	 	".$dollar."body = ".$dollar."req->body();
	 	if(count(".$dollar."body) > 0){
	 		".$dollar."app->db->where('".$id."',".$dollar."req->id);
		 	".$dollar."app->db->update('".$table."',".$dollar."body);
		 	".$dollar."rmsg = '".ucfirst($table)." has been updated successfuly.';
	 	}
		".$dollar."app->json(".$dollar."rmsg);
});

# API ".$table." delete
Http::post('/api/".$table."/delete/:id',function(".$dollar."app,".$dollar."req){ ".$dollar."rmsg = 'Please fill out required fields.';

	 	".$dollar."body = ".$dollar."req->body();
	 	if(count(".$dollar."body) > 0){
	 		".$dollar."app->db->where('".$id."',".$dollar."req->id);
		 	".$dollar."app->db->delete('".$table."');
		 	".$dollar."rmsg = '".ucfirst($table)." has been deleted successfuly.';
	 	}
		".$dollar."app->json(".$dollar."rmsg);
});

# API ".$table." get all
Http::get('/api/".$table."/all',function(".$dollar."app){
	".$dollar."query = ".$dollar."app->db->get('".$table."');
	".$dollar."app->json(".$dollar."query->result());
});
# API ".$table." get single
Http::get('/api/".$table."/(int):id',function(".$dollar."app,".$dollar."req){
	".$dollar."query = ".$dollar."app->db->get_where('".$table."',array('".$id."'=>".$dollar."req->id));
	".$dollar."app->json(".$dollar."query->result());
});\n?>";

		if (file_exists($file)){
		  	$rmsg = "\033[0;31m".ucfirst($fileName)." ".$c_dir." already exist.\033[0m \n";
		} else{
		  if(is_dir($c_dir) && is_writable($c_dir)){
		  	$fh = fopen($file, 'w');
		    fwrite($fh, $message."\n");
		    $rmsg = "\033[0;32m".ucfirst($c_dir).' '.ucfirst($fileName).' has been created'."\033[0m \nGo to ".$file." create your methods and access easily.\n";
		    fclose($fh);
		  }else{
		  	$rmsg = "\033[0;31mPermission denied. coult't create ".$c_dir."  \033[0m \n";
		  }
		}
		return $rmsg;
	} # Reset trending all
}
