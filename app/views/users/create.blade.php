@extends('layout.master')

@section('content')
<div id="wrapper">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="navbar-header">
<a class="navbar-brand visible-lg" href="{{url("/home")}}">
	<p style="color: #000">User manager </p>
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
            <li><a href="{{ url('users') }}">Users</a></li>
            <li class="active">Add</li>                    
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
{{ Form::open(array("url"=>url('users/add'),"class"=>"")) }}
  <div class="form-group">
    <label for="exampleInputEmail1">Firstname</label>
    <input type="text" name="fname" class="form-control" id="exampleInputEmail1" placeholder="Firstname" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Middlename</label>
    <input type="text" name="mname" class="form-control" id="exampleInputPassword1" placeholder="Middlename" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Lastname</label>
    <input type="text" name="lname" class="form-control" id="exampleInputEmail1" placeholder="Lastname" required>
  </div>
     <div class="form-group">
    <label for="exampleInputPassword1">Gender</label>
  <select class="form-control" name="gender">
  <option value="M">Male</option>
  <option value="F">Female</option>
    </select>
</div>
  <div class="form-group">
    <label for="exampleInputPassword1">Username</label>
    <input type="text" name="username" class="form-control" id="exampleInputPassword1" placeholder="Username" required>
  </div>  
   <div class="form-group">
    <label for="exampleInputPassword1">Role</label>
 <select class="form-control" name="level" required>
                        <option value=""></option>
                        <option value="9">Manager</option>
                        <option value="11">Director</option>
                        <option value="3">Accountant</option>
                        <option value="8">Point of sales</option>
                        <option value="2">Secretary / Receptionist</option>
                        <option value="7">Restaurant - Waiter/Waitres</option>                        
                        <option value="4">Store Keeper</option>
                        <option value="5">Laundry</option>
                        <option value="6">Bar - Waiter/Waitres</option>
                        <option value="10">Room Controller</option>
                        </select>
</div>
  <button type="submit" class="btn btn-success">Add User</button>
</form>
</div>
</div>   
</div>  
@stop