<?php


error_reporting(0);




$last = '';
$type = '';
$tur = '';

if(isset($_GET)){

if(isset($_GET['last_id'])){
    $last = $_GET['last_id'];
}
if(isset($_GET['typez'])){
    $type = $_GET['typez'];
}
if(isset($_GET['tur'])){
    $tur = $_GET['tur'];
}

}



$cache_klasor = './Cache/';



$dosya_isim = "ajx".$tur.$type.$last;


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



    $url = PAL.'/api/load-series';
$options = array(
    'header'=>array(
        'accept'=>'application/json, text/javascript, */*; q=0.01',
    'origin'=>'https://dizipal411.com',
    'content-type'=>'application/x-www-form-urlencoded; charset=UTF-8',
    //'accept-encoding'=>'gzip, deflate, br',
    'accept-language'=>'tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7',
'referer'=>'https://dizipal411.com/koleksiyon/blutv',
    ),
'post'=>array(
    'date'=>$last,
    'tur'=>$tur,
    'durum'=>'',
    'kelime'=>'',
    'type'=>$type,
    'siralama'=>'',
),
);
    $left = '';
    $right = '';
    $getjson = implode('', json_decode($this->get_contents($left, $right, $url, $options), true));

//$this->print_pre($getjson);





$left = '<!-- anasayfa dizi resimleri--><img src="';
$right = '"';
$getImage = $this->get_contents($left, $right, $getjson);

$left = '<span class="title">';
$right = '</span>';
$getTitle = $this->get_contents($left, $right, $getjson);

$left = '<div class="vote">';
$right = '</div>';
$getImdb = $this->get_contents($left, $right, $getjson);

$left = '<a target="_blank" href="';
$right = '"';
$getLinks = $this->get_contents($left, $right, $getjson);

$left = 'data-date="';
$right = '"';
$dataMov = $this->get_contents($left, $right, $getjson);

$arrx['image'] = $getImage;
$arrx['title'] = $getTitle;
$arrx['imdb'] = $getImdb;
$arrx['link'] = $getLinks;
$arrx['data'] = $dataMov;



if(empty($arrx['image'][0])){
    exit("<script>

        $('.more').remove();
       

    </script>");
}

for($i=0; count($arrx['image']) > $i; $i++) {
    
    

    
    ?>
   <ion-item class="ion-item">
    <a id="<?=$arrx['data'][$i]?>" href="<?=$this->base_url?>Serie/<?=base64_encode(PAL.$arrx['link'][$i]);?>">
     <div class="list">
         <div class="shadow"></div>
          <ion-avatar class="avatar" slot="start">
            <img src="<?=$arrx['image'][$i]?>">
          </ion-avatar>
          <ion-label>
              <div class="ion-text-wrap texts">
            <h2><?=$arrx['title'][$i]?></h2>
            <h3>IMDb:&nbsp;<?=$arrx['imdb'][$i]?></h3>
            </div>
          </ion-label>
            </div>
            </a>
        </ion-item>
        
        <?php
       
        
} 



echo "<script>var lastId = $('a:last').attr('id');</script>";

?>





<?php

if(empty($getTitle[0])){



    

    
    echo "/*";
}else{


$sayfa_verisi = ob_get_contents(); //sayfanın sonuç çıktısını al

ob_end_flush();


$dosya = fopen($dosya_yolu, 'w+'); //cache dosyasını aç
fwrite($dosya, $sayfa_verisi); //dosyaya yaz
fclose($dosya); //dosyayı kapat
}


?>