<?php


session_start();
if(!isset($_SESSION['user_session']))
{
?>
<script>
    top.location.href="../../login.php";
    window.reload();
</script>
<?php
}
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$AnioActual=date("Y"); //Año actual para mostrar por default
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <?php
    $tipo = 0;
    $usuario = 0;
    $evitar_repetidos = "";
    if(isset($_GET['tipo'])){
      $tipo = $_GET['tipo'];
      if($tipo == 2)
        $enviados_recibidos = "recibidos";
        if($tipo == 1)
          $enviados_recibidos = "enviados";
          if($tipo == 3)
            $enviados_recibidos = "invitados";
    }


    if(isset($_GET['usr'])){
      $usuario = $_GET['usr'];
    }
    if(isset($_GET['ideje'])){
      $ejearea = 2;
      $idejearea = $_GET['ideje'];
      $ideje = $_GET['ideje'];
      $cons = "select CONCAT(eje.idEje,'.-',eje.Nombre) AS nombre from c_eje eje where idEje = $ideje";
      $resu= $catalogo->obtenerLista($cons);
      while ($rs = mysqli_fetch_array($resu)){
        $nombre = ' eje '.$rs['nombre'];
      }
      $por = "área";
      $th = "Área";
    }
    if(isset($_GET['idarea'])){
      $ejearea = 1;
      $idejearea = $_GET['idarea'];
      $idarea = $_GET['idarea'];
      $cons = "select ar.Nombre from c_area ar where ar.Id_Area = $idarea";
      $resu= $catalogo->obtenerLista($cons);
      while ($rs = mysqli_fetch_array($resu)){
        $nombre = ' área  <b>'.$rs['Nombre'].'</b>';
      }
      $por = "eje";
      $th = "Eje";
    }

    $array_problematica = array(0,0,0);
    $array_solicitud = array(0,0,0);
    $array_conocimiento = array(0,0,0);
    $array_sugerencia = array(0,0,0);
    $tipos  = array (4,1,2,3);
    $pocentajes = array();
    $where_adicional = "";

   ?>
   <script>
     nombrearea ='<?php echo $nombre; ?>';
   </script>
  <body>
    <?php
      $tabla = "";
      if($tipo != -1){ // carga normal
     ?>
     <div class="row">
       <legend id="AnioTitulo" style="text-align: center;">Asuntos <?php echo $enviados_recibidos; ?> del   <?php echo $nombre; ?>  por <?php echo $por; ?></legend>

     </div>
     <?php
     if($tipo == 1){
       $areaorigendestino = " JOIN k_conversacion con ON con.idOrigen = ar.Id_Area  ";
       $campoorigendestino = " con.idOrigen ";
       $from = "  k_conversacion con ";
     }
     if($tipo == 2){
       $areaorigendestino = " JOIN k_conversacion con ON con.idDestino = ar.Id_Area  ";
       $campoorigendestino = " con.idDestino ";
       if(!isset($_GET['ideje'])){
         $evitar_repetidos = " AND con.idOrigen <> $idarea ";
       }
       $from = "  k_conversacion con ";
     }
     if($tipo == 3){
       $areaorigendestino = " JOIN k_conversacionArea conva ON conva.idArea = ar.Id_Area
                              JOIN k_conversacion con ON con.idConversacion = conva.idConversacion ";
        $campoorigendestino = " conva.idArea ";
        $from = " k_conversacionArea conva JOIN k_conversacion con ON con.idConversacion = conva.idConversacion ";
     }

     if(isset($_GET['ideje'])){
       $consulta = "   SELECT ar.Nombre AS nombre , ar.Id_Area
                         from c_area ar
                         $areaorigendestino
                         JOIN k_conversacionActividad conac ON con.idConversacion = conac.idConversacion
                        WHERE ar.estatus = 1   AND conac.idEje = $ideje
                        GROUP BY ar.Id_Area
                        order by ar.Id_Area";
     }else{
       $consulta = "   SELECT  eje.idEje, CONCAT(eje.idEje,'.-',eje.Nombre) AS nombre
                         from  k_conversacion con
                         JOIN k_conversacionActividad conac ON con.idConversacion = conac.idConversacion
                         JOIN c_eje eje ON eje.idEje = conac.idEje
								 WHERE $campoorigendestino =  $idarea $evitar_repetidos
								 GROUP BY conac.idEje";
        if($tipo == 3){
          $consulta = "   SELECT  eje.idEje, CONCAT(eje.idEje,'.-',eje.Nombre) AS nombre
                         from c_eje eje
                         JOIN k_conversacionActividad conac ON eje.idEje = conac.idEje
                         JOIN k_conversacionArea conva ON conva.idConversacion = conac.idConversacion
                         JOIN k_conversacion con ON con.idConversacion = conva.idConversacion
								 WHERE  conva.idArea =  $idarea
								  GROUP BY conac.idEje";
        $campoorigendestino =  " conva.idArea ";
        $where_adicional = "  AND conva.idArea NOT IN (con.idOrigen,con.idDestino) ";
        }

     }

     $resul= $catalogo->obtenerLista($consulta);
     $cont = 0;
     while ($rs = mysqli_fetch_array($resul)){
       $cont++;
       if(isset($_GET['ideje'])){
         $id = $rs['Id_Area'];
         $idejearea_detalle = $id;
         $where_avance = " a.IdArea = $id";
       }else {
         $ideje = $rs['idEje'];
         $idejearea_detalle = $ideje;
         $id = $idarea;
         $where_avance = " a.IdEje = $ideje";
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
       $tabla .= "<tr>";
         $tabla .= "<td style='border-right: solid;'><b>".$rs['nombre']."</b>&nbsp; (avance $avance%)</td>";
         $total_fila = 0;
         $pendientes_fila = 0;
         foreach ($tipos as $key){


           $datos = "SELECT
                    (SELECT  COUNT(*) AS total
                    from $from  JOIN k_conversacionActividad conac ON con.idConversacion = conac.idConversacion
                         WHERE con.tipo = $key AND con.estatus = 1 AND $campoorigendestino = $id $evitar_repetidos  AND conac.idEje = $ideje $where_adicional ) AS sinleer,

                     (SELECT  COUNT(*) AS total
                    from $from JOIN k_conversacionActividad conac ON con.idConversacion = conac.idConversacion
                         WHERE con.tipo = $key AND con.estatus = 2 AND $campoorigendestino = $id $evitar_repetidos  AND conac.idEje = $ideje $where_adicional ) AS enconv,

                   (SELECT  COUNT(*) AS total
                    from $from JOIN k_conversacionActividad conac ON con.idConversacion = conac.idConversacion
                         WHERE con.tipo = $key AND con.estatus IN (3,4) AND $campoorigendestino = $id $evitar_repetidos  AND conac.idEje = $ideje $where_adicional ) AS resuelto	";
               $resdatos = $catalogo->obtenerLista($datos);

                   while ($rs1 = mysqli_fetch_array($resdatos)){
                     //if($ejearea == 1){

                     $color_amarillo = "";
                     $color_rojo = "";
                     if($rs1['enconv'] > 0)
                       $color_amarillo = "background-color: #fbf44e;";
                     if($rs1['sinleer'] > 0)
                         $color_rojo = "background-color: #e07878;";

                       $tabla .= "<td style='text-align: center;'><a href='#' onclick='muestraDetalle_modal(".$ejearea.",".$idejearea.",".$tipo.",0,0,".$key.",3,".$idejearea_detalle.")'>".$rs1['resuelto']."</a></td>";
                       $tabla .= "<td style='text-align: center;$color_amarillo'><a href='#' onclick='muestraDetalle_modal(".$ejearea.",".$idejearea.",".$tipo.",0,0,".$key.",2,".$idejearea_detalle.")'>".$rs1['enconv']."</a></td>";
                       $tabla .= "<td style='text-align: center;border-right: solid;$color_rojo'><a href='#' onclick='muestraDetalle_modal(".$ejearea.",".$idejearea.",".$tipo.",0,0,".$key.",1,".$idejearea_detalle.")'>".$rs1['sinleer']."</a></td>";
                     // }else{
                     //   $tabla .= "<td style='text-align: center;'>".$rs1['resuelto']."</td>";
                     //   $tabla .= "<td style='text-align: center;'>".$rs1['enconv']."</td>";
                     //   $tabla .= "<td style='text-align: center;border-right: solid;'>".$rs1['sinleer']."</td>";
                     // }

                         $total_fila += $rs1['resuelto'] + $rs1['enconv'] + $rs1['sinleer'];
                         $pendientes_fila +=  $rs1['enconv'] + $rs1['sinleer'];

                         if($key == 4){
                           $array_problematica[2] += $rs1['resuelto'];$array_problematica[1] += $rs1['enconv'];$array_problematica[0] += $rs1['sinleer'];
                         }
                         if($key == 1){
                           $array_solicitud[2] += $rs1['resuelto'];$array_solicitud[1] += $rs1['enconv'];$array_solicitud[0] += $rs1['sinleer'];
                         }
                          if($key == 2){
                            $array_conocimiento[2] += $rs1['resuelto'];$array_conocimiento[1] += $rs1['enconv'];$array_conocimiento[0] += $rs1['sinleer'];
                          }
                          if($key == 3){
                            $array_sugerencia[2] += $rs1['resuelto'];$array_sugerencia[1] += $rs1['enconv'];$array_sugerencia[0] += $rs1['sinleer'];
                          }


                   }
         }
         $tabla .= "<td style='text-align: center;'> <a style='cursor: pointer;' onclick='muestraDetalle_modal(".$ejearea.",".$idejearea.",$tipo,0,0,0,8,$idejearea_detalle)'> <span id='tot_$cont'>  $total_fila  </span> </a> <span id='porc_$cont'></span> / <a style='cursor: pointer;' onclick='muestraDetalle_modal(".$ejearea.",".$idejearea.",$tipo,0,0,0,7,$idejearea_detalle)'> $pendientes_fila </a> </td>";

       $tabla .= "</tr>";

     }
     $array_problematica[3] = $array_problematica[0]+$array_problematica[1]+$array_problematica[2];
     $array_solicitud[3] = $array_solicitud[0]+$array_solicitud[1]+$array_solicitud[2];
     $array_conocimiento[3] = $array_conocimiento[0]+$array_conocimiento[1]+$array_conocimiento[2];
     $array_sugerencia[3] = $array_sugerencia[0]+$array_sugerencia[1]+$array_sugerencia[2];
     $total = $array_problematica[3]+$array_solicitud[3]+$array_conocimiento[3]+$array_sugerencia[3];
     if($total == 0){
       $pocentajes[1] = 0;
       $pocentajes[2] = 0;
       $pocentajes[3] = 0;
       $pocentajes[4] = 0;
     }else{
       $pocentajes[1] = ($array_problematica[3] * 100) / $total;
       $pocentajes[2] = ($array_solicitud[3] * 100) / $total;
       $pocentajes[3] = ($array_conocimiento[3] * 100) / $total;
       $pocentajes[4] = ($array_sugerencia[3] * 100) / $total;
     }


      ?>
    <table id="tabladetalle" class="table table-striped table-bordered" style="width:100%">
      <thead class="thead-dark">
          <tr>
              <th style="text-align: center;border-right: solid;"><?php echo $th; ?></th>
              <th style="text-align: center;border-right: solid" scope="col" colspan="3">Problemática &nbsp;&nbsp;(<?php echo $array_problematica[3].") (".round($pocentajes[1], 2); ?>%) </th>
              <th style="text-align: center;border-right: solid" scope="col" colspan="3">Solicitud &nbsp;&nbsp;(<?php echo $array_solicitud[3].") (".round($pocentajes[2], 2); ?>%)</th>
              <th style="text-align: center;border-right: solid" scope="col" colspan="3">Conocimiento &nbsp;&nbsp;(<?php echo $array_conocimiento[3].") (".round($pocentajes[3], 2); ?>%)</th>
              <th style="text-align: center;border-right: solid" scope="col" colspan="3">Sugerencia &nbsp;&nbsp;(<?php echo $array_sugerencia[3].") (".round($pocentajes[4], 2); ?>%)</th>
              <th style="text-align: center;" >Total (<?php echo $total; ?>)</th>
          </tr>
          <tr>
            <th style="border-right: solid;"></th>
            <th style="background-color: #76c65a;text-align: center"><span style="font-size: .8em;">Resuelto</span>  <br>(<?php echo $array_problematica[2]; ?>)</th>
            <th style="background-color: #fbf44e;text-align: center"><span style="font-size: .7em;">Conversación</span> <br>(<?php echo $array_problematica[1]; ?>)</th>
            <th style="background-color: #e65f5f;text-align: center;border-right: solid"><span style="font-size: .8em;">Sin leer</span> <br>(<?php echo $array_problematica[0]; ?>)</th>
            <th style="background-color: #76c65a;text-align: center"><span style="font-size: .8em;">Resuelto</span>  <br>(<?php echo $array_solicitud[2]; ?>)</th>
            <th style="background-color: #fbf44e;text-align: center"><span style="font-size: .7em;">Conversación</span> <br>(<?php echo $array_solicitud[1]; ?>)</th>
            <th style="background-color: #e65f5f;text-align: center;border-right: solid"><span style="font-size: .8em;">Sin leer</span> <br>(<?php echo $array_solicitud[0]; ?>)</th>
            <th style="background-color: #76c65a;text-align: center"><span style="font-size: .8em;">Resuelto</span>  <br>(<?php echo $array_conocimiento[2]; ?>)</th>
            <th style="background-color: #fbf44e;text-align: center"><span style="font-size: .7em;">Conversación</span> <br>(<?php echo $array_conocimiento[1]; ?>)</th>
            <th style="background-color: #e65f5f;text-align: center;border-right: solid"><span style="font-size: .8em;">Sin leer</span> <br>(<?php echo $array_conocimiento[0]; ?>)</th>
            <th style="background-color: #76c65a;text-align: center"><span style="font-size: .8em;">Resuelto</span>  <br>(<?php echo $array_sugerencia[2]; ?>)</th>
            <th style="background-color: #fbf44e;text-align: center"><span style="font-size: .7em;">Conversación</span> <br>(<?php echo $array_sugerencia[1]; ?>)</th>
            <th style="background-color: #e65f5f;text-align: center;border-right: solid"><span style="font-size: .8em;">Sin leer</span> <br>(<?php echo $array_sugerencia[0]; ?>)</th>
            <th></th>

          </tr>

      </thead>
    <tbody>
      <?php
      echo $tabla;
       ?>
    </tbody>
    <?php
  }//solo carga los js

     ?>



<input type="hidden" name="idusu_" id="idusu_" value="<?php echo $usuario; ?>">
  </body>
 <script type="text/javascript">
 $(document).ready(function () {

     $('#tabladetalle').DataTable(
         {
             "language":
             {
                 "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
             },
             bAutoWidth: false,
                 aoColumns : [
                     { sWidth: '26%' },
                     { sWidth: '5%' },
                     { sWidth: '5%' },
                     { sWidth: '5%' },
                     { sWidth: '5%' },
                     { sWidth: '5%' },
                     { sWidth: '5%' },
                     { sWidth: '5%' },
                     { sWidth: '5%' },
                     { sWidth: '5%' },
                     { sWidth: '5%' },
                     { sWidth: '5%' },
                     { sWidth: '5%' },
                     { sWidth: '14%' }
                   //  { sWidth: '30%' }
                 ],
             "order": false,
             "paging": false,
             "searching": false,
             "ordering": false
             //"ordering": false
         });
       var total = <?php echo $total; ?>;
       var total_ejearea = 0;
       var res = 0;
       for (var i = 1; i <= <?php echo $cont ?>; i++) {
         total_ejearea = $("#tot_"+i).text();
         res = (total_ejearea * 100) / total;
         $("#porc_"+i).html("("+res.toFixed(2)+"%)");
       }
 });
 </script>

</html>
