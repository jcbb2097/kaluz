<?php
/*if ((!isset($_COOKIE['user']) || $_COOKIE['user'] == "") || (!isset($_COOKIE['IdSession']) || strlen($_COOKIE['IdSession']) != 15)) {
    header("Location: ../../../index.php");
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
$catalogo = new Catalogo();
$Area = "";
$indicadorEje = "";
$IdMenus = array();
$UsuarioPermiso = $_SESSION["user_session"];
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
WHERE c_menuaplicacion.IdAplicacion=43 AND c_usuario.IdUsuario=$UsuarioPermiso
";
$resultPermisosubmenu = $catalogo->obtenerLista($consultaPermisosubmenu);
while ($row2 = mysqli_fetch_array($resultPermisosubmenu)) {
    // $permiso =$row2['EditarPublicaciones'];      
    array_push($IdMenus, $row2['IdSubmenuAplicacion'], $row2['Consulta']);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Indicadores</title>
        <meta charset="utf-8">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script type="text/javascript" language="javascript" src="resources/js/paginas/indicadores/AltaIndicadores.js" ></script> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
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
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/highcharts-3d.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
        <script src="../../../resources/js/bootstrap-select.js"></script>
        <script src="../../../resources/js/sweetAlert.js"></script>
        <script src="../../../resources/js/bootstrap/bootstrapValidator.js"></script>
        <script src="../../../resources/js/aplicaciones/Indicadores/AltaIndicadores.js"></script>
        <script src="../../../resources/js/aplicaciones/Indicadores/Carga.js"></script>
        <script src="../../../resources/js/aplicaciones/Indicadores/funciones.js"></script>
    </head>
    <body>
        <!-- <h1>Indicadores</h1>   
        <ul class="nav nav-tabs"> --> 
            <!-- <li role="presentation"  ><a href="#" onclick="cambiarContenidos('#contenidos', 'Lista_indicadores.php');" >Home</a></li> -->
            <!-- <li role="presentation" class="active"><a href="#" id="editarConsulta" onclick="cambiarContenidos('#contenidos', 'Menu_vistaindicadores.php');"><span class="glyphicon glyphicon-indent-right"></span>&nbsp;Consulta Indicadores</a></li> -->
             <!-- <li role="presentation"><a href="http://caomi1.com/SIE2019/aplicaciones/MenuAplicaciones2.php"><span class="glyphicon glyphicon-arrow-left"></span>Regresar</a></li> -->
        <!-- </ul> -->
        <?php
/*echo" <ul class=\"nav nav-tabs\"> ";

echo"<li role=\"presentation\"  ><a href=\"#\" onclick=\"cambiarContenidos('#contenidos', 'Menu_vistaindicadores.php');\" >Ver Indicadores por</a></li>";
if($IdMenus[2]==130 && $IdMenus[3]==1){
echo"<li role=\"presentation\"><a href=\"#\" onclick=\"cambiarContenidos('#contenidos', 'Menu_por_eje.php');\" >Eje</a></li>";
}
if($IdMenus[4]==131 && $IdMenus[5]==1){
echo"<li role=\"presentation\" class=\"active\" ><a href=\"#\" onclick=\"cambiarContenidos('#contenidos', 'Menu_por_area.php');\" >Área</a></li>";
}
if($IdMenus[8]==139 && $IdMenus[9]==1){
echo"<li role=\"presentation\"  ><a href=\"#\" onclick=\"cambiarContenidos('#contenidos', 'Menu_mis_indicadores.php');\" >Mis Indicadores</a></li>";
}
if($IdMenus[6]==132 && $IdMenus[7]==1){
echo"<li role=\"presentation\" ><a href=\"#\" onclick=\"cambiarContenidos('#contenidos', 'Menu_reporte.php');\" >Reporte Indicador</a></li>";
}
echo"   </ul>";*/
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <legend>Indicadores por Área</legend>
            <div class="row">
                <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Área</label>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <select id="Area" class="form-control" name="Area" onchange="cargarIndicadorPorArea();" >
                            <?php
                            /*$consulta = "SELECT
                                c_area.IdArea,
                                c_area.Nombre,
                                sie_cat_periodos.CPE_ID_PERIODO
                                FROM
                                c_area
                                INNER JOIN sie_cat_periodos ON c_area.IdPeriodo = sie_cat_periodos.CPE_ID_PERIODO
                                WHERE CPE_ESTATUS=1 ORDER BY Nombre";*/
                            $consulta = "SELECT
                                    c_area.Id_Area,
                                    c_area.Nombre 
                                FROM
                                    c_area 
                                WHERE
                                    estatus = 1 
                                ORDER BY
                                    Nombre";
                            $resultado = $catalogo->obtenerLista($consulta);
                            echo '<option value="">Seleccione una opción</option>';
                            while ($row = mysqli_fetch_array($resultado)) {
                                $s = '';
                                if ($row['Id_Area'] == $Area) {
                                    $s = 'selected="selected"';
                                }
                                echo '<option value="' . $row['Id_Area'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                            }
                            ?>   

                        </select>
                    </div>
                </div>
            </div>
        </div><br><br>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Indicador</label>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <select id="IndicadorArea" class="form-control" name="IndicadorArea" onchange="Filtroindicador();" >
                            <option value="">Seleccione una opción</option>
                        </select>
                    </div>
                </div><br>
            </div><br>
        </div><br>
    </div><br>
    <div class="col-md-12 col-sm-12 col-xs-12" class="row" id="recargarvista" >
         
    </div>
</div>

</body>
</html>