<?php
namespace package;
class Validation{ protected $value;
	public function __construct($value = null){
		$this->value = $value;
	}
	public function numeric(){ $result = true;
		if(!is_numeric($this->value)){
			$result = false;
		}
		return $result;
	}
	public function length(){
		
	} 
}
#$usernameValidator = v::alnum()->noWhitespace()->length(1, 10);
#$ageValidator = v::numeric()->positive()->between(1, 20);
