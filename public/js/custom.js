$(function(){
    let URL              = window.location;
    let elementURL       = URL.href.split('/');
    let categorySelected = elementURL.pop();
 
    if(URL.search != ''){
        let productTitle = $('.product-title').offset().top - 100
        $(window).scrollTop(productTitle)
    }

    $('.input-search').keyup(function(event) {
        console.log(event.keyCode)
        if (event.keyCode === 13) {
            $('.btn-search').click();
        } 
    });
    if(!isNaN(categorySelected)){
        $(".select-search option[value='"+categorySelected+"']").attr("selected", true);
    }
});