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
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Add Product Attributes</h5>
            </div>
            <div class="widget-content nopadding">
              <form class="form-horizontal" method="post" action="{{url('admin/add-attributes/'.$product->id)}}" name="add_product" enctype='multipart/form-data'>
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
                  <label class="control-label">Product Attributes</label>
                  <div class="field_wrapper">
                    <div>
                        <input type="text" required name="sku[]" placeholder="SKU" style="width:120px;" />
                        <input type="text" required name="size[]" placeholder="Size" style="width:120px;" />
                        <input type="text" required name="price[]" placeholder="Price" style="width:120px;" />
                        <input type="text" required name="stock[]" placeholder="stock" style="width:120px;" />
                        <a href="javascript:void(0);" class="add_button" title="Add field">Add </a>
                    </div>
                </div>
              </div>
                <div class="form-actions">
                  <input type="submit" value="Add Attribute" class="btn btn-success">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data table</h5>
          </div>
          <div class="widget-content nopadding">
          <form action="{{url('/admin/edit-attributes/'.$product->id)}}" method="post">
            @csrf
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Product ID</th>
                  <th>SKU</th>
                  <th>Size</th>
                  <th>Price</th>
                  <th>Stock</th>>
                </tr>
              </thead>
              <tbody>
                @foreach($product['attributes'] as $attributes)
                <tr class="gradeX">
                  <td><input type="hidden" name="idAttr[]" value="{{$attributes->id}}">{{$attributes['product_id']}}</td>
                  <td>{{$attributes['sku']}}</td>
                  <td>{{$attributes['size']}}</td>
                  <td><input type="text" name="price[]" value="{{$attributes['price']}}">
                  <td><input type="text" name="stock[]" value="{{$attributes['stock']}}">
                  <td class="center">
                    <input type="submit" value="Update Attribute" class="btn btn-success btn-mini">
                    <a rel="{{$attributes->id}}" rel1="delete-attributes" <?php /* href="{{url('/admin/delete-product/'.$products['id'])}}" */ ?> href="javascript:" class="btn btn-danger btn-mini deleteAttributes">Delete</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection