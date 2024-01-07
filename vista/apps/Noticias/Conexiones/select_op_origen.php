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
if($area == "todos"){
  $where_area = "";
  $joinarea = "";
}else{
   $where_area = "AND  cac.IdArea = ".$area;
   $joinarea = "JOIN c_actividad cac on op.IdActTurnada=cac.IdActividad ";
}
if($exposicion == "todos")  $where_expo = "";
else $where_expo = "AND  op.idExposicion = ".$exposicion;
$rows = array();
$con=mysqli_connect("localhost","sie2020produsr",'siiee2020$pr0D.y9',"SIE2020produ") or die("Error de Conexion");
mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$consulta = mysqli_query($con, "SELECT  (SELECT COUNT(IdOpinion)  FROM c_opiniones op $joineje $joinarea WHERE op.IdOrigenOpinion > 0 $where_fecha $where_eje $where_area $where_expo) AS total,
(SELECT COUNT(op.IdOpinion)  FROM c_opiniones  op $joineje $joinarea WHERE  op.IdOrigenOpinion = 1 $where_fecha $where_eje $where_area $where_expo) AS web,
(SELECT COUNT(op.IdOpinion)  FROM c_opiniones  op $joineje $joinarea WHERE  op.IdOrigenOpinion = 2 $where_fecha $where_eje $where_area $where_expo) AS kioskos,
(SELECT COUNT(op.IdOpinion)  FROM c_opiniones  op $joineje $joinarea WHERE  op.IdOrigenOpinion = 3  $where_fecha $where_eje $where_area $where_expo) AS escritas,
(SELECT COUNT(op.IdOpinion)  FROM c_opiniones  op $joineje $joinarea WHERE  op.IdOrigenOpinion IN(4,5) $where_fecha $where_eje $where_area $where_expo) AS redes,
(SELECT COUNT(op.IdOpinion)  FROM c_opiniones  op $joineje $joinarea WHERE  op.IdOrigenOpinion = 6 $where_fecha $where_eje $where_area $where_expo) AS gerencia,
(SELECT COUNT(op.IdOpinion)  FROM c_opiniones  op $joineje $joinarea WHERE  op.IdOrigenOpinion = 7 $where_fecha $where_eje $where_area $where_expo) AS correo,
(SELECT COUNT(op.IdOpinion)  FROM c_opiniones  op $joineje $joinarea WHERE  op.IdOrigenOpinion = 8 $where_fecha $where_eje $where_area $where_expo) AS otros");

while($r =mysqli_fetch_assoc($consulta)) {
    $rows[] = $r;
}
echo json_encode($rows);
mysqli_close($con);

?>
