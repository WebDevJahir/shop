@extends('layouts.frontendLayout.master')
@section('content')	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				@if(Session::has('flash_message_error'))
      					<div class="alert alert-danger alert-block">
          					<button type="button" class="close" data-dismiss="alert">x</button>
            				<strong>{{session('flash_message_error')}}</strong>
      					</div>
      					@endif
      			@if(Session::has('flash_message_success'))
      					<div class="alert alert-success alert-block">
          					<button type="button" class="close" data-dismiss="alert">x</button>
            				<strong>{{session('flash_message_success')}}</strong>
      					</div>
      					@endif
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form">
						<h2>Update Account</h2>
						<form id="accountForm" name="accountForm" action="{{url('/account')}}" method="post">
							@csrf
							<input value="{{$userDetails->name}}" type="text" name="name" id="name" placeholder="Name" required>
							<input value="{{$userDetails->address}}" type="text" name="address" id="address" placeholder="Address" required>
							<input value="{{$userDetails->city}}" type="text" name="city" id="city" placeholder="City" required>
							<input value="{{$userDetails->state}}" type="text" name="state" id="state" placeholder="State" required>
							<select id="country" name="country" required>
								<option value="">Select Country</option>
								@foreach($countries as $country)
								<option value="{{$country->country_name}}" @if($userDetails->country == $country->country_name) selected @endif>{{$country->country_name}}</option>
								@endforeach
							</select>
							<input value="{{$userDetails->pincode}}" style="margin-top:10px" type="text" name="pincode" id="pincode" placeholder="Pincode" required>
							<input value="{{$userDetails->mobile}}" type="text" name="mobile" id="mobile" placeholder="Mobile" required>
							<button type="submit" class="btn btn-default">Update</button>
						</form>
					</div>     <!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4"><!--sign up form-->
					<div class="login-form">
						<h2>Update Password</h2>
					<form id="passwordForm" name="passwordForm" action="{{url('/update-user-password')}}" method="post">
						@csrf
						<input type="password" name="current_password" id="current_password" placeholder="Current Password">
						<h6 id="check"></h6>
						<input type="password" name="new_password" id="new_password" placeholder="New Password">
						<input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
						<button type="submit">Update</button>
					</form>
				</div>
			</div>
			</div>
		</div>
	</section><!--/form-->
	
@endsection
