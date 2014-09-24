<table class=" table table-condensed table-striped" id="roomreport">
    <thead><tr><th>First name</th><th>Last name</th><th>Room no</th><th>Checkin</th><th>Checkout</th><th>Status</th></tr></thead>
    <tbody>
        @foreach($git as $row)
                <tr><td>{{$row->firstname}}</td><td>{{$row->lastname}}</td><td>{{$row->name}}</td><td>{{$row->arrival_date}}
                    </td><td>{{$row->departure_date}}</td><td>{{$row->status}}</td></tr>
        @endforeach
    </tbody>
    
</table>
<script>
    $("#roomreport").dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
       });
</script>