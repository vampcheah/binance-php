<?php
/**
 * @author francis
 * */

namespace Francis\Binance;


use Francis\Binance\Api\Futures\User;
use Francis\Binance\Api\Futures\Trade;
use Francis\Binance\Api\Futures\Market;

class BinanceFuture
{
    protected $key;
    protected $secret;
    protected $host;

    protected $options=[];

    function __construct(string $key='',string $secret='',string $host='https://fapi.binance.com'){
        $this->key=$key;
        $this->secret=$secret;
        $this->host=$host;
    }

    /**
     *
     * */
    private function init(){
        return [
            'key'=>$this->key,
            'secret'=>$this->secret,
            'host'=>$this->host,

            'options'=>$this->options,
        ];
    }

    /**
     *
     * */
    function setOptions(array $options=[]){
        $this->options=$options;
    }

    /**
     *
     * */
    public function user(){
        return new User($this->init());
    }

    /**
     *
     * */
    public function trade(){
        return new Trade($this->init());
    }

    /**
     *
     * */
    public function market(){
        return new Market($this->init());
    }
}
