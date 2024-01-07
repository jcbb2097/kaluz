<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$Periodo = date('Y');
session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once __DIR__ . "/../../../source/dao/clases/LoggedinTime.php";
$catalogo = new Catalogo();

if ((isset($_GET['tipoPerfil']) && $_GET['tipoPerfil'] != "")) {
    $tipoPerfil = $_GET["tipoPerfil"];
} else {
    $tipoPerfil = '';
}
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
    $nombreUsuario = $_GET["nombreUsuario"];
} else {
    $nombreUsuario = '';
}
if ((isset($_GET['idUsuario']) && $_GET['idUsuario'] != "")) {
    $idUsuario = $_GET["idUsuario"];
} else {
    $idUsuario = '';
}
echo '<input type="hidden" id="tipoPerfil" name="tipoPerfil" value="' . $_GET['tipoPerfil'] . '"/>';
echo '<input type="hidden" id="nombreUsuario" name="nombreUsuario" value="' . $_GET['nombreUsuario'] . '"/>';
echo '<input type="hidden" id="idUsuario" name="idUsuario" value="' . $_GET['idUsuario'] . '"/>';

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="../../../resources/js/aplicaciones/Permisos.js"></script>
    <title>::.INDICADOR ARCHIVOS COMPARTIDOS.::</title>
    <style type="text/css">
        a:hover {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Aplicaciones</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Indicador Archivos Compartidos</a></div>
    <div class="well2 wr">
        <a style="color:#fefefe; cursor: pointer;" href="Indicador_archivos.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario?>"> Indicador Archivos Compartidos</a> /
        <a style="color:#fefefe; cursor: pointer;" href="lista_archivo.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario?>">Lista Archivos Compartidos</a> /
        <a style="color:#fefefe; cursor: pointer;" onclick="Alta(<?php echo $idUsuario ?>,15,'Alta_archivo.php?accion=guardar&tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>');">Agregar +</a> 
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">Ver por:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="ver" class="form-control" name="ver" onchange="filtros();">
                            <option value="3">Tipo</option>
                            <option value="1">Área</option>
                            <option value="2">Eje</option>

                        </select>
                    </div>
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">Año:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="anio" class="form-control" name="anio" onchange="filtros();">
                            <?php
                            /*$Perfil = "SELECT DISTINCT p.Id_Periodo,p.Periodo FROM c_periodo p INNER JOIN c_documento d on d.anio=p.Id_Periodo ORDER BY p.Periodo DESC";*/
                            $Perfil = "SELECT Id_Periodo,Periodo FROM `c_periodo` WHERE Vista=1 ORDER BY Periodo DESC";
                            $resul = $catalogo->obtenerLista($Perfil);
                            while ($row = mysqli_fetch_array($resul)) {
                                if ($Periodo == $row['Periodo'] || $Periodo == $row['Id_Periodo']) {
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                }
                                echo "<option value='" . $row['Id_Periodo'] . "' " . $selected . ">" . $row['Periodo'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active"><br>

                    </div>
                </div>
            </div>
        </div>
</body>
<script>
    $('document').ready(function() {
        filtros();
    });

    function filtros() {
        var tipo = $('#ver').val();
        var anio = $('#anio').val();
        var nombreUsuario = $('#nombreUsuario').val();
        var idUsuario = $('#idUsuario').val();
        var tipoPerfil = $('#tipoPerfil').val();
        $.post("Datos.php", {
            anio: anio,
            tipo: tipo,
            nombreUsuario: nombreUsuario,
            idUsuario: idUsuario,
            tipoPerfil: tipoPerfil,
        }, function(data) {
            $("#home").html('');
            $("#home").html(data);
        });

    }
</script>

</html>