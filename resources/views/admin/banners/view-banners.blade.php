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
                  <th>Banner ID</th>
                  <th>Banner Title</th>
                  <th>Banner Link</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($allBanner as $allBanners)
                <tr class="gradeX">
                  <td>{{$allBanners['id']}}</td>
                  <td>{{$allBanners['title']}}</td>
                  <td>{{$allBanners['link']}}</td>
                  <td>
                  	@if(!empty($allBanners->image))
                  <img src="{{asset('/images/backend_image/banners/'.$allBanners['image'])}}" style="width:400px; height: 100px;"/>
                   @endif </td>
                 
                  
                  <td class="center">
                    <a href="{{url('/admin/edit-banner/'.$allBanners['id'])}}" class="btn btn-primary btn-mini">Edit</a>|
                    <a rel="{{$allBanners->id}}" rel1="delete-banner" <?php /* href="{{url('/admin/delete-product/'.$products['id'])}}" */ ?> href="javascript:" class="btn btn-danger btn-mini deleteBanner">Delete</td>
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