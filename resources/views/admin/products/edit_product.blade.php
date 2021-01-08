@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Product</a> <a href="#" class="current">Edit Product</a> </div>
    <h1>Edit Product</h1>
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
              <h5>Edit Product</h5>
            </div>
            <div class="widget-content nopadding">
              <form class="form-horizontal" method="post" action="{{url('/admin/edit-product/'.$product->id)}}" name="add_product" id="edit_product" novalidate="novalidate" enctype='multipart/form-data'>
                @csrf
                  <div class="control-group">
                  <label class="control-label">Category level</label>
                  <div class="controls">
                    <select name="category_id" style="width: 220px">
                      <?php echo $categories_dropdown; ?>
                    </select>  
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Product Name</label>
                  <div class="controls">
                    <input type="text" name="product_name" id="product_name" value="{{$product->product_name}}" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Product Code</label>
                  <div class="controls">
                    <input type="text" name="product_code" id="product_code" value="{{$product->product_code}}"/>
                  </div>
                </div>
                 <div class="control-group">
                  <label class="control-label">Product Color</label>
                  <div class="controls">
                    <input type="text" name="product_color" id="product_color" value="{{$product->product_color}}"/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Description</label>
                  <div class="controls">
                    <textarea type="text" name="description" id="description">{{$product->description}}</textarea>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Material and Care</label>
                  <div class="controls">
                    <textarea type="text" name="care" id="care">{{$product->care}}</textarea>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Price</label>
                  <div class="controls">
                    <input type="text" name="price" id="price" value="{{$product->price}}"/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Select Sleeve</label>
                  <div class="controls">
                    <select name="sleeve" style="width: 220px">
                      @foreach($sleeveArray as $sleeve)
                      <option @if($product->sleeve == $sleeve) selected="selected" @endif value="{{$sleeve}}">{{$sleeve}}</option>
                      @endforeach
                    </select>  
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Select Pattern</label>
                  <div class="controls">
                    <select name="pattern" style="width: 220px">
                      @foreach($patternArray as $pattern)
                      <option @if($product->pattern == $pattern) selected="selected" @endif value="{{$pattern}}">{{$pattern}}</option>
                      @endforeach
                    </select>  
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Image</label>
                  <div class="controls">
                    <input type="file" name="image" id="image" />
                    <input type="hidden" name="current_image" id="image" value="{{$product->image}}">
                    <img src="{{asset('/images/backend_image/products/small/'.$product->image)}}" style="width: 40px"> || <a href="{{url('/admin/delete-product-image/'.$product->id)}}">Delete</a>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Video</label>
                  <div class="controls">
                    <input type="file" name="video" id="video" />
                    <input type="hidden" name="current_video" id="video" value="{{$product->video}}">
                    @if(!empty($product->video))
                    <a target="_blank" href="{{url('video/'.$product->video)}}">View</a> || <a href="{{url('/admin/delete-product-video/'.$product->id)}}">Delete</a>
                    @endif
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Weight(g)</label>
                  <div class="controls">
                    <input type="text" name="weight" id="weight" value="{{$product->weight}}"/>
                  </div>
                </div>
                <div class="control-group">
                   <label class="control-label">Enable</label>
                  <div class="controls">
                    <input type="checkbox" <?php if($product->status == 1){?> checked <?php } ?> name="status" id="status" value="1" />
                  </div>
                </div>
                <div class="control-group">
                   <label class="control-label">Featured Item</label>
                  <div class="controls">
                    <input type="checkbox" <?php if($product->feature_item == 1){?> checked <?php } ?> name="feature_item" id="feature_item" value="1" />
                  </div>
                </div>
                <div class="form-actions">
                  <input type="submit" value="Update Product" class="btn btn-success">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection