<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$Periodo = date('Y');
$Id_eje = "";
session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once __DIR__ . "/../../../source/dao/clases/LoggedinTime.php";
$catalogo = new Catalogo();
$where_ano = "";
$Categoria = "";
/* $tipoPerfil = $_GET["tipoPerfil"];
$nombreUsuario = $_GET["nombreUsuario"];
$idUsuario = $_GET["idUsuario"]; */

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
    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <title>::.SIE.::</title>
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/Indicador_entregables.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <style type="text/css">
        a:hover {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="well2 "><a style="color:#fefefe;" href="../../indicadores.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Indicadores</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Entregables dashboard</a></b>
        <i id="global" onclick="vista();" data-toggle="tooltip" data-placement="bottom" title="Entregables cruces" style="position: absolute;right: 9px;cursor:pointer;" class="fas fa-grip-horizontal" aria-hidden="true"></i>
    </div>
    <div class="well2 wr">
        <div class="titleano">Año&nbsp;&nbsp; <b></b></div>
        <div class="anoSelect">
            <select style="width: 47px;border-radius: 0px;font-size: 9px;font-family: 'Muli-Regular';" name="anio" id="anio" onchange="limpiaCombos(1);filtros();">>
                <option value="todos">Todos</option>
                <?php
                $Perfil = "SELECT p.Id_Periodo,p.Periodo from c_periodo p ORDER BY p.Periodo  DESC";
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
        <div class="titleeje">Eje&nbsp;&nbsp; <b></b></div>
        <div class="ejeSelect" style="padding-left: 0; padding-right: 0;">
            <select style="width: 146px;border-radius: 0px;font-size: 9px;font-family: 'Muli-Regular';" name="eje" id="eje" onchange="limpiaCombos(1);Categorias();filtros();">
                <option value="0">Seleccione una opción</option>
                <?php
                $eje = "SELECT e.idEje,CONCAT(e.orden,'.-',e.Nombre) nombre FROM c_eje e";
                $resul = $catalogo->obtenerLista($eje);
                while ($row = mysqli_fetch_array($resul)) {
                    if ($Id_eje == $row['idEje']) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    echo "<option value='" . $row['idEje'] . "' " . $selected . ">" . $row['nombre'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="titlecate">Categorías&nbsp;&nbsp; <b></b></div>
        <div class="cateSelect" style="padding-left: 0;">
            <select style="width: 124px;border-radius: 0px;font-size: 9px;font-family: 'Muli-Regular';" name="cate" id="cate" onchange="limpiaCombos(2);Sub_Categorias();filtros();">
                <option value="0">Seleccione una opción</option>

            </select>
        </div>
        <div class="titlesubcate">Sub-Categorías&nbsp;&nbsp; <b></b></div>
        <div class="subcateSelect" style="padding-left: 0;">
            <select style="width: 124px;border-radius: 0px;font-size: 9px;font-family: 'Muli-Regular';" name="subcate" id="subcate" onchange="filtros();">
                <option value="0">Seleccione una opción</option>

            </select>
        </div>
    </div>
    <div class="container-fluid">

        <div class="col-md-8 col-sm-8 col-xs-8">
            <input type="hidden" id="opcion" name="opcion" value="1" />
        </div>
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

    function vista() {
        url = "Dashboard_entregables.php?estatus=1";
        $(location).attr('href', url);
    }


    function Categorias() {

        var eje = $('#eje').val();
        var anio = $('#anio').val();
        $('#cate').load("../../../WEB-INF/Controllers/Entregables/Acciones_entregables.php", {
            eje: eje,
            anio: anio,
            categorias: 'categorias'
        }, function(data) {
            $(this).select();
        });
    }

    function Sub_Categorias() {
        var cate = $('#cate').val();
        $('#subcate').load("../../../WEB-INF/Controllers/Entregables/Acciones_entregables.php", {
            cate: cate,
            subcate: 'subcate'
        }, function(data) {
            $(this).select();
        });
    }

    function limpiaCombos(tipo) {
        if (tipo == 1) {
            $('#cate').empty();
            $('#subcate').empty();
        } else {
            $('#subcate').empty();
        }
    }


    function filtros() {
        var eje = $('#eje').val();
        var anio = $('#anio').val();
        var cate = $('#cate').val();
        var subcate = $('#subcate').val();
        $("#opcion").val(1);
        $.post("categorias.php", {
            anio: anio,
            eje: eje,
            cate: cate,
            subcate: subcate,
        }, function(data) {
            $("#home").html('');
            $("#home").html(data);
        });

    }

</script>

</html>