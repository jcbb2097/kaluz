<?php

include_once("../../Classes/Catalogo.class.php");
$catalogo = new Catalogo();
if (isset($_POST['IdGlobal']) && $_POST['IdGlobal'] != "") {
    $IdGlobal = $_POST['IdGlobal'];
    $s = "";
    $consulta = "SELECT ca.IdActividad,CONCAT(ca.Numeracion,ca.Nombre) AS actividad
                    FROM `c_actividad` AS ca
                    INNER JOIN c_eje AS ce ON ce.idEje = ca.IdEje
                    INNER JOIN c_actividad AS caGlob ON caGlob.IdActividad = ca.IdActividadSuperior
                    WHERE ca.IdActividadSuperior=".$IdGlobal." AND ca.IdNivelActividad = 2 ORDER BY ce.orden,ca.Orden;";
    $resultado = $catalogo->obtenerLista($consulta);
    echo '<option value="">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
    }
} else if (isset($_POST['IdGeneral']) && $_POST['IdGeneral'] != "") {
    $IdGeneral = $_POST['IdGeneral'];
    $s = "";

    $consulta = "SELECT ca.IdActividad,CONCAT(ce.orden,'. ',caGlob.Orden,'. ',caGen.Orden,'. ',ca.Orden,'. ',     ca.Nombre) AS actividad
        FROM
            `c_actividad` AS ca
        INNER JOIN c_eje AS ce ON ce.idEje = ca.IdEje
        INNER JOIN c_actividad AS caGen ON caGen.IdActividad = ca.IdActividadSuperior
        INNER JOIN c_actividad AS caGlob ON caGlob.IdActividad = caGen.IdActividadSuperior
        WHERE
            ca.IdActividadSuperior = ".$IdGeneral." ORDER BY ce.orden,caGlob.Orden,caGen.Orden,ca.Orden;";
    $resultado = $catalogo->obtenerLista($consulta);
    echo '<option value="">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
    }
}elseif(isset($_POST['IdPar']) && $_POST['IdPar'] != ""){
    $IdPar = $_POST['IdPar'];
    $consulta = "SELECT ca.IdActividad,CONCAT(ce.orden,'. ',caGlob.Orden,'. ',caGen.Orden,'. ',caPar.Orden,
        '. ',ca.Orden,'. ',ca.Nombre) AS actividad
        FROM `c_actividad` AS ca
        INNER JOIN c_eje AS ce ON ce.idEje = ca.IdEje
        INNER JOIN c_actividad AS caPar ON caPar.IdActividad = ca.IdActividadSuperior
        INNER JOIN c_actividad AS caGen ON caGen.IdActividad = caPar.IdActividadSuperior
        INNER JOIN c_actividad AS caGlob ON caGlob.IdActividad = caGen.IdActividadSuperior
        WHERE ca.IdActividadSuperior =".$IdPar." ORDER BY ce.orden,caGlob.Orden,caGen.Orden,caPar.Orden,ca.Orden;";
    $resultado = $catalogo->obtenerLista($consulta);
    echo '<option value="">Seleccione una opción</option>';
    $s="";
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
    }

}elseif((isset($_POST['IdEje']) && $_POST['IdEje'] != "") && (isset($_POST['IdTipo']) && $_POST['IdTipo'] != "") && (isset($_POST['IdPeriodo']) && $_POST['IdPeriodo'] != "")){

    $IdPeriodo=$_POST['IdPeriodo'];
    $IdEje=$_POST['IdEje'];
    $IdTipo=$_POST['IdTipo'];
    $consultaGlob="SELECT IdActividad,CONCAT(ce.orden,'.',ca.orden,'. ',ca.Nombre) AS actividad
                        FROM `c_actividad` AS ca
                        INNER JOIN c_eje AS ce ON ce.idEje = ca.IdEje
                        WHERE ca.Periodo=".$IdPeriodo." AND ca.IdEje=".$IdEje." AND ca.IdNivelActividad=1 AND ca.IdTipoActividad=".$IdTipo." ORDER BY ce.orden,ca.Orden;";
                    $resultGlob= $catalogo->obtenerLista($consultaGlob);
                    $s = "";
                    echo '<option value="">Seleccione</option>';
                    while ($row =mysqli_fetch_array($resultGlob)){
                        /*if($IdGlob == $row['IdActividad']){
                                 $s="selected";
                              }else{
                                 $s="";
                              }*/
                        echo "<option value='".$row['IdActividad']."'".$s.">".$row['actividad']."</option>";
                    }

}elseif ((isset($_POST['IdActividad']) && $_POST['IdActividad'] != "") && (isset($_POST['Insumo']) && $_POST['Insumo'] == "Insumo")){
        $IdActividad=$_POST['IdActividad'];
            $consulta = ("SELECT kea.IdActividad,kea.IdEntregable,ce.Nombre AS entregable FROM
                        `k_entregableActividad` AS kea
                    INNER JOIN c_actividad AS ca ON ca.IdActividad = kea.IdActividad
                    INNER JOIN c_entregable AS ce ON ce.IdEntregable = kea.IdEntregable
                    WHERE kea.IdActividad=".$IdActividad.";");
        //echo $consulta;
        $s="selected";
        echo '<option value="">Seleccione</option>';
        $query = $catalogo->obtenerLista($consulta);
        while ($rs = mysqli_fetch_array($query)) {
            echo "<option value='".$rs['IdEntregable']."'".$s.">".$rs['entregable']."</option>";
        }
}elseif ((isset($_POST['Scategoria']) && $_POST['Scategoria'] != "")){
    $Scategoria=$_POST['Scategoria'];
        $consulta = ("SELECT IdCategoria, descCategoria FROM c_categoriasdeejes 
                        where nivelCategoria = 2 and idCategoriaPadre='$Scategoria';");
    //echo $consulta;
    //$s="selected";
    $s="";
    echo '<option value="">Seleccione</option>';
    $query = $catalogo->obtenerLista($consulta);
    while ($rs = mysqli_fetch_array($query)) {
        echo "<option value='".$rs['IdCategoria']."'".$s.">".$rs['descCategoria']."</option>";
    }
}elseif ((isset($_POST['Ecategoria']) && $_POST['Ecategoria'] != "")){
    $Scategoria=$_POST['Ecategoria'];
        $consulta = ("SELECT idCategoria, descCategoria FROM c_categoriasdeejes WHERE IdEje=".$Scategoria." and nivelCategoria=1 ORDER BY descCategoria;");
    //echo $consulta;
    //$s="selected";
    $s="";
    echo '<option value="">Seleccione una categoría</option>';
    $query = $catalogo->obtenerLista($consulta);
    while ($rs = mysqli_fetch_array($query)) {
        echo "<option value='".$rs['idCategoria']."'".$s.">".$rs['descCategoria']."</option>";
    }
}elseif ((isset($_POST['ActividadG']) && $_POST['ActividadG'] != "")){
    $ActividadG=$_POST['ActividadG'];
    $Periodo=$_POST['Periodo'];
    $IdEje= $_POST['IdEje'];
        $consulta = ("SELECT IdActividad,CONCAT(ce.orden,'.',ca.orden,'. ',ca.Nombre) AS actividad
        FROM `c_actividad` AS ca
        INNER JOIN c_eje AS ce ON ce.idEje = ca.IdEje
        WHERE ca.Periodo=".$Periodo." AND ca.IdEje='".$IdEje."' AND ca.IdNivelActividad=1 AND ca.IdTipoActividad='".	$ActividadG."' ORDER BY ce.orden,ca.Orden;");
    //echo $consulta;
    //$s="selected";
    $s="";
    echo '<option value="">Seleccione</option>';
    $query = $catalogo->obtenerLista($consulta);
    while ($rs = mysqli_fetch_array($query)) {
        echo "<option value='".$rs['IdActividad']."'".$s.">".$rs['actividad']."</option>";
    }
}
elseif ((isset($_POST['ScategoriaE']) && $_POST['ScategoriaE'] != "")){

    $IdEje= $_POST['ScategoriaE'];
    $consulta = "SELECT IdCategoria, descCategoria FROM `c_categoriasdeejes` WHERE nivelCategoria =1 and idEje=$IdEje ORDER BY descCategoria;";
    echo $consulta;
    //$s="selected";
    $s="";
    echo '<option value="">Seleccione</option>';
    $query = $catalogo->obtenerLista($consulta);
    while ($rs = mysqli_fetch_array($query)) {
        echo "<option value='".$rs['IdCategoria']."'".$s.">".$rs['descCategoria']."</option>";
    }
}





