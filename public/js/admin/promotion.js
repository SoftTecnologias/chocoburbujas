
$(function () {
    hoy = new Date();
    $('#promotionTable').DataTable({
        'scrollY':'500px',
        'scrollX':true,
        'ajax':{
            url: '/panel/api/promotions',
            dataSrc: function (json){
                return json;
            }
        },
        'createdRow':function(row,data,index){
            if(hoy >= new Date(data.inicio_promocion) && hoy <= new Date(data.fin_promocion)){
                $('td',row).addClass("success");
            }else{
                if(hoy < new Date(data.inicio_promocion)  ){
                    $('td', row).addClass("warning");
                }else{
                    $('td', row).addClass("danger");
                }
            }
        },
        'columns':[
            {data:'nombre'},
            {data:'descripcion'},
            {data:'descuento'},
            {data:'inicio_promocion'},
            {data:'fin_promocion'},
            {data:
                function (row) {
                    str = "<div align='center'>";
                    str += "<div class='col-md-6'> <button id='btnEditar' class='btn btn-primary block' onclick='showPromotion(" + row['id'] +")'><i class='fa fa-pencil-square-o'></i></button> </div>";
                    str += "<div class='col-md-6'> <button id='btnEliminar' class='btn btn-danger block' onclick='deletePromotion(" + row['id'] +")'><i class='fa fa-trash-o'></i></button> </div>";
                    str += "</div>";
                    return str;
                }
            }
        ],
        'language': {
            url:'https://cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json'
        }
    });
     
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

    $("#newPromo").on('click',function () {
        clear();
        $('#modalPromotion').modal('show');
    });

    $("#btnAceptarPromo").on('click',function(event){
        $('#promotionForm').submit();
    });
    jQuery.validator.addMethod("fechaFinal",function(value,element){
        if(new Date($("#fechaFpromo").val()) < new Date($("#fechaIpromo").val()))
            return false;
        else
            return true;

    },"La fecha de final  no puede ser antes o de la fecha de inicio");

    $('#promotionForm').validate({
        rules: {
            nombre: {
                required: true
            },
            descripcion: {
                required: true,
                maxlength: 50
            },
            descuento: {
                required: true,
                number: true,
                rangelength: [1,100]
            },
            fechaIpromo: {
                required: true,
                date: true
            },
            fechaFpromo: {
                required: true,
                date:true,
                fechaFinal: true
            }
        }
        ,
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
        submitHandler: function (form) {
            promotionAction($("#promotionid").val());
            return false;
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
    $('#fechaIpromo').val("");
    $('#fechaFpromo').val("");
}

function deletePromotion(id) {
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
        ruta ='/panel/delete/productPromotion/'+id;
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

function promotionAction(id){
    if(id != ""){
        var datos = new FormData(document.getElementById('promotionForm'));
        $.ajax({
            url: '/panel/promotions/'+$("#promotionid").val(),
            type: 'post',
            data: datos,
            contentType:false,
            processData: false
        }).done(function(json){
            if(json.code===200){
                swal("Realizado", json.msg, json.detail);
                $('#modalPromotion').modal('hide');
                $("#promotionTable").dataTable().api().ajax.reload(null, false);
            }else{
                swal("Error", json.msg, json.detail);
            }
        });
        $('.selectpicker').selectpicker('refresh');   
    }else{
        var datos = new FormData(document.getElementById('promotionForm'));
        console.log("Es promocion del mes: "+$("#is_promotion_month").val());
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
                $("#promotionTable").dataTable().api().ajax.reload(null, false);
            }else{
                swal("Error", json.msg, json.detail);
            }
        });
        $('.selectpicker').selectpicker('refresh');   
    }
}

function showPromotion(id){
    $.ajax({
        url: "api/promotions/"+id,
        type: 'GET'
    }).done(function(response){
        if(response.code==200){
            clear();
            promo=response.msg;
            fechaI =new Date(promo.inicio_promocion);
            fechaF =new Date(promo.fin_promocion);
            if(fechaI.getDate() < 10){
                dia = '0'+fechaI.getDate();
            }else{
                dia = fechaI.getDate();
            }
            if(fechaI.getMonth()+1< 10){
                mes = '0'+(fechaI.getMonth()+1);
            }else{
                mes=(fechaI.getMonth()+1);
            }
            console.log(fechaI.getFullYear()+"-"+mes+"-"+dia);
            $('#fechaIpromo').val(fechaI.getFullYear()+"-"+mes+"-"+dia);
            if(fechaF.getDate() < 10){
                dia = '0'+fechaF.getDate();
            }else{
                dia = fechaF.getDate();
            }
            if(fechaF.getMonth()+1< 10){
                mes = '0'+(fechaF.getMonth()+1);
            }else{
                mes=(fechaF.getMonth()+1);
            }
            console.log(fechaF.getFullYear()+"-"+mes+"-"+dia);
            $('#fechaFpromo').val(fechaF.getFullYear()+"-"+mes+"-"+dia);
            $('#namepromo').val(promo.nombre);
            $('#descripcionpromo').val(promo.descripcion);
            $('#descuentopromo').val(promo.descuento);
            $("#promotionid").val(promo.id);
            $("#titulo-modal").text("Editar Promoción");
            $("#modalPromotion").modal("show");
            if(promo.is_promotion_month == 0)
                $("#is_promotion_month").prop('checked', false);
            else
            $("#is_promotion_month").prop('checked', true);
        }
    }).fail(function(){
        swal("Error","No pudimos recuperar los datos","warning");
    });
}