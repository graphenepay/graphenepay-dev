<?php

class GrapheneCore
{

    protected $rpc;
    protected $wss;

    protected $connector;

    function __construct()
    {
        if($_ENV['CONNECTION_PROTOCOL'] === 'WSS') {
            $this->connector = new Graphene_WSS();
        }
        elseif($_ENV['CONNECTION_PROTOCOL'] === 'RPC') {
            $this->connector = new JsonRPC();
        } else {
            App::Abort(404, 'E1001: Connection not specified!');
        }
    }

    static function getConnection() {
        $gpc = new GrapheneCore();
        return $gpc->connector->connversion;
    }

    private function graphenepay_request($method, $params = array())
    {
        try {
            $ret = $this->connector->request($method, $params);
            return $ret->result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    function about()
    {
        return $this->graphenepay_request(__FUNCTION__);
    }

    public static function checkPayment($data)
    {
        // Load our $data array into variables
        $paymentID = $data->payid;
        $receiver = $data->to;
        $amount = $data->amount;
        $currency = $data->currency;
        $callback = $data->callback;


        // Read receiver transaction history
        $graphene = new GrapheneCore();
        $tx = $graphene->get_account_history($receiver, -1, 100);

        //return var_dump($tx);

        $data = array();

        // Loop trough each object in our history
        foreach($tx as $transactions) {

            // Itterate over the operations array to detect a deposit
            foreach($transactions[1] as $operation) {

                // Is there any deposit?
                if ($operation[0] === 'transfer') {

                    // Deposit found. Does it match the generated memo?
                    if ($operation[1]->memo === $paymentID) {

                        $tx_time = $transactions[1]->timestamp;
                        $tx_trx_id = $transactions[1]->trx_id;
                        $tx_block = $transactions[1]->block;
                        $tx_payid = $operation[1]->memo;
                        $tx_amount = $operation[1]->amount;

                        // Variable amount is requested, so payment ends here
                        if($amount === 0 || $amount === "0" || $amount === "0.000") {
                            $data['status'] = "success";
                            $data['success'] = true;
                            $data['message'] = "Payment completed with variable amount of " . $amount . "";
                            $data['block'] = $tx_block;
                            $data['trx_id'] = $tx_trx_id;
                            $data['payid'] = $tx_payid;
                            $data['amount'] = $tx_amount;
                            $data['timestamp'] = $tx_time;
                            return $data;
                        } else {
                            // Does the amount matches the requested amount?

                            if ($operation[1]->amount === $amount . " " . strtoupper($currency) ) {
                                $data['status'] = "success";
                                $data['success'] = true;
                                $data['message'] = "Payment completed with fixed amount (" . $amount . " " . $currency. ").";
                                $data['block'] = $tx_block;
                                $data['trx_id'] = $tx_trx_id;
                                $data['payid'] = $tx_payid;
                                $data['amount'] = $tx_amount;
                                $data['timestamp'] = $tx_time;
                                return $data;
                            } else {
                                $data['status'] = "success";
                                $data['success'] = false;
                                $data['message'] = "The deposited amount (" . $operation[1]->amount . ")  does not match the requested (" . $amount .  " " . $currency .").";
                                $data['block'] = $tx_block;
                                $data['trx_id'] = $tx_trx_id;
                                $data['payid'] = $tx_payid;
                                $data['amount'] = $tx_amount;
                                $data['timestamp'] = $tx_time;
                                return $data;
                            }
                        }
                    }
                }
            }
        }
        $data['status'] = false;
        $data['success'] = false;
        $data['message'] = "No transaction has been found so far with ID" . $paymentID;
        return $data;
    }


    function get_block($input)
    {
        return $this->graphenepay_request(__FUNCTION__, array($input));
    }

    function get_accounts($input)
    {
        return $this->graphenepay_request(__FUNCTION__, array($input));
    }

    function get_account_history($input, $seq, $limit)
    {
        return $this->graphenepay_request(__FUNCTION__, array($input, $seq, $limit));
    }

}