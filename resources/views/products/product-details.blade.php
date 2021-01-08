@extends('layouts.frontendLayout.master')
@section('content')	
<?php use App\Product; ?>
	<section>
		<div class="container">
			<div class="row" >
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
              @include('layouts.frontendLayout.frontend_sidebar')
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
									<a href="{{asset('images/backend_image/products/large/'.$product->image)}}">
										<img class="mainImage" style="width: 300px;" src="{{asset('images/backend_image/products/medium/'.$product->image)}}" alt="" />
									</a>
							    </div>
							</div> 
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
								    	<?php $count=1 ?>
								    	@foreach($productImage->chunk(3) as $productImage)
										<div <?php if($count==1) { ?> class="item active thumbnails" <?php }else{ ?> class="item thumbnails" <?php } ?>>
										@foreach($productImage as $images)
										<a href="{{asset('images/backend_image/products/large/'.$images->image)}}" data-standard="{{asset('images/backend_image/products/small/'.$images->image)}}">
										  <img class="changeImage" src="{{asset('images/backend_image/products/small/'.$images->image)}}" alt="" style="height: 80px; width: 80px; cursor:pointer">
										</a>
										  @endforeach
										</div>
										<?php $count++; ?>
										@endforeach
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<form action="{{url('/add-cart')}}" name="addtocartForm" id="addtocartForm" method="post">
								@csrf
								<input type="hidden" name="product_id" value="{{$product->id}}">
								<input type="hidden" name="product_name" value="{{$product->product_name}}">
								<input type="hidden" name="product_code" value="{{$product->product_code}}">
								<input type="hidden" name="product_color" value="{{$product->product_color}}">
								<input type="hidden" name="price" id="price" value="{{$product->price}}">
							<div class="product-information"><!--/product-information-->
								<?php echo $breadcrumb; ?>
								<img src="{{asset('images/fronted_image/product-details/new.jpg')}}" class="newarrival" alt="" />
								<h2>{{$product->product_name}}</h2>
								<p>Product Code: {{$product->product_code}}</p>
								<p>Product Color: {{$product->product_color}}</p>
								@if(!empty($product->sleeve))
								<p>Product Sleeve: {{$product->sleeve}}</p>
								@endif
								<p>
									<select id="sellSize"  name="size" style="width:150px">
										<option value="">Select Size</option>
										@foreach($product->attributes as $size)
										<option value="{{$product->id}}-{{$size->size}}">{{$size->size}}</option>
										@endforeach
									</select>	
								</p>
								<img src="{{asset('images/fronted_image/product-details/rating.png')}}" alt="" />
								<span>
									<?php $getCurrenciesRates = Product::getCurrencyRates($product->price); ?>
									<span id="getPrice">
										TK {{ $product->price }}<br>
										<h2>
										USD {{ $getCurrenciesRates['USD_Rate'] }}<br>
										EUR {{ $getCurrenciesRates['EUR_Rate'] }}<br>
										GBP {{ $getCurrenciesRates['GBP_Rate'] }}<br>
										</h2>
									</span>
									<label>Quantity:</label>
									<input type="text" name="quantity" value="3" />
									@if($totalStock>0)
									<button type="Submit" id="cartButton" class="btn btn-fefault cart" value="Add to Cart" style="margin-left: 0px;">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
									@endif
								</span>
								<button type="Submit" id="wishButton" name="wishButton" class="btn btn-fefault cart" value="wish list" style="margin-left: 0px;">
										<i class="fa fa-shopping-cart"></i>
										Add to Wishlist
									</button>
								<p><b>Availability:
								</b><span id="Availability">@if($totalStock>0) In Stock
								@else
								Not In Stock
								@endif
								</span>
								<p><b>Condition:</b> New</p>
								<input type="text" name="pincode" id="chkPincode" placeholder="Check Pincode" >
								<button type="button" onclick=" return checkPincode();">Go</button>
								<h6 id="pincodeResponse"></h6>
								<p><b>Brand:</b> E-SHOPPER</p>
								<a>
								<div class="sharethis-inline-share-buttons"></div>
								</a>
							</div><!--/product-information-->
							</form>
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Description</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Marial and Care</a></li>
								<li><a href="#tag" data-toggle="tab">Delivery Option</a></li>
								@if(!empty($product->video))
								<li ><a href="#video" data-toggle="tab">Product Video</a></li>
								@endif
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="details" >
								<p>{{$product->description}}</p>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<p>{{$product->care}}</p>
							</div>
							
							<div class="tab-pane fade" id="tag" >
								
							</div>
							@if(!empty($product->video))
							<div class="tab-pane fade" id="video" >
								<div class="col-sm-12">
									<video controls width="320" height="240">
										<source src="{{url('video/'.$product->video)}}" type="video/mp4">
									</video>
								</div>
							</div>
							@endif
							
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<?php $count=1 ?>
								@foreach($relatedProduct->chunk(3) as $chunk)
								<div <?php if($count == 1){?> class="item active" <?php } else { ?> class="item" <?php } ?> >	
									@foreach($chunk as $item)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{asset('images/backend_image/products/medium/'.$item->image)}}" alt="" />
													<h2>TK {{$item->price}}</h2>
													<p>{{$item->product_name}}</p>
													<a href="{{url('product/'.$item->id)}}">
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button></a>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
								<?php $count++; ?>
								@endforeach
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>
@endsection