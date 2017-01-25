<?php
class User{ 
	public function insert(){
		echo "Welcome";
	}	
	public function update(){
		echo 'Update';
	}
	public function delete(){
		Http::model('Test')->delete();
	}
}