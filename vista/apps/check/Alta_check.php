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
include_once('Check.class.php');

$catalogo = new Catalogo();
$checkList = new Check();

$MiTipoPerfil=1;//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiIdUsr= $_SESSION['user_session'];
$MiNomUsr="SinUsr";
if ((isset($_GET['tipoPerfil']) && $_GET['tipoPerfil'] != ""))          { $MiTipoPerfil=$_GET['tipoPerfil']; }
if ((isset($_GET['idUsuario']) && $_GET['idUsuario'] != ""))            { $MiIdUsr=     $_GET['idUsuario']; }
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != ""))    { $MiNomUsr=    $_GET['nombreUsuario']; }
$MiNomUsr=str_replace(" ", "%20", $MiNomUsr);
$MisParam="tipoPerfil=".$MiTipoPerfil."&idUsuario=".$MiIdUsr."&nombreUsuario=".$MiNomUsr; //Para pasar parametros a la siguiente liga


$editar = false;
date_default_timezone_set('America/Mexico_City');
$nombre = "";
$descripcion = "NULL";
$nivel = "";
$padre = "";
$anio = "";
$eje = "";
$tipoactividad = "";
$global = "";
$general = "";
$particular = "";
$subactividad = "";
$categoria = "";
$subcategoria = "";
$tiene = "";
$orden = "";
$entregable="";
$responsable ="";

//desde planeacion
$regresar = "";
$Id_actividad = "";
$Id_categoria = "";
$Id_subcategoria = "";
$ACME = "";
$Periodo= "";
$Nombreeje = "";
$ano = "";
$Id_usuario = "";
$nombreUsuario = "";
$Perfil = "";
$Id_actividadsuperior = "";
$check = "";

if ((isset($_GET['idPeriodo']) && $_GET['idPeriodo'] != "")) //Si el parametro existe se procesa
{   if ($_GET['idPeriodo']!="0") {$anio = $_GET['idPeriodo'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $anio=""; } //Si el parametro es igual a 0 se buscan los NULOS
}

if ((isset($_GET['idEje']) && $_GET['idEje'] != "")) //Si el parametro existe se procesa
{   if ($_GET['idEje']!="0") {$eje = $_GET['idEje'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $eje=""; } //Si el parametro es igual a 0 se buscan los NULOS
}

if ((isset($_GET['idActividad']) && $_GET['idActividad'] != "")) //Si el parametro existe se procesa
{   if ($_GET['idActividad']!="0") {
    $tipoactividad = $_GET['idActividad'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $tipoactividad=""; } //Si el parametro es igual a 0 se buscan los NULOS
}

if ((isset($_GET['idCategoria']) && $_GET['idCategoria'] != "")) //Si el parametro existe se procesa
{   if ($_GET['idCategoria']!="0") {$categoria  = $_GET['idCategoria'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $categoria =""; } //Si el parametro es igual a 0 se buscan los NULOS
}

if ((isset($_GET['idSubCategoria']) && $_GET['idSubCategoria'] != "")) //Si el parametro existe se procesa
{   if ($_GET['idSubCategoria']!="0") {$subcategoria  = $_GET['idSubCategoria'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $subcategoria =""; } //Si el parametro es igual a 0 se buscan los NULOS
}

//se invierte las variables de global y general
if ((isset($_GET['idActGlo']) && $_GET['idActGlo'] != "")) //Si el parametro existe se procesa
{   if ($_GET['idActGlo']!="0") {$general  = $_GET['idActGlo'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $general ="0"; } //Si el parametro es igual a 0 se buscan los NULOS
}

if ((isset($_GET['idActGen']) && $_GET['idActGen'] != "")) //Si el parametro existe se procesa
{   if ($_GET['idActGen']!="0") {$global  = $_GET['idActGen'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $global ="0"; } //Si el parametro es igual a 0 se buscan los NULOS
}


if ((isset($_GET['idResponsable']) && $_GET['idResponsable'] != "")) //Si el parametro existe se procesa
{   if ($_GET['idResponsable']!="0") {$responsable  = $_GET['idResponsable'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $responsable =""; } //Si el parametro es igual a 0 se buscan los NULOS
}

if ((isset($_GET['idNivel']) && $_GET['idNivel'] != "")) //Si el parametro existe se procesa
{   if ($_GET['idNivel']!="0") {$nivel  = $_GET['idNivel'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $nivel =""; } //Si el parametro es igual a 0 se buscan los NULOS
}

if ((isset($_GET['idCheck']) && $_GET['idCheck'] != "")) //Si el parametro existe se procesa
{   if ($_GET['idCheck']!="0") {$padre = $_GET['idCheck'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $padre =""; } //Si el parametro es igual a 0 se buscan los NULOS
}


//desde planeacion
if ((isset($_GET['regresar']) OR $regresar != "")) //Si el parametro existe se procesa
{   if ($_GET['regresar']!="0") {$regresar  = $_GET['regresar'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $regresar =""; } //Si el parametro es igual a 0 se buscan los NULOS
}

if ((isset($_GET['Id_actividad']) OR $Id_actividad != "")) //Si el parametro existe se procesa
{   if ($_GET['Id_actividad']!="0") {$Id_actividad  = $_GET['Id_actividad'];
} //Si el parametro es diferente de 0 se busca el valor
    else {  $Id_actividad ="0"; } //Si el parametro es igual a 0 se buscan los NULOS
}

if ((isset($_GET['Id_categoria']) OR $Id_categoria != "")) //Si el parametro existe se procesa
{   if ($_GET['Id_categoria']!="0") {$Id_categoria  = $_GET['Id_categoria'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $Id_categoria=""; } //Si el parametro es igual a 0 se buscan los NULOS
}

if ((isset($_GET['Id_subcategoria']) OR $Id_subcategoria != "")) //Si el parametro existe se procesa
{   if ($_GET['Id_subcategoria']!="0") {$Id_subcategoria  = $_GET['Id_subcategoria'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $Id_subcategoria=""; } //Si el parametro es igual a 0 se buscan los NULOS
}

if ((isset($_GET['ACME']) OR $ACME != "")) //Si el parametro existe se procesa
{   if ($_GET['ACME']!="0") {$ACME = $_GET['ACME'];
$tipoactividad = $ACME;} //Si el parametro es diferente de 0 se busca el valor
    else {  $ACME=""; } //Si el parametro es igual a 0 se buscan los NULOS
}


if ((isset($_GET['Periodo']) OR $Periodo != "")) //Si el parametro existe se procesa
{   if ($_GET['Periodo']!="0") {$Periodo = $_GET['Periodo'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $Periodo=""; } //Si el parametro es igual a 0 se buscan los NULOS
}

if ((isset($_GET['Nombreeje']) OR $Nombreeje != "")) //Si el parametro existe se procesa
{   if ($_GET['Nombreeje']!="0") {$Nombreeje = $_GET['Nombreeje'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $Nombreeje=""; } //Si el parametro es igual a 0 se buscan los NULOS
}

if ((isset($_GET['ano']) OR $ano != "")) //Si el parametro existe se procesa
{   if ($_GET['ano']!="0") {$ano = $_GET['ano'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $ano=""; } //Si el parametro es igual a 0 se buscan los NULOS
}

if ((isset($_GET['Id_usuario']) OR $Id_usuario != "")) //Si el parametro existe se procesa
{   if ($_GET['Id_usuario']!="0") {$Id_usuario = $_GET['Id_usuario'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $Id_usuario=""; } //Si el parametro es igual a 0 se buscan los NULOS
}

if ((isset($_GET['nombreUsuario']) OR $nombreUsuario != "")) //Si el parametro existe se procesa
{   if ($_GET['nombreUsuario']!="0") {$nombreUsuario = $_GET['nombreUsuario'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $nombreUsuario="undefined"; } //Si el parametro es igual a 0 se buscan los NULOS
}

if ((isset($_GET['Perfil']) OR $Perfil != "")) //Si el parametro existe se procesa
{   if ($_GET['Perfil']!="0") {$Perfil = $_GET['Perfil'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $Perfil=""; } //Si el parametro es igual a 0 se buscan los NULOS
}

if ((isset($_GET['Id_actividadsuperior']) OR $Id_actividadsuperior != "")) //Si el parametro existe se procesa
{   if ($_GET['Id_actividadsuperior']!="0") {$Id_actividadsuperior= $_GET['Id_actividadsuperior'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $Id_actividadsuperior = "0"; } //Si el parametro es igual a 0 se buscan los NULOS
}

if ((isset($_GET['check']) OR $check != "")) //Si el parametro existe se procesa
{   if ($_GET['check']!="0") {$check = $_GET['check'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $check="0"; } //Si el parametro es igual a 0 se buscan los NULOS
}

if (isset($_GET['accion']) && $_GET['accion'] != "") {
    echo '<input type="hidden" id="accion" name="accion" value="' . $_GET['accion'] . '" />';
    echo '<input type="hidden" id="usuario" name="usuario" value="' . $_GET['usuario'] . '" />';
    $user = $_GET['usuario'];
    if ($_GET['accion'] == "editar") {
        $editar = true;
        if ($Id_actividadsuperior != 0) {
            $valor =  $Id_actividad;
            $valor2 = $Id_actividadsuperior;
            $Id_actividad = $valor2;
            $Id_actividadsuperior = $valor;
        }
        echo '<input type="hidden" id="id" name="id" value="' . $_GET['id'] . '"/>';
        echo '<input type="hidden" id="regresar" name="regresar" value="' . $regresar . '"/>';
        echo '<input type="hidden" id="Id_actividad" name="Id_actividad" value="' . $Id_actividad . '"/>';
        echo '<input type="hidden" id="Id_categoria" name="Id_categoria" value="' . $Id_categoria. '"/>';
        echo '<input type="hidden" id="Id_subcategoria" name="Id_subcategoria" value="' . $Id_subcategoria . '"/>';
        echo '<input type="hidden" id="ACME" name="ACME" value="' . $ACME. '"/>';
        echo '<input type="hidden" id="Periodo" name="Periodo" value="' . $Periodo . '"/>';
        echo '<input type="hidden" id="Nombreeje" name="Nombreeje" value="' . $Nombreeje . '"/>';
        echo '<input type="hidden" id="ano" name="ano" value="' . $ano . '"/>';
        echo '<input type="hidden" id="Id_usuario" name="Id_usuario" value="' . $Id_usuario . '"/>';
        echo '<input type="hidden" id="nombreUsuario" name="nombreUsuario" value="' . $nombreUsuario . '"/>';
        echo '<input type="hidden" id="Perfil" name="Perfil" value="' . $Perfil. '"/>';
        echo '<input type="hidden" id="Id_actividadsuperior" name="Id_actividadsuperior" value="' . $Id_actividadsuperior. '"/>';
        echo '<input type="hidden" id="check" name="check" value="' . $check . '"/>';
    } else {
        echo '<input type="hidden" id="id" name="id" value="0"/>';

    }
}

if ($editar == true) {
    $id = $_GET['id'];
    $checkList->setId_check($_GET['id']);
    $checkList->getcheck();
    $nombre = $checkList->getnombre();
    $descripcion = $checkList->getdescripcion();
    $nivel = $checkList->getnivel();
    $padre = $checkList->getpadre();
    $anio = $checkList->getanio();  
    $eje = $checkList->geteje();
    $tipoactividad = $checkList->gettipoactividad();
    $global = $checkList->getglobal();  
    $general = $checkList->getgeneral();
    $categoria = $checkList->getcategoria();
    $subcategoria = $checkList->getsubcategoria();
    $tiene = $checkList->gettiene();
    $orden = $checkList->getorden();
    $entregable = $checkList->getentregable();
    $responsable = $checkList->getresponsable();

    $generalpadre = "";
    $globalpadre = "";
    if ($general != "") {
        $generalpadre = "and chea.IdActividad=".$general;
    }else{
        $globalpadre  = "and chea.IdActividad=".$global;
    }
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
    <script src="Alta_check.js"></script>
</head>

<script type="text/javascript">
    function llenar1(){
    var campo = $('#nivel').val();
        if(campo == "NULL"){
            var otro = document.getElementById("padre").value;
            var element = document.getElementById("inicial_div");
            element.style.display = "none";
        $('#padre').html('<option value = "NULL">Seleccione un checklist inicial</option>');
        } if (campo == 1){
            var otro = document.getElementById("padre").value;
            var element = document.getElementById("inicial_div");
            element.style.display = "none";
        $('#padre').html('<option value = "NULL">Seleccione un checklist inicial</option>');
        }if (campo == 2){
            var otro = document.getElementById("padre").value;
            var element = document.getElementById("inicial_div");
            element.style.display = "block";
            var actividadgeneral = $('#actividadgeneral').val();
            if (actividadgeneral == "") {
                llenarpadreglobal();
                $.post( "Consultapadre.php",{},function(data) {
            if(data != ""){
                $('#padre').append(data);
            }
        });
            }else{
                llenarpadregeneral();
                $.post( "Consultapadre.php",{},function(data) {
            if(data != ""){
                $('#padre').append(data);
            }
        });
            }
        }else{

        }
    }

    function llenar(){
    var periodo = $('#anio').val();
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
    var periodo1 = $('#anio').val();
    var actividadmeta = $('#actividadmeta').val();
    $.post( "Consultacategorias.php?EjeGlobal=" + ejeglobal + "&AnoGlobal=" + periodo1 + "&ActividadMeta=" + actividadmeta,{},function(data) {
    if(data != ""){
    $('#actividadglobal').html(data);
    }
    });
    }

    function llenarglobalcategoria(){
    var ejeglobal1 = $('#eje').val();
    var periodo11 = $('#anio').val();
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

    function llenarpadreglobal(){
    var actividadglobal = $('#actividadglobal').val();
    $.post( "Consultapadre.php?global=" + actividadglobal,{},function(data) {
    if(data != ""){
    $('#padre').html(data);
    }
    });
    }

    function llenarpadregeneral(){
    var actividadgeneral = $('#actividadgeneral').val();
    $.post( "Consultapadre.php?general=" + actividadgeneral,{},function(data) {
    if(data != ""){
    $('#padre').html(data);
    }
    });
    }

    function limpiardesdeeje(){
  $('#subcategoria').html("");
  $('#actividadgeneral').html("");
  }

  function limpiardesdeglobal(){
  $('#actividadgeneral').html("");
  }
</script>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?<?php echo $MisParam?>">Aplicaciones</a> / <a style="color:#fefefe;" href="Lista_check.php?<?php echo $MisParam?>">Checklist</a> / 
        <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Agregar Checklist</a> </div>
    <div class="well2 wr">
            <a style="color:#fefefe; cursor: pointer;" href="vista.php?<?php echo $MisParam?>"> Indicadores</a> /
            <a style="color:#fefefe; cursor: pointer;" href="Lista_check.php?<?php echo $MisParam?>">Lista Checklist</a> /
            <a style="color:#fefefe; cursor: pointer;" href="Alta_check.php?accion=guardar&usuario='<?php echo $MiNomUsr; ?>'&<?php echo $MisParam?>"' . '">Agregar +</a>
        </div>
    <div id="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form class="form-horizontal" id="formCheck" name="formCheck">
                <?php

        //esto para no usar el parametro id actividad superior que viene erroneo
                if ($Id_actividadsuperior == 0) {
                    $Id_actividadsuperior = 0;
                }else{
                    $Id_actividadsuperior = $global;
                }
                if ($general == 0) {
                $Id_actividad = $global;
                }else{
                $Id_actividad = $general;
                }
        echo '<input type="hidden" id="regresar" name="regresar" value="' . $regresar . '"/>';
        echo '<input type="hidden" id="Id_actividad" name="Id_actividad" value="' . $Id_actividad . '"/>';
        echo '<input type="hidden" id="Id_categoria" name="Id_categoria" value="' . $Id_categoria. '"/>';
        echo '<input type="hidden" id="Id_subcategoria" name="Id_subcategoria" value="' . $Id_subcategoria . '"/>';
        echo '<input type="hidden" id="ACME" name="ACME" value="' . $ACME. '"/>';
        echo '<input type="hidden" id="Periodo" name="Periodo" value="' . $Periodo . '"/>';
        echo '<input type="hidden" id="Nombreeje" name="Nombreeje" value="' . $Nombreeje . '"/>';
        echo '<input type="hidden" id="ano" name="ano" value="' . $ano . '"/>';
        echo '<input type="hidden" id="Id_usuario" name="Id_usuario" value="' . $Id_usuario . '"/>';
        echo '<input type="hidden" id="nombreUsuario" name="nombreUsuario" value="' . $nombreUsuario . '"/>';
        echo '<input type="hidden" id="Perfil" name="Perfil" value="' . $Perfil. '"/>';
        echo '<input type="hidden" id="Id_actividadsuperior" name="Id_actividadsuperior" value="' . $Id_actividadsuperior. '"/>';
        echo '<input type="hidden" id="check" name="check" value="' . $check . '"/>';
                ?>

                <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Periodo:</label>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <select id="anio" class="form-control" name="anio" onchange="llenar();llenarglobal();limpiardesdeeje();" style="width: 500px">
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
                        <select id="eje" class="form-control" name="eje" onchange="llenar();llenarglobal();limpiardesdeeje();" style="width: 500px">
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
                        <select id="actividadmeta" class="form-control" name="actividadmeta" onchange="llenar();llenarglobal();limpiardesdeeje();" style="width: 500px">
                            <?php if ($tipoactividad == 1) {
                                    echo '<option value="1" selected="selected">Actividad</option>';
                                    echo '<option value="2">Meta</option>';
                                } else if ($tipoactividad == 2) {
                                    echo '<option value="1" >Actividad</option>';
                                    echo '<option value="2" selected="selected">Meta</option>';
                                } else{
                                    echo '<option value="1" selected="selected">Actividad</option>';
                                    echo '<option value="2" >Meta</option>';
                                }
                                ?>
                        </select>
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Categoría:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="categoria" class="form-control" name="categoria" onchange="llenarsub();llenarglobalcategoria();" style="width: 500px">
                            <?php
                            $consultacategoria = "SELECT ce.idCategoria,ce.descCategoria FROM c_categoriasdeejes ce INNER JOIN c_periodo p on p.Id_Periodo=ce.anio WHERE ce.nivelCategoria=1 AND p.Id_Periodo=$anio AND ce.idEje=$eje ORDER BY ce.orden ";
                            $resultado3 = $catalogo->obtenerLista($consultacategoria);
                            while ($row = mysqli_fetch_array($resultado3)) {
                            $s = '';
                            if ($row['idCategoria'] == $categoria) {
                            $s = 'selected = "selected"';
                            }
                            echo '<option value = "' . $row['idCategoria'] . '" ' . $s . '>' . $row['descCategoria'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                    

                 <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Sub categoría:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="subcategoria" class="form-control" name="subcategoria" onchange="llenarglobalsubcategoria();" style="width: 500px">
                            <?php
                            $consultasubcategoria = "SELECT ce.idCategoria,ce.descCategoria FROM c_categoriasdeejes ce WHERE ce.idCategoriaPadre=$categoria ORDER BY ce.orden";
                            $resultado4 = $catalogo->obtenerLista($consultasubcategoria);
                            echo '<option value = "">Seleccione</option>';
                            while ($row = mysqli_fetch_array($resultado4)) {
                            $s = '';
                            if ($row['idCategoria'] == $subcategoria) {
                            $s = 'selected = "selected"';
                            }
                            echo '<option value = "' . $row['idCategoria'] . '" ' . $s . '>' . $row['descCategoria'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>


                <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Global:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="actividadglobal" class="form-control" name="actividadglobal" onchange="llenargeneral();limpiardesdeglobal();llenar1();" style="width: 500px">
                            <?php 
                            $consultaperiodo7 = "SELECT a.IdActividad, CONCAT(a.Numeracion,a.Nombre) as actividad FROM c_actividad a WHERE a.IdEje=$eje AND a.IdNivelActividad=1 AND a.IdTipoActividad=$tipoactividad ORDER BY a.Orden";
                            $resultado7 = $catalogo->obtenerLista($consultaperiodo7);
                            while ($row = mysqli_fetch_array($resultado7)) {
                            $s = '';
                            if ($row['IdActividad'] == $global) {
                            $s = 'selected = "selected"';
                            }
                            echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">General:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="actividadgeneral" class="form-control" name="actividadgeneral" style="width: 500px" onchange="llenar1();">
                            <?php
                                $consultaperiodo8 = "SELECT a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad 
                                        FROM c_actividad a 
                                        WHERE a.IdEje = $eje AND a.IdNivelActividad = 2 AND a.IdTipoActividad =$tipoactividad AND a.IdActividadSuperior=$global
                                        ORDER BY a.Orden";
                                $resultado8 = $catalogo->obtenerLista($consultaperiodo8);
                                echo '<option value = "">Seleccione</option>';
                                while ($row = mysqli_fetch_array($resultado8)) {
                                    $s = '';
                                    if ($row['IdActividad'] == $general) {
                                        $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
                                }
                                ?>
                        </select>
                    </div>
                </div>
                    
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="nombre">* Nombre del Checklist:</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <textarea class="form-control" id="nombre" name="nombre" style="width: 500px"><?php echo $nombre; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Responsable del Checklist:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="persona" class="form-control" name="persona" style="width: 500px">
                                <option value="">Seleccione</option>
                                <?php
                                $consultapersonas = "SELECT p.id_Personas, CONCAT(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno)as nombre 
                                FROM c_personas as p 
                                JOIN c_rolPersona rp ON p.id_Personas=rp.id_Persona
                                WHERE rp.id_Rol=146
                                ORDER BY nombre";
                                $resulpersona = $catalogo->obtenerLista($consultapersonas);
                                while ($row = mysqli_fetch_array($resulpersona)) {
                                    if ($row['id_Personas'] == $responsable) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option value='" . $row['id_Personas'] . "' " . $selected . ">" . $row['nombre'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        </div>

                    <div class="form-group form-group-sm" style="display: none;">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">* Descripción:</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <textarea class="form-control" id="descripcion" name="descripcion" style="width: 500px"><?php echo $descripcion; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="nivel">* Nivel:</label>
                        <div class="col-md-2 col-sm-2 col-xs-2">

                            <select id="nivel" class="form-control" name="nivel" onchange="llenar1();" style="width: 500px">
                                <option value="NULL">Seleccione</option>
                                <?php 
                                $selectnivel = "";
                                $select1 = "";
                                $select2 = "";
                                if($nivel == "NULL") $selectnivel = "Selected";
                                           
                                    if($nivel == "1") $select1 = "Selected";

                                        if($nivel == "2") $select2 = "Selected";
                                ?>
                                <!--<option value="NULL" <?php echo $selectnivel?>>Sin nivel</option>-->
                                <option value="1" <?php echo $select1?>>1-Checklist</option>
                                <option value="2" <?php echo $select2?>>2-SubChecklist</option>
                            </select>
                        </div>
                    </div>
                    <?php
                    $visible ="";
                    if ($nivel ==2) {
                        $visible = 'block';
                    }else if($nivel ==1){
                        $visible = 'none';
                    }else if($nivel == ""){
                        $visible = 'none';
                    }
                    ?>
                    <div class="form-group form-group-sm" style="display:<?php echo $visible; ?>;" id="inicial_div">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="padre">Checklist Inicial:</label>
                        <div class="col-md-2 col-sm-2 col-xs-2">

                            <select id="padre" class="form-control" name="padre" style="width: 500px">
                                <?php if($nivel == "2") {
                                    $consultapadre = "SELECT che.IdCheckList as IdCheckList,che.Nombre as Nombre FROM c_checkList AS che 
                                    JOIN k_checklist_actividad chea ON chea.IdCheckList=che.IdCheckList
                                    WHERE 1 $generalpadre $globalpadre 
                                    and che.Nivel = 1
                                    ORDER BY che.Nombre asc";
                                    //echo $consultapadre;
                                    $resultado = $catalogo->obtenerLista($consultapadre);
                                    while ($row = mysqli_fetch_array($resultado)) {
                                    $s = '';
                                    if ($row['IdCheckList'] == $padre) {
                                    $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $row['IdCheckList'] . '" ' . $s . '>' . $row['Nombre'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    

                    <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Tiene subcheck:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="tiene" class="form-control" name="tiene" style="width: 500px">
                            <?php 
                                if ($tiene == 2) {
                                    echo '<option value="1" >No</option>';
                                    echo '<option value="2" selected="selected">Si</option>';
                                } else {
                                    echo '<option value="1" selected="selected">No</option>';
                                    echo '<option value="2" >Si</option>';
                                }
                                ?>
                        </select>
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Orden:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <input type="number" name="orden" id="orden" class="form-control" value="<?php echo $orden;?>" style="width: 500px">
                    </div>
                </div>

                <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="entregable">* Entregable del Checklist:</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <textarea class="form-control" id="entregable" name="entregable" style="width: 500px"><?php echo $entregable; ?></textarea>
                        </div>
                    </div>
                  
                    <div class="form-group form-group-sm">
                        <div class="col-md-2 col-sm-2 col-xs-2">

                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <button type="button" class="btn btn-default btn-xs" id="guardar">Guardar</button>
                            <!-- <button type="cancel" class="btn btn-default btn-xs" id="cancelar" onclick="javascript:window.location='Lista_noticias.php">Cancelar</button> -->
                            <button type="button" class="btn btn-default btn-xs" id="back">Regresar</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
    var back = document.getElementById('back'); // Suponiendo que la identificación del elemento del botón de retorno está de vuelta
    back.onclick = function() {
        history.back(); // Regresa a la página anterior, también se puede escribir como history.go (-1)
    };
</script>

</body>
</html>