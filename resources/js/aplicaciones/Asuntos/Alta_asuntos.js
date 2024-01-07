$(document).ready(function () {

    var form = "#formasunto";
    var controller = "../../../WEB-INF/Controllers/Asuntos/Controler_asuntos.php";

    $( "#cerrar_archivos" ).click(function() {
      window.location.reload(true);
    });

    $("#guardar").click(function (event) {

        var bandera = true;
        var actividad_global = $('#AGlobal').val();
        var actividad_general = $('#AGeneral').val();
        var categoria = $('#cate').val();
        var subcategoria = $('#subcate').val();
        var acme = $('#acme').val();
        var periodo = $('#ano').val();
        var ano = $('#ano option:selected').text();
        var eje = 'Eje ' + $('#Eje option:selected').text();
        var accion = 'guardar';
        var origen = $('#origen').val();
        var areaor = $('#areaor').val();

        var actividad_superior;
        var actividad;
        if (actividad_general > 0) {
            actividad_superior = actividad_global;
            actividad = actividad_general;
        } else {
            actividad_superior = actividad_general;
            actividad = actividad_global;
        }

        var mensaje = 'No es posible guardar el registro, revise los campos obligatorios';

        if ($('#checkeck').val() == "") {
            var mensaje = 'Selecciona el tipo (problemática, solicitud, conocimiento, sugerencia)';
            bandera = false;
        } else if ($('#tituloAsunto').val() == "") {
            var mensaje = '"Debe escribir el titulo del asunto"';
            bandera = false;
        } else if ($('#mensaje').val() == "") {
            var mensaje = '"Debe escribir un mensaje"';
            bandera = false;
        }else if ($('#area').val() == "0") {
            var mensaje = '"No hay un área destino"';
            bandera = false;
        }else if ($('#usuario').val() == "0") {
            var mensaje = '"No hay un usuario destino"';
            bandera = false;
        }else if ($('#Checklist').val() == "0" || $('#Checklist').val() == "") {
            var mensaje = '"Seleccione un check para registrar el asunto"';
            bandera = false;
        }




        event.preventDefault();

        if ($(form).bootstrapValidator('validate').has('.has-error').length === 0 && bandera == true) {
            //console.log("todo validado");
            // cargando();
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

                  let data_json = JSON.parse(data);
                    if (data_json.mensaje.toString().indexOf("Error:") === -1) {
                        //swal(data,"","success");
                        $.confirm({
                            icon: 'glyphicon glyphicon-ok-sign',
                            title: 'Confirmación',
                            content: data_json.mensaje,
                            type: 'dark',
                            typeAnimated: true,
                            buttons:
                            {
                                aceptar:
                                {
                                    btnClass: 'btn-dark',
                                    action: function () {
                                        //$("#formEjes")[0].reset();
                                        if(origen == 2){
                                          //padre = $(window.parent.document);
                                          window.location.href = "../Asuntos_indicadores/estadisticas.php?ejearea=1&idejearea="+areaor;
                                          //$(padre).find('#cerrar_nuevoasunto').click();

                                        }else{
                                          if(origen == 3){
                                            window.location.href = "../Planeacion/Alta_asunto.php?accion=guardar&tipoPerfil=1&origen=3&idUsuario=" + $("#idUsuario").val() + '';
                                          }else{
                                            window.location.href = "../Planeacion/Alta_logro_modal.php?nombreUsuario=" + $("#nombreUsuario").val() + "&Perfil=" + $("#tipoPerfil").val() + "&Id_usuario=" + $("#idUsuario").val() + '&Id_actividad=' + actividad + '&Id_categoria=' + categoria + '&Id_subcategoria=' + subcategoria + '&ACME=' + acme + '&Periodo=' + periodo + '&Nombreeje=' + eje + '&ano=' + ano + '&Id_actividadsuperior=' + actividad_superior + '&accion=' + accion+ '&check=0';
                                          }

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
                content: mensaje,
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

    $("#adjuntar").click(function (event) {

        var bandera = true;
        var actividad_global = $('#AGlobal').val();
        var actividad_general = $('#AGeneral').val();
        var categoria = $('#cate').val();
        var subcategoria = $('#subcate').val();
        var acme = $('#acme').val();
        var periodo = $('#ano').val();
        var ano = $('#ano option:selected').text();
        var eje = 'Eje ' + $('#Eje option:selected').text();
        var accion = 'guardar';
        var origen = $('#origen').val();
        var areaor = $('#areaor').val();

        var actividad_superior;
        var actividad;
        if (actividad_general > 0) {
            actividad_superior = actividad_global;
            actividad = actividad_general;
        } else {
            actividad_superior = actividad_general;
            actividad = actividad_global;
        }

        var mensaje = 'No es posible guardar el registro, revise los campos obligatorios';

        if ($('#checkeck').val() == "") {
            var mensaje = 'Selecciona el tipo (problemática, solicitud, conocimiento, sugerencia)';
            bandera = false;
        } else if ($('#tituloAsunto').val() == "") {
            var mensaje = '"Debe escribir el titulo del asunto"';
            bandera = false;
        } else if ($('#mensaje').val() == "") {
            var mensaje = '"Debe escribir un mensaje"';
            bandera = false;
        }else if ($('#area').val() == "0") {
            var mensaje = '"No hay un área destino"';
            bandera = false;
        }else if ($('#usuario').val() == "0") {
            var mensaje = '"No hay un usuario destino"';
            bandera = false;
        }else if ($('#Checklist').val() == "0" || $('#Checklist').val() == "") {
            var mensaje = '"Seleccione un check para registrar el asunto"';
            bandera = false;
        }




        event.preventDefault();
        if ($(form).bootstrapValidator('validate').has('.has-error').length === 0 && bandera == true) {
            //console.log("todo validado");
            // cargando();
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

                  let data_json = JSON.parse(data);

                    if (data_json.mensaje.toString().indexOf("Error:") === -1) {
                        //swal(data,"","success");                                                                                                            //$("#formEjes")[0].reset();
                                        if(origen == 2){
                                          //padre = $(window.parent.document);
                                          //lanzar adjuntar archivo

                                          adjuntarArchivo_nuevo(2,data_json.asunto_id);
                                          //window.location.href = "../Asuntos_indicadores/estadisticas.php?ejearea=1&idejearea="+areaor;

                                          //$(padre).find('#cerrar_nuevoasunto').click();

                                        }else{
                                          if(origen == 3){
                                            //lanzar adjuntar archivo
                                            adjuntarArchivo_nuevo(3,data_json.asunto_id);
                                            //window.location.href = "../Planeacion/Alta_asunto.php?accion=guardar&tipoPerfil=1&origen=3&idUsuario=" + $("#idUsuario").val() + '';
                                          }else{
                                            //lanzar adjuntar archivo
                                            adjuntarArchivo_nuevo(1,data_json.asunto_id);
                                            //window.location.href = "../Planeacion/Alta_logro_modal.php?nombreUsuario=" + $("#nombreUsuario").val() + "&Perfil=" + $("#tipoPerfil").val() + "&Id_usuario=" + $("#idUsuario").val() + '&Id_actividad=' + actividad + '&Id_categoria=' + categoria + '&Id_subcategoria=' + subcategoria + '&ACME=' + acme + '&Periodo=' + periodo + '&Nombreeje=' + eje + '&ano=' + ano + '&Id_actividadsuperior=' + actividad_superior + '&accion=' + accion+ '&check=0';
                                          }

                                        }
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
                content: mensaje,
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

function llenacategoria(tipo_cat_sub){
  if(tipo_cat_sub == 1){//es paar llenar categorias
    let eje = $('#eje').val();
	let periodo = $('#ano').val();
    $('#cate').load("../../../WEB-INF/Controllers/Asuntos/Acciones_asuntos.php", {"tipoSelect": "categoria", "eje": eje, "periodo": periodo}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/

    });
    limpiacampos(2);
  }
  if(tipo_cat_sub == 2){//es paar llenar subcategorias
    let cat = $('#cate').val();
    $('#subcate').load("../../../WEB-INF/Controllers/Asuntos/Acciones_asuntos.php", {"tipoSelect": "SubCategoría", "cat": cat}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/

    });
    llenaactividades(1);
    limpiacampos(3);
  }


}
function llenapersonas(){
  let area = $('#area').val();
  $('#usuario').load("../../../WEB-INF/Controllers/Asuntos/Acciones_asuntos.php", {"tipoSelect": "usuario", "area": area}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/

  });
}
 function llenaactividades(tipoact){
   let subcat = $('#subcate').val();
   let cat = $('#cate').val();
   let actmet = $('#actmet').val();
   if(tipoact == 1 || subcat == 0){

     //aqui puede que se ponga si es act o metas
     $('#AGlobal').load("../../../WEB-INF/Controllers/Asuntos/Acciones_asuntos.php", {"tipoSelect": "act_cat", "cat": cat,"actmet" : actmet}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/

     });
   }
   if(tipoact == 2){


     $('#AGlobal').load("../../../WEB-INF/Controllers/Asuntos/Acciones_asuntos.php", {"tipoSelect": "act_subcat", "subcat": subcat,"actmet" : actmet}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/

     });
   }

 }

 function llenageneral(){
   let aGlobal = $('#AGlobal').val();
   let actmet = $('#actmet').val();
   $('#AGeneral').load("../../../WEB-INF/Controllers/Asuntos/Acciones_asuntos.php", {"tipoSelect": "general", "aGlobal": aGlobal}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
     llenacheck();
   });

   limpiacampos(4);
 }

 function llenacheck(){
   let aGlobal = $('#AGlobal').val();
   let aGeneral = $('#AGeneral').val();
   let cat = $('#cate').val();
   let subcat = $('#subcate').val();
   let act  = aGlobal;
   if(aGeneral != 0){
     act = aGeneral;
   }
   if(subcat != 0){
     cat = subcat;
   }
   $('#Checklist').load("../../../WEB-INF/Controllers/Asuntos/Acciones_asuntos.php", {"tipoSelect": "check", "act": act,"cate":cat}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/

   });
   limpiacampos(5);
 }

 function llenadatoscheck(){
 let check = $('#Checklist').val();
 let act = $('#AGlobal').val();
 let aGeneral = $('#AGeneral').val();
 let cat = $('#cate').val();
 let subcat = $('#subcate').val();
 if(subcat != 0){
   cat = subcat;
 }

 if(aGeneral != 0 && aGeneral != "" )
  act = aGeneral;
   $.post("../../../WEB-INF/Controllers/Asuntos/Acciones_asuntos.php", {"tipoSelect": "check_info", "check": check , "act" : act,"cate":cat},
       function(data, status) {
           if (status == "success") {
               let obj = JSON.parse(data);
                   $.each(obj, function(i, item) {
                       $('#tituloAsunto').val(item.Nombre);
                       if(item.id_Personas != "" && item.id_Personas != null){
                         $('#3c2').html(item.nombrepersona+"("+item.area_rec+")");
                         $('#area').val(item.idArea);
                         $('#usuario').load("../../../WEB-INF/Controllers/Asuntos/Acciones_asuntos.php", {"tipoSelect": "usuario", "area": item.idArea}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
                            console.log("poniendo persona : "+item.id_Personas);
                            $('#usuario').val(item.id_Personas);
                         });
                       }

                   });
           }
       });



 }

 function llena_area_usr(){
   let persona = $('#usuario').val();
   let area = $('#area').val();
   $.post("../../../WEB-INF/Controllers/Asuntos/Acciones_asuntos.php", {"tipoSelect": "area_persona", "persona": persona}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
     let obj = JSON.parse(data);
         $.each(obj, function(i, item) {
           console.log("valor : "+area);
           if(area == "0"){
             $('#area').val(item.Id_Area);
           }

         });
   });
 }
 function actividadmeta(valor){
   console.log("cambiando valor : "+valor);
   $('#actmet').val(valor);
   limpiacampos(1);
 }

 function limpiacampos(tipocampo){
   switch (tipocampo) {
     case 1:
       $('#eje').val('0');
       $('#cate').val('0');
       $('#subcate').val('0');
       $('#area').val('0');
       $('#usuario').val('0');
       $('#AGlobal').val('0');
       $('#AGeneral').val('0');
       $('#Checklist').val('0');
       $('#tituloAsunto').val("");
       $('#3c2').html("");
       break;
       case 2:
         $('#subcate').val('0');
         $('#area').val('0');
         $('#usuario').val('0');
         $('#AGlobal').val('0');
         $('#AGeneral').val('0');
         $('#Checklist').val('0');
         $('#tituloAsunto').val("");
         $('#3c2').html("");
         break;
         case 3:
           $('#area').val('0');
           $('#usuario').val('0');
           $('#AGeneral').val('0');
           $('#Checklist').val('0');
           $('#tituloAsunto').val("");
           $('#3c2').html("");
           break;
           case 4:
             $('#area').val('0');
             $('#usuario').val('0');
             $('#tituloAsunto').val("");
             $('#3c2').html("");
             break;
             case 5:
               $('#area').val('0');
               $('#usuario').val('0');
               $('#tituloAsunto').val("");
               $('#3c2').html("");
               break;
     default:
     break;

   }


 }

 function adjuntarArchivo_nuevo(tipo_origen,asunto){


   var usr = $( "#idUsuario" ).val();
   let nombreusr = $( "#nombreUsuario" ).val();
   let ideje = $( "#eje" ).val();
   let act =  $( "#actmet" ).val();//si es act
   let categoria = $( "#cate" ).val();
   let subcategoria = $( "#subcate" ).val();
   let act_glob = $( "#AGlobal" ).val();
   let act_gen = $( "#AGeneral" ).val();
   let periodo = 9;
   let check = $( "#Checklist" ).val();
   let tipoentregable = 9;


  $(".h").css('background-color',"#4d4d57");
  $("#Modal_altaarchivo").modal({backdrop: false});

   var frame = $('#frame'); //   ../ArchivosEntregables/Alta_entregable_2.php
      var url = "../Asuntos_indicadores/tipo_archivo.php?accion=guardar&tipoPerfil=1&nombreUsuario="+nombreusr+"&idUsuario="+usr+"&plan=1&Id_eje="+ideje+"&ACME="+act+
  "&cate="+categoria+"&subcate="+subcategoria+"&AGBL="+act_glob+"&AGENE="+act_gen+"&periodo="+periodo+"&check="+check+"&subcheck=&regreso=&tipo_entregable="+tipoentregable+"&origen_asunto="+asunto+"&origen=redactarasunto";
  frame.attr('src',url).show();

 }
