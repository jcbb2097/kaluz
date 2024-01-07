<?php
$fecha=$_POST["fecha"];
$rows = array();
$con=mysqli_connect("localhost","sie2020produsr",'siiee2020$pr0D.y9',"SIE2020produ") or die("Error de Conexion");
mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$consulta = mysqli_query($con, "SELECT c_actividad.IdArea, COUNT(c_actividad.IdArea) AS conteo  FROM c_opiniones JOIN c_actividad ON c_opiniones.IdActTurnada=c_actividad.IdActividad WHERE  c_actividad.IdArea IS NOT NULL  AND c_opiniones.IdTipoOpinion in (1,2,3) AND YEAR( c_opiniones.fecha)=".$fecha." GROUP BY c_actividad.IdArea");

while($r =mysqli_fetch_assoc($consulta)) {
    $rows[] = $r;
}

echo json_encode($rows);
mysqli_close($con);

?>
