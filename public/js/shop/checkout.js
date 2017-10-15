
$(function(){
    $.validator.addMethod("mes",
        function(value, element) {
            return (value<=12 && value>0);
        },
        "Mes Incorrecto");
    $.validator.addMethod("año",
        function(value, element) {
            var d = new Date();
            var año = d.getFullYear();
            año = año-2000;
            return (value>=año && value<(año+8));
        },
        "año Incorrecto");
    $("#payment-form").validate({
        rules:{
            'nombre': {
                required:true,
                minlength:4,
                maxlength:100},
            'number':{
                required:true,
                integer:true,
                minlength:16,
                maxlength:16
            },
            'direccion':{
                required:true,
                minlength:4,
                maxlength:20
            },
            'cvc':{
                required:true,
                minlength:3,
                maxlength:3,
                integer:true
            },
            'mes':{
                required:true,
                mes:true,
                integer:true
            },
            'año':{
                required:true,
                año:true,
                integer:true
            }

        },
        messages:{
            'nombre': {
                required:'Este campo es Requerido',
                minlength:'Escriba por lo menos 4 caractres',
                maxlength:150},
            'number':{
                required:'Este campo es Requerido',
                integer:'Solo Numeros',
                minlength:'Tarjeta no valida',
                maxlength:'Tarjeta no valida'
            },
            'direccion':{
                required:'Este campo es Requerido',
                minlength:'direccion no valida',
                maxlength:'direccion no valida'
            },
            'cvc':{
                required:'Este campo es Requerido',
                minlength:'CVC no Valido',
                maxlength:'CVC no valido',
                integer:true
            },
            'mes':{
                required:'Este campo es Requerido',
                mes:true,
                integer:'Solo Numeros'
            },
            'año':{
                required:'Este campo es Requerido',
                año:true,
                integer:'Solo numeros'
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
            console.log('algo');
            return false;
        }
    });
  $('#continuar').on('click',function () {
        $("#payment-form").submit();
  });
});
