<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Softon\Indipay\Facades\Indipay;
use Illuminate\Support\Facades\Mail;
use Session;
use App\Order;
use App\User;


class PayumoneyController extends Controller
{
    public function payumoneyPayment(){
    	$order_id = Session::get('order_id');
    	$grand_total = Session::get('grand_total');
    	$orderDetails = Order::getOrderDetails($order_id);
    	$orderDetails = json_decode(json_encode($orderDetails));
    	$nameArr = explode(' ', $orderDetails->name);
    	$parameters = [
    		'txnid' => $order_id,
    		'order_id' => $order_id,
    		'amount' => $grand_total,
    		'firstname' => $nameArr[0],
    		'lastname' => $nameArr[1],
    		'email' => $orderDetails->user_email,
    		'phone' => $orderDetails->mobile,
    		'productinfo' => $order_id,
    		'service_provider' => '',
    		'zipcode' => $orderDetails->pincode,
    		'city' => $orderDetails->city,
    		'country' => $orderDetails->country,
    		'address1' =>$orderDetails->address,
    		'address2' => ' ',
    		'surl' => url('payumoney/response/success'),
    		'furl' => url('payumoney/response/'),
    	];
    	$order = Indipay::prepare($parameters);
    	return Indipay::process($order);
    }

    public function payumoneyResponse(Request $request){
    	$response = Indipay::response($request);
    	echo "<pre>"; print_r($response);
    	if($response['status']=="success" && $response['unmappedstatus']=="captured"){
    		$order_id = Session::get('order_id');
    		Order::where('id',$order_id)->update(['order_status'=>'Payment Capture']);

    		$productDetails = Order::with('orders')->where('id',$order_id)->first();
    		$productDetails = json_decode(json_encode($productDetails),true);
    		$user_id = $productDetails['user_id'];
    		$user_email = $productDetails['user_email'];
    		$name = $productDetails['name'];

    		$userDetails = User::where('id',$user_id)->first();
    		$userDetails = json_decode(json_encode($userDetails),true);
    		$email = $user_email;
    		$messageData = [
    			'email' => $email,
    			'name' => $name,
    			'order_id' => $order_id,
    			'productDetails' => $productDetails,
    			'userDetails' => $userDetails
    		];
    		Mail::send('emails.order',$messageData,function($messageData) use($email){
    			$messageData->to($email)->subject('Order Placed - Online Shopping');
    		});

    		return redirect('payumoney/thanks');
    	}else{

    		$order_id = Session::get('order_id');

    		Order::where('id',$order_id)->update(['order_status'=>'Payment Failed']);
    		DB::table('cart')->where('user_email',$user_email)->delete();
    		return redirect('payumoney/fail');
    	}
    }	

    public function payumoneyThanks(){
    	return view('orders.thanks_payumoney');
    }

    public function payumoneyFail(){
    	return view('orders.cancel_payumoney');
    }
}
