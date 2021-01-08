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
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
<!-- 	Start of Different Method
				this different method to show category and sub category						
							<div class="panel panel-default">
								<?php  $category_all; ?>
							</div> 

		End of Different Method				-->


							<div class="panel panel-default">
								@foreach($category_all as $cat)
								@if($cat->status=='1')
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#{{$cat->id}}">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											{{$cat->category_name}}
										</a>
									</h4>
								</div>
								<div id="{{$cat->id}}" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											@foreach($cat['categories'] as $sub_cat)
											@if($sub_cat->status=='1')
											<li><a href="{{url('products/'.$sub_cat->url)}}">
											{{$sub_cat->category_name}}</a></li>
											@endif
											@endforeach
										</ul>
									</div>
								</div>
								@endif
								@endforeach
							</div>
						</div><!--/category-products-->
		<div class="panel-group category-products">
		<form action="{{url('products/filter')}}" method="post">
				@csrf
				<?php if(!empty($url)){ ?>
				<input type="hidden" name="url" value="{{$url}}">
				<?php } ?>
				<h2>Color</h2>
				<div class="panel-group">
					@foreach($colorArr as $color)
						@if(!empty($_GET['color']))
						<?php $colorArray = explode('-', $_GET['color']); ?>
						@if(in_array($color,$colorArray))
							<?php $colorCheck = "checked"; ?>
						@else
							<?php $colorCheck="" ;?>
						@endif
						@else
						<?php $colorCheck = ""; ?>
						@endif
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<input type="checkbox" onchange="javascript:this.form.submit();" id="{{$color}}" name="colorFilter[]" value="{{$color}}" {{$colorCheck}}>&nbsp;&nbsp;<span class="category-products">{{$color}}</span>
								</h4>
							</div>
						</div>
					@endforeach
				</div>
</div>
	<div class="panel-group category-products">
			<h2>Sleeve</h2>
				<div class="panel-group">
					@foreach($sleeveArray as $sleeve)
						@if(!empty($_GET['sleeve']))
						<?php $sleeveArr = explode('_', $_GET['sleeve']); ?>
						@if(in_array($sleeve,$sleeveArr))
							<?php $sleeveCheck = "checked"; ?>
						@else
							<?php $sleeveCheck = "" ;?>
						@endif
						@else
						<?php $sleeveCheck = ""; ?>
						@endif
						@if(!empty($sleeve))
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<input type="checkbox" onchange="javascript:this.form.submit();" id="{{$sleeve}}" name="sleeveFilter[]" value="{{$sleeve}}" {{$sleeveCheck}}>&nbsp;&nbsp;<span class="category-products">{{$sleeve}}</span>
								</h4>
							</div>
						</div>
						@endif
					@endforeach
				</div>	
		</div>
<div class="panel-group category-products">
			<h2>Pattern</h2>
				<div class="panel-group">
					@foreach($patternArray as $pattern)
						@if(!empty($_GET['pattern']))
						<?php $patternArr = explode('-', $_GET['pattern']); ?>
						@if(in_array($pattern,$patternArr))
							<?php $patternCheck = "checked"; ?>
						@else
							<?php $patternCheck = "" ;?>
						@endif
						@else
						<?php $patternCheck = ""; ?>
						@endif
						@if(!empty($pattern))
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<input type="checkbox" onchange="javascript:this.form.submit();" id="{{$pattern}}" name="patternFilter[]" value="{{$pattern}}" {{$patternCheck}}>&nbsp;&nbsp;<span class="category-products">{{$pattern}}</span>
								</h4>
							</div>
						</div>
						@endif
					@endforeach
				</div>	
		</div>
	<div class="panel-group category-products">
			<h2>Size</h2>
				<div class="panel-group">
					@foreach($sizeArray as $size)
						@if(!empty($_GET['size']))
						<?php $sizeArr = explode('-', $_GET['size']); ?>
						@if(in_array($size,$sizeArr))
							<?php $sizeChecked = "checked"; ?>
						@else
							<?php $sizeChecked = "" ;?>
						@endif
						@else
						<?php $sizeChecked = ""; ?>
						@endif
						@if(!empty($size))
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<input type="checkbox" onchange="javascript:this.form.submit();" id="{{$size}}" name="sizeFilter[]" value="{{$size}}" {{$sizeChecked}}>&nbsp;&nbsp;<span class="category-products">{{$size}}</span>
								</h4>
							</div>
						</div>
						@endif
					@endforeach
				</div>
			</div>
		</form>	
</div>
</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">
							@if(!empty($search_product))
								{{$search_product}} Item
							@else
							{{$category->category_name}} Item
							@endif
						</h2>
						<div align="left"><?php echo $breadcrumb; ?> </div>
						<div>&nbsp;</div>
						@foreach($product_all as $listingProduct)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{asset('images/backend_image/products/small/'.$listingProduct->image)}}" alt="" />
											<h2>TK {{$listingProduct->price}}</h2>
											<p>{{$listingProduct->product_name}}</p>
											<a href="{{url('/product/'.$listingProduct->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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
						{{$product_all->links()}}
						<div>	
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
	

@endsection