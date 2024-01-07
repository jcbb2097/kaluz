
$(document).ready(function(){

    var form = "#formDispositivosp";
    var controller = "../../../WEB-INF/Controllers/Seguridad/Controler_Dispositivos.php";
    $(form).bootstrapValidator({
        fields: {
           Tdispositivo: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese un Dispositivo'
                    }
                }
            },  
            Eje: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese un tipo Eje'
                    }
                }
            },  
            area: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese un tipo Área'
                    }
                }
            },  
            Inventario: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese un Inventario'
                    }
                }
            },  
            Ncontrol: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese un No de control'
                    }
                }
            },  
            Nserie: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese un No de Serie'
                    }
                }
            },  
            Marca: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese una Marca'
                    }
                }
            }, 
            Estatus: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese un Estatus'
                    }
                }
            },
            Adquisicion: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese una Observación'
                    }
                }
            },  
            Accesorio: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese un Accesorio'
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
            Personau : {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Asignar una persona'
                    }
                }
            },
            Personar : {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Asignar una persona'
                    }
                }
            },
            Estadoe : {
                enabled: false,
                validators: {
                    notEmpty: {
                        message: 'Por favor, Asignar un estado'
                    }
                }
            },
            Agente : {
                enabled: false,
                validators: {
                    notEmpty: {
                        message: 'Por favor, Asignar un Agente'
                    }
                }
            }       
        }
    });
    $("#guardar").click(function(event) {
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
                 if($("#valores").val()==""){
                    valor= $("#Tdispositivo").val();
                 }
                 else{
                    valor= $("#valores").val();
                 }
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
                                    window.location.href="seguridad.php?nombreUsuario="+$("#usuario").val()+"&menu_seguridad=tabla_datos&id_t=tabla_datos&valor="+valor; 
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
                     alert("asd"); 
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

function eliminar(Id,dispositivo){
   
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
                    $.post('../../../WEB-INF/Controllers/Seguridad/Controler_Dispositivos.php',{id:Id, accion:"eliminar", dispositivo:dispositivo}, function(data)
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
    window.location.href="Alta_Dispositivosp.php?accion=editar&id="+Id+"&usuario="+user;
}

function cambiartablas(div, page,id,ubicacion){
//alert(div+" "+ page+" "+id)
  pagina = page.split('?',3);

  if (page === "") {
        //alert("Funcionalidad no implementada aún");
        alert("Pantalla no definida aún");
        return;
  }
 $('#ubicaciones').val(ubicacion);
  var usuario = $('#usuario').val();


  $(div).load(pagina[0],{valor:id, resto:ubicacion  }, function (data, status, xhr) {
        if (status == "error") {
            $("#errorPrincipal").html(data + "<br/>" + xhr.status + " " + xhr.statusText);
        } else {
            //$(div).html(data);
            //finalizar();
        }

  });

    
}
function cambiartablas_ubi(div, page,id, idubicacion, disp){
setInterval(8000);
  pagina = page.split('?',3);
  if (page === "") {
        //alert("Funcionalidad no implementada aún");
        alert("Pantalla no definida aún");
        return;
  }
if(typeof $('#ubicaciones').val() === 'undefined'){
 
}else{
  idubicacion=$('#ubicaciones').val();
 
}
$("#disposi").val("");

  var usuario = $('#usuario').val();
   
  $(div).load(pagina[0],{id_valor:id, idubicacion:idubicacion, valor:id, disp:disp }, function (data, status, xhr) {

        if (status == "error") {
            $("#errorPrincipal").html(data + "<br/>" + xhr.status + " " + xhr.statusText);
        } else {
            //$(div).html(data);
            //finalizar();
        }

  });
    
}
function extintor(valor){
    if(valor==6){
        
   
        $('#dispositivos_apa').css("display","none")
        $('#extintores_apa').css("display","block")
        $('#Nserie1').css("display","block");
        $('#Ncontrol1').css("display","none");
        $('#Inventario1').css("display","none")
        $('#formDispositivosp').bootstrapValidator('enableFieldValidators', 'Estadoe')
        .bootstrapValidator('enableFieldValidators', 'Agente');
    }
    else{
      
        if(valor==5){
            $('#Nserie1').css("display","none");
            $('#Ncontrol1').css("display","none");
            $('#Inventario1').css("display","none");
        }
        if(valor==10){
            $('#Nserie1').css("display","none");
            $('#Ncontrol1').css("display","none");
            $('#Inventario1').css("display","block");
        }
        if(valor==7){
            $('#Nserie1').css("display","none");
            $('#Ncontrol1').css("display","none");
            $('#Inventario1').css("display","none");
        }
        if(valor==8){
            $('#Nserie1').css("display","block");
            $('#Ncontrol1').css("display","block");
            $('#Inventario1').css("display","block");
        }
        if(valor==11){
            $('#Nserie1').css("display","none");
            $('#Ncontrol1').css("display","none");
            $('#Inventario1').css("display","block");
        }
        $('#dispositivos_apa').css("display","block")
        $('#extintores_apa').css("display","none")
          $('#formDispositivosp').bootstrapValidator('disableFieldValidators', 'Estadoe')
        .bootstrapValidator('disableFieldValidators', 'Agente');
    }
}