/**
 * Created by fenix on 11/06/2017.
 */
$(function(){
    $('.fprice').on('click',function(){
        toUrlParameters('precio', $(this).data('val'));
    });
});

//se creará un nuevo parametro y si ya está el parametró se actualizará
function toUrlParameters(name,value) {
    var url = document.location.pathname;
    console.log("direccion: "+ url);
    var searchurl = document.location.search;
    console.log("busqueda:" + searchurl);
    var parametros = (searchurl!= "" )? searchurl.split('?')[1].split('&'): [];
    var index =  -1;

    for(i = 0 ; i < parametros.length; i++){
        if(parametros[i].split('=')[0] == name){
            index = i ;
            break;
        }

    }
    if (index != -1) { // si existe el parametro
        var cv = parametros[index].split('=');  //obtenemos la clave valor
        cv[1] = value; //asignamos el valor
        parametros[index] = cv[0] + '=' + cv[1]  //reasignamos el parametro al arreglo
    } else {
        parametros.push(name + '=' + value);
    }

    //reformamos la url de busqueda
    searchurl = ""; //limpiamos la url
    parametros.forEach( function (row,i) {
        if (row.split('=')[0] != 'page')
        searchurl += row + '&';
    });

    document.location.href = url + '?' + searchurl.substr(0,searchurl.length-1);
}