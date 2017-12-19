$(function () {
    window.onload=hora;
    fecha = new Date($('#htime').val());

});
function hora(){
    var meses = ['Ene','Feb','Mar',"Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"];
    var hora=fecha.getHours();
    var minutos=fecha.getMinutes();
    var segundos=fecha.getSeconds();
    var fechaI=fecha.getDate()+" de "+meses[fecha.getMonth()]+' del '+fecha.getFullYear();
    if(hora<10){ hora='0'+hora;}
    if(minutos<10){minutos='0'+minutos; }
    if(segundos<10){ segundos='0'+segundos; }
    fech=fechaI+'  '+hora+":"+minutos+":"+segundos;
    document.getElementById('time').innerHTML=fech;
    fecha.setSeconds(fecha.getSeconds()+1);
    setTimeout("hora()",1000);
}
