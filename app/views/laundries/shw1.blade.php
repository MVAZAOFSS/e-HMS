
<p><b>Guest Name</b>: {{Guest::find($guid)->firstname}} {{Guest::find($guid)->lastname}} <b>Room No: </b>{{Room::find(Guest::find($guid)->room_number)->name}} <b>Date: </b> {{$date}} &nbsp;&nbsp;&nbsp;<b>Remain Amount  {{$remain}} /=</b></p>
<p><b>Time sent to laundry: </b> <input type="text" value="{{$timespent}}" id="time" /> <b>Total Piece</b> <input type="text" id="total" value="{{$totalprice}}" /> <input  type="hidden" value="{{$gid}}" id="gid" />
   <b>Pay</b>&nbsp;&nbsp;&nbsp;<input type="text" id="remainz" name="remain" required>
 </p>
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
		<td><input type="text" class="form-control list" value="{{ Llist::whereRaw('gid = ? and counttype = ? and category = ? and date =? and item =?', array($guid, 'g', 1,$date,$ls[$i]))->first()->cvalue }}" count="g" item="{{$ls[$i]}}" cate="1"  /></td>
		<td><input type="text" class="form-control list" value="{{ Llist::whereRaw('gid = ? and counttype = ? and category = ? and date =? and item =?', array($guid, 'h', 1,$date,$ls[$i]))->first()->cvalue }}" count="h" item="{{$ls[$i]}}" cate="1" /></td>
		@if(Laundrie::whereRaw('category = ? and name = ?', array(1, $ls[$i]))->count() != 0)
		<td>{{Laundrie::whereRaw('category = ? and name = ?', array(1, $ls[$i]))->first()->cost}}</td>
		@endif
		
		<td><input type="text" class="form-control list" value="{{ Llist::whereRaw('gid = ? and counttype = ? and category = ? and date =? and item =?', array($guid, 'g', 2,$date,$ls[$i]))->first()->cvalue }}" count="g" item="{{$ls[$i]}}" cate="2"  /></td>
		<td><input type="text" class="form-control list" value="{{ Llist::whereRaw('gid = ? and counttype = ? and category = ? and date =? and item =?', array($guid, 'h', 2,$date,$ls[$i]))->first()->cvalue }}" count="h" item="{{$ls[$i]}}" cate="2" /></td>
		@if(Laundrie::whereRaw('category = ? and name = ?', array(2, $ls[$i]))->count() != 0)
		<td>{{Laundrie::whereRaw('category = ? and name = ?', array(2, $ls[$i]))->first()->cost}}</td>
		@endif
		<td><input type="text" class="form-control list" value="{{ Llist::whereRaw('gid = ? and counttype = ? and category = ? and date =? and item =?', array($guid, 'g', 3,$date,$ls[$i]))->first()->cvalue }}" count="g" item="{{$ls[$i]}}" cate="3" /></td>
		<td><input type="text" class="form-control list" value="{{ Llist::whereRaw('gid = ? and counttype = ? and category = ? and date =? and item =?', array($guid, 'h', 3,$date,$ls[$i]))->first()->cvalue }}" count="h" item="{{$ls[$i]}}" cate="3" /></td>
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
    $('.list').change(function(){
        var item     = $(this).attr('item');
        var count    = $(this).attr('count');
        var cate     = $(this).attr('cate');
        var cvalue   = $(this).val();
        var gid      = {{$gid}} ;

    $.post('llist', {i:item, gid:gid, c:count, cate:cate, cv:cvalue}, function(data){

    });

    });
$('#sv').on('click', function(){
var gid    = {{$gid}} ;
var list   = $('.list').val();
var remain= $('#remainz').val();
    if(remain===''){
 alert('Cant remain amount be empty');
   }else{
var url="<?php echo url('checkSum');?>";
$.post(url, {gid:gid,remain:remain}, function(data){
            $('#ajax5').hide('fast', function(){
                $('#alrt1').show();
                window.location = "gllists";
            });

        });
    }
});
</script>