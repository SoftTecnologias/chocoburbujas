$(function () {
    $('#btn-save').on('click',function () {

    })
});
function reg() {
    var datos = new FormData(document.getElementById('infEmpresa'));
    $.ajax({
        url:"api/info",
        type:"POST",
        data: datos,
        contentType:false,
        processData: false
    }).done(function(json){
        if(json.code == 200) {
            swal("Realizado", json.msg, json.detail);
            reset();
        }else{
            swal("Error",json.msg,json.detail);
        }
    }).fail(function(){
        swal("Error","Tuvimos un problema de conexion","error");
    });
}
function up() {
    var datos = new FormData(document.getElementById('infEmpresa'));
    $.ajax({
        url:"api/infoUpdate",
        type:"POST",
        data: datos,
        contentType:false,
        processData: false
    }).done(function(json){
        if(json.code == 200) {
            swal("Realizado", json.msg, json.detail);
            reset();
        }else{
            swal("Error",json.msg,json.detail);
        }
    }).fail(function(){
        swal("Error","Tuvimos un problema de conexion","error");
    });
}