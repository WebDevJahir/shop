@extends('layouts.frontendLayout.master')
@section('content')
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
				<h3>YOUR PAYUMONEY ORDER HAS BEEN CANCELLED</h3>
				<p>Please contact with us if you have any enquiry.</p>
			</div>
		</div>
	</section>

@endsection
<?php 
Session::forget('grand_total');
Session::forget('order_id');
?>