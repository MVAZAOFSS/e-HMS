@if(isset($error))
<img src="{{url("img/load.gif")}}" id="ajax5" style="width:52px;display:none;z-index:3000;position:absolute;margin-left: 230px; margin-top:120px">
          <div id="alrt" class="alert alert-success alert-dismissable" style="display:none;z-index:3000;position:absolute;margin-left: 160px; margin-top:50px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Successfully added! redirecting ....</strong> 
          </div>
<table class="table table-bordered" id="gt">
	<tr style="background-color: #f5f5f5">
		<th>
			<div class="alert alert-danger">
					{{$error}}
			</div>
		</th>
		<th>
			<select class="form-control" id="time">
				<option value="{{$stime}}"> {{$stime}} </option>
		        <option value=""></option>
		        <option value="1">Break fast</option>
		        <option value="2">Lunch</option>
		        <option value="3">Supper</option>
		        <option value="4">Dinner</option>
		        <option value="5">Neither</option>
		        <option value="all"> bill history</option>
		    <select> 
		    <input id="gb" value="{{$g}}" type="hidden" /> 
		</th>
	</tr>	
</table>

@else

	@if(Auth::user()->role == 7)

		<?php

		$foods  = explode("," , $bi->foods);
		$fds    = array_pop($foods);

		$unique = array_keys(array_count_values($foods));
		$l      = count($unique);
        $idadi=$bi->no_foods;

		?>
		<p> Name: {{ Guest::find($bi->guestid)->firstname }} {{ Guest::find($bi->guestid)->lastname }} Room {{ Room::find(Guest::find($bi->guestid)->room_number)->name }} </p>
		<img src="{{url("img/load.gif")}}" id="ajax5" style="width:52px;display:none;z-index:3000;position:absolute;margin-left: 230px; margin-top:120px">
		          <div id="alrt" class="alert alert-success alert-dismissable" style="display:none;z-index:3000;position:absolute;margin-left: 160px; margin-top:50px">
		            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		            <strong>Successfully added! redirecting ....</strong>
		          </div>
		<table class="table table-bordered" id="gt">
			<tr style="background-color: #f5f5f5">
				<th>Food</th>
                <th>No Foods</th>
				<th>Times</th>
				<th>Each cost</th>
				<th>Total cost</th>
				<th>
					<select class="form-control" id="time">
			<option value="{{$bi->servicetime}}">{{Bill::tm($bi->servicetime)}}</option>
				        <option value=""></option>
				        <option value="1">Break fast</option>
				        <option value="2">Lunch</option>
				        <option value="3">Supper</option>
				        <option value="4">Dinner</option>
				        <option value="5">Neither</option>
				        <option value="all"> bill history</option>
				    <select>
				</th>
			</tr>
			<?php $total = 0; ?>
			@for($i=0; $i<$l; $i++)
				<tr>
					<td>{{$unique[$i]}}</td>
                    <td>{{$idadi[$i]}}</td>
					<td>{{Bill::appears($unique[$i], $foods)}}</td>
					<td>{{Restaurant::where('name', $unique[$i])->first()->cost}} /=</td>
					<td>{{($idadi[$i])*(Restaurant::where('name', $unique[$i])->first()->cost)}} /=</td>
				</tr>
			<?php $total = $total + (($idadi[$i])*(Restaurant::where('name', $unique[$i])->first()->cost)); ?>
			@endfor
			<tr style="background-color: #f5f5f5">
				<td ></td>
				<td></td>
				<td><b>Total</b></td>
				<td id="ttl">
					{{$total}} /=
				</td>
			</tr>
			@if($bi->paymentmode == "cash")
				<tr>
					<td><b>Payment<b></td>
					<td>Cash</td>
					<td><b>Amount paid </b></td>
					<td>{{$bi->amount}}</td>
					<td><b>served by</b> <br/>{{User::find($bi->added_by)->firstname}}{{User::find($bi->added_by)->lastname}}  </td>
				</tr>
				@if($bi->remain != 0)
				<tr>
				<td style="background-color: #f5f5f5"></td>
				<td style="background-color: #f5f5f5"></td>
				<td ><b>Enter Amount</b></td>
					<td style="background-color: #f5f5f5">
						<input type="text" class="form-control" id="amountb" value="" />
					</td>
				<td style="background-color: #f5f5f5">
					<input id="guestidb" value="{{$bi->id}}" type="hidden" />
					<input id="gb" value="{{$bi->guestid}}" type="hidden" />
					<input id="totalb" value="{{$total}}" type="hidden" />
					<input id="servtb" value="{{$bi->servicetime}}" type="hidden" />
					<button type="button" id="svb" class="btn btn-success">Update bill </button></td>
				</tr>
				@endif

			@else
				<tr>
					<td><b>Payment<b></td>
					<td>credit</td>
					<td><b>Amount paid </b></td>
					<td>{{$bi->amount}}</td>
					<td><b>served by</b><br/>
						<input id="gb" value="{{$bi->guestid}}" type="hidden" />
						{{User::find($bi->added_by)->firstname}} {{User::find($bi->added_by)->lastname}}  </td>
				</tr>
				@if($bi->amount == 0)
				<tr>
				<td style="background-color: #f5f5f5"></td>
				<td style="background-color: #f5f5f5"></td>
				<td ><b>Enter Amount</b></td>
					<td style="background-color: #f5f5f5">
						<input type="text" class="form-control" id="amountb" value="" />
					</td>
				<td style="background-color: #f5f5f5">
					<input id="guestidb" value="{{$bi->id}}" type="hidden" />
					<input id="gb" value="{{$bi->guestid}}" type="hidden" />
					<input id="totalb" value="{{$total}}" type="hidden" />
					<input id="servtb" value="{{$bi->servicetime}}" type="hidden" />
					<button type="button" id="svb" class="btn btn-success">Update bill </button></td>
				</tr>
				@else
					@if($bi->remain != 0)
					<tr>
					<td style="background-color: #f5f5f5"></td>
					<td style="background-color: #f5f5f5"></td>
					<td ><b>Enter Amount</b></td>
						<td style="background-color: #f5f5f5">
							<input type="text" class="form-control" id="amountb" value="" />
						</td>
					<td style="background-color: #f5f5f5">
						<input id="guestidb" value="{{$bi->id}}" type="hidden" />
						<input id="gb" value="{{$bi->guestid}}" type="hidden" />
						<input id="totalb" value="{{$total}}" type="hidden" />
						<input id="servtb" value="{{$bi->servicetime}}" type="hidden" />
						<button type="button" id="svb" class="btn btn-success">Update bill </button></td>
					</tr>
					@endif
				@endif
			@endif
		</table>

	@elseif(Auth::user()->role == 8)
          <?php

		$foods  = explode("," , $bi->foods);
		$fds    = array_pop($foods);

		$unique = array_keys(array_count_values($foods));
		$l      = count($unique);
        $idadi=$bi->no_foods;

		?>
		<p> Name: {{ Guest::find($bi->guestid)->firstname }} {{ Guest::find($bi->guestid)->lastname }} Room {{ Room::find(Guest::find($bi->guestid)->room_number)->name }} </p>
		<img src="{{url("img/load.gif")}}" id="ajax5" style="width:52px;display:none;z-index:3000;position:absolute;margin-left: 230px; margin-top:120px">
		          <div id="alrt" class="alert alert-success alert-dismissable" style="display:none;z-index:3000;position:absolute;margin-left: 160px; margin-top:50px">
		            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		            <strong>Successfully added! redirecting ....</strong> 
		          </div>
		<table class="table table-bordered" id="gt">
			<tr style="background-color: #f5f5f5">
				<th>Food</th>
                <th>No Foods</th>
				<th>Times</th>
				<th>Each cost</th>
				<th>Total cost</th>
				<th>
			<select class="form-control" id="time">
			<option value="{{$bi->servicetime}}">{{Bill::tm($bi->servicetime)}}</option>
				        <option value=""></option>
				        <option value="1">Break fast</option>
				        <option value="2">Lunch</option>
				        <option value="3">Supper</option>
				        <option value="4">Dinner</option>
				        <option value="5">Neither</option>
				        <option value="all"> bill history</option>
				    <select>  
				</th>
			</tr>	
			<?php $total = 0; ?>
			@for($i=0; $i<$l; $i++)
				<tr>
					<td>{{$unique[$i]}}</td>
                    <td>{{$idadi[$i]}}</td>
					<td>{{Bill::appears($unique[$i], $foods)}}</td>
					<td>{{Restaurant::where('name', $unique[$i])->first()->cost}} /=</td>
					<td>{{($idadi[$i])*(Restaurant::where('name', $unique[$i])->first()->cost)}} /=</td>
				</tr>
			<?php $total = $total + (($idadi[$i])*(Restaurant::where('name', $unique[$i])->first()->cost)); ?>
			@endfor	
			<tr style="background-color: #f5f5f5">
                <td></td>
				<td></td>
				<td></td>
				<td><b>Total</b></td>
				<td id="ttl">
					{{$total}} /=
				</td>
			</tr>
			@if($bi->paymentmode == "cash")
				<tr>
					<td><b>Payment<b></td>
					<td>Cash</td>
					<td><b>Amount paid </b></td>
					<td>{{$bi->amount}}</td>
					<td><b>served by</b> <br/>{{User::find($bi->added_by)->firstname}}{{User::find($bi->added_by)->lastname}}  </td>
				</tr>	
				@if($bi->remain != 0)
				<tr>
				<td style="background-color: #f5f5f5"></td>	
				<td style="background-color: #f5f5f5"></td>	
				<td ><b>Enter Amount</b></td>
					<td style="background-color: #f5f5f5">
						<input type="text" class="form-control" id="amountb" value="" />
					</td>
				<td style="background-color: #f5f5f5">
					<input id="guestidb" value="{{$bi->id}}" type="hidden" />
					<input id="gb" value="{{$bi->guestid}}" type="hidden" />
					<input id="totalb" value="{{$total}}" type="hidden" />
					<input id="servtb" value="{{$bi->servicetime}}" type="hidden" /> 
					<button type="button" id="svb" class="btn btn-success">Update bill </button></td>	
				</tr>
				@endif

			@else
				<tr>
					<td><b>Payment<b></td>
					<td>credit</td>
					<td><b>Amount paid </b></td>
					<td>{{$bi->amount}}</td>
					<td><b>served by</b><br/> 
						<input id="gb" value="{{$bi->guestid}}" type="hidden" />
						{{User::find($bi->added_by)->firstname}} {{User::find($bi->added_by)->lastname}}  </td>
				</tr>
				@if($bi->amount == 0)
				<tr>
				<td style="background-color: #f5f5f5"></td>	
				<td style="background-color: #f5f5f5"></td>	
				<td ><b>Enter Amount</b></td>
					<td style="background-color: #f5f5f5">
						<input type="text" class="form-control" id="amountb" value="" />
					</td>
				<td style="background-color: #f5f5f5">
					<input id="guestidb" value="{{$bi->id}}" type="hidden" />
					<input id="gb" value="{{$bi->guestid}}" type="hidden" />
					<input id="totalb" value="{{$total}}" type="hidden" />
					<input id="servtb" value="{{$bi->servicetime}}" type="hidden" /> 
					<button type="button" id="svb" class="btn btn-success">Update bill </button></td>	
				</tr>
				@else
					@if($bi->remain != 0)
					<tr>
					<td style="background-color: #f5f5f5"></td>	
					<td style="background-color: #f5f5f5"></td>	
					<td ><b>Enter Amount</b></td>
						<td style="background-color: #f5f5f5">
							<input type="text" class="form-control" id="amountb" value="" />
						</td>
					<td style="background-color: #f5f5f5">
						<input id="guestidb" value="{{$bi->id}}" type="hidden" />
						<input id="gb" value="{{$bi->guestid}}" type="hidden" />
						<input id="totalb" value="{{$total}}" type="hidden" />
						<input id="servtb" value="{{$bi->servicetime}}" type="hidden" /> 
						<button type="button" id="svb" class="btn btn-success">Update bill </button></td>	
					</tr>
					@endif
				@endif
			@endif	
		</table>
    @else
	
		<?php

		$foods  = explode("," , $bi->drinks);
		$fds    = array_pop($foods);

		$unique = array_keys(array_count_values($foods));
		$l      = count($unique);
        $idadi  = $bi->no_drinks;

		?>
		<p> Name: {{ Guest::find($bi->guestid)->firstname }} {{ Guest::find($bi->guestid)->lastname }} Room {{ Room::find(Guest::find($bi->guestid)->room_number)->name }} </p>
		<img src="{{url("img/load.gif")}}" id="ajax5" style="width:52px;display:none;z-index:3000;position:absolute;margin-left: 230px; margin-top:120px">
		          <div id="alrt" class="alert alert-success alert-dismissable" style="display:none;z-index:3000;position:absolute;margin-left: 160px; margin-top:50px">
		            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		            <strong>Successfully added! redirecting ....</strong> 
		          </div>
		<table class="table table-bordered" id="gt">
			<tr style="background-color: #f5f5f5">
				<th>Drink</th>
                <th>No.Drinks</th>
				<th>Times</th>
				<th>Each cost</th>
				<th>Total cost</th>
				<th>
					<select class="form-control" id="time">
					<option value="{{$bi->servicetime}}">{{Bill::tm($bi->servicetime)}}</option>
				        <option value=""></option>
				        <option value="1">Break fast</option>
				        <option value="2">Lunch</option>
				        <option value="3">Supper</option>
				        <option value="4">Dinner</option>
				        <option value="5">Neither</option>
				        <option value="all"> bill history</option>
				    <select>  
				</th>
			</tr>	
			<?php $total = 0; ?>
			@for($i=0; $i<$l; $i++)
				<tr>
					<td>{{$unique[$i]}}</td>
                    <td>{{$idadi[$i]}}</td>
					<td>{{Bill::appears($unique[$i], $foods)}}</td>
					<td>{{Bar::where('name', $unique[$i])->first()->cost}} /=</td>
                    <td>{{($idadi[$i])*(Bar::where('name', $unique[$i])->first()->cost)}} /=</td>
				</tr>
            <?php $total = $total + (($idadi[$i])*(Bar::where('name', $unique[$i])->first()->cost)); ?>
			@endfor	
			<tr style="background-color: #f5f5f5">
                <td></td>
				<td ></td>
				<td></td>
				<td><b>Total</b></td>
				<td id="ttl">
					{{$total}} /=
				</td>
			</tr>
			@if($bi->paymentmode == "cash")
				<tr>
					<td><b>Payment<b></td>
					<td>Cash</td>
					<td><b>Amount paid </b></td>
					<td>{{$bi->amount}}</td>
					<td><b>served by</b> <br/>{{User::find($bi->added_by)->firstname}}{{User::find($bi->added_by)->lastname}}  </td>
				</tr>	
				@if($bi->remain != 0)
				<tr>
				<td style="background-color: #f5f5f5"></td>	
				<td style="background-color: #f5f5f5"></td>	
				<td ><b>Enter Amount</b></td>
					<td style="background-color: #f5f5f5">
						<input type="text" class="form-control" id="amountb" value="" />
					</td>
				<td style="background-color: #f5f5f5">
					<input id="guestidb" value="{{$bi->id}}" type="hidden" />
					<input id="gb" value="{{$bi->guestid}}" type="hidden" />
					<input id="totalb" value="{{$total}}" type="hidden" />
					<input id="servtb" value="{{$bi->servicetime}}" type="hidden" /> 
					<button type="button" id="svb" class="btn btn-success">Update bill </button></td>	
				</tr>
				@endif

			@else
				<tr>
					<td><b>Payment<b></td>
					<td>credit</td>
					<td><b>Amount paid </b></td>
					<td>{{$bi->amount}}</td>
					<td><b>served by</b><br/> 
						<input id="gb" value="{{$bi->guestid}}" type="hidden" />
						{{User::find($bi->added_by)->firstname}} {{User::find($bi->added_by)->lastname}}  </td>
				</tr>
				@if($bi->amount == 0)
				<tr>
				<td style="background-color: #f5f5f5"></td>	
				<td style="background-color: #f5f5f5"></td>	
				<td ><b>Enter Amount</b></td>
					<td style="background-color: #f5f5f5">
						<input type="text" class="form-control" id="amountb" value="" />
					</td>
				<td style="background-color: #f5f5f5">
					<input id="guestidb" value="{{$bi->id}}" type="hidden" />
					<input id="gb" value="{{$bi->guestid}}" type="hidden" />
					<input id="totalb" value="{{$total}}" type="hidden" />
					<input id="servtb" value="{{$bi->servicetime}}" type="hidden" /> 
					<button type="button" id="svb" class="btn btn-success">Update bill </button></td>	
				</tr>
				@else
					@if($bi->remain != 0)
					<tr>
					<td style="background-color: #f5f5f5"></td>	
					<td style="background-color: #f5f5f5"></td>	
					<td ><b>Enter Amount</b></td>
						<td style="background-color: #f5f5f5">
							<input type="text" class="form-control" id="amountb" value="" />
						</td>
					<td style="background-color: #f5f5f5">
						<input id="guestidb" value="{{$bi->id}}" type="hidden" />
						<input id="gb" value="{{$bi->guestid}}" type="hidden" />
						<input id="totalb" value="{{$total}}" type="hidden" />
						<input id="servtb" value="{{$bi->servicetime}}" type="hidden" /> 
						<button type="button" id="svb" class="btn btn-success">Update bill </button></td>	
					</tr>
					@endif
				@endif
			@endif
       </table>

	@endif

@endif

<script type="text/javascript">
$(document).ready(function(){

	$('#time').on('change', function(){
		var stime = $(this).val();
		var g = $('#gb').val();
		$('#gt').css('opacity', '0.2');
		$('#ajax5').show();
		$.post('servicetime', {s:stime, g:g}, function(data){
			$('#main').html(data);
		})
	});

	/////////////////////////////////////////////////////////

	$('#svb').on('click', function(){
        @if(Auth::user()->role == 7)
		var a = $('#amountb').val();
		var g = $('#guestidb').val();
		var t = $('#totalb').val();
		var s = $('#servtb').val();
		if(a==""){
			alert("Please, fill the amount first !");
		}else{
			$('#gt').css('opacity', '0.2');
			$('#ajax5').show();
			$.post('bill/updatebill', {a:a,g:g,t:t,s:s}, function(data){
				$('#main').html(data);
			});
		}
        @elseif(Auth::user()->role == 8)
        var a = $('#amountb').val();
        var g = $('#guestidb').val();
        var t = $('#totalb').val();
        var s = $('#servtb').val();
        if(a==""){
            alert("Please, fill the amount first !");
        }else{
            $('#gt').css('opacity', '0.2');
            $('#ajax5').show();
            $.post('bill/updatebill', {a:a,g:g,t:t,s:s}, function(data){
                $('#main').html(data);
            });
        }
        @elseif(Auth::user()->role == 12)
        var a = $('#amountb').val();
        var g = $('#guestidb').val();
        var t = $('#totalb').val();
        var s = $('#servtb').val();
        if(a==""){
            alert("Please, fill the amount first !");
        }else{
            $('#gt').css('opacity', '0.2');
            $('#ajax5').show();
            $.post('bill/updatebill', {a:a,g:g,t:t,s:s}, function(data){
                $('#main').html(data);
            });
        }
        @else
        var a = $('#amountb').val();
        var g = $('#guestidb').val();
        var t = $('#totalb').val();
        var s = $('#servtb').val();
        if(a==""){
            alert("Please, fill the amount first !");
        }else{
            $('#gt').css('opacity', '0.2');
            $('#ajax5').show();
            $.post('bill/updatebill', {a:a,g:g,t:t,s:s}, function(data){
                $('#main').html(data);
            });
        }
        @endif
	});

	$('#md').on('change', function(){
		var c = $(this).val();
		if(c == "cash"){
			$("#a, #ai").fadeIn(1000);
		}else{
			$("#a, #ai").hide();
		}
	});
////////////////////////////////////////////
	$('#sv').click(function(){
		var c  = $('#md').val();
		var gid = $('#guestid').val();
		var ai = $('#amount').val(); 
		var t  = $('#total').val();
		var s  = $('#servt').val();
		if(c==""){
			alert("Please choose payment mode");
		}else{
			if(c=="mkopo"){
					$('#gt').css('opacity', '0.2');
					$('#ajax5').show();
					$.post('add', {c:c, gid:gid, a:ai, t:t, s:s}, function(data){
						$('#ajax5').hide('fast', function(){
							$('#alrt').fadeIn(1000, function(){
								window.location = 'all';
							});
						});
					});
			}else{
				if(ai==""){
					alert("Please enter amount");
				}else{
					$('#gt').css('opacity', '0.2');
					$('#ajax5').show();
					$.post('add', {c:c, gid:gid, a:ai, t:t, s:s}, function(data){
						$('#ajax5').hide('fast', function(){
							$('#alrt').fadeIn(1000, function(){
								window.location = 'all';
							});
						});
					});
				}
			}
		}
	});

});	
</script>
