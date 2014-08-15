@extends('layout.master')

@section('content')
<div id="wrapper">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="navbar-header">
<a class="navbar-brand visible-lg" href="{{url("/home")}}">
	<p style="color: #000">GREENLIGHT HOTEL  </p>
</a>
<a class="navbar-brand hidden-lg" href='#'>
	 <p>EMIS</p>
</a>
</div>

@include('sidebar')
</nav>

<div id="page-wrapper" style="background-color:#fff">
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}">Home</a></li>
            <li><a href="{{ url('laundry') }}">Laundry</a></li>
            <li class="active">Edit</li>                    
        </ol>
 <!--response messages-->
         @if(isset($emsg))
         <div class="alert alert-danger alert-dismissable" >
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{ $emsg }}!</strong> 
          </div>
         @endif
         
         @if(isset($msg))
         <div class="alert alert-success alert-dismissable" >
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{ $msg }}!</strong> 
          </div>
         @endif        
<div style="width:300px">         
{{ Form::open(array("url"=>url("laundry/edit/{$laundry->id}"),"class"=>"")) }}
  <div class="form-group">
    <label for="exampleInputEmail1">Laundry item name</label>
    <input type="text" name="name" value="{{$laundry->name}}" class="form-control" id="exampleInputEmail1" placeholder="name" required>
  </div>
   <div class="form-group">
    <label for="exampleInputPassword1">Laundry category</label>
  <select class="form-control" name="category">
  <option value="1">laundry</option>
  <option value="2">dry cleaning</option>
    <option value="3">pressing</option>
    </select>
</div>
  <div class="form-group">
    <label for="exampleInputPassword1">Laundry item Cost/price</label>
    <input type="text" name="cost"  value="{{$laundry->cost}}" class="form-control" id="exampleInputPassword1" placeholder="cost/price" required>
  </div>
  <button type="submit" class="btn btn-success">Update Item</button>
</form>
</div>
</div>   
</div>  
@stop