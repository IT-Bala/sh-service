<?php
class Response{
	private static function setHeader($status,$body=""){
		if($status!=""){
			header("HTTP/1.1 ".$status."");
			header("Content-Type: application/json");
			return json_encode(["status"=>$status,"body"=>$body]);
		}
	}
	public static function json($content,$object=false){
		// application/json
		if($object==true){
			return json_decode(self::setHeader("200",$content));
		}else{
			die(self::setHeader("200",$content));
		}
	}
	public static function send(){ $status = 200; $content_type = 'application/json';
		$args = func_get_args();
		if(count($args) >0){
				if(count($args) == 1){
					$body = $args[0];
				}elseif(count($args) == 2){
					$status = $args[0]; 
					$body = $args[1];
				}else{
					$status = $args[0]; 
					$body = $args[1];
					$content_type = $args[2];
				}
				header("HTTP/1.1 ".$status."");
				header("Content-Type: ".$content_type);
				$send = json_encode(["status"=>$status,"body"=>$body]);
				die($send);
		}
		
	}
}
