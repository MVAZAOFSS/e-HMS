<div class="well well-transparent">
    <div class="row">
        <table class="table table-striped table-hover table-responsive table-bordered">
            <?php
            $guest=DB::table('guests')->select('*')
                ->where('id',$id)->where('arrival_date',$start_date)->where('departure_date',$end_date)
                ->get();
            ?>
            @foreach($guest as $row)
            <tr><th>Fist Name</th><th>{{$row->firstname}}</th><th>Last Name</th><th>{{$row->lastname}}</th><th>Surname</th><th>{{$row->surname}}</th></tr>
            <tr><th>Sex</th><th>{{$row->sex}}</th><th>No children</th><th>{{$row->children}}</th><th>Mobile</th><th>{{$row->mobile}}</th></tr>
            <tr><th>Arrival From</th><th>{{$row->arrival_from}}</th><th>Destination To</th><th>{{$row->destination_to}}</th><th>Address</th><th>{{$row->address}}</th></tr>
            <tr><th>Guest Room</th><th>{{Room::find($row->room_number)->name}}</th><th>Arrival Date</th><th>{{$row->arrival_date}}</th><th>Departure Date</th><th>{{$row->departure_date}}</th></tr>
            <tr><th>Room Cost</th><th>{{Room::find($row->room_number)->cost}}</th><th>Deposit Paid Amount</th><th>{{$row->discount}}</th><th>Country</th><th>{{$row->country}}</th></tr>
            <tr><th>Days Spent</th><th>
                    <?php
                    $start=strtotime($row->arrival_date);
                    $end=strtotime($row->departure_date);
                    $diff=$end-$start;
                    ?>

                    {{round($diff/86400)}}</th><th>Cost of Room</th><th>{{$roomstotalcost}}</th><th> </th><th> </th></tr>
            @endforeach
        </table>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="well well-sm">
                <p>Records of Food Taken by Guest</p>
            </div>
            <?php
            $res=DB::table('foodbills')->select('*')
                ->join('guests','guests.id','=','foodbills.guestid')
                ->where('foodbills.guestid',$id)
                ->whereBetween('foodbills.date',array($start_date,$end_date))
                ->get();
            ?>
            <div class="well well-sm">
         <table class="table table-hover table-striped" id="coltable1">
             <thead><tr><th>Food</th><th>Cost</th><th>Date</th> </tr></thead>
             <tbody>
               @foreach($res as $food)
               <tr><td>{{$food->foods}}</td><td>{{$food->amount}}</td><td>{{$food->date}}</td></tr>
               @endforeach
             </tbody>

         </table>
        </div>
            </div>
        <div class="col-md-4">
            <div class="well well-sm">
                <p>Records of Drinks Taken by Guest</p>
            </div>
            <?php
            $restaurant=DB::table('barbills')->select('*')
                ->join('guests','guests.id','=','barbills.guestid')
                ->where('barbills.guestid',$id)
                ->whereBetween('barbills.date',array($start_date,$end_date))
                ->get();
            ?>
            <div class="well well-sm">
            <table class="table table-hover table-striped" id="coltable2">
                <thead><tr><th>Drinks</th><th>Cost</th><th>Date</th> </tr></thead>
                <tbody>
                @foreach($restaurant as $drink)
                <tr><td>{{$drink->drinks}}</td><td>{{$drink->amount}}</td><td>{{$drink->date}}</td></tr>
                @endforeach
                </tbody>

            </table>
        </div>
            </div>
        <div class="col-md-4">
            <div class="well well-sm">
                <p>Records of Laundry Taken by Guest</p>
            </div>
            <?php
            $laundry=DB::table('laundrylist')->select('*')
                ->join('guests','guests.id','=','laundrylist.gid')
                ->where('laundrylist.gid',$id)
                ->whereBetween('laundrylist.date',array($start_date,$end_date))
                ->get();
            ?>
            <div class="well well-sm">
            <table class="table table-hover table-striped" id="coltable3">
                <thead><tr><th>Total Piece</th><th>Cost</th><th>Date</th><th>Status</th></tr></thead>
                <tbody>
                @foreach($laundry as $laund)
                <tr><td>{{$laund->totalpiece}}</td><td>{{$laund->totalprice}}</td><td>{{$laund->date}}</td><td>{{$laund->money_mode}}</td></tr>
                @endforeach
                </tbody>
            </table>
            </div>
    </div>

   </div>

    <div class="row">
        <div class="well well-sm">
            <table class="table table-striped table-bordered table-responsive">
                <tr><th>Total Amount of Food paid</th><th>{{$foodbillscost}}</th><th>Total Amount of Food unpaid</th><th>{{$foodbillscostremain}}</th><th>Total Amount of Food consumed</th><th>{{$foodbillscost+$foodbillscostremain}}</th></tr>
                <tr><th>Total Amount of Drinks paid</th><th>{{$barbillscost}}</th><th>Total Amount of Drinks unpaid</th><th>{{$barbillscostremain}}</th><th>Total Amount of Drinks consumed</th><th>{{$barbillscost+$barbillscostremain}}</th></tr>
                @foreach($laundry as $laund)
                   @if($laund->payment_mode=='no')
                <tr><th>Total Amount of Laundry paid</th><th>0</th><th>Total Amount of Laundry unpaid</th><th>{{$laundrycost}}</th><th>Total Amount of Laundry consumed</th><th>{{$laundrycost}}</th></tr>
                   @else
                <tr><th>Total Amount of Laundry paid</th><th>{{$laundrycost}}</th><th>Total Amount of Laundry unpaid</th><th>{{$laundrycostremain}}</th><th>Total Amount of Laundry consumed</th><th>{{$laundrycost}}</th></tr>
                  @endif
                @endforeach
            </table>
        </div>
    </div>
    <div class="row">
        <p>The General Total Amount used <b>{{$foodbillscost+$foodbillscostremain+$barbillscost+$barbillscostremain+$laundrycost+$roomstotalcost}} /=</b></p>
    </div>
        <?php
        $total=Guest::where('id',$id)->where('arrival_date',$start_date)->where('departure_date',$end_date)->first()->discount;
        $general=$foodbillscost+$foodbillscostremain+$barbillscost+$barbillscostremain+$laundrycost+$roomstotalcost;
        ?>
     @if($total!=0)
          @if($total >=$general)
       <div class="row">
        <p class="alert alert-warning">The Balance <b>{{Guest::where('id',$id)->where('arrival_date',$start_date)->where('departure_date',$end_date)->first()->discount- ($foodbillscost+$foodbillscostremain+$barbillscost+$barbillscostremain+$laundrycost+$roomstotalcost)}} /=</b></p>
        </div>
           @else
    <div class="row">
        <p class="alert alert-danger">The Amount remain unpaid <b>{{($foodbillscost+$foodbillscostremain+$barbillscost+$barbillscostremain+$laundrycost+$roomstotalcost)-$total}} /=</b></p>
    </div>
           @endif
    @endif

</div>
<script>
    $("#coltable1,#coltable2,#coltable3").dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
</script>