<table class="table table-condensed table-striped" id="mycont">
   <thead>
   <tr>
   <th>added</th><th>reduced</th><th>Type(s)</th><th>Date</th></tr></thead>
    <tbody>
        @foreach($res as $row)
        <tr><td>
               {{$row->added}}
            </td>
            <td>
                {{$row->used}}
            </td>
            @if($row->gId==1)
            <td>
              Mchele
            </td>
            @elseif($row->gId==2)
            <td>
                Mafuta
            </td>
            @elseif($row->gId==3)
            <td>
                Chumvi
            </td>
            @endif
            <td>
                {{$row->created_at}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<script>
    $('#mycont').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
</script>