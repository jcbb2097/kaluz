<?php
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once('../../../WEB-INF/Classes/Juridico.class.php');
$catalogo = new Catalogo();
$juridico = new Juridico();
$editar = false;
date_default_timezone_set('America/Mexico_City');
$zonahoraria = date_default_timezone_get();
$añoactual = date("Y");
$periodo_actual = $juridico->PeriodoActual($añoactual);
$periodo2 = "";
$exposicion = "";
$Instrumento = "";
$Subtipo = "";
$Objeto = "";
$Pago_derechos = "";
$Pago_seguro = "";
$transporte = "";
$Fecha_pagos = "";
$Estatus = "";
$PDF = "";
$num_obras = "";
$tipo_contrato = "";
$borrador = "";
$Avance = "";
$contraparte="";
$Eje="";
$contra="";
$institucion="";
$actividad="";
$area="";


if (isset($_GET['accion']) && $_GET['accion'] != "") {
    echo '<input type="hidden" id="accion" name="accion" value="' . $_GET['accion'] . '" />';
    echo '<input type="hidden" id="usuario" name="usuario" value="' . $_GET['usuario'] . '" />';
    $user = $_GET['usuario'];
    if ($_GET['accion'] == "editar") {
        $editar = true;
        echo '<input type="hidden" id="id" name="id" value="' . $_GET['id'] . '"/>';
    } else {
        echo '<input type="hidden" id="id" name="id" value="0"/>';
    }
}

if ($editar == true) {
    $id = $_GET['id'];
    $juridico->setId_juridico($_GET['id']);
    $juridico->getJuridico();
    $periodo2 = $juridico->getId_periodo();
    $exposicion = $juridico->getId_Exposicion();
    $Subtipo = $juridico->getId_subtipo();
    $Instrumento = $juridico->getId_Instrumento();
    $Objeto = $juridico->getObjeto();
    $Pago_derechos = $juridico->getFee_pago();
    $Pago_seguro = $juridico->getPago_seguro();
    $transporte = $juridico->getComite_transporte();
    $Fecha_pagos = $juridico->getFecha_pago_contraparte();
    $Estatus = $juridico->getEstatus();
    $PDF = $juridico->getArchivo();
    $num_obras = $juridico->getNum_obra();
    $tipo_contrato = $juridico->getTipo_contrato();
    $borrador = $juridico->getBorrador();
    $Avance = $juridico->getAvance();
    $contraparte=$juridico->getContraparte_gestor();
    $Eje=$juridico->getId_eje();
    $contra=$juridico->getContraparte();
    $institucion=$juridico->getAtraves();
    $actividad=$juridico->getAct();
    $area=$juridico->getArea();
    $EstatusAvance=$juridico->getEstatusAvance();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>::.FORMULARIO ACTIVO FIJO.::</title>

    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link href="../../../resources/css/bootstrap-select.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="../../../resources/js/bootstrap-select.js"></script>

    <script src="../../../resources/js/sweetAlert.js"></script>
    <script src="../../../resources/js/bootstrap/bootstrapValidator.js"></script>
    <script src="../../../resources/js/aplicaciones/Juridico/Alta_juridico.js"></script>
    <script src="../../../resources/js/aplicaciones/Juridico/Acciones.js"></script>

</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1">Aplicaciones</a> / <a style="color:#fefefe;" href="Lista_juridico.php?nombreUsuario=<?php echo ($user); ?>">Jurídico</a> / Agregar </div>
    <div id="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form class="form-horizontal" id="formJuridico" name="formJuridico">
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Año</label>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <select id="ano" class="form-control" name="ano" onchange="expo();">
                                <option value="">Seleccione un Año</option>
                                <?php
                                $AÑO = "SELECT p.Id_Periodo,p.Periodo FROM c_periodo as p";
                                $resulaño = $catalogo->obtenerLista($AÑO);
                                while ($row = mysqli_fetch_array($resulaño)) {
                                    if ($periodo2 == $row['Id_Periodo'] && $editar == true) {
                                        $selected = "selected";
                                    } else if ($periodo_actual == $row['Id_Periodo'] && $editar == false) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option value='" . $row['Id_Periodo'] . "' " . $selected . ">" . $row['Periodo'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-md-3 col-sm-3 col-xs-3  control-label" for="AÑO"> Exposición Temporal:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="Expotem" class="form-control" name="Expotem">
                                <?php
                                if ($editar == true) {
                                    $consultaperiodo6 = "SELECT e.idExposicion,e.tituloFinal FROM c_exposicionTemporal as e  ORDER BY e.tituloFinal";
                                } else {
                                    $consultaperiodo6 = "SELECT e.idExposicion,e.tituloFinal FROM c_exposicionTemporal as e WHERE e.anio=$añoactual ORDER BY e.tituloFinal";
                                }
                                $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
                                echo '<option value = "">Seleccione una opción</option>';
                                while ($row = mysqli_fetch_array($resultado6)) {
                                    $s = '';
                                    if ($row['idExposicion'] == $exposicion) {
                                        $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $row['idExposicion'] . '" ' . $s . '>' . $row['tituloFinal'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Tipo instrumento jurídico:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="Instrumento" class="form-control" name="Instrumento">
                                <?php
                                $consulta_instrumento = "SELECT ij.idInstrumento,ij.nombre FROM c_instrumentoJuridico ij WHERE ij.tipo=1 ORDER BY ij.nombre";
                                $resultado = $catalogo->obtenerLista($consulta_instrumento);
                                echo '<option value = "">Seleccione una opción</option>';
                                while ($row = mysqli_fetch_array($resultado)) {
                                    $s = '';
                                    if ($row['idInstrumento'] == $Instrumento) {
                                        $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $row['idInstrumento'] . '" ' . $s . '>' . $row['nombre'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Subtipo:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="Sub_tipo" class="form-control" name="Sub_tipo">
                                <?php
                                $consulta_subtipo = "SELECT ij.idInstrumento,ij.nombre,ij.tipo FROM c_instrumentoJuridico ij WHERE ij.tipo=2 ORDER BY ij.nombre";
                                $resultado2 = $catalogo->obtenerLista($consulta_subtipo);
                                echo '<option value = "">Seleccione una opción</option>';
                                while ($row = mysqli_fetch_array($resultado2)) {
                                    $s = '';
                                    if ($row['idInstrumento'] == $Subtipo) {
                                        $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $row['idInstrumento'] . '" ' . $s . '>' . $row['nombre'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">

                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="Eje"> *Eje:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="Eje" class="form-control" name="Eje" onchange="cargaractE();">
                                <?php
                                $consultagiro = "SELECT e.idEje,e.Nombre FROM c_eje as e ";
                                $resultado = $catalogo->obtenerLista($consultagiro);
                                echo '<option value = "">Seleccione una opción</option>';
                                while ($row = mysqli_fetch_array($resultado)) {
                                    $s = '';
                                    if ($row['idEje'] == $Eje) {
                                        $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $row['idEje'] . '" ' . $s . '>' . $row['idEje'].'. '.$row['Nombre'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="imagen">* Contraparte y Gestor:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <input type="text" id="Contraparte_gestor" name="Contraparte_gestor" class="form-control" value="<?php echo ($contraparte); ?>" />

                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2 control-label" for="inputState">Actividad</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select name="actividad" id="actividad" class="form-control">
                                <?php
                                if ($editar == true && $actividad != "") {
                                    $consultaAct ="  SELECT CONCAT(ca.Numeracion,' ',ca.Nombre)as nombre,ca.IdActividad  FROM c_actividad ca WHERE ca.IdEje = $Eje AND ca.IdTipoActividad = 1 ORDER By ca.Numeracion,ca.Orden ";
                                    $resultado = $catalogo->obtenerLista($consultaAct);
                                    echo '<option value="00">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['IdActividad'] == $actividad) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>' . $row['nombre'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">* Area</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="area" class="form-control" name="area">
                                <?php
                                    $consultaeje = "SELECT * FROM c_area ORDER BY Nombre";
                                    $resultado = $catalogo->obtenerLista($consultaeje);
                                    echo '<option value="00">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['Id_Area'] == $area) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['Id_Area'] . '" ' . $s . '>' .$row['Nombre'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Tipo:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="Tipo" class="form-control" name="Tipo">
                                <?php

                                if ($editar == true) {
                                    if ($tipo_contrato == 1) {
                                        echo '<option value="1" selected="selected">Nacional</option>';
                                        echo '<option value="2">Internacional</option>';
                                    } else {
                                        echo '<option value="1">Nacional</option>';
                                        echo '<option value="2" selected="selected">Internacional</option>';
                                    }
                                } else {
                                    echo '<option value="">Seleccione una opción</option>
                                    <option value="1">Nacional</option>
                                    <option value="2">Internacional</option>';
                                }

                                ?>
                            </select>
                        </div>
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Objeto:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <input type="text" id="Objeto" name="Objeto" class="form-control" value="<?php echo ($Objeto); ?>" />
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* FEE / Pago de derechos:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <input type="text" id="Pago_derechos" name="Pago_derechos" class="form-control" value="<?php echo ($Pago_derechos); ?>" />
                        </div>
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Pago de seguro:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <input type="text" id="Pago_seguro" name="Pago_seguro" class="form-control" value="<?php echo ($Pago_seguro); ?>" />
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Comité de transporte:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <input type="text" id="transporte" name="transporte" class="form-control" value="<?php echo ($transporte); ?>" />
                        </div>
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Fecha de pagos con la contraparte:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <input id="Fecha_pagos" name="Fecha_pagos" type="date" class="form-control" value="<?php echo $Fecha_pagos; ?>">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Núm. obras en prestamo:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <input type="number" id="num_obras" name="num_obras" class="form-control" step="1" min="0" value="<?php echo ($num_obras); ?>" />
                        </div>
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Borrador de contraparte:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="Borrador" class="form-control" name="Borrador">
                                <?php

                                if ($editar == true) {
                                    if ($borrador == 1) {
                                        echo '<option value="1" selected="selected">si</option>';
                                        echo '<option value="2">no</option>';
                                    } else {
                                        echo '<option value="1">si</option>';
                                        echo '<option value="2" selected="selected">no</option>';
                                    }
                                } else {
                                    echo '<option value="">Seleccione una opción</option>
                                    <option value="1">si</option>
                                    <option value="2">no</option>';
                                }

                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Avance:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="Avance" class="form-control" name="Avance">
                                <?php
                                if ($editar == true) {
                                    if ($Avance == 10) {
                                        echo ' <option value="0">0%</option>';
                                        echo '<option value="10" selected="selected">si</option>';
                                        echo '<option value="20">20%</option>';
                                        echo '<option value="30">30%</option>';
                                        echo '<option value="40">40%</option>';
                                        echo '<option value="50">50%</option>';
                                        echo '<option value="60">60%</option>';
                                        echo '<option value="70">70%</option>';
                                        echo '<option value="80">80%</option>';
                                        echo '<option value="90">90%</option>';
                                        echo '<option value="100">100%</option>';
                                    } elseif ($Avance == 20) {
                                        echo ' <option value="0">0%</option>';
                                        echo '<option value="10">si</option>';
                                        echo '<option value="20" selected="selected">20%</option>';
                                        echo '<option value="30">30%</option>';
                                        echo '<option value="40">40%</option>';
                                        echo '<option value="50">50%</option>';
                                        echo '<option value="60">60%</option>';
                                        echo '<option value="70">70%</option>';
                                        echo '<option value="80">80%</option>';
                                        echo '<option value="90">90%</option>';
                                        echo '<option value="100">100%</option>';
                                    }elseif ($Avance == 30) {
                                        echo ' <option value="0">0%</option>';
                                        echo '<option value="10">si</option>';
                                        echo '<option value="20">20%</option>';
                                        echo '<option value="30" selected="selected">30%</option>';
                                        echo '<option value="40">40%</option>';
                                        echo '<option value="50">50%</option>';
                                        echo '<option value="60">60%</option>';
                                        echo '<option value="70">70%</option>';
                                        echo '<option value="80">80%</option>';
                                        echo '<option value="90">90%</option>';
                                        echo '<option value="100">100%</option>';
                                    }elseif ($Avance == 40) {
                                        echo ' <option value="0">0%</option>';
                                        echo '<option value="10">si</option>';
                                        echo '<option value="20">20%</option>';
                                        echo '<option value="30">30%</option>';
                                        echo '<option value="40" selected="selected">40%</option>';
                                        echo '<option value="50">50%</option>';
                                        echo '<option value="60">60%</option>';
                                        echo '<option value="70">70%</option>';
                                        echo '<option value="80">80%</option>';
                                        echo '<option value="90">90%</option>';
                                        echo '<option value="100">100%</option>';
                                    }elseif ($Avance == 50) {
                                        echo ' <option value="0">0%</option>';
                                        echo '<option value="10">si</option>';
                                        echo '<option value="20">20%</option>';
                                        echo '<option value="30">30%</option>';
                                        echo '<option value="40">40%</option>';
                                        echo '<option value="50" selected="selected">50%</option>';
                                        echo '<option value="60">60%</option>';
                                        echo '<option value="70">70%</option>';
                                        echo '<option value="80">80%</option>';
                                        echo '<option value="90">90%</option>';
                                        echo '<option value="100">100%</option>';
                                    }elseif ($Avance == 60) {
                                        echo ' <option value="0">0%</option>';
                                        echo '<option value="10">si</option>';
                                        echo '<option value="20">20%</option>';
                                        echo '<option value="30">30%</option>';
                                        echo '<option value="40">40%</option>';
                                        echo '<option value="50">50%</option>';
                                        echo '<option value="60" selected="selected">60%</option>';
                                        echo '<option value="70">70%</option>';
                                        echo '<option value="80">80%</option>';
                                        echo '<option value="90">90%</option>';
                                        echo '<option value="100">100%</option>';
                                    }elseif ($Avance == 70) {
                                        echo ' <option value="0">0%</option>';
                                        echo '<option value="10">si</option>';
                                        echo '<option value="20">20%</option>';
                                        echo '<option value="30">30%</option>';
                                        echo '<option value="40">40%</option>';
                                        echo '<option value="50">50%</option>';
                                        echo '<option value="60">60%</option>';
                                        echo '<option value="70" selected="selected">70%</option>';
                                        echo '<option value="80">80%</option>';
                                        echo '<option value="90">90%</option>';
                                        echo '<option value="100">100%</option>';
                                    }elseif ($Avance == 80) {
                                        echo ' <option value="0">0%</option>';
                                        echo '<option value="10">si</option>';
                                        echo '<option value="20">20%</option>';
                                        echo '<option value="30">30%</option>';
                                        echo '<option value="40">40%</option>';
                                        echo '<option value="50">50%</option>';
                                        echo '<option value="60">60%</option>';
                                        echo '<option value="70">70%</option>';
                                        echo '<option value="80" selected="selected">80%</option>';
                                        echo '<option value="90">90%</option>';
                                        echo '<option value="100">100%</option>';
                                    }elseif ($Avance == 90) {
                                        echo ' <option value="0">0%</option>';
                                        echo '<option value="10">si</option>';
                                        echo '<option value="20">20%</option>';
                                        echo '<option value="30">30%</option>';
                                        echo '<option value="40">40%</option>';
                                        echo '<option value="50">50%</option>';
                                        echo '<option value="60">60%</option>';
                                        echo '<option value="70">70%</option>';
                                        echo '<option value="80">80%</option>';
                                        echo '<option value="90" selected="selected">90%</option>';
                                        echo '<option value="100">100%</option>';
                                    }elseif ($Avance == 100) {
                                        echo ' <option value="0">0%</option>';
                                        echo '<option value="10">si</option>';
                                        echo '<option value="20">20%</option>';
                                        echo '<option value="30">30%</option>';
                                        echo '<option value="40">40%</option>';
                                        echo '<option value="50">50%</option>';
                                        echo '<option value="60">60%</option>';
                                        echo '<option value="70">70%</option>';
                                        echo '<option value="80">80%</option>';
                                        echo '<option value="90">90%</option>';
                                        echo '<option value="100" selected="selected">100%</option>';
                                    }else{
                                        echo ' <option value="0" selected="selected">0%</option>';
                                        echo '<option value="10">si</option>';
                                        echo '<option value="20">20%</option>';
                                        echo '<option value="30">30%</option>';
                                        echo '<option value="40">40%</option>';
                                        echo '<option value="50">50%</option>';
                                        echo '<option value="60">60%</option>';
                                        echo '<option value="70">70%</option>';
                                        echo '<option value="80">80%</option>';
                                        echo '<option value="90">90%</option>';
                                        echo '<option value="100">100%</option>';
                                    }
                                } else {
                                    echo '<option value="">Seleccione una opción</option>
                                    <option value="0">0%</option>
                                    <option value="10">10%</option>
                                    <option value="20">20%</option>
                                    <option value="30">30%</option>
                                    <option value="40">40%</option>
                                    <option value="50">50%</option>
                                    <option value="60">60%</option>
                                    <option value="70">70%</option>
                                    <option value="80">80%</option>
                                    <option value="90">90%</option>
                                    <option value="100">100%</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO"> Estatus Avance:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="EstatusAvance" class="form-control" name="EstatusAvance">
                                <?php
                                    $consultaEstatus = "SELECT * FROM Estatus_Avance ORDER BY id";
                                    $resultadoEstatus = $catalogo->obtenerLista($consultaEstatus);
                                    echo '<option value="00">Seleccione una opción</option>';
                                    echo $EstatusAvance;
                                    while ($rowEstatus = mysqli_fetch_array($resultadoEstatus)) {
                                        $s = '';
                                        if ($rowEstatus['id'] == $EstatusAvance) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $rowEstatus['id'] . '" ' . $s . '>' .$rowEstatus['Nombre'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>

                    </div>
                     <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Contraparte:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="contra" class="form-control" name="contra">
                                <?php

                                if ($editar == true) {
                                    if ($contra == 1) {
                                        echo '<option value="1" selected="selected">Física</option>';
                                        echo '<option value="2">Moral</option>';
                                    } else {
                                        echo '<option value="1">Física</option>';
                                        echo '<option value="2" selected="selected">Moral</option>';
                                    }
                                } else {
                                    echo '<option value="">Seleccione una opción</option>
                                    <option value="1">Física</option>
                                    <option value="2">Moral</option>';
                                }

                                ?>
                            </select>
                        </div>
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">A través de quién:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="institucion" class="form-control" name="institucion" onchange="">
                                <?php
                                $consultagiro = "SELECT Id_institucion,Nombre FROM c_institucion ORDER BY Nombre";
                                $resultado = $catalogo->obtenerLista($consultagiro);
                                echo '<option value = "">Seleccione una opción</option>';
                                while ($row = mysqli_fetch_array($resultado)) {
                                    $s = '';
                                    if ($row['Id_institucion'] == $institucion) {
                                        $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $row['Id_institucion'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                }
                                ?>
                            </select>
                    </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Estatus:</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <textarea class="form-control" id="Estatus" name="Estatus" rows="2"><?php echo $Estatus; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="imagen">Archivo:</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input type="file" id="pdf" name="pdf" class="form-control" accept=".pdf" />
                            <?php
                            if ($editar == true && $PDF != "") {
                                $ruta = '../../../resources/aplicaciones/PDF/Juridico/' . $PDF;
                                echo '<a target="_blank" href="' . $ruta . '" ><i class="glyphicon glyphicon-file"></i> Archivo</a>';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <div class="col-md-2 col-sm-2 col-xs-2">

                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <button type="button" class="btn btn-default btn-xs" id="guardar">Guardar</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
