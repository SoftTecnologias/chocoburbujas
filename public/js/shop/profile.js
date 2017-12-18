//tab js//
$(document).ready(function(e) {

    $("#editper").on('click',function () {
       $("#nombre").prop('disabled',false);
        $("#nombre").focus();
       $("#apellidop").prop('disabled',false);
        $("#apellidom").prop('disabled',false);
       $("#acciones").prop('hidden',false);
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
    $("#edpas").on('click',function () {
        $("#passactual").prop('disabled',false);
        $("#passactual").focus();
        $("#newpass").prop('disabled',false);
        $("#confirmpass").prop('disabled',false);
    });
    $("#editcontact").on('click',function () {
        $("#calle").prop('disabled',false);
        $("#colonia").prop('disabled',false);
        $("#noext").prop('disabled',false);
        $("#cp").prop('disabled',false);
        $("#noint").prop('disabled',false);
        $("#tel").prop('disabled',false);
        $("#tel2").prop('disabled',false);
        $("#accionesc").prop('hidden',false);
        $("#estado").prop('disabled',false);
        $("#municipio").prop('disabled',false);
        $("#mail").prop('disabled',false);
    });
    $("#guardarper").on('click',function () {
        var id = $("#userid").val();
        var datos = {'nombre':$('#nombre').val(),apellidop:$('#apellidop').val(),apellidom:$('#apellidom').val()};
        $.ajax({
            url:document.location.protocol+'//'+document.location.host+'/perfil/perup',
            type:"POST",
            data: datos,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function(json){
            if(json.code == 200) {
                swal("Realizado", json.msg, json.detail).then(function () {
                    location.reload();
                });
            }else{

                swal("Error",json.msg,json.detail).then(function () {
                    location.reload();
                });
            }
        }).fail(function(){
            swal("Error","Tuvimos un problema de conexion","error");
        });
    });
    $("#guardarcontact").on('click',function () {
        var id = $("#userid").val();
        var datos = {
                    estado:$('#estado').val(),
                    municipio:$('#municipio').val(),
                    colonia:$('#colonia').val(),
                    calle:$('#calle').val(),
                    noext:$('#noext').val(),
                    noint:$('#noint').val(),
                    cp:$('#cp').val(),
                    tel:$('#tel').val(),
                    email:$('#mail').val(),
                    tel2:$('#tel2').val()
        };
        $.ajax({
            url:document.location.protocol+'//'+document.location.host+'/perfil/contup',
            type:"POST",
            data: datos,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function(json){
            if(json.code == 200) {
                swal("Realizado", json.msg, json.detail).then(function () {
                    location.reload();
                });
            }else{

                swal("Error",json.msg,json.detail).then(function () {
                    location.reload();
                });
            }
        }).fail(function(){
            swal("Error","Tuvimos un problema de conexion","error");
        });
    });
    $("#changepass").on('click',function () {
        if($('#newpass').val() != '' || $('#passactual').val() != ''){
            if($('#newpass').val() != $('#confirmpass').val()){
                swal("Error",'Las contraseñas no coinciden','');
            }else{
                cambiaPass();}
    }else{
            swal("Error",'Escriba una contraseña','');
        }
    });
    $("#cancelar").on('click',function () {
       location.reload();
    });
    $("#cancelarc").on('click',function () {
        location.reload();
    });
    $("#foto").on('change',function (event) {
        var id = $("#userid").val();
         data = new FormData(document.getElementById("passform"));
        $.ajax({
            url:document.location.protocol+'//'+document.location.host+'/perfil/imgup',
            type:"POST",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        }).done(function(json){
            if(json.code == 200) {
                swal("Realizado", json.msg, json.detail).then(function () {
                    location.reload();
                });
            }else{

                swal("Error",json.msg,json.detail).then(function () {
                    location.reload();
                });
            }
        }).fail(function(){
            swal("Error","Tuvimos un problema de conexion","error");
        });
    });
    $('.form').find('input, textarea').on('keyup blur focus', function (e) {

        var $this = $(this),
            label = $this.prev('label');

        if (e.type === 'keyup') {
            if ($this.val() === '') {
                label.removeClass('active highlight');
            } else {
                label.addClass('active highlight');
            }
        } else if (e.type === 'blur') {
            if( $this.val() === '' ) {
                label.removeClass('active highlight');
            } else {
                label.removeClass('highlight');
            }
        } else if (e.type === 'focus') {

            if( $this.val() === '' ) {
                label.removeClass('highlight');
            }
            else if( $this.val() !== '' ) {
                label.addClass('highlight');
            }
        }

    });


    $('.tab a').on('click', function (e) {

        e.preventDefault();

        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');
        target = $(this).attr('href');

        $('.tab-content > div').not(target).hide();

        $(target).fadeIn(600);

    });
//canvas off js//
    $('#menu_icon').click(function(){
        if($("#content_details").hasClass('drop_menu'))
        {
            $("#content_details").addClass('drop_menu1').removeClass('drop_menu');
        }
        else{
            $("#content_details").addClass('drop_menu').removeClass('drop_menu1');
        }


    });

//search box js//


    $("#flip").click(function(){
        $("#panel").slideToggle("5000");
    });

// sticky js//

    $(window).scroll(function(){
        if ($(window).scrollTop() >= 500) {
            $('nav').addClass('stick');
        }
        else {
            $('nav').removeClass('stick');
        }
    });

});
function cambiaPass(){
    swal({
        title: '¿Estás seguro?',
        text: "Esto no se puede revertir!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, deseo Cambiarla!',
        cancelButtonText: "Lo pensaré"
    }).then(function(){
        var datos = {
            actual:$('#passactual').val(),
            nueva:$('#newpass').val(),
            confirm:$('#confirmpass').val()
        };
        $.ajax({
            url:document.location.protocol+'//'+document.location.host+'/perfil/passup',
            type:"POST",
            data: datos,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function(json){
            if(json.code == 200) {
                swal("Realizado", json.msg, json.detail).then(function () {
                    location.reload();
                });
            }else{

                swal("Error",json.msg,json.detail).then(function () {
                    location.reload();
                });
            }
        }).fail(function(){
            swal("Error","Tuvimos un problema de conexion","error");
        });
    });

}
function infocompra(id){
    $.ajax({
        url:document.location.protocol+'//'+document.location.host+'/perfil/infocompra/'+id,
        type:'GET'
    }).done(function(response){
        if(response.code == 200){
            $('#info tr').remove();
            $.each($.parseJSON(response.msg),function(i, row){
                var nuevaFila="<tr>";
                nuevaFila+="<td>"+row['producto']+"</td>";
                nuevaFila+="<td>"+row['marca']+"</td>";
                nuevaFila+="<td>"+row['cantidad']+"</td>";
                nuevaFila+="<td>"+row['preciounitario']+"</td>";
                nuevaFila+="<td>"+(row['preciounitario']*row['cantidad'])+"</td>";
                nuevaFila+="<td>MXN</td>";
                nuevaFila+="</tr>";
                $("#info").append(nuevaFila);
            });
        }
    }).fail(function(){

    });
    $('#modalinfo').modal('show');
}
function cancelar(id){
    swal({
        title: '¿Estás seguro?',
        text: "Si cancela no podra recuperar la orden",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Deseo Continuar',
        cancelButtonText: "Lo pensaré"
    }).then(function(){
        swal({
            title: 'Motivo de Cancelacion',
            input: 'text',
            showCancelButton: true,
            confirmButtonText: 'Enviar',
            showLoaderOnConfirm: true,
            preConfirm: function (motivo) {
                return new Promise(function (resolve, reject) {
                    setTimeout(function() {
                        if (motivo === '') {
                            reject('Escriba un Motivo')
                        } else {
                            resolve()
                        }
                    }, 2000)
                })
            },
            allowOutsideClick: false
        }).then(function (motivo) {
            $.ajax({
                url:document.location.protocol+'//'+document.location.host+'/panel/pedidos/accion/'+id,
                type:"POST",
                data: {'estado':'C', 'motivo':motivo},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }).done(function(json){
                if(json.code == 200) {
                    swal("Realizado", json.msg, json.detail).then(function () {
                        $('#tblPedidos').dataTable().api().ajax.reload(null,false);
                    });
                }else{

                    swal("Error",json.msg,json.detail).then(function () {
                        $('#tblPedidos').dataTable().api().ajax.reload(null,false);
                    });
                }
            }).fail(function(){
                swal("Error","Tuvimos un problema de conexion","error");
            });
        })

    });
}
