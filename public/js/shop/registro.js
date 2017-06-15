/**
 * Created by fenix on 14/06/2017.
 */
$(function(){

    $('#estado').change(function(){
        var estado = $(this).val();
        if(estado != '00'){
            $.ajax({
                url:document.location.protocol+'//'+document.location.host+'/chocoburbujas/public'+'/getMunicipios/'+estado,
                type:'GET'
            }).done(function(response){
                if(response.code == 200){
                    $('#municipio option').remove();
                    $('<option>',{
                        text:'Seleccione un Municipio'
                    }).attr('value',"000").appendTo('#municipio');
                    $.each($.parseJSON(response.msg),function(i, row){
                        $('<option>',{text:row.nom_mun}).attr('value',row.cve_mun).appendTo('#municipio');
                    });
                }
            }).fail(function(){

            });
        }
    });

});
