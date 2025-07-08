<?php
error_reporting(0); 



if(isset($_GET)){
    if(isset($_GET['q'])){
        $q = $_GET['q'];
    }else{
        $q = '';
    }
}



$cache_klasor = './Cache/';

$dosya_isim = "ara-".$q;


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


$url = PAL.'/api/search-autocomplete';
$options = array(
    'header'=>array(
        'accept'=>'application/json, text/javascript, */*; q=0.01',
    'origin'=>PAL,
    'content-type'=>'application/x-www-form-urlencoded; charset=UTF-8',
    //'accept-encoding'=>'gzip, deflate, br',
    'accept-language'=>'tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7',
'referer'=>PAL.'/',
    ),
'post'=>array(
    'query'=>$q,

),
);
    $left = '';
    $right = '';
    $getjson = json_decode($this->get_contents($left, $right, $url, $options), true);







?>


<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="color-scheme" content="light dark" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List</title>
  <script type="module" src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.esm.js"></script>
  <script nomodule src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ionic/core/css/ionic.bundle.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  


  
  <style>
  
  
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
  
  @import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');

  @import url('https://fonts.googleapis.com/css2?family=Antonio:wght@700&display=swap');

  @import url('https://fonts.googleapis.com/css2?family=Dosis&display=swap');


    :root {
--ion-text-color:  #fff;
--ion-font-family: "Poppins";
--ion-background-color: #121212;
    }
    
    ion-app {
        width: 100%!important;
        height: 100%!important;
        margin: 0;
    }
    
    ion-content {
        width: 100%;
        height: 100%;
    }
    
    

    
    h5 {
        color:#ccc!important;
        font-size: 9px!important;
    }
    
    
    h3 {
        color: dodgerblue!important;
        font-size: 11px!important;
    }
    
    h4 {
        font-size:11px!important;
    }
    
    h2 {
        font-size: 13px!important;
    }
    
    hr {
        background: #08ffc5!important;
        max-width: 47vh;
        height: 4px;
        filter: blur(3px);
    }
    
    
   
    
    
    ion-label{
        padding: 4px 4px;
    }
    
div.texts{
    position: absolute;
    z-index: 999;
    bottom:0;
    float: left;
    color: #fff;
    padding: 3px;
    max-width 23vh;
}
    
    
.avatar {
    --border-radius:4px;
    display: flex;
    width: 23vh;
    height: 33vh;
}


.x {
    --border-radius:0px;
    display: block;
}


.ion-item {
    float: left;
    margin-left: -3vh;
    position:relative;
    left: 3vh;
    margin-bottom: 2vh;
    display: block;
}

.pagination {
    position: -webkit-sticky;
    position: sticky;
    bottom:0;
    width: 100%!important;
    background: #222222;

    z-index: 9999;
    display:flex;
}

.navbtn {
    background: white;
    padding: 8px 8px;
    border-radius: 4px;
    display: flex;
    width: auto;
    height: 6vh;
    font-size: 18px;
    margin-left: 1vh;
    color: #000;
}

a {
    color:#fff;
    text-decoration: none;
}

.shadow {
    background: rgb(0,0,0);
background: linear-gradient(0deg, rgba(0,0,0,1) 0%, rgba(255,0,230,0) 100%);
z-index: 998;
position: absolute;
bottom: 0;
width: 23vh;
height: 32vh;
border-radius: 4px;
}

ion-header{
    font-size: 16px;
}




    
    
    .arw {
        color: #194e80;
        margin-bottom: -4px;
        font-size: 29px;
        animation: cl 3s ease 0s infinite;
    }
    
.hw {

    height: 5vh;

    width: 15vh;
}

ion-input {
        width: 20vh;
    }
    
    
        .logx {

        height: 9vh;

        width: 15vh;
    }



 .more{
        font-family: 'Anton';
        width:100%!important;
    }

    .morex{
        font-family: 'Anton';
        width:100%!important;
    }


    .abso {
  display:none;
  width: 100%;
    height: 100%;
  position:fixed;
  z-index: 9999999999;
  text-align:center;
  background: rgb(0,0,0);
background: linear-gradient(90deg, rgba(0,0,0,0.53125) 0%, rgba(0,0,0,0.53125) 100%);
}

.abso img {
    position: relative;
    top:39%;
}




ion-toolbar ion-title{
    font-family: 'antonio';
    font-size:24px;
}

.btn-tb {
    font-family: 'antonio';
    font-size:29px;
    text-transform:uppercase;
}

.btn-tbx {
    font-size:20px!important;
    text-transform:uppercase;
}

ion-toolbar {
    --background: #070808!important;
    display:flex;
}

ion-modal {
    --height: 50%;
    --border-radius: 16px;
    --box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
  }

  ion-modal::part(backdrop) {
    background: rgba(209, 213, 219);
    opacity: 1;
  }

  ion-modal ion-toolbar {
    --background: linear-gradient(287deg, rgba(34,34,34,1) 0%, rgba(14,116,144,1) 100%);
    --color: white;
  }

  .fa-solid {
    font-size: 29px;
    position: relative;
    left: 4px;
    color: #e8e8e8;
  }

  .modal-tool {
    position:fixed;
  }

  .modal-item{
   transition: .2s ease all;
  }

  .modal-item:hover {
    border-left: 9px solid #fff;
  }

  .cate-txt {
    font-family: 'Poppins';
  }



  </style>
</head>
<body>

    
    
  <ion-app> 
<ion-toolbar>
  <ion-buttons slot="start">
    <ion-button href="<?php echo DOMAIN.'/palx/'; ?>" shape="outline" class="btn-tb" color="light">
      <ion-icon slot="start" name="options-outline"></ion-icon>ANA SAYFA
    </ion-button>
    <ion-button shape="clear" class="btn-tbx" color="light">
    ARAMA <ion-text color="primary">/</ion-text> <?php echo $q;?>
    </ion-button>
  </ion-buttons>


</ion-toolbar>

           <!-- <form method="GET" action="../Search/">
           <ion-item color="dark">
                         
               
           <ion-input required="true" name="Search" type="search" placeholder="Ara..." color="light"></ion-input>
           
           </ion-item>
            </form>-->

<br>
<ion-content fullscreen>
        


            
           

          
            <div id="cont" class="series">
           
                   <?php


$detect = '';
$dtext = '';
foreach($getjson as $key => $val){

    if(strpos($key, 'series') !== FALSE){
        $detect = 'Serie';
        $dtext = 'DİZİ';
    }else{
        $detect = 'MWatch';
        $dtext = 'FİLM';
    }


?>

<ion-item class="ion-item">
    <a href="<?=DOMAIN.'/palx/'.$detect.'/'.base64_encode(PAL.$getjson[$key]['url']);?>">
     <div class="list">
         <div class="shadow"></div>
          <ion-avatar class="avatar" slot="start">
            <img src="<?=$getjson[$key]['poster']?>">
          </ion-avatar>
          <ion-label>
              <div class="ion-text-wrap texts">
            <h2><?=$getjson[$key]['title']?></h2>
            <h3><?=$dtext?></h3>
            </div>
          </ion-label>
            </div>
            </a>
        </ion-item>
        
<?php



 

}




?>
          

</div>

            
<br><br><br>




 






  </ion-app>
  
  
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


  
</body>
</html>

        
<?php

if(empty($getjson)){



    

    
    echo "/*";
}else{


$sayfa_verisi = ob_get_contents(); //sayfanın sonuç çıktısını al

ob_end_flush();


$dosya = fopen($dosya_yolu, 'w+'); //cache dosyasını aç
fwrite($dosya, $sayfa_verisi); //dosyaya yaz
fclose($dosya); //dosyayı kapat
}


?>