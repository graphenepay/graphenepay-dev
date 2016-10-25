<?php

return array(


    /*
     * Specifies the protocol to use.
     * Set to 'WSS' for websockets or 'RPC' for RPC connection trough CLI_WALLET
     */

    'CONNECTION_PROTOCOL'       => "WSS",

    /*
     * Golos: wss://golos.steem.ws
     * Steem: wss://steemit.com/wspa
     */

    'GRAPHENE_PUB_NODE'         => 'wss://steemit.com/wspa',


    /*
     * Golos: http://www.golosdb.com
     * Steem: http://www.steemdb.com
     */

    'GRAPHENE_BLOCK_EXPLORER'   => 'http://www.steemdb.com',



    /*
     * CLI_WALLET server settings
     */
    'RPC_SERVER'                => '',
    'RPC_PORT'                  => 8090,
    'RPC_VERSION'               => "2.0",


    /*
     * Receiving account
     */

    'STEEMPAY_ACCOUNT'          => 'steempayments',
    'RECEIVER_HISTORY_COUNT'    => 100,


    'ENABLE_DEBUG'              => true,


);