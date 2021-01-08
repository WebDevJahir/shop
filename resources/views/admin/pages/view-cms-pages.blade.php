@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>CMS Pages</a> <a href="#" class="current">Categories Table</a> </div>
            @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ session('flash_message_success') }}  </strong>
        </div>
        @endif  
    <h1>CMS Pages</h1>
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
                  <th>Id</th>
                  <th>Page Title</th>
                  <th>Url</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($pages as $page)
                <tr class="gradeX">
                  <td>{{$page['id']}}</td>
                  <td>{{$page['title']}}</td>
                  <td>{{$page['url']}}</td>
                  <td>{{$page['description']}}</td>
                  <td>@if($page['status'] == 1) Active @else Not Active @endif</td>
                  <td><a href="{{url('admin/edit-cms-page/'.$page['id'])}}" class="btn-primary btn-small m-3" style="margin-right: 5px;">Edit</a>||<a rel="{{$page->id}}" rel1="delete-page" <?php /* href="{{url('/admin/delete-product/'.$products['id'])}}" */ ?> href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</td></td>
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