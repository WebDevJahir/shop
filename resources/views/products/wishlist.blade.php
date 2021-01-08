@extends('layouts.frontendLayout.master')
@section('content')
<?php use App\Product; ?>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">User Wishlist</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
			@if(Session::has('flash_message_success'))
      		<div class="alert alert-success alert-block">
          		<button type="button" class="close" data-dismiss="alert">x</button>
            	<strong>{{session('flash_message_success')}}</strong>
      		</div>
     		 @endif
     		 @if(Session::has('flash_message_error'))
      		<div class="alert alert-danger alert-block">
          		<button type="button" class="close" data-dismiss="alert">x</button>
            	<strong>{{session('flash_message_error')}}</strong>
      		</div>
     		 @endif
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description">Product Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php $total_amount = 0; ?>
						@foreach($wishpro as $wishproduct)
						<tr>
							<td class="cart_product">
								<a href=""><img width="100px" src="{{asset('images/backend_image/products/small/'.$wishproduct->image)}}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$wishproduct->product_name}}</a></h4>
								<p>Product SKU: {{$wishproduct->product_code}} -- Product Size: {{$wishproduct->size}}</p>
							</td>
							<td class="cart_price">
								<?php $product_price = Product::getProductPrice($wishproduct->product_id,$wishproduct->size); ?>
								<p>TK {{$product_price}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href="{{url('/cart/update-quantity/'.$wishproduct->id.'/1')}}"> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$wishproduct->quantity}}" autocomplete="off" size="2">
									<a class="cart_quantity_down" href="{{url('/cart/update-quantity/'.$wishproduct->id.'/-1')}}"> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">TK {{$product_price*$wishproduct->quantity}}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{url('/wishlist/delete-product/'.$wishproduct->id)}}"><i class="fa fa-times"></i></a>
							</td>
							<td>
							<a href="{{url('addtocart/'.$wishproduct->id)}}" id="cartButton" class="btn btn-fefault cart" value="Add to Cart" style="margin-left: 0px;">
							<i class="fa fa-shopping-cart"></i>
										Add to cart
							</a>
						</td>
						</tr>
						<?php $total_amount = $total_amount + ($product_price*$wishproduct->quantity) ;?>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->



@endsection