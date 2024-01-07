
let ejes = ['Estrategias de seguridad', 'Plan estratégico', 'Infraestructura', 'Gestion administrativa', 'Autogestión de recursos', 'Exposición permanente', 'Exposiciones temporales', 'Bellas artes para todos', 'Difusión e imagen', 'Publicaciones', 'Estrategia digital'];
let area = ['Dirección', 'Jefa de oficina', 'Relaciones públicas', 'Proyectos especiales', 'Sistemas', 'Fotografía', 'Subdirección técnica', 'Indicadores', 'Exhibición', 'Registro y control de obra', 'Mediación y Programas públicos', 'Difusión', 'Museografía', 'Arquitectura', 'Diseño', 'Editorial', 'Investigación', 'Administración', 'Programación y presupuesto', 'Recursos humanos', 'Recursos financieros', 'Recursos materiales', 'Jurídico', 'Seguridad', 'Custodios', 'AAMPBA', 'INBAL'];
let sub_area = ['Jefatura de Exhibición', 'Gestión Exhibición', 'Investigacion Educativa', 'Programas Publicos', 'Redes Sociales', 'Audiovisual', 'Prensa', 'Promoción', 'Taquilla', 'Servicio Social', 'Archivo', 'Tienda', 'Presidencia'];
let incidencias = ['Sin incidencia','No dejó correo','Correo inválido','Problema con el SIE','Sin respuesta','Con respuesta'];


//'Electrónicos', 'Servicios al público', 'Coordinación Operativa', 'Limpieza', 'Pintura', 'Iluminación', 'Administrador', 'Dirección', 'Jefa de Oficina', 'Relaciones Públicas', 'Proyectos Especiales', 'Sistemas', 'Fotografia', 'Subdirección Técnica', 'Indicadores', 'Exhibición', 'Registro', 'Mediación', 'Difusión', 'Museografía', 'Arquitectura', 'Diseño', 'Editorial', 'Investigación', 'Administración', 'Presupuesto', 'Recursos Humanos', 'Recursos Financieros', 'Recursos Materiales', ////'Jurídico', 'Seguridad', 'Custodios', 'Amigos del MPBA', 'INBAL'

let colores = ['rgb(24, 149, 240)', 'rgb(250, 204, 9)', 'purple'];
let RowFelicitacion = []
let RowSolicitud = []
let RowQueja = []
let dt = []

let RowFelicitacionArea = []
let RowSolicitudArea = []
let RowQuejaArea = []
let dtArea = []

let RowFelicitacion_subArea = []
let RowSolicitud_subArea = []
let RowQueja_subArea = []
let dt_subArea = []


let dt_incidencias = []
let Row = []
let newGrf={

llenaMatrices:(fmetricas)=>{
    $.post("./Conexiones/SelectTotalGraficaPorAnio.php",
    { fecha: fmetricas, id: 1 }
    ,
    function (data, status) {
        if (status == "success") {
            let obj = JSON.parse(data);
            let countobj = Object.keys(obj).length;
                let x=0;
                $.each(ejes, function (i, item) {
                  if( x < countobj){
                    if((i+1)== obj[x].idEje){
                     RowFelicitacion.push( parseInt(obj[x].total));
                     x=x+1;
                    }
                    else
                        RowFelicitacion.push(0);
                  }else
                       RowFelicitacion.push(0);
                });
        }
    });

    $.post("./Conexiones/SelectTotalGraficaPorAnio.php",
    { fecha: fmetricas, id: 2 }
    ,
    function (data, status) {
        if (status == "success") {
            let obj = JSON.parse(data);
            let countobj = Object.keys(obj).length;
                let x=0;
                $.each(ejes, function (i, item) {
                   if( x < countobj){
                     if((i+1)== obj[x].idEje){
                      RowSolicitud.push( parseInt(obj[x].total));
                      x=x+1;
                     }
                     else
                      RowSolicitud.push(0);
                   }else
                    RowSolicitud.push(0);
                });
        }
    });

    $.post("./Conexiones/SelectTotalGraficaPorAnio.php",
    { fecha: fmetricas, id: 3 }
    ,
    function (data, status) {
        if (status == "success") {
            let obj = JSON.parse(data);
            let countobj = Object.keys(obj).length;
                let x=0;
                $.each(ejes, function (i, item) {
                   if( x < countobj){
                     if((i+1)== obj[x].idEje){
                      RowQueja.push( parseInt(obj[x].total));
                      x=x+1;
                     }
                     else
                      RowQueja.push(0);
                   }else
                      RowQueja.push(0);
                });
                newGrf.CrearGraficaEjes();
        }
    });

},
CrearGraficaEjes:()=>{
    ejes.forEach(function (valor, indice, ejes) {
        row = { x: ejes[indice], Felicitacion: RowFelicitacion[indice], Solicitud: RowSolicitud[indice], Queja: RowQueja[indice] }
        dt.push(row);
    });

    Morris.Bar({
        element: 'graph',
        data: dt,
        xkey: 'x',
        ykeys: ['Felicitacion', 'Solicitud', 'Queja'],
        labels: ['Felicitación', 'Solicitud', 'Queja'],
        barColors: colores,
        xLabelAngle:45,
        resize:true,
        padding: 60,
        stacked: true

    });

    $("#mostrarGrafica").attr("hidden","hidden");
    $("#RefreshGrafica").removeAttr("hidden");
},
RefreshGraficaEjes:()=>{
    RowFelicitacion = [];
    RowSolicitud = [];
    RowQueja = [];
    dt = [];
    let fmetricas=$("#fechaMetricas").val();
    newGrf.llenaMatrices(fmetricas);
    $("#RefreshGrafica").attr("hidden","hidden");
    $("#mostrarGrafica").removeAttr("hidden");
    $("#graph").html("");
},
llenaMatricesArea:(fmetricas)=>{
    $.post("./Conexiones/SelectTotalGraficaAreaPorAnio.php",
    { fecha: fmetricas, id: 1 }
    ,
    function (data, status) {
        if (status == "success") {
            let obj = JSON.parse(data);
            let countobj = Object.keys(obj).length;
                let x=0;
                $.each(area, function (i, item) {
                   if( x < countobj){
                     if((item)== obj[x].Nombre ){
                      RowFelicitacionArea.push( parseInt(obj[x].total));
                      x=x+1;
                     }
                     else
                      RowFelicitacionArea.push(0);
                   }else
                    RowFelicitacionArea.push(0);

                });
        }
    });

    $.post("./Conexiones/SelectTotalGraficaAreaPorAnio.php",
    { fecha: fmetricas, id: 2 }
    ,
    function (data, status) {
        if (status == "success") {
          //console.log(data);
            let obj = JSON.parse(data);
            let countobj = Object.keys(obj).length;
                let x=0;
                $.each(area, function (i, item) {
                    if( x < countobj){
                      if((item) == obj[x].Nombre ){
                      RowSolicitudArea.push( parseInt(obj[x].total));
                      x=x+1;
                     }
                     else
                        RowSolicitudArea.push(0);
                    }else
                       RowSolicitudArea.push(0);

                });
        }
    });

    $.post("./Conexiones/SelectTotalGraficaAreaPorAnio.php",
    { fecha: fmetricas, id: 3 }
    ,
    function (data, status) {
        if (status == "success") {
            let obj = JSON.parse(data);
            let countobj = Object.keys(obj).length;
                let x=0;
                $.each(area, function (i, item) {
                    if( x < countobj){
                      if((item)== obj[x].Nombre){
                      RowQuejaArea.push( parseInt(obj[x].total));
                      x=x+1;
                     }
                     else
                        RowQuejaArea.push(0);
                    }else
                       RowQuejaArea.push(0);

                });
                newGrf.CrearGraficaArea();
        }
    });
},
CrearGraficaArea:()=>{
    area.forEach(function (valor, indice, area) {
        row = { x: area[indice], Felicitacion: RowFelicitacionArea[indice], Solicitud: RowSolicitudArea[indice], Queja: RowQuejaArea[indice] }
        dtArea.push(row);
      //  console.log('ingresando: '+area[indice]+' con felic: '+RowFelicitacionArea[indice]+' con sol: '+RowSolicitudArea[indice]+' con queja: '+RowQuejaArea[indice]);
    });

    Morris.Bar({
        element: 'graphArea',
        data: dtArea,
        xkey: 'x',
        ykeys: ['Felicitacion', 'Solicitud', 'Queja'],
        labels: ['Felicitación', 'Solicitud', 'Queja'],
        barColors: colores,
        xLabelAngle:90,
        resize:true,
        padding: 60,
        stacked: true
    });
},
RefreshGraficaArea:()=>{
    RowFelicitacionArea = [];
    RowSolicitudarea = [];
    RowQuejaArea = [];
    dtArea = [];
    let fmetricas=$("#fechaMetricas").val();
    newGrf.llenaMatricesArea(fmetricas);
    $("#RefreshGrafica").attr("hidden","hidden");
    $("#mostrarGrafica").removeAttr("hidden");
    $("#graphArea").html("");

},
llenaMatrices_subArea:(fmetricas)=>{
    $.post("./Conexiones/SelectTotalGrafica_sub_area.php",
    { fecha: fmetricas, id: 1 }
    ,
    function (data, status) {
        if (status == "success") {
            let obj = JSON.parse(data);
            let countobj = Object.keys(obj).length;
                let x=0;
                $.each(sub_area, function (i, item) {
                   if( x < countobj){
                       if((item)== obj[x].Nombre ){
                          RowFelicitacion_subArea.push( parseInt(obj[x].total));
                          console.log("entra en anadir");
                          x=x+1;
                       }else{
                        RowFelicitacion_subArea.push(0);
                        console.log("entra en else");
                     }
                   }else
                     RowFelicitacion_subArea.push(0);
                });
        }
    });

    $.post("./Conexiones/SelectTotalGrafica_sub_area.php",
    { fecha: fmetricas, id: 2 }
    ,
    function (data, status) {
        if (status == "success") {
            let obj = JSON.parse(data);
            let countobj = Object.keys(obj).length;
                let x=0;
                $.each(sub_area, function (i, item) {
                    if( x < countobj){
                        if((item) == obj[x].Nombre ){
                        RowSolicitud_subArea.push( parseInt(obj[x].total));
                        x=x+1;
                       }else
                          RowSolicitud_subArea.push(0);
                    }else
                      RowSolicitud_subArea.push(0);
                });
        }
    });

    $.post("./Conexiones/SelectTotalGrafica_sub_area.php",
    { fecha: fmetricas, id: 3 }
    ,
    function (data, status) {
        if (status == "success") {
            let obj = JSON.parse(data);
            let countobj = Object.keys(obj).length;
                let x=0;
                $.each(sub_area, function (i, item) {
                    if( x < countobj){
                      if((item)== obj[x].Nombre){
                        RowQueja_subArea.push( parseInt(obj[x].total));
                        x=x+1;
                     }else
                        RowQueja_subArea.push(0);
                    }else
                        RowQueja_subArea.push(0);
                });
                newGrf.CrearGrafica_subArea();
        }
    });
},
CrearGrafica_subArea:()=>{
    sub_area.forEach(function (valor, indice, sub_area) {
        row = { x: sub_area[indice], Felicitacion: RowFelicitacion_subArea[indice], Solicitud: RowSolicitud_subArea[indice], Queja: RowQueja_subArea[indice] }
        dt_subArea.push(row);

    });

    Morris.Bar({
        element: 'graph_subArea',
        data: dt_subArea,
        xkey: 'x',
        ykeys: ['Felicitacion', 'Solicitud', 'Queja'],
        labels: ['Felicitación', 'Solicitud', 'Queja'],
        barColors: colores,
        xLabelAngle:45,
        resize:true,
        padding: 60,
        stacked: true
    });
},
llenaMatrices_incidencias:(fmetricas)=>{
    $.post("./Conexiones/select_incidencias.php",
    { fecha: fmetricas, id: 1 }
    ,
    function (data, status) {
        if (status == "success") {
          let obj = JSON.parse(data);
            let countobj = Object.keys(obj).length;
                let x=0;
                $.each(incidencias, function (i, item) {
                   if( x < countobj){
                       if((item)== obj[x].descripcion ){
                          Row.push( parseInt(obj[x].total));

                          x=x+1;
                       }else{
                        Row.push(0);
                     }
                   }else
                     Row.push(0);
                });
                newGrf.CrearGrafica_incidencias();
        }
    });
},
CrearGrafica_incidencias:()=>{
    incidencias.forEach(function (valor, indice, incidencias) {
        row = { x: incidencias[indice], Total: Row[indice] }
        dt_incidencias.push(row);

    });

    Morris.Bar({
        element: 'graph_incidencias',
        data: dt_incidencias,
        xkey: 'x',
        ykeys: ['Total'],
        labels: ['Total'],
        barColors: colores,
        xLabelAngle:45,
        resize:true,
        padding: 60,
        stacked: true
    });
}

}


// Use Morris.Bar





$(document).ready(function () {

    eval($('#code').text());
    prettyPrint();

    let fmetricas=$("#fechaMetricas").val();
    newGrf.llenaMatrices(fmetricas);
    newGrf.llenaMatricesArea(fmetricas);
    newGrf.llenaMatrices_subArea(fmetricas);
    newGrf.llenaMatrices_incidencias(fmetricas);
    //newGrf.
     //newGrf.CrearGraficaArea();

});
