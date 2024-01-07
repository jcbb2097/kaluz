function Alta(id_usuario, id_submenu, ruta) {
    $.post("../../../WEB-INF/Controllers/Menu/Controler_permisos.php", {
        Accion: 'Alta',
        Id_usuario: id_usuario,
        Id_submenu: id_submenu
    },
        (data, status) => {
            if (status == "success") {
                url = ruta;
                if (data == 1) {
                    $(location).attr('href', url);
                } else {
                    alert('no cuenta con los permisos necesarios');
                }
            }
        });
}

function edita(id_usuario, id_submenu, ruta) {
    $.post("../../../WEB-INF/Controllers/Menu/Controler_permisos.php", {
        Accion: 'Editar',
        Id_usuario: id_usuario,
        Id_submenu: id_submenu
    },
        (data, status) => {
            if (status == "success") {
                url = ruta;
                if (data == 1) {
                    $(location).attr('href', url);
                } else {
                    alert('no cuenta con los permisos necesarios');
                }
            }
        });
}

function elimina(id_usuario, id_submenu, id) {
    $.post("../../../WEB-INF/Controllers/Menu/Controler_permisos.php", {
        Accion: 'Eliminar',
        Id_usuario: id_usuario,
        Id_submenu: id_submenu
    },
        (data, status) => {
            if (status == "success") {
                if (data == 1) {
                    eliminar(id);
                } else {
                    alert('no cuenta con los permisos necesarios');
                }
            }
        });
}

function consulta() {
    $.post("../../../WEB-INF/Controllers/Menu/Controler_permisos.php", {
        Accion: 'Consulta'
    },
        (data, status) => {
            if (status == "success") {

                alert(data);
            }
        });
}
