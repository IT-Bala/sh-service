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
}