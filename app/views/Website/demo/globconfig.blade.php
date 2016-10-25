@extends('master')


@section('content')
    <h1 class="gpp_h1"><img src="/graphenepay/assets/img/h1_logo.png">&nbsp; Documentation</h1>
    <hr>
    <h4>Global configuration file <code class="prettyprint">.env.php</code> <i>(root directory)</i></h4>
    <div class="row">
        <div class="col-md-12" style="margin-top: 30px;">
            <table class="table table-responsive table-bordered">
                <tr>
                    <td width="30%"><code class="prettyprint">CONNECTION_PROTOCOL</code></td>
                    <td>Set value to <code class="prettyprint">RPC</code> for a local wallet or <code class="prettyprint">WSS</code> for a public node by websocket.</td>
                </tr>
                <tr>
                    <td width="30%"><code class="prettyprint">GRAPHENE_PUB_NODE</code></td>
                    <td>Set the public web socket address to connect to. For example, <code class="prettyprint"><i>wss://steemit.com/wspa</i></code> for the STEEM blockchain.</td>
                </tr>
                <tr>
                    <td width="30%"><code class="prettyprint">GRAPHENE_BLOCK_EXPLORER</code></td>
                    <td>Set the correct blockexplorer for the selected chain. For example, <code class="prettyprint"><i>https://www.steemd.com</i></code> for STEEM.</td>
                </tr>
                <tr>
                    <td width="30%"><code class="prettyprint">RPC_XXX Settings</code></td>
                    <td>Set your local wallet RPC settings. <code class="prettyprint">HOST</code> and <code class="prettyprint">PORT</code>. <code class="prettyprint">VERSION</code> should <strong>not</strong> be altered.</td>
                </tr>
                <tr>
                    <td width="30%"><code class="prettyprint">STEEMPAY_ACCOUNT</code></td>
                    <td>The account that should receive the payments. In most cases, this will be your account. <strong>Do not use @ !</strong></td>
                </tr>
                <tr>
                    <td width="30%"><code class="prettyprint">RECEIVER_HISTORY_COUNT</code></td>
                    <td>Sets how far in the sender's history to look for. Default = 100, max = 1000 transactions.</td>
                </tr>
                <tr>
                    <td width="30%"><code class="prettyprint">ENABLE_DEBUG</code></td>
                    <td>Only set to true during testing. <strong>Never</strong> set true on a live server!</td>
                </tr>
            </table>
        </div>
    </div>
@stop