<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();

if(!isset($_SESSION['user_session']))
{
?>
<script>
    top.location.href="../../login.php";
    window.reload();
</script>
<?php
}

$AnioActual="2020";//Cambiar cada año
$Aplicacion="Noticias";
$VarWhere= " ";

//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiTipoPerfil=1;
$MiIdUsr=$_SESSION['user_session'];
$MiNomUsr="SinUsr";
if ((isset($_GET['tipoPerfil'])    && $_GET['tipoPerfil'] != ""))    { $MiTipoPerfil=$_GET['tipoPerfil'];    }
if ((isset($_GET['idUsuario'])     && $_GET['idUsuario'] != ""))     { $MiIdUsr=     $_GET['idUsuario'];     }
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) { $MiNomUsr=    $_GET['nombreUsuario']; }
$MiNomUsr=str_replace(" ", "%20", $MiNomUsr);
$MisParam="tipoPerfil=".$MiTipoPerfil."&idUsuario=".$MiIdUsr."&nombreUsuario=".$MiNomUsr; //Para pasar parametros a la siguiente liga

$FiltroAnio="";
if (isset($_GET['F_IdAnio']) && $_GET['F_IdAnio'] != "")
{
    if ($_GET['F_IdAnio']=="Sin información")
        { $VarWhere= " WHERE isnull(n.FechaPublicacion) "; } //Para fechas nulas
    elseif ($_GET['F_IdAnio']=="Todos") //Para todos los años
        { $VarWhere= " WHERE 1=1 "; }
    else { $VarWhere= " WHERE n.FechaPublicacion>='".$_GET['F_IdAnio']."/01/01 00:00:00' AND n.FechaPublicacion<='".$_GET['F_IdAnio']."/12/31 23:59:59' "; }
}
else {
    //$VarWhere= " WHERE n.FechaPublicacion>='".$AnioActual."/01/01 00:00:00' AND n.FechaPublicacion<='".$AnioActual."/12/31 23:59:59' ";
    $VarWhere= "";
}

$FiltroEje=""; //Se inicializa la variable
if ((isset($_GET['F_IdEje']) && $_GET['F_IdEje'] != "")) //Si el parametro existe se procesa
{   if ($_GET['F_IdEje']!="0") {$FiltroEje =" AND idEje=".$_GET['F_IdEje'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $FiltroEje="  AND isnull(idEje)"; } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroMedio="";
if ((isset($_GET['F_IdMedio']) && $_GET['F_IdMedio'] != ""))
{   if ($_GET['F_IdMedio']!="0") {$FiltroMedio =" AND n.idMedio=".$_GET['F_IdMedio'];}
    else {  $FiltroMedio="  AND isnull(n.idMedio)"; }
}

$FiltroGenero="";
if ((isset($_GET['F_IdGenero']) && $_GET['F_IdGenero'] != ""))
{   if ($_GET['F_IdGenero']!="0") {$FiltroGenero =" AND n.idGenero=".$_GET['F_IdGenero'];}
    else {  $FiltroGenero="  AND isnull(n.idGenero)"; }
}

$FiltroTipoMedio="";
if ((isset($_GET['F_IdTipoMedio'])  && $_GET['F_IdTipoMedio'] != ""))
{   if ($_GET['F_IdTipoMedio']!="0") {$FiltroTipoMedio =" AND n.idTipoMedio=".$_GET['F_IdTipoMedio'];}
    else {  $FiltroTipoMedio="  AND isnull(n.idTipoMedio)"; }
}

$FiltroArea="";
if ((isset($_GET['F_IdArea']) && $_GET['F_IdArea'] != ""))
{   if ($_GET['F_IdArea']!="0") {$FiltroArea =" AND n.idArea=".$_GET['F_IdArea'];}
    else {  $FiltroArea="  AND isnull(n.idArea)"; }
}

$FiltroLugar="";
if ((isset($_GET['F_IdLugar']) && $_GET['F_IdLugar'] != ""))
{   if ($_GET['F_IdLugar']!="0") {$FiltroLugar =" AND n.idLugarNoticia=".$_GET['F_IdLugar'];}
    else {  $FiltroLugar="  AND isnull(n.idLugarNoticia)"; }
}

$FiltroTipoInterna="";
if ((isset($_GET['F_IdTipoInterna']) && $_GET['F_IdTipoInterna'] != ""))
{   if ($_GET['F_IdTipoInterna']!="0") {$FiltroTipoInterna =" AND n.idTipo=".$_GET['F_IdTipoInterna'];}
    else {  $FiltroTipoInterna="  AND isnull(n.idTipo)"; }
}

$FiltroSoporte="";
if ((isset($_GET['F_IdSoporte']) && $_GET['F_IdSoporte'] != ""))
{    if ($_GET['F_IdSoporte']!="0") { $FiltroSoporte =" AND n.idSoporte=".$_GET['F_IdSoporte']; }
    else { $FiltroSoporte="  AND isnull(n.idSoporte)"; }
}

$FiltroCalificacion="";
if ((isset($_GET['F_IdCalificacion']) && $_GET['F_IdCalificacion'] != ""))
{    if ($_GET['F_IdCalificacion']!="0") { $FiltroCalificacion =" AND n.idCalificacion=".$_GET['F_IdCalificacion']; }
    else { $FiltroCalificacion="  AND isnull(n.idCalificacion)"; }
}

$FiltroExpo="";
if ((isset($_GET['F_IdExpoTemp']) && $_GET['F_IdExpoTemp'] != ""))
{   if ($_GET['F_IdExpoTemp']!="0") { $FiltroExpo =" AND n.idExposicion=".$_GET['F_IdExpoTemp']; }
    else  { $FiltroExpo="  AND isnull(n.idExposicion)"; }
}

$Filtroorigen="";
if ((isset($_GET['Origen']) && $_GET['Origen'] != ""))
{   if ($_GET['Origen']!="0") { $Filtroorigen =" AND n.origen='".$_GET['Origen']."'"; }
    else  { $Filtroorigen= "  AND isnull(n.origen)"; }
}
$Filtrovar="";
if ((isset($_GET['variable']) && $_GET['variable'] != ""))
{   if ($_GET['variable']!="0") { $Filtrovar =" AND n.Variable1='".$_GET['variable']."'"; }
    else  { $Filtrovar= "  AND isnull(n.variable)"; }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
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
    <script src="../../../resources/js/bootstrap-select.js"></script>
    <script src="../../../resources/js/sweetAlert.js"></script>
    <script src="../../../resources/js/bootstrap/bootstrapValidator.js"></script>
    <script src="../../../resources/js/aplicaciones/Noticias/Alta_Noticias.js"></script>
    <script src="../../../resources/js/aplicaciones/Noticias/funciones.js"></script>
    <script src="../../../resources/js/aplicaciones/Noticias/acciones.js"></script>
    <title>::.<?php echo $Aplicacion; ?>.::</title>
</head>
<body>
    <div class="well well-sm">
        <a style="color:#fefefe;" href="../../aplicaciones.php?<?php echo $MisParam; ?>">Aplicaciones</a> /
        <a style="color:#fefefe;" href="Lista.php?<?php echo $MisParam; ?>"><?php echo $Aplicacion; ?></a> /
        <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Lista Noticias</a>
    </div>
    <div class="well2 wr">
      <a style="color:#fefefe; cursor: pointer;" href="vista.php?<?php echo $MisParam; ?>"> Indicadores</a> /
      <a style="color:#fefefe; cursor: pointer;" href="Lista.php?<?php echo $MisParam; ?>">Lista Noticias</a> /
      <a style="color:#fefefe; cursor: pointer;" onclick="cambiarContenido('#catalogo','catalogos.php?usuario=<?php echo $MiNomUsr;?>');">Catálogos</a> /
      <a style="color:#fefefe; cursor: pointer;" href="Alta_noticias.php?accion=guardar&usuario=<?php echo $MiNomUsr;?>&<?php echo $MisParam; ?>">Agregar +</a>
     </div>
    <div class="container-fluid" id="contenidoProcesos">
                <?php
                if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
                    $user = $_GET['nombreUsuario'];
                ?>
                <?php
                } else {
                    $user = "User_desconocido";

                ?>
                <?php
                }
                ?>
            <br>
        <div class="row" id="catalogo">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table id="tNoticias" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Titulo</th>
                            <th>Análisis</th>
                            <th>Resumen</th>
                            <th>Medio</th>
                            <th>Impacto</th>
                            <th>Valor comercial</th>
                            <th>Valor comercial real</th>
                            <th>Fecha de publicación</th>
                            <th>Nacional o Internacional</th>
                            <th>Etapa</th>
                            <th>Calificación</th>
                            <th>Enlace</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $consulta = "SELECT
                            n.idNoticia as idNoticia, n.Titulo,n.FechaCaducidad,n.Analisis,n.Resumen, n.idMedio, m.Nombre AS Medio,
                            n.idTipoMedio, tm.Nombre AS Tipo_Medio,n.Precio as Precio, n.Reach as Reach,n.PrecioReal as PrecioReal,
                            n.Url, n.FechaPublicacion, n.idLugarNoticia, ln.Nombre AS Lugar_Noticia,
                            n.idEtapa, e.Nombre AS Etapa,
                            n.idCalificacion, c.Nombre AS Calificacion, n.Archivo
                        FROM
                            c_noticia n
                            LEFT JOIN c_medio m ON m.idMedio = n.idMedio
                            LEFT JOIN c_tipoMedio tm ON tm.idTipoMedio = n.idTipoMedio
                            LEFT JOIN c_lugarNoticia ln ON ln.idLugarNoticia = n.idLugarNoticia
                            LEFT JOIN c_etapa e ON e.idEtapa = n.idEtapa
                            LEFT JOIN c_calificacion c ON c.idCalificacion = n.idCalificacion
                            ".$VarWhere." ".$FiltroEje.$FiltroMedio.$FiltroGenero.$FiltroTipoMedio.$FiltroArea
                            .$FiltroLugar.$FiltroTipoInterna.$FiltroSoporte.$FiltroCalificacion.$FiltroExpo.$Filtroorigen
                            .$Filtrovar ." order by n.FechaPublicacion desc";

                        if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
                            $ValUser = "'".$user."'";
                        }else{
                            $user="User_desconocido";
                            $ValUser = "'".$user."'";
                        }
                        $resultado = $catalogo->obtenerLista($consulta);
                        while ($rs = mysqli_fetch_array($resultado)) {
                            echo '<tr>';
                            echo '<td><a style="color:black;cursor:pointer" onclick="eliminar('.$rs['idNoticia'].')"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;<a style="color:black;cursor:pointer" onclick="modificar('.$rs['idNoticia'].','.$ValUser.')"><span class="glyphicon glyphicon-pencil"></span></a></td>';
                        ?>
                            <?php
                              if($rs['Url'] != ""){
                                ?>
                                <td><b><?php echo $rs['Titulo']; ?></b> <br> <a href="<?php echo $rs['Url']; ?>" target="_blank">Liga</a> </td>
                            <?php
                          }else{  ?>
                                <td><b><?php echo $rs['Titulo']; ?></b>  </td>
                            <?php
                          }
                             ?>

                            <td><span style="color: #1d84b0;"><?php echo $rs['Analisis']; ?></span></td>
                            <td><?php echo str_replace("Museo Kaluz", "<b><u>Museo Kaluz</u></b>", $rs['Resumen']); ?></td>
                            <td><?php echo $rs['Tipo_Medio']; ?> <br> <?php echo $rs['Medio']; ?>
                            <?php
                            if ($rs['Archivo'] != '') { //Si tiene archivo muestra la liga.
                                $ruta = '../../../resources/aplicaciones/Noticias/'.$rs['Archivo'];
                                echo '<a target="_blank" href="'.$ruta.'" ><i class="glyphicon glyphicon-file"></i> </a>';
                            }?>
                            </td>
                            <td><?php echo number_format($rs['Reach'],2) ?></td>
                            <td><?php echo number_format($rs['Precio'],2) ?></td>
                            <td><?php echo number_format($rs['PrecioReal'],2) ?></td>
                            <td><?php echo date('Y-m-d', strtotime($rs['FechaPublicacion'])); ?></td>
                            <td><?php echo $rs['Lugar_Noticia']; ?></td>
                            <td><?php echo $rs['Etapa']; ?></td>
                            <td><?php echo $rs['Calificacion']; ?></td>
                            <?php
                              if($rs['Url'] != ""){
                                ?>
                                <td><a href="<?php echo $rs['Url']; ?>" target="_blank">Liga</a></td>
                                <?php
                              }else{  ?>

                                <td></td>
                                <?php
                              }
                                 ?>

                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
