<?php
class User{
	public function get(){
		$q = Http::db()->get('users');
	    var_dump($q->result());
	}
	public function insert(){
		#$app->library('Demo')->a();
		Http::library('Demo')->a();
	}	
	public function update(){ 
		#echo 'Update';
		$m = Http::model('Test');
		$m->index();
	}
	public function delete(){
		Http::model('Test')->delete();
	}
}