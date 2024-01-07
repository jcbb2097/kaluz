<?php
session_start();
if (!isset($_SESSION['user_session'])) {
?>
    <script>
        top.location.href = "../login.php";
        window.reload();
    </script>
<?php
}
?>
<?php
include_once('../../../WEB-INF/Classes/Indicadores_opiniones.class.php');
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$indicadores = new Indicadores_opiniones();
$idusuario = $_GET["idUsuario"];
$nombreUsuario = $_GET["nombreUsuario"];
$AnioActual = date("Y");
$titulo = "";
$titulo2 = "";
$responsable = "";
$sub = "";
$total_opiniones = 0;
$total_opiniones_atendidas = 0;
$percentResul = 0;
$totEje1 = 0;
$cadenaTotalesArea = "";
$style = "";
$seleccion = "";
$onclick = "";
$estado = "";
$estatus;
$cadenas_ejes = array('', '', '', '', '', '', '', '', '', '', '', '');
$totales_ejes = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$ejes = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11);
$categorias = array();
$series = array();
$Opiniones;
$color = "";
$total_cuadro = 0;
$por_eje = 0;
$por_area = 0;
$estado_2;
$where_1 = "";
$Total_indicador = 0;
//variables de tipo de opiniones
$array_E;
$array_A;
$array_AT;
$fel_eje = 0;
$sol_eje = 0;
$que_eje = 0;
$S_F_E = "";
$S_S_E = "";
$S_Q_E = "";
$fel_ac = 0;
$sol_ac = 0;
$que_ac = 0;
$S_F_A = "";
$S_S_A = "";
$S_Q_A = "";
$fel_at = 0;
$sol_at = 0;
$que_at = 0;
$S_F_AT = "";
$S_S_AT = "";
$S_Q_AT = "";
$tipo = "";

//variables opiniones pendientes de turnar a eje
$total_opiniones_pendientes_eje = 0;
$stylo_1 = "";
$resalta_1 = "";
//variables opiniones avance turnado a eje
$total_opiniones_tur_eje = 0;
$stylo_2 = "";
$resalta_2 = "";
//variables opiniones pendientes de turnar a actividad
$total_opiniones_pendientes_actividad = 0;
$stylo_3 = "";
$resalta_3 = "";
//variables opiniones avance turnado a actividad
$total_opiniones_tur_act = 0;
$stylo_4 = "";
$resalta_4 = "";
//variables opiniones pendientes por atender
$total_opiniones_pendientes = 0;
$stylo_5 = "";
$resalta_5 = "";
//variables opiniones atendidas
$total_opiniones_atendidas = 0;
$stylo_6 = "";
$resalta_6 = "";
//total opiniones
$stylo_7 = "";
$resalta_7 = "";

//llamada a funciones
$total_opiniones_atendidas = $indicadores->atendidas();
$total_opiniones_pendientes = $indicadores->pendientes();
$total_opiniones = $indicadores->totales();
$total_opiniones_tur_act = $indicadores->total_turnado_actividad();
$total_opiniones_pendientes_actividad = $indicadores->pendientes_t_act();
$total_opiniones_tur_eje = $indicadores->avance_t_eje();
$total_opiniones_pendientes_eje = $indicadores->pendientes_t_eje();
$areas = $indicadores->getAreas();

$percentResul = $total_opiniones_atendidas * 100 / $total_opiniones;

if (isset($_GET["tipo"]) && $_GET["tipo"] == 1) {
    $tipo = "1";
} elseif (isset($_GET["tipo"]) && $_GET["tipo"] == 2) {
    $tipo = "2";
} elseif (isset($_GET["tipo"]) && $_GET["tipo"] == 3) {
    $tipo = "3";
} else {
    $tipo = "";
}
if (isset($_GET["estatus"]) && $_GET["estatus"] == 1) {
    $titulo = "/ Avance turnado a eje";
    $resalta_1 = "resalta";
    $S_F_A = "opacaEstatus";
    $S_S_A = "opacaEstatus";
    $S_Q_A = "opacaEstatus";
    $stylo_2 = "opacity: .5;";
    $stylo_3 = "opacity: .5;";
    $stylo_4 = "opacity: .5;";
    $stylo_5 = "opacity: .5;";
    $stylo_6 = "opacity: .5;";
    $stylo_7 = "opacity: .5;";
    $S_F_AT = "opacaEstatus";
    $S_S_AT = "opacaEstatus";
    $S_Q_AT = "opacaEstatus";
    $estado = '>1';
    $array_E = $indicadores->Total_por_tipo(1);
    $fel_eje = $array_E[0];
    $sol_eje = $array_E[1];
    $que_eje = $array_E[2];
    $array_A = $indicadores->Total_por_tipo(3);
    $fel_ac = $array_A[0];
    $sol_ac = $array_A[1];
    $que_ac = $array_A[2];
    $array_AT = $indicadores->Total_por_tipo(5);
    $fel_at = $array_AT[0];
    $sol_at = $array_AT[1];
    $que_at = $array_AT[2];
    if ($tipo == 1) {
        $total_cuadro = $array_E[0];
        $color = "#0093a3";
        $S_F_E = "resaltaEstatus";
        $sub = " / Felicitaciones";
    } elseif ($tipo == 2) {
        $total_cuadro =  $array_E[1];
        $color = "#0093a3";
        $S_S_E = "resaltaEstatus";
        $sub = " / Solicitudes";
    } elseif ($tipo == 3) {
        $total_cuadro = $array_E[2];
        $color = "#0093a3";
        $S_Q_E = "resaltaEstatus";
        $sub = " / Quejas";
    } else {
        $total_cuadro = $total_opiniones_tur_eje;
        $color = "#0093a3";
    }
} elseif (isset($_GET["estatus"]) && $_GET["estatus"] == 2) {
    $titulo = "/ Pendientes de turnar a eje";
    $resalta_2 = "resalta";
    $stylo_1 = "opacity: .5;";
    $stylo_3 = "opacity: .5;";
    $stylo_4 = "opacity: .5;";
    $stylo_5 = "opacity: .5;";
    $stylo_6 = "opacity: .5;";
    $stylo_7 = "opacity: .5;";
    $S_F_E = "opacaEstatus";
    $S_S_E = "opacaEstatus";
    $S_Q_E = "opacaEstatus";
    $S_F_A = "opacaEstatus";
    $S_S_A = "opacaEstatus";
    $S_Q_A = "opacaEstatus";
    $S_F_AT = "opacaEstatus";
    $S_S_AT = "opacaEstatus";
    $S_Q_AT = "opacaEstatus";
    $estado = '=1';
    $array_E = $indicadores->Total_por_tipo(1);
    $fel_eje = $array_E[0];
    $sol_eje = $array_E[1];
    $que_eje = $array_E[2];
    $array_A = $indicadores->Total_por_tipo(3);
    $fel_ac = $array_A[0];
    $sol_ac = $array_A[1];
    $que_ac = $array_A[2];
    $array_AT = $indicadores->Total_por_tipo(5);
    $fel_at = $array_AT[0];
    $sol_at = $array_AT[1];
    $que_at = $array_AT[2];
} elseif (isset($_GET["estatus"]) && $_GET["estatus"] == 3) {
    $titulo = "/ Avance turnado a actividad";
    $stylo_1 = "opacity: .5;";
    $stylo_2 = "opacity: .5;";
    $stylo_4 = "opacity: .5;";
    $stylo_5 = "opacity: .5;";
    $stylo_6 = "opacity: .5;";
    $stylo_7 = "opacity: .5;";
    $resalta_3 = "resalta";
    $S_F_AT = "opacaEstatus";
    $S_S_AT = "opacaEstatus";
    $S_Q_AT = "opacaEstatus";
    $S_F_E = "opacaEstatus";
    $S_S_E = "opacaEstatus";
    $S_Q_E = "opacaEstatus";
    $estado = 'in( 3,4)';
    $array_E = $indicadores->Total_por_tipo(1);
    $fel_eje = $array_E[0];
    $sol_eje = $array_E[1];
    $que_eje = $array_E[2];
    $array_A = $indicadores->Total_por_tipo(3);
    $fel_ac = $array_A[0];
    $sol_ac = $array_A[1];
    $que_ac = $array_A[2];
    $array_AT = $indicadores->Total_por_tipo(5);
    $fel_at = $array_AT[0];
    $sol_at = $array_AT[1];
    $que_at = $array_AT[2];
    if ($tipo == 1) {
        $total_cuadro = $array_A[0];
        $color = "#0093a3";
        $S_F_A = "resaltaEstatus";
        $sub = " / Felicitaciones";
    } elseif ($tipo == 2) {
        $total_cuadro =  $array_A[1];
        $color = "#0093a3";
        $S_S_A = "resaltaEstatus";
        $sub = " / Solicitudes";
    } elseif ($tipo == 3) {
        $total_cuadro = $array_A[2];
        $color = "#0093a3";
        $S_Q_A = "resaltaEstatus";
        $sub = " / Quejas";
    } else {
        $total_cuadro = $total_opiniones_tur_act;
        $color = "#0093a3";
    }
} elseif (isset($_GET["estatus"]) && $_GET["estatus"] == 4) {
    $titulo = "/ Pendientes de turnar a actividad";
    $estado = '=2';
    $stylo_1 = "opacity: .5;";
    $stylo_2 = "opacity: .5;";
    $stylo_3 = "opacity: .5;";
    $stylo_5 = "opacity: .5;";
    $stylo_6 = "opacity: .5;";
    $stylo_7 = "opacity: .5;";
    $resalta_4 = "resalta";
    $S_F_E = "opacaEstatus";
    $S_S_E = "opacaEstatus";
    $S_Q_E = "opacaEstatus";
    $S_F_A = "opacaEstatus";
    $S_S_A = "opacaEstatus";
    $S_Q_A = "opacaEstatus";
    $S_F_AT = "opacaEstatus";
    $S_S_AT = "opacaEstatus";
    $S_Q_AT = "opacaEstatus";
    $array_E = $indicadores->Total_por_tipo(1);
    $fel_eje = $array_E[0];
    $sol_eje = $array_E[1];
    $que_eje = $array_E[2];
    $array_A = $indicadores->Total_por_tipo(3);
    $fel_ac = $array_A[0];
    $sol_ac = $array_A[1];
    $que_ac = $array_A[2];
    $array_AT = $indicadores->Total_por_tipo(5);
    $fel_at = $array_AT[0];
    $sol_at = $array_AT[1];
    $que_at = $array_AT[2];
} elseif (isset($_GET["estatus"]) && $_GET["estatus"] == 5) {
    $titulo = "/ Atendidas";
    $stylo_1 = "opacity: .5;";
    $stylo_2 = "opacity: .5;";
    $estado = 'in( 4)';
    $stylo_3 = "opacity: .5;";
    $stylo_4 = "opacity: .5;";
    $stylo_6 = "opacity: .5;";
    $stylo_7 = "opacity: .5;";
    $resalta_5 = "resalta";
    $S_F_E = "opacaEstatus";
    $S_S_E = "opacaEstatus";
    $S_Q_E = "opacaEstatus";
    $S_F_A = "opacaEstatus";
    $S_S_A = "opacaEstatus";
    $S_Q_A = "opacaEstatus";
    $array_E = $indicadores->Total_por_tipo(1);
    $fel_eje = $array_E[0];
    $sol_eje = $array_E[1];
    $que_eje = $array_E[2];
    $array_A = $indicadores->Total_por_tipo(3);
    $fel_ac = $array_A[0];
    $sol_ac = $array_A[1];
    $que_ac = $array_A[2];
    $array_AT = $indicadores->Total_por_tipo(5);
    $fel_at = $array_AT[0];
    $sol_at = $array_AT[1];
    $que_at = $array_AT[2];
    if ($tipo == 1) {
        $total_cuadro = $array_AT[0];
        $color = "green";
        $S_F_AT = "resaltaEstatus";
        $sub = " / Felicitaciones";
    } elseif ($tipo == 2) {
        $total_cuadro =  $array_AT[1];
        $color = "green";
        $S_S_AT = "resaltaEstatus";
        $sub = " / Solicitudes";
    } elseif ($tipo == 3) {
        $total_cuadro = $array_AT[2];
        $color = "green";
        $S_Q_AT = "resaltaEstatus";
        $sub = " / Quejas";
    } else {
        $total_cuadro = $total_opiniones_atendidas;
        $color = "green";
    }
} elseif (isset($_GET["estatus"]) && $_GET["estatus"] == 6) {
    $titulo = "/ Pendientes de atender";
    $estado = 'in( 3)';
    $stylo_1 = "opacity: .5;";
    $stylo_2 = "opacity: .5;";
    $stylo_3 = "opacity: .5;";
    $stylo_4 = "opacity: .5;";
    $stylo_5 = "opacity: .5;";
    $stylo_7 = "opacity: .5;";
    $resalta_6 = "resalta";
    $S_F_E = "opacaEstatus";
    $S_S_E = "opacaEstatus";
    $S_Q_E = "opacaEstatus";
    $S_F_A = "opacaEstatus";
    $S_S_A = "opacaEstatus";
    $S_Q_A = "opacaEstatus";
    $S_F_AT = "opacaEstatus";
    $S_S_AT = "opacaEstatus";
    $S_Q_AT = "opacaEstatus";
    $array_E = $indicadores->Total_por_tipo(1);
    $fel_eje = $array_E[0];
    $sol_eje = $array_E[1];
    $que_eje = $array_E[2];
    $array_A = $indicadores->Total_por_tipo(3);
    $fel_ac = $array_A[0];
    $sol_ac = $array_A[1];
    $que_ac = $array_A[2];
    $array_AT = $indicadores->Total_por_tipo(5);
    $fel_at = $array_AT[0];
    $sol_at = $array_AT[1];
    $que_at = $array_AT[2];
    $total_cuadro = $total_opiniones_pendientes;
    $color = "red";
} elseif (isset($_GET["estatus"]) && $_GET["estatus"] == 7) {
    $stylo_1 = "opacity: .5;";
    $stylo_2 = "opacity: .5;";
    $stylo_3 = "opacity: .5;";
    $stylo_4 = "opacity: .5;";
    $stylo_5 = "opacity: .5;";
    $stylo_6 = "opacity: .5;";
    $resalta_7 = "resalta";
    $S_F_E = "opacaEstatus";
    $S_S_E = "opacaEstatus";
    $S_Q_E = "opacaEstatus";
    $S_F_A = "opacaEstatus";
    $S_S_A = "opacaEstatus";
    $S_Q_A = "opacaEstatus";
    $S_F_AT = "opacaEstatus";
    $S_S_AT = "opacaEstatus";
    $S_Q_AT = "opacaEstatus";
    $array_E = $indicadores->Total_por_tipo(1);
    $fel_eje = $array_E[0];
    $sol_eje = $array_E[1];
    $que_eje = $array_E[2];
    $array_A = $indicadores->Total_por_tipo(3);
    $fel_ac = $array_A[0];
    $sol_ac = $array_A[1];
    $que_ac = $array_A[2];
    $array_AT = $indicadores->Total_por_tipo(5);
    $fel_at = $array_AT[0];
    $sol_at = $array_AT[1];
    $que_at = $array_AT[2];
    $titulo2 = 'Opiniones ';
    $responsable = $indicadores->Usuario($idusuario);
    echo '<input type="hidden" id="persona" name="persona" value="' . $responsable . '" />';
}
if (isset($_GET["tipo"]) && $_GET["tipo"] == 1) {
    $tipo = "1";
} elseif (isset($_GET["tipo"]) && $_GET["tipo"] == 2) {
    $tipo = "2";
} elseif (isset($_GET["tipo"]) && $_GET["tipo"] == 3) {
    $tipo = "3";
} else {
    $tipo = "";
}
if ($_GET["estatus"] == 1 || $_GET["estatus"] == 3 || $_GET["estatus"] == 5 || $_GET["estatus"] == 6) {
    $responsable = $indicadores->Usuario($idusuario);

    while ($area = mysqli_fetch_assoc($areas)) { //recorren las areas
        $total_area = 0;
        foreach ($ejes as $eje) { //recorren todos los ejes
            $Opiniones = $indicadores->Opiniones_indicador($area["Id_Area"], $eje, $estado, $tipo);
            if ($Opiniones == 0) {
                $onclick = "";
                $style = "style='opacity:.4;'";
            } else {
                $nombre_area = '"' . $area["Nombre"] . '"';
                $onclick = "onclick='muestraDetalle(" . $area["Id_Area"] . ",$eje,\"$estado\",$responsable,$tipo);mostrarModal($nombre_area);' ";
                $style = "style='background-color: $color;color:white;'";
                $seleccion .= "";
            }
            $cadenas_ejes[$eje] .= "<div $style id='ae$eje" . $area["Id_Area"] . "' $onclick  class='j  horizontal'><p class='rotarT'>" . $Opiniones . "</p></div>";
            $seleccion .= "";
            $totales_ejes[$eje] += $Opiniones;
            $total_area += $Opiniones;
        }
        $por_area = round(($total_area * 100) / $total_cuadro, 1);
        $cadenaTotalesArea .= "<div  id='totalArea" . $area["Id_Area"] . "' onclick=''  class=' j2 horizontal'><p class='rotarT'>" . $total_area . "</p><p class='porcentajeTot' style='font-size: .6em;color:green;'>$por_area%</p></div>";
        $seleccion .= "";
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
    <link rel="stylesheet" type="text/css" href="../../../resources/css/Indicador_opiniones.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--  <script src="../../../resources/js/aplicaciones/Indicadores/Opiniones/opiniones.js"></script> -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <style type="text/css">
		a:hover {
			cursor: pointer;
		}
	</style>
</head>

<body>
    <div class="well2 ">Indicadores de Opiniones <?php echo $titulo . $sub; ?></b>
        <p class="titRes">atendidas <b><?php echo $total_opiniones_atendidas; ?> / <?php echo $total_opiniones; ?></b></p>
        <div onclick="" style="cursor:pointer;" data-toggle="tooltip" data-placement="bottom" title="atendidas" class="progress clsPro">
            <div class="clsProSub progress-bar progress-bar-success" role="progressbar" style="color: black;background-color: green;width:<?php echo $percentResul; ?>%">
                <?php echo number_format($percentResul, 1, '.', ''); ?>%
            </div>
        </div>
    </div>
    <div class="well2 wr">
        <p data-toggle="tooltip" data-placement="bottom" title="Total de opiniones" style="top: 31px;cursor:pointer;background-color:#0093a3;border: 1px solid white;left:1px;color:white; <?php echo $stylo_7;  ?>" onclick="javascript:location.href='indicadores_opiniones.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idusuario; ?>&estatus=7'" class="totales a <?php echo $resalta_7; ?>"><?php echo $total_opiniones; ?></p>
        <p style="position: absolute;left: 41px;top: 31px;">Totales</p>
        <p data-toggle="tooltip" data-placement="bottom" title="Avance turnado a eje" style="top: 31px;cursor:pointer;background-color:#0093a3;border: 1px solid white;left:116px;color:white; <?php echo $stylo_1; ?>" onclick="javascript:location.href='indicadores_opiniones.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idusuario; ?>&estatus=1'" class="totales a <?php echo $resalta_1; ?>"><?php echo $total_opiniones_tur_eje; ?></p>
        <p data-toggle="tooltip" data-placement="bottom" title="Pendientes de turnar a eje" style="top: 31px;cursor:pointer;background-color:red;left: 146px;border: 1px solid white; <?php echo $stylo_2; ?>" onclick="javascript:location.href='indicadores_opiniones.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idusuario; ?>&estatus=2'" class="totales a  <?php echo $resalta_2; ?>"><?php echo $total_opiniones_pendientes_eje; ?></p>
        <div class="clasifTodo">
            <p onclick="javascript:location.href='indicadores_opiniones.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idusuario; ?>&estatus=1&tipo=1'" style="cursor:pointer;background-color: #0093a3;z-index:10;" class="b pclasifTodo todo1 <?php echo $S_F_E; ?>" data-toggle="tooltip" data-placement="bottom" title="Felicitaciones"><?php echo $fel_eje; ?></p>
            <p onclick="javascript:location.href='indicadores_opiniones.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idusuario; ?>&estatus=1&tipo=2'" style="cursor:pointer;background-color: #0093a3;z-index:10;" class="b pclasifTodo todo2 <?php echo $S_S_E; ?>" data-toggle="tooltip" data-placement="bottom" title="Solicitudes"><?php echo $sol_eje; ?></p>
            <p onclick="javascript:location.href='indicadores_opiniones.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idusuario; ?>&estatus=1&tipo=3'" style="cursor:pointer;background-color: #0093a3;z-index:10;" class="b pclasifTodo todo3 <?php echo $S_Q_E; ?>" data-toggle="tooltip" data-placement="bottom" title="Quejas"><?php echo $que_eje; ?></p>
        </div>
        <p data-toggle="tooltip" data-placement="bottom" title="Avance turnado a actividad" style="top: 31px;cursor:pointer;background-color:#0093a3;border: 1px solid green;left:298px;color:white; <?php echo $stylo_3; ?>" onclick="javascript:location.href='indicadores_opiniones.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idusuario; ?>&estatus=3'" class="totales a <?php echo $resalta_3; ?>"><?php echo $total_opiniones_tur_act; ?></p>
        <p data-toggle="tooltip" data-placement="bottom" title="Pendientes de turnar a actividad" style="top: 31px;cursor:pointer;background-color:red;left: 328px;border: 1px solid white; <?php echo $stylo_4; ?>" onclick="javascript:location.href='indicadores_opiniones.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idusuario; ?>&estatus=4'" class="totales a  <?php echo $resalta_4; ?>"><?php echo $total_opiniones_pendientes_actividad; ?></p>
        <div class="clasifPro">
            <p onclick="javascript:location.href='indicadores_opiniones.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idusuario; ?>&estatus=3&tipo=1'" style="cursor:pointer;background-color: #0093a3;z-index:10;" class="b pclasifTodo todo1 <?php echo $S_F_A; ?>" data-toggle="tooltip" data-placement="bottom" title="Felicitaciones"><?php echo $fel_ac; ?></p>
            <p onclick="javascript:location.href='indicadores_opiniones.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idusuario; ?>&estatus=3&tipo=2'" style="cursor:pointer;background-color: #0093a3;z-index:10;" class="b pclasifTodo todo2 <?php echo $S_S_A; ?>" data-toggle="tooltip" data-placement="bottom" title="Solicitudes"><?php echo $sol_ac; ?></p>
            <p onclick="javascript:location.href='indicadores_opiniones.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idusuario; ?>&estatus=3&tipo=3'" style="cursor:pointer;background-color: #0093a3;z-index:10;" class="b pclasifTodo todo3 <?php echo $S_Q_A; ?>" data-toggle="tooltip" data-placement="bottom" title="Quejas"><?php echo $que_ac; ?></p>
        </div>
        <p data-toggle="tooltip" data-placement="bottom" title="Atendidas" style="top: 31px;cursor:pointer;background-color:green;border: 1px solid green;left:477px;color:white; <?php echo $stylo_5; ?>" onclick="javascript:location.href='indicadores_opiniones.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idusuario; ?>&estatus=5'" class="totales a <?php echo $resalta_5; ?>"><?php echo $total_opiniones_atendidas; ?></p>
        <p data-toggle="tooltip" data-placement="bottom" title="Pendientes de atender" style="top: 31px;cursor:pointer;background-color:red;left: 508px;border: 1px solid white; <?php echo $stylo_6; ?>" onclick="javascript:location.href='indicadores_opiniones.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idusuario; ?>&estatus=6'" class="totales a  <?php echo $resalta_6; ?>"><?php echo $total_opiniones_pendientes; ?></p>
        <div class="clasifCon">
            <p onclick="javascript:location.href='indicadores_opiniones.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idusuario; ?>&estatus=5&tipo=1'" style="cursor:pointer;background-color: green;z-index:10;" class="b pclasifTodo todo1 <?php echo $S_F_AT; ?>" data-toggle="tooltip" data-placement="bottom" title="Felicitaciones"><?php echo $fel_at; ?></p>
            <p onclick="javascript:location.href='indicadores_opiniones.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idusuario; ?>&estatus=5&tipo=2'" style="cursor:pointer;background-color: green;z-index:10;" class="b pclasifTodo todo2 <?php echo $S_S_AT; ?>" data-toggle="tooltip" data-placement="bottom" title="Solicitudes"><?php echo $sol_at; ?></p>
            <p onclick="javascript:location.href='indicadores_opiniones.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idusuario; ?>&estatus=5&tipo=3'" style="cursor:pointer;background-color: green;z-index:10;" class="b pclasifTodo todo3 <?php echo $S_Q_AT; ?>" data-toggle="tooltip" data-placement="bottom" title="Quejas"><?php echo $que_at; ?></p>
        </div>
        <p style="position:absolute;top:42px;right:30px;"># total</p>
    </div>
    <?php if ($_GET["estatus"] == 2) { ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <table class="table table-striped table-bordered" style="width:100%" id="myTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>origen</th>
                                <th> # </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $areas = "SELECT oo.IdOpinionOrigen,
                    oo.Descripcion AS datos,
                    (
                    SELECT
                        COUNT( op.IdOpinion ) 
                    FROM
                        c_opiniones op 
                    WHERE
                        op.IdOrigenOpinion = oo.IdOpinionOrigen 
                        AND op.IdEstatusOpinion $estado 
                        $where_1
                    ) AS series 
                FROM
                c_opinionesOrigen oo 
                ORDER BY
                    oo.Descripcion";
                            //echo$areas;
                            //AND op.IdTipoOpinion = 3 
                            $resultareas = $catalogo->obtenerLista($areas);
                            while ($rowareas = mysqli_fetch_array($resultareas)) {
                                $onclick = "onclick='muestraDetalle2(\"$estado\"," . $rowareas['IdOpinionOrigen'] . ",".$idusuario.",\"$nombreUsuario\");mostrarModal2(\"" . $rowareas['datos'] . "\",\"2\");' ";
                                $Total_indicador = $Total_indicador + $rowareas['series'];
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['datos'] . '</td>';
                                echo '<td ' . $onclick . ' style="color: rgb(124,181,236); text-decoration: underline;cursor: pointer;">' . $rowareas['series'] . '</td>';
                                echo '</tr>';
                                array_push($categorias, $rowareas['datos']);
                                array_push($series, $rowareas['series']);
                            }
                            $nombres = "";
                            for ($i = 0; $i < count($categorias); $i++) {
                                $nombres = $nombres . "'" . $categorias[$i] . "'";
                                if ($i + 1 < count($categorias)) {
                                    $nombres = $nombres . ",";
                                }
                            }
                            $resultados = "";
                            for ($index = 0; $index < count($series); $index++) {
                                $resultados = $resultados . $series[$index];
                                if ($index + 1 < count($series)) {
                                    $resultados = $resultados . ",";
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot class="thead-dark">
                            <tr>
                                <td>Total</td>
                                <td><?php echo $Total_indicador ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <figure class="highcharts-figure">

                        <div id="container"></div>
                    </figure>
                </div>
            </div>
        </div>
    <?php } elseif ($_GET["estatus"] == 4) { ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <table class="table table-striped table-bordered" style="width:100%" id="myTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>Eje</th>
                                <th> # </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $areas = "SELECT oo.idEje as ID, CONCAT(oo.IdEje,'.-',oo.Nombre) as datos, ( SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdEjeTurnado = oo.idEje AND op.IdEstatusOpinion in(2)) AS series FROM c_eje oo ORDER BY oo.idEje ";
                            //echo$areas;
                            //AND op.IdTipoOpinion = 3 
                            $resultareas = $catalogo->obtenerLista($areas);
                            while ($rowareas = mysqli_fetch_array($resultareas)) {
                                $separador = explode('-', $rowareas['datos']);
                                $tituloM = $separador[1];
                                $onclick = "onclick='muestraDetalle2(\"$estado\"," . $rowareas['ID'] . ",".$idusuario.",\"$nombreUsuario\");mostrarModal2(\"" . $tituloM . "\",\"1\");' ";
                                $Total_indicador = $Total_indicador + $rowareas['series'];
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['datos'] . '</td>';
                                echo '<td ' . $onclick . ' style="color: rgb(124,181,236); text-decoration: underline;cursor: pointer;">' . $rowareas['series'] . '</td>';
                                echo '</tr>';
                                array_push($categorias, $rowareas['datos']);
                                array_push($series, $rowareas['series']);
                            }
                            $nombres = "";
                            for ($i = 0; $i < count($categorias); $i++) {
                                $nombres = $nombres . "'" . $categorias[$i] . "'";
                                if ($i + 1 < count($categorias)) {
                                    $nombres = $nombres . ",";
                                }
                            }
                            $resultados = "";
                            for ($index = 0; $index < count($series); $index++) {
                                $resultados = $resultados . $series[$index];
                                if ($index + 1 < count($series)) {
                                    $resultados = $resultados . ",";
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot class="thead-dark">
                            <tr>
                                <td>Total</td>
                                <td><?php echo $Total_indicador ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <figure class="highcharts-figure">

                        <div id="container"></div>
                    </figure>
                </div>
            </div>
        </div>
    <?php } elseif ($_GET["estatus"] == 7) { ?>
        <div class="container-fluid" id="recargar">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">Ver por:</label>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <select id="tipo" class="form-control" name="tipo" onchange="indicador();">
                                <option value="1">Origen</option>
                                <option value="2">Tipo</option>
                                <option value="3">Eje</option>
                                <option value="4">Área</option>
                                <option value="5">Persona</option>
                            </select>
                        </div>
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">Año : </label>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <select id="anio" class="form-control" name="anio" onchange="indicador();">
                            <option value="Todos"> Todos</option>
                                <?php
                                $AÑO = "SELECT DISTINCT 
                                CASE
                                        WHEN ISNULL(YEAR ( p.Fecha ) ) THEN 'Todos' 
                                        ELSE YEAR ( p.Fecha ) 
                                    END as Periodo
                                FROM
                                    c_opiniones p";
                                   
                                $resulaño = $catalogo->obtenerLista($AÑO);
                                while ($row = mysqli_fetch_array($resulaño)) {
                                    $selected = "";
                                    if ($row['Periodo'] == " ") {
                                        echo 'hoy';
                                    }
                                    echo "<option value='" . $row['Periodo'] . "' " . $selected . ">" . $row['Periodo'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <table class="table table-striped table-bordered" style="width:100%" id="myTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>Origen</th>
                                <th> # </th>
                                <th>Atendidas</th>
                                <th>Sin atender</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $areas = "SELECT oo.IdOpinionOrigen as ID, oo.Descripcion AS datos, ( SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdOrigenOpinion = oo.IdOpinionOrigen) AS series, (SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdOrigenOpinion = oo.IdOpinionOrigen AND op.IdEstatusOpinion = 4 ) AS atendidas , (SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdOrigenOpinion = oo.IdOpinionOrigen AND op.IdEstatusOpinion in(1,2,3) ) AS n_atendidas FROM c_opinionesOrigen oo ORDER BY oo.Descripcion ";
                            //echo$areas;
                            //AND op.IdTipoOpinion = 3 
                            $resultareas = $catalogo->obtenerLista($areas);
                            $ano = "Todos";
                            $total_atendidas = 0;
                            $total_natendidas = 0;
                            $tipo = 1;
                            while ($rowareas = mysqli_fetch_array($resultareas)) {
                                $ID = $rowareas['ID'];
                                $onclick = "onclick='muestraDetalle2(\"$tipo\",\"$ano\",\"$ID\",\"0\");mostrarModal(\"" . $rowareas['datos'] . "\",\"1\",\"0\");' ";
                                $onclickA = "onclick='muestraDetalle2(\"$tipo\",\"$ano\",\"$ID\",\"1\");mostrarModal(\"" . $rowareas['datos'] . "\",\"1\",\"1\");' ";
                                $onclickNA = "onclick='muestraDetalle2(\"$tipo\",\"$ano\",\"$ID\",\"2\");mostrarModal(\"" . $rowareas['datos'] . "\",\"1\",\"2\");' ";
                                $Total_indicador = $Total_indicador + $rowareas['series'];
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['datos'] . '</td>';
                                echo '<td ' . $onclick . 'style="color: rgb(124,181,236); text-decoration: underline;cursor: pointer;">' . $rowareas['series'] . '</td>';
                                echo '<td ' . $onclickA . 'style="color: rgb(124,181,236); text-decoration: underline;cursor: pointer;">' . $rowareas['atendidas'] . '</td>';
                                echo '<td ' . $onclickNA . 'style="color: rgb(124,181,236); text-decoration: underline;cursor: pointer;">' . $rowareas['n_atendidas'] . '</td>';
                                echo '</tr>';
                                array_push($categorias, $rowareas['datos']);
                                array_push($series, $rowareas['series']);
                                $total_atendidas = $total_atendidas + $rowareas['atendidas'];
                                $total_natendidas = $total_natendidas + $rowareas['n_atendidas'];
                            }
                            $nombres = "";
                            for ($i = 0; $i < count($categorias); $i++) {
                                $nombres = $nombres . "'" . $categorias[$i] . "'";
                                if ($i + 1 < count($categorias)) {
                                    $nombres = $nombres . ",";
                                }
                            }
                            $resultados = "";
                            for ($index = 0; $index < count($series); $index++) {
                                $resultados = $resultados . $series[$index];
                                if ($index + 1 < count($series)) {
                                    $resultados = $resultados . ",";
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot class="thead-dark">
                            <tr>
                            <td>Total</td>
                                <td><?php echo $Total_indicador ?></td>
                                <td><?php echo $total_atendidas; ?></td>
                                <td><?php echo $total_natendidas; ?></td> </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <figure class="highcharts-figure">

                        <div id="container2"></div>
                    </figure>
                </div>
            </div>
        </div>

    <?php } else { ?>
        <div class="global">
            <?php
            $top_px = 54;
            foreach ($ejes as $eje) { //imprime toda la linea
                $top_px--;
                $por_eje = round(($totales_ejes[$eje] * 100) / $total_cuadro, 1);
            ?>
                <div style="top:<?php echo $top_px; ?>px" class="flotante">
                    <?php echo $cadenas_ejes[$eje]; ?>
                    <div class="totEj">
                        <p class="totEjeFin"><?php echo $totales_ejes[$eje]; ?></p>
                        <p class="totEjeFinPercent" style="font-size: .9em;color:green;"><?php echo $por_eje; ?>%</p>
                    </div>

                </div>
            <?php
            }
            ?>
            <div class="flotante" style="top: 42px;">
                <?php echo $cadenaTotalesArea; ?>
                <div class="totEj">
                    <p style="font-size: 15px;"><?php echo $total_cuadro; ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
    <div style="top: 33px;" class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="left: -132px;width: 860px;">
                <div class="modal-header h" style="padding: 7px 5px;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="modal-title" id="modalTitle">Opiniones detalle</div>
                </div>
                <div class="modal-body detalle" style="padding: 31px 5px;"></div>
            </div>
        </div>
    </div>
    <?php if ($_GET["estatus"] == 2 || $_GET["estatus"] == 4) { ?>
        <script>
            Highcharts.chart('container', {
                chart: {
                    type: 'column',
                    options3d: {
                        enabled: true,
                        alpha: 15,
                        beta: 15,
                        viewDistance: 25,
                        depth: 40
                    }
                },
                title: {
                    text: '<?php echo $titulo; ?>'
                },
                xAxis: {
                    categories: [
                        <?php
                        echo $nombres;
                        ?>
                    ],
                    labels: {
                        skew3d: true,
                        style: {
                            fontSize: '16px'
                        }
                    }
                },
                yAxis: {
                    allowDecimals: false,
                    min: 0,
                    title: {
                        text: 'Numero de Opiniones',
                        skew3d: true
                    }
                },
                tooltip: {
                    headerFormat: '<b>{point.key}</b><br>',
                    pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y} / {point.stackTotal}'
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        depth: 40
                    }
                },
                series: [{
                    name: 'Opiniones',
                    data: [
                        <?php
                        echo $resultados;
                        ?>
                    ],
                    stack: 'male'
                }]
            });
        </script>
    <?php } elseif ($_GET["estatus"] == 7) { ?>
        <script>
            Highcharts.chart('container2', {
                chart: {
                    type: 'column',
                    options3d: {
                        enabled: true,
                        alpha: 15,
                        beta: 15,
                        viewDistance: 25,
                        depth: 40
                    }
                },
                title: {
                    text: '<?php echo $titulo2; ?>'
                },
                xAxis: {
                    categories: [
                        <?php
                        echo $nombres;
                        ?>
                    ],
                    labels: {
                        skew3d: true,
                        style: {
                            fontSize: '16px'
                        }
                    }
                },
                yAxis: {
                    allowDecimals: false,
                    min: 0,
                    title: {
                        text: 'Numero de Opiniones',
                        skew3d: true
                    }
                },
                tooltip: {
                    headerFormat: '<b>{point.key}</b><br>',
                    pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y} / {point.stackTotal}'
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        depth: 40
                    }
                },
                series: [{
                    name: 'Opiniones',
                    data: [
                        <?php
                        echo $resultados;
                        ?>
                    ],
                    stack: 'male'
                }]
            });
        </script>
    <?php } ?>
    <script>
        $('document').ready(function() {



            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="popover"]').popover();

            $('.a').click(function(e) {
                e.preventDefault();
                $('.a').removeClass('resalta');
                $(this).addClass('resalta');
            });


            $('.b').click(function(e) {
                e.preventDefault();
                $('.b').removeClass('resaltaEstatus');
                $(this).addClass('resaltaEstatus');
            });


        });

        function muestraDetalle(idArea, idEje, estatus, id_usuario, tipo) {

            $(".h").css('background-color', "#4d4d57");
            $("#myModal").modal({
                backdrop: false
            });
            console.log("area : " + idArea);
            $.post("Lista_opiniones.php", {
                IdEje: idEje,
                IdArea: idArea,
                actividad: 1,
                id_usuario: id_usuario,
                IdEstatus_igual: estatus,
                IdTipo: tipo
            }, function(data) {
                $(".detalle").html('');
                $(".detalle").html(data);
            });
        }

        function mostrarModal(nombre, tipo, atendido) {
            var sub = "";
            if (tipo == 1) {
                if (atendido == 1) {
                    sub = "atendidas"
                }
                else if(atendido == 2) {
                    sub = " sin atender"
                }
                var titulo = 'Opiniones por tipo ' + nombre + ' '+ sub;
            } else {
                var titulo = 'Opiniones del área de ' + nombre;
            }

            $("#modalTitle").html(titulo);
            $("#myModal").modal("show");
        }
        function mostrarModal2(nombre, tipo) {
         var titulo="";
         if (tipo==1) {
             titulo='Opiniones pendientes de turnar del eje '+nombre;
         } else {
            titulo='Opiniones pendientes de turnar del origen '+nombre;
         }
            $("#modalTitle").html(titulo);
            $("#myModal").modal("show");
        }


        function muestraDetalle2(tipo, ano, id, caso) {

            $(".h").css('background-color', "#4d4d57");
            $("#myModal").modal({
                backdrop: false
            });
            $.post("Datos_grafica.php", {
                tipo: tipo,
                Ano: ano,
                Id: id,
                Caso: caso
            }, function(data) {
                $(".detalle").html('');
                $(".detalle").html(data);
            });
        }

        function indicador() {
            var periodo = $("#anio").val();
            var tipo = $("#tipo").val();
            var persona = $("#persona").val();

            $("#recargar").load("Indicador.php?periodo=" + periodo + "&tipo=" + tipo + '&persona=' + persona);
        }
    </script>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</html>