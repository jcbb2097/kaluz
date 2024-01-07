function cambiarContenido(div, page){

  //alert(div+" "+page);
  pagina = page.split('?',4);


  if (page === "") {
        //alert("Funcionalidad no implementada aún");
        alert("Pantalla no definida aún");
        return;
  }

  var usuario = $('#usuario').val();
   // alert(div+" "+pagina[0]);
  $(div).load(pagina[0],{nombreUsuario:pagina[1],idUsuario:pagina[2], id_t:pagina[3] }, function (data, status, xhr) {
        if (status == "error") {
            $("#errorPrincipal").html(data + "<br/>" + xhr.status + " " + xhr.statusText);
        } else {
            //$(div).html(data);
            //finalizar();
        }

  });
    
}