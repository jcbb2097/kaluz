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
if ((isset($_GET['idareaje']) && $_GET['idareaje'] != "")){
  $idejearea =  $_GET['idareaje'];
  $cons = "select ar.Nombre from c_area ar where ar.Id_Area = $idejearea";
  $resu= $catalogo->obtenerLista($cons);
  while ($rs = mysqli_fetch_array($resu)){
    $nombre = $rs['Nombre'];
  }
}
if ((isset($_GET['tipo']) && $_GET['tipo'] != ""))    {
   $tipo=    $_GET['tipo'];
   switch ($tipo) {
     case 'otrasareas':
        $encabezado = "<b>$nombre</b> No esta invitado por las áreas : ";
        $query_total = "SELECT COUNT(con.idConversacion) AS total FROM k_conversacion con
                          JOIN c_area ca ON con.idOrigen = ca.Id_Area
                           WHERE con.estatus NOT IN(3,4)  AND con.idDestino not IN ( $idejearea ) and con.idOrigen not IN ( $idejearea ) AND con.idConversacion NOT IN (SELECT con.idConversacion FROM k_conversacion con
                          JOIN k_conversacionArea conva ON con.idConversacion = conva.idConversacion AND conva.idArea NOT IN (con.idOrigen,con.idDestino) AND conva.idArea = $idejearea
                           WHERE con.estatus NOT IN(3,4)  AND con.idDestino not IN ( $idejearea ) and con.idOrigen not IN ( $idejearea ) )";
        $query_principal = "SELECT ca.Nombre ,ca.Id_Area, COUNT(con.idConversacion) AS total FROM k_conversacion con
                            JOIN c_area ca ON con.idOrigen = ca.Id_Area
                             WHERE con.estatus NOT IN(3,4)  AND con.idDestino not IN ( $idejearea ) and con.idOrigen not IN ( $idejearea ) AND con.idConversacion NOT IN (SELECT con.idConversacion FROM k_conversacion con
                            JOIN k_conversacionArea conva ON con.idConversacion = conva.idConversacion AND conva.idArea NOT IN (con.idOrigen,con.idDestino) AND conva.idArea = $idejearea
                             WHERE con.estatus NOT IN(3,4)  AND con.idDestino not IN ( $idejearea ) and con.idOrigen not IN ( $idejearea ) )
                             GROUP BY ca.Id_Area ORDER BY total desc, ca.Nombre ";
       break;
     case 'invitados_area':
          $encabezado = " <b>$nombre</b> invitado por las áreas : ";
          $query_total = "SELECT  con.idConversacion
                        FROM k_conversacion con
                        JOIN k_conversacionArea conva ON con.idConversacion = conva.idConversacion AND conva.idArea NOT IN (con.idOrigen,con.idDestino)
                       left JOIN k_conversacionRespuesta conre ON conre.idConversacion = con.idConversacion AND conre.idArea = conva.idArea
                       WHERE con.estatus NOT IN(3,4) AND  conva.idArea =  $idejearea GROUP BY con.idConversacion ";
          $query_principal = "SELECT   ca.Nombre ,ca.Id_Area, count(con.idConversacion) total, (	 SELECT  count(conver.idConversacion)  FROM k_conversacion conver
                        JOIN k_conversacionArea convar ON conver.idConversacion = convar.idConversacion AND convar.idArea NOT IN (conver.idOrigen,conver.idDestino)
                       WHERE conver.estatus  IN(3,4) AND  convar.idArea = $idejearea AND conver.idOrigen = ca.Id_Area
                       GROUP BY conver.idOrigen ) AS resueltos
                        FROM k_conversacion con
                        JOIN k_conversacionArea conva ON con.idConversacion = conva.idConversacion AND conva.idArea NOT IN (con.idOrigen,con.idDestino)
                       JOIN c_area ca ON ca.Id_Area = con.idOrigen
                       WHERE con.estatus NOT IN(3,4) AND  conva.idArea = $idejearea
                       GROUP BY ca.Id_Area ORDER BY total desc";
         break;
     case 'area':
         $encabezado = "Intervenciones por área";
           $query_total =  "SELECT  COUNT(*) AS total FROM k_conversacionRespuesta r JOIN c_area a ON a.Id_Area=r.idArea";
           $query_principal = "SELECT a.Nombre,a.Id_Area, COUNT(*) AS total FROM k_conversacionRespuesta r JOIN c_area a ON a.Id_Area=r.idArea
                               GROUP BY r.idArea
                               ORDER BY total desc";

        break;
     case 'enviados':
          $encabezado = " Enviados por <b>$nombre</b>  a las áreas :";
          $query_total = "SELECT COUNT(*) total FROM k_conversacion con  WHERE con.estatus NOT IN(3,4)  AND con.idOrigen = $idejearea";
          $query_principal = " SELECT COUNT(*) as total, ca.Nombre ,ca.Id_Area, (SELECT COUNT(*) as total
								                     FROM k_conversacion conver
								                      JOIN c_area car ON conver.idDestino = car.Id_Area
								                      WHERE conver.estatus  IN(3,4)  and conver.idOrigen  in ( $idejearea ) AND car.Id_Area = ca.Id_Area
								                       GROUP BY conver.idDestino) AS 	resueltos
                     FROM k_conversacion con
                      JOIN c_area ca ON con.idDestino = ca.Id_Area
                      WHERE con.estatus NOT IN(3,4)  and con.idOrigen  in ( $idejearea )
                       GROUP BY con.idDestino ORDER BY total desc";
        break;
      case 'recibidos':
          $encabezado = " Recibidos por <b>$nombre</b> de las áreas :";
          $query_total =  "SELECT COUNT(*) total FROM k_conversacion con  WHERE con.estatus NOT IN(3,4)  AND con.idDestino = $idejearea";
          $query_principal = "SELECT COUNT(*) as total,con.idDestino  ,ca.Id_Area, ca.Nombre , ( SELECT COUNT(*) FROM k_conversacion conver
										                      JOIN c_area car ON conver.idOrigen = car.Id_Area
										                      WHERE conver.estatus  IN(3,4)  AND conver.idDestino  in ( $idejearea )AND car.Id_Area = ca.Id_Area
										                       GROUP BY conver.idOrigen) AS resueltos
                     FROM k_conversacion con
                      JOIN c_area ca ON con.idOrigen = ca.Id_Area
                      WHERE con.estatus NOT IN(3,4)  AND con.idDestino  in ( $idejearea )
                       GROUP BY con.idOrigen ORDER BY total desc  ";
        break;
        case 'invitados':
             $encabezado = " <b>$nombre</b> es invitado por las áreas :";
             $query_total = "SELECT  con.idConversacion
                           FROM k_conversacion con
                           JOIN k_conversacionArea conva ON con.idConversacion = conva.idConversacion AND conva.idArea NOT IN (con.idOrigen,con.idDestino)
                          left JOIN k_conversacionRespuesta conre ON conre.idConversacion = con.idConversacion AND conre.idArea = conva.idArea
                          WHERE con.estatus NOT IN(3,4) AND  conva.idArea =  $idejearea GROUP BY con.idConversacion ";
             $query_principal = "SELECT   ca.Nombre ,ca.Id_Area, count(con.idConversacion) total, (	 SELECT  count(conver.idConversacion)  FROM k_conversacion conver
                           JOIN k_conversacionArea convar ON conver.idConversacion = convar.idConversacion AND convar.idArea NOT IN (conver.idOrigen,conver.idDestino)
                          WHERE conver.estatus  IN(3,4) AND  convar.idArea = $idejearea AND conver.idOrigen = ca.Id_Area
                          GROUP BY conver.idOrigen ) AS resueltos
                           FROM k_conversacion con
                           JOIN k_conversacionArea conva ON con.idConversacion = conva.idConversacion AND conva.idArea NOT IN (con.idOrigen,con.idDestino)
                          JOIN c_area ca ON ca.Id_Area = con.idOrigen
                          WHERE con.estatus NOT IN(3,4) AND  conva.idArea = $idejearea
                          GROUP BY ca.Id_Area ORDER BY total desc";
           break;
     default:
       break;
   }
 }


 ?>
 <center><?php echo $encabezado; ?></center>
   <table class="table table-striped table-bordered" style="width:100%;font-size: .7em;" >
     <thead>
       <th> Nombre</th>
       <th>Abiertos </th>
       <th>% Abiertos</th>
       <?php if($tipo != 'otrasareas' && $tipo != 'area'){
        ?>
       <th>Resueltos </th>
       <?php } ?>
     </thead>
     <tbody>
       <?php
       $total = 0;
       $resu= $catalogo->obtenerLista($query_total);
       if($tipo == 'invitados' || $tipo == 'invitados_area'){
         $total = mysqli_num_rows($resu);
       }else{
         while ($r = mysqli_fetch_array($resu)){
           $total = $r['total'];
         }
       }
       $totalcalc = 0;
       $resu= $catalogo->obtenerLista($query_principal);
       while ($rs = mysqli_fetch_array($resu)){
         $porcentaje = ($rs['total'] / $total) * 100;
         $color = "";
         $idarea = $rs['Id_Area'];

         switch ($tipo) {
           case 'enviados':
             $env_rec_inv = 1;$det_env_rec = 1;
             break;
           case 'recibidos':
            $env_rec_inv = 2;$det_env_rec = 2;
               break;
          case 'invitados':
            $env_rec_inv = 3;$det_env_rec = 2;
            break;
          case 'invitados_area':
              $env_rec_inv = 3;$det_env_rec = 2;
            break;
          case 'otrasareas':
             $env_rec_inv = 2;$det_env_rec = 2;
           break;
           default:
             break;
         }

         if(!isset($rs['resueltos']) || $rs['resueltos'] == "")
          $rs['resueltos'] = 0;


          if($tipo == "area"){
            if($idarea == $idejearea){
              $color = "style='background-color:#1d476e;color: white;'";
            }
          }

         echo "<tr $color >";
            echo "<td style='padding:4px !important;'>".$rs['Nombre']."</td>";
             if($tipo != 'area' && $tipo != 'otrasareas'){
               echo "<td style='padding:4px !important;'><a href='#' onclick='muestraDetalle_modal_extra(1,$idejearea,$env_rec_inv,0,0,0,0,$idarea,1,$det_env_rec)'>".$rs['total']."</a></td>";
             }else{
               if($tipo == 'otrasareas'){
                 echo "<td style='padding:4px !important;'><a href='#' onclick='muestraDetalle_noinvitados($idejearea,$idarea)'>".$rs['total']."</a></td>";
               }else{
                 echo "<td style='padding:4px !important;'>".$rs['total']."</td>";
               }
             }
             echo "<td style='padding:4px !important;'>".round($porcentaje,1)." %</td>";
             if($tipo != 'otrasareas'  && $tipo != 'area'){
               echo "<td style='padding:4px !important;'>".$rs['resueltos']."</td>";
             }
         echo "</tr>";
         //$totalcalc += $rs['total'];
       }
        ?>
     </tbody>
     <tfoot>
       <tr >
         <th></th>
         <th><?php echo $total; ?></th>
         <th>100%</th>
       </tr>
     </tfoot>
   </table>
