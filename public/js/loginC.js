/**
 * Created by necro on 25/07/2017.
 */
$(function () {

    $('#btnLogin').on('click',function(){
        $.ajax({
            url:document.location.protocol+'//'+document.location.host+"/login",
            type:"POST",
            data:{
                email: $("#modalemail").val(),
                password: $("#modalpassword").val()
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function(response){

            if(response.code == 200){

                if(response.msg['rol']== 1 ){

                    window.location.href=document.location.protocol + '//' + document.location.host+ "/panel/area";
                }else{
                    //parte de los clientes redirigimos al index (primero generando la cookie)
                    window.location.href=document.location.protocol + '//' + document.location.host+ "/";
                }
            }
            else{
                console.log('No se hizo');
                swal("error",'Correo o Contraseña incorrecta',"error");
            }

        }).fail(function(){
            swal("error","No pudimos conectarnos al servidor","error");
            console.log('ni conecto');
        });
    });
    $(document).keypress(function(e) {
        if(e.which == 13) {
            // enter pressed
            console.log('enter capturado');
        }
    });
});
