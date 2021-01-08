@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Coupons</a> <a href="#" class="current">Coupons Table</a> </div>
            @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ session('flash_message_success') }}  </strong>
        </div>
        @endif  
    <h1>Coupons</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Coupons table</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Coupon Id</th>
                  <th>Coupon code</th>
                  <th>Amount</th>
                  <th>Amount_type</th>
                  <th>Expiry Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($coupons as $allCoupon)
                <tr class="gradeX">
                  <td>{{$allCoupon['id']}}</td>
                  <td>{{$allCoupon['coupon_code']}}</td>
                  <td>{{$allCoupon['amount']}} <?php if($allCoupon->amount_type=="Precentage"){echo "%";}else{echo "/="; } ?> </td>
                  <td>{{$allCoupon['amount_type']}}</td>
                  <td>{{$allCoupon['expiry_date']}}</td>
                  <td><?php if($allCoupon->status==1){echo "Active";}else{echo "Not Active"; } ?> </td>
                 
                  
                  <td class="center">
                    <a href="{{url('/admin/edit-coupon/'.$allCoupon['id'])}}" class="btn btn-primary btn-mini">Edit</a>|
                    <a rel="{{$allCoupon->id}}" rel1="delete-coupon" <?php /* href="{{url('/admin/delete-product/'.$products['id'])}}" */ ?> href="javascript:" class="btn btn-danger btn-mini deleteConpon">Delete</td>
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