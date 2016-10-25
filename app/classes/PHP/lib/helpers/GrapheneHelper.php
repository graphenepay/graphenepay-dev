<?php

class GrapheneHelper {


    static function testCLIrunning($ip, $port) {
        $fp = @fsockopen($ip, $port, $errno, $errstr, 30);
        if (is_resource($fp)) {
            return true;
        }
    }

    /**
     * @return string
     */
    static function generatePaymentID() {
        $length = 18;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $payID = '';
        for ($i = 0; $i < $length; $i++) {
            $payID .= $characters[rand(0, $charactersLength - 1)];
        }
        return $payID;
    }

    static function object_to_array($object) {
        return (array) $object;
    }

    static function formatCurrency($amount) {
        $amount = number_format($amount, 3, '.', '');
        return $amount;
    }

}