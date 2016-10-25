<?php
use WebSocket\Client;
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 22/10/2016
 * Time: 18:54
 */
class Graphene_WSS
{

    public $connversion = "WSS";

    private $client;
    function __construct()
    {
        $this->client = new Client("wss://steemit.com/wspa");
    }

    function request($method, $params=array()) {


        $this->client = new Client("wss://steemit.com/wspa");


        $parameters = array(
            "id"  => 1,
            "method" => $method,
            "params" => $params
        );


        $this->client->send(json_encode($parameters));

        //echo var_dump(json_encode($parameters));

        $response = @json_decode($this->client->receive());

        //return var_dump($response);

        if(property_exists($response, "error")) { App::Abort(404, $response->error->data->message); }

        return $response;
    }

    function format_response($response)
    {
        return @json_decode($response);
    }
}