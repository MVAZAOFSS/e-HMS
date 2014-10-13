<table class="table table-striped table-condensed" id="laud">
    <thead><tr><th>Guest Name</th><th>Room</th><th>Amount</th><th>Date</th></tr></thead>
    <tbody>
        @foreach($laud as $row)
         <tr><td>{{$row->firstname}} {{$row->lastname}}</td><td>{{Room::find($row->room_number)->name}}</td><td>{{$row->totalprice}}</td><td>{{$row->date}}</td></tr>
        @endforeach
    </tbody>
</table>
<script>
    $("#laud").dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
       });
</script>