<?php
class Curl{
	public static function post($url,$post_fields=array(),$json=false){   # true means direct json format print || false means object oriented format
            $KEY = SH_KEY; $VALUE = SH_VALUE;
            if(defined("API_KEY") && defined("API_TOKEN")){
                $KEY = API_KEY; $VALUE = API_TOKEN;
            }
			$ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$post_fields);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                'Content-Type: application/json',                                                                                
                $KEY.': '.$VALUE)                                                                      
            );
            $server_output = curl_exec ($ch);
            curl_close ($ch);
            if($json==true){
                return $server_output;
            }else{
                return json_decode($server_output);
            }
     } 
	 public static function file_encode($name=NULL){ 
            $KEY = SH_KEY; $VALUE = SH_VALUE;
            if(defined("API_KEY") && defined("API_TOKEN")){
                $KEY = API_KEY; $VALUE = API_TOKEN;
            }
         $base64='';
		 if(isset($_FILES[$name]['name']) && $_FILES[$name]['name']!=''){
			$filename = $_FILES[$name]['name'];
			$tmp = $_FILES[$name]['tmp_name'];
			$type = pathinfo($filename, PATHINFO_EXTENSION);
			$data = file_get_contents($tmp);
			$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
		 } return $base64;
	 }
	 public static function form_data($url,$post_fields=array(),$json=false){   # true means direct json format print || false means object oriented format
			$KEY = SH_KEY; $VALUE = SH_VALUE;
            if(defined("API_KEY") && defined("API_TOKEN")){
                $KEY = API_KEY; $VALUE = API_TOKEN;
            }
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$post_fields);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                'Content-Type: application/json',                                                                                
                $KEY.': '.$VALUE)                                                                      
            );
            $server_output = curl_exec ($ch);
            curl_close ($ch);
            if($json==true){
                return $server_output;
            }else{
                return json_decode($server_output);
            }
     }     
       
     public static function get($url,$json=false){
            $KEY = SH_KEY; $VALUE = SH_VALUE;
            if(defined("API_KEY") && defined("API_TOKEN")){
                $KEY = API_KEY; $VALUE = API_TOKEN;
            }
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                'Content-Type: application/json',                                                                                
                $KEY.': '.$VALUE)                                                                     
            );
            $server_output = curl_exec($ch);
            curl_close ($ch);
             if($json==true){
                return $server_output;
            }else{
                return json_decode($server_output);
            }
     }
	 public static function put($url,$post_fields,$json=false){ 
            $KEY = SH_KEY; $VALUE = SH_VALUE;
            if(defined("API_KEY") && defined("API_TOKEN")){
                $KEY = API_KEY; $VALUE = API_TOKEN;
            }           
            $ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
			curl_setopt($ch, CURLOPT_POSTFIELDS,$post_fields);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                'Content-Type: application/json',                                                                                
                $KEY.': '.$VALUE)                                                                       
            );
			$server_output  = curl_exec($ch);
			curl_close($ch);      
             if($json==true){
                return $server_output;
            }else{
                return json_decode($server_output);
            }
       }
	 public static function delete($url,$post_fields,$json=false){
            $KEY = SH_KEY; $VALUE = SH_VALUE;
            if(defined("API_KEY") && defined("API_TOKEN")){
                $KEY = API_KEY; $VALUE = API_TOKEN;
            }         
            $ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
			curl_setopt($ch, CURLOPT_POSTFIELDS,$post_fields);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                'Content-Type: application/json',                                                                                
                $KEY.': '.$VALUE)                                                                       
            );
			$server_output  = curl_exec($ch);
			curl_close($ch);          
             if($json==true){
                return $server_output;
            }else{
                return json_decode($server_output);
            }
       }
}
