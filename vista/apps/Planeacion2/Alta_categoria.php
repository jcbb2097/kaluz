<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include_once __DIR__ . "/../../../source/dao/clases/LoggedinTime.php";
include_once('../../../WEB-INF/Classes/Catalogo.class.php');

$catalogo = new Catalogo();
$id_eje = $_GET["IdEje"];
$tipo = $_GET["tipo"];
$Periodo = $_GET["Periodo"];
$ano = $_GET["ano"];
$Nombreeje = $_GET["nombreeje"];
$titulo = "";
if ($tipo == 1) {
    $titulo = "Planeación " . $ano;
} else {
    $titulo = "Planeación " . $ano;
}
$nombreUsuario = $_GET['nombreUsuario'];
$Id_usuario = $_GET['Id_usuario'];
$Perfil = $_GET['Perfil'];
$tipoPerfil = $_GET['Perfil'];
$orden = 0;

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
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>::.FORMULARIO CATEGORIAS.::</title>

    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <script src="../../../resources/js/sweetAlert.js"></script>

    <style>
        textarea {
            resize: none;
        }
    </style>
</head>

<body>
    <div class="well2 "><a style="color:#fefefe;" onclick="back(<?php echo $tipo ?>,<?php echo $id_eje ?>,<?php echo $Periodo ?>,'<?php echo $Nombreeje ?>',<?php echo $ano ?>,<?php echo $Id_usuario ?>,'<?php echo $nombreUsuario ?>',<?php echo $Perfil ?>)"><?php echo $titulo ?></a> / <spam style="color:#fefefe;"><?php echo $Nombreeje; ?></spam> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Agregar Categorías y subcategorías </a></b>
    </div>
    <div id="container-fluid">
        <form class="form-horizontal" id="formCategorias" name="formCategorias">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group form-group-sm" style="display:none">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Periodo:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="ano" class="form-control" name="ano" onchange="" style="width: 280px;">
                                <?php
                                $consulta_periodo = "SELECT p.Id_Periodo,p.Periodo FROM c_periodo p ORDER BY p.Periodo DESC";
                                $result_periodo = $catalogo->obtenerLista($consulta_periodo);
                                while ($row_p = mysqli_fetch_array($result_periodo)) {
                                    if ($Periodo == $row_p['Id_Periodo']) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option value='" . $row_p['Id_Periodo'] . "' " . $selected . ">" . $row_p['Periodo'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Eje:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select class="form-control" onchange="" style="width: 280px;" disabled>
                                <option value="">Seleccione</option>
                                <?php
                                $consulta_eje = "SELECT e.idEje, CONCAT(e.orden,'.-',e.Nombre) nombre FROM c_eje e ORDER BY e.orden";
                                $result_eje = $catalogo->obtenerLista($consulta_eje);
                                while ($row_e = mysqli_fetch_array($result_eje)) {
                                    $selected = '';
                                    if ($row_e['idEje'] == $id_eje) {
                                        $selected = 'selected="selected"';
                                    }
                                    echo "<option value='" . $row_e['idEje'] . "' " . $selected . ">" . $row_e['nombre'] . "</option>";
                                }

                                ?>
                            </select>
                            <input type="hidden" id="eje" name="eje" value="<?php echo $id_eje ?>">
                        </div>
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO"><button id="mas" name="mas" type="button" class="btn btn-xs" onclick="nuevaCategoria();"><i class="glyphicon glyphicon-plus"></i></button></label>

                    </div>
                    <?php
                    $consulta = "SELECT
                    c.idCategoria,
                    c.descCategoria,
                    c.orden,
                    ca.Visible
                FROM
                    c_categoriasdeejes c 
                    INNER JOIN k_categoriasdeejes_anios ca on ca.idCategoria=c.idCategoria
                WHERE
                    c.idEje = $id_eje
                    AND c.nivelCategoria = 1 AND ca.ACME=$tipo AND ca.Anio=$ano 
                    ORDER BY c.orden";
                    $resultado = $catalogo->obtenerLista($consulta);
                    while ($row = mysqli_fetch_array($resultado)) {
                    ?>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Descripción categoría:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?php echo $row['descCategoria']; ?></textarea>
                            </div>
                            <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO">Orden:</label>
                            <div class="col-md-1 col-sm-1 col-xs-1">
                                <input type="number" name="ordencate" id="ordencate" class="form-control" value="<?php echo $row['orden']; ?>">
                            </div>
                            <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO">visible:</label>
                            <div class="col-md-1 col-sm-1 col-xs-1">
                                <?php if ($row['Visible'] == 1) {   ?>
                                    <input type="checkbox" style="height: 17px;" name="visible" id="visible" class="form-control" value="<?php echo $row['Visible']; ?>" checked>
                                <?php   } else {   ?>
                                    <input type="checkbox" style="height: 17px;" name="visible" id="visible" class="form-control" value="<?php echo $row['Visible']; ?>">

                                <?php    }   ?>

                            </div>
                            
                        </div>

                    <?php $orden++;
                    } ?>
                    <input type="hidden" id="subcate" name="subcate" value="<?php echo $orden; ?>" />
                    <div id="new"></div>
                </div>
        </form>
    </div>
</body>

</html>
<script>
    function back(Tipo, id_eje, Periodo, Nombreeje, ano, Id_usuario, nombreUsuario, Perfil) {
        url = 'Planeacion_avance_acme.php?accion=guardar&IdEje=' + id_eje + '&tipo=' + Tipo + '&Periodo=' + Periodo + '&ano=' + ano + '&nombreeje=' + Nombreeje + '&nombreUsuario=' + nombreUsuario + '&Id_usuario=' + Id_usuario + '&Perfil=' + Perfil;
        $(location).attr('href', url);
    }

    function nuevaCategoria() {
        var contadorFila = $("#subcate").val();
        var html = '<div class="row" id="categoria' + contadorFila + '">' +
            '<div class="form-group form-group-sm">' +
            '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Descripción categoría:</label>' +
            ' <div class="col-md-4 col-sm-4 col-xs-4">' +
            '<textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>' +
            '</div>' +
            '<label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO">Orden:</label>' +
            '<div class="col-md-1 col-sm-1 col-xs-1">' +
            '<input type="number" name="ordencate" id="ordencate" class="form-control" value="">' +
            '</div>' +
            '<label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO">visible:</label>' +
            '<div class="col-md-1 col-sm-1 col-xs-1">' +
            '<input type="checkbox" style="height: 17px;" name="visible" id="visible" class="form-control" value="">' +
            '</div>' +
            '<label class="col-md-1 col-sm-1 col-xs-1  control-label" style="left: -40px;"  for="AÑO"><button id="mas" name="mas" type="button" class="btn btn-xs" onclick="eliminarsubcategoria(' + contadorFila + ');"><i class="glyphicon glyphicon-trash"></i></button></label>' +
         
            '</div>' +
            '</div>';
        $("#new").append(html);
        contadorFila++;
        $("#aniovisible"+id).load("Controllers/Acciones_planeacion.php", { "actividad_global": "actividad_global" }, function (data) {
        $(this).select();
       });
       //alert(contadorFila+"mas");
       $("#subcate").val(contadorFila);
    }

    function eliminarsubcategoria(id) {
        var contadorFila = $("#subcate").val();
        $("#categoria" + id).remove();
        contadorFila--;
        $("#subcate").val(contadorFila);

    }
</script>