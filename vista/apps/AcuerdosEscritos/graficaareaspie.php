<?php
session_start();

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$accion = "";
$tipo = "";
$periodo = "";
$nombre = "";
$contador = 1;
$totalconvoca = 0;
$totalinvita = 0;
$totalrea = 0;
$totalnorea = 0;
$totalcancel = 0;
$id_eje = array(); // añadido
$categorias = array();
$realizado = array();
$norealizado = array();
$cancelado = array();
$invitados = array();
$total = array();
$titulo = "";
$AnioGraficaAreasEje="";

if ((isset($_GET['tipoPerfil']) && $_GET['tipoPerfil'] != "")) {
    $tipoPerfil = $_GET["tipoPerfil"];
} else {
    $tipoPerfil = '1';
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

if (isset($_GET['periodo']) && $_GET['periodo'] != "") { //Si trae Todos no se debe filtrar por año, pero si trae algo diferente se arma el WHERE
    $periodo=$_GET['periodo'];
    if ($_GET['periodo'] == "1") { $VarWhere= " "; }
    else { $VarWhere="AND pe.Periodo='".$periodo."' ";
    $AnioGraficaAreasEje = "'".$periodo."' "; 
}
}

if (isset($_GET['tipo']) && $_GET['tipo'] != "undefined") {
    $tipo = $_GET['tipo'];
    if($tipo == 9){
        $nombre = 'Área';
        $titulo = 'Total de acuerdos por ' . $nombre;
    }
}

if ((isset($_GET['eje']) && $_GET['eje'] != "")) {
    $valoreje = $_GET["eje"];
} else {
    $valoreje = '7';
}


//EXTRAEMOS EL ID Y NOMBRE DE USUARIO
$idUsuario = $_SESSION['user_session'];
$MiNomUsr="SinUsr";
$nombreUsuario = $MiNomUsr;
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="../../../resources/js/aplicaciones/AcuedosEscritos/Alta_acuerdo.js"></script>
</head>

<body>
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6" style="display:none">
                <table class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <?php
                            echo '<th>Acuerdos escritos por ' . $nombre . '</th>';
                            if ($tipo == 1) {
                                echo ' <th>Donde mi área convoca</th>';
                            } else {
                                echo ' <th>total por ' . $nombre . '</th>';
                            }
                            ?>
                            <?php if ($tipo == 1) echo ' <th>Donde mi área fue invitada</th>'; ?>
                            <th>Realizado</th>
                            <th>En proceso</th>
                            <th>Cancelado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $graficapie2 =array();
                        $totalgraficaareas="";
                        if ($tipo == 9) {
                            $areasporeje = "SELECT distinct a.id_area as idArea,a.Nombre AS nombre,
                                ( SELECT COUNT(*) FROM k_acuerdoactividad acu LEFT JOIN c_acuerdospdf a1 ON a1.id_acuerdo_escrito=acu.id_acuerdo LEFT JOIN c_periodo pe ON pe.Id_Periodo=a1.anio WHERE a1.id_area = a.Id_Area ".$VarWhere." AND acu.id_proyecto=".$valoreje.") AS convoca,
                                ( SELECT COUNT(*) FROM k_acuerdoactividad acu LEFT JOIN c_acuerdospdf a3 ON a3.id_acuerdo_escrito=acu.id_acuerdo LEFT JOIN c_periodo pe ON pe.Id_Periodo=a3.anio  WHERE a3.id_area = a.Id_Area AND acu.Id_acuerdoestatus = 2 ".$VarWhere." AND acu.id_proyecto=".$valoreje.") AS realizado,
                                ( SELECT COUNT(*) FROM k_acuerdoactividad acu LEFT JOIN c_acuerdospdf a4 ON a4.id_acuerdo_escrito=acu.id_acuerdo LEFT JOIN c_periodo pe ON pe.Id_Periodo=a4.anio  WHERE a4.id_area = a.Id_Area AND acu.Id_acuerdoestatus = 1 ".$VarWhere."  AND acu.id_proyecto=".$valoreje.") AS norealizado, 
                                ( SELECT COUNT(*) FROM k_acuerdoactividad acu LEFT JOIN c_acuerdospdf a4 ON a4.id_acuerdo_escrito=acu.id_acuerdo LEFT JOIN c_periodo pe ON pe.Id_Periodo=a4.anio  WHERE a4.id_area = a.Id_Area AND acu.Id_acuerdoestatus = 3 ".$VarWhere."  AND acu.id_proyecto=".$valoreje.") AS cancelado 
                            FROM c_area AS a
                            where a.tipoArea=1 AND a.estatus=1 
                            ORDER BY a.Nombre
                            limit 27";
                            //echo $areasporeje;
                            $resultareaseje = $catalogo->obtenerLista($areasporeje);
                            while ($rowareas = mysqli_fetch_array($resultareaseje)) {
                                array_push($categorias, $rowareas['nombre']);
                                array_push($total, $rowareas['convoca']);
                                array_push($cancelado, $rowareas['cancelado']);
                                array_push($realizado, $rowareas['realizado']);
                                array_push($norealizado, $rowareas['norealizado']);
                            if ($rowareas['convoca']==0) {

                            }else{
                            echo '<tr id="trFilaArea">';
                            echo '<td>'. $rowareas['nombre'] . '</td>';
                            if ($rowareas['convoca'] == '0') {
                                    echo '<td>' . $rowareas['convoca'] . '</td>';
                                    $totalconvoca = $totalconvoca + $rowareas['convoca'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&idArea='.$rowareas['idArea'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . $rowareas['convoca'] . '</a> </td>';
                                    $totalconvoca = $totalconvoca + $rowareas['convoca'];
                                }

                                if ($rowareas['realizado'] == '0') {
                                    echo '<td>' . $rowareas['realizado'] . '</td>';
                                    $totalrea = $totalrea + $rowareas['realizado'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&idArearealizado='.$rowareas['idArea'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . $rowareas['realizado'] . '</a> </td>';
                                    $totalrea = $totalrea + $rowareas['realizado'];
                                }

                                if ($rowareas['norealizado'] == '0') {
                                    echo '<td>' . $rowareas['norealizado'] . '</td>';
                                    $totalnorea = $totalnorea + $rowareas['norealizado'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&idAreanorealizado='.$rowareas['idArea'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . $rowareas['norealizado'] . '</a> </td>';
                                    $totalnorea = $totalnorea + $rowareas['norealizado'];
                                }

                                if ($rowareas['cancelado'] == '0') {
                                    echo '<td>' . $rowareas['cancelado'] . '</td>';
                                    $totalcancel = $totalcancel + $rowareas['cancelado'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&idAreanorealizado='.$rowareas['idArea'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . $rowareas['cancelado'] . '</a> </td>';
                                    $totalcancel = $totalcancel + $rowareas['cancelado'];
                                }
                            }
                            echo '</tr>';
                            if ($rowareas['convoca']==0) {
                                // code...
                            }else{
                                //$totalgraficaareas=$rowareas['convoca']+$rowareas['realizado']+$rowareas['norealizado']+$rowareas['cancelado'];
                                $totalgraficaareas=$rowareas['convoca'];
                                array_push($graficapie2,"{ name: '".$rowareas['nombre']."', y: ".$totalgraficaareas."},");
                            }
                            }

                            echo '<tr>';
                            echo '<th>Total</td>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . $totalconvoca . '</th>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&idAreainvitatotal=1&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . $totalinvita . '</th>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&idArearealizadototal=2&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . $totalrea . '</th>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&idAreanorealizadototal=1&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . $totalnorea . '</th>'; 
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&idAreacanceladototal=3&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . $totalcancel. '</th>'; 
                            echo '</tr>';                              
                        } 
                        ?>
                    </tbody>
                </table>
            </div>
            <div>
                <figure class="highcharts-figure">

                    <div id="container2"></div>
                </figure>
            </div>
        </div>
    </div>
</body>
<?php
$nombres = "";
for ($i = 0; $i < count($categorias); $i++) {
    $nombres = $nombres . "'" . $categorias[$i] . "'";
    if ($i + 1 < count($categorias)) {
        $nombres = $nombres . ",";
    }
}
$resultados = "";
for ($index = 0; $index < count($total); $index++) {
    $resultados = $resultados . $total[$index];
    if ($index + 1 < count($total)) {
        $resultados = $resultados . ",";
    }
}
$resultados2 = "";
for ($index = 0; $index < count($realizado); $index++) {
    $resultados2 = $resultados2 . $realizado[$index];
    if ($index + 1 < count($realizado)) {
        $resultados2 = $resultados2 . ",";
    }
}
$resultados3 = "";
for ($index = 0; $index < count($norealizado); $index++) {
    $resultados3 = $resultados3 . $norealizado[$index];
    if ($index + 1 < count($norealizado)) {
        $resultados3 = $resultados3 . ",";
    }
}

$resultados4 = "";
for ($index = 0; $index < count($cancelado); $index++) {
    $resultados4 = $resultados4 . $cancelado[$index];
    if ($index + 1 < count($cancelado)) {
        $resultados4 = $resultados4 . ",";
    }
}

?>

<script>
Highcharts.chart('container2', {
  chart: {
      type: 'pie',
  },
  title: {
      text: 'Área',
  },
  series: [{
      name: '',
      data: [
        <?php
          foreach ($graficapie2 as $clave => $valor) {
            echo  $valor;
          }
        ?>
      ]
  }]
});
</script>
</html>