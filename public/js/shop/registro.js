/**
 * Created by fenix on 14/06/2017.
 */
$(function(){

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
    $("#guardarcli").on('click',function () {
        $('#formReg').submit();
    });
    $('#formReg').validate({
        rules:{
            'nombre': {
                required:true,
                minlength:3,
                maxlength:100},
        'ape_pat' :{
            required:true,
            minlength:3,
            maxlength:100},
        'ape_mat' : {
            required:true,
            minlength:3,
            maxlength:100},
        'tele1'  : {
            required:true,
            minlength:10,
            maxlength:100},
        'tele2' :{
            minlength:7,
            maxlength:20},
        'calle' : {
            required:true,
            minlength:3,
            maxlength:100},
        'numero_int' : {
            maxlength:100},
        'numero_ext' :{
            required:true,
            maxlength:100},
        'colonia' : {
            required:true,
            minlength:3,
            maxlength:100},
        'cp' : {
            required:true,
            maxlength:100},
        'estado' : {
            required:true},
        'municipio' : {
            required:true},
        'username' : {
            required:true,
            minlength:3,
            maxlength:100},
        'email' : {
            required:true,
            minlength:3,
            email:true},
        'password' : {
            required:true,
            minlength:3,
            maxlength:100},
        'password_confirmation' : {
            required:true,
            minlength:3,
            maxlength:100},
            'photo':{
                extension: "png|jpg|gif"
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
            userAction();
            return false;
        }
    });
});
function userAction() {
    var data = new FormData(document.getElementById("formReg"));
    data.append('photo',$('input#photo')[0].files[0]);
    $.ajax({
        url:document.location.protocol + '//' + document.location.host+"/registro",
        type:"POST",
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },contentType:false,
        processData: false
    }).done(function(json){
        if(json.code == 200) {
            swal("Realizado", json.msg, json.detail).then(function () {
                var $redirect=$('#redireccion').attr('href');
                return window.location=$redirect;
            });
        }else{

            swal("error",json.msg,json.detail).then(function () {

            });
        }
    }).fail(function(){
        swal("Error","Tuvimos un problema de conexion","error");
    });
}
