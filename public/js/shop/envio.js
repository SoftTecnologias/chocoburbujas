$(document).ready(function () {
    $('#fact').on('change',function () {
        if($('#fact').prop('checked')){
            $('#facturacion').prop('hidden',false);
            $('#fact').prop('value',1);
        }else{
            $('#facturacion').prop('hidden',true);
            $('#fact').prop('value',0);
        }
    }) ;
    $('#editar').on("click",function () {
       $('#textNombres').prop('readonly',false);
        $('#txtApepat').prop('readonly',false);
        $('#txtApemat').prop('readonly',false);
        $('#estado').prop('readonly',false);
        $('#municipio').prop('readonly',false);
        $('#txtColonia').prop('readonly',false);
        $('#txtCalle').prop('readonly',false);
        $('#txtNumExt').prop('readonly',false);
        $('#txtNumInt').prop('readonly',false);
        $('#txtTel').prop('readonly',false);
        $('#txtCp').prop('readonly',false);
        $('#txtCorreo').prop('readonly',false);
    });
    $('#estado').change(function(){
        var estado = $(this).val();
        if(estado != '00'){
            $.ajax({
                url:document.location.protocol+'//'+document.location.host+'/getMunicipios/'+estado,
                type:'GET'
            }).done(function(response){
                if(response.code == 200){
                    $('#municipio option').remove();
                    $('<option>',{
                        text:'Seleccione un Municipio'
                    }).attr('value',"000").appendTo('#municipio');
                    $.each($.parseJSON(response.msg),function(i, row){
                        $('<option>', {text: row.nombre}).attr('value', row.id).appendTo('#municipio');
                    });
                }
            }).fail(function(){

            });
        }
    });
    $('#continue').on('click',function () {
        $('#formdats').submit();
    });
    $.validator.addMethod("sel",
        function(value, element) {
            return (value!=00 && value!=000);
        },
        "Seleccion Incorrecta");

    $('#formdats').validate({
        rules:{
            'textNombres': {
                required:true,
                minlength:4,
                maxlength:100},
            'txtApepat' :{
                required:true,
                minlength:4,
                maxlength:100},
            'txtApemat' : {
                required:true,
                minlength:4,
                maxlength:100},
            'estado'  : {
                required:true,
                sel:true},
            'municipio' :{
                required:true,
                sel:true},
            'txtColonia' : {
                required:true,
                minlength:4,
                maxlength:100},
            'ttxCalle' : {
                required:true,
                minlength:4,
                maxlength:100},
            'txtNumExt' :{
                required:true,
                integer:true},
            'txtNumInt' : {
                integer:true},
            'txtTel' : {
                required:true,
                maxlength:15},
            'txtCp' : {
                integer:true,
                required:true},
            'txtCorreo' : {
                email:true,
                required:true},
            'txtRFC' : {
                required:"#fact:checked",
                minlength:13,
                maxlength:13
            },
            'txtTel2':{
                maxlength:15
            },
            'factnombre':{
                required:"#fact:checked",
                minlength:4
            },
            'factpais':{
                required:"#fact:checked",
                minlength:3
            },
            'factestado':{
                required:"#fact:checked",
                minlength:3
            },
            'factmunicipio':{
                required:"#fact:checked",
                minlength:3
            },
            'factciudad':{
                required:"#fact:checked",
                minlength:3
            },
            'factcolonia':{
                required:"#fact:checked",
                minlength:3
            },
            'factcalle':{
                required:"#fact:checked",
                minlength:3
            },
            'factnume':{
                required:"#fact:checked",
                integer:true
            },
            'factnumi':{
                integer:true
            },
            'factcp':{
                required:"#fact:checked",
                integer:true
            },
            'factcelular':{
                required:"#fact:checked",
                maxlength:20
            },
            'factcorreo':{
                required:"#fact:checked",
                email:true
            }
        },
        messages:{
            'textNombres': {
                required:'Este campo es Requerido',
                minlength:'Minimo 4 caracteres',
                 maxlength:'Maximo 100 caracteres'},
            'txtApepat' :{
                required:'Este campo es Requerido',
                minlength:'Minimo 4 caracteres',
                 maxlength:'Maximo 100 caracteres'},
            'txtApemat' : {
                required:'Este campo es Requerido',
                minlength:'Minimo 4 caracteres',
                 maxlength:'Maximo 100 caracteres'},
            'estado'  : {
                required:'Este campo es Requerido',
                sel:true},
            'municipio' :{
                required:'Este campo es Requerido',
                sel:true},
            'txtColonia' : {
                required:'Este campo es Requerido',
                minlength:'Minimo 4 caracteres',
                 maxlength:'Maximo 100 caracteres'},
            'ttxCalle' : {
                required:'Este campo es Requerido',
                minlength:'Minimo 4 caracteres',
                 maxlength:'Maximo 100 caracteres'},
            'txtNumExt' :{
                required:'Este campo es Requerido',
                integer:'Solo Numeros'},
            'txtNumInt' : {
                integer:'Solo Numeros'},
            'txtTel' : {
                required:'Este campo es Requerido',
                maxlength:'Maximo 15 caracteres'},
            'txtCp' : {
                integer:'Solo Numeros',
                required:'Este campo es Requerido'},
            'txtCorreo' : {
                email:'Email Incorrecto',
                required:'Este campo es Requerido'},
            'txtRFC' : {
                required:'Este campo es Requerido para facturacion',
                minlength:'Minimo 13 caracteres',
                 maxlength:'Maximo 13 caracteres'
            },
            'txtTel2':{
                 maxlength:'Maximo 15 caracteres'
            },
            'factnombre':{
                required:'Este campo es Requerido para facturacion',
                minlength:'Minimo 4 caracteres'
            },
            'factpais':{
                required:'Este campo es Requerido para facturacion',
                minlength:'Minimo 3 caracteres'
            },
            'factestado':{
                required:'Este campo es Requerido para facturacion',
                minlength:'Minimo 3 caracteres'
            },
            'factmunicipio':{
                required:'Este campo es Requerido para facturacion',
                minlength:'Minimo 3 caracteres'
            },
            'factciudad':{
                required:'Este campo es Requerido para facturacion',
                minlength:'Minimo 3 caracteres'
            },
            'factcolonia':{
                required:'Este campo es Requerido para facturacion',
                minlength:'Minimo 3 caracteres'
            },
            'factcalle':{
                required:'Este campo es Requerido para facturacion',
                minlength:'Minimo 3 caracteres'
            },
            'factnume':{
                required:'Este campo es Requerido para facturacion',
                integer:'Solo Numeros'
            },
            'factnumi':{
                integer:'Solo Numeros'
            },
            'factcp':{
                required:'Este campo es Requerido para facturacion',
                integer:'Solo Numeros'
            },
            'factcelular':{
                required:'Este campo es Requerido para facturacion',
                maxlength:'Maximo 20 caracteres'
            },
            'factcorreo':{
                required:'Este campo es Requerido para facturacion',
                email:'Email Incorrecto'
            }
        },
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function () {
           continuarDir();
            return false;
        }
    });
});
function continuarDir() {
    swal({
        title: '¿Esta seguro?',
        text: "Si no desea realizar modificaciones puede proceder, este cambio no se puede revetir",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, deseo proceder',
        cancelButtonText: "No, deseo verificar mis datos"
    }).then(function(){
        var data = new FormData(document.getElementById("formdats"));
        data.append('checked',$('#fact').val());
        $.ajax({
            url:document.location.protocol + '//' + document.location.host+"/envio/direccion",
            type:"POST",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },contentType:false,
            processData: false
        }).done(function(json){
            if(json.code == 200) {
                swal("Realizado", json.msg, json.detail).then(function () {

                });
            }else{

                swal("error",json.msg,json.detail).then(function () {

                });
            }
        }).fail(function(){
            swal("Error","Tuvimos un problema de conexion","error");
        });
    });

}