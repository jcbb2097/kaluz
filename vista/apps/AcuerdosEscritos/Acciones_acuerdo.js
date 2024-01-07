$(document).ready(function () {
    var fecha = new Date(); //Fecha actual
    var mes = fecha.getMonth() + 1; //obteniendo mes
    var dia = fecha.getDate(); //obteniendo dia
    var ano = fecha.getFullYear(); //obteniendo año
    if (dia < 10)
        dia = '0' + dia; //agrega cero si el menor de 10
    if (mes < 10)
        mes = '0' + mes //agrega cero si el menor de 10
    var contador = 0;
    var accion = $('#accion').val();
    var accion2 = $('#ons').val();

    if (accion == 'guardar') {
        $("#fechaf").prop('disabled', true);
        $("#realizado").change(function () {
            contador++;
            if (contador == 1) {
                $("#fechaf").prop('disabled', false);
                $("#fechaf").val(ano + "-" + mes + "-" + dia);
            } else {
                $("#fechaf").val("");
                $("#fechaf").prop('disabled', true);

                contador = 0;
            }
        });
    } else if (accion == 'editar' && accion2 == 1) {
        //alert('fer1');
        $("#fechaf").prop('disabled', false);
        $("#realizado").change(function () {
            //  alert('fer2');
            $("#fechaf").val("");
            $("#fechaf").prop('disabled', true);
        });
    } else if (accion == 'editar' && accion2 == 0) {
        //alert('fer3');
        $("#fechaf").prop('disabled', true);
        $("#realizado").change(function () {
            $("#fechaf").val(ano + "-" + mes + "-" + dia);
            $("#fechaf").prop('disabled', false);
            //alert('fer4');
        });
    }


});


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

    } else {
        var eje7 = $('#Eje' + contador).val();
        divC = document.getElementById("expo" + contador);
        if (eje7 != 0) {
            divC.style.display = "";
            $('#Expotem' + contador).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "expo": "expo", "Periodo": Periodo }, function (data) {
                $(this).select();
            });

        } else {
            divC.style.display = "none";
        }
    }
}

function nuevaactividad() {
    var contadorFila = $("#tamanoArt").val();

    var html = '<div id="actividades' + contadorFila + '">' +
        '<hr style="display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0; border-top: 1px solid black;">'+
        '<div class="form-group form-group-sm">' +
        '<input type="hidden" id="id_edit" name="id_edit" value="1"/>'+
        '<label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO"><button id="mas" name="mas" type="button" class="btn btn-xs" onclick="eliminaractividad(' + contadorFila + ');"><i class="glyphicon glyphicon-trash"></i></button></label>' +
        '</div>' +
        '<div class="form-group form-group-sm" style="margin-top: -12px;">' +
        '<label class="col-md-3 col-sm-3 col-xs-3  control-label" for="AÑO" style="width: 152px; font-size: 11px;">* Descripción Acuerdo:</label>' +
        '<div class="col-md-10 col-sm-10 col-xs-10" style="width: 728px;">' +
        '<textarea class="form-control" id="descripcionacuerdo' + contadorFila + '" name="descripcionacuerdo' + contadorFila + '" rows="3" style="height: 100px; width: 500px; font-size: 11px;" maxlength="1000"></textarea>' +
        '</div>' +
        '</div>' +
        '<div class="form-group form-group-sm" style="margin-top: -12px;"> ' +
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">* Actividad/Meta:</label>' +
        '<div class="col-md-4 col-sm-4 col-xs-4">' +
        '<select id="acme' + contadorFila + '" class="form-control" name="acme' + contadorFila + '" onchange="actividades11('+contadorFila+');actividades111('+contadorFila+');" style="width: 260px; font-size: 11px;">' +
        '<option value="1">Actividad</option>' +
        '<option value="2">Meta</option>' +
        '</select>' +
        '</div>' +
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="width: 152px; font-size: 11px;">* Tipo Acuerdo:</label>' +
        '<div class="col-md-2 col-sm-2 col-xs-2">' +
        '<select id="tipoacuerdo' + contadorFila + '" class="form-control" name="tipoacuerdo' + contadorFila + '"  style="width: 240px; font-size: 11px;">' +
        '<option value="">Seleccione</option>' +
        '<option value="Conocimiento">Conocimiento</option>' +
        '<option value="Problemática">Problemática</option>' +
        '<option value="Solicitud">Solicitud</option>' +
        '<option value="Sugerencia">Sugerencia</option>' +
        '</select>' +
        '</div>' +
        '</div>' +
        '<div class="form-group form-group-sm" style="margin-top: -12px;">' +
        '<label class="col-md-3 col-sm-3 col-xs-3  control-label" for="AÑO" style="width: 152px; font-size: 11px;">* Eje:</label>' +
        '<div class="col-md-4 col-sm-4 col-xs-4">' +
        '<select id="Eje' + contadorFila + '" class="form-control" style="width: 260px; font-size: 11px;" name="Eje' + contadorFila + '" onchange="Categorias(' + contadorFila + ');actividades1(' + contadorFila + ');">' +
        '</select>' +
        '</div>' +
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">Categoría:</label>' +
        '<div class="col-md-2 col-sm-2 col-xs-2">' +
        '<select id="cate' + contadorFila + '" class="form-control" name="cate' + contadorFila + '" onchange="Sub_Categorias(' + contadorFila + ');actividades11('+contadorFila+');" style="width: 240px; font-size: 11px;">' +
        '<option value="">Seleccione</option>' +
        '</select>' +
        '</div>' +
        '</div>' +
        '<div class="form-group form-group-sm" style="margin-top: -12px;">' +
        '<label class="col-md-3 col-sm-3 col-xs-3  control-label" for="AÑO" style="width: 152px; font-size: 11px;">Sub categoría:</label>' +
        '<div class="col-md-4 col-sm-4 col-xs-4">' +
        '<select id="subcate' + contadorFila + '" class="form-control" name="subcate' + contadorFila + '" onchange="actividades111('+contadorFila+');" style="width: 260px; font-size: 11px;">' +
        '<option value="">Seleccione</option>' +
        '</select>' +
        '</div>' +
        '</div>' +

        '<div class="form-group form-group-sm" style="margin-top: -12px; display: none;">' +
        '<label class="col-md-3 col-sm-3 col-xs-3  control-label" for="AÑO" style="width: 152px; font-size: 11px;">Exposición Temporal:</label>' +
        '<div class="col-md-2 col-sm-2 col-xs-2">' +
        '<select id="Expotem' + contadorFila + '" class="form-control" name="Expotem' + contadorFila + '" style="width: 700px; font-size: 11px;">' +
        '<option value="">Seleccione</option>' +
        '</select>' +
        '</div>' +
        '</div>' +
        '<div class="form-group form-group-sm" style="margin-top: -12px;">' +
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">* Global:</label>' +
        '<div class="col-md-2 col-sm-2 col-xs-2">' +
        '<select id="ActvGlobal' + contadorFila + '"class="form-control" name="ActvGlobal' + contadorFila + '" onchange="actividades2(' + contadorFila + ');checklist(' + contadorFila + ');responsableactividad(' + contadorFila + ');" style="width: 700px; font-size: 11px;">' +
        '</select>' +
        '</div>' +
         '</div>' +
         '<div class="form-group form-group-sm" style="margin-top: -12px;">' +
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">General:</label>' +
        '<div class="col-md-2 col-sm-2 col-xs-2">' +
        '<select id="ActvGeneral' + contadorFila + '"class="form-control" name="ActvGeneral' + contadorFila + '" onchange="actividades3(' + contadorFila + ');checklist(' + contadorFila + ');responsableactividad(' + contadorFila + ');" style="width: 700px;">' +
        '</select>' +
        '</div>' +
        '</div>' +
        '<div class="form-group form-group-sm" style="display:none; margin-top: -12px;">' +
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">Particular:</label>' +
        '<div class="col-md-2 col-sm-2 col-xs-2">' +
        '<select id="ActvParticular' + contadorFila + '"class="form-control" name="ActvParticular' + contadorFila + '" onchange="actividades4(' + contadorFila + ');" style="width: 700px; font-size: 11px;">' +
        '<option value=""></option>' +
        '</select>' +
        '</div>' +
        '</div>' +
        '<div class="form-group form-group-sm" style="display:none; margin-top: -12px;">' +
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">SubActividad/Meta:</label>' +
        '<div class="col-md-2 col-sm-2 col-xs-2">' +
        '<select id="SubActividad' + contadorFila + '"class="form-control" name="SubActividad' + contadorFila + '" onchange="" style="width: 700px; font-size: 11px;">' +
        '<option value=""></option>' +
        '</select>' +
        '</div>' +
        '</div>' +

        '<div class="form-group form-group-sm" style="margin-top: -12px;">' +
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">Check:</label>' +
        '<div class="col-md-2 col-sm-2 col-xs-2">' +
        '<select id="check' + contadorFila + '" class="form-control" name="check' + contadorFila + '" onchange="subchecklist(' + contadorFila + ');responsablecheck(' + contadorFila + ');" style="width: 700px; font-size: 11px;">'+
        '<option value=""></option>' +
        '</select>' +
        '</div>' +
        '</div>' +

        '<div class="form-group form-group-sm" style="margin-top: -12px; display: none;" id="ocultaSubcheck'+ contadorFila +'">' +
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">SubCheck:</label>' +
        '<div class="col-md-2 col-sm-2 col-xs-2">' +
        '<select id="Subcheck' + contadorFila + '" class="form-control" name="Subcheck' + contadorFila + '" onchange="responsablecheck(' + contadorFila + ');"  style="width: 700px; font-size: 11px;">'+
        '<option value=""></option>' +
        '</select>' +
        '</div>' +
        '</div>' +

        '<div class="form-group form-group-sm" style="margin-top: -12px;">' +
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">Acuerdo estatus:</label>' +
        '<div class="col-md-2 col-sm-2 col-xs-2">' +
        '<select id="acuerdoestatus' + contadorFila + '" class="form-control" name="acuerdoestatus' + contadorFila + '" style="width: 700px; font-size: 11px;">'+
        '<option value=""></option>' +
        '</select>' +
        '</div>' +
        '</div>' +
        
        '<div class="form-group form-group-sm" style="margin-top: -12px;">' +
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">Receptor del acuerdo:</label>' +
        '<div class="col-md-2 col-sm-2 col-xs-2">' +
        '<select id="responsableacuerdo' + contadorFila + '" class="form-control" name="responsableacuerdo' + contadorFila + '" style="width: 700px; font-size: 11px;">'+
        '<option value=""></option>' +
        '</select>' +
        '</div>' +
        '</div>' +

        '<div class="form-group form-group-sm" style="margin-top: -12px;">' +
           '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="Fechac" style="font-size: 11px; ">* Fecha compromiso:</label>' +
           '<div class="col-md-3 col-sm-3 col-xs-3">' +
              '<input id="fechares" name="fechares" type="date" style="width: 170px;" class="form-control" style="font-size: 11px; " value="">' +
           '</div>' +  
        '</div>' +
        
        '<div class="form-group form-group-sm" style="margin-top: -12px;">' +
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion" style="font-size: 11px;">Resolución:</label>' +
        '<div class="col-md-9 col-sm-9 col-xs-9">' +
        '<textarea class="form-control" id="resolucion' + contadorFila + '" name="resolucion' + contadorFila + '" rows="2" style="height: 70px; width: 700px; font-size: 11px;"></textarea>' +
        '</div>' +
        '<label class="col-md-4 col-sm-4 col-xs-4  control-label" for="AÑO" style="display:none">Realizado:</label>' +
        '<div class="col-md-2 col-sm-2 col-xs-2">' +
        '<input type="checkbox" class="custom-control-input" id="realizadoact' + contadorFila + '" name="realizadoact' + contadorFila + '" style="display:none">' +
        '</div>' +
        '</div>' +

       /* '<div class="form-group form-group-sm">' +
        '<div class="col-md-2 col-sm-2 col-xs-2">' +
        '</div>' +
        '<div class="col-md-6 col-sm-6 col-xs-6">' +
        '<button type="button" class="btn btn-default btn-xs" id="guardar" onClick="CKupdate();">Guardar</button>' +
        '</div>' +
        '</div>' + */

        '</div>';
    //alert(contadorFila);
    $("#nuevaactividad").append(html);
    $('#Eje' + contadorFila).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "tipoSelect": "cargar" }, function (data) {
        $(this).select();
    });
    $('#Expotem' + contadorFila).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "exposicion": "exposicion" }, function (data) {
        $(this).select();
    });
    $('#acuerdoestatus' + contadorFila).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "acuerdoestatus": "acuerdoestatus" }, function (data) {
        $(this).select();
    });
    $('#responsableacuerdo' + contadorFila).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "responsableacuerdo": "responsableacuerdo" }, function (data) {
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

function invarea() {
    var contadorFila = $("#tamanoAreas").val();
    var area = $('#area').val();
    if ($("#invA").val() != "-" && $("#invA").val() != "<%=idProy%>" && $("#invA" + $("#invA").val()).length == 0) {
        $('#involucrados').append('<span id="areaI' + $("#invA").val() + '" class="badge badge-dark disable-select">' + $("#invA option:selected").text() + ' <i class="glyphicon glyphicon-remove" onclick="eliminarArea(' + $("#invA").val() + ')" style="font-size:13px;"></i></span>');
        $('#involucrados').append('<input id="invA' + $("#invA").val() + '" name="invitados' + contadorFila + '" value="' + $("#invA").val() + '" type="hidden">');
        contadorFila++;
        $("#tamanoAreas").val(contadorFila);
    } else {
        alert('El Área ya fue agregada o es el Área que convoca');
    }
}

function eliminarArea(am,id) {
    var contadorFila = $("#tamanoAreas").val();
    $("#areaI" + am).remove();
    $("#invA" + am).remove();
    console.log(am +" "+id);
    contadorFila--;
    $("#tamanoAreas").val(contadorFila);
    window.open("eliminarareas.php?areainvitada="+am+"&idacuerdo="+id, '_blank');
}

function actividades1(contador) {
    if (contador == undefined) {
        //alert('entra al if'+contador);
        var Eje = $('#Eje').val();
        var Tipo_actividad = $('#acme').val();
        var Periodo = $('#ano').val();
        var App = 1;
        $('#ActvGlobal').load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "tipoSelect": "Actividades", "Eje": Eje, "tipo": Tipo_actividad, "Periodo": Periodo, "App": App }, function (data) {
            $(this).select();
        });
        $('#ActvGeneral').html("");
        $('#ActvParticular').html("");
        $('#SubActividad').html("");
    } else {
        //  alert('entra al else'+contador);
        var Eje = $('#Eje' + contador).val();
        var Tipo_actividad = $('#acme' + contador).val();
        var Periodo = $('#ano').val();
        $('#ActvGlobal' + contador).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "tipoSelect": "Actividades", "Eje": Eje, "tipo": Tipo_actividad, "Periodo": Periodo }, function (data) {
            $(this).select();
        });
        $('#ActvGeneral' + contador).html("");
        $('#ActvParticular' + contador).html("");
        $('#SubActividad' + contador).html("");
    }
}

function actividades2(contador) {
    if (contador == undefined) {
        var ActvG = $('#ActvGlobal').val();
        var Periodo = $('#ano').val();
        var cate = $('#cate').val();
        var subcate = $('#subcate').val();
        if(subcate =! ""){
            var categoriaConsulta = $('#subcate').val();
        }else {
            var categoriaConsulta = $('#cate').val();
        }
        var text = $('#ActvGlobal option:selected').html();
        $('#ActvGeneral').load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "General": "General", "actividad2": ActvG, "text": text, "Periodo": Periodo,  "Cate" : categoriaConsulta  }, function (data) {
            $(this).select();
            var ActvGeneralN = $('#ActvGeneral option').length; 
            if (ActvGeneralN > 1) {
                $('#ActvGeneral').prop('disabled', false);
            } else {
                $('#ActvGeneral').prop('disabled', true);
            }      
        });
    
        $('#check').html("");
        $('#Subcheck').html("");
    } else {
        var ActvG = $('#ActvGlobal' + contador).val();
        var Periodo = $('#ano').val();
        var cate = $('#cate' + contador).val();
        var subcate = $('#subcate' + contador).val();
        if(subcate =! ""){
            var categoriaConsulta = $('#subcate' + contador).val();
        }else {
            var categoriaConsulta = $('#cate' + contador).val();
        }
        var text = $('#ActvGlobal' + contador + ' option:selected').html();
        $('#ActvGeneral' + contador).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "General": "General", "actividad2": ActvG, "text": text,"Periodo": Periodo, "Cate" : categoriaConsulta }, function (data) {
            $(this).select();

            var ActvGeneralN = $('#ActvGeneral' + contador + ' option').length; 
            if (ActvGeneralN > 1) {
                $('#ActvGeneral' + contador).prop('disabled', false);
            } else {
                $('#ActvGeneral' + contador).prop('disabled', true);
            }  
        });

 

        $('#check'+contador).html("");
        $('#Subcheck'+contador).html("");
    }
}

function actividades3(contador) {
    if (contador == undefined) {
        var ActvG = $('#ActvGeneral').val();
        var Periodo = $('#ano').val();
        var text = $('#ActvGeneral option:selected').html();
        $('#ActvParticular').load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "Particular": "Particular", "actividad3": ActvG, "text": text,"Periodo": Periodo }, function (data) {
            $(this).select();
        });
    } else {
        var ActvG = $('#ActvGeneral' + contador).val();
        var Periodo = $('#ano').val();
        var text = $('#ActvGeneral' + contador + ' option:selected').html();
        $('#ActvParticular' + contador).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "Particular": "Particular", "actividad3": ActvG, "text": text,"Periodo": Periodo }, function (data) {
            $(this).select();
        });
    }
}
function actividades4(contador) {
    if (contador == undefined) {
        var ActvG = $('#ActvParticular').val();
        var Periodo = $('#ano').val();
        var text = $('#ActvParticular option:selected').html();
        $('#SubActividad').load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "SubActividad": "SubActividad", "actividad5": ActvG, "text": text,"Periodo": Periodo }, function (data) {
            $(this).select();
        });
    } else {
        var ActvG = $('#ActvParticular' + contador).val();
        var Periodo = $('#ano').val();
        var text = $('#ActvParticular' + contador + ' option:selected').html();
        $('#SubActividad' + contador).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "SubActividad": "SubActividad", "actividad5": ActvG, "text": text,"Periodo": Periodo }, function (data) {
            $(this).select();
        });


    }
}

function Categorias(contador) {
    if (contador == undefined) {
        var eje = $('#Eje').val();
        var anio = "14";//$('#ano').val();
        $('#cate').load("../../../WEB-INF/Controllers/Entregables/Acciones_entregables.php", {
            eje: eje,
            anio: anio,
            categorias: 'categorias'
        }, function (data) {
            $(this).select();
        });
        $('#subcate').html("");
    } else {
        var eje = $('#Eje' + contador).val();
        var anio = "14";//$('#ano').val();
        $('#cate' + contador).load("../../../WEB-INF/Controllers/Entregables/Acciones_entregables.php", {
            eje: eje,
            anio: anio,
            categorias: 'categorias'
        }, function (data) {
            $(this).select();
        });
        $('#subcate' + contador).html("");
    }
}

function Sub_Categorias(contador) {
    if (contador == undefined) {
        var cate = $('#cate').val();
        var anio = $('#ano').val();
        $('#subcate').load("../../../WEB-INF/Controllers/Entregables/Acciones_entregables.php", {
            cate: cate,
            anio: anio,
            subcate: 'subcate'
        }, function (data) {
            $(this).select();
        });
    } else {
        var cate = $('#cate' + contador).val();
        var anio = $('#ano').val();
        $('#subcate' + contador).load("../../../WEB-INF/Controllers/Entregables/Acciones_entregables.php", {
            cate: cate,
            anio: anio,
            subcate: 'subcate'
        }, function (data) {
            $(this).select();
        });
    }
}





//Buscar por categoria llenar Global
function actividades11(contador) {
    if (contador == undefined) {
        //alert('entra al if'+contador);
        var Eje = $('#Eje').val();
        var Tipo_actividad = $('#acme').val();
        var Periodo = $('#ano').val();
        var categoria = $('#cate').val();
        var App = 1;
        $('#ActvGlobal').load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "Ejecate": Eje, "tipo": Tipo_actividad, "Periodo": Periodo, "Categoria": categoria, "App": App }, function (data) {
            $(this).select();
        });
        $('#ActvGeneral').html("");
        $('#ActvParticular').html("");
        $('#SubActividad').html("");
    } else {
        //  alert('entra al else'+contador);
        var Eje = $('#Eje' + contador).val();
        var Tipo_actividad = $('#acme' + contador).val();
        var Periodo = $('#ano').val();
        var categoria = $('#cate' + contador).val();
        $('#ActvGlobal' + contador).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "Ejecate": Eje, "tipo": Tipo_actividad, "Periodo": Periodo, "Categoria": categoria }, function (data) {
            $(this).select();
        });
        $('#ActvGeneral' + contador).html("");
        $('#ActvParticular' + contador).html("");
        $('#SubActividad' + contador).html("");
    }
}



//Buscar por subcategoria llenar Global
function actividades111(contador) {
    console.log(contador);
    console.log(contador);
    if (contador == undefined) {
        //alert('entra al if'+contador);
        var Tipo_actividad = $('#acme').val();
        var Periodo = $('#ano').val();
        var categoria = $('#subcate').val();
        var App = 1;
        $('#ActvGlobal').load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "tipo": Tipo_actividad,"Periodo": Periodo, "SubCategoria": categoria, "App": App }, function (data) {
            $(this).select();
        });
        $('#ActvGeneral').html("");
        $('#ActvParticular').html("");
        $('#SubActividad').html("");
    } else {
        //  alert('entra al else'+contador);
        var Tipo_actividad = $('#acme' + contador).val();
        var Periodo = $('#ano').val();
        var categoria = $('#subcate' + contador).val();
        console.log(contador);
        $('#ActvGlobal' + contador).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "tipo": Tipo_actividad,"Periodo": Periodo, "SubCategoria": categoria }, function (data) {
            $(this).select();
        });
        $('#ActvGeneral' + contador).html("");
        $('#ActvParticular' + contador).html("");
        $('#SubActividad' + contador).html("");
    }
}


function actividadesmetaactividadglobal(contador) {
    if (contador == undefined) {
        //alert('entra al if'+contador);
        var Eje = $('#Eje').val();
        var Tipo_actividad = $('#acme').val();
        var Periodo = $('#ano').val();
        var App = 1;
        $('#ActvGlobal').load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "Ejeact": Eje, "tipo": Tipo_actividad, "Periodo": Periodo, "App": App }, function (data) {
            $(this).select();
        });
        $('#ActvGeneral').html("");
        $('#ActvParticular').html("");
        $('#SubActividad').html("");
        $('#cate').html("");
        $('#subcate').html("");
    } else {
        //  alert('entra al else'+contador);
        var Eje = $('#Eje' + contador).val();
        var Tipo_actividad = $('#acme' + contador).val();
        var Periodo = $('#ano').val();
        $('#ActvGlobal' + contador).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "Ejeact": Eje, "tipo": Tipo_actividad, "Periodo": Periodo}, function (data) {
            $(this).select();
        });
        $('#ActvGeneral' + contador).html("");
        $('#ActvParticular' + contador).html("");
        $('#SubActividad' + contador).html("");
        $('#cate' + contador).html("");
        $('#subcate' + contador).html("");
    }
}


//para mostrar el check desde general y global
function checklist(contador) {
    if (contador == undefined) {
        var ActvG = $('#ActvGeneral').val();
        var ActvGlo = $('#ActvGlobal').val();
        var cate = $('#cate').val();
        var subcate = $('#subcate').val();
        if(subcate =! "0"){
            var categoriaConsulta = $('#subcate').val();
        }else {
            var categoriaConsulta = $('#cate').val();
        }
        var actividad;
        if (ActvG > 0) {
            actividad = ActvG;
        } else {
            actividad = ActvGlo;
        }
        var Periodo = $('#ano').val();
        var text = $('#check option:selected').html();
        $('#check').load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "check": "check", "actividad3": actividad, "Periodo": Periodo, "text": text, "Cate" : categoriaConsulta }, function (data) {
            $(this).select();
            var checkN = $('#check option').length; 
            if (checkN > 1) {
                $('#check').prop('disabled', false);
            } else {
                $('#check').prop('disabled', true);
            }   
        });
    } else {
        var ActvG = $('#ActvGeneral' + contador).val();
        var ActvGlo = $('#ActvGlobal' + contador).val();
        var cate = $('#cate' + contador).val();
        var subcate = $('#subcate' + contador).val();
        if(subcate =! "0" ){
            var categoriaConsulta = $('#subcate' + contador).val();
        }else {
            var categoriaConsulta =  $('#cate' + contador).val();
        }
        var actividad;
        if (ActvG > 0) {
            actividad = ActvG;
        } else {
            actividad = ActvGlo;
        }
        var Periodo = $('#ano').val();
        var text = $('#check' + contador + ' option:selected').html();
        $('#check' + contador).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "check": "check", "actividad3": actividad, "Periodo": Periodo, "text": text, "Cate" : categoriaConsulta }, function (data) {
            $(this).select();
            var checkN = $('#check' + contador + ' option').length; 
            if (checkN > 1) {
                $('#check' + contador).prop('disabled', false);
            } else {
                $('#check' + contador).prop('disabled', true);
            }  
        });
    }
}

//mostrar el subcheck
function subchecklist(contador) {
    if (contador == undefined) {
        var ActvG = $('#ActvGeneral').val();
        var ActvGlo = $('#ActvGlobal').val();
        var Check = $('#check').val();
        var Periodo = $('#ano').val();
        var cate = $('#cate').val();
        var subcate = $('#subcate').val();
        if(subcate =! "0" ){
            var categoriaConsulta = $('#subcate').val();
        }else {
            var categoriaConsulta = $('#cate').val();
        }
        var actividad;
        if (ActvG > 0) {
            actividad = ActvG;
        } else {
            actividad = ActvGlo;
        }
        var text = $('#Subcheck option:selected').html();
        $('#Subcheck').load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "Subcheck": "Subcheck", "actividad5": actividad,"Periodo": Periodo,"checklist": Check, "text": text, "Cate" : categoriaConsulta }, function (data) {
            $(this).select();
            var Subcheck = $('#Subcheck option').length; 
            if (Subcheck > 1) {
                subcheckmuestra()
                $('#Subcheck').prop('disabled', false);
            } else {
                subcheckoculta()
                $('#Subcheck').prop('disabled', true);
            }        
        });
    } else {
        var ActvG = $('#ActvGeneral' + contador).val();
        var ActvGlo = $('#ActvGlobal' + contador).val();
        var Check = $('#check' + contador).val();
        var Periodo = $('#ano').val();
        var cate = $('#cate' + contador).val();
        var subcate = $('#subcate' + contador).val();
        if(subcate =! "0"){
            var categoriaConsulta = $('#subcate' + contador).val();
        }else {
            var categoriaConsulta = $('#cate' + contador).val();
        }
        var actividad;
        if (ActvG > 0) {
            actividad = ActvG;
        } else {
            actividad = ActvGlo;
        }
        var text = $('#Subcheck' + contador + ' option:selected').html();
        $('#Subcheck' + contador).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "Subcheck": "Subcheck", "actividad5": actividad,"Periodo": Periodo,"checklist": Check, "text": text, "Cate" : categoriaConsulta }, function (data) {
            $(this).select();
            var Subcheck = $('#Subcheck' + contador + ' option').length; 
            if (Subcheck > 1) {
              //  subcheckmuestrac(contador)
                $('#Subcheck' + contador).prop('disabled', false);
            } else {
              //  subcheckocultac(contador)
                $('#Subcheck' + contador).prop('disabled', true);
            }       
        });
    }
}

function subcheckmuestra() {
    var subcheck = document.getElementById("ocultaSubcheck");
    subcheck.style.display = "block";    
}
function subcheckoculta() {
    var subcheck = document.getElementById("ocultaSubcheck");
    subcheck.style.display = "none";    
}
function subcheckmuestrac(contador) {
    var subcheckc = document.getElementById("ocultaSubcheck" + contador);
    subcheckc.style.display = "block";    
}
function subcheckocultac(contador) {
    var subcheckc = document.getElementById("ocultaSubcheck" + contador);
    subcheckc.style.display = "none";    
}

//mostrar el responsable por general o global
function responsableactividad(contador) {
    if (contador == undefined) {
        var ActvG = $('#ActvGeneral').val();
        var ActvGlo = $('#ActvGlobal').val();
        var Check = $('#check').val();
        var SubCheck = $('#Subcheck').val();
        var Periodo = $('#ano').val();
        var actividad;
        if (ActvG > 0) {
            actividad = ActvG;
        } else {
            actividad = ActvGlo;
        }
        var text = $('#responsableacuerdo option:selected').html();
        $('#responsableacuerdo').load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "responsableactividad": "responsableactividad", "actividad10": actividad,"Periodo": Periodo,"checklist": Check,"subchecklist": SubCheck, "text": text }, function (data) {
            $(this).select();
        });
    } else {
        var ActvG = $('#ActvGeneral' + contador).val();
        var ActvGlo = $('#ActvGlobal' + contador).val();
        var Check = $('#check' + contador).val();
        var SubCheck = $('#Subcheck'+contador).val();
        var Periodo = $('#ano').val();
        var actividad;
        if (ActvG > 0) {
            actividad = ActvG;
        } else {
            actividad = ActvGlo;
        }
        var text = $('#responsableacuerdo' + contador + ' option:selected').html();
        $('#responsableacuerdo' + contador).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "responsableactividad": "responsableactividad", "actividad10": actividad,"Periodo": Periodo,"checklist": Check,"subchecklist": SubCheck, "text": text }, function (data) {
            $(this).select();
        });
    }
}


//mostrar el responsable por general o global
function responsablecheck(contador) {
    if (contador == undefined) {
        var ActvG = $('#ActvGeneral').val();
        var ActvGlo = $('#ActvGlobal').val();
        var Check = $('#check').val();
        var SubCheck = $('#Subcheck').val();
        var Periodo = $('#ano').val();
        var actividad;
        if (SubCheck > 0) {
            actividad = SubCheck;
        } else {
            actividad = Check;
        }
        var text = $('#responsableacuerdo option:selected').html();
        $('#responsableacuerdo').load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "responsablechecklist": "responsablechecklist", "actividad11": actividad,"Periodo": Periodo,"checklist": Check,"subchecklist": SubCheck, "text": text }, function (data) {
            $(this).select();
        });
    } else {
        var ActvG = $('#ActvGeneral' + contador).val();
        var ActvGlo = $('#ActvGlobal' + contador).val();
        var Check = $('#check' + contador).val();
        var SubCheck = $('#Subcheck'+contador).val();
        var Periodo = $('#ano').val();
        var actividad;
        if (SubCheck > 0) {
            actividad = SubCheck;
        } else {
            actividad = Check;
        }
        var text = $('#responsableacuerdo' + contador + ' option:selected').html();
        $('#responsableacuerdo' + contador).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "responsablechecklist": "responsablechecklist", "actividad11": actividad,"Periodo": Periodo,"checklist": Check,"subchecklist": SubCheck, "text": text }, function (data) {
            $(this).select();
        });
    }
}

function eliminaractividadedit(Id) {
    //var con = "'"+controller+"'";
    
    $.confirm({
        icon: 'glyphicon glyphicon-minus-sign',
        title: '¿Desea eliminar el registro?',
        content: 'No podrás revertir los cambios',
        autoClose: 'cancelar|8000',
        type: 'dark',
        typeAnimated: true,
        buttons:
        {
            aceptar:
            {
                btnClass: 'btn-dark',
                action: function () {
                    var contadorFila = $("#tamanoArt").val();
                    contadorFila--;
                    //alert(contadorFila);
                    var contadorFilas= $("#tamanoArtedit").val();
                    contadorFilas--;
                    $.post('../../../WEB-INF/Controllers/AcuerdosEscritos/Controler_acuerdos.php', { id: Id, accion: "eliminaractividadedit", tamanoArt: contadorFila, tamanoArtedit: contadorFilas }, function (data) {
                        if (data.toString().indexOf("Error:") === -1) {
                            //$.dialog(data);
                            $.confirm({
                                icon: 'glyphicon glyphicon-ok-sign',
                                title: data,
                                content: '',
                                type: 'dark',
                                buttons:
                                {
                                    aceptar:
                                    {
                                        action: function () {
                                            location.reload();
                                        }

                                    }
                                }
                            });
                            //location.reload();
                        } else {
                            $.confirm({
                                icon: 'glyphicon glyphicon-remove-sign',
                                title: data,
                                content: '',
                                type: 'red',
                                buttons:
                                {
                                    aceptar:
                                    {
                                        action: function () {
                                            location.reload();
                                        }

                                    }
                                }
                            });
                            //$.dialog(data);
                        }
                        //location.reload();
                    });
                }
            },
            cancelar: function () {
                //$.alert('Cancelado!');
            }
        }
    });
}

function guardaunAcuerdo(id) {
    var idacuerdo = $('#idacuerdo'+id).val();
    var undescripcionacuerdo = $('#descripcionacuerdo'+id).val();
    var unacme = $('#acme'+id).val();
    var untipoacuerdo = $('#tipoacuerdo'+id).val();
    var unEje = $('#Eje'+id).val();
    var uncate = $('#cate'+id).val();
    var unExpotem = $('#Expotem'+id).val();
    var unActvGlobal = $('#ActvGlobal'+id).val();
    var unActvGeneral = $('#ActvGeneral'+id).val();
    var uncheck = $('#check'+id).val();
    var unSubcheck = $('#Subcheck'+id).val();
    var unresolucion = $('#resolucion'+id).val();
    var unacuerdoestatus = $('#acuerdoestatus'+id).val();
    var unfechacompromiso = $('#fechacomp'+id).val();
    var unresponsableacuerdo = $('#responsableacuerdo'+id).val();

    $.confirm({
        icon: 'glyphicon glyphicon-minus-sign',
        title: '¿Desea editar el acuerdo ?',
        content: 'No podrás revertir los cambios',
        autoClose: 'cancelar|8000',
        type: 'dark',
        typeAnimated: true,
        buttons:
        {
            aceptar:
            {
                btnClass: 'btn-dark',
                action: function () {
                    var contadorFila = $("#tamanoArt").val();
                    contadorFila--;
                    //alert(contadorFila);
                    var contadorFilas= $("#tamanoArtedit").val();
                    contadorFilas--;
                    $.post('../../../WEB-INF/Controllers/AcuerdosEscritos/Controler_acuerdos.php', { id: id, accion: "editarunacuerdo", tamanoArt: contadorFila, tamanoArtedit: contadorFilas,
                    idacuerdo: idacuerdo,
                    descripcionacuerdo: undescripcionacuerdo,
                    acme: unacme,
                    tipoacuerdo: untipoacuerdo,
                    Eje: unEje,
                    cate: uncate,
                    Expotem: unExpotem, 
                    ActvGlobal: unActvGlobal, 
                    ActvGeneral: unActvGeneral, 
                    check: uncheck,
                    Subcheck: unSubcheck, 
                    resolucion: unresolucion, 
                    acuerdoestatus: unacuerdoestatus, 
                    fechacompromiso: unfechacompromiso, 
                    responsableacuerdo: unresponsableacuerdo
                    
                }, function (data) {
                        if (data.toString().indexOf("Error:") === -1) {
                            //$.dialog(data);
                            $.confirm({
                                icon: 'glyphicon glyphicon-ok-sign',
                                title: data,
                                content: '',
                                type: 'dark',
                                buttons:
                                {
                                    aceptar:
                                    {
                                        action: function () {
                                            location.reload();
                                        }

                                    }
                                }
                            });
                            //location.reload();
                        } else {
                            $.confirm({
                                icon: 'glyphicon glyphicon-remove-sign',
                                title: data,
                                content: '',
                                type: 'red',
                                buttons:
                                {
                                    aceptar:
                                    {
                                        action: function () {
                                          //  location.reload();
                                        }

                                    }
                                }
                            });
                            //$.dialog(data);
                        }
                        //location.reload();
                    });
                }
            },
            cancelar: function () {
                //$.alert('Cancelado!');
            }
        }
    });
}
