

/////////////////////////////////////
$(document).ready(function (){
    $("#stafftale").dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
           "fnDrawCallback": function( oSettings ) {
               $(".bll").click(function(){
                   var id1 = $(this).parent().attr('id');
                   $('#main').html("");
                   $('#ajax7').show();
                   $.post('loadbill',{id:id1}, function(data){
                      $('#ajax7').hide();
                      $('#main').html(data);
                   }); 

               });//endof deleting category
           }
       });
    $('input[type="text"]').addClass("form-control");
    $('select').addClass("form-control");
    
    
});

///////////////////////////////////////////////