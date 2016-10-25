@extends('master')

@section('content')
    <h1 class="gpp_h1"><img src="/graphenepay/assets/img/h1_logo.png"> test suite</h1>
    <hr>
    <h4>Thank you page and redirect user after receiving.</h4>

    <div class="row">
        <div class="col-md-12 text-center">
            <hr>
            <button id="btn_next" class="btn btn-success btn-lg">Take me back to the merchant!</button>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <p class="lead">This page does nothing really.</p>
            <p>This will only show to the user that the payment has been made, and allow him to return. This could be done automatically using a timeout.</p>
            <p>This is the page where the callback will happen to the merchant. Remember, validation is <strong>mandatory</strong> before marking payment complete!</p>
            <p><strong>The callback will be appended with the '&payid=xxxxxxxxxxxxx' parameter!</strong></p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <p class="lead">Simulate a verification request.</p>
            <p>This will only show to the user that the payment has been made, and allow him to return. This could be done automatically using a timeout.</p>
            <p>This is the page where the callback will happen to the merchant. Remember, validation is <strong>mandatory</strong> before marking payment complete!</p>

            <div class="row">
                <div class="col-md-12 text-center">
                    <hr>
                    <button id="btn_verify" class="btn btn-success btn-lg">Simulate a verification call!</button>
                    <hr>
                </div>
            </div>
        </div>
    </div>

@stop

@section('page_js')

    <script>
        $("#btn_next").click(function() {
            window.location.href = '{{ $callback }}' + '&payid=' + '{{ $payid }}';
        });
        $("#btn_verify").click(function() {
            window.location.href = '/verify?payid={{$payid}}&receiver={{$to}}&amount={{$amount}}&currency={{$currency}}';
        });
    </script>


    <script> var GoURL = 'testing.com';</script>
    {{ HTML::script('graphenepay/assets/js/graphenejs.js') }}
    <script>


        function callAjax(){
            $.ajax({
                type: 'GET',
                url: '/handle?payid={{$payid}}&receiver={{$to}}&amount={{$amount}}&currency={{$currency}}&callback={{$callback}}',
                dataType: 'json',
                success: function(data){
                    console.log(data);
                },

            });
        }

        function getBlock(block) {
            steem.api.options.url = "{{ $_ENV['GRAPHENE_PUB_NODE'] }}";
            steem.api.getBlockHeader(block, function(err, result) {
                console.log(err, result);
            });
        }

        function callAccount(){

            amount = {{ $amount }};
            currency = "{{{ $currency }}}";
            receiver = "{{{ $to }}}";
            payid = "{{{ $payid }}}";

            steem.api.options.url = "{{ $_ENV['GRAPHENE_PUB_NODE'] }}";
            steem.api.getAccountHistory('{{$to}}', '-1', {{{ $_ENV['RECEIVER_HISTORY_COUNT'] }}}, function(err, result) {

                for (var key in result) {
                    var tx = result[key][1]['op'];
                    if (tx[0] === "transfer") {

                        if (tx[1]['memo'] === '{{$payid}}' ) {

                            //Donation, so payment ends here.
                            if(amount === 0 ) {
                                console.log("success");

                            } else {
                                if( tx[1]['amount'] === amount + " " + currency ) {
                                    //success
                                    console.log ('Payment completed');
                                }
                                console.log (tx[1]['amount']);
                            }
                        }
                    }
                }
            });


        }


    </script>
@stop