@extends('layout.master')

@section('content')
<div id="wrapper">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="navbar-header">
<a class="navbar-brand visible-lg" href="{{url("/home")}}">
	<p style="color: #000">Password manager</p>
</a>
<a class="navbar-brand hidden-lg" href='#'>
	 <p>EMIS</p>
</a>
</div>

@include('sidebar')
</nav>

<div id="page-wrapper" style="background-color:#fff">
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}">Home</a></li>
            @if(Auth::user()->role == 1)
            <li><a href="{{ url('password/users') }}">Reset Users Password</a></li>
            @endif
            <li class="active">Change Your Password</li>                    
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
          <div class="alert alert-success alert-dismissable" id="paxchg" style="display: none">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Password changed successfully!</strong> 
          </div>        
<div style="width:300px;">         
<img src="{{url("/img/loader.gif")}}"  id="loader" style="position:absolute;left:449px;top:205px;z-index:3000;display:none"/> 
{{ Form::open(array("url"=>url('password/change'),"id"=>"my_f", "style"=>"")) }}
  <div class="form-group">
    <label for="exampleInputEmail1">Old Password </label>
    <input type="password" name="olpax" class="form-control" id="olpax" placeholder="Old Password" required><br/>
    <span id="fdbk"></span>
  </div>
  <div class="form-group" id="np" style="display: none">
    <label for="exampleInputPassword1">New Password</label>
    <input type="password"  name="npax"  class="form-control" id="npax" placeholder="New Password" required><br/>
    <span id="fb"></span> 
  </div>
  <div class="form-group" id="cp" style="display: none">
    <label for="exampleInputEmail1">Confirm Password</label>
    <input type="password" name="cpax" class="form-control" id="cpax" placeholder="Confirm Password" required><br/>
    <span id="fbk"></span> 
  </div>
  <br/>
  <button id="chbtn" style="display: none" type="button" class="btn btn-success" id="change">Change Password</button>
  <br/>
</form>
</div>
</div>  
</div>  
<script type="text/javascript">
$(document).ready(function(){

  $('#chbtn').click(function(){
      $('#my_f').css('opacity', '0.2'); 
      $('#loader').show(); 
      var cpax =  $('#cpax').val();
      $.post('password/pax', {cpax:cpax}, function(data){
          if(data == "ok"){
              $('#loader').hide();
              $('#my_f').css('opacity', '1'); 
              $('#olpax, #npax, #cpax').val('');
              $('#fdbk, #fbk, #fb').html('');
              $('#np, #cp, #chbtn').hide(); 
              $('#paxchg').fadeIn('fast', function(){
                  $(this).fadeOut(3000);
              }); 
          }
      }); 
  });


  ////////////////////////////////////////////////

  var strtext  = ["weak", "average", "strong"];
  var strcolor = ["#c00", "#f80", "#080"];
  $('#npax').keyup(function(){
      var pass   = $(this).val();
      var uc  = pass.match(/[A-Z]/g);
      uc = (uc && uc.length || 0);

      var nm = pass.match(/\d/g);
      nm  = (nm && nm.length || 0);

      var nw = pass.match(/\W/g);
      nw = (nw && nw.length || 0);

      var s = pass.length + uc + (nm*2) + (nw*3);

      s = Math.min(Math.floor(s / 10), 2);

      var sw = strtext[s];
      if(sw != "weak"){
          /*if(sw != "average"){
             $('#cp').show();  
          }else{
            $('#cp').hide(); 
          }*/
          $('#cp').show(); 
      }else{
          $('#cp').hide();        
      }
      $('#fb').html(strtext[s]).css('color', strcolor[s]);

  });
//////////////////////////////////////////////////////////////

 
  $('#cpax').keyup(function(){
      var nlt = $('#npax').val().length;
      var cl = $(this).val().length;
      $('#fbk').html('checking .. ').css('color', 'black');  
      if(cl >= nlt){
         var newpass = $('#npax').val(); 
         var conpass = $('#cpax').val();
         if(newpass == conpass){
          $('#chbtn').show();
          $('#fbk').html('Password Matches ...').css('color', 'green'); 
         }else{
          $('#chbtn').hide();
          $('#fbk').html('Password mismatches ...').css('color', 'red');          
         }          
      }else if(cl == 0){
         $('#chbtn').hide();
        $('#fbk').html('checking ..').css('color', 'black'); 
      }else{
         $('#chbtn').hide();
         $('#fbk').html('checking ..').css('color', 'black'); 
      }
  });




  ///////////////////////////////////////////////////
  $('#olpax').keyup(function(){
      var olpax = $(this).val();
      var l = olpax.length;
      $('#fdbk').html('checking ...').css('color','black');
      if(l != 0){
         $('#fdbk').html('checking ...').css('color','black');       
        if(l >= 4){
        $('#fdbk').html('checking ...').css('color','black');
          $.post('password/change', {olpax:olpax}, function(data){
            if(data == "good"){
                $('#fdbk').html('Matches ...').css('color','green');
                $('#np').fadeIn(1000);
            }else{
                $('#fdbk').html('Mismatches please try again').css('color','red');
                $('#np').fadeOut(1000);
            }
          });
        }else{ 
            $('#fdbk').html('checking ...').css('color','black');
            $('#np').fadeOut();           
        }
      }else{
         
        $('#np').fadeOut(1000); 
      }
  });
});
</script>
@stop