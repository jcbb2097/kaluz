<?php
date_default_timezone_set('america/mexico_city');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once __DIR__ . "/../../../source/dao/clases/LoggedinTime.php";
$catalogo = new Catalogo();

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
    <title>Dashboard Prueba</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
	<link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css"/>
	<link  rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>

	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <style type="text/css">
        a:hover {
            cursor: pointer;
        }
        tfoot{
	background-color: #cbcbca;
    }

    </style>
</head>
<body>
<div class="well well-sm">
    <a style="color:#fefefe;" href="../../aplicaciones.php">Aplicaciones</a>/
    <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Usuarios</a></div>

    <legend style="text-align: center; color:#5a274f;">Usuarios</legend>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-13 col-sm-13 col-xs-13">
             <ul class="nav nav-tabs" style="font-family: 'Muli-Regular';font-size: 11px;">
                <li role="presentation"><a
                    class="nav-link active" href="#v-pills"
                    onclick="showLink('Eje');" data-toggle="tab" href="../../apps/Usuarios/Eje.php">Eje</a>
                </li>
                <li role="presentation"><a
                    class="nav-link" href="#v-pills"
                    onclick="showLink('Area');" data-toggle="tab" href="../../apps/Usuarios/Area.php">Área</a>
                </li>
                <li role="presentation"><a
                    class="nav-link" href="#v-pills"
                    onclick="showLink('Perfil');" data-toggle="tab" href="../../apps/Usuarios/Perfil.php">Perfil</a>
                </li>
                <li role="presentation"><a
                    class="nav-link" href="#v-pills"
                    onclick="showLink('AppPerson');" data-toggle="tab" href="../../apps/Usuarios/AppPerson.php">Aplicación por persona</a>
                </li>
                <li role="presentation"><a
                    class="nav-link" href="#v-pills"
                    onclick="showLink('usoApp');" data-toggle="tab" href="../../apps/Usuarios/usoApp.php">Uso de aplicaciones</a>
                </li>
                <li role="presentation"><a
                    class="nav-link" href="#v-pills"
                    onclick="showLink('ultimoAcc');" data-toggle="tab" href="../../apps/Usuarios/ultimoAcc.php">Últimos accesos</a>
                </li>
                <li role="presentation"><a
                    class="nav-link" href="#v-pills"
                    onclick="showLink('accPerson');" data-toggle="tab" href="../../apps/Usuarios/accPerson.php">Accesos por persona</a>
                </li>
                <li role="presentation"><a
                    class="nav-link" href="#v-pills"
                    onclick="showLink('accApp');" data-toggle="tab" href="../../apps/Usuarios/accApp.php">Accesos por aplicación</a>
                </li>
             </ul>
            </div>
            <br>
            <div class="col-md-9 col-sm-9 col-xs-9">
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $('document').ready(function() {

        $.post(`Eje.php`,

            function(data) {
            $("#home").html('');
            $("#home").html(data);
        });

    });

    function showLink(link) {

        $.post(`${link}.php`,

        function(data) {
            $("#home").html('');
            $("#home").html(data);
            }
        );

    }
</script>

</html>
