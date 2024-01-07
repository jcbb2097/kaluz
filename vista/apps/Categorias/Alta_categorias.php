<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once('../../../WEB-INF/Classes/CategoriaEje.class.php');

include_once __DIR__ . "/../../../source/dao/clases/LoggedinTime.php";
$catalogo = new Catalogo();
$obj = new categoria_eje();

$tipoPerfil = $_GET["tipoPerfil"];
$nombreUsuario = $_GET["nombreUsuario"];
$idUsuario = $_GET["idUsuario"];
$editar = false;
$descripcion = "";
$subcate = 0;
$periodo = date("Y");
$Id_eje = "";
$Id_expo = "";
$indice = "";
$ordencategoria = "";
$ordensubcategoria= "";


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
    $obj->setIdCategoria($_GET['id']);
    $obj->getCategoria();
    $periodo = $obj->getAnio();
    $Id_eje = $obj->getIdEje();
    $descripcion = $obj->getDescCategoria();
    $ordencategoria = $obj->getordencate();
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
    <link href="../../../resources/css/bootstrap-select.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="../../../resources/js/bootstrap-select.js"></script>
    <script src="../../../resources/js/sweetAlert.js"></script>
    <script src="../../../resources/js/bootstrap/bootstrapValidator.js"></script>
    <script src="../../../resources/js/aplicaciones/Categorias/Alta_categoria.js"></script>
    <script src="../../../resources/js/aplicaciones/Categorias/Acciones_categoria.js"></script>
    <style>
        textarea {
            resize: none;
        }
    </style>
</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Aplicaciones</a> / <a style="color:#fefefe;" href="Lista_categorias.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Categorías y subcategorías</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)"> Agregar Categorías y subcategorías</a></div>
    <div class="well2 wr">
        <a style="color:#fefefe;" href="vista.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Indicadores</a> /
        <a style="color:#fefefe;" href="Lista_categorias.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Lista de Categorías y subcategorías</a> /
        <a style="color:#fefefe; cursor: pointer;" href="javascript:window.location.reload(true)">Agregar +</a>
    </div>
    <div id="container-fluid">
        <form class="form-horizontal" id="formCategorias" name="formCategorias">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Periodo:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="ano" class="form-control" name="ano" onchange="" style="width: 280px;">
                                <option value="">Seleccione</option>
                                <?php
                                $consulta_periodo = "SELECT p.Id_Periodo,p.Periodo FROM c_periodo p WHERE p.CPE_ESTATUS=1 ORDER BY p.Periodo DESC";
                                $result_periodo = $catalogo->obtenerLista($consulta_periodo);
                                while ($row_p = mysqli_fetch_array($result_periodo)) {
                                    if ($periodo == $row_p['Id_Periodo'] && $editar == true) {
                                        $selected = "selected";
                                    } else if ($periodo == $row_p['Periodo'] && $editar == false) {
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
                            <select id="eje" class="form-control" name="eje" onchange="habilitar();" style="width: 280px;">
                                <option value="">Seleccione</option>
                                <?php
                                $consulta_eje = "SELECT e.idEje, CONCAT(e.orden,'.-',e.Nombre) nombre FROM c_eje e ORDER BY e.orden";
                                $result_eje = $catalogo->obtenerLista($consulta_eje);
                                while ($row_e = mysqli_fetch_array($result_eje)) {
                                    $selected = '';
                                    if ($row_e['idEje'] == $Id_eje) {
                                        $selected = 'selected="selected"';
                                    }
                                    echo "<option value='" . $row_e['idEje'] . "' " . $selected . ">" . $row_e['nombre'] . "</option>";
                                }

                                ?>
                            </select>
                        </div>

                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Descripción categoría:</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?php echo $descripcion; ?></textarea>
                        </div>
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Orden:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <input type="number" name="ordencate" id="ordencate" class="form-control" value="<?php echo $ordencategoria;?>">
                    </div>
                    
                        <?php if ($editar == true) {  ?>
                            <label class="col-md-0 col-sm-0 col-xs-0  control-label" for="AÑO"><button id="mas" name="mas" type="button" class="btn btn-xs" onclick="nuevasubcategoria();"><i class="glyphicon glyphicon-plus"></i></button></label>
                        <?php   } ?>
                    </div>
                    <?php if ($editar == false) { ?>
                        <hr style="display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0; border-top: 1px solid black;">
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO"> Descripción subcategoría:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <textarea class="form-control" id="dessubcate0" name="dessubcate0" rows="2"></textarea>
                            </div>
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Orden:</label>
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                <input type="number" name="ordensubcate0" id="ordensubcate0" class="form-control">
                                </div>  
                                <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO" style="left: -25px;"><button id="mas" name="mas" type="button" class="btn btn-xs" onclick="nuevasubcategoria();"><i class="glyphicon glyphicon-plus"></i></button></label>
                            </div>
                            <div class="form-group form-group-sm">
                            <div id="expodiv"  class="divexpo">
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label expo" for="AÑO"> Exposición<br> temporal:</label>
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <select id="expo0" class="form-control expo" name="expo0" style="width: 500px;">
                                        <option value="">Seleccione</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php } else {
                        $consulta_subcate = "SELECT ce.idCategoria,ce.descCategoria,ce.idExposicion,ce.orden FROM c_categoriasdeejes ce WHERE ce.idCategoriaPadre=" . $_GET['id']." ORDER BY ce.orden";
                        $result_subcate = $catalogo->obtenerLista($consulta_subcate);
                        $indice = 0;
                        while ($row_subca = mysqli_fetch_array($result_subcate)) {  ?>
                            <hr style="display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0; border-top: 1px solid black;">
                            <div class="form-group form-group-sm">
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO"> Orden: <?php echo $row_subca['orden'];?></label>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO"> Descripción subcategoría:</label>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <textarea class="form-control" id="dessubcateed<?php echo $indice; ?>" name="dessubcateed<?php echo $indice; ?>" rows="2"><?php echo $row_subca['descCategoria']; ?></textarea>
                                </div>
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Orden:</label>
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                <input type="number" name="ordensubcateedit<?php echo $indice; ?>" id="ordensubcateedit<?php echo $indice; ?>" class="form-control" value="<?php echo $row_subca['orden'];?>">
                                </div>
                                <label class="col-md-1 col-sm-1 col-xs-1  control-label" style="left: -25px;" for="AÑO"><button id="mas" name="mas" type="button" class="btn btn-xs" onclick="eliminarsubcategoria2(<?php echo $row_subca['idCategoria'] ?>);"><i class="glyphicon glyphicon-trash"></i></button></label>
                            </div>
                            <div class="form-group form-group-sm">
                                <div id="expodiv"  class="divexpo">
                                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO"> Exposición<br> temporal:</label>
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                        <select id="expoed<?php echo $indice; ?>" class="form-control" name="expoed<?php echo $indice; ?>" style="width: 500px;">
                                            <option value="">Seleccione</option>
                                            <?php
                                            /*$consulta_expo = 'SELECT
                                    ex.idExposicion,
                                    CONCAT( ex.tituloFinal, " (", ex.anio, ")" ) nombre 
                                FROM
                                    c_exposicionTemporal ex 
                                    INNER JOIN c_periodo p on p.Periodo=ex.anio
                                WHERE
                                    ex.estatus = 1 AND p.Id_Periodo=' . $periodo;*/
                                    $consulta_expo = "SELECT et.idExposicion as idExposicion,CONCAT ('(',et.anio,') ',et.tituloFinal) as nombre
                                    FROM c_exposicionTemporal et
                                    where et.estatus=1 AND et.anio>1
                                    ORDER BY et.anio desc";
                                            $result_expo = $catalogo->obtenerLista($consulta_expo);
                                            while ($row_e = mysqli_fetch_array($result_expo)) {
                                                $selected = '';
                                                if ($row_e['idExposicion'] == $row_subca['idExposicion']) {
                                                    $selected = 'selected="selected"';
                                                }
                                                echo "<option value='" . $row_e['idExposicion'] . "' " . $selected . ">" . $row_e['nombre'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" id="idsub<?php echo $indice; ?>" name="idsub<?php echo $indice; ?>" value="<?php echo $row_subca['idCategoria']; ?>" />
                            </div>
                        <?php
                            $indice++;
                        } ?>

                    <?php } ?>
                    <div id="nuevasubcategoria">

                    </div>

                    <div class="form-group form-group-sm">
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <input type="hidden" id="subcate" name="subcate" value="<?php echo $subcate; ?>" />
                            <input type="hidden" id="subcateedi" name="subcateedi" value="<?php echo $indice; ?>" />
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <button type="button" class="btn btn-default btn-xs" id="guardar">Guardar</button>
                            <button type="button" class="btn btn-default btn-xs" id="back">Regresar</a>
                        </div>

                    </div>
                </div>
            </div>
        </form>
        <script>
        var back = document.getElementById('back'); // Suponiendo que la identificación del elemento del botón de retorno está de vuelta
        back.onclick = function() {
        history.back(); // Regresa a la página anterior, también se puede escribir como history.go (-1)
        };
        </script>
    </div>