@extends('master')


@section('content')
    <h1 class="gpp_h1"><img src="/graphenepay/assets/img/h1_logo.png">&nbsp; Documentation</h1>
    <hr>
    <h4>Serve the demo and documentation.</h4>
    <div class="row">
        <div class="col-md-12" style="margin-top: 30px;">
            <p><code class="prettyprint">git clone https://github.com/graphenepay/graphenepay</code> </p>
            <p><code class="prettyprint">cd graphenepay && cd GraphenePay-L4</code> </p>
            <p>&nbsp;</p>
            <p><strong>PHP 7</strong></p>
            <p><code class="prettyprint">sudo apt-get install mcrypt php7.0-mcrypt</code></p>
            <p>&nbsp;</p>
            <p><strong>PHP 5</strong></p>
            <p><code class="prettyprint">sudo apt-get install mcrypt php5-mcrypt<br>
                 sudo php5enmod mcrypt<br>
                sudo service apache2 restart</code></p>
            <p><code class="prettyprint">php artisan serve</code></p>
            <p>To specify your host and port use <code class="prettyprint">php artisan serve--host HOST:PORT </code></p>
            <p>Go to the URL printed in your console. Enjoy!</p>
            <p>&nbsp;</p>
            <p class="text-info">Hint!</p>
            Laravel runs on <code class="prettyprint">localhost</code> by default. Your localhost may be <code class="prettyprint">0.0.0.0</code> or <code class="prettyprint">127.0.0.1</code>
        </div>
    </div>
@stop