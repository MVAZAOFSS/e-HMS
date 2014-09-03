@extends('layout.master')
@section('content')
<div id="wrapper">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="navbar-header">
<a class="navbar-brand visible-lg" href="{{url("/home")}}">
  <p style="color: #000">Checkout browser</p>
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
            <li class="active">Checkouts today</li>
            <li><a href="{{ url("guest") }}"> Guests</a></li> 
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
                      <th>  Full name   </th>
                      <th>  Mobile      </th>
                      <th>  Room        </th>
                      <th>  Arrival date</th>
                      <th>  Departure date</th>
                      <th>  Days spent</th>
                      <th>  Operations  </th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i = 1;  
                   $guests = Guest::where('departure_date', date("Y-m-d"))->get(); ?>
                    @foreach($guests as $m)
                    <tr>
                        <td>{{ $i++ }}</td>
                         <td>{{$m->firstname}} {{$m->middlename}} {{$m->lastname}}</td>
                         <td>{{ $m->mobile }}</td>
                         <td>{{ Room::find($m->room_number)->name }}</td>
                         <td>{{ $m->arrival_date }}</td>
                         <td>{{ $m->departure_date }}</td>
                         <td>{{Guest::daysSpent($m->arrival_date, $m->departure_date)}}</td>
                         <td><a class="btn btn-success btn-xs" href="{{url('view_den/'.$m->id)}}"><span class="glyphicon glyphicon-share-alt"></span> Details</a></td>
                    </tr>
                    @endforeach
               
              </tbody>
 </table>   
</div>
</div>   
</div> 
<script>
$(document).ready(function (){
   $("#stafftale").dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
           "fnDrawCallback": function( oSettings ) {
               $(".deletedrink").click(function(){
                var id1 = $(this).parent().attr('id');
                $(".deletedrink").show("slow").parent().find("span").remove();
                var btn = $(this).parent().parent();
                $(this).hide("slow").parent().append("<span><br>Confirm? <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Y</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> N</a></span>");
                $("#no").click(function(){
                    $(this).parent().parent().find(".deletedrink").show("slow");
                    $(this).parent().parent().find("span").remove();
                });
                $("#yes").click(function(){
                    $('#msg').hide('fast', function(){$('#l').show()});
                    $(this).parent().html("<br><i class=''></i><span style='font-size: 11px; color:red'>confirm...</span>");
                    $.post("messages/"+id1,function(data){
                      btn.hide("slow").next("hr").hide("slow");
                      $('#l').hide('fast', function(){
                            $('#msg').show('fast', function(){$(this).text(data);});
                      });
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
    function incompleteDetails(id){
        var urlz="<?php echo url('view');?>";
    $.get(urlz+'/'+id,function(data){
        $('.main').html(data);
    });
}

</script>
@stop