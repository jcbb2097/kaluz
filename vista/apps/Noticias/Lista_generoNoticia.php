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
    <script src="../../../resources/js/aplicaciones/Noticias/Alta_genero.js"></script>
    <script src="../../../resources/js/aplicaciones/Noticias/funciones.js"></script>
    <title>::.GENERO NOTICIAS.::</title>
</head>
<body>
    <div class="container-fluid" id="contenidoProcesos">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <?php
                if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
                    $user = $_GET['nombreUsuario'];
                ?>
                    <a style="color:purple;cursor:pointer" onclick="cambiarContenido('#contenidoProcesos','alta_generoNoticia.php?accion=guardar&usuario=<?php echo $user ?>');" href='alta_generoNoticia.php?accion=guardar&usuario=<?php echo $user ?>'>agregar +</a>
                <?php
                } else {
                    $user = "User_desconocido";
                ?>
                    <a style="color:purple;cursor:pointer" onclick="cambiarContenido('#contenidoProcesos','alta_generoNoticia.php?accion=guardar&usuario=<?php echo $user ?>');" href='alta_generoNoticia.php?accion=guardar&usuario=<?php echo $user ?>'>agregar +</a>
                <?php
                }

                ?>

            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table id="tGeneroNoticias" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Género</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $consulta = "SELECT * FROM c_genero_noticia";
                        if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
                            $ValUser = "'".$user."'";
                        }else{
                            $user="User_desconocido";
                            $ValUser = "'".$user."'";
                        }
                        $resultado = $catalogo->obtenerLista($consulta);
                        while ($rs = mysqli_fetch_array($resultado)) {
                            echo '<tr>';
                            echo '<td><a style="color:black;cursor:pointer" onclick="eliminar('.$rs['Id_genero'].')"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;<a style="color:black;cursor:pointer" onclick="modificar('.$rs['Id_genero'].','.$ValUser.')"><span class="glyphicon glyphicon-pencil"></span></a></td>';
                        ?>
                            <td><?php echo $rs['Descripcion']; ?></td>
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