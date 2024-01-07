function dispositivo(idTipoDispositivo){ 
   //var form = "#formDispositivo";
    //var controller = "../../../WEB-INF/Controllers/Seguridad/Controler_MDispositivo.php";
  var posting = $.post("../../../WEB-INF/Controllers/Seguridad/Controler_indicador.php",{idTipoDispositivo:idTipoDispositivo,action:'indicadorDispositivo'});
    posting.done(function(data)
      {
        var valor="";
        if (idTipoDispositivo == 5){ valor ="CCTV"}
        if (idTipoDispositivo == 6){ valor ="Extintores"}
        if (idTipoDispositivo == 7){ valor ="Sensores de Humo"}
        if (idTipoDispositivo == 8){ valor ="Palancas de Incendio"}
        if (idTipoDispositivo == 9){ valor ="Radiocomunicación"}
        
        var resultado = "<p style='text-align:center;font-weight:bold;font-size:16px'>" + valor + "</p><table  class='table table-bordered table-hover table-striped'>"
        +"<thead>"
          +"<tr>"
            +"<th style='text-align:center'>Tipo / Marca</th>"
            +"<th style='text-align:center'>Totales</th>"
            +"<th style='text-align:center'>Activas</th>"
            +"<th style='text-align:center'>Inactivas</th>"
          +"</tr>"
        +"</thead>"
        +"<tbody style='text-align:center'>";
        
        $.each(data, function(i,item)
        {
          resultado += "<tr>"
                  +"<td>"+data[i].marca+"</td>"
                  +"<td>"+data[i].total+"</td>"
                  +"<td>"+data[i].totalActivas+"</td>"
                  +"<td>"+data[i].totalInactivas+"</td>"
                 +"</tr>";
                // +"</tbody>"
          //+"</table>";
          
          $("#datoDisp").html(resultado);
        
          
        });       
      }); 
}
  
function cambiartabla(div, page,id){

  pagina = page.split('?',3);

  if (page === "") {
        //alert("Funcionalidad no implementada aún");
        alert("Pantalla no definida aún");
        return;
  }

  var usuario = $('#usuario').val();
  
  $(div).load(pagina[0],{valor:id }, function (data, status, xhr) {
        if (status == "error") {
            $("#errorPrincipal").html(data + "<br/>" + xhr.status + " " + xhr.statusText);
        } else {
            //$(div).html(data);
            //finalizar();
        }

  });
    
}

function cambiarContenidoscondicion(div, page, valor, dato, valor2){



  pagina = page.split('?',3);
  if (page === "") {
        //alert("Funcionalidad no implementada aún");
        alert("Pantalla no definida aún");
        return;
  }
  var usuario = $('#usuario').val();
  $(div).load(pagina[0],{nombreUsuario:pagina[1],id_valor:valor, dato:dato, valor2: valor2 }, function (data, status, xhr) {
        if (status == "error") {
            $("#errorPrincipal").html(data + "<br/>" + xhr.status + " " + xhr.statusText);
        } else {
            //$(div).html(data);
            //finalizar();
        }
  });   
}
