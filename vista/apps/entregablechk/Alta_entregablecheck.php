<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once __DIR__."/../../../source/dao/clases/LoggedinTime.php";
include_once __DIR__."/../../../source/controller/UsuarioController.php";



if(!isset($_SESSION['user_session']))
{
?>
<script>
    top.location.href="../../login.php";
    window.reload();
</script>
<?php
}


include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once('Entregablecheck.class.php');

$catalogo = new Catalogo();
$entregablecheck = new Entregablecheck();
$MiTipoPerfil=1;//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiIdUsr=$_SESSION['user_session'];
$MiNomUsr="SinUsr";
if ((isset($_GET['tipoPerfil'])      && $_GET['tipoPerfil'] != ""))          { $MiTipoPerfil=$_GET['tipoPerfil']; }
if ((isset($_GET['idUsuario'])       && $_GET['idUsuario'] != ""))           { $MiIdUsr=     $_GET['idUsuario']; }
if ((isset($_GET['nombreUsuario'])   && $_GET['nombreUsuario'] != ""))       { $MiNomUsr=    $_GET['nombreUsuario']; }
$MiNomUsr=str_replace(" ", "%20", $MiNomUsr);
$MisParam="tipoPerfil=".$MiTipoPerfil."&idUsuario=".$MiIdUsr."&nombreUsuario=".$MiNomUsr; //Para pasar parametros a la siguiente liga


$editar = false;
date_default_timezone_set('America/Mexico_City');
$entregable = "";
$checklist = "";
$responsable = "";
$anio = "";
$eje = "";
$tipoactividad = "";
$global = "";
$general = "";
$particular = "";
$subactividad = "";
$categoria = "";
$subcategoria = "";
$IdExposición = "";



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
    $entregablecheck->setId_entregablecheck($_GET['id']);
    $entregablecheck->getentregablecheck();
    $entregable = $entregablecheck->getentregable();
    $checklist = $entregablecheck->getchecklist();
    $responsable = $entregablecheck->getresponsable();
    $anio = $entregablecheck->getanio();
    $eje = $entregablecheck->geteje();
    $tipoactividad = $entregablecheck->gettipoactividad();
    $global = $entregablecheck->getglobal();
    $general = $entregablecheck->getgeneral();
    $particular = $entregablecheck->getparticular();
    $subactividad = $entregablecheck->getsubactividad();
    $categoria = $entregablecheck->getcategoria();
}
?>


<!DOCTYPE html>
<html lang="es">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>::.FORMULARIO ENTREGABLE CHECK.::</title>

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
    <script src="Alta_entregablecheck.js"></script>
</head>

<script type="text/javascript">
    function llenar(){
    var periodo = $('#ano').val();
    var eje = $('#eje').val();
        
    $.post( "Consultacategorias.php?Ano=" + periodo + "&Eje=" + eje,{},function(data) {
    if(data != ""){
    $('#categoria').html(data);
    }
    });
    }

    function llenarsub(){
    var categoria = $('#categoria').val();
    $.post( "Consultacategorias.php?Categoria=" + categoria,{},function(data) {
    if(data != ""){
    $('#subcategoria').html(data);
    }
    });
    }

    function llenarglobal(){
    var ejeglobal = $('#eje').val();
    var periodo1 = $('#ano').val();
    var actividadmeta = $('#actividadmeta').val();
    $.post( "Consultacategorias.php?EjeGlobal=" + ejeglobal + "&AnoGlobal=" + periodo1 + "&ActividadMeta=" + actividadmeta,{},function(data) {
    if(data != ""){
    $('#actividadglobal').html(data);
    }
    });
    }

    function llenarglobalcategoria(){
    var ejeglobal1 = $('#eje').val();
    var periodo11 = $('#ano').val();
    var categoria2 = $('#categoria').val();
    var actividadmeta1 = $('#actividadmeta').val();
    $.post( "Consultacategorias.php?EjeGlobal1=" + ejeglobal1 + "&AnoGlobal1=" + periodo11 + "&Categoria1=" + categoria2 + "&ActividadMeta1=" + actividadmeta1,{},function(data) {
    if(data != ""){
    $('#actividadglobal').html(data);
    }
    });
    }

    function llenarglobalsubcategoria(){
    var categoria3 = $('#subcategoria').val();
    var actividadmeta2 = $('#actividadmeta').val();
    $.post( "Consultacategorias.php?Categoria3=" + categoria3 + "&ActividadMeta2=" + actividadmeta2,{},function(data) {
    if(data != ""){
    $('#actividadglobal').html(data);
    }
    });
    }

    function llenargeneral(){
    var actividadglobal = $('#actividadglobal').val();
    var ejeparaglobal = $('#eje').val();
    var actividadmetageneral = $('#actividadmeta').val();
    $.post( "Consultacategorias.php?ejeparaglobal=" + ejeparaglobal + "&actividadglobal=" + actividadglobal + "&actividadmetageneral=" + actividadmetageneral,{},function(data) {
    if(data != ""){
    $('#actividadgeneral').html(data);
    }
    });
    }


    function llenarpaticular(){
    var actividadparticular = $('#actividadgeneral').val();
    var ejeparaparticular = $('#eje').val();
    var actividadmetaparticular = $('#actividadmeta').val();
    $.post( "Consultacategorias.php?ejeparaparticular=" + ejeparaparticular + "&actividadparticular=" + actividadparticular + "&actividadmetaparticular=" + actividadmetaparticular,{},function(data) {
    if(data != ""){
    $('#actividadparticular').html(data);
    }
    });
    }


    function llenarsubactividad(){
    var actividadsubactividad = $('#actividadparticular').val();
    var ejeparasubactividad = $('#eje').val();
    var actividadmetaactividadsub = $('#actividadmeta').val();
    $.post( "Consultacategorias.php?ejeparasubactividad=" + ejeparasubactividad + "&actividadsubactividad=" + actividadsubactividad + "&actividadmetaactividadsub=" + actividadmetaactividadsub,{},function(data) {
    if(data != ""){
    $('#SubActividad').html(data);
    }
    });
    }


  function limpiardesdeeje(){
  $('#subcategoria').html("");
  $('#actividadgeneral').html("");
  $('#actividadparticular').html("");
  $('#SubActividad').html("");
  $('#entregable').html("");
  }

  function limpiardesdeglobal(){
  $('#actividadgeneral').html("");
  $('#actividadparticular').html("");
  $('#SubActividad').html("");
  $('#entregable').html("");
  }


  function limpiarentregable(){
  $('#entregable').html("");
  }


  function llenarentregableglobal(){
    var ejeentregableglobal = $('#actividadglobal').val();
    $.post( "Consultacategorias.php?EjeEntregableGlobal=" + ejeentregableglobal,{},function(data) {
    if(data != ""){
    $('#entregable').html(data);
    }
    });
    }



    function llenarentregablegeneral(){
    var ejeentregablegeneral = $('#actividadgeneral').val();
    $.post( "Consultacategorias.php?EjeEntregableGeneral=" + ejeentregablegeneral,{},function(data) {
    if(data != ""){
    $('#entregable').html(data);
    }
    });
    }

   
    function llenarentregableparticular(){
    var ejeentregableparticular = $('#actividadparticular').val();
    $.post( "Consultacategorias.php?EjeEntregableParticular=" + ejeentregableparticular,{},function(data) {
    if(data != ""){
    $('#entregable').html(data);
    }
    });
    }


    function llenarentregablesubactividad(){
    var ejeentregablesubactividad = $('#SubActividad').val();
    $.post( "Consultacategorias.php?EjeEntregableSubActividad=" + ejeentregablesubactividad,{},function(data) {
    if(data != ""){
    $('#entregable').html(data);
    }
    });
    }

</script>
<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?<?php echo $MisParam; ?>">Aplicaciones</a> / <a style="color:#fefefe;" href="Lista_entregablecheck.php?<?php echo $MisParam; ?>">Entregable Check</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Agregar Entregable Check</a> </div>
    <div class="well2 wr">
            <a style="color:#fefefe; cursor: pointer;" href="vista.php?<?php echo $MisParam; ?>"> Indicadores</a> /
            <a style="color:#fefefe; cursor: pointer;" href="Lista_entregablecheck.php?<?php echo $MisParam; ?>">Lista Entregable Check</a> /
            <a style="color:#fefefe; cursor: pointer;" href="Alta_entregablecheck.php?accion=guardar&usuario='<?php echo $MiNomUsr; ?>'&?<?php echo $MisParam; ?>"' . '">Agregar +</a>
        </div>
    <div id="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form class="form-horizontal" id="formEntregablecheck" name="formEntregablecheck">

                <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Periodo:</label>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <select id="ano" class="form-control" name="ano" onchange="llenar();llenarglobal();limpiardesdeeje();">
                        <?php
                        $consultaanio = "SELECT DISTINCT p.Id_Periodo,p.Periodo FROM c_periodo as p 
                        JOIN c_actividad a ON a.Periodo=p.Id_Periodo
                        WHERE p.CPE_ESTATUS=1 ORDER BY p.Periodo DESC";
                        $resultado1 = $catalogo->obtenerLista($consultaanio);
                        echo '<option value = "">Seleccione</option>';
                        while ($row = mysqli_fetch_array($resultado1)) {
                        $s = '';
                        if ($row['Id_Periodo'] == $anio) {
                        $s = 'selected = "selected"';
                        }
                        echo '<option value = "' . $row['Id_Periodo'] . '" ' . $s . '>' . $row['Periodo'].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

                    <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Eje:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="eje" class="form-control" name="eje" onchange="llenar();llenarglobal();limpiardesdeeje();">
                            <?php
                        $consultaeje = "SELECT e.idEje,e.Nombre FROM c_eje as e";
                        $resultado2 = $catalogo->obtenerLista($consultaeje);
                        echo '<option value = "">Seleccione</option>';
                        while ($row = mysqli_fetch_array($resultado2)) {
                        $s = '';
                        if ($row['idEje'] == $eje) {
                        $s = 'selected = "selected"';
                        }
                        echo '<option value = "' . $row['idEje'] . '" ' . $s . '>' . $row['idEje'] . '. ' . $row['Nombre'] . '</option>';
                        }
                        ?>
                        </select>
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Actividad/Meta:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="actividadmeta" class="form-control" name="actividadmeta" onchange="llenar();llenarglobal();limpiardesdeeje();">
                            <?php if ($tipoactividad == 1) {
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
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Categoria:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="categoria" class="form-control" name="categoria" onchange="llenarsub();llenarglobalcategoria();">
                            <?php
                            if ($editar == true) {
                            $consultacategoria = "SELECT ce.idCategoria,ce.descCategoria FROM c_categoriasdeejes ce INNER JOIN c_periodo p on p.Id_Periodo=ce.anio WHERE ce.nivelCategoria=1 AND p.Id_Periodo=$anio AND ce.idEje=$eje ORDER BY ce.orden ";
                            $resultado3 = $catalogo->obtenerLista($consultacategoria);
                            while ($row = mysqli_fetch_array($resultado3)) {
                            $s = '';
                            if ($row['idCategoria'] == $categoria) {
                            $s = 'selected = "selected"';
                            }
                            echo '<option value = "' . $row['idCategoria'] . '" ' . $s . '>' . $row['descCategoria'] . '</option>';
                            }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                    

                 <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Sub categoría:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="subcategoria" class="form-control" name="subcategoria" onchange="llenarglobalsubcategoria();">
                            <?php
                            if ($editar == true) {
                            $consultasubcategoria = "SELECT ce.idCategoria,ce.descCategoria FROM c_categoriasdeejes ce WHERE ce.idCategoriaPadre=$categoria ORDER BY ce.orden";
                            $resultado4 = $catalogo->obtenerLista($consultasubcategoria);
                            while ($row = mysqli_fetch_array($resultado4)) {
                            $s = '';
                            if ($row['idCategoria'] == $subcategoria) {
                            $s = 'selected = "selected"';
                            }
                            echo '<option value = "' . $row['idCategoria'] . '" ' . $s . '>' . $row['descCategoria'] . '</option>';
                            }
                        }
                            ?>
                        </select>
                    </div>
                </div>

                <!--<div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Exposición Temporal:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="exposiciontemporal" class="form-control" name="exposiciontemporal">
                            <?php
                                $consultaperiodo6 = "SELECT e.idExposicion,e.tituloFinal FROM c_exposicionTemporal as e WHERE e.estatus=1 ORDER BY e.tituloFinal ";
                                $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
                                echo '<option value = "">Seleccione</option>';
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
                </div>-->

                <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Global:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="actividadglobal" class="form-control" name="actividadglobal" onchange="llenargeneral();limpiardesdeglobal();llenarentregableglobal();">
                            <?php 
                            if ($editar == true) {
                            $consultaperiodo7 = "SELECT a.IdActividad, CONCAT(a.Numeracion,a.Nombre) as actividad FROM c_actividad a WHERE a.IdEje=$eje AND a.IdNivelActividad=1 AND IdTipoActividad=$tipoactividad ORDER BY a.Orden";
                            $resultado7 = $catalogo->obtenerLista($consultaperiodo7);
                            while ($row = mysqli_fetch_array($resultado7)) {
                            $s = '';
                            if ($row['IdActividad'] == $global) {
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
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">General:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="actividadgeneral" class="form-control" name="actividadgeneral" onchange="llenarpaticular();llenarentregablegeneral();limpiarentregable();">
                            <?php
                            if ($editar == true) {
                                $consultaperiodo8 = "SELECT a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad 
                                        FROM c_actividad a 
                                        WHERE a.IdEje = $eje AND a.IdNivelActividad = 2 AND a.IdTipoActividad =$tipoactividad AND a.IdActividadSuperior=$global
                                        ORDER BY a.Orden";
                                $resultado8 = $catalogo->obtenerLista($consultaperiodo8);
                                while ($row = mysqli_fetch_array($resultado8)) {
                                    $s = '';
                                    if ($row['IdActividad'] == $general) {
                                        $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
                                }
                            }
                                ?>
                        </select>
                    </div>
                </div>


                <div class="form-group form-group-sm" style="display: none;">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Particular:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="actividadparticular" class="form-control" name="actividadparticular" onchange="llenarsubactividad();llenarentregableparticular();limpiarentregable();">
                            <?php
                            if ($editar == true) {
                                 $consultaperiodo9 = "SELECT a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad 
                            FROM c_actividad a 
                            WHERE a.IdEje = $eje AND a.IdNivelActividad = 3 AND a.IdTipoActividad =$tipoactividad AND a.IdActividadSuperior=$general
                            ORDER BY a.Orden";
                            $resultado9 = $catalogo->obtenerLista($consultaperiodo9);
                            while ($row = mysqli_fetch_array($resultado9)) {
                            $s = '';
                            if ($row['IdActividad'] == $particular) {
                            $s = 'selected = "selected"';
                            }
                            echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
                            }
                        }
                            ?>
                        </select>
                    </div>
                </div>


                <div class="form-group form-group-sm" style="display: none;">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">SubActividad/Meta:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="SubActividad" class="form-control" name="SubActividad" onchange="llenarentregablesubactividad();limpiarentregable();">
                            <?php
                            if ($editar == true) {
                                $consultaperiodo10 = "SELECT a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad 
                                        FROM c_actividad a 
                                        WHERE a.IdEje = $eje AND a.IdNivelActividad = 4 AND a.IdTipoActividad =$tipoactividad AND a.IdActividadSuperior=$particular ORDER BY a.Orden";
                                    $resultado10 = $catalogo->obtenerLista($consultaperiodo10);
                                    while ($row = mysqli_fetch_array($resultado10)) {
                                        $s = '';
                                        if ($row['IdActividad'] == $subactividad) {
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
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="padre">* Entregable:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">

                            <select id="entregable" class="form-control" name="entregable">
                                <?php 
                                if ($editar == true) {
                                    $consultaentregable = "SELECT IdEntregable,Nombre FROM c_entregable where IdEntregable=$entregable order by Nombre asc";
                                    $resultado = $catalogo->obtenerLista($consultaentregable);
                                    while ($row = mysqli_fetch_array($resultado)) {
                                    $s = '';
                                    if ($row['IdEntregable'] == $entregable) {
                                    $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $row['IdEntregable'] . '" ' . $s . '>' . $row['Nombre'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="checklist">* CheckList:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">

                            <select id="checklist" class="form-control" name="checklist">
                                <option value="">Seleccione</option>
                                <?php 
                                    $consultacheck = "SELECT IdCheckList,Nombre FROM c_checkList order by Nombre asc;";
                                    $resultado = $catalogo->obtenerLista($consultacheck);
                                    while ($row = mysqli_fetch_array($resultado)) {
                                    $s = '';
                                    if ($row['IdCheckList'] == $checklist) {
                                    $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $row['IdCheckList'] . '" ' . $s . '>' . $row['Nombre'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="responsable">* Responsable:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">

                            <select id="responsable" class="form-control" name="responsable">
                                <option value = "">Seleccione</option>
                                <?php 
                                    $consultaresponsable = "SELECT id_Personas, CONCAT(Nombre,' ',Apellido_Paterno,' ',Apellido_Materno) AS nombrecompleto FROM c_personas order by Nombre asc";
                                /*$consultaresponsable = "SELECT p.id_Personas, CONCAT(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno)as nombrecompleto 
                                FROM c_personas as p 
                                JOIN c_rolPersona rp ON p.id_Personas=rp.id_Persona
                                WHERE rp.id_Rol=146
                                ORDER BY nombrecompleto";*/
                                    $resultado = $catalogo->obtenerLista($consultaresponsable);
                                    while ($row = mysqli_fetch_array($resultado)) {
                                    $s = '';
                                    if ($row['id_Personas'] == $responsable) {
                                    $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $row['id_Personas'] . '" ' . $s . '>' . $row['nombrecompleto'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>


                  
                    <div class="form-group form-group-sm">
                        <div class="col-md-2 col-sm-2 col-xs-2">

                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <button type="button" class="btn btn-default btn-xs" id="guardar">Guardar</button>
                            <!-- <button type="cancel" class="btn btn-default btn-xs" id="cancelar" onclick="javascript:window.location='Lista_noticias.php">Cancelar</button> -->
                            <a href="Lista_entregablecheck.php" class="btn btn-default btn-xs">Regresar</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

</body>
</html>
