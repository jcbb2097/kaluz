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
$categoriasNumero = array();

$norealizado = array();

$invitados = array();
$total = array();

$realizado = array();
$enproceso = array();
$cancelado = array();
$atendido = array();
$sinrealizar = array();

$sinrealizarGrafica = array();

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
    if ($_GET['periodo'] == "Todos") { $VarWhere= " "; }
    else { $VarWhere="AND pe.Periodo='".$periodo."' ";
    $AnioGraficaAreasEje = "'".$periodo."' "; 
}
}

if (isset($_GET['tipo']) && $_GET['tipo'] != "undefined") {
    $tipo = $_GET['tipo'];
    if ($tipo == 1) {
        $nombre = 'Área';
        $titulo = 'Total de acuerdos por ' . $nombre;
    } elseif ($tipo == 2) {
        $nombre = 'Eje';
        $titulo = 'Total de acuerdos por ' . $nombre;
    } elseif ($tipo == 3) {
        $nombre = 'Año';
        $titulo = 'Total de acuerdos por ' . $nombre;
    } elseif($tipo == 4){
        $nombre = 'Exposición';
        $titulo = 'Total de acuerdos por ' . $nombre;
    } elseif($tipo == 5){
        $nombre = 'Acuerdo';
        $titulo = 'Total de acuerdos por ' . $nombre;
    } elseif($tipo == 6){
        $nombre = 'Documento';
        $titulo = 'Total de acuerdos por ' . $nombre;
    }  elseif($tipo == 7){
        $nombre = 'Receptor';
        $titulo = 'Total de acuerdos por ' . $nombre;
    }  elseif($tipo == 8){
        $nombre = 'Eje';
        $titulo = 'Total de acuerdos por ' . $nombre;
    } elseif($tipo == 9){
        $nombre = 'Área';
        $titulo = 'Total de acuerdos por ' . $nombre;
    } elseif($tipo == 10){
        $nombre = 'Emisor';
        $titulo = 'Total de acuerdos por ' . $nombre;
    }


}


//EXTRAEMOS EL ID Y NOMBRE DE USUARIO
$idUsuario = $_SESSION['user_session'];
$MiNomUsr="SinUsr";
$nombreUsuario = $MiNomUsr;
?>

<script>
    var MiTipoPerfil = '<?php echo $tipoPerfil; ?>';
    var MiIdUsr = '<?php echo $idUsuario; ?>';
    var MiNomUsr = '<?php echo $nombreUsuario; ?>';
    var MiAnioAct = '<?php echo $periodo; ?>';
</script>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <table class="table table-striped " style="width:100%; margin-top: -52.2px; margin-left: -15px;">
                  <thead class="thead-dark" style="background-color: #00000000; color: #ffffff;">
                        <tr>
                            <?php
                            if ($nombre != "Eje") {
                            echo '<th>' . $nombre . '</th>';
                          /*  if ($tipo == 1) {
                                echo ' <th>Emisor</th>';
                            } else {
                                echo ' <th> ' . $nombre . '</th>';
                            }*/
                            ?>     
                                <th>Total</th>                       
                                <th>Realizado</th>                               
                                <th>Atendido</th>
                                <th>En.proceso</th>
                                <th>Cancelado</th>
                                <th>Sin.realizar</th>
                            <?php }else if($tipo == "8") {?>
                                <th>Eje</th>
                                <th>Total</th>  
                                <th>Realizado</th>
                                <th>Atendido</th>
                                <th>En.proceso</th>
                                <th>Cancelado</th>
                                <th>Sin.realizar</th>
                            <?php } else {?>
                                <th>Total</th>  
                                <th>Realizado</th>
                                <th>Atendido</th>
                                <th>En.proceso</th>
                                <th>Cancelado</th>
                                <th>Sin realizar</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $graficapie1 =array();
                        $graficapie2 =array();
                        $contadorejes=1;
                        $contadorareas=0;
                        $numeracion=1;
                        $totalgraficaeje="";
                        $totalgraficaareas="";
                        if ($tipo == 1) {

                            $areas = "SELECT 
                                a.id_area as idArea,a.Nombre AS nombre,
                                ( SELECT COUNT(*) FROM k_acuerdoactividad acu LEFT JOIN c_acuerdospdf a1 ON a1.id_acuerdo_escrito=acu.id_acuerdo LEFT JOIN c_periodo pe ON pe.Id_Periodo=a1.anio WHERE a1.id_area = a.Id_Area ".$VarWhere.") AS convoca,
                                ( SELECT COUNT(*) FROM k_acuerdoactividad acu LEFT JOIN c_acuerdospdf a2 ON a2.id_acuerdo_escrito=acu.id_acuerdo JOIN k_acuerdoarea k ON k.id_Acuerdo=a2.id_acuerdo_escrito LEFT JOIN c_periodo pe ON pe.Id_Periodo=a2.anio WHERE k.id_Area_invitada = a.Id_Area ".$VarWhere.") AS invitada,
                                ( SELECT COUNT(*) FROM k_acuerdoactividad acu LEFT JOIN c_acuerdospdf a3 ON a3.id_acuerdo_escrito=acu.id_acuerdo LEFT JOIN c_periodo pe ON pe.Id_Periodo=a3.anio  WHERE a3.id_area = a.Id_Area AND acu.Id_acuerdoestatus = 2 ".$VarWhere.") AS realizado,
                                ( SELECT COUNT(*) FROM k_acuerdoactividad acu LEFT JOIN c_acuerdospdf a4 ON a4.id_acuerdo_escrito=acu.id_acuerdo LEFT JOIN c_periodo pe ON pe.Id_Periodo=a4.anio  WHERE a4.id_area = a.Id_Area AND acu.Id_acuerdoestatus = 1 ".$VarWhere.") AS enproceso,
                                ( SELECT COUNT(*) FROM k_acuerdoactividad acu LEFT JOIN c_acuerdospdf a4 ON a4.id_acuerdo_escrito=acu.id_acuerdo LEFT JOIN c_periodo pe ON pe.Id_Periodo=a4.anio  WHERE a4.id_area = a.Id_Area AND acu.Id_acuerdoestatus = 3 ".$VarWhere.") AS cancelado,
                                ( SELECT COUNT(*) FROM k_acuerdoactividad acu LEFT JOIN c_acuerdospdf a4 ON a4.id_acuerdo_escrito=acu.id_acuerdo LEFT JOIN c_periodo pe ON pe.Id_Periodo=a4.anio  WHERE a4.id_area = a.Id_Area AND acu.Id_acuerdoestatus = 4 ".$VarWhere.") AS atendido,
                                ( SELECT COUNT(*) FROM k_acuerdoactividad acu LEFT JOIN c_acuerdospdf a4 ON a4.id_acuerdo_escrito=acu.id_acuerdo LEFT JOIN c_periodo pe ON pe.Id_Periodo=a4.anio  WHERE a4.id_area = a.Id_Area AND acu.Id_acuerdoestatus = 5 ".$VarWhere.") AS sinrealizar
                            FROM c_area AS a
                            where ( SELECT COUNT(*) FROM k_acuerdoactividad acu LEFT JOIN c_acuerdospdf a1 ON a1.id_acuerdo_escrito=acu.id_acuerdo LEFT JOIN c_periodo pe ON pe.Id_Periodo=a1.anio WHERE a1.id_area = a.Id_Area ".$VarWhere.") > 0
                            ORDER BY convoca desc";
                            //echo$areas;
                            $resultareas = $catalogo->obtenerLista($areas);
                            while ($rowareas = mysqli_fetch_array($resultareas)) {
                                array_push($categorias, $rowareas['nombre']);                             
                                array_push($total, $rowareas['convoca']);
                                array_push($realizado, $rowareas['realizado']);
                                array_push($enproceso, $rowareas['enproceso']);
                                array_push($cancelado, $rowareas['cancelado']);
                                array_push($atendido, $rowareas['atendido']);
                                array_push($sinrealizar, $rowareas['sinrealizar']);
                                array_push($sinrealizarGrafica, $rowareas['convoca'] - $rowareas['realizado']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['nombre'] . '</td>';
                                //recorre el while y valida si esta en 0 no crea el href
                                if ($rowareas['convoca'] == '0') {
                                    echo '<td>' . $rowareas['convoca'] . '</td>';
                                  //  $totalconvoca = $totalconvoca + $rowareas['convoca'];                                  
                                } else {
                                    $numeroAcuerdos = $rowareas['convoca'];
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowareas['idArea'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=todos&indicador=areas">' . $rowareas['convoca'] . '</a> </td>';
                                   // $totalconvoca = $totalconvoca + $rowareas['convoca'];
                                }

                                if ($rowareas['realizado'] == '0') {
                                    echo '<td>' . $rowareas['realizado'] . '</td>';
                                 //  $totalinvita = $totalinvita + $rowareas['invitada'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowareas['idArea'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=realizado&indicador=areas">' . $rowareas['realizado'] . '</a> </td>';
                                  //  $totalinvita = $totalinvita + $rowareas['invitada'];
                                }                  

                                if ($rowareas['atendido'] == '0') {
                                    echo '<td>' . $rowareas['atendido'] . '</td>';
                                  //  $totalnorea = $totalnorea + $rowareas['atendido'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowareas['idArea'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=atendido&indicador=areas">' . $rowareas['atendido'] . '</a> </td>';
                                  //  $totalnorea = $totalnorea + $rowareas['atendido'];
                                }

                                if ($rowareas['enproceso'] == '0') {
                                    echo '<td>' . $rowareas['enproceso'] . '</td>';
                                 //   $totalrea = $totalrea + $rowareas['realizado'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowareas['idArea'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=enproceso&indicador=areas">' . $rowareas['enproceso'] . '</a> </td>';
                                   // $totalrea = $totalrea + $rowareas['realizado'];
                                }

                                if ($rowareas['cancelado'] == '0') {
                                    echo '<td>' . $rowareas['cancelado'] . '</td>';
                                  //  $totalcancel = $totalcancel + $rowareas['cancelado'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowareas['idArea'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=cancelado&indicador=areas">' . $rowareas['cancelado'] . '</a> </td>';
                                  //  $totalcancel = $totalcancel + $rowareas['cancelado'];
                                }

                                if ($rowareas['sinrealizar'] == '0') {
                                    echo '<td>' . $rowareas['sinrealizar'] . '</td>';
                                   // $totalcancel = $totalcancel + $rowareas['sinrealizar'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowareas['idArea'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=sinrealizar&indicador=areas">' . $rowareas['sinrealizar'] . '</a> </td>';
                                  //  $totalcancel = $totalcancel + $rowareas['sinrealizar'];
                                }

                                echo '</tr>';
                                $contador++;
                            }
                            echo '<tr>';
                            echo '<th>Total</td>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($total) . '</th>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&idAreainvitatotal=1&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($realizado) . '</th>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&idAreanorealizadototal=1&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($atendido)  . '</th>'; 
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&idArearealizadototal=2&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($enproceso) . '</th>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&idAreacanceladototal=3&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($cancelado). '</th>'; 
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&idAreacanceladototal=3&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($sinrealizar). '</th>'; 
                            echo '</tr>';
                        } elseif ($tipo == 2) {
                            $ejes = "SELECT e.idEje as idEje, e.Nombre as nombre,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio 
                            WHERE acu.id_proyecto = e.idEje ".$VarWhere.") AS concoca,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                            WHERE acu.Id_acuerdoestatus=2 AND acu.id_proyecto = e.idEje ".$VarWhere.") AS realizado,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                            WHERE acu.Id_acuerdoestatus=1 AND acu.id_proyecto = e.idEje ".$VarWhere.") AS enproceso,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                            WHERE acu.Id_acuerdoestatus=3 AND acu.id_proyecto = e.idEje ".$VarWhere.") AS cancelado,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio
                            WHERE acu.Id_acuerdoestatus=4 AND acu.id_proyecto = e.idEje ".$VarWhere.") AS atendido,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio
                            WHERE acu.Id_acuerdoestatus=5 AND acu.id_proyecto = e.idEje ".$VarWhere.") AS sinrealizar
                            FROM c_eje as e 
                            ORDER BY e.idEje ASC";
                            $resultejes = $catalogo->obtenerLista($ejes);
                            $numeroAcuerdos = "0";
                            while ($rowejes = mysqli_fetch_array($resultejes)) {

                                echo '<tr id="trFila" style="height: 53px;">';
                                array_push($id_eje, $rowejes['idEje']); //añadido
                                array_push($categorias, $rowejes['nombre']);
                                array_push($categoriasNumero, $rowejes['idEje'] . " - " . $rowejes['nombre']);
                                array_push($cancelado, $rowejes['cancelado']);
                                array_push($enproceso, $rowejes['enproceso']);
                                array_push($realizado, $rowejes['realizado']);
                                array_push($atendido, $rowejes['atendido']);
                                array_push($sinrealizar, $rowejes['sinrealizar']);
                                array_push($sinrealizarGrafica, $rowejes['concoca'] - $rowejes['realizado']);
                                array_push($total, $rowejes['concoca']);
                                if ($nombre != "Eje") {
                                    echo '<td>' . $rowejes['idEje'] . '. ' . $rowejes['nombre'] . '</td>';
                                }
                               
                                //recorre el while y valida si esta en 0 no crea el href
                                if ($rowejes['concoca'] == '0') {
                                    echo '<td> ' . $rowejes['concoca'] . '</td>';
                                  //  $totalconvoca = $totalconvoca + $rowejes['concoca'];
                                } else {
                                    
                                    $numeroAcuerdos = $rowejes['concoca'];
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid='.$rowejes['idEje'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=todos">' . $rowejes['concoca'] . '</a> </td>';
                                  //  $totalconvoca = $totalconvoca + $rowejes['concoca'];
                                }

                                if ($rowejes['realizado'] == '0') {
                                    echo '<td> ' . $rowejes['realizado'] . '</td>';
                                 //   $totalrea = $totalrea + $rowejes['realizado'];
                                } else {
                                    echo '<td>  <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid='.$rowejes['idEje'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=realizado">' . $rowejes['realizado'] . '</a> </td>';
                                 //   $totalrea = $totalrea + $rowejes['realizado'];
                                }                            

                                if ($rowejes['atendido'] == '0') {
                                    echo '<td> ' . $rowejes['atendido'] . '</td>';
                                  //  $totalatendido = $totalatendido + $rowejes['atendido'];
                                } else {
                                    echo '<td>  <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid='.$rowejes['idEje'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=atendido">' . $rowejes['atendido'] . '</a> </td>';
                                  //  $totalatendido = $totalatendido + $rowejes['atendido'];
                                }

                                if ($rowejes['enproceso'] == '0') {
                                    echo '<td> ' . $rowejes['enproceso'] . '</td>';
                                  //  $totalnorea = $totalnorea + $rowejes['enproceso'];
                                } else {
                                    echo '<td>  <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid='.$rowejes['idEje'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=enproceso">' . $rowejes['enproceso'] . '</a> </td>';
                                  //  $totalnorea = $totalnorea + $rowejes['enproceso'];
                                }

                                if ($rowejes['cancelado'] == '0') {
                                    echo '<td> ' . $rowejes['cancelado'] . '</td>';
                                  //  $totalcancel = $totalcancel + $rowejes['cancelado'];
                                } else {
                                    echo '<td>  <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid='.$rowejes['idEje'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=cancelado">' . $rowejes['cancelado'] . '</a> </td>';
                                  //  $totalcancel = $totalcancel + $rowejes['cancelado'];
                                }

                               

                                if ($rowejes['sinrealizar'] == '0') {
                                    echo '<td> ' . $rowejes['sinrealizar'] . '</td>';
                                  //  $totalsreal = $totalsreal + $rowejes['sinrealizar'];
                                } else {
                                    echo '<td>  <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid='.$rowejes['idEje'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=sinrealizar">' . $rowejes['sinrealizar'] . '</a> </td>';
                                  //  $totalsreal = $totalsreal + $rowejes['sinrealizar'];
                                }

                                echo '</tr>';
                            }
                            
                            echo '<tr style="height: 35px;">'; //añadido
                                echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid=todos&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=todos">' . array_sum($total) . '</a> </th>';
                                echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid=todos&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=realizado">' . array_sum($realizado) . '</a> </th>';
                                echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid=todos&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=atendido">' . array_sum($atendido) . '</a> </th>';
                                echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid=todos&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=enproceso">' . array_sum($enproceso) . '</a> </th>';
                                
                                echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid=todos&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=cancelado">' . array_sum($cancelado) . '</a> </th>';
                                echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid=todos&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=sinrealizar">' . array_sum($sinrealizar) . '</a> </th>';
                            echo '</tr>';
                            
                            
                        } elseif ($tipo == 3) {
                            $act = "SELECT
                                pe.Id_Periodo as Id_Periodo, pe.Periodo AS nombre,
                                ( SELECT COUNT( acu.id_acuerdo_escrito ) FROM c_acuerdospdf AS acu WHERE acu.anio = pe.Id_Periodo ) AS concoca,
                                ( SELECT COUNT( id_acuerdo_escrito ) FROM c_acuerdospdf AS p JOIN k_acuerdoactividad a1 ON a1.id_acuerdo=p.id_acuerdo_escrito WHERE p.anio = pe.Id_Periodo AND a1.Id_acuerdoestatus = 2 ) AS realizado,
                                ( SELECT COUNT( id_acuerdo_escrito ) FROM c_acuerdospdf AS p JOIN k_acuerdoactividad a1 ON a1.id_acuerdo=p.id_acuerdo_escrito WHERE p.anio = pe.Id_Periodo AND a1.Id_acuerdoestatus = 1 ) AS enproceso, 
                                ( SELECT COUNT( id_acuerdo_escrito ) FROM c_acuerdospdf AS p JOIN k_acuerdoactividad a1 ON a1.id_acuerdo=p.id_acuerdo_escrito WHERE p.anio = pe.Id_Periodo AND a1.Id_acuerdoestatus = 3 ) AS cancelado,
                                ( SELECT COUNT( id_acuerdo_escrito ) FROM c_acuerdospdf AS p JOIN k_acuerdoactividad a1 ON a1.id_acuerdo=p.id_acuerdo_escrito WHERE p.anio = pe.Id_Periodo AND a1.Id_acuerdoestatus = 4 ) AS atendido,
                                ( SELECT COUNT( id_acuerdo_escrito ) FROM c_acuerdospdf AS p JOIN k_acuerdoactividad a1 ON a1.id_acuerdo=p.id_acuerdo_escrito WHERE p.anio = pe.Id_Periodo AND a1.Id_acuerdoestatus = 5 ) AS sinrealizar
                                FROM c_periodo AS pe 
                                WHERE 1 ".$VarWhere." and pe.Periodo > 2012 and pe.Periodo < 2023
                                ORDER BY pe.Periodo desc";
                                $resultexpo = $catalogo->obtenerLista($act);
                                while ($rowejes = mysqli_fetch_array($resultexpo)) {

                                echo '<tr id="trFila">';
                                array_push($categorias, $rowejes['nombre']);
                                array_push($enproceso, $rowejes['enproceso']);
                                array_push($realizado, $rowejes['realizado']);
                                array_push($cancelado, $rowejes['cancelado']);
                                array_push($total, $rowejes['concoca']);
                                array_push($atendido, $rowejes['atendido']);
                                array_push($sinrealizar, $rowejes['sinrealizar']);
                                array_push($sinrealizarGrafica, $rowejes['concoca'] - $rowejes['realizado']);
                                echo '<td>' . $rowejes['nombre'] . '</td>';

                                //recorre el while y valida si esta en 0 no crea el href
                                if ($rowejes['concoca'] == '0') {
                                    echo '<td>' . $rowejes['concoca'] . '</td>';
                                  //  $totalconvoca = $totalconvoca + $rowejes['concoca'];
                                } else {
                                    $numeroAcuerdos = $rowejes['concoca'];
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['Id_Periodo'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=todos&indicador=anio">' . $rowejes['concoca'] . '</a> </td>';
                                  //  $totalconvoca = $totalconvoca + $rowejes['concoca'];
                                }

                                if ($rowejes['realizado'] == '0') {
                                    echo '<td>' . $rowejes['realizado'] . '</td>';
                                  //  $totalrea = $totalrea + $rowejes['realizado'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['Id_Periodo'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=realizado&indicador=anio">' . $rowejes['realizado'] . '</a> </td>';
                                  //  $totalrea = $totalrea + $rowejes['realizado'];
                                }

                                if ($rowejes['atendido'] == '0') {
                                    echo '<td>' . $rowejes['atendido'] . '</td>';
                                 //   $totalcancel = $totalcancel + $rowejes['cancelado'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['Id_Periodo'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=atendido&indicador=anio">' . $rowejes['atendido'] . '</a> </td>';
                                 //   $totalcancel = $totalcancel + $rowejes['cancelado'];
                                }

                                if ($rowejes['enproceso'] == '0') {
                                    echo '<td>' . $rowejes['enproceso'] . '</td>';
                                  //  $totalnorea = $totalnorea + $rowejes['norealizado'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['Id_Periodo'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=enproceso&indicador=anio">' . $rowejes['enproceso'] . '</a> </td>';
                                  //  $totalnorea = $totalnorea + $rowejes['norealizado'];
                                }                             

                                if ($rowejes['cancelado'] == '0') {
                                    echo '<td>' . $rowejes['cancelado'] . '</td>';
                                 //   $totalcancel = $totalcancel + $rowejes['cancelado'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['Id_Periodo'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=cancelado&indicador=anio">' . $rowejes['cancelado'] . '</a> </td>';
                                 //   $totalcancel = $totalcancel + $rowejes['cancelado'];
                                }

                                if ($rowejes['sinrealizar'] == '0') {
                                    echo '<td>' . $rowejes['sinrealizar'] . '</td>';
                                 //   $totalcancel = $totalcancel + $rowejes['cancelado'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['Id_Periodo'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=sinrealizar&indicador=anio">' . $rowejes['sinrealizar'] . '</a> </td>';
                                 //   $totalcancel = $totalcancel + $rowejes['cancelado'];
                                }
                                echo '</tr>';
                            }
                            echo '<tr>';
                            echo '<th>Total</td>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($total) . '</th>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&anototalrealizados=2&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($realizado) . '</th>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&anototalcancelado=3&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($atendido) . '</th>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&anototalnorealizados=1&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($enproceso) . '</th>'; 
                             
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&anototalcancelado=3&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($cancelado) . '</th>'; 
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&anototalcancelado=3&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($sinrealizar) . '</th>'; 
                            echo '</tr>';
                        } else if($tipo == 4) {
                            $expo = "SELECT e.idExposicion as idExposicion, CONCAT(e.anio,' - ',e.tituloFinal) AS nombre,
                            (SELECT COUNT( acu.id_proyecto ) FROM k_acuerdoactividad AS acu LEFT JOIN c_acuerdospdf AS p ON p.id_acuerdo_escrito=acu.id_acuerdo LEFT JOIN c_periodo pe ON pe.Id_Periodo=p.anio WHERE acu.id_exposicion = e.idExposicion ".$VarWhere.") AS concoca,
                            (SELECT COUNT( id_acuerdo_escrito ) FROM k_acuerdoactividad AS c LEFT JOIN c_acuerdospdf AS p ON p.id_acuerdo_escrito=c.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=p.anio 
                            WHERE c.Id_acuerdoestatus = 2 AND c.id_acuerdo = p.id_acuerdo_escrito AND c.id_exposicion = e.idExposicion ".$VarWhere.") AS realizado,
                            (SELECT COUNT( id_acuerdo_escrito) FROM k_acuerdoactividad AS c LEFT JOIN c_acuerdospdf AS p ON p.id_acuerdo_escrito=c.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=p.anio 
                            WHERE c.Id_acuerdoestatus = 1 AND c.id_acuerdo = p.id_acuerdo_escrito AND c.id_exposicion = e.idExposicion ".$VarWhere.") AS enproceso,
                            (SELECT COUNT( id_acuerdo_escrito) FROM k_acuerdoactividad AS c LEFT JOIN c_acuerdospdf AS p ON p.id_acuerdo_escrito=c.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=p.anio 
                            WHERE c.Id_acuerdoestatus = 3 AND c.id_acuerdo = p.id_acuerdo_escrito AND c.id_exposicion = e.idExposicion ".$VarWhere.") AS cancelado,
                            (SELECT COUNT( id_acuerdo_escrito) FROM k_acuerdoactividad AS c LEFT JOIN c_acuerdospdf AS p ON p.id_acuerdo_escrito=c.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=p.anio 
                            WHERE c.Id_acuerdoestatus = 3 AND c.id_acuerdo = p.id_acuerdo_escrito AND c.id_exposicion = e.idExposicion ".$VarWhere.") AS atendido,
                            (SELECT COUNT( id_acuerdo_escrito) FROM k_acuerdoactividad AS c LEFT JOIN c_acuerdospdf AS p ON p.id_acuerdo_escrito=c.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=p.anio 
                            WHERE c.Id_acuerdoestatus = 3 AND c.id_acuerdo = p.id_acuerdo_escrito AND c.id_exposicion = e.idExposicion ".$VarWhere.") AS sinrealizar 
                            FROM c_exposicionTemporal AS e 
                            where (SELECT COUNT( acu.id_proyecto ) FROM k_acuerdoactividad AS acu LEFT JOIN c_acuerdospdf AS p ON p.id_acuerdo_escrito=acu.id_acuerdo LEFT JOIN c_periodo pe ON pe.Id_Periodo=p.anio WHERE acu.id_exposicion = e.idExposicion ".$VarWhere.") > 0
                            ORDER BY e.anio desc";
                            $resultexpo = $catalogo->obtenerLista($expo);
                            while ($rowejes = mysqli_fetch_array($resultexpo)) {

                                echo '<tr id="trFila">';
                                array_push($categorias, $rowejes['nombre']);
                                array_push($enproceso, $rowejes['enproceso']);
                                array_push($realizado, $rowejes['realizado']);
                                array_push($cancelado, $rowejes['cancelado']);
                                array_push($total, $rowejes['concoca']);
                                array_push($atendido, $rowejes['atendido']);
                                array_push($sinrealizar, $rowejes['sinrealizar']);
                                array_push($sinrealizarGrafica, $rowejes['concoca'] - $rowejes['realizado']);
                                echo '<td>' . $rowejes['nombre'] . '</td>';
                                
                                //recorre el while y valida si esta en 0 no crea el href
                                if ($rowejes['concoca'] == '0') {
                                    echo '<td>' . $rowejes['concoca'] . '</td>';
                                } else {
                                    $numeroAcuerdos = $rowejes['concoca'];
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['idExposicion'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=todos&indicador=expo">' . $rowejes['concoca'] . '</a> </td>';
                                   
                                }

                                if ($rowejes['realizado'] == '0') {
                                    echo '<td>' . $rowejes['realizado'] . '</td>';
                                   
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['idExposicion'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=realizado&indicador=expo">' . $rowejes['realizado'] . '</a> </td>';
                                   
                                }                            

                                if ($rowejes['atendido'] == '0') {
                                    echo '<td>' . $rowejes['atendido'] . '</td>';
                                  
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['idExposicion'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=atendido&indicador=expo">' . $rowejes['atendido'] . '</a> </td>';
                                   
                                }

                                if ($rowejes['enproceso'] == '0') {
                                    echo '<td>' . $rowejes['enproceso'] . '</td>';
                                  
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['idExposicion'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=enproceso&indicador=expo">' . $rowejes['enproceso'] . '</a> </td>';
                                  
                                }

                                if ($rowejes['cancelado'] == '0') {
                                    echo '<td>' . $rowejes['cancelado'] . '</td>';
                                  
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['idExposicion'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=cancelado&indicador=expo">' . $rowejes['cancelado'] . '</a> </td>';
                                   
                                }

                                if ($rowejes['sinrealizar'] == '0') {
                                    echo '<td>' . $rowejes['sinrealizar'] . '</td>';
                                  
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['idExposicion'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=sinrealizar&indicador=expo">' . $rowejes['sinrealizar'] . '</a> </td>';
                                 
                                }
                                echo '</tr>';
                            }
                            echo '<tr>';
                            echo '<th>Total</td>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&exposiciontotal=1&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($total) . '</th>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&exposiciontotalrealizado=2&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($realizado) . '</th>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&exposiciontotalcancelado=3&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($atendido) . '</th>'; 
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&exposiciontotalnorealizado=1&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($enproceso) . '</th>'; 
                           
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&exposiciontotalcancelado=3&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($cancelado) . '</th>'; 
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&exposiciontotalcancelado=3&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($sinrealizar) . '</th>'; 
                            echo '</tr>';
                        } elseif ($tipo == 5) {
                            $act = "SELECT e.TipoAcuerdo as TipoAcuerdo,
                            (SELECT COUNT( * ) FROM k_acuerdoactividad AS acu LEFT JOIN c_acuerdospdf AS p ON p.id_acuerdo_escrito=acu.id_acuerdo LEFT JOIN c_periodo pe ON pe.Id_Periodo=p.anio WHERE acu.TipoAcuerdo=e.TipoAcuerdo ".$VarWhere.") AS concoca,
                            (SELECT COUNT( * ) FROM k_acuerdoactividad AS c LEFT JOIN c_acuerdospdf AS p ON p.id_acuerdo_escrito=c.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=p.anio 
                            WHERE c.Id_acuerdoestatus = 2 AND c.id_acuerdo = p.id_acuerdo_escrito AND c.TipoAcuerdo=e.TipoAcuerdo ".$VarWhere.") AS realizado,
                            (SELECT COUNT( *) FROM k_acuerdoactividad AS c LEFT JOIN c_acuerdospdf AS p ON p.id_acuerdo_escrito=c.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=p.anio 
                            WHERE c.Id_acuerdoestatus = 1 AND c.id_acuerdo = p.id_acuerdo_escrito AND c.TipoAcuerdo=e.TipoAcuerdo ".$VarWhere.") AS enproceso,
                            (SELECT COUNT( *) FROM k_acuerdoactividad AS c LEFT JOIN c_acuerdospdf AS p ON p.id_acuerdo_escrito=c.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=p.anio 
                            WHERE c.Id_acuerdoestatus = 3 AND c.id_acuerdo = p.id_acuerdo_escrito AND c.TipoAcuerdo=e.TipoAcuerdo ".$VarWhere.") AS cancelado,
                            (SELECT COUNT( *) FROM k_acuerdoactividad AS c LEFT JOIN c_acuerdospdf AS p ON p.id_acuerdo_escrito=c.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=p.anio 
                            WHERE c.Id_acuerdoestatus = 4 AND c.id_acuerdo = p.id_acuerdo_escrito AND c.TipoAcuerdo=e.TipoAcuerdo ".$VarWhere.") AS atendido,
                            (SELECT COUNT( *) FROM k_acuerdoactividad AS c LEFT JOIN c_acuerdospdf AS p ON p.id_acuerdo_escrito=c.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=p.anio 
                            WHERE c.Id_acuerdoestatus = 5 AND c.id_acuerdo = p.id_acuerdo_escrito AND c.TipoAcuerdo=e.TipoAcuerdo ".$VarWhere.") AS sinrealizar
                            FROM k_acuerdoactividad AS e 
                            WHERE !ISNULL(TipoAcuerdo)
                            GROUP BY TipoAcuerdo
                            ORDER BY TipoAcuerdo";
                            $resultexpo = $catalogo->obtenerLista($act);
                            while ($rowejes = mysqli_fetch_array($resultexpo)) {

                                echo '<tr id="trFila">';
                                array_push($categorias, $rowejes['TipoAcuerdo']);
                                array_push($enproceso, $rowejes['enproceso']);
                                array_push($realizado, $rowejes['realizado']);
                                array_push($cancelado, $rowejes['cancelado']);
                                array_push($total, $rowejes['concoca']);
                                array_push($atendido, $rowejes['atendido']);
                                array_push($sinrealizar, $rowejes['sinrealizar']);
                                array_push($sinrealizarGrafica, $rowejes['concoca'] - $rowejes['realizado']);
                                echo '<td>' . $rowejes['TipoAcuerdo'] . '</td>';

                                //recorre el while y valida si esta en 0 no crea el href
                                if ($rowejes['concoca'] == '0') {
                                    echo '<td>' . $rowejes['concoca'] . '</td>';
                                   
                                } else {
                                    $numeroAcuerdos = $rowejes['concoca'];
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['TipoAcuerdo'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=todos&indicador=acuerdo">' . $rowejes['concoca'] . '</a> </td>';
                                    
                                }

                                if ($rowejes['realizado'] == '0') {
                                    echo '<td>' . $rowejes['realizado'] . '</td>';
                                 
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['TipoAcuerdo'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=realizado&indicador=acuerdo">' . $rowejes['realizado'] . '</a> </td>';
                                 
                                }

                                if ($rowejes['atendido'] == '0') {
                                    echo '<td>' . $rowejes['atendido'] . '</td>';
                                   
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['TipoAcuerdo'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=atendido&indicador=acuerdo">' . $rowejes['atendido'] . '</a> </td>';
                                   
                                }

                                if ($rowejes['enproceso'] == '0') {
                                    echo '<td>' . $rowejes['enproceso'] . '</td>';
                                   
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['TipoAcuerdo'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=enproceso&indicador=acuerdo">' . $rowejes['enproceso'] . '</a> </td>';
                                  
                                }                             

                                if ($rowejes['cancelado'] == '0') {
                                    echo '<td>' . $rowejes['cancelado'] . '</td>';
                                   
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['TipoAcuerdo'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=cancelado&indicador=acuerdo">' . $rowejes['cancelado'] . '</a> </td>';
                                   
                                }
                                if ($rowejes['sinrealizar'] == '0') {
                                    echo '<td>' . $rowejes['sinrealizar'] . '</td>';
                                   
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['TipoAcuerdo'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=sinrealizar&indicador=acuerdo">' . $rowejes['sinrealizar'] . '</a> </td>';
                                    
                                }
                                echo '</tr>';
                            }
                            echo '<tr>';
                            echo '<th>Total</td>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&TipoAcuerdototal=1&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($total) . '</th>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&TipoAcuerdototalrealizados=2&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($realizado) . '</th>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&TipoAcuerdototalcancelado=3&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($atendido) . '</th>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&TipoAcuerdototalnorealizados=1&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($enproceso) . '</th>'; 
                             
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&TipoAcuerdototalcancelado=3&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($cancelado) . '</th>'; 
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&TipoAcuerdototalcancelado=3&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($sinrealizar) . '</th>'; 
                            echo '</tr>';
                        } elseif ($tipo == 6) {
                            $act = "SELECT td.id_tipo as IdTipoDoc, td.tipo as nombre,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio
                            WHERE a.id_tipo = td.id_tipo ".$VarWhere.") AS concoca,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                            WHERE acu.Id_acuerdoestatus=2 AND a.id_tipo = td.id_tipo ".$VarWhere.") AS realizado,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                            WHERE acu.Id_acuerdoestatus=1 AND a.id_tipo = td.id_tipo ".$VarWhere.") AS enproceso, 
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                            WHERE acu.Id_acuerdoestatus=3 AND a.id_tipo = td.id_tipo ".$VarWhere.") AS cancelado,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                            WHERE acu.Id_acuerdoestatus=4 AND a.id_tipo = td.id_tipo ".$VarWhere.") AS atendido,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                            WHERE acu.Id_acuerdoestatus=5 AND a.id_tipo = td.id_tipo ".$VarWhere.") AS sinrealizar
                            FROM c_tipo_documento as td
                            WHERE td.id_tipo IN (1,2)
                            ORDER BY td.id_tipo ASC";
                            $resultexpo = $catalogo->obtenerLista($act);
                            while ($rowejes = mysqli_fetch_array($resultexpo)) {

                                echo '<tr id="trFila">';
                                array_push($categorias, $rowejes['nombre']);
                                array_push($enproceso, $rowejes['enproceso']);
                                array_push($realizado, $rowejes['realizado']);
                                array_push($cancelado, $rowejes['cancelado']);
                                array_push($total, $rowejes['concoca']);
                                array_push($atendido, $rowejes['atendido']);
                                array_push($sinrealizar, $rowejes['sinrealizar']);
                                array_push($sinrealizarGrafica, $rowejes['concoca'] - $rowejes['realizado']);
                                echo '<td>' . $rowejes['nombre'] . '</td>';

                                //recorre el while y valida si esta en 0 no crea el href
                                if ($rowejes['concoca'] == '0') {
                                    echo '<td>' . $rowejes['concoca'] . '</td>';
                                   
                                } else {
                                    $numeroAcuerdos = $rowejes['concoca'];
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['IdTipoDoc'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=todos&indicador=documento">' . $rowejes['concoca'] . '</a> </td>';
                                  
                                }

                                if ($rowejes['realizado'] == '0') {
                                    echo '<td>' . $rowejes['realizado'] . '</td>';
                                  
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['IdTipoDoc'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=realizado&indicador=documento">' . $rowejes['realizado'] . '</a> </td>';
                                  
                                }
                               
                                if ($rowejes['atendido'] == '0') {
                                    echo '<td>' . $rowejes['atendido'] . '</td>';
                                   
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['IdTipoDoc'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=atendido&indicador=documento">' . $rowejes['atendido'] . '</a> </td>';
                                  
                                }

                                if ($rowejes['enproceso'] == '0') {
                                    echo '<td>' . $rowejes['enproceso'] . '</td>';
                                   
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['IdTipoDoc'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=enproceso&indicador=documento">' . $rowejes['enproceso'] . '</a> </td>';
                                  
                                }

                                if ($rowejes['cancelado'] == '0') {
                                    echo '<td>' . $rowejes['cancelado'] . '</td>';
                                  
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['IdTipoDoc'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=cancelado&indicador=documento">' . $rowejes['cancelado'] . '</a> </td>';
                                  
                                }

                                if ($rowejes['sinrealizar'] == '0') {
                                    echo '<td>' . $rowejes['sinrealizar'] . '</td>';
                                 
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&ejeid='.$rowejes['IdTipoDoc'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=sinrealizar&indicador=documento">' . $rowejes['sinrealizar'] . '</a> </td>';
                                    
                                }
                                echo '</tr>';
                            }
                            echo '<tr>';
                            echo '<th>Total</td>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&TipoDocumentototal=1&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($total) . '</th>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&TipoDocumentototalrealizados=2&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($realizado) . '</th>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&TipoDocumentototalcancelado=3&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($atendido) . '</th>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&TipoDocumentototalnorealizados=1&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($enproceso) . '</th>'; 
                            
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&TipoDocumentototalcancelado=3&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($cancelado) . '</th>';
                            echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&TipoDocumentototalcancelado=3&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($sinrealizar) . '</th>';
                            echo '</tr>';
                        }  elseif ($tipo == 7) {
                           $ejes = "SELECT res.id_Personas as idPersona, CONCAT(res.Nombre,' ',res.Apellido_Paterno,' ',res.Apellido_Materno) as nombre,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio 
                            WHERE acu.Id_persona = res.id_Personas ".$VarWhere.") AS concoca,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                            WHERE acu.Id_acuerdoestatus=2 AND acu.Id_persona = res.id_Personas ".$VarWhere.") AS realizado,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                            WHERE acu.Id_acuerdoestatus=1 AND acu.Id_persona = res.id_Personas ".$VarWhere.") AS enproceso,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                            WHERE acu.Id_acuerdoestatus=3 AND acu.Id_persona = res.id_Personas ".$VarWhere.") AS cancelado,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                            WHERE acu.Id_acuerdoestatus=4 AND acu.Id_persona = res.id_Personas ".$VarWhere.") AS atendido,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                            WHERE acu.Id_acuerdoestatus=5 AND acu.Id_persona = res.id_Personas ".$VarWhere.") AS sinrealizar
                            FROM c_personas as res 
                            JOIN c_rolPersona rp ON res.id_Personas=rp.id_Persona
                            WHERE rp.id_Rol=148 and (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio 
                            WHERE acu.Id_persona = res.id_Personas ".$VarWhere.") > 0
                            ORDER BY concoca desc";
                            //echo $ejes;
                            $resultejes = $catalogo->obtenerLista($ejes);
                            while ($rowejes = mysqli_fetch_array($resultejes)) {

                                echo '<tr id="trFila">';
                                array_push($id_eje, $rowejes['idPersona']); //añadido
                                array_push($categorias, $rowejes['nombre']);
                                array_push($cancelado, $rowejes['cancelado']);
                                array_push($enproceso, $rowejes['enproceso']);
                                array_push($realizado, $rowejes['realizado']);
                                array_push($total, $rowejes['concoca']);
                                array_push($atendido, $rowejes['atendido']);
                                array_push($sinrealizar, $rowejes['sinrealizar']);
                                array_push($sinrealizarGrafica, $rowejes['concoca'] - $rowejes['realizado']);
                                echo '<td>' . $rowejes['nombre'] . '</td>';
                                //recorre el while y valida si esta en 0 no crea el href
                                if ($rowejes['concoca'] == '0') {
                                    echo '<td>' . $rowejes['concoca'] . '</td>';
                                   
                                } else {
                                    $numeroAcuerdos = $rowejes['concoca'];
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid='.$rowejes['idPersona'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=todos&indicador=receptor">' . $rowejes['concoca'] . '</a> </td>';
                                   
                                }

                                if ($rowejes['realizado'] == '0') {
                                    echo '<td>' . $rowejes['realizado'] . '</td>';
                                  
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario .'&ejeid='.$rowejes['idPersona'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=realizado&indicador=receptor">' . $rowejes['realizado'] . '</a> </td>';
                                   
                                }

                                if ($rowejes['atendido'] == '0') {
                                    echo '<td>' . $rowejes['atendido'] . '</td>';
                                  
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario .'&ejeid='.$rowejes['idPersona'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=atendido&indicador=receptor">' . $rowejes['atendido'] . '</a> </td>';
                                   
                                }

                                if ($rowejes['enproceso'] == '0') {
                                    echo '<td>' . $rowejes['enproceso'] . '</td>';
                                  
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario .'&ejeid='.$rowejes['idPersona'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=enproceso&indicador=receptor">' . $rowejes['enproceso'] . '</a> </td>';
                                  
                                }

                                if ($rowejes['cancelado'] == '0') {
                                    echo '<td>' . $rowejes['cancelado'] . '</td>';
                                  
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario .'&ejeid='.$rowejes['idPersona'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=cancelado&indicador=receptor">' . $rowejes['cancelado'] . '</a> </td>';
                                   
                                }

                                if ($rowejes['sinrealizar'] == '0') {
                                    echo '<td>' . $rowejes['sinrealizar'] . '</td>';
                                   
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario .'&ejeid='.$rowejes['idPersona'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=sinrealizar&indicador=receptor">' . $rowejes['sinrealizar'] . '</a> </td>';
                                  
                                }
                                echo '</tr>';
                            }
                            
                            echo '<tr>'; //añadido
                                echo '<th>Total</th>';
                                echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid=todos&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=todos&indicador=receptor">' . array_sum($total) . '</a> </th>';
                                echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid=todos&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=realizado&indicador=receptor">' . array_sum($realizado) . '</a> </th>';
                                echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid=todos&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=atendido&indicador=receptor">' . array_sum($atendido) . '</a> </th>';
                                echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid=todos&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=enproceso&indicador=receptor">' . array_sum($enproceso) . '</a> </th>';
                                
                                echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid=todos&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=cancelado&indicador=receptor">' . array_sum($cancelado) . '</a> </th>';
                                echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid=todos&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=sinrealizar&indicador=receptor">' . array_sum($sinrealizar) . '</a> </th>';
                                
                            echo '</tr>';
                            
                            
                        } elseif ($tipo == 8) {
                            $ejes = "SELECT e.idEje as idEje, e.Nombre as nombre,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio 
                            WHERE acu.id_proyecto = e.idEje ".$VarWhere.") AS concoca,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                            WHERE acu.Id_acuerdoestatus=2 AND acu.id_proyecto = e.idEje ".$VarWhere.") AS realizado,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                            WHERE acu.Id_acuerdoestatus=1 AND acu.id_proyecto = e.idEje ".$VarWhere.") AS enproceso,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                            WHERE acu.Id_acuerdoestatus=3 AND acu.id_proyecto = e.idEje ".$VarWhere.") AS cancelado,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                            WHERE acu.Id_acuerdoestatus=4 AND acu.id_proyecto = e.idEje ".$VarWhere.") AS atendido,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                            WHERE acu.Id_acuerdoestatus=5 AND acu.id_proyecto = e.idEje ".$VarWhere.") AS sinrealizar
                            FROM c_eje as e 
                            ORDER BY e.idEje ASC";
                            //echo $ejes;
                            $resultejes = $catalogo->obtenerLista($ejes);
                            while ($rowejes = mysqli_fetch_array($resultejes)) {

                                echo '<tr id="trFila">';
                                array_push($id_eje, $rowejes['idEje']); //añadido
                                array_push($categorias, $rowejes['nombre']);
                                array_push($enproceso, $rowejes['enproceso']);
                                array_push($cancelado, $rowejes['cancelado']);
                                array_push($realizado, $rowejes['realizado']);
                                array_push($total, $rowejes['concoca']);
                                array_push($atendido, $rowejes['atendido']);
                                array_push($sinrealizar, $rowejes['sinrealizar']);
                                array_push($sinrealizarGrafica, $rowejes['concoca'] - $rowejes['realizado']);
                                if ($periodo == "Todos") {
                                    $periodo="1";
                                }
                                echo '<td><a style="color:black;cursor:pointer" onClick="MostrarAreas('.$contadorejes.','.$rowejes['idEje'].','.$periodo.');"><span class="glyphicon glyphicon-th-list"></span></a>&nbsp;&nbsp' . $rowejes['idEje'] . '. ' . $rowejes['nombre'] . '</td>';
                                //recorre el while y valida si esta en 0 no crea el href
                                if ($rowejes['concoca'] == '0') {
                                    echo '<td>' . $rowejes['concoca'] . '</td>';
                                 
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid='.$rowejes['idEje'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . $rowejes['concoca'] . '</a> </td>';
                                  
                                }

                                if ($rowejes['realizado'] == '0') {
                                    echo '<td>' . $rowejes['realizado'] . '</td>';
                                   
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario .'&ejeidrealizado='.$rowejes['idEje'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . $rowejes['realizado'] . '</a> </td>';
                                  
                                }

                                if ($rowejes['atendido'] == '0') {
                                    echo '<td>' . $rowejes['atendido'] . '</td>';
                                  
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario .'&ejeidnorealizado='.$rowejes['idEje'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . $rowejes['atendido'] . '</a> </td>';
                                   
                                }

                                if ($rowejes['enproceso'] == '0') {
                                    echo '<td>' . $rowejes['enproceso'] . '</td>';
                                  
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario .'&ejeidnorealizado='.$rowejes['idEje'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . $rowejes['enproceso'] . '</a> </td>';
                                  
                                }                              

                                if ($rowejes['cancelado'] == '0') {
                                    echo '<td>' . $rowejes['cancelado'] . '</td>';
                                   
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario .'&ejeidcancelado='.$rowejes['idEje'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . $rowejes['cancelado'] . '</a> </td>';
                                   
                                }

                                if ($rowejes['sinrealizar'] == '0') {
                                    echo '<td>' . $rowejes['sinrealizar'] . '</td>';
                                  
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario .'&ejeidnorealizado='.$rowejes['idEje'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . $rowejes['sinrealizar'] . '</a> </td>';
                                   
                                }
                            echo '</tr>';
                            //$totalgraficaeje=$rowejes['concoca']+$rowejes['realizado']+$rowejes['norealizado']+$rowejes['cancelado'];
                            $totalgraficaeje=$rowejes['concoca'];
                            array_push($graficapie1,"{ name: '".$rowejes['nombre']."', y: ".$totalgraficaeje."},");

                            //$contadorareas=$contadorejes;
                            $contadorejes++;  
                            $areasporeje = "SELECT distinct a.id_area as idArea,a.Nombre AS nombre,
                                ( SELECT COUNT(*) FROM k_acuerdoactividad acu LEFT JOIN c_acuerdospdf a1 ON a1.id_acuerdo_escrito=acu.id_acuerdo LEFT JOIN c_periodo pe ON pe.Id_Periodo=a1.anio WHERE a1.id_area = a.Id_Area ".$VarWhere." AND acu.id_proyecto=".$rowejes['idEje'].") AS convoca,
                                ( SELECT COUNT(*) FROM k_acuerdoactividad acu LEFT JOIN c_acuerdospdf a3 ON a3.id_acuerdo_escrito=acu.id_acuerdo LEFT JOIN c_periodo pe ON pe.Id_Periodo=a3.anio  WHERE a3.id_area = a.Id_Area AND acu.Id_acuerdoestatus = 2 ".$VarWhere." AND acu.id_proyecto=".$rowejes['idEje'].") AS realizado,
                                ( SELECT COUNT(*) FROM k_acuerdoactividad acu LEFT JOIN c_acuerdospdf a4 ON a4.id_acuerdo_escrito=acu.id_acuerdo LEFT JOIN c_periodo pe ON pe.Id_Periodo=a4.anio  WHERE a4.id_area = a.Id_Area AND acu.Id_acuerdoestatus = 1 ".$VarWhere."  AND acu.id_proyecto=".$rowejes['idEje'].") AS norealizado, 
                                ( SELECT COUNT(*) FROM k_acuerdoactividad acu LEFT JOIN c_acuerdospdf a4 ON a4.id_acuerdo_escrito=acu.id_acuerdo LEFT JOIN c_periodo pe ON pe.Id_Periodo=a4.anio  WHERE a4.id_area = a.Id_Area AND acu.Id_acuerdoestatus = 3 ".$VarWhere."  AND acu.id_proyecto=".$rowejes['idEje'].") AS cancelado 
                            FROM c_area AS a
                            where a.tipoArea=1 AND a.estatus=1 
                            ORDER BY a.Nombre
                            limit 27";
                            //echo "<br><br>".$areasporeje;
                            $resultareaseje = $catalogo->obtenerLista($areasporeje);
                            while ($rowareas = mysqli_fetch_array($resultareaseje)) {
                                array_push($categorias, $rowareas['nombre']);
                                array_push($total, $rowareas['convoca']);
                                array_push($cancelado, $rowareas['cancelado']);
                                array_push($realizado, $rowareas['realizado']);
                                array_push($norealizado, $rowareas['norealizado']);
                            if ($rowareas['convoca']==0) {

                            }else{
                            echo '<tr id="trFilaArea'.$numeracion.''. $contadorareas.'" style="display:none">';
                            echo '<td>'. $rowareas['nombre'] . '</td>';
                            if ($rowareas['convoca'] == '0') {
                                    echo '<td>' . $rowareas['convoca'] . '</td>';
                                    $totalconvoca = $totalconvoca + $rowareas['convoca'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&idAreaeje='.$rowareas['idArea'].'&ejeareabusqueda='.$rowejes['idEje'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . $rowareas['convoca'] . '</a> </td>';
                                    $totalconvoca = $totalconvoca + $rowareas['convoca'];
                                }

                                if ($rowareas['realizado'] == '0') {
                                    echo '<td>' . $rowareas['realizado'] . '</td>';
                                    $totalrea = $totalrea + $rowareas['realizado'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&idArearealizadoeje='.$rowareas['idArea'].'&ejeareabusqueda='.$rowejes['idEje'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . $rowareas['realizado'] . '</a> </td>';
                                    $totalrea = $totalrea + $rowareas['realizado'];
                                }

                                if ($rowareas['norealizado'] == '0') {
                                    echo '<td>' . $rowareas['norealizado'] . '</td>';
                                    $totalnorea = $totalnorea + $rowareas['norealizado'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&idAreanorealizadoeje='.$rowareas['idArea'].'&ejeareabusqueda='.$rowejes['idEje'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . $rowareas['norealizado'] . '</a> </td>';
                                    $totalnorea = $totalnorea + $rowareas['norealizado'];
                                }

                                if ($rowareas['cancelado'] == '0') {
                                    echo '<td>' . $rowareas['cancelado'] . '</td>';
                                    $totalcancel = $totalcancel + $rowareas['cancelado'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '&idAreacanceladoeje='.$rowareas['idArea'].'&ejeareabusqueda='.$rowejes['idEje'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . $rowareas['cancelado'] . '</a> </td>';
                                    $totalcancel = $totalcancel + $rowareas['cancelado'];
                                }
                                $contadorareas++;
                            }
                            echo '</tr>';
                            }
                            $numeracion++;
                            }                         
                            echo '<tr>'; //añadido
                                echo '<th>Total</th>';
                                echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($total) . '</a> </th>';
                                echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&idejerealizadostotal=1&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($realizado) . '</a> </th>';
                                echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&idejecanceladototal=3&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($atendido) . '</a> </th>'; 
                                echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&idejenorealizadostotal=1&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($enproceso) . '</a> </th>'; 
                                 
                                echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&idejecanceladototal=3&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($cancelado) . '</a> </th>';   
                                echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&idejecanceladototal=3&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'">' . array_sum($sinrealizar) . '</a> </th>';         
                            echo '</tr>';      
                        } elseif ($tipo == 10) {
                            $ejes = "SELECT res.id_Personas as idPersona, CONCAT(res.Nombre,' ',res.Apellido_Paterno,' ',res.Apellido_Materno) as nombre,
                             (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                             LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio 
                             WHERE a.id_usuario = res.id_Personas ".$VarWhere.") AS concoca,
                             (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                             LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                             WHERE acu.Id_acuerdoestatus=2 AND a.id_usuario = res.id_Personas ".$VarWhere.") AS realizado,
                             (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                             LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                             WHERE acu.Id_acuerdoestatus=1 AND a.id_usuario = res.id_Personas ".$VarWhere.") AS enproceso,
                             (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                             LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                             WHERE acu.Id_acuerdoestatus=3 AND a.id_usuario = res.id_Personas ".$VarWhere.") AS cancelado,
                             (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                             LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                             WHERE acu.Id_acuerdoestatus=4 AND a.id_usuario = res.id_Personas ".$VarWhere.") AS atendido,
                             (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                             LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio  
                             WHERE acu.Id_acuerdoestatus=5 AND a.id_usuario = res.id_Personas ".$VarWhere.") AS sinrealizar
                             FROM c_personas as res 
                             JOIN c_rolPersona rp ON res.id_Personas=rp.id_Persona
                             WHERE rp.id_Rol=148 and (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                             LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio 
                             WHERE a.id_usuario = res.id_Personas ".$VarWhere.") > 0
                             ORDER BY concoca desc";
                             //echo $ejes;
                             $resultejes = $catalogo->obtenerLista($ejes);
                             while ($rowejes = mysqli_fetch_array($resultejes)) {
 
                                 echo '<tr id="trFila">';
                                 array_push($id_eje, $rowejes['idPersona']); //añadido
                                 array_push($categorias, $rowejes['nombre']);
                                 array_push($cancelado, $rowejes['cancelado']);
                                 array_push($enproceso, $rowejes['enproceso']);
                                 array_push($realizado, $rowejes['realizado']);
                                 array_push($total, $rowejes['concoca']);
                                 array_push($atendido, $rowejes['atendido']);
                                 array_push($sinrealizar, $rowejes['sinrealizar']);
                                 array_push($sinrealizarGrafica, $rowejes['concoca'] - $rowejes['realizado']);
                                 echo '<td>' . $rowejes['nombre'] . '</td>';
                                 //recorre el while y valida si esta en 0 no crea el href
                                 if ($rowejes['concoca'] == '0') {
                                     echo '<td>' . $rowejes['concoca'] . '</td>';
                                    
                                 } else {
                                     $numeroAcuerdos = $rowejes['concoca'];
                                     echo '<td> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid='.$rowejes['idPersona'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=todos&indicador=emisor">' . $rowejes['concoca'] . '</a> </td>';
                                   
                                 }
 
                                 if ($rowejes['realizado'] == '0') {
                                     echo '<td>' . $rowejes['realizado'] . '</td>';
                                    
                                 } else {
                                     echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario .'&ejeid='.$rowejes['idPersona'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=realizado&indicador=emisor">' . $rowejes['realizado'] . '</a> </td>';
                                    
                                 }
 
                                 if ($rowejes['atendido'] == '0') {
                                    echo '<td>' . $rowejes['atendido'] . '</td>';
                                  
                                 } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario .'&ejeid='.$rowejes['idPersona'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=atendido&indicador=emisor">' . $rowejes['atendido'] . '</a> </td>';
                                   
                                 }

                                 if ($rowejes['enproceso'] == '0') {
                                     echo '<td>' . $rowejes['enproceso'] . '</td>';
                                    
                                 } else {
                                     echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario .'&ejeid='.$rowejes['idPersona'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=enproceso&indicador=emisor">' . $rowejes['enproceso'] . '</a> </td>';
                                   
                                 }                              
 
                                 if ($rowejes['cancelado'] == '0') {
                                     echo '<td>' . $rowejes['cancelado'] . '</td>';
                                   
                                 } else {
                                     echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario .'&ejeid='.$rowejes['idPersona'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=cancelado&indicador=emisor">' . $rowejes['cancelado'] . '</a> </td>';
                                   
                                 }

                                 if ($rowejes['sinrealizar'] == '0') {
                                    echo '<td>' . $rowejes['sinrealizar'] . '</td>';
                                   
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario .'&ejeid='.$rowejes['idPersona'].'&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=sinrealizar&indicador=emisor">' . $rowejes['sinrealizar'] . '</a> </td>';
                                   
                                }
                                 echo '</tr>';
                             }
                             
                             echo '<tr>'; //añadido
                                 echo '<th>Total</th>';
                                 echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid=todos&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=todos&indicador=receptor">' . array_sum($total) . '</a> </th>';
                                 echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid=todos&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=realizado&indicador=receptor">' . array_sum($realizado) . '</a> </th>';
                                 echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid=todos&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=atendido&indicador=receptor">' . array_sum($atendido) . '</a> </th>';
                                 echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid=todos&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=enproceso&indicador=receptor">' . array_sum($enproceso) . '</a> </th>';
                                 
                                 echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid=todos&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=cancelado&indicador=receptor">' . array_sum($cancelado) . '</a> </th>';
                                 echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&ejeid=todos&ejeaño='.$periodo.'&tipoPerfil='.$tipoPerfil.'&idUsuario='.$idUsuario.'&numeroAcuerdos='.$numeroAcuerdos.'&directo=1&varFiltro=sinrealizar&indicador=receptor">' . array_sum($sinrealizar) . '</a> </th>';
                             echo '</tr>';
                             
                             
                         }
                        ?>
                    </tbody>
                </table>
            </div>
            <!--tabla araeas por eje-->
                <!--<div id="AreaTabla" style="display : none;">
                
                </div>-->
            <div class="col-md-6 col-sm-6 col-xs-6">
                <figure class="highcharts-figure">

                    <div id="container"></div>
                </figure>
            </div> 
            <div class="col-md-6 col-sm-6 col-xs-6" style="display:none;" id="grafica_areaseje">
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
$nombresNumero = "";
    for ($i = 0; $i < count($categoriasNumero); $i++) {
        $nombresNumero = $nombresNumero . "'" . $categoriasNumero[$i] . "'";
        if ($i + 1 < count($categoriasNumero)) {
            $nombresNumero = $nombresNumero . ",";
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
for ($index = 0; $index < count($sinrealizarGrafica); $index++) {
    $resultados3 = $resultados3 . $sinrealizarGrafica[$index];
    if ($index + 1 < count($sinrealizarGrafica)) {
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

$tipografica = "";
if ($tipo== 8) {
    $tipografica = "'pie'";
}else{
    $tipografica = "'column'";
}

?>
<script>
    Highcharts.chart('container', {
        chart: {
            type: <?php echo $tipografica?>,
            options3d: {
                enabled: false,
                alpha: 15,
                beta: 15,
                viewDistance: 25,
                depth: 40
            }
        },
        title: {
            text: '<?php echo $titulo; ?>'
        },
        colors: ['#12a2cd', "#3fff00", "#ff0000"],

        xAxis: {
            categories: [
                <?php
                if($tipo == 2){
                    echo $nombresNumero;
                }else{
                    echo $nombres;
                }              
                ?>
            ],
            labels: {
                skew3d: false,
                style: {
                    fontSize: '10px'
                }
            }
        },
        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Número de Acuerdos',
                skew3d: false
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
        <?php 
        if ($tipo!= 8) {
        ?>
        series: [{
            name: 'Acuerdos',
            data: [
                <?php
                echo $resultados;
                ?>
            ],
            stack: 'male'
        }, {
            name: 'realizados',
            data: [
                <?php
                echo $resultados2;
                ?>
            ],
            stack: 'female'
        }, {
            name: 'No realizados',
            data: [
                <?php
                echo $resultados3;
                ?>
            ],
            stack: 'female'
        }]
        <?php
        }else{ 
        ?>
        series: [{
        name: '',
        data: [
        <?php
          foreach ($graficapie1 as $clave => $valor) {
            echo  $valor;
          }
        ?>
      ]
  }]
        <?php
        } 
        ?>
    });

/*Highcharts.chart('container2', {
  chart: {
      type: 'pie',
  },
  title: {
      text: 'Área Pie',
  },
  series: [{
      name: '',
      data: [
        <?php
          //foreach ($graficapie2 as $clave => $valor) {
            //echo  $valor;
          //}
        ?>
      ]
  }]
});*/
</script>
<script type="text/javascript">
     function MostrarAreas(row,eje,anio) {
     var valoreje = eje;
     var valoranio = anio;
     GraficaTablaAreaEje(valoreje,valoranio);
     for (i = 0; i <= 298; i++) {
     if ($('#trFilaArea'+row+i).is(":hidden")) {
                $('#trFilaArea'+row+i).show();
            }else {
                $('#trFilaArea'+row+i).hide(); 
            }
     }
     if ($('#grafica_areaseje').is(":hidden")) {
                $("#grafica_areaseje").show();
            }else {
                $("#grafica_areaseje").hide();
            }
     }

    function GraficaTablaAreaEje(eje,anio){
    var valoreje = eje;
    var valoranio = anio;
    $.post( "graficaareaspie.php?tipo=9&eje=" + valoreje+"&periodo="+valoranio+"&tipoPerfil="+MiTipoPerfil+"&nombreUsuario="+MiNomUsr+"&idUsuario="+MiIdUsr,{},function(data) {
    if(data != ""){
    $("#grafica_areaseje").html(data);   
    }
    });
    }
</script>
</html>