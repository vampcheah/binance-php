<?php
/**
 * @author francis
 * */

namespace Vampcheah\Exchange;

use Workerman\Connection\AsyncTcpConnection;

class BinanceWebSocket
{
    private $server=null;
    private $client=null;
    private $config=[];
    private $subscribe=[];

    /**
     * @param array $config
     */
    public function config(array $config=[]){
        $this->config=$config;
    }

    /**
     * @param array $subscribe
     */
    public function subscribe(array $subscribe=[]){
        $this->subscribe = json_encode([
            "method"=>"SUBSCRIBE",
            'params'=>$subscribe,
            'id'=>1
        ]);
    }

    /**
     * 执行 AsyncTcpConnection
     */
    public function run(callable $callback){
        $ws = new AsyncTcpConnection($this->getBaseUrl());
        $ws->transport = 'ssl';
        $ws->send($this->subscribe);
        $ws->onMessage = function($connection, $data) use ($callback) {
            $json = json_decode($data);
            call_user_func($callback, $this, $data);
        };
        $ws->onError = function($ws, $code, $msg){
            $ws->reConnect(1);
        };
        $ws->onClose = function($ws) {
            // 如果连接断开，则在1秒后重连
            $ws->reConnect(1);
        };
        $ws->connect();
    }

    private function getBaseUrl(){
        $baseurl=isset($this->config['baseurl']) ? $this->config['baseurl'] : 'ws://stream.binance.com:9443';
        return $baseurl.'/stream';
    }
}
