/**
 * Created by fenix on 21/03/2017.
 */
$(function(){
    $(".Btn-seccion").on('click',function(){
        updateSection($(this).data('val'));
    });
});

function updateSection(seccion){
    id=$("#"+seccion+"-id").val();
    nombre=$('#'+seccion+"-nombre").val();
    activo=$('#'+seccion+"-activo").prop("checked");
    setHeight=$('#'+seccion+"-setHeight").prop("checked");
    height=$('#'+seccion+"-height").val();
    console.log ("height:"+height);
    console.log ("activo:"+activo);
    console.log ("nombre:"+nombre);
    console.log ("setHeight:"+setHeight);
    console.log ("id:"+id);
    if(nombre !== ""){  //validamos nombre
        if(setHeight){ //validamos que esté chequeado el setheight
            if(height !== "" || height > 0 ){ //validamos heigth no esté vacio o sea 0
                //Enviamos a servidor
                $.ajax({
                    url:"api/configuraciones/"+id,
                    type:"post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'nombre':nombre,
                        'activo':activo,
                        'setHeight':setHeight,
                        'height': height
                    }
                }).done(function(json){
                    if(json.code == 200) {
                        swal("Realizado", json.msg, json.detail);
                        $("#"+seccion+"-title").text(nombre);
                    }else{
                        console.log(json);
                        swal("Error",json.msg,json.detail);
                    }
                }).fail(function(){
                    swal("Error","Tuvimos un problema de conexion","error");
                });
            }else{ //esta vacio o es 0
                $("#"+seccion+"-height").focus();
                swal("Advertencia","Al seleccionar el tamaño no se permiten valores menores a 0","error");
            }
        }else{ //Como es falso no se envian todos los parametros
            //Enviamos a servidor
            $.ajax({
                url:"api/configuraciones/"+id,
                type:"post",
                data: {
                    nombre:nombre,
                    setHeight:setHeight,
                    activo:activo
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }).done(function(json){
                if(json.code == 200) {
                    swal("Realizado", json.msg, json.detail);
                    $("#"+seccion+"-title").text(nombre);
                }else{
                    console.log(json);
                    swal("Error",json.msg,json.detail);
                }
            }).fail(function(){
                swal("Error","Tuvimos un problema de conexion","error");
            });
        }
    }else {
        swal("error","El nombre de la seccion no puede ir vacio");
        $("#"+seccion+"-nombre").focus();
    }
}

