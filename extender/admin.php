<?php
if(!defined("SHA")) die("Access denied!");

Http::page('/admin',function($app){
	if(isset($_POST['save'])){
		# Manual Routes
		if(count($this->route_url['GET']) > 0){ $routes = array();
			foreach($this->route_url['GET'] as $route){
				$routes[] = substr($route, 1);
			}
		}		
		if($_POST['title'] != '' && $_POST['content']!=''){
			$checkTypes = array('page'=>"tbl_pages",'blog'=>"tbl_blogs",'service'=>"tbl_service");
			
			if(!$app->db->has("tbl_routes",["route"=>$app->clean_url($_POST['title'])]) && !in_array(clean_url($_POST['title']),$routes)){       
			    $id = $app->db->insert("tbl_routes", [
						"type" => $_POST['type'],
						"route" => $app->clean_url($_POST['title']),
						"when_created" => date('Y-m-d H:i:s')
					]);
				$app->db->insert($checkTypes[$_POST['type']], [
								"route_id" => $id,
								"title" => $_POST['title'],
								"content" => $_POST['content'],
								"when_created" => date('Y-m-d H:i:s')
							]);
				echo "Submitted successfuly!";
		  }else{
				echo "Already exist route!";
		  }	
		}else{
				echo "Fill out required fields.";
		}
    }
	$data["types"] = array("page","blog","service");
    $app->html('admin',$data);    
});

