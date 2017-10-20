<?php
if(!defined('SHA')) die("Access Denied");
class Request{
	public function __construct($args=array()){
		foreach($args as $var=>$value){
			$this->$var = $value;
		}
		$this->session = new Session;
	}
	# Methods
	public static function request($variable=NULL){
		$_= $_REQUEST;
		if(trim($variable)!="" && isset($_REQUEST[$variable])){
			$_ = $_REQUEST[$variable];
		}elseif($_SERVER['REQUEST_METHOD'] == 'REQUEST'){
			$_= $_REQUEST;
		}  return $_;
	}
	public static function get($variable=NULL){
		$_= $_GET;
		if(trim($variable)!="" && isset($_GET[$variable])){
			$_ = $_GET[$variable];
		}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
			$_= $_GET;
		} return $_;
	}
	public static function post($variable=NULL){
		$_= '';
		if(trim($variable)!="" && isset($_POST[$variable])){
			$_ = $_POST[$variable];
		}elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
			$_= $_POST;
		} return $_;
	}
	public static function args($variable=NULL){
		$_= '';
		$input = file_get_contents('php://input');
		if(trim($variable)!="" && isset($input) && $input!=''){
			$requestParams = json_decode($input, true);
			$_ = $requestParams[$variable];
		}elseif(trim($variable)==""){
			$_= $requestParams = json_decode($input, true);
		} return $_;
	}
}
