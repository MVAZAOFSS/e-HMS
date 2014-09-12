@extends('layout.master')

@section('content')
<div id="wrapper">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="navbar-header">
<a class="navbar-brand visible-lg" href="{{url("/home")}}">
  <p style="color: #000">Guest register</p>
</a>
<a class="navbar-brand hidden-lg" href='#'>
   <p>EMIS</p>
</a>
</div>
@include('layout-setup')
@include('sidebar')
</nav>

<div id="page-wrapper" style="background-color:#fff" >
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}">Home</a></li>
            <li><a href="{{ url('guest') }}">Guests</a></li>

            <li class="active">Guest register</li>                    
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
<table class="table" style="" id="myT">
  <tr style="width: 100%" >
    <td valign="top" style="width: 70%">
 <h5><b>Available Rooms:</b></h5><hr/>     
<table class='table table-striped table-responsive table-bordered' id='stafftale' >
              <thead>
                  <tr class="">
                      <th> # </th>
                      <th>  Name </th>
                      <th>  Cost  </th>
                      <th>  status </th>
                      <th> Arrival date</th>
                      <th> Departure date</th>
                      <th> Operation  </th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i = 1; ?>
                    @foreach($rooms as $m)
                    <tr>
                        <td>{{ $i++ }}</td>
                         <td>{{ $m->name }}</td>
                         <td>{{ $m->cost }}</td>
                         <td>{{ $m->status }}</td>
                         <td> 
                          @if($m->status == "reserved")
                          {{ $m->checkin }}
                          @else
                            -
                          @endif
                         </td>
                         <td> 
                          @if($m->status == "reserved")
                          {{ $m->checkout }}
                          @else
                            -
                          @endif
                        </td>
                         <td id="{{ $m->id }}">
                              <button type="button" id="delete" class="btn btn-danger btn-xs deleteroom">Add Guest</button>  
                         </td>
                    </tr>
                    @endforeach
               
              </tbody>
          </table>
    </td>
    <td valign="top" style="width: 30%">
          <p style="display:none" id="lod"><img style="width:24px" src="{{url("/img/load.gif")}}" /> Loading . . .</p>
      <div id="checks" style="background-color: #f5f5f5; padding:9px; display:none;font-size:11px; border-radius:8px">   
         <div class="form-group">
          <label for="exampleInputEmail1">Check In (Arrival date)</label>
          <input type="text" name="name" class="form-control" id="checkin" placeholder="" required>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Check Out (Departure date)</label>
          <input type="text" name="cost" class="form-control" id="checkout" placeholder="" required>
        </div>
      <form id="guestform">  
      <input type="hidden" id="rmId" name="rmId" value="3" /> 
      <button type="button" id="btncheck" class="btn btn-primary btn-xs">Checking</button>        
      </div>
      <div id="fdk"></div>
    </td>
  </tr>  
</table>   
</div>
</div>   
</div> 
<!-------------------------- -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">GUEST REGISTRATION FORM</h4>
      </div>
      <div class="modal-body" style="height: 420px; overflow:scroll">
          <img src="{{url("img/loader.gif")}}" id="ajax" style="display:none;z-index:3000;position:absolute;margin-left: 230px; margin-top:100px">
          <div id="alrt" class="alert alert-success alert-dismissable" style="display:none;z-index:3000;position:absolute;margin-left: 160px; margin-top:100px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Successfully added! ...Please wait</strong> 
          </div>
          <table class="table" id="gtable" style="font-size: 12px;">
            <tr>
               <td>First Name</td>
               <td>Last Name</td> 
               <td>Mobile</td> 
            </tr> 
            <tr>
               <td><input id="fname" name="fname" type="text" required /></td>
               <td><input id="lname" name="lname" type="text" required /></td>
               <td><input id="mobile" name="mobile" type="text" required /></td>
            </tr> 
            <tr>
               <td>Address</td>
               <td>Passport Number</td> 
               <td>Country</td>
            </tr>  
            <tr>
               <td><input id="address" name="address" type="text" /></td>
               <td><input id="passpost_number" name="passport_number" type="text" /></td>
               <td>
                  <select id="country" name="country">
                      <option value="Tanzania">Tanzania</option>
                  </select>
               </td>
            </tr>
            <tr>
               <td>Id Number</td>
               <td>Professional</td> 
               <td>Company</td> 
            </tr> 
            <tr>
               <td><input id="id_number" name="id_number" type="text" /></td>
               <td><input id="professional" name="professional" type="text" /></td>
               <td><input id="company" name="company" type="text" /></td>
            </tr> 
            <tr>
               <td>Telephone</td>
               <td>Fax</td> 
               <td>Job</td> 
            </tr> 
            <tr>
               <td><input id="telophone" name="telephone" type="text" /></td>
               <td><input id="fax" name="fax" type="text" /></td>
               <td><input id="job" name="job" type="text" /></td>
            </tr>        
            <tr>
               <td>Nationality</td>
               <td>Email</td> 
               <td>Rate</td> 
            </tr> 
            <tr>
               <td><input id="nationality" name="nationality" type="text" /></td>
               <td><input id="email" name="email" type="text" /></td>
               <td><input id="rate" name="rate" type="text" /></td>
            </tr> 
            <tr>
               <td>Adults</td>
               <td>Children</td>
               <td>Allegy</td> 
            </tr> 
            <tr>
               <td><input id="adults" name="adults" type="text" /></td>
               <td><input id="children" name="children" type="text" /></td>
               <td rowspan="3">
                <textarea name="allegy" id="allegy" class="form-control" rows="5"></textarea>
               </td>
            </tr>
            <tr>
               <td>Discount</td>
               <td>Mode of Payment</td> 
            </tr> 
            <tr>
               <td><input id="discount" name="discount" type="text" /></td>
               <td>
                  <select id="mode" name="mode">
                    <option>Cash</option>
                    <option>Other</option>
                  </select>
               </td>
            </tr>                                
          </table>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" id="saveguest" class="btn btn-success">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>

<script>

function checking(r_no){
  var t = r_no.value;
  if(t == ""){
    $('#fd').hide();
  }else{
    $('#fd').show();
    $('#f').html('').css({
            "color": "", "font-size":""
          });
    $.post('rno', {t:t}, function(data){
         $('#fd').hide();
        if(data == "yes"){
          $('#regguest').show();
        }else{
          $('#f').html('already! taken ...').css({
            "color": "red", "font-size":"12px"
          });
          $('#regguest').hide();
        }
    });
  }
  
}

$('#saveguest').click(function(){

      var f  =  $('#r_no').val();
      if(f == ""){
          alert('Please fill reservation number first');
      }else{
        var al = $('#fname, #lname, #mobile').val();
        if(al == ""){
            alert('Please fill the form');
        }else{
        var data = $('#guestform').serializeArray();
            if(f == null){   data.push({ name: "reservation_number", value: "" }); }else{
               data.push({ name: "reservation_number", value: Number($('#r_no').val()) });
            }

        $('#gtable').css('opacity', '0.2');
        $('#ajax').show();
        
        $.post('add', data, function(json){
           $('#ajax').hide();
           $('#alrt').fadeIn(300, function(){
                    window.location = 'list';
           });
           //alert(json);
        });
      }  
    }
});


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
<script type="text/javascript">
  $(document).ready(function(){
      $('#checkin, #checkout').datepicker({
         minDate : 0,
         showAnim: "drop",
         changeMonth: true,
         changeYear: true,
         dateFormat: "yy-mm-dd"
      });

      $('#btncheck').click(function(){
          var checkin    = $('#checkin').val();
          var checkout   = $('#checkout').val();
          var rmid = $('#rmId').val();
          if(checkin == "" && checkout==""){

          }else{
              $('#checks').hide('fast', function(){$('#lod').show()});
              $.post('roomcheck', { room:rmid, checkin:checkin, checkout:checkout}, function(data){
                  $('#lod').hide();
                  var obj = JSON.parse(data);
                   if(obj.msg == "occupied"){
                      $('#fdk').html('Room: <span style="color: blue">' + obj.room + '</span><br/> status: <span style="color: red"> occupied </span> <br/> Available date: <span style="color: green">' + obj.checkout + ' </span>').css({
                        'color': 'black',
                        'padding': '6px',
                        'border': '1px solid #ccc',
                        'border-radius': '7px',
                        'background-color': '#f5f5f5'
                      });
                   }else if(obj.msg == "available"){
                       
                       var bk = obj.res;
                       if(bk == "sio"){
                            $('#fdk').html('Room: <span style="color: blue">' + obj.room + '</span><br/> status: <span style="color: green"> available </span> <br/> <hr/><button class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal">Register Guest</button>').css({
                             'color': 'black',
                             'padding': '6px',
                             'border': '1px solid #ccc',
                             'border-radius': '7px',
                             'background-color': '#f5f5f5'
                            });
                       }else{
                            $('#fdk').html('Room: <span style="color: blue">' + obj.room + '</span><br/> status: <span style="color: green"> available </span> <br/>Enter Reservation Number <br/><input type="text" name="r_no" id="r_no" onkeyup="checking(this)" /> <span style="display:none" id="fd"><img src="{{url("img/load.gif")}}" /></span><br/><span id="f"></span><hr/><button id="regguest" style="display:none" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal">Register Guest</button>').css({
                             'color': 'black',
                             'padding': '6px',
                             'border': '1px solid #ccc',
                             'border-radius': '7px',
                             'background-color': '#f5f5f5'
                            });
                       }
                   }else if(obj.msg == "reserved"){

                        var bk = obj.res;
                        if(bk == "sio"){
                            $('#fdk').html('Room: <span style="color: blue">' + obj.room + '</span><br/> status: <span style="color: orange"> reserved!  </span> <br/> <hr/><button class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal">Register Guest</button>').css({
                            'color': 'black',
                            'padding': '6px',
                            'border': '1px solid #ccc',
                            'border-radius': '7px',
                            'background-color': '#f5f5f5'
                          });
                        }else{
                            $('#fdk').html('Room: <span style="color: blue">' + obj.room + '</span><br/> status: <span style="color: green"> reserved! </span> <br/>Enter Reservation Number <br/><input type="text" name="r_no" id="r_no" onkeyup="checking(this)" /> <span style="display:none" id="fd"><img src="{{url("img/load.gif")}}" /></span><br/><span id="f"></span><hr/><button id="regguest" style="display:none" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal">Register Guest</button>').css({
                             'color': 'black',
                             'padding': '6px',
                             'border': '1px solid #ccc',
                             'border-radius': '7px',
                             'background-color': '#f5f5f5'
                            });
                        }
                   }else if(obj.msg == "ereserved"){
                        $('#fdk').html('Room: <span style="color: blue">' + obj.room + '</span><br/> status: <span style="color: orange"> occupied ! checking date again </span><br />Before date: '+ obj.checkin +'  <br/> <hr/>').css({
                        'color': 'black',
                        'padding': '6px',
                        'border': '1px solid #ccc',
                        'border-radius': '7px',
                        'background-color': '#f5f5f5'
                      });
                   }
              });
          } 
      });

  });
</script>
@stop