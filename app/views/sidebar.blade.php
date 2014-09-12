<div class="">
	@if(Auth::user()->role == 1)
    <ul class="nav navbar-nav side-nav" id="side">
        <li><a href="{{url("home")}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="{{url("users/add")}}"><span class="glyphicon glyphicon-user"></span> Users</a></li>
        <li><a href="{{url("password")}}"><span class="glyphicon glyphicon-lock"></span> Password </a></li>
	    <li><a href="{{url("rooms/add")}}"><span class="glyphicon glyphicon-credit-card"></span> Rooms</a></li>
	    <li><a href="{{url("bar/add")}}"><span class="glyphicon glyphicon-glass"></span> Bars</a></li>
	    <li><a href="{{url("restaurant/add")}}"><span class="glyphicon glyphicon-cutlery"></span> Restaurants</a></li>
        <li><a href="{{url("laundry/add")}}"><span class="glyphicon glyphicon-trash"></span> Laundry</a></li>
        <li><a href="{{url("good/set")}}"><span class="glyphicon glyphicon-shopping-cart"></span> Stores</a></li>
        <li><a href="{{url("logout")}}"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
    </ul>
    @endif
    @if(Auth::user()->role == 2)
    <ul class="nav navbar-nav side-nav" id="side">
        <li><a href="{{url("home")}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="{{url("guest/add")}}"><span class="glyphicon glyphicon-credit-card"></span> Guest register</a></li>
        <li><a href="{{url("guest/messages")}}"><span class="glyphicon glyphicon-question-sign"></span> Checkin <span class="badge pull-right" id="msg">{{Guest::whereRaw('reserved != ? and confirm = ? and arrival_date <= ? and cancelled = ?' , array('no',  'no', date("Y-m-d", strtotime("+1 day")),'no'))->count()}}</span>  <img id="l" class="pull-right" style="display:none" src="{{url("img/load.gif")}}" /></a></li>
        <li><a href="{{url("guest/checkouts")}}"><span class="glyphicon glyphicon-check"></span> Checkout <span class="badge pull-right" id="msg2">{{Guest::where('departure_date', date("Y-m-d"))->count()}}</span>  <img id="l2" class="pull-right" style="display:none" src="{{url("img/load.gif")}}" /></a></li>
        <li><a href="{{url("conferences")}}"><span class="glyphicon glyphicon-ban-circle"></span> Conference & Function</a></li>
        <li><a href="{{url("notifications")}}"><span class="glyphicon glyphicon-bell"></span> Notification <span class="badge pull-right" id="msg1">{{Notification::whereToAndReadAndRemoved('secretary', 'no', 'no')->count()}}</span>  <img id="l4" class="pull-right" style="display:none" src="{{url("img/load.gif")}}" /></a></a></li>
        <li><a href="{{url("password")}}"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
        <li><a href="{{url("logout")}}"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
    </ul>
    @endif
    @if(Auth::user()->role == 10)
    <ul class="nav navbar-nav side-nav" id="side">
        <li><a href="{{url("home")}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="{{url("rooms/release")}}"><span class="glyphicon glyphicon-log-out"></span> Rooms to release <span class="badge pull-right" id="msg">{{Guest::whereRaw('departure_date = ? and released = ?', array(date("Y-m-d"), 'no'))->count()}}</span>  <img id="l" class="pull-right" style="display:none" src="{{url("img/load.gif")}}" /></a></li>
        <li><a href="{{url("rooms/repair")}}"><span class="glyphicon glyphicon-wrench"></span> Rooms to repair</a></li>
        <li><a href="{{url("password")}}"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
        <li><a href="{{url("logout")}}"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
    </ul>
    @endif  
    @if(Auth::user()->role == 7)
    <ul class="nav navbar-nav side-nav" id="side">
        <li><a href="{{url("home")}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="{{url("bill/add")}}"><span class="glyphicon glyphicon-book"></span> Guests Bills</a></li>
        <li><a href="{{url("bill/sales/add")}}"><span class="glyphicon glyphicon-cutlery"></span> Sales</a></li>
        <li><a href="{{url("password")}}"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
        <li><a href="{{url("logout")}}"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
    </ul>
    @endif 
    @if(Auth::user()->role == 8)
    <ul class="nav navbar-nav side-nav" id="side">
        <li><a href="{{url("home")}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="{{url("bill/add")}}"><span class="glyphicon glyphicon-book"></span> Guests Bills</a></li>
        <li><a href="{{url("bill/sales/add")}}"><span class="glyphicon glyphicon-cutlery"></span> Sales</a></li>
        <li><a href="{{url("password")}}"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
        <li><a href="{{url("logout")}}"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
    </ul>
    @endif 
    @if(Auth::user()->role == 6)
    <ul class="nav navbar-nav side-nav" id="side">
        <li><a href="{{url("home")}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="{{url("bill/add")}}"><span class="glyphicon glyphicon-book"></span> Guests Bills</a></li>
        <li><a href="{{url("bill/sales/add")}}"><span class="glyphicon glyphicon-glass"></span> Sales</a></li>
        <li><a href="{{url("password")}}"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
        <li><a href="{{url("logout")}}"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
    </ul>
    @endif
    @if(Auth::user()->role == 12)
    <ul class="nav navbar-nav side-nav" id="side">
        <li><a href="{{url("home")}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="{{url("bill/add")}}"><span class="glyphicon glyphicon-book"></span> Guests Bills</a></li>
        <li><a href="{{url("bill/sales/add")}}"><span class="glyphicon glyphicon-glass"></span> Sales</a></li>
        <li><a href="{{url("password")}}"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
        <li><a href="{{url("logout")}}"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
    </ul>
    @endif
    @if(Auth::user()->role == 5)
    <ul class="nav navbar-nav side-nav" id="side">
        <li><a href="{{url("home")}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="{{url("laundry/list")}}"><span class="glyphicon glyphicon-trash"></span> Guest Laundry List</a></li>
        <li><a href="{{url("password")}}"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
        <li><a href="{{url("logout")}}"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
    </ul>
    @endif
    @if(Auth::user()->role == 3)
    <ul class="nav navbar-nav side-nav" id="side">
        <li><a href="{{url("home")}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="{{url("accountant/income/".date('Y-m-d'))}}"><span class="glyphicon glyphicon-arrow-down"></span> Income</a></li>
        <li><a href="{{url("create")}}"><span class="glyphicon glyphicon-usd"></span> Report B/F</a></li>
        <li><a href="{{url("accountant/expenditure")}}"><span class="glyphicon glyphicon-arrow-up"></span> Expenditure</a></li>
        <li><a href="{{url("accountant/report")}}"><span class="glyphicon glyphicon-list-alt"></span> Reports</a></li>
        <li><a href="{{url("password")}}"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
        <li><a href="{{url("logout")}}"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
    </ul>
    @endif
    @if(Auth::user()->role == 9)
    <ul class="nav navbar-nav side-nav"  id="side">
        <li><a href="{{url("home")}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="{{url("reports/rooms")}}"><span class="glyphicon glyphicon-list-alt"></span> Room Reports</a></li>
        <li><a id="popv" href="{{url("reports/restaurant")}}"><span class="glyphicon glyphicon-list-alt"></span> Restaurant Reports</a></li>
        <li><a href="{{url("reports/bar")}}"><span class="glyphicon glyphicon-list-alt"></span> Bar Reports</a></li>
        <li><a href="{{url("reports/laundry")}}"><span class="glyphicon glyphicon-list-alt"></span> Laundry Reports</a></li>
        <li><a href="{{url("notifications")}}"><span class="glyphicon glyphicon-bell"></span> Notification <span class="badge pull-right" id="msg1">{{Notification::whereToAndReadAndRemoved('secretary', 'no', 'no')->count()}}</span>  <img id="l4" class="pull-right" style="display:none" src="{{url("img/load.gif")}}" /></a></a></li>
        <li><a href="{{url("password")}}"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
        <li><a href="{{url("logout")}}"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
    </ul>
    @endif       
    @if(Auth::user()->role == 4)
    <ul class="nav navbar-nav side-nav" id="side">
        <li><a href="{{url("home")}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="{{url("goods/manage")}}"><span class="glyphicon glyphicon-wrench"></span> Manage Goods</a></li>
        <li><a href="{{url("goods/report")}}"><span class="glyphicon glyphicon-list-alt"></span> Today Reports</a></li>
        <li><a href="{{url("password")}}"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
        <li><a href="{{url("logout")}}"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
    </ul>
    @endif    
    @if(Auth::user()->role == 11)
    <ul class="nav navbar-nav side-nav" id="side">
        <li><a href="{{url("home")}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="{{url("reports/rooms")}}"><span class="glyphicon glyphicon-list-alt"></span> Room Reports</a></li>
        <li><a href="{{url("reports/restaurant")}}"><span class="glyphicon glyphicon-list-alt"></span> Restaurant Reports</a></li>
        <li><a href="{{url("reports/bar")}}"><span class="glyphicon glyphicon-list-alt"></span> Bar Reports</a></li>
        <li><a href="{{url("reports/laundry")}}"><span class="glyphicon glyphicon-list-alt"></span> Laundry Reports</a></li>
        <li><a href="{{url("password")}}"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
        <li><a href="{{url("logout")}}"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
    </ul>
    @endif 
    
</div>
  <script type="text/javascript">
    $(document).ready(function(){
        function notify(){
            $.get('notify', function(data){
                    $('#msg1').text(data); 
            });
        }

        setInterval(notify, 10000);
    });
</script>