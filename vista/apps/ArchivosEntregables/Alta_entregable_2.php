<?php
//Aplicacion modificada por : Jose carlos 19/08/2021 //
//clases que usa el formulario
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once('../../../WEB-INF/Classes/ArchivoCompartido.class.php');
include_once('../../../WEB-INF/Classes/ActividadArchivo.class.php');
include_once('../../../WEB-INF/Classes/AreaArchivo.class.php');
$catalogo = new Catalogo();
$archivo = new ArchivoCompartido();
$archivo2 = new actividades();
//variables del formulario
date_default_timezone_set('America/Mexico_City');
$zonahoraria = date_default_timezone_get();
$editar = false;
$añoactual = date("Y");
$tipoPerfil = $_GET["tipoPerfil"];
$nombreUsuario = $_GET["nombreUsuario"];
$idUsuario = $_GET["idUsuario"];
$periodo_actual = $archivo->PeriodoActual($añoactual);
$Descripcion_entregable = "";
$periodo2 = "";
$Area = "";
$Tipo_entregable = "";
$Eje = "";
$ACME = "";
$Categoria = "";
$Subcategoria = "";
$Actividad_global = "";
$Actividad_general = "";
$Actividad = "";
$Check = "";
$Subcheck = "";
$PDF = "";
$link = "";
$id_archivo = "";
$tipo_regresar = "";
$bandera_regresar = false;
$origen_asunto = 0;
$areausr = "";

if (isset($_GET['origen_asunto'])) {
    $origen_asunto = $_GET['origen_asunto'];
    $mas_pequeno = "label {
      font-size: .7em !important;
  }
  textarea {
      font-size: .7em !important;
  }
  select {
      font-size: .7em !important;
  }
  span{
      font-size: .7em !important;
      font-weight: bold;
  }
  .form-group {
    margin-bottom: 5px !important;
}";
    $mas_pequeno .= ".visible_componentes{
  display: none;
}";
} else {
    $mas_pequeno = " .visible_componentes{

  }";
}
$resultado = $catalogo->obtenerLista("SELECT per.idArea from c_usuario usu JOIN c_personas per ON per.id_Personas = usu.IdPersona where usu.IdUsuario = $idUsuario");
while ($row = mysqli_fetch_array($resultado)) {
    $areausr = $row["idArea"];
}

if (isset($_GET['accion']) && $_GET['accion'] != "") {
    if (isset($_GET['check_global'])) {
        $check_global = $_GET['check_global'];
    } else {
        $check_global = 0;
    }
    echo '<input type="hidden" id="accion" name="accion" value="' . $_GET['accion'] . '" />';
    echo '<input type="hidden" id="tipoPerfil" name="tipoPerfil" value="' . $_GET['tipoPerfil'] . '"/>';
    echo '<input type="hidden" id="nombreUsuario" name="nombreUsuario" value="' . $_GET['nombreUsuario'] . '"/>';
    echo '<input type="hidden" id="idUsuario" name="idUsuario" value="' . $_GET['idUsuario'] . '"/>';
    echo '<input type="hidden" id="regreso" name="regreso" value="' . $_GET['regreso'] . '"/>';

    echo '<input type="hidden" id="check_global" name="check_global" value="' . $check_global . '"/>';


    if (isset($_GET['plan']) && $_GET['plan'] == "1") {
        $editar = true;
        $Eje = $_GET['Id_eje'];
        $ACME = $_GET['ACME'];
        $Categoria = $_GET['cate'];
        $Subcategoria = $_GET['subcate'];
        $Actividad_global = $_GET['AGBL'];
        $Actividad_general = $_GET['AGENE'];
        $Check = $_GET['check'];
        $Subcheck = $_GET['subcheck'];
        $periodo2 = $_GET['periodo'];
        $Tipo_entregable = $_GET['tipo_entregable'];

        if ($Actividad_general > 0) {
            $Actividad = $Actividad_general;
        } else {
            $Actividad = $Actividad_global;
        }
        echo '<input type="hidden" id="Actividad" name="Actividad" value="' . $Actividad . '"/>';

        if ($Check != '') {
            $consultacheck = "SELECT ch.IdCheckList,ch.Nivel, CASE WHEN che.Nombre_alterno != '' THEN che.Nombre_alterno else ch.Nombre end as Nombre,chk.IdCheckList AS chpadre
        FROM c_checkList ch INNER JOIN k_checklist_actividad che ON che.IdCheckList = ch.IdCheckList
        LEFT JOIN c_checkList chk ON chk.IdCheckList = ch.IdCheckListPadre
            WHERE ch.IdCheckList = $Check ";
            //echo$consultacheck;
            $resultado6 = $catalogo->obtenerLista($consultacheck);

            while ($row = mysqli_fetch_array($resultado6)) {
                $Descripcion_entregable = $row['Nombre'];
                if ($row['chpadre'] != "") {
                    $Check = $row['chpadre'];
                    $Subcheck = $row['IdCheckList'];
                }
            }
        }
    }

    if ($_GET['accion'] == "editar2") {
        $editar = true;
        echo '<input type="hidden" id="id" name="id" value="' . $_GET['id'] . '"/>';
    } else {
        echo '<input type="hidden" id="id" name="id" value="0"/>';
    }
}
if ($editar == true && isset($_GET['plan']) && $_GET['plan'] != "1") {
    $id_archivo = $_GET['id'];
    $archivo->setId_documento($id_archivo);
    $archivo->getAcuerdo();
    $archivo2->setId_archivo($id_archivo);
    $archivo2->getActividades();
    $Descripcion_entregable = $archivo->getDescripcion();
    $periodo2 = $archivo->getAnio();
    $Area = $archivo->getId_area();
    $Tipo_entregable = $archivo->getId_tipo();
    $PDF = $archivo->getPdfcedulafiscal();
    $link = $archivo->getRuta();
    $Eje = $archivo2->getId_proyecto();
    $ACME = $archivo2->getId_tipo();
    $Categoria = $archivo2->getId_categoria();
    $Subcategoria = $archivo2->getId_subcategoria();
    $Actividad_global = $archivo2->getId_actividad1();
    $Actividad_general = $archivo2->getId_actividad2();
    $Check = $archivo2->getId_check_list();
    $Subcheck = $archivo2->getId_subcheck_list();
    $Actividad = $archivo2->getId_actividad();
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
    <script src="../../../resources/js/aplicaciones/ArchivosCompartidos/Alta_Entregable.js?911"></script>

    <style>
        textarea {
            resize: none;
        }

        <?php echo $mas_pequeno; ?>
    </style>
</head>

<body>
    <?php if (!isset($_GET['origen_asunto'])) { ?>

        <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Aplicaciones</a> / <a style="color:#fefefe;" href="Lista_entregable.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Entregables</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)"> Agregar Entregable</a></div>
    <?php } ?>
    <div id="container">
        <form class="form-horizontal" id="formArchivo" name="formArchivo">
            <div class="form-group form-group-sm visible_componentes">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">* Descripción del entregable</label>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="2"><?php echo $Descripcion_entregable; ?></textarea>
                </div>
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Periodo</label>
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <select id="ano" class="form-control" name="ano" onchange="">
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
            <div class="form-group form-group-sm visible_componentes">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Área sube el entregable:</label>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <select id="area" class="form-control" name="area" onchange="">
                        <?php
                        $consultaperiodo = "SELECT a.Id_Area,a.Nombre FROM c_area as a WHERE a.estatus=1 ORDER BY a.Nombre";
                        $resultado = $catalogo->obtenerLista($consultaperiodo);
                        echo ' <option value = "">Seleccione un Área</option>';
                        while ($row = mysqli_fetch_array($resultado)) {
                            $s = '';

                            if ($_GET['accion'] == "editar2") {
                                if ($row['Id_Area'] == $Area) $s = 'selected="selected"';
                            } else {
                                if ($areausr == $row['Id_Area']) $s = 'selected="selected"';
                            }

                            echo '<option value="' . $row['Id_Area'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

            </div>
            <div class="form-group form-group-sm ">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Tipo de entregable:</label>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <select id="categoria" class="form-control" name="categoria">
                        <?php
                        $consultaperiodo2 = "SELECT d.id_tipo,d.tipo FROM c_tipo_documento as d WHERE d.id_tipo IN (9,10,14) order BY d.fechaCreacion asc";
                        $resultado88 = $catalogo->obtenerLista($consultaperiodo2);
                        echo '<option value="">Seleccione una opción</option>';
                        while ($row = mysqli_fetch_array($resultado88)) {
                            $s = '';
                            if ($row['id_tipo'] == $Tipo_entregable) {
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
                    <input type="hidden" id="Tipo_last" name="Tipo_last" value="<?php echo $Tipo_entregable ?>" />
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="imagen">* Archivo </label>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <input type="file" id="pdf" name="pdf" class="form-control" accept="" <?php if ($editar == true && $PDF == "link") echo "disabled"; ?> />
                    <?php
                    if ($editar == true && $PDF != "" && $PDF != "link") {
                        $rutaimg = $archivo->ruta_guardar($Tipo_entregable);
                        $rutaimg = '../../../' . $rutaimg . $PDF;
                        echo '<a target="_blank" href="' . $rutaimg . '" ><i class="glyphicon glyphicon-file"></i> Archivo</a>';
                        echo '<input type="hidden" name="archivo_registrado" id="archivo_registrado" value="1">';
                    }
                    ?>

                </div>
                <label class="col-md-2 col-sm-2 col-xs-2 ">(Máximo 4 Mb) </label>
            </div>
            <div class="form-group form-group-sm">
                <div class="col-md-2 col-sm-2 col-xs-2  control-label">
                    <span>Añadir link a archivo</span> <input type="checkbox" id="checkbox_pdf" onclick="link()" <?php if ($editar == true && $PDF == "link") echo "checked"; ?> />
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <input type="text" id="link_pdf" name="link_pdf" class="form-control" <?php if ($editar == true && $PDF == "link") echo "value='$link'";
                                                                                            else echo "disabled" ?> />
                </div>
                <label class="col-md-2 col-sm-2 col-xs-2 ">(Más de 4 Mb) </label>
            </div>
            <div class="form-group form-group-sm visible_componentes">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Eje:</label>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <select id="Eje" class="form-control" name="Eje" onchange="Categorias();">
                        <?php
                        $consultagiro = "SELECT * FROM c_eje WHERE estatus = 1 ORDER BY idEje; ";
                        $resultado = $catalogo->obtenerLista($consultagiro);
                        echo '<option value = "">Seleccione una opción</option>';
                        while ($row = mysqli_fetch_array($resultado)) {
                            $s = '';
                            if ($row['idEje'] == $Eje) {
                                $s = 'selected="selected"';
                            }
                            echo '<option value = "' . $row['idEje'] . '" ' . $s . '>' . $row['idEje'] . '. ' . $row['Nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

            </div>
            <div class="form-group form-group-sm visible_componentes">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Actividad/Meta:</label>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <select id="acme" class="form-control" name="acme" onchange="">
                        <?php if ($ACME == 1 && $editar == true) {
                            echo '<option value="1" selected="selected">Actividad</option>';
                            echo '<option value="2">Meta</option>';
                        } elseif ($ACME == 2 && $editar == true) {
                            echo '<option value="1">Actividad</option>';
                            echo '<option value="2" selected="selected">Meta</option>';
                        } else {
                            echo '<option value="1">Actividad</option>
                            <option value="2">Meta</option>';
                        }

                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group form-group-sm visible_componentes">
                <label class="col-md-2 col-sm-2 col-xs-2 control-label" for="AÑO">* Categoría:</label>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <select id="cate" class="form-control" name="cate" onchange="Sub_Categorias();Actividad_global();">
                        <?php
                        if ($editar == true) {
                            $consultagiro = "SELECT c.* FROM c_categoriasdeejes c 
                            WHERE c.idEje= '$Eje' AND c.nivelCategoria=1 
                            AND c.anio=$periodo2
                            ORDER BY c.descCategoria;";
                            //echo$consultagiro;
                            $resultado = $catalogo->obtenerLista($consultagiro);
                            echo '<option value="">Seleccione una opción</option>';
                            while ($row = mysqli_fetch_array($resultado)) {
                                $s = '';
                                if ($row['idCategoria'] == $Categoria) {
                                    $s = 'selected="selected"';
                                }
                                echo '<option value="' . $row['idCategoria'] . '" ' . $s . '>' . $row['descCategoria'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO">Sub categoría:</label>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <select id="subcate" class="form-control" name="subcate" onchange="Actividad_global();">
                        <?php
                        if ($editar == true && $Subcategoria > 1) {
                            $consultagiro = "SELECT c.* FROM c_categoriasdeejes c 
                            WHERE  c.nivelCategoria=2 AND c.idCategoriaPadre=" . $Categoria . "
                            ORDER BY c.descCategoria";
                            $resultado = $catalogo->obtenerLista($consultagiro);
                            echo '<option value="">Seleccione una opción</option>';
                            while ($row = mysqli_fetch_array($resultado)) {
                                $s = '';
                                if ($row['idCategoria'] == $Subcategoria) {
                                    $s = 'selected="selected"';
                                }
                                echo '<option value="' . $row['idCategoria'] . '" ' . $s . '>' . $row['descCategoria'] . '</option>';
                            }
                        } elseif ($editar == true && $Subcategoria == "") {
                            echo '<option value="0">No aplica</option>';
                        } elseif ($editar == true) {
                            echo '<option value="0">No aplica</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group form-group-sm visible_componentes">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* A/M. Global:</label>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <select id="ActvGlobal" class="form-control" name="ActvGlobal" onchange="Actividad_general();">
                        <?php
                        if ($editar == true) {
                            if ($Subcategoria == 0) {

                                $query = "SELECT a.*, b.Numeracion, b.Orden
                                FROM c_actividad a 
                                JOIN k_actividad_categoria b ON b.IdActividad=a.IdActividad
                                WHERE  b.IdCategoria=$Categoria AND a.IdNivelActividad=1
                                ORDER BY b.Orden";
                                $result = $catalogo->obtenerLista($query);

                                echo '<option value="0">Seleccione</option>';
                                while ($rowM = mysqli_fetch_array($result)) {
                                    $s = '';
                                    if ($rowM['IdActividad'] == $Actividad_global) {
                                        $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $rowM['IdActividad'] . '" ' . $s . '>' . $rowM['Numeracion'] . " " . $rowM['Nombre'] . '</option>';
                                }
                            } else {
                                $query = "SELECT a.* , b.Numeracion, b.Orden
                                FROM c_actividad a 
                                JOIN k_actividad_categoria b ON b.IdActividad=a.IdActividad
                                WHERE  b.IdCategoria=$Subcategoria AND a.IdNivelActividad=1
                                ORDER BY b.Orden";
                                $result = $catalogo->obtenerLista($query);

                                echo '<option value="0">Seleccione</option>';
                                while ($rowM = mysqli_fetch_array($result)) {
                                    $s = '';
                                    if ($rowM['IdActividad'] == $Actividad_global) {
                                        $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $rowM['IdActividad'] . '" ' . $s . '>' . $rowM['Numeracion'] . " " . $rowM['Nombre'] . '</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
                <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO">A/M. General:</label>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <select id="ActvGeneral" class="form-control" name="ActvGeneral" onchange="checklist();">
                        <?php
                        if ($editar == true) {
                            if($Categoria == ''){
                                $Categoria = 0;
                            }
                            if($Subcategoria == 0){
                                $query = "SELECT a.* , b.Numeracion, b.Orden
                                FROM c_actividad a 
                                JOIN k_actividad_categoria b ON b.IdActividad=a.IdActividad
                                WHERE  b.IdCategoria=$Categoria AND a.IdNivelActividad=2
                                AND a.IdActividadSuperior =$Actividad_global
                                ORDER BY b.Orden";
                                $result = $catalogo->obtenerLista($query);
                    
                                echo '<option value="0">Seleccione</option>';
                                while ($row = mysqli_fetch_array($result)) {
                                    $s = '';
                                    if ($rowM['IdActividad'] == $Actividad_general) {
                                        $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $rowM['IdActividad'] . '" ' . $s . '>' . $rowM['Numeracion']. " ". $rowM['Nombre'] . '</option>';
                                }
                    
                            }else{
                                $query = "SELECT a.* , b.Numeracion, b.Orden
                                FROM c_actividad a 
                                JOIN k_actividad_categoria b ON b.IdActividad=a.IdActividad
                                WHERE  b.IdCategoria=$Subcategoria AND a.IdNivelActividad=2
                                AND a.IdActividadSuperior =$Actividad_global
                                ORDER BY b.Orden";
                                $result = $catalogo->obtenerLista($query);
                    
                                echo '<option value="0">Seleccione</option>';
                                while ($rowM = mysqli_fetch_array($result)) {
                                    $s = '';
                                    if ($rowM['IdActividad'] == $Actividad_general) {
                                        $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $rowM['IdActividad'] . '" ' . $s . '>' . $rowM['Numeracion']. " ". $rowM['Nombre'] . '</option>';
                                }
                    
                            }
                            
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group form-group-sm visible_componentes">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO"> Check:</label>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <select id="Check" class="form-control" name="Check" onchange="Subcheck();">
                        <?php
                        if ($editar == true) {
                            if($Subcategoria ==0){
                                $Subcategoria = $Categoria;
                            }
                            if($Actividad_general == 0){
                                $query = "SELECT c.idCheckList , c.Nombre  , c.Tipo,a.IdActividad, a.IdCategoria  
                                FROM c_checkList  c 
                                JOIN k_checklist_actividad a  ON c.idCheckList = a.IdCheckList 
                                WHERE Nivel = 1 and a.IdActividad =  $Actividad_global and a.Idcategoria = $Subcategoria
                                ORDER BY c.Nombre "
                            ;
                            $result = $catalogo->obtenerLista($query);
                
                            echo '<option value="0">Seleccione</option>';
                            while ($row = mysqli_fetch_array($result)) {
                                $s = '';
                                if ($row['idCheckList'] == $Check) {
                                    $s = 'selected = "selected"';
                                }
                                echo '<option value = "' . $row['idCheckList'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                            }
                
                            }else{
                                $query = "SELECT c.idCheckList , c.Nombre  , c.Tipo,a.IdActividad, a.IdCategoria  
                                FROM c_checkList  c 
                                JOIN k_checklist_actividad a  ON c.idCheckList = a.IdCheckList 
                                WHERE Nivel = 1 and a.IdActividad =  $Actividad_general and a.Idcategoria = $Subcategoria
                                ORDER BY c.Nombre "
                            ;
                            $result = $catalogo->obtenerLista($query);
                
                            echo '<option value="0">Seleccione</option>';
                            while ($row = mysqli_fetch_array($result)) {
                                $s = '';
                                if ($row['idCheckList'] == $Check) {
                                    $s = 'selected = "selected"';
                                }
                                echo '<option value = "' . $row['idCheckList'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                            }
                
                            }

                            
                        }
                        ?>
                    </select>
                </div>
                <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO">Sub-Check:</label>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <select id="subCheck" class="form-control" name="subCheck" onchange="">
                        <?php
                        if ($editar == true) {
                            if($Check == ""){
                                $Check = 0;
                            }
                            $query = "SELECT c.idCheckList , c.Nombre  , c.Tipo,a.IdActividad, a.IdCategoria, c.IdCheckListPadre  
                            FROM c_checkList  c 
                            JOIN k_checklist_actividad a  ON c.idCheckList = a.IdCheckList 
                            WHERE c.IdCheckListPadre=  $Check
                            ORDER BY c.Nombre"
                            ;
                            $result = $catalogo->obtenerLista($query);

                            echo '<option value="0">Seleccione</option>';
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $s = '';
                                    if ($row['idCheckList'] == $Subcheck) {
                                        $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $row['idCheckList'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                }
                            }
                            else {
                                echo ' <option value="0">No aplica</option>';
                            }
                           
                        } 
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group form-group-sm">
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <?php
                    echo '<input type="hidden" id="idUsuario" name="idUsuario" value="' . $idUsuario . '"/>';
                    echo '<input type="hidden" id="usuario" name="usuario" value="' . $nombreUsuario . '" />';
                    echo '<input type="hidden" id="aplicacion" name="aplicacion" value="2" />';
                    echo '<input type="hidden" id="bandera" name="bandera" value="' . $bandera_regresar . '" />';
                    echo '<input type="hidden" id="origenasunto" name="origenasunto" value="' . $origen_asunto . '" />';
                    ?>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <?php if (isset($_GET['plan']) && $_GET['plan'] == "1" && !isset($_GET['origen_asunto'])) { ?>
                        <button type="button" class="btn btn-default btn-xs" id="back">regresar</button>
                    <?php } elseif (isset($_GET['plan']) && $_GET['plan'] == "2" && $_GET['regreso'] == "2" && !isset($_GET['origen_asunto'])) { ?>
                        <button type="button" class="btn btn-default btn-xs" id="back">regresar</button>
                    <?php } ?>
                    <button type="button" class="btn btn-default btn-xs" id="guardar">Guardar</button>

                </div>

            </div>
        </form>
    </div>
</body>
<script>
    var back = document.getElementById('back'); // Suponiendo que la identificación del elemento del botón de retorno está de vuelta
    back.onclick = function() {
        history.back(); // Regresa a la página anterior, también se puede escribir como history.go (-1)
    };
</script>

</html>