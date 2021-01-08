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
    <h1>Shipping Charges</h1>
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
                  <th>Country</th>
                  <th>Shipping Charges(0g-500g)</th>
                  <th>Shipping Charges(500g-1000g)</th>
                  <th>Shipping Charges(1000g-2000g)</th>
                  <th>Shipping Charges(2000g-5000g)</th>
                  <th>created_at</th>
                  <th>Updated_at</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($allShipping as $charge)
                <tr class="gradeX">
                  <td>{{$charge['id']}}</td>
                  <td>{{$charge['country']}}</td>
                  <td>{{$charge['shipping_charge0_500']}}</td>
                  <td>{{$charge['shipping_charge500_1000']}}</td>
                  <td>{{$charge['shipping_charge1000_2000']}}</td>
                  <td>{{$charge['shipping_charge2000_5000']}}</td>
                  <td>{{$charge['created_at']}}</td>
                  <td>{{$charge['updated_at']}}</td>
                  <td><a href="{{url('admin/edit-shipping-charge/'.$charge['id'])}}" class="btn-primary btn-small m-3" style="margin-right: 5px;">Edit</a>||<a rel="{{$charge->id}}" rel1="delete-shipping-charge" <?php /* href="{{url('/admin/delete-product/'.$products['id'])}}" */ ?> href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</td></td>
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