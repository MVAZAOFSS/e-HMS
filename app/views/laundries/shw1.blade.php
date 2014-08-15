<p><b>Guest Name</b>: {{Guest::find($gid)->firstname}} {{Guest::find($gid)->lastname}} <b>Room No: </b>{{Room::find(Guest::find($gid)->room_number)->name}} <b>Date: </b> {{date('Y-m-d')}}</p>
<p><b>Time sent to laundry: </b> <input type="text" value="{{$list->timespent}}" id="time" /> <b>Total Piece</b> <input type="text" id="total" value="{{$list->totalprice}}" /> <input  type="hidden" value="{{$gid}}" id="gid" /> </p>
<p>Please choose :
 <input type="radio" name="tick" id="tick1" value="starch" {{Laundrie::tick($list->choose, "starch")}} /> Starch  
 <input type="radio" name="tick" id="tick2" value="nostarch" {{Laundrie::tick($list->choose, "nostarch")}} /> No Starch  
 <input type="radio" name="tick" id="tick3" value="shirtfolder" {{Laundrie::tick($list->choose, "shirtfolder")}} /> Shirt folder  
 <input type="radio" name="tick" id="tick4" value="shirtonhanger" {{Laundrie::tick($list->choose, "shirtonhanger")}}  /> Shirt on hanger</p>
<hr/>

<img src="{{url("img/load.gif")}}" id="ajax5" style="width:52px;display:none;z-index:3000;position:absolute;margin-left: 375px; margin-top:120px">
          <div id="alrt1" class="alert alert-success alert-dismissable" style="display:none;z-index:3000;position:absolute;margin-left: 260px; margin-top:50px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Successfully added! redirecting ....</strong> 
          </div>
<table id="gtb" class="table table-bordered" style="font-size:9px">
	<tr > 
		<th></th>
		<th style="text-align:center">Items</th>
		<th colspan="3">Laundry</th>
		<th colspan="3">dry cleaning to be collect next</th>
		<th colspan="3">pressing</th>
		<th>remarks/request</th>
	</tr>	
	<tr>
		<td></td>
		<td></td>
		<td>Guest count</td>
		<td>Hotel count</td>
		<td>Price</td>
		<td>Guest count</td>
		<td>Hotel count</td>
		<td>Price</td>
		<td>Guest count</td>
		<td>Hotel count</td>
		<td>Price</td>
		<td></td>	
	</tr>	
	<?php 
		$a       = 1;
		$laundry = Laundrie::all();
		$items   = array();
		foreach($laundry as $l){
			$items[] = $l->name;
		}

		$ls = array_keys(array_count_values($items));
		$s  = count($ls);

	?>
	@for($i=0;$i<$s; $i++)
	<tr>
		<td>{{$a}} <?php $a++; ?></td>
		<td>{{$ls[$i]}}</td>
		<td><input type="text" class="form-control list" value="{{ Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'g', 1))->first()->cvalue }}" count="g" item="{{$ls[$i]}}" cate="1"  /></td>
		<td><input type="text" class="form-control list" value="{{ Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'h', 1))->first()->cvalue }}" count="h" item="{{$ls[$i]}}" cate="1" /></td>
		@if(Laundrie::whereRaw('category = ? and name = ?', array(1, $ls[$i]))->count() != 0)
		<td>{{Laundrie::whereRaw('category = ? and name = ?', array(1, $ls[$i]))->first()->cost}}</td>
		@endif
		
		<td><input type="text" class="form-control list" value="{{ Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'g', 2))->first()->cvalue }}" count="g" item="{{$ls[$i]}}" cate="2"  /></td>
		<td><input type="text" class="form-control list" value="{{ Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'h', 2))->first()->cvalue }}" count="h" item="{{$ls[$i]}}" cate="2" /></td>
		@if(Laundrie::whereRaw('category = ? and name = ?', array(2, $ls[$i]))->count() != 0)
		<td>{{Laundrie::whereRaw('category = ? and name = ?', array(2, $ls[$i]))->first()->cost}}</td>
		@endif
		<td><input type="text" class="form-control list" value="{{ Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'g', 3))->first()->cvalue }}" count="g" item="{{$ls[$i]}}" cate="3" /></td>
		<td><input type="text" class="form-control list" value="{{ Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'h', 3))->first()->cvalue }}" count="h" item="{{$ls[$i]}}" cate="3" /></td>
		@if(Laundrie::whereRaw('category = ? and name = ?', array(3, $ls[$i]))->count() != 0)
		<td>{{Laundrie::whereRaw('category = ? and name = ?', array(3, $ls[$i]))->first()->cost}}</td>
		@endif
		<td></td>	
	</tr>
	@endfor

	<tr>
		<td></td>
		<td><b>TOTAL</b></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>	
	</tr>		
</table>	
<script type="text/javascript">
$(document).ready(function(){
	$('.list').change(function(){
		var item     = $(this).attr('item');
		var count    = $(this).attr('count');
		var cate     = $(this).attr('cate');
		var cvalue   = $(this).val();
		var gid      = {{$gid}} ;
		 
		$.post('llist', {i:item, gid:gid, c:count, cate:cate, cv:cvalue}, function(data){
		
		});

	});

	//////////////////////////////////////////
	    var v; 
	$('input:radio[name="tick"]').change(function(){
		 v = $(this).val();
	});

	$('#sv').on('click', function(){

		var tm     = $('#time').val();
		var total  = $('#total').val();
		var nv     = v;
		var gid    = {{$gid}} ;
		var list   = $('.list').val();

		if(tm==""&&total==""&&nv==""){
			alert("please fill the fields");
		}else{
			if(list == ""){
				alert("please fill the fields")
			}else{
				
				$('#gtb').css('opacity', '0.2');
				$('#ajax5').show();

				$.post("glist", {t:tm, to:total, c:nv, gid:gid}, function(data){
					$('#ajax5').hide('fast', function(){
						$('#alrt1').show();
						window.location = "gllists";
					});
					
				});

			}
		}
	});
});
</script>