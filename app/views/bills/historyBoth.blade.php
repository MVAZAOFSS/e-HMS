<?php
$guestid = $bi[0]->guestid;
?>

<p> Guest bill inforamtion history ({{ Guest::find($guestid)->firstname }} {{ Guest::find($guestid)->lastname }} Room {{ Room::find(Guest::find($guestid)->room_number)->name }})</p>
<hr/>

@foreach($bi as $b)
<?php

$foods  = explode("," , $b->foods);
$fds    = array_pop($foods);

$unique = array_keys(array_count_values($foods));
$l      = count($unique);

?>

<table class="table table-bordered" id="gt">
    <tr >
        <th style="background-color: #f5f5f5">Date</th>
        <th style="background-color: #f5f5f5">Food</th>
        <th style="background-color: #f5f5f5">Times</th>
        <th style="background-color: #f5f5f5">Each cost</th>
        <th style="background-color: #f5f5f5">Total cost</th>
        <th style="background-color: #f5f5f5">
            Service Time
        </th>
    </tr>
    <tr>
        <td>{{$b->date}}</td>
        <td style="background-color:#f5f5f5"></td>
        <td style="background-color:#f5f5f5"></td>
        <td style="background-color:#f5f5f5"></td>
        <td style="background-color:#f5f5f5"></td>
        <td >{{Bill::tm($b->servicetime)}} </td>
    </tr>
    <?php $total = 0; ?>
    @for($i=0; $i<$l; $i++)
    <tr>
        <td style="background-color:#f5f5f5"></td>

        <td>{{$unique[$i]}}</td>
        <td>{{Bill::appears($unique[$i], $foods)}}</td>
        <td>{{Restaurant::where('name', $unique[$i])->first()->cost}} /=</td>
        <td>{{(Bill::appears($unique[$i], $foods))*(Restaurant::where('name', $unique[$i])->first()->cost)}} /=</td>
        <td style="background-color: #f5f5f5"></td>
    </tr>
    <?php $total = $total + ((Bill::appears($unique[$i], $foods))*(Restaurant::where('name', $unique[$i])->first()->cost)); ?>
    @endfor
    <tr style="background-color: #f5f5f5">
        <td ></td>
        <td style="background-color:#f5f5f5"></td>
        <td></td>
        <td><b>Total</b></td>
        <td id="ttl">
            {{$total}} /=
        </td>
    </tr>
    @if($b->paymentmode == "cash")
    <tr>
        <td></td>
        <td><b>Payment<b></td>
        <td>Cash</td>
        <td><b>Amount paid </b></td>
        <td>{{$b->amount}}</td>
        <td><b>served by</b> <br/>
            {{User::find($b->added_by)->firstname}} {{User::find($b->added_by)->lastname}}
        </td>
    </tr>
    @else
    <tr>
        <td></td>
        <td><b>Payment<b></td>
        <td>credit</td>
        <td><b>Amount paid </b></td>
        <td>{{$b->amount}}</td>
        <td><b>served by</b><br/>
            <input id="gb" value="{{$b->guestid}}" type="hidden" />
            {{User::find($b->added_by)->firstname}} {{User::find($b->added_by)->lastname}}  </td>
    </tr>
    @if($b->amount == 0)

    @endif
    @endif
</table>
@endforeach