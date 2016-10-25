<?php

/**
 * Simple JSON-RPC interface.
 */

class JsonRPC
{

    public $connversion = "RPC";

    protected $host, $port, $version;
    protected $id = 0;

    function __construct()
    {
            $this->host = $_ENV['RPC_SERVER'];
            $this->port = $_ENV['RPC_PORT'];
            $this->version = $_ENV['RPC_VERSION'];
    }

    function request($method, $params=array())
    {
        $data = array();
        $data['jsonrpc'] = $this->version;
        $data['id'] = $this->id++;
        $data['method'] = $method;
        $data['params'] = $params;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->host);
        curl_setopt($ch, CURLOPT_PORT, $this->port);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $ret = curl_exec($ch);

        if($ret !== FALSE)
        {
            $formatted = $this->format_response($ret);

            if(isset($formatted->error))
            {
                throw new JsonRPCException($formatted->error->message, $formatted->error->code);
            }
            else
            {
                return $formatted;
            }
        }
        else
        {
            exit("Server down: ". curl_error($ch));
        }
    }

    function format_response($response)
    {
        return @json_decode($response);
    }

}
class JsonRPCException extends Exception
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": ".(($this->code > 0)?"[{$this->code}]:":"")." {$this->message}\n";
    }
}