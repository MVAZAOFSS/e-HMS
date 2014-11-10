@if(Auth::user()->role== 8)
<?php

$foods  = explode("," , $bi->drinks);
$fds    = array_pop($foods);
$idadi=$bi->no_drinks;

$unique = array_keys(array_count_values($foods));
$l      = count($unique);

?>
<img src="{{url("img/loader.gif")}}" id="ajax5" style="display:none;z-index:3000;position:absolute;margin-left: 230px; margin-top:50px">
<div id="alrt" class="alert alert-success alert-dismissable" style="display:none;z-index:3000;position:absolute;margin-left: 160px; margin-top:50px">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Successfully added! redirecting ....</strong>
</div>
<table class="table table-bordered" id="gt">
    <tr style="background-color: #f5f5f5">
        <th>Drink</th>
        <th>No.Drinks</th>
        <th>Times</th>
        <th>Each cost</th>
        <th>Total cost</th>
        <th>
            <select class="form-control active" id="tserv">
                <option value="{{$bi->servicetime}}">{{Bill::tm($bi->servicetime)}}</option>
                <select>
        </th>
    </tr>
    <?php $total = 0; ?>
    @for($i=0; $i < $l; $i++)
    <tr>
        <td>{{$unique[$i]}}</td>
        <td>{{$idadi[$i]}}</td>
        <td>{{Bill::appears($unique[$i], $foods)}}</td>
        <td>{{Bar::where('name', $unique[$i])->first()->cost}} /=</td>
        <td>{{($idadi[$i])*(Bar::where('name', $unique[$i])->first()->cost)}} /=</td>
    </tr>
    <?php $total = $total + (($idadi[$i])*(Bar::where('name', $unique[$i])->first()->cost)); ?>
    @endfor
    <tr style="background-color: #f5f5f5">
        <td ></td>
        <td></td>
        <td><b>Total</b></td>
        <td id="ttl">
            {{$total}} /=
        </td>
    </tr>
    <tr>
        <td>Payment</td>
        <td>
            <select id="md" class="form-control">
                <option value=""></option>
                <option value="cash">Cash</option>
                <option value="mkopo">Credit</option>
            </select>
        </td>
        <td id="a" style="display:none">Amount</td>
        <td id="ai" style="display:none">
            <p><input type="text" class="form-control" id="amount" /></p>
        </td>
        <td>
            <input id="guestid" value="{{$bi->guestid}}" type="hidden" />
            <input id="total" value="{{$total}}" type="hidden" />
            <input id="servt" value="{{$bi->servicetime}}" type="hidden" />
            <button type="button" id="sv" class="btn btn-success">Save bill </button></td>
    </tr>
</table>

@endif

<script type="text/javascript">
    $(document).ready(function(){

        $('#amount').focus(function(){$(this).css('border','1px solid red');});

        //////////////////////////////////////////
        $('#md').on('change', function(){
            var c = $(this).val();
            if(c == "cash"){
                $("#a, #ai").fadeIn(1000);
            }else{
                $("#a, #ai").hide();
            }
        });
////////////////////////////////////////////
        $('#sv').click(function(){
            var c  = $('#md').val();
            var gid = $('#guestid').val();
            var ai = $('#amount').val();
            var t  = $('#total').val();
            var s  = $('#servt').val();
            if(c==""){
                alert("Please choose payment mode");
            }else{
                if(c=="mkopo"){
                    $('#gt').css('opacity', '0.2');
                    $('#ajax5').show();
                    $.post('addBoth', {c:c, gid:gid, a:ai, t:t, s:s}, function(data){
                        $('#ajax5').hide('fast', function(){
                            $('#alrt').fadeIn(1000, function(){
                                window.location = '<?php echo url('billBoth');?>';
                            });
                        });
                    });
                }else{
                    if(ai==""){
                        alert("Please enter amount");
                    }else{
                        $('#gt').css('opacity', '0.2');
                        $('#ajax5').show();
                        $.post('addBoth', {c:c, gid:gid, a:ai, t:t, s:s}, function(data){
                            if(data == "ok"){
                                $('#ajax5').hide('fast', function(){
                                    $('#alrt').fadeIn(1000, function(){
                                        window.location = '<?php echo url('billBoth');?>';
                                    });
                                });
                            }else{
                                $('#amount').css('border','1px solid red');
                            }
                        });
                    }
                }
            }
        });

    });
</script>
