<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/verify', function()
{
	$payment = new GraphenePayment(Input::All());
	return json_encode(GrapheneCore::checkPayment($payment));
});


Route::get('/pay', function()
{
	$payment = new GraphenePayment(Input::All());

	if (!$payment->success) {
		return $payment->message;
	}

	return View::make('Website.process.init')->with(GrapheneHelper::object_to_array($payment));
});


Route::get('/donate', function()
{
	$donation = new GrapheneDonation(Input::All());

	if (!$donation->success) {
		return $donation->message;
	}

	return View::make('Website.process.init')->with(GrapheneHelper::object_to_array($donation));
});


Route::get('/received', function()
{

	$payment = new GraphenePayment(Input::All());

	if (!$payment->success) {
		return $payment->message;
	}

	return View::make('Website.process.received')->with(GrapheneHelper::object_to_array($payment));
});


/*
|--------------------------------------------------------------------------
| View only, no data needed.
|--------------------------------------------------------------------------
|
*/


Route::get('/demo', function() {return View::make('Website.demo.index');});
Route::get('/demo/pay', function() {return View::make('Website.pay_demo');});
Route::get('/help/config', function() {return View::make('Website.demo.globconfig');});
Route::get('/help/run', function() {return View::make('Website.demo.running');});
Route::get('/', function() {return View::make('Website.demo.index');});


/*
|--------------------------------------------------------------------------
| Special filter to see if the RPC is online!
|--------------------------------------------------------------------------
|
| Put every call inside this filter.
| If your RPC connection is offline, you're application will throw an error.
| See 'testCLIrunning' in GrapheneHelper.php.
|
*/

Route::group(array('before' => 'online'), function()
{
/*
	Route::get('/', function()
	{
		// Do your thing!
	});
*/
});




