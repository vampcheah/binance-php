<?php


/**
 * @author francis
 *
 * Fill in your key and secret and pass can be directly run
 *
 * Most of them are unfinished and need your help
 * https://github.com/zhouaini528/huobi-php.git
 * */
use Francis\BinanceDelivery;

require __DIR__ .'../../../vendor/autoload.php';

include 'key_secret.php';

$binance=new BinanceDelivery($key,$secret);

$binance->setOptions([
    //Set the request timeout to 60 seconds by default
    'timeout'=>10,

    //If you are developing locally and need an agent, you can set this
    //'proxy'=>true,
    //More flexible Settings
    /* 'proxy'=>[
     'http'  => 'http://127.0.0.1:12333',
     'https' => 'http://127.0.0.1:12333',
     'no'    =>  ['.cn']
     ], */
    //Close the certificate
    //'verify'=>false,
]);

try {
    $result=$binance->user()->postListenKey();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}



