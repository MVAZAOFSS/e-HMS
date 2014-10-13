
<div class="well well-sm">
    <table class="table">
        <tr><td>Customer Name</td><td>{{$name}}</td></tr>
        <tr><td>Date:</td><td>{{$date}}</td></tr>
        <tr><td>Remain Amount</td><td>{{$remain}}</td></tr>
        <tr><td>Time sent to laundry:</td><td>{{$timespent}}</td></tr>
        <tr><td>Total Piece</td><td>{{$totalpiece}}</td></tr>
        <?php
        if($remain==''||$remain==0){
            ?>
            <tr><td><p class="label label-success">No amount remain unpaid</p></td><td></td></tr>
        <?php
        }else{
            ?>
            <tr><td>Amount remained {{$remain}}</td><td><input type="text" id="remainz" name="remain" required></td></tr>
        <?php
        }?>
    </table>
</div>
<img src="{{url("img/load.gif")}}" id="ajax5" style="width:52px;display:none;z-index:3000;position:absolute;margin-left: 375px; margin-top:120px">
<div id="alrt1" class="alert alert-success alert-dismissable" style="display:none;z-index:3000;position:absolute;margin-left: 260px; margin-top:50px">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Successfully added! redirecting ....</strong>
</div>

<script type="text/javascript">
    <?php
    if($remain !=0 ||$remain !=''){
    ?>
    $('#sv').on('click', function(){
    var gid    = "<?php echo $gid;?>";
    var list   = $('.list').val();
    var remain= $('#remainz').val();
    if(remain===''){
        alert('Cant remain amount be empty');
    }else{
        var url="<?php echo url('checkSumSales');?>";
        $.post(url, {gid:gid,remain:remain}, function(data){
            $('#ajax5').hide('fast', function(){
                $('#alrt1').show();
                window.location = "salesEditAction";
            });

        });
    }
    });
    <?php
    }else{
    ?>
    $('#sv').hide();
    <?php
    }?>
</script>