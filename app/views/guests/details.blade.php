<form id="rep">
<div class="col-lg-12">
    <table class="table table-striped table-hover">
        <tr>
            <td>
                Drinks Taken
            </td>
            <td class="alert-success">
                {{Bil::find($id)->drinks}}
            </td>
        </tr>
        <tr>
            <td>
                Payment mode
            </td>
            <td class="alert-success">
                {{Bil::find($id)->paymentmode}}
            </td>
        </tr>
        <tr>
            <td>
               Amount Payed
            </td>
            <td class="alert-success">
                {{Bil::find($id)->amount}}
            </td>
        </tr>
        <tr>
            <td>
                Amount remained
            </td>
            <td class="alert-success">
                {{Bil::find($id)->remain}}
            </td>
        </tr>
        <tr>
            <td>
               Date  
            </td>
            <td class="alert-success">
                {{Bil::find($id)->date}}
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
<script>
    $('#rep').submit(function(e){
        e.preventDefault();
        $('.main').html('<label class="label label-info">Loading..</label>');
        var formz=$(this).serializeArray();
        var url="<?php echo url('barbills_update');?>";
        var url2="<?php echo $id;?>";
        var url3=url+'/'+url2;
        formz.push({"name": "save","value": ""});
        $.post(url3,formz,function(data){
            setTimeout(function(){
            $('.main').html(data);
            location.reload();
            },2000);
        });
    });
</script>
