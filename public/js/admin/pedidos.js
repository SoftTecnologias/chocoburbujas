
$(document).ready(function(){
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
    /* Dependencia de los combos*/
    var tabla= $('#tblPedidos').DataTable({
        'scrollX':true,
        'scrollY':'600px',
        "processing": true,
        "serverSide": true,
        "ajax": document.location.protocol+'//'+document.location.host+'/panel/getpedidos',
        "columnDefs": [
            { width: "20%", "targets": [0,3,5]},
            { width: "10%", "targets": [2]},
            { width: "10%", "targets": [1,4]},
            {searchable: false, targets:[2,3,4,5]},
            {"targets": 0,"orderable": false}
        ],
        columns: [
            {data:'name'},
            {data:'phone'},
            {data: 'ostatus'},
            {data: function (row) {
                str = "<div aling='center'>  <label id='orderid' hidden>"+row['orderid']+"</label>";

                str += (row['userA'] != null) ? "<label id='usera'>"+row['userA']+"</label>" : "<label id='usea'>Sin Asignar</label>";
                str += "</div>";
                return str;
            }},
            {data: 'orderdate'},
            {data: function (row) {
                // console.log(row);
                str = "<div align='center'>";
                str += "<button id='Detalle"+row["orderid"]+"' class='btn btn-warning btn-xs col-md-3' onclick='showDetail(\""+row['orderid']+"\",\""+row["ostatus"]+"\")'>Detalle</button>";
                str += (row['ostatus'] == 'No Asignado') ? "<button id='Asignar"+row["orderid"]+"' class='btn btn-success btn-xs col-md-3' onclick='Asignar(\""+row['orderid']+"\")'>Asignar</button>":
                    (row['ostatus']== 'Tomado') ?  "<button id='reasignar"+row["orderid"]+"' class='btn btn-success btn-xs col-md-3' onclick='Asignar(\""+row['orderid']+"\")'>Reasignar</button>" +
                        "<button id='despachar"+row["orderid"]+"' class='btn btn-info btn-xs col-md-3' onclick='Despachar(\""+row['orderid']+"\")'>Despachar</button>":
                        (row['ostatus'] == 'Despachado') ? "<button id='enviado"+row["orderid"]+"' class='btn btn-info btn-xs col-md-3' onclick='Enviado(\""+row['orderid']+"\")'>Enviado</button>":
                            (row['ostatus']=='Enviado') ? "<button id='recibido"+row["orderid"]+"' class='btn btn-info btn-xs col-md-3' onclick='recibido(\""+row['orderid']+"\")'>Recibido</button>":
                                (row['ostatus']=='Cancelado') ? '<i class="fa fa-times fa-2x" aria-hidden="true"></i>':'<i class="fa fa-check fa-2x" aria-hidden="true"></i>';
                str += (row['ostatus'] == 'No Asignado' || row['ostatus'] == 'Tomado' || row['ostatus'] == 'Despachado') ? "<button id='cancelar"+row["orderid"]+"' class='btn btn-danger btn-xs col-md-3' onclick='Cancelar(\""+row['orderid']+"\")'>Cancelar</button>":'';
                str += "</div>";
                return str;
            }}
        ],
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            switch (aData['ostatus'])
            {
                case 'No Asignado':
                    $('td',nRow).addClass('default');
                    $('td:nth-child(3)',nRow,1).attr('style',"font-weight:bold");
                break;
                case 'Tomado': $('td',nRow).addClass('active');
                    $('td:nth-child(3)',nRow,1).attr('style',"color:darkgray;font-weight:bold");
                    break;
                case 'Despachado': $('td',nRow).addClass('info');
                    $('td:nth-child(3)',nRow,1).attr('style',"color:blue;font-weight:bold");
                    break;
                case 'Enviado': $('td',nRow).addClass('warning');
                    $('td:nth-child(3)',nRow,1).attr('style',"color:orange;font-weight:bold");
                    break;
                case 'Recibido': $('td',nRow).addClass('success');
                    $('td:nth-child(3)',nRow,1).attr('style',"color:green;font-weight:bold");
                    break;
                case 'Cancelado': $('td',nRow).addClass('danger');
                    $('td:nth-child(3)',nRow,1).attr('style',"color:red;font-weight:bold");
                    break;
            }
        },
        'language': {
            url:'https://cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json',
            sLoadingRecords : '<span><img src="http://www.snacklocal.com/images/ajaxload.gif"></span>'
        }
    });

    $('#prenform').validate({
        rules: {
            'cppr': {
                required: true,
                integer:true,
                maxlength: 10
            },
            'colpr': {
                required: true,
                maxlength: 200
            },
            'prenvio': {
                required: true,
               number: true
            }
        },
        messages: {
            'cppr': {
                required: "Este campo es requerido",
                integer: "Solo numero enteros",
                maxlength: "El codigo postal no puede superar los 10 caracteres"
            },
            'colpr': {
                required: "Este campo es requerido",
                maxlength: "El nombre no puede superar los 200 caracteres"
            },
            'prenvio': {
                required: "Este campo es requerido",
                number: "Solo numeros"
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
            AgregarCosto();
            return false;
        }
    });

    $('#btnAsignar').on('click',function () {
        swal({
            title: '¿Estás seguro?',
            text: "Al asignar a este trabajador no lo podra asignar hasta que halla concluido el proceso",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: "Lo pensaré"
        }).then(function(){
            var id = $("#trabajadores option:selected").val();
            var pedidoid = $('#pedidoid').val();
            console.log(pedidoid);
            $.ajax({
                url:document.location.protocol+'//'+document.location.host+'/panel/pedidos/regitra/'+pedidoid,
                type:"POST",
                data: {'trabajador':id},
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
        });
    });
    $('#filtroNombre').on('change',function () {
       if($(this).prop('checked')) {
            $('#tblPedidos').dataTable({
                destroy: true,
                columnDefs: [{
                    "searchable": false, targets: [ 2, 3, 4, 5]
                }]
            });
        }else{
           $('#filtroEstado').prop('checked', true);
            $('#tblPedidos').dataTable({
                destroy: true,
                columnDefs: [{
                    "searchable": false, targets: [0, 2, 3, 4, 5]
                }]
            });
        }
    });
    $('#filtroEstado').on('change',function () {
        if($(this).prop('checked')) {

            $('#tblPedidos').dataTable({
                destroy: true,
                columnDefs: [{
                    "searchable": false, targets: [2, 3, 4, 5]
                }]
            });
        }else{
            $('#filtroNombre').prop('checked', true);
            $('#tblPedidos').dataTable({
                destroy: true,
                columnDefs: [{
                    "searchable": false, targets: [1, 2, 3, 4, 5]
                }]
            });
        }
    });
    $('#precioEnvio').on('click',function () {
        $('#cppr').val('');
        $('#colpr').val('');
        $('#prenvio').val('');
        $('#modprecio').modal('show');
    });
    $('#btnAgregar').on('click',function () {
        $('#prenform').submit();
    });

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

function Asignar(id){
    $.ajax({
        url: document.location.protocol + '//' + document.location.host+"/panel/getTrabajadores",
        type: 'GET'
    }).done(function (response) {
        if (response.code == 200) {
            $('#trabajadores option').remove();
            $('<option>', {
                text: 'Seleccione un Trabajador'
            }).attr('value', "00").appendTo('#trabajadores');
            $.each($.parseJSON(response.msg), function (i, row) {
                $('<option>', {text: row.name}).attr('value', row.id).appendTo('#trabajadores');
            });
            $('#pedidoid').val(id);
            $('#modtr').modal('show');
        }
    }).fail(function () {

    });
}
$('#btnAceptar').on('click',function () {
    $('#moddetalle').modal('hide');

});

function Despachar(id) {
    swal({
        title: '¿Estás seguro?',
        text: "Una vez despachado el producto no se puede volver atras",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Deseo Continuar',
        cancelButtonText: "Lo pensaré"
    }).then(function(){
        $.ajax({
            url:document.location.protocol+'//'+document.location.host+'/panel/pedidos/accion/'+id,
            type:"POST",
            data: {'estado':'D'},
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
    });
}

function Enviado(id) {
    swal({
        title: '¿Estás seguro?',
        text: "Una vez Enviado el producto no se puede volver atras",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Deseo Continuar',
        cancelButtonText: "Lo pensaré"
    }).then(function(){
        console.log(pedidoid);
        $.ajax({
            url:document.location.protocol+'//'+document.location.host+'/panel/pedidos/accion/'+id,
            type:"POST",
            data: {'estado':'E'},
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
    });
}

function recibido(id) {
    swal({
        title: '¿Estás seguro?',
        text: "El pedido se marcara como Recibido",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Deseo Continuar',
        cancelButtonText: "Lo pensaré"
    }).then(function(){
        console.log(pedidoid);
        $.ajax({
            url:document.location.protocol+'//'+document.location.host+'/panel/pedidos/accion/'+id,
            type:"POST",
            data: {'estado':'R'},
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
    });
}

function Cancelar(id) {
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

function showDetail(id,status){
    var $total;
    console.log(status);
    $.ajax({
        url: document.location.protocol + '//' + document.location.host+"/panel/pedidos/detail/"+id,
        type: 'GET'
    }).done(function (response) {
        var $canceldetail = '';
        if (response.code == 200) {
            $('#cuerpodetalles td').remove();
            $('#cuerpodetalles tr').remove();
            $.each($.parseJSON(response.msg), function (i, row) {
                    var precio = row.up;
                    $('<tr>').attr('role','row').appendTo('#cuerpodetalles');
                $('<td>', {text: row.producto}).attr('class','info').appendTo('#cuerpodetalles');
                $('<td>', {text: '$'+precio}).attr('class','info').appendTo('#cuerpodetalles');
                $('<td>', {text: row.cantidad}).attr('class','info').appendTo('#cuerpodetalles');
                $('<td>', {text: '$'+row.tc}).attr('class','info').appendTo('#cuerpodetalles');
                $total = row.total;
                $canceldetail = row.detalle;
            });
            $('#celtotal td').remove();
            $('#celtotal tr').remove();
            $('#celtotal').append(
                '<tr class="success">' +
                '<td colspan="3">Total de la compra</td>' +
                '<td> $'+$total+'</td>' +
                '</tr>'
            );
            if(status == 'Cancelado') {
                $('#celtotal').append(
                    '<tr class="warning">' +
                    '<td colspan="4">Informacion de Cancelacion</td>' +
                    '</tr>' +
                    '<tr class="warning">' +
                    '<td colspan="4">'+$canceldetail+'</td>' +
                    '</tr>'
                );
            }
            $('#moddetalle').modal('show');
        }
    }).fail(function () {

    })

}
