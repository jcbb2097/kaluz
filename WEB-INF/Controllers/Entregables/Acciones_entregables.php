<?php
include_once("../../Classes/Catalogo.class.php");
include_once('../../../WEB-INF/Classes/AcuerdoEscrito.class.php');
$catalogo = new Catalogo();
if (isset($_POST['categorias']) && $_POST['categorias'] != "") {
    $Eje = $_POST['eje'];
    $Periodo = $_POST['anio'];
    if ($Periodo != 'todos') {
        $where_ano = "and p.Id_Periodo=" . $Periodo;
        $where_ano = "and p.Id_Periodo=9";//cbc.2022-jul-31. Se muestran siempre del año2021=IdPeriodo=9
    }
    $consulta_categorias = "SELECT
	ce.idCategoria,
	ce.descCategoria as categoria 
FROM
	c_categoriasdeejes ce
	INNER JOIN c_periodo p ON p.Id_Periodo = ce.anio
	WHERE ce.idEje=$Eje $where_ano and ce.nivelCategoria=1 ORDER BY ce.orden";
    //echo$consulta_categorias;
    $resul = $catalogo->obtenerLista($consulta_categorias);
      echo' <option value="0">Seleccione</option>';
    while ($row = mysqli_fetch_array($resul)) {
        $selected = "";
        echo "<option value='" . $row['idCategoria'] . "' " . $selected . ">" . $row['categoria'] . "</option>";
    }
} elseif (isset($_POST['subcate']) && $_POST['subcate'] != "") {
    $cate = $_POST['cate'];
    $consulta_categorias = "SELECT ce.idCategoria,ce.descCategoria FROM c_categoriasdeejes ce WHERE ce.idCategoriaPadre=$cate ORDER BY ce.orden";
    //echo$consulta_categorias;
    $resul = $catalogo->obtenerLista($consulta_categorias);
      echo' <option value="0">Seleccione</option>';
    while ($row = mysqli_fetch_array($resul)) {
        $selected = "";
        echo "<option value='" . $row['idCategoria'] . "' " . $selected . ">" . $row['descCategoria'] . "</option>";
    }


} elseif (isset($_POST['expo']) && $_POST['expo'] != "") {
    $cate = $_POST['categoria'];
    $consulta_categorias = "SELECT
	ce.idExposicion,
	expo.tituloFinal
FROM
	c_categoriasdeejes ce 
	LEFT JOIN c_exposiciontemporal expo on expo.idExposicion=ce.idExposicion
WHERE
	ce.idCategoria =" . $cate;

    $resul = $catalogo->obtenerLista($consulta_categorias);
    while ($row = mysqli_fetch_array($resul)) {
        $selected = "";
        echo "<option value='" . $row['idExposicion'] . "' " . $selected . ">" . $row['tituloFinal'] . "</option>";
    }
} elseif (isset($_POST['subcategorias']) && $_POST['subcategorias'] != "") {
    $categoria = $_POST['categoria'];
    $Eje = $_POST['eje'];
    $consulta_categorias = "SELECT
	ce.idCategoria,
	ce.descCategoria as categoria 
FROM
	c_categoriasdeejes ce
	INNER JOIN c_periodo p ON p.Id_Periodo = ce.anio
	WHERE ce.idEje=$Eje and ce.nivelCategoria=2 and ce.idCategoriaPadre=$categoria";
    $resul = $catalogo->obtenerLista($consulta_categorias);
    echo '<option value="0">Sub-categorías</option>';
    while ($row = mysqli_fetch_array($resul)) {
        $selected = "";
        echo "<option value='" . $row['idCategoria'] . "' " . $selected . ">" . $row['categoria'] . "</option>";
    }
}
