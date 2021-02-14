<?php


/**
 * @author francis
 *
 * Fill in your key and secret and pass can be directly run
 *
 * Most of them are unfinished and need your help
 * https://github.com/zhouaini528/huobi-php.git
 * */
use Francis\Binance\BinanceDelivery;

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

//Send in a new order.
try {
    $result=$binance->trade()->postOrder([
        'symbol'=>'ETHUSD_201225',
        'side'=>'BUY',
        'type'=>'LIMIT',
        'quantity'=>'1',
        'price'=>'50',
        'timeInForce'=>'GTC',

        //'newClientOrderId'=>'xxxxxxx'
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}
sleep(1);

//Check an order's status.
try {
    $result=$binance->user()->getOrder([
        'symbol'=>'ETHUSD_201225',
        'orderId'=>$result['orderId'],
        //'origClientOrderId'=>$result['clientOrderId'],
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}
sleep(1);

//Cancel an active order.
try {
    $result=$binance->trade()->deleteOrder([
        'symbol'=>'ETHUSD_201225',
        'orderId'=>$result['orderId'],
        'origClientOrderId'=>$result['clientOrderId'],
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}







