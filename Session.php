<?php
if(!defined('SHA')) die("Access Denied");
#session_destroy();
class Session{
	# Sessions
	public function __construct(){
		if(!isset($_SESSION)){session_start();}
	}
	public static function get($variable=NULL){
		$_= (isset($_SESSION))?$_SESSION:'';
		if(trim($variable)!=""){
			$_ = (isset($_SESSION[$variable]))?$_SESSION[$variable]:'';
		} return $_;
	}
	public static function set($variable=NULL,$value=NULL){
		if(trim($variable)!=""){
			$_SESSION[$variable] = $value;
		}
	}
	public static function put($variable=NULL,$value=NULL){
		if(trim($variable)!=""){
			$_SESSION[$variable] = $value;
		}
	}
	public static function delete($variable=NULL){
		if(trim($variable)!=""){
			session_unset($variable);
		}
	}
	public static function remove($variable=NULL){
		if(trim($variable)!=""){
			session_unset($variable);
		}
	}
	public static function destroy($variable=NULL){
		session_destroy();
	}
}
