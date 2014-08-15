<p><b>Guest Name</b>: {{Guest::find($gid)->firstname}} {{Guest::find($gid)->lastname}} <b>Room No: </b>{{Room::find(Guest::find($gid)->room_number)->name}} <b>Date: </b> {{date('Y-m-d')}}</p>
<p><b>Time sent to laundry: </b> {{$list->timespent}} <b>Total Piece</b> {{$list->totalprice}}  </p>
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

		$lauTC = 0;
		$dryTC = 0;
		$preTC = 0;

	?>
	@for($i=0;$i<$s; $i++)
	<tr>
		<td>{{$a}} <?php $a++; ?></td>
		<td>{{$ls[$i]}}</td>
		<td>
			{{ Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'g', 1))->first()->cvalue }}
		</td>
		<td>
			{{ Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'h', 1))->first()->cvalue }}
		</td>
		@if(Laundrie::whereRaw('category = ? and name = ?', array(1, $ls[$i]))->count() != 0)
		<td>{{ (Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'g', 1))->first()->cvalue  * Laundrie::whereRaw('category = ? and name = ?', array(1, $ls[$i]))->first()->cost)  }}</td>
		@endif
		
		<td>
			{{ Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'g', 2))->first()->cvalue }}
		</td>
		<td>
			{{ Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'h', 2))->first()->cvalue }}
		</td>
		@if(Laundrie::whereRaw('category = ? and name = ?', array(2, $ls[$i]))->count() != 0)
		<td>
			{{
				(Laundrie::whereRaw('category = ? and name = ?', array(2, $ls[$i]))->first()->cost
				*  Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'g', 2))->first()->cvalue) 	
			}}
		</td>
		@endif
		<td>
			{{ Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'g', 3))->first()->cvalue }}
		</td>
		<td>
			{{ Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'h', 3))->first()->cvalue }}
		</td>
		@if(Laundrie::whereRaw('category = ? and name = ?', array(3, $ls[$i]))->count() != 0)
		<td>{{

			(Laundrie::whereRaw('category = ? and name = ?', array(3, $ls[$i]))->first()->cost
				*  Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'g', 3))->first()->cvalue) 
		}}</td>
		@endif
		<td></td>	
	</tr>
		<?php

			$lauTC = (Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'g', 1))->first()->cvalue  * Laundrie::whereRaw('category = ? and name = ?', array(1, $ls[$i]))->first()->cost) + $lauTC;
			$dryTC = (Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'g', 2))->first()->cvalue  * Laundrie::whereRaw('category = ? and name = ?', array(2, $ls[$i]))->first()->cost)  + $dryTC;
			$preTC = (Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'g', 3))->first()->cvalue  * Laundrie::whereRaw('category = ? and name = ?', array(3, $ls[$i]))->first()->cost) + $preTC;


		?>
	@endfor

	<tr>
		<td></td>
		<td><b>TOTAL</b></td>
		<td></td>
		<td></td>
		<td>{{$lauTC}}</td>
		<td></td>
		<td></td>
		<td>{{$dryTC}}</td>
		<td></td>
		<td></td>
		<td>{{$preTC}}</td>
		<td></td>	
	</tr>		
</table>

<?php  
	//$totCost = $lauTC + $preTC + $dryTC;  
	//$remain  = $totalprice - (integer)($list->totalprice);
?>
