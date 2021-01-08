@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Category</a> <a href="#" class="current">Update Category</a> </div>
    <h1>Update Category</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Update Category</h5>
            </div>
            <div class="widget-content nopadding">
              <form class="form-horizontal" method="post" action="{{url('/admin/edit-category/'.$category->id)}}" name="add_category" id="add_category" novalidate="novalidate">
                @csrf
                <div class="control-group">
                  <label class="control-label">Category Name</label>
                  <div class="controls">
                    <input type="text" name="category_name" id="category_name" value="{{$category->category_name}}" />
                  </div>
                  <div class="control-group">
                  <label class="control-label">Category Level</label>
                  <div class="controls">
                    <select name="parent_id" style="width: 220px">
                      <option value="0">Main Category</option>
                      @foreach($parents as $parents)
                      <option value="{{$parents->id}}" @if($parents->id == $category->parent_id) selected @endif>{{$parents->category_name}}</option>
                      @endforeach
                    </select>  
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Description</label>
                  <div class="controls">
                    <input type="text" name="description" id="description" value="{{$category->description}}"/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Url</label>
                  <div class="controls">
                    <input type="text" name="url" id="url" value="{{$category->url}}" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Meta Title</label>
                  <div class="controls">
                    <input type="text" name="meta_title" id="meta_title" value="{{$category->meta_title}}" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Meta Description</label>
                  <div class="controls">
                    <input type="text" name="meta_description" id="meta_description" value="{{$category->meta_description}}"/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Meta Keywords</label>
                  <div class="controls">
                    <input type="text" name="meta_keywords" id="meta_keywords" value="{{$category->meta_keywords}}"/>
                  </div>
                </div>
                 <div class="control-group">
                  <label class="control-label">Enable</label>
                  <div class="controls">
                    <input type="checkbox" name="status" id="status" @if($category->status == '1') checked @endif value="1" />
                  </div>
                </div>
                <div class="form-actions">
                  <input type="submit" value="Update Category" class="btn btn-success">
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