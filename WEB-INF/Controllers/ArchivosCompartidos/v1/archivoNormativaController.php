<?php
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$eje=$_POST['eje'];
$catalogo = new Catalogo();
$categoria = "";
$consultagiro = "SELECT ce.idCategoria,CONCAT( ce.idEje, '.-', ce.descCategoria ) categoria FROM c_categoriasdeejes ce WHERE ce.idEje=$eje";
$resultado = $catalogo->obtenerLista($consultagiro);
echo '<option value = "">Seleccione una opción</option>';
while ($row = mysqli_fetch_array($resultado)) {
    $s = '';
    if ($row['idCategoria'] == $categoria) {
        $s = 'selected = "selected"';
    }
    echo '<option value = "' . $row['idCategoria'] . '" ' . $s . '>' . $row['categoria'] . '</option>';
}

