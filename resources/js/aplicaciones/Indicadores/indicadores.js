$(document).ready(function(){
    
    enviar_anio();

});
function enviar_anio()
    { 
        if($("#nivel").val() == 1){
        $("#titulo_pagina").html('Acuerdos Enviados por Área/Empleado/Clasificación '+$("#menu_anio").val());
        
        $.post('WEB-INF/Controllers/Indicadores/Controler_AcuerdosEnviados.php',{anio:$("#menu_anio").val(),nivel:1},function(data){
            $("#tabla").html(data);
        });
    }else if($("#nivel").val() == 2){
        $("#titulo_pagina").html('Acuerdos Enviados por '+$("#nombreArea").val()+" en el año "+$("#menu_anio").val());
        
        $.post('WEB-INF/Controllers/Indicadores/Controler_AcuerdosEnviados.php',{anio:$("#menu_anio").val(),nivel:2,idArea:$("#idArea").val(),nombreArea:$("#nombreArea").val()},function(data){
            $("#tabla").html(data);
        });
    }else if($("#nivel").val() == 3){
       
        $("#titulo_pagina").html('Acuerdos Enviados por '+$("#nombreEmp").val()+" en el año "+$("#menu_anio").val());
        
        $.post('WEB-INF/Controllers/Indicadores/Controler_AcuerdosEnviados.php',{anio:$("#menu_anio").val(),nivel:3,idArea:$("#idArea").val(),idEmp:$("#equipoTrabajo").val(),nombreEmp:$("#nombreEmp").val(),nombreArea:$("#nombreArea").val()},function(data){
            $("#tabla").html(data);
        });
    }else if($("#nivel").val() == 4){
          $("#titulo_pagina").html('Acuerdos Enviados por '+$("#nombreEmp").val()+"del tipo "+$("#nombreAcuerdo").val()+" en el año "+$("#menu_anio").val());
        
        $.post('WEB-INF/Controllers/Indicadores/Controler_AcuerdosEnviados.php',{anio:$("#menu_anio").val(),nivel:4,idArea:$("#idArea").val(),idEmp:$("#equipoTrabajo").val(),nombreEmp:$("#nombreEmp").val(),tipoAcuerdo:$("#tipoAcuerdo").val(),nombreAcuerdo:$("#nombreAcuerdo").val()},function(data){
            $("#tabla").html(data);
        });
    }
    
    }