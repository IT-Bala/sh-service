<?php
if(!defined("SHA")) die("Access denied!");

Http::page('/admin',function($app){
	if(DB_STATUS == false) die(Http::json(["Database Connection failed"]));
	
	if(isset($_POST['save'])){
		$routes = explode(',',$_POST['routes']);
		if($_POST['title'] != '' && $_POST['content']!=''){
			$checkTypes = array('page'=>"tbl_pages",'blog'=>"tbl_blogs",'service'=>"tbl_service");
			$q = $app->db->get_where("tbl_routes",["route"=>$app->clean_url($_POST['title'])]);

			if($q->num_rows()==0 && !in_array($app->clean_url($_POST['title']),$routes)){       
			   $app->db->insert("tbl_routes", [
						"type" => $_POST['type'],
						"route" => $app->clean_url($_POST['title']),
						"when_created" => date('Y-m-d H:i:s')
					]);
			    $id = $app->db->insert_id();
				$app->db->insert($checkTypes[$_POST['type']], [
								"route_id" => $id,
								"title" => $_POST['title'],
								"content" => $_POST['content'],
								"when_created" => date('Y-m-d H:i:s')
							]);
				echo "Submitted successfuly!";
		  }else{
				echo $app->clean_url($_POST['title'])." route already exist!";
		  }	
		}else{
				echo "Fill out required fields.";
		}
    }
	# Manual Routes
	#print_r($this->route_url['GET']);
	$routes = array();
	if(isset($this->route_url['GET']) && count($this->route_url['GET']) > 0){
		foreach($this->route_url['GET'] as $route){
			$routes[] = substr($route['url'], 1);
		}
	}
	$data["types"] = array("page","blog","service");
	$data["urls"]  = implode(',',$routes);
    $app->html('admin',$data);    
});

