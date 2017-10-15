$(function(){
    $("#cart").on("click", function() {
        $.ajax({
           url:"https://"+document.location.host+"/showItems",
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

});
function addProducto(codigo){
    console.log(document.location.protocol+'//'+document.location.host+'/addToCart');
    $.ajax({
        url:document.location.protocol+'//'+document.location.host+'/addToCart',/*quitar o agregar segun corresponda*/
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
            src : "https://"+document.location.host+'/images/productos/'+row.item['img1'],
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
    $('#tMCart').text('$ '+productos['total']);
    $('#totalCart').text(productos['cantidadProductos']);
    if( productos['cantidadProductos'] != 0) {
        $('#cartTitle').text('Tu carrito de compra contiene: ' + productos['cantidadProductos']+ ' productos');
        $('#checkB').show();
    }else{
        $('#cartTitle').text('Tu carrito de compra está vacío :( ');
        $('<li></li>',{
            class:'clearfix',
            text:'No hay productos disponibles'
        }).appendTo('#detalles');
        $('#checkB').hide();
    }
    $(".rmCart").on('click',function(){
        //Eliminamos this shit
        removeCart($(this).data('value'));
    });
}

function removeCart(codigo){
    $.ajax({
        url:document.location.protocol+'//'+document.location.host+'/removeCart',
        type: 'delete',
        data:{codigo:codigo}
    }).done(function(json) {
        if(json.code === 200){
            console.log(json);
            swal('Producto eliminado del carrito',"Se ha retirado el producto de tu carrito",'success');
            //En el mensaje vendrá el carrito así que lo volveremos a agregar
            constructCart(json.msg);
        }
    }).fail({

    });
}

function removeCarrito(codigo, index){
    $('#row'+index).remove();
    $.ajax({
        url:document.location.protocol+'//'+document.location.host+'/removeCart',
        type: 'delete',
        data:{codigo:codigo}
    }).done(function(json) {
        if(json.code === 200){
            console.log(json);
            swal('Producto eliminado del carrito',"Se ha retirado el producto de tu carrito",'success');
            //En el mensaje vendrá el carrito así que lo volveremos a agregar
            constructCart(json.msg);
            $('#gTotal').text('Total $'+json.msg['total']);
            if(json.msg['cantidadProductos'] == 0){
                $('<tr></tr>',{
                    text:'No hay productos disponibles'
                }).appendTo('#cart tbody');
             $('#Ncheck').attr("disabled", true);
             $('#Ncheck').prop('onclick',null).off('click');
            }
        }
    }).fail(function(){
        swal('Advertencia','No se pudo eliimnar el producto del carrito','warning');
    });
}

function updateCart(index){
    var cantidad = $('#ca'+index).val();
    var precio = $('#pr'+index).text();
    $('#sb'+index).text(cantidad * precio);
    var filas = $("#cart tbody tr").length;
    var totalGlobal = 0;
    var totalProductos = 0;
    var i = 0;
    for(i ; i< filas; i++){
       totalProductos = parseInt(totalProductos)+parseInt(parseInt($("#ca"+i).val()));
       totalparcial = parseFloat($('#sb'+i).text());
       totalGlobal = parseFloat(totalGlobal) + parseFloat(totalparcial);
    }
    $('#gTotal').text("Total $"+totalGlobal);
    $('#canP').text(totalProductos+" Productos");
    $('#totalCart').text(totalProductos);
    $('#tMCart').text('$ '+totalGlobal);
}

function checkout(){
    var filas = $("#cart tbody tr").length;
    var datos = "[";
    for (i=0; i < filas; i++){
        datos += '{ "codigo": "'+$('#codigo'+i).data("value")+'", "cantidad":'+$('#ca'+i).val()+'},';
    }

    datos = datos.substr(0,datos.length-1)+ "]";
    console.log(datos);
    $.post("https://"+document.location.host+"/chocoburbujas/public/"+"checkout", {productos: datos},function(){
        document.location.href = "https://"+document.location.host+"/chocoburbujas/public/"+"checkout";
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