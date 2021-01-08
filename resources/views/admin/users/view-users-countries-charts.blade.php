<?php
 
// $dataPoints = array(   
// foreach($getUserCountries as $country){
//       array("y" =>$country['count'],"label"=>$country['country']);
// } );

$dataPoints = array(
  array("y" => $getUserCountries[0]['count'], "label" => $getUserCountries[0]['country']),
   array("y" => $getUserCountries[1]['count'], "label" => $getUserCountries[1]['country']),
   array("y" => $getUserCountries[2]['count'], "label" => $getUserCountries[2]['country']),
   array("y" => $getUserCountries[3]['count'], "label" => $getUserCountries[3]['country']),
   array("y" => $getUserCountries[4]['count'], "label" => $getUserCountries[4]['country']),
);
 
?>


@extends('layouts.adminLayout.admin_design')
@section('content')

<script>
window.onload = function() {
 
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  title: {
    text: "Usage Share of Desktop Browsers"
  },
  subtitles: [{
    text: "November 2017"
  }],
  data: [{
    type: "pie",
    yValueFormatString: "#,##0.00\"%\"",
    indexLabel: "{label} ({y})",
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
          <div class="widget-content nopadding">
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> 

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endsection