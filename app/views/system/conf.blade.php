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

<ul class="nav navbar-nav side-nav" id="side">
        <li><a href="{{url("system/config")}}"><span class="glyphicon glyphicon-cog"></span> System</a></li>
        <li><a href="{{url("logout")}}"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
</ul>

</nav>

<div id="page-wrapper">
    <div>
    	<button class="btn btn-danger"> <i class="glyphicon glyphicon-user"></i>   Admin Setup</button>
    	<button class="btn btn-primary"> <i class="glyphicon glyphicon-repeat"></i> Empty Database</button>
    	<button class="btn btn-success"> <i class="glyphicon glyphicon-floppy-disk"></i> Database Backup</button>
    	<button class="btn btn-warning"> <i class="glyphicon glyphicon-refresh"></i> System Restore</button>
    	<button class="btn btn-primary"> <i class="glyphicon glyphicon-random"></i> System Status</button>
    	<button class="btn btn-success"> <i class="glyphicon glyphicon-list-alt"></i> System Logs</button>
    </div>
</div>   
</div> 
@stop