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

    $('#nexStepCheckout').prop("disabled", true);
    
    $('#terms-condition-checkout').on('change',function() {
        if( $(this).is(':checked') && $('#terms-condition-prolibro').is(':checked') ) {
            $('#nexStepCheckout').removeAttr("disabled");
        } else {
            $('#nexStepCheckout').prop("disabled", true);

        }
    });
    $('#terms-condition-prolibro').on('change',function() {
        if( $(this).is(':checked') && $('#terms-condition-checkout').is(':checked')) {
            $('#nexStepCheckout').removeAttr("disabled");
        } else {
            $('#nexStepCheckout').prop("disabled", true);

        }
    });
    $('#terms-condition-register').on('change',function() {
        if( $(this).is(':checked') ) {
            $('.btn-register').removeAttr("disabled");
        } else {
            $('.btn-register').prop("disabled", true);

        }
    });
    $('#terms-condition-support').on('change',function() {
        if( $(this).is(':checked') ) {
            $('.btn-support').removeAttr("disabled");
        } else {
            $('.btn-support').prop("disabled", true);

        }
    });
});