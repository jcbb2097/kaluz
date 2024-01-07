<?php

    $var="";
   
    $rows = array();
    $con=mysqli_connect("localhost","sie2020produsr","siiee2020$pr0D.y9","SIE2020produ") or die("Error de Conexion");   
    mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
    $consulta=mysqli_query($con,"SELECT c_eje.idEje as IdEje,  c_eje.Nombre,COUNT(c_opiniones.IdEjeTurnado) AS conteo FROM c_eje LEFT JOIN c_opiniones ON c_eje.idEje=c_opiniones.IdEjeTurnado WHERE c_opiniones.IdEstatusOpinion=4 GROUP BY c_eje.idEje");
    while($r =mysqli_fetch_assoc($consulta)) {
        $rows[] = $r;
    }
    
    echo json_encode($rows);  
    mysqli_close($con);
    
?>