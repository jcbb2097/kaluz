<?php
include_once("../../Classes/Catalogo.class.php");

$catalogo = new Catalogo();

if (isset($_POST['global']) && $_POST['global'] != "") {
    $Eje = $_POST['Eje'];
    $Tipo = $_POST['tipo'];
    $Periodo = $_POST['Periodo'];
    $categoria = $_POST['categoria'];
    $where = "";
    $where_categoria = "";
    $existe = false;
    $eje_terminados = [1, 7, 8];
    for ($i = 0; $i < count($eje_terminados); $i++) {
        if ($eje_terminados[$i] == $Eje) {
            $existe = true;
        }
    }
    if ($Periodo == 9 && $existe == false) {
        $where = "p.Id_Periodo in(9,3)";
    } else {
        $where = "p.Id_Periodo=$Periodo";
        $where_categoria = " AND a.Idcategoria=$categoria";
    }

    $consulta_actividad = "SELECT a.IdActividad,CONCAT(a.Numeracion,a.Nombre) Nombre FROM c_actividad as a
  INNER JOIN c_periodo as p on a.Anio=p.Periodo
  WHERE a.IdEje=$Eje AND $where AND a.IdTipoActividad=$Tipo AND IdNivelActividad=1 $where_categoria ORDER BY a.Orden";
    echo $consulta_actividad;
    $resultado = $catalogo->obtenerLista($consulta_actividad);
    echo '<option value="">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '">' . $row['Nombre'] . '</option>';
    }
} else if (isset($_POST['General']) && $_POST['General'] != "") {
    $actividad = $_POST['Actividad'];
    $consulta_actividad = "SELECT a.IdActividad,CONCAT(a.Numeracion,a.Nombre) Nombre FROM c_actividad as a WHERE a.IdActividadSuperior=$actividad ORDER BY a.Orden";
    //echo $consulta_actividad;
    $resultado = $catalogo->obtenerLista($consulta_actividad);
    echo '<option value="">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '">' . $row['Nombre'] . '</option>';
    }
} else if (isset($_POST['Particular']) && $_POST['Particular'] != "") {
    $actividad = $_POST['Actividad'];
    $consulta_actividad = "SELECT a.IdActividad,CONCAT(a.Numeracion,a.Nombre) Nombre FROM c_actividad as a WHERE a.IdActividadSuperior=$actividad ORDER BY a.Orden";
    //echo $consulta_actividad;
    $resultado = $catalogo->obtenerLista($consulta_actividad);
    echo '<option value="">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '">' . $row['Nombre'] . '</option>';
    }
} else if (isset($_POST['Subactividad']) && $_POST['Subactividad'] != "") {
    $actividad = $_POST['Actividad'];
    $consulta_actividad = "SELECT a.IdActividad,CONCAT(a.Numeracion,a.Nombre) Nombre FROM c_actividad as a WHERE a.IdActividadSuperior=$actividad ORDER BY a.Orden";
    //echo $consulta_actividad;
    $resultado = $catalogo->obtenerLista($consulta_actividad);
    echo '<option value="">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '">' . $row['Nombre'] . '</option>';
    }
} else if (isset($_POST['exposicion']) && $_POST['exposicion'] != "") {
    $consulta_expo = "SELECT e.idExposicion,e.tituloFinal FROM c_exposicionTemporal as e WHERE e.estatus=1 ORDER BY e.tituloFinal";
    $resultado_expo = $catalogo->obtenerLista($consulta_expo);
    echo '<option value="">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resultado_expo)) {
        echo '<option value="' . $row['idExposicion'] . '" >' . $row['tituloFinal'] . '</option>';
    }
} else if (isset($_POST['eje']) && $_POST['eje'] != "") {
    $consulta_eje = "SELECT e.idEje,CONCAT(e.orden,'. ',e.Nombre) nombre FROM c_eje e ORDER BY e.orden";
    $resultado_eje = $catalogo->obtenerLista($consulta_eje);
    echo '<option value="">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resultado_eje)) {
        echo '<option value="' . $row['idEje'] . '">' . $row['nombre'] . '</option>';
    }
} else if (isset($_POST['categoria']) && $_POST['categoria'] != "") {
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
	INNER JOIN c_periodo p ON p.Id_Periodo = ce.anio
	WHERE ce.idEje=$Eje $where_ano and ce.nivelCategoria=1 ORDER BY ce.orden";
    $resul = $catalogo->obtenerLista($consulta_categorias);
    echo ' <option value="0">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resul)) {
        $selected = "";
        echo "<option value='" . $row['idCategoria'] . "' " . $selected . ">" . $row['categoria'] . "</option>";
    }
} else if (isset($_POST['subcategoria']) && $_POST['subcategoria'] != "") {
    $cate = $_POST['cate'];
    $consulta_categorias = "SELECT ce.idCategoria,ce.descCategoria FROM c_categoriasdeejes ce WHERE ce.idCategoriaPadre=$cate ORDER BY ce.orden";
    $resul = $catalogo->obtenerLista($consulta_categorias);
    if (mysqli_num_rows($resul) > 0) {
        echo ' <option value="0">Seleccione una opción</option>';
        while ($row = mysqli_fetch_array($resul)) {
            $selected = "";
            echo "<option value='" . $row['idCategoria'] . "' " . $selected . ">" . $row['descCategoria'] . "</option>";
        }
    } else {
        echo ' <option value="0">No aplica</option>';
    }
} else if (isset($_POST['check']) && $_POST['check'] != "") {
    $actividad = $_POST['Actividad'];
    $Periodo = $_POST['Periodo'];

    $consulta_actividad = "SELECT
	ch.IdCheckList,
	ch.Nombre 
FROM
	c_checkList ch
	INNER JOIN k_checklist_actividad che ON che.IdCheckList = ch.IdCheckList
	WHERE che.IdActividad=$actividad AND che.Id_Periodo=$Periodo AND ch.Nivel=1";
    //echo $consulta_actividad;
    $resultado = $catalogo->obtenerLista($consulta_actividad);
    echo '<option value="NULL">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdCheckList'] . '">' . $row['Nombre'] . '</option>';
    }
} else if (isset($_POST['Subcheck']) && $_POST['Subcheck'] != "") {
    $actividad = $_POST['Actividad'];
    $check = $_POST['checklist'];
    $Periodo = $_POST['Periodo'];
    $consulta_subcheck = "SELECT
	ch.IdCheckList,
	ch.Nombre 
FROM
	c_checkList ch
	INNER JOIN k_checklist_actividad che ON che.IdCheckList = ch.IdCheckList
	WHERE che.IdActividad=$actividad AND che.Id_Periodo=$Periodo AND ch.Nivel=2 AND ch.IdCheckListPadre=$check";
    //echo $consulta_actividad;
    $resultado = $catalogo->obtenerLista($consulta_subcheck);
    if (mysqli_num_rows($resultado) > 0) {
        echo ' <option value="0">Seleccione una opción</option>';
        while ($row = mysqli_fetch_array($resultado)) {
            $selected = "";
            echo "<option value='" . $row['IdCheckList'] . "' " . $selected . ">" . $row['Nombre'] . "</option>";
        }
    } else {
        echo ' <option value="0">No aplica</option>';
    }
}
