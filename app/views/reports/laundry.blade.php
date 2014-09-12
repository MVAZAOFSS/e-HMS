@extends('layout.master')
@section('content')
<div id="wrapper">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="navbar-header">
<a class="navbar-brand visible-lg" href="{{url("/home")}}">
	<p style="color: #000">Hotel administration</p>
</a>
<a class="navbar-brand hidden-lg" href='#'>
	 <p>EMIS</p>
</a>
</div>
@include('layout-setup')
@include('sidebar')
</nav>

<div id="page-wrapper" style="background-color:#fff">
<ol class="breadcrumb">
            <li><a href="{{ url('home') }}">Home</a></li>
            <li class="active">Laundry reports </li>
                           
</ol>
<hr/>
<p id="loader" style="display:none; z-index: 3000; position: absolute; top: 92px; left: 480px">
    <span style="background-color: #f5f5f5; padding:8px; border:1px solid #dd6 ; border-radius:4px"><img src="{{url("img/load.gif")}}"> <b>fetching report ...</b></span></p>
<form id="rep">
<p id="ir" style="border: 1px solid #dd6; padding: 3px; border-left:4px solid #dd7">
    Report of: 
    <select id="reportof" style="border: 1px solid #002;padding:2px">
        <option></option>
        <option value="Guest">Guest</option>
        <option value="income">income</option>
    </select>
    Laundry:     
    <select id="laundry" style="border: 1px solid #002;padding:2px">
        <option></option>
        <option value="all">all</option>
        <option value="1">laundry</option>
        <option value="2">dry cleaning</option>
        <option value="3">pressing</option>
    </select>
    Report for: 
    <select id="reportfor" style="border: 1px solid #002;padding:2px">
        <option></option>
        <option value="daily">daily</option>
        <option value="weekly">weekly</option>
        <option value="monthly">monthly</option>
        <option value="yearly">yearly</option>
    </select>   
    <span id="daily" style="display:none">
     Date:   
    <input id="date" style="width: 90px;border: 1px solid #002;padding:2px" type="text" />  
    </span>
    <span id="weekly" style="display:none">
     start   
    <input id="start" style="width: 90px;border: 1px solid #002;padding:2px" type="text" /> 
     end   
    <input id="end" style="width: 90px;border: 1px solid #002;padding:2px" type="text" />  
    </span>
    <span id="monthly" style="display:none">
    <select id="month" style="border: 1px solid #002;padding:2px">
        <option></option>
        <option value="01">january</option>
        <option value="02">february</option>
        <option value="03">march</option>
        <option value="04">april</option>
        <option value="05">may</option>
        <option value="06">june</option>
        <option value="07">july</option>
        <option value="08">august</option>
        <option value="09">september</option>
        <option value="10">october</option>
        <option value="11">november</option>
        <option value="12">december</option>
    </select>
    <input type="text" placeholder="Year" value="{{date('Y')}}" id="mYear" style="width: 90px;border: 1px solid #002;padding:2px" />  
    </span>
    <span id="yearly" style="display:none">
     <input id="year" style="width: 90px;border: 1px solid #002;padding:2px" value="{{date('Y')}}"  type="text" />  
    </span>
    Report in: 
    <select id="reportin" style="border: 1px solid #002;padding:2px">
        <option></option>
        <option value="Table">Table</option>
    </select>
    <button id="go">Go</button>
</p>
</form>
<hr />

<div id="ireport"></div>
<div id="container" style="border-radius: 8px"></div>
</div>   
</div>

<script type="text/javascript">
$(document).ready(function(){

    $('#date, #start, #end').datepicker({
        dateFormat:"yy-mm-dd",
        changeMonth: true,
        changeYear:true,
        maxDate: 0
    });
$('#reportfor').on('change', function(){
        var rf = $(this).val();
        if(rf ==="daily"){
            $(".chart").hide();
            $('#reportin').val('');
            $('#weekly').hide();
            $('#monthly').hide();
            $('#yearly').hide();
            $('#daily').fadeIn(1000);
        }else if(rf ==="weekly"){
            $(".chart").show();
            $('#daily').hide();
            $('#monthly').hide();
            $('#yearly').hide();
            $('#weekly').fadeIn(1000);
        }else if(rf ==="yearly"){
            $(".chart").show();
            $('#reportin').val('');
            $('#daily').hide();
            $('#weekly').hide();
            $('#monthly').hide();
            $('#yearly').fadeIn(1000);
        }else if(rf ==="monthly"){
            $(".chart").show();
            $('#reportin').val('');
            $('#daily').hide();
            $('#weekly').hide();
            $('#yearly').hide();
            $('#monthly').fadeIn(1000);
        }
    });
 $('#rep').submit(function(e){
     e.preventDefault();
     var formd=document.getElementById('reportof').value;
     var laud=document.getElementById('laundry').value;
     var days=document.getElementById('reportfor').value;
     if(formd===''||laud===''||days===''){
         alert('The fileds cant be empty');
         return false;
     }else{
         $('#ir').css('opacity', '0.1');
         $('#loader').show();
         if(days==='daily'){
            var datex=$('#date').val();
            var url="<?php echo url('day_laundry');?>";
            var url2=url+'/'+formd+'/'+laud+'/'+datex;
            $.get(url2,function(data){
                setTimeout(function(){
                    $('#loader').hide();
                    $('#ireport').html(data);
                },2000);
            });
         }if(days==='weekly'){
            var start_date=$('#start').val();
            var end_date=$('#end').val();
            var url="<?php echo url('week_laundry');?>";
            var url2=url+'/'+formd+'/'+laud+'/'+start_date+'/'+end_date;
            $.get(url2,function(data){
                setTimeout(function(){
                    $('#loader').hide();
                    $('#ireport').html(data);
                },2000);
            });
         }if(days==='monthly'){
            var month=document.getElementById('month').value;
            var year=$('#mYear').val();
            var url="<?php echo url('month_laundry');?>";
            var url2=url+'/'+formd+'/'+laud+'/'+month+'/'+year;
            $.get(url2,function(data){
                setTimeout(function(){
                    $('#loader').hide();
                    $('#ireport').html(data);
                },2000);
            });
         }if(days==='yearly'){
             var year=$('#year').val();
             var url="<?php echo url('year_laundry');?>";
             var url2=url+'/'+formd+'/'+laud+'/'+year;
             $.get(url2,function(data){
                 setTimeout(function(){
                     $('#loader').hide();
                     $('#ireport').html(data);
                 },2000);
             });
         }
     }
});
});
</script>  
@stop