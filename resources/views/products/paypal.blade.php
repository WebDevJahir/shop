@extends('layouts.frontendLayout.master')
@section('content')
<?php use App\Order; ?>
	<section id="cart_item">
		<div class="container">
			<div class="Breadcrumbs">
				<ol class="Breadcrumbs">
					<li><a href="{{url('/')}}">Home</a></li>
					<li class="active">Thanks</li>
				</ol>
			</div>
		</div>
	</section>
	<section id="do_action">
		<div class="container">
			<div class="heading" align="center">
				<h3>YOUR COD ORDER HAS BEEN PLACED</h3>
				<p>Your order number is {{Session::get('order_id')}} and total payable about is TK {{Session::get('grand_total')}}</p>
				<?php
					$orderDetails = Order::getOrderDetails(Session::get('order_id'));
					$orderDetails = json_decode(json_encode($orderDetails));
					$nameArr = explode(' ',$orderDetails->name);
					//echo "<pre>"; var_dump($nameArr); die;
					$countryCode = Order::getCountryCode($orderDetails->country);
				 ?>
				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
					<input type="hidden" name="cmd" value="_xclick"><br>
					<input type="hidden" name="business" value="jahirupa@gmail.com"><br>
					<input type="text" name="item_name" value="{{Session::get('order_id')}}"><br>
					<input type="text" name="currency_code" value="USD"><br>
					<input type="text" name="amount" value="{{Session::get('grand_total')}}"><br>
					<input type="text" name="first_name" value="{{ $nameArr[0] }}"><br>
					<input type="text" name="last_name" value="{{ $nameArr[1] }}"><br>
					<input type="text" name="address1" value="{{$orderDetails->address}}"><br>
					<input type="text" name="address2" value=""><br>
					<input type="text" name="city" value="{{$orderDetails->city}}"><br>
					<input type="text" name="state" value="{{$orderDetails->state}}"><br>
					<input type="text" name="zip" value="{{$orderDetails->pincode}}"><br>
					<input type="text" name="country" value="{{$countryCode->country_code}}"><br>
					<input type="hidden" name="return" value="{{url('paypal/thanks')}}"><br>
					<input type="hidden" name="cancel_return" value="{{url('paypal/cancel')}}"><br>
					<input type="text" name="email" value="{{$orderDetails->user_email}}"><br>
					<input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_buynow_107x26.png" alt="Buy now">
					<img src="https://paypalobjects.com/en_US/i/scr/pixel.gif" alt="" width="1" height="1">
				</form>
			</div>
		</div>
	</section>

@endsection
<?php 
Session::forget('grand_total');
Session::forget('order_id');
?>