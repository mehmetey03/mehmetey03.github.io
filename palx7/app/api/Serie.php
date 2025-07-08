<?php 



    
    $serieLink = base64_decode($this->post['Serie']);
    
    


$left = '<h5>';
$right = '</h5>';
$getName = $this->get_contents($left, $right, $serieLink);




$cache_klasor = './Cache/';



$serie = str_replace('/', '', $serieLink);


$dosya_isim = "d-icerik".$serie;



$dosya_yolu = $cache_klasor.$dosya_isim. '.html';
$cache_suresi = 5 * 60 * 60; // cache süresi 30 saat

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





$left = '<div class="entry-meta">';
$right = '</div>';
$getMeta = implode('', $this->get_contents($left, $right, $serieLink));

$left = '<div class="value">';
$right = '</div>';
$genreStp = implode('', $this->get_contents($left, $right, $serieLink));

$left = '<a href="javascript:;">';
$right = '</a>';
$getGenre = $this->get_contents($left, $right, $genreStp);

$left = '<div class="key">IMDB Puanı</div>';
$right = 'div>';
$getImdbstp = $this->get_contents($left, $right, $serieLink);

$left = '<div class="value">';
$right = '</';
$getImdb = $this->get_contents($left, $right, $getImdbstp[0]);

$left = '<div class="description">';
$right = '</div>';
$getDescStp = implode('', $this->get_contents($left, $right, $serieLink));

$left = '<p>';
$right = '</p>';
$getDesc = $this->get_contents($left, $right, $serieLink);

$left = '<article class="post single">';
$right = '</article>';
$getArticle = implode('', $this->get_contents($left, $right, $serieLink));

$left = '<div class="cover" style="background-image: url(';
$right = ')';
$getThumb = $this->get_contents($left, $right, $serieLink);

$left = '<div class="cover" style="background-image: url(';
$right = ')';
$getBg = $this->get_contents($left, $right, $serieLink);


/***XXXXXX***/////// 






$arr = array();
$ar = array();
$getTitle = "";


    
    



$left = '<ul class="episodes">';
$right = '</ul>';
$getAll = implode('', $this->get_contents($left, $right, $serieLink));


$left = '<img src="';
$right = '"';
$getImages = $this->get_contents($left, $right, $getAll);


$left = '<span class="num-epi">';
$right = '</span>';
$getEpNums = $this->get_contents($left, $right, $getAll);


$left = '<div class="episode">';
$right = '</div>';
$getTitle = $this->get_contents($left, $right, $getAll);

$left = '<a data-request href="';
$right = '"';
$getEpLinks = $this->get_contents($left, $right, $getAll);


//$this->print_pre($getAll);


/**** printsdisabled
$this->print_pre($getImages); 
 
$this->print_pre($getTitle); 

$this->print_pre($getEpLinks); 
****/


$arr['image'] = $getImages;
$arr['title'] = $getTitle;
$arr['link'] = $getEpLinks;



//$this->print_pre($getYear);


?>




        
        
<html lang="tr"><head><meta http-equiv="content-type" content="text/html;charset=UTF-8">    

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legends - RW</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://rwmovies.site/kral.css">

        <style id="tp_style_css" type="text/css">
            
            :root {
              --body:#000000;
              --text:#fff;
              --link:#ffffff;
              --link-hover:#ffffff;
              --primary:#adadad;
              --gray-dark:#eee;
              --tertiary:#666666;
              --dark:#000;
              --light:#fff;
              --gray:#222222;
              --gray-light:#311e54;
              --secondary:#222222;
            }
        
        </style>
        	
	
</head>

<div id="aa-wp" class="cont">
    <header class="hd dfx alg-cr pfx headroom--top pfxa">
                                <figure class="logo fg1 cl0c">
                <a href="go:anasayfa" class="custom-logo-link" rel="home"><img width="124" height="85" src="https://i.hizliresim.com/jithui0.png" class="custom-logo" alt="Legends - Rabbit" srcset="https://i.hizliresim.com/jithui0.png 22w, https://i.hizliresim.com/jithui0.png 24w, https://i.hizliresim.com/jithui0.png 36w, https://i.hizliresim.com/jithui0.png 48w" ></a>				</figure>
                <nav id="menu" class="hdd dfxc fg1 jst-sb alg-cr">	
											</ul>
</li>
</ul>		</nav>
		
		</header>	<b>
	
        <body>

        
        <div class="middle">
            <body>
    
                <br> 
        <p class="round3"><i class="fa fa-imdb"> IMDb: <?php echo $getImdb[0];?></i></p>
        <br>
        <p class="round2"><i class="fa fa-angle-right"> Tür:  <?php 

             foreach($getGenre as $genre){

         

            echo ''.$genre.',';
            
            
             }

             ?></i></p>
        
        <h2><?php echo $getName[0];?></h2>
        <br> 
        <h3><i class="fa fa-eye"></i> Detay</h1>
        
        <h4><?php echo $getDesc[0] ?></h4>
        
        <br>
       

        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        
       
        </head> 
         
        <div class="header"> 
        
        
        
        </div>
        <div id="player"></div> 
        <footer class="footer"><ul id="nav"></div> 
        <div id="content-container"> 
        <div id="content">
        <div class="list-group">   
        
        
        
        <?php


   

$new = array();
for($i = 0; count($arr['image']) >= $i; $i++){
     

     
            
            if(isset($arr['image'][$i]) || isset($arr['title'][$i]) || isset($arr['link'][$i])){
                
     $new[$i]['image'] = $arr['image'][$i];
      $new[$i]['title'] = $arr['title'][$i];
          $new[$i]['link'] = $arr['link'][$i];

        

    


?>

        
        
<button class="list-group-item izle" 
onclick="location.href='<?php echo DOMAIN;?>/palx/Watch/<?=base64_encode(PAL.$new[$i]['link']);?>  ';" >
<img class="bluimg" src="<?=$new[$i]['image']?>">  
<strong><?php echo $getName[0];?></strong>   
<p class="menu70"><?=$new[$i]['title']?></p></button>
 


<?php

}

}


?>
 









        <center>
        <br>
        <a   href='https://bit.ly/rabbitweb27' >  
        <strong>Bu Kodlama Rabbit Web'e Aittir!</strong><br>
        <p> indirmek için tıklayınız.</p></a>
        
        
        
        
      
         
        
              
              
        
        
    
        
       
        
        
        
        
        
        
        
        
       
        
        



        

            
    
   
                                        
        </div>
        <div class="bghd"><img loading="lazy" src="<?php echo $getBg[0]?>"></div>
        <div class="bgft"><img loading="lazy" src="<?php echo $getBg[0]?>"></div>
        
	</b></div><b>
	


				
				<!-- modal -->
					
			</div>
		 







</b> 
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