<div class="col-lg-12">
    <ul class=" nav nav-tabs nav-justified">
            <li class="active"><a href="#datz" data-toggle="tab">Restaurants</a></li>
            <li class="<?php if(isset($active1)){ echo'active';}?>"><a href="#bar" data-toggle="tab">Bar</a></li>
            <li class="<?php if(isset($active2)){ echo'active';}?>"><a href="#pay" data-toggle="tab">Laundry</a></li>
        </ul>
        <div class="tab-content" style="display: block;">
           
            <div class="in tab-pane active" id="datz">
                <table class="table table-condensed table-striped table-hover" id="retz">
                    <thead><tr><th>Foods</th><th>Date</th><th>Extra</th></tr></thead>
                    <tbody>
                    <?php
                    $res=Bill::where('guestid',$id)->where('cleared','no')->get();
                    if($res){
                    foreach ($res as $row){
                    ?>
                        <tr><td>{{$row->foods}}</td><td>{{$row->date}}</td><td><button class="btn btn-danger btn-xs" onclick="incompleteRestaurant('{{$row->id}}')"
                                                                                       data-target="#myinco" data-toggle="modal">
                                Incomplete</button></td></tr>
                    <?php
                    }
                    }else{
                    ?>
                    <p class="alert alert-warning"><span class="glyphicon glyphicon-warning-sign"></span> No food Taken</p>
                   <?php
                    }
                   ?>
                    </tbody>
                </table>
            </div>
            <div class="in tab-pane <?php if(isset($active1)){ echo 'active';}?>" id="bar">
                
                <table class="table table-condensed table-striped table-hover" id="retz1">
                    <thead><tr><th>Drinks</th><th>Date</th><th>Extra</th></tr></thead>
                    <tbody>
                    <?php
                    $restz=Bil::where('guestid',$id)->where('cleared','no')->get();
                    if($restz){
                    foreach ($restz as $row){
                    ?>
                        <tr><td>{{$row->drinks}}</td><td>{{$row->date}}</td><td><button class="btn btn-danger btn-xs" onclick="incompleteDetails('{{$row->id}}')"
                                                                                data-target="#myinco" data-toggle="modal">
                                Incomplete</button></td></tr>
                    <?php
                    }
                    }else{
                    ?>
                       <p class="alert alert-warning"><span class="glyphicon glyphicon-warning-sign"></span> No Drinks Taken</p>
                   <?php
                    }
                   ?>
                    </tbody>
                </table>
                
            </div>
            <div class="in tab-pane <?php if(isset($active2)){echo 'active';}?>" id="pay">
                <table class="table table-condensed table-striped table-hover" id="retz2">
                <thead><tr><th>Drinks</th><th>Date</th><th>Extra</th></tr></thead>
                    <tbody>
                    <?php
                    $restl=  Llist::where('gid',$id)->get();
                    if($restl){
                    foreach ($restl as $row){
                    ?>
                        <tr><td>{{$row->item}}</td><td>{{$row->created_at}}</td><td><button class="btn btn-danger btn-xs">
                                complete</button></td></tr>
                    <?php
                    }
                    }else{
                    ?>
                       <p class="alert alert-warning"><span class="glyphicon glyphicon-warning-sign"></span> No Drinks Taken</p>
                   <?php
                    }
                   ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
<div class="modal fade" id="myinco" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Guest bill information</h4>
      </div>
      <div class="modal-body" style="height: 320px; overflow:scroll">
        
        <div class="main">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
    $("#retz").dataTable({
    });
    $("#retz1").dataTable({
    });
    $("#retz2").dataTable({
    });
</script>
<script>
    function incompleteDetails(id){
        var urlz="<?php echo url('view');?>";
    $.get(urlz+'/'+id,function(data){
        $('.main').html(data);
    });
}
function incompleteRestaurant(id){
    var urla="<?php echo url('restaurants');?>";
    var urla2=urla+'/'+id;
    $.get(urla2,function(data){
        $('.main').html(data);
    });
}
function ViewList(id){
    var url="<?php echo url('view_den');?>";
    var url2=url+'/'+id;
    $.get(url2,function(data){
        $('.list').html(data);
    });
}
</script>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
