

function cambiartablas_ubicacion(div, page,id, idubicacion){
  pagina = page.split('?',3);
  if (page === "") {
        //alert("Funcionalidad no implementada aún");
        alert("Pantalla no definida aún");
        return;
  }
if(typeof $('#ubicaciones').val() === 'undefined'){
}else{
  idubicacion=$('#ubicaciones').val();
}
  var usuario = $('#usuario').val();
  
  $(div).load(pagina[0],{id_valor:id, idubicacion:idubicacion, valor:id }, function (data, status, xhr) {
        if (status == "error") {
            $("#errorPrincipal").html(data + "<br/>" + xhr.status + " " + xhr.statusText);
        } else {
            //$(div).html(data);
            //finalizar();
        }
  });
}



