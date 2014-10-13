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
  <div class="well well-sm"> <i class="glyphicon glyphicon-export"></i> Expenses of  {{date('d/m/Y')}} </div>

  <div class="well well-sm col-lg-5 col-lg-offset-0">
      {{Form::open(array('url'=>'expenditure'))}}
      @if(isset($sms))
          {{$sms}}
      @endif
      <table class="table">
          <tr><td>Expenditure on:
              {{$errors->first('option','<span class="error">:message</span>')}}
              </td></tr>
          <tr><td><select class="form-control" name="option">
                      <option class="empty"></option>
                      <option class="rooms">ROOMS</option>
                      <option class="bar">BAR/DRINKS/BEVERAGES</option>
                      <option class="rest">RESTAURANT FOODS</option>
                      <option class="opt">OTHERS</option>
                </select>
               </td></tr>
          <tr><td> 
              {{$errors->first('other','<span class="error">:message</span>')}}    
         <textarea  name="other" class="form-control other" placeholder="specify"></textarea></td></tr>
  	<tr><td>Amount 
            {{$errors->first('amount','<span class="error">:message</span>')}}
            </td></tr>
        <tr><td><input type="text" class="form-control" name="amount"></td></tr>
        <tr><td>Date
            {{$errors->first('date','<span class="error">:message</span>')}}
          </td></tr>
        <tr><td><input type="text" name="date" class="form-control datepicker"></td></tr>
        <tr><td><button class="btn btn-success">Add Expenditure </button></td></tr>
      </table>
      {{Form::token()}}
      {{Form::close()}}
  </div>
  <div class="col-lg-7">
      <div class="panel panel-danger">
          <div class="panel-heading">
              <span class="glyphicon glyphicon-usd"></span> INCOME USED
          </div>
          <div class="panel-body">
              <table class="table table-condensed" id="tablez">
                  <thead><tr><th>Cost</th><th>Expe.for</th><th>Date updated</th><th>Details</th></tr></thead>
                  <tbody>
                      <?php
                      $data=DB::table('expenditures')->get();
                      foreach($data as $row){
                      ?>
                      <tr><td>{{$row->cost}}</td><td>{{$row->expenditure_name}}</td><td>{{$row->date}}</td>
                      <td><button class="btn btn-success btn-xs" onclick="viewResourcesUsed('{{$row->id}}')" data-toggle="modal" data-target="#myresource"><span class="glyphicon glyphicon-eye-open"> Details</span></button>
                          <a class="btn btn-warning btn-xs" href="{{url('printpdf/'.$row->id)}}"><span class="glyphicon glyphicon-print"></span>Export pdf</a></td></tr>
                      <?php
                      }?>
                  </tbody>
              </table>
          </div>
          <div class="panel-footer">
              <p><b>TOTAL INCOME </b></p>
          </div>
      </div>
  </div>
</div>   
</div>
<div class="modal fade" id="myresource" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Expenses Details</h4>
            </div>
            <div class="modal-body" style="height: 420px; overflow:scroll">
                <div id="main">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.datepicker').datepicker({
        dateFormat:"yy-mm-dd",
        changeMonth: true,
        changeYear:true,
        maxDate: 0
    });
        $('.other').hide();
        $('.opt').click(function(){
            $('.other').show();
        });
        $('.empty').click(function(){
            $('.other').show();
        });
        $('.bar').click(function(){
            $('.other').show();
        });
        $('.rest').click(function(){
            $('.other').show();
        });
        $('.rooms').click(function(){
            $('.other').show();
        });
        
    $("#tablez").dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
      });
});

 function viewResourcesUsed(id){
     var url="<?php echo url('resourcesDetails');?>";
     var url2=url+'/'+id;
     $.get(url2,function(data){
          $('#main').html(data);
     });
 }
</script>
@stop