<?php

    $var="";

    $rows = array();
    $con=mysqli_connect("localhost","caomi8ad_Kaluz234c",'k4l0z.29.r3t01',"caomi8ad_siekaluz") or die("Error de Conexion");
    mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
    $consulta=mysqli_query($con,"SELECT Id_Area,Nombre FROM c_area where estatus = 1 ORDER BY Nombre asc ");
    while($r =mysqli_fetch_assoc($consulta)) {
        $rows[] = $r;
    }

    echo json_encode($rows);
    mysqli_close($con);

?>
