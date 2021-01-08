@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Admins</a> <a href="#" class="current">Admins Table</a> </div>
            @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ session('flash_message_success') }}  </strong>
        </div>
        @endif
         @if(Session::has('flash_message_error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ session('flash_message_error') }}  </strong>
        </div>
        @endif   
    <h1>Admins</h1>
  </div>
  <div class="container-fluid">
    <hr>
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
                  <th>ID</th>
                  <th>Username</th>
                  <th>Type</th>
                  <th>Roles</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($allAdmin as $admin)
                 <?php if($admin->type=="Admin"){
                      $roles = "All";                    
                    }else{
                      $roles = "";
                      if($admin->categories_full_access==1){
                        $roles .= "Categories Full, "; 
                      }
                      if($admin->categories_view_access==1){
                        $roles .= "Categories View, "; 
                      }
                      if($admin->categories_edit_access==1){
                        $roles .= "Categories Edit, "; 
                      }
                      if($admin->products_access==1){
                        $roles .= "Products, "; 
                      }
                      if($admin->orders_access==1){
                        $roles .= "Orders, "; 
                      }
                      if($admin->users_access==1){
                        $roles .= "Users"; 
                      }
                    }

                  ?>
                <tr class="gradeX">
                  <td>{{$admin['id']}}</td>
                  <td>{{$admin['username']}}</td>
                  <td>{{$admin['type']}}</td>
                  <td>{{$roles}}</td>
                  <td>@if($admin['status']=='1')
                    <?php echo 'Active'; ?>
                  @else
                    <?php echo 'Not Active'; ?>
                  @endif
                  </td>
                  <td class="center"><a href="{{url('/admin/edit-admin/'.$admin['id'])}}" class="btn btn-primary btn-mini">Edit</a>||<a rel="{{$admin->id}}" rel1="delete-admin" <?php /* href="{{url('/admin/delete-product/'.$products['id'])}}" */ ?> href="javascript:" class="btn btn-danger btn-mini deleteCategory">Delete</td>
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