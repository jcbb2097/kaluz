<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="libs/css/chat.css" >
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://use.fontawesome.com/779a643cc8.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<script src="libs/js/chat.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>


</head>
<body>
	<style>
		.cnt-sm {
            height: 26px !important; 
            line-height: 20px !important;
            font-size:10px !important;
            padding-top: 0px !important;
            padding-bottom: 0px !important;
        }
        .btn.btn-danger.active,
        .btn.btn-danger:active {
            background-color:red !important;
            color: white !important;
        }
        .btn.btn-secondary.active,
        .btn.btn-secondary:active {
            background-color:#4D4D57  !important;
            color: white !important;
        }
        .btnTipo {
            width: 90.45px;
            height: 26px;
            font-size: 10px;
            border-radius: 0px;
            font-family: 'Muli', sans-serif;
        }
        table.actTable {
            background-color:#f9f9f9;
            font-size: 10px;
        }
        table.actTable td, table.actTable th {
            /*border: none;*/
            font-family: 'Muli', sans-serif;
            /*padding: 0.2rem;*/
            white-space: nowrap;
            word-break: keep-all;
            border: 1px solid #ddd;
        }
        table.actTable th.actTable {
            font-size: 10px;
            color: #ffffff;
            background-color: #4D4D57;
            min-height: 20px;
            /*max-width: 80px;*/
            border: none;
            text-align: left;
        }

        .nc1 {
            min-width: 331.65px !important;
            max-width: 331.65px !important;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .nc2 {
            min-width: 90.45px !important;
            max-width: 90.45px !important;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .nc3 {
            min-width: 150.75px !important;
            max-width: 150.75px !important;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .nc4 {
            min-width: 150.75px;
            max-width: 150.75px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .nc5  {
            min-width: 30.15px;
            max-width: 30.15px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .s1 {
            min-width: 360px;
            max-width: 360px;
            overflow: hidden;
            text-overflow: ellipsis;
            background-color: transparent;
        }
        .s2 {
            min-width: 300px;
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            background-color: transparent;
        }
        .s3 {
            min-width: 120px;
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
	<form id="form1" name="form" method="post" action="index.php?ac=3" onsubmit="return validateForm()">
    <input type="hidden" id="tipoAM" name="tipoAM" value="1">
    
    <div class="container-fluid" style="font-family: 'Muli', sans-serif;">
        <div class="row px-0" style="display:grid; grid-template-columns: 361.8px 30.15px 361.8px;">
            <div class="" style="grid-column: 1 / 2; justify-self: start; font-size: 10px;">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btnTipo btn btn-danger btn-sm active" style="background-color: #999898;">
                        <input type="radio" name="eleccion" id="option4" value="4" autocomplete="off" checked>Problemática
                    </label>
                    <label class="btnTipo btn btn-secondary btn-sm " style="background-color: #999898;">
                        <input type="radio" name="eleccion" id="option1" value="1" autocomplete="off" >Solicitud
                    </label>
                    <label class="btnTipo btn btn-secondary btn-sm" style="background-color: #999898;">
                        <input type="radio" name="eleccion" id="option2" value="2" autocomplete="off">Conocimiento
                    </label>
                    <label class="btnTipo btn btn-secondary btn-sm" style="background-color: #999898;">
                        <input type="radio" name="eleccion" id="option3" value="3" autocomplete="off">Sugerencia
                    </label>
                    
                </div>
            </div>
            <div id="botonesEnviar" class="" style="grid-column: 3 / 4; justify-self: end; font-size: 10px;">
                <div id="bloqueDirecto" style="">
                    <div class="mx-0" style="display: inline-block; width: 60.3px;">Para:</div><button id="areaD" class="btnTipo btn btn-secondary btn-sm" style="background-color: #4D4D57 !important; opacity: 1; white-space: nowrap; text-overflow: ellipsis;word-break: keep-all; overflow: hidden; display: inline-block; min-width: 150.75px !important;" disabled></button><!--<div class="mx-0" style="display: inline-block; width: 30.15px;">ó</div>-->
                    <button id="enviarAlt" type="button" class="btnTipo btn btn-info btn-sm" style="display: inline-block;">elegir otra área</button>
                </div>
                <div id="bloqueAlterno" style="display:none;">
                    Para: 
                        <select id="areaSec" class="form-control form-control-sm cnt-sm s3" style="width:auto; display:inline-block;">
                            <option value="-" selected>Seleccione un Área</option>
                            <?php 
                            foreach ($this->areas as $area) {
                                $item = new Area();
                                $item = $area;
                                echo '<option value="'.$item->getIdArea().'">'.$item->getNombre().'</option>';
                            }
                            ?>
                        </select>
                        <button id="cancelarAlt" type="button" class="btn btn-dark btn-sm cnt-sm"><i class="material-icons">cancel</i></button>
                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 px-0">
                <table class="actTable">
                    <thead class="actTable">
                        <tr class="actTable">
                            <th class="actTable nc1">Nombre</th>
                            <th class="actTable nc2">Encargado</th>
                            <th class="actTable nc3">Insumo(s)</th>
                            <th id="tipo" class="actTable nc4">Entregable(s)</th>
                            <th class="actTable nc5">.</th>
                        </tr>
                    </thead>
                    <tbody class="actTable">
                        <tr>
                            <td class="nc1"><?php echo $this->ordenAct.' '.$this->nombreAct;?></td>
                            <td id="1c2" class="nc2"><?php echo $this -> areaDN?></td>
                            <td id="1c3" class="nc3"></td>
                            <td id="1c4" class="nc4" data-toggle="tooltip" data-placement="top" title=""><?php echo $this -> entregable?></td>
                            <td id="1c5" class="nc5"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-12 px-0">
                <B><input id="tituloAsunto" name="titulo" class="form-control form-control-sm rounded-0" type="text" placeholder="Escribe el asunto" maxlength="120" style="font-size: 12px; width: 753.75px;"></B>
            </div>
        </div>
        <div class="row">
            <div class="col-12 px-0">
                <div class="input-group" style="width: 753.75px;">
                    <div class="input-group-append" >
                        <span class="input-group-text attach_btn rounded-0" style="width: 30.15px; padding-left: 8px;"><i class="fas fa-paperclip"></i></span>
                    </div>
                    <textarea name="mensaje" class="form-control type_msg bg-white" placeholder="Escribe....." maxlength="500" style="font-size:12px; "></textarea>
                    <div class="input-group-append" >
                        <span id="enviar" class="input-group-text send_btn rounded-0 bg-success" style="width: 30.15px; padding-left: 8px;"><i class="fas fa-location-arrow"></i></span>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="invt" style="font-size:10px; float:right;">
            <div class="row" >
                <div class="col-12" >
                    <div style="display:inline-block; width:60.3px; margin-left:90.45px;">Invitados:</div>
                    <select id="invA" class="form-control form-control-sm cnt-sm s3" style="font-size:12px; display:inline-block; min-width: 150.75px !important; border-color: #eadfba; float:right;">
                        <option value="-" selected>Seleccione un área</option>
                        <?php 
                        foreach ($this->areas as $area) {
                            $item = new Area();
                            $item = $area;
                            echo '<option value="'.$item->getIdArea().'">'.$item->getNombre().'</option>';
                        }
                        ?>
                    </select>
                    <!--<button id="agregarAreas" class="btn btn-info btn-sm cnt-sm"><i class="material-icons">person_add</i></button>-->
                </div>
            </div> 
            <div class="row" style="width:361.8px; float:right;">
                <div id="involucrados" class="col-12">
                </div>
            </div>
        </div>

        <div class="row" style="float:left;">
            <div class="col-12 px-0 mx-0">
                <div id="cajaEI" class="cajaEI" style="display: none; background-color: #464456; width:100% !important;">

                </div>
            </div>
        </div>

        <input type='Hidden' name='etiqueta' value='1'>
        <input type="hidden" name="actm" value="0" >
     	<input type="hidden" name="anio" value="<?php echo date("Y");?>" >
     	<input type="hidden" name="ejes" value="<?php echo $this -> idEje;?>" >
        <input id='areaDestino' type='hidden' name='areaDestino' value='<?php echo $this -> idAreaD;?>'>     
        <input id='areaDR' type='hidden' value='-'>
        <input id='areaIDR' type='hidden' value='-'>  
        <input type="hidden" name="idArea" value="<?php echo $this -> idArea; ?>">
        <input type="hidden" name="idAreaU" value="<?php echo $this -> idAreaU; ?>">
        <input type="hidden" name="idUsuario" value="<?php echo $this -> idUsuario; ?>">
    </div>  <!--fin del container-->                           
    
    

<script type="text/javascript">
    
    //enviar a otra
    $("#enviarAlt").on("click", function (e) {
        e.preventDefault();
        $("#bloqueAlterno").show();
        $("#bloqueDirecto").hide();
        $("#areaIDR").attr("value",$("#areaDestino").val());
        $("#areaDestino").attr("value","-");
    });
    //cancelar
    $("#cancelarAlt").on("click", function (e) {
        e.preventDefault();
        $("#bloqueAlterno").hide();
        $("#bloqueDirecto").show();
        //$("#areaD").html($("#areaDR").val());
        //$("#botonSubmit1").html("Enviar a '"+$("#areaDR").val()+"'");
        $("#areaDestino").attr("value",$("#areaIDR").val());
        $('#areaSec option').prop('selected', function() {
            return this.defaultSelected;
        });
    });

    $("#areaSec").on("change", function (e) {
    	e.preventDefault();
        $("#areaDestino").attr("value",$("#areaSec option:selected").val());
    });
    
    $("#invA").on("change", function(e) {
        e.preventDefault();
        if($("#invA").val() != "-" && $("#invA").val() != "<?php echo $this->idArea; ?>" && $("#invA"+$("#invA").val()).length == 0 ) {
            $('#involucrados').append('<span id="areaI'+$("#invA").val()+'" class="badge badge-dark disable-select">'+$("#invA option:selected").text()+' <i class="material-icons text-warning" onclick="eliminar('+$("#invA").val()+')" style="font-size:13px;">backspace</i></span>' );
            $('#involucrados').append('<input id="invA'+$("#invA").val()+'" name="invitados[]" value="'+$("#invA").val()+'" type="hidden">');
            $('#invA option').prop('selected', function() {return this.defaultSelected;});
        }else {
            alert("Ya fue agreado o no es posible agregar");
        }
    });
    
    function eliminar(am){
        $("#areaI"+am).remove();
        $("#invA"+am).remove();
    }

    $('#enviar').click(function() {
        $(this).closest('form').submit();
    });

    function detalleEntregable(idEntregable, idUsuario, idAreaU,aux){
        $("#cajaEI").slideDown("slow");
        $.post("indexAct.php",{action:'entregables',idEntregable:idEntregable,idUsuario:idUsuario,idAreaU:idAreaU,interno:'1',aux:aux}, function( data ) {
            $( "#cajaEI" ).html(data);

        });
    }

    $( document ).ready(function() {
<?php
    if($this->idEje == '7') {
?>
        $.post("indexAct.php",{action:'entregableAct',idActividad:'<?php echo $this->actividad;?>', expo:'<?php echo $this->idExp;?>'}, function( data ){
            var json = data;
            //id del entregable y conteo de entregables
            if(json.idEE != null) {
                var celda = ' <input type="hidden" name="idEE" value="'+json.idEE+'">';
                $("#idEEdiv").html(celda);
                if(json.iavance != null) {
                    var insumo = json.ifinal +'/'+json.itotal+' ('+ json.iavance/json.itotal+'%)';
                    $( "#1c3" ).html(insumo);
                    $( "#1c3" ).attr('onClick','detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',1)');
                } else {
                    $( "#1c3" ).html("s/insumo(s)");
                }
                $('#1c4').html(json.final+'/'+json.total +'('+json.avance/json.total+'%) '+ json.nombre);
                $('#1c4').attr("title",json.nombre);
                $("#1c4").attr('onClick','detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',2)');

                var detalle = '<button type="button" class="cnt-sm btn btn-light" onclick="detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',0);"><i class="fa fa-search" aria-hidden="true"></i></button>';
                $( "#1c5" ).html(detalle); 
            } /*else if(json.nombre != null) {
                $('#1c4').html('(0)'+json.nombre);
            }*/
        });
<?php
    } else {
?>
        $.post("indexAct.php",{action:'catEnt',idActividad:'<?php echo $this->actividad;?>'}, function( data ) {
            
            var json = data;
            //id del entregable y conteo de entregables
            if(json.idEE != null) {
                var celda = ' <input type="hidden" name="idEE" value="'+json.idEE+'">';
                $("#idEEdiv").html(celda);
                if(json.itotal > 0 ) {
                    var avance =0;
                    if(json.iavance != null) {
                        avance = json.iavance/json.itotal;
                    } 
                    var insumo = json.ifinal +'/'+json.itotal+' ('+avance+'%)';
                    $( "#1c3" ).html(insumo);
                    $( "#1c3" ).attr('onClick','detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',1)');
                }else {
                     $( "#1c3" ).html("s/insumo(s)");
                }
                $('#1c4').html(json.final+'/'+json.total+'('+ json.avance/json.total+'%) '+ json.nombre);
                $('#1c4').attr("title",json.nombre);
                $( "#1c4" ).attr('onClick','detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',2)');
                var detalle = '<button type="button" class="cnt-sm btn btn-light" onclick="detalleEntregable('+json.idEE+','+form.idUsuario.value+','+form.idAreaU.value+',0);"><i class="fa fa-search" aria-hidden="true"></i></button>';
                $( "#1c5" ).html(detalle); 
            }
        });
<?php
    }
?>

    });
</script>

</form>

</body>
</html>