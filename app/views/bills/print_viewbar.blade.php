@foreach($res as $row)

<table border='2' width='80%' height='50%'>
    <tr><td>Name:</td><td>{{Guest::find($row->guestid)->lastname}} {{Guest::find($row->guestid)->firstname}}</td></tr>
    <tr><td>Drink taken</td><td>{{$row->drinks}}</td></tr>
    <tr><td>Amount</td><td>{{$row->amount}}</td></tr>
    <tr><td>Payment Mode</td><td>{{$row->paymentmode}}</td></tr>
    <tr><td>Authorized by</td><td>{{User::find($row->added_by)->firstname}} {{User::find($row->added_by)->lastname}}</td></tr>
</table>
@endforeach