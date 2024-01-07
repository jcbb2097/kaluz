<?php
    $fecha=$_POST["fecha"];
    $rows = array();
    $con=mysqli_connect("localhost","sie2020produsr",'siiee2020$pr0D.y9',"SIE2020produ") or die("Error de Conexion");
    mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
    $consulta=mysqli_query($con,"SELECT (SELECT COUNT(*) AS Recibida FROM c_opiniones  WHERE YEAR(Fecha)=$fecha) AS Historico,
                                 (SELECT COUNT(*) AS Recibida FROM c_opiniones WHERE IdTipoOpinion=1 and YEAR(Fecha)=$fecha) AS felicitacion ,
                                 (SELECT COUNT(*) AS Recibida FROM c_opiniones WHERE IdTipoOpinion=2 and YEAR(Fecha)=$fecha) AS solicitud,
                                 (SELECT COUNT(*) AS Recibida FROM c_opiniones WHERE IdTipoOpinion=3 and YEAR(Fecha)=$fecha) AS queja");
    while($r =mysqli_fetch_assoc($consulta)) {
        $rows[] = $r;
    }

    echo json_encode($rows);
    mysqli_close($con);

?>
