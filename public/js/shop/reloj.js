$(function () {
   setInterval(ActualizarHora,1000);

});
function ActualizarHora(){
    var fecha = new Date();
    var segundos = fecha.getSeconds();
    if(segundos < 10){
        segundos = "0"+segundos;
    }
    var minutos = fecha.getMinutes();
    var horas = fecha.getHours();

    $('#time').text("  "+horas+":"+minutos+":"+segundos);
}