@extends('layout.master')

@section('content')
<div id="wrapper">
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="navbar-header">
<a class="navbar-brand visible-lg" href="{{url("/home")}}">
	<p style="color: #FFF">Rooms browser</p>
</a>
<a class="navbar-brand hidden-lg" href='#'>
	 <p></p>
</a>
</div>

@include('sidebar')
</nav>

<div id="md" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
 <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Greenlight Hotel - GUEST LAUNDRY LIST</h4>
      </div>
      <div class="modal-body" style="height: 470px">
            <p style="display:none" id="ldr"><img src="{{url("img/load.gif")}}"> Loading list ....</p>
            <div id="loadlist" style="overflow:auto; height:480px"></div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<div id="md" class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
 <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Greenlight Hotel - GUEST LAUNDRY LIST</h4>
      </div>
      <div class="modal-body" style="height: 470px">
            <p style="display:none" id="ldr1"><img src="{{url("img/load.gif")}}"> Loading list ....</p>
            <div id="loadlist1" style="overflow:auto; height:480px"></div>
      </div>
      <div class="modal-footer">
        
       <button type="button" class="btn btn-success" id="sv">Update changes</button>
      </div>
    </div>
  </div>
</div>



<div id="page-wrapper" style="background-color:#fff">
     	<ol class="breadcrumb">
            <li><a href="{{ url('home') }}">Home</a></li>
            <li class="active">Guest Laundry Lists</li>
            <li ><a href="{{ url("laundry/list") }}">Guest Laundry list</a></li>                            
        </ol>
      
<div>
<table class='table table-striped table-responsive table-bordered' id='stafftale' >
              <thead>
                  <tr class="">
                      <th> # </th>
                      <th>  Full name </th>
                      <th>  Room  </th>
                      <th>  Date </th>
                      <th>  operation </th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i = 1; $glists = Glist::all(); ?>
	                  @foreach($glists as $m)
	                  <tr>
	                      <td>{{ $i++ }}</td>
	                       <td>{{ Guest::find($m->gid)->firstname }} {{ Guest::find($m->gid)->lastname }}</td>
	                       <td>{{ Room::find(Guest::find($m->gid)->room_number)->name  }}</td>
                         <td>{{ $m->date }}</td>
	                       <td id="{{ $m->id }}">
	                            <button type="button" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-primary btn-xs viw"><span class="glyphicon glyphicon-eye-open"></span> View</button>
                              <button type="button" data-toggle="modal" data-target=".bs-example-modal-lg1"  class="btn btn-success btn-xs viw1"><span class="glyphicon glyphicon-edit"></span> Edit list</button>
	                       </td>
	                  </tr>
	                  @endforeach
               
              </tbody>
          </table>
</div>
</div>
<script>
$(document).ready(function (){


    $("#stafftale").dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
           "fnDrawCallback": function( oSettings ) {
              $(".viw").click(function(){
                var id1 = $(this).parent().attr('id');
                $('#ldr').show();
                $('#loadlist').html("");
                $.post('viewlist', {id:id1}, function(data){
                  $('#ldr').fadeOut(2000, function(){
                      $('#loadlist').html(data);
                  });
                });  
              });
              $(".viw1").click(function(){
                var id1 = $(this).parent().attr('id');
                $('#ldr1').show();
                $('#loadlist1').html("");
                $.post('viewlist1', {id:id1}, function(data){
                  $('#ldr1').fadeOut(2000, function(){
                      $('#loadlist1').html(data);
                  });
                });  
              });
           }
       });
    $('input[type="text"]').addClass("form-control");
    $('select').addClass("form-control");
    
    
});
</script>
@stop