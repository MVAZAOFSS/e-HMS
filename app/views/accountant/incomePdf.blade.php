<div id="page-wrapper" xmlns="http://www.w3.org/1999/html">
        <p><div class="well well-sm"> <i class="glyphicon glyphicon-import"></i> Daily Income: {{date('d/m/Y')}} </div></p>
        <p><div class="well well-sm">  <b>CASH BALANCE</b> B/F  <span class="text text-info"> {{$balance-$cost}} /=</span></div></p>
        <p><div class="well well-sm">  <center><b>CASH  COLLECTION OF {{date('d/m/Y')}}</b> </center> </div></p>
        <div class="well well-sm">
            <p><b>ROOMS .......................................................................................................... <span class="">Tsh {{$roomcost}} /= </span></b></p>
            <p><b>BAR ...............................................................................................................Tsh {{$barcost+$barbillscost}} /=

                </b></p>
            <p><b>RESTAURANT ..................................................................................................Tsh {{$msosicost+$bilscost}} /=
                    <span class=""> </span>
                </b></p>
            <p><b>LAUNDRY .......................................................................................................
                    <span class=""> Tsh {{$totalprice}} /=</b></p>
            <p><b>LAUNDRY .......................................................................................................
                    <span class=""> Tsh {{$totalpricesales}} /=</b></p>
            <p><b>CONFERENCE .................................................................................................{{$amount+$remain}}</b></p>
            <p><b>FUNCTION ...................................................................................................{{$amount1+$remain1}}</b></p>
        </div>
        <div class="well well-sm">
            <p><b>ADVANCE PAYMENT FOR ROOMS ....................................................................... <span class="">Tsh {{$roomcost}} /= </span></b></p>
            <p><b>ADVANCE PAYMENT FOOD & DRINKS ...................................................................
                    <span class="">Tsh {{$no_drinks*$barcost+$bilscost+$barbillscost+$msosicost}}  /= </span>
                </b></p>
            <p><b>ADVANCE PAYMENT FOR FUNCTIONS ......................................................................{{$amount}}</b></p>
            <p><b>ADVANCE PAYMENT FOR CONFERENCE ......................................................................{{$amount1}}</b></p>
        </div>
        <div class="well well-sm">
            <p><b>TOTAL INCOME........................................................................... Tsh {{$roomcost+$barcost+$bilscost+$barbillscost+$totalprice+$totalpricesales+$msosicost+$amount+$remain+$amount1+$remain1}} /= </b></p>
        </div>

    </div>

