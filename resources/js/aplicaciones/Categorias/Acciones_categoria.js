$(document).ready(function () {
    /*    var accion = $('#accion').val();
       if (accion == 'guardar') {
         
       } */
       habilitar();
   });
   function nuevasubcategoria() {
       var contadorFila = $("#subcate").val();
       var id = parseInt(contadorFila) + 1;
       var html = '<div class="row" id="subcategoriafila' + contadorFila + '">' +
           '<br>'+
           '<hr style="display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0; border-top: 1px solid black;">'+
           '<div class="form-group form-group-sm">' +
           '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO"> Descripción subcategoría:</label>' +
           '<div class="col-md-4 col-sm-4 col-xs-4">' +
           '<textarea class="form-control" id="dessubcate' + id + '" name="dessubcate' + id + '" rows="2"></textarea>' +
           '</div>' +
           '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Orden:</label>'+
           '<div class="col-md-3 col-sm-3 col-xs-3">'+
           '<input type="number" name="ordensubcate' + id + '" id="ordensubcate' + id + '" class="form-control">'+
           '</div>'+
           '<label class="col-md-1 col-sm-1 col-xs-1  control-label" style="left: -40px;"  for="AÑO"><button id="mas" name="mas" type="button" class="btn btn-xs" onclick="eliminarsubcategoria(' + contadorFila + ');"><i class="glyphicon glyphicon-trash"></i></button></label>' +
           '</div>'+
           '<div class="form-group form-group-sm">' +
           '<div id="expodiv" style="" class="divexpo"> '+
           '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO"> Exposición<br> temporal:</label>' +
           '<div class="col-md-3 col-sm-3 col-xs-3">' +
           '<select id="expo' + id + '" class="form-control expo" name="expo' + id + '" style="width: 500px;">' +
           '<option value="">Seleccione</option>' +
           '</select>' +
           '</div>' +
           '</div>' +
           '</div>' +
           '</div>';
   
       $("#nuevasubcategoria").append(html);
       habilitar(id);
       contadorFila++;
       //alert(contadorFila+"mas");
       $("#subcate").val(contadorFila);
       //alert(contadorFila);
   }
   
   function eliminarsubcategoria(id) {
       var contadorFila = $("#subcate").val();
       $("#subcategoriafila" + id).remove();
       contadorFila--;
       $("#subcate").val(contadorFila);
   
   }
   
   function habilitar(contador) {
       if (contador == undefined) {
       var Eje = $("#eje").val();
       if (Eje == 7) {
           $( ".divexpo" ).show();
           var ano = $("#ano").val();
           $('#expo0').load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "exposicion": "exposicion", "anio": ano }, function (data) {
               $(this).select();
           });
       } else {
           $( ".divexpo" ).hide();
       }
       }else{
        var Eje = $("#eje").val();
       if (Eje == 7) {
           $( ".divexpo" ).show();
           var ano = $("#ano").val();
           $('#expo'+contador).load("../../../WEB-INF/Controllers/AcuerdosEscritos/Acciones_acuerdos.php", { "exposicion": "exposicion", "anio": ano }, function (data) {
               $(this).select();
           });
       } else {
           $( ".divexpo" ).hide();
       }
       }
   }
   
   function eliminar(Id) {
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
                   action: function () {
                       $.post('../../../WEB-INF/Controllers/Categorias/Controler_categorias.php', { id: Id, accion: "eliminar" }, function (data) {
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
   function eliminarsubcategoria2(Id) {
       //var con = "'"+controller+"'";
       $.confirm({
           icon: 'glyphicon glyphicon-minus-sign',
           title: '¿Desea eliminar la subcategoría',
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
                       $.post('../../../WEB-INF/Controllers/Categorias/Controler_categorias.php', { id: Id, accion: "eliminarsub" }, function (data) {
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