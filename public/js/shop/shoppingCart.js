$(function(){
    $('#cart').prop('onclick',null).off('click');
    $('#cartLink').prop('onclick',null).off('click');
    $("#updateCart").on('click',function (){
        filas = $("#cart tbody").find("tr");
        datos ="[";
        a=0;
        $.each(filas,function(i,row){
            if($(row).data("qty")!= $(row).find("input").val()){
                //Hay cambio por tanto se actualiza
                if(a==0) {
                    datos += "{ \"id\":\"" + $(row).data("id") + "\", \"cantidad\":" + $(row).find("input").val() + " }";
                    a++;
                }else{
                    datos+=",{ \"id\":\""+$(row).data("id") + "\", \"cantidad\":"+ $(row).find("input").val()+" }";
                }
            }
        });
        datos+="]";

        $.ajax({
            type:"POST",
            url:document.location.protocol + '//' + document.location.host  + '/updateCart',
            data:{ productos: datos},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function(response){
            if(response.code == 200){
                swal("¡Listo!", "Carrito Actualizado", response.detail);
                location.reload();
                $.each(filas,function(i,row) {
                    $(row).data("qty", $(row).find("input").val());
                });
            }else{
                swal("UPSS", response.msg, response.detail);
            }
        }).fail(function(){
            swal("UPSS", "No pudimos conectarnos al servidor", "error");
        });
    });

    $("#next").on('click',function () {
       $.ajax({
           url:'shoppingCart',
           type: 'post',
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function(json){
             console.log(json);
             switch(json.code){
                 case 200:
                     window.location.href = $("#next").data('val');
                     break;
                 case 404:
                     console.log("marcamos con error el input correspondiente");
                     $.each(json.msg,function(index,row){
                         $('#qty'+row['product_id']).addClass("has-error");
                         $('#qty'+row['product_id'] +" span").remove();
                         $('#qty'+row['product_id']).append($('<span>',{text:row['msg']}));
                     });

                     break;
                 case 403:
                     window.location.href = json.detail;
                     break;
                 case 500:

                     break;
                 default:
                     break;
             }
           },
           error:function (response) {
             console.log(response);
           }
       });
    });


});


function stripeResponseHandler(status, response) {
    if (response.error) {
        $('.error')
            .removeClass('hide')
            .find('.alert')
            .text(response.error.message);
    } else {
        // token contains id, last4, and card type
        var token = response['id'];
        // insert the token into the form so it gets submitted to the server
        $form.find('input[type=text]').empty();
        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
        $form.get(0).submit();
    }
}