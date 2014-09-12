@extends('layout.master')
@section('content')
<div id="wrapper">
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="navbar-header">
<a class="navbar-brand visible-lg" href="{{url("/home")}}">
  <p style="color: #FFF">Sales info browser </p>
</a>
<a class="navbar-brand hidden-lg" href='#'>
   <p></p>
</a>
</div>

@include('sidebar')
</nav>

<div id="page-wrapper" style="background-color:#fff">

<ol class="breadcrumb">
            <li><a href="{{ url('home') }}">Home</a></li>
            <li class="active">sales</li>
            @if(Auth::user()->role == 7)
            <li><a href="{{ url("bill/sales/add") }}">add restaurant sale </a></li>
            @elseif(Auth::user()->role == 8)
            <li><a href="{{ url("bill/sales/add") }}">add restaurant sale </a></li>
            @else
          <li><a href="{{ url("bill/sales/add") }}">add bar sale </a></li>
            
            @endif                            
</ol>
      
<div>
<table class='table table-striped table-responsive table-bordered' id='stafftale' >
              <thead>
                  <tr class="">
                      <th> # </th>
                        @if(Auth::user()->role == 7||Auth::user()->role == 8)
                        <th>  Food</th>
                        @else
                        <th> Drink</th>
                        @endif
                      
                      <th>  Cost  </th>
                      <th>  Service time </th>
                      <th>  served by </th>
                      <th>  Date</th>
                  </tr>
              </thead>
              <tbody>
                  @if(Auth::user()->role == 7)
                  <?php $i = 1; $sales = FoodSales::all();?>
                  @elseif(Auth::user()->role == 8)
                  <?php $i = 1; $sales = FoodSales::all();?>
                  @else
                  <?php $i = 1; $sales = DrinkSales::all();?>
                  @endif

                  @foreach($sales as $s)
                      <tr>
                        <td>{{$i}} <?php $i++; ?></td>
                        
                        @if(Auth::user()->role == 7)
                        <td>{{$s->food}}</td>
                         <td>{{Restaurant::where('name',$s->food)->first()->cost}}</td>
                         @elseif(Auth::user()->role == 8)
                         <td>{{$s->food}}</td>
                         <td>{{Restaurant::where('name',$s->food)->first()->cost}}</td>
                        @else
                        <td>{{$s->drink}}</td>
                         <td>{{Bar::where('name',$s->drink)->first()->cost}}</td>
                        @endif
                       
                        <td>{{Bill::tm($s->service)}}</td>
                        <td>{{User::find($s->added_by)->firstname}} {{User::find($s->added_by)->lastname}}</td>
                        <td>{{$s->date}}
                        @if($s->date==date('Y-m-d'))
                        @if(Auth::user()->role == 7)
                        <a href="{{url('sells/print/'.$s->id)}}" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-barcode"></span> print</a>
                        @elseif(Auth::user()->role == 8)
                        <a href="{{url('sells/print/'.$s->id)}}" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-barcode"></span> print</a>
                        @else
                        <a href="{{url('sells/printbarz/'.$s->id)}}" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-cloud"></span> print</a>
                        @endif
                        @endif
                        </td>
                      </tr>  
                  @endforeach
              </tbody>
          </table>
</div>
</div>
<script>
$(document).ready(function (){
    $("#stafftale").dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
           "fnDrawCallback": function( oSettings ) {
               $(".deleteuser").click(function(){
                var id1 = $(this).parent().attr('id');
                $(".deleteuser").show("slow").parent().find("span").remove();
                var btn = $(this).parent().parent();
                $(this).hide("slow").parent().append("<span><br>Delete? <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Y</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> N</a></span>");
                $("#no").click(function(){
                    $(this).parent().parent().find(".deleteuser").show("slow");
                    $(this).parent().parent().find("span").remove();
                });
                $("#yes").click(function(){
                    $(this).parent().html("<br><i class=''></i><span style='font-size: 11px; color:red'>deleting...</span>");
                    $.post("users/delete/"+id1,function(data){
                      btn.hide("slow").next("hr").hide("slow");
                   });
                });
            });//endof deleting category
           }
       });
    $('input[type="text"]').addClass("form-control");
    $('select').addClass("form-control");
    
    
});
</script>
@stop
