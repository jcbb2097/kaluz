let usuarios = [];
let dt = [];
let colores = ['rgb(24, 149, 240)', 'rgb(250, 204, 9)', 'purple'];
let Row = []
let newGrf={

llenaMatrices:(fmetricas)=>{

    $.post("./Conexiones/select_op_usuario.php",
    { fecha: fmetricas, area_filtro: "todos" ,eje_filtro:"todos"}
    ,
    function (data, status) {
        if (status == "success") {
            let obj = JSON.parse(data);
                $.each(obj, function (i, item) {
                     usuarios.push(item.Usuario);
                     Row.push( parseInt(item.total));
                });
                newGrf.CrearGrafica();
        }
    });

},
CrearGrafica:()=>{
  $("#graph_por_usuario").html("");
    usuarios.forEach(function (valor, indice, usuarios) {
        row = { x: usuarios[indice], Total: Row[indice]}
        dt.push(row);
    });
    if(usuarios.length > 0){
        Morris.Bar({
          element: 'graph_por_usuario',
          data: dt,
          xkey: 'x',
          ykeys: ['Total'],
          labels: ['Total'],
          barColors: colores,
          xLabelAngle:45,
          resize:true,
          padding: 60,
          stacked: true

      });
    }else{
      $("#graph_por_usuario").html("*No hay datos de este año");
    }

},
RefreshGrafica:()=>{
    usuarios = [];
    Row = [];
    dt = [];
    let fmetricas=$("#fechaMetricas").val();
    newGrf.llenaMatrices(fmetricas);

}
}


// Use Morris.Bar
$(document).ready(function () {

    eval($('#code').text());
    prettyPrint();

    let fmetricas=$("#fechaMetricas").val();
    newGrf.llenaMatrices(fmetricas);
    $("#fechaMetricas").change(function(){
      newGrf.RefreshGrafica();
    });

});
