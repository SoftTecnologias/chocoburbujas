$(function(){
    $("#cart").on("click", function() {
        $.ajax({
           url:"https://"+document.location.host+"/chocoburbujas/public/"+"showItems",
           type:'GET',
            'Access-Control-Allow-Headers': '*'
        }).done(function(json){
            if(json.code === 200){
                constructCart(json.msg);
            }
        }).fail(function(){

        });
        $("#modalCart").modal();
    });

    $(".addToCart").on('click',function () {

    });
});
function addProducto(codigo){
    console.log('codigo: '+codigo+" a direccion: "+document.location.protocol+'//'+document.location.host+'/chocoburbujas/public'+'/addToCart');
    $.ajax({
        url:document.location.protocol+'//'+document.location.host+'/chocoburbujas/public'+'/addToCart',/*quitar o agregar segun corresponda*/
        type: 'POST',
        data:{codigo:codigo}
    }).done(function(response){
            //Se agrega el producto y se muestra la chingadera
        if (response.code == 200){
            swal('Producto Agregado al Carrito',"Se a añadido exitosamente",'success');
            //En el mensaje vendrá el carrito así que lo volveremos a agregar
            constructCart(response.msg);
        }else{ //Codigo diferente
            swal('ups!! :(', response.msg,'warning'); //Mensaje de error personalizado
        }
    }).fail(function(){
        swal('ups!! :(', 'Lamentablemente no tuvimos acceso al servidor intente mas tarde ','warning'); //Mensaje de error al fallar la conexion
    });
}

function verProducto(codigo){
    //Basicamente me redirecciona al producto (Puedo hacerlo con php pero por lo pronto aqui se queda)
}

function constructCart(productos){
    $('#detalles').empty();
    $.each(productos['productos'],function(index, row){
        $('<li>',{
            class:'clearfix'
        }).append($('<img>',{
            src : "https://"+document.location.host+"/chocoburbujas/public/"+'images/productos/'+row.item['img1'],
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
            text:'x',
            'data-value': row.item['codigo']
        })).appendTo('#detalles');
    });
    $("#check").text('$ '+productos['total']);
    $('#totalCart').text(productos['cantidadProductos']);
    $(".rmCart").on('click',function(){
        //Eliminamos this shit
        removeCart($(this).data('value'));
    });
}

function removeCart(codigo){
    $.ajax({
        url:document.location.protocol+'//'+document.location.host+'/chocoburbujas/public'+'/removeCart',
        type: 'delete',
        data:{codigo:codigo}
    }).done(function(json) {
        if(json.code === 200){
            console.log(json);
            swal('Producto eliminado del carrito',"Se ha retirado el producto de tu carrito",'success');
            //En el mensaje vendrá el carrito así que lo volveremos a agregar
            constructCart(json.msg);
            /*
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
            */
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