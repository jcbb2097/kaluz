function link() {
    if ($("#checkbox_pdf").prop('checked')) {

        $("#link_pdf").prop('disabled', false);
        $("#pdf").prop('disabled', true);
    } else {

        $("#link_pdf").prop('disabled', true);
        $("#pdf").prop('disabled', false);
    }

}
function busca_entregable(act, select) {
    $("#" + select).html("");
    $.post("./Selectentregable_por_act.php", {
        actividad: act
    },
        function (data, status) {
            if (status == "success") {
                let obj = JSON.parse(data);
                let countobj = Object.keys(obj).length;
                if (countobj > 0) {

                    $.each(obj, function (i, item) {
                        $("#" + select).append(item.Nombre);
                    });
                } else {
                    $("#" + select).append("Sin entregable");
                }
            }
        });
}
function nuevaactividad() {
    var accion = $("#accion").val();
    var contadorFila = $("#tamanoArt").val();
    var contador = contadorFila;
    if (accion == 'editar') {
        contador++;
    }

    var html = '<div class="row" id="actividades' + contador + '">' +

        '<div class="form-group form-group-sm">' +
        '<input type="hidden" id="id_edit" name="id_edit" value="1"/>' +
        '<label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO"><button id="mas" name="mas" type="button" class="btn btn-xs" onclick="eliminaractividad(' + contador + ');"><i class="glyphicon glyphicon-trash"></i></button></label>' +
        '</div>' +
        '<div class="form-group form-group-sm">' +
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Eje:</label>' +
        '<div class="col-md-3 col-sm-3 col-xs-3">' +
        '<select id="Eje' + contador + '" class="form-control"  name="Eje' + contadorFila + '" onchange="Categorias(' + contador + ');actividades1(' + contador + ');">' +
        ' </select>' +
        '</div>' +
        '</div>' +
        '<div class="form-group form-group-sm">' +
        '<label class="col-md-2 col-sm-2 col-xs-2 control-label" for="AÑO">* Categoría:</label>' +
        '<div class="col-md-3 col-sm-3 col-xs-3">' +
        ' <select id="cate' + contador + '" class="form-control" name="cate' + contadorFila + '" onchange="Sub_Categorias(' + contador + ');">' +
        ' </select>' +
        '</div>' +
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Sub categoría:</label>' +
        '<div class="col-md-3 col-sm-3 col-xs-3">' +
        '<select id="subcate' + contador + '" class="form-control" name="subcate' + contadorFila + '" onchange="">' +
        '</select>' +
        '</div>' +
        '</div>' +
        '<div class="form-group form-group-sm">' +
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Exposición Temporal:</label>' +
        '<div class="col-md-3 col-sm-3 col-xs-3">' +
        '<select id="Expotem' + contador + '" class="form-control" name="Expotem' + contadorFila + '">' +
        '</select>' +
        '</div>' +
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Actividad/Meta:</label>' +
        '<div class="col-md-2 col-sm-2 col-xs-2">' +
        '<select id="acme' + contador + '" class="form-control" name="acme' + contadorFila + '" onchange="actividades1(' + contador + ')">' +
        '<option value="1">Actividad</option>' +
        '<option value="2">Meta</option>' +
        '</select>' +
        '</div>' +
        '</div>' +
        '<div class="form-group form-group-sm">' +
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* A/M. Global:</label>' +
        '<div class="col-md-3 col-sm-3 col-xs-3">' +
        '<select id="ActvGlobal' + contador + '" class="form-control" name="ActvGlobal' + contadorFila + '" onchange="actividades2(' + contador + ');">' +
        '</select>' +
        '</div>' +
        '</div>' +
        '<div class="form-group form-group-sm">' +
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">A/M. General:</label>' +
        '<div class="col-md-3 col-sm-3 col-xs-3">' +
        '<select id="ActvGeneral' + contador + '"class="form-control" name="ActvGeneral' + contadorFila + '" onchange="actividades3(' + contador + ');">' +
        '</select>' +
        '</div>' +
        '</div>' +
        '<div class="form-group form-group-sm">' +
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">A/M. Particular:</label>' +
        '<div class="col-md-3 col-sm-3 col-xs-3">' +
        '<select id="ActvParticular' + contador + '"class="form-control" name="ActvParticular' + contador + '" onchange="actividades4(' + contador + ');">' +
        '</select>' +
        '</div>' +
        '</div>' +
        '<div class="form-group form-group-sm">' +
        '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">SubActividad/Meta:</label>' +
        '<div class="col-md-3 col-sm-3 col-xs-3">' +
        '<select id="SubActividad' + contador + '"class="form-control" name="SubActividad' + contadorFila + '" onchange="">' +
        '</select>' +
        '</div>' +
        '</div>' +
        '</div>';
    $("#nuevaactividad").append(html);
    $('#Eje' + contador).load("../../../WEB-INF/Controllers/ArchivosCompartidos/Acciones_archivo.php", { "eje": "eje" }, function (data) {
        $(this).select();
    });
    $('#Expotem' + contador).load("../../../WEB-INF/Controllers/ArchivosCompartidos/Acciones_archivo.php", { "exposicion": "exposicion" }, function (data) {
        $(this).select();
    });
    contadorFila++;
    $("#tamanoArt").val(contadorFila);
}
function eliminaractividad(id) {
    var contadorFila = $("#tamanoArt").val();
    $("#actividades" + id).remove();
    $("#actividades2" + id).remove();
    contadorFila--;
    $("#tamanoArt").val(contadorFila);

}
function actividades1(contador) {
    if (contador == undefined) {
        var Eje = $('#Eje').val();
        var Tipo_actividad = $('#acme').val();
        var Periodo = $('#ano').val();
        var categoria = $('#cate').val();
        var subcategoria = $('#subcate').val();
        var Categoria;
        if (subcategoria > 0) {
            Categoria = subcategoria;
        } else {
            Categoria = categoria;
        }
        $('#ActvGlobal').load("../../../WEB-INF/Controllers/ArchivosCompartidos/Acciones_archivo.php", { "global": "global", "Eje": Eje, "tipo": Tipo_actividad, "Periodo": Periodo, "categoria": Categoria }, function (data) {
            $(this).select();
        });
        $('#ActvGeneral').html("");
        $('#ActvParticular').html("");
        $('#SubActividad').html("");
    } else {
        var Eje = $('#Eje' + contador).val();
        var Tipo_actividad = $('#acme' + contador).val();
        var Periodo = $('#ano').val();
        var categoria = $('#cate' + contador).val();
        var subcategoria = $('#subcate' + contador).val();
        var Categoria;
        if (subcategoria > 0) {
            Categoria = subcategoria;
        } else {
            Categoria = categoria;
        }
        $('#ActvGlobal' + contador).load("../../../WEB-INF/Controllers/ArchivosCompartidos/Acciones_archivo.php", { "global": "global", "Eje": Eje, "tipo": Tipo_actividad, "Periodo": Periodo }, function (data) {
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
        $('#ActvGeneral').load("../../../WEB-INF/Controllers/ArchivosCompartidos/Acciones_archivo.php", { "General": "General", "Actividad": ActvG }, function (data) {
            $(this).select();
        });
        $('#ActvParticular').html("");
        $('#SubActividad').html("");
    } else {
        var ActvG = $('#ActvGlobal' + contador).val();
        $('#ActvGeneral' + contador).load("../../../WEB-INF/Controllers/ArchivosCompartidos/Acciones_archivo.php", { "General": "General", "Actividad": ActvG }, function (data) {
            $(this).select();
        });
        $('#ActvParticular' + contador).html("");
        $('#SubActividad' + contador).html("");
    }
}
function actividades3(contador) {
    if (contador == undefined) {
        var ActvG = $('#ActvGeneral').val();
        $('#ActvParticular').load("../../../WEB-INF/Controllers/ArchivosCompartidos/Acciones_archivo.php", { "Particular": "Particular", "Actividad": ActvG }, function (data) {
            $(this).select();
        });
        $('#SubActividad').html("");
    } else {
        var ActvG = $('#ActvGeneral' + contador).val();
        $('#ActvParticular' + contador).load("../../../WEB-INF/Controllers/ArchivosCompartidos/Acciones_archivo.php", { "Particular": "Particular", "Actividad": ActvG }, function (data) {
            $(this).select();
        });
        $('#SubActividad' + contador).html("");
    }
}
function actividades4(contador) {
    if (contador == undefined) {
        var ActvG = $('#ActvParticular').val();
        $('#SubActividad').load("../../../WEB-INF/Controllers/ArchivosCompartidos/Acciones_archivo.php", { "Subactividad": "Subactividad", "Actividad": ActvG }, function (data) {
            $(this).select();
        });
    } else {
        var ActvG = $('#ActvParticular' + contador).val();
        $('#SubActividad' + contador).load("../../../WEB-INF/Controllers/ArchivosCompartidos/Acciones_archivo.php", { "General": "General", "Actividad": ActvG }, function (data) {
            $(this).select();
        });


    }
}
function check(contador) {
    if (contador == undefined) {
        var ActvG = $('#ActvGlobal').val();
        var Periodo = $('#ano').val();
        $('#Check').load("../../../WEB-INF/Controllers/ArchivosCompartidos/Acciones_archivo.php", { "check": "check", "Actividad": ActvG, "Periodo": Periodo }, function (data) {
            $(this).select();
        });
    } else {
        var ActvG = $('#ActvGlobal' + contador).val();
        var Periodo = $('#ano').val();
        $('#Check' + contador).load("../../../WEB-INF/Controllers/ArchivosCompartidos/Acciones_archivo.php", { "check": "check", "Actividad": ActvG, "Periodo": Periodo }, function (data) {
            $(this).select();
        });


    }
}
function Subcheck(contador) {
    var ActvG = $('#ActvGlobal').val();
    var Check = $('#Check').val();
    var Periodo = $('#ano').val();
    $('#subCheck').load("../../../WEB-INF/Controllers/ArchivosCompartidos/Acciones_archivo.php", {
        Subcheck: 'Subcheck',
        Actividad: ActvG,
        Periodo: Periodo,
        checklist: Check,
    }, function (data) {
        $(this).select();
    });
}

function Categorias(contador) {
    if (contador == undefined) {
        var eje = $('#Eje').val();
        var anio = $('#ano').val();
        $('#cate').load("../../../WEB-INF/Controllers/ArchivosCompartidos/Acciones_archivo.php", {
            categoria: 'categoria',
            ideje: eje,
            anio: anio

        }, function (data) {
            $(this).select();
        });
        $('#ActvGlobal').html("");
        $('#subcate').html("");
        $('#ActvGeneral').html("");
        $('#ActvParticular').html("");
        $('#SubActividad').html("");
    } else {
        var eje = $('#Eje' + contador).val();
        var anio = $('#ano').val();
        $('#cate' + contador).load("../../../WEB-INF/Controllers/ArchivosCompartidos/Acciones_archivo.php", {
            categoria: 'categoria',
            ideje: eje,
            anio: anio

        }, function (data) {
            $(this).select();
        });
        $('#ActvGlobal' + contador).html("");
        $('#subcate' + contador).html("");
        $('#ActvGeneral' + contador).html("");
        $('#ActvParticular' + contador).html("");
        $('#SubActividad' + contador).html("");
    }
}

function Sub_Categorias(contador) {
    if (contador == undefined) {
        var cate = $('#cate').val();
        $('#subcate').load("../../../WEB-INF/Controllers/ArchivosCompartidos/Acciones_archivo.php", {
            cate: cate,
            subcategoria: 'subcategoria'
        }, function (data) {
            $(this).select();
        });
        $('#ActvGlobal').html("");
        $('#ActvGeneral').html("");
        $('#ActvParticular').html("");
        $('#SubActividad').html("");
    } else {
        var cate = $('#cate' + contador).val();
        $('#subcate' + contador).load("../../../WEB-INF/Controllers/ArchivosCompartidos/Acciones_archivo.php", {
            cate: cate,
            subcategoria: 'subcategoria'
        }, function (data) {
            $(this).select();
        });
        $('#ActvGlobal' + contador).html("");
        $('#ActvGeneral' + contador).html("");
        $('#ActvParticular' + contador).html("");
        $('#SubActividad' + contador).html("");
    }
}

function invarea() {
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
function eliminaractividadarchivo(Id) {
    //var con = "'"+controller+"'";
    $.confirm({
        icon: 'glyphicon glyphicon-minus-sign',
        title: '¿Desea desvincular la actividad?',
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
                    $.post('../../../WEB-INF/Controllers/ArchivosCompartidos/Controler_archivo.php', { id: Id, accion: "eliminarsub" }, function (data) {
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
