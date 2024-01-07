
function eliminar_check(Id_check, Id_actividad, Id_periodo,Id_categoria) {
    //var con = "'"+controller+"'";
    $.confirm({
        icon: 'glyphicon glyphicon-minus-sign',
        title: '¿Desea eliminar el checklist?',
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
                    $.post('Controllers/Controller_check.php', { id: Id_check, accion: "eliminar", Id_actividad: Id_actividad, Id_periodo: Id_periodo,Id_categoria:Id_categoria }, function (data) {
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

function subeliminar(Id_check, Id_actividad, Id_periodo,Id_categoria) {
    //var con = "'"+controller+"'";
    $.confirm({
        icon: 'glyphicon glyphicon-minus-sign',
        title: '¿Desea eliminar el Sub checklist?',
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
                    $.post('Controllers/Controller_check.php', { id: Id_check, accion: "subeliminar", Id_actividad: Id_actividad, Id_periodo: Id_periodo,Id_categoria:Id_categoria }, function (data) {
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

function modificar(Id, user) {
    window.location.href = "Alta_check.php?accion=editar&id=" + Id + "&usuario=" + user;
}
function De_ativate_chech(Id, tipo, periodo, padre,idactividad,idcategoria) {
    var Mensaje = "";
    var contenido = '';
    if (tipo == 1) {
        Mensaje = '¿Desea activar el check?';
        var contenido = 'Se activaran todo lo asociado a el';
    } else {
        Mensaje = '¿Desea desactivar el check?';
        var contenido = 'Se desactivaran todo lo asociado a el';
    }
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
                        periodo: periodo,
                        padre: padre,
                        idactividad:idactividad,
                        idcategoria:idcategoria,
                        accion: "Deactivatecheck"
                    }, function (data) {
                   
                        if (data.toString().indexOf("Error:") === -1) {
                            //$.dialog(data);
                            acAvanceCheck(idactividad,periodo,idcategoria);
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

