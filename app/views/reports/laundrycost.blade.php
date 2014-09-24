<table class="table table-striped table-condensed" id="laud">
    <thead><tr><th>Guest Name</th><th>Items</th><th>Category</th><th>cost</th></tr></thead>
    <tbody>
        @foreach($laud as $row)
        @if($row->category==1)
        <tr><td>{{$row->firstname}} {{$row->lastname}}</td><td>{{$row->item}}</td><td>Laundry</td><td>{{$row->cost}}</td></tr>
        @elseif($row->category==2)
        <tr><td>{{$row->firstname}} {{$row->lastname}}</td><td>{{$row->item}}</td><td>Dry cleaning</td><td>{{$row->cost}}</td></tr>
        @elseif($row->category==3)
        <tr><td>{{$row->firstname}} {{$row->lastname}}</td><td>{{$row->item}}</td><td>Pressing</td><td>{{$row->cost}}</td></tr>
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