<?php

    $var="";
   $id=$_POST["id"];
   $rows = array();

   $con=mysqli_connect("localhost","sie2020produsr",'siiee2020$pr0D.y9',"SIE2020produ") or die("Error de Conexion");
    mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
    $consulta=mysqli_query($con,"SELECT c_area.Id_Area,c_area.Nombre, COUNT(c_opiniones.IdActTurnada) as conteo FROM  c_opiniones RIGHT JOIN c_actividad ON c_opiniones.IdActTurnada=c_actividad.IdActividad RIGHT JOIN c_area ON c_area.Id_Area= c_actividad.IdArea WHERE idAreaPadre IS NULL AND c_opiniones.IdTipoOpinion=".$id." AND c_opiniones.IdEstatusOpinion=4  GROUP BY  c_area.Id_Area  ORDER BY c_area.orden,Id_Area");
    while($r =mysqli_fetch_assoc($consulta)) {
        $rows[] = $r;
    }

    echo json_encode($rows);
    mysqli_close($con);

?>
