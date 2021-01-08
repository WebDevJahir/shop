@extends('layouts.frontendLayout.master')
@section('content')
	<section id="cart_items">
		<div class="container">
			@if(Session::has('flash_message_error'))
      		<div class="alert alert-danger alert-block">
          		<button type="button" class="close" data-dismiss="alert">x</button>
            	<strong>{{session('flash_message_error')}}</strong>
      		</div>
     		 @endif
			<form action="{{url('/checkout')}}" method="post">
				@csrf
					<div class="col-sm-4 col-sm-offset-1">
						<div class="login-form">
							<h2>Bill To</h2>
								<div class="form-group">
									<input type="text" value="{{$userDetails->name}}" id="billing_name" name="billing_name" placeholder="Billing Name" class="form-control" >
								</div>
								<div class="form-group">
									<input type="text" value="{{$userDetails->address}}" id="billing_address" name="billing_address" placeholder="Billing Address" class="form-control">
								</div>
								<div class="form-group">
									<input type="text" value="{{$userDetails->city}}" id="billing_city" name="billing_city" placeholder="Billing City" class="form-control">
								</div>
								<div class="form-group">
									<input type="text" value="{{$userDetails->state}}" id="billing_state" name="billing_state" placeholder="Billing State" class="form-control">
								</div>
								<select id="billing_country" name="billing_country"  class="form-group" class="dropdown-menu">
								<option value="">Select Country</option>
								@foreach($country as $country)
								<option class="dropdown-item" value="{{$country->country_name}}" @if($userDetails->country == $country->country_name) selected @endif>{{$country->country_name}}</option>
								@endforeach
							</select>
								<div class="form-group">
									<input type="text" value="{{$userDetails->pincode}}" id="billing_pincode" name="billing_pincode" placeholder="Billing Pincode" class="form-control">
								</div>
								<div class="form-group">
									<input type="text" value="{{$userDetails->mobile}}" id="billing_mobile" name="billing_mobile" placeholder="Billing Mobile" class="form-control">
								</div>
								<div class="form-check">
									<input type="checkbox" class="form-check-input" id="billtoship"> 
									 <label class="form-check-label" for="billtoship">Shipping Adress same as Billing Address</label>
								</div>
							</div>
						</div>
							<div class="col-sm-4">
								<div class="signup-form">
								<h2>Ship To</h2>
								<div class="form-group">
									<input type="text" name="shipping_name" id="shipping_name" placeholder="Billing Name" class="form-control">
								</div>
								<div class="form-group">
									<input type="text" name="shipping_address" id="shipping_address" placeholder="Billing Address" class="form-control">
								</div>
								<div class="form-group">
									<input type="text" name="shipping_city" id="shipping_city" placeholder="Billing City" class="form-control">
								</div>
								<div class="form-group">
									<input type="text" name="shipping_state" id="shipping_state" placeholder="Billing State" class="form-control">
								</div>
								<select id="shipping_country" name="shipping_country"  class="form-group" class="dropdown-menu">
								<option value="">Select Country</option>
								@foreach($countries as $country)
								<option class="dropdown-item" value="{{$country->country_name}}">{{$country->country_name}}</option>
								@endforeach
							 	</select>
								<div class="form-group">
									<input type="text" name="shipping_pincode" id="shipping_pincode" placeholder="Billing Pincode" class="form-control">
								</div>
								<div class="form-group">
									<input type="text" name="shipping_mobile" id="shipping_mobile" placeholder="Billing Mobile" class="form-control">
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-large btn-primary">Check Out</button>
								</div>
							    </div>
								</div>
							</form>
							</div>
						</div>
					</div>					
				</div>
			</div>
		</div>
	</section> <!--/#cart_items-->

@endsection