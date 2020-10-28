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
    /*
    if(!isNaN(elementURL[4])){
        $(".select-search option[value='"+elementURL[4]+"']").attr("selected", true);
    }
    */
    if(elementURL[3] == "search-products" && !isNaN(query)){
        $(".select-search option[value='"+query+"']").attr("selected", true);
    }

    $('.go-policy').keyup(function(event) {
        if (event.keyCode === 13) {
            $('.btn-search').click();
        } 
    });
    $('body').on('click','.go-policy', function(){
        let 
        element = $(this).data('policy').replace(/['"]+/g, '')
        titleModal = {
            "privacy_policy": 'Políticas de Privacidad',
            "shipping_policy": 'Políticas de Compra',
            "return_policy": 'Políticas de Devolución',
        } 
        $('.'+element).removeClass('d-none')
        $('.title-policy').text(titleModal[element])
    });
    $('body').on('click','.btn-close-modal', function(){
        $('.policy-text').addClass('d-none')
    });
});