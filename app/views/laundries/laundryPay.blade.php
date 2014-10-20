
<div class="jumbotron">
<table class="table">
<tr><td>Guest Name</td><td>{{Guest::find($guid)->firstname}} {{Guest::find($guid)->lastname}}</td></tr>
    <tr><td>Time sent to laundry: </td><td> {{$timespent}}</td></tr>
    <tr><td>Room No: </td><td>{{Room::find(Guest::find($guid)->room_number)->name}} </td></tr>
    <tr><td>Date: </td><td> {{$date}}</td></tr>
    <tr><td>Total Piece</td><td> {{$totalpiece}}</td></tr>
    <tr><td>Total Amount</td><td> {{$totalprice}}</td></tr>
    <tr><td>Amount paid</td><td> {{$remain}}</td></tr>
    <?php
    if($payment_mode=='paid'){
    ?>
    <tr><td><p class="label label-success">No amount remain unpaid</p></td><td></td></tr>
    <?php
    }else{
    ?>
    <tr><td>Amount remained </td><td><input type="text" id="remainz" name="remain" required></td></tr>
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
    if($payment_mode=='no'){
    ?>
    $('#sv').on('click', function(){
        var gid    = {{$gid}} ;
       var guid="<?php echo $guid;?>";
    var list   = $('.list').val();
    var remain= $('#remainz').val();
       var url="<?php echo url('checkSum');?>";
        $.post(url,{gid:gid,remain:remain,guid:guid}, function(data){
            $('#ajax5').hide('fast', function(){
                $('#alrt1').show();
                window.location = "gllists";
            });

        });

    });
    <?php
    }else{
    ?>
          $('#sv').hide();
    <?php
    }?>
</script>