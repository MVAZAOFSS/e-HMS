@foreach($res as $row)
<table border='2' width='80%' height='50%'>
    <tr><td>Drink taken</td><td>{{$row->drink}}</td></tr>
    <tr><td>Amount</td><td>{{$row->no_drinks*$row->cost}}</td></tr>
    <tr><td>Authorized by</td><td>{{User::find($row->added_by)->firstname}} {{User::find($row->added_by)->lastname}}</td></tr>
</table>
@endforeach