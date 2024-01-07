<?php

    $fecha=$_POST["fecha"];
    $rows = array();
    $con=mysqli_connect("localhost","sie2020produsr",'siiee2020$pr0D.y9',"SIE2020produ") or die("Error de Conexion");
    mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
    $consulta=mysqli_query($con,"SELECT (SELECT COUNT(*) AS Recibida FROM c_opiniones where YEAR(Fecha)=$fecha) AS Historico,
 (SELECT COUNT(*) AS Recibida FROM c_opiniones WHERE IdEstatusOpinion=1 AND YEAR(Fecha)=$fecha) AS Recibida ,
 (SELECT COUNT(*) AS Recibida FROM c_opiniones WHERE IdEstatusOpinion=2 AND YEAR(Fecha)=$fecha) AS TurnadaEje,
 (SELECT COUNT(*) AS Recibida FROM c_opiniones WHERE IdEstatusOpinion=3 AND YEAR(Fecha)=$fecha) AS TurnadaActividad,
 (SELECT COUNT(*) AS Recibida FROM c_opiniones WHERE IdEstatusOpinion=4 AND YEAR(Fecha)=$fecha) AS Atendida");
    while($r =mysqli_fetch_assoc($consulta)) {
        $rows[] = $r;
    }

    echo json_encode($rows);
    mysqli_close($con);

?>
