<?php
if(!defined("SHA")) die("Access denied!");

Http::get('/sha',function($app){
	$q= Http::db()->query("select * from tbl_users")->fetchAll();
	echo $app->json($q);
});

Http::routes('GET /sh',['a'=>'User::insert']);

Http::page('/admin',function($app){
    if(isset($_POST['save'])){
        
        if(!$app->db->has("tbl_routes",["route"=>$app->clean_url($_POST['title'])])){       
            $id = $app->db->insert("tbl_routes", [
                    "type" => "page",
                    "route" => $app->clean_url($_POST['title']),
                    "when_created" => date('Y-m-d H:i:s')
                ]);
            #$id = $app->db->id();
              
            $app->db->insert("tbl_pages", [
                            "route_id" => $id,
                            "title" => $_POST['title'],
                            "content" => $_POST['content'],
                            "when_created" => date('Y-m-d H:i:s')
                        ]);
            echo "Submitted successfuly!";
      }else{
            echo "Already exist route!";
      }
                
    }
    $app->html('admin');    
});

