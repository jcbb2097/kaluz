
$(document).ready(function(){

    var form = "#formDispositivo";
    var controller = "../../../WEB-INF/Controllers/Seguridad/Controler_MDispositivo.php";
    $(form).bootstrapValidator({
        fields: {
           Eje: {
                validators: {
                    notEmpty: {
                        message: 'Por favor Selecciona un Eje'
                    }
                }
            },
             areac: {
                validators: {
                    notEmpty: {
                        message: 'Por favor Selecciona un Área'
                    }
                }
            },
            ndispositivo: {
                validators: {
                    notEmpty: {
                        message: 'Por favor Selecciona un Número de Dispositivo'
                    }
                }
            } ,
            tipo_d: {
                validators: {
                    notEmpty: {
                        message: 'Por favor Selecciona Tipo de Dispositivo'
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
                                    window.location.href="seguridad.php?nombreUsuario="+$("#usuario").val()+"&menu_seguridad=catalogos&id_t=lista_metadispositivo"; 
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
                    $.post('../../../WEB-INF/Controllers/Seguridad/Controler_MDispositivo.php',{id:Id, accion:"eliminar"}, function(data)
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
    window.location.href="alta_agentes.php?accion=editar&id="+Id+"&usuario="+user;
}
function atras(){
    $('#area').val("");
     $('#actividad').val("");
    
}