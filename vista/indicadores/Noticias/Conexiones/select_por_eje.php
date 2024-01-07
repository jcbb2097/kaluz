<?php
$rows = array();
$fecha=$_POST["fecha"];
$eje=$_POST["eje_filtro"];
$area=$_POST["area_filtro"];
$exposicion=$_POST["exposicion"];
if($fecha == "todos")$where_fecha = "";
else $where_fecha = "AND  YEAR( op.fecha) = ".$fecha;
if($eje == "todos")
  $where_eje = "";
else
   $where_eje = "AND  eje.idEje = ".$eje;
if($area == "todos"){
     $where_area = "";
     $joinarea = "";
}else{
      $where_area = "AND  cac.IdArea = ".$area;
      $joinarea = "JOIN c_actividad cac on op.IdActTurnada=cac.IdActividad ";
   }
if($exposicion == "todos")  $where_expo = "";
else $where_expo = "AND  op.idExposicion = ".$exposicion;
$con=mysqli_connect("localhost","caomi8ad_Kaluz234c",'k4l0z.29.r3t01',"caomi8ad_siekaluz") or die("Error de Conexion");
mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$consulta = mysqli_query($con, "SELECT eje.idEje as IdEje,eje.Nombre,(select COUNT(op.IdActTurnada) from c_opiniones op $joinarea
 WHERE op.IdEjeTurnado= eje.idEje and IdEstatusOpinion >2 $where_fecha $where_eje $where_area $where_expo)AS conteo
FROM c_eje eje ORDER BY eje.idEje");

while($r =mysqli_fetch_assoc($consulta)) {
    $rows[] = $r;
}

echo json_encode($rows);
mysqli_close($con);

?>
