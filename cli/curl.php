<?php
class curl{       
     public function get($url,$json=false){
     		$url = str_replace("@",":", $url);
     		$url = 'http://'.$url;           
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            /*curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                'Content-Type: application/json',                                                                                
                SH_KEY.': '.SH_VALUE)                                                                       
            );*/
            $server_output = curl_exec($ch);
            curl_close ($ch);
            echo $server_output."\n";
     }
}