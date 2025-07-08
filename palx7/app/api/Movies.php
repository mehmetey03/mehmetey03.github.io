<?php




if(isset($_GET)){
    if(isset($_GET['v'])){
        $v = $_GET['v'];
    }else{
        $v = '';
    }
}


$cache_klasor = './Cache/';

$cch = str_replace('/', '', base64_decode($v));


$dosya_isim = "film-".$cch;


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


$link = base64_decode($v);

$left = '<div class="container" style="flex-direction: column; padding-right: 0 !important; align-items: flex-start">';
$right = '</div>';
$getsectit = $this->get_contents($left, $right, $link);


if(empty($getsectit[0])){
    $getsectit[0] = '';
}

if(isset($_GET)){


    

if(isset($_GET['tur'])){
    $tur = $_GET['tur'];
    $left = '<option selected';
$right = 'option>';
$getsectitstep = $this->get_contents($left, $right, $link);


$left = '">';
$right = '</';
$getsectit = $this->get_contents($left, $right, $getsectitstep[0]);
}else{
    $tur = '';
}

if(isset($_GET['type'])){
    $type = $_GET['type'];
}else{
    $type = '';
}

}
    


if(isset($_GET['all'])){

$left = '<article class="movie-type-genres type2 view-">';
$right = '</article>';
$getarticle = implode('', $this->get_contents($left, $right, $link));
}else{
    $left = '<article class="movie-type-genres type2">';
$right = '</article>';
$getarticle = implode('', $this->get_contents($left, $right, $link));
}
//$this->print_pre($getarticle);


$left = '<img src="';
$right = '"';
$getImage = $this->get_contents($left, $right, $getarticle);


$left = '<span class="title">';
$right = '</span>';
$getTitle = $this->get_contents($left, $right, $getarticle);

$left = '<div class="vote">';
$right = '</div>';
$getImdb = $this->get_contents($left, $right, $getarticle);

$left = '<a target="_blank" href="';
$right = '"';
$getLinks = $this->get_contents($left, $right, $getarticle);

$left = 'data-id="';
$right = '"';
$dataMov = $this->get_contents($left, $right, $getarticle);

$arrx['image'] = $getImage;
$arrx['title'] = $getTitle;
$arrx['imdb'] = $getImdb;
$arrx['link'] = $getLinks;
$arrx['data'] = $dataMov;





//$this->print_pre($getImage);

$co =  count($getImage)-1;


$rang = range(0,$co,3);

$images = array();
for($i=0; count($rang) > $i; $i++){

$images[$i] = $getImage[$rang[$i]];

}
//$this->print_pre($images);

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
    width: 17vh;
    height: 26vh;
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
    <ion-button id="open-modal" shape="outline" class="btn-tb" color="light">
      <ion-icon slot="start" name="options-outline"></ion-icon>KATEGORİLER
    </ion-button>
    <ion-button shape="clear" class="btn-tbx" color="light">
    FİLMLER <ion-text color="primary">/</ion-text> <?php echo $getsectit[0];?>
    </ion-button>
  </ion-buttons>


</ion-toolbar>

           <form method="GET" action="../Search/">
           <ion-item color="dark">
                         
               
           <ion-input required="true" name="q" type="search" placeholder="Ara..." color="light"></ion-input>
           
           </ion-item>
            </form>

<br>
<ion-content fullscreen>
        

<ion-modal trigger="open-modal">
      <ion-content>
        <ion-toolbar class="modal-tool">
          <ion-title class="cate-txt">KATEGORİLER</ion-title>
          <ion-buttons slot="end">
            <ion-button shape="outline" color="light" onclick="modal.dismiss()">Kapat</ion-button>
          </ion-buttons>
        </ion-toolbar>
        <ion-list>
            <br><br><br>
             <!---x-->
          <ion-item href="<?php echo DOMAIN;?>/palx/"  class="modal-item">
            <ion-avatar class="x" slot="start">
            <i class="fa-solid fa-home"></i>
            </ion-avatar>
            <ion-label>
              <h2>Ana Sayfa</h2>
            </ion-label>
          </ion-item>
        <!---x-->
          <ion-item href="<?php echo DOMAIN;?>/palx/Movies/?v=<?php echo base64_encode(PAL.'/tur/aile?'); ?>&tur=1"  class="modal-item">
            <ion-avatar class="x" slot="start">
            <i class="fa-solid fa-house-user"></i>
            </ion-avatar>
            <ion-label>
              <h2>Aile</h2>
            </ion-label>
          </ion-item>
          <!---x-->
          <ion-item href="<?php echo DOMAIN;?>/palx/Movies/?v=<?php echo base64_encode(PAL.'/tur/aksiyon?'); ?>&tur=2"  class="modal-item">
            <ion-avatar class="x" slot="start">
            <i class="fa-solid fa-gun"></i>
            </ion-avatar>
            <ion-label>
              <h2>Aksiyon</h2>
            </ion-label>
          </ion-item>
        <!---x-->
        <ion-item href="<?php echo DOMAIN;?>/palx/Movies/?v=<?php echo base64_encode(PAL.'/tur/animasyon?'); ?>&tur=3"  class="modal-item">
            <ion-avatar class="x" slot="start">
            <i class="fa-solid fa-fish"></i>
            </ion-avatar>
            <ion-label>
              <h2>Animasyon</h2>
            </ion-label>
          </ion-item>
        <!---x-->
        <ion-item href="<?php echo DOMAIN;?>/palx/Movies/?v=<?php echo base64_encode(PAL.'/tur/anime?'); ?>&tur=26"  class="modal-item">
            <ion-avatar class="x" slot="start">
            <i class="fa-solid fa-yen-sign"></i>
            </ion-avatar>
            <ion-label>
              <h2>Anime</h2>
            </ion-label>
          </ion-item>
        <!---x-->
        <ion-item href="<?php echo DOMAIN;?>/palx/Movies/?v=<?php echo base64_encode(PAL.'/tur/belgesel?'); ?>&tur=4"  class="modal-item">
            <ion-avatar class="x" slot="start">
            <i class="fa-solid fa-cow"></i>
            </ion-avatar>
            <ion-label>
              <h2>Belgesel</h2>
            </ion-label>
          </ion-item>
        <!---x-->
        <ion-item href="<?php echo DOMAIN;?>/palx/Movies/?v=<?php echo base64_encode(PAL.'/tur/bilimkurgu?'); ?>&tur=5"  class="modal-item">
            <ion-avatar class="x" slot="start">
            <i class="fa-solid fa-robot"></i>
            </ion-avatar>
            <ion-label>
              <h2>Bilim-Kurgu</h2>
            </ion-label>
          </ion-item>
        <!---x-->
        <ion-item href="<?php echo DOMAIN;?>/palx/Movies/?v=<?php echo base64_encode(PAL.'/tur/dram?'); ?>&tur=7"  class="modal-item">
            <ion-avatar class="x" slot="start">
            <i class="fa-solid fa-heart-crack"></i>
            </ion-avatar>
            <ion-label>
              <h2>Dram</h2>
            </ion-label>
          </ion-item>
        <!---x-->
        <ion-item href="<?php echo DOMAIN;?>/palx/Movies/?v=<?php echo base64_encode(PAL.'/tur/erotik?'); ?>&tur=25"  class="modal-item">
            <ion-avatar class="x" slot="start">
            <i class="fa-solid fa-venus-mars"></i>
            </ion-avatar>
            <ion-label>
              <h2>Erotik</h2>
            </ion-label>
          </ion-item>
        <!---x-->
        <ion-item href="<?php echo DOMAIN;?>/palx/Movies/?v=<?php echo base64_encode(PAL.'/tur/fantastik?'); ?>&tur=8"  class="modal-item">
            <ion-avatar class="x" slot="start">
            <i class="fa-solid fa-dragon"></i>
            </ion-avatar>
            <ion-label>
              <h2>Fantastik</h2>
            </ion-label>
          </ion-item>
        <!---x-->
        <ion-item href="<?php echo DOMAIN;?>/palx/Movies/?v=<?php echo (PAL.'/tur/gerilim?'); ?>&tur=9"  class="modal-item">
            <ion-avatar class="x" slot="start">
            <i class="fa-solid fa-face-flushed"></i>
            </ion-avatar>
            <ion-label>
              <h2>Gerilim</h2>
            </ion-label>
          </ion-item>
        <!---x-->
        <ion-item href="<?php echo DOMAIN;?>/palx/Movies/?v=<?php echo base64_encode(PAL.'/tur/gizem?'); ?>&tur=10"  class="modal-item">
            <ion-avatar class="x" slot="start">
            <i class="fa-solid fa-user-secret"></i>
            </ion-avatar>
            <ion-label>
              <h2>Gizem</h2>
            </ion-label>
          </ion-item>
        <!---x-->
        <ion-item href="<?php echo DOMAIN;?>/palx/Movies/?v=<?php echo base64_encode(PAL.'/tur/komedi?'); ?>&tur=11"  class="modal-item">
            <ion-avatar class="x" slot="start">
            <i class="fa-solid fa-face-laugh-squint"></i>
            </ion-avatar>
            <ion-label>
              <h2>Komedi</h2>
            </ion-label>
          </ion-item>
        <!---x-->
        <ion-item href="<?php echo DOMAIN;?>/palx/Movies/?v=<?php echo base64_encode(PAL.'/tur/korku?'); ?>&tur=12"  class="modal-item">
            <ion-avatar class="x" slot="start">
            <i class="fa-solid fa-face-tired"></i>
            </ion-avatar>
            <ion-label>
              <h2>Korku</h2>
            </ion-label>
          </ion-item>
        <!---x-->
        <ion-item href="<?php echo DOMAIN;?>/palx/Movies/?v=<?php echo base64_encode(PAL.'/tur/macera?'); ?>&tur=13"  class="modal-item">
            <ion-avatar class="x" slot="start">
            <i class="fa-solid fa-fire-flame-curved"></i>
            </ion-avatar>
            <ion-label>
              <h2>Macera</h2>
            </ion-label>
          </ion-item>
        <!---x-->
        <ion-item href="<?php echo DOMAIN;?>/palx/Movies/?v=<?php echo base64_encode(PAL.'/tur/yerli?'); ?>&tur=14"  class="modal-item">
            <ion-avatar class="x" slot="start">
            <i class="fa-solid fa-music"></i>
            </ion-avatar>
            <ion-label>
              <h2>Yerli</h2>
            </ion-label>
          </ion-item>
        <!---x-->
        <ion-item href="<?php echo DOMAIN;?>/palx/Movies/?v=<?php echo base64_encode(PAL.'/tur/romantik?'); ?>&tur=16"  class="modal-item">
            <ion-avatar class="x" slot="start">
            <i class="fa-solid fa-face-grin-hearts"></i>
            </ion-avatar>
            <ion-label>
              <h2>Romantik</h2>
            </ion-label>
          </ion-item>
        <!---x-->
        <ion-item href="<?php echo DOMAIN;?>/palx/Movies/?v=<?php echo base64_encode(PAL.'/tur/savas?'); ?>&tur=17"  class="modal-item">
            <ion-avatar class="x" slot="start">
            <i class="fa-solid fa-bomb"></i>
            </ion-avatar>
            <ion-label>
              <h2>Savaş</h2>
            </ion-label>
          </ion-item>
        <!---x-->
                <ion-item href="<?php echo DOMAIN;?>/palx/Movies/?v=<?php echo base64_encode(PAL.'/tur/yerli?'); ?>&tur=24"  class="modal-item">
            <ion-avatar class="x" slot="start">
            <i class="fa-solid fa-bomb"></i>
            </ion-avatar>
            <ion-label>
              <h2>Yerli</h2>
            </ion-label>
          </ion-item>
        </ion-list>
      </ion-content>
    </ion-modal>
            
           

          
            <div id="cont" class="Movies">
           
                   <?php



   $last = '';

  $new = array();
for($i=0; count($arrx['title']) > $i; $i++) {
    
    

 if(isset($arrx['image'][$i]) || isset($arrx['title'][$i]) || isset($arrx['imdb'][$i]) || isset($arrx['link'][$i])) {

    $new[$i]['title'] = $arrx['title'][$i];
    $new[$i]['image'] = $images[$i];
    $new[$i]['imdb'] = $arrx['imdb'][$i];
    $new[$i]['links'] = $arrx['link'][$i];
    
 $new[$i]['data'] = $arrx['data'][$i];
    
if($i === array_key_last($arrx['image'])){
    $last = $arrx['data'][$i];
    $x = $i;
}


 }
 

    


?>

<ion-item class="ion-item">
    <a id="<?=$new[$i]['data']?>" href="<?=DOMAIN.'/palx/MWatch/'.base64_encode(PAL.$new[$i]['links']);?>">
     <div class="list">
         <div class="shadow"></div>
          <ion-avatar class="avatar" slot="start">
            <img src="<?=$new[$i]['image']?>">
          </ion-avatar>
          <ion-label>
              <div class="ion-text-wrap texts">
            <h2><?=$new[$i]['title']?></h2>
            <h3>IMDb:&nbsp;<?=$new[$i]['imdb']?></h3>
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




 




<p class="ion-padding-start ion-padding-end"><ion-button color="light" class="more" onclick="scrols()" expand="block" fill="outline" disabled="false">DAHA FAZLA YÜKLE</ion-button><ion-button color="light" class="morex" expand="block" fill="outline" disabled="true">DAHA FAZLA YÜKLE</ion-button></p>

    </ion-content>
    <div class="abso">
            <img src="https://arenaseries.xyz/palx/loader.svg">
</div>

  </ion-app>
  
  
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>

  var modal = document.querySelector('ion-modal');

  function dismiss() {
    modal.dismiss();
  }
</script>

  <script>
 



  var content = document.querySelector('ion-content');
content.scrollEvents = true;





        var lastId = $('a:last').attr('id');

        var types = "<?php echo $type;?>";
        var tur = "<?php echo $tur;?>";
        
           
            function getContent() {
        return document.querySelector('ion-content');
      }

      

      function scrols(){
        load_more_data(btoa(lastId),types);
        $('.more').attr('disabled', true);
        $(".abso"). css("display", "block");
 setTimeout(function() {
       $('.more').attr('disabled', false);
       $(".abso").css("display", "none");
 }, 2000);


      }



 

    function load_more_data(lastId, types){
        $.ajax({
                type:'GET',
                url:'<?php echo DOMAIN;?>/palx/ajaxm/',
                dataType:'html',
                data:{last_id:lastId,tur:tur},
                beforeSend:function(){
                    $('.loader').show();
                },
                success:function(data){
                   
                    setTimeout(function() {
                    $('.loader').remove();
                    $('#cont').append(data);
                    
                   },0); 

                   
                   
                }
                
            });
            
    }






  </script>

  
</body>
</html>

        
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