@if(isset($error))
	<div class="alert alert-danger">{{$error}}</div>
@else

<center>
  @if(isset($date))
  <h4>Report of  {{$rests}} restaurants on {{$date}} </h4>
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
                      <th>  Service Time</th>
                      <th>  Foods</th>
                      <th>  Arrival date  </th>
                      <th>  Departure date  </th>
                      
                  </tr>
              </thead>
              <tbody>
                  <?php $i = 1; ?>
                  @if($rests == "all")
                    @foreach($reports as $m)
                    <?php
                    	$bill = Bill::find($m);
                    ?>
                    <tr>
                        <td>{{ $i++ }}</td>
                         <td>{{ Guest::find($bill->guestid)->firstname }}</td>
                         <td>{{ Guest::find($bill->guestid)->lastname }}</td>
                         <td>{{ Guest::find($bill->guestid)->mobile }}</td>
                         <td>{{ Room::find(Guest::find($bill->guestid)->room_number)->name }}</td>
                         <td> {{Bill::tm($bill->servicetime)}}</td>
                         <td> {{$bill->foods}}</td>
                         <td>{{ Guest::find($bill->guestid)->arrival_date }}</td>
                         <td>{{ Guest::find($bill->guestid)->departure_date }}</td>
                    </tr>
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