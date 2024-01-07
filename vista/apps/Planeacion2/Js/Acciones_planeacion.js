function De_ativate_categoria(Id, tipo, perfil, Id_periodo, periodo, ACME) {
    var Mensaje = "";
    var contenido = '';
    if (tipo == 1) {
        Mensaje = '¿Desea activar la categoría?';
        var contenido = 'Se activaran todo lo asociado a ella';
    } else {
        Mensaje = '¿Desea desactivar la categoría?';
        var contenido = 'Se desactivaran todo lo asociado a ella';
    }
    if (perfil == 1) {
        $.confirm({
            icon: 'glyphicon glyphicon-minus-sign',
            title: Mensaje,
            content: contenido,
            autoClose: 'cancelar|8000',
            type: 'dark',
            typeAnimated: true,
            buttons: {
                aceptar: {
                    btnClass: 'btn-dark',
                    action: function () {
                        $.post('Controllers/Controler_planeacion.php', {
                            id: Id,
                            tipo: tipo,
                            Id_periodo: Id_periodo,
                            periodo: periodo,
                            ACME: ACME,
                            accion: "Deactivate"
                        }, function (data) {
                            if (data.toString().indexOf("Error:") === -1) {
                                //$.dialog(data);
                                $.confirm({
                                    icon: 'glyphicon glyphicon-ok-sign',
                                    title: data,
                                    content: '',
                                    type: 'dark',
                                    buttons: {
                                        aceptar: {
                                            action: function () {
                                                location.reload();
                                                seleccionar();
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
                                    buttons: {
                                        aceptar: {
                                            action: function () {
                                                location.reload();
                                                seleccionar();
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
    } else {
        $.confirm({
            icon: 'glyphicon glyphicon-remove-sign',
            title: 'No eres el responsable o no eres administrador',
            content: '',
            type: 'red',
        });
    }
}
function De_ativate_subcate(Id, tipo, perfil, Id_periodo, periodo, ACME) {

    var Mensaje = "";
    var contenido = '';
    if (tipo == 1) {
        Mensaje = '¿Desea activar la sub-categoría?';
        var contenido = 'Se activaran todo lo asociado a ella';
    } else {
        Mensaje = '¿Desea desactivar la sub-categoría?';
        var contenido = 'Se desactivaran todo lo asociado a ella';
    }
    if (perfil == 1) {
        $.confirm({
            icon: 'glyphicon glyphicon-minus-sign',
            title: Mensaje,
            content: contenido,
            autoClose: 'cancelar|8000',
            type: 'dark',
            typeAnimated: true,
            buttons: {
                aceptar: {
                    btnClass: 'btn-dark',
                    action: function () {
                        $.post('Controllers/Controler_planeacion.php', {
                            id: Id,
                            tipo: tipo,
                            Id_periodo: Id_periodo,
                            periodo: periodo,
                            ACME: ACME,
                            accion: "Deactivate"
                        }, function (data) {
                            if (data.toString().indexOf("Error:") === -1) {
                                //$.dialog(data);
                                $.confirm({
                                    icon: 'glyphicon glyphicon-ok-sign',
                                    title: data,
                                    content: '',
                                    type: 'dark',
                                    buttons: {
                                        aceptar: {
                                            action: function () {
                                                location.reload();
                                                seleccionar();
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
                                    buttons: {
                                        aceptar: {
                                            action: function () {
                                                location.reload();
                                                seleccionar();
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
    } else {
        $.confirm({
            icon: 'glyphicon glyphicon-remove-sign',
            title: 'No eres el responsable o no eres administrador',
            content: '',
            type: 'red',
        });
    }
}
function actividad(tipo, Id, ACME, Responsable, id_usuario, perfil, id_periodo, periodo, id_categoria) {
    var Mensaje = "";
    var contenido = '';
    if (tipo == 1 && ACME == 1) {
        Mensaje = '¿Desea activar la actividad?';
        var contenido = 'Se activaran todas sus actividades y checklist asociados';
    } else if (tipo == 1 && ACME == 2) {
        Mensaje = '¿Desea activar la meta?';
        var contenido = 'Se activaran todas sus metas y checklist asociados';
    } else if (tipo == 2 && ACME == 1) {
        Mensaje = '¿Desea desactivar la actividad?';
        var contenido = 'Se desactivaran todas sus actividades y checklist asociados';
    } else if (tipo == 2 && ACME == 2) {
        Mensaje = '¿Desea desactivar la meta?';
        var contenido = 'Se desactivaran todas sus metas y checklist asociados';
    }
    if (Responsable == id_usuario || perfil == 1) {
        $.confirm({
            icon: 'glyphicon glyphicon-minus-sign',
            title: Mensaje,
            content: contenido,
            autoClose: 'cancelar|8000',
            type: 'dark',
            typeAnimated: true,
            buttons: {
                aceptar: {
                    btnClass: 'btn-dark',
                    action: function () {
                        $.post('Controllers/Controler_planeacion.php', {
                            id: Id,
                            tipo: tipo,
                            accion: "activar",
                            id_periodo: id_periodo,
                            Periodo: periodo,
                            id_categoria: id_categoria
                        }, function (data) {
                            if (data.toString().indexOf("Error:") === -1) {
                                //$.dialog(data);
                                $.confirm({
                                    icon: 'glyphicon glyphicon-ok-sign',
                                    title: data,
                                    content: '',
                                    type: 'dark',
                                    buttons: {
                                        aceptar: {
                                            action: function () {
                                                location.reload();
                                                seleccionar();
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
                                    buttons: {
                                        aceptar: {
                                            action: function () {
                                                location.reload();
                                                seleccionar();
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
    } else {
        $.confirm({
            icon: 'glyphicon glyphicon-remove-sign',
            title: 'No eres el responsable o no eres administrador',
            content: '',
            type: 'red',
        });
    }

}
function plan(Id_actividad, Id_categoria, Id_subcategoria, ACME, Periodo, nombre, ano, Id_actividadsuperior, check, filtro) {
    var accion = "editar";
    var Id_actividad = Id_actividad;
    var Id_categoria = Id_categoria;
    var Id_subcategoria = Id_subcategoria;
    var Id_actividadsuperior = Id_actividadsuperior;
    var ACME = ACME;
    var check = check;
    var Periodo = Periodo;
    var filtro = filtro;
    var Categoria;
    if (Id_subcategoria > 0) {
        Categoria = Id_subcategoria;
    } else {
        Categoria = Id_categoria;
    }
    if (Id_actividadsuperior > 0) {
        acti = Id_actividad;
    } else {
        acti = Id_actividadsuperior;
    }
    var Id_usuario = $('#Id_usuario').val();
    var nombreUsuario = $('#nombreUsuario').val();
    var Perfil = $('#Perfil').val();
    acAvanceCheck(acti, Periodo, Categoria);
    url = "Alta_logro_modal.php?Id_actividad=" + Id_actividad + "&Id_categoria=" + Id_categoria + "&Id_subcategoria=" + Id_subcategoria + "&ACME=" + ACME + "&Periodo=" + Periodo + "&accion=" + accion + "&Nombreeje=" + nombre + "&ano=" + ano + "&Id_usuario=" + Id_usuario + "&nombreUsuario=" + nombreUsuario + "&Perfil=" + Perfil + "&Id_actividadsuperior=" + Id_actividadsuperior + "&check=" + check + '&filtro=' + filtro;
    setTimeout(function () {
        $(location).attr('href', url);
    }, 2000);

}
function acAvanceCheck(id_actividad, periodo, categoria) {
    var accion = 'actualizar';
    var id_actividad = id_actividad;
    var periodo = periodo;
    var categoria = categoria;
    $.post("Controllers/Controler_planeacion.php", {
        accion: "actualizar",
        id_actividad: id_actividad,
        periodo: periodo,
        categoria: categoria
    }, function (data) {
    });
}
function edita_check(id) {
    var Id_usuario = $('#Id_usuario').val();
    var Id_acGBL = $('#actividadg').val();
    var activ = $('#activ').val();
    var cate = $('#categoria').val();
    var sucbate = $('#subcategoria').val();
    var tipo = $('#tipo').val();
    var Periodo = $('#Periodo').val();
    var Nombreeje = $('#Nombreeje').val();
    var ano = $('#ano').val();
    var Perfil = $('#Perfil').val();
    var nombreUsuario = $('#nombreUsuario').val();
    url = '../check/Alta_check.php?accion=editar&id=' + id + '&usuario=' + Id_usuario + '&regresar=1&Id_actividad=' + activ + '&Id_categoria=' + cate + '&Id_subcategoria=' + sucbate + '&ACME=' + tipo + '&Periodo=' + Periodo + '&Nombreeje=' + Nombreeje + '&ano=' + ano + '&Id_usuario=' + Id_usuario + '&nombreUsuario=' + nombreUsuario + '&Perfil=' + Perfil + '&Id_actividadsuperior=' + Id_acGBL + '&check=0';
    $(location).attr('href', url);
}

