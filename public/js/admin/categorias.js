/**
 * Created by fenix on 19/03/2017.
 */
$(function(){
    $('#btnNew').on('click', function () {
        $('#titulo-modal').text("Nueva Categoria");
        $("#modalCategory").modal("show");
    });

    $('#categoryTable').DataTable({
        'ajax':{
            'url':'api/categorias'
        },
        'columns':[
            {
                data:'nombre'
            },{
                data:function (row) {
                    str = "<div align='center'>";
                    str += " <button id='btnEditar' class='btn btn-primary block col-md-3' onclick='showCategory(" + row['id'] + ");'><i class='glyphicon glyphicon-edit'></i></button>";
                    str += "<button id='btnEliminar' class='btn btn-danger block col-md-3' onclick='deleteCategory(" + row['id'] + ")'><i class='fa fa-trash-o'></i></button>";
                    str += "</div>";
                    return str;
                }
            }
        ],
        'language': {
            url:'https://cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json'
        }
    });

    $('#categoryForm').validate({
        rules:{
            nombre:{
                required:true,
                minlength:3
            }
        },
        messages:{
            nombre:{
                required:"El nombre de la categoria es obligatoria",
                minlength:"La categoria debe tener mas de tres caracteres"
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
        submitHandler: function (form) {
            categoryAction();
            return false;
        }
    });

    $('#btnCategory').on('click',function () {
       $("#categoryForm").submit();
    });
});
function categoryAction(){
    if($('#id').val()==""){
        newCategory();
    }else{
        updateCategory($('#id').val());
    }
}
function newCategory(){
 var nombre = $('#nombre').val();
    $.ajax({
     url:'api/categorias',
     type:'POST',
     data:{nombre:nombre}
 }).done(function(json){
    if(json.code == 200) {
        swal("Realizado", json.msg, json.detail);
        $('#modalCategory').modal("hide");
        $('#categoryTable').dataTable().api().ajax.reload();
        reset();
    }else{
        swal("Error",json.msg,json.detail);
    }

 }).fail(function(response){
    console.log(response);
 });
}
function updateCategory(id){
    $.ajax({
        url:"api/categorias/"+id,
        type:"PUT",
        data:{
            nombre: $("#nombre").val()
        }
    }).done(function(json){
        if(json.code == 200) {
            swal("Realizado", json.msg, json.detail);
            $('#modalCategory').modal("hide");
            $('#categoryTable').dataTable().api().ajax.reload();
            reset();
        }else{
            swal("Error",json.msg,json.detail);
        }

    }).fail(function(){
        swal("Error", "No pudimos conectarnos","warning")
    });
}
function deleteCategory(id){

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
        ruta ='api/categorias/'+id;
        $.ajax({
            url:ruta,
            type:'delete'
        }).done(function(json){
            if(json.code==200) {
                swal("Realizado", json.msg, json.detail);
                $('#categoryTable').dataTable().api().ajax.reload();
            }else{
                swal("Error", json.msg, json.detail);
            }
        }).fail(function(response){
            swal("Error", "tuvimos un problema", "warning");
        });
    });
}
function showCategory(id){
    $.ajax({
        url: "api/categorias/"+id,
        type: 'GET'
    }).done(function(json){
        if(json.code==200){
            $("#id").val(json.msg.id);
            $("#nombre").val (json.msg.nombre);
            $("#titulo-modal").text("Editar Categoria");
            $("#modalCategory").modal("show");
        }
    }).fail(function(){
        swal("Error","No pudimos recuperar los datos","warning");
    });


}
function reset(){
    $('#titulo-modal').text("");
    $("#id").val("");
    $('#nombre').val("");
}
