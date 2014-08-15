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

@stop