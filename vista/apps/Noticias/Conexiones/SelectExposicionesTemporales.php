<?php

    $fecha=$_POST["fecha"];
    if($fecha == "todos"){
      $where = "";
    }else{
      $where = "WHERE YEAR(c_exposicionTemporal.fechaInicio)=$fecha ";
    }
    $rows = array();
    $con=mysqli_connect("localhost","sie2020produsr",'siiee2020$pr0D.y9',"SIE2020produ") or die("Error de Conexion");
    mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
    $consulta = mysqli_query($con,"SELECT c_exposicionTemporal.idExposicion,CONCAT(YEAR(c_exposicionTemporal.fechaInicio),'-',c_exposicionTemporal.tituloFinal) Exposiciones,
                      count(c_opiniones.IdOpinion) conteo,
                      CONCAT(ROUND(count(c_opiniones.IdOpinion)*100 / (SELECT count(c_opiniones.IdOpinion) from c_eje  JOIN c_exposicionTemporal ON c_eje.idEje=c_exposicionTemporal.idEje
                                   Left JOIN c_opiniones ON c_eje.idEje=c_opiniones.IdEjeTurnado
                                   $where ),1),'%')  porcentaje
                       from c_eje  JOIN c_exposicionTemporal ON c_eje.idEje=c_exposicionTemporal.idEje
                       Left JOIN c_opiniones ON c_eje.idEje=c_opiniones.IdEjeTurnado
                       $where GROUP BY c_exposicionTemporal.tituloFinal  ORDER BY c_exposicionTemporal.fechaInicio ");
    while($r =mysqli_fetch_assoc($consulta)){
        $rows[] = $r;
    }
    echo json_encode($rows);
    mysqli_close($con);
?>
