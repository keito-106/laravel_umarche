<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LifeCycleTestController extends Controller
{

    public function showServiceProviderTest()
    {
        //サービスプロバイダのテスト
        $encrypt = app()->make('encrypter');
        $password = $encrypt->encrypt('password');

        $sample = app()->make('serviceProviderTest');

        dd($sample, $password, $encrypt->decrypt($password));
    }

    public function showServiceContainerTest()
    {
        app()->bind('lifeCycleTest', function(){
            return 'ライフサイクルテスト';
        });

        $test = app()->make('lifeCycleTest');

        //サービスコンテナなしのパターン
        //$message = new Message();
        //$sample = new Sample($message);
        //$sample->run();

        //サービスコンテナapp()ありのパターン
        app()->bind('sample', Sample::class);
        $sample = app()->make('sample');
        $sample->run();
        dd($test, app());
    }
}

class Sample
{
    public $Message;
    public function __construct(Message $message){
        $this->Message = $message;
    }
    public function run(){
        $this->Message->send();
    }
}

class Message
{
    public function send(){
        echo('メッセージ表示');
    }
}
