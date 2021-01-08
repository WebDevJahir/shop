@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Shipping Charge</a> <a href="#" class="current">Add Shipping Charge</a> </div>
    <h1>Add Shipping Charge</h1>
    @if(Session::has('flash_message_error'))
      <div class="alert alert-error alert-block">
          <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{session('flash_message_error')}}</strong>
      </div>
      @endif
      @if(Session::has('flash_message_success'))
      <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{session('flash_message_success')}}</strong>
      </div>
      @endif
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Add Shipping Charge</h5>
            </div>
            <div class="widget-content nopadding">
              <form class="form-horizontal" method="post" action="{{url('/admin/add-shipping-charge')}}" name="add_category" id="add_category" novalidate="novalidate">
                @csrf
                <div class="control-group">
                  <label class="control-label">Country</label>
                  <div class="controls">
                    <input type="text" name="country" id="country" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Shipping Charge(0g-500g)</label>
                  <div class="controls">
                    <input type="text" name="shipping_charge0_500" id="shipping_charge" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Shipping Charge(500g-1000g)</label>
                  <div class="controls">
                    <input type="text" name="shipping_charge500_1000" id="shipping_charge" />
                  </div>
                </div> 
                <div class="control-group">
                  <label class="control-label">Shipping Charge(1000g-2000g)</label>
                  <div class="controls">
                    <input type="text" name="shipping_charge1000_2000" id="shipping_charge" />
                  </div>
                </div> 
                <div class="control-group">
                  <label class="control-label">Shipping Charge(2000g-5000g)</label>
                  <div class="controls">
                    <input type="text" name="shipping_charge2000_5000" id="shipping_charge" />
                  </div>
                </div>   
                <div class="form-actions">
                  <input type="submit" value="Add Shipping" class="btn btn-success">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection