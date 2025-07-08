<?php

//$v = base64_decode($_GET["v"]);

$v = $_GET['v'];




    $v = str_replace('*', '?', $v);
    $v = str_replace('@', '&', $v);
    $left = '';
$right = '';
$getEps = $this->get_contents($left, $right, $v);
echo $getEps;
    header('Access-Control-Allow-Origin: *');















