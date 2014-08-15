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
  <div class="well well-sm"> <i class="glyphicon glyphicon-import"></i> Daily Income: {{date('d/m/Y')}} </div>
  <div class="well well-sm">  <b>CASH BALANCE</b> B/F </div>
  <div class="well well-sm">  <center><b>CASH  COLLECTION OF {{date('d/m/Y')}}</b> </center> </div>
  <div class="well well-sm"> 
    <p><b>ROOMS .......................................................................................................... <span class="">Tsh {{HotelLogs::getIncome(date('Y-m-d'))}} /= </span></b></p>
    <p><b>BAR ...............................................................................................................Tsh {{Bil::getAlIncome(date('Y-m-d')) + DrinkSales::getIncome(date('Y-m-d'))}} /=
     
    </b></p>
    <p><b>RESTAURANT ..................................................................................................Tsh {{Bill::getAlIncome(date('Y-m-d')) + FoodSales::getIncome(date('Y-m-d'))}} /=
<span class=""> </span>   
    </b></p>
    <p><b>LAUNDRY .......................................................................................................
      <span class="">Tsh {{Llist::getIncome(date('Y-m-d'))}} /=</b></p>
    <p><b>CONFERENCE ..........................................................................................................</b></p>
    <p><b>FUNCTION ................................................................................................................</b></p>
  </div>
  <div class="well well-sm"> 
    <p><b>ADVANCE PAYMENT FOR ROOMS ....................................................................... <span class="">Tsh {{HotelLogs::getIncome(date('Y-m-d'))}} /= </span></b></p>
    <p><b>ADVANCE PAYMENT FOOD & DRINKS ...................................................................
      <span class="">Tsh {{Bil::getIncome(date('Y-m-d')) + DrinkSales::getIncome(date('Y-m-d')) + Bill::getIncome(date('Y-m-d')) + FoodSales::getIncome(date('Y-m-d'))}} /= </span> 
    </b></p>
    <p><b>ADVANCE PAYMENT FOR FUNCTIONS ...........................................................................</b></p>
    <p><b>ADVANCE PAYMENT FOR CONFERENCE ...........................................................................</b></p>
  </div>
  <div class="well well-sm"> 
    <p><b>DEBTORS PAID BILLS ...........................................................................</b></p>
    <p><b>ROOMS .........................................................................................Tsh {{HotelLogs::getIncome(date('Y-m-d')) - HotelLogs::getIncome(date('Y-m-d'))}} /= </b></p>
    <p><b>FOOD & BEVERAGE ...............................................................................................Tsh 
      {{(Bil::getAlIncome(date('Y-m-d')) + DrinkSales::getIncome(date('Y-m-d')) + Bill::getAlIncome(date('Y-m-d')) + FoodSales::getIncome(date('Y-m-d'))) - Bil::getIncome(date('Y-m-d')) + DrinkSales::getIncome(date('Y-m-d')) + Bill::getIncome(date('Y-m-d')) + FoodSales::getIncome(date('Y-m-d'))}} /=
    </b></p>
    <p><b>LAUNDRY.........................................................................</b></p>
    <p><b>FUNCTIONS.........................................................................</b></p>
  </div>

  <div class="well well-sm"> 
    <p><b>TOTAL INCOME........................................................................... Tsh {{(HotelLogs::getIncome(date('Y-m-d')) + Bil::getAlIncome(date('Y-m-d')) + DrinkSales::getIncome(date('Y-m-d')) + Bill::getAlIncome(date('Y-m-d')) + FoodSales::getIncome(date('Y-m-d')) + Llist::getIncome(date('Y-m-d'))) }}</b></p>
  </div>

</div>   
</div>  
@stop