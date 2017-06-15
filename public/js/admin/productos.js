/**
 * Created by fenix on 20/03/2017.
 */
$(function(){
    $('#btnNew').on('click', function () {
        $('#titulo-modal').text("Nuevo Producto");
        $("#modalProduct").modal("show");
    });
    $('#btnProduct').on('click',function(){
        $('#productForm').submit();
    });
    //*
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
            {data:'codigo'},
            {data:'nombre'},
            {data:'descripcion'},
            {data:'marca'},
            {data:'categoria'},
            {data:function(row){
                       return '$ '+row['precio1'];
                  }
            },
            {data:'stock'},
            {data:function (row) {
                str = "<div align='center'>";
                str = "<div class='col-md-6'> ";
                str += " <button id='btnEditar' class='btn btn-primary block' onclick='showProduct(" + row['id'] +");'><i class='glyphicon glyphicon-edit'></i></button> </div>";
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
    /*Validacion de los archivos*/
    $.validator.addMethod('filesize', function (value, element, param) {
        // param = size (in bytes)
        // element = element to validate (<input>)
        // value = value of the element (file name)
        return this.optional(element) || (element.files[0].size <= param);
    }, $.validator.format("El archivo debe ser menor a 1MB"));

    jQuery.extend(jQuery.validator.messages, {
        required: "Este campo es obligatorio.",
        number: "Por favor, escribe un número válido.",
        digits: "Por favor, escribe sólo dígitos.",
        maxlength: jQuery.validator.format("Por favor, no escribas más de {0} caracteres."),
        minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
        min: "Por favor ingrese un valor mayor a {0}"
    });
    jQuery.validator.addMethod("minimum",function(value,element){
        if($("#minimo").val() > $("#maximo").val())
            return false;
        else
            return true;

    },"El Stock minimo no puede ser mayor o igual al stock maximo");
    jQuery.validator.addMethod("maximum",function(value,element){
        if($("#maximo").val() < $("#minimo").val())
            return false;
        else
            return true;
    },"El Stock maximo no puede ser menor o igual al stock maximo");
    //
    $('#productForm').validate({
        rules: {
            codigo: {
                required: true,
                minlength: 8,
                maxlength: 20
            },
            nombre: {
                required: true
            },
            description: {
                required: true,
                maxlength: 50
            },
            brand_id: {
                required: true
            },
            category_id: {
                required: true
            },
            unidad_id: {
                required: true
            },
            proveedor_id: {
                required: true
            },
            precio1: {
                required: true,
                number: true
            },
            precio2: {
                required: true,
                number: true
            },
            minimo: {
                required: true,
                number: true,
                min:1,
                minimum:true
            },
            maximo: {
                required: true,
                number: true,
                min :0
               // maximum:true
            },
            actual: {
                required: true,
                number: true,
                min:0
            },
            'img[]': {
                extension: "png|jpg|gif",
                filesize: 1048576
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
            productAction();
            return false;
        }

    });

    /*files de las imagenes*/
    $("#img1").fileinput({
        allowedFileTypes: ["image"],
        showUpload:false,
        browseClass: "btn btn-success",
        browseLabel: "Elegir Foto",
        browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
        removeClass: "btn btn-danger",
        removeLabel: "Eliminar",
        removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
        maxFileSize: 1024,
    });
    $("#img2").fileinput({
        allowedFileTypes: ["image"],
        showUpload:false,
        browseClass: "btn btn-success",
        browseLabel: "Elegir Foto",
        browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
        removeClass: "btn btn-danger",
        removeLabel: "Eliminar",
        removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
        maxFileSize: 1024,

    });
    $("#img3").fileinput({
        allowedFileTypes: ["image"],
        showUpload:false,
        browseClass: "btn btn-success",
        browseLabel: "Elegir Foto",
        browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
        removeClass: "btn btn-danger",
        removeLabel: "Eliminar",
        removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
        maxFileSize: 1024,
    });

    /* Inputs con url*/
    $("#imgu1").on("change",function(){
            if($(this).val()!==""){
                $('#im1').attr("src",$(this).val());
                $('#im1').removeClass("hidden");
            }else{
                $('#im1').addClass("hidden");
            }
    });
    $("#imgu2").on("change",function(){
        if($(this).val()!==""){
            $('#im2').attr("src",$(this).val());
            $('#im2').removeClass("hidden");
        }else{
            $('#im2').addClass("hidden");
        }
    });
    $("#imgu3").on("change",function(){
        if($(this).val()!==""){
            $('#im3').attr("src",$(this).val());
            $('#im3').removeClass("hidden");
        }else{
            $('#im3').addClass("hidden");
        }
    });
});

//
function productAction(){
    if($("#id").val()==""){
        newProduct();
    }else{
        updateProduct($("#id").val());
    }
}
//
function newProduct(){
    var data = new FormData(document.getElementById("productForm"));
    $.ajax({
        url:"api/productos",
        type:"POST",
        data: data,
        contentType:false,
        processData: false
    }).done(function(json){
        if(json.code == 200) {
            swal("Realizado", json.msg, json.detail);
            $('#modalProduct').modal("hide");
            $('#productTable').dataTable().api().ajax.reload(null, false);
            reset();
        }else{
            swal("Error",json.msg,json.detail);
        }
    }).fail(function(){
        swal("Error","Tuvimos un problema de conexion","error");
    });
}
//
function updateProduct(id){
    $("#id").val(id);
    var datos = new FormData(document.getElementById("productForm"));
    $.ajax({
        url:"api/productos/"+id,
        type:"post",
        data: datos,
        contentType:false,
        processData: false
    }).done(function(json){
        if(json.code == 200) {
            swal("Realizado", json.msg, json.detail);
            $('#modalProduct').modal("hide");
            $('#productTable').dataTable().api().ajax.reload(null,false)
            reset();
        }else{
            console.log(json);
            swal("Error",json.msg,json.detail);
        }
    }).fail(function(){
        swal("Error","Tuvimos un problema de conexion","error");
    });
}
//
function deleteProduct(id){
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
        ruta ='api/productos/'+id;
        $.ajax({
            url:ruta,
            type:'delete'
        }).done(function(json){
            if(json.code==200) {
                swal("Realizado", json.msg, json.detail);
                $('#productTable').dataTable().api().ajax.reload(null,false);
            }else{
                swal("Error", json.msg, json.detail);
            }
        }).fail(function(response){
            swal("Error", "tuvimos un problema", "warning");
        });
    });
}
//
function showProduct(id){
    $.ajax({
        url: "api/productos/"+id,
        type: 'GET'
    }).done(function(json){
        if(json.code==200){
            reset();
            $("#id").val(json.msg.id);
            $("#codigo").val(json.msg.codigo);
            $("#nombre").val(json.msg.nombre);
            $("#descripcion").val(json.msg.descripcion);
            $("#marca_id").val(json.msg.marca_id);
            $("#categoria_id").val(json.msg.categoria_id);
            $("#proveedor_id").val(json.msg.proveedor_id);
            $("#unidad_id").val(json.msg.unidad_id);
            $("#maximo").val(json.msg.stock_max);
            $("#minimo").val(json.msg.stock_min);
            $("#actual").val(json.msg.stock);
            $("#precio1").val(json.msg.precio1);
            $("#precio2").val(json.msg.precio2);
            $("#im1").attr("src","../images/productos/"+json.msg.img1);
            $("#im2").attr("src","../images/productos/"+json.msg.img2);
            $("#im3").attr("src","../images/productos/"+json.msg.img3);
            $('#im1').removeClass("hidden");
            $('#im2').removeClass("hidden");
            $('#im3').removeClass("hidden");
            $("#titulo-modal").text("Editar Producto");
            $("#modalProduct").modal("show");
        }
    }).fail(function(){
        swal("Error","No pudimos recuperar los datos","warning");
    });
}
//
function reset(){
    document.getElementById("productForm").reset();
    $("#productForm").validate().resetForm();
    $("#minimo").val(1);
    $("#maximo").val(2);
    $('#im1').addClass("hidden");
    $('#im1').attr("src","");
    $('#im2').addClass("hidden");
    $('#im2').attr("src","");
    $('#im3').addClass("hidden");
    $('#im3').attr("src","");
}
