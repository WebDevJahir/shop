@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Orders</a> </div>
    <h1>Order Id: #{{$orderDetails->id}}</h1>
  </div>
  @if(Session::has('flash_message_success'))
      <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{session('flash_message_success')}}</strong>
      </div>
      @endif
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span6">
         <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
            <h5>Order Details</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-striped table-bordered">
              <tbody>
                <tr>
                  <td class="taskDesc">Order Date</td>
                  <td class="taskStatus">{{$orderDetails->created_at}}</td>
                </tr>
                <tr>
                  <td class="taskDesc">Order Status</td>
                  <td class="taskStatus">{{$orderDetails->order_status}}</td>
                </tr>
                <tr>
                  <td class="taskDesc"></i>Total Amount</td>
                  <td class="taskStatus">TK {{$orderDetails->grand_total}}</td>
                </tr>
                <tr>
                  <td class="taskDesc"></i> Shipping Charges</td>
                  <td class="taskStatus">{{$orderDetails->shipping_charges}}</td>
                </tr>
                <tr>
                  <td class="taskDesc"></i> Coupon Code</td>
                  <td class="taskStatus">{{$orderDetails->coupon_code}}</td>
                </tr>
                <tr>
                  <td class="taskDesc">Coupon Amount</td>
                  <td class="taskStatus">TK {{$orderDetails->coupon_amount}}</td>
                </tr>
                <tr>
                  <td class="taskDesc">Payment Method</td>
                  <td class="taskStatus">{{$orderDetails->payment_method}}</td>
                </tr>
                <tr>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="accordion" id="billing">
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title"> <a data-parent="#billing" href="#collapseGOne" data-toggle="collapse"> <span class="icon"><i class="icon-ok"></i></span>
                <h5>Billing Address</h5>
                </a> </div>
            </div>
            <div class="collapse in accordion-body" id="collapseGOne">
              <div class="widget-content"> 
              	{{ $userDetails->name }} <br>
              	{{ $userDetails->address }} <br>
              	{{ $userDetails->city }} <br>
              	{{ $userDetails->state }} <br>
              	{{ $userDetails->country }} <br>
              	{{ $userDetails->pincode }} <br>
              	{{ $userDetails->mobile }} <br>
               </div>
            </div>
          </div>
          </div>
        </div>
              <div class="span6">
         <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
            <h5>Customer Details</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-striped table-bordered">
              <tbody>
                <tr>
                  <td class="taskDesc"><i class="icon-info-sign"></i> Customer Name</td>
                  <td class="taskStatus">{{$orderDetails->name}}</td>
                </tr>
                <tr>
                  <td class="taskDesc"><i class="icon-plus-sign"></i> Customer Email</td>
                  <td class="taskStatus">{{$orderDetails->user_email}}</td>
                </tr>
                <tr>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="accordion" id="update-order">
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title"> <a data-parent="#update-order" href="#collapseGThree" data-toggle="collapse"> <span class="icon"><i class="icon-ok"></i></span>
                <h5>Update Order Status</h5>
                </a> </div>
            </div>
            <div class="collapse in accordion-body" id="collapseGThree">
              <div class="widget-content"> 
              	<form action="{{url('admin/update-order-status')}}" method="post">
              		@csrf
              		<input type="hidden" name="order_id" value="{{$orderDetails->id}}" class="control-label" required="">
              		<table width="100%">
              			<tr>
              			  <td>
		              		<select name="order_status" id="order_status" class="control-label" required="">
		              			<option value="New" @if($orderDetails->order_status == "New") selected @endif>New</option>
		              			<option value="Pending" @if($orderDetails->order_status == "Pending") selected @endif>Pending</option>
		              			<option value="Cancelled" @if($orderDetails->order_status == "Cancelled") selected @endif>Cancelled</option>
		              			<option value="In Process" @if($orderDetails->order_status == "In Process") selected @endif>In Process</option>
		              			<option value="Shipped" @if($orderDetails->order_status == "Shipped") selected @endif>Shipped</option>
		              			<option value="Delivered" @if($orderDetails->order_status == "Delivered
		              				") selected @endif>Delivered</option>
		              		</select>
		              	  </td>
		              	  <td>
		              		<input type="submit" value="Update">
		              	  </td>
		              	</tr>
		            </table>
              	</form>

               </div>
            </div>
          </div>
          </div>
        <div class="accordion" id="collapse-group">
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGTwo" data-toggle="collapse"> <span class="icon"><i class="icon-ok"></i></span>
                <h5>Shipping Address</h5>
                </a> </div>
            </div>
            <div class="collapse in accordion-body" id="collapseGTwo">
              <div class="widget-content"> 
              	{{ $orderDetails->name }} <br>
              	{{ $orderDetails->address }} <br>
              	{{ $orderDetails->city }} <br>
              	{{ $orderDetails->state }} <br>
              	{{ $orderDetails->country }} <br>
              	{{ $orderDetails->pincode }} <br>
              	{{ $orderDetails->mobile }} <br>
               </div>
            </div>
          </div>
          </div>
        </div>
  </div>
  <div class="row-fluid">
  					<table id="example" class="table table-striped table-bordered" style="width: 100%">
					<thead>
						<tr>
							<th>Product Code</th>
							<th>Product Name</th>
							<th>Product Size</th>
							<th>Product Color</th>
							<th>Product Price</th>
							<th>Product Quantity</th>
							<th>Created At</th>
						</tr>
					</thead>
					<tbody>
						@foreach($orderDetails->orders as $orderProduct)
						<tr>
							<td>{{$orderProduct->product_code}}</td>
							<td>{{$orderProduct->product_name}}</td>
							<td>{{$orderProduct->product_size}}</td>
							<td>{{$orderProduct->product_color}}</td>
							<td>{{$orderProduct->product_price}}</td>
							<td>{{$orderProduct->product_quantity}}</td>
							<td>{{$orderProduct->created_at}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
  </div>
</div>
@endsection