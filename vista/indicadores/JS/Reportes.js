
let total_por_eje ,total_por_Area ;
let reportes={
    cargaInicial:()=>{
        reportes.totalHistorico(2020);
        reportes.totalRecibidas(2020);
        reportes.totalPendientes(2020);
        reportes.totalAtendidas(2020);
        reportes.Progresbar();
        //reportes.totalEjeActividad();
        reportes.ExposicionesTemporales(2020);
        reportes.origenes_opiniones(2020);
        reportes.tipo_opiniones(2020);
    },
    lista:()=>{
        $("#VerAuditoria").modal("show");
    },
    totalHistorico:(fecha)=>{
        let imprime="";
        $("#progressBar2").html("");
        $("#opinionesHistorico").html("");
        $("#opinionesHistoricoRecibida").html("");
        $("#opinionesHistoricoAtendidaEje").html("");
        $("#opinionesHistoricoTurnadaActividad").html("");
        $("#opinionesHistoricoAtendida").html("");
        $.post("./Conexiones/SelectTotalHistorico.php",
        {fecha:fecha},
        function (data, status) {
            if (status == "success") {
                let obj = JSON.parse(data);
                let countobj = Object.keys(obj).length;
                if (countobj > 0) {
                    $.each(obj, function (i, item) {

                       // let Historico=(item.Historico/item.Historico)*100;
                        let Recibida=parseFloat((item.Recibida/item.Historico)*100).toFixed(0);
                        let TurnadaEje=parseFloat((item.TurnadaEje/item.Historico)*100).toFixed(0);
                        let TurnadaActividad=parseFloat((item.TurnadaActividad/item.Historico)*100).toFixed(0);
                        let Atendida=parseFloat((item.Atendida/item.Historico)*100).toFixed(0);

                        $("#opinionesHistorico").append(item.Historico);
                        $("#opinionesHistoricoRecibida").append(item.Recibida);
                        $("#opinionesHistoricoAtendidaEje").append(item.TurnadaEje);
                        $("#opinionesHistoricoTurnadaActividad").append(item.TurnadaActividad);
                        $("#opinionesHistoricoAtendida").append(item.Atendida);

                        imprime+='<p><div class="progress">';
                          imprime+='<div class="w3-container w3-green w3-center" style="width:'+(Atendida)+'%">'+(Atendida)+'% Ate.</div>';
                          imprime+='<div class="w3-container w3-yellow w3-center" style="width:'+(Recibida)+'%">'+(Recibida)+'%  Recibida</div>';
                          imprime+='<div class="w3-container w3-red w3-center" style="width:'+(TurnadaEje)+'%">'+(TurnadaEje)+'% T.Eje</div>';
                          imprime+='<div class="w3-container w3-orange w3-center" style="width:'+(TurnadaActividad)+'%">'+(TurnadaActividad)+'% T.Act</div>';

                        imprime+='</div>';
                        $("#progressBar2").append(imprime);
                    });
                }
            }
        });
    },
    origenes_opiniones:(fecha)=>{
        let imprime="";
        $("#opiniones_total").html("");
        $("#opiniones_web").html("");
        $("#opiniones_kioskos").html("");
        $("#opiniones_escritas").html("");
        $("#opiniones_facebook").html("");
        $("#opiniones_twitter").html("");
        $("#opiniones_gerencia").html("");
        $("#opiniones_correo").html("");
        $("#Opiniones_otros").html("");
        $.post("./Conexiones/SelectOrigenOpinion.php",
        {fecha:fecha},
        function (data, status) {
            if (status == "success") {
                let obj = JSON.parse(data);
                let countobj = Object.keys(obj).length;
                if (countobj > 0) {
                    $.each(obj, function (i, item) {
                       if(item.total > 0  ){
                         $("#opiniones_total").append(item.total);
                         $("#opiniones_web").append(item.web);
                         $("#opiniones_kioskos").append(item.kioskos);
                         $("#opiniones_escritas").append(item.escritas);
                         $("#opiniones_facebook").append(item.facebook);
                         $("#opiniones_twitter").append(item.twitter);
                         $("#opiniones_gerencia").append(item.gerencia);
                         $("#opiniones_correo").append(item.correo);
                         $("#Opiniones_otros").append(item.otros);
                       }
                    });
                }
            }
        });
    },
    tipo_opiniones:(fecha)=>{
        let imprime="";
        $("#progressBar3").html("");
        $.post("./Conexiones/SelectTotalTipo_Opiniones.php",
        {fecha:fecha},
        function (data, status) {
            if (status == "success") {
                let obj = JSON.parse(data);
                let countobj = Object.keys(obj).length;
                    $.each(obj, function (i, item) {
                        if(item.Historico > 0  ){
                          // let Historico=(item.Historico/item.Historico)*100;
                           let felicitacion=parseFloat((item.felicitacion/item.Historico)*100).toFixed(0);
                           let solicitud=parseFloat((item.solicitud/item.Historico)*100).toFixed(0);
                           let queja=parseFloat((item.queja/item.Historico)*100).toFixed(0);

                           imprime+='<div class="progress">';
                           imprime+='<div class="w3-container w3-blue w3-center" style="width:'+(felicitacion)+'%">'+(felicitacion)+'% Feli. </div>';
                           imprime+='<div class="w3-container w3-yellow w3-center" style="width:'+(solicitud)+'%"> '+(solicitud)+'% Sol.</div>';
                           imprime+='<div class="w3-container w3-purple w3-center" style="width:'+(queja)+'%"> '+(queja)+'% Queja</div>';
                           imprime+='</div>';
                           $("#progressBar3").append(imprime);
                        }
                    });
            }
        });
    },
    ExposicionesTemporales:(fecha)=>{
        $("#ExposicionesTempoxAnio").html("");
        $("#select_exposiciones").html("");
        $.post("./Conexiones/SelectExposicionesTemporales.php",
        {fecha:fecha},
        function (data, status) {
            if (status == "success") {
                let obj = JSON.parse(data);
                let countobj = Object.keys(obj).length;
                if (countobj > 0) {
                    let rows='<ul class="list-group">';
                    let select = '<option selected> Todas las exposiciones </option> '
                    rows+='<li class="list-group-item">';
                    $.each(obj, function (i, item) {
                         rows+='<br><strong>'+item.Exposiciones+': </strong> '+item.conteo+'  ( '+item.porcentaje+' )';
                         select+='<option>'+item.Exposiciones+': </option> ';
                    });
                    rows+='</li>';
                    rows+='</ul>';
                    $("#ExposicionesTempoxAnio").append(rows);
                    $("#select_exposiciones").append(select);

                }
            }
        });
    },
    totalEjeActividad:(fecha)=>{
        $("#idTotalEjeActividad").html("");
        $.post("./Conexiones/SelectTotalEjeActividad.php",
        {fecha:fecha},
        function (data, status) {
            if (status == "success") {
                let obj = JSON.parse(data);
                let countobj = Object.keys(obj).length;
                if (countobj > 0) {
                    $.each(obj, function (i, item) {
                      //console.log('anadiendo : '+item.total);
                        total_por_eje = parseInt(item.total);
                        $("#idTotalEjeActividad").append(item.total);
                    });
                }
                  reportes.Muestra_piniones_sin_area();
            }
        });
    },
    set_opiniones_sin_area:(total_por_area)=>{
      total_por_Area =  parseInt(total_por_area);
        //console.log("ingresando :"+total_por_Area);
    },
    Muestra_piniones_sin_area:()=>{
      //console.log("eje :"+total_por_eje+" area :"+total_por_Area);
      let sobrantes = total_por_eje - total_por_Area;
     $("#sin_area").append(sobrantes);
   },
    totalRecibidas:(fecha)=>{
        $("#opinionesRecibidas").html("");
        $.post("./Conexiones/SelectTotalRecibidas.php",
        {fecha:fecha},
        function (data, status) {
            if (status == "success") {
                let obj = JSON.parse(data);
                let countobj = Object.keys(obj).length;
                if (countobj > 0) {
                    $.each(obj, function (i, item) {
                        $("#opinionesRecibidas").append(item.total);
                    });
                }
            }
        });
    },
    totalPendientes:(fecha)=>{
        $("#opinionesPendientes").html("");
        $.post("./Conexiones/SelectTotalPendientes.php",
        {fecha:fecha},
        function (data, status) {
            if (status == "success") {
                let obj = JSON.parse(data);
                let countobj = Object.keys(obj).length;
                if (countobj > 0) {
                    $.each(obj, function (i, item) {
                        $("#opinionesPendientes").append(item.total);
                    });
                }
            }
        });
    },
    totalAtendidas:(fecha)=>{
        $("#opinionesAtendidas").html("");
        $.post("./Conexiones/SelectMetricaTotalAtendidas.php",
        {fecha:fecha},
        function (data, status) {
            if (status == "success") {
                let obj = JSON.parse(data);
                let countobj = Object.keys(obj).length;
                if (countobj > 0) {
                    $.each(obj, function (i, item) {
                        $("#opinionesAtendidas").append(item.total);
                    });
                }
            }
        });
    },
    Progresbar:()=>{
        let total=0;
        let atendidas=0;
        let progres=0
        let imprime="";
        $("#opinionesAtendidas").html("");
        $.post("./Conexiones/SelectTotalHistorico.php",
        function (data, status) {
            if (status == "success") {
                let obj = JSON.parse(data);
                let countobj = Object.keys(obj).length;
                if (countobj > 0) {
                    $.each(obj, function (i, item) {
                          total=item.Historico;
                    });
                     }
                if (total>0){
                    $.post("./Conexiones/SelectMetricaTotalAtendidas.php",
                    function (data, status) {
                        if (status == "success") {
                            let obj = JSON.parse(data);
                            let countobj = Object.keys(obj).length;
                            if (countobj > 0) {
                                $.each(obj, function (i, item) {
                                    atendidas=item.total;
                                });
                            }
                            progres=parseFloat((atendidas/total)*100).toFixed(2);

                            imprime+='<div class="progress"><div class="progress-bar progress-bar-danger progress-bar-striped bg-success" role="progressbar" style="width:'+progres+'%">'+progres+'%</div>';
                            imprime+='<div class="progress-bar progress-bar-danger progress-bar-striped bg-danger" role="progressbar" style="width:'+(100-progres)+'%">'+(100-progres)+'%</div></div>';
                            $("#progressBar").append(imprime);
                        }
                    });

                }
            }
        });


    },
    init:()=>{
        reportes.cargaInicial();
    }

    }

    $(document).ready(function () {
        $("#fechaMetricas").change(function()
        {
            fmetricas=$("#fechaMetricas").val();
            reportes.ExposicionesTemporales(fmetricas);
            reportes.tipo_opiniones(fmetricas);
            reportes.origenes_opiniones(fmetricas);
            reportes.totalHistorico(fmetricas);
            reportes.totalRecibidas(fmetricas);
            reportes.totalPendientes(fmetricas);
            reportes.totalAtendidas(fmetricas);
            newGrf.RefreshGraficaEjes();
            newGrf.RefreshGraficaArea();

        });

    reportes.init();

    });
