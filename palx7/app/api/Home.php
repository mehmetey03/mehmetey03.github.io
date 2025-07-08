<?php


?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="color-scheme" content="light dark" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HOME</title>
  <script type="module" src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.esm.js"></script>
  <script nomodule src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ionic/core/css/ionic.bundle.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <script type="module" src="https://cdn.jsdelivr.net/npm/ionicons/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://cdn.jsdelivr.net/npm/ionicons/dist/ionicons/ionicons.js"></script>

</head>
  
  
  <style>
  
  
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
  



    :root {
--ion-text-color:  #fff;
--ion-font-family: "Poppins";
--ion-background-color: #000000;
user-select:none;
    }
    
    .search-item {
       
    }

.inputs {
    position: relative;
        top: 2vh;
        width: 100%;
    --border-radius: 90px!important;
    --background: #222428;
}

#open-modal {
    position: relative;
        top: 40vh;
        z-index:1;
        --border-radius: 90px!important;
}


#palx {
    position: relative;
        top: 1vh;
        z-index:1;
}


.shadow {
    background: rgb(111,220,30);
background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 100%);
position: absolute;
height: 15%;
width: 100%;
z-index:1;
bottom:0;
}

.bg  {
    position: absolute;
    z-index: -2;
    top: 0vh;
    height: 100%;
    width: 120%;
    opacity: 0.2;
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
    --color: ;
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
    border-left: 9px solid #222428;
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
    top:0%;
}


</style>

<body>
           <ion-app>
        <ion-content fullscreen>
            <div class="shadow"></div>
            <ion-button id="palx" expand="full" color="none">A R E N A</ion-button>
          <!--  <form method="GET" action="./Search/">

           <ion-input enterkeyhint="search" showCancelButton="focus"  class="inputs ion-text-center" required="true" name="q" type="search" placeholder="Ara..." color="light"></ion-input>-->

            </form>
            <br>
            



        <ion-item href="<?php $this->base_url;?>Movies/?v=<?php echo base64_encode(PAL.'/filmler'); ?>&all=true" class="modal-item">
            <ion-avatar slot="start">
            <i class="fa-solid fa-film"></i>
            </ion-avatar>
            <ion-label>
              <h2>Filmler</h2>
            </ion-label>
          </ion-item>
          <ion-item href="<?php $this->base_url;?>Series/?v=<?php echo base64_encode(PAL.'/diziler'); ?>"  class="modal-item">
            <ion-avatar slot="start">
            <i class="fa-solid fa-display"></i>
            </ion-avatar>
            <ion-label>
              <h2>Diziler</h2>
            </ion-label>
          </ion-item>
          <ion-item href="<?php echo DOMAIN;?>/palx/Series/?v=<?php echo base64_encode(PAL.'/diziler?kelime=&durum=&tur=26&type=&siralama='); ?>&tur=26" class="modal-item">
            <ion-avatar slot="start">
            <i class="fa-solid fa-book-skull"></i>
            </ion-avatar>
            <ion-label>
              <h2>Animeler</h2>
            </ion-label>
          </ion-item>
          <ion-item href="<?php $this->base_url;?>Series/?v=<?php echo base64_encode(PAL.'/koleksiyon/blutv'); ?>&type=4" class="modal-item">
            <ion-avatar slot="start">
              <ion-img src="https://play-lh.googleusercontent.com/UZD0bVn--ylKD7iGvl1tzyBy3OkBSiOY4GyZN8s0-CEonx_x0dlewaMLcvu8Xr9vy50" />
            </ion-avatar>
            <ion-label>
              <h2>Blutv</h2>
            </ion-label>
          </ion-item>
          <ion-item href="<?php $this->base_url;?>Series/?v=<?php echo base64_encode(PAL.'/koleksiyon/exxen'); ?>&type=3" class="modal-item">
            <ion-avatar slot="start">
              <ion-img src="https://play-lh.googleusercontent.com/vwyYQtvtAEj0MkdZLq5bhBIdXiXh-oYYU4MT9LxH5hVpf7Q8JI0cJlACq3FjxlmGn-Q" />
            </ion-avatar>
            <ion-label>
              <h2>Exxen</h2>
            </ion-label>
          </ion-item>
          <ion-item href="<?php $this->base_url;?>Series/?v=<?php echo base64_encode(PAL.'/koleksiyon/netflix'); ?>&type=2" class="modal-item">
            <ion-avatar slot="start">
              <ion-img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/75/Netflix_icon.svg/1200px-Netflix_icon.svg.png" />
            </ion-avatar>
            <ion-label>
              <h2>Netflix</h2>
            </ion-label>
          </ion-item>
          <ion-item href="<?php $this->base_url;?>Series/?v=<?php echo base64_encode(PAL.'/koleksiyon/disney'); ?>&type=6" class="modal-item">
            <ion-avatar slot="start">
              <ion-img src="https://s3.imgbu.com/file/imgbucom-s/2022/10/12/disneyd4e16b2e4e53ad59.jpg" />
            </ion-avatar>
            <ion-label>
              <h2>Disney +</h2>
            </ion-label>
          </ion-item>
          <ion-item href="<?php $this->base_url;?>Series/?v=<?php echo base64_encode(PAL.'/koleksiyon/amazon-prime'); ?>&type=7" class="modal-item">
            <ion-avatar slot="start">
              <ion-img src="https://play-lh.googleusercontent.com/O2FfBTgdkim23RfZE98VQByYNbBrqY8bs2VWhy_Gu7KE9DvzvSyoWbfcgYZ-WuLHN3Y" />
            </ion-avatar>
            <ion-label>
              <h2>Amazon Prime</h2>
            </ion-label>
          </ion-item>
          <ion-item href="<?php $this->base_url;?>Series/?v=<?php echo base64_encode(PAL.'/koleksiyon/bein-connect'); ?>&type=8" class="modal-item">
            <ion-avatar slot="start">
              <ion-img src="https://play-lh.googleusercontent.com/ojJC2ML7PlN29TPWreEtJOqmKBktv43ZBo9y399K17TvdujxgoI20jxTFE9xla-_lto" />
            </ion-avatar>
            <ion-label>
              <h2>beIN Connect</h2>
            </ion-label>
          </ion-item>
          <ion-item href="<?php $this->base_url;?>Series/?v=<?php echo base64_encode(PAL.'/koleksiyon/gain'); ?>&type=5" class="modal-item">
            <ion-avatar slot="start">
              <ion-img src="https://play-lh.googleusercontent.com/IlsA4VOl449AvSlqVFIMm2dz8vgNjRGz6TrT9aL-SyPZTaQ4elHW5JmerKMgB_vhdRE" />
            </ion-avatar>
            <ion-label>
              <h2>Gain</h2>
            </ion-label>
          </ion-item>
           <ion-item href="https://www.trdiziizle.co/tr501/"  class="modal-item">
            <ion-avatar slot="start">
            <i class="fa-solid fa-display"></i>
            </ion-avatar>
            <ion-label>
              <h2>Yerli Diziler & Programlar</h2>
            </ion-label>
          </ion-item>
        </ion-list>
      </ion-content>
    </ion-modal>
            
    <script>

  var modal = document.querySelector('ion-modal');

  function dismiss() {
    modal.dismiss();
  }
</script>
            
            
            
        </ion-content>
        
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
   var triggered = false;    
$(window).on("unload",function(event) {
    if (triggered === true) {
        return; //this is run automatically after the timeout
    }

    event.preventDefault();
    $('.abso').css('display','block');

    triggered = true; // set flag
    setTimeout(function(){$(this).trigger('unload');},1000); //set animation length as timeout
 });
    </script>
        
        
        <div class="abso">
            <img src="https://arenaseries.xyz/palx/loader.svg">
</div>
        
        
    </ion-app>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    
</body>
</html>

<?php
/*
$sayfa_verisi = ob_get_contents(); //sayfanın sonuç çıktısını al



ob_end_flush();


$dosya = fopen($dosya_yolu, 'w+'); //cache dosyasını aç
fwrite($dosya, $sayfa_verisi); //dosyaya yaz
fclose($dosya); //dosyayı kapat
*/
?>


