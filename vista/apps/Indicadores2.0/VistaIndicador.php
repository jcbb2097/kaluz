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
$catalogo = new Catalogo();
$indicador = "";
$idIndicador = "";
$idindicador = array();
$objeto = array();
$Reporte = "";
$men2="";

if (isset($_GET['IndicadorArea']) && $_GET['IndicadorArea'] != "undefined") {
//echo $_GET['IndicadorArea'];
    $idIndicador = $_GET['IndicadorArea'];
    array_push($idindicador, $_GET['IndicadorArea']);
    $cadena_equipo = implode( $idindicador);
    $indicador= explode(",", $cadena_equipo);
 
} else if (isset($_GET['IndicadorArea']) && $_GET['IndicadorArea'] != "undefined") {

    $idIndicador = $_GET['IndicadorArea'];
} else if (isset($_GET['Reporte']) && $_GET['Reporte'] != "undefined") {

    $idIndicador = $_GET['Reporte'];
} else {

    $idIndicador = $_GET['Indicador'];
}
 
/*foreach ($idindicador as $key => $value) {
    echo$value;
}*/
/*for ($i = 0; $i < count($idindicador); $i++) {
    echo"hola";
}*/

$i=0;

    
 

 
  
if ($indicador!="") {
     for ($index = 0; $index < count($indicador); $index++) {
    $obj->setIdIndicador($indicador[$i]);
    $obj->getRegistro();
      
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
                $prueba= $row['series'];
                    if($prueba==""){
                        $prueba2='"$0';
                      }else{
                         $prueba2 = '"'.$prueba.'';
                    }
                $men2 = explode("$", $prueba2);
                echo '<tr>';
                echo '<td class="contenido_tabla"><font size="3">' . $row['datos'] . '</font></td>';
                echo '<td class="contenido_tabla" align="center"><font size="3">' . $prueba. '</font></td>';
                echo '</tr>';
                    $total = $total + $men2[1];
                }
            
            echo '<tr class="titulo_tabla" align="center">';
            echo '<td><font size="3">Total</font></td><td><font size="3">' . $total . '</font></td>';
            echo '</tr>';
            echo '</table></center>';

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
            break;
        case 5:
            //lineal
            $consulta = $obj->getQueryConsulta();
            $men = explode("?", $consulta);
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
            break;
        case 6:
            //tabla Pie
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


            echo'<div class="row">';
            echo'<div class="col-md-6 col-sm-6 col-xs-6" id="dTindicadores" style="display:block;">';
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
                echo '</tr>';
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


            echo'   </tbody>

                </table>
            </div> ';
            break;
        case 7:
            //tabla barras
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
            echo'<div class="row">';
            echo'<div class="col-md-6 col-sm-6 col-xs-6" id="dTindicadores" style="display:block;">';
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
                echo '</tr>';
            }


            echo'   </tbody>

                </table>
            </div> ';
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
            break;
        case 9:
            //piramide tablas
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


            echo'<div class="row">';
            echo'<div class="col-md-6 col-sm-6 col-xs-6" id="dTindicadores" style="display:block;">';
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
                echo '</tr>';
            }


            echo'   </tbody>

                </table>
            </div> ';
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
            case 9:
            //piramide tablas
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


            echo'<div class="row">';
            echo'<div class="col-md-6 col-sm-6 col-xs-6" id="dTindicadores" style="display:block;">';
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
                echo '</tr>';
            }


            echo'   </tbody>

                </table>
            </div> ';
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
       
                echo' <iframe id="scorm_object" src="'.$consulta.'" style="width:100%;height:708px;border:0;z-index:100"></iframe>';

            break;
    }
       $i++;
}
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- <link rel="stylesheet" href="resources/css/paginas/indicadores/indicadores.css">
        <script type="text/javascript" language="javascript" src="resources/js/paginas/indicadores/Carga.js" ></script> -->
        <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
        <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/indicadores.css" />
        <script src="../../../resources/js/aplicaciones/Indicadores/Carga.js"></script>
    </head>
    <body>

        <div id="container" style="min-width: 410px; max-width: 600px; height: 400px; margin: 0 auto"></div>
<?php
/*if (isset($_GET['regreso']) && $_GET['regreso'] == 1) {
    echo '<input type="button" class="btn btn-primary" onclick="cambiarContenidos(\'#contenidos\',\'Lista_indicadores.php\');" value="Regresar"/>';
} else {
    echo '<input type="button" class="btn btn-primary" onclick="cambiarContenidos(\'#contenidos\',\'Lista_indicadores.php\');" value="Regresar"/>';
}*/
?>

    </body>
</html>
