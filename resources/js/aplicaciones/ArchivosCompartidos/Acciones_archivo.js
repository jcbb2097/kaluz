
    function mostrar(contador) {
        var Periodo = $('#ano').val();
     if (contador == undefined) {
         var eje7 = $('#Eje').val();
        divC = document.getElementById("expo");
       if (eje7 != "") {
                divC.style.display = "";
            } else {
                divC.style.display = "none";
            }

    }else{
        var eje7 = $('#Eje' + contador).val();
            divC = document.getElementById("expo" + contador);
            if (eje7 != 0) {
                divC.style.display = "";
               $('#Expotem' + contador).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", {"expo": "expo", "Periodo": Periodo}, function (data) {
                    $(this).select();
                });

            } else {
                divC.style.display = "none";
            }
    }
    }

    function  nuevaactividad() {
    var contadorFila = $("#tamanoArt").val();
    var ano = $("#ano").val();
    var html ='<div class="row" id="actividades' + contadorFila + '">' +
    '<div class="form-group form-group-sm">'+
    '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Eje:</label>'+
    '<div class="col-md-2 col-sm-2 col-xs-2">'+
    '<select id="Eje' + contadorFila + '" class="form-control" name="Eje' + contadorFila + '" onchange="mostrar(' + contadorFila + ');actividades1(' + contadorFila + ');">' +
    '</select>' +
    '</div>'+
    '<div id="expo'+contadorFila+'">'+
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Exposición Temporal:</label>'+
    '<div class="col-md-2 col-sm-2 col-xs-2">'+
    ' <select id = "Expotem' + contadorFila + '" class = "form-control" name = "Expotem' + contadorFila + '">' +
                '<option value=""></option>' +
                ' </select>' +
    '</div>'+
    '</div>'+
    '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Actividad/Meta:</label>'+
    '<div class="col-md-2 col-sm-2 col-xs-2">'+
    '<select id = "acme' + contadorFila + '" class = "form-control" name = "acme' + contadorFila + '" onchange="actividades1(' + contadorFila + ');">' +
                '<option value = "1">Actividad</option>' +
                '<option value = "2">Meta</option>' +
                '</select>' +
    '<label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO"><button id="mas" name="mas" type="button" class="btn btn-xs" onclick="eliminaractividad(' + contadorFila + ');"><i class="glyphicon glyphicon-trash"></i></button></label>'+
    '</div>'+
    '</div>'+
    '<div class="form-group form-group-sm">'+
    '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* A/M. Global:</label>'+
    '<div class="col-md-2 col-sm-2 col-xs-2">'+
    '<select id="ActvGlobal' + contadorFila + '"class="form-control" name="ActvGlobal' + contadorFila + '" onchange="actividades2(' + contadorFila + ');">' +
                '</select>' +
    '</div>'+
    '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">A/M. General:</label>'+
    '<div class="col-md-2 col-sm-2 col-xs-2">'+
    '<select id="ActvGeneral' + contadorFila + '"class="form-control" name="ActvGeneral' + contadorFila + '" onchange="actividades3(' + contadorFila + ');">' +
                '</select>' +
    '</div>'+
    '</div>'+
     '<div class="form-group form-group-sm">'+
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">A/M. Particular:</label>'+
    '<div class="col-md-2 col-sm-2 col-xs-2">'+
    '<select id="ActvParticular' + contadorFila + '"class="form-control" name="ActvParticular' + contadorFila + '" onchange="actividades4(' + contadorFila + ');">' +
                '<option value=""></option>' +
                '</select>' +
    '</div>'+
    '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">SubActividad/Meta:</label>'+
    '<div class="col-md-2 col-sm-2 col-xs-2">'+
    '<select id="SubActividad' + contadorFila + '"class="form-control" name="SubActividad' + contadorFila + '" onchange="">' +
                '<option value=""></option>' +
                '</select>' +
    '</div>'+
    '</div>'+
    '</div>';
    //alert(contadorFila);
    $("#nuevaactividad").append(html);
    $('#Eje' + contadorFila).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", {"tipoSelect": "cargar"}, function (data) {
        $(this).select();
    });
    contadorFila++;
    //alert(contadorFila+"mas");
        $("#tamanoArt").val(contadorFila);
        }

        function eliminaractividad(id) {
        var contadorFila = $("#tamanoArt").val();
        $("#actividades" + id).remove();
        $("#actividades2" + id).remove();
        contadorFila--;
        $("#tamanoArt").val(contadorFila);

    }

    function invarea(){
        var contadorFila = $("#tamanoAreas").val();
        var area = $('#area').val();
        if ($("#invA").val() != "-" && $("#invA").val() != "<%=idProy%>" && $("#invA" + $("#invA").val()).length == 0 && $("#invA").val() != area) {
            $('#involucrados').append('<span id="areaI' + $("#invA").val() + '" class="badge badge-dark disable-select">' + $("#invA option:selected").text() + ' <i class="glyphicon glyphicon-remove" onclick="eliminarArea(' + $("#invA").val() + ')" style="font-size:13px;"></i></span>');
            $('#involucrados').append('<input id="invA' + $("#invA").val() + '" name="invitados' + contadorFila + '" value="' + $("#invA").val() + '" type="hidden">');
            contadorFila++;
            $("#tamanoAreas").val(contadorFila);
        } else {
            alert('El Área ya fue agregada o es el Área que convoca');
        }
    }
    function eliminarArea(am) {
        var contadorFila = $("#tamanoAreas").val();
        $("#areaI" + am).remove();
        $("#invA" + am).remove();
        contadorFila--;
        $("#tamanoAreas").val(contadorFila);
    }
    function actividades1(contador) {
        if (contador == undefined) {
            //alert('entra al if'+contador);
            console.log("entrando a act 1");
            var Eje = $('#Eje').val();
            var Tipo_actividad = $('#acme').val();
            var Periodo = $('#ano').val();

            $('#ActvGlobal').load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", {"tipoSelect": "Actividades", "Eje": Eje, "tipo": Tipo_actividad,"Periodo":Periodo}, function (data) {
                $(this).select();
            });
            $('#entregable_act_glob').html("");
            $('#ActvGeneral').html("");$('#entregable_act_gen').html("");
            $('#ActvParticular').html("");$('#entregable_act_part').html("");
            $('#SubActividad').html("");$('#entregable_subact').html("");
        }else{
          //  alert('entra al else'+contador);
            var Eje = $('#Eje'+contador).val();
            var Tipo_actividad = $('#acme'+contador).val();
            var Periodo = $('#ano').val();
            $('#ActvGlobal' + contador).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", {"tipoSelect": "Actividades", "Eje": Eje, "tipo": Tipo_actividad,"Periodo":Periodo}, function (data) {
                $(this).select();
            });
            $('#entregable_act_glob'+contador).html("");
            $('#ActvGeneral'+contador).html("");$('#entregable_act_gen'+contador).html("");
            $('#ActvParticular'+contador).html("");$('#entregable_act_part'+contador).html("");
            $('#SubActividad'+contador).html("");$('#entregable_subact'+contador).html("");

        }
    }
    function actividades2(contador) {
        if (contador == undefined) {
            var ActvG = $('#ActvGlobal').val();
            var text = $('#ActvGlobal option:selected').html();
            $('#ActvGeneral').load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", {"General": "General", "actividad2": ActvG, "text": text}, function (data) {
                $(this).select();
            });
            $('#entregable_act_gen').html("");
            $('#ActvParticular').html("");$('#entregable_act_part').html("");
            $('#SubActividad').html("");$('#entregable_subact').html("");
        } else {
            if ($('#ActvG' + contador).val() == undefined) {
                var ActvG = $('#ActvGlobal'+ contador).val();
            }else{
                var ActvG = $('#ActvG' + contador).val();
            }
            if ($('#ActvG' + contador).val() == undefined) {
                var text = $('#ActvGlobal'+ contador+' option:selected').html();
            }else{
                var text = $('#ActvG' + contador + ' option:selected').html();
            }
            //alert(ActvG);
            $('#ActvGeneral' + contador).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", {"General": "General", "actividad2": ActvG, "text": text}, function (data) {
                $(this).select();
            });
            $('#entregable_act_gen'+contador).html("");
            $('#ActvParticular'+contador).html("");$('#entregable_act_part'+contador).html("");
            $('#SubActividad'+contador).html("");$('#entregable_subact'+contador).html("");
        }
    }
    function actividades3(contador) {
        if (contador == undefined) {
            var ActvG = $('#ActvGeneral').val();
            var text = $('#ActvGeneral option:selected').html();
            $('#ActvParticular').load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", {"Particular": "Particular", "actividad3": ActvG, "text": text}, function (data) {
                $(this).select();
            });
            $('#entregable_act_part').html("");
            $('#SubActividad').html("");$('#entregable_subact').html("");
        } else {
            if ($('#ActvGe' + contador).val() == undefined) {
                var ActvG = $('#ActvGeneral'+ contador).val();
            }else{
                var ActvG = $('#ActvGe' + contador).val();
            }
            if ($('#ActvGe' + contador).val() == undefined) {
                var text = $('#ActvGeneral'+ contador+' option:selected').html();
            }else{
                var text = $('#ActvGe' + contador + ' option:selected').html();
            }
            $('#ActvParticular' + contador).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", {"Particular": "Particular", "actividad3": ActvG, "text": text}, function (data) {
                $(this).select();
            });
            $('#entregable_act_part'+contador).html("");
            $('#SubActividad'+contador).html("");$('#entregable_subact'+contador).html("");
        }
    }
    function actividades4(contador) {
        if (contador == undefined) {
            var ActvG = $('#ActvParticular').val();
            var text = $('#ActvParticular option:selected').html();
            $('#SubActividad').load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", {"SubActividad": "SubActividad", "actividad5": ActvG, "text": text}, function (data) {
                $(this).select();
            });
            $('#entregable_subact').html("");
        } else {
             if ($('#actP' + contador).val() == undefined) {
                var ActvG = $('#ActvParticular'+ contador).val();
            }else{
                var ActvG = $('#actP' + contador).val();
            }
            if ($('#actP' + contador).val() == undefined) {
                var text = $('#ActvParticular'+ contador+' option:selected').html();
            }else{
                var text = $('#actP' + contador + ' option:selected').html();
            }
            $('#SubActividad' + contador).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", {"SubActividad": "SubActividad", "actividad5": ActvG, "text": text}, function (data) {
                $(this).select();
            });
            $('#entregable_subact'+contador).html("");


        }
    }
