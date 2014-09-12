@if(isset($sms))
  {{$sms}}
@endif
<form id="ed">
<div class="panel panel-default">
    <div class="panel-heading">
        <label>Squeeze Order for :  {{Guest::find($id)->firstname}}  {{Guest::find($id)->lastname}}</label>
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <tr>
                <td><label>From Date</label></td>
                <td><div class="col-md-9">
                        {{$errors->first('start','<span class="error">:message</span>')}}
                        <input type="text" name="start" class="form-control datepicker" 
                                                 value="{{Guest::find($id)->arrival_date}}">
                    </div></td>
            </tr>
            <tr>
                <td><label>End Date</label></td>
                <td><div class="col-md-9">
                        {{$errors->first('end','<span class="error">:message</span>')}}
                        <input type="text" name="end" class="form-control datepicker"
                                                 value="{{Guest::find($id)->departure_date}}">
                    </div></td>
            </tr>
            <tr>
                <td></td>
                <td><div class="col-md-9"><button class="btn btn-success btn-sm">Squeeze order</button></div></td>
            </tr>
        </table>
        
    </div>
</div>
</form>
<script>
    $('.datepicker').datepicker({
        dateFormat:"yy-mm-dd",
        changeMonth: true,
        changeYear:true,
        minDate:0
    });
    $('#ed').submit(function(e){
        e.preventDefault();
        $('.main').html('<label class="label label-info">Loading..</label>');
        var forms=$(this).serializeArray();
        var url="<?php echo url('cancel_edit');?>";
        var url2="<?php echo $id;?>";
        var url3=url+'/'+url2;
        forms.push({"name": "save","value": ""});
        $.post(url3,forms,function(data){
            setTimeout(function(){
            $('.main').html(data);
            location.reload();
            },2000);
        });
    });
</script>
