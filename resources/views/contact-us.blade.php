<!--/header-->
@extends('layouts.frontendLayout.master')
@section('content')	
	<section>
		<div class="container">
			<div class="row">
				@include('layouts.frontendLayout.frontend_sidebar')
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Contact Us</h2>
						<div class="col-sm-12">
				@if(Session::has('flash_message_success'))
      				<div class="alert alert-success alert-block">
          				<button type="button" class="close" data-dismiss="alert">x</button>
           				<strong>{{session('flash_message_success')}}</strong>
     				</div>
      			@endif
      			@if($errors->any())
      			<div class="alert alert-danger">
      				<ul>
      					@foreach($errors->all() as $error)
      					<li>{{$error}}</li>
      					@endforeach
      				</ul>
      			</div>
      			@endif
	    			<div class="contact-form">
	    				<h2 class="title text-center">Get In Touch</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" action="{{url('/contact')}}" class="contact-form row" name="contact-form" method="post">
				    		@csrf
				            <div class="form-group col-md-6">
				                <input type="text" name="name" class="form-control"  placeholder="Name" required="required">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control"  placeholder="Email" required="required">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control"  placeholder="Subject" required="required">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message"  class="form-control" rows="8" placeholder="Your Message Here" required="required"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
				            </div>
				        </form>
	    			</div>				
					</div><!--features_items-->
				</div>
			
		</div>
	</div>
	</section>
	

@endsection
