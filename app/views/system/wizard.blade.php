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
                </div>
                <div class="panel-body">
                    <div>
                        @if(isset($error))
                        <div class="alert alert-danger" style="padding: 5px">
                            <strong>{{ $error }}!</strong> 
                          </div>
                        @endif
                    </div>

                    <div style="margin-left: 18px; margin-top: 25px; margin-bottom:25px">
                        <div class="alert alert-info" style="padding: 5px">
                            <strong>System Installer:<br> Please follow instruction to install this system<br/>1st Step::<br/>
                            </strong>
                            <span>Fill mysql database server access information below </span> 
                          </div>
                        <div class="progress progress-striped active">
                          <div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 15%">
                            <span class="sr-only">45% Complete</span>
                          </div>
                        </div>

                        {{Form::open(array('url'=>'system/setup', 'class'=>'form-horizontal', 'role'=>'form'))}}
                        <div class="form-group">
                            {{Form::label('inputEmail3', 'Username', array('class'=>'col-sm-3 control-label'))}}
                            <div class="col-sm-8">
                                {{Form::text('username', '', array('class'=>'form-control', 'placeholder'=>'Username', 'required'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('inputPassword3', 'Password', array('class'=>'col-sm-3 control-label'))}}
                            <div class="col-sm-8">
                                {{Form::password('password', array('class'=>'form-control', 'required', 'id'=>'inputPassword3', 'placeholder'=>'Password'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('inputEmail3', 'Database', array('class'=>'col-sm-3 control-label'))}}
                            <div class="col-sm-8">
                                {{Form::text('database', '', array('class'=>'form-control', 'placeholder'=>'Database name', 'required'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-10">
                                <button class="btn btn-warning active"> Next <i class="glyphicon glyphicon-arrow-right"></i></button>
                                
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