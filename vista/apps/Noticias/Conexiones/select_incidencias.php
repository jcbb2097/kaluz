<?php
$rows = array();
$fecha=$_POST["fecha"];
$con=mysqli_connect("localhost","sie2020produsr",'siiee2020$pr0D.y9',"SIE2020produ") or die("Error de Conexion");
mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$consulta = mysqli_query($con, "SELECT cia.descripcion,COUNT(op.idOpinion)AS total  FROM c_opiniones op
                                join c_incidencias_atender cia ON op.Incidencia_al_atender = cia.Id_Incidencia
                                WHERE op.Incidencia_al_atender IS NOT null  and YEAR(op.Fecha)=$fecha");
while($r =mysqli_fetch_assoc($consulta)) {
    $rows[] = $r;
}

echo json_encode($rows);
mysqli_close($con);
?>
