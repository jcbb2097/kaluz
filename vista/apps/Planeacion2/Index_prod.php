<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once __DIR__ . "/../../../source/dao/clases/LoggedinTime.php";
include_once('Classes/Planeacion.class.php');
//clases necesarias
$catalogo = new Catalogo();
$Planeacion = new Planeacion();
//variables globales 
if (isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "") {
    $nombreUsuario = $_GET['nombreUsuario'];
}
if (isset($_GET['idUsuario']) && $_GET['idUsuario'] != "") {
    $Id_usuario = $_GET['idUsuario'];
}
if (isset($_GET['perfil']) && $_GET['perfil'] != "") {
    $perfil = $_GET['perfil'];
}
if (isset($_GET['tipoPerfil']) && $_GET['tipoPerfil'] != "") {
    $tipo_perfil = $_GET['tipoPerfil'];
}
if (isset($_GET['periodo']) && $_GET['periodo'] != "") {
    $a = $_GET['periodo'];
    $Year = $Planeacion->periodo($a);
} else {
    $Year = $Planeacion->periodo(date('Y'));
}
$ejes = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11);
$nombreEjes = array('Eje 1 Estrategias de seguridad', 'Eje 2 Plan estratégico', 'Eje 3 Infraestructura', 'Eje 4 Gestion administrativa', 'Eje 5 Autogestión de recursos', 'Eje 6 Exposición permanente', 'Eje 7 Exposiciones temporales', 'Eje 8 Bellas artes para todos', 'Eje 9 Difusión e imagen', 'Eje 10 Publicaciones', 'Eje 11 Estrategia digital');
$colorEjes = array('66', '118', '170', '222', '274', '326', '378', '430', '482', '534', '586');
$totalesEntregablesEjesA = array();
$totalesPorcentajeEjesA = array();
$totalesEntregablesEjesCompletosA = array();
$totalesEntregablesEjesM = array();
$totalesPorcentajeEjesM = array();
$totalesEntregablesEjesCompletosM = array();
$i = 0;
$totalE = 0;
$totalEC = 0;
$totalAv = 0;
$t_e_a = 0;
$t_e_a_1 = 0;
$t_e_a_P = 0;
$t_e_m = 0;
$t_e_m_1 = 0;
$t_e_m_P = 0;
$color_anio = "";
if ($Year[1] == 2021) {
    $color_anio = '4ffa2d';
} else {
    $color_anio = 'ffef5e';
}

foreach ($ejes as $eje) {
    $actividad = $Planeacion->Vista_entregables_eje($eje, 1, $Year[0], $Year[1]);
    $meta = $Planeacion->Vista_entregables_eje($eje, 2, $Year[0], $Year[1]);
    array_push($totalesEntregablesEjesA, $actividad[0]);
    array_push($totalesPorcentajeEjesA, $actividad[1]);
    array_push($totalesEntregablesEjesCompletosA, $actividad[2]);
    array_push($totalesEntregablesEjesM, $meta[0]);
    array_push($totalesPorcentajeEjesM, $meta[1]);
    array_push($totalesEntregablesEjesCompletosM, $meta[2]);
    $totalE = $totalE += $actividad[0] + $meta[0];
    $totalEC = $totalEC += $actividad[2] + $meta[2];
    $t_e_a = $t_e_a += $actividad[0];
    $t_e_m = $t_e_m += $meta[0];
    $t_e_a_1 = $t_e_a_1 += $actividad[2];
    $t_e_m_1 = $t_e_m_1 += $meta[2];
}
if ($totalEC > 0) {
    $totalAv = $totalEC * 100 / $totalE;
}
if ($t_e_a > 0) {
    $t_e_a_P =  $t_e_a_1 * 100 / $t_e_a;
}
if ($t_e_m > 0) {
    $t_e_m_P = $t_e_m_1 * 100 / $t_e_m;
}
$colora = "";
$colorm = "";
$colorTotal = "";
if ($totalAv >= 1 && $totalAv <= 25) {
    $colorTotal = "-in";
} elseif ($totalAv >= 26 && $totalAv <= 50) {
    $colorTotal = "-pr";
} elseif ($totalAv >= 100) {
    $colorTotal = "-fn";
}
if ($t_e_m_P >= 1 && $t_e_m_P <= 25) {
    $colorm = "-in";
} elseif ($t_e_m_P >= 26 && $t_e_m_P <= 50) {
    $colorm = "-pr";
} elseif ($t_e_m_P >= 100) {
    $colorm = "-fn";
}
if ($t_e_a_P >= 1 && $t_e_a_P <= 25) {
    $colora = "-in";
} elseif ($t_e_a_P >= 26 && $t_e_a_P <= 50) {
    $colora = "-pr";
} elseif ($t_e_a_P >= 100) {
    $colora = "-fn";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <title>::.SIE.::</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="../../../resources/js/Eje_color.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/Planeacion_avance.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <style type="text/css">
        .aplE {
            font-family: 'Muli-SemiBold';
            position: absolute;
            height: 51px;
            width: 180px;
            font-size: 11px;
            background-color: #e2e2e1;
            color: #000;
            padding-left: 15px;
            padding-top: 5px;
        }

        .entregable {
            color: black;
        }

        a:hover {
            cursor: pointer;
        }

        .loading-div {
            width: 1800px;
            height: 720px;
            background-color: #fff;
            display: table-cell;
            vertical-align: middle;
            color: #555;
            overflow: hidden;
            text-align: center;
        }

        .loading-div::before {
            display: inline-block;
            vertical-align: middle;
        }

        .titletotal {
            position: absolute;
            top: 40px;
            left: 220px;
        }

        .titlep {
            position: absolute;
            top: 39px;
            left: 446px;
            width: 50px;
        }

        .progress-bar-in {
            background-color: #dfa739 !important;
        }

        .progress-bar-pr {
            background-color: #dbd909 !important;
        }

        .progress-bar-fn {
            background-color: #33ab15 !important;
        }

        .progress {
            margin-bottom: 20px;
            overflow: hidden;
            background-color: #f5f5f5;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
        }
    </style>

</head>
<div class="well2 "><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $Id_usuario; ?>">Aplicaciones</a> / <a style="color:#<?php echo $color_anio; ?>;" href="javascript:window.location.reload(true)">Planeación y avance <?php echo $Year[1] ?></a>
</div>
<div class="well2 wr">
    <div class="titlecategoria">Periodo : &nbsp;&nbsp; <b></b></div>
    <div class="cateSelect">
        <select style="width: 124px;border-radius: 0px;font-size: 9px;font-family: 'Muli-Regular';color: black;" name="anio" id="anio">
            <option value="0">Seleccione una opción</option>
            <?php
            $Perfil = "SELECT p.Id_Periodo,p.Periodo from c_periodo p ORDER BY p.Periodo  DESC";
            $resul = $catalogo->obtenerLista($Perfil);
            while ($row = mysqli_fetch_array($resul)) {
                if ($Year[0] == $row['Id_Periodo']) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                echo "<option value='" . $row['Id_Periodo'] . "' " . $selected . ">" . $row['Periodo'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="titletotal">Avance total de actividades y metas <?php echo $totalE ?></div>

    <div class="progress titlep">
        <div class="progress-bar<?php echo $colorTotal; ?>" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($totalAv, 1); ?>%; color: black;height: 20px;"><?php echo round($totalAv, 1) . "%"; ?>
        </div>
    </div>

</div>

<body>
    <div class="loading-div">
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw "></i>
        <span class="sr-only">Loading...</span>
    </div>

    <?php
    foreach ($ejes as $eje) {
        $colorac = "";
        if (round($totalesPorcentajeEjesA[$i]) >= 1 && round($totalesPorcentajeEjesA[$i]) <= 25) {
            $colorac = "-in";
        } elseif (round($totalesPorcentajeEjesA[$i]) >= 26 && round($totalesPorcentajeEjesA[$i]) <= 50) {
            $colorac = "-pr";
        } elseif (round($totalesPorcentajeEjesA[$i]) >= 100) {
            $colorac = "-fn";
        }
        $colorme = "";
        if (round($totalesPorcentajeEjesM[$i]) >= 1 && round($totalesPorcentajeEjesM[$i]) <= 25) {
            
            $colorme = "-in";
        } elseif (round($totalesPorcentajeEjesM[$i]) >= 26 && round($totalesPorcentajeEjesM[$i]) <= 50) {
            $colorme = "-pr";
        } elseif (round($totalesPorcentajeEjesM[$i]) >= 100) {
            $colorme = "-fn";
        }
        //echo round($totalesPorcentajeEjesA[$i]) .'<br>';
    ?>
    <div style="top: <?php echo $colorEjes[$i] ?>px;left: 1px;width: 450px;" class="aplE">
            <div class="col-md-7 col-sm-7 col-xs-7">
                <a class="entregable control-label" onclick="ejeColor(<?php echo $eje ?> ,'<?php echo $colorEjes[$i]; ?>' );muestraDetalle(<?php echo $eje ?> ,1,<?php echo $Year[0] ?>)">
                    Avance de actividades de <?php echo ($totalesEntregablesEjesA[$i]); ?> entregables</a>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-5">
                <div class="progress">
                    <div class="progress-bar<?php echo $colorac; ?>" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($totalesPorcentajeEjesA[$i], 1); ?>%; color: black;height: 20px;"><?php echo round($totalesPorcentajeEjesA[$i], 1) . "%"; ?>
                    </div>
                </div>
            </div>
        </div>
        <div style="top: <?php echo $colorEjes[$i] ?>px;left: 452px;width: 453px;" class="aplE">
        <div class="col-md-7 col-sm-7 col-xs-7">
                <a class="entregable control-label" onclick="ejeColor(<?php echo $eje ?> ,'<?php echo $colorEjes[$i]; ?>' );muestraDetalle(<?php echo $eje ?> ,2,<?php echo $Year[0] ?>)">
               Avance de metas de <?php echo ($totalesEntregablesEjesM[$i]); ?> entregables</a></div>
               <div class="col-md-5 col-sm-5 col-xs-5">
                <div class="progress">
                    <div class="progress-bar<?php echo $colorme; ?>" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($totalesPorcentajeEjesM[$i], 1); ?>%; color: black;height: 20px;"><?php echo round($totalesPorcentajeEjesM[$i], 1) . "%"; ?>
                    </div>
                </div>
            </div>
        </div> 
    <?php $i++;
    }

    ?>
    <div style="top: 638px;left: 1px;width: 450px;" class="aplE">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <p>Total de entregables en actividades:</p>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
            <label class="control-label">Avance de <?php echo $t_e_a ?> entregables</label>
            <div class="progress">
                <div class="progress-bar<?php echo $colora ?>" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($t_e_a_P, 1); ?>%; color: black;height: 20px;"><?php echo round($t_e_a_P, 1) . "%"; ?>
                </div>
            </div>
        </div>
    </div>
    <div style="top:638px;left: 452px;width: 453px;" class="aplE">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <p>Total de entregables en metas:</p>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
            <label class="control-label">Avance de <?php echo $t_e_m ?> entregables</label>
            <div class="progress">
                <div class="progress-bar<?php echo $colorm ?>" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($t_e_m_P, 1); ?>%; color: black;height: 20px;"><?php echo round($t_e_m_P, 1) . "%"; ?>
                </div>
            </div>
        </div>
    </div>



    <input type="hidden" id="Id_usuario" value="<?php echo $Id_usuario ?>">
    <input type="hidden" id="nombreUsuario" value="<?php echo $nombreUsuario ?>">
    <input type="hidden" id="Perfil" value="<?php echo $perfil ?>">
    <input type="hidden" id="Tipo_perfil" value="<?php echo $tipo_perfil ?>">
</body>

<script>
    document.onreadystatechange = function() {
        if (document.readyState == "complete") {
            $(".loading-div").hide();
            $('body').css('overflow', 'scroll');
        }
    }

    $('#anio').on('change', function() {
        var Periodo = $('#anio').val();
        var Id_usuario = $('#Id_usuario').val();
        var nombreUsuario = $('#nombreUsuario').val();
        var Perfil = $('#Perfil').val();
        var Tipo_perfil = $('#Tipo_perfil').val();
        url = "Index.php?nombreUsuario=" + nombreUsuario + "&idUsuario=" + Id_usuario + "&perfil=" + Perfil + "&tipoPerfil=" + Tipo_perfil + "&periodo=" + Periodo;
        $(location).attr('href', url);
    });

    function muestraDetalle(idEje, tipo, periodo) {
        var ano = $("#anio option:selected").text();
        var Id_usuario = $('#Id_usuario').val();
        var nombreUsuario = $('#nombreUsuario').val();
        var Perfil = $('#Perfil').val();
        var Tipo_perfil = $('#Tipo_perfil').val();
        let ejes = ['Eje 1 Estrategias de seguridad', 'Eje 2 Plan estratégico', 'Eje 3 Infraestructura', 'Eje 4 Gestion administrativa', 'Eje 5 Autogestión de recursos', 'Eje 6 Exposición permanente', 'Eje 7 Exposiciones temporales', 'Eje 8 Bellas artes para todos', 'Eje 9 Difusión e imagen', 'Eje 10 Publicaciones', 'Eje 11 Estrategia digital'];
        url = "Planeacion_avance_acme.php?IdEje=" + idEje + "&tipo=" + tipo + "&Periodo=" + periodo + "&ano=" + ano + "&nombreeje=" + ejes[idEje - 1] + "&Id_usuario=" + Id_usuario + "&nombreUsuario=" + nombreUsuario + "&Perfil=" + Perfil + "&tipoPerfil=" + Tipo_perfil;
        $(location).attr('href', url);
    }
</script>

</html>