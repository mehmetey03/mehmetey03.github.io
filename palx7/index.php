<?php
error_reporting(E_ALL & ~E_NOTICE);
///exit("YENİ İÇERİKLER EKLENİYOR DAHA SONRA TEKRAR DENEYİNİZ");
require './Mind.php';




/////////////////**
/**
 * DİZİPAL BOTU BY:::> t.me/tarumar
 * SÜRÜM: v11.10.2022
 * ///what we know is an a drop, what we don't know is an ocean.///
 ** /
 * //////////////



//NOT//
/**
 * AŞŞAĞIDAKİ BİLGİLERİ KENDİNİZE GÖRE UYARLARKEN 2. KISMI DEĞİŞTİRİN.
 * 
 * Örnek : define('BURA DEĞİL', 'BURDAKİ BİLGİ DEĞİŞECEK')
 * bura değil dediğim kısma dokunma bot bozulur amn..
 **/


/*** LISANS KODUNU GİR */
define('LICENSE', 'aren4');

//kendi domainin
define('DOMAIN', 'https://mehmetey03.github.io/');

//dizipal güncel domain
define('PAL', 'https://dizipal953.com');

define('PUL', '');

//isteğe özel koruma:::paket adını girin
define('PACKAGE', 'rabbit.web3');

//USER AGENT KORUMASI -- user agent gir.
define('USERAGENT', 'Mozilla/5.0 (Linux; Android 7.1.2; SM-N976N Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/119.0.6045.193 Mobile Safari/537.36 Vinebre');





// AÇMA KAPAMA ALANI
$paket = 'off';
$useragent = 'off';






$conf = array(
    'license'=>array(
        'key'=>LICENSE
        )
);

$Mind = new Mind($conf);


//////////////*///////////////
$package = PACKAGE;
 if($paket == 'on'){
         $srv = $_SERVER['HTTP_X_REQUESTED_WITH'];
         if(stristr($srv, $package) === FALSE) {
    $Mind->abort('403','ACCESS-DENIED');
  }else{
      echo '';
  }
     
 }
  
///////////*///////////////

//////////////*///////////////
$ua = USERAGENT;
 if($useragent == 'on'){
         $uasrv = $_SERVER['HTTP_USER_AGENT'];
         if(stristr($uasrv, $ua) === FALSE) {
    $Mind->abort('','');
  }else{
      echo '';
  }
 }
  
///////////*///////////////

$Mind->route('/', 'app/api/Home');
$Mind->route('Series', 'app/api/Series');
$Mind->route('Movies:List@pag', 'app/api/Movies');
$Mind->route('Serie:Serie@num', 'app/api/Serie');
$Mind->route('Watch:Watch', 'app/api/Watch');
$Mind->route('MWatch:Watch', 'app/api/MWatch');
$Mind->route('Search:Search@pag', 'app/api/Search');
$Mind->route('Get', 'app/api/Get');
$Mind->route('Get2', 'app/api/Get2');
$Mind->route('Get3', 'app/api/Get3');
$Mind->route('ajax', 'app/api/ajax');
$Mind->route('ajaxm', 'app/api/ajaxm');
