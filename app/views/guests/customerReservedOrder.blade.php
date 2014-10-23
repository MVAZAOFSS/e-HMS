@extends('layout.master')

@section('content')
<div id="wrapper">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand visible-lg" href="{{url("/home")}}">
            <p style="color: #000">Guest register</p>
            </a>
            <a class="navbar-brand hidden-lg" href='#'>
                <p>EMIS</p>
            </a>
        </div>
        @include('layout-setup')
        @include('sidebar')
    </nav>

    <div id="page-wrapper" style="background-color:#fff" >
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}">Home</a></li>
            <li><a href="{{ url('guest') }}">Guests</a></li>
            <li><a href="{{url("guest/add")}}">Guest register</a></li>
            <li class="active">Guest register</li>
        </ol>
        <!--response messages-->
    <div class="col-lg-10">
        <div class="well well-sm">Reserved Customer Orders</div>
        <table class="table table-condensed table-hover table-responsive" id="stafftable">
            <thead><tr><th>First Name</th><th>Last Name</th><th>Surname</th><th>Sex</th><th>Arrival Date</th><th>Expected Departure date</th><th>More..</th></tr></thead>
        <tbody>
        @foreach($res as $row)
          <tr><td>{{$row->firstname}}</td><td>{{$row->lastname}}</td><td>{{$row->surname}}</td><td>{{$row->sex}}</td><td>{{$row->arrival_date}}</td><td>{{$row->departure_date}}</td><td><button class="btn btn-success btn-xs" onclick="customerOrder('{{$row->id}}')" data-target="#myres" data-toggle="modal"><span class="glyphicon glyphicon-align-justify"></span> info</button></td></tr>
        @endforeach
        </tbody>
        </table>
    </div>

    </div>
</div>
<!-------------------------- -->

<!-- Modal -->
<div class="modal fade" id="myres" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">GUEST RESERVATION INFORMATION</h4>
            </div>
            <div class="modal-body" style="height: 420px; overflow:scroll">
             <div class="contents"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#stafftable").dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
 </script>
<script>
    function customerOrder(id){
        var urlz="<?php echo url('reservedContent');?>";
        var url2=urlz+'/'+id;
        $.get(url2,function(data){
            $('.contents').html(data);
        });
    }
</script>
@stop