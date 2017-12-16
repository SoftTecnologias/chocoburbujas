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
    if(minutos < 10){
        minutos = "0"+minutos;
    }
    var horas = fecha.getHours();
    if(horas < 10){
        horas = "0"+horas;
    }

    $('#time').text("  "+horas+":"+minutos+":"+segundos);
}