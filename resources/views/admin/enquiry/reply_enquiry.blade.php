@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Enquiry</a> <a href="#" class="current">Reply Enquiry</a> </div>
    <h1>Reply Enquiry</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Reply Enquiry</h5>
            </div>
            <div class="widget-content nopadding">
              <form class="form-horizontal" method="post" action="{{url('/admin/reply-enquiry/'.$enquiry->id)}}" name="add_category" id="add_category" novalidate="novalidate">
                @csrf
                <div class="control-group">
                  <label class="control-label">Client Name</label>
                  <div class="controls">
                    <input type="text" name="name" id="category_name" readonly="" value="{{$enquiry->name}}" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Email</label>
                  <div class="controls">
                    <input type="text" name="email" id="email" readonly="" value="{{$enquiry->email}}"/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Suject</label>
                  <div class="controls">
                    <input type="text" name="subject" id="subject" readonly="" value="{{$enquiry->subject}}" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Message</label>
                  <div class="controls">
                    <textarea name="message"></textarea>
                  </div>
                </div>
                <div class="form-actions">
                  <input type="submit" value="Reply Message" class="btn btn-success">
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