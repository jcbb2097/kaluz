<?php
/*if ((!isset($_COOKIE['user']) || $_COOKIE['user'] == "") || (!isset($_COOKIE['IdSession']) || strlen($_COOKIE['IdSession']) != 15)) {
    header("Location: ../index.php");
}*/
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

session_start();
include_once __DIR__."/../../../source/dao/clases/LoggedinTime.php";
include_once __DIR__."/../../../source/controller/UsuarioController.php";
include_once __DIR__."/../../../source/controller/EjeController.php";
include_once __DIR__."/../../../source/controller/AreaController.php";
include_once __DIR__."/../../../source/controller/NoticiaController.php";

if(!isset($_SESSION['user_session']))
{
?>  
<script>
    top.location.href="../../login.php";
    window.reload();
</script>
<?php   
}
if(isset($_SESSION["user_session"])) 
{
    if(isLoginSessionExpired()) 
    {
?>
<script>
    top.location.href="../../logout.php?session_expired=1";
</script>
<?php
    }
}

include_once("../../../WEB-INF/Classes/Catalogo.class.php");
include_once("../../../WEB-INF/Classes/Indicadores.2.class.php");
$obj = new Indicadores2();
$obj2 = new Indicadores2();
$catalogo = new Catalogo();
$indicador = "";
$indicador2 = "";
$idIndicador = "";
$Reporte = "";
$periodo = "";
$i = 0;
$querry = "";
$aplicacion = "";
$local = "";

//echo $_GET['Indicador']." <br>".$_GET['IndicadorEje']."<br>".$_GET['IndicadorArea'];

if (isset($_GET['IndicadorEje']) && $_GET['IndicadorEje'] != "undefined") {
    $periodo = $_GET['Periodo'];
    $idIndicador = $_GET['IndicadorEje'];
} else if (isset($_GET['IndicadorArea']) && $_GET['IndicadorArea'] != "undefined") {
    $periodo = $_GET['Periodo'];
    $idIndicador = $_GET['IndicadorArea'];
} else if (isset($_GET['Reporte']) && $_GET['Reporte'] != "undefined") {
    $periodo = $_GET['Periodo'];
    $idIndicador = $_GET['Reporte'];
} if (isset($_GET['indicador']) && $_GET['indicador'] != "") {
    $idIndicador = $_GET['indicador'];
    $periodo = $_GET['Periodo'];
} else {
    $periodo = $_GET['Periodo'];
    $idIndicador = $_GET['Indicador'];
}
if ($idIndicador) {
    $obj->setIdIndicador($idIndicador);
    $obj->getRegistro();
    $aplicacion = $obj->getIdAplicacion();

    switch ($obj->getIdPresentacion()) {
        case 1:
            //unico
            $consulta = $obj->getQueryConsulta();

            $result = $catalogo->obtenerLista($consulta);

            // echo $consulta;
            echo '<br><center><table width="600px" height="150px" border="1" bordercolorlight="#999999" cellpadding="0" cellspacing="0">
    <tr class="titulo_tabla" align="center"> 
        <td colspan="2" ><font size="10">' . $obj->getDescripcion() . '</font></td>
        </tr>';
            while ($row = mysqli_fetch_array($result)) {
                echo '<tr>';
                echo '<td class="contenido_tabla"><font size="7">' . "se tiene un total de:" . '</font></td>';
                echo '<td class="contenido_tabla" align="center"><font size="7">' . $row['series'] . '</font></td>';
                echo '</tr>';
            }
            echo '</table></center>';
            echo'<a href="#" data-toggle="modal" data-target="#miModal">
  Mas información
</a>';
            break;
        case 2:
            //tabla
            $consulta = $obj->getQueryConsulta();

            $result = $catalogo->obtenerLista($consulta);
            //echo $consulta;
            echo '<center><table width="400" border="1" bordercolorlight="#999999" cellpadding="0" cellspacing="0">
    <tr class="titulo_tabla" align="center"> 
        <td colspan="2" ><font size="3">' . $obj->getDescripcion() . '</font></td>
</tr>';
            $total = 0;
            while ($row = mysqli_fetch_array($result)) {
                echo '<tr>';
                echo '<td class="contenido_tabla"><font size="3">' . $row['datos'] . '</font></td>';
                echo '<td class="contenido_tabla" align="center"><font size="3">' . $row['series'] . '</font></td>';
                echo '</tr>';
                $men2 = explode("$", $row['series']);

                if ($men2[1] != "") {
                    $total = $total + $men2[1];
                } else {
                    $total = $total + $row['series'];
                }
            }
            echo '<tr class="titulo_tabla" align="center">';
            echo '<td><font size="3">Total</font></td><td><font size="3">' . $total . '</font></td>';
            echo '</tr>';
            echo '</table></center>';
            echo'<a href="#" data-toggle="modal" data-target="#miModal">
  Mas información
</a>';

            break;
        case 3:
            //Pie
            $consulta = $obj->getQueryConsulta();
            $result = $catalogo->obtenerLista($consulta);
            // echo $consulta;
            $columnas = array();
            $series = array();
            while ($row = mysqli_fetch_array($result)) {
                array_push($columnas, $row['datos']);
                array_push($series, $row['series']);
            }

            $se = "";

            for ($i = 0; $i < count($series); $i++) {
                $se = $se . "['" . $columnas[$i] . "'," . $series[$i] . "]";
                if ($i + 1 < count($series)) {
                    $se = $se . ",";
                }
            }


            echo "<script>Highcharts.chart('container', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: '" . $obj->getDescripcion() . "'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: '" . $obj->getDescripcion() . "',
        data: [
            " . $se . "
        ]
    }]
});</script>";
            echo'<a href="#" data-toggle="modal" data-target="#miModal">
  Mas información
</a>';
            break;
        case 4:
            //barras
            $consulta = $obj->getQueryConsulta();

            $result = $catalogo->obtenerLista($consulta);
            //echo $querry;
            $columnas = array();
            $series = array();
            while ($row = mysqli_fetch_array($result)) {
                array_push($columnas, $row['datos']);
                array_push($series, $row['series']);
            }

            $co = "";
            $se = "";
            for ($i = 0; $i < count($columnas); $i++) {
                $co = $co . "'" . $columnas[$i] . "'";
                if ($i + 1 < count($columnas)) {
                    $co = $co . ",";
                }
            }

            for ($i = 0; $i < count($series); $i++) {
                $se = $se . $series[$i];
                if ($i + 1 < count($series)) {
                    $se = $se . ",";
                }
            }


            echo "<script>Highcharts.chart('container', {
    chart: {
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        }
    },
    title: {
        text: '" . $obj->getDescripcion() . "'
    },
    plotOptions: {
        column: {
            depth: 25
        }
    },
    xAxis: {
        categories: [" . $co . "]
    },
    yAxis: {
        title: {
            text: null
        }
    },
    series: [{
        name: '" . $obj->getDescripcion() . "',
        data: [" . $se . "]
    }]
});</script>";
            echo'<a href="#" data-toggle="modal" data-target="#miModal">
  Mas información
</a>';
            break;
        case 5:
            //lineal
            $consulta = $obj->getQueryConsulta();
            $men = explode("?", $consulta);
            $Sumatotal = 0;
            $querry = $men[0] . $men[1];
            $result = $catalogo->obtenerLista($querry);
            $datos = array();
            while ($row = mysqli_fetch_array($result)) {
                $datos[$row['datos']] = $row['series'];
            }
            //echo $consulta;

            echo "<script>Highcharts.chart('container', {

    title: {
        text: '" . $obj->getDescripcion() . "'
    },

    subtitle: {
        text: 'Source: thesolarfoundation.com'
    },

    yAxis: {
        title: {
            text: '" . $obj->getDescripcion() . "'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 2010
        }
    },
";
            echo "series:[";
            foreach ($datos as $key => $value) {
                echo "{ name: '" . $key . "',";
                echo "  data: [";
                echo "$value ]";
                echo"},";
            }
            echo '],';
            echo"               
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});  </script>";
            echo'<a href="#" data-toggle="modal" data-target="#miModal">
  Abrir modal
</a>';
            break;
        case 6:
            //tabla Pie
            $consulta = $obj->getQueryConsulta();
            $result = $catalogo->obtenerLista($consulta);
            $Sumatotal = 0;
            // echo $consulta;
            $columnas = array();
            $series = array();
            while ($row = mysqli_fetch_array($result)) {
                array_push($columnas, $row['datos']);
                array_push($series, $row['series']);
            }

            $se = "";

            for ($i = 0; $i < count($series); $i++) {
                $se = $se . "['" . $columnas[$i] . "'," . $series[$i] . "]";
                if ($i + 1 < count($series)) {
                    $se = $se . ",";
                }
            }


            echo'<div class="row">';
            echo'<div id="dTindicadores" style="display:block;">';
            echo' <table id="tpie" class="display table table-bordered">';
            echo' <thead>
                        <tr>';
            echo'  <th>Datos</th>';
            echo'<th>Series</th>';
            echo '</tr>
                    </thead>
                    <tbody>';
            $result2 = $catalogo->obtenerLista($consulta);
            while ($rowActividades = mysqli_fetch_array($result2)) {
                echo '<tr id="trFila">';
                echo '<td>' . $rowActividades['datos'] . '</td>';
                echo '<td>' . $rowActividades['series'] . '</td>';
                $Sumatotal = $Sumatotal + $rowActividades['series'];
                echo '</tr>';
            }
            echo '<td>' . 'Total</td>';
            echo '<td>' . $Sumatotal . '</td>';
            echo'<a href="#" data-toggle="modal" data-target="#miModal">
  Mas información
</a>';

            echo "<script>Highcharts.chart('container', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: '" . $obj->getDescripcion() . "'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: '" . $obj->getDescripcion() . "',
        data: [
            " . $se . "
        ]
    }]
});</script>";
            echo'   </tbody>

                </table>
            </div> ';
            break;
        case 7:
            //tabla barras
            $consulta = $obj->getQueryConsulta();
            $Sumatotal = 0;
            $result = $catalogo->obtenerLista($consulta);
            //echo $querry;
            $columnas = array();
            $series = array();
            while ($row = mysqli_fetch_array($result)) {
                array_push($columnas, $row['datos']);
                array_push($series, $row['series']);
            }

            $co = "";
            $se = "";
            for ($i = 0; $i < count($columnas); $i++) {
                $co = $co . "'" . $columnas[$i] . "'";
                if ($i + 1 < count($columnas)) {
                    $co = $co . ",";
                }
            }

            for ($i = 0; $i < count($series); $i++) {
                $se = $se . $series[$i];
                if ($i + 1 < count($series)) {
                    $se = $se . ",";
                }
            }
            echo'<div class="row">';
            echo'<div id="dTindicadores" style="display:block;">';
            echo' <table id="tbarras" class="display table table-bordered">';
            echo' <thead>
                        <tr>';
            echo'  <th>Datos</th>';
            echo'<th>Series</th>';
            echo '</tr>
                    </thead>
                    <tbody>';
            $result2 = $catalogo->obtenerLista($consulta);
            while ($rowActividades = mysqli_fetch_array($result2)) {
                echo '<tr id="trFila">';
                echo '<td>' . $rowActividades['datos'] . '</td>';
                echo '<td>' . $rowActividades['series'] . '</td>';
                $Sumatotal = $Sumatotal + $rowActividades['series'];
                echo '</tr>';
            }

            echo '<td>' . 'Total</td>';
            echo '<td>' . $Sumatotal . '</td>';
            echo'   </tbody>

                </table>
            </div> ';
            echo'<a href="#" data-toggle="modal" data-target="#miModal">
  Mas información
</a>';
            echo "<script>Highcharts.chart('container', {
    chart: {
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        }
    },
    title: {
        text: '" . $obj->getDescripcion() . "'
    },
    plotOptions: {
        column: {
            depth: 25
        }
    },
    xAxis: {
        categories: [" . $co . "]
    },
    yAxis: {
        title: {
            text: null
        }
    },
    series: [{
        name: '" . $obj->getDescripcion() . "',
        data: [" . $se . "]
    }]
});</script>";

            break;
        case 8:
            //piramide
            $consulta = $obj->getQueryConsulta();
            $result = $catalogo->obtenerLista($consulta);
            //echo $querry;
            $columnas = array();
            $series = array();
            while ($row = mysqli_fetch_array($result)) {
                array_push($columnas, $row['datos']);
                array_push($series, $row['series']);
            }
            $se = "";

            for ($i = 0; $i < count($series); $i++) {
                $se = $se . "['" . $columnas[$i] . "'," . $series[$i] . "]";
                if ($i + 1 < count($series)) {
                    $se = $se . ",";
                }
            }

            echo "<script>
                $(document).ready(function(){
        Highcharts.chart('container', {
chart: {
    type: 'pyramid'
},
title: {
   text: '" . $obj->getDescripcion() . "',
    x: -50
},
plotOptions: {
    series: {
        dataLabels: {
            enabled: true,
            format: '<b>{point.name}</b> ({point.y:,.0f})',
            softConnector: true
        },
        center: ['40%', '50%'],
        width: '80%'
    }
},
legend: {
    enabled: false
},
series: [{
    name: '" . $obj->getDescripcion() . "',
    data: [
            " . $se . "
        ]
}]
 });
 });</script>";
            echo'<a href="#" data-toggle="modal" data-target="#miModal">
  Abrir modal
</a>';
            break;
        case 9:
            //piramide tablas
            $consulta = $obj->getQueryConsulta();
            $result = $catalogo->obtenerLista($consulta);
            // echo $consulta;
            $Sumatotal = 0;
            $columnas = array();
            $series = array();
            while ($row = mysqli_fetch_array($result)) {
                array_push($columnas, $row['datos']);
                array_push($series, $row['series']);
            }

            $se = "";

            for ($i = 0; $i < count($series); $i++) {
                $se = $se . "['" . $columnas[$i] . "'," . $series[$i] . "]";
                if ($i + 1 < count($series)) {
                    $se = $se . ",";
                }
            }


            echo'<div class="row">';
            echo'<div id="dTindicadores" style="display:block;">';
            echo' <table id="tbarras2" class="display table table-bordered">';
            echo' <thead>
                        <tr>';
            echo'  <th>Datos</th>';
            echo'<th>Series</th>';
            echo '</tr>
                    </thead>
                    <tbody>';
            $result2 = $catalogo->obtenerLista($consulta);
            while ($rowActividades = mysqli_fetch_array($result2)) {
                echo '<tr id="trFila">';
                echo '<td>' . $rowActividades['datos'] . '</td>';
                echo '<td>' . $rowActividades['series'] . '</td>';
                $Sumatotal = $Sumatotal + $rowActividades['series'];
                echo '</tr>';
            }
            echo '<td>' . 'Total</td>';
            echo '<td>' . $Sumatotal . '</td>';
            echo'   </tbody>
               
                </table>
            </div> ';
            echo'<a href="#" data-toggle="modal" data-target="#miModal">
  Mas información
</a>';
            echo "<script>
                $(document).ready(function(){
        Highcharts.chart('container', {
chart: {
    type: 'pyramid'
},
title: {
   text: '" . $obj->getDescripcion() . "',
    x: -50
},
plotOptions: {
    series: {
        dataLabels: {
            enabled: true,
            format: '<b>{point.name}</b> ({point.y:,.0f})',
            softConnector: true
        },
        center: ['40%', '50%'],
        width: '80%'
    }
},
legend: {
    enabled: false
},
series: [{
    name: '" . $obj->getDescripcion() . "',
    data: [
            " . $se . "
        ]
}]
 });
 });</script>";


            break;
        case 10:
            //varios unicos
            $consulta = $obj->getQueryConsulta();
            $indicador2 = explode(",", $consulta);
            $total = count($indicador2) - 1;
            for ($index = 0; $index < $total; $index++) {
                $obj->setIdIndicador($indicador2[$i]);
                $obj->getRegistro();
                $consulta2 = $obj->getQueryConsulta();
                $result = $catalogo->obtenerLista($consulta2);
                echo '<br><center><table width="600px" height="150px" border="1" bordercolorlight="#999999" cellpadding="0" cellspacing="0">
    <tr class="titulo_tabla" align="center"> 
        <td colspan="2" ><font size="10">' . $obj->getDescripcion() . '</font></td>
        </tr>';
                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td class="contenido_tabla"><font size="7">' . "se tiene un total de:" . '</font></td>';
                    echo '<td class="contenido_tabla" align="center"><font size="7">' . $row['series'] . '</font></td>';
                    echo '</tr>';
                }
                echo '</table></center>';

                $i++;
            }
            echo'<a href="#" data-toggle="modal" data-target="#miModal">
  Mas información
</a>';

            break;
        case 11:
            $consulta = $obj->getQueryConsulta();

            echo' <iframe id="scorm_object" src="' . $consulta . '" style="width:100%;height:708px;border:0;z-index:100"></iframe>';

            break;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- <link rel="stylesheet" href="resources/css/paginas/indicadores/indicadores.css"> -->
        <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/indicadores.css" />
        <!-- <script type="text/javascript" language="javascript" src="resources/js/paginas/indicadores/Carga.js" ></script> -->
        <script src="../../../resources/js/aplicaciones/Indicadores/Carga.js"></script>
    </head>
    <body>

        <div id="container" name="container"> </div>
        <?php
        if (isset($_GET['regreso']) && $_GET['regreso'] == 1) {
             echo '<input type="button" class="btn btn-primary" onclick="cambiarContenidos(\'#contenidos\',\'Indicadores2.0/MenuActividades.php?Periodo=' . $periodo . '\');" value="Regresar"/>';
        } else {
            echo '<input type="button" class="btn btn-primary" onclick="cambiarContenidos(\'#contenidos\',\'Indicadores2.0/Lista_indicadores.php\');" value="Regresar"/>';
        }
        ?>
        <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Indicadores relacionados</h4>
                    </div>
                    <div class="modal-body" id="indicador">
                        <table id="tmodal" class="display table table-bordered">
                            <thead>
                                <tr>                                 
                                    <th>Descripción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $consulta = "SELECT
k_indicadores.IdIndicador,
k_indicadores.Descripcion,
c_aplicacion.Nombre as aplicacion
FROM
c_aplicacion 
INNER JOIN k_indicadores ON k_indicadores.IdAplicacion = c_aplicacion.IdAplicacion
WHERE c_aplicacion.IdAplicacion=$aplicacion";
                                $resultActividades = $catalogo->obtenerLista($consulta);
                                while ($rowActividades = mysqli_fetch_array($resultActividades)) {
                                    echo '<tr id="trFila">';
                                    echo'<td><a onclick=" ocualtar(\'#contenidos\',\'VistaIndicadores2.php?indicador=' . $rowActividades['IdIndicador'] . '&regreso=1&Periodo=' . $periodo . '\');">' . $rowActividades['Descripcion'] . ' </a></td>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">

                    <?php
                    $consulta = "SELECT Nombre,Ruta,`local` FROM c_aplicacion where IdAplicacion=$aplicacion";
                    $resultActividades = $catalogo->obtenerLista($consulta);
                    while ($rowActividades = mysqli_fetch_array($resultActividades)) {
                        $local = $rowActividades['local'];
                        if ($local == 0) {
                            echo' <button type="button" class="btn btn-default" data-dismiss="modal"><a href="' . $rowActividades['Ruta'] . '"></a>Mas información</button>';
                        } else {
                            echo' <button type="button" class="btn btn-default" data-dismiss="modal" onclick=app("#contenidos","' . $rowActividades['Ruta'] . '");>Mas información</button>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
