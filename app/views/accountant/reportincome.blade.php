<table class="table table-bordered table-condensed table-hover" id="income">
    <thead><tr><th>Rooms income</th><th>Guests Drinks Income</th><th>Drinks sales income</th><th>Food Income</th></tr></thead>
    <tbody><tr><td>{{$roomscost}}</td><td>{{$salescost}}</td><td>{{$barcost}}</td><td>{{$amount}}</td></tr></tbody>
</table>
<p class="alert alert-warning">Total Income is {{$roomscost+$salescost+$barcost+$amount}} /=</p>
<script>
    $("#income").dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
       });
</script>