<table class="table table-bordered table-condensed table-hover" id="income">
    <thead><tr><th>Rooms income</th><th>Food Sales Income</th><th>Guest Drinks Sales</th><th>Drinks sales income</th><th>Food Income</th><th>Function Income</th><th>Conference Income</th><th>Laundry Income</th><th>Laundry Sales Income</th></tr></thead>
    <tbody><tr><td>{{$roomscost}}</td><td>{{$salescost}}</td><td></td>{{$baramount}}<td>{{$no_drinks*$barcost}}</td><td>{{$amount}}</td><td>{{$co_amount}}</td><td>{{$fu_amount}}</td><td>{{$totalprice}}</td><td>{{$totalpricesales}}</td></tr></tbody>
</table>
<p class="alert alert-warning">Total Income is {{$roomscost+$salescost+$barcost+$amount+$co_amount+$fu_amount+$totalprice+$totalpricesales}} /=</p>
<script>
    $("#income").dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
       });
</script>