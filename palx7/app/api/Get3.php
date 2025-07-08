<?php


//$v = base64_decode($_GET["v"]);

$v = str_replace('@', '&', $_GET['v']);

$v = str_replace('*', '?', $v);
$v = str_replace('%', '?', $v);


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


$options =  array(
'header'=> array(
'referer'=>PAL,
    ),

);


$left = '';
$right = '';
$getEps = $this->get_contents($left, $right, $v, $options);


$left = 'URI="';
$right = '"';
$getUri = $this->get_contents($left, $right, $getEps);

//echo $getEps;


if(empty($getUri[0])){
    $getUri[0] = "";
}

$getx = str_replace('&', '@', $getUri[0]);



$getEps = str_replace($getUri[0], DOMAIN.'/palx/Get/?v='.$cropx.$getx, $getEps);

$getEps = str_replace('encryption.key?', 'encryption.key*', $getEps);







header('Access-Control-Allow-Origin: *'); 
header ("Access-Control-Expose-Headers: Content-Length, X-JSON"); 
header ("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS"); 
 
header ("Access-Control-Allow-Headers: Content-Type, Authorization, Accept, Accept-Language, X-Authorization"); 
header('Content-Type: text/plain');

echo $getEps;

//$this->print_pre($getUri);
