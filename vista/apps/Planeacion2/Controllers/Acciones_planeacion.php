<?php
include_once('../../../../WEB-INF/Classes/Catalogo.class.php');

$catalogo = new Catalogo();

if (isset($_POST['categoria']) && $_POST['categoria'] != "") {
    //aqui hacemos la consulta a la BD para obtener las categorias
    $Eje = $_POST['ideje'];
    $Periodo = $_POST['anio'];
    $consulta_categorias = "SELECT
    * 
FROM
    c_categoriasdeejes ce
    INNER JOIN k_categoriasdeejes_anios cea ON cea.idCategoria = ce.idCategoria
    INNER JOIN c_periodo p on p.Periodo=cea.Anio
    WHERE p.Id_Periodo=$Periodo AND ce.nivelCategoria=1 AND ce.idEje=$Eje AND cea.Visible=1 AND ACME=1
    ORDER BY ce.orden";
    $resul = $catalogo->obtenerLista($consulta_categorias);
    echo ' <option value="0">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resul)) {
        $selected = "";
        echo "<option value='" . $row['idCategoria'] . "' " . $selected . ">" . $row['descCategoria'] . "</option>";
    }
} else if (isset($_POST['subcategoria']) && $_POST['subcategoria'] != "") {
    //aqui hacemos la consulta a la BD para obtener las Subcategorias
    $cate = $_POST['cate'];
    $anio = $_POST['periodo'];
    $consulta_categorias = "SELECT ce.idCategoria,ce.descCategoria FROM c_categoriasdeejes ce
	INNER JOIN k_categoriasdeejes_anios cea ON cea.idCategoria = ce.idCategoria
	INNER JOIN c_periodo p on p.Periodo=cea.Anio 
WHERE ce.idCategoriaPadre = $cate AND p.Id_Periodo = $anio AND cea.Visible = 1 AND ACME=1
ORDER BY ce.orden";
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
} else if (isset($_POST['actividad_global']) && $_POST['actividad_global'] != "") {

    $consulta_categorias = "SELECT a.IdActividad,a.Nombre FROM c_actividad a WHERE a.Estructura=1 AND a.IdEje=1 AND a.IdTipoActividad=1 AND a.IdNivelActividad=1 ORDER BY a.Nombre";
    $resul = $catalogo->obtenerLista($consulta_categorias);
    echo ' <option value="0">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resul)) {
        $selected = "";
        echo "<option value='" . $row['IdActividad'] . "' " . $selected . ">" . $row['Nombre'] . "</option>";
    }
} else if (isset($_POST['Responsable']) && $_POST['Responsable'] != "") {

    $consulta_categorias = "SELECT p.id_Personas, CONCAT(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno)as nombre
    FROM c_personas as p
    JOIN c_rolPersona rp ON p.id_Personas=rp.id_Persona
    WHERE rp.id_Rol=146
    ORDER BY nombre";
    $resul = $catalogo->obtenerLista($consulta_categorias);
    echo ' <option value="0">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resul)) {
        $selected = "";
        echo "<option value='" . $row['id_Personas'] . "' " . $selected . ">" . $row['nombre'] . "</option>";
    }
}
