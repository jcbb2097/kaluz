<?php
$fecha=$_POST["fecha"];
$eje=$_POST["eje_filtro"];
$area=$_POST["area_filtro"];
$exposicion=$_POST["exposicion"];
if($fecha == "todos")$where_fecha = "";
else $where_fecha = "AND  YEAR( op.fecha) = ".$fecha;
if($eje == "todos"){
  $where_eje = "";
  $joineje = "";
}else{
   $where_eje = "AND  eje.idEje = ".$eje;
   $joineje = "join c_eje eje on op.IdEjeTurnado=eje.idEje";
}
if($area == "todos")
     $where_area = "";
   else
      $where_area = "AND  cac.IdArea = ".$area;
if($exposicion == "todos")  $where_expo = "";
else $where_expo = "AND  op.idExposicion = ".$exposicion;

$rows = array();
$con=mysqli_connect("localhost","caomi8ad_Kaluz234c",'k4l0z.29.r3t01',"caomi8ad_siekaluz") or die("Error de Conexion");
mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$consulta = mysqli_query($con, "SELECT ca.Id_Area,ca.Nombre,(select COUNT(op.IdOpinion) FROM  c_opiniones op
JOIN c_actividad cac on op.IdActTurnada=cac.IdActividad $joineje
WHERE  ca.Id_Area= cac.IdArea   $where_fecha $where_eje $where_area $where_expo)AS cuenta FROM c_area ca
ORDER BY ca.Id_Area");

while($r =mysqli_fetch_assoc($consulta)) {
    $rows[] = $r;
}

echo json_encode($rows);
mysqli_close($con);

?>
