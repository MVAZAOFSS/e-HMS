@extends('layout.master')

@section('content')
<div id="wrapper">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="navbar-header">
<a class="navbar-brand visible-lg" href="{{url("/home")}}">
	<p style="color: #000">Notification browser</p>
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
            <li class="active"> Notifications</li>                   
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
                      <th>  From </th>
                      <th>  To  </th>
                      <th> Room </th>
                      <th>  Title  </th>
                      <th>  Sent date   </th>
                      <th>  Body  </th>
                      <th> Operation</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i = 1;  $nts = Notification::whereToAndReadAndRemoved('secretary', 'no', 'no')->get(); ?>
                    @foreach($nts as $m)
                    <tr>
                        <td>{{ $i++ }}</td>
                         <td> {{ $m->nfrom }} </td>
                         <td> You</td>
                         <td>{{Room::find(Guest::find($m->nid)->room_number)->name}}</td>
                         <td>{{ $m->title }}</td>
                         <td>{{ $m->created_at->format('Y-m-d') }}</td>
                         <td >
                            {{ $m->body }}
                        </td>
                        <td id="{{ $m->id }}">
                        	@if($m->ntype != "room repair")
                             <a href="{{url("guest/edit/{$m->nid}")}}" title="add days" class="more days"><i class="glyphicon glyphicon-plus-sign text-info"></i> Add days </a>&nbsp;&nbsp;&nbsp;
							@else
							<a href="#" title="click to show that it solved" class="edituser"><i class="glyphicon glyphicon-ok-sign text-success"></i> Solved </a>&nbsp;&nbsp;&nbsp;	
							@endif
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
            window.location = 'release';
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

               $(".edituser").click(function(){
                var id1 = $(this).parent().attr('id');
                $(".delete").show("slow").parent().find("span").remove();
                var btn = $(this).parent().parent();
                $(this).hide("slow").parent().append("<span><br>Are sure ? <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Y</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> N</a></span>");
                $("#no").click(function(){
                    $(this).parent().parent().find(".edituser").show("slow");
                    $(this).parent().parent().find("span").remove();
                });
                $("#yes").click(function(){
                    $('#msg1').hide('fast', function(){$('#l4').show()});
                    $(this).parent().html("<br><i class=''></i><span style='font-size: 11px; color:red'>saving...</span>");
                    $.post("notifications/solved/"+id1,function(data){
                      
                      btn.hide("slow").next("hr").hide("slow");
                      $('#l4').hide('fast', function(){
                            $('#msg1').show('fast', function(){$(this).text(data);});
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