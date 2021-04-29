<?php


namespace App\Services;

use GuzzleHttp\Client;
use App\Services\AppServices;

class MessageService
{
    private $token;
    private $baseurl;
    private $client;
    private $chatId;
    private $text;
    private $palindrom;
function __construct(){
    $this->baseurl=env('TELEGRAM_API_URL');
    $this->token=env('TELEGRAM_BOT_TOKEN');
    $this->client= new Client(
        ['base_uri' => $this->baseurl . 'bot' . $this->token . '/']
    );
    }



public function getMessages(){
    $responce = $this->client->request('GET','getUpdates',['query' => ['offset' => -1]]);



    if($responce->getStatusCode() === 200){
        $message =json_decode($responce->getBody()->getContents(),true);
        if(array_key_exists('edited_message', $message['result'][0])) {
            $this->chatId = $message['result'][0]['edited_message']['chat']['id'];
            $this->text = $message['result'][0]['edited_message']['text'];
        } else {
            $this->chatId = $message['result'][0]['message']['chat']['id'];
            $this->text = $message['result'][0]['message']['text'];
        }
        $this->palindrom = AppServices::getPhrase($this->text);
        $this->setMessages();
    }
}
public function setMessages(){
  
        $this->client->request('GET','sendMessage',['query' => [
            'chat_id' => $this->chatId,
            'text' => $this->palindrom
        ]]);
    }

}