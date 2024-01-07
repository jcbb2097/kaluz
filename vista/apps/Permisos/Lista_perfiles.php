<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once __DIR__ . "/../../../source/dao/clases/LoggedinTime.php";
$catalogo = new Catalogo();
$tipoPerfil = $_GET["tipoPerfil"];
$nombreUsuario = $_GET["nombreUsuario"];


$idUsuario = $_GET["idUsuario"];

if (!isset($_SESSION['user_session'])) {
?>
    <script>
        top.location.href = "../../login.php";
        window.reload();
    </script>
    <?php
}
if (isset($_SESSION["user_session"])) {
    if (isLoginSessionExpired()) {
    ?>
        <script>
            top.location.href = "../../logout.php?session_expired=1";
        </script>
<?php
    }
}
?>

<html lang="en">

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
    <script src="../../../resources/js/aplicaciones/Menu/Alta_perfil.js"></script>
    <title>::.Perfiles.::</title>
</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Aplicaciones</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Perfil</a></div>
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-4 col-sm-4 col-xs-12">
                <a style="color:purple;" href="Alta_perfil.php?accion=guardar&tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Agregar perfil +</a> / <a style="color:purple;" href="Lista_permisos.php?tipoPerfil=<?php echo $tipoPerfil; ?>&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Permisos </a>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
            </div>
        </div><br>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 6px;"></th>
                            <th>Perfil</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $consulta = "SELECT p.idPerfil,p.descripcion
                        FROM c_perfil p";
                        $resultConsulta = $catalogo->obtenerLista($consulta);
                        $nombreUsuario2 = "'".$nombreUsuario."'";
                        while ($row = mysqli_fetch_array($resultConsulta)) {
                            echo '<tr>';
                            echo '<td><a style="color:purple;cursor:pointer" onclick="eliminar(' . $row['idPerfil'] . ')"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;<a style="color:purple;cursor:pointer" onclick="modificar('.$row['idPerfil'].','.$tipoPerfil.','.$idUsuario.','.$nombreUsuario2.')"><span class="glyphicon glyphicon-pencil"></span></a></td>';
                            echo '<td>' . $row['descripcion'] . '</td>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {

        $('#myTable').DataTable({
            searching: true,
            "paging": true,
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
            }
            //"ordering": false
        });
    });
</script>
</html>