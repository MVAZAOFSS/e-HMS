<p><b>Guest Name</b>: {{$name}} <b>Date: </b> {{date('Y-m-d')}}</p>
<p><b>Time sent to laundry: </b> {{$timespent}} <b>Total Piece</b> {{$totalpiece}}  </p>
<p>Please choose :
    <input type="radio" name="tick" id="tick1" value="starch"  <?php
    if(isset($choose)=='starch'){
        echo 'checked';
    }

    ?> /> Starch
    <input type="radio" name="tick" id="tick2" value="nostarch"   <?php
    if(isset($choose)=='nostarch'){
        echo 'checked';
    }

    ?>/> No Starch
    <input type="radio" name="tick" id="tick3" value="shirtfolder"  <?php
    if(isset($choose)=='shirtfolder'){
        echo 'checked';
    }

    ?> /> Shirt folder
    <input type="radio" name="tick" id="tick4" value="shirtonhanger" <?php
    if(isset($choose)=='shirtonhanger'){
        echo 'checked';
    }

    ?> /> Shirt on hanger</p>
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

    $lauTC = 0;
    $dryTC = 0;
    $preTC = 0;

    ?>
    @for($i=0;$i<$s; $i++)
    <tr>
        <td>{{$a}} <?php $a++; ?></td>
        <td>{{$ls[$i]}}</td>
        <td>
            {{CustomerList::whereRaw('name = ? and counttype = ? and category = ? and date = ? and item =?', array($name, 'g', 1,$date,$ls[$i]))->first()->cvalue }}
        </td>
        <td>
            {{ CustomerList::whereRaw('name = ? and counttype = ? and category = ? and date = ? and item =?', array($name, 'h', 1,$date,$ls[$i]))->first()->cvalue }}
        </td>
        @if(Laundrie::whereRaw('category = ? and name = ?', array(1, $ls[$i]))->count() != 0)
        <td>{{ (CustomerList::whereRaw('name = ? and counttype = ? and category = ? and date = ?  and item =?', array($name, 'g',1,$date,$ls[$i]))->first()->cvalue  * Laundrie::whereRaw('category = ? and name = ?', array(1, $ls[$i]))->first()->cost)}}</td>
        @endif

        <td>
            {{ CustomerList::whereRaw('name = ? and counttype = ? and category = ? and date = ? and item =?', array($name, 'g', 2,$date,$ls[$i]))->first()->cvalue }}
        </td>
        <td>
            {{ CustomerList::whereRaw('name = ? and counttype = ? and category = ? and date = ? and item =?', array($name, 'h', 2,$date,$ls[$i]))->first()->cvalue }}
        </td>
        @if(Laundrie::whereRaw('category = ? and name = ?', array(2, $ls[$i]))->count() != 0)
        <td>
            {{
            (Laundrie::whereRaw('category = ? and name = ?', array(2, $ls[$i]))->first()->cost
            *  CustomerList::whereRaw('name = ? and counttype = ? and category = ? and date = ?  and item =?', array($name, 'g', 2,$date,$ls[$i]))->first()->cvalue)
            }}
        </td>
        @endif
        <td>
            {{ CustomerList::whereRaw('name = ? and counttype = ? and category = ? and date = ? and item =?', array($name, 'g', 3,$date,$ls[$i]))->first()->cvalue }}
        </td>
        <td>
            {{ CustomerList::whereRaw('name = ? and counttype = ? and category = ? and date = ? and item =?', array($name, 'h', 3,$date,$ls[$i]))->first()->cvalue }}
        </td>
        @if(Laundrie::whereRaw('category = ? and name = ?', array(3, $ls[$i]))->count() != 0)
        <td>{{

            (Laundrie::whereRaw('category = ? and name = ?', array(3, $ls[$i]))->first()->cost
            *  CustomerList::whereRaw('name = ? and counttype = ? and category = ? and date = ?  and item =?', array($name, 'g', 3,$date,$ls[$i]))->first()->cvalue)
            }}</td>
        @endif
        <td></td>
    </tr>
    <?php

    $lauTC = (CustomerList::whereRaw('name = ? and counttype = ? and category = ? and date = ?  and item =?', array($name, 'g', 1,$date,$ls[$i]))->first()->cvalue  * Laundrie::whereRaw('category = ? and name = ?', array(1, $ls[$i]))->first()->cost) + $lauTC;
    $dryTC = (CustomerList::whereRaw('name= ? and counttype = ? and category = ? and date = ?  and item =?', array($name, 'g', 2,$date,$ls[$i]))->first()->cvalue  * Laundrie::whereRaw('category = ? and name = ?', array(2, $ls[$i]))->first()->cost)  + $dryTC;
    $preTC = (CustomerList::whereRaw('name= ? and counttype = ? and category = ? and date = ?  and item =?', array($name, 'g', 3,$date,$ls[$i]))->first()->cvalue  * Laundrie::whereRaw('category = ? and name = ?', array(3, $ls[$i]))->first()->cost) + $preTC;


    ?>
    @endfor

    <tr>
        <td></td>
        <td><b>TOTAL</b></td>
        <td></td>
        <td></td>
        <td>{{$lauTC}}</td>
        <td></td>
        <td></td>
        <td>{{$dryTC}}</td>
        <td></td>
        <td></td>
        <td>{{$preTC}}</td>
        <td></td>
    </tr>
</table>
<p class="alert alert-info" > The Total amount is {{$lauTC + $preTC + $dryTC}} </p>
<input type="hidden" name="amount" id="amount" value="{{$lauTC + $preTC + $dryTC}}">
<script>

    $(document).ready(function(){
        var amount=$('#amount').val();
        var name="<?php echo $name;?>";
        var url="<?php echo url('confirmLaundrySales');?>";
        $.post(url,{name:name,amount:amount},function(data){
            setTimeout(function(){
                window.location="salesEditAction";
            },6000);
        });

    });
</script>
