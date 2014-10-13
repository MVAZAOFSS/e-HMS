<table class="table table-striped table-condensed" id="laud">
    <thead><tr><th>Guest Name</th><th>Room</th><th>category</th><th>Item</th><th>Date</th></tr></thead>
    <tbody>
    @foreach($laud as $row)
    @if($row->category==1)
    <tr><td>{{Guest::find($row->gid)->lastname}} {{Guest::find($row->gid)->firstname}}</td><td>{{Room::find(Guest::find($row->gid)->room_number)->name}}</td><td>laundry</td><td>{{$row->item}}</td><td>{{$row->date}}</td></tr>
    @endif
    @if($row->category==2)
    <tr><td>{{Guest::find($row->gid)->lastname}} {{Guest::find($row->gid)->firstname}}</td><td>{{Room::find(Guest::find($row->gid)->room_number)->name}}</td><td>dry cleaning</td><td>{{$row->item}}</td><td>{{$row->date}}</td></tr>
    @endif
    @if($row->category==3)
    <tr><td>{{Guest::find($row->gid)->lastname}} {{Guest::find($row->gid)->firstname}}</td><td>{{Room::find(Guest::find($row->gid)->room_number)->name}}</td><td>pressing</td><td>{{$row->item}}</td><td>{{$row->date}}</td></tr>
    @endif
    @endforeach
    </tbody>
</table>
<script>
    $("#laud").dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
</script>