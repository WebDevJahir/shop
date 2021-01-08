<?php
 
  $current_month = Date('M');
  $last_month = Date('M',strtotime("-1 month"));
  $last_to_last_month = Date('M',strtotime("-2 month"));

$dataPoints = array(
  array("y" => $last_to_last_month_order, "label" => $last_to_last_month),
  array("y" => $last_month_orders, "label" => $last_month),
  array("y" => $current_month_orders, "label" => $current_month),
);
 
?>


@extends('layouts.adminLayout.admin_design')
@section('content')

<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2",
  title:{
    text: "Orders Report"
  },
  axisY: {
    title: "Number of Orders"
  },
  data: [{
    type: "column",
    yValueFormatString: "#,##0.## tonnes",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}
</script>


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
          <div id="chartContainer" style="height: 370px; width: 100%;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> 

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endsection