$(function(){
    let URL          = window.location;

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