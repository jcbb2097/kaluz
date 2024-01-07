<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once('../../../WEB-INF/Classes/Perfil_submenu.class.php');
include_once('../../../WEB-INF/Classes/Perfil_menu.class.php');
include_once __DIR__ . "/../../../source/dao/clases/LoggedinTime.php";
$catalogo = new Catalogo();
$menu = new Perfil_menu();
$submenu = new Perfil_submenu();
$tipoPerfil = $_GET["tipoPerfil"];
$nombreUsuario = $_GET["nombreUsuario"];
$idUsuario = $_GET["idUsuario"];
$editar = false;
$perfil = "";
$contadorar = 0;
$APP = "";
$Menu = "";
$Submenu = "";
$A = "";
$B = "";
$C = "";
$CC = "";
$ver = "none";
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
    $ver = "";
    $APP = $_GET['idaplicacion'];
    $menu->setId_perfil($_GET['id']);
    $menu->Get_perfil_menu($APP);
    $Menu = $menu->getId_menu();
    $CC = $menu->getConsulta();
    $perfil = $_GET['id'];
    $Submenu = $_GET['idsubmenu'];
    $submenu->setId_perfil($_GET['id']);
    $submenu->setId_submenu($_GET['idsubmenu']);
    $submenu->Get_perfil_submenu();
    $A = $submenu->getAlta();
    $B = $submenu->getBaja();
    $C = $submenu->getCambio();
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
    <script src="../../../resources/js/aplicaciones/Menu/Alta_menu.js"></script>
    <script src="../../../resources/js/aplicaciones/Menu/Acciones_menu.js"></script>

    <title>::.Permisos.::</title>
</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Aplicaciones</a> / <a style="color:#fefefe;" href="../../apps/Permisos/Lista_permisos.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Permisos</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Agregar permiso</a></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form class="form-horizontal" id="formPermisos" name="formPermisos">
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">* Perfil</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="perfil" class="form-control" name="perfil" onchange="">
                                <option value="">Seleccione un Perfil</option>
                                <?php
                                $Perfil = "SELECT p.idPerfil,p.descripcion FROM c_perfil p ";
                                $resul = $catalogo->obtenerLista($Perfil);
                                while ($row = mysqli_fetch_array($resul)) {
                                    if ($perfil == $row['idPerfil']) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option value='" . $row['idPerfil'] . "' " . $selected . ">" . $row['descripcion'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">* Aplicación</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="App" class="form-control" name="App" onchange="menu();">
                                <option value="">Seleccione una Aplicación</option>
                                <?php
                                $Perfil = "SELECT a.idAplicacion,a.Descripcion FROM c_aplicaciones as a INNER JOIN c_menu m on m.Id_aplicacion=a.idAplicacion ORDER BY a.Descripcion";
                                $resul = $catalogo->obtenerLista($Perfil);
                                while ($row = mysqli_fetch_array($resul)) {
                                    if ($APP == $row['idAplicacion']) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option value='" . $row['idAplicacion'] . "' " . $selected . ">" . $row['Descripcion'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">* Menú</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="Menu" class="form-control" name="Menu" onchange="submenu();">
                                <option value="">Seleccione un Menú</option>
                                <?php
                                if ($editar == true) {
                                    $Perfil = "SELECT m.Id_menu,m.Nombre FROM c_menu as m";
                                    $resul = $catalogo->obtenerLista($Perfil);
                                    while ($row = mysqli_fetch_array($resul)) {
                                        if ($Menu == $row['Id_menu']) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                        echo "<option value='" . $row['Id_menu'] . "' " . $selected . ">" . $row['Nombre'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">* Submenú</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="Sub_Menu"  class="form-control" name="Sub_Menu" onchange="acciones();">
                                <option value="">Seleccione un Submenú</option>
                                <?php
                                if ($editar == true) {
                                    $Perfil = "SELECT m.Id_submenu,m.Descripcion FROM c_submenu as m";
                                    $resul = $catalogo->obtenerLista($Perfil);
                                    while ($row = mysqli_fetch_array($resul)) {
                                        if ($Submenu == $row['Id_submenu']) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                        echo "<option value='" . $row['Id_submenu'] . "' " . $selected . ">" . $row['Descripcion'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div id="Permisos">
                        <div class="form-group form-group-sm" style="display:<?php echo $ver; ?>" id="SUB">
                            <div class="col-md-8 col-sm-8 col-xs-8 titulosP">
                                <b id="titulo"></b>
                            </div>
                            <hr style="border-top: 3px solid #0a0a0a;">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Consulta</label>
                            <div class="col-md-1 col-sm-1 col-xs-1">
                                <?php
                                if ($editar == true && $CC == 0) {
                                    echo '<input type="checkbox" class="custom-control-input" id="cc" name="cc">';
                                } elseif ($editar == true && $CC == 1) {
                                    echo '<input type="checkbox" class="custom-control-input" id="cc" name="cc" checked="">';
                                } else {
                                    echo '<input type="checkbox" class="custom-control-input" id="cc" name="cc">';
                                }
                                ?>
                            </div>
                            <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO">Alta</label>
                            <div class="col-md-1 col-sm-1 col-xs-1">
                                <?php
                                if ($editar == true && $A == 0) {
                                    echo '<input type="checkbox" class="custom-control-input" id="a" name="a">';
                                } elseif ($editar == true && $A == 1) {
                                    echo '<input type="checkbox" class="custom-control-input" id="a" name="a" checked="">';
                                } else {
                                    echo '<input type="checkbox" class="custom-control-input" id="a" name="a">';
                                }
                                ?>
                            </div>
                            <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO">Baja</label>
                            <div class="col-md-1 col-sm-1 col-xs-1">
                                <?php
                                if ($editar == true && $B == 0) {
                                    echo '<input type="checkbox" class="custom-control-input" id="b" name="b">';
                                } elseif ($editar == true && $B == 1) {
                                    echo '<input type="checkbox" class="custom-control-input" id="b" name="b" checked="">';
                                } else {
                                    echo '<input type="checkbox" class="custom-control-input" id="b" name="b">';
                                }
                                ?>
                            </div>
                            <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO">Cambio</label>
                            <div class="col-md-1 col-sm-1 col-xs-1">
                                <?php
                                if ($editar == true && $C == 0) {
                                    echo '<input type="checkbox" class="custom-control-input" id="c" name="c">';
                                } elseif ($editar == true && $C == 1) {
                                    echo '<input type="checkbox" class="custom-control-input" id="c" name="c" checked="">';
                                } else {
                                    echo '<input type="checkbox" class="custom-control-input" id="c" name="c">';
                                }
                                ?>
                            </div>

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