@extends('layouts.frontendLayout.master')
@section('content')
<?php use App\Product; ?>
	<section id="cart_items">
		<div class="container">
			<div class="row">
			@if(Session::has('flash_message_error'))
      		<div class="alert alert-danger alert-block">
          		<button type="button" class="close" data-dismiss="alert">x</button>
            	<strong>{{session('flash_message_error')}}</strong>
      		</div>
     		 @endif
					<div class="col-sm-4 clearfix">
						<div class="login-form">
							<h2>Bill To</h2>
								<div class="form-group">
									{{$userDetails->name}}
								</div>
								<div class="form-group">
									{{$userDetails->address}}
								</div>
								<div class="form-group">
									{{$userDetails->city}}
								</div>
								<div class="form-group">
									{{$userDetails->state}}
								</div>
								<div class="form-group">
									{{$userDetails->country}}
								</div>
								<div class="form-group">
									{{$userDetails->pincode}}
								</div>
								<div class="form-group">
									{{$userDetails->mobile}}
								</div>
							</div>
						</div>
						<div class="col-sm-4 clearfix">
								<div class="signup-form">
								<h2>Ship To</h2>
								<div class="form-group">
									{{$shippingDetails->name}}
								</div>
								<div class="form-group">
									{{$shippingDetails->address}}
								</div>
								<div class="form-group">
									{{$shippingDetails->city}}
								</div>
								<div class="form-group">
									{{$shippingDetails->state}}
								</div>
								<div class="form-group">
									{{$shippingDetails->country}}
								</div>
								<div class="form-group">
									{{$shippingDetails->pincode}}
								</div>
								<div class="form-group">
									{{$shippingDetails->mobile}}
								</div>
							    </div>
							</div>
						</div>
										<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
										<tbody>
						<?php $total_amount = 0; ?>
						@foreach($userCart as $cartItem)
						<tr>
							<td class="cart_product">
								<a href=""><img width="100px" src="{{asset('images/backend_image/products/small/'.$cartItem->image)}}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$cartItem->product_name}}</a></h4>
								<p>Product SKU: {{$cartItem->product_code}} -- Product Size: {{$cartItem->size}}</p>
							</td>
							<td class="cart_price">
								<p>TK {{$cartItem->price}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href="{{url('/cart/update-quantity/'.$cartItem->id.'/1')}}"> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$cartItem->quantity}}" autocomplete="off" size="2">
									<a class="cart_quantity_down" href="{{url('/cart/update-quantity/'.$cartItem->id.'/-1')}}"> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">TK {{$cartItem->price*$cartItem->quantity}}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{url('/cart/delete-product/'.$cartItem->id)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php $total_amount = $total_amount + ($cartItem->price*$cartItem->quantity) ;?>
						@endforeach
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
								<tr>
									<td>Cart Sub Total</td>
									<td>TK {{$total_amount}}</td>
								</tr>
								<tr class="shipping-cost">
									<td>Shipping Cost</td>
									<td>{{$shippingCharge}}</td>
								</tr>
								<tr class="shipping-cost">
									<td>Discount Amount</td>
									<td>@if(!empty(Session::get('CouponAmount')))
									TK {{Session::get('CouponAmount')}}
									@else
									TK 0
									@endif
									</td>
								</tr>
								<tr>
									<?php $grand_total = $total_amount + $shippingCharge -Session::get('CouponAmount'); ?>
									<?php $getCurrencyRates  = Product::getCurrencyRates($total_amount); ?>
									<td>Grand Total</td>
									<td><span type="button" class="btn-secondary" data-toggle="tooltip" data-html="true" title="
									USD {{ $getCurrencyRates['USD_Rate'] }}<br>
									EUR {{ $getCurrencyRates['EUR_Rate'] }}<br>
									GBP {{ $getCurrencyRates['GBP_Rate'] }}
									">TK 
									{{$grand_total}}</span></td>
								</tr>
							</table>
							</td>
						</tr>
					</tbody>

				</table>
			</div>
			<form name="paymentForm" id="paymentForm" action="{{url('/place-order')}}" method="post">
				@csrf
				<input type="hidden" name="grand_total" value="{{$grand_total}}">
				<div class="payment-options">
					<span>
						<label><strong>Select Payment Method:</strong></label>
					</span>
					<span>
						<label><input type="radio" name="payment_method" id="COD" value="COD"> <strong>COD</strong></label>
					</span>
					<span>
						<label><input type="radio" name="payment_method" id="Paypal" value="Paypal"><strong>Paypal</strong></label>
					</span>
					<span>
						<label><input type="radio" name="payment_method" id="Payumoney" value="PayUmoney"><strong>Payumoney</strong></label>
					</span>
					<span style="float: right;">
						<button type="Submit" class="btn btn-default" onclick="return selectPaymentMethod();">Place Order</button>
					</span>
				</div>
			</form>
		</div>
	</section> <!--/#cart_items-->

	
						</div>
					</div>					
				</div>
			</div>
		</div>
	</section> <!--/#cart_items-->

@endsection