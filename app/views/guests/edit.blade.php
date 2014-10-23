@extends('layout.master')

@section('content')
<div id="wrapper">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="navbar-header">
<a class="navbar-brand visible-lg" href="{{url("/home")}}">
  <p style="color: #000">GREENLIGHT HOTEL  </p>
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
            <li><a href="{{ url("guest") }}"> Guests </a></li>
            <li class="active">Edit Guest Information</li>                   
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
<form class="form-inline">
<label class="form-label">Days</label> <input type="text" id="days" />
<button type="button" id="adddays" class="btn btn-primary">Add</button>
<!--<button type="button" id="reducedays" class="btn btn-danger">Reduce</button>-->
<button type="button" id="edit" class="btn btn-success">Edit Guest Info</button>
</form>  
<hr/>
<p id="ajax1" style="display:none;"><img src="{{url("img/load.gif")}}" > Loading . . </p>
<div id="checks">

</div>  
<hr/>
<form  id="guestform">
          <img src="{{url("img/loader.gif")}}" id="ajax" style="display:none;z-index:3000;position:absolute;margin-left: 320px; margin-top:250px">
          <div id="alrt" class="alert alert-success alert-dismissable" style="display:none;z-index:3000;position:absolute;margin-left: 170px; margin-top:250px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Successfully Guest Info Updated! ...Please wait</strong> 
          </div>
<table class="table" id="gtable" style="font-size: 12px;display:none">
            <tr>
               <td>First Name</td>
               <td>Last Name</td>
                <td>Surname</td>
            </tr> 
            <tr>
               <td><input id="fname" name="fname" type="text" value="{{$g->firstname}}" required /></td>
               <td><input id="lname" name="lname" type="text" value="{{$g->lastname}}" required /></td>
               <td><input id="surname" name="sname" type="text" value="{{$g->surname}}"  required /></td>
            </tr>
    <tr>
        <td>Sex</td>
        <td>Arrival from</td>
        <td>Next Destination</td>
    </tr>
    <tr>
        <td><select id="sex" name="sex" required >
                <option value="{{$g->sex}}">{{$g->sex}}</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select></td>
        <td><input id="arrival" name="arrival" type="text" value="{{$g->arrival_from}}" required /></td>
        <td><input id="destination" name="destination" type="text" value="{{$g->destination_to}}" required /></td>
    </tr>
            <tr>
               <td>Address</td>
               <td>Passport Number</td> 
               <td>Country</td>
            </tr>  
            <tr>
               <td><input id="address" name="address" value="{{$g->address}}"  type="text" /></td>
               <td><input id="passpost_number" name="passport_number" value="{{$g->passport_number}}" type="text" /></td>
               <td>
                  <select id="country" name="country">
                      <option value="Tanzania" value="{{$g->country}}">Tanzania</option>
                  </select>
               </td>
            </tr>
            <tr>
               <td>Id Number</td>
               <td>Professional</td> 
               <td>Company</td> 
            </tr> 
            <tr>
               <td><input id="id_number" name="id_number" value="{{$g->id_number}}" type="text" /></td>
               <td><input id="professional" name="professional" value="{{$g->professional}}" type="text" /></td>
               <td><input id="company" name="company" value="{{$g->company}}" type="text" /></td>
            </tr> 
            <tr>
               <td>Telephone</td>
               <td>Fax</td>
                <td>Mobile</td>
            </tr> 
            <tr>
               <td><input id="telophone" name="telephone" value="{{$g->telephone}}" type="text" /></td>
               <td><input id="fax" name="fax" value="{{$g->fax}}" type="text" /></td>
                <td><input id="mobile" name="mobile" type="text" value="{{$g->mobile}}" required /></td>
            </tr>        
            <tr>
               <td>Nationality</td>
               <td>Email</td> 
               <td>Rate</td> 
            </tr> 
            <tr>
               <td><input id="nationality" name="nationality" value="{{$g->nationality}}" type="text" /></td>
               <td><input id="email" name="email" type="text" value="{{$g->email}}" /></td>
               <td><input id="rate" name="rate" value="{{$g->rate}}" type="text" /></td>
            </tr> 
            <tr>
               <td>Adults</td>
               <td>Children</td>
              <td>Allegy</td> 
            </tr> 
            <tr>
               <td><input id="adults" name="adults" value="{{$g->adults}}" type="text" /></td>
               <td><input id="children" name="children" value="{{$g->children}}" type="text" /></td>
               <td rowspan="1">
                <textarea name="allegy" id="allegy" class="form-control" rows="5">{{$g->allegy}}</textarea>
               </td>
            </tr>
            <tr>
                <td>Job</td>
               <td>Discount</td>
               <td>Mode of Payment</td> 
            </tr> 
            <tr>
               <td><input id="job" name="job" value="{{$g->job}}" type="text" /></td>
               <td><input id="reservation_number" name="discount" value="{{$g->discount}}" type="text" /></td>
               <td>
                   @if($g->mode=='Cash')
                  <select id="mode" name="mode">
                     <option value="{{$g->mode}}">{{$g->mode}}</option>
                    <option id="cash">Cash</option>
                    <option id="other">Other</option>
                  </select>
                   @elseif($g->mode=='Other')
                   <select id="mode" name="mode">
                       <option value="{{$g->mode}}">{{$g->mode}}</option>
                       <option id="cash">Cash</option>
                       <option id="other">Other</option>
                   </select>
                   <input type="text" id="prepaid" name="prepaid" value="{{$g->pre_paidcost}}">
                    @endif
               </td>
            </tr>                                
            <tr>
              <td>
          
            <button type="button" id="saveguest" class="btn btn-success">Update Guest Information</button>
          
              </td>
            </tr> 
          </table> 
</form>          
</div>
</div>   
</div> 
<!-------------------------- -->


<script>



/////////////////////////////////////
$(document).ready(function (){


$('#adddays').click(function(){
      var days = $('#days').val();
      var rmid = {{$g->room_number}} ;
      var gid  = {{$g->id}} ;
      var url  = '{{$g->id}}/moredays';
       $('#checks').html("").css({
                "border":"",
                "border-radius": "",
                "background-color": '',
                "padding": ""
       });
       $('#ajax1').show();
       $('#msg1').hide('fast', function(){$('#l4').show()});
       $.post(url, {days:days, gid:gid,  rmid:rmid}, function(data){

           

           $('#ajax1').hide();
            var obj = JSON.parse(data);
             $('#l4').hide('fast', function(){
                            $('#msg1').show('fast', function(){$(this).text(obj.nid);});
              });
            $('#checks').html('Room:<b>' + obj.rom + "</b> New Departure date: <b>" + obj.checkout + "</b>").css({
                "border":"1px solid #ccc",
                "border-radius": "8px",
                "background-color": '#f5f5f5',
                "padding": "5px"
            });
      });
});  

$('#saveguest').click(function(){
      var al = $('#fname, #lname, #mobile').val();
      if(al == ""){
          alert('Please fill the form');
      }else{
      var data = $('#guestform').serializeArray();
          data.push({ name: "reservation_number", value: " " });
      $('#gtable').css('opacity', '0.2');
      $('#ajax').show();
      var url  =  "{{$g->id}}";
      $.post(url, data, function(data){
         $('#ajax').hide();
          $('#alrt').fadeIn(300, function(){
                  window.location = "{{$g->id}}";
         });
      });
    }
});


//////////////////////////////////////////////////
    var i = 0;
    $('#edit').click(function(){
        if(i == 0){
          $(this).text('Hide Edit Guest Info');
          $('#gtable').fadeIn(1000);
          i++;
        }else{
          $(this).text('Edit Guest Info');
          $('#gtable').fadeOut('fast');
          i = 0;
        }
    });


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