$(function(){
    $("#cart").on("click", function() {
        $.ajax({
           url:"showItems",
           type:'GET'
        }).done(function(json){
            if(json.code === 200){
                $('#detalles').empty();
                $.each(json.msg['productos'],function(index, row){
                    $('<li>',{
                        class:'clearfix'
                    }).append($('<img>',{
                        src : 'images/productos/'+row.item['img1'],
                        alt:'item'+(index+1),
                        style:'height: 75px; width: 50px;'
                    })).append($('<span>',{
                        class:'item-name',
                        text:row.item['nombre']
                    })).append($('<span>',{
                        class:'item-price',
                        text:'$'+row.item['precio1']
                    })).append($('<span>',{
                        class:'item-quantity',
                        text: 'Cantidad: '+ row.cantidad
                    })).append($('<a>',{
                        class:'close',
                        text:'x',
                        'data-value': row.item['id']
                    })).appendTo('#detalles');
                });
                $("#check").text('$ '+json.msg['total']);
            }
        }).fail(function(){

        });
        $("#modalCart").modal();
    });
});
function removeCart(id){
    $.ajax({
        url:' removeProduct/'+id,
        type: 'GET',
    }).done(function(json) {
        if(json.code === 200){
            $('#detalles').empty();
            $.each(json.msg['productos'],function(index, row){
                $('<li>',{
                    class:'clearfix'
                }).append($('<img>',{
                    src : 'images/productos/'+row.item['img1'],
                    alt:'item'+(index+1),
                    style:'height: 75px; width: 50px;'
                })).append($('<span>',{
                    class:'item-name',
                    text:row.item['nombre']
                })).append($('<span>',{
                    class:'item-price',
                    text:'$'+row.item['precio1']
                })).append($('<span>',{
                    class:'item-quantity',
                    text: 'Cantidad: '+ row.cantidad
                })).append($('<a>',{
                    class:'close rmCart',
                    text:'x'
                })).appendTo('#detalles');
            });


            $(".rmCart").on('click',function(){
                $.ajax({
                    url:'removeProduct/'+this.data('value'),
                    type:'GET'
                })
            });

        }
    }).fail({

    });
}

function searchProduct(producto){

}

//se creará un nuevo parametro y si ya está el parametró se actualizará
function toUrlParameters(name,value) {
    var url = document.location.pathname;
    var searchurl = document.location.search;
    var parametros = searchurl.split('?')[1].split('&');
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
        console.log('index: '+i);
        console.log('row: '+row);
        searchurl += row + '&';
    });

   document.location.href = url + '?' + searchurl.substr(0,searchurl.length-1);
}