$(function(){
    let URL = window.location;
    let acumTotal = 0;

    $('body').on('submit',function(){
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
        if($('.repeatable-element').length == 1 ){
            $('.id-fee').each(function(e){
                $(this).find("input").val(e)
            })
        }

        let totalFee = 0;
        $('.field-amount').each(function(){
            let amount = $(this).find('input').val();
            totalFee = parseFloat(totalFee) + parseFloat(amount);
            $('.total-fee').val(totalFee)
        });
        
    });

    $('a[tab_name = "programar-pagos"]').on('click',function(){
        if($('.repeatable-element').length > 0 ){
            console.log($('.id-fee').length, 'idfee')
            $('.id-fee').each(function(value,element){
                $(this).find('input').val(value);
            })
        }
    })

    $('.add-repeatable-element-button').click(function(e){

   /*      $('.field-amount').each(function(val){
            let amount = $(this).find('input').val();
            acumTotal = parseFloat(acumTotal) + parseFloat(amount);
        });
        $('.total-fee').val(acumTotal) */

        if(URL.hash == '#programar-pagos'){
           // console.log($('.repeatable-element').length,'len')
            if($('.repeatable-element').length > 0 ){
                $('.id-fee').each(function(value,element){
                   // console.log(value,element,'value,element')
                    $(this).addClass('id-f-'+value);
                    //$(this).find("input").val(value+1)
                })
            }
        }
    });
});