<!--/header-->
@extends('layouts.frontendLayout.master')
@section('content')	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							@foreach($banners as $key => $banner)
							<li data-target="#slider-carousel" data-slide-to="0" @if($key==0) class="active" @endif></li>
							@endforeach
						</ol>
						
						<div class="carousel-inner">
							@foreach($banners as $key => $banner)
							<div class="item @if($key==0) active @endif">
								
									<a href="{{$banner->link}}" title="{{$banner->title}}"><img src="{{asset('images/fronted_image/banners/'.$banner->image)}}"></a>
							</div>
							@endforeach
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section>
	<section>
		<div class="container">
			<div class="row">
				@include('layouts.frontendLayout.frontend_sidebar')
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						@foreach($allProduct as $singleProduct)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{asset('images/backend_image/products/small/'.$singleProduct->image)}}" alt="" />
											<h2>TK {{ $singleProduct->price }}</h2>
											<p>{{$singleProduct->product_name}}</p>
											<a href="{{url('/product/'.$singleProduct->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View Details</a>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>
						@endforeach	
						<div class="text-center" style="clear: both;">
						{{$allProduct->links()}}
						<div>				
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
	

@endsection