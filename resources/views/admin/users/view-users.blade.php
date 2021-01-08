@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Users</a> <a href="#" class="current">Users Table</a> </div>
            @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ session('flash_message_success') }}  </strong>
        </div>
        @endif  
    <h1>Users</h1>
  </div>
  <div class="container-fluid">
    <hr>
     <div>
    <a href="{{url('admin/export-users')}}" class="btn-primary btn-mini">Export</a>
    </div>
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
                  <th>User ID</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Country</th>
                  <th>Pincode</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Registered On</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr class="gradeX">
                  <td>{{$user->id}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->address}}</td>
                  <td>{{$user->city}}</td> 
                  <td>{{$user->state}}</td> 
                  <td>{{$user->country}}</td>
                  <td>{{$user->pincode}}</td>
                  <td>{{$user->mobile}}</td>
                  <td>{{$user->email}}</td>
                  <td>@if($user->status == '1')
                   		<span style="color: green"> Active </span> 
               		  @else 
           				<span style="color: red"> Not Active </span>
           				@endif
           			</td>
                  <td>{{$user->created_at}}</td>
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