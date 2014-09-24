<table class="table table-striped table-condensed" id="guestz">
    <thead><tr><th>Food</th><th>Cost</th><th>Date</th></tr></thead>
    <tbody>
        @foreach($gz as $row)
        <tr><td>{{$row->food}}</td><td>{{$row->cost}}</td><td>{{$row->date}}</td></tr>
        @endforeach
    </tbody>
    
</table>
<script>
    $("#guestz").dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
       });
</script>