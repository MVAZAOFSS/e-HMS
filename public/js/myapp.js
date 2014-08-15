function incompleteDetails(id){
    $.get('view/'+id,function(data){
        $('.main').html(data);
    });
}

