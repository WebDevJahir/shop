@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Admin</a> <a href="#" class="current">Update Admin</a> </div>
    <h1>Update Admin</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Update Admin</h5>
            </div>
            <div class="widget-content nopadding">
              <form class="form-horizontal" method="post" action="{{url('/admin/edit-admin/'.$admin->id)}}" name="add_category" id="add_category" novalidate="novalidate">
                @csrf
                <div class="control-group">
                  <label class="control-label">Type</label>
                  <div class="controls">
                    <select name="type" id="type" style="width: 28%;">
                    <option value="Sub Admin" @if($admin->type=='Sub Admin') selected @endif>Sub Admin</option>                    
                      <option value="Admin" @if($admin->type=='Admin') selected @endif>Admin</option>\
                    </select>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Username</label>
                  <div class="controls">
                    <input type="text" name="username" id="username" value="{{$admin->username}}" />
                  </div>
                  <div class="control-group">
                  <label class="control-label">Password</label>
                  <div class="controls">
                    <?php $password = bcrypt($admin->password) ?>
                    <input type="text" name="password" id="password" value="{{$password}}" />
                  </div>
                <div id="access">
                <div class="control-group">
                  <label class="control-label">Categories View Access</label>
                  <div class="controls">
                    <input type="checkbox" name="categories_view_access" id="categories_access" @if($admin->categories_view_access == '1') checked @endif value="1" />
                  </div>
                  <label class="control-label">Categories Edit  Access</label>
                  <div class="controls">
                    <input type="checkbox" name="categories_edit_access" id="categories_access" @if($admin->categories_edit_access == '1') checked @endif value="1" />
                  </div>
                  <label class="control-label">Categories Full Access</label>
                  <div class="controls">
                    <input type="checkbox" name="categories_full_access" id="categories_full_access" @if($admin->categories_full_access == '1') checked @endif value="1" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Product Access</label>
                  <div class="controls">
                    <input type="checkbox" name="products_access" id="products_access"  @if($admin->products_access == '1') checked @endif value="1" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Order Access</label>
                  <div class="controls">
                    <input type="checkbox" name="orders_access" id="orders_access"  @if($admin->orders_access == '1') checked @endif value="1" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Users Access</label>
                  <div class="controls">
                    <input type="checkbox" name="users_access" id="users_access"  @if($admin->users_access == '1') checked @endif value="1" />
                  </div>
                </div>
              </div>
                 <div class="control-group">
                  <label class="control-label">Enable</label>
                  <div class="controls">
                    <input type="checkbox" name="status" id="status" @if($admin->status == '1') checked @endif value="1" />
                  </div>
                </div>
                <div class="form-actions">
                  <input type="submit" value="Update admin" class="btn btn-success">
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