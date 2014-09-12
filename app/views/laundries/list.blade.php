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
<div style="margin-right: 100px; display:none">
<ul class="nav navbar-nav navbar-right">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
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
        
       <button type="button" class="btn btn-success" id="sv">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div id="page-wrapper" style="background-color:#fff">
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}">Home</a></li>
            <li><a href="{{ url('laundry/gllists') }}"> Guest Laundry Lists</a></li>
            <li class="active">Guest Laundry list</li>
        </ol>
        <form class="form-inline">
            <p>Guest : <input type="text" style="width:356px" id="guest" class="form-control" /> <button id="go" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"> GO </button></p>
        </form>     
</div>   
</div>
<?php 
  $guests = Guest::whereRaw('checked = ? and llist = ? ',  array('no', 'no'))->get();

  $data   = array();
  foreach($guests as $g){
      $data[] = $g->firstname . " " . $g->lastname . " (".Room::find($g->room_number)->name.")" ;
  }

  $json = json_encode($data);

?>
<script type="text/javascript">
    $(document).ready(function(){

        $('.tick').on('click', function(){
            var s = $(this).val();
            alert(s);
        });    

        $('#sv').on('click', function(){

            var time    = $('#time').val();
            var total   = $('#total').val();
            var gid     = $('#gid').val();

        });

        $('#guest').autocomplete({
            source:  {{ $json }}
        });

        $('#go').on('click', function(){
            var g = $('#guest').val();
            $('#loadlist').html('');
            $('#ldr').show();
            $.post('list', {g:g}, function(data){
                 $('#ldr').fadeOut('fast', function(){
                    $('#loadlist').html(data);
                 });
                 
            });
        });
    });
</script>  
@stop
