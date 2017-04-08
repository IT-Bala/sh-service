<?php
class Request{
	public function __construct($args=array()){
		foreach($args as $var=>$value){
			$this->$var = $value;
		}
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
