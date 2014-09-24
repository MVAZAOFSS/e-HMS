@extends('layout.master')
@section('content')
<div id="wrapper">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="navbar-header">
<a class="navbar-brand visible-lg" href="{{url("/home")}}">
  <p style="color: #000">Bills info browser</p>
</a>
<a class="navbar-brand hidden-lg" href='#'>
   <p>EMIS</p>
</a>
</div>

@include('sidebar')
</nav>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Guest bill information</h4>
      </div>
      <div class="modal-body" style="height: 420px; overflow:scroll">
        <p id="ajax7"><img src="{{url("img/load.gif")}}"  style=""> Loading ...</p>
        <div id="main">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div id="page-wrapper" style="background-color:#fff">
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}">Home</a></li>
            <li class="active">Guests bills</li>
            <li><a href="{{ url('bill/add') }}">add bill information</a></li>                   
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
                      <th>  Full name </th>
                      <th>  Room  </th>
                      <th> Service Time </th>
                      <th>  Mobile </th>
                      <th> served date </th>
                      <th>  Arrival date</th>
                      <th>  Departure date</th>
                      <th>  Operations  </th>
                  </tr>
              </thead>
              <tbody>
                  @if(Auth::user()->role == 7)
                      <?php $bills = Bill::all(); ?>
                  @elseif(Auth::user()->role ==8)
                  <?php $bills = Bill::all(); ?>
                  @else 
                      <?php $bills = Bil::all(); ?>
                  @endif
                  @foreach($bills as $b)
                    <tr>
                      <td></td>
                      <td> {{ Guest::find($b->guestid)->firstname }} {{ Guest::find($b->guestid)->lastname  }}</td>
                      <td> {{ Room::find(Guest::find($b->guestid)->room_number)->name }} </td>
                      <td> {{ Bill::tm($b->servicetime) }} </td>
                      <td> {{ Guest::find($b->guestid)->mobile }}</td>
                      <td> {{ $b->date }} </td>
                      <td> {{ Guest::find($b->guestid)->arrival_date }}</td>
                      <td> {{ Guest::find($b->guestid)->departure_date }}</td>
                      <td id="{{$b->id}}"> 
                        <button type="button" data-toggle="modal" data-target="#myModal"  class="btn btn-xs btn-success bll"><span class="glyphicon glyphicon-file"></span> View Bill info</button>
                        @if($b->date==date('Y-m-d'))
                        @if(Auth::user()->role == 7)
                        <a href="{{url('bills/print/'.$b->id)}}" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-barcode"></span> print</a>
                        @elseif(Auth::user()->role == 8)
                        <a href="{{url('bills/print/'.$b->id)}}" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-barcode"></span> print</a>
                        @else
                        <a href="{{url('bills/printbar/'.$b->id)}}" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-cloud-upload"></span> print</a>
                        @endif
                        @endif
                      </td>
                    </tr>  
                  @endforeach
               
              </tbody>
 </table>   
</div>
</div>   
</div> 
<!-------------------------- -->
<script>
/////////////////////////////////////
$(document).ready(function (){
    $("#stafftale").dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
           "fnDrawCallback": function( oSettings ) {
               $(".bll").click(function(){
               var id1 = $(this).parent().attr('id');
                   $('#main').html("");
                   $('#ajax7').show();
                   $.post('loadbill',{id:id1}, function(data){
                      $('#ajax7').hide();
                      $('#main').html(data);
                   }); 
                   });//endof deleting category
           }
       });
    $('input[type="text"]').addClass("form-control");
    $('select').addClass("form-control");
    
    
});
 
</script> 

@stop