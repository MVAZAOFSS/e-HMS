@if(Auth::user()->role == 7)
<?php

$fs = array();

foreach($sales as $s){
	$fs[] = $s->food ;
    $idadi[] = $s->no_foods ;
}
$unique = array_keys(array_count_values($fs));
$l      = count($unique);

$newarr = array();
foreach ($unique as $key => $value) {
	# code...
	array_push($newarr, $value);
}



?>

<table class="table table-bordered" id="gt">
	<tr style="background-color: #f5f5f5">
		<th>Food</th>
        <th>No Foods</th>
		<th>Times</th>
		<th>Each cost</th>
		<th>Total cost</th>
		<th>
			<select class="form-control" id="time">
				<option value="{{$sales[0]->service}}">{{Bill::tm($sales[0]->service)}}</option>
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
			<td>{{$newarr[$i]}}</td>
            <td>{{$idadi[$i]}}</td>
			<td>{{Bill::appears($newarr[$i], $fs)}}</td>
			<td>{{Restaurant::where('name', $newarr[$i])->first()->cost}} /=</td>
			<td>{{($idadi[$i])*(Restaurant::where('name', $newarr[$i])->first()->cost)}} /=</td>
		</tr>
	<?php $total = $total + (($idadi[$i])*(Restaurant::where('name', $newarr	[$i])->first()->cost)); ?>
	@endfor	
	<tr style="background-color: #f5f5f5">
		<td ></td>
		<td></td>
		<td><b>Total</b></td>
		<td id="ttl">
			{{$total}} /=
		</td>
	</tr>
	
</table>

@elseif(Auth::user()->role == 8)
<?php

$fs = array();

foreach($sales as $s){
	$fs[] = $s->food ;
    $idadi[]  = $s->no_foods;
}
$unique = array_keys(array_count_values($fs));
$l      = count($unique);

$newarr = array();
foreach ($unique as $key => $value) {
	# code...
	array_push($newarr, $value);
}



?>

<table class="table table-bordered" id="gt">
	<tr style="background-color: #f5f5f5">
		<th>Food</th>
        <th>No Foods</th>
		<th>Times</th>
		<th>Each cost</th>
		<th>Total cost</th>
		<th>
			<select class="form-control" id="time">
				<option value="{{$sales[0]->service}}">{{Bill::tm($sales[0]->service)}}</option>
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
			<td>{{$newarr[$i]}}</td>
            <td>{{$idadi[$i]}}</td>
			<td>{{Bill::appears($newarr[$i], $fs)}}</td>
			<td>{{Restaurant::where('name', $newarr[$i])->first()->cost}} /=</td>
			<td>{{($idadi[$i])*(Restaurant::where('name', $newarr[$i])->first()->cost)}} /=</td>
		</tr>
	<?php $total = $total + (($idadi[$i])*(Restaurant::where('name', $newarr	[$i])->first()->cost)); ?>
	@endfor	
	<tr style="background-color: #f5f5f5">
		<td ></td>
		<td></td>
		<td><b>Total</b></td>
		<td id="ttl">
			{{$total}} /=
		</td>
	</tr>
	
</table>
@else


<?php

$fs = array();

foreach($sales as $s){
	$fs[] = $s->drink ;
    $idadi[]  = $s->no_drinks;
}


$unique = array_keys(array_count_values($fs));
$l      = count($unique);


$newarr = array();
foreach ($unique as $key => $value) {
	# code...
	array_push($newarr, $value);
}



?>

<table class="table table-bordered" id="gt">
	<tr style="background-color: #f5f5f5">
		<th>Drink</th>
		<th>Times</th>
		<th>Each cost</th>
		<th>Total cost</th>
		<th>
			<select class="form-control" id="time">
				<option value="{{$sales[0]->service}}">{{Bill::tm($sales[0]->service)}}</option>
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
			<td>{{$newarr[$i]}}</td>
            <td>{{$idadi[$i]}}</td>
			<td>{{Bill::appears($newarr[$i], $fs)}}</td>
			<td>{{Bar::where('name', $newarr[$i])->first()->cost}} /=</td>
			<td>{{($idadi[$i])*(Bar::where('name', $newarr[$i])->first()->cost)}} /=</td>
		</tr>
	<?php $total = $total + (($idadi[$i])*(Bar::where('name', $newarr[$i])->first()->cost)); ?>
	@endfor	
	<tr style="background-color: #f5f5f5">
		<td ></td>
		<td></td>
		<td><b>Total</b></td>
		<td id="ttl">
			{{$total}} /=
		</td>
	</tr>
	
</table>
@endif
