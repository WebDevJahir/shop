@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Currency</a> <a href="#" class="current">Currency Table</a> </div>
            @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ session('flash_message_success') }}  </strong>
        </div>
        @endif  
    <h1>Currencies</h1>
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
                  <th>Currency ID</th>
                  <th>Currency Code</th>
                  <th>Exchange Rate</th>
                  <th>Status</th>
                  <th>Created_at</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($currencies as $currency)
                <tr class="gradeX">
                  <td>{{$currency['id']}}</td>
                  <td>{{$currency['currency_code']}}</td>
                  <td>{{$currency['exchange_rate']}}</td>
                  <td>@if($currency['status']=='1')
                    <?php echo 'Active'; ?>
                  @else
                    <?php echo 'Not Active'; ?>
                  @endif
                  </td>
                  <td>{{$currency['created_at']}}</td>
                  <td class="center"><a href="{{url('/admin/edit-currency/'.$currency['id'])}}" class="btn btn-primary btn-mini">Edit</a>||<a rel="{{$currency->id}}" rel1="delete-currency" <?php /* href="{{url('/admin/delete-product/'.$products['id'])}}" */ ?> href="javascript:" class="btn btn-danger btn-mini deleteCategory">Delete</td>
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