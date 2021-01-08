@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> CMS Page</a> <a href="#" class="current">Add CMS Page</a> </div>
    <h1>Add Product</h1>
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
              <h5>Add CMS page</h5>
            </div>
            <div class="widget-content nopadding">
              <form class="form-horizontal" method="post" action="{{url('/admin/add-cms-page')}}" name="add_page" id="add_page" novalidate="novalidate" enctype='multipart/form-data'>
                @csrf
                <div class="control-group">
                  <label class="control-label">Page Title</label>
                  <div class="controls">
                    <input type="text" name="title" id="title" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Url</label>
                  <div class="controls">
                    <input type="text" name="url" id="url" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Description</label>
                  <div class="controls">
                    <textarea type="text" name="description" id="description"></textarea>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Meta Title</label>
                  <div class="controls">
                    <input type="text" name="meta_title" id="meta_title" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Meta Description</label>
                  <div class="controls">
                    <input type="text" name="meta_description" id="meta_description" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Meta Keywords</label>
                  <div class="controls">
                    <input type="text" name="meta_keywords" id="meta_keywords" />
                  </div>
                </div>
                <div class="control-group">
                   <label class="control-label">Status</label>
                  <div class="controls">
                    <input type="checkbox" name="status" id="status" value="1" />
                  </div>
                </div>              
                <div class="form-actions">
                  <input type="submit" value="Add Page" class="btn btn-success">
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