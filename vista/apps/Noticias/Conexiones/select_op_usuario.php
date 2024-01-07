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
    mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
    $consulta=mysqli_query($con,"SELECT u.Usuario,COUNT(op.IdOpinion) AS total FROM c_opiniones op $joineje $joinarea
                                  JOIN c_usuario  u ON  op.IdUsuarioAtendio = u.IdUsuario
                                   WHERE op.IdUsuarioAtendio IS NOT NULL  $where_fecha $where_eje $where_area  $where_expo GROUP BY op.IdUsuarioAtendio order BY total ");
    while($r =mysqli_fetch_assoc($consulta)) {
        $rows[] = $r;
    }

    echo json_encode($rows);
    mysqli_close($con);

?>
