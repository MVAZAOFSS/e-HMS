<?php
$res=DB::table('guests')->select('*')
        ->join('barbills','barbills.guestid','=','guests.id')
        ->where('cleared','no')->where('guestid',$id)->get();
foreach ($res as $row){
?>
<div class="col-lg-12">
    <table class="table table-striped table-hover">
        <tr>
            <td>
                Full Name: 
            </td>
            <td class="alert-success">
                {{ucfirst($row->firstname)}} {{ucfirst($row->lastname)}}
            </td>
        </tr>
        <tr>
            <td>
                Drinks Taken
            </td>
            <td class="alert-success">
                {{$row->drinks}}
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
