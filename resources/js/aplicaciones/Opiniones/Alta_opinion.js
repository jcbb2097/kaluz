$(document).ready(function () {

    var form = "#actualizasugerencia";
    var controller = "../../../WEB-INF/Controllers/Opiniones/Controler_opiniones.php";

    $("#guardar").click(function (event) {
        let confirmacion = validaEnvio();
        if (confirmacion == true) {
            var inputs = $("input[type=file]"),
                files = [];
            for (var i = 0; i < inputs.length; i++) {
                files.push(inputs.eq(i).prop("files")[0]);
            }

            var formData = new FormData();
            $.each(files, function (key, value) {
                formData.append(key, value);
            });
            formData.append('form', $(form).serialize());
            formData.append('accion', $("#accion").val());
            formData.append('id', $("#id").val());
            formData.append('usuario', $("#usuario").val());
            $.ajax({
                url: controller,
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data, textStatus, jqXHR) {
                    if (data.toString().indexOf("Error:") === -1) {
                        //swal(data,"","success");
                        $.confirm({
                            icon: 'glyphicon glyphicon-ok-sign',
                            title: 'Confirmación',
                            content: data,
                            type: 'dark',
                            typeAnimated: true,
                            buttons:
                            {
                                aceptar:
                                {
                                    btnClass: 'btn-dark',
                                    action: function () {
                                        //$("#formEjes")[0].reset();
                                        if ($("#origen").val()=='apps') {
                                            window.location.href = "Pendientes_por_area.php?idarea=" + $("#idarea").val()+"&nombreUsuario=" + $("#nombreUsuario").val() + "&idUsuario=" + $("#idUsuario").val(); 
                                        }else if ($("#origen").val()=='indicadores') {
                                            window.location.href = "indicadores_opiniones.php?idarea=" + $("#idarea").val()+"&nombreUsuario=" + $("#nombreUsuario").val() + "&idUsuario=" + $("#idUsuario").val(); 
                                        }else{
                                            alert('mosaico');
                                        }
                                       
                                    }
                                }
                            }
                        });

                    } else {
                        // swal(data,'','error');
                        // $("#mensajes").html(data);
                        $.confirm({
                            icon: 'glyphicon glyphicon-remove-sign',
                            title: 'Error',
                            content: data,
                            type: 'red',
                            typeAnimated: true,
                            buttons:
                            {
                                aceptar:
                                {
                                    btnClass: 'btn-dark',
                                    action: function () {

                                    }
                                }
                            }
                        });
                    }
                    //finalizar();
                },
                error: function (data) {
                    console.log("Error al enviar");
                },
                complete: function () {
                }
            });

        } else {
            $.confirm({
                icon: 'glyphicon glyphicon-remove-sign',
                title: 'Error',
                content: 'No es posible guardar el registro, revise los campos obligatorios',
                type: 'red',
                typeAnimated: true,
                buttons:
                {
                    aceptar:
                    {
                        btnClass: 'btn-dark',
                        action: function () {

                        }
                    }
                }
            });
        }
    });
});
function validaEnvio() {
    var resultado = false;
    if (document.getElementById("cbEmail").checked == true || document.getElementById("cbTel").checked == true) {
        if (document.getElementById("txtRespuestaEmail").disabled == false) {
            if (document.getElementById("txtRespuestaEmail").value != "") {
                resultado = true;
            }
        }
        if (document.getElementById("txtRespuestaTel").disabled == false) {
            if (document.getElementById("txtRespuestaTel").value != "") {
                resultado = true;
            }
            else {
                resultado = false;
            }
        }
    }

    return resultado;
}