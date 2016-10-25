# GraphenePay, one solution for all Graphene based blockchains. 
### Full PHP code to be scalable and easy to integrate on any webhost.

![http://i.imgur.com/4efF6WW.png](http://i.imgur.com/4efF6WW.png "http://i.imgur.com/4efF6WW.png")

----
http://i.imgur.com/m4DIKV4.png
## Any coin that runs on graphene.
Simply adapt the global configuration file to start accepting payments for your specific coin.

## Dedicated URL for both payments as donations. 
No more messing around with 0 values. Simply use the `/pay/` or the `/donatate/` URL.

## Websockets or RPC, you decide!
GraphenePay offers full support for `WSS` connections. This ensures that even the weakest backend can run the code to offer payment solutions. Rather use your own node? Simply switch to `RPC` and you're good to go.

## Filters and functions to ensure being live.
The route file has now some special filters that check for connectivity to the node first. This ensures that your services are always up when a customer initiates his payment.

## 100% decentralized.
Full open source codebase so anyone can start accepting payments on a Graphene blockchain coin.

## Many improvements.
GraphenePay has been build around SteemPay, making it more scalable and lightweight.


----
http://i.imgur.com/podTE4I.png
-----

# Running on your server for demo and docs

### Requirements

 - PHP (>5.5 or 7.0)
 - mcrypt enabled in your php.ini
 
### Setup
 - git clone https://github.com/graphenepay/graphenepay-dev
 - cd graphenepay-dev
 - php artisan serve
 
To specify your host and port use `php artisan serve --host HOST:PORT`
Go to the URL printed in your console. **Enjoy!**

### Having trouble? 

#### Mcrypt issues.

PHP 7
`sudo apt-get install mcrypt php7.0-mcrypt
`
PHP 5
`sudo apt-get install mcrypt php5-mcrypt
sudo php5enmod mcrypt
sudo service apache2 restart`

#### Permission issues
`chmod -R 777 /app/storage`


----
http://i.imgur.com/xX1hCOz.png
----
# Global configuration file (.env.php)

| PARAMETER       |  Information       |
| ------------ | ------------ |
|  CONNECTION_PROTOCOL | Set value to `RPC` for a local wallet or `WSS` for a public node by websocket.|
|  GRAPHENE_PUB_NODE | Set the public web socket address to connect to. For example, `wss://steemit.com/wspa` for the STEEM blockchain.|
|  GRAPHENE_BLOCK_EXPLORER | Set the correct blockexplorer for the selected chain. For example, `https://www.steemd.com` for STEEM.|
|  RPC_XXX Settings	 | Set your local wallet RPC settings. `HOST` and `PORT`. VERSION should not be altered.|
|  STEEMPAY_ACCOUNT | The account that should receive the payments. In most cases, this will be your account. Do not use @ !|
|  RECEIVER_HISTORY_COUNT | Sets how far in the sender's history to look for. Default = `100`, max = `1000` transactions.|
|  ENABLE_DEBUG | Only set to true during testing. Never set true on a live server!|

----
http://i.imgur.com/2f3T53Y.png

## Github:  https://github.com/graphenepay/graphenepay-dev

This is a functional, yet **experimental** code. Since all payments are made on the blockchain, funds will always be safe. Make sure to check Github for updates, as they will happen on a regular base.

## I found some things in your code!
Good! Please make a pull request or contact me on steemit.chat

## GraphenePay funding
All fundings will come from related posts and my **witness** steve-walschot. Please take your time to upvote my witness at https://steemit.com/~witnesses


# Truly yours, steve.
