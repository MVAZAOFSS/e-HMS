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

<div id="page-wrapper" style="background-color:#fff">
     	<ol class="breadcrumb">
            <li><a href="{{ url('home') }}">Home</a></li>
            <li class="active">Rooms </li>
            <li ><a href="{{ url("rooms/add") }}">add room </a></li>                            
        </ol>
      
<div>
<table class='table table-striped table-responsive table-bordered' id='stafftale' >
              <thead>
                  <tr class="">
                      <th> # </th>
                      <th>  Name </th>
                      <th>  Cost  </th>
                      <th> Action </th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i = 1; ?>
	                  @foreach($rooms as $m)
	                  <tr>
	                      <td>{{ $i++ }}</td>
	                       <td>{{ $m->name }}</td>
	                       <td>{{ $m->cost }}</td>
	                       <td id="{{ $m->id }}">
	                            <a href="{{url("rooms/edit/{$m->id}")}}" title="edit Room" class="editroom"><i class="glyphicon glyphicon-pencil text-info"></i> </a>&nbsp;&nbsp;
	                            <a href="#b" title="delete Room" class="deleteroom"><i class="glyphicon glyphicon-trash text-danger"></i> </a>
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
               $(".deleteroom").click(function(){
                
                var id1 = $(this).parent().attr('id');
                $(".deleteroom").show("slow").parent().find("span").remove();
                var btn = $(this).parent().parent();
                $(this).hide("slow").parent().append("<span><br>Delete? <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Y</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> N</a></span>");
                $("#no").click(function(){
                    $(this).parent().parent().find(".deleteroom").show("slow");
                    $(this).parent().parent().find("span").remove();
                });
                $("#yes").click(function(){
                    $(this).parent().html("<br><i class=''></i><span style='font-size: 11px; color:red'>deleting...</span>");
                    $.post("rooms/delete/"+id1,function(data){
                      btn.hide("slow").next("hr").hide("slow");
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