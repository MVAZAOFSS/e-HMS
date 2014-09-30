@extends('layout.master')

@section('content')
<div id="wrapper">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand visible-lg" href="{{url("/home")}}">
            <p style="color: #000">Guest register</p>
            </a>
            <a class="navbar-brand hidden-lg" href='#'>
                <p>EMIS</p>
            </a>
        </div>
        @include('layout-setup')
        @include('sidebar')
    </nav>

    <div id="page-wrapper" style="background-color:#fff" >
        <div class="container">
             <div class="row">
                 <div class="col-lg-10 col-lg-offset-0">
                     {{Form::open(array('url'=>'submitConferences','id'=>'sub'))}}
                     <table class="table table-striped">
                         <tr><td><input type="text" name="name" placeholder="Name of Customer" required></td><td>Select</td><td><select name="sec" id="choose">{{$errors->first('sec','<span class="error">:message</span>')}}
                                 <option value=""></option>
                                 <option value="Conference">Conference</option>
                                  <option value="Function">Function</option>
                                 </select></td>
                                 <td>Payment Mode</td><td><select name="mode"  id="moden">
                                     <option value="Cash">Cash</option>
                                     <option value="Credit">Credit</option>
                                 </select></td>
                             <td id="amounts">Amount Payed</td><td>{{$errors->first('amount','<span class="error">:message</span>')}}
                                 <input type="text" name="amount" class="amounts"></td>
                             <td id="remains">Amount Remain</td><td>
                                 <input type="text" name="remain" class="remains"></td>
                             <td><button class="btn btn-success btn-xs">Save</button></td></tr>
                     </table>
                     {{Form::token()}}
                     {{Form::close()}}
                      @if(isset($sms))
                     <div class="row">
                         <div class="alert alert-success alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert" arial-hidden="true">&times;</button>
                           <strong>{{$sms}}</strong>
                         </div>
                     </div>
                     @endif
                 </div>
             </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="well well-sm alert alert-info">
                        Records of Conference and Function Performed
                    </div>
                    <table class="table table-hover table-condensed" id="conf">
                      <thead><tr><th>Name</th><th>Type</th><th>AmountPaid</th><th>AmountRemain</th><th>Date</th><th>Action</th></tr></thead>
                        <tbody>
                            @if(isset($ro))
                            @foreach($ro as $row)
                            <tr><td>{{$row->customerName}}</td><td>{{$row->type_conferes}}</td><td>{{$row->amount}}</td><td>{{$row->remain}}</td>
                                <td>{{$row->date}}</td><td>
                                    @if($row->status=='paid')
                                    <button class="btn btn-success btn-xs">Cleared</button>
                                    @endif
                                    @if($row->status=='no')
                                    <button class="btn btn-danger btn-xs" onclick="getsRecordsFromTable('{{$row->id}}')">Pay</button>
                                    @endif
                                </td></tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <div class="menu"></div>
                </div>
            </div>
        </div>
     </div>
    </div>
<script>
    $(document).ready(function(){
        $('#remains').hide();
        $('.remains').hide();
        $('#moden').on('change',function(){
            var mode=$(this).val();
            if(mode==='Cash'){
                $('#remains').hide();
                $('.remains').hide();
            }else if(mode==='Credit'){
                $('#remains').show();
                $('.remains').show();
                $('#amounts').show();
                $('.amounts').show();
            }
        });
     });

</script>
<script>
    function getsRecordsFromTable(id){
        var url="<?php echo url('tableContents');?>";
        var url2=url+'/'+id;
        $.get(url2,function(data){
            $('.menu').html(data);
        });
    }
    $('#conf').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
</script
@stop