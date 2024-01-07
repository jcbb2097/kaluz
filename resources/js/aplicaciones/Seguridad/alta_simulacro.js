
$(document).ready(function(){
    $('#tSimulacro').DataTable(
    {
        "scrollX": true,
        "pageLength": 10,
        "language": 
        {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
        },
        "order": [[ 0, "asc" ]]
        //"ordering": false

    });
   
    var form = "#formSimulacro";
    var controller = "../../../WEB-INF/Controllers/Seguridad/Controler_simulacro.php";
    $(form).bootstrapValidator({
        fields: {
           tipo_S: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese un Tipo de Simulacro'
                    }
                }
            },  
            ubicacion: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese una Ubicación'
                    }
                }
            },
            fecha: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese una Fecha'
                    }
                }
            }, 
            Personase: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese las Personas Evacuadas'
                    }
                }
            }, 
            Personasne: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese las Personas no Evacuadas'
                    }
                }
            }, 
            Personasp: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese las Personas Presentes'
                    }
                }
            }, 
            Tiempoe: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese el Tiempo de evaciación'
                    }
                }
            }, 
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
                                    //window.location.href="seguridad.php?nombreUsuario="+$("#usuario").val();
                                    window.location.href="seguridad.php?nombreUsuario="+$("#usuario").val()+"&menu_seguridad=catalogos&id_t=lista_simulacro";
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
                    $.post('../../../WEB-INF/Controllers/Seguridad/Controler_simulacro.php',{id:Id, accion:"eliminar"}, function(data)
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

function modificar(Id)
{

    //console.log("entra");
    window.location.href="alta_agentes.php?accion=editar&id="+Id+"&usuario="+user;
   
}