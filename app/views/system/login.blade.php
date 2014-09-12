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
                            <div class="col-sm-offset-3 col-sm-10">
                                {{Form::submit('Log in', array('class'=>'btn btn-success active'))}}
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