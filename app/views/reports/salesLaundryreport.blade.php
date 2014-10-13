<table class="table table-striped table-condensed" id="laud">
    <thead><tr><th>Guest Name</th><th>category</th><th>Item</th><th>Date</th></tr></thead>
    <tbody>
    @foreach($laud as $row)
    @if($row->category==1)
    <tr><td>{{$row->name}} </td><td>laundry</td><td>{{$row->item}}</td><td>{{$row->date}}</td></tr>
    @endif
    @if($row->category==2)
    <tr><td>{{$row->name}}  </td><td>dry cleaning</td><td>{{$row->item}}</td><td>{{$row->date}}</td></tr>
    @endif
    @if($row->category==3)
    <tr><td>{{$row->name}} </td><td>pressing</td><td>{{$row->item}}</td><td>{{$row->date}}</td></tr>
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