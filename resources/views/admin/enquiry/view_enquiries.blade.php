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
                  <th>Enquiry ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($allEnquiries as $enquiry)
                <tr class="gradeX">
                  <td>{{$enquiry['id']}}</td>
                  <td>{{$enquiry['name']}}</td>
                  <td>{{$enquiry['email']}}</td>
                  <td>{{$enquiry['subject']}}</td>
                  <td>{{$enquiry['message']}}</td>
                  <td class="center"><a href="{{url('/admin/reply-enquiry/'.$enquiry['id'])}}" class="btn btn-primary btn-mini">Reply</a>
                    ||<a rel="{{$enquiry->id}}" rel1="delete-enquiry" <?php /* href="{{url('/admin/delete-product/'.$products['id'])}}" */ ?> href="javascript:" class="btn btn-danger btn-mini deleteCategory" >Delete </a>
         			</td>
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