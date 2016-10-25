@extends('master')


@section('content')
    <h1 class="gpp_h1"><img src="/graphenepay/assets/img/h1_logo.png"> test suite</h1>
    <hr>
    <h4>Fill out the data and get started testing GraphenePay.</h4>
    <div class="row">
        <div class="col-md-6 col-md-offset-3" style="margin-top: 60px;">
            <form class="form-horizontal" action="/pay/">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Receiver</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="receiver"  name="receiver" placeholder="steem username">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">Amount</label>
                    <div class="col-md-4">
                        <select class="form-control" name="currency">
                            <option value="SBD">Steem Dollars</option>
                            <option value="STEEM">STEEM</option>
                            <option value="0">Donation (any amount)</option>
                        </select>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="amount" placeholder="Amount">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Callback</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="callback" placeholder="Where to return your customers">
                    </div>
                </div>
                <div class="col-md-12" style="margin:0; padding:0;"> <hr style="border-color: #e8e8e8"></div>
                <div class="form-group">
                    <div class="col-md-12" style="text-align: center">
                        <button type="submit" class="btn btn-default" id="btnGenerateBtn">Start demo</button>
                    </div>
                </div>
                <div class="col-md-12" style="margin:0; padding:0;"> <hr style="border-color: #e8e8e8"></div>
            </form>
        </div>
    </div>
    <div class="col-md-12">
        <p class="text-info">Hint!</p>
        Set your own account as receiver and make a payment to yourself to test!
    </div>
@stop