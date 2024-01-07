
let portada={
    cargaInicial:()=>{
      fecha=$("#filtro_fecha").val();
      eje_filtro=$("#filtro_eje").val();
      area_filtro=$("#filtro_area").val();
      portada.ObtenerListadoEjes();
      portada.ObtenerListadoAreas();
      portada.Opiniones_por_status(fecha,eje_filtro,area_filtro,"todos");
      portada.Opiniones_por_tipo(fecha,eje_filtro,area_filtro,"todos");
      portada.Opiniones_por_origen(fecha,eje_filtro,area_filtro,"todos");
      portada.Opiniones_por_anio(fecha,eje_filtro,area_filtro,"todos");
      portada.Opiniones_por_eje(fecha,eje_filtro,area_filtro,"todos");
      portada.Opiniones_por_area(fecha,eje_filtro,area_filtro,"todos");
      portada.Opiniones_por_usuario(fecha,eje_filtro,area_filtro,"todos");
      portada.ExposicionesTemporales(fecha);

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
    Opiniones_por_status:(fecha,eje_filtro,area_filtro,exposicion)=>{
    let obj;
    console.log("entrando a opiniones por status con parametros fecha  "+fecha+" eje : "+eje_filtro+" area : "+area_filtro+" expo : "+exposicion);
    $("#total_opiniones").html("");
    $("#opiniones_totales").html("");
        $.post("./Conexiones/select_op_por_estatus.php",
          {fecha:fecha,eje_filtro:eje_filtro,area_filtro:area_filtro,exposicion:exposicion},
            (data, status) => {
                if (status == "success") {
                  console.log("entrando a opiniones por status success ");
                    let obj = JSON.parse(data);
                    console.log("anadiendo data :  "+data);
                    let rows='<ul class="list-group">';
                    $.each(obj, function (i, item) {
                      console.log("anadiendo row ");
                      rows+='<li class="es-li">';
                           rows+= '<strong> Opiniones pendientes de turnar a eje : </strong>'+item.pendientes_t_eje;
                      rows+='</li>';
                      rows+='<li class="es-li">';
                           rows+= '<strong> Opiniones pendientes de turnar a act : </strong>'+item.pendientes_t_act;
                      rows+='</li>';
                      rows+='<li class="es-li">';
                           rows+= '<strong> Opiniones pendientes de atender : </strong>'+item.pendientes_atender;
                      rows+='</li>';
                      rows+='<li class="es-li">';
                           rows+= '<strong> Opiniones atendidas : </strong>'+item.atendidas;
                      rows+='</li>';
                    $("#total_opiniones").append(' : '+item.total);
                    });
                    rows+='</ul>';

                    $("#opiniones_totales").append(rows);
                }
            });
    },
    Opiniones_por_tipo:(fecha,eje_filtro,area_filtro,exposicion)=>{
    let obj;
    $("#tipo_opiniones").html("");
    $("#opiniones_tipo").html("");
        $.post("./Conexiones/select_op_tipo.php",
          {fecha:fecha,eje_filtro:eje_filtro,area_filtro:area_filtro,exposicion:exposicion},
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let rows='<ul class="list-group">';
                    $.each(obj, function (i, item) {
                      rows+='<li class="es-li">';
                           rows+= '<strong> Felicitación : </strong>'+item.felicitacion;
                      rows+='</li>';
                      rows+='<li class="es-li">';
                           rows+= '<strong> Solicitud : </strong>'+item.solicitud;
                      rows+='</li>';
                      rows+='<li class="es-li">';
                           rows+= '<strong> Queja : </strong>'+item.queja;
                      rows+='</li>';
                    $("#tipo_opiniones").append(' : '+item.total);
                    });
                    rows+='</ul>';

                    $("#opiniones_tipo").append(rows);
                }
            });
    },
    Opiniones_por_origen:(fecha,eje_filtro,area_filtro,exposicion)=>{
    let obj;
    $("#origen_opiniones").html("");
    $("#opiniones_origen").html("");
        $.post("./Conexiones/select_op_origen.php",
          {fecha:fecha,eje_filtro:eje_filtro,area_filtro:area_filtro,exposicion:exposicion},
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let rows='<ul class="list-group">';
                    $.each(obj, function (i, item) {
                      rows+='<li class="es-li">';
                           rows+= '<strong> Web : </strong>'+item.web;
                      rows+='</li>';
                      rows+='<li class="es-li">';
                           rows+= '<strong> Escritas : </strong>'+item.kioskos;
                      rows+='</li>';
                      rows+='<li class="es-li">';
                           rows+= '<strong> Kioskos : </strong>'+item.escritas;
                      rows+='</li>';
                      rows+='<li class="es-li">';
                           rows+= '<strong> Redes : </strong>'+item.redes;
                      rows+='</li>';
                      rows+='<li class="es-li">';
                           rows+= '<strong> Gerencia : </strong>'+item.gerencia;
                      rows+='</li>';
                      rows+='<li class="es-li">';
                           rows+= '<strong> Correo : </strong>'+item.correo;
                      rows+='</li>';
                      rows+='<li class="es-li">';
                           rows+= '<strong> Otros : </strong>'+item.otros;
                      rows+='</li>';
                    $("#origen_opiniones").append(' : '+item.total);
                    });
                    rows+='</ul>';

                    $("#opiniones_origen").append(rows);
                }
            });
    },
    Opiniones_por_anio:(fecha,eje_filtro,area_filtro,exposicion)=>{
    let obj;
    $("#total_anio").html("");
    $("#opiniones_anio").html("");
        $.post("./Conexiones/select_op_anio.php",
        {fecha:fecha,eje_filtro:eje_filtro,area_filtro:area_filtro,exposicion:exposicion},
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let rows='<ul class="list-group">';
                    $.each(obj, function (i, item) {
                      rows+='<li class="es-li">';
                           rows+= '<strong> 2015 : </strong>'+item.anio_2015;
                      rows+='</li>';
                      rows+='<li class="es-li">';
                           rows+= '<strong> 2016 : </strong>'+item.anio_2016;
                      rows+='</li>';
                      rows+='<li class="es-li">';
                           rows+= '<strong> 2017 : </strong>'+item.anio_2017;
                      rows+='</li>';
                      rows+='<li class="es-li">';
                           rows+= '<strong> 2018 : </strong>'+item.anio_2018;
                      rows+='</li>';
                      rows+='<li class="es-li">';
                           rows+= '<strong> 2019 : </strong>'+item.anio_2019;
                      rows+='</li>';
                      rows+='<li class="es-li">';
                           rows+= '<strong> 2020 : </strong>'+item.anio_2020;
                      rows+='</li>';
                    $("#total_anio").append(' : '+item.total);
                    });
                    rows+='</ul>';

                    $("#opiniones_anio").append(rows);
                }
            });
    },
    Opiniones_por_eje:(fecha,eje_filtro,area_filtro,exposicion)=>{
    let obj;
    $("#total_eje").html("");
    $("#opiniones_eje").html("");
        $.post("./Conexiones/select_por_eje.php",
          {fecha:fecha,eje_filtro:eje_filtro,area_filtro:area_filtro,exposicion:exposicion},
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let total = 0;
                    let rows='<ul class="list-group">';
                    $.each(obj, function (i, item) {
                      rows+='<li class="es-li">';
                           rows+= '<strong>'+item.IdEje+' .- '+item.Nombre+' : </strong>'+item.conteo;
                      rows+='</li>';
                      total+=parseInt(item.conteo);
                    });
                    rows+='</ul>';
                    $("#total_eje").append(' : '+total);
                    $("#opiniones_eje").append(rows);
                }
            });
    },
    Opiniones_por_area:(fecha,eje_filtro,area_filtro,exposicion)=>{
    let obj;
    $("#total_area").html("");
    $("#opiniones_area").html("");
        $.post("./Conexiones/select_por_area.php",
          {fecha:fecha,eje_filtro:eje_filtro,area_filtro:area_filtro,exposicion:exposicion},
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let total = 0;
                    let rows='<ul class="list-group">';
                    $.each(obj, function (i, item) {
                      rows+='<li class="es-li">';
                           rows+= '<strong>'+item.Id_Area+' .- '+item.Nombre+' : </strong>'+item.cuenta;
                      rows+='</li>';
                      total+=parseInt(item.cuenta);
                    });
                    rows+='</ul>';
                    $("#total_area").append(' : '+total);
                    $("#opiniones_area").append(rows);
                }
            });
    },
    Opiniones_por_usuario:(fecha,eje_filtro,area_filtro,exposicion)=>{
    let obj;
    $("#total_usuarios").html("");
    $("#opiniones_usuarios").html("");
        $.post("./Conexiones/select_op_usuario.php",
          {fecha:fecha,eje_filtro:eje_filtro,area_filtro:area_filtro,exposicion:exposicion},
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let total = 0;
                    let rows='<ul class="list-group">';
                    $.each(obj, function (i, item) {
                      if(i<10){
                        rows+='<li class="es-li">';
                             rows+= '<strong>'+item.Usuario+' : </strong>'+item.total;
                        rows+='</li>';
                        total+=parseInt(item.total);
                      }
                    });
                    rows+='</ul>';
                    $("#total_usuarios").append(' : '+total);
                    $("#opiniones_usuarios").append(rows);
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
                    let select = '<option value= "todos" selected> Todas las exposiciones </option> '
                    $.each(obj, function (i, item) {

                         select+='<option value = "'+item.idExposicion+'">'+item.Exposiciones+': </option> ';
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
            console.log("entrando a cambiando fecha");
            fecha=$("#filtro_fecha").val();
            eje_filtro=$("#filtro_eje").val();
            area_filtro=$("#filtro_area").val();
            exposicion=$("#select_exposiciones").val();
            portada.Opiniones_por_status(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_tipo(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_origen(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_anio(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_eje(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_area(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_usuario(fecha,eje_filtro,area_filtro,exposicion);
            portada.ExposicionesTemporales(fecha);
        });
        $("#filtro_eje").change(function()
        {
            fecha=$("#filtro_fecha").val();
            eje_filtro=$("#filtro_eje").val();
            area_filtro=$("#filtro_area").val();
            exposicion=$("#select_exposiciones").val();
            portada.Opiniones_por_status(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_tipo(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_origen(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_anio(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_eje(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_area(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_usuario(fecha,eje_filtro,area_filtro,exposicion);
        });
          $("#filtro_area").change(function(){
            fecha=$("#filtro_fecha").val();
            eje_filtro=$("#filtro_eje").val();
            area_filtro=$("#filtro_area").val();
            exposicion=$("#select_exposiciones").val();
            portada.Opiniones_por_status(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_tipo(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_origen(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_anio(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_area(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_eje(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_usuario(fecha,eje_filtro,area_filtro,exposicion);
          });
          $("#select_exposiciones").change(function(){
            fecha=$("#filtro_fecha").val();
            eje_filtro=$("#filtro_eje").val();
            area_filtro=$("#filtro_area").val();
            exposicion=$("#select_exposiciones").val();
            portada.Opiniones_por_status(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_tipo(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_origen(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_anio(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_area(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_eje(fecha,eje_filtro,area_filtro,exposicion);
            portada.Opiniones_por_usuario(fecha,eje_filtro,area_filtro,exposicion);
          });

    portada.init();

    });
