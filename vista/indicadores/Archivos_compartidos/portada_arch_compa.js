
let portada={
    cargaInicial:()=>{
      fecha=$("#filtro_fecha").val();
      eje_filtro=$("#filtro_eje").val();
      area_filtro=$("#filtro_area").val();
      portada.ObtenerListadoanios();
      portada.ObtenerListadoEjes();
      portada.ObtenerListadoAreas();
      portada.archivos_totales(fecha,eje_filtro,area_filtro,"todos");
      portada.archivos_por_eje(fecha,eje_filtro,area_filtro,"todos");
      portada.archivos_por_area(fecha,eje_filtro,area_filtro,"todos");
      portada.archivos_por_anio(fecha,eje_filtro,area_filtro,"todos");
      portada.archivos_por_expo(fecha,eje_filtro,area_filtro,"todos");
      portada.ExposicionesTemporales(fecha);

    },
    ObtenerListadoanios:()=>{
    let obj;
        $.post("./Conexiones_arch_compa.php",
        {accion:"anios"},
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let anio = "";
                    $.each(obj, function (i, item) {
                        anio+="<option >"+item.Anio+"</option>";
                    });
                    $("#filtro_fecha").append(anio)
                }
            });
    },
    ObtenerListadoEjes:()=>{
    let obj;
        $.post("./Conexiones_arch_compa.php",
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
        $.post("./Conexiones_arch_compa.php",
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
    archivos_totales:(fecha,eje_filtro,area_filtro,exposicion)=>{
    let obj;
    $("#total_arch_compa").html("");
    $("#arch_compa_total").html("");
        $.post("./Conexiones_arch_compa.php",
          {accion:"totales",fecha:fecha,eje_filtro:eje_filtro,area_filtro:area_filtro,exposicion:exposicion},
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let rows='<ul class="list-group">';
                    $.each(obj, function (i, item) {
                      rows+='<li class="es-li">';
                           rows+= '<strong> Total archivos : </strong>'+item.total;
                      rows+='</li>';
                    $("#total_arch_compa").append(' : '+item.total);
                    });
                    rows+='</ul>';

                    $("#arch_compa_total").append(rows);
                }
            });
    },
    archivos_por_eje:(fecha,eje_filtro,area_filtro,exposicion)=>{
    let obj;
    $("#eje_arch_compa").html("");
    $("#arch_compa_eje").html("");
        $.post("./Conexiones_arch_compa.php",
          {accion:"por_eje",fecha:fecha,eje_filtro:eje_filtro,area_filtro:area_filtro,exposicion:exposicion},
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
                    $("#eje_arch_compa").append(' : '+total);
                    $("#arch_compa_eje").append(rows);
                }
            });
    },
    archivos_por_area:(fecha,eje_filtro,area_filtro,exposicion)=>{
    let obj;
    $("#origen_arch_compa").html("");
    $("#arch_compa_origen").html("");
        $.post("./Conexiones_arch_compa.php",
          {accion:"por_area",fecha:fecha,eje_filtro:eje_filtro,area_filtro:area_filtro,exposicion:exposicion},
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
                    $("#origen_arch_compa").append(' : '+total);
                    $("#arch_compa_origen").append(rows);
                }
            });
    },
    archivos_por_anio:(fecha,eje_filtro,area_filtro,exposicion)=>{
    let obj;
    $("#anio_arch_compa").html("");
    $("#arch_compa_anio").html("");
        $.post("./Conexiones_arch_compa.php",
        {accion:"por_anio",fecha:fecha,eje_filtro:eje_filtro,area_filtro:area_filtro,exposicion:exposicion},
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let rows='<ul class="list-group">';
                    total = 0;
                    $.each(obj, function (i, item) {
                      rows+='<li class="es-li">';
                           rows+= '<strong> '+item.Anio+' : </strong>'+item.total;
                      rows+='</li>';
                      total +=  parseInt(item.total);
                    });
                    rows+='</ul>';
                    $("#anio_arch_compa").append(' : '+total);
                    $("#arch_compa_anio").append(rows);
                }
            });
    },
    archivos_por_expo:(fecha,eje_filtro,area_filtro,exposicion)=>{
    let obj;
    $("#expo_arch_compa").html("");
    $("#arch_compa_expo").html("");
        $.post("./Conexiones_arch_compa.php",
          {accion:"por_expo",fecha:fecha,eje_filtro:eje_filtro,area_filtro:area_filtro,exposicion:exposicion},
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let total = 0;
                    let rows='<ul class="list-group">';
                    $.each(obj, function (i, item) {
                      rows+='<li class="es-li">';
                           rows+= '<strong> '+item.ExpoTemp+' : </strong>'+item.total;
                      rows+='</li>';
                      total+=parseInt(item.total);
                    });
                    rows+='</ul>';
                    $("#expo_arch_compa").append(' : '+total);
                    $("#arch_compa_expo").append(rows);
                }
            });
    },
    ExposicionesTemporales:(fecha)=>{
        $("#select_exposiciones").html("");
        $.post("./Conexiones_arch_compa.php",
        {accion:"expos",fecha:fecha},
        function (data, status) {
            if (status == "success") {
                let obj = JSON.parse(data);
                let countobj = Object.keys(obj).length;
                if (countobj > 0) {
                    let select = '<option value= "todos" selected> Todas las exposiciones </option> '
                    $.each(obj, function (i, item) {

                         select+='<option value = "'+item.idExposicion+'">'+item.tituloFinal+': </option> ';
                    });
                    $("#select_exposiciones").append(select);

                }
            }
        });
    },
    init:()=>{
        portada.cargaInicial();
    }
    }

    $(document).ready(function () {
        $("#filtro_fecha").change(function()
        {
            fecha=$("#filtro_fecha").val();
            eje_filtro=$("#filtro_eje").val();
            area_filtro=$("#filtro_area").val();
            exposicion=$("#select_exposiciones").val();
            portada.archivos_totales(fecha,eje_filtro,area_filtro,exposicion);
            portada.archivos_por_eje(fecha,eje_filtro,area_filtro,exposicion);
            portada.archivos_por_area(fecha,eje_filtro,area_filtro,exposicion);
            portada.archivos_por_anio(fecha,eje_filtro,area_filtro,exposicion);
            portada.archivos_por_expo(fecha,eje_filtro,area_filtro,exposicion);
            portada.ExposicionesTemporales(fecha);
        });
        $("#filtro_eje").change(function()
        {
            fecha=$("#filtro_fecha").val();
            eje_filtro=$("#filtro_eje").val();
            area_filtro=$("#filtro_area").val();
            exposicion=$("#select_exposiciones").val();
            portada.archivos_totales(fecha,eje_filtro,area_filtro,exposicion);
            portada.archivos_por_eje(fecha,eje_filtro,area_filtro,exposicion);
            portada.archivos_por_area(fecha,eje_filtro,area_filtro,exposicion);
            portada.archivos_por_anio(fecha,eje_filtro,area_filtro,exposicion);
            portada.archivos_por_expo(fecha,eje_filtro,area_filtro,exposicion);
        });
          $("#filtro_area").change(function(){
            fecha=$("#filtro_fecha").val();
            eje_filtro=$("#filtro_eje").val();
            area_filtro=$("#filtro_area").val();
            exposicion=$("#select_exposiciones").val();
            portada.archivos_totales(fecha,eje_filtro,area_filtro,exposicion);
            portada.archivos_por_eje(fecha,eje_filtro,area_filtro,exposicion);
            portada.archivos_por_area(fecha,eje_filtro,area_filtro,exposicion);
            portada.archivos_por_anio(fecha,eje_filtro,area_filtro,exposicion);
            portada.archivos_por_expo(fecha,eje_filtro,area_filtro,exposicion);
          });
          $("#select_exposiciones").change(function(){
            fecha=$("#filtro_fecha").val();
            eje_filtro=$("#filtro_eje").val();
            area_filtro=$("#filtro_area").val();
            exposicion=$("#select_exposiciones").val();
            portada.archivos_totales(fecha,eje_filtro,area_filtro,exposicion);
            portada.archivos_por_eje(fecha,eje_filtro,area_filtro,exposicion);
            portada.archivos_por_area(fecha,eje_filtro,area_filtro,exposicion);
            portada.archivos_por_anio(fecha,eje_filtro,area_filtro,exposicion);
            portada.archivos_por_expo(fecha,eje_filtro,area_filtro,exposicion);
          });
    portada.init();

    });
