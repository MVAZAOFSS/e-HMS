<?php
$res=DB::table('guests')->select('*')
        ->join('foodbills','foodbills.guestid','=','guests.id')
        ->where('cleared','no')->where('guestid',$viewID)->get();
foreach ($res as $row){
?>
<div class="col-lg-12">
    <table class="table table-striped table-hover">
        <tr>
            <td>
               Food Taken
            </td>
            <td class="alert-success">
                {{$row->foods}}
            </td>
        </tr>
        <tr>
            <td>
                Payment mode
            </td>
            <td class="alert-success">
                {{$row->paymentmode}}
            </td>
        </tr>
        <tr>
            <td>
               Cost Payed 
            </td>
            <td class="alert-success">
                {{$row->amount}}
            </td>
        </tr>
        <tr>
            <td>
               Date  
            </td>
            <td class="alert-success">
                {{$row->date}}
            </td>
        </tr>
    </table>
</div>
<?php
}?>
