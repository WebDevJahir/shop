<!--/header-->
@extends('layouts.frontendLayout.master')
@section('content')	
	<section>
		<div class="container">
			<div class="row">
				@include('layouts.frontendLayout.frontend_sidebar')
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">{{$cmsPageDetails->title}}</h2>
						<div class="col-sm-4">
							{{$cmsPageDetails->description}}
						</div>				
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
	

@endsection