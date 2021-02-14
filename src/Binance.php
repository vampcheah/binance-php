<?php
/**
 * @author francis
 * */

namespace Francis\Binance;

use Francis\Binance\Api\User;
use Francis\Binance\Api\System;
use Francis\Binance\Api\Trade;

class Binance
{
    protected $key;
    protected $secret;
    protected $host;

    protected $options=[];

    function __construct(string $key='',string $secret='',string $host='https://api.binance.com'){
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
    public function system(){
        return new System($this->init());
    }

    /**
     *
     * */
    public function trade(){
        return new Trade($this->init());
    }
}
