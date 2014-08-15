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
    
<hr/>
<p id="loader" style="display:none; z-index: 3000; position: absolute; top: 92px; left: 480px"><span style="background-color: #f5f5f5; padding:8px; border:1px solid #dd6 ; border-radius:4px">
        <img src="{{url("img/load.gif")}}"> <b>fetching report ...</b></span></p>
        <form id="rep">
<p id="ir" style="border: 1px solid #dd6; padding: 3px; border-left:4px solid #dd7;background-color:#f5f5f5">
    Report of: 
    <select id="reportof" style="border: 1px solid #002;padding:2px">
        <option></option>
        <option value="income">Income</option>
        <option value="expenditure">Expenditure</option>
    </select>
    Date:
    <input id="date" style="width: 90px;border: 1px solid #002;padding:2px" type="text" /> 
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


<script type="text/javascript">

$(document).ready(function(){

    $('#date').datepicker({
        dateFormat:"yy-mm-dd",
        changeMonth: true,
        changeYear:true,
        maxDate: 0
    });
  $('#rep').submit(function(e){
      e.preventDefault();
      var formd=document.getElementById('reportof').value;
      var table=document.getElementById('reportin').value;
      var date=$('#date').val();
      if(formd===''||date===''||table===''){
       alert('The fields cant be empty');
       return false;
      }else{
      $('#ir').css('opacity','0.1');
      $('#loader').show();
      if(table==='Table'){
        var url="<?php echo url('accountant_report')?>";
        var url2=url+'/'+formd+'/'+date;
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