<form id="sub">
    <table class="table table-hover">
        <tr>
            <td>Amount payed</td>
            <td>{{Glist::find($id)->totalprice}}</td>
        </tr>
        <tr>
            <td>Amount Remain</td>
            <td>{{Glist::find($id)->remain}}</td>
        </tr>
        <tr>
            <td>Date</td>
            <td> {{Glist::find($id)->date}}</td>
        </tr>
        <tr>
            <td>
                {{$errors->first('cost','<span class="error">:message</span>')}}
                <input type="text" name="cost" class="form-control"></td>
            <td><button class="btn btn-success btn-sm">update changes</button></td>
        </tr>
    </table>
    @if(isset($sms))
    {{$sms}}
    @endif
</form>

<script>
 $('#sub').submit(function(e){
        e.preventDefault();
        $('.main').html('<label class="label label-info">Loading..</label>');
        var formz=$(this).serializeArray();
        var url="<?php echo url('laundryEditAction');?>";
        var url2="<?php echo $id;?>";
        var url3=url+'/'+url2;
        formz.push({"name": "save","value": ""});
        $.post(url3,formz,function(data){
            setTimeout(function(){
                $('.main').html(data);
            },2000);
        });
    });
</script>