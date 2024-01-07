<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include_once __DIR__ . "/../../../source/dao/clases/LoggedinTime.php";
include_once('../../../WEB-INF/Classes/Catalogo.class.php');

$catalogo = new Catalogo();
$id_eje = $_GET["idEje"];
$tipo = $_GET["ACME"];
$check = $_GET["check"];
$Periodo = $_GET["Periodo"];
$ano = $_GET["ano"];
$Nombreeje = $_GET["Nombreeje"];
$idCategoria = $_GET["Id_categoria"];
$idSubCategoria = $_GET["Id_subcategoria"];
$idactividadGlobal = $_GET["idactividadGlobal"];
$idactividadGeneral = $_GET["idactividadGeneral"];
$titulo = "";
$nombreUsuario = $_GET['nombreUsuario'];
$Id_usuario = $_GET['Id_usuario'];
$Perfil = $_GET['Perfil'];
$tipoPerfil = $_GET['Perfil'];
$orden = 0;
if ($idSubCategoria > 0) {
    $cate = $idSubCategoria;
} else {
    $cate = $idCategoria;
}
if ($idactividadGeneral > 0) {
    $acti = $idactividadGeneral;
} else {
    $acti = $idactividadGlobal;
}
if ($check >= 1) {
    $titulo = "Planeación " . $ano;
    $n = "Subcheck";
} else {
    $titulo = "Planeación " . $ano;
    $n = "Check";
}
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
    <title>::.FORMULARIO CHECKS.::</title>

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
    <div class="well2 "><a style="color:#fefefe;" onclick="back(<?php echo $tipo ?>,<?php echo $id_eje ?>,<?php echo $Periodo ?>,'<?php echo $Nombreeje ?>',<?php echo $ano ?>,<?php echo $Id_usuario ?>,'<?php echo $nombreUsuario ?>',<?php echo $Perfil ?>,1)"><?php echo $titulo ?></a> / <spam style="color:#fefefe;"><?php echo $Nombreeje; ?></spam> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Agregar <?php echo $n; ?> </a></b>
    </div>
    <div id="container-fluid">
        <form class="form-horizontal" id="formCategorias" name="formCategorias">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Eje:</label>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <select class="form-control" onchange="" style="width: 200px;" disabled>
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
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Periodo:</label>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <select id="ano" class="form-control" name="ano" onchange="" disabled>
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
                            <input type="hidden" id="Periodo" name="Periodo" value="<?php echo $Periodo ?>">
                        </div>
                        <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO"><button id="mas" name="mas" type="button" class="btn btn-xs" onclick="nuevaActividad(<?php echo $id_eje ?>,<?php echo $tipo ?>);"><i class="glyphicon glyphicon-plus"></i></button></label>

                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Categoría:</label>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <select class="form-control" onchange="" style="width: 185px;" disabled>
                                <?php
                                $c_categoria = "SELECT ce.idCategoria,ce.descCategoria FROM
                               c_categoriasdeejes ce
                               INNER JOIN k_categoriasdeejes_anios cea ON cea.idCategoria = ce.idCategoria
                               INNER JOIN c_periodo p on p.Periodo=cea.Anio
                               WHERE p.Id_Periodo=$Periodo AND ce.nivelCategoria=1 AND ce.idEje=$id_eje AND cea.Visible=1
                               ORDER BY ce.orden";
                                //echo$c_categoria;
                                $resul_cate = $catalogo->obtenerLista($c_categoria);
                                while ($row = mysqli_fetch_array($resul_cate)) {
                                    if ($idCategoria == $row['idCategoria']) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option value='" . $row['idCategoria'] . "' " . $selected . ">" . $row['descCategoria'] . "</option>";
                                }
                                ?>

                            </select>
                            <input type="hidden" id="idCategoria" name="idCategoria" value="<?php echo $idCategoria ?>">
                        </div>
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Subcategoría:</label>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <select class="form-control" onchange="" style="width: 185px;" disabled>
                                <?php
                                $c_categoria = "SELECT ce.idCategoria,ce.descCategoria FROM
                               c_categoriasdeejes ce
                               INNER JOIN k_categoriasdeejes_anios cea ON cea.idCategoria = ce.idCategoria
                               INNER JOIN c_periodo p on p.Periodo=cea.Anio
                               WHERE p.Id_Periodo=$Periodo AND ce.nivelCategoria=2 AND ce.idEje=$id_eje AND cea.Visible=1
                               ORDER BY ce.orden";
                                //echo$c_categoria;
                                $resul_cate = $catalogo->obtenerLista($c_categoria);
                                while ($row = mysqli_fetch_array($resul_cate)) {
                                    if ($idSubCategoria == $row['idCategoria']) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option value='" . $row['idCategoria'] . "' " . $selected . ">" . $row['descCategoria'] . "</option>";
                                }
                                ?>

                            </select>
                            <input type="hidden" id="idCategoria" name="idCategoria" value="<?php echo $idCategoria ?>">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Global:</label>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <select class="form-control" onchange="" style="width: 185px;" disabled>
                                <?php
                                $c_categoria = "SELECT
                                a.IdActividad,
                                CONCAT( aa.Numeracion, a.Nombre ) nombre 
                            FROM
                                c_actividad a
                                INNER JOIN k_actividad_categoria aa ON aa.IdActividad = a.IdActividad
                                WHERE aa.IdCategoria=$cate AND a.IdTipoActividad=$tipo AND a.IdNivelActividad=1 AND aa.IdPeriodo=$Periodo ORDER BY aa.Orden";
                                //echo$c_categoria;
                                $resul_cate = $catalogo->obtenerLista($c_categoria);
                                while ($row = mysqli_fetch_array($resul_cate)) {
                                    if ($idactividadGlobal == $row['IdActividad']) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option value='" . $row['IdActividad'] . "' " . $selected . ">" . $row['nombre'] . "</option>";
                                }
                                ?>

                            </select>
                            <input type="hidden" id="idCategoria" name="idCategoria" value="<?php echo $idCategoria ?>">
                        </div>
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* General:</label>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <select class="form-control" onchange="" style="width: 185px;" disabled>
                                <?php
                                $c_categoria = "SELECT
                                a.IdActividad,
                                CONCAT( aa.Numeracion, a.Nombre ) nombre 
                            FROM
                                c_actividad a
                                INNER JOIN k_actividad_categoria aa ON aa.IdActividad = a.IdActividad
                                WHERE aa.IdCategoria=$cate AND a.IdTipoActividad=$tipo  AND aa.IdPeriodo=$Periodo
                                AND a.IdActividadSuperior=$idactividadGlobal ORDER BY aa.Orden ";
                                //echo$c_categoria;
                                $resul_cate = $catalogo->obtenerLista($c_categoria);
                                while ($row = mysqli_fetch_array($resul_cate)) {
                                    if ($idactividadGlobal == $row['IdActividad']) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option value='" . $row['IdActividad'] . "' " . $selected . ">" . $row['nombre'] . "</option>";
                                }
                                ?>

                            </select>
                            <input type="hidden" id="idCategoria" name="idCategoria" value="<?php echo $idCategoria ?>">
                        </div>
                    </div>
                    <hr style="display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0; border-top: 1px solid black;">

                    <div class="form-group form-group-sm" style="padding-left: 20px;">
                        <label class="col-md-1 col-sm-1 col-xs-1 control-label" for="AÑO">check:</label>


                    </div>


                    <hr style="display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0; border-top: 1px solid black;">

                    <input type="hidden" id="acti" name="acti" value="<?php echo $orden; ?>" />
                    <div id="new"></div>

                </div>
            </div>
        </form>
    </div>
</body>

</html>
<script>
    function back(Tipo, id_eje, Periodo, Nombreeje, ano, Id_usuario, nombreUsuario, Perfil, back) {
        if (back == 1) {
            url = 'Alta_logro_modal.php?accion=guardar&accion=&IdEje=' + id_eje + '&tipo=' + Tipo + '&Periodo=' + Periodo + '&ano=' + ano + '&nombreeje=' + Nombreeje + '&nombreUsuario=' + nombreUsuario + '&Id_usuario=' + Id_usuario + '&Perfil=' + Perfil;
        } else {
            url = 'Planeacion_avance_acme.php?accion=guardar&IdEje=' + id_eje + '&tipo=' + Tipo + '&Periodo=' + Periodo + '&ano=' + ano + '&nombreeje=' + Nombreeje + '&nombreUsuario=' + nombreUsuario + '&Id_usuario=' + Id_usuario + '&Perfil=' + Perfil;
        }
        $(location).attr('href', url);
    }

    function nuevaActividad(idEje, idTipo) {
        var contadorFila = $("#acti").val();
        var i = parseInt(contadorFila) + 1;
        var name = "";
        if (idTipo == 1) {
            name = 'Actividad:';
        } else {
            name = 'Meta:'
        }
        var html = '<div class="form-group form-group-sm" style="padding-left: 20px;" id="actividad' + contadorFila + '">' +
            '<label class="col-md-1 col-sm-1 col-xs-1 control-label" for="AÑO">numeración:</label>' +
            '<div class="col-md-1 col-sm-1 col-xs-1"><input id="nume' + contadorFila + '" name="nume' + contadorFila + '" class="form-control" type="text" value="' + idEje + '.' + i + '."></div>' +
            '<label class="col-md-1 col-sm-1 col-xs-1 control-label" for="AÑO">' + name + '</label>' +
            '<div class="col-md-4 col-sm-4 col-xs-4"><select class="form-control" name="ac' + contadorFila + '" id="ac' + contadorFila + '"></select></div>' +
            '</div>' +
            '<hr style="display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0; border-top: 1px solid black;">';
        $("#new").append(html);
        $("#ac" + contadorFila).load("Controllers/Acciones_planeacion.php", {
            "actividad_global": "actividad_global"
        }, function(data) {
            $(this).select();
        });
        contadorFila++;
        //alert(contadorFila+"mas");
        $("#acti").val(contadorFila);
    }

    function eliminarsubcategoria(id) {
        var contadorFila = $("#acti").val();
        $("#actividad" + id).remove();
        contadorFila--;
        $("#acti").val(contadorFila);

    }
</script>