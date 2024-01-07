<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$tipo = "";
$nombre = "";
$titulo = "";
$tot = 0;
$categorias = array();
$total = array();
$anio="";

$AnioActual=date("Y"); //Año actual para mostrar por default
if (isset($_GET['F_IdAnio']) && $_GET['F_IdAnio'] != "") {
    $AnioActual=$_GET['F_IdAnio'];
    if ($_GET['F_IdAnio'] == "Todos") { $VarWhere= " where 1 "; $VarWhere2= " ";  }
    else {  $VarWhere =" WHERE n.FechaPublicacion BETWEEN '".$AnioActual."/01/01 00:00:00' AND '".$AnioActual."/12/31 23:59:59' ";
            $VarWhere2="   AND n.FechaPublicacion BETWEEN '".$AnioActual."/01/01 00:00:00' AND '".$AnioActual."/12/31 23:59:59' ";
    }
}

$Aplicacion="Noticias";

//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiTipoPerfil=1;
$MiIdUsr=999;
$MiNomUsr="SinUsr";
if ((isset($_GET['tipoPerfil'])    && $_GET['tipoPerfil'] != ""))    { $MiTipoPerfil=$_GET['tipoPerfil'];    }
if ((isset($_GET['idUsuario'])     && $_GET['idUsuario'] != ""))     { $MiIdUsr=     $_GET['idUsuario'];     }
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) { $MiNomUsr=    $_GET['nombreUsuario']; }
$MiNomUsr=str_replace(" ", "%20", $MiNomUsr);
$MisParam="tipoPerfil=".$MiTipoPerfil."&idUsuario=".$MiIdUsr."&nombreUsuario=".$MiNomUsr; //Para pasar parametros a la siguiente liga


if (isset($_GET['tipo']) && $_GET['tipo'] != "undefined") {
    $tipo = $_GET['tipo'];
    if ($tipo == 1)        {    $nombre = 'Eje';                $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 2)  {    $nombre = 'Área';               $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 3)  {    $nombre = 'Año';                $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 4)  {    $nombre = 'Lugar de Noticia';   $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 5)  {    $nombre = 'Tipo de Noticia';    $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 6)  {    $nombre = 'Soporte de Noticia'; $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 7)  {    $nombre = 'Tipo de Medio';      $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 8)  {    $nombre = 'Género';             $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 9)  {    $nombre = 'Medio ';             $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 11) {    $nombre = 'Exposición';         $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 10) {    $nombre = 'Calificación';       $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 12) {    $nombre = 'Impactos';           $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 13) {    $nombre = 'Valor Comercial';    $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 14) {    $nombre = 'Valor Comercial Real';    $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 15) {    $nombre = 'Origen museo';    $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 16) {    $nombre = 'Otro origen';    $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    }
}
    $consulta = "SELECT  DATE_FORMAT(noti.FechaPublicacion,'%Y') anio FROM c_noticia noti GROUP BY DATE_FORMAT(FechaPublicacion,'%Y')
    ORDER BY noti.FechaPublicacion DESC LIMIT 3";
    $result= $catalogo->obtenerLista($consulta);
    $ultimos_3_anios = array();
    while ($rs = mysqli_fetch_array($result)){
      array_push($ultimos_3_anios,$rs['anio']);
    }

    $consulta = "SELECT  DATE_FORMAT(noti.FechaPublicacion,'%Y') anio FROM c_noticia noti GROUP BY DATE_FORMAT(FechaPublicacion,'%Y')
    ORDER BY noti.FechaPublicacion asc LIMIT 1";
    $result= $catalogo->obtenerLista($consulta);
    while ($rs = mysqli_fetch_array($result)){
       $ult_anio = $rs['anio'];
    }
    $total_anio1 = 0;
    $total_anio2 = 0;
    $total_anio3 = 0;
    $total_anio_ant = 0;
?>

<script>
    var MiApp='<?php echo $Aplicacion; ?>';
    var MiTipoPerfil='<?php echo $MiTipoPerfil; ?>';
    var MiIdUsr='<?php echo $MiIdUsr; ?>';
    var MiNomUsr='<?php echo $MiNomUsr; ?>';
    var MiAnioAct=$("#anio").val();
</script>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="../../../resources/js/aplicaciones/Noticias/Alta_Noticias.js"></script>
    <script src="../../../resources/js/aplicaciones/Noticias/funciones.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <table id="" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <?php
                            if ($_GET['F_IdAnio'] == "Todos" && $tipo != 3){
                              echo '<th>'.$nombre.'</th>';
                              $contador_anios = 0;
                              foreach ($ultimos_3_anios as $key ) {
                                if($contador_anios == 0)$anio1 = $key;
                                  if($contador_anios == 1)$anio2 = $key;
                                    if($contador_anios == 2)$anio3 = $key;
                              $contador_anios++;
                                  echo '<th>Total de '.$Aplicacion.' '.$key.'</th>';
                              }
                              $contador_anios = 0;
                              echo '<th style="width:10px">Años Ant.</th>';
                              echo '<th>Totales </th>';
                            }else{
                              echo '<th>'.$nombre.'</th>';
                              echo '<th>Total de '.$Aplicacion.' por '.$nombre.'</th>';
                            }

                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $graficapie1 =array();
                        $grafica_vr =array();
                        $grafica_vc =array();
                        if ($tipo == 1) { //----------------------------------------Ver por EJE--------------------------------------------
                          $totales_ = "";
                          $anio_aux = "";
                            if ($_GET['F_IdAnio'] == "Todos"){
                              foreach ($ultimos_3_anios as $key ){
                                $where_local="   AND n.FechaPublicacion BETWEEN '$key/01/01 00:00:00' AND '$key/12/31 23:59:59' ";
                                $totales_ .= "  (SELECT COUNT(*) FROM c_noticia n  WHERE n.idEje=ej.idEje
                                            ".$where_local." ) AS total$key ,  ";
                                $anio_aux = $key;

                              }
                              $anio_aux=$anio_aux-1;
                              $where_local="   AND n.FechaPublicacion BETWEEN '$ult_anio/01/01 00:00:00' AND '$anio_aux/12/31 23:59:59' ";
                              $totales_ .= "  (SELECT COUNT(*) FROM c_noticia n  WHERE n.idEje=ej.idEje
                                          ".$where_local." ) AS total_ant ,  ";
                            }else{
                              $totales_ = "(SELECT COUNT(*) FROM c_noticia n
                              WHERE n.idEje=ej.idEje
                              ".$VarWhere2.") AS total ,";
                            }
                            $eje = " SELECT ej.idEje AS id_eje, concat(ej.idEje, '. ', ej.Nombre) AS nombre_eje,
                                     $totales_  1 FROM c_eje ej ORDER BY ej.idEje";
                            //echo $eje;
                            $resulteje = $catalogo->obtenerLista($eje);
                            while ($rs = mysqli_fetch_array($resulteje)) {
                                $total_fila = 0;
                                $contador_anios = 0;
                                array_push($categorias, $rs['nombre_eje']);
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){
                                    $total_fila += $rs['total'.$key];
                                    $tot=$tot+$rs['total'.$key];
                                    if($contador_anios == 0)
                                      $total_anio1 += $rs['total'.$key];
                                      if($contador_anios == 1)
                                        $total_anio2 += $rs['total'.$key];
                                        if($contador_anios == 2)
                                          $total_anio3 += $rs['total'.$key];
                                    $contador_anios++;
                                  }
                                  $total_fila += $rs['total_ant'];//se añade lo de años anteriores
                                  $total_anio_ant += $rs['total_ant'];
                                  $tot=$tot+$rs['total_ant'];

                                  array_push($total, $total_fila);
                                }else{
                                  array_push($total, $rs['total']);
                                  $tot=$tot+$rs['total'];
                                }


                                if ($_GET['F_IdAnio'] == "Todos"){
                                    echo '<tr><td>'.$rs['nombre_eje'].'</td>';
                                    foreach ($ultimos_3_anios as $key ){

                                      echo '<td><a href="Lista.php?F_IdAnio='.$key.'&F_IdEje='.$rs['id_eje'].'&'.$MisParam.'">'.$rs['total'.$key].'</a></td>';
                                    }
                                    echo '<td>'.$rs['total_ant'].'</td>';//anios anteriores
                                    echo '<td><a href="Lista.php?F_IdAnio=Todos&F_IdEje='.$rs['id_eje'].'&'.$MisParam.'">'.$total_fila.'</a></td>';//$AnioActual
                                  echo '</tr>';
                                }else{
                                  echo '<tr><td>'.$rs['nombre_eje'].'</td><td><a href="Lista.php?F_IdAnio='.$AnioActual.'&F_IdEje='.$rs['id_eje'].'&'.$MisParam.'">'.$rs['total'].'</a></td></tr>';
                                }

                            }
                        } elseif ($tipo == 2) { //----------------------------------------Ver por AREA--------------------------------------------
                          $totales_ = "";
                          $anio_aux = "";
                          if ($_GET['F_IdAnio'] == "Todos"){
                            foreach ($ultimos_3_anios as $key ){
                              $where_local="   AND n.FechaPublicacion BETWEEN '$key/01/01 00:00:00' AND '$key/12/31 23:59:59' ";
                              $totales_ .= "  IF (ISNULL(n.idArea),(SELECT COUNT(*) FROM c_noticia n  WHERE n.idArea IS null $where_local ),
                              (SELECT COUNT(*) FROM c_noticia n  WHERE n.idArea=a.Id_Area $where_local )) AS total$key ,  ";
                              $anio_aux = $key;
                            }
                            $anio_aux=$anio_aux-1;
                            $where_local="   AND n.FechaPublicacion BETWEEN '$ult_anio/01/01 00:00:00' AND '$anio_aux/12/31 23:59:59' ";
                            $totales_ .= "  IF (ISNULL(n.idArea),(SELECT COUNT(*) FROM c_noticia n  WHERE n.idArea IS null $where_local ),
                             (SELECT COUNT(*) FROM c_noticia n  WHERE n.idArea=a.Id_Area ".$where_local." )) AS total_ant ,  ";
                          }else{
                            $totales_ = "count( * ) AS total, ";
                          }
                            $area = "SELECT $totales_
                                    IF (ISNULL(a.Nombre),'Sin información', a.Nombre) AS Area,
                                    IF (ISNULL(n.idArea), 0,n.idArea) AS IdArea
                                    FROM c_noticia n LEFT JOIN c_area a ON n.idArea=a.Id_Area
                                    ".$VarWhere."
                                    GROUP BY n.idArea";
                            $resultareas = $catalogo->obtenerLista($area);
                            while ($rowareas = mysqli_fetch_array($resultareas)) {
                                $total_fila = 0;
                                $contador_anios = 0;
                                array_push($categorias, $rowareas['Area']);
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){
                                    $total_fila += $rowareas['total'.$key];
                                    $tot=$tot+$rowareas['total'.$key];
                                    if($contador_anios == 0)
                                      $total_anio1 += $rowareas['total'.$key];
                                      if($contador_anios == 1)
                                        $total_anio2 += $rowareas['total'.$key];
                                        if($contador_anios == 2)
                                          $total_anio3 += $rowareas['total'.$key];
                                    $contador_anios++;
                                  }
                                  $total_fila += $rowareas['total_ant'];//se añade lo de años anteriores
                                  $total_anio_ant += $rowareas['total_ant'];
                                  $tot=$tot+$rowareas['total_ant'];

                                  array_push($total, $total_fila);
                                }else{
                                  array_push($total, $rowareas['total']);
                                  $tot=$tot+$rowareas['total'];
                                }

                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Area'] . '</td>';
                                if ($_GET['F_IdAnio'] == "Todos"){

                                  foreach ($ultimos_3_anios as $key ) {
                                    echo '<td><a href="Lista.php?F_IdArea='.$rowareas['IdArea'].'&F_IdAnio='.$key.'&'.$MisParam.'">'. $rowareas['total'.$key] .'</a></td>';
                                  }
                                  echo '<td>  '.$rowareas['total_ant'].'</td>';//anios anteriores
                                  echo '<td><a href="Lista.php?F_IdArea='.$rowareas['IdArea'].'&F_IdAnio=Todos&'.$MisParam.'">'.$total_fila.'</a></td>';//$AnioActual

                                }else{

                                  echo '<td><a href="Lista.php?F_IdArea='.$rowareas['IdArea'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">'. $rowareas['total'] .'</a></td>';
                                }
                                echo '</tr>';


                            }
                        } elseif ($tipo == 3) { //----------------------------------------Ver por ANIO--------------------------------------------
                            $anio = "SELECT count( * ) AS total, DATE_FORMAT(FechaPublicacion,'%Y') AnioP,
                                IF (ISNULL(FechaPublicacion), 'Sin información', DATE_FORMAT(FechaPublicacion,'%Y') ) AS Anio
                                FROM c_noticia GROUP BY 2 ORDER BY AnioP desc
                                ";
                            $resultanio = $catalogo->obtenerLista($anio);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['Anio']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Anio'] . '</td>';
                                echo '<td><a href="Lista.php?F_IdAnio='.$rowareas['Anio'].'&'.$MisParam.'">'. $rowareas['total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 4) { //----------------------------------------Ver por Lugar--------------------------------------------
                          $totales_ = "";
                          $anio_aux = "";
                          if ($_GET['F_IdAnio'] == "Todos"){
                            foreach ($ultimos_3_anios as $key ){
                              $where_local="   AND n.FechaPublicacion BETWEEN '$key/01/01 00:00:00' AND '$key/12/31 23:59:59' ";
                              $totales_ .= "  (SELECT COUNT(*) FROM c_noticia n  WHERE n.idLugarNoticia=l.idLugarNoticia ".$where_local." ) AS total$key ,  ";
                              $anio_aux = $key;
                            }
                            $where_local="   AND n.FechaPublicacion BETWEEN '$ult_anio/01/01 00:00:00' AND '$anio_aux/01/01 00:00:00' ";
                            $totales_ .= "   (SELECT COUNT(*) FROM c_noticia n WHERE n.idLugarNoticia=l.idLugarNoticia ".$where_local." ) AS total_ant ,  ";
                          }else{
                            $totales_ = "count( * ) AS total, ";
                          }
                            $lugar = "SELECT $totales_ n.idLugarNoticia, l.Nombre AS Lugar
                                FROM c_noticia n JOIN c_lugarNoticia l ON n.idLugarNoticia=l.idLugarNoticia
                                ".$VarWhere."
                                GROUP BY Lugar ORDER BY n.idLugarNoticia";
                            $resultanio = $catalogo->obtenerLista($lugar);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                $total_fila = 0;
                                $contador_anios = 0;

                                array_push($categorias, $rowareas['Lugar']);
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){
                                    $total_fila += $rowareas['total'.$key];
                                    $tot=$tot+$rowareas['total'.$key];
                                    if($contador_anios == 0)
                                      $total_anio1 += $rowareas['total'.$key];
                                      if($contador_anios == 1)
                                        $total_anio2 += $rowareas['total'.$key];
                                        if($contador_anios == 2)
                                          $total_anio3 += $rowareas['total'.$key];
                                    $contador_anios++;
                                  }
                                  $total_fila += $rowareas['total_ant'];//se añade lo de años anteriores
                                  $total_anio_ant += $rowareas['total_ant'];
                                  $tot=$tot+$rowareas['total_ant'];

                                  array_push($total, $total_fila);
                                }else{
                                  array_push($total, $rowareas['total']);
                                  $tot=$tot+$rowareas['total'];
                                }

                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Lugar'] . '</td>';

                                  if ($_GET['F_IdAnio'] == "Todos"){
                                    foreach ($ultimos_3_anios as $key ){

                                      echo '<td><a href="Lista.php?F_IdLugar='.$rowareas['idLugarNoticia'].'&F_IdAnio='.$key.'&'.$MisParam.'">'. $rowareas['total'.$key] .'</a></td>';
                                    }
                                    echo '<td>  '.$rowareas['total_ant'].'</td>';//anios anteriores
                                    echo '<td><a href="Lista.php?F_IdLugar='.$rowareas['idLugarNoticia'].'&F_IdAnio=Todos&'.$MisParam.'">'.$total_fila.'</a></td>';//$AnioActual
                                  }else{
                                      echo '<td><a href="Lista.php?F_IdLugar='.$rowareas['idLugarNoticia'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">'. $rowareas['total'] .'</a></td>';
                                  }

                                echo '</tr>';

                            }
                        } elseif ($tipo == 5) { //----------------------------------------Ver por Tipo Interna-Externa--------------------------------------------
                            $totales_ = "";
                            $anio_aux = "";
                            if ($_GET['F_IdAnio'] == "Todos"){
                              foreach ($ultimos_3_anios as $key ){
                                $where_local="   AND n.FechaPublicacion BETWEEN '$key/01/01 00:00:00' AND '$key/12/31 23:59:59' ";
                                $totales_ .= "  IF (ISNULL(n.idTipo),(SELECT COUNT(*) FROM c_noticia n  WHERE n.idTipo IS null $where_local ),
                                                (SELECT COUNT(*) FROM c_noticia n  WHERE n.idTipo=t.Id_tipo ".$where_local." )) AS total$key ,  ";
                                $anio_aux = $key;
                              }
                              $anio_aux=$anio_aux-1;
                              $where_local="   AND n.FechaPublicacion BETWEEN '$ult_anio/01/01 00:00:00' AND '$anio_aux/12/31 23:59:59' ";
                              $totales_ .= "    IF (ISNULL(n.idTipo),(SELECT COUNT(*) FROM c_noticia n  WHERE n.idTipo IS null $where_local ),
                                                (SELECT COUNT(*) FROM c_noticia n WHERE n.idTipo=t.Id_tipo ".$where_local." )) AS total_ant ,  ";
                            }else{
                              $totales_ = "count( * ) AS total, ";
                            }
                            $tipon = "SELECT $totales_
                                IF (ISNULL(t.Descripcion),'Sin información', t.Descripcion) AS TipoN,
                                IF (ISNULL(n.idTipo), 0,n.idTipo) AS idTipo
                                FROM c_noticia n LEFT JOIN c_tipo_noticia t ON n.idTipo=t.Id_tipo
                                ".$VarWhere."
                                GROUP BY n.idTipo ";
                            $resultanio = $catalogo->obtenerLista($tipon);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                $total_fila = 0;
                                $contador_anios = 0;
                                array_push($categorias, $rowareas['TipoN']);
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){
                                    $total_fila += $rowareas['total'.$key];
                                    $tot=$tot+$rowareas['total'.$key];
                                    if($contador_anios == 0)
                                      $total_anio1 += $rowareas['total'.$key];
                                      if($contador_anios == 1)
                                        $total_anio2 += $rowareas['total'.$key];
                                        if($contador_anios == 2)
                                          $total_anio3 += $rowareas['total'.$key];
                                    $contador_anios++;
                                  }
                                  $total_fila += $rowareas['total_ant'];//se añade lo de años anteriores
                                  $total_anio_ant += $rowareas['total_ant'];
                                  $tot=$tot+$rowareas['total_ant'];

                                  array_push($total, $total_fila);
                                }else{
                                  array_push($total, $rowareas['total']);
                                  $tot=$tot+$rowareas['total'];
                                }

                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['TipoN'] . '</td>';
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){
                                    echo '<td><a href="Lista.php?F_IdTipoInterna='.$rowareas['idTipo'].'&F_IdAnio='.$key.'&'.$MisParam.'">'. $rowareas['total'.$key] .'</a></td>';
                                  }
                                  echo '<td>  '.$rowareas['total_ant'].'</td>';//anios anteriores
                                  echo '<td><a href="Lista.php?F_IdTipoInterna='.$rowareas['idTipo'].'&F_IdAnio=Todos&'.$MisParam.'">'.$total_fila.'</a></td>';//$AnioActual
                                }else{
                                  echo '<td><a href="Lista.php?F_IdTipoInterna='.$rowareas['idTipo'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">'. $rowareas['total'] .'</a></td>';
                                }

                                echo '</tr>';

                            }
                        } elseif ($tipo == 6){//----------------------------------------Ver por SOPORTE--------------------------------------------
                          $totales_ = "";
                          $anio_aux = "";
                          if ($_GET['F_IdAnio'] == "Todos"){
                            foreach ($ultimos_3_anios as $key ){
                              $where_local="   AND n.FechaPublicacion BETWEEN '$key/01/01 00:00:00' AND '$key/12/31 23:59:59' ";
                              $totales_ .= "  IF (ISNULL(n.idSoporte),(SELECT COUNT(*) FROM c_noticia n  WHERE n.idSoporte IS null $where_local ),
                                              (SELECT COUNT(*) FROM c_noticia n  WHERE n.idSoporte=s.IdSoporte ".$where_local." )) AS total$key ,  ";
                              $anio_aux = $key;
                            }
                            $anio_aux=$anio_aux-1;
                            $where_local="   AND n.FechaPublicacion BETWEEN '$ult_anio/01/01 00:00:00' AND '$anio_aux/12/31 23:59:59' ";
                            $totales_ .= "   IF (ISNULL(n.idSoporte),(SELECT COUNT(*) FROM c_noticia n  WHERE n.idSoporte IS null $where_local ),
                                            (SELECT COUNT(*) FROM c_noticia n WHERE n.idSoporte=s.IdSoporte ".$where_local." )) AS total_ant ,  ";
                          }else{
                            $totales_ = "count( * ) AS total, ";
                          }
                            $soporte = "SELECT $totales_
                                IF (ISNULL(s.Nombre),'Sin información', s.Nombre) AS Soporte,
                                IF (ISNULL(n.idSoporte), 0,n.idSoporte) AS idSoporte
                                FROM c_noticia n LEFT JOIN c_soporteNoticia s ON n.idSoporte=s.IdSoporte
                                ".$VarWhere."
                                GROUP BY Soporte";
                            $resultanio = $catalogo->obtenerLista($soporte);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                $total_fila = 0;
                                $contador_anios = 0;
                                array_push($categorias, $rowareas['Soporte']);
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){
                                    $total_fila += $rowareas['total'.$key];
                                    $tot=$tot+$rowareas['total'.$key];
                                    if($contador_anios == 0)
                                      $total_anio1 += $rowareas['total'.$key];
                                      if($contador_anios == 1)
                                        $total_anio2 += $rowareas['total'.$key];
                                        if($contador_anios == 2)
                                          $total_anio3 += $rowareas['total'.$key];
                                    $contador_anios++;
                                  }
                                  $total_fila += $rowareas['total_ant'];//se añade lo de años anteriores
                                  $total_anio_ant += $rowareas['total_ant'];
                                  $tot=$tot+$rowareas['total_ant'];

                                  array_push($total, $total_fila);
                                }else{
                                  array_push($total, $rowareas['total']);
                                  $tot=$tot+$rowareas['total'];
                                }

                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Soporte'] . '</td>';
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){

                                    echo '<td><a href="Lista.php?F_IdSoporte='.$rowareas['idSoporte'].'&F_IdAnio='.$key.'&'.$MisParam.'">'. $rowareas['total'.$key] .'</a></td>';
                                  }
                                  echo '<td>  '.$rowareas['total_ant'].'</td>';//anios anteriores
                                  echo '<td><a href="Lista.php?F_IdSoporte='.$rowareas['idSoporte'].'&F_IdAnio=Todos&'.$MisParam.'">'.$total_fila.'</a></td>';//$AnioActual
                                }else{
                                  echo '<td><a href="Lista.php?F_IdSoporte='.$rowareas['idSoporte'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">'. $rowareas['total'] .'</a></td>';
                                }

                                echo '</tr>';

                            }
                        } elseif ($tipo == 7) {//----------------------------------------Ver por Tipo Medio--------------------------------------------
                          $totales_ = "";
                          $anio_aux = "";
                          if ($_GET['F_IdAnio'] == "Todos"){
                            foreach ($ultimos_3_anios as $key ){
                              $where_local="   AND n.FechaPublicacion BETWEEN '$key/01/01 00:00:00' AND '$key/12/31 23:59:59' ";
                              $totales_ .= "  (SELECT COUNT(*) FROM c_noticia n  WHERE n.idTipoMedio=tm.idTipoMedio ".$where_local." ) AS total$key ,  ";
                              $anio_aux = $key;
                            }
                            $where_local="   AND n.FechaPublicacion BETWEEN '$ult_anio/01/01 00:00:00' AND '$anio_aux/01/01 00:00:00' ";
                            $totales_ .= "   (SELECT COUNT(*) FROM c_noticia n WHERE n.idTipoMedio=tm.idTipoMedio ".$where_local." ) AS total_ant ,  ";
                          }else{
                            $totales_ = "count( * ) AS total, ";
                          }
                            $tmedio = "SELECT $totales_ n.idTipoMedio, tm.Nombre AS TipoMedio
                                FROM c_noticia n JOIN c_tipoMedio tm ON n.idTipoMedio=tm.idTipoMedio
                                ".$VarWhere."
                                GROUP BY TipoMedio 	";

                            $resultanio = $catalogo->obtenerLista($tmedio);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                $total_fila = 0;
                                $contador_anios = 0;
                                array_push($categorias, $rowareas['TipoMedio']);

                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){
                                    $total_fila += $rowareas['total'.$key];
                                    $tot=$tot+$rowareas['total'.$key];
                                    if($contador_anios == 0)
                                      $total_anio1 += $rowareas['total'.$key];
                                      if($contador_anios == 1)
                                        $total_anio2 += $rowareas['total'.$key];
                                        if($contador_anios == 2)
                                          $total_anio3 += $rowareas['total'.$key];
                                    $contador_anios++;
                                  }
                                  $total_fila += $rowareas['total_ant'];//se añade lo de años anteriores
                                  $total_anio_ant += $rowareas['total_ant'];
                                  $tot=$tot+$rowareas['total_ant'];

                                  array_push($total, $total_fila);
                                }else{
                                  array_push($total, $rowareas['total']);
                                  $tot=$tot+$rowareas['total'];
                                }

                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['TipoMedio'] . '</td>';
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){
                                    echo '<td><a href="Lista.php?F_IdTipoMedio='.$rowareas['idTipoMedio'].'&F_IdAnio='.$key.'&'.$MisParam.'">'.$rowareas['total'.$key].'</a></td>';
                                  }
                                  echo '<td>  '.$rowareas['total_ant'].'</td>';//anios anteriores
                                  echo '<td><a href="Lista.php?F_IdTipoMedio='.$rowareas['idTipoMedio'].'&F_IdAnio=Todos&'.$MisParam.'">'.$total_fila.'</a></td>';//$AnioActual
                                }else{
                                  echo '<td><a href="Lista.php?F_IdTipoMedio='.$rowareas['idTipoMedio'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">'.$rowareas['total'].'</a></td>';
                                }

                                echo '</tr>';

                            }
                        } elseif ($tipo == 8) {//----------------------------------------Ver por Genero--------------------------------------------
                            $totales_ = "";
                            $anio_aux = "";
                            if ($_GET['F_IdAnio'] == "Todos"){
                              foreach ($ultimos_3_anios as $key ){
                                $where_local="   AND n.FechaPublicacion BETWEEN '$key/01/01 00:00:00' AND '$key/12/31 23:59:59' ";
                                $totales_ .= "  IF (ISNULL(n.idGenero),(SELECT COUNT(*) FROM c_noticia n  WHERE n.idGenero IS null $where_local ),
                                                (SELECT COUNT(*) FROM c_noticia n  WHERE n.idGenero=g.Id_genero ".$where_local." )) AS total$key ,  ";
                                $anio_aux = $key;
                              }
                              $anio_aux=$anio_aux-1;
                              $where_local="   AND n.FechaPublicacion BETWEEN '$ult_anio/01/01 00:00:00' AND '$anio_aux/12/31 23:59:59' ";
                              $totales_ .= "   IF (ISNULL(n.idGenero),(SELECT COUNT(*) FROM c_noticia n  WHERE n.idGenero IS null $where_local ),
                                               (SELECT COUNT(*) FROM c_noticia n WHERE n.idGenero=g.Id_genero ".$where_local." )) AS total_ant ,  ";
                            }else{
                              $totales_ = "count( * ) AS total, ";
                            }
                            $genero = "SELECT $totales_
                                IF (ISNULL(n.idGenero), 0,n.idGenero) AS idGenero,
                                IF (ISNULL(g.Descripcion),'Sin información', g.Descripcion) AS Genero
                                FROM c_noticia n LEFT JOIN c_genero_noticia g ON n.idGenero=g.Id_genero
                                ".$VarWhere."
                                GROUP BY Genero 	";
                            $resultanio = $catalogo->obtenerLista($genero);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                $total_fila = 0;
                                $contador_anios = 0;
                                array_push($categorias, $rowareas['Genero']);
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){
                                    $total_fila += $rowareas['total'.$key];
                                    $tot=$tot+$rowareas['total'.$key];
                                    if($contador_anios == 0)
                                      $total_anio1 += $rowareas['total'.$key];
                                      if($contador_anios == 1)
                                        $total_anio2 += $rowareas['total'.$key];
                                        if($contador_anios == 2)
                                          $total_anio3 += $rowareas['total'.$key];
                                    $contador_anios++;
                                  }
                                  $total_fila += $rowareas['total_ant'];//se añade lo de años anteriores
                                  $total_anio_ant += $rowareas['total_ant'];
                                  $tot=$tot+$rowareas['total_ant'];

                                  array_push($total, $total_fila);
                                }else{
                                  array_push($total, $rowareas['total']);
                                  $tot=$tot+$rowareas['total'];
                                }

                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Genero'] . '</td>';
                                if ($_GET['F_IdAnio'] == "Todos")
                                {
                                  foreach ($ultimos_3_anios as $key ){

                                    echo '<td><a href="Lista.php?F_IdGenero='.$rowareas['idGenero'].'&F_IdAnio='.$key.'&'.$MisParam.'">' . $rowareas['total'.$key] . '</a></td>';
                                  }
                                  echo '<td>  '.$rowareas['total_ant'].'</td>';//anios anteriores
                                  echo '<td><a href="Lista.php?F_IdGenero='.$rowareas['idGenero'].'&F_IdAnio=Todos&'.$MisParam.'">'.$total_fila.'</a></td>';//$AnioActual
                                }else{
                                  echo '<td><a href="Lista.php?F_IdGenero='.$rowareas['idGenero'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">' . $rowareas['total'] . '</a></td>';
                                }

                                echo '</tr>';
                            }
                        } elseif ($tipo == 9) {//----------------------------------------Ver por MEDIO--------------------------------------------
                          $totales_ = "";
                          $anio_aux = "";
                          if ($_GET['F_IdAnio'] == "Todos"){
                            foreach ($ultimos_3_anios as $key ){
                              $where_local="   AND n.FechaPublicacion BETWEEN '$key/01/01 00:00:00' AND '$key/12/31 23:59:59' ";
                              $totales_ .= "  IF (ISNULL(m.Nombre),(SELECT COUNT(*) FROM c_noticia n  WHERE n.idMedio IS null ".$where_local." ), (SELECT COUNT(*) FROM c_noticia n  WHERE n.idMedio=m.idMedio ".$where_local." )) AS total$key ,  ";
                              $anio_aux = $key;
                            }
                            $where_local="   AND n.FechaPublicacion BETWEEN '$ult_anio/01/01 00:00:00' AND '$anio_aux/01/01 00:00:00' ";
                            $totales_ .= "   IF (ISNULL(m.Nombre),(SELECT COUNT(*) FROM c_noticia n WHERE n.idMedio IS null ".$where_local." ), (SELECT COUNT(*) FROM c_noticia n WHERE n.idMedio=m.idMedio ".$where_local." )) AS total_ant ,  ";
                          }else{
                            $totales_ = "count( * ) AS total, ";
                          }
                            $medio = "SELECT $totales_
                                IF (ISNULL(n.idMedio), 0,n.idMedio) AS idMedio,
                                IF (ISNULL(m.Nombre),'Sin información', m.Nombre) AS Medio
                                FROM c_noticia n LEFT JOIN c_medio m ON n.idMedio=m.idMedio
                                ".$VarWhere."
                                GROUP BY Medio";
                                // echo "Medio:".$medio;
                            $resultanio = $catalogo->obtenerLista($medio);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                $total_fila = 0;
                                $contador_anios = 0;
                                array_push($categorias, $rowareas['Medio']);
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){
                                    $total_fila += $rowareas['total'.$key];
                                    $tot=$tot+$rowareas['total'.$key];
                                    if($contador_anios == 0)
                                      $total_anio1 += $rowareas['total'.$key];
                                      if($contador_anios == 1)
                                        $total_anio2 += $rowareas['total'.$key];
                                        if($contador_anios == 2)
                                          $total_anio3 += $rowareas['total'.$key];
                                    $contador_anios++;
                                  }
                                  $total_fila += $rowareas['total_ant'];//se añade lo de años anteriores
                                  $total_anio_ant += $rowareas['total_ant'];
                                  $tot=$tot+$rowareas['total_ant'];

                                  array_push($total, $total_fila);
                                }else{
                                  array_push($total, $rowareas['total']);
                                  $tot=$tot+$rowareas['total'];
                                }
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Medio'] . '</td>';
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){

                                    echo '<td><a href="Lista.php?F_IdMedio='.$rowareas['idMedio'].'&F_IdAnio='.$key.'&'.$MisParam.'">' . $rowareas['total'.$key] . '</a></td>';
                                  }
                                  echo '<td>  '.$rowareas['total_ant'].'</td>';//anios anteriores
                                  echo '<td><a href="Lista.php?F_IdMedio='.$rowareas['idMedio'].'&F_IdAnio=Todos&'.$MisParam.'">'.$total_fila.'</a></td>';//$AnioActual

                                }else{
                                  echo '<td><a href="Lista.php?F_IdMedio='.$rowareas['idMedio'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">' . $rowareas['total'] . '</a></td>';
                                }
                                echo '</tr>';

                            }
                        } elseif ($tipo == 11) {//----------------------------------------Ver por Exposicion--------------------------------------------
                          $totales_ = "";
                          $anio_aux = "";
                          if ($_GET['F_IdAnio'] == "Todos"){
                            foreach ($ultimos_3_anios as $key ){
                              $where_local="   AND n.FechaPublicacion BETWEEN '$key/01/01 00:00:00' AND '$key/12/31 23:59:59' ";
                              $totales_ .= "  IF (ISNULL(n.idExposicion),(SELECT COUNT(*) FROM c_noticia n  WHERE n.idExposicion IS null $where_local ),
                                              (SELECT COUNT(*) FROM c_noticia n  WHERE n.idExposicion=e.idExposicion ".$where_local." )) AS total$key ,  ";
                              $anio_aux = $key;
                            }
                            $anio_aux=$anio_aux-1;
                            $where_local="   AND n.FechaPublicacion BETWEEN '$ult_anio/01/01 00:00:00' AND '$anio_aux/12/31 23:59:59' ";
                            $totales_ .= "   IF (ISNULL(n.idExposicion),(SELECT COUNT(*) FROM c_noticia n  WHERE n.idExposicion IS null $where_local ),
                                             (SELECT COUNT(*) FROM c_noticia n WHERE n.idExposicion=e.idExposicion ".$where_local." )) AS total_ant ,  ";
                          }else{
                            $totales_ = "count( * ) AS total, ";
                          }
                            $expoTemp = "SELECT $totales_
                                CASE WHEN isnull(n.idExposicion) THEN '0' ELSE n.idExposicion END AS idExposicion,
                                CASE WHEN n.idExposicion >0 THEN e.tituloFinal ELSE 'Sin exposición' END AS ExpoTemp
                                FROM c_noticia n LEFT JOIN c_exposicionTemporal e ON n.idExposicion=e.idExposicion
                                ".$VarWhere."
                                GROUP BY ExpoTemp  ";
                            $resultanio = $catalogo->obtenerLista($expoTemp);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                $total_fila = 0;
                                $contador_anios = 0;
                                array_push($categorias, $rowareas['ExpoTemp']);
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){
                                    $total_fila += $rowareas['total'.$key];
                                    $tot=$tot+$rowareas['total'.$key];
                                    if($contador_anios == 0)
                                      $total_anio1 += $rowareas['total'.$key];
                                      if($contador_anios == 1)
                                        $total_anio2 += $rowareas['total'.$key];
                                        if($contador_anios == 2)
                                          $total_anio3 += $rowareas['total'.$key];
                                    $contador_anios++;
                                  }
                                  $total_fila += $rowareas['total_ant'];//se añade lo de años anteriores
                                  $total_anio_ant += $rowareas['total_ant'];
                                  $tot=$tot+$rowareas['total_ant'];

                                  array_push($total, $total_fila);
                                }else{
                                  array_push($total, $rowareas['total']);
                                  $tot=$tot+$rowareas['total'];
                                }

                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['ExpoTemp'] . '</td>';
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){

                                    echo '<td><a href="Lista.php?F_IdExpoTemp='.$rowareas['idExposicion'].'&F_IdAnio='.$key.'&'.$MisParam.'">' . $rowareas['total'.$key] . '</a></td>';
                                  }
                                  echo '<td>  '.$rowareas['total_ant'].'</td>';//anios anteriores
                                  echo '<td><a href="Lista.php?F_IdExpoTemp='.$rowareas['idExposicion'].'&F_IdAnio=Todos&'.$MisParam.'">'.$total_fila.'</a></td>';//$AnioActual
                                }else{
                                  echo '<td><a href="Lista.php?F_IdExpoTemp='.$rowareas['idExposicion'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">' . $rowareas['total'] . '</a></td>';
                                }

                                echo '</tr>';
                            }
                        } elseif ($tipo == 10) { //----------------------------------------Ver por Calificación--------------------------------------------
                          $totales_ = "";
                          $anio_aux = "";
                          if ($_GET['F_IdAnio'] == "Todos"){
                            foreach ($ultimos_3_anios as $key ){
                              $where_local="   AND n.FechaPublicacion BETWEEN '$key/01/01 00:00:00' AND '$key/12/31 23:59:59' ";
                              $totales_ .= "  IF (ISNULL(n.idCalificacion),(SELECT COUNT(*) FROM c_noticia n  WHERE n.idCalificacion IS null $where_local ),
                                              (SELECT COUNT(*) FROM c_noticia n  WHERE n.idCalificacion=c.idCalificacion ".$where_local." )) AS total$key ,  ";
                              $anio_aux = $key;
                            }
                            $anio_aux=$anio_aux-1;
                            $where_local="   AND n.FechaPublicacion BETWEEN '$ult_anio/01/01 00:00:00' AND '$anio_aux/12/31 23:59:59' ";
                            $totales_ .= "   IF (ISNULL(n.idCalificacion),(SELECT COUNT(*) FROM c_noticia n  WHERE n.idCalificacion IS null $where_local ),
                                             (SELECT COUNT(*) FROM c_noticia n WHERE n.idCalificacion=c.idCalificacion ".$where_local." )) AS total_ant ,  ";
                          }else{
                            $totales_ = "count( * ) AS total, ";
                          }
                            $calif = "SELECT $totales_
                                IF (ISNULL(n.idCalificacion), 0,n.idCalificacion) AS idCalificacion,
                                IF (ISNULL(c.Nombre),'Sin información', c.Nombre) AS Calif
                                FROM c_noticia n LEFT JOIN c_calificacion c ON n.idCalificacion=c.idCalificacion
                                ".$VarWhere."GROUP BY Calif";
                            $resultanio = $catalogo->obtenerLista($calif);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                $total_fila = 0;
                                $contador_anios = 0;
                                array_push($categorias, $rowareas['Calif']);
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){
                                    $total_fila += $rowareas['total'.$key];
                                    $tot=$tot+$rowareas['total'.$key];
                                    if($contador_anios == 0)
                                      $total_anio1 += $rowareas['total'.$key];
                                      if($contador_anios == 1)
                                        $total_anio2 += $rowareas['total'.$key];
                                        if($contador_anios == 2)
                                          $total_anio3 += $rowareas['total'.$key];
                                    $contador_anios++;
                                  }
                                  $total_fila += $rowareas['total_ant'];//se añade lo de años anteriores
                                  $total_anio_ant += $rowareas['total_ant'];
                                  $tot=$tot+$rowareas['total_ant'];

                                  array_push($total, $total_fila);
                                }else{
                                  array_push($total, $rowareas['total']);
                                  $tot=$tot+$rowareas['total'];
                                }

                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Calif'] . '</td>';
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){
                                    echo '<td><a href="Lista.php?F_IdCalificacion='.$rowareas['idCalificacion'].'&F_IdAnio='.$key.'&'.$MisParam.'">'.$rowareas['total'.$key].'</a></td>';
                                  }
                                  echo '<td>  '.$rowareas['total_ant'].'</td>';//anios anteriores
                                  echo '<td><a href="Lista.php?F_IdCalificacion='.$rowareas['idCalificacion'].'&F_IdAnio=Todos&'.$MisParam.'">'.$total_fila.'</a></td>';//$AnioActual

                                }else{
                                  echo '<td><a href="Lista.php?F_IdCalificacion='.$rowareas['idCalificacion'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">'.$rowareas['total'].'</a></td>';
                                }

                                echo '</tr>';

                            }
                        } elseif ($tipo == 13) {//----------------------------------------Ver por valor comercial--------------------------------------------
                          $totales_ = "";
                          $anio_aux = "";
                          if ($_GET['F_IdAnio'] == "Todos"){
                            foreach ($ultimos_3_anios as $key ){
                              $where_local="   AND n.FechaPublicacion BETWEEN '$key/01/01 00:00:00' AND '$key/12/31 23:59:59' ";
                              $totales_ .= "  (SELECT if (ISNULL(sum( n.Precio )),0, sum( n.Precio )) FROM c_noticia n  WHERE n.idTipoMedio=tm.idTipoMedio ".$where_local." ) AS total$key ,  ";
                              $anio_aux = $key;
                            }
                            $where_local="   AND n.FechaPublicacion BETWEEN '$ult_anio/01/01 00:00:00' AND '$anio_aux/01/01 00:00:00' ";
                            $totales_ .= "   (SELECT if (ISNULL(sum( n.Precio )),0, sum( n.Precio )) FROM c_noticia n WHERE n.idTipoMedio=tm.idTipoMedio ".$where_local." ) AS total_ant ,  ";
                          }else{
                            $totales_ = "if (ISNULL(sum( n.Precio )),0, sum( n.Precio )) AS total, ";
                          }
                            $tmedio = "SELECT $totales_ n.idTipoMedio, tm.Nombre AS TipoMedio
                                FROM c_noticia n LEFT JOIN c_tipoMedio tm ON n.idTipoMedio=tm.idTipoMedio
                                ".$VarWhere."
                                GROUP BY TipoMedio  ";
                            //echo $tmedio;
                            $resultanio = $catalogo->obtenerLista($tmedio);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                $total_fila = 0;
                                $contador_anios = 0;
                                array_push($categorias, $rowareas['TipoMedio']);

                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){
                                    $total_fila += $rowareas['total'.$key];
                                    $tot=$tot+$rowareas['total'.$key];
                                    if($contador_anios == 0)
                                      $total_anio1 += $rowareas['total'.$key];
                                      if($contador_anios == 1)
                                        $total_anio2 += $rowareas['total'.$key];
                                        if($contador_anios == 2)
                                          $total_anio3 += $rowareas['total'.$key];
                                    $contador_anios++;
                                  }
                                  $total_fila += $rowareas['total_ant'];//se añade lo de años anteriores
                                  $total_anio_ant += $rowareas['total_ant'];
                                  $tot=$tot+$rowareas['total_ant'];

                                  array_push($total, $total_fila);
                                  $totalgraficaeje=$total_fila;
                                  array_push($graficapie1,"{ name: '".$rowareas['TipoMedio']."', y: ".$totalgraficaeje."},");
                                }else{
                                  array_push($total, $rowareas['total']);
                                   $totalgraficaeje=$rowareas['total'];
                                   array_push($graficapie1,"{ name: '".$rowareas['TipoMedio']."', y: ".$totalgraficaeje."},");
                                  $tot=$tot+$rowareas['total'];
                                }

                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['TipoMedio'] . '</td>';
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){
                                    echo '<td style="font-size:.6em;"><a href="Lista.php?F_IdTipoMedio='.$rowareas['idTipoMedio'].'&F_IdAnio='.$key.'&'.$MisParam.'">'.number_format($rowareas['total'.$key],2).'</a></td>';
                                  }
                                  echo '<td style="font-size:.6em;">  '.number_format($rowareas['total_ant'],2).'</td>';//anios anteriores
                                  echo '<td style="font-size:.6em;"><a href="Lista.php?F_IdTipoMedio='.$rowareas['idTipoMedio'].'&F_IdAnio=Todos&'.$MisParam.'">'.number_format($total_fila,2).'</a></td>';//$AnioActual
                                }else{
                                  echo '<td style="font-size:.6em;"><a href="Lista.php?F_IdTipoMedio='.$rowareas['idTipoMedio'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">'.number_format($rowareas['total'],2).'</a></td>';
                                }

                                echo '</tr>';
                            }
                        } elseif ($tipo == 12) {//----------------------------------------Ver por Tipo Medio--------------------------------------------
                          $totales_ = "";
                          $anio_aux = "";
                          if ($_GET['F_IdAnio'] == "Todos"){
                            foreach ($ultimos_3_anios as $key ){
                              $where_local="   AND n.FechaPublicacion BETWEEN '$key/01/01 00:00:00' AND '$key/12/31 23:59:59' ";
                              $totales_ .= "  (SELECT if (ISNULL(sum( n.Reach )),0, sum( n.Reach )) FROM c_noticia n  WHERE n.idTipoMedio=tm.idTipoMedio ".$where_local." ) AS total$key ,  ";
                              $anio_aux = $key;
                            }
                            $where_local="   AND n.FechaPublicacion BETWEEN '$ult_anio/01/01 00:00:00' AND '$anio_aux/01/01 00:00:00' ";
                            $totales_ .= "   (SELECT if (ISNULL(sum( n.Reach )),0, sum( n.Reach ))  FROM c_noticia n WHERE n.idTipoMedio=tm.idTipoMedio ".$where_local." ) AS total_ant ,  ";
                          }else{
                            $totales_ = "if (ISNULL(sum( n.Reach )),0, sum( n.Precio )) AS total, ";
                          }
                            $tmedio = "SELECT $totales_ n.idTipoMedio, tm.Nombre AS TipoMedio
                                FROM c_noticia n LEFT JOIN c_tipoMedio tm ON n.idTipoMedio=tm.idTipoMedio
                                ".$VarWhere."
                                GROUP BY TipoMedio  ";
                            //echo $tmedio;
                            $resultanio = $catalogo->obtenerLista($tmedio);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                $total_fila = 0;
                                $contador_anios = 0;
                                array_push($categorias, $rowareas['TipoMedio']);

                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){
                                    $total_fila += $rowareas['total'.$key];
                                    $tot=$tot+$rowareas['total'.$key];
                                    if($contador_anios == 0)
                                      $total_anio1 += $rowareas['total'.$key];
                                      if($contador_anios == 1)
                                        $total_anio2 += $rowareas['total'.$key];
                                        if($contador_anios == 2)
                                          $total_anio3 += $rowareas['total'.$key];
                                    $contador_anios++;
                                  }
                                  $total_fila += $rowareas['total_ant'];//se añade lo de años anteriores
                                  $total_anio_ant += $rowareas['total_ant'];
                                  $tot=$tot+$rowareas['total_ant'];
                                  array_push($total, $total_fila);
                                  $totalgraficaeje=$total_fila;
                                  array_push($graficapie1,"{ name: '".$rowareas['TipoMedio']."', y: ".$totalgraficaeje."},");
                                }else{
                                  array_push($total, $rowareas['total']);
                                  $totalgraficaeje=$rowareas['total'];
                                  array_push($graficapie1,"{ name: '".$rowareas['TipoMedio']."', y: ".$totalgraficaeje."},");
                                  $tot=$tot+$rowareas['total'];
                                }

                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['TipoMedio'] . '</td>';
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){
                                    echo '<td style="font-size:.6em;"><a href="Lista.php?F_IdTipoMedio='.$rowareas['idTipoMedio'].'&F_IdAnio='.$key.'&'.$MisParam.'">'.number_format($rowareas['total'.$key],2).'</a></td>';
                                  }
                                  echo '<td style="font-size:.6em;">  '.number_format($rowareas['total_ant'],2).'</td>';//anios anteriores
                                  echo '<td style="font-size:.6em;"><a href="Lista.php?F_IdTipoMedio='.$rowareas['idTipoMedio'].'&F_IdAnio=Todos&'.$MisParam.'">'.number_format($total_fila,2).'</a></td>';//$AnioActual
                                }else{
                                  echo '<td style="font-size:.6em;"><a href="Lista.php?F_IdTipoMedio='.$rowareas['idTipoMedio'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">'.number_format($rowareas['total'],2).'</a></td>';
                                }

                                echo '</tr>';

                            }
                        } elseif ($tipo == 14) {//----------------------------------------Ver por valor real--------------------------------------------
                          $totales_ = "";
                          $anio_aux = "";
                          if ($_GET['F_IdAnio'] == "Todos"){
                            foreach ($ultimos_3_anios as $key ){
                              $where_local="   AND n.FechaPublicacion BETWEEN '$key/01/01 00:00:00' AND '$key/12/31 23:59:59' ";
                              $totales_ .= "  (SELECT if (ISNULL(sum( n.PrecioReal )),0, sum( n.PrecioReal )) FROM c_noticia n  WHERE n.idTipoMedio=tm.idTipoMedio ".$where_local." ) AS total$key ,  ";
                              $anio_aux = $key;
                            }
                            $where_local="   AND n.FechaPublicacion BETWEEN '$ult_anio/01/01 00:00:00' AND '$anio_aux/01/01 00:00:00' ";
                            $totales_ .= "   (SELECT if (ISNULL(sum( n.PrecioReal )),0, sum( n.PrecioReal )) FROM c_noticia n WHERE n.idTipoMedio=tm.idTipoMedio ".$where_local." ) AS total_ant ,  ";
                          }else{
                            $totales_ = "if (ISNULL(sum( n.PrecioReal )),0, sum( n.PrecioReal )) AS total, ";
                          }
                            $tmedio = "SELECT $totales_ n.idTipoMedio, tm.Nombre AS TipoMedio
                                FROM c_noticia n  LEFT JOIN c_tipoMedio tm ON n.idTipoMedio=tm.idTipoMedio
                                ".$VarWhere."
                                GROUP BY TipoMedio  ";
                            //echo $tmedio;
                            $resultanio = $catalogo->obtenerLista($tmedio);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                $total_fila = 0;
                                $contador_anios = 0;
                                array_push($categorias, $rowareas['TipoMedio']);

                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){
                                    $total_fila += $rowareas['total'.$key];
                                    $tot=$tot+$rowareas['total'.$key];
                                    if($contador_anios == 0)
                                      $total_anio1 += $rowareas['total'.$key];
                                      if($contador_anios == 1)
                                        $total_anio2 += $rowareas['total'.$key];
                                        if($contador_anios == 2)
                                          $total_anio3 += $rowareas['total'.$key];
                                    $contador_anios++;
                                  }
                                  $total_fila += $rowareas['total_ant'];//se añade lo de años anteriores
                                  $total_anio_ant += $rowareas['total_ant'];
                                  $tot=$tot+$rowareas['total_ant'];

                                  array_push($total, $total_fila);
                                  $totalgraficaeje=$total_fila;
                                  array_push($grafica_vr,"{ name: '".$rowareas['TipoMedio']."', y: ".$totalgraficaeje."},");
                                }else{
                                  array_push($total, $rowareas['total']);
                                   $totalgraficaeje=$rowareas['total'];
                                   array_push($grafica_vr,"{ name: '".$rowareas['TipoMedio']."', y: ".$totalgraficaeje."},");
                                  $tot=$tot+$rowareas['total'];
                                }

                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['TipoMedio'] . '</td>';
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){
                                    echo '<td style="font-size:.6em;"><a href="Lista.php?F_IdTipoMedio='.$rowareas['idTipoMedio'].'&F_IdAnio='.$key.'&'.$MisParam.'">'.number_format($rowareas['total'.$key],2).'</a></td>';
                                  }
                                  echo '<td style="font-size:.6em;"> '.number_format($rowareas['total_ant'],2).'</td>';//anios anteriores
                                  echo '<td style="font-size:.6em;"><a href="Lista.php?F_IdTipoMedio='.$rowareas['idTipoMedio'].'&F_IdAnio=Todos&'.$MisParam.'">'.number_format($total_fila,2).'</a></td>';//$AnioActual
                                }else{
                                  echo '<td style="font-size:.6em;"><a href="Lista.php?F_IdTipoMedio='.$rowareas['idTipoMedio'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">'.number_format($rowareas['total'],2).'</a></td>';
                                }

                                echo '</tr>';

                            }
                            $totales_ = "";
                            $anio_aux = "";
                            if ($_GET['F_IdAnio'] == "Todos"){
                              foreach ($ultimos_3_anios as $key ){
                                $where_local="   AND n.FechaPublicacion BETWEEN '$key/01/01 00:00:00' AND '$key/12/31 23:59:59' ";
                                $totales_ .= "  (SELECT if (ISNULL(sum( n.Reach )),0, sum( n.Reach )) FROM c_noticia n  WHERE n.idTipoMedio=tm.idTipoMedio ".$where_local." ) AS total$key ,  ";
                                $anio_aux = $key;
                              }
                              $where_local="   AND n.FechaPublicacion BETWEEN '$ult_anio/01/01 00:00:00' AND '$anio_aux/01/01 00:00:00' ";
                              $totales_ .= "   (SELECT if (ISNULL(sum( n.Reach )),0, sum( n.Reach ))  FROM c_noticia n WHERE n.idTipoMedio=tm.idTipoMedio ".$where_local." ) AS total_ant ,  ";
                            }else{
                              $totales_ = "if (ISNULL(sum( n.Reach )),0, sum( n.Precio )) AS total, ";
                            }
                              $tmedio = "SELECT $totales_ n.idTipoMedio, tm.Nombre AS TipoMedio
                                  FROM c_noticia n LEFT JOIN c_tipoMedio tm ON n.idTipoMedio=tm.idTipoMedio
                                  ".$VarWhere."
                                  GROUP BY TipoMedio  ";
                              //echo $tmedio;
                              $resultanio = $catalogo->obtenerLista($tmedio);
                              while ($rowareas = mysqli_fetch_array($resultanio)) {
                                  $total_fila_1 = 0;

                                  if ($_GET['F_IdAnio'] == "Todos"){
                                    foreach ($ultimos_3_anios as $key ){
                                      $total_fila_1 += $rowareas['total'.$key];
                                    }

                                    $totalgraficaeje_1=$total_fila_1;
                                    array_push($grafica_vc,"{ name: '".$rowareas['TipoMedio']."', y: ".$totalgraficaeje_1."},");
                                  }else{
                                    $totalgraficaeje_1=$rowareas['total'];
                                    array_push($grafica_vc,"{ name: '".$rowareas['TipoMedio']."', y: ".$totalgraficaeje_1."},");

                                  }
                              }

                        }elseif ($tipo == 15) {//----------------------------------------Ver por origen museo--------------------------------------------
                          $totales_ = "";
                          $anio_aux = "";
                          if ($_GET['F_IdAnio'] == "Todos"){
                            foreach ($ultimos_3_anios as $key ){
                              $where_local="   AND n.FechaPublicacion BETWEEN '$key/01/01 00:00:00' AND '$key/12/31 23:59:59' ";
                              $totales_ .= "  IF (ISNULL(n.Variable1),(SELECT COUNT(*) FROM c_noticia n  WHERE n.Variable1 IS null $where_local and n.origen='Museo' ),
                                              (SELECT COUNT(*) FROM c_noticia noti  WHERE noti.Variable1=n.Variable1  ".$where_local." and noti.origen='Museo' )) AS total$key ,  ";
                              $anio_aux = $key;
                            }
                            $anio_aux=$anio_aux-1;
                            $where_local="   AND n.FechaPublicacion BETWEEN '$ult_anio/01/01 00:00:00' AND '$anio_aux/12/31 23:59:59' ";
                            $totales_ .= "   IF (ISNULL(n.Variable1),(SELECT COUNT(*) FROM c_noticia n  WHERE n.Variable1 IS null $where_local  and n.origen='Museo' ),
                                             (SELECT COUNT(*) FROM c_noticia noti  WHERE noti.Variable1=n.Variable1 ".$where_local." and noti.origen='Museo' )) AS total_ant ,  ";
                          }else{
                            $totales_ = "count( * ) AS total, ";
                          }
                            $expoTemp = "SELECT $totales_
                                if(isnull(n.Variable1),'Sin informacion',n.Variable1)   AS var
                                FROM c_noticia n
                                ".$VarWhere." and n.origen='Museo'
                                GROUP BY n.Variable1  ";
                            $resultanio = $catalogo->obtenerLista($expoTemp);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                $total_fila = 0;
                                $contador_anios = 0;
                                array_push($categorias, $rowareas['var']);
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){
                                    $total_fila += $rowareas['total'.$key];
                                    $tot=$tot+$rowareas['total'.$key];
                                    if($contador_anios == 0)
                                      $total_anio1 += $rowareas['total'.$key];
                                      if($contador_anios == 1)
                                        $total_anio2 += $rowareas['total'.$key];
                                        if($contador_anios == 2)
                                          $total_anio3 += $rowareas['total'.$key];
                                    $contador_anios++;
                                  }
                                  $total_fila += $rowareas['total_ant'];//se añade lo de años anteriores
                                  $total_anio_ant += $rowareas['total_ant'];
                                  $tot=$tot+$rowareas['total_ant'];

                                  array_push($total, $total_fila);
                                }else{
                                  array_push($total, $rowareas['total']);
                                  $tot=$tot+$rowareas['total'];
                                }

                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['var'] . '</td>';
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){

                                    echo '<td><a href="Lista.php?Origen=Museo&variable='.$rowareas['var'].'&F_IdAnio='.$key.'&'.$MisParam.'">' . $rowareas['total'.$key] . '</a></td>';
                                  }
                                  echo '<td>  '.$rowareas['total_ant'].'</td>';//anios anteriores
                                  echo '<td><a href="Lista.php?Origen=Museo&variable='.$rowareas['var'].'&F_IdAnio=Todos&'.$MisParam.'">'.$total_fila.'</a></td>';//$AnioActual
                                }else{
                                  echo '<td><a href="Lista.php?Origen=Museo&variable='.$rowareas['var'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">' . $rowareas['total'] . '</a></td>';
                                }

                                echo '</tr>';
                            }
                        }elseif ($tipo == 16) {//----------------------------------------Ver por otro origen--------------------------------------------
                          $totales_ = "";
                          $anio_aux = "";
                          if ($_GET['F_IdAnio'] == "Todos"){
                            foreach ($ultimos_3_anios as $key ){
                              $where_local="   AND n.FechaPublicacion BETWEEN '$key/01/01 00:00:00' AND '$key/12/31 23:59:59' ";
                              $totales_ .= "  IF (ISNULL(n.Variable1),(SELECT COUNT(*) FROM c_noticia n  WHERE n.Variable1 IS null $where_local ),
                                              (SELECT COUNT(*) FROM c_noticia noti  WHERE noti.Variable1=n.Variable1  ".$where_local." )) AS total$key ,  ";
                              $anio_aux = $key;
                            }
                            $anio_aux=$anio_aux-1;
                            $where_local="   AND n.FechaPublicacion BETWEEN '$ult_anio/01/01 00:00:00' AND '$anio_aux/12/31 23:59:59' ";
                            $totales_ .= "   IF (ISNULL(n.Variable1),(SELECT COUNT(*) FROM c_noticia n  WHERE n.Variable1 IS null $where_local ),
                                             (SELECT COUNT(*) FROM c_noticia noti  WHERE noti.Variable1=n.Variable1 AND noti.FechaPublicacion ".$where_local." )) AS total_ant ,  ";
                          }else{
                            $totales_ = "count( * ) AS total, ";
                          }
                            $expoTemp = "SELECT $totales_
                                if(isnull(n.Variable1),'Sin informacion',n.Variable1)   AS var
                                FROM c_noticia n
                                ".$VarWhere." and origen='Otro'
                                GROUP BY n.Variable1  ";
                            $resultanio = $catalogo->obtenerLista($expoTemp);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                $total_fila = 0;
                                $contador_anios = 0;
                                array_push($categorias, $rowareas['var']);
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){
                                    $total_fila += $rowareas['total'.$key];
                                    $tot=$tot+$rowareas['total'.$key];
                                    if($contador_anios == 0)
                                      $total_anio1 += $rowareas['total'.$key];
                                      if($contador_anios == 1)
                                        $total_anio2 += $rowareas['total'.$key];
                                        if($contador_anios == 2)
                                          $total_anio3 += $rowareas['total'.$key];
                                    $contador_anios++;
                                  }
                                  $total_fila += $rowareas['total_ant'];//se añade lo de años anteriores
                                  $total_anio_ant += $rowareas['total_ant'];
                                  $tot=$tot+$rowareas['total_ant'];

                                  array_push($total, $total_fila);
                                }else{
                                  array_push($total, $rowareas['total']);
                                  $tot=$tot+$rowareas['total'];
                                }

                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['var'] . '</td>';
                                if ($_GET['F_IdAnio'] == "Todos"){
                                  foreach ($ultimos_3_anios as $key ){

                                    echo '<td><a href="Lista.php?Origen=otro&variable='.$rowareas['var'].'&F_IdAnio='.$key.'&'.$MisParam.'">' . $rowareas['total'.$key] . '</a></td>';
                                  }
                                  echo '<td>  '.$rowareas['total_ant'].'</td>';//anios anteriores
                                  echo '<td><a href="Lista.php?Origen=otro&variable='.$rowareas['var'].'&F_IdAnio=Todos&'.$MisParam.'">'.$total_fila.'</a></td>';//$AnioActual
                                }else{
                                  echo '<td><a href="Lista.php?Origen=otro&variable='.$rowareas['var'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">' . $rowareas['total'] . '</a></td>';
                                }

                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">
                              <?php
                              $tipografica = "";
                              if ($tipo== 12 or $tipo == 13 or $tipo == 14) {
                                $tipografica = "Total";
                              }else{
                                $tipografica = "Total de ".$nombre;
                              }
                              ?>
                              <?php echo $tipografica; ?></th>
                            <?php if($_GET['F_IdAnio'] == "Todos" && $tipo != 3){
                              if ($tipo== 12 or $tipo == 13 or $tipo == 14) {
                                echo "<th style='font-size:.6em;'><a href='Lista.php?F_IdAnio=$anio1&$MisParam'>";
                                echo number_format($total_anio1,2);
                                echo "</a></th>";
                                echo "<th style='font-size:.6em;'><a href='Lista.php?F_IdAnio=$anio2&$MisParam'>";
                                echo number_format($total_anio2,2);
                                echo "</a></th>";
                                echo "<th style='font-size:.6em;'><a href='Lista.php?F_IdAnio=$anio3&$MisParam'>";
                                echo number_format($total_anio3,2);
                                echo "</a></th>";
                                echo "<th style='font-size:.6em;'>";
                                echo number_format($total_anio_ant,2);
                                echo "</th>";
                              }else{
                                echo "<th><a href='Lista.php?F_IdAnio=$anio1&$MisParam'>$total_anio1</a></th>
                                      <th><a href='Lista.php?F_IdAnio=$anio2&$MisParam'>$total_anio2</a></th>
                                      <th><a href='Lista.php?F_IdAnio=$anio3&$MisParam'>$total_anio3</a></th>
                                      <th>$total_anio_ant</th>";

                              }


                            }?>
                            <?php
                              if ($tipo== 12 or $tipo == 13 or $tipo == 14) {
                                ?>
                                <th scope="col" style="font-size:.6em;"><?php echo '<a href="Lista.php?F_IdAnio='.$AnioActual.'&'.$MisParam.'">' .number_format($tot,2) . '</a>'; ?></th>
                                <?php
                              }else{
                                ?>
                                <th scope="col"><?php echo '<a href="Lista.php?F_IdAnio='.$AnioActual.'&'.$MisParam.'">' . $tot . '</a>'; ?></th>
                                <?php
                              }
                              ?>
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
</body>
<?php
    $tipograficagrafica = "";

      if ($tipo== 12 ) {//or $tipo ==13 or $tipo ==14
          $tipograficagrafica = "'pie'";
      }else{
          $tipograficagrafica = "'bar'";
      }



?>
    <script>
    <?php if($tipo == 14 ){  ?>
      Highcharts.chart('container', {
          chart: { type: 'column'  },
          title: { text: 'Valor comercial vs real' },
          xAxis: { categories: [<?php   foreach ($categorias as $clave => $valor) { echo  "'".trim($valor)."', "; }?>] },
          yAxis: { min: 0, title: { text: '<?php echo $Aplicacion; ?>'  } },
          plotOptions: {
          column: {
              pointPadding: 0.2,
              borderWidth: 0
            }
          },
          series: [{  name: 'Valor comercial' ,
                      data: [<?php foreach ($grafica_vc as $clave => $valor) {
          echo  $valor;}?>
          ]
        },{
           name: 'Real' ,
                    data: [<?php foreach ($grafica_vr as $clave => $valor) {
        echo  $valor;}?>
        ]
      }
      ]
      });
    <?php  }else{  ?>


        Highcharts.chart('container', {
            chart: { type: <?php echo $tipograficagrafica; ?>  },
            title: { text: '<?php echo $Aplicacion; ?> por <?php echo $nombre; ?>' },
            xAxis: { categories: [<?php   foreach ($categorias as $clave => $valor) { echo  "'".trim($valor)."', "; }?>] },
            yAxis: { min: 0, title: { text: '<?php echo $Aplicacion; ?>'  } },
            legend: { reversed: false  },
            plotOptions: { series: { stacking: 'normal' } },
            <?php
            if ($tipo== 12 or $tipo==13 or $tipo==14) {
            ?>
            series: [{  name: '' ,
                        data: [<?php foreach ($graficapie1 as $clave => $valor) {
            echo  $valor;}?>
            ]
            }]
            <?php
            }else{
            ?>
            series: [{  name: '<?php echo $tot;?> <?php echo $Aplicacion; ?>' ,
                        data: [<?php   foreach ($total as $clave => $valor) { echo  $valor.", "; }?>]
            }]

        <?php
            }
        ?>
        });

  <?php } ?>

    </script>
</html>
