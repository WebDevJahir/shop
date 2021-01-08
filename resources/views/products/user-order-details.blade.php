@extends('layouts.frontendLayout.master')
@section('content')
	<section id="cart_item">
		<div class="container">
			<div class="Breadcrumbs">
				<ol class="Breadcrumbs">
					<li><a href="{{url('/')}}">Home</a></li>
					<li class="active">Orders</li>
				</ol>
			</div>
		</div>
	</section>
	<section id="do_action">
		<div class="container">
			<div class="heading" align="center">
				<table id="example" class="table table-striped table-bordered" style="width: 100%">
					<thead>
						<tr>
							<th>Product Code</th>
							<th>Product Name</th>
							<th>Product Size</th>
							<th>Product Color</th>
							<th>Product Price</th>
							<th>Product Quantity</th>
							<th>Created At</th>
						</tr>
					</thead>
					<tbody>
						@foreach($orderDetails->orders as $orderProduct)
						<tr>
							<td>{{$orderProduct->product_code}}</td>
							<td>{{$orderProduct->product_name}}</td>
							<td>{{$orderProduct->product_size}}</td>
							<td>{{$orderProduct->product_color}}</td>
							<td>{{$orderProduct->product_price}}</td>
							<td>{{$orderProduct->product_quantity}}</td>
							<td>{{$orderProduct->created_at}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section>

@endsection
<?php 
Session::forget('grand_total');
Session::forget('order_id');
?>