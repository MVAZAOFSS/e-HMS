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
@include('layout-setup')
@include('sidebar')
</nav>

<div id="page-wrapper" style="background-color:#fff">
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}">Home</a></li>
            <li><a href="{{ url('users') }}">Users</a></li>
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

{{ Form::open(array("url"=>url("user/edit/{$user->id}"),"id"=>"myform")) }}
  <div class="form-group">
    <label for="exampleInputEmail1">Status</label><br/>
		<div class="radio-inline">
		  <label>
		    <input type="radio" name="status" id="optionsRadios1" value="active" {{User::active($user->status)}}>
		    Active
		  </label>
		</div>
		<div class="radio-inline">
		  <label>
		    <input type="radio" name="status" id="optionsRadios2" value="blocked" {{User::blocked($user->status)}}>
		    Blocked
		  </label>
		</div>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Request password reset ?</label><br/>
    <div class="radio-inline">
      <label>
        <input type="radio" name="passrest" id="optionsRadios1" value="yes" >
         Yes
      </label>
    </div>
    <div class="radio-inline">
      <label>
        <input type="radio" name="passrest" id="optionsRadios2" value="no" checked>
        No
      </label>
    </div>
  </div>

<div style="display:none1">
  <div class="form-group">
    <label for="exampleInputEmail1">Firstname</label>
    <input type="text" name="fname" value="{{$user->firstname}}" class="form-control" id="exampleInputEmail1" placeholder="Firstname" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Middlename</label>
    <input type="text" name="mname" value="{{$user->middlename}}" class="form-control" id="exampleInputPassword1" placeholder="Middlename" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Lastname</label>
    <input type="text" name="lname" value="{{$user->lastname}}" class="form-control" id="exampleInputEmail1" placeholder="Lastname" required>
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
    <input type="text" name="username" value="{{$user->username}}" class="form-control" id="exampleInputPassword1" placeholder="Username" required>
  </div>  
   <div class="form-group">
    <label for="exampleInputPassword1">Role</label>
 <select class="form-control" name="level" required>
                        <option value="{{$user->role}}">{{User::role($user->role)}}</option>
                        <option ></option>
                        <option value="9">Manager</option>
                        <option value="2">Secretary / Receptionist</option>
                        <option value="3">Accountant</option>
                        <option value="4">Store Keeper</option>
                        <option value="5">Laundry</option>
                        <option value="6">Bar - Waiter/Waitres</option>
                        <option value="7">Restaurant - Waiter/Waitres</option>
                        <option value="10">Room Controller</option>
                        </select>
</div>
</div>
<hr/>
  <button type="submit" class="btn btn-success">Update User</button>
</form>
</div>
</div>   
</div>  
@stop