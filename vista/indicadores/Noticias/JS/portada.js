let portada={
    cargaInicial:()=>{
      fecha=$("#filtro_fecha").val();
      eje_filtro=$("#filtro_eje").val();
      area_filtro=$("#filtro_area").val();
      portada.ObtenerListadoanios();
      portada.ObtenerListadoEjes();
      portada.ObtenerListadoAreas();
      portada.ExposicionesTemporales(fecha);
      portada.acuerdos_totales(fecha,eje_filtro,area_filtro,"todos");
      portada.acuerdos_por_anio(fecha,eje_filtro,area_filtro,"todos");
      portada.acuerdos_por_eje(fecha,eje_filtro,area_filtro,"todos");
      portada.acuerdos_por_area(fecha,eje_filtro,area_filtro,"todos");
      portada.Acuerdos_por_expo(fecha,eje_filtro,area_filtro,"todos");
    },
    ObtenerListadoEjes:()=>{
    let obj;
        $.post("./Conexiones/SelectEje.php",
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
        $.post("./Conexiones/SelectArea.php",
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
    ObtenerListadoanios:()=>{

    let obj;
        $.post("./Conexiones/select_anios.php",
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let eje = "";
                    $.each(obj, function (i, item) {
                        if(item.anio == null){
                            eje+="<option > Sin año </option>";
                        }else{
                        eje+="<option >"+item.anio+"</option>";
                        }
                    });
                    $("#filtro_fecha").append(eje)
                }
            });
    },
    acuerdos_totales:(fecha,eje_filtro,area_filtro,exposicion)=>{
    let obj;
    $("#total_acuerdos").html("");
    $("#acuerdos_totales").html("");
        $.post("./Conexiones/select_acuerdos_totales.php",
          {fecha:fecha,eje_filtro:eje_filtro,area_filtro:area_filtro,exposicion:exposicion},
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let rows='<ul class="list-group">';
                    $.each(obj, function (i, item) {
                      rows+='<li class="es-li">';
                           rows+= '<strong> Acuerdos revisados : </strong>'+item.revisados;
                      rows+='</li>';
                      rows+='<li class="es-li">';
                           rows+= '<strong> Acuerdos no revisados : </strong>'+item.norevisados;
                      rows+='</li>';
                    $("#total_acuerdos").append(' : '+item.total);
                    });
                    rows+='</ul>';

                    $("#acuerdos_totales").append(rows);
                }
            });
    },
    Acuerdos_por_expo:(fecha,eje_filtro,area_filtro,exposicion)=>{
    let obj;
    $("#expo_total").html("");
    $("#acuerdos_expo").html("");
        $.post("./Conexiones/select_acuerdos_expo.php",
          {fecha:fecha,eje_filtro:eje_filtro,area_filtro:area_filtro,exposicion:exposicion},
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let rows='<ul class="list-group">';
                    let total = 0;
                    $.each(obj, function (i, item) {
                      rows+='<li class="es-li">';
                           rows+= '<strong> '+item.nombre+' : </strong>'+item.total;
                      rows+='</li>';
                      total += parseInt(item.total);
                    });
                    rows+='</ul>';
                    $("#expo_total").append(' : '+total);
                    $("#acuerdos_expo").append(rows);
                }
            });
    },
    acuerdos_por_anio:(fecha,eje_filtro,area_filtro,exposicion)=>{

    let obj;
    $("#total_anio").html("");
    $("#acuerdos_anio").html("");
        $.post("./Conexiones/select_acuerdos_anio.php",
        {fecha:fecha,eje_filtro:eje_filtro,area_filtro:area_filtro,exposicion:exposicion},
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let total = 0;
                    let rows='<ul class="list-group">';
                    $.each(obj, function (i, item) {
                      rows+='<li class="es-li">';
                           rows+= '<strong> '+item.anio+' : </strong>'+item.total;
                      rows+='</li>';
                      total += parseInt(item.total);
                    });
                    rows+='</ul>';
                    $("#total_anio").append(' : '+total);
                    $("#acuerdos_anio").append(rows);
                }
            });
    },
    acuerdos_por_eje:(fecha,eje_filtro,area_filtro,exposicion)=>{
    let obj;
    $("#total_eje").html("");
    $("#acuerdos_eje").html("");
        $.post("./Conexiones/select_acuerdos_eje.php",
          {fecha:fecha,eje_filtro:eje_filtro,area_filtro:area_filtro,exposicion:exposicion},
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let total = 0;
                    let rows='<ul class="list-group">';
                    $.each(obj, function (i, item) {
                      rows+='<li class="es-li">';
                           rows+= '<strong>'+item.idEje+' .- '+item.nombre+' : </strong>'+item.total;
                      rows+='</li>';
                      total+=parseInt(item.total);
                    });
                    rows+='</ul>';
                    $("#total_eje").append(' : '+total);
                    $("#acuerdos_eje").append(rows);
                }
            });
    },
    acuerdos_por_area:(fecha,eje_filtro,area_filtro,exposicion)=>{
    let obj;
    $("#total_area").html("");
    $("#acuerdos_area").html("");
        $.post("./Conexiones/select_acuerdos_area.php",
          {fecha:fecha,eje_filtro:eje_filtro,area_filtro:area_filtro,exposicion:exposicion},
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let total = 0;
                    let rows='<ul class="list-group">';
                    $.each(obj, function (i, item) {
                      rows+='<li class="es-li">';
                           rows+= '<strong>'+item.nombre+' : </strong>'+item.total;
                      rows+='</li>';
                      total+=parseInt(item.total);
                    });
                    rows+='</ul>';
                    $("#total_area").append(' : '+total);
                    $("#acuerdos_area").append(rows);
                }
            });
    },
    ExposicionesTemporales:(fecha)=>{
        $("#select_exposiciones").html("");
        $.post("./Conexiones/SelectExposicionesTemporales.php",
        {fecha:fecha},
        function (data, status) {
            if (status == "success") {
                let obj = JSON.parse(data);
                let countobj = Object.keys(obj).length;
                if (countobj > 0) {
                    let select = '<option selected value ="todos" > Todas las exposiciones </option> '
                    $.each(obj, function (i, item) {
                        /*if (item.Exposicion == null) {
                            select+='<option value = "'+item.idExposicion+'"> Sin Exposición </option> ';
                        } else {*/
                            select+='<option value = "'+item.idExposicion+'">'+item.Exposiciones+': </option> ';
                        //}
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
            portada.acuerdos_totales(fecha,eje_filtro,area_filtro,exposicion);
            portada.acuerdos_por_anio(fecha,eje_filtro,area_filtro,exposicion);
            portada.acuerdos_por_eje(fecha,eje_filtro,area_filtro,exposicion);
            portada.acuerdos_por_area(fecha,eje_filtro,area_filtro,exposicion);
            portada.Acuerdos_por_expo(fecha,eje_filtro,area_filtro,exposicion);
        });
        $("#filtro_eje").change(function()
        {
            fecha=$("#filtro_fecha").val();
            eje_filtro=$("#filtro_eje").val();
            area_filtro=$("#filtro_area").val();
            exposicion=$("#select_exposiciones").val();
            portada.acuerdos_totales(fecha,eje_filtro,area_filtro,exposicion);
            portada.acuerdos_por_anio(fecha,eje_filtro,area_filtro,exposicion);
            portada.acuerdos_por_eje(fecha,eje_filtro,area_filtro,exposicion);
            portada.acuerdos_por_area(fecha,eje_filtro,area_filtro,exposicion);
            portada.Acuerdos_por_expo(fecha,eje_filtro,area_filtro,exposicion);
        });
          $("#filtro_area").change(function(){
            fecha=$("#filtro_fecha").val();
            eje_filtro=$("#filtro_eje").val();
            area_filtro=$("#filtro_area").val();
            exposicion=$("#select_exposiciones").val();
            portada.acuerdos_totales(fecha,eje_filtro,area_filtro,exposicion);
            portada.acuerdos_por_anio(fecha,eje_filtro,area_filtro,exposicion);
            portada.acuerdos_por_eje(fecha,eje_filtro,area_filtro,exposicion);
            portada.acuerdos_por_area(fecha,eje_filtro,area_filtro,exposicion);
            portada.Acuerdos_por_expo(fecha,eje_filtro,area_filtro,exposicion);
          });
          $("#select_exposiciones").change(function(){
            fecha=$("#filtro_fecha").val();
            eje_filtro=$("#filtro_eje").val();
            area_filtro=$("#filtro_area").val();
            exposicion=$("#select_exposiciones").val();
            portada.acuerdos_totales(fecha,eje_filtro,area_filtro,exposicion);
            portada.acuerdos_por_anio(fecha,eje_filtro,area_filtro,exposicion);
            portada.acuerdos_por_eje(fecha,eje_filtro,area_filtro,exposicion);
            portada.acuerdos_por_area(fecha,eje_filtro,area_filtro,exposicion);
            portada.Acuerdos_por_expo(fecha,eje_filtro,area_filtro,exposicion);
          });

    portada.init();

    });
