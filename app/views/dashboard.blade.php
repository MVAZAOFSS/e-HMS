@extends('layout.master')
@section('content')
<div id="wrapper">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="navbar-header">
<a class="navbar-brand visible-lg" href="{{url("/home")}}">
	<p style="color: #000">Hotel administration</p>
</a>
<a class="navbar-brand hidden-lg" href='#'>
	 <p>EMIS</p>
</a>
</div>

@include('sidebar')
</nav>

<div id="page-wrapper">
      @if(Auth::user()->role == 1)
     <div class="well well-sm">Welcome Administrator</div>
                   <div class="row">
                    <div class="col-lg-12">
                        <div style="text-align: center;">
                           
                            <a class="quick-btn" href="{{url('users')}}">
                                <i class="icon-user icon-2x"></i>
                                <span> Users</span>
                                <span class="label label-danger">{{User::where('role', '!=', 1)->count()}}</span>
                            </a>

                            <a class="quick-btn" href="{{url('rooms')}}">
                                <i class="icon-credit-card icon-2x"></i>
                                <span>Rooms</span>
                                <span class="label label-success">{{Room::count()}}</span>
                            </a>
                            <a class="quick-btn" href="{{url('bars')}}">
                                <i class="icon-glass icon-2x"></i>
                                <span>Bar</span>
                                <span class="label label-warning">{{Bar::count()}}</span>
                            </a>
                            <a class="quick-btn" href="{{url('restaurant')}}">
                                <i class="icon-external-link icon-2x"></i>
                                <span>Restaurant</span>
                                <span class="label btn-metis-2">{{Restaurant::count()}}</span>
                            </a>
                            <a class="quick-btn" href="{{url('laundry')}}">
                                <i class="icon-trash icon-2x"></i>
                                <span>Laundry</span>
                                <span class="label btn-metis-4">{{Laundrie::count()}}</span>
                            </a>
                            <a class="quick-btn" href="#">
                                <i class="icon-shopping-cart icon-2x"></i>
                                <span>Stores</span>
                                <span class="label label-default"></span>
                            </a>

                            
                            
                        </div>

                    </div>
                    </div>
                    <hr/>
                         <div id="container" class="well well-sm">
        <center><img src="{{url('img/load.gif')}}" /></center>
     </div>
<script type="text/javascript">
    $(document).ready(function(){
        $(function () {
    $('#container').highcharts({
        title: {
            text: 'Hotel Management Reports'
        },
        xAxis: {
            categories: ['daily', 'weekly', 'monthly', 'yearly']
        },
        labels: {
            items: [{
                html: 'Total income obtained',
                style: {
                    left: '50px',
                    top: '18px',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                }
            }]
        },
        series: [{
            type: 'column',
            name: 'Rooms',
            data: [3, 2, 1, 3]
        }, {
            type: 'column',
            name: 'Restaurant & Bar',
            data: [2, 3, 5, 7]
        }, {
            type: 'column',
            name: 'Laundry',
            data: [4, 3, 3, 9]
        }, {
            type: 'spline',
            name: 'Average',
            data: [3, 2.67, 3, 6.33],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }, {
            type: 'pie',
            name: 'Total Guest Number',
            data: [{
                name: 'Rooms',
                y: 13,
                color: Highcharts.getOptions().colors[0] // Jane's color
            }, {
                name: 'Restaurant & Bar',
                y: 23,
                color: Highcharts.getOptions().colors[1] // John's color
            }, {
                name: 'Laundry',
                y: 19,
                color: Highcharts.getOptions().colors[2] // Joe's color
            }],
            center: [100, 80],
            size: 100,
            showInLegend: false,
            dataLabels: {
                enabled: false
            }
        }]
    });
});
    });
</script> 

     @endif
    @if(Auth::user()->role == 2)
     <div class="well well-sm">Welcome Secretary!</div>
     <div class="row">
                    <div class="col-lg-12">
                        <div style="text-align: center;">

                            <a class="quick-btn" href="#">
                                <i class="icon-credit-card icon-2x"></i>
                                <span>Rooms</span>
                                <span class="label label-success">{{Room::where('status', '!=', 'occupied')->count()}}</span>
                            </a>  
                           
                            <a class="quick-btn" href="{{url('guest')}}">
                                <i class="icon-user icon-2x"></i>
                                <span> Guests</span>
                                <span class="label label-danger">{{Guest::count()}}</span>
                            </a>

                        </div>

                    </div>
                    </div>
                    <hr/>
                                             <div id="container" class="well well-sm">
        <center><img src="{{url('img/load.gif')}}" /></center>
     </div>
<script type="text/javascript">
    $(document).ready(function(){
        $(function () {
    $('#container').highcharts({
        title: {
            text: 'Hotel Management Reports'
        },
        xAxis: {
            categories: ['daily', 'weekly', 'monthly', 'yearly']
        },
        labels: {
            items: [{
                html: 'Total income obtained',
                style: {
                    left: '50px',
                    top: '18px',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                }
            }]
        },
        series: [{
            type: 'column',
            name: 'Rooms',
            data: [3, 2, 1, 3]
        }, {
            type: 'column',
            name: 'Restaurant & Bar',
            data: [2, 3, 5, 7]
        }, {
            type: 'column',
            name: 'Laundry',
            data: [4, 3, 3, 9]
        }, {
            type: 'spline',
            name: 'Average',
            data: [3, 2.67, 3, 6.33],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }, {
            type: 'pie',
            name: 'Total Guest Number',
            data: [{
                name: 'Rooms',
                y: 13,
                color: Highcharts.getOptions().colors[0] // Jane's color
            }, {
                name: 'Restaurant & Bar',
                y: 23,
                color: Highcharts.getOptions().colors[1] // John's color
            }, {
                name: 'Laundry',
                y: 19,
                color: Highcharts.getOptions().colors[2] // Joe's color
            }],
            center: [100, 80],
            size: 100,
            showInLegend: false,
            dataLabels: {
                enabled: false
            }
        }]
    });
});
    });
</script> 
    @endif
    @if(Auth::user()->role == 10)
     <div class="well well-sm">Welcome Room controller!</div>
     <div class="col-lg-12">
         <div class="panel panel-warning">
             <div class="panel-heading">
                 <h5>Important task to be performed <b class="caret"></b><span class="glyphicon glyphicon-align-center pull-right"></span></h5>
                 
             </div>
             <div class="panel-body">
                 <div class="col-lg-4">
                   <a class="quick-btn" href="{{url("rooms/release")}}">
                         <i class="icon icon-home icon-5x"></i>
                          <span>Room release</span>
                       </a>
                     
                 </div>
                 <div class="col-lg-4">
                     <a class="quick-btn" href="{{url("rooms/repair")}}">
                         <i class="glyphicon glyphicon-wrench icon-5x"></i>
                          <span>Room repair</span>
                       </a>
                 </div>
                 <div class="col-lg-4">
                     <a class="quick-btn" href="{{url("password")}}">
                         <i class="icon icon-cogs icon-5x"></i>
                          <span>Settings</span>
                       </a>
                 </div>
             </div>
         </div>
     </div>
    @endif
    @if(Auth::user()->role == 7)
     <div class="well well-sm">Welcome Restaurant!</div>
     <div class="col-lg-12">
         <div class="panel panel-warning">
             <div class="panel-heading">
                 <h5>Important task to be performed <b class="caret"></b><span class="glyphicon glyphicon-align-center pull-right"></span></h5>
                 
             </div>
             <div class="panel-body">
                 <div class="col-lg-4">
                   <a class="quick-btn" href="{{url("bill/add")}}">
                         <i class="icon icon-archive icon-5x"></i>
                          <span>Add guests bills</span>
                       </a>
                     
                 </div>
                 <div class="col-lg-4">
                     <a class="quick-btn" href="{{url("bill/sales/add")}}">
                         <i class="icon icon-shopping-cart icon-5x"></i>
                          <span>Add sales</span>
                       </a>
                 </div>
                 <div class="col-lg-4">
                     <a class="quick-btn" href="{{url("password")}}">
                         <i class="icon icon-cogs icon-5x"></i>
                          <span>Settings</span>
                       </a>
                 </div>
             </div>
         </div>
     </div>
    @endif
    @if(Auth::user()->role == 8)
     <div class="well well-sm">Welcome Point of Sales(Pos)!</div>
     <div class="col-lg-12">
         <div class="panel panel-warning">
             <div class="panel-heading">
                 <h5>Important task to be performed <b class="caret"></b><span class="glyphicon glyphicon-align-center pull-right"></span></h5>
                 
             </div>
             <div class="panel-body">
                 <div class="col-lg-4">
                   <a class="quick-btn" href="{{url("bill/add")}}">
                         <i class="icon icon-archive icon-5x"></i>
                          <span>Add guests bills</span>
                       </a>
                     
                 </div>
                 <div class="col-lg-4">
                     <a class="quick-btn" href="{{url("bill/sales/add")}}">
                         <i class="icon icon-shopping-cart icon-5x"></i>
                          <span>Add sales</span>
                       </a>
                 </div>
                 <div class="col-lg-4">
                     <a class="quick-btn" href="{{url("password")}}">
                         <i class="icon icon-cogs icon-5x"></i>
                          <span>Settings</span>
                       </a>
                 </div>
             </div>
         </div>
     </div>
    @endif
    @if(Auth::user()->role == 6)
     <div class="well well-sm">Welcome Bar manager!</div>
     <div class="col-lg-12">
         <div class="panel panel-warning">
             <div class="panel-heading">
                 <h5>Important task to be performed <b class="caret"></b><span class="glyphicon glyphicon-align-center pull-right"></span></h5>
                 
             </div>
             <div class="panel-body">
                 <div class="col-lg-4">
                   <a class="quick-btn" href="{{url("bill/add")}}">
                         <i class="icon icon-archive icon-5x"></i>
                          <span>Add guests bills</span>
                       </a>
                     
                 </div>
                 <div class="col-lg-4">
                     <a class="quick-btn" href="{{url("bill/sales/add")}}">
                         <i class="icon icon-shopping-cart icon-5x"></i>
                          <span>Add sales</span>
                       </a>
                 </div>
                 <div class="col-lg-4">
                     <a class="quick-btn" href="{{url("password")}}">
                         <i class="icon icon-cogs icon-5x"></i>
                          <span>Settings</span>
                       </a>
                 </div>
             </div>
         </div>
     </div>
    @endif
    @if(Auth::user()->role == 5)
     <div class="well well-sm">Welcome Laundry manager!</div>
     <div class="col-lg-12">
     <div class="panel panel-warning">
             <div class="panel-heading">
                 <h5>Important task to be performed <b class="caret"></b><span class="glyphicon glyphicon-align-center pull-right"></span></h5>
                 
             </div>
             <div class="col-lg-4">
                     <a class="quick-btn" href="">
                         <i class="icon icon-dashboard icon-5x"></i>
                          <span>Home</span>
                       </a>
                 </div>
             <div class="panel-body">
                 <div class="col-lg-4">
                   <a class="quick-btn" href="{{url("laundry/list")}}">
                         <i class="icon icon-dollar icon-5x"></i>
                          <span>Guests Laundry List</span>
                        </a>
                     
                 </div>
                 <div class="col-lg-4">
                     <a class="quick-btn" href="{{url("password")}}">
                         <i class="icon icon-cogs icon-5x"></i>
                          <span>Settings</span>
                       </a>
                 </div>
             </div>
         </div>
</div>
    @endif
    @if(Auth::user()->role == 3)
     <div class="well well-sm">Welcome Accountant!</div>
     <div class="col-lg-12">
     <div class="panel panel-warning">
             <div class="panel-heading">
                 <h5>Important task to be performed <b class="caret"></b><span class="glyphicon glyphicon-align-center pull-right"></span></h5>
                 
             </div>
             <div class="panel-body">
                 <div class="col-lg-4">
                   <a class="quick-btn" href="{{url("accountant/income/".date('Y-m-d'))}}">
                         <i class="icon icon-dollar icon-5x"></i>
                          <span>Income</span>
                        </a>
                     
                 </div>
                 <div class="col-lg-4">
                     <a class="quick-btn" href="{{url("accountant/expenditure")}}">
                         <i class="icon icon-file-alt icon-5x"></i>
                          <span>Expenditure</span>
                       </a>
                 </div>
                 <div class="col-lg-4">
                     <a class="quick-btn" href="{{url("accountant/report")}}">
                         <i class="icon icon-file-text icon-5x"></i>
                          <span>Reports</span>
                       </a>
                 </div>
             </div>
         </div>
     </div>
    @endif    
    @if(Auth::user()->role == 4)
     <div class="well well-sm">Welcome Store Keeper!</div>
     <div class="col-lg-12">
         <div class="panel panel-warning">
             <div class="panel-heading">
                 <h5>Important task to be performed <b class="caret"></b><span class="glyphicon glyphicon-align-center pull-right"></span></h5>
                 
             </div>
             <div class="panel-body">
                 <div class="col-lg-4">
                   <a class="quick-btn" href="{{url("goods/manage")}}">
                         <i class="icon icon-archive icon-5x"></i>
                          <span>Manage goods</span>
                        </a>
                     
                 </div>
                 <div class="col-lg-4">
                     <a class="quick-btn" href="{{url("goods/report")}}">
                         <i class="icon icon-bookmark icon-5x"></i>
                          <span>To day report</span>
                       </a>
                 </div>
                 <div class="col-lg-4">
                     <a class="quick-btn" href="{{url("password")}}">
                         <i class="icon icon-cogs icon-5x"></i>
                          <span>Settings</span>
                       </a>
                 </div>
             </div>
         </div>
     </div>
    @endif
    @if(Auth::user()->role == 9)
     <div class="well well-sm">Welcome Manager!</div>
     <div class="well well-sm"><span class="glyphicon glyphicon-stats"></span> As Manager you can see all forms of reports from table to chart as shown below</div>
     <div class="well well-sm"><span class="glyphicon glyphicon-stats"></span> Guest Number and income in rooms, bar, laundry and restaurant REPORTS daily, weekly, monthly or yearly</div>
     <div id="container" class="well well-sm">
        <center><img src="{{url('img/load.gif')}}" /></center>
     </div>
<script type="text/javascript">
    $(document).ready(function(){
        $(function () {
    $('#container').highcharts({
        title: {
            text: 'Hotel Management Reports'
        },
        xAxis: {
            categories: ['daily', 'weekly', 'monthly', 'yearly']
        },
        labels: {
            items: [{
                html: 'Total income obtained',
                style: {
                    left: '50px',
                    top: '18px',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                }
            }]
        },
        series: [{
            type: 'column',
            name: 'Rooms',
            data: [3, 2, 1, 3]
        }, {
            type: 'column',
            name: 'Restaurant & Bar',
            data: [2, 3, 5, 7]
        }, {
            type: 'column',
            name: 'Laundry',
            data: [4, 3, 3, 9]
        }, {
            type: 'spline',
            name: 'Average',
            data: [3, 2.67, 3, 6.33],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }, {
            type: 'pie',
            name: 'Total Guest Number',
            data: [{
                name: 'Rooms',
                y: 13,
                color: Highcharts.getOptions().colors[0] // Jane's color
            }, {
                name: 'Restaurant & Bar',
                y: 23,
                color: Highcharts.getOptions().colors[1] // John's color
            }, {
                name: 'Laundry',
                y: 19,
                color: Highcharts.getOptions().colors[2] // Joe's color
            }],
            center: [100, 80],
            size: 100,
            showInLegend: false,
            dataLabels: {
                enabled: false
            }
        }]
    });
});
    });
</script> 
    @endif 
    @if(Auth::user()->role == 11)
     <div class="well well-sm">Welcome Director!</div>
          <div class="well well-sm"><span class="glyphicon glyphicon-stats"></span> As Director you can see all forms of reports from table to chart as shown below</div>
     <div class="well well-sm"><span class="glyphicon glyphicon-stats"></span> Guest Number and income in rooms, bar, laundry and restaurant REPORTS daily, weekly, monthly or yearly</div>
     <div id="container" class="well well-sm">
        <center><img src="{{url('img/load.gif')}}" /></center>
     </div>
<script type="text/javascript">
    $(document).ready(function(){
        $(function () {
    $('#container').highcharts({
        title: {
            text: 'Hotel Management Reports'
        },
        xAxis: {
            categories: ['daily', 'weekly', 'monthly', 'yearly']
        },
        labels: {
            items: [{
                html: 'Total income obtained',
                style: {
                    left: '50px',
                    top: '18px',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                }
            }]
        },
        series: [{
            type: 'column',
            name: 'Rooms',
            data: [3, 2, 1, 3]
        }, {
            type: 'column',
            name: 'Restaurant & Bar',
            data: [2, 3, 5, 7]
        }, {
            type: 'column',
            name: 'Laundry',
            data: [4, 3, 3, 9]
        }, {
            type: 'spline',
            name: 'Average',
            data: [3, 2.67, 3, 6.33],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }, {
            type: 'pie',
            name: 'Total Guest Number',
            data: [{
                name: 'Rooms',
                y: 13,
                color: Highcharts.getOptions().colors[0] // Jane's color
            }, {
                name: 'Restaurant & Bar',
                y: 23,
                color: Highcharts.getOptions().colors[1] // John's color
            }, {
                name: 'Laundry',
                y: 19,
                color: Highcharts.getOptions().colors[2] // Joe's color
            }],
            center: [100, 80],
            size: 100,
            showInLegend: false,
            dataLabels: {
                enabled: false
            }
        }]
    });
});
    });
</script>
    @endif
    @if(Auth::user()->role == 12)
     <div class="well well-sm">Welcome Bar point of sales!</div>
     <div class="col-lg-12">
         <div class="panel panel-warning">
             <div class="panel-heading">
                 <h5>Important task to be performed <b class="caret"></b><span class="glyphicon glyphicon-align-center pull-right"></span></h5>
                 
             </div>
             <div class="panel-body">
                 <div class="col-lg-4">
                   <a class="quick-btn" href="{{url("bill/add")}}">
                         <i class="icon icon-archive icon-5x"></i>
                          <span>Add guests bills</span>
                       </a>
                     
                 </div>
                 <div class="col-lg-4">
                     <a class="quick-btn" href="{{url("bill/sales/add")}}">
                         <i class="icon icon-shopping-cart icon-5x"></i>
                          <span>Add sales</span>
                       </a>
                 </div>
                 <div class="col-lg-4">
                     <a class="quick-btn" href="{{url("password")}}">
                         <i class="icon icon-cogs icon-5x"></i>
                          <span>Settings</span>
                       </a>
                 </div>
             </div>
         </div>
     </div>
    @endif
</div>   
</div> 
@stop