@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Product Attributes</a> <a href="#" class="current">Add Product Attributes</a> </div>
    <h1>Add Product Attributes</h1>
    @if(Session::has('flash_message_success'))
      <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{session('flash_message_success')}}</strong>
      </div>
      @endif
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Add Product Attributes</h5>
            </div>
            <div class="widget-content nopadding">
              <form class="form-horizontal" method="post" action="{{url('admin/add-images/'.$product->id)}}" name="add_product" enctype='multipart/form-data'>
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <div class="control-group">
                  <label class="control-label">Product Name</label>
                  <label class="control-label"><strong>{{$product->product_name}}</strong></label>
                </div>
                <div class="control-group">
                  <label class="control-label">Product Code</label>
                  <label class="control-label"><strong>{{$product->product_code}}</strong></label>
                </div>
                <div class="control-group">
                  <label class="control-label">Product Color</label>
                  <label class="control-label"><strong>{{$product->product_color}}</strong></label>
                </div>
                <div class="control-group">
                  <label class="control-label">Product Images</label>
                 	<input type="file" name="image[]" multiple="multiple" id="image">
                </div>
              </div>
                <div class="form-actions">
                  <input type="submit" value="Add Images" class="btn btn-success">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
        <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Product Images</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Image ID</th>
                  <th>Product</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($product['images'] as $images)
                <tr class="gradeX">
                  <td>{{$images['id']}}</td>
                  <td>{{$images['product_id']}}</td>
                  <td><img src="{{asset('images/backend_image/products/small/'.$images->image)}}" style="height: 80px; width: 80px;"></td>
                  <td class="center">
                    <a rel="{{$images->id}}" rel1="delete-images" <?php /* href="{{url('/admin/delete-product/'.$products['id'])}}" */ ?> href="javascript:" class="btn btn-danger btn-mini deleteImages">Delete</td>
                </tr>
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