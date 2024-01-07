function cambiarContenidod(div, page){
  if (page === "") {
        //alert("Funcionalidad no implementada aún");
        alert("Pantalla no definida aún");
        return;
  }

  var usuario = $('#usuario').val();
  
  $(div).load(page,{usuario:usuario}, function (data, status, xhr) {
    alert("hola");
        /*if (status == "error") {
            $("#errorPrincipal").html(data + "<br/>" + xhr.status + " " + xhr.statusText);
        } else {
            //$(div).html(data);
            //finalizar();
        }*/

  });
    
}