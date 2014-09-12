<table class="table table-striped table-condensed" id="guestz">
    <thead><tr><th>First name</th><th>Last name</th><th>Cost</th><th>Food</th><th>Date</th><th>Payment Mode</th></tr></thead>
    <tbody>
        @foreach($gz as $row)
        <tr><td>{{$row->firstname}}</td><td>{{$row->lastname}}</td><td>{{$row->amount}}</td>
            <td>{{$row->foods}}</td><td>{{$row->date}}</td><td>{{$row->paymentmode}}</td></tr>
        @endforeach
    </tbody>
    
</table>
<script>
    $("#guestz").dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
       });
</script>