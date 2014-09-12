@extends('layout.master')

@section('content')
<div id="wrapper">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="navbar-header">
<a class="navbar-brand visible-lg" href="{{url("/home")}}">
	<p style="color: #000">Sale browser</p>
</a>
<a class="navbar-brand hidden-lg" href='#'>
	 <p>EMIS</p>
</a>
</div>
<div style="margin-right: 100px; display:none">
<ul class="nav navbar-nav navbar-right">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
</div>

@include('sidebar')
</nav>

<div id="page-wrapper" style="background-color:#fff; position: absolute">
<ol class="breadcrumb">
            <li><a href="{{ url('home') }}">Home</a></li>
            <li><a href="{{ url("bill/sales/all") }}">sales </a></li>
             @if(Auth::user()->role == 7)
            <li class="active">add restaurant sale </li>
            @elseif(Auth::user()->role == 8)
            <li class="active">add restaurant sale </li>
            @else
            <li class="active">add bar sale </li>
            
            @endif                          
</ol>
<div class="pull-left" id="billform" style="width: 300px; border: 1px solid #ccc; padding:3px">

<img src="{{url("img/load.gif")}}" id="ajax" style="width: 56px; display:none;z-index:3000;position:absolute;margin-left: 120px; margin-top:100px">

@if(Auth::user()->role ==7)
<table class="table table-bordered">
<tr>
  <td style="background-color: #f5f5f5">  
  Enter Food: 
  </td>
</tr>
<tr>
  <td>
    <input class="form-control" type="text" id="food" />
  </td>  
</tr>  
</table>
@elseif(Auth::user()->role == 8)
<table class="table table-bordered">
<tr>
  <td style="background-color: #f5f5f5">  
  Enter Food: 
  </td>
</tr>
<tr>
  <td>
    <input class="form-control" type="text" id="food" />
  </td>  
</tr>  
</table>
@else
<table class="table table-bordered">
<tr>
  <td style="background-color: #f5f5f5">  
  Enter Drink: 
  </td>
</tr>
<tr>
  <td>
    <input class="form-control" type="text" id="drink" />
  </td>  
</tr>  
</table>
@endif

<table class="table table-bordered">
<tr>
  <td style="background-color: #f5f5f5">  
  Select Service Time: 
  </td>
</tr>
<tr>
  <td>
    <select class="form-control" id="time">
        <option value=""></option>
        <option value="1">Break fast</option>
        <option value="2">Lunch</option>
        <option value="3">Supper</option>
        <option value="4">Dinner</option>
        <option value="5">Neither</option>
    <select>  
  </td>  
</tr>  
</table>
<table class="table table-bordered" > 
<tr>
  <td>
    <button type="button" class="btn btn-primary" id="addbill"> Sell now</button>
  </td>  
</tr> 
</table>
</div>
<div style="width:600px" class="pull-right">
  <div >
    <table class="table table-bordered" >
      <tr>
        <td style="background-color: #f5f5f5">
        @if(Auth::user()->role == 7)  
          Today sales
        @elseif(Auth::user()->role == 8)
        Today sales
        @else
        
          Today sales
        @endif  
        </td>
      </tr>
      <tr>
      <td valign="top">
          <!--<p id="ajax2" style="display: none"><img src="{{url("img/load.gif")}}"  style="width: 26px;"> Loading bill info . . . </p>
          -->
          <div id="infobill">

          </div>
      </td>  
      </tr>  
  </table>
  </div>  
</div>
</div>   
</div>  
<?php 
  if(Auth::user()->role == 7){
    $foods = Restaurant::all();
    $data2 = array();
    foreach($foods as $f){
        $data2[] = $f->name;
    }  

     $json2 = json_encode($data2);
     
  }elseif(Auth::user()->role == 8){ 
      $foods = Restaurant::all();
    $data2 = array();
    foreach($foods as $f){
        $data2[] = $f->name;
    }  

     $json2 = json_encode($data2);
  }else{
      $drinks = Bar::all();
      $data3 = array();
      foreach($drinks as $f){
          $data3[] = $f->name;
      }  

       $json3 = json_encode($data3);
  }



?>

<script type="text/javascript">
$(document).ready(function(){
    $('#time').on('change', function(){
    var stime = $(this).val();

    alert($stime);
    var g = $('#gb').val();
    $('#gt').css('opacity', '0.2');
    $('#ajax5').show();
    $.post('servicetime1', {s:stime, g:g}, function(data){
      $('#main').html(data);
    })
  });
});
</script>


<script type="text/javascript">
$(document).ready(function(){

@if(Auth::user()->role == 7)
$('#addbill').on('click', function(){
    
    var food      = $('#food').val();
    var t         = $('#time').val();
    
    if(food == "" || t==""){
          alert("Please fill the fields");
    }else{
      $("#billform").css('opacity', '0.4');
      $('#ajax, #ajax2').show();

      $.post('submitsale', {f:food, t:t}, function(data){

           $("#billform").css('opacity', '1');
           $('#ajax, #ajax2').hide('fast', function(){$('#food').val('');$('#time').val('');});
           $('#infobill').html(data);
      });
    }
    
});
  $('#food').autocomplete({
    source:  {{ $json2 }}
  });
 @elseif(Auth::user()->role == 8)
 $('#addbill').on('click', function(){
    
    var food      = $('#food').val();
    var t         = $('#time').val();
    
    if(food == "" || t==""){
          alert("Please fill the fields");
    }else{
      $("#billform").css('opacity', '0.4');
      $('#ajax, #ajax2').show();

      $.post('submitsale', {f:food, t:t}, function(data){

           $("#billform").css('opacity', '1');
           $('#ajax, #ajax2').hide('fast', function(){$('#food').val('');$('#time').val('');});
           $('#infobill').html(data);
      });
    }
    
});
  $('#food').autocomplete({
    source:  {{ $json2 }}
  });
@else
$('#addbill').on('click', function(){
    
    var drink      = $('#drink').val();
    var t         = $('#time').val();
    
    if(drink == "" || t==""){
          alert("Please fill the fields");
    }else{
      $("#billform").css('opacity', '0.4');
      $('#ajax, #ajax2').show();

      $.post('submitsale', {d:drink, t:t}, function(data){

           $("#billform").css('opacity', '1');
           $('#ajax, #ajax2').hide('fast', function(){$('#drink').val('');$('#time').val('');});
           $('#infobill').html(data);
      });
    }
    
});
   $('#drink').autocomplete({
    source:  {{ $json3 }}
  }); 
@endif


/////////////////////////////////////////////////////



  
});
</script>
@stop