$(function(){
    let URL = window.location;
    let acumTotal = 0;

    if($('.status-register').val() == 2){
        $('.add-repeatable-element-button').hide();
    }

    $('body').on('click','.add-repeatable-element-button',function(){
        $('.id-fee').each(function(value,element){
            $(this).find('input').attr("name","id_fee").val(value);
        })
    });

    $('body').on('submit',function(e){
       
        if (URL.pathname.includes("/admin/payments")){
            $('.number-fee').val($('.repeatable-element').length)          
        }
        let totalFee = 0;
        $('.field-amount').each(function(){
            let amount = $(this).find('input').val();
            totalFee = parseFloat(totalFee) + parseFloat(amount);
        });
        $('.total-fee').val(totalFee)
    });

    $('a[href = "#tab_programar-pagos"]').click(function(){
        let totalFee = 0;
        $('.field-amount').each(function(){
            let amount = $(this).find('input').val();
            totalFee = parseFloat(totalFee) + parseFloat(amount);
            $('.total-fee').val(totalFee)
        });
        
    });

    $('a[tab_name = "programar-pagos"]').on('click',function(){
        /* if($('.repeatable-element').length > 0 ){
            $('.id-fee').each(function(value,element){
                console.log(value,element)
                $(this).find('input').val(value);
            })
        } */
       
        $('.field-status').each(function(){
            if($(this).find('input').val() == 2){
                $(this).parent('.repeatable-element').find('.delete-element').hide()                
                $(this).parent('.repeatable-element').find('.field-date').find('input').attr('readonly', true)                
                $(this).parent('.repeatable-element').find('.field-amount').find('input').attr('readonly', true)                
            }
        });
    })

});