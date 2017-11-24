/**
 * Created by fenix on 20/03/2017.
 */
$(function(){
    $('#btnNew').on('click', function () {
        $('#titulo-modal').text("Nuevo Costo");
        $("#modalCost").modal("show");
    });


    $('#btnEnvio').on('click',function () {
        $('#cppr').val('');
        $('#colpr').val('');
        $('#prenvio').val('');
        $('#modprecio').modal('show');
    });

    $('#btnProduct').on('click',function(){
        $('#productForm').submit();
    });
    //*
    $('#costTable').dataTable({
        'ajax':{
            url: 'api/costs',
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
                str += (row['mostrar'] == 0) ? "<div class='col-md-2'><input type='checkbox' id='check"+row['id']+"' onchange='mostrarEnIndex("+row['id']+")'> Mostrar</div>":
                    "<div class='col-md-2'><input type='checkbox' id='check"+row['id']+"' onchange='mostrarEnIndex("+row['id']+")' checked> Mostrar</div>";
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

 function test() {
     window.alert($('#estado').val());
 }

 function mostrarEnIndex(id){
     var show = $('#check'+id).prop('checked');
     swal({
         title: '¿Estás seguro?',
         text: "El producto se mostrara en la pagina principal",
         type: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Si, deseo continuar',
         cancelButtonText: "Lo pensaré"
     }).then(function(){
         $.ajax({
             url:document.location.protocol+'//'+document.location.host+'/panel/products/mostrarindex/'+id,
             type:"POST",
             data: {"mostrar":show},
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         }).done(function(json){
             if(json.code == 200) {
                 swal("Realizado", json.msg, json.detail).then(function () {

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
            $('#productTable').dataTable().api().ajax.reload(null,false);
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
            $('#productTable').dataTable().api().ajax.reload(null, false);
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
