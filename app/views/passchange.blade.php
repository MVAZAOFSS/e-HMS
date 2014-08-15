@extends('layout.master')
@section('content')
<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
        <div style="margin:32px 35px 0px 25px">
            <div class="panel panel-success">
                <div class="panel-heading" style="text-align:center">
                    {{HTML::image('/img/GL.png')}}
                    <hr/>
                    <p>Welcome! {{Auth::user()->firstname}}({{User::role(Auth::user()->role)}})<br/>Change Password below in order to start use the System</p>
                    <hr/>
                </div>
                <div class="panel-body">
                    <div>
                        @if(isset($emsg))
                        <div class="alert alert-danger" style="padding: 5px">
                            <strong>{{ $emsg }}!</strong> 
                          </div>
                        @endif
                    </div>

                    <div style="margin-left: 18px; margin-top: 25px; margin-bottom:25px">

                        {{Form::open(array("url"=>"passchange", 'class'=>'form-horizontal', 'role'=>'form'))}}
                        
                        <div class="form-group">
                            {{Form::label('inputEmail3', 'New Password', array('class'=>'col-sm-3 control-label'))}}
                            <div class="col-sm-8">
                                <input name="npax" required class="form-control" type="password" placeholder="New Password">
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('inputPassword3', 'Confirm Password', array('class'=>'col-sm-3 control-label'))}}
                            <div class="col-sm-8">
                                {{Form::password('cpax', array('class'=>'form-control', 'required', 'id'=>'inputPassword3', 'placeholder'=>'Confirm Password'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-10">
                                {{Form::submit('Submit', array('class'=>'btn btn-success active'))}}
                                <a href="{{url('/')}}"><button class="btn btn-primary"> Cancel </button></a>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
    </div>
</div>
@stop