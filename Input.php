<?php
if(!defined("SHA")) die("Access denied!");
class Input{ 
	public function post($var=NULL){
		return ($var!=NULL)?$_POST[$var]:$_POST;
	}
	public function get($var=NULL){
		return ($var!=NULL)?$_GET[$var]:$_GET;
	}
	public function request($var=NULL){
		return ($var!=NULL)?$_REQUEST[$var]:$_REQUEST;
	}
}