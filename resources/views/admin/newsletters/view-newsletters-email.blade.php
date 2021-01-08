@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Subscribed Email</a> <a href="#" class="current">Subscribed Email Table</a> </div>
            @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ session('flash_message_success') }}  </strong>
        </div>
        @endif  
    <h1>Subscribed Emails</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div>
    <a href="{{url('admin/export-newsletters-email')}}" class="btn-primary btn-mini">Export</a>
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
                  <th>Subcriber ID</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($newsletters as $newsletter)
                <tr class="gradeX">
                  <td>{{$newsletter['id']}}</td>
                  <td>{{$newsletter['email']}}</td>
                  <td>@if($newsletter['status']=='1')
                      <a href="{{url('admin/update-subscribed-email/'.$newsletter->id.'/0')}}">
                        <span style="color:green">Active</span></a>
                  @else
                    <a href="{{url('admin/update-subscribed-email/'.$newsletter->id.'/1')}}">
                        <span style="color:green">Not Active</span></a>
                  @endif
                  </td>
                  <td class="center"><a rel="{{$newsletter->id}}" rel1="delete-subscribed-email" <?php /* href="{{url('/admin/delete-product/'.$products['id'])}}" */ ?> href="javascript:" class="btn btn-danger btn-mini deleteCategory" >Delete </a>
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