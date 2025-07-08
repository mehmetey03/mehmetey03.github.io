<?php


$watchLink = base64_decode($this->post['Watch']);


$cache_klasor = './Cache/';


$cch = str_replace('/', '', $watchLink);


$dosya_isim = "plyr-".$cch;


$dosya_yolu = $cache_klasor.$dosya_isim. '.html';
$cache_suresi = 5 * 60 * 60; // cache süresi 1 saat

if (file_exists($dosya_yolu)){ // cache dosyası var ise
 // filemtime() = dosyanın son düzenlenme zamanını bulur
 if(time() - $cache_suresi < filemtime($dosya_yolu)){ //cache dosyasının süresi bitmediyse
  readfile($dosya_yolu); //dosyayı oku
  exit; //aşağıdaki satırları okuma
 }else{ // cache süresi doldu ise
  unlink($dosya_yolu); //dosyayı, cache sil
 }
}
ob_start();


$left = '<iframe src="';
$right = '"';
$getPlayer = $this->get_contents($left, $right, $watchLink);

$left = '';
$right = '';
$options = array(
'header'=>array(
    'referer'=>PAL,
    'origin'=>PAL,
)
);
$embed = $this->get_contents($left, $right, $getPlayer[0], $options);

$left = 'poster:"';
$right = '"';
$poster = $this->get_contents($left, $right, $embed);

$left = 'file:"';
$right = '"';
$file = $this->get_contents($left, $right, $embed);

$left = '"subtitle":"';
$right = '"';
$subs = $this->get_contents($left, $right, $embed);


$stream = str_replace('dizipal', 'stream.dizipal', PAL);

$file[0] = str_replace('&', '@', $file[0]);

if(!empty($subs)){
$subs[0] = str_replace('/srt/', $stream.'/srt/', $subs[0]);
}else{
    $subs[0]='';
}
//$this->print_pre($subs);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    



<html>


<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
	html { height:100%; } body {user-select: none; background-color: #000; } html, body { Margin: 0; Padding: 0; } h2 { background: linear-gradient(90deg, rgba(18,18,18,1) 0%, rgba(18,18,18,1) 50%, rgba(18,18,18,1) 100%); font-weight: 600; color: #ff0000; font-family: "Poppins", sans-serif; font-size: 20px; text-align: center; } p { font-family: "Poppins", sans-serif; color: #fff; font-size: 17px; text-align: center; }
</style>
</head>

<body>
	<iframe src="<?php echo $getPlayer[0]; ?>" data-src="<?php echo $getPlayer[0]; ?>" sandbox="allow-forms allow-pointer-lock allow-same-origin allow-scripts allow-top-navigation"frameborder="0" width="100%" height="100%" scrolling="no" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
	<h2> </h2> 
    <br>

 </font></center>












</body>

</html>


<?php

if(empty($getPlayer[0])){



    

    
    echo "/*";
}else{


$sayfa_verisi = ob_get_contents(); //sayfanın sonuç çıktısını al

ob_end_flush();


$dosya = fopen($dosya_yolu, 'w+'); //cache dosyasını aç
fwrite($dosya, $sayfa_verisi); //dosyaya yaz
fclose($dosya); //dosyayı kapat
}


?>