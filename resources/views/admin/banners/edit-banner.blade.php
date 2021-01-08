@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Banner</a> <a href="#" class="current">Update Banner</a> </div>
    <h1>Update Banner</h1>
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
              <h5>Update Banner</h5>
            </div>
            <div class="widget-content nopadding">
              <form class="form-horizontal" method="post" action="{{url('/admin/edit-banner/'.$editBanner->id)}}" name="add_banner" id="add_banner" novalidate="novalidate" enctype='multipart/form-data'>
                @csrf
                <div class="control-group">
                  <label class="control-label">Bannner title</label>
                  <div class="controls">
                    <input type="text" name="title" id="title" value="{{$editBanner->title}}" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Link</label>
                  <div class="controls">
                    <input type="text" name="link" id="link" value="{{$editBanner->link}}" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Image</label>
                  <div class="controls">
                    <input type="file" name="image" id="image" /><img height="80px" width="80px" src="{{asset('images/backend_image/banners/'.$editBanner->image)}}">
                  </div>
                </div>
                <div class="control-group">
                   <label class="control-label">Enable</label>
                  <div class="controls">
                    <input type="checkbox" @if($editBanner->status==1) checked @endif name="status" id="status" value="1" />
                  </div>
                </div>
                <div class="form-actions">
                  <input type="submit" value="update Banner" class="btn btn-success">
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