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
            <tr><th>No children</th><th>{{$row->children}}</th><th>Mobile</th><th>{{$row->mobile}}</th><th>Country</th><th>{{$row->country}}</th></tr>
            <tr><th>Arrival From</th><th>{{$row->arrival_from}}</th><th>Destination To</th><th>{{$row->destination_to}}</th><th>Address</th><th>{{$row->address}}</th></tr>
            <tr><th>Guest Room</th><th>{{Room::find($row->room_number)->name}}</th><th>Arrival Date</th><th>{{$row->arrival_date}}</th><th>Departure Date</th><th>{{$row->departure_date}}</th></tr>
            <tr><th>Room Cost</th><th>{{$row->totalcost}}</th><th>Pre-Paid Amount</th><th>{{$row->pre_paidcost}}</th><th>Sex</th><th>{{$row->sex}}</th></tr>
            <tr><th>Days Spent</th><th>
                    <?php
                    $start=strtotime($row->arrival_date);
                    $end=strtotime($row->departure_date);
                    $diff=$end-$start;
                    ?>

                    {{round($diff/86400)}}</th><th> </th><th></th><th> </th><th> </th></tr>
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
         <table class="table table-hover table-striped" id="coltable1">
             <thead><tr><th>Food</th><th>Cost</th><th>Date</th> </tr></thead>
             <tbody>
               @foreach($res as $food)
               <tr><td>{{$food->foods}}</td><td>{{$food->amount}}</td><td>{{$food->date}}</td></tr>
               @endforeach
             </tbody>

         </table>
            <div class="row">
                <p class="alert alert-success">Total Amount of Food paid {{$foodbillscost}}</p>
            </div>
            <div class="row">
                <p class="alert alert-danger">Total Amount of Food unpaid {{$foodbillscostremain}}</p>
            </div>
            <div class="row">
                <p class="alert alert-info">Total Amount of Food consumed {{$foodbillscost+$foodbillscostremain}}</p>
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
            <table class="table table-hover table-striped" id="coltable2">
                <thead><tr><th>Drinks</th><th>Cost</th><th>Date</th> </tr></thead>
                <tbody>
                @foreach($restaurant as $drink)
                <tr><td>{{$drink->drinks}}</td><td>{{$drink->amount}}</td><td>{{$drink->date}}</td></tr>
                @endforeach
                </tbody>

            </table>
            <div class="row">
                <p class="alert alert-success">Total Amount of Drinks paid{{$barbillscost}} /=</p>
            </div>
            <div class="row">
                <p class="alert alert-danger">Total Amount of Drinks unpaid {{$barbillscostremain}} /=</p>
            </div>
            <div class="row">
                <p class="alert alert-info">Total Amount of Drinks consumed {{$barbillscost+$barbillscostremain}} /=</p>
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
            <table class="table table-hover table-striped" id="coltable3">
                <thead><tr><th>Total Piece</th><th>Cost</th><th>Date</th> </tr></thead>
                <tbody>
                @foreach($laundry as $laund)
                <tr><td>{{$laund->totalpiece}}</td><td>{{$laund->totalprice}}</td><td>{{$laund->date}}</td></tr>
                @endforeach
                </tbody>
            </table>
            <div class="row">
            <p class="alert alert-warning">Total Amount of Laundry consumed {{$laundrycost}} /=</p>
             </div>
            </div>
    </div>
    <div class="row">
        <p>The General Total Amount used <b>{{$foodbillscost+$foodbillscostremain+$barbillscost+$barbillscostremain+$laundrycost}} /=</b></p>
    </div>
        <?php
        $total=Guest::where('id',$id)->where('arrival_date',$start_date)->where('departure_date',$end_date)->first()->pre_paidcost;
        $general=$foodbillscost+$foodbillscostremain+$barbillscost+$barbillscostremain+$laundrycost;
        ?>
     @if($total!=0)
          @if($total>=$general)
       <div class="row">
        <p class="alert alert-warning">The Balance <b>{{Guest::where('id',$id)->where('arrival_date',$start_date)->where('departure_date',$end_date)->first()->pre_paidcost- ($foodbillscost+$foodbillscostremain+$barbillscost+$barbillscostremain+$laundrycost)}} /=</b></p>
        </div>
           @else
    <div class="row">
        <p class="alert alert-danger">The Amount remain unpaid <b>{{($foodbillscost+$foodbillscostremain+$barbillscost+$barbillscostremain+$laundrycost)-$total}} /=</b></p>
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