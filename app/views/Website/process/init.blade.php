@extends('master')

@section('content')
    <h1 class="gpp_h1"><img src="/graphenepay/assets/img/h1_logo.png"> test suite</h1>
    <hr>
    <h4>Initial page showing instructions and overview</h4>
    {{-- DONATION PART --}}
    @if($amount === 0 || $amount === '')

    <p>These are the fields used for a <strong>donation</strong> to someone. Donations are independant of currency or amount.</p>

    <div class="row" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="col-md-12 well">
            Sent any amount to
            <p class="text-info">{{{ $amount }}} </p>
            Using the following memo code
            <p class="text-info">{{{ $payid }}} </p>
        </div>
        <div class="row" id="pay_received">
            <div class="col-md-12 text-center">
                <p id="txt_btn_next">A link will appear if after you made this payment. Set your own account as receiver and try!</p>
                <button id="btn_next" class="btn btn-success" style="display: none">Payment received, continue to next step!</button>
            </div>
        </div>
        <div class="col-md-12">
            <p class="text-info">Hint!</p>
            Users can set the paymentID to any desired value by using 'payid' in the URL.  Custom 'payid' <strong>must</strong> be unique!
        </div>
    </div>

    @else
    {{-- PAYMENT PART --}}
    <p>These are the fields used for a <strong>payment</strong> to someone. Amount and currency are checked.</p>

    <div class="row" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="col-md-12 well">
            Sent the exact amount of
            <p class="text-info">{{{ $amount . " " . strtoupper($currency) }}} </p>
            to account
            <p class="text-info">{{{ $to }}} </p>
            Using the following memo code
            <p class="text-info">{{{ $payid }}} </p>
        </div>
        <div class="row" id="pay_received">
            <div class="col-md-12 text-center">
                <p id="txt_btn_next">A link will appear if after you made this payment. Set your own account as receiver and try!</p>
                <button id="btn_next" class="btn btn-success" style="display: none">Payment received, continue to next step!</button>
            </div>
        </div>
        <div class="col-md-12">
            <p class="text-info">Hint!</p>
            Users can set the paymentID to any desired value by using 'payid' in the URL. Custom 'payid' <strong>must</strong> be unique!
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <p class="lead">Merchants! Here is your flow to follow.</p>
            <p>The proper flow of accepting a payment is to start out by generating your own payment ID and supply it in the 'payid' parameter.
            You should store all payment information prior to submitting the user to the payment gateway.</p>

            <p>If you do not supply a payment ID, the code will generate one for you and return it on your callback url.</p>

            <p>If the payment is successfull, the 'callback' parameter will return your user to this specific URL. It is <strong>mandatory</strong> that you make a verification upon receiving a callback
            <strong>before</strong> marking the payment as complete, since their is always a risk that the user tampered with the data.</p>

            <p>The verify call is processed in the backend of the server with additional checks to make it tamper proof.</p>

            <hr>

            <p>This page only checks if the specific memo has been found in the blockchain, no data validation happens at this point since altering the URL would give a success.</p>
        </div>
    </div>
@stop

@section('page_js')
    <script>


        $("#btn_next").click(function() {

            window.location.href = '/received?payid={{$payid}}&receiver={{$to}}&amount={{$amount}}&currency={{$currency}}&callback={{ $callback }}';
        });


    </script>

    {{ HTML::script('graphenepay/assets/js/graphenejs.js') }}

    <script>

        var interval = null;
        updateDiv();

        function updateDiv(){
            callAccount();
        }

        function callAccount(){

            steem.api.options.url = "{{ $_ENV['GRAPHENE_PUB_NODE'] }}";
            steem.api.getAccountHistory('{{$to}}', '-1', {{{ $_ENV['RECEIVER_HISTORY_COUNT'] }}}, function(err, result) {
                //console.log(err, JSON.stringify(result));
                for (var key in result) {

                    var tx = result[key][1]['op'];
                    ///console.log(JSON.stringify(key));
                    if (tx[0] === "transfer") {

                        if (tx[1]['memo'] === '{{$payid}}' ) {
                            console.info("Payment success in block " + result[key][1]['block']);
                            clearInterval(interval);
                            $( "#btn_next" ).toggle();
                            $( "#txt_btn_next" ).toggle();
                        }

                       // console.log(JSON.stringify("from : " + tx[1]['from'] + "| TO: " + tx[1]['memo']));
                    }
                }
            });
        }

        $(document).ready(function() {
            interval = setInterval(updateDiv, 2000);
        });

    </script>
@stop