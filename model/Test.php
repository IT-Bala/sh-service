<?php
class Test{
	public function index(){
		$data = array('prabha'=>"php developer");
		echo Http::json($data);
	}
	public function delete(){
		if(Http::body())
		echo Http::body()->username;
	}
}