
@if(isset($error))
	<div class="alert alert-danger">
		<span class="glyphicon glyphicon-warning-sign"></span> {{$error}}
	</div>
@else

<?php 
  $rn=0;
  $pn=0; 
?>
@if(isset($month)&&isset($mYear) || isset($year) || isset($start) || isset($date))

@else
  @foreach($reports as $m)
    @if(Guest::find($m->guestid)->checked == "yes")
        $pn = $pn + 1;
     @endif 
  @endforeach 
  @foreach($reports as $m)
      @if(Guest::find($m->guestid)->reservation_number != "")
          $rn = $rn + 1;
       @endif 
  @endforeach 
@endif

<center>
  @if(isset($date))
  <h4>Report of  {{$rms}} Guests on {{$date}} </h4>
  @endif
  @if(isset($start) && isset($end))
    @if(isset($month)&&isset($mYear))
      <h4>Report of  {{$rms}} Guests in {{$month}}, {{$mYear}}</h4>
    @else
     <h4>Report of  {{$rms}} Guests from {{$start}} to {{$end}}</h4>
    @endif
  @endif
  @if($rms == "all")
  <h5>Total number of {{$rms}} guests: {{count($reports)}}</h5>
  @endif
  @if($rms == "reserved")
  <h5>Total number of {{$rms}} guests: {{$rn}}</h5>
  @endif
  @if($rms == "paid")
  <h5>Total number of {{$rms}} guests: {{$pn}}</h5>
  @endif    
</center>
<div>
<hr/>	
<table class='table table-striped table-responsive table-bordered' id='stafftale' >
              <thead>
                  <tr class="">
                      <th> # </th>
                      <th>  First Name </th>
                      <th>  Last Name  </th>
                      <th>  Mobile  </th>
                      <th>  Room   </th>
                      <th>  Arrival date  </th>
                      <th>  Departure date  </th>
                      
                  </tr>
              </thead>
              <tbody>
                  <?php $i = 1; ?>
                  @if($rms == "all")
                    @foreach($reports as $m)
                    <tr>
                        <td>{{ $i++ }}</td>
                         <td>{{ Guest::find($m->guestid)->firstname }}</td>
                         <td>{{ Guest::find($m->guestid)->lastname }}</td>
                         <td>{{ Guest::find($m->guestid)->mobile }}</td>
                         <td>{{ Room::find(Guest::find($m->guestid)->room_number)->name }}</td>
                         <td>{{ Guest::find($m->guestid)->arrival_date }}</td>
                         <td>{{ Guest::find($m->guestid)->departure_date }}</td>
                    </tr>
                    @endforeach
                  @endif

                  @if($rms == "reserved")
                    @foreach($reports as $m)
                      @if(Guest::find($m->guestid)->reservation_number != "")
                        <tr>
                            <td>{{ $i++ }}</td>
                             <td>{{ Guest::find($m->guestid)->firstname }}</td>
                             <td>{{ Guest::find($m->guestid)->lastname }}</td>
                             <td>{{ Guest::find($m->guestid)->mobile }}</td>
                             <td>{{ Room::find(Guest::find($m->guestid)->room_number)->name }}</td>
                             <td>{{ Guest::find($m->guestid)->arrival_date }}</td>
                             <td>{{ Guest::find($m->guestid)->departure_date }}</td>
                        </tr>
                       @endif 
                    @endforeach 
                  @endif    

                  @if($rms == "paid")
                    @foreach($reports as $m)
                      @if(Guest::find($m->guestid)->checked == "yes")
                        <tr>
                            <td>{{ $i++ }}</td>
                             <td>{{ Guest::find($m->guestid)->firstname }}</td>
                             <td>{{ Guest::find($m->guestid)->lastname }}</td>
                             <td>{{ Guest::find($m->guestid)->mobile }}</td>
                             <td>{{ Room::find(Guest::find($m->guestid)->room_number)->name }}</td>
                             <td>{{ Guest::find($m->guestid)->arrival_date }}</td>
                             <td>{{ Guest::find($m->guestid)->departure_date }}</td>
                        </tr>
                       @endif 
                    @endforeach 
                  @endif 

                  
                  

               
              </tbody>
 </table> 
</div>	

<script>



/////////////////////////////////////
$(document).ready(function (){
    $("#stafftale").dataTable({
            "bJQueryUI": true,
            "sDom": '<"H"Tfr>t<"F"ip>',
			"oTableTools": {
				"sSwfPath": "{{url("DataTables/TableTools/swf/copy_cvs_xls_pdf.swf")}}",
				"aButtons": [
					"print","xls",
					{
                        "sExtends": "pdf",
                        "sTitle": "Report Name",
                        "sPdfMessage": "Summary Info",
                        "sPdfOrientation": "landscape" 
					}
				]
			},
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
    
    
    
});
</script> 
@endif