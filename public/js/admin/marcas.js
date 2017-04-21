/**
 * Created by fenix on 19/03/2017.
 */
$(function(){
    $('#btnNew').on('click', function () {
        $('#titulo-modal').text("Nueva marca");
        $("#modalBrand").modal("show");
    });
    $('#btnBrand').on('click',function(){
        $('#brandForm').submit();
    });
    $('#brandTable').DataTable({
        'ajax':{
            url:'api/marcas'
            }
        ,
        'columns':[
            {
              data:function(row){
                  var str="";
                  str = "<div align='center col-md-4'>";
                  str += "<img class=\"img-responsive \" src='../images/marcas/" + row['img'] + "' alt='" + row['id'] + "'>";
                  str += "</div>";
                  return str;
              }
            },{
               data:'nombre'
            },{
               data:function (row) {
                   str  = "<div align='center'>";
                   str +=   "<button id='btnEditar' class='btn btn-primary block col-md-3' onclick='showBrand(" + row['id'] + ");'><i class='glyphicon glyphicon-edit'></i></button>";
                   str +=   "<button id='btnEliminar' class='btn btn-danger block col-md-3' onclick='deleteBrand(" + row['id'] + ")'><i class='fa fa-trash-o'></i></button>";
                   str += "</div>";
                   return str;
               }
            }
        ],
        'language': {
            url:'https://cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json'
        }
    });

    $.validator.addMethod('filesize', function (value, element, param) {
        // param = size (in bytes)
        // element = element to validate (<input>)
        // value = value of the element (file name)
        return this.optional(element) || (element.files[0].size <= param);
    }, $.validator.format("El archivo debe ser menor a 1MB"));
    $('#brandForm').validate({
        rules:{
            'nombre':{
                required:true
            },
            'img': {
                extension: "png|jpg|gif",
                filesize: 1048576
            }
        },
        messages:{
            'nombre':{
                required:"Ingrese el nombre de la marca"
            },
            'img':{
                extension:"Solo se permiten extensiones png, jpg y gif"
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
            brandAction();
            return false;
        }
    });
});

function brandAction() {
    if($('#id').val()=="")
        newBrand();
    else
        updateBrand($("#id").val());
}
function newBrand(){
    data = new FormData(document.getElementById("brandForm"));

    $.ajax({
        url:"api/marcas",
        type:'post',
        data: data,
        dataType:'json',
        contentType:false,
        processData: false
    }).done(function(json){
        if(json.code == 200) {
            swal("Realizado", json.msg, json.detail);
            $('#modalBrand').modal("hide");
            $('#brandTable').dataTable().api().ajax.reload();
            reset();
        }else{
            swal("Error",json.msg,json.detail);
        }
    }).fail(function(){
        swal("Error","Tuvimos un problema de conexion","error");
    });
}
function updateBrand(id){
    $("#id").val(id);
    var data = new FormData(document.getElementById("brandForm"));
    console.log("los datos son ",data.get("nombre"));
    $.ajax({
        url:"api/marcas/"+id,
        type:"post",
        data: data,
        contentType:false,
        processData: false
    }).done(function(json){
        if(json.code == 200) {
            swal("Realizado", json.msg, json.detail);
            $('#modalBrand').modal("hide");
            $('#brandTable').dataTable().api().ajax.reload();
            reset();
        }else{

            swal("Error",json.msg,json.detail);
        }
    }).fail(function(){
        swal("Error","Tuvimos un problema de conexion","error");
    });
}
function deleteBrand(id){
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
        ruta ='api/marcas/'+id;
        $.ajax({
            url:ruta,
            type:'delete'
        }).done(function(json){
            if(json.code==200) {
                swal("Realizado", json.msg, json.detail);
                $('#brandTable').dataTable().api().ajax.reload();
            }else{
                swal("Error", json.msg, json.detail);
            }
        }).fail(function(response){
            swal("Error", "tuvimos un problema", "warning");
        });
    });
}
function showBrand(id){
    $.ajax({
        url: "api/marcas/"+id,
        type: 'GET'
    }).done(function(json){
        if(json.code==200){
            reset();
            $("#id").val(json.msg.id);
            $("#nombre").val(json.msg.nombre);
            $("#titulo-modal").text("Editar Marca");
            $("#modalBrand").modal("show");
        }
    }).fail(function(){
        swal("Error","No pudimos recuperar los datos","warning");
    });
}
function reset(){
    $('#titulo-modal').text("");
    $("#id").val("");
    $('#nombre').val("");
    $('#img').val("");
}

