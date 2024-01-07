<?php


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	

    <script src="libs/js/funcionesRegistrar.js"></script>
</head>
<body>
	<style>
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
        
        .disable-select {
            user-select: none; /* supported by Chrome and Opera */
           -webkit-user-select: none; /* Safari */
           -khtml-user-select: none; /* Konqueror HTML */
           -moz-user-select: none; /* Firefox */
           -ms-user-select: none; /* Internet Explorer/Edge */
        }

        .cnt-sm {
            height: 26px; 
            line-height: 20px !important;
            font-size:10px !important;
            padding-top: 0px !important;
            padding-bottom: 0px !important;
            border-radius: 0px;
        }
        .type_msg{
            border:1 !important;
            overflow-y: auto;
            min-height: 78px !important;
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
            padding-top: 0px;
            padding-bottom: 0px;
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
            min-width: 361.8px !important;
            max-width: 361.8px !important;
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
            min-width: 211.05px !important;
            max-width: 211.05px !important;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .nc4 {
            min-width: 211.05px;
            max-width: 211.05px;
            overflow: hidden;
            text-overflow: ellipsis;
            vertical-align: middle;
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
        .badge-ent {
            /*height: 26px;*/
            min-width: 25px;
            font-size:12px;
            padding: 7px;
            border-radius: 0px !important;
        }
    </style>
<div class="container-fluid" style="font-family: 'Muli', sans-serif;">
	<form id="form1" name="form" method="post" action="index.php?ac=3" onsubmit="return validateForm()">
    <input type="hidden" id="tipoAM" name="tipoAM" value="1">
    <div id="idEEdiv"></div>
    <div class="row" style="height: 26px; font-size:14px; background-color: #e9e7e6;">
        <div style='color:white' class="col-12">
            Redacta un nuevo asunto
        </div>
    </div>
    <div class="row px-0">
        <div class="col-12 px-0">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btnTipo btn btn-danger btn-sm" style="background-color: #999898;">
                    <input type="radio" name="eleccion" id="option4" value="4" autocomplete="off">Problemática
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
    </div>
    <div class="row" style="height: 26px !important;">
        <div class="col-12 px-0 " style="">
            <div class="btn-group btn-group-toggle" data-toggle="buttons" style="">
                <label class="btnTipo btn btn-secondary btn-sm active" onclick="seleccion(1);" style="background-color: #999898;">
                     <input type="radio" name="actm" value="0" autocomplete="off" checked>Actividades
                </label>
                <label class="btnTipo btn btn-secondary btn-sm" onclick="seleccion(2);" style="background-color: #999898;">
                     <input type="radio" name="actm" value="0" autocomplete="off">Metas
                </label>
            </div>
        </div>
    </div>
    <div class="row" style="display:grid; grid-template-columns: 180.9px 90px 271.35px 361.8px">
        <div class="" style=" width: 180.9px; grid-column: 1 / 2;">
            <select class="form-control form-control-sm cnt-sm" name='anio' onChange='changeGlobal(form);'  hidden>
                <option value='2013'>2013</option>
                <option value='2014'>2014</option>
                <option value='2015'>2015</option>
                <option value='2016'>2016</option>
                <option value='2017'>2017</option>
                <option value='2018'>2018</option>
                <option value='2019'>2019</option>
    			<option value='2020' selected>2020</option>
            </select>
            <select id="ejeSelect" name="ejes" class="form-control form-control-sm cnt-sm" style="" onChange="cargarGlobales();">
                <option value='-' selected >Seleccione un Eje</option>
                <?php 
                    foreach ($this->ejes as $area) {
                        $item = new Area();
                        $item = $area;
                        echo '<option orden="'.$item->getOrden().'" value="'.$item->getIdArea().'">'.$item->getOrden().'. '.$item->getNombre().'</option>';
                    }
                ?>
            </select>
            <input id='areaDestino' type='hidden' name='areaDestino' value='-'>
        </div>
        <div class="expoC" style="display:none; grid-column: 2 / 3;">
            <select id="anioExpo" class="form-control form-control-sm cnt-sm"  name='anioExpo' onChange='cambiarExpo();' style="width: 90px;">
                <option value='2013'>2013</option>
                <option value='2014'>2014</option>
                <option value='2015'>2015</option>
                <option value='2016'>2016</option>
                <option value='2017'>2017</option>
                <option value='2018'>2018</option>
                <option value='2019'>2019</option>
                <option value='2020' >2020</option>
                <option value='2021' selected>2021</option>
                <option value='2022'>2022</option>
                <option value='2023'>2023</option>
                <option value='2024'>2024</option>
            </select>
           
        </div>
        <div class="expoC" style="display:none; grid-column: 3 / 4;">
             <select id="expo" name="expo" class="form-control form-control-sm cnt-sm" onChange="cargarGlobalesExpo();" style="width:271.35px; ">
                <option value="0" selected > Selecciona exposición </option>
                <?php
                if(isset($this -> exposiciones)) {
                    foreach ($this -> exposiciones as $expo) {
                        echo '<option value="'.$expo->getIdExposicion().'">'.$expo->getTitulo().'</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div id="botonesEnviar" class="" style="grid-column: 4 / 5; justify-self: end; font-size: 10px;">
            <div id="bloqueDirecto" style="display:none;">
                <div class="mx-0" style="display: inline-block; width: 30.15px;">Para:</div>
                <button id="areaD" class="btnTipo btn btn-secondary btn-sm" style="background-color: #4D4D57 !important; opacity: 1; white-space: nowrap; text-overflow: ellipsis;word-break: keep-all; overflow: hidden; display: inline-block; min-width: 120.6px !important;" disabled></button><select id="destinatario" name="destinatario" class="form-control form-control-sm cnt-sm" style="width: 120.6px !important; display: inline-block;">
                        <option value="0" selected>Selecciona usuario</option>
                        
                    </select><button id="enviarAlt" class="btnTipo btn btn-info btn-sm px-0" style="width: 60.30px !important; display: inline-block;"><< cambiar</button>
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
                    <select id="destinatario2" name="destinatario2" class="form-control form-control-sm cnt-sm" style="width: 120.6px !important; display: inline-block;">
                        <option value="0" selected>Selecciona usuario</option>
                        
                    </select>
                    <button id="cancelarAlt" type="button" class="btn btn-dark btn-sm cnt-sm"><i class="material-icons">cancel</i></button>
                
            </div>
        </div>
        
    </div>
    
    
    <div class="row" style="">
        <div class="col-12 px-0">
            <table class="actTable">
                <thead class="actTable">
                    <tr class="actTable" style="height: 26px;">
                        <th class="actTable nc1">&nbsp;&nbsp;&nbsp;Nombre</th>
                        <th class="actTable nc2">Encargado</th>
                        <th class="actTable nc3">Insumo(s)</th>
                        <th id="tipo" class="actTable nc4">Entregable(s)</th>
                        <th class="actTable nc5">.</th>
                    </tr>
                </thead>
                <tbody class="actTable">
                    <tr id="trGlobal" style="">
                        <td class="nc1">
                            <select id="AGlobal" name="AGlobal" class="form-control form-control-sm cnt-sm s1 d-none" onChange="cargarGenerales();" style="height: 24.5px !important">
                                <option value="0">Selecciona una global</option>
                            </select>
                        </td>
                        <td id="1c2" class="nc2" data-toggle="tooltip" data-placement="top" title=""></td>
                        <td id="1c3" class="nc3"></td>
                        <td id="1c4" class="nc4" data-toggle="tooltip" data-placement="top" title=""></td>
                        <td id="1c5" class="nc5"></td>
                    </tr>
                    <tr id="trGeneral">
                        <td class="nc1">
                            <select id="AGeneral" name="AGeneral" class="form-control form-control-sm d-none cnt-sm s1" onChange="cargarParticulares();" style="height: 24.5px !important">  
                                <option value="0">Selecciona una general</option>
                            </select>
                        </td>
                        <td id="2c2" class="nc2" data-toggle="tooltip" data-placement="top" title=""></td>
                        <td id="2c3" class="nc3"></td>
                        <td id="2c4" class="nc4" data-toggle="tooltip" data-placement="top" title=""></td>
                        <td id="2c5" class="nc5"></td>
                    </tr>
                    <tr id="trParticular">
                        <td class="nc1">
                            <select id="AParticular" name='AParticular' class="form-control form-control-sm d-none cnt-sm s1" onChange='cargarSub();' style="height: 24.5px !important" > 
                                <option value='0'>Selecciona una particular</option>    
                            </select>
                        </td>
                        <td id="3c2" class="nc2" data-toggle="tooltip" data-placement="top" title=""></td>
                        <td id="3c3" class="nc3"></td>
                        <td id="3c4" class="nc4" data-toggle="tooltip" data-placement="top" title=""></td>
                        <td id="3c5" class="nc5"></td>
                    </tr>
                    <tr id="trSub">
                        <td class="nc1">
                            <select id="ASub" name='SActividad' class="form-control form-control-sm d-none cnt-sm s1" onChange='cargarSub2();' style="height: 24.5px !important" >
                                <option VALUE='0'>Selecciona una sub</option>
                            </select>
                        </td>
                        <td id="4c2" class="nc2" data-toggle="tooltip" data-placement="top" title=""></td>
                        <td id="4c3" class="nc3"></td>
                        <td id="4c4" class="nc4" data-toggle="tooltip" data-placement="top" title=""></td>
                        <td id="4c5" class="nc5"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
                            
    <input type='Hidden' name='etiqueta' value='1'>
    

    <div class="row">
        <div class="col-12 px-0">
            <B><input id="tituloAsunto" name="titulo" class="form-control form-control-sm rounded-0" type="text" placeholder="Escribe el asunto" maxlength="120" style="font-size: 12px;"></B>
        </div>
    </div>
    <div class="row">
        <div class="col-12 px-0">
            <div class="input-group">
                <div class="input-group-append">
                    <span class="input-group-text attach_btn rounded-0"><i class="fas fa-paperclip"></i></span>
                </div>
                <textarea name="mensaje" class="form-control type_msg bg-white" placeholder="Escribe....." maxlength="500" style="font-size:12px;"></textarea>
                <div class="input-group-append">
                    <span id="enviar" class="input-group-text send_btn rounded-0 bg-info"><i class="fas fa-location-arrow"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="invt" style="font-size:10px; float:right; margin-right: -15px;">
        <div class="row" >
            <div class="col-12" >
                <div style="display:inline-block; width:60.3px; margin-left:60.3px;">Invitados:</div>
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
        

        <input id='areaDR' type='hidden' value='-'>
        <input id='areaIDR' type='hidden' value='-'> 
        <input type="hidden" name="idArea" value="<?php echo $this -> idArea; ?>">
        <input type="hidden" name="idAreaU" value="<?php echo $this -> idAreaU; ?>">
        <input type="hidden" name="idUsuario" value="<?php echo $this -> idUsuario; ?>">
        <input type="hidden" name="opcion" value="<?php echo $this -> opcion; ?>">
        <input type="hidden" name="tipo" value="<?php echo $this -> tipo; ?>">
        <input type="hidden" name="idEje" value="<?php echo $this -> idEje; ?>">
        <input type="hidden" name="estatus" value="<?php echo $this -> estatus; ?>">
        <!--<input type="hidden" name="anio" value="<?php //echo $this -> anio; ?>">-->
                            
</div>    
    

<script type="text/javascript">
    
    //enviar a otra
    $("#enviarAlt").on("click", function (e) {
        e.preventDefault();
        $("#bloqueAlterno").show();
        $("#bloqueDirecto").hide();
        $("#areaIDR").attr("value",$("#areaDestino").val());
        //$("#areaD").html(" ");
        $("#areaDestino").attr("value","-");
        limpiaCombos(document.getElementById("destinatario2"));
        document.getElementById("destinatario").setAttribute("name", "destinatario2");
        document.getElementById("destinatario2").setAttribute("name", "destinatario");

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
        limpiaCombos(document.getElementById("destinatario2"));
        document.getElementById("destinatario").setAttribute("name", "destinatario");
        document.getElementById("destinatario2").setAttribute("name", "destinatario2");
    });

    $("#areaSec").on("change", function (e) {
      e.preventDefault();
        //$("#alterno").show();
        //$("#enviarAlt").hide();//esconde boton de "enviar a otra area"
        //$("#areaD").html($("#areaSec option:selected").text());
        $("#areaDestino").attr("value",$("#areaSec option:selected").val());

        var idA = $("#areaSec").val();
   
        $.post("indexAct.php",{action:'usuarios',idArea:idA}, function( data ) {
            limpiaCombos(document.getElementById("destinatario2"));
            $( "#destinatario2" ).append(data);
        });
        
    });

    $("#ejeSelect").on("change", function (e) {
        $("#bloqueAlterno").hide();
        $("#bloqueDirecto").hide();

        limpiaCombos(document.getElementById("destinatario"));
        limpiaCombos(document.getElementById("destinatario2"));
        document.getElementById("destinatario").setAttribute("name", "destinatario");
        document.getElementById("destinatario2").setAttribute("name", "destinatario2");
    });
    $("#AGlobal").on("change", function (e) {
        e.preventDefault();
        $('#areaSec option').prop('selected', function() {return this.defaultSelected;});
        $("#bloqueDirecto").show();
        $("#bloqueAlterno").hide();
        limpiaCombos(document.getElementById("destinatario"));
        document.getElementById("destinatario").setAttribute("name", "destinatario");
        document.getElementById("destinatario2").setAttribute("name", "destinatario2");
    });
    $("#AGeneral").on("change", function (e) {
        e.preventDefault();
        $('#areaSec option').prop('selected', function() {return this.defaultSelected;});
       $("#bloqueDirecto").show();
        $("#bloqueAlterno").hide();
        limpiaCombos(document.getElementById("destinatario"));
        limpiaCombos(document.getElementById("destinatario2"));
        document.getElementById("destinatario").setAttribute("name", "destinatario");
        document.getElementById("destinatario2").setAttribute("name", "destinatario2");
    });
    $("#AParticular").on("change", function (e) {
        e.preventDefault();
        $('#areaSec option').prop('selected', function() {return this.defaultSelected;});
        $("#bloqueDirecto").show();
        $("#bloqueAlterno").hide();
        limpiaCombos(document.getElementById("destinatario"));
        limpiaCombos(document.getElementById("destinatario2"));
        document.getElementById("destinatario").setAttribute("name", "destinatario");
        document.getElementById("destinatario2").setAttribute("name", "destinatario2");
    });
    $("#ASub").on("change", function (e) {
        e.preventDefault();
        $('#areaSec option').prop('selected', function() {return this.defaultSelected;});
        $("#bloqueDirecto").show();
        $("#bloqueAlterno").hide();
        limpiaCombos(document.getElementById("destinatario"));
        limpiaCombos(document.getElementById("destinatario2"));
        document.getElementById("destinatario").setAttribute("name", "destinatario");
        document.getElementById("destinatario2").setAttribute("name", "destinatario2");
    });
    
    $("#invA").on("change", function(e) {
        e.preventDefault();
        if($("#invA").val() != "-" && $("#invA").val() != "<?php echo $this->idArea; ?>" && $("#invA"+$("#invA").val()).length == 0 && $("#areaDestino").val() != $("#invA").val() ) {
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
    
    /*$("#ejeSelect").on("change", function (e) {
        if($("#ejeSelect").val() === "7")   {
            $("#tipo").html("Exposición");
        } else {
            $("#tipo").html("Período");
        }
    });*/
 
    
    function seleccion(tipo){
        $("#tipoAM").val(tipo);
        //document.getElementById("myNav").style.width = "0%";
        $("#areaD").html(" ");
        $("#areaEnt").html(" ");
        $("#personaD").html(" ");
        $("#areaDestino").attr("value","-");

        $("#AGlobal").removeClass("bg-success text-light");
        $("#trGlobal").removeClass("bg-success text-light");
        $("#AGeneral").removeClass("bg-success text-light");
        $("#trGeneral").removeClass("bg-success text-light");
        $("#AParticular").removeClass("bg-success text-light");
        $("#trParticular").removeClass("bg-success text-light");
        $("#trSub").removeClass("bg-success text-light");
        $("#ASub").removeClass("bg-success text-light");

        $("#AGlobal").addClass("d-none");
        $("#AGeneral").addClass("d-none");
        $("#AParticular").addClass("d-none");
        $("#ASub").addClass("d-none");
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
        limpiaCombos(this.document.form.AGlobal);
        limpiaCombos(this.document.form.AGeneral);
        limpiaCombos(this.document.form.AParticular);
        limpiaCombos(this.document.form.ASub);
        limpiaCombos(this.document.form.destinatario);
        $('#ejeSelect option').prop('selected', function() {return this.defaultSelected;});
        $('#areaSec option').prop('selected', function() {return this.defaultSelected;});
        $('#anioExpo option').prop('selected', function() {return this.defaultSelected;});
        $('#expo option').prop('selected', function() {return this.defaultSelected;});
        $("#bloqueDirecto").hide();
        $("#bloqueAlterno").hide();
        $(".expoC").hide();
    }
    //cambiar id Area responsable
    /*function establecerArea(idArea, area){
        //$("#personaD").html("<%=nombre+' '+apaterno+' '+amaterno%>");
        $("#areaDR").attr("value",area);
        $("#areaIDR").attr("value",idArea);
        //$("#botonSubmit1").html("Enviar a '"+area+"'");
        $("#areaD").html(area);
        $("#areaDestino").attr("value",idArea);  
    }*/

    $('#enviar').click(function() {
		
		$(this).closest('form').submit();
			
			
		
        //$(this).closest('form').submit();
		
		
		
 
        //$.post("index.php",$("#form1").serialize()+"&ac=3");
		
    });

	
		


    $( document ).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
	
	
</script>

</form>

</body>
</html>