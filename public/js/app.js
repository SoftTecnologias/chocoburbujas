"use strict";
$(function(){
  /* Se inicializa el megamenu */
   $(".megamenu").megamenu();
   /* Se inicializa el slider de los productos */
    $("#slider").responsiveSlides({
                auto: true,
                nav: false,
                speed: 500,
                namespace: "callbacks",
                pager: true,
            });
    /*Se revisa la sesión con cookies*/
    var cookie = Cookies.get("sesion");
    if(cookie != null){
      $($('<li>').append($('<a>',{
        href:'#',
        id:'account',
        text:"Mi Cuenta"
      }))).appendTo('#sesionOpc');
      $($('<li>').append($('<a>',{
        href:'#',
        id:'exit',
        text:"Salir"
      }))).appendTo('#sesionOpc');
    }else{
      $($('<li>').append($('<a>',{
        href:'#',
        id:'wili',
        text:"Mi lista de deseos"
      }))).appendTo('#sesionOpc').on('click',function(){
        alert("Mi lista de deseos");
      });

      $('<li>').append($('<a>',{
        href:'#',
        id:'login',
        text:"Iniciar Sesion"
      })).appendTo('#sesionOpc').on('click',function(){
        alert("Iniciar sesion");
      });
      $('<li>').append($('<a>',{
        href:'#',
        id:'reg',
        text:"Registrarse"
      })).appendTo("#sesionOpc").on('click',function(){
        alert("Registrarse");
      });
    }
    //modificamos la divisa a la cookie
    $('#divisa').change(function(){
        alert($(this).val()+" nueva divisa");
    });
    //modificamos el idioma a la cookie
    $('#idioma').change(function(){
        alert($(this).val()+" nuevo idioma");
    });

});
