<div style="margin-right: 85px;">
<ul class="nav navbar-nav navbar-right">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
            <span class="label label-primary">
                <span class="glyphicon glyphicon-cog"></span> Layout     
            </span>    
           </a>
          <ul class="dropdown-menu">
            <li id="min"><a href="#" onclick="javascript:minSide()"><span class="glyphicon glyphicon-circle-arrow-left"></span> <label class="label label-success">Hide Sidebar</label></a></li>
            <li id="max" style="display:none"><a href="#" onclick="javascript:maxSide()"><span class="glyphicon glyphicon-circle-arrow-right"></span> <label class="label label-success">Show Sidebar</label></a></li>
            <li class="divider"></li>
            
          </ul>
        </li>
      </ul>
    @if(Auth::user()->role == 8)
    <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="label label-default">
                <span class="glyphicon glyphicon-wrench"></span> Change role for Bar Point of Sale ! <b class=" icon-caret-down"></b>
            </span>
            </a>
            <ul class="dropdown-menu panel panel-success">
                <li><a href="#"><span class="glyphicon glyphicon-check"></span> <label class="label label-success">Bar point of sale Aunthentication</label></a></li>
                <li class="divider"></li>
                {{Form::open(array('route'=>'login', 'class'=>'form-horizontal', 'role'=>'form'))}}
               <li> <div class="form-group">
                    {{Form::label('inputEmail3', 'Username', array('class'=>'col-sm-3 control-label'))}}
                    <div class="col-sm-11">
                        {{Form::text('username', '', array('class'=>'form-control', 'placeholder'=>'Username', 'required'))}}
                    </div>
                </div></li>
                <li><div class="form-group">
                    {{Form::label('inputPassword3', 'Password', array('class'=>'col-sm-3 control-label'))}}
                    <div class="col-sm-11">
                        {{Form::password('password', array('class'=>'form-control', 'required', 'id'=>'inputPassword3', 'placeholder'=>'Password'))}}
                    </div>
                </div></li>
                <li><div class="form-group">
                    <div class="col-sm-offset-3 col-sm-10">
                        {{Form::submit('Change Role', array('class'=>'btn btn-success btn-sm'))}}
                    </div>
                </div></li>
                </form>
            </ul>
        </li>
    </ul>
    @elseif(Auth::user()->role == 12)
    <ul class="nav navbar-nav navbar-right">

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="label label-default">
                <span class="glyphicon glyphicon-wrench"></span> Change role for Rest Point of Sale ! <b class=" icon-caret-down"></b>
            </span>
            </a>
            <ul class="dropdown-menu panel panel-success">
                <li><a href="#"><span class="glyphicon glyphicon-check"></span> <label class="label label-success">Restaurant point of sale For Aunthentication</label></a></li>
                <li class="divider"></li>
                {{Form::open(array('route'=>'login', 'class'=>'form-horizontal', 'role'=>'form'))}}
                <li> <div class="form-group">
                        {{Form::label('inputEmail3', 'Username', array('class'=>'col-sm-3 control-label'))}}
                        <div class="col-sm-11">
                            {{Form::text('username', '', array('class'=>'form-control', 'placeholder'=>'Username', 'required'))}}
                        </div>
                    </div></li>
                <li><div class="form-group">
                        {{Form::label('inputPassword3', 'Password', array('class'=>'col-sm-3 control-label'))}}
                        <div class="col-sm-11">
                            {{Form::password('password', array('class'=>'form-control', 'required', 'id'=>'inputPassword3', 'placeholder'=>'Password'))}}
                        </div>
                    </div></li>
                <li><div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10">
                            {{Form::submit('Change Role', array('class'=>'btn btn-success btn-sm'))}}
                        </div>
                    </div></li>
                </form>
            </ul>
        </li>
    </ul>
    @endif
</div>
