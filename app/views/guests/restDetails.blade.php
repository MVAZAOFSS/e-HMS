<form id="sub">
    @if(isset($sms))
    {{$sms}}
    @endif
    @if(isset($smz))
    {{$smz}}
    @endif
<div class="col-lg-12">
    <table class="table table-striped table-hover">
        <tr>
            <td>
               Food Taken
            </td>
            <td class="alert-success">
                {{Bill::find($viewID)->foods}}
            </td>
        </tr>
        <tr>
            <td>
                Payment mode
            </td>
            <td class="alert-success">
                {{Bill::find($viewID)->paymentmode}}
            </td>
        </tr>
        <tr>
            <td>
               Amount To be Payed 
            </td>
            <td class="alert-success">
                {{Bill::find($viewID)->remain}}
            </td>
        </tr>
        <tr>
            <td>
               Amount Payed 
            </td>
            <td class="alert-success">
                {{Bill::find($viewID)->amount}}
            </td>
        </tr>
        <tr>
            <td>
               Date  
            </td>
            <td class="alert-success">
                {{Bill::find($viewID)->date}}
            </td>
        </tr>
        <tr>
            <td>
              Amount 
            </td>
            <td class="alert-success">
                {{$errors->first('amount','<span class="error">:message</span>')}}
                <input type="text" name="amount" class="form-control" required>
            </td>
        </tr>
        <tr>
            <td></td><td><button class="btn btn-success btn-sm" name="save">submit</button></td>
        </tr>
    </table>
</div>
    </form>
<script>
    $('#sub').submit(function(e){
        e.preventDefault();
        $('.main').html('<label class="label label-info">Loading..</label>');
        var formz=$(this).serializeArray();
        var url="<?php echo url('restaurant_update');?>";
        var url2="<?php echo $viewID;?>";
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

