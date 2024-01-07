function limpiaCombos(object) {        
	for (i=eval(object.length); i >= 1; i--){
			eval(object.options[i]=null);
	}
}
function cargarGlobales() {
	$("#areaD").html(" ");
    //$("#personaD").html(" ");
    $("#areaDestino").attr("value","-");

    limpiaCombos(this.document.form.AGlobal);
    limpiaCombos(this.document.form.AGeneral);
    limpiaCombos(this.document.form.AParticular);
    limpiaCombos(this.document.form.SActividad);
    limpiaCombos(form.destinatario);
    $('#1c2').html('');
    $('#1c3').html('');
    $('#1c4').html('');
    $('#1c5').html('');
    $('#2c2').html('');
    $('#2c3').html('');
    $('#2c4').html('');
    $('#2c5').html('');
    $('#3c2').html('');
    $('#3c3').html('');
    $('#3c4').html('');
    $('#3c5').html('');
    $('#4c2').html('');
    $('#4c3').html('');
    $('#4c4').html('');
    $('#4c5').html('');
    $("#idEEdiv").html("");
    $("#cajaEI").html("");
	var eje = this.document.form.ejes.options[form.ejes.selectedIndex].value;
    var orden = form.ejes.options[form.ejes.selectedIndex].getAttribute("orden");
    //var anio = new Date().getFullYear();
    var anio = '2020';
    var tipo = form.tipoAM.value;
	//var anio = this.document.form.anio.options[form.anio.selectedIndex].value;
    $("#1c3").css("background-color", "");
    $("#1c4").css("background-color", "");
    $("#AGlobal").removeClass("bg-info text-light");
    $("#trGlobal").removeClass("bg-info text-light");
    $("#AGeneral").removeClass("bg-info text-light");
    $("#trGeneral").removeClass("bg-info text-light");
    $("#AParticular").removeClass("bg-info text-light");
    $("#trParticular").removeClass("bg-info text-light");
    $("#trSub").removeClass("bg-info text-light");
    $("#ASub").removeClass("bg-info text-light");
   
    $("#AGeneral").addClass("d-none");

    $("#AParticular").addClass("d-none");
    $("#ASub").addClass("d-none");
    
    if(eje != 7) {
        $("#AGlobal").removeClass("d-none");
        $(".expoC").hide();
        $('#expo option').prop('selected', function() {return this.defaultSelected;});
    } else {
        $('#expo option').prop('selected', function() {return this.defaultSelected;});
        $(".expoC").show();
        $("#AGlobal").addClass("d-none"); 
    }
    
	$.post("indexAct.php",{action:'actividadEje',eje:eje,anio:anio,orden:orden,tipo:tipo}, function( data ){
    	$( "#AGlobal" ).append(data);
    });
    
} 

function cargarGlobalesExpo() {
    $("#areaD").html(" ");
    //$("#personaD").html(" ");
    $("#areaDestino").attr("value","-");

    limpiaCombos(this.document.form.AGlobal);
    limpiaCombos(this.document.form.AGeneral);
    limpiaCombos(this.document.form.AParticular);
    limpiaCombos(this.document.form.SActividad);
    limpiaCombos(form.destinatario);
    $('#1c2').html('');
    $('#1c3').html('');
    $('#1c4').html('');
    $('#1c5').html('');
    $('#2c2').html('');
    $('#2c3').html('');
    $('#2c4').html('');
    $('#2c5').html('');
    $('#3c2').html('');
    $('#3c3').html('');
    $('#3c4').html('');
    $('#3c5').html('');
    $('#4c2').html('');
    $('#4c3').html('');
    $('#4c4').html('');
    $('#4c5').html('');
    $("#idEEdiv").html("");
    $("#cajaEI").html("");
    var eje = this.document.form.ejes.options[form.ejes.selectedIndex].value;
    var orden = form.ejes.options[form.ejes.selectedIndex].getAttribute("orden");
    //var anio = new Date().getFullYear();
    var anio = '2020';
    var tipo = form.tipoAM.value;
    //var anio = this.document.form.anio.options[form.anio.selectedIndex].value;

    $("#AGlobal").removeClass("bg-info text-light");
    $("#trGlobal").removeClass("bg-info text-light");
    $("#AGeneral").removeClass("bg-info text-light");
    $("#trGeneral").removeClass("bg-info text-light");
    $("#AParticular").removeClass("bg-info text-light");
    $("#trParticular").removeClass("bg-info text-light");
    $("#trSub").removeClass("bg-info text-light");
    $("#ASub").removeClass("bg-info text-light");
   
    $("#AGeneral").addClass("d-none");
    $("#AParticular").addClass("d-none");
    $("#ASub").addClass("d-none");
    $("#AGlobal").removeClass("d-none"); 
    
    
    $.post("indexAct.php",{action:'actividadEje',eje:eje,anio:anio,orden:orden,tipo:tipo}, function( data ){
        $( "#AGlobal" ).append(data);
    });
    
} 

function cargarGenerales() {
	//cambia labels
    /*var txt = $("#AGlobal").val();
    $.post("areaActividad.jsp", {actividad: txt, nivel: "0"}, function(result){
        $("#auxD").html(result);
    });*/
    //border border-primary
    $("#trGlobal").addClass("bg-info text-light");
    $("#AGlobal").addClass("bg-info text-light");
    $("#trGeneral").removeClass("bg-info text-light");
    $("#AGeneral").removeClass("bg-info text-light");
    
    $("#1c3").css("background-color", "");
    $("#1c4").css("background-color", "");
    $("#2c3").css("background-color", "");
    $("#2c4").css("background-color", "");
    //$("#AParticular").removeClass("bg-dark text-light");
    //$("#ASub").removeClass("bg-dark text-light");
    
    //$("#AGeneral").removeClass("d-none");
    $("#AParticular").addClass("d-none");
    $("#ASub").addClass("d-none");
    
    //Cambia generales
    limpiaCombos(form.AGeneral);
    limpiaCombos(form.AParticular);
    limpiaCombos(form.SActividad);
    $('#2c2').html('');
    $('#2c3').html('');
    $('#2c4').html('');
    $('#2c5').html('');
    $('#3c2').html('');
    $('#3c3').html('');
    $('#3c4').html('');
    $('#3c5').html('');
    $('#4c2').html('');
    $('#4c3').html('');
    $('#4c4').html('');
    $('#4c5').html('');
    $("#cajaEI").html("");
    var globalD=form.AGlobal.options[form.AGlobal.selectedIndex].value;
    var orden = form.AGlobal.options[form.AGlobal.selectedIndex].getAttribute("orden");
    var nombre=form.AGlobal.options[form.AGlobal.selectedIndex].getAttribute("nombre");
    var idEnc=form.AGlobal.options[form.AGlobal.selectedIndex].getAttribute("idEnc");
    var area=form.AGlobal.options[form.AGlobal.selectedIndex].getAttribute("area");
    var idA=form.AGlobal.options[form.AGlobal.selectedIndex].getAttribute("idA");
    var seleccionar=0;
    //$('#personaD').html(nombre+'('+ area + ')');
    $("#areaD").html(area);
    $("#areaDestino").attr("value",idA);
    if(idA != '') {
        $.post("indexAct.php",{action:'usuarios',idArea:idA}, function( data ) {
            limpiaCombos(form.destinatario);
            $( "#destinatario" ).append(data);
            $("#destinatario").val(idEnc);
        });
    }

    var n = nombre.split("", 1);
    var ap = nombre.split(" ");
    var nombreArea = area;
    var auxA = area.split(" ");
    if(auxA.length > 1) {
        nombreArea = auxA[0].substring(0, 1)+auxA[1].substring(0, 1);
    } else if(auxA.length == 1) {
        nombreArea = area.substring(0, 2);
    }
    $('#1c2').attr("title",nombre+"("+area+")");
    $('#1c2').html(n+''+ap[ap.length-1]+'('+ nombreArea + ')');
    $('#1c3').html('');
    $('#1c4').html('');
    $('#1c5').html('');
	$.post("indexAct.php",{action:'actividad',actividad:globalD,orden:orden}, function( data ) {
        $( "#AGeneral" ).append(data);
        if(form.AGeneral.options.length > 1){
            $("#AGeneral").removeClass("d-none");
        }
    });

    $.post("indexAct.php",{action:'nombreAct',idActividad:globalD}, function( data ) {
        $( "#1c4" ).append('(0)'+data);
        $( "#1c3" ).append('-');
    });
    //limpiaCombos(form.expo);

    if(form.ejes.options[form.ejes.selectedIndex].value == '7') {
        var exp = form.expo.options[form.expo.selectedIndex].value
        $.post("indexAct.php",{action:'entregableAct',idActividad:globalD, expo:exp}, function( data ) {
            var json = data;
            //id del entregable y conteo de entregables
            if(json.idEE != null) {
                var celda = ' <input type="hidden" name="idEE" value="'+json.idEE+'">';
                $("#idEEdiv").html(celda);

                if(json.icero == 0 && json.ipreliminar == 0 && json.iproceso == 0 && json.ifinal == 0) {
                    $("#1c3").css("background-color", "red");$( "#1c3" ).html("s/insumo(s)"); 
                } else {
                    var tot=0;
                    if(json.itotal!=0)
                        tot=Math.round((json.iavance/json.itotal)* 100) / 100;
                    var insumo =  '';
                    if(json.ifinal != 0) insumo += '<span class="badge badge-ent" style="background-color:#33d62b; color:white;">'+json.ifinal+' </span>';
                    if(json.iproceso != 0) insumo += '<span class="badge badge-ent" style="background-color:#f0ee35; color:black;">'+json.iproceso+'</span>';
                    if(json.ipreliminar != 0) insumo += '<span class="badge badge-ent" style="background-color:#ff8f00; color:black;">'+json.ipreliminar+'</span>';
                    if(json.icero != 0) insumo += '<span class="badge badge-ent" style="background-color:red; color:white;">'+json.icero+'</span> ';
                    insumo +=  '('+tot+'%)';
                    $( "#1c3" ).html(insumo);
                    $( "#1c3" ).attr('onClick','detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',1)');
                }

                if(json.cero == 0 && json.preliminar == 0 && json.proceso == 0 && json.final == 0){
                    $("#1c4").css("background-color", "red");$( "#1c4" ).html("s/insumo(s)"); 
                } else {
                    var entregable = '';
                    if(json.final != 0) entregable += '<span class="badge badge-ent" style="background-color:#33d62b; color:white;">'+json.final+' </span>';
                    if(json.proceso != 0) entregable += '<span class="badge badge-ent" style="background-color:#f0ee35; color:black;">'+json.proceso+'</span>';
                    if(json.preliminar != 0) entregable += '<span class="badge badge-ent" style="background-color:#ff8f00; color:black;">'+json.preliminar+'</span>';
                    if(json.cero != 0) entregable += '<span class="badge badge-ent" style="background-color:red; color:white;">'+json.cero+'</span> ';
                    entregable += '('+ Math.round((json.avance/json.total) * 100) / 100+'%) ' + json.nombre;
                    $('#1c4').html(entregable);
                    $('#1c4').attr("title",json.nombre);
                    $("#1c4").attr('onClick','detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',2)');

                    var detalle = '<button type="button" class="cnt-sm btn btn-light" onclick="detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',0);"><i class="fa fa-search" aria-hidden="true"></i></button>';
                    $( "#1c5" ).html(detalle); 
                }
            } /*else if(json.nombre != null) {
                $('#1c4').html('(0)'+json.nombre);
            }*/
        });
    } else {
        $.post("indexAct.php",{action:'catEnt',idActividad:globalD}, function( data ) {
            
            var json = data;
            //id del entregable y conteo de entregables
            if(json.idEE != null) {
                var celda = ' <input type="hidden" name="idEE" value="'+json.idEE+'">';
                $("#idEEdiv").html(celda);

                if(json.icero == 0 && json.ipreliminar == 0 && json.iproceso == 0 && json.ifinal == 0) {
                    $("#1c3").css("background-color", "red");$( "#1c3" ).html("s/insumo(s)"); 
                } else {
                    var tot=0;
                    if(json.itotal!=0)
                        tot=Math.round((json.iavance/json.itotal)* 100) / 100;
                    var insumo =  '';
                    if(json.ifinal != 0) insumo += '<span class="badge badge-ent" style="background-color:#33d62b; color:white;">'+json.ifinal+' </span>';
                    if(json.iproceso != 0) insumo += '<span class="badge badge-ent" style="background-color:#f0ee35; color:black;">'+json.iproceso+'</span>';
                    if(json.ipreliminar != 0) insumo += '<span class="badge badge-ent" style="background-color:#ff8f00; color:black;">'+json.ipreliminar+'</span>';
                    if(json.icero != 0) insumo += '<span class="badge badge-ent" style="background-color:red; color:white;">'+json.icero+'</span> ';
                    insumo +=  '('+tot+'%)';
                    $( "#1c3" ).html(insumo);
                    $( "#1c3" ).attr('onClick','detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',1)');
                }

                if(json.cero == 0 && json.preliminar == 0 && json.proceso == 0 && json.final == 0){
                    $("#1c4").css("background-color", "red");$( "#1c4" ).html("s/insumo(s)"); 
                } else {
                    var entregable = '';
                    if(json.final != 0) entregable += '<span class="badge badge-ent" style="background-color:#33d62b; color:white;">'+json.final+' </span>';
                    if(json.proceso != 0) entregable += '<span class="badge badge-ent" style="background-color:#f0ee35; color:black;">'+json.proceso+'</span>';
                    if(json.preliminar != 0) entregable += '<span class="badge badge-ent" style="background-color:#ff8f00; color:black;">'+json.preliminar+'</span>';
                    if(json.cero != 0) entregable += '<span class="badge badge-ent" style="background-color:red; color:white;">'+json.cero+'</span> ';
                    entregable += '('+ Math.round((json.avance/json.total) * 100) / 100+'%) ' + json.nombre;
                    $('#1c4').html(entregable);
                    $('#1c4').attr("title",json.nombre);
                    $("#1c4").attr('onClick','detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',2)');

                    var detalle = '<button type="button" class="cnt-sm btn btn-light" onclick="detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',0);"><i class="fa fa-search" aria-hidden="true"></i></button>';
                    $( "#1c5" ).html(detalle); 
                }
            }
            /*
            var select = '<select id="idEE1" name="idEE" class="form-control form-control-sm cnt-sm s2" onChange="cambiarEntregable(\'1\');">'
                          +'<option value="0" selected>Selecciona...</option>'
                          + data
                          +'</select>';
            if(data != '') {
                $( "#1c4" ).html(select);
            }*/
        });
    } 
    
    /*var sel = document.getElementById('destinatario');
    var opts = sel.options;
    //alert(idEnc);
    for (var opt, j = 0; opt = opts[j]; j++) {
        //alert(opt.value);
        if (opt.value == idEnc) {
            //alert(opt.value);
            //document.getElementById('destinatario').selectedIndex = j;
            //break;
        }
    }*/
} 

function cargarParticulares() {
    $("#trGlobal").removeClass("bg-info text-light");
	$("#AGlobal").removeClass("bg-info text-light");
    $("#trGeneral").addClass("bg-info text-light");
    $("#AGeneral").addClass("bg-info text-light");
    $("#trParticular").removeClass("bg-info text-light");
    $("#AParticular").removeClass("bg-info text-light");
    $("#1c3").css("background-color", "");
    $("#1c4").css("background-color", "");
    $("#2c3").css("background-color", "");
    $("#2c4").css("background-color", "");
    $("#3c3").css("background-color", "");
    $("#3c4").css("background-color", "");
    //$("#ASub").removeClass("bg-dark text-light");
    
    //$("#AParticular").removeClass("d-none");
    $("#ASub").addClass("d-none");
    
    //Cambia generales
    limpiaCombos(form.AParticular);
    limpiaCombos(form.SActividad);
    $('#3c2').html('');
    $('#3c3').html('');
    $('#3c4').html('');
    $('#3c5').html('');
    $('#4c2').html('');
    $('#4c3').html('');
    $('#4c4').html('');
    $('#4c5').html('');
    $("#cajaEI").html("");
    var general=form.AGeneral.options[form.AGeneral.selectedIndex].value;
    var orden=form.AGeneral.options[form.AGeneral.selectedIndex].getAttribute("orden");
    var nombre=form.AGeneral.options[form.AGeneral.selectedIndex].getAttribute("nombre");
    var idEnc=form.AGlobal.options[form.AGlobal.selectedIndex].getAttribute("idEnc");
    var area=form.AGeneral.options[form.AGeneral.selectedIndex].getAttribute("area");
    var idA=form.AGeneral.options[form.AGeneral.selectedIndex].getAttribute("idA");
    //$('#personaD').html(nombre+'('+ area + ')');
    $("#areaD").html(area);
    $("#areaDestino").attr("value",idA);

    if(idA != '') {
        $.post("indexAct.php",{action:'usuarios',idArea:idA}, function( data ) {
            limpiaCombos(form.destinatario);
            $( "#destinatario" ).append(data);
            $("#destinatario").val(idEnc);
        });
    }

    var n = nombre.split("", 1);
    var ap = nombre.split(" ");
    var nombreArea = area;
    var auxA = area.split(" ");
    if(auxA.length > 1) {
        nombreArea = auxA[0].substring(0, 1)+auxA[1].substring(0, 1);
    } else if(auxA.length == 1) {
        nombreArea = area.substring(0, 2);
    }
    $('#2c2').attr("title",nombre+"("+area+")");
    $('#2c2').html(n+''+ap[ap.length-1]+'('+ nombreArea+ ')');
    $('#2c3').html('');
    $('#2c4').html('');
    $('#2c5').html('');

	$.post("indexAct.php",{action:'actividad',actividad:general,orden:orden}, function( data ) {
        $( "#AParticular" ).append(data);
        if(form.AParticular.options.length > 1){
            $("#AParticular").removeClass("d-none");
        }
    });

    $.post("indexAct.php",{action:'nombreAct',idActividad:general}, function( data ) {
        $( "#2c4" ).append('(0)'+data);
        $( "#2c3" ).append('-');
    });

    if(form.ejes.options[form.ejes.selectedIndex].value == '7'){
        var exp = form.expo.options[form.expo.selectedIndex].value
        $.post("indexAct.php",{action:'entregableAct',idActividad:general, expo:exp}, function( data ){
            var json = data;
            //id del entregable y conteo de entregables
            if(json.idEE != null) {
                var celda = ' <input type="hidden" name="idEE" value="'+json.idEE+'">';
                $("#idEEdiv").html(celda);

                if(json.icero == 0 && json.ipreliminar == 0 && json.iproceso == 0 && json.ifinal == 0) {
                    $("#2c3").css("background-color", "red");$( "#2c3" ).html("s/insumo(s)"); 
                } else {
                    var tot=0;
                    if(json.itotal!=0)
                        tot=Math.round((json.iavance/json.itotal)* 100) / 100;
                    var insumo =  '';
                    if(json.ifinal != 0) insumo += '<span class="badge badge-ent" style="background-color:#33d62b; color:white;">'+json.ifinal+' </span>';
                    if(json.iproceso != 0) insumo += '<span class="badge badge-ent" style="background-color:#f0ee35; color:black;">'+json.iproceso+'</span>';
                    if(json.ipreliminar != 0) insumo += '<span class="badge badge-ent" style="background-color:#ff8f00; color:black;">'+json.ipreliminar+'</span>';
                    if(json.icero != 0) insumo += '<span class="badge badge-ent" style="background-color:red; color:white;">'+json.icero+'</span> ';
                    insumo +=  '('+tot+'%)';
                    $( "#2c3" ).html(insumo);
                    $( "#2c3" ).attr('onClick','detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',1)');
                }

                if(json.cero == 0 && json.preliminar == 0 && json.proceso == 0 && json.final == 0){
                    $("#2c4").css("background-color", "red");$( "#2c4" ).html("s/insumo(s)"); 
                } else {
                    var entregable = '';
                    if(json.final != 0) entregable += '<span class="badge badge-ent" style="background-color:#33d62b; color:white;">'+json.final+' </span>';
                    if(json.proceso != 0) entregable += '<span class="badge badge-ent" style="background-color:#f0ee35; color:black;">'+json.proceso+'</span>';
                    if(json.preliminar != 0) entregable += '<span class="badge badge-ent" style="background-color:#ff8f00; color:black;">'+json.preliminar+'</span>';
                    if(json.cero != 0) entregable += '<span class="badge badge-ent" style="background-color:red; color:white;">'+json.cero+'</span> ';
                    entregable += '('+ Math.round((json.avance/json.total) * 100) / 100+'%) ' + json.nombre;
                    $('#2c4').html(entregable);
                    $('#2c4').attr("title",json.nombre);
                    $("#2c4").attr('onClick','detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',2)');

                    var detalle = '<button type="button" class="cnt-sm btn btn-light" onclick="detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',0);"><i class="fa fa-search" aria-hidden="true"></i></button>';
                    $( "#2c5" ).html(detalle); 
                }

            } 
        });
    } else {
        $.post("indexAct.php",{action:'catEnt',idActividad:general}, function( data ){
            var json = data;
            //id del entregable y conteo de entregables
            if(json.idEE != null) {
                var celda = ' <input type="hidden" name="idEE" value="'+json.idEE+'">';
                $("#idEEdiv").html(celda);
                if(json.icero == 0 && json.ipreliminar == 0 && json.iproceso == 0 && json.ifinal == 0) {
                    $("#2c3").css("background-color", "red");$( "#2c3" ).html("s/insumo(s)"); 
                } else {
                    var tot=0;
                    if(json.itotal!=0)
                        tot=Math.round((json.iavance/json.itotal)* 100) / 100;
                    var insumo =  '';
                    if(json.ifinal != 0) insumo += '<span class="badge badge-ent" style="background-color:#33d62b; color:white;">'+json.ifinal+' </span>';
                    if(json.iproceso != 0) insumo += '<span class="badge badge-ent" style="background-color:#f0ee35; color:black;">'+json.iproceso+'</span>';
                    if(json.ipreliminar != 0) insumo += '<span class="badge badge-ent" style="background-color:#ff8f00; color:black;">'+json.ipreliminar+'</span>';
                    if(json.icero != 0) insumo += '<span class="badge badge-ent" style="background-color:red; color:white;">'+json.icero+'</span> ';
                    insumo +=  '('+tot+'%)';
                    $( "#2c3" ).html(insumo);
                    $( "#2c3" ).attr('onClick','detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',1)');
                }

                if(json.cero == 0 && json.preliminar == 0 && json.proceso == 0 && json.final == 0){
                    $("#2c4").css("background-color", "red");$( "#2c4" ).html("s/insumo(s)"); 
                } else {
                    var entregable = '';
                    if(json.final != 0) entregable += '<span class="badge badge-ent" style="background-color:#33d62b; color:white;">'+json.final+' </span>';
                    if(json.proceso != 0) entregable += '<span class="badge badge-ent" style="background-color:#f0ee35; color:black;">'+json.proceso+'</span>';
                    if(json.preliminar != 0) entregable += '<span class="badge badge-ent" style="background-color:#ff8f00; color:black;">'+json.preliminar+'</span>';
                    if(json.cero != 0) entregable += '<span class="badge badge-ent" style="background-color:red; color:white;">'+json.cero+'</span> ';
                    entregable += '('+ Math.round((json.avance/json.total) * 100) / 100+'%) ' + json.nombre;
                    $('#2c4').html(entregable);
                    $('#2c4').attr("title",json.nombre);
                    $("#2c4").attr('onClick','detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',2)');

                    var detalle = '<button type="button" class="cnt-sm btn btn-light" onclick="detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',0);"><i class="fa fa-search" aria-hidden="true"></i></button>';
                    $( "#2c5" ).html(detalle); 
                }
            } 
        });
    }
} 

function cargarSub() {
    $("#trGlobal").removeClass("bg-info text-light");
	$("#AGlobal").removeClass("bg-info text-light");
    $("#trGeneral").removeClass("bg-info text-light");
    $("#AGeneral").removeClass("bg-info text-light");
    $("#trParticular").addClass("bg-info text-light");
    $("#AParticular").addClass("bg-info text-light");
    $("#trSub").removeClass("bg-info text-light");
    $("#ASub").removeClass("bg-info text-light");
    $("#2c3").css("background-color", "");
    $("#2c4").css("background-color", "");
    $("#3c3").css("background-color", "");
    $("#3c4").css("background-color", "");
    $("#4c3").css("background-color", "");
    $("#4c4").css("background-color", "");
    //$("#ASub").removeClass("d-none");
    
    //Cambia generales
    limpiaCombos(form.SActividad);
    $('#4c2').html('');
    $('#4c3').html('');
    $('#4c4').html('');
    $('#4c5').html('');
    $("#cajaEI").html("");
    var part=form.AParticular.options[form.AParticular.selectedIndex].value;
    var orden=form.AParticular.options[form.AParticular.selectedIndex].getAttribute("orden");
    var nombre=form.AParticular.options[form.AParticular.selectedIndex].getAttribute("nombre");
    var idEnc=form.AGlobal.options[form.AGlobal.selectedIndex].getAttribute("idEnc");
    var area=form.AParticular.options[form.AParticular.selectedIndex].getAttribute("area");
    var idA=form.AParticular.options[form.AParticular.selectedIndex].getAttribute("idA");
    //$('#personaD').html(nombre+'('+ area + ')');
    $("#areaD").html(area);
    $("#areaDestino").attr("value",idA);
    if(idA != '') {
        $.post("indexAct.php",{action:'usuarios',idArea:idA}, function( data ) {
            limpiaCombos(form.destinatario);
            $( "#destinatario" ).append(data);
            $("#destinatario").val(idEnc);
        });
    }
    var n = nombre.split("", 1);
    var ap = nombre.split(" ");
    var nombreArea = area;
    var auxA = area.split(" ");
    if(auxA.length > 1) {
        nombreArea = auxA[0].substring(0, 1)+auxA[1].substring(0, 1);
    } else if(auxA.length == 1) {
        nombreArea = area.substring(0, 2);
    }
    $('#3c2').attr("title",nombre+"("+area+")");
    $('#3c2').html(n+''+ap[ap.length-1]+'('+ nombreArea + ')');
    $('#3c3').html('');
    $('#3c4').html('');
    $('#3c5').html('');
	$.post("indexAct.php",{action:'actividad',actividad:part,orden:orden}, function( data ) {
        $( "#ASub" ).append(data);
        if(form.ASub.options.length > 1){
            $("#ASub").removeClass("d-none");
        }
    });

    $.post("indexAct.php",{action:'nombreAct',idActividad:part}, function( data ) {
        $( "#3c4" ).append('(0)'+data);
        $( "#3c3" ).append('-');
    });

    if(form.ejes.options[form.ejes.selectedIndex].value == '7') {
        var exp = form.expo.options[form.expo.selectedIndex].value
        $.post("indexAct.php",{action:'entregableAct',idActividad:part, expo:exp}, function( data ){
            var json = data;
            //id del entregable y conteo de entregables
            if(json.idEE != null) {
                var celda = ' <input type="hidden" name="idEE" value="'+json.idEE+'">';
                $("#idEEdiv").html(celda);

                if(json.icero == 0 && json.ipreliminar == 0 && json.iproceso == 0 && json.ifinal == 0) {
                    $("#3c3").css("background-color", "red");$( "#3c3" ).html("s/insumo(s)"); 
                } else {
                    var tot=0;
                    if(json.itotal!=0)
                        tot=Math.round((json.iavance/json.itotal)* 100) / 100;
                    var insumo =  '';
                    if(json.ifinal != 0) insumo += '<span class="badge badge-ent" style="background-color:#33d62b; color:white;">'+json.ifinal+' </span>';
                    if(json.iproceso != 0) insumo += '<span class="badge badge-ent" style="background-color:#f0ee35; color:black;">'+json.iproceso+'</span>';
                    if(json.ipreliminar != 0) insumo += '<span class="badge badge-ent" style="background-color:#ff8f00; color:black;">'+json.ipreliminar+'</span>';
                    if(json.icero != 0) insumo += '<span class="badge badge-ent" style="background-color:red; color:white;">'+json.icero+'</span> ';
                    insumo +=  '('+tot+'%)';
                    $( "#3c3" ).html(insumo);
                    $( "#3c3" ).attr('onClick','detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',1)');
                }

                if(json.cero == 0 && json.preliminar == 0 && json.proceso == 0 && json.final == 0){
                    $("#3c4").css("background-color", "red");$( "#3c4" ).html("s/insumo(s)"); 
                } else {
                    var entregable = '';
                    if(json.final != 0) entregable += '<span class="badge badge-ent" style="background-color:#33d62b; color:white;">'+json.final+' </span>';
                    if(json.proceso != 0) entregable += '<span class="badge badge-ent" style="background-color:#f0ee35; color:black;">'+json.proceso+'</span>';
                    if(json.preliminar != 0) entregable += '<span class="badge badge-ent" style="background-color:#ff8f00; color:black;">'+json.preliminar+'</span>';
                    if(json.cero != 0) entregable += '<span class="badge badge-ent" style="background-color:red; color:white;">'+json.cero+'</span> ';
                    entregable += '('+ Math.round((json.avance/json.total) * 100) / 100+'%) ' + json.nombre;
                    $('#3c4').html(entregable);
                    $('#3c4').attr("title",json.nombre);
                    $("#3c4").attr('onClick','detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',2)');

                    var detalle = '<button type="button" class="cnt-sm btn btn-light" onclick="detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',0);"><i class="fa fa-search" aria-hidden="true"></i></button>';
                    $( "#3c5" ).html(detalle); 
                }

            } 
        });
    } else {
        $.post("indexAct.php",{action:'catEnt',idActividad:part}, function( data ) {
            var json = data;
            //id del entregable y conteo de entregables
            if(json.idEE != null) {
                var celda = ' <input type="hidden" name="idEE" value="'+json.idEE+'">';
                $("#idEEdiv").html(celda);

                if(json.icero == 0 && json.ipreliminar == 0 && json.iproceso == 0 && json.ifinal == 0) {
                    $("#3c3").css("background-color", "red");$( "#3c3" ).html("s/insumo(s)"); 
                } else {
                    var tot=0;
                    if(json.itotal!=0)
                        tot=Math.round((json.iavance/json.itotal)* 100) / 100;
                    var insumo =  '';
                    if(json.ifinal != 0) insumo += '<span class="badge badge-ent" style="background-color:#33d62b; color:white;">'+json.ifinal+' </span>';
                    if(json.iproceso != 0) insumo += '<span class="badge badge-ent" style="background-color:#f0ee35; color:black;">'+json.iproceso+'</span>';
                    if(json.ipreliminar != 0) insumo += '<span class="badge badge-ent" style="background-color:#ff8f00; color:black;">'+json.ipreliminar+'</span>';
                    if(json.icero != 0) insumo += '<span class="badge badge-ent" style="background-color:red; color:white;">'+json.icero+'</span> ';
                    insumo +=  '('+tot+'%)';
                    $( "#3c3" ).html(insumo);
                    $( "#3c3" ).attr('onClick','detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',1)');
                }

                if(json.cero == 0 && json.preliminar == 0 && json.proceso == 0 && json.final == 0){
                    $("#3c4").css("background-color", "red");$( "#3c4" ).html("s/insumo(s)"); 
                } else {
                    var entregable = '';
                    if(json.final != 0) entregable += '<span class="badge badge-ent" style="background-color:#33d62b; color:white;">'+json.final+' </span>';
                    if(json.proceso != 0) entregable += '<span class="badge badge-ent" style="background-color:#f0ee35; color:black;">'+json.proceso+'</span>';
                    if(json.preliminar != 0) entregable += '<span class="badge badge-ent" style="background-color:#ff8f00; color:black;">'+json.preliminar+'</span>';
                    if(json.cero != 0) entregable += '<span class="badge badge-ent" style="background-color:red; color:white;">'+json.cero+'</span> ';
                    entregable += '('+ Math.round((json.avance/json.total) * 100) / 100+'%) ' + json.nombre;
                    $('#3c4').html(entregable);
                    $('#3c4').attr("title",json.nombre);
                    $("#3c4").attr('onClick','detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',2)');

                    var detalle = '<button type="button" class="cnt-sm btn btn-light" onclick="detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',0);"><i class="fa fa-search" aria-hidden="true"></i></button>';
                    $( "#3c5" ).html(detalle); 
                }
            }
        });
    }

} 

function cargarSub2() {
    $("#trGlobal").removeClass("bg-info text-light");
	$("#AGlobal").removeClass("bg-info text-light");
    $("#trGeneral").removeClass("bg-info text-light");
    $("#AGeneral").removeClass("bg-info text-light");
    $("#trParticular").removeClass("bg-info text-light");
    $("#AParticular").removeClass("bg-info text-light");
    $("#trSub").addClass("bg-info text-light");
    $("#ASub").addClass("bg-info text-light");
    $("#4c3").css("background-color", "");
    $("#4c4").css("background-color", "");
    $("#3c3").css("background-color", "");
    $("#3c4").css("background-color", "");

    var sub=form.SActividad.options[form.SActividad.selectedIndex].value;
    var nombre=form.SActividad.options[form.SActividad.selectedIndex].getAttribute("nombre");
    var idEnc=form.AGlobal.options[form.AGlobal.selectedIndex].getAttribute("idEnc");
    var area=form.SActividad.options[form.SActividad.selectedIndex].getAttribute("area");
    var idA=form.SActividad.options[form.SActividad.selectedIndex].getAttribute("idA");
    //$('#personaD').html(nombre+'('+ area + ')');
    $("#areaD").html(area);
    $("#areaDestino").attr("value",idA);
    if(idA != '') {
        $.post("indexAct.php",{action:'usuarios',idArea:idA}, function( data ) {
            limpiaCombos(form.destinatario);
            $( "#destinatario" ).append(data);
            $("#destinatario").val(idEnc);
        });
    }
    var n = nombre.split("", 1);
    var ap = nombre.split(" ");
    var nombreArea = area;
    var auxA = area.split(" ");
    if(auxA.length > 1) {
        nombreArea = auxA[0].substring(0, 1)+auxA[1].substring(0, 1);
    } else if(auxA.length == 1) {
        nombreArea = area.substring(0, 2);
    }
    $('#4c2').attr("title",nombre+"("+area+")");
    $('#4c2').html(n+''+ap[ap.length-1]+'('+ nombreArea + ')');
    $('#4c3').html('');
    $('#4c4').html('');
    $('#4c5').html('');
    $("#cajaEI").html("");
    $.post("indexAct.php",{action:'nombreAct',idActividad:sub}, function( data ) {
        $( "#4c4" ).append('(0)'+data);
        $( "#4c3" ).append('-');
    });

    if(form.ejes.options[form.ejes.selectedIndex].value == '7') {
        var exp = form.expo.options[form.expo.selectedIndex].value
        $.post("indexAct.php",{action:'entregableAct',idActividad:sub, expo:exp}, function( data ){
            var json = data;
            //id del entregable y conteo de entregables
            if(json.idEE != null) {
                var celda = ' <input type="hidden" name="idEE" value="'+json.idEE+'">';
                $("#idEEdiv").html(celda);
                
                if(json.icero == 0 && json.ipreliminar == 0 && json.iproceso == 0 && json.ifinal == 0) {
                    $("#4c3").css("background-color", "red");$( "#4c3" ).html("s/insumo(s)"); 
                } else {
                    var tot=0;
                    if(json.itotal!=0)
                        tot=Math.round((json.iavance/json.itotal)* 100) / 100;
                    var insumo =  '';
                    if(json.ifinal != 0) insumo += '<span class="badge badge-ent" style="background-color:#33d62b; color:white;">'+json.ifinal+' </span>';
                    if(json.iproceso != 0) insumo += '<span class="badge badge-ent" style="background-color:#f0ee35; color:black;">'+json.iproceso+'</span>';
                    if(json.ipreliminar != 0) insumo += '<span class="badge badge-ent" style="background-color:#ff8f00; color:black;">'+json.ipreliminar+'</span>';
                    if(json.icero != 0) insumo += '<span class="badge badge-ent" style="background-color:red; color:white;">'+json.icero+'</span> ';
                    insumo +=  '('+tot+'%)';
                    $( "#4c3" ).html(insumo);
                    $( "#4c3" ).attr('onClick','detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',1)');
                }

                if(json.cero == 0 && json.preliminar == 0 && json.proceso == 0 && json.final == 0){
                    $("#4c4").css("background-color", "red");$( "#4c4" ).html("s/insumo(s)"); 
                } else {
                    var entregable = '';
                    if(json.final != 0) entregable += '<span class="badge badge-ent" style="background-color:#33d62b; color:white;">'+json.final+' </span>';
                    if(json.proceso != 0) entregable += '<span class="badge badge-ent" style="background-color:#f0ee35; color:black;">'+json.proceso+'</span>';
                    if(json.preliminar != 0) entregable += '<span class="badge badge-ent" style="background-color:#ff8f00; color:black;">'+json.preliminar+'</span>';
                    if(json.cero != 0) entregable += '<span class="badge badge-ent" style="background-color:red; color:white;">'+json.cero+'</span> ';
                    entregable += '('+ Math.round((json.avance/json.total) * 100) / 100+'%) ' + json.nombre;
                    $('#4c4').html(entregable);
                    $('#4c4').attr("title",json.nombre);
                    $("#4c4").attr('onClick','detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',2)');

                    var detalle = '<button type="button" class="cnt-sm btn btn-light" onclick="detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',0);"><i class="fa fa-search" aria-hidden="true"></i></button>';
                    $( "#4c5" ).html(detalle); 
                }
            } 
        });
    } else {
        $.post("indexAct.php",{action:'catEnt',idActividad:sub}, function( data ) {
            var json = data;
            //id del entregable y conteo de entregables
            if(json.idEE != null) {
                var celda = ' <input type="hidden" name="idEE" value="'+json.idEE+'">';
                $("#idEEdiv").html(celda);
                if(json.icero == 0 && json.ipreliminar == 0 && json.iproceso == 0 && json.ifinal == 0) {
                    $("#4c3").css("background-color", "red");$( "#4c3" ).html("s/insumo(s)"); 
                } else {
                    var tot=0;
                    if(json.itotal!=0)
                        tot=Math.round((json.iavance/json.itotal)* 100) / 100;
                    var insumo =  '';
                    if(json.ifinal != 0) insumo += '<span class="badge badge-ent" style="background-color:#33d62b; color:white;">'+json.ifinal+' </span>';
                    if(json.iproceso != 0) insumo += '<span class="badge badge-ent" style="background-color:#f0ee35; color:black;">'+json.iproceso+'</span>';
                    if(json.ipreliminar != 0) insumo += '<span class="badge badge-ent" style="background-color:#ff8f00; color:black;">'+json.ipreliminar+'</span>';
                    if(json.icero != 0) insumo += '<span class="badge badge-ent" style="background-color:red; color:white;">'+json.icero+'</span> ';
                    insumo +=  '('+tot+'%)';
                    $( "#4c3" ).html(insumo);
                    $( "#4c3" ).attr('onClick','detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',1)');
                }

                if(json.cero == 0 && json.preliminar == 0 && json.proceso == 0 && json.final == 0){
                    $("#4c4").css("background-color", "red");$( "#4c4" ).html("s/insumo(s)"); 
                } else {
                    var entregable = '';
                    if(json.final != 0) entregable += '<span class="badge badge-ent" style="background-color:#33d62b; color:white;">'+json.final+' </span>';
                    if(json.proceso != 0) entregable += '<span class="badge badge-ent" style="background-color:#f0ee35; color:black;">'+json.proceso+'</span>';
                    if(json.preliminar != 0) entregable += '<span class="badge badge-ent" style="background-color:#ff8f00; color:black;">'+json.preliminar+'</span>';
                    if(json.cero != 0) entregable += '<span class="badge badge-ent" style="background-color:red; color:white;">'+json.cero+'</span> ';
                    entregable += '('+ Math.round((json.avance/json.total) * 100) / 100+'%) ' + json.nombre;
                    $('#4c4').html(entregable);
                    $('#4c4').attr("title",json.nombre);
                    $("#4c4").attr('onClick','detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',2)');

                    var detalle = '<button type="button" class="cnt-sm btn btn-light" onclick="detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',0);"><i class="fa fa-search" aria-hidden="true"></i></button>';
                    $( "#4c5" ).html(detalle); 
                }
            }
        });
    }
}

function cambiarExpo() {
    var anio = form.anioExpo.options[form.anioExpo.selectedIndex].value;

    limpiaCombos(form.expo);

    $.post("indexAct.php",{action:'exposiciones',anio:anio}, function( data ){
        $( "#expo" ).append(data);
    });
}

function cambiarUsuarios() {

}

function cambiarEntregable(nivel) {
    var id = form.idEE.options[form.idEE.selectedIndex].value
    var detalle = '<button type="button" class="cnt-sm btn btn-light" onclick="detalleEntregable('+id+','+form.idUsuario.value+','+form.idAreaU.value+',0);"><i class="fa fa-search" aria-hidden="true"></i></button>';
    $( "#"+nivel+"c5" ).html(detalle);

    $.post('indexAct.php',{action: 'insumosGeneral', idEntregable:id}, function(data) {
        var json = data;
        if(json.itotal > 0) {
            var tot = json.iavance;
            if(json.iavance == null)
                tot = 0
            var insumo = json.ifinal +'/'+json.itotal+' ('+ tot/json.itotal+'%)';
            $( "#"+nivel+"c3" ).html(insumo);
        } else {
            $( "#"+nivel+"c3" ).html("s/insumo(s)");
        }
    });
}

function validateForm() {
    //alert(form.eleccion.value);
    if(form.eleccion.value == ''){
        alert("Selecciona el tipo (problemática, solicitud, conocimiento, sugerencia)");
        return false;
    }
    var x = form.AGlobal.value;
    if (x == "0") {
        alert("Debe seleccionar una actividad o meta");
        return false;
    }

    if(form.areaDestino.value == '-') {
        alert("No hay un área destino");
        return false;
    }
    /*if(form.destinatario.value == '0') {
        alert("No hay un usuario destino");
        return false;
    }*/
        
    if(form.titulo.value == '') {
        alert("Debe escribir el titulo");
        return false;
    }
    
    if(form.mensaje.value == '') {
        alert("Escriba un mensaje");
        return false;
    }
    if(form.idEE != null) {
        if(form.idEE.value == '0') {
            if(confirm("Desea continuar sin entregable"))
                return true;
            else
                form.expo.focus();
                return false;
        }
    }else {
        if(confirm("Desea continuar sin entregable"))
            return true;
        else
            form.expo.focus();
            return false;
    }
}

function detalleEntregable(idEntregable, idUsuario, idAreaU,aux){
    $("#cajaEI").slideDown("slow");
    $.post("indexAct.php",{action:'entregables',idEntregable:idEntregable,idUsuario:idUsuario,idAreaU:idAreaU,interno:'1',aux:aux}, function( data ) {
        $( "#cajaEI" ).html(data);

    });
}
