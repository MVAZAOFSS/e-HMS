@extends('layout.master')
@section('content')
<div id="wrapper">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand visible-lg" href="{{url("/home")}}">
            <p style="color: #000">Bar manager </p>
            </a>
            <a class="navbar-brand hidden-lg" href='#'>
                <p>EMIS</p>
            </a>
        </div>

        @include('sidebar')
    </nav>
    <div id="page-wrapper">
       <div class="container">
           <div class="row">
               <div class="col-lg-8 col-lg-offset-0">
                       {{Form::open(array('url'=>'submitBf'))}}
                     <table class="table table-striped">
                         <tr><td>Cash To Benk</td><td>{{$errors->first('benk','<span class="error">:message</span>')}}<input type="text" name="benk" class="form-control"></td>
                            <td>Cash Balance</td><td>{{$errors->first('bak','<span class="error">:message</span>')}}<input type="text" name="bak" class="form-control"></td>
                             <td><button class="btn btn-success">Save</button></td></tr>
                     </table>
                       {{Form::token()}}
                       {{Form::close()}}
                   @if(isset($rg))
                   <div class="row">
                       <div class=" alert alert-success alert-dismissable">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                           <strong>
                               {{rg}}
                           </strong>
                       </div>
                   </div>
                   @endif
                   @if(isset($rg1))
                   <div class="row">
                       <div class="alert alert-success alert-dismissable">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                           <strong>
                   {{$rg1}}
                           </strong>
                       </div>
                   </div>
                   @endif
                   <div class="row">
                   <div class="well well-sm">
                      <p>Records of Money Taken To bank</p>
                   </div>
                       <table class="table table-striped table-condensed table-hover" id="money">
                           <thead><tr><th>Amount To Bank</th><th>Amount Balance</th><th>Date Action</th></tr></thead>
                            <tbody>
                            <?php
                            $res=DB::table('banks')->get();
                            foreach($res as $row){
                            ?>
                                <tr><td>{{$row->bank}}</td><td>{{$row->balance}}</td><td>{{$row->date}}</td></tr>
                            <?php
                            }?>
                            </tbody>
                       </table>
                    </div>
               </div>
           </div>

       </div>

    </div>
</div>
<script>
    $('#money').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
</script>
@stop