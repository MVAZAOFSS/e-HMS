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
<div style="margin-right: 100px; display:none">
<ul class="nav navbar-nav navbar-right">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
</div>

@include('sidebar')
</nav>

<div id="page-wrapper" style="background-color:#fff">
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}">Home</a></li>
            <li class="active">Manage goods</li>                    
        </ol>
       <?php $n = Goods::count(); $goods = Goods::all(); ?>
          @if($n == 0)
            <div class="alert alert-info"><span class="glyphicon glyphicon-info-sign"></span> Please set goods first then start manage here!</div>
          @else
      <div style="padding: 10px; margin:0px 20px; height: 300px; overflow: auto">
            <h4>Manange Store: <span style="padding-left: 120px; font-size: 15px">{{date("d-m-Y")}}</span> <span style="float: right; font-size: 12px">SELECT ACTION: 
              <select id="acti">
              <option></option>
              <option value="redu">REDUCE</option>
              <option  value="ad">ADD</option>
              </select>
            </h4>
            <hr/>
            <img src="{{url("img/load.gif")}}" id="ajax5" style="width:52px;display:none;z-index:3000;position:absolute;margin-left: 330px; margin-top:120px">
          <div id="alrt" class="alert alert-success alert-dismissable" style="display:none;z-index:3000;position:absolute;margin-left: 160px; margin-top:50px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Successfully proccessed please wait redirecting ....</strong> 
          </div>
            <table id="gtl" class="table table-bordered" style="font-size: 14px">
                    <tr style="background-color:#f5f5f5">
                        <td>Goods</td>
                        <td>Total</td>
                        <td class='used' style='display: none'>Reduced</td>
                        <td class='add' style='display: none'>Added</td>

                    </tr> 
                    @foreach($goods as $g)
                      <tr>
                        <td>{{$g->goods}}</td>
                        <td>{{$g->tno}}</td>
                        <td class='used' style='display: none'><input type='text' name="{{$g->goods}}" class='used1' /></td>
                        <td class='add' style='display: none'><input type='text' name="{{$g->goods}}" class='add1'  /></td> 
                      </tr> 
                    @endforeach
            </table>

      </div>    
              <p style="margin: 20px"><input style="margin-right: 12px; display: none" type="button" name="reduce" id="reduce" class="btn btn-round btn-danger" value="Punguza Store" /><input style="margin-right: 12px; display: none" type="button" name="add" id="a" class="btn btn-round btn-success" value="Ongeza Store" /></p>  
          @endif  
                

</div>   
</div>  
<script type="text/javascript">
    $('#acti').on('change', function(){

            var sel = $(this).val();
            
            if(sel == ''){
                $('.add').hide();
                $('.used').hide();
                $('#reduce').hide();
                $('#a').hide();
            }
            
            if(sel == 'redu'){
                $(this).css('color', 'red');
                $('.add').hide();
                $('.used').show();
                $('#reduce').show();
                $('#a').hide();
            }else if(sel == 'ad'){
                $(this).css('color', 'green');
                $('.used').hide(); 
                $('.add').show();
                $('#reduce').hide();
                $('#a').show();
            }
    });


            $('#a').click(function(){
            var s = ' { "data" :{ ';
            $('.add1').each(function(){
                var u = $(this).val();
                var name = $(this).attr('name');
                s += '"'+name + '":' + u + ", ";         
            });
            s= s.substr(0, s.length - 2); 
            s += '} }';

            $('#gtl').css('opacity', '0.2');
            $('#ajax5').show();
            
            $.post('process_add', {s: s}, function(data){
                $('#ajax5').fadeOut('fast', function(){
                     $('#alrt').show();
                     window.location = "report";
                });
            });
        });

        ///////////////////////////////////////////////////////////////        
        $('#reduce').click(function(){
            var s = ' { "data" :{ ';
            $('.used1').each(function(){
                var u = $(this).val();
                var name = $(this).attr('name');
                s += '"'+name + '":' + u + ", ";         
            });
            s= s.substr(0, s.length - 2); 
            s += '} }';

            $('#gtl').css('opacity', '0.2');
            $('#ajax5').show();

            $.post('process_reduce', {s: s}, function(data){
                $('#ajax5').fadeOut('fast', function(){
                     $('#alrt').show();
                     window.location = "report";
                });
            });
        });


</script>
@stop

