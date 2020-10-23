$(function(){
    let URL          = window.location;
    let elementURL   = URL.href.split('/');
    let query        = elementURL.pop();

    $('.input-search').keyup(function(event) {
        if (event.keyCode === 13) {
            $('.btn-search').click();
        } 
    });


    if(elementURL[3] == "search-products" && elementURL[4] != undefined){
        $('.input-search').val(query);
    }
    if(!isNaN(elementURL[4])){
        $(".select-search option[value='"+elementURL[4]+"']").attr("selected", true);
    }
    /*
    if(elementURL[3] == "search-products" && !isNaN(query)){
        console.log(elementURL,query)
        $(".select-search option[value='"+query+"']").attr("selected", true);
    }
    */
});