<?php
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

$nombre = isset($_GET['accion']) ? $_GET['accion'] : null;
include_once("../../../WEB-INF/Classes/Transparencia.class.php");
$catalogo = new Catalogo();

//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiTipoPerfil=1;
$MiIdUsr=$_SESSION['user_session'];
$MiNomUsr="SinUsr";
if ((isset($_GET['tipoPerfil'])    && $_GET['tipoPerfil'] != ""))    { $MiTipoPerfil=$_GET['tipoPerfil'];    }
if ((isset($_GET['idUsuario'])     && $_GET['idUsuario'] != ""))     { $MiIdUsr=     $_GET['idUsuario'];     }
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) { $usuario=    $_GET['nombreUsuario']; }
$MiNomUsr=str_replace(" ", "%20", $MiNomUsr);
$MisParam="tipoPerfil=".$MiTipoPerfil."&idUsuario=".$MiIdUsr."&nombreUsuario=".$MiNomUsr; //Para pasar parametros a la siguiente liga

/*CBC.14-oct-20 Se filtra todo para el año 2020*/
$FiltroAnio=2020; if ((isset($_GET['FiltroAnio']) && $_GET['FiltroAnio'] != "")) { $FiltroAnio = $_GET['FiltroAnio']; }
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
    <title>::.NOTICIAS.::</title>
</head>
<body>
    <div class="well well-sm">
        <a style="color:#fefefe;" href="../../aplicaciones.php?<?php echo $MisParam; ?>">Aplicaciones</a> / 
        <a style="color:#fefefe;" href="Lista.php?<?php echo $MisParam; ?>">Noticias</a> / 
        <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Lista Noticias</a> 
    </div>
    <div class="well2 wr">
      <a style="color:#fefefe; cursor: pointer;" href="vista.php?<?php echo $MisParam; ?>"> Indicadores</a> /
      <a style="color:#fefefe; cursor: pointer;" href="Lista.php?<?php echo $MisParam; ?>">Lista Noticias</a> /
      <a style="color:#fefefe; cursor: pointer;" href="Alta_noticias.php">Agregar +</a>
     </div>
    <!-- Jueves17SEP -->
    <!-- <div class="row" style="margin-bottom:15px;border-bottom: 2px solid #4d4c5752;margin-left: 0px !important;margin-top: -20px; width: 100%;">
        <div id="catalogo" class="dropdown">
            <select name="cat" id="cat" class="form-control" onchange="catalogo(this.value)">
                <option value="">Catálogos</option>
                <option value="1">Lugar de Noticia</option>
                <option value="2">Tipo de Noticia</option>
                <option value="3">Soporte de Noticia</option>
                <option value="4">Tipo de Medio</option>
                <option value="5">Género</option>
                <option value="6">Medio</option>
            </select>
        </div> -->
        <!-- <div id="proteccion" class="dropdown">
            <button class="dropbtn"  onclick="cambiarContenido('#contenidoProcesos','portada_noticias.php?nombreUsuario=<?php echo $user;?>&?idUsuario=<?php echo $Id_usuario;?>');">Indicador</button>
        </div> -->
    <!-- </div> -->
    <!-- Fin Jueves17SEP -->
    <div class="container-fluid" id="contenidoProcesos">
        <!--<div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <?php
                /*if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
                    $user = $_GET['nombreUsuario'];

                    //echo $user;
                    //echo '<a style="color:purple;" href="Alta_noticias.php?accion=guardar&usuario=' . $user . '"' . '>agregar +</a>';
                    echo '<a style="color:purple;" href="Alta_noticias.php?accion=guardar&usuario=' . $user . '"' . '>agregar +</a> / <a style="color:purple;" href="vista.php?Eje=1&usuario=' . $user . '"' . '> Indicador </a>';
                } else {
                    $user = "User_desconocido";

                    //echo $user;
                    //echo '<a style="color:purple;" href="Alta_noticias.php?accion=guardar&usuario=' . $user . '"' . '>agregar +</a>';
                    echo '<a style="color:purple;" href="Alta_noticias.php?accion=guardar&usuario=' . $user . '"' . '>agregar +</a> / <a style="color:purple;" href="vista.php?Eje=1&usuario=' . $user . '"' . '> Indicador </a>';
                }*/

                ?>

            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
            </div>
        </div><br>-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table id="tNoticias" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Titulo</th>
                            <th>Medio</th>
                            <th>Tipo de Medio</th>
                            <th>Enlace</th>
                            <th>Fecha de publicación</th>
                            <th>Nacional o Internacional</th>
                            <th>Etapa</th>
                            <th>Calificación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $consulta = "SELECT
                            n.idNoticia,
                            n.Titulo,
                            n.idMedio,
                            m.Nombre AS Medio,
                            n.idTipoMedio,
                            tm.Nombre AS Tipo_Medio,
                            n.Url,
                            n.FechaPublicacion,
                            n.idLugarNoticia,
                            ln.Nombre AS Lugar_Noticia,
                            n.idEtapa,
                            e.Nombre AS Etapa,
                            n.idCalificacion,
                            c.Nombre AS Calificacion 
                        FROM
                            c_noticia n
                            LEFT JOIN c_medio m ON m.idMedio = n.idMedio
                            LEFT JOIN c_tipoMedio tm ON tm.idTipoMedio = n.idTipoMedio
                            LEFT JOIN c_lugarNoticia ln ON ln.idLugarNoticia = n.idLugarNoticia
                            LEFT JOIN c_etapa e ON e.idEtapa = n.idEtapa
                            LEFT JOIN c_calificacion c ON c.idCalificacion = n.idCalificacion 
							WHERE n.FechaPublicacion>='2020/01/01'";
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
                            <td><?php echo $rs['Titulo']; ?></td>
                            <td><?php echo $rs['Medio']; ?></td>
                            <td><?php echo $rs['Tipo_Medio']; ?></td>
                            <td><a href="<?php echo $rs['Url']; ?>" target="_blank"><?php echo $rs['Url']; ?></a></td>
                            <td><?php echo date('Y-m-d', strtotime($rs['FechaPublicacion'])); ?></td>
                            <td><?php echo $rs['Lugar_Noticia']; ?></td>
                            <td><?php echo $rs['Etapa']; ?></td>
                            <td><?php echo $rs['Calificacion']; ?></td>
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