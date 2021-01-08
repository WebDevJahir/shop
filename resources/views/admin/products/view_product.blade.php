@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Categories</a> <a href="#" class="current">Categories Table</a> </div>
            @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ session('flash_message_success') }}  </strong>
        </div>
        @endif  
    <h1>Categories</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div>
    <a href="{{url('admin/export-products')}}" class="btn-primary btn-mini">Export</a>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data table</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Product ID</th>
                  <th>Category ID</th>
                  <th>Product Name</th>
                  <th>Product Code</th>
                  <th>Product Color</th>
                  <th>Price</th>
                  <th>Image</th>
                  <th>Featured</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($products as $products)
                <tr class="gradeX">
                  <td>{{$products['id']}}</td>
                  <td>{{$products['category_name']}}</td>
                  <td>{{$products['product_name']}}</td>
                  <td>{{$products['product_code']}}</td>
                  <td>{{$products['product_color']}}</td>
                  <td>TK {{$products['price']}}</td>
                  <td>
                  	@if(!empty($products->image))
                  <img src="{{asset('/images/backend_image/products/small/'.$products['image'])}}" style="width:70px;height: 70px">
                   @endif </td>
                  <td>@if($products['feature_item']==1) Yes @else No @endif</td>
                  <td class="center">
                    <a href="#myModal{{$products['id']}}" data-toggle="modal" class="btn btn-success btn-mini">View</a>|
                    <a href="{{url('/admin/edit-product/'.$products['id'])}}" class="btn btn-primary btn-mini">Edit</a>|
                    <a href="{{url('/admin/add-attributes/'.$products['id'])}}" class="btn btn-success btn-mini">Add Attr</a>|
                    <a href="{{url('/admin/add-images/'.$products['id'])}}" class="btn btn-primary btn-mini">Add images</a>|
                    <a rel="{{$products->id}}" rel1="delete-product" <?php /* href="{{url('/admin/delete-product/'.$products['id'])}}" */ ?> href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</td>
                </tr>
                <div id="myModal{{$products['id']}}" class="modal hide">
                	<div class="modal-header">
                		<button data-dismiss="modal" class="close" type="button">x</button>
                		<h3> Product Name Full Details</h3>
                		<p>Product Id: {{$products->id}}</p>
                		<p>Category name : {{$products->category_name}}</p>
                		<p>Product Name: {{$products->product_name}}</p>
                		<p>Product Code: {{$products->product_code}}</p>
                		<p>Product Color: {{$products->product_color}}</p>
                		<p>Product Description: {{$products->description}}</p>
                    <p>Product Care: {{$products->care}}</p>

                		<p>Product Price:{{$products->price}}</p>
                	</div>
                </div>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection