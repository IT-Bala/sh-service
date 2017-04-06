<?php
if(!defined('SHA')) die("Access Denied");
class Session{
	# Sessions
	public function __construct(){
		if(!isset($_SESSION)){session_start();}
	}
	public function get($variable=NULL){
		$_= $_SESSION;
		if(trim($variable)!=""){
			$_ = (isset($_SESSION[$variable]))?$_SESSION[$variable]:'';
		} return $_;
	}
	public function set($variable=NULL,$value=NULL){
		if(trim($variable)!=""){
			$_SESSION[$variable] = $value;
		}
	}
	public function destroy($variable=NULL){
		session_destroy();
	}
	public function delete($variable=NULL){
		if(trim($variable)!=""){
			session_unset($variable);
		}
	}
}