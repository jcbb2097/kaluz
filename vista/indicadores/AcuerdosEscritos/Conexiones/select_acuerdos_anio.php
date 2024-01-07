<?php
$fecha=$_POST["fecha"];
$eje=$_POST["eje_filtro"];
$area=$_POST["area_filtro"];
$exposicion=$_POST["exposicion"];
if($fecha == "todos")$where_fecha = "";
else $where_fecha = "AND  YEAR( c_ac.fecha_convocado) = ".$fecha;
if($eje == "todos"){
  $where_eje = "";
  $joineje = "";
}else{
   $where_eje = " AND  acu.id_proyecto = ".$eje;
   $joineje = "join k_acuerdoactividad  acu on c_ac.id_acuerdo_escrito=acu.id_acuerdo";
}
if($area == "todos"){
   $where_area = "";
}else{
   $where_area = "AND  c_ac.id_area = ".$area;
}
if($exposicion == "todos"){
  $where_expo = "";
}else{
   $joineje = "join k_acuerdoactividad  acu on c_ac.id_acuerdo_escrito=acu.id_acuerdo";
   $where_expo = "AND  acu.id_exposicion = ".$exposicion;
}
$rows = array();
$con=mysqli_connect("localhost","caomi8ad_Kaluz234c",'k4l0z.29.r3t01',"caomi8ad_siekaluz") or die("Error de Conexion");
mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");//(SELECT COUNT(op.IdOpinion)  FROM c_opiniones  op WHERE  op.IdEstatusOpinion = 1 $where_fecha) AS recibidas,
$consulta = mysqli_query($con, "SELECT YEAR( fecha_convocado) AS anio,COUNT( id_acuerdo_escrito ) AS total
 FROM c_acuerdospdf c_ac $joineje where estatus > -1 $where_fecha $where_eje  $where_area $where_expo GROUP BY YEAR( c_ac.fecha_convocado)");

while($r =mysqli_fetch_assoc($consulta)) {
    $rows[] = $r;
}
echo json_encode($rows);
mysqli_close($con);

?>
