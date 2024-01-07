$(document).ready(function () {
    var form = "#formPermisos";
    var controller = "../../../WEB-INF/Controllers/Menu/Controler_menusql.php";

    $(form).bootstrapValidator({
        err: {
            container: 'tooltip'
        },
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            perfil: {
                validators: {

                    notEmpty: {
                        message: 'Por favor, seleccione un perfil'
                    }

                }
            }, App: {
                validators: {

                    notEmpty: {
                        message: 'Por favor, seleccione una aplicación'
                    }

                }
            }, Menu: {
                validators: {

                    notEmpty: {
                        message: 'Por favor, seleccione un menú'
                    }

                }
            }, Sub_Menu: {
                validators: {

                    notEmpty: {
                        message: 'Por favor, seleccione un submenú'
                    }

                }
            }
        }
    });
    $("#guardar").click(function (event) {
        event.preventDefault();
        if ($(form).bootstrapValidator('validate').has('.has-error').length === 0) {
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
                                        window.location.href = "Lista_permisos.php?nombreUsuario=" + $("#nombreUsuario").val() + "&tipoPerfil=" + $("#tipoPerfil").val() + "&idUsuario=" + $("#idUsuario").val();
                                    }
                                }
                            }
                        });
                    } else {
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

function eliminar(Id_perfil,Id_menu){
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
                action: function()
                {
                    $.post('../../../WEB-INF/Controllers/Menu/Controler_menusql.php',{id_perfil:Id_perfil,id_menu:Id_menu, accion:"eliminar"}, function(data)
                    {
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
                                            action: function(){
                                                location.reload();
                                            }
                
                                        }
                                    }	
                                });
                            //location.reload();
                        }else{
                            $.confirm({
                                    icon: 'glyphicon glyphicon-remove-sign',
                                    title: data,
                                    content: '',
                                    type: 'red',
                                    buttons: 
                                    {
                                        aceptar: 
                                        {
                                            action: function(){
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
            cancelar: function()
            {
                //$.alert('Cancelado!');
            }
        }
    }); 
}

function modificar(Id,Tipo_perfil,n_usuario,Id_usuario,Id_aplicacion,Id_submenu)
{
	window.location.href="Alta_permisos.php?accion=editar&id="+Id+"&tipoPerfil="+Tipo_perfil+"&idUsuario="+n_usuario+"&nombreUsuario="+Id_usuario+"&idaplicacion="+Id_aplicacion+"&idsubmenu="+Id_submenu;  
    
}


