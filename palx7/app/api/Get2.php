<?php 
 

 
//$v = base64_decode($_GET["v"]); 
 
$v = str_replace('@', '&', $_GET['v']); 
 
 
 
 
 
$options =  array( 
'header'=> array( 
'referer'=>PAL, 
    ), 
 
); 
 
 
$left = ''; 
$right = ''; 
$getEps = $this->get_contents($left, $right, $v, $options); 
 
$getEps = str_replace('&', '@', $getEps); 
$getEps = str_replace('?', '*', $getEps); 
 
 
 
$crop = explode('/', $v); 
 
$cropx = 'https://'.$crop[2].'/'.$crop[3].'/'.$crop[4].'/'.$crop[5].'/'.$crop[6].'/'; 
 
 
 
 if(!empty($crop[10]) and strpos($v, 'lang') !== FALSE){
     
     
    
$cropx = 'https://'.$crop[2].'/'.$crop[3].'/'.$crop[4].'/'.$crop[5].'/'.$crop[6].'/'.$crop[7].'/'.$crop[8].'/'.$crop[9].'/'.$crop[10].'/'; 

//echo $cropx.'<br>';

//$this->print_pre($crop);
     
     
 }
 
 
 
 if(empty($crop[10]) and strpos($v, 'lang') !== FALSE){


$crop[10] = "";
  
  $cropx = 'https://'.$crop[2].'/'.$crop[3].'/'.$crop[4].'/'.$crop[5].'/'.$crop[6].'/'.$crop[7].'/'.$crop[8].'/'; 
         
     }
 
 
 

 

if(strpos($getEps, 'index-v1-a2.m3u8') !== FALSE){ 
$replace = str_replace('index-v1-a2.m3u8', DOMAIN.'/palx/Get3/?v='.$cropx.'index-v1-a2.m3u8', $getEps); 
}else{ 
$replace = str_replace('index-v1-a1.m3u8', DOMAIN.'/palx/Get3/?v='.$cropx.'index-v1-a1.m3u8', $getEps); 
} 
 
$replace2 = str_replace('index-a1.m3u8', DOMAIN.'/palx/Get3/?v='.$cropx.'index-a1.m3u8', $replace); 


$replace3 = str_replace('index-a2.m3u8', DOMAIN.'/palx/Get3/?v='.$cropx.'index-a2.m3u8', $replace2); 
 
 
 
 //IF CONTAINS F1-V1 !!!! WARNING!
 if(strpos($getEps, 'index-f1-v1') !== FALSE){
     
     if(strpos($getEps, 'index-f1-v1-a2.m3u8') !== FALSE){ 

$replace = str_replace('index-f1-v1-a2.m3u8', DOMAIN.'/palx/Get3/?v='.$cropx.'index-f1-v1-a2.m3u8', $getEps); 

}else{
     
     $replace = str_replace('index-f1-v1-a1.m3u8', DOMAIN.'/palx/Get3/?v='.$cropx.'index-f1-v1-a1.m3u8', $getEps); 
}
     
 
$replace2 = str_replace('index-f2.m3u8', DOMAIN.'/palx/Get3/?v='.$cropx.'index-f2.m3u8', $replace); 


$replace3 = str_replace('index-f3.m3u8', DOMAIN.'/palx/Get3/?v='.$cropx.'index-f3.m3u8', $replace2); 

$replace3 = str_replace('index-f1-a1.m3u8', DOMAIN.'/palx/Get3/?v='.$cropx.'index-f1-a1.m3u8', $replace3); 

$replace3 = str_replace('index-f1-a2.m3u8', DOMAIN.'/palx/Get3/?v='.$cropx.'index-f1-a2.m3u8', $replace3); 
     
 }
 
 
 
 
echo $replace3; 
//$this->print_pre($crop); 
 
 
 
 
 
 
 
//$this->print_pre($amp); 
 
header('Access-Control-Allow-Origin: *'); 
header ("Access-Control-Expose-Headers: Content-Length, X-JSON"); 
header ("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS"); 
 
header ("Access-Control-Allow-Headers: Content-Type, Authorization, Accept, Accept-Language, X-Authorization"); 
 
 
 
 
//header("access-control-allow-origin:*"); 
//header("Content-Disposition: attachment"); 
//header("Content-Type: application/x-mpegurl"); 
header("content-type: text/plain"); 
//echo $Replace;
