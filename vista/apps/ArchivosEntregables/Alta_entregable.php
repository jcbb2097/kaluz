<?php
//Aplicacion modificada por : Jose carlos 19/08/2021 //
//clases que usa el formulario
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once('../../../WEB-INF/Classes/ArchivoCompartido.class.php');
include_once('../../../WEB-INF/Classes/ActividadArchivo.class.php');
include_once('../../../WEB-INF/Classes/AreaArchivo.class.php');
$catalogo = new Catalogo();
$archivo = new ArchivoCompartido();
//variables del formulario
date_default_timezone_set('America/Mexico_City');
$zonahoraria = date_default_timezone_get();
$editar = false;
$edit = 0;
$añoactual = date("Y");
$tipoPerfil = $_GET["tipoPerfil"];
$nombreUsuario = $_GET["nombreUsuario"];
$idUsuario = $_GET["idUsuario"];
$periodo_actual = $archivo->PeriodoActual($añoactual);
$contadorac = 0;
$contadorar = 0;
$estatus = "";
$periodo2 = "";
$descripcion = "";
$area = "";
$tipo = "";
if (isset($_GET['accion']) && $_GET['accion'] != "") {
    echo '<input type="hidden" id="accion" name="accion" value="' . $_GET['accion'] . '" />';
    echo '<input type="hidden" id="tipoPerfil" name="tipoPerfil" value="' . $_GET['tipoPerfil'] . '"/>';
    echo '<input type="hidden" id="nombreUsuario" name="nombreUsuario" value="' . $_GET['nombreUsuario'] . '"/>';
    echo '<input type="hidden" id="idUsuario" name="idUsuario" value="' . $_GET['idUsuario'] . '"/>';

    if ($_GET['accion'] == "editar") {
        $editar = true;
        echo '<input type="hidden" id="id" name="id" value="' . $_GET['id'] . '"/>';
    } else {
        echo '<input type="hidden" id="id" name="id" value="0"/>';
    }
}
if ($editar == true) {
    $archivo->setId_documento($_GET['id']);
    $archivo->getAcuerdo($_GET['id']);
    $idacuerdo = $_GET['id'];
    $periodo2 = $archivo->getAnio();
    $tipo = $archivo->getId_tipo();
    $area = $archivo->getId_area();
    $descripcion = $archivo->getDescripcion();
    $PDF = $archivo->getPdfcedulafiscal();
    $categoria = $archivo->getIdCategoriadeEje();
    $link = $archivo->getRuta();
    echo '<input type="hidden" id="ons" name="ons" value="' . $estatus . '"/>';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>::.FORMULARIO ENTREGABLES.::</title>

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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="../../../resources/js/sweetAlert.js"></script>
    <script src="../../../resources/js/bootstrap/bootstrapValidator.js"></script>
    <script src="../../../resources/js/aplicaciones/ArchivosCompartidos/Acciones_Archivos.js"></script>
    <script src="../../../resources/js/aplicaciones/ArchivosCompartidos/Alta_Entregable.js"></script>

    <style>
        textarea {
            resize: none;
        }
    </style>
</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Aplicaciones</a> / <a style="color:#fefefe;" href="Lista_entregable.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Entregables</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)"> Agregar Entregable</a></div>
    <div id="container">
        <form class="form-horizontal" id="formArchivo" name="formArchivo">
            <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">* Descripción del entregable</label>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="2"><?php echo $descripcion; ?></textarea>
                </div>
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Periodo</label>
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <select id="ano" class="form-control" name="ano" onchange="periodo();">
                        <option value="">Seleccione un Periodo</option>
                        <?php
                        $Ano = "SELECT p.Id_Periodo,p.Periodo FROM c_periodo as p WHERE p.CPE_ESTATUS=1 ORDER BY p.Periodo DESC";
                        $resulaño = $catalogo->obtenerLista($Ano);
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
            </div>
            <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Área sube el entregable:</label>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <select id="area" class="form-control" name="area" onchange="">
                        <?php
                        $consultaperiodo = "SELECT a.Id_Area,a.Nombre FROM c_area as a WHERE a.estatus=1 ORDER BY a.Nombre";
                        $resultado = $catalogo->obtenerLista($consultaperiodo);
                        echo ' <option value = "">Seleccione un Área</option>';
                        while ($row = mysqli_fetch_array($resultado)) {
                            $s = '';
                            if ($row['Id_Area'] == $area) {
                                $s = 'selected="selected"';
                            }
                            echo '<option value="' . $row['Id_Area'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Tipo de entregable:</label>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <select id="categoria" class="form-control" name="categoria">
                        <?php
                        $consultaperiodo2 = "SELECT d.id_tipo,d.tipo FROM c_tipo_documento as d WHERE d.id_tipo IN (9,10,14) order BY d.fechaCreacion asc";
                        $resultado88 = $catalogo->obtenerLista($consultaperiodo2);
                        echo '<option value="">Seleccione una opción</option>';
                        while ($row = mysqli_fetch_array($resultado88)) {
                            $s = '';
                            if ($row['id_tipo'] == $tipo) {
                                $s = 'selected="selected"';
                            }
                            $color_back = "";
                            if ($row['id_tipo'] == 9) $color_back = "style='background-color : #dfa739;color : white'";
                            if ($row['id_tipo'] == 10) $color_back = "style='background-color : #33ab15;color : white'";
                            if ($row['id_tipo'] == 14) $color_back = "style='background-color : #dbd909;color : white'";
                            echo '<option ' . $color_back . ' value="' . $row['id_tipo'] . '" ' . $s . '>' . $row['tipo'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="imagen">* Archivo </label>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <input type="file" id="pdf" name="pdf" class="form-control" accept="" <?php if ($editar == true && $PDF == "link") echo "disabled"; ?> />
                    <?php
                    if ($editar == true && $PDF != "" && $PDF != "link") {
                        $rutaimg = $archivo->ruta_guardar($tipo);
                        $rutaimg ='../../../'.$rutaimg . $PDF;
                        echo '<a target="_blank" href="' . $rutaimg . '" ><i class="glyphicon glyphicon-file"></i> Archivo</a>';
                        echo '<input type="hidden" name="archivo_registrado" id="archivo_registrado" value="1">';
                    }
                    ?>

                </div>
                <label class="col-md-2 col-sm-2 col-xs-2 ">(Máximo 4 Mb) </label>
            </div>
            <div class="form-group form-group-sm">
                <div class="col-md-2 col-sm-2 col-xs-2  control-label">
                    Añadir link a archivo <input type="checkbox" id="checkbox_pdf" onclick="link()" <?php if ($editar == true && $PDF == "link") echo "checked"; ?> />
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <input type="text" id="link_pdf" name="link_pdf" class="form-control" <?php if ($editar == true && $PDF == "link") echo "value='$link'";
                                                                                            else echo "disabled" ?> />
                </div>
                <label class="col-md-2 col-sm-2 col-xs-2 ">(Más de 4 Mb) </label>
            </div>
            <div class="form-group form-group-sm">
                <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO"><button id="mas" name="mas" type="button" class="btn btn-xs" onclick="nuevaactividad();"><i class="glyphicon glyphicon-plus"></i></button></label>
            </div>
            <?php if ($editar == true) {
                $indice = 0;
                $IdProyecto = "";
                $IdExposición = "";
                $IdTipoConcepto = "";
                $IdGlobal = "";
                $IdGeneral = "";
                $Particular = "";
                $subact = "";
                $Id_categoria = "";
                $Id_subcategoria = "";
                $consulta_actividad = "SELECT * FROM k_archivoactividad ka WHERE ka.id_archivo=" . $idacuerdo;
                $resultAcuerdoActividad = $catalogo->obtenerLista($consulta_actividad);
                while ($rowAcuerdoActividad = mysqli_fetch_array($resultAcuerdoActividad)) {
                    $Ideditar = $rowAcuerdoActividad['id_archivoactividad'];
                    $IdProyecto = $rowAcuerdoActividad['id_proyecto'];
                    $IdExposición = $rowAcuerdoActividad['id_exposicion'];
                    $IdTipoConcepto = $rowAcuerdoActividad['id_tipo'];
                    $IdGlobal = $rowAcuerdoActividad['id_actividad1'];
                    $IdGeneral = $rowAcuerdoActividad['id_actividad2'];
                    $Particular = $rowAcuerdoActividad['id_actividad3'];
                    $subact = $rowAcuerdoActividad['id_actividad4'];
                    $Id_categoria = $rowAcuerdoActividad['id_categoria'];
                    $Id_subcategoria = $rowAcuerdoActividad['id_subcategoria'];
            ?>
                    <div class="form-group form-group-sm">
                        <input type="hidden" id="id_edit<?php echo $indice; ?>" name="id_edit<?php echo $indice; ?>" value="<?php echo $Ideditar; ?>" />
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Eje:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="Eje_<?php echo $indice; ?>" class="form-control" name="Eje_edit<?php echo $indice; ?>" onchange="Categorias(<?php echo $indice; ?>);actividades1(<?php echo $indice; ?>);">
                                <?php
                                $consultagiro = "SELECT e.idEje,e.Nombre FROM c_eje as e";
                                $resultado = $catalogo->obtenerLista($consultagiro);
                                echo '<option value="">Seleccione una opción</option>';
                                while ($row = mysqli_fetch_array($resultado)) {
                                    $s = '';
                                    if ($row['idEje'] == $IdProyecto) {
                                        $s = 'selected="selected"';
                                    }
                                    echo '<option value="' . $row['idEje'] . '" ' . $s . '>' . $row['idEje'] . '. ' . $row['Nombre'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2 control-label" for="AÑO">* Categoría:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="cate_<?php echo $indice; ?>" class="form-control" name="cate_edit<?php echo $indice; ?>" onchange="Sub_Categorias(<?php echo $indice; ?>);">
                                <?php
                                if ($Id_categoria) {
                                    $consultagiro = "SELECT ce.idCategoria,ce.descCategoria FROM c_categoriasdeejes ce INNER JOIN c_periodo p on p.Id_Periodo=ce.anio WHERE ce.nivelCategoria=1 AND p.Id_Periodo=$periodo2 AND ce.idEje=$IdProyecto ORDER BY ce.orden";
                                    $resultado = $catalogo->obtenerLista($consultagiro);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['idCategoria'] == $Id_categoria) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['idCategoria'] . '" ' . $s . '>' . $row['descCategoria'] . '. ' . $row['Nombre'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Sub categoría:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="subcate<?php echo $indice; ?>" class="form-control" name="subcate_edit<?php echo $indice; ?>" onchange="">
                                <?php
                                if ($Id_subcategoria) {
                                    $consultagiro = "SELECT ce.idCategoria,ce.descCategoria FROM c_categoriasdeejes ce WHERE ce.idCategoriaPadre=$Id_categoria ORDER BY ce.orden ";
                                    $resultado = $catalogo->obtenerLista($consultagiro);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['idCategoria'] == $Id_subcategoria) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['idCategoria'] . '" ' . $s . '>' . $row['descCategoria'] . '. ' . $row['Nombre'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO"><button id="mas" name="mas" type="button" class="btn btn-xs" onclick="eliminaractividadarchivo(<?php echo $Ideditar ?>);"><i class="glyphicon glyphicon-trash"></i></button></label>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Exposición Temporal:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="Expotem<?php echo $indice; ?>" class="form-control" name="Expotem_edit<?php echo $indice; ?>">
                                <?php
                                $consultaperiodo6 = "SELECT e.idExposicion,e.tituloFinal FROM c_exposicionTemporal as e WHERE e.estatus=1 ORDER BY e.tituloFinal ";
                                $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
                                echo '<option value = "">Seleccione una opción</option>';
                                while ($row = mysqli_fetch_array($resultado6)) {
                                    $s = '';
                                    if ($row['idExposicion'] == $IdExposición) {
                                        $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $row['idExposicion'] . '" ' . $s . '>' . $row['tituloFinal'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Actividad/Meta:</label>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <select id="acme<?php echo $indice; ?>" class="form-control" name="acme_edit<?php echo $indice; ?>" onchange="">
                                <?php if ($IdTipoConcepto == 1) {
                                    echo '<option value="1" selected="selected">Actividad</option>';
                                    echo '<option value="2">Meta</option>';
                                } else {
                                    echo '<option value="1">Actividad</option>';
                                    echo '<option value="2" selected="selected">Meta</option>';
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* A/M. Global:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="ActvGlobal<?php echo $indice; ?>" class="form-control" name="ActvGlobal_edit<?php echo $indice; ?>" onchange="actividades2(<?php echo $indice; ?>);">
                                <?php
                                $consultaperiodo6 = "SELECT a.IdActividad, CONCAT(a.Numeracion,a.Nombre) actividad FROM c_actividad a WHERE a.IdEje=$IdProyecto AND a.IdNivelActividad=1 AND IdTipoActividad=$IdTipoConcepto ORDER BY a.Orden";
                                $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
                                echo '<option value = "">Seleccione una opción</option>';
                                while ($row = mysqli_fetch_array($resultado6)) {
                                    $s = '';
                                    if ($row['IdActividad'] == $IdGlobal) {
                                        $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">A/M. General:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="ActvGeneral<?php echo $indice; ?>" class="form-control" name="ActvGeneral_edit<?php echo $indice; ?>" onchange="actividades3(<?php echo $indice; ?>);">
                                <?php
                                $consultaperiodo6 = "SELECT a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad 
                                        FROM c_actividad a 
                                        WHERE a.IdEje = $IdProyecto AND a.IdNivelActividad = 2 AND a.IdTipoActividad = $IdTipoConcepto AND a.IdActividadSuperior=$IdGlobal
                                        ORDER BY a.Orden";
                                $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
                                echo '<option value = "">Seleccione una opción</option>';
                                while ($row = mysqli_fetch_array($resultado6)) {
                                    $s = '';
                                    if ($row['IdActividad'] == $IdGeneral) {
                                        $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">A/M. Particular:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="ActvParticular<?php echo $indice; ?>" class="form-control" name="ActvParticular_edit<?php echo $indice; ?>" onchange="actividades4(<?php echo $indice; ?>);">
                                <?php
                                if ($Particular) {
                                    $consultaperiodo6 = "SELECT a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad 
                                            FROM c_actividad a 
                                            WHERE a.IdEje = $IdProyecto AND a.IdNivelActividad = 3 AND a.IdTipoActividad = $IdTipoConcepto AND a.IdActividadSuperior=$IdGeneral
                                            ORDER BY a.Orden";
                                    $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
                                    echo '<option value = "">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado6)) {
                                        $s = '';
                                        if ($row['IdActividad'] == $Particular) {
                                            $s = 'selected = "selected"';
                                        }
                                        echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">SubActividad/Meta:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="SubActividad<?php echo $indice; ?>" class="form-control" name="SubActividad_edit<?php echo $indice; ?>">
                                <?php
                                if ($subact) {
                                    $consultaperiodo6 = "SELECT a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad 
                                        FROM c_actividad a 
                                        WHERE a.IdEje = $IdProyecto AND a.IdNivelActividad = 4 AND a.IdTipoActividad = $IdTipoConcepto AND a.IdActividadSuperior=$IdParticular
                                        ORDER BY a.Orden";
                                    $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
                                    echo '<option value = "">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado6)) {
                                        $s = '';
                                        if ($row['IdActividad'] == $subact) {
                                            $s = 'selected = "selected"';
                                        }
                                        echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <span id="entregable_subact" name="entregable_subact"></span>
                        </div>
                    </div>
                <?php
                    $indice++;
                    $edit++;
                } ?>
            <?php } else { ?>
                <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Eje:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="Eje" class="form-control" name="Eje" onchange="Categorias();">
                            <?php
                            $consultagiro = "SELECT e.idEje,e.Nombre FROM c_eje as e ";
                            $resultado = $catalogo->obtenerLista($consultagiro);
                            echo '<option value = "">Seleccione una opción</option>';
                            while ($row = mysqli_fetch_array($resultado)) {
                                $s = '';
                                echo '<option value = "' . $row['idEje'] . '" ' . $s . '>' . $row['idEje'] . '. ' . $row['Nombre'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2 control-label" for="AÑO">* Categoría:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="cate" class="form-control" name="cate" onchange="actividades1();Sub_Categorias();">
                        </select>
                    </div>
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Sub categoría:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="subcate" class="form-control" name="subcate" onchange="actividades1();">
                        </select>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Exposición Temporal:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="Expotem" class="form-control" name="Expotem">
                            <?php
                            $consultaperiodo6 = "SELECT e.idExposicion,e.tituloFinal FROM c_exposicionTemporal as e WHERE e.estatus=1 ORDER BY e.tituloFinal ";
                            $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
                            echo '<option value = "">Seleccione una opción</option>';
                            while ($row = mysqli_fetch_array($resultado6)) {
                                echo '<option value = "' . $row['idExposicion'] . '" ' . $s . '>' . $row['tituloFinal'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Actividad/Meta:</label>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <select id="acme" class="form-control" name="acme" onchange="actividades1();">
                            <option value="1">Actividad</option>
                            <option value="2">Meta</option>
                        </select>
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* A/M. Global:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="ActvGlobal" class="form-control" name="ActvGlobal" onchange="actividades2();">

                        </select>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <span id="entregable_act_glob" name="entregable_act_glob"></span>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">A/M. General:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="ActvGeneral" class="form-control" name="ActvGeneral" onchange="actividades3();">

                        </select>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <span id="entregable_act_gen" name="entregable_act_gen"></span>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">A/M. Particular:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="ActvParticular" class="form-control" name="ActvParticular" onchange="actividades4();" disabled>
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <span id="entregable_act_part" name="entregable_act_part"></span>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">SubActividad/Meta:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="SubActividad" class="form-control" name="SubActividad" disabled>
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <span id="entregable_subact" name="entregable_subact"></span>
                    </div>
                </div>
            <?php } ?>
            <div id="nuevaactividad">

            </div>
            <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Invitar a:</label>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <select id="invA" class="form-control form-control-sm mx-0 px-0 w-50" style="font-size:12px; display:inline-block;">
                        <?php
                        $consultaperiodo = "SELECT Id_Area,Nombre FROM c_area  ORDER BY Nombre";
                        $resultado = $catalogo->obtenerLista($consultaperiodo);
                        echo ' <option value = "">Seleccione un Área</option>';
                        while ($row = mysqli_fetch_array($resultado)) {
                            $s = '';
                            echo '<option value = "' . $row['Id_Area'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <button id="agregarAreas" type="button" class="btn btn-info btn-sm" onclick="invarea();"><i class="glyphicon glyphicon-plus-sign"></i></button>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2" id="involucrados">

                    <?php
                    if ($editar == TRUE) {
                        $contador = 0;
                        $consultaareasin = "SELECT acu.id_Archivo_area,acu.id_Area_invitada,a.Nombre FROM k_archivoarea AS acu INNER JOIN c_area as a on a.Id_Area=acu.id_Area_invitada WHERE acu.id_Archivo =$idacuerdo";

                        $resultadoarea = $catalogo->obtenerLista($consultaareasin);
                        while ($row = mysqli_fetch_array($resultadoarea)) {
                            echo '<span id = "areaI' . $row["id_Area_invitada"] . '"class = "badge badge-dark disable-select">' . $row["Nombre"] . ' <i class = "glyphicon glyphicon-remove" onclick = "eliminarArea(' . $row["id_Area_invitada"] . ');" style = "font-size:13px;"></i></span>';
                            echo '<input id = "invA' . $row["id_Area_invitada"] . '" name = "invitados' . $contador . '" value = "' . $row["id_Area_invitada"] . '" type = "hidden">';

                            $contador++;
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="form-group form-group-sm">
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <?php
                    echo '<input type="hidden" id="tamanoArt" name="tamanoArt" value="' . $contadorac . '"/>';
                    echo '<input type="hidden" id="tamanoAreas" name="tamanoAreas" value="' . $contadorar . '"/>';
                    echo '<input type="hidden" id="editaer" name="editaer" value="' . $edit . '"/>';
                    echo '<input type="hidden" id="idUsuario" name="idUsuario" value="' . $idUsuario . '"/>';
                    echo '<input type="hidden" id="usuario" name="usuario" value="' . $nombreUsuario . '" />';
                    echo '<input type="hidden" id="aplicacion" name="aplicacion" value="2" />';
                    ?>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <button type="button" class="btn btn-default btn-xs" id="guardar">Guardar</button>
                </div>

            </div>
        </form>
    </div>