@extends('layout.master')

@section('content')
<div id="wrapper">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="navbar-header">
<a class="navbar-brand visible-lg" href="{{url("/home")}}">
	<p style="color: #000">Bar manager </p>
</a>
<a class="navbar-brand hidden-lg" href='#'>
	 <p>EMIS</p>
</a>
</div>

@include('sidebar')
</nav>

<div id="page-wrapper">
  <div class="well well-sm"> <i class="glyphicon glyphicon-import"></i> Daily Income: {{date('d/m/Y')}} <a class="btn btn-default btn-sm pull-right" href="{{url('dailyPdfExport/'.date('Y-m-d'))}}"><span class="glyphicon glyphicon-print pull-right"> Exportpdf</span></a></div>
  <div class="well well-sm">  <b>CASH BALANCE</b> B/F  <span class="text text-info"> {{$balance-$cost}} /=</span></div>
  <div class="well well-sm">  <center><b>CASH  COLLECTION OF {{date('d/m/Y')}}</b> </center> </div>
  <div class="well well-sm"> 
    <p><b>ROOMS .......................................................................................................... <span class="">Tsh {{$roomcost}} /= </span></b></p>
    <p><b>BAR ...............................................................................................................Tsh {{$barcost+$barbillscost}} /=
     
    </b></p>
    <p><b>RESTAURANT ..................................................................................................Tsh {{$nofoodst*$msosicost+$bilscost}} /=
<span class=""> </span>   
    </b></p>
    <p><b>LAUNDRY .......................................................................................................
      <span class=""> Tsh {{$totalprice}} /=</b></p>
      <p><b>LAUNDRY SALES.......................................................................................................
              <span class=""> Tsh {{$totalpricesales}} /=</b></p>
    <p><b>CONFERENCE .................................................................................................{{$amount+$remain}}</b></p>
    <p><b>FUNCTION ...................................................................................................{{$amount1+$remain1}}</b></p>
  </div>
  <div class="well well-sm"> 
    <p><b>ADVANCE PAYMENT FOR ROOMS ....................................................................... <span class="">Tsh {{$roomcost}} /= </span></b></p>
    <p><b>ADVANCE PAYMENT FOOD & DRINKS ...................................................................
      <span class="">Tsh {{($no_drinks*$barcost)+$bilscost+$barbillscost+$msosicost}}  /= </span>
    </b></p>
    <p><b>ADVANCE PAYMENT FOR FUNCTIONS ......................................................................{{$amount1}}</b></p>
    <p><b>ADVANCE PAYMENT FOR CONFERENCE ......................................................................{{$amount}}</b></p>
  </div>
  <div class="well well-sm"> 
    <p><b>TOTAL INCOME........................................................................... Tsh {{$roomcost+$barcost+$bilscost+$barbillscost+$totalprice+$totalpricesales+($nofoodst*$msosicost)+$amount+$remain+$amount1+$remain1}} /= </b></p>
  </div>

</div>   
</div>  
@stop