@extends('layout.master')
@section('content')
<div id="wrapper">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="navbar-header">
<a class="navbar-brand visible-lg" href="{{url("/home")}}">
  <p style="color: #000">Guest browser</p>
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
            <li class="active">Guests</li>
             
            <li><a href="{{ url("guest/add") }}"> Guest register</a></li>                    
        </ol>
 <!--response messages-->
         @if(isset($emsg))
         <div class="alert alert-danger alert-dismissable" >
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{ $emsg }}!</strong> 
          </div>
         @endif
         
         @if(isset($msg))
         <div class="alert alert-success alert-dismissable" >
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{ $msg }}!</strong> 
          </div>
         @endif        
<div style="">         
<table class='table table-striped table-responsive table-bordered' id='stafftale' >
              <thead>
                  <tr class="">
                      <th> # </th>
                      <th>  First Name </th>
                      <th>  Last Name  </th>
                      <th>  Mobile  </th>
                      <th>  Room   </th>
                      <th>Room Status</th>
                      <th>  Arrival date  </th>
                      <th>  Departure date  </th>
                      <th>  Operations  </th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i = 1; ?>
                    @foreach($guests as $m)
                    <tr>
                        <td>{{ $i++ }}</td>
                         <td>{{ $m->firstname }}</td>
                         <td>{{ $m->lastname }}</td>
                         <td>{{ $m->mobile }}</td>
                         <td>{{ Room::find($m->room_number)->name }}</td>
                         <td>{{ Room::find($m->room_number)->status }}</td>
                         <td>{{ $m->arrival_date }}</td>
                         <td>{{ $m->departure_date }}</td>
                         <td id="{{ $m->id }}">
                              <a href="{{url("guest/edit/{$m->id}")}}"><button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit </button></a>
                              @if(($m->arrival_date)>=(date('Y-m-d'))&& $m->cancelled=='no'&& $m->released=='no')
                              <div class="btn-group btn-group-xs"><button class="btn btn-info btn-xs" data-toggle="dropdown">Extra <span class="caret"></span></button>
                                  <ul class="dropdown-menu" role="menu">
                                      <li><a href="#" onclick="SquezeOrder('{{$m->id}}')" data-target="#squeez" data-toggle="modal">Squeze order</a></li>
                                      <li><a href="#" data-target="#cancel" data-toggle="modal">Cancel order</a></li>
                                  </ul>
                              </div>
                              <div class="modal fade" id="cancel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                <div class="modal-body">
                                    <div class="contz">
                                      <p class="alert alert-danger">Are sure you want to cancel this order</p> 
                                    </div>
                                </div>
                                 <div class="modal-footer">
                                 <button type="button" class="btn btn-danger btn-sm" onclick="CancelOrder('{{$m->id}}')">Yes</button>
                                 <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button></div>
                                </div>
                                </div>
                                </div>
                              @elseif($m->cancelled =='yes')
                              <button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove-circle"></span> canceled</button>
                              @endif
                         </td>
                    </tr>
                    @endforeach
               
              </tbody>
 </table>   
</div>
</div>   
</div> 
<div class="modal fade" id="squeez" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Guest Details</h4>
      </div>
      <div class="modal-body" style="height: 320px; overflow:scroll">
        
        <div class="main">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function (){
    $("#stafftale").dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
           "fnDrawCallback": function( oSettings ) {
               $(".deleteroom").click(function(){

                $('#fdk').html('').css({
                  'color': '',
                  'padding': '',
                  'border': '',
                  'border-radius': '',
                  'background-color': ''
                });
                $('#checkout, #checkin').val('');
                $('#checks').hide();
                var id1 = $(this).parent().attr('id');
                $("#myT").parent().find("#rmId").val(id1);
                //$("#myT").parent().find("#RMID").val(id1);

                $('#lod').fadeIn(1000, function(){
                     $('#checks').fadeIn(500, function(){
                        $('#lod').hide();
                     });
                });
               
            });//endof deleting category
           }
       });
    $('input[type="text"]').addClass("form-control");
    $('select').addClass("form-control");
});
</script>
<script>
    function SquezeOrder(id){
      var url="<?php echo url('view_cancel');?>";
      var url2=url+'/'+id;
      $.get(url2,function(data){
          $('.main').html(data);
      });
   }
   function CancelOrder(id){
       $('.contz').html('<label class="label label-info"> Please wait...</label>');
      var url="<?php echo url('view_danger');?>";
      var url2=url+'/'+id;
      $.get(url2,function(data){
          setTimeout(function(){
          $('.contz').html(data);
          location.reload();
          },2000);
      });
   }
</script>
@stop
