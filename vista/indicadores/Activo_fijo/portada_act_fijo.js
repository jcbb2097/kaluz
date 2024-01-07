
let portada={
    cargaInicial:()=>{
      eje_filtro=$("#filtro_eje").val();
      area_filtro=$("#filtro_area").val();
      portada.ObtenerListadoEjes();
      portada.ObtenerListadoAreas();
      portada.Totales_(eje_filtro,area_filtro,"todos");
      portada.Por_eje(eje_filtro,area_filtro,"todos");
      portada.Por_area(eje_filtro,area_filtro,"todos");
    },
    ObtenerListadoEjes:()=>{
    let obj;
        $.post("./Conexiones_act_fijo.php",
        {accion:"ejes"},
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let eje = "";
                    $.each(obj, function (i, item) {
                        eje+="<option value='"+item.idEje+"'>"+item.idEje+".-"+item.Nombre+"</option>";
                    });
                    $("#filtro_eje").append(eje)
                }
            });
    },
    ObtenerListadoAreas:()=>{
    let obj;
        $.post("./Conexiones_act_fijo.php",
        {accion:"areas"},
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let area = "";
                    $.each(obj, function (i, item) {
                        area+="<option value='"+item.Id_Area+"'>"+item.Nombre+"</option>";
                    });
                    $("#filtro_area").append(area)
                }
            });
    },
    Totales_:(fecha,eje_filtro,area_filtro,exposicion)=>{
    let obj;
    $("#total_activo_fijo").html("");
    $("#activo_fijo_total").html("");
        $.post("./Conexiones_act_fijo.php",
          {accion:"totales",eje_filtro:eje_filtro,area_filtro:area_filtro,exposicion:exposicion},
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let rows='<ul class="list-group">';
                    $.each(obj, function (i, item) {
                      rows+='<li class="es-li">';
                           rows+= '<strong> Total archivos : </strong>'+item.total;
                      rows+='</li>';
                    $("#total_activo_fijo").append(' : '+item.total);
                    });
                    rows+='</ul>';

                    $("#activo_fijo_total").append(rows);
                }
            });
    },
    Por_eje:(fecha,eje_filtro,area_filtro,exposicion)=>{
    let obj;
    $("#eje_activo_fijo").html("");
    $("#activo_fijo_eje").html("");
        $.post("./Conexiones_act_fijo.php",
          {accion:"por_eje",eje_filtro:eje_filtro,area_filtro:area_filtro,exposicion:exposicion},
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let rows='<ul class="list-group">';
                    total = 0;
                    $.each(obj, function (i, item) {
                      rows+='<li class="es-li">';
                           rows+= '<strong> '+item.nombre_eje+' : </strong>'+item.total;
                      rows+='</li>';
                      total +=  parseInt(item.total);
                    });
                    rows+='</ul>';
                    $("#eje_activo_fijo").append(' : '+total);
                    $("#activo_fijo_eje").append(rows);
                }
            });
    },
    Por_area:(eje_filtro,area_filtro,exposicion)=>{
    let obj;
    $("#origen_activo_fijo").html("");
    $("#activo_fijo_origen").html("");
        $.post("./Conexiones_act_fijo.php",
          {accion:"por_area",eje_filtro:eje_filtro,area_filtro:area_filtro,exposicion:exposicion},
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let rows='<ul class="list-group">';
                    total = 0;
                    $.each(obj, function (i, item) {
                      rows+='<li class="es-li">';
                           rows+= '<strong> '+item.nombre_area+' : </strong>'+item.total;
                      rows+='</li>';
                      total +=  parseInt(item.total);
                    });
                    rows+='</ul>';
                    $("#origen_activo_fijo").append(' : '+total);
                    $("#activo_fijo_origen").append(rows);
                }
            });
    },
    init:()=>{
        portada.cargaInicial();
    }
    }

    $(document).ready(function () {

        $("#filtro_eje").change(function()
        {
            eje_filtro=$("#filtro_eje").val();
            area_filtro=$("#filtro_area").val();
            exposicion=$("#select_exposiciones").val();
            portada.Totales_(eje_filtro,area_filtro,exposicion);
            portada.Por_eje(eje_filtro,area_filtro,exposicion);
            portada.Por_area(eje_filtro,area_filtro,exposicion);
        });
          $("#filtro_area").change(function(){
            eje_filtro=$("#filtro_eje").val();
            area_filtro=$("#filtro_area").val();
            exposicion=$("#select_exposiciones").val();
            portada.Totales_(eje_filtro,area_filtro,exposicion);
            portada.Por_eje(eje_filtro,area_filtro,exposicion);
            portada.Por_area(eje_filtro,area_filtro,exposicion);
          });

    portada.init();

    });
