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
	public function label(){ $args = func_get_args();
		# language must be a session dynamic variable
		$en = ($this->session->get("lang")!="")?$this->session->get("lang"):"en";
		if(is_dir(LANG_PATH.$en)){
			foreach ( glob(LANG_PATH.$en."/*.php") as $file){
			        if($file != "") require_once $file;
			}
			if(isset($lang)){
				if(count($args) == 1){
					return (isset($lang[$args[0]])) ? $lang[$args[0]] : '';
				}else if(count($args) >= 2){
					$key = $args[0];
					array_shift($args);
					return  (isset($lang[$key])) ? vsprintf($lang[$key],$args) : '';
				}
			}
			
		}

	}
}
