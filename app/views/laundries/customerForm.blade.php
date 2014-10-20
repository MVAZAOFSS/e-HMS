
<div class="col-lg-12">
<p><b>Customer Name</b>:<b class="text-primary" id="pr"> {{$name}} </b><b>Date: </b> {{date('Y-m-d')}}</p>
<p><b>Time sent to laundry: </b> <input type="text" id="time" /> <b>Total Piece</b> <input type="text" id="total" />
    <b>Select payment Mode</b><select id="opt"><option id="cash">Cash</option><option id="credit">Credit</option></select></p>
<p>Please choose :
    <input type="radio" name="tick" id="tick1" value="starch" /> Starch
    <input type="radio" name="tick" id="tick2" value="nostarch"  /> No Starch
    <input type="radio" name="tick" id="tick3" value="shirtfolder" /> Shirt folder
    <input type="radio" name="tick" id="tick4" value="shirtonhanger"  /> Shirt on hanger</p>
<hr/>

<img src="{{asset("img/load.gif")}}" id="ajax5" style="width:52px;display:none;z-index:3000;position:absolute;margin-left: 375px; margin-top:120px">
<div id="alrt1" class="alert alert-success alert-dismissable" style="display:none;z-index:3000;position:absolute;margin-left: 260px; margin-top:50px">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Successfully added! redirecting ....</strong>
</div>
<table id="gtb" class="table table-bordered" style="font-size:9px">
    <tr >
        <th></th>
        <th style="text-align:center">Items</th>
        <th colspan="3">Laundry</th>
        <th colspan="3">dry cleaning to be collect next</th>
        <th colspan="3">pressing</th>
        <th>remarks/request</th>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Guest count</td>
        <td>Hotel count</td>
        <td>Price</td>
        <td>Guest count</td>
        <td>Hotel count</td>
        <td>Price</td>
        <td>Guest count</td>
        <td>Hotel count</td>
        <td>Price</td>
        <td></td>
    </tr>
    <?php
    $a       = 1;
    $laundry = Laundrie::all();
    $items   = array();
    foreach($laundry as $l){
        $items[] = $l->name;
    }

    $ls = array_keys(array_count_values($items));
    $s  = count($ls);

    ?>
    @for($i=0;$i<$s; $i++)
    <tr>
        <td>{{$a}} <?php $a++; ?></td>
        <td>{{$ls[$i]}}</td>
        <td><input type="text" class="form-control list" count="g" item="{{$ls[$i]}}" cate="1"  /></td>
        <td><input type="text" class="form-control list" count="h" item="{{$ls[$i]}}" cate="1" /></td>
        @if(Laundrie::whereRaw('category = ? and name = ?', array(1, $ls[$i]))->count() != 0)
        <td>{{Laundrie::whereRaw('category = ? and name = ?', array(1, $ls[$i]))->first()->cost}}</td>
        @endif

        <td><input type="text" class="form-control list" count="g" item="{{$ls[$i]}}" cate="2"  /></td>
        <td><input type="text" class="form-control list" count="h" item="{{$ls[$i]}}" cate="2" /></td>
        @if(Laundrie::whereRaw('category = ? and name = ?', array(2, $ls[$i]))->count() != 0)
        <td>{{Laundrie::whereRaw('category = ? and name = ?', array(2, $ls[$i]))->first()->cost}}</td>
        @endif
        <td><input type="text" class="form-control list" count="g" item="{{$ls[$i]}}" cate="3" /></td>
        <td><input type="text" class="form-control list" count="h" item="{{$ls[$i]}}" cate="3" /></td>
        @if(Laundrie::whereRaw('category = ? and name = ?', array(3, $ls[$i]))->count() != 0)
        <td>{{Laundrie::whereRaw('category = ? and name = ?', array(3, $ls[$i]))->first()->cost}}</td>
        @endif
        <td></td>
    </tr>
    @endfor

    <tr>
        <td></td>
        <td><b>TOTAL</b></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>
    <button type="button" class="btn btn-success pull-right" id="sv">Save changes</button>
    </div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#rem').hide();
        $('#opt').on('change',function(){
            var rf=$(this).val();
            if(rf==='Cash'){
                $('#rem').hide();
            }
            if(rf==='Credit'){
                $('#rem').show();
            }
        });
        $('.list').change(function(){
            var item     = $(this).attr('item');
            var count    = $(this).attr('count');
            var cate     = $(this).attr('cate');
            var cvalue   = $(this).val();
            var name      ="<?php echo $name;?>";
            var url="<?php echo url('customerList');?>";

        $.post(url, {i:item, name:name, c:count, cate:cate, cv:cvalue}, function(data){

        });

    });

    //////////////////////////////////////////
    var v;
    $('input:radio[name="tick"]').change(function(){
        v = $(this).val();
    });

    $('#sv').on('click', function(){
    var tm     = $('#time').val();
    var total  = $('#total').val();
    var nv     = v;
    var list   = $('.list').val();
    var opt=document.getElementById('opt').value;
    if(tm==" " &&total==" "&&nv==" "){
        alert("please fill the fields");
    }else{
        if(list == ""){
            alert("please fill the fields")
        }else{

            $('#gtb').css('opacity', '0.2');
            $('#ajax5').show();
            var name      ="<?php echo $name;?>";
            var url2="<?php echo url('customers');?>";
            $.post(url2, {t:tm, to:total,name:name,opt:opt,v:nv}, function(data){
                $('#ajax5').hide('fast', function(){
                    $('#alrt1').show();
                    window.location = "salesEditAction";
                });

            });

        }
    }
    });
    });
</script>