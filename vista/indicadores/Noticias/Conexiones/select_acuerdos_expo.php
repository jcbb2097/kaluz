<?php
$fecha=$_POST["fecha"];
$eje=$_POST["eje_filtro"];
$area=$_POST["area_filtro"];
$exposicion=$_POST["exposicion"];
if($fecha == "todos"){
  $where_fecha = "";
  $joinfecha = "";
}
else{
  $where_fecha = "AND  YEAR( fechaInicio) = ".$fecha;
}
if($eje == "todos"){
  $where_eje = "";
  $joineje = "";
}else{
   $where_eje = " AND  acu.id_proyecto = ".$eje;
}
if($area == "todos"){
   $where_area = "";
   $joinarea = "";
}else{
   $where_area = "AND  c_ac.id_area = ".$area;
   $joinarea = "join c_acuerdospdf  c_ac on acu.id_acuerdo = c_ac.id_acuerdo_escrito";
}
if($exposicion == "todos"){
  $where_expo = "";
}else{
   $where_expo = "AND  idExposicion = ".$exposicion;
}
$rows = array();
$con=mysqli_connect("localhost","caomi8ad_Kaluz234c",'k4l0z.29.r3t01',"caomi8ad_siekaluz") or die("Error de Conexion");
mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");//(SELECT COUNT(op.IdOpinion)  FROM c_opiniones  op WHERE  op.IdEstatusOpinion = 1 $where_fecha) AS recibidas,
$consulta = mysqli_query($con, "SELECT CONCAT(YEAR(fechaInicio),'-',e.tituloFinal) AS nombre,
   ( SELECT COUNT( acu.id_proyecto ) FROM k_acuerdoactividad AS acu  $joinarea WHERE acu.id_exposicion = e.idExposicion $where_eje $where_area ) AS total
    FROM c_exposicionTemporal AS e  WHERE idExposicion > 0 $where_fecha $where_expo ORDER BY anio");

while($r =mysqli_fetch_assoc($consulta)) {
    $rows[] = $r;
}
echo json_encode($rows);
mysqli_close($con);

?>
