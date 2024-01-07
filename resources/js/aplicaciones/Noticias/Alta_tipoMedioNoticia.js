$(document).ready(function(){

    var form = "#formTipoMedio";
    var controller = "../../../WEB-INF/Controllers/Noticias/Controler_tipoMedio.php";

    $('#tipoMedio').DataTable(
    {
        "language": 
        {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
        },
        "order": [[ 0, "asc" ]]
        //"ordering": false
    });

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
            soportemedio: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, agregue un Tipo de Soporte'
                    }
                }
            },
            tipomedio: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, agregue un Tipo de Medio'
                    }
                }
            }
        }
    });

    $("#guardar").click(function(event) {
        
     //limpiarMensaje();
        event.preventDefault();
        if ($(form).bootstrapValidator('validate').has('.has-error').length === 0 ) {
         //console.log("todo validado");
         // cargando();
          var inputs = $("input[type=file]"),
                 files = [];
                 for (var i = 0; i < inputs.length; i++) {
                     files.push(inputs.eq(i).prop("files")[0]);
                 }

                 var formData = new FormData();
                 $.each(files, function(key, value)
                 {
                     formData.append(key, value);
                 });
                 formData.append('form', $(form).serialize());
                 formData.append('accion',$("#accion").val());
                 formData.append('id',$("#id").val());
                 formData.append('usuario',$("#usuario").val());    
                $.ajax({
                 url: controller,
                 type: 'POST',
                 data: formData,
                 cache: false,
                 contentType: false,
                 processData: false,
                 success: function(data, textStatus, jqXHR){
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
                                action: function()
                                {   
                                    //$("#formEjes")[0].reset();
                                    cambiarContenido('#contenido','Lista_tipoMedio.php?nombreUsuario='+$("#usuario").val());
                                    //window.location.href="Lista_noticia_2020.php?nombreUsuario="+$("#usuario").val(); 
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
                                    action: function()
                                    {
                                        
                                    }
                                }
                            }
                        }); 
                     }
                     //finalizar();
                },
                error: function(data)
                {
                    console.log("Error al enviar");
                },
                complete: function()
                {
                }
            });

        }else{
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
                        action: function()
                        {
                            
                        }
                    }
                }
            }); 
        }
    });
});

function eliminar(Id){
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
                    $.post('../../../WEB-INF/Controllers/Noticias/Controler_lugarNoticia.php',{id:Id, accion:"eliminar"}, function(data)
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

function modificar(Id,user)
{
    //console.log("entra E ");
    //cambiarContenido('#contenido','alta_tipoMedio.php?accion=editar&id='+Id+'&usuario='+user);
    window.location.href="alta_tipoMedio.php?accion=editar&id="+Id+"&usuario="+user;   
}