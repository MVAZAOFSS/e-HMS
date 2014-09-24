<form id="subs">
<div class="panel panel-default">
    <label>Details</label>
    @if(isset($sms))
      {{$sms}}
    @endif
   <table class="table">
            <tr>
                <td>Type of Service<td>
                <td>{{Confere::find($id)->type_conferes}}</td>
            </tr>
            <tr>
                <td>Amount Payed<td>
                <td>{{Confere::find($id)->amount}}</td>
            </tr>
            <tr>
                <td>Amount Remained<td>
                <td>{{Confere::find($id)->remain}}</td>
            </tr>
            <tr>
                <td>Pay<td>
                <td>{{$errors->first('pay','<span class="error">:message</span>')}}<input type="text" name="pay" class="form-control"></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td><button class="btn btn-success pull-right" name="save">PayBill</button></td>
            </tr>
        </table>
</div>
    <script>
        $('#subs').submit(function(e){
            e.preventDefault();
            $('.menu').html('Loading..');
            var url="<?php echo $id;?>";
            var url2="<?php echo url('payBillContents');?>";
            var formz=$(this).serializeArray();
            var url3=url2+'/'+url;
            formz.push({"name": "save","value":" "});
            $.post(url3,formz,function(data){
                setTimeout(function(){
                $('.menu').html(data);
                    location.reload();
                },2000);
            });

        });
    </script>
</form>
