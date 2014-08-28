<?php
$res=DB::table('guests')->select('*')
        ->join('barbills','barbills.guestid','=','guests.id')
        ->where('cleared','no')->where('guestid',$id)->get();
if($res){
foreach ($res as $row){
?>
<form id="rep">
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
        <tr>
            <td>
              Pay remain amount
            </td>
            <td class="alert-success">
                {{$errors->first('amount','<span class="error">:message</span>')}}
                <input type="text" name="amount" class="form-control">
            </td>
        </tr>
        <tr>
            <td></td><td><button class="btn btn-success btn-sm" name="save">submit</button></td>
        </tr>
    </table>
</div>
</form>
<?php
}
}else{
?>
<?php
echo '<p class="alert alert-warning"><blink><span class="glyphicon glyphicon-warning-sign"></blink> No drinks taken by this guests</span></p>';
}
?>
<script>
    $('#rep').submit(function(e){
        e.preventDefault();
        var formz=$(this).serializeArray();
        var url="<?php echo url('barbills_update');?>";
        var url2="<?php echo $id;?>";
        var url3=url+'/'+url2;
        formz.push({"name": "save","value": ""});
        $.post(url3,formz,function(data){
            $('.main').html(data);
        });
    });
</script>
