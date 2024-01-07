<?php
include_once("../../Classes/Catalogo.class.php");

$catalogo = new Catalogo();


if (isset($_POST['categoria']) && $_POST['categoria'] != "") {
    //aqui hacemos la consulta a la BD para obtener las categorias
    $Eje = $_POST['ideje'];
    $Periodo = $_POST['anio'];
    $where_ano = "";
    if ($Periodo != 'todos') {
        $where_ano = "and p.Id_Periodo=" . $Periodo;
    }
    $consulta_categorias = "SELECT
	ce.idCategoria,
	ce.descCategoria as categoria
FROM
	c_categoriasdeejes ce
	LEFT JOIN k_categoriasdeejes_anios kca ON kca.idCategoria=ce.idCategoria
    LEFT JOIN c_periodo p on p.Periodo=kca.Anio
	WHERE ce.idEje=$Eje $where_ano and ce.nivelCategoria=1 AND kca.Visible=1 AND kca.ACME = 1 ORDER BY ce.orden";
    $resul = $catalogo->obtenerLista($consulta_categorias);
    echo ' <option value="0">Seleccione</option>';
    while ($row = mysqli_fetch_array($resul)) {
        $selected = "";
        echo "<option value='" . $row['idCategoria'] . "' " . $selected . ">" . $row['categoria'] . "</option>";
    }
} else if (isset($_POST['subcategoria']) && $_POST['subcategoria'] != "") {
    //aqui hacemos la consulta a la BD para obtener las Subcategorias
    $cate = $_POST['cate'];
    $Periodo = $_POST['anio'];
    $consulta_categorias = "SELECT ce.idCategoria,ce.descCategoria FROM c_categoriasdeejes ce LEFT JOIN k_categoriasdeejes_anios kca ON kca.idCategoria=ce.idCategoria
        LEFT JOIN c_periodo p on p.Periodo=kca.Anio WHERE ce.idCategoriaPadre=$cate and  kca.Visible=1 and p.Id_Periodo=$Periodo  AND kca.ACME = 1 ORDER BY ce.orden";
    $resul = $catalogo->obtenerLista($consulta_categorias);
    if (mysqli_num_rows($resul) > 0) {
        echo ' <option value="0">Seleccione</option>';
        while ($row = mysqli_fetch_array($resul)) {
            $selected = "";
            echo "<option value='" . $row['idCategoria'] . "' " . $selected . ">" . $row['descCategoria'] . "</option>";
        }
    } else {
        echo ' <option value="0">No aplica</option>';
    }
} else if (isset($_POST['Actividad_global']) && $_POST['Actividad_global'] != "") {
    //aqui hacemos la consulta a la BD para obtener las actividades globales
    $Eje = $_POST['Eje'];
    $Tipo = $_POST['tipo'];
    $Periodo = $_POST['Periodo'];
    $categoria = $_POST['cate'];

    $consulta_actividad = "SELECT a.IdActividad,CONCAT( aa.Numeracion, a.Nombre ) AS Nombre 
        FROM c_actividad a
	    INNER JOIN k_actividad_categoria aa ON aa.IdActividad = a.IdActividad 
        WHERE a.IdEje = $Eje AND a.IdTipoActividad = $Tipo AND aa.IdPeriodo = $Periodo AND aa.IdCategoria = $categoria AND a.IdNivelActividad = 1 
        ORDER BY aa.Orden";
    $s = "";
    $resultado = $catalogo->obtenerLista($consulta_actividad);
    echo '<option value="">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
    }
} else if (isset($_POST['General']) && $_POST['General'] != "") {
    //aqui hacemos la consulta a la BD para obtener las actividades generales
    $actividad = $_POST['Actividad'];
    $Periodo = $_POST['Periodo'];
    $categoria = $_POST['cate'];
    $consulta_actividad = "SELECT a.IdActividad,CONCAT( aa.Numeracion, a.Nombre ) AS Nombre 
        FROM c_actividad a INNER JOIN k_actividad_categoria aa ON aa.IdActividad = a.IdActividad 
        WHERE aa.IdPeriodo = $Periodo AND a.IdActividadSuperior=$actividad AND aa.IdCategoria=$categoria
        ORDER BY aa.Orden";
    //echo $consulta_actividad;
    $resul = $catalogo->obtenerLista($consulta_actividad);
    if (mysqli_num_rows($resul) > 0) {
        echo '<option value="">Seleccione</option>';
        while ($row = mysqli_fetch_array($resul)) {
            echo '<option value="' . $row['IdActividad'] . '">' . $row['Nombre'] . '</option>';
        }
    } else {
        echo ' <option value="0">No aplica</option>';
    }
} else if (isset($_POST['check']) && $_POST['check'] != "") {
    //aqui hacemos la consulta a la BD para obtener los checklist de la actividad globla/general
    $actividad = $_POST['Actividad'];
    $Periodo = $_POST['Periodo'];
    //$categoria = $_POST['cate'];
    $consulta_actividad = "SELECT ch.IdCheckList,ch.Nombre FROM c_checkList ch
	    INNER JOIN k_checklist_actividad che ON che.IdCheckList = ch.IdCheckList
        WHERE che.IdActividad = $actividad AND che.Id_Periodo = $Periodo AND ch.Nivel = 1 AND che.IdCategoria=$categoria ORDER BY che.Orden";

    $resultado = $catalogo->obtenerLista($consulta_actividad);
    echo '<option value="NULL">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdCheckList'] . '">' . $row['Nombre'] . '</option>';
    }
} else if (isset($_POST['Subcheck']) && $_POST['Subcheck'] != "") {
    $actividad = $_POST['Actividad'];
    $check = $_POST['checklist'];
    $Periodo = $_POST['Periodo'];
    $categoria = $_POST['cate'];
    $consulta_subcheck = "SELECT ch.IdCheckList,CASE
        WHEN che.Nombre_alterno != '' THEN
        che.Nombre_alterno ELSE ch.Nombre 
        END AS Nombre FROM
	    c_checkList ch INNER JOIN k_checklist_actividad che ON che.IdCheckList = ch.IdCheckList
        WHERE che.IdActividad = 16994 AND che.Id_Periodo = $Periodo AND ch.Nivel = 2 AND ch.IdCheckListPadre = $check AND che.IdCategoria=$categoria ORDER BY che.Orden";
    $resultado = $catalogo->obtenerLista($consulta_subcheck);
    //echo $consulta_subcheck;
    if (mysqli_num_rows($resultado) > 0) {
        echo ' <option value="NULL">Seleccione</option>';
        while ($row = mysqli_fetch_array($resultado)) {
            $selected = "";
            echo "<option value='" . $row['IdCheckList'] . "' " . $selected . ">" . $row['Nombre'] . "</option>";
        }
    } else {
        echo ' <option value="NULL">No aplica</option>';
    }
} else if (isset($_POST['Particular']) && $_POST['Particular'] != "") {
    $actividad = $_POST['Actividad'];
    $consulta_actividad = "SELECT a.IdActividad,CONCAT(a.Numeracion,a.Nombre) Nombre FROM c_actividad as a WHERE a.IdActividadSuperior=$actividad ORDER BY a.Orden";
    //echo $consulta_actividad;
    $resultado = $catalogo->obtenerLista($consulta_actividad);
    echo '<option value="">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '">' . $row['Nombre'] . '</option>';
    }
} else if (isset($_POST['Subactividad']) && $_POST['Subactividad'] != "") {
    $actividad = $_POST['Actividad'];
    $consulta_actividad = "SELECT a.IdActividad,CONCAT(a.Numeracion,a.Nombre) Nombre FROM c_actividad as a WHERE a.IdActividadSuperior=$actividad ORDER BY a.Orden";
    //echo $consulta_actividad;
    $resultado = $catalogo->obtenerLista($consulta_actividad);
    echo '<option value="">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '">' . $row['Nombre'] . '</option>';
    }
} else if (isset($_POST['exposicion']) && $_POST['exposicion'] != "") {
    $consulta_expo = "SELECT e.idExposicion,e.tituloFinal FROM c_exposicionTemporal as e WHERE e.estatus=1 ORDER BY e.tituloFinal";
    $resultado_expo = $catalogo->obtenerLista($consulta_expo);
    echo '<option value="">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado_expo)) {
        echo '<option value="' . $row['idExposicion'] . '" >' . $row['tituloFinal'] . '</option>';
    }
} else if (isset($_POST['eje']) && $_POST['eje'] != "") {
    $consulta_eje = "SELECT e.idEje,CONCAT(e.orden,'. ',e.Nombre) nombre FROM c_eje e ORDER BY e.orden";
    $resultado_eje = $catalogo->obtenerLista($consulta_eje);
    echo '<option value="">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado_eje)) {
        echo '<option value="' . $row['idEje'] . '">' . $row['nombre'] . '</option>';
    }
}
