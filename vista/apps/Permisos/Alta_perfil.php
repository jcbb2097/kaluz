<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once('../../../WEB-INF/Classes/Perfil.class.php');
include_once __DIR__ . "/../../../source/dao/clases/LoggedinTime.php";
$catalogo = new Catalogo();
$obj = new Perfil();
$tipoPerfil = $_GET["tipoPerfil"];
$nombreUsuario = $_GET["nombreUsuario"];
$idUsuario = $_GET["idUsuario"];
$editar = false;
$descripcion = "";

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
    $obj->setIdPerfil($_GET['id']);
    $obj->Get_perfil();
    $descripcion = $obj->getDescripcion();
}
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <!-- Estilos del SIE -->
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <!--jquery -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

    <!-- bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../../../resources/js/bootstrap/bootstrapValidator.js"></script>
    <!-- Js de la app -->
    <script src="../../../resources/js/aplicaciones/Menu/Alta_perfil.js"></script>

    <title>::.Perfil.::</title>
</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Aplicaciones</a> / <a style="color:#fefefe;" href="../../apps/Permisos/Lista_perfiles.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Perfiles</a> /<a style="color:#fefefe;" href="javascript:window.location.reload(true)">Agregar perfil</a></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form class="form-horizontal" id="perfiles" name="perfiles">
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">* Descripción</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input type="text" class="form-control" id="descripcion" name="descripcion" rows="3" value="<?php echo $descripcion;?>">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <div class="col-md-2 col-sm-2 col-xs-2">

                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <button type="button" class="btn btn-default btn-xs" id="guardar">Guardar</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>