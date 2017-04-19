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
		if(trim($variable)!=""){
			$_ = $_REQUEST[$variable];
		} return $_;
	}
	public static function get($variable=NULL){
		$_= $_GET;
		if(trim($variable)!=""){
			$_ = $_GET[$variable];
		} return $_;
	}
	public static function post($variable=NULL){
		$_= $_POST;
		if(trim($variable)!=""){
			$_ = $_POST[$variable];
		} return $_;
	}
}
