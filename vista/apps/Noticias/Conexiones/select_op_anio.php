<?php
$eje=$_POST["eje_filtro"];
$fecha=$_POST["fecha"];
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
$consulta = mysqli_query($con, "SELECT  (SELECT COUNT(IdOpinion)  FROM c_opiniones op  $joineje $joinarea where op.IdOpinion > 0  $where_eje $where_area $where_fecha $where_expo) AS total,
(SELECT COUNT(op.IdOpinion)  FROM c_opiniones  op $joineje $joinarea WHERE  YEAR( op.fecha ) = 2015 $where_eje $where_area $where_fecha $where_expo) AS anio_2015,
(SELECT COUNT(op.IdOpinion)  FROM c_opiniones  op $joineje $joinarea WHERE  YEAR( op.fecha ) = 2016 $where_eje $where_area $where_fecha $where_expo) AS anio_2016,
(SELECT COUNT(op.IdOpinion)  FROM c_opiniones  op $joineje $joinarea WHERE  YEAR( op.fecha ) = 2017 $where_eje $where_area $where_fecha $where_expo) AS anio_2017,
(SELECT COUNT(op.IdOpinion)  FROM c_opiniones  op $joineje $joinarea WHERE  YEAR( op.fecha ) = 2018 $where_eje $where_area $where_fecha $where_expo) AS anio_2018,
(SELECT COUNT(op.IdOpinion)  FROM c_opiniones  op $joineje $joinarea WHERE  YEAR( op.fecha ) = 2019 $where_eje $where_area $where_fecha $where_expo) AS anio_2019,
(SELECT COUNT(op.IdOpinion)  FROM c_opiniones  op $joineje $joinarea WHERE  YEAR( op.fecha ) = 2019 $where_eje $where_area $where_fecha $where_expo) AS anio_2019,
(SELECT COUNT(op.IdOpinion)  FROM c_opiniones  op $joineje $joinarea WHERE  YEAR( op.fecha ) = 2020 $where_eje $where_area $where_fecha $where_expo) AS anio_2020");

while($r =mysqli_fetch_assoc($consulta)) {
    $rows[] = $r;
}

echo json_encode($rows);
mysqli_close($con);

?>
