<?php
session_start();
include_once('../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$tot = 0;
$categorias = array();
$total = array();
$ejearea = 0;
$evitar_repetidos = "";
$array_problematica = array(0,0,0);
$array_solicitud = array(0,0,0);
$array_conocimiento = array(0,0,0);
$array_sugerencia = array(0,0,0);
$tipos  =array (4,1,2,3);
$pocentajes = array();
$avance = 0;
$AnioActual=date("Y"); //Año actual para mostrar por default
if(isset($_GET['ideje'])){
  $ideje = $_GET['ideje'];
  $ejearea = 2;
  $idejearea = $ideje;
  $th = "Eje";
  $muestrainfo = "muestradetalle($ideje,1,0)";
}
if(isset($_GET['idarea'])){
  $idarea = $_GET['idarea'];
  $ejearea = 1;
  $idejearea = $idarea;
  $th = "Área";
  $muestrainfo = "muestradetalle($idarea,2,0)";
}
if(isset($_GET['tipo'])){
  $tipo = $_GET['tipo'];
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>

<body>



    <?php
    $totales_consulta = "SELECT COUNT(*) AS total , con.tipo , con.estatus  FROM k_conversacion con
                        GROUP BY con.tipo , con.estatus";


      $res = $catalogo->obtenerLista($totales_consulta);
      while ($rows = mysqli_fetch_array($res)){
        switch ($rows['tipo']) {
          case 1://solicitud
            if($rows['estatus'] == '1')
              $array_solicitud[0] = $rows['total'] ;
            elseif($rows['estatus'] == '2')
              $array_solicitud[1] = $rows['total'] ;
            else
              $array_solicitud[2] += $rows['total']  ;
            break;
          case 2://conocimiento
            if($rows['estatus'] == '1')
              $array_conocimiento[0] = $rows['total'] ;
            elseif($rows['estatus'] == '2')
              $array_conocimiento[1] = $rows['total'] ;
            else
              $array_conocimiento[2] += $rows['total']  ;
              break;
          case 3://sugerencia
            if($rows['estatus'] == '1')
              $array_sugerencia[0] = $rows['total'] ;
            elseif($rows['estatus'] == '2')
              $array_sugerencia[1] = $rows['total'] ;
            else
              $array_sugerencia[2] += $rows['total']  ;
              break;
          case 4://Problematica
            if($rows['estatus'] == '1')
              $array_problematica[0] = $rows['total'] ;
            elseif($rows['estatus'] == '2')
              $array_problematica[1] = $rows['total'] ;
            else
              $array_problematica[2] += $rows['total']  ;
            break;
        }
      }
      $array_problematica[3] = $array_problematica[0]+$array_problematica[1]+$array_problematica[2];
      $array_solicitud[3] = $array_solicitud[0]+$array_solicitud[1]+$array_solicitud[2];
      $array_conocimiento[3] = $array_conocimiento[0]+$array_conocimiento[1]+$array_conocimiento[2];
      $array_sugerencia[3] = $array_sugerencia[0]+$array_sugerencia[1]+$array_sugerencia[2];
      $total = $array_problematica[3]+$array_solicitud[3]+$array_conocimiento[3]+$array_sugerencia[3];
      $pocentajes[1] = ($array_problematica[3] * 100) / $total;
      $pocentajes[2] = ($array_solicitud[3] * 100) / $total;;
      $pocentajes[3] = ($array_conocimiento[3] * 100) / $total;;
      $pocentajes[4] = ($array_sugerencia[3] * 100) / $total;;

     ?>
    <div class="row">
        <div >
                <div class="col-md-12 col-sm-12 col-xs-12" id="recargar">
                <table id="tablaasuntos_refresh" class="table table-striped table-bordered" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th style="border-right: solid" class="celdas"><?php if(isset($_GET['idarea']))echo 'Área';else echo 'Eje'?></th>
                        <th style="border-right: solid;" class="celdas" scope="col" colspan="3">Pr &nbsp;(<?php echo $array_problematica[3].") (".round($pocentajes[1], 2); ?>%) </th>
                        <th style="border-right: solid;" class="celdas" scope="col" colspan="3">Sol &nbsp;(<?php echo $array_solicitud[3].") (".round($pocentajes[2], 2); ?>%)</th>
                        <th style="border-right: solid;" class="celdas" scope="col" colspan="3">Con &nbsp;(<?php echo $array_conocimiento[3].") (".round($pocentajes[3], 2); ?>%)</th>
                        <th style="border-right: solid;" class="celdas" scope="col" colspan="3">Sug &nbsp;(<?php echo $array_sugerencia[3].") (".round($pocentajes[4], 2); ?>%)</th>
                        <th class="celdas" >Total (<?php echo $total; ?>)</th>
                    </tr>
                    <tr>
                      <th style="border-right: solid;" class="celdas"></th>
                      <th style="background-color: #76c65a;" class="celdas">Res</th>
                      <th style="background-color: #fbf44e;" class="celdas">Conv</th>
                      <th style="background-color: #e65f5f;border-right: solid" class="celdas">Snleer</th>
                      <th style="background-color: #76c65a;" class="celdas">Res</th>
                      <th style="background-color: #fbf44e;" class="celdas">Conv</th>
                      <th style="background-color: #e65f5f;border-right: solid" class="celdas">Snleer</th>
                      <th style="background-color: #76c65a;" class="celdas">Res</th>
                      <th style="background-color: #fbf44e;" class="celdas">Conv</th>
                      <th style="background-color: #e65f5f;border-right: solid" class="celdas">Snleer</th>
                      <th style="background-color: #76c65a;" class="celdas">Res</th>
                      <th style="background-color: #fbf44e;" class="celdas">Conv</th>
                      <th style="background-color: #e65f5f;border-right: solid" class="celdas">Snleer</th>
                      <th></th>

                    </tr>

                </thead>
                <tbody>

                <?php


                if(isset($_GET['idarea'])){//area
                  $consulta = "  SELECT area.Nombre AS nombre , area.Id_Area
                            from c_area area WHERE area.estatus = 1  order by area.Id_Area";
                }else{
                  $consulta = " SELECT concat(eje.idEje,'.-',eje.Nombre) AS nombre , eje.idEje
                            from c_eje eje order by eje.idEje";
                }

                $resulteje = $catalogo->obtenerLista($consulta);
                $cont = 0;
                while ($rs = mysqli_fetch_array($resulteje)) {
                  $cont++;
                  if(isset($_GET['idarea'])){
                    $id = $rs['Id_Area'];
                    $where_avance = "a.IdArea = $id";
                  }
                  else{
                    $id = $rs['idEje'];
                    $where_avance = "a.IdEje = $id";
                  }
                  $consulta_avance = "  SELECT  if(AVG(chani.Avance) IS NULL,0,ROUND(AVG(chani.Avance),1)) total
                                        FROM k_checklist_actividad cha
                                        JOIN c_checkList ch ON ch.IdCheckList=cha.IdCheckList
                                        JOIN c_actividad a ON a.IdActividad=cha.IdActividad
                                        LEFT JOIN k_checkList_anios chani ON chani.IdCheckList=cha.IdCheckList
                                        LEFT JOIN k_actividad_anios acani ON acani.IdActividad=cha.IdActividad
                                        LEFT JOIN k_categoriasdeejes_anios caani ON caani.idCategoria=a.Idcategoria
                                        WHERE (a.Anio=2021)
                                        AND ((ch.Nivel=2) OR (ch.Nivel=1 AND ch.Tipo=1))
                                        AND chani.Visible<>0 AND chani.Anio=2021
                                        AND acani.Visible<>0 AND acani.Anio=2021
                                        AND caani.Visible<>0 AND caani.Anio=2021
                                        AND $where_avance ";


                    $resul_avance = $catalogo->obtenerLista($consulta_avance);
                    while ($row_avance = mysqli_fetch_array($resul_avance)){
                      $avance = $row_avance['total'];
                    }


                    echo  "<tr id='".$id."'>";
                    if(isset($_GET['idarea']))
                      echo "<td onclick='muestradetalle(".$id.",2,1)' style='cursor:pointer;border-right: solid;' class='celdas'><b>".$rs['nombre']."&nbsp;&nbsp;&nbsp;&nbsp; </b> ($avance%)</td>";//<a href='estadisticas.php?ejearea=1&idejearea=$id'><i class='fa fa-bar-chart fa-3' aria-hidden='true'></i></a>
                    else
                      echo "<td onclick='muestradetalle(".$id.",1,1)' style='cursor:pointer;border-right: solid;' class='celdas' ><b>".$rs['nombre']."</b> ($avance%)</td>";
                      $total_fila = 0;
                      $pendientes_fila = 0;
                      foreach ($tipos as $key) {

                        $join = "";

                        if($tipo == 1){
                          $origendestino = "con.idOrigen";
                        }
                        if($tipo == 2){
                          $origendestino = "con.idDestino";
                          $evitar_repetidos = " AND con.idOrigen <> $id ";
                        }
                        if($tipo == 3){
                          $origendestino = "conva.idArea";
                          $join = " JOIN k_conversacionArea conva ON con.idConversacion = conva.idConversacion AND conva.idArea NOT IN (con.idOrigen,con.idDestino) ";
                        }

                                      if(isset($_GET['idarea'])){
                                        $datos = "SELECT
                                                 (SELECT  COUNT(*) AS total
                                                 from k_conversacion con $join
                                                      WHERE con.tipo = $key AND con.estatus = 1 AND $origendestino = $id $evitar_repetidos) AS sinleer,

                                                  (SELECT  COUNT(*) AS total
                                                 from k_conversacion con $join
                                                      WHERE con.tipo = $key AND con.estatus = 2 AND $origendestino = $id $evitar_repetidos) AS enconv,

                                                (SELECT  COUNT(*) AS total
                                                 from k_conversacion con $join
                                                      WHERE con.tipo = $key AND con.estatus IN (3,4) AND $origendestino = $id $evitar_repetidos) AS resuelto	";
                                      }else{
                                        $datos = "SELECT
                                                 (SELECT  COUNT(*) AS total
                                                 from k_conversacion con JOIN k_conversacionActividad conac ON con.idConversacion = conac.idConversacion
                                                      WHERE con.tipo = $key AND con.estatus = 1 AND conac.idEje = $id) AS sinleer,

                                                  (SELECT  COUNT(*) AS total
                                                 from k_conversacion con JOIN k_conversacionActividad conac ON con.idConversacion = conac.idConversacion
                                                      WHERE con.tipo = $key AND con.estatus = 2 AND conac.idEje = $id) AS enconv,

                                                (SELECT  COUNT(*) AS total
                                                 from k_conversacion con JOIN k_conversacionActividad conac ON con.idConversacion = conac.idConversacion
                                                      WHERE con.tipo = $key AND con.estatus IN (3,4) AND conac.idEje = $id) AS resuelto";
                                      }
                        $resdatos = $catalogo->obtenerLista($datos);

                        while ($rs1 = mysqli_fetch_array($resdatos)){
                          $color_amarillo = "";
                          $color_rojo = "";
                          if($rs1['enconv'] > 0)
                            $color_amarillo = "background-color: #fbf44e;";
                          if($rs1['sinleer'] > 0)
                              $color_rojo = "background-color: #e07878;";
                            echo "<td class='celdas' ><a href='#' onclick='muestraDetalle_modal(".$ejearea.",".$idejearea.",$tipo,0,0,".$key.",3,0)'>".$rs1['resuelto']."</a></td>";
                            echo "<td style='$color_amarillo' class='celdas' ><a href='#' onclick='muestraDetalle_modal(".$ejearea.",".$idejearea.",$tipo,0,0,".$key.",2,0)'>".$rs1['enconv']."</a></td>";
                            echo "<td style='border-right: solid;$color_rojo' class='celdas' ><a href='#' onclick='muestraDetalle_modal(".$ejearea.",".$idejearea.",$tipo,0,0,".$key.",1,0)'>".$rs1['sinleer']."</a></td>";
                            $total_fila += $rs1['resuelto'] + $rs1['enconv'] + $rs1['sinleer'];
                            $pendientes_fila +=  $rs1['enconv'] + $rs1['sinleer'];
                        }
                      }
                      $porcentaje = round(($total_fila * 100) / $total,1);
                  echo "<td class='celdas'> <a style='cursor: pointer;' onclick='muestraDetalle_modal(".$ejearea.",".$id.",$tipo,0,0,0,8,0)'>$total_fila </a> ($porcentaje%) / <a style='cursor: pointer;' onclick='muestraDetalle_modal(".$ejearea.",".$id.",$tipo,0,0,0,7,0)'> $pendientes_fila </a> </td>";
                  echo  "</tr>";

                }
            ?>
          </tbody>

                </table>
            </div>



        </div>
    </div>
    </body>

<script>

$(document).ready(function () {
    $('#tablaasuntos_refresh').DataTable(
        {
            "language":
            {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
            },
            bAutoWidth: false,
                aoColumns : [
                  { sWidth: '17.2%'},
                  { sWidth: '5.66%' },
                  { sWidth: '5.66%' },
                  { sWidth: '5.66%' },
                  { sWidth: '5.66%' },
                  { sWidth: '5.66%' },
                  { sWidth: '5.66%' },
                  { sWidth: '5.66%' },
                  { sWidth: '5.66%' },
                  { sWidth: '5.66%' },
                  { sWidth: '5.66%' },
                  { sWidth: '5.66%' },
                  { sWidth: '5.76%' },
                  { sWidth: '14.7%' }
                  //  { sWidth: '30%' }
                ],
            "order": false,
            "paging": false,
            "searching": false,
            "bInfo": false,
            "ordering": false
            //"ordering": false
        });
});
<?php echo $muestrainfo; ?>
</script>

</html>
