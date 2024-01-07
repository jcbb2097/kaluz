
let atendidas={

busca_opinion:(correo)=>{
    let imprime = "";
    $("#opiniones").html("");
    $.post("./js/Conexiones/Select_atendidas_correo.php",
    { correo: correo },
    function (data, status) {
        if (status == "success") {
            let obj = JSON.parse(data);

                let x=0;
                $.each(obj, function (i, item) {
                    imprime += '<tr><td>'+item.Descripcion+'</td>';
  								  imprime += '<td>'+item.Fecha+'</td>';
                    imprime += '<td>'+item.FechaAtencion+'</td>';
                    imprime += '<td><center>Seleccionar<br><input type="radio" name="seleccion"  onclick ="atendidas.habilita()"value="'+item.IdOpinion+'" /></center></td></tr>';
                });
                console.log("imprime  : "+imprime);
                $("#opiniones").append(imprime);
        }
    });
},
habilita:()=>{
  $("#incidencias").css("display", "block");
}
}
$(document).ready(function () {
  $("#buscar").click(function () {
      let correo=$("#correo_buscar").val();
      atendidas.busca_opinion(correo);
  });
  $("#incidencia").change(function () {
      let incidencia=$("#incidencia").val();
      if(incidencia == 6)
        $("#cuadro_respuesta").css("display", "block");
      else
        $("#cuadro_respuesta").css("display", "none");
  });
});
