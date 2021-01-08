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
                  <th>Category ID</th>
                  <th>Category Name</th>
                  <th>Category Level</th>
                  <th>URL</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $categories)
                <tr class="gradeX">
                  <td>{{$categories['id']}}</td>
                  <td>{{$categories['category_name']}}</td>
                  <td>{{$categories['parent_id']}}</td>
                  <td>{{$categories['url']}}</td>
                  <td>@if($categories['status']=='1')
                    <?php echo 'Active'; ?>
                  @else
                    <?php echo 'Not Active'; ?>
                  @endif
                  </td>
                  <td class="center"><a href="{{url('/admin/edit-category/'.$categories['id'])}}" class="btn btn-primary btn-mini">Edit</a>
                    @if(Session::get('adminDetails')['categories_edit_access']==1 || Session::get('adminDetails')['categories_full_access']==1 )
                    ||<a rel="{{$categories->id}}" rel1="delete-category" <?php /* href="{{url('/admin/delete-product/'.$products['id'])}}" */ ?> href="javascript:" class="btn btn-danger btn-mini deleteCategory" >Delete </a>
                  @endif</td>
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