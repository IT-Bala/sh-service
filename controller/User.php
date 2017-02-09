<?php
class User{ 
	public function insert(){
		Http::library('Demo')->a();
	}	
	public function update(){
		echo 'Update';
	}
	public function delete(){
		Http::model('Test')->delete();
	}
}