$(function(){
    var note = $('#note'),
		ts = new Date(2012, 0, 1),
		newYear = true;
	
	if((new Date()) > ts){
		// The new year is here! Count towards something else.
		// Notice the *1000 at the end - time must be in milliseconds
		ts = (new Date()).getTime() + 10*24*60*60*1000;
		newYear = false;
	}
		
	$('#countdown').countdown({
		timestamp	: ts,
		callback	: function(days, hours, minutes, seconds){
			
			var message = "";
			
			message += days + " day" + ( days==1 ? '':'s' ) + ", ";
			message += hours + " hour" + ( hours==1 ? '':'s' ) + ", ";
			message += minutes + " minute" + ( minutes==1 ? '':'s' ) + " and ";
			message += seconds + " second" + ( seconds==1 ? '':'s' ) + " <br />";
			
			if(newYear){
				message += "left until the new year!";
			}
			else {
				message += "left to 10 days from now!";
			}
			
			note.html(message);
		}
	});

    $("#slider").responsiveSlides({
        auto: true,
        nav: false,
        speed: 500,
        namespace: "callbacks",
        pager: true,
    });

    $("#flexiselDemo3").flexisel({
        visibleItems: 5,
        animationSpeed: 1800,
        autoPlay: true,
        autoPlaySpeed:1500,
        pauseOnHover: true,
        enableResponsiveBreakpoints: true,
        responsiveBreakpoints: {
            portrait: {
                changePoint: 480,
                visibleItems: 1
            },
            landscape: {
                changePoint: 640,
                visibleItems: 2
            },
            tablet: {
                changePoint: 768,
                visibleItems: 3
            }
        }
    });

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
                    text:'x',

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

