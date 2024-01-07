<?php
/*if ((!isset($_COOKIE['user']) || $_COOKIE['user'] == "") || (!isset($_COOKIE['IdSession']) || strlen($_COOKIE['IdSession']) != 15)) {
    header("Location: ../../index.php");
}*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once __DIR__."/../../../source/dao/clases/LoggedinTime.php";
include_once __DIR__."/../../../source/controller/UsuarioController.php";
include_once __DIR__."/../../../source/controller/EjeController.php";
include_once __DIR__."/../../../source/controller/AreaController.php";
include_once __DIR__."/../../../source/controller/NoticiaController.php";

if(!isset($_SESSION['user_session']))
{
?>  
<script>
    top.location.href="../../login.php";
    window.reload();
</script>
<?php   
}
if(isset($_SESSION["user_session"])) 
{
    if(isLoginSessionExpired()) 
    {
?>
<script>
    top.location.href="../../logout.php?session_expired=1";
</script>
<?php
    }
}

include_once("../../../WEB-INF/Classes/Catalogo.class.php");
include_once("../../../WEB-INF/Classes/Indicadores.2.class.php");

$editar = false;
$ConsultaQuery = "";
$Area = "";
$Eje = "";
$actividad = "";
$activo = "";
$tiempoq = "";
$Aplicacion = "";
$presentacion = "";
$descripcion = "";
$periodo = "";
$expo = "";
$registro = array();
$catalogo = new Catalogo();
if ((isset($_GET['accion']) && $_GET['accion'] != "") or (isset($_REQUEST['accion']) && $_REQUEST['accion'] != "") ) {
     
     if (isset($_GET['accion']) && $_GET['accion'] != ""){
        $accion= $_GET['accion'];
        
     }
     else{
        $accion= $_REQUEST['accion'];
        $id= $_REQUEST['id'];
     }
     if(isset($_GET['id'])){
        $id= $_GET['id'];
     }

     echo '<input type="hidden" id="accion" name="accion" value="' . $accion . '" />';
    if ($accion == "editar") {
        $editar = true;
        echo '<input type="hidden" id="id" name="id" value="' . $id. '"/>';
    } else {
        echo '<input type="hidden" id="id" name="id" value="0"/>';
    }

}
    

if ($editar == true) {
    $obj = new Indicadores2();
    $obj->setIdIndicador($id);
    $obj->getRegistro($id);
    $ConsultaQuery = $obj->getQueryConsulta();
    $Eje = $obj->getIdProyecto();
    $actividad = $obj->getIdConcepto();
    $tiempoq = $obj->getIdTiempo();
    $Aplicacion = $obj->getIdAplicacion();
    $presentacion = $obj->getIdPresentacion();
    $activo = $obj->getInteres();
    $descripcion = $obj->getDescripcion();
    $Area = $obj->getIdArea();
    $periodo = $obj->getPeriodo();
    $expo = $obj->getExpo();
}

$UsuarioPermiso = $_SESSION["user_session"];
include_once("../../../WEB-INF/Classes/Indicadores.2.class.php");
$catalogo = new Catalogo();
$IdMenus = array();
$IdMenuss = array();
$consultaPermisosubmenu = "SELECT
c_usuario.IdUsuario,
k_permisosaplicacion.IdSubmenuAplicacion,
c_perfil.IdPerfil,
c_perfil.descripcion,
c_submenuaplicacion.IdMenuAplicacion,
c_menuaplicacion.IdAplicacion,
k_permisosaplicacion.Altas,
k_permisosaplicacion.Bajas,
k_permisosaplicacion.Modificacion,
k_permisosaplicacion.Consulta
FROM
c_usuario

INNER JOIN c_perfil ON c_usuario.IdPerfil = c_perfil.IdPerfil
INNER JOIN k_permisosaplicacion ON k_permisosaplicacion.IdPerfil = c_perfil.IdPerfil
INNER JOIN c_submenuaplicacion ON k_permisosaplicacion.IdSubmenuAplicacion = c_submenuaplicacion.IdSubMenuAplicacion
INNER JOIN c_menuaplicacion ON c_submenuaplicacion.IdMenuAplicacion = c_menuaplicacion.IdMenuAplicacion
WHERE c_menuaplicacion.IdAplicacion=43 AND c_submenuaplicacion.IdSubMenuAplicacion=129 AND c_usuario.IdUsuario=$UsuarioPermiso
";
$resultPermisosubmenu = $catalogo->obtenerLista($consultaPermisosubmenu);
while ($row2 = mysqli_fetch_array($resultPermisosubmenu)) {
    // $permiso =$row2['EditarPublicaciones'];      
    $Bajas = $row2['Bajas'];
    $Altas = $row2['Altas'];
    $Modificacion = $row2['Modificacion'];
    $cons = $row2['Consulta'];
}
//consulta nivel 2
$consultaMenu = "SELECT
k_perfilmenuaplicacion.IdPerfil,
c_perfil.descripcion,
c_usuario.IdUsuario,
k_perfilmenuaplicacion.IdMenuaplicacion,
k_perfilmenuaplicacion.consulta,
c_menuaplicacion.NombreMenu
FROM
k_perfilmenuaplicacion
INNER JOIN c_perfil ON k_perfilmenuaplicacion.IdPerfil = c_perfil.IdPerfil
INNER JOIN c_usuario ON c_usuario.IdPerfil = c_perfil.IdPerfil
INNER JOIN c_menuaplicacion ON k_perfilmenuaplicacion.IdMenuaplicacion = c_menuaplicacion.IdMenuAplicacion
WHERE c_menuaplicacion.IdAplicacion=43 AND c_usuario.IdUsuario=$UsuarioPermiso
";
$resultPermisomenu = $catalogo->obtenerLista($consultaMenu);
while ($row2 = mysqli_fetch_array($resultPermisomenu)) {
   array_push($IdMenus, $row2['IdMenuaplicacion'], $row2['consulta']);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- <meta charset="UTF-8">
        <script src="resources/js/paginas/indicadores/AltaIndicadores.js"></script>
        <script type="text/javascript" language="javascript" src="../../../resources/js/aplicaciones/Indicadores/Carga.js"></script>
        <script src="../../../resources/js/aplicaciones/Indicadores/AltaIndicadores.js"></script> -->
        <!-- <script src="resources/js/bootstrap/bootstrap-multiselect.js"></script> -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>::.FORMULARIO ALTA INDICADORES.::</title>
        <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css"/>
        <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css"/>
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
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>

        <script src="../../../resources/js/bootstrap/bootstrapValidator.js"></script>
        <script src="../../../resources/js/bootstrap/bootstrap-multiselect.js"></script>
        <script src="../../../resources/js/aplicaciones/Indicadores/Carga.js"></script>
        <script src="../../../resources/js/aplicaciones/Indicadores/AltaIndicadores.js"></script>
        <script src="../../../resources/js/aplicaciones/Indicadores/funciones.js"></script>
        <script>
            $(document).ready(function () {

                $('#indicadores').multiselect({
                    includeSelectAllOption: false,
                    enableFiltering: true,
                    enableCaseInsensitiveFiltering: true,
                    maxHeight: 400,
                    filterPlaceholder: 'Busca una opción...'
                });


            });


        </script>
                <style>

            .container {
                    width: 100%;
                    margin: 0 auto;
                    padding-left: 0px;
                    padding-right: 0px;
            }

            .dropdown {
              position: relative;
              display: inline-block;
              margin-left: 19px;
              padding-bottom: 4px;
              height: 30px;
              padding-top: 5px;
            }
            .sel{
              background-color: #4d4c57;
            }
            .sel .dropbtn{
             color:white;
            }
            .lbl {
                    width: 100%;
                    position: relative;
                    display: block;
                    background-color: #ffffff;
                    border: none;
                    height: 19px;
                    font-family: 'Muli', sans-serif;
                    font-size: 14px;
                    font-weight: 400;
                    color: #4d4c57;
                    padding: 0 0 0 2px;
                    outline: none;
                    margin-top: 3px;
            }

            .dropbtn {
              background-color: transparent;
              color: black;
              font-size: 11px;
              font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
              font-weight: 500;
              border: none;
            }

            .dropdown-content {
              display: none;
              position: absolute;
              background-color: #cacaca;
              min-width: 160px;
              box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
              z-index: 1;
            }

            .dropdown-content a {
              color: #525252;
              padding: 6px 8px;
              text-decoration: none;
              display: block;
            }
            .sub{
              font-size: 11px;
            }

.dropdown-content a:hover {background-color: #dedede;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover {cursor: pointer;}

.tbl-header{
  background-color: black;
  color:white;
  border-collapse: collapse;
}
.tbl-header, .tbl-td, .tbl-th{
  border: 1px solid black;
  text-align: center;
}
.tbl-td, .tbl-th{
  padding: 4px;
}
.tbl-ind{
  width: 98%;
}
.avance  {

}
.td1{
  max-width: 80px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.td2{
  max-width: 110px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}


.grande{
  min-width: 80px;
}
.line-container.jsx-3213596737 {
    display: block;
    -webkit-box-flex: 1;
    -webkit-flex-grow: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
  height: 6px;
    border-radius: 1.1px;
    background-color: #bbbbbb;
    border: solid 0.1px #000000;
    max-width: 40px;
}

.progress.jsx-3213596737 {
    height: 102%;
    border-radius: 1.1px;
    -webkit-transition: width 1s ease-in, background-color 1s ease-in;
    transition: width 1s ease-in, background-color 1s ease-in;
}
.progress{
  margin-bottom: 0px !important;
}

span.jsx-3213596737 {
    color: #4D4D57;
    font-family: 'Muli', sans-serif;
    font-size: 10px;
    padding-right: 3px;
}
figure{
  cursor: pointer;
}

.pendiente.jsx-3213596737 {
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    -webkit-justify-content: start;
    -ms-flex-pack: justify;
    justify-content: start;
    min-width: 100px;
}

.pendiente.jsx-3213596737 .progress {
    width: 6px;
    height: 6px;
}
.progreso{

}
#tabla{
    margin: auto;
}

body{
        overflow-x: hidden;
}

/*label, input {
    width:200px;
    display:block;
    float:left;
    margin-bottom:10px;
}
label {
    width:145px;
    text-align:right;
    padding-right:10px;
    margin-top:2px;
}*/


br {
    clear:left;
}

.dmenuact{
  border-bottom: 1px solid #4d4d57;
  margin-left: 4px;
}
.menuact{
  padding-top: 3px;
  padding-bottom: 3px;
  margin-right: 6px;
  cursor: pointer;
}
.bac{
  background-color: #4d4d57;
  border-radius: 5px 5px 0px 0px;
}
.pnum{
  color:black;
  font-weight:500;
  font-family: 'Muli', sans-serif;
  font-size: 9px;
  margin: 0;
}
.ptit{
  color:black;
  font-family: 'Muli', sans-serif;
  font-size: 11px;
  font-weight:200;
  text-decoration: underline black;
  margin: 0;
}
.bac > .pnum{
  color:white;
  font-family: 'Muli', sans-serif;
  font-size: 9px;
  margin: 0;
}
.bac > .ptit{
  color:white;
  font-family: 'Muli', sans-serif;
  font-size: 11px;
  font-weight:200;
  text-decoration: underline white;
  margin: 0;
}
.acsub{
  margin-right: 6px;
}
.ppor{
  margin-left: -13px !important;
  font-family: 'Muli', sans-serif;
  font-size: 9px;
  margin: 0;
  color: #00000075;
}
.barraact{
  min-width: 157%;
  margin-left: -13px;
}
.container.jsx-3213596737 {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    min-width: 60px;
    }
.modal-avances{
  border-radius: 50px;
}
.avances-image{
    width: 100%;
    border-radius: 50px 50px 0px 0px;
}
.avances-header-container{
  padding: 0px;
}
.avances-titulo{

  margin-top: -1px;
  font-family: 'Muli-Regular';
  font-size: 14px;
  color: white;
}
.avances-contenido{
  font-family: 'Muli-Regular';
  font-size: 11px;
  color: #e6e6e6bf;
}
.avances-body{
  margin-top: -3px;
  background-color: #404040;
}
.avances-footer-orange{
  padding: 3px;
  border-top: none;
  text-align: center;
  background: rgb(250,220,45);
  background: linear-gradient(90deg, rgba(250,220,45,1) 0%, rgba(255,255,255,1) 38%);
  border-radius: 0px 0px 50px 50px;

}
.avances-footer-green{
  padding: 3px;
  border-top: none;
  text-align: center;
  background: rgb(39,182,58);
  background: linear-gradient(90deg, rgba(39,182,58,1) 0%, rgba(255,255,255,1) 88%);
  border-radius: 0px 0px 50px 50px;

}
.avances-footer-content{
  padding-top: 5px;
  font-family: 'Muli-Regular';
  font-size: 15px;
  color: red;
}
.modal-sm{
  width: 232px;
}
.form-control{
font-size: 11px !important;
margin: 0px !important;
border-radius: none!important;
padding: 0px !important;
}

    </style>
    </head>

    <body>
   <div id="contenidos2">
    	  <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1">Aplicaciones</a> / <!-- <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Indicadores</a> --><a style="color:#fefefe;">Indicadores</a></div>
        <?php
        if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
          $user = $_GET['nombreUsuario'];}
        ?>


        <div class="row" style="margin-bottom:15px;border-bottom: 2px solid #4d4c5752;margin-left: 5px !important;margin-top: -20px;">
            <div id="proteccion" class="dropdown">
                <button class="dropbtn active" onclick="cambiarContenidos('#contenidos2','Lista_indicadores.php');"><a style="color:#000;" href="Lista_indicadores.php" >Home</a></button><!--javascript:window.location.reload(true)-->
            </div>
            <div id="proteccion" class="dropdown">
                <button class="dropbtn" ><a style="color:#000;" href="Alta_indicadores.php?accion=guardar" > + Añadir Indicador</a></button>
            </div>
            <?php
            if ($IdMenus[2] == 17 && $IdMenus[3] == 1) {
            ?>
            <div id="proteccion" class="dropdown" >
                <?php
                $consultaPermisosubmenu2 = "SELECT
                    c_usuario.IdUsuario,
                    k_permisosaplicacion.IdSubmenuAplicacion,
                    c_perfil.IdPerfil,
                    c_perfil.descripcion,
                    c_submenuaplicacion.IdMenuAplicacion,
                    c_menuaplicacion.IdAplicacion,
                    k_permisosaplicacion.Altas,
                    k_permisosaplicacion.Bajas,
                    k_permisosaplicacion.Modificacion,
                    k_permisosaplicacion.Consulta
                    FROM
                    c_usuario

                    INNER JOIN c_perfil ON c_usuario.IdPerfil = c_perfil.IdPerfil
                    INNER JOIN k_permisosaplicacion ON k_permisosaplicacion.IdPerfil = c_perfil.IdPerfil
                    INNER JOIN c_submenuaplicacion ON k_permisosaplicacion.IdSubmenuAplicacion = c_submenuaplicacion.IdSubMenuAplicacion
                    INNER JOIN c_menuaplicacion ON c_submenuaplicacion.IdMenuAplicacion = c_menuaplicacion.IdMenuAplicacion
                    WHERE c_menuaplicacion.IdAplicacion=43 AND c_usuario.IdUsuario=$UsuarioPermiso
                    ";
                    $resultPermisosubmenu2 = $catalogo->obtenerLista($consultaPermisosubmenu2);
                    while ($row2 = mysqli_fetch_array($resultPermisosubmenu2)) {
                        // $permiso =$row2['EditarPublicaciones'];      
                        array_push($IdMenuss, $row2['IdSubmenuAplicacion'], $row2['Consulta']);
                    }
                ?>
                <select class="form-control" name="dispositivos" onchange="menuss(this.value);">
                  <option value="">Consulta Indicadores</option>
                  <?php
                  if($IdMenuss[2]==130 && $IdMenuss[3]==1){
                    echo "<option value='1'>Eje </option>";
                  }
                  if($IdMenuss[4]==131 && $IdMenuss[5]==1){
                    echo "<option value='2'>Área </option>";
                  }
                  if($IdMenuss[8]==139 && $IdMenuss[9]==1){
                    echo "<option value='3'>Mis Indicadores </option>";
                  }
                  if($IdMenuss[6]==132 && $IdMenuss[7]==1){
                    echo "<option value='4'>Reporte Indicador </option>";
                  }
                    ?>
                </select>
            </div>
            <?php
            }
            ?>
        </div>
<div id="contenidos">
        <!-- <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1">Aplicaciones</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Indicadores</a></div> -->
        <div class="container-fluid" >
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <form class="form-horizontal" style="font-family: 'Muli-Regular';" id="formIndicador" name="formIndicador" >
                    <legend>Registro de Indicador</legend>
                    <div class="row">
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">* Descripci&oacute;n del indicador</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <textarea class="form-control" rows="3" placeholder="Descripción" id="descripcion" name="descripcion" required ><?php echo $descripcion; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">
                                <?php
                                if ($editar == true && $activo == 0) {
                                    echo '<input type="checkbox" id="activo" name="activo" class="form-check-input"/>
                                          Interés';
                                } elseif ($editar == true && $activo == 1) {
                                    echo '<input type="checkbox" id="activo" name="activo" class="form-check-input" checked="checked"/>
                                          Interés';
                                } else {
                                    echo '<input type="checkbox" id="activo" name="activo" class="form-check-input"/>
                                            Interés';
                                }
                                ?>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <small style="color:green;">*Si no esta marcado no sera de su interés </small>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">* Periodo</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="Periodo" class="form-control" name="Periodo" onchange="cargarperiodo();" >
                                    <?php
                                    $consultaperiodo = "SELECT CPE_ID_PERIODO,CPE_PERIODO FROM sie_cat_periodos WHERE CPE_CERRADO=1 ORDER BY CPE_PERIODO";
                                    $resultado = $catalogo->obtenerLista($consultaperiodo);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['CPE_ID_PERIODO'] == $periodo) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['CPE_ID_PERIODO'] . '" ' . $s . '>' . $row['CPE_PERIODO'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">* Eje</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="Eje" class="form-control" name="Eje" onchange="cargarActiviadad();" >
                                    <?php
                                    if ($editar == true) {
                                        /*$consulta = "SELECT
                                            c_proyecto.IdProyecto,
                                            c_proyecto.Nombre,
                                            c_proyecto.orden
                                        FROM
                                            c_proyecto";*/
                                        $consulta= "SELECT
                                            c_eje.IdEje,
                                            c_eje.Nombre,
                                            c_eje.orden 
                                          FROM
                                            c_eje";
                                        $resultado = $catalogo->obtenerLista($consulta);
                                        echo '<option value="">Seleccione una opción</option>';
                                        while ($row = mysqli_fetch_array($resultado)) {
                                            $s = '';
                                            if ($row['IdEje'] == $Eje) {
                                                $s = 'selected="selected"';
                                            }
                                            echo '<option value="' . $row['IdEje'] . '" ' . $s . '>' . $row['IdEje']. '.- '.$row['Nombre'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">* Actividad:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="Actividad" class="form-control" name="Actividad" onchange="">
                                    <?php
                                    if ($editar == true) {
                                        /*$consulta = "SELECT
                                            c_concepto.Nombre,
                                            c_concepto.IdConcepto
                                            FROM `c_concepto`
                                            ORDER BY
                                            c_concepto.Nombre ASC
                                            ;";*/
                                        $consulta=" SELECT
                                            cc.IdActividad,
                                            CASE
                                        WHEN cc.IdNivelActividad = 1 THEN
                                            CONCAT(
                                                cp.orden,
                                                '.',
                                                cc.Orden,
                                                '. ',
                                                cc.Nombre
                                            )
                                        WHEN cc.IdNivelActividad = 2 THEN
                                            CONCAT(
                                                cp.orden,
                                                '.',
                                                ccDos.Orden,
                                                '.',
                                                cc.Orden,
                                                '. ',
                                                cc.Nombre
                                            )
                                        WHEN cc.IdNivelActividad = 3 THEN
                                            CONCAT(
                                                cp.orden,
                                                '.',
                                                ccTres.Orden,
                                                '.',
                                                ccDos.Orden,
                                                '.',
                                                cc.Orden,
                                                '. ',
                                                cc.Nombre
                                            )
                                        WHEN cc.IdNivelActividad = 5 THEN
                                            CONCAT(
                                                cp.orden,
                                                '.',
                                                ccCuatro.Orden,
                                                '.',
                                                ccTres.Orden,
                                                '.',
                                                ccDos.Orden,
                                                '.',
                                                cc.Orden,
                                                '. ',
                                                cc.Nombre
                                            )
                                        END AS Actividad,
                                         cnc.Nombre AS Nivel,
                                         cnc.IdNivel
                                        FROM
                                            `c_actividad` AS cc
                                        INNER JOIN c_eje AS cp ON cp.idEje = cc.IdEje
                                        LEFT JOIN c_actividad AS ccDos ON ccDos.IdActividad = cc.IdActividadSuperior
                                        LEFT JOIN c_actividad AS ccTres ON ccTres.IdActividad = ccDos.IdActividadSuperior
                                        LEFT JOIN c_actividad AS ccCuatro ON ccCuatro.IdActividad = ccTres.IdActividadSuperior
                                        LEFT JOIN c_nivelActividadMeta AS cnc ON cnc.IdNivel = cc.IdNivelActividad
                                        LEFT JOIN c_tipoActividadMeta AS ctc ON ctc.IdTipo = cc.IdTipoActividad
                                        INNER JOIN c_periodo AS cper ON cper.Id_Periodo = cc.Periodo
                                        WHERE cper.Actual = 1 AND cc.IdEje=".$Eje." AND cc.IdTipoActividad=1
                                        GROUP BY cc.IdActividad ORDER BY Actividad;";
                                        $resultado = $catalogo->obtenerLista($consulta);
                                        echo '<option value="">Seleccione una opción</option>';
                                        while ($row = mysqli_fetch_array($resultado)) {
                                            $s = '';
                                            if ($row['IdActividad'] == $actividad) {
                                                $s = 'selected="selected"';
                                            }
                                            echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>' . $row['Actividad'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">* Aplicación</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="Aplicación" class="form-control" name="Aplicación">
                                    <?php
                                    if ($editar == true) {
                                        $consulta = "SELECT
                                            c_aplicaciones.IdAplicacion,
                                            c_aplicaciones.Descripcion 
                                        FROM
                                            c_aplicaciones
                                        ORDER BY
                                            Descripcion";
                                        $resultado = $catalogo->obtenerLista($consulta);
                                        echo '<option value="">Seleccione una opción</option>';
                                        while ($row = mysqli_fetch_array($resultado)) {
                                            $s = '';
                                            if ($row['IdAplicacion'] == $Aplicacion) {
                                                $s = 'selected="selected"';
                                            }
                                            echo '<option value="' . $row['IdAplicacion'] . '" ' . $s . '>' . $row['Descripcion'] . '</option>';
                                        }
                                    }
                                    ?>   
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">* Periodicidad de la consulta</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="Tiempo" class="form-control" name="Tiempo">
                                    <?php
                                    $consulta = "SELECT
                                        c_tiempoconsulta.IdTiempo,
                                        c_tiempoconsulta.Tiempo
                                        FROM
                                        c_tiempoconsulta
                                        ORDER BY
                                        c_tiempoconsulta.Tiempo ASC
                                        ";
                                    $resultado = $catalogo->obtenerLista($consulta);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['IdTiempo'] == $tiempoq) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['IdTiempo'] . '" ' . $s . '>' . $row['Tiempo'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">* Presentación</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select class="form-control" id="presentacion" name="presentacion" required onchange="agruparindicadores();">
                                    <?php
                                    $consulta = "SELECT
                                        c_presentacionindicadores.IdPresentacion,
                                        c_presentacionindicadores.Tipo
                                        FROM
                                        c_presentacionindicadores
                                        ORDER BY
                                        c_presentacionindicadores.Tipo ASC
                                        ;";
                                    $resultado = $catalogo->obtenerLista($consulta);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['IdPresentacion'] == $presentacion) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['IdPresentacion'] . '" ' . $s . '>' . $row['Tipo'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div> 
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">* Área</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select class="form-control" id="area" name="area" >
                                    <?php
                                    if ($editar == true) {
                                        $consulta = "SELECT Id_Area ,Nombre FROM c_area ORDER BY Nombre";
                                        $resultado = $catalogo->obtenerLista($consulta);
                                        echo '<option value="">Seleccione una opción</option>';
                                        while ($row = mysqli_fetch_array($resultado)) {
                                            $s = '';
                                            if ($row['Id_Area'] == $Area) {
                                                $s = 'selected="selected"';
                                            }
                                            echo '<option value="' . $row['Id_Area'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Exposición</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="expo" class="form-control" name="expo">
                                    <?php
                                    if ($editar == true && $expo != "") {
                                        $consultaexpo = "SELECT * FROM c_exposicionTemporal";
                                        $resultado = $catalogo->obtenerLista($consultaexpo);
                                        echo '<option value="">Seleccione una opción</option>';
                                        while ($row = mysqli_fetch_array($resultado)) {
                                            $s = '';
                                            if ($row['idExposicion'] == $expo) {
                                                $s = 'selected="selected"';
                                            }
                                            echo '<option value="' . $row['idExposicion'] . '" ' . $s . '>' . $row['tituloFinal'] . '</option>';
                                        }
                                    } else{
                                        $consultaexpo = "SELECT * FROM c_exposicionTemporal ORDER BY tituloFinal";
                                        $resultado = $catalogo->obtenerLista($consultaexpo);
                                        echo '<option value="">Seleccione una opción</option>';
                                        while ($row = mysqli_fetch_array($resultado)) {
                                            $s = '';
                                            if ($row['idExposicion'] == $expo) {
                                                $s = 'selected="selected"';
                                            }
                                            echo '<option value="' . $row['idExposicion'] . '" ' . $s . '>' . $row['tituloFinal'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="consulta">* Consulta</label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                                <textarea class="form-control" rows="3" id="consulta" name="consulta" required > <?php echo $ConsultaQuery; ?></textarea>
                                <small><b>(Debe tener una columna de categorias llamada datos y los resultados en una columna llamada series,  en el caso de presentación &uacute;nico solo llamar la columna series. ej.SELECT categorias AS datos, resultados AS series)</b></small>
                            </div>
                        </div>


                        <div class="form-group form-group-sm"   id="nCuenta" style="display:none;">
                            <label for="indicadores">Indicadores:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">    
                                <select id="indicadores" name="indicadores[]" multiple="multiple" onchange="cargarquerrys();">
                                    <option value="">Seleccione una opción</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="btn-group" role="group" aria-label="...">
                        <!-- <div style="float:right;"> -->
                            <button id="guardar" name="guardar" type="button" class="btn btn-default btn-xs">
                                <!-- <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; -->Guardar</button>
                        <!-- </div> -->
                        <!-- <button type="button" class="btn btn-default btn-xs" id="guardar">Guardar</button> -->
                    </div>

                    <!-- <div style="float:right;">
                        <button id="regresarHX" name="regresarHX" onclick="cambiarContenidos('#contenidos', 'Indicadores2.0/Lista_indicadores.php?accion=regresar');" type="button" class="btn btn-primary btn-lg">
                            <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Regresar</button>
                    </div> -->
                </form>
        </div>
     </div>
       </div>
    </body>
</html>

