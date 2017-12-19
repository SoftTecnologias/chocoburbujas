
$(function () {

    $('#promotions').on('change',function () {
       var id = $('#promotions').val();
       setInfo(id);
        table.destroy();
        table = $('#promotionTable').DataTable({
            'scrollX':true,
            'scrollY':'500px',
            'ajax':{
                url: '/panel/promotions/'+id,
                dataSrc: function (json){
                    return json;
                }
            },
            'createdRow':function(row,data,index){
                if(data.stock <= 0 ){
                    $('td', row).addClass("danger");
                }else{

                }
                if(parseInt(data.stock) >= parseInt(data.stock_max)){
                    $('td',row).addClass("success");
                }
                if(parseInt(data.stock) <= parseInt(data.stock_min)){
                    $('td',row).addClass("warning");
                }

            },
            'columns':[
                {data:'nombre'},
                {data:function(row){
                    return '$ '+(row['precio1']-(row['precio1']*row['descuento']));
                }
                },
                {data:function (row) {
                    str = "<div align='center'>";
                    str += "<div class='col-md-6'> <button id='btnEliminar' class='btn btn-danger block' onclick='deleteProduct(" + row['id'] +")'><i class='fa fa-trash-o'></i></button> </div>";
                    str += "</div>";
                    return str;
                }
                }
            ],
            'language': {
                url:'https://cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json'
            }
        });
    });

    $.ajax({
        url: '/panel/getpromotions/',
        type: 'get'
    }).done(function(json){
        if(json.code===200){
             $('<option></option>', {text: "Seleccione una Promocion"}).attr('value', "").appendTo('#promotions');
            $.each(json.msg, function (i, row) {
                $('<option></option>', {text: row.nombre}).attr('value', row.id).appendTo('#promotions');
                $('.selectpicker').selectpicker('refresh');
            });
        }else{
             $('<option></option>', {text: "No se obtuvieron resultados"}).attr('value', "").appendTo('#promotions');
            $('.selectpicker').selectpicker('refresh');
        }
    });


    $("#newPromo").on('click',function () {
        clear();
        $('#modalPromotion').modal('show');
    });

    $('#deletePevious').on('click',function () {
        swal({
            title: '¿Estás seguro?',
            text: "Esto no se puede revertir!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo eliminarlo!',
            cancelButtonText: "Lo pensaré"
        }).then(function () {
            ruta ='/panel/promociones/deletePrevious';
            $.ajax({
                url:ruta,
                type:'post'
            }).done(function(json){
                if(json.code==200) {
                    swal("Realizado", json.msg, json.detail);
                }else{
                    swal("Error", json.msg, json.detail);
                }
            }).fail(function(response){
                swal("Error", "tuvimos un problema", "warning");
            });
        });
    });

    $("#btnAceptarPromo").on("click",function () {
        var datos = new FormData(document.getElementById('promotionForm'));
        $('#promotions option').remove();
        $.ajax({
            url: '/panel/api/promotions',
            type: 'post',
            data: datos,
            contentType:false,
            processData: false
        }).done(function(json){
            if(json.code===200){
                swal("Realizado", json.msg, json.detail);
                $('#modalPromotion').modal('hide');
                $.ajax({
                    url: '/panel/getpromotions/',
                    type: 'get'
                }).done(function(json){
                    if(json.code===200){
                        $('<option></option>', {text: "Seleccione una Promocion"}).attr('value', "").appendTo('#promotions');
                        $.each(json.msg, function (i, row) {
                            $('<option></option>', {text: row.nombre}).attr('value', row.id).appendTo('#promotions');
                            $('.selectpicker').selectpicker('refresh');
                        });
                    }else{
                        $('<option></option>', {text: "No se obtuvieron resultados"}).attr('value', "").appendTo('#promotions');
                        $('.selectpicker').selectpicker('refresh');
                    }
                });
            }else{
                swal("Error", json.msg, json.detail);
            }
        });
        $('.selectpicker').selectpicker('refresh');
    });

    $('#productTable').DataTable({
        'scrollX':true,
        'scrollY':'500px',
        'ajax':{
            url: 'api/productos',
            dataSrc: function (json){
                return json;
            }
        },
        'createdRow':function(row,data,index){
            if(data.stock <= 0 ){
                $('td', row).addClass("danger");
            }else{

            }
            if(parseInt(data.stock) >= parseInt(data.stock_max)){
                $('td',row).addClass("success");
            }
            if(parseInt(data.stock) <= parseInt(data.stock_min)){
                $('td',row).addClass("warning");
            }

        },
        'columns':[
            {data:function(row){
                var str="";
                str = "<div align='center col-md-3'>";
                str += "<img class=\"img-responsive \" src='../images/productos/" + row['img1'] + "' alt='" + row['id'] + "'>";
                str += "</div>";
                return str;}
            },
            {data:'nombre'},
            {data:'marca'},
            {data:function(row){
                return '$ '+row['precio1'];
            }
            },
            {data:function (row) {
                str = "<div align='center'>";
                str = "<div class='col-md-6'> ";
                str += " <button id='btnAgregar' class='btn btn-primary block' onclick='Agregar(" + row['id'] +");'><i class=\"fa fa-share\" aria-hidden=\"true\"></i></button> </div>";
                str += "</div>";
                return str;
            }
            }
        ],
        'language': {
            url:'https://cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json'
        }
    });

    var table = $('#promotionTable').DataTable({
        'scrollX':true,
        'scrollY':'500px',
        'ajax':{
            url: '/panel/api/promotions',
            dataSrc: function (json){
                return json;
            }
        },
        'createdRow':function(row,data,index){
            if(data.stock <= 0 ){
                $('td', row).addClass("danger");
            }else{

            }
            if(parseInt(data.stock) >= parseInt(data.stock_max)){
                $('td',row).addClass("success");
            }
            if(parseInt(data.stock) <= parseInt(data.stock_min)){
                $('td',row).addClass("warning");
            }

        },
        'columns':[
            {data:'nombre'},
            {data:function(row){
                return '$ '+row['precio1'];
            }
            },
            {data:function (row) {
                str = "<div align='center'>";
                str += "<div class='col-md-6'> <button id='btnEliminar' class='btn btn-danger block' onclick='deleteProduct(" + row['id'] +")'><i class='fa fa-trash-o'></i></button> </div>";
                str += "</div>";
                return str;
            }
            }
        ],
        'language': {
            url:'https://cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json'
        }
    });
});

function Agregar(id) {
    var promo = $('#promotions').val();
    if(promo == ""){
        swal("Error","Seleccione una Promocion","error");
    }else {
        $.ajax({
            url: '/panel/api/productPromotion',
            type: 'post',
            data: {idproduct:id,idpromo:promo}
        }).done(function(json){
            if(json.code===200){
                swal("Realizado", json.msg, json.detail);
                $('#modalPromotion').modal('hide');
                $('#promotionTable').dataTable().api().ajax.reload(null,false);
            }else{
                swal("Error", json.msg, json.detail);
            }
        });
        $('.selectpicker').selectpicker('refresh');
    }
}

function clear() {
    $('#namepromo').val("");
    $('#descripcionpromo').val("");
    $('#descuentopromo').val("");
    $('#fechapromo').val("");
}

function deleteProduct(id) {
    swal({
        title: '¿Estás seguro?',
        text: "Esto no se puede revertir!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, deseo eliminarlo!',
        cancelButtonText: "Lo pensaré"
    }).then(function () {
        ruta ='/panel/delete/productPromotion/'+id+"-"+$('#promotions').val();
        $.ajax({
            url:ruta,
            type:'post'
        }).done(function(json){
            if(json.code==200) {
                swal("Realizado", json.msg, json.detail);
                $('#promotionTable').dataTable().api().ajax.reload(null,false);
            }else{
                swal("Error", json.msg, json.detail);
            }
        }).fail(function(response){
            swal("Error", "tuvimos un problema", "warning");
        });
    });
}

function setInfo(id) {
    console.log('si');
    $.ajax({
        url: '/panel/getpromotions/info/'+id,
        type: 'get'
    }).done(function(json){
        if(json.code===200){
                $('#infoP').text(json.msg['descuento']+"% de descuento hasta el "+json.msg['fin_promocion']+' ');
        }else{
            console.log('nel');
        }
    });
}