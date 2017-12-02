/**
 * Created by fenix on 20/03/2017.
 */
$(function(){
    $('#btnNew').on('click', function () {
        $('#titulo-modal').text("Nuevo Costo");
        $("#modalCost").modal("show");
    });
    $('#estado').change(function(){
        var estado = $(this).val();
        if(estado != '00'){
            $.ajax({
                url:document.location.protocol+'//'+document.location.host+'/getMunicipiosfitro/'+estado,
                type:'GET'
            }).done(function(response){
                if(response.code == 200){

                    $('#muni option').remove();

                    $('<option>',{text:'Seleccione un Municipio'}).attr('value',"000").appendTo('#muni');

                    $.each($.parseJSON(response.msg),function(i, row){

                        $('<option>', {text: row.nombre}).attr('value', row.id).appendTo('#muni');
                    });
                    $('#muni').selectpicker('refresh');;
                }
            }).fail(function(){

            });
        }
    });

    //*
    $('#costTable').dataTable({
        'ajax':{
            url: 'api/costos'
        },
        'createdRow':function(row,data,index){
        },
        "columnDefs": [
            { "searchable": true, "targets":[0,1] }
        ],
        'columns':[
            {data:'estado'},
            {data:'muni'},
            {data:function(row){
                        str = "<div><input type='hidden' value='"+row['id']+"'><label>"+'$ '+row['costo']+"</label></div>"
                       return str;
                  }
            },
            {data:function (row) {
                str = "<div align='center'>";
                str = "<div class='col-md-6'> ";
                str += " <button id='btnEditar' class='btn btn-primary btn-block' onclick='showCosto(\"" + row['id']+"\",\""+row['muni'] +"\");'><i class='glyphicon glyphicon-edit'></i></button> </div>";
                str += "<div class='col-md-6'> <button id='btnEliminar' class='btn btn-danger btn-block' onclick='deleteCosto(\"" + row['id'] +"\")'><i class='fa fa-trash-o'></i></button> </div>";
                str += "</div>";
                return str;
             }
            }
        ],
        'language': {
            url:'https://cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json'
        }
    });
    /*Validacion de los archivos*/


});
 function AgregarCosto() {
    swal({
        title: '¿Estás seguro?',
        text: "Se Asignara el precio al Municipio seleccionado",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, deseo continuar',
        cancelButtonText: "Lo pensaré"
    }).then(function(){
        $.ajax({
            url:document.location.protocol+'//'+document.location.host+'/panel/products/precioenvio',
            type:"POST",
            data: {'estado':$('#estado').val(),
                'municipio':$('#muni').val(),
                'precio':$('#prenvio').val()},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function(json){
            if(json.code == 200) {
                swal("Realizado", json.msg, json.detail).then(function () {
                    $('#costTable').dataTable().api().ajax.reload(null,false);
                    $('#cppr').val('');
                    $('#colpr').val('');
                    $('#prenvio').val('');
                    $('#modprecio').modal('hide');
                });
            }else{

                swal("Error",json.msg,json.detail).then(function () {

                });
            }
        }).fail(function(){
            swal("Error","Tuvimos un problema de conexion","error");
        });
    });
}

 function showCosto(id, municipio) {
     swal({
         title: 'Nuevo costo de envio para '+municipio,
         input: 'number',
         showCancelButton: true,
         confirmButtonText: 'Enviar',
         showLoaderOnConfirm: true,
         preConfirm: function (nuevoCosto) {
             return new Promise(function (resolve, reject) {
                 setTimeout(function() {
                     if (nuevoCosto === '') {
                         reject('No puede quedar en blanco')
                     } else {
                         resolve()
                     }
                 }, 2000)
             })
         },
         allowOutsideClick: false
     }).then(function (nuevoCosto) {
         $.ajax({
             url:document.location.protocol+'//'+document.location.host+'/panel/api/costos/update/'+id,
             type:"POST",
             data: {'motivo':nuevoCosto},
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         }).done(function(json){
             if(json.code == 200) {
                 swal("Realizado", json.msg, json.detail).then(function () {
                     $('#costTable').dataTable().api().ajax.reload(null,false);
                 });
             }else{

                 swal("Error",json.msg,json.detail).then(function () {
                     $('#costTable').dataTable().api().ajax.reload(null,false);
                 });
             }
         }).fail(function(){
             swal("Error","Tuvimos un problema de conexion","error");
         });
     })
 }

 function deleteCosto(id) {
     swal({
         title: '¿El Elemento se Eliminara?',
         text: "Una vez Realizado no se podra Recuperar",
         type: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Deseo Continuar',
         cancelButtonText: "Lo pensaré"
     }).then(function(){
         console.log(id);
         $.ajax({
             url:document.location.protocol+'//'+document.location.host+'/panel/api/costos/'+id,
             type:'delete',
         }).done(function(json){
             if(json.code == 200) {
                 swal("Realizado", json.msg, json.detail).then(function () {
                     $('#costTable').dataTable().api().ajax.reload(null,false);
                 });
             }else{

                 swal("Error",json.msg,json.detail).then(function () {
                     $('#costTable').dataTable().api().ajax.reload(null,false);
                 });
             }
         }).fail(function(){
             swal("Error","Tuvimos un problema de conexion","error");
         });
     });

 }