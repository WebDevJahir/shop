<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Order # {{$orderDetails->id}} <span style="float: "><?php echo DNS10::getBarcodeHTML($ordersDetails->id,"C39"); ?></span></h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
	    				{{ $userDetails->name }} <br>
	              		{{ $userDetails->address }} <br>
	              		{{ $userDetails->city }} <br>
	              		{{ $userDetails->state }} <br>
	              		{{ $userDetails->country }} <br>
	              		{{ $userDetails->pincode }} <br>
	              		{{ $userDetails->mobile }} <br>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
    					{{ $orderDetails->name }} <br>
		              	{{ $orderDetails->address }} <br>
		              	{{ $orderDetails->city }} <br>
		              	{{ $orderDetails->state }} <br>
		              	{{ $orderDetails->country }} <br>
		              	{{ $orderDetails->pincode }} <br>
		              	{{ $orderDetails->mobile }} <br>
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					{{$orderDetails->payment_method}}<br>
    					{{$orderDetails->user_email}}
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					{{$orderDetails->created_at}}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<th style="width:18%">Product Code</th>
									<th style="width:18%">Size</th>
									<th style="width:18%">Color</th>
									<th style="width:15%">Price</th>
									<th style="width:20%">Quantity</th>
									<th style="width:20%">Total</th>
                                </tr>
    						</thead>
    						<tbody>
    							<?php $Subtotal = 0; ?>
    							@foreach($orderDetails->orders as $orderProduct)
									<tr>
										<td>{{$orderProduct->product_code}}</td>
										<td>{{$orderProduct->product_size}}</td>
										<td>{{$orderProduct->product_color}}</td>
										<td>{{$orderProduct->product_price}}</td>
										<td>{{$orderProduct->product_quantity}}</td>
										<td>{{$total = $orderProduct->product_price * $orderProduct->product_quantity }}</td>
									</tr>	
									<?php $Subtotal = $Subtotal + ($orderProduct->product_price * $orderProduct->product_quantity); ?>								
								@endforeach
									<tr>
										<td class="thick-line"></td>
										<td class="thick-line"></td>
										<td class="thick-line"></td>
										<td class="thick-line"></td>
										<td class="thick-line text-center"><strong>Subtotal</strong></td>
										<td class="thick-line text-center">TK {{ $Subtotal }}</td>
									</tr>
									<tr>
										<td class="thick-line"></td>
										<td class="thick-line"></td>
										<td class="thick-line"></td>
										<td class="thick-line"></td>
										<td class="thick-line text-center"><strong>Shipping Cost(+)</strong></td>
										<td class="thick-line text-center">TK 0</td>
									</tr>
									<tr>
										<td class="thick-line"></td>
										<td class="thick-line"></td>
										<td class="thick-line"></td>
										<td class="thick-line"></td>
										<td class="thick-line text-center"><strong>Coupon Discount(-)</strong></td>
										<td class="thick-line text-center">TK {{$orderDetails->coupon_amount}}</td>
									</tr>
									<tr>
										<td class="thick-line"></td>
										<td class="thick-line"></td>
										<td class="thick-line"></td>
										<td class="thick-line"></td>
										<td class="thick-line text-center"><strong>Grand Total</strong></td>
										<td class="thick-line text-center">TK {{ $grandTotal = $Subtotal - $orderDetails->coupon_amount}}</td>
									</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>