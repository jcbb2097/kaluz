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
  $where_fecha = "AND  YEAR( c_ac.fecha_convocado) = ".$fecha;
  $joinfecha = "JOIN c_acuerdospdf c_ac on acu.id_acuerdo = c_ac.id_acuerdo_escrito ";
}
if($eje == "todos"){
  $where_eje = "";
}else{
   $where_eje = " where  e.idEje = ".$eje;
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
   $where_expo = "AND  acu.id_exposicion = ".$exposicion;
}
$rows = array();
$con=mysqli_connect("localhost","caomi8ad_Kaluz234c",'k4l0z.29.r3t01',"caomi8ad_siekaluz") or die("Error de Conexion");
mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");//(SELECT COUNT(op.IdOpinion)  FROM c_opiniones  op WHERE  op.IdEstatusOpinion = 1 $where_fecha) AS recibidas,
$consulta = mysqli_query($con, "SELECT e.idEje,e.Nombre as nombre,
                            ( SELECT COUNT( acu.id_proyecto ) FROM k_acuerdoactividad AS acu $joinfecha $joinarea WHERE acu.id_proyecto = e.idEje $where_fecha  $where_area $where_expo) AS total
                            FROM c_eje as e $where_eje ORDER BY orden ASC");

while($r =mysqli_fetch_assoc($consulta)) {
    $rows[] = $r;
}
echo json_encode($rows);
mysqli_close($con);

?>
