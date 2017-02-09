<?php
class Demo{ 
	public function a(){
		$q= db()->query("select * from tbl_users");
		echo Http::json($q->fetchAll()); # ["Welcome to A"]
	}	
	public function b(){
		echo "Welcome to B";
	}
}