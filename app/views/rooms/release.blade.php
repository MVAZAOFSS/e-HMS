@extends('layout.master')

@section('content')
<div id="wrapper">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="navbar-header">
<a class="navbar-brand visible-lg" href="{{url("/home")}}">
	<p style="color: #000">Rooms browser</p>
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
        <h4 class="modal-title" id="myModalLabel">Add days request</h4>
      </div>
      <div class="modal-body">
        <img src="{{url("img/loader.gif")}}" id="ajax" style="display:none;z-index:3000;position:absolute;margin-left: 230px; margin-top:20px">
          <div id="alrt" class="alert alert-success alert-dismissable" style="display:none;z-index:3000;position:absolute;margin-left: 160px; margin-top:20px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Successfully sent! ...Please wait</strong> 
        </div>
        <table class="table" id="gtable" style="font-size: 12px;">
            <tr>
               <td></td>
               <td>Days to add</td>  
            </tr> 
            <tr>
               <td></td>
               <td>
                <input id="days" name="days" type="text" required />
                <input id="rn"  name="rn" type="hidden" value="" />
               </td>
            </tr>
        </table>    
      </div>
      <div class="modal-footer">
        <button type="button" id="send" class="btn btn-primary">Send to Secreatary</button>
      </div>
    </div>
  </div>
</div>



<div id="page-wrapper" style="background-color:#fff">
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}">Home</a></li>
            <li class="active">Rooms release</li> 
            <li><a href="{{ url('rooms/requests') }}"> view add days requests</a></li>                   
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
                      <th>  Arrival date  </th>
                      <th>  Operation  </th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i = 1;  $guests = Guest::whereRaw('reserved = ? and departure_date = ? and released = ?' , array('no', date("Y-m-d"), "no"))->get(); ?>
                    @foreach($guests as $m)
                    <tr>
                        <td>{{ $i++ }}</td>
                         <td>{{ $m->firstname }}</td>
                         <td>{{ $m->lastname }}</td>
                         <td>{{ $m->mobile }}</td>
                         <td>{{ Room::find($m->room_number)->name }}</td>
                         <td>{{ $m->arrival_date }}</td>
                         <td id="{{ $m->id }}">
                            <a href="#" class="deletedrink1"><button data-toggle="modal" data-target="#myModal" type="button" class="btn btn-success btn-xs "><span class="glyphicon glyphicon-plus-sign"></span> Add days </button></a>
                            <a href="#" class="deletedrink"><button type="button" class="btn btn-primary btn-xs "><span class="glyphicon glyphicon-check"></span> Release </button></a>
                         </td>
                    </tr>
                    @endforeach
               
              </tbody>
 </table>
</div>
</div>   
</div>  
<script>

$('#send').click(function(){


  var days = $('#days').val();
  var rn   = $('#rn').val();

  if(days==""){
      alert('Please fill the empty spaces');
  }else{
    $('#gtable').css('opacity', '0.2');
    $('#ajax').show();
    $.post('addday', { d:days, r:rn}, function(data){
          $('#ajax').hide();
          $('#alrt').fadeIn('fast', function(){
            window.location = 'requests';
          });
    });
  }
  
});

/////////////////////////////////////
$(document).ready(function (){
   $("#stafftale").dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
           "fnDrawCallback": function( oSettings ) {

               $(".deletedrink1").click(function(){ 
                 var id1 = $(this).parent().attr('id');
                   $('#rn').val(id1);
               });

               $(".deletedrink").click(function(){
                var id1 = $(this).parent().attr('id');
                $(".deletedrink").show("slow").parent().find("span").remove();
                var btn = $(this).parent().parent();
                $(this).hide("slow").parent().append("<span><br>Are sure, releasing ? <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Y</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> N</a></span>");
                $("#no").click(function(){
                    $(this).parent().parent().find(".deletedrink").show("slow");
                    $(this).parent().parent().find("span").remove();
                });
                $("#yes").click(function(){
                    $('#msg').hide('fast', function(){$('#l').show()});
                    $(this).parent().html("<br><i class=''></i><span style='font-size: 11px; color:red'>releasing...</span>");
                    $.post("release/"+id1,function(data){
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
@stop