<?php

include_once("../../Classes/Catalogo.class.php");
$catalogo = new Catalogo();
if (isset($_POST['IdEje']) && $_POST['IdEje'] != "") {
    $IdEje = $_POST['IdEje'];
    $consultaActividad ="SELECT
            cc.IdActividad,
            CASE
        WHEN cc.IdNivelActividad = 1 THEN
            CONCAT(
                cp.orden,
                '.',
                cc.Orden,
                '. ',
                cc.Nombre
            )
        WHEN cc.IdNivelActividad = 2 THEN
            CONCAT(
                cp.orden,
                '.',
                ccDos.Orden,
                '.',
                cc.Orden,
                '. ',
                cc.Nombre
            )
        WHEN cc.IdNivelActividad = 3 THEN
            CONCAT(
                cp.orden,
                '.',
                ccTres.Orden,
                '.',
                ccDos.Orden,
                '.',
                cc.Orden,
                '. ',
                cc.Nombre
            )
        WHEN cc.IdNivelActividad = 5 THEN
            CONCAT(
                cp.orden,
                '.',
                ccCuatro.Orden,
                '.',
                ccTres.Orden,
                '.',
                ccDos.Orden,
                '.',
                cc.Orden,
                '. ',
                cc.Nombre
            )
        END AS Actividad,
         cnc.Nombre AS Nivel,
         cnc.IdNivel
        FROM
            `c_actividad` AS cc
        INNER JOIN c_eje AS cp ON cp.idEje = cc.IdEje
        LEFT JOIN c_actividad AS ccDos ON ccDos.IdActividad = cc.IdActividadSuperior
        LEFT JOIN c_actividad AS ccTres ON ccTres.IdActividad = ccDos.IdActividadSuperior
        LEFT JOIN c_actividad AS ccCuatro ON ccCuatro.IdActividad = ccTres.IdActividadSuperior
        LEFT JOIN c_nivelActividadMeta AS cnc ON cnc.IdNivel = cc.IdNivelActividad
        LEFT JOIN c_tipoActividadMeta AS ctc ON ctc.IdTipo = cc.IdTipoActividad
        INNER JOIN c_periodo AS cper ON cper.Id_Periodo = cc.Periodo
        WHERE cper.Actual = 1 AND cc.IdEje = ".$IdEje." AND cc.IdTipoActividad= 1
        GROUP BY cc.IdActividad ORDER BY Actividad;";

        //echo "<br>".$consultaActividad."<br>";
        $resultActividad = $catalogo->obtenerLista($consultaActividad);
         echo "<option value=''>Seleccione una opción</option>";
        while ( $row = mysqli_fetch_array($resultActividad)) {
            /*if ($IdActividad == $row['IdActividad']) {
                $s = "selected";
            }else{
                $s="";
            }*/
         echo "<option value='".$row['IdActividad']."'".$s.">".$row['Actividad']."</option>";
        }
}



