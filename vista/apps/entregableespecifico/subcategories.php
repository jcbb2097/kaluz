<?php
$html = '';

 
$id_actividad = $_POST['IdEntregable'];

$consultaentregable = "SELECT en.IdEntregable, en.Nombre,ac.IdActividad,CONCAT(ac.Numeracion,' ',ac.Nombre) AS Nombre
  FROM c_entregableEspecifico AS ene
  LEFT JOIN c_entregable AS en ON en.IdEntregable=ene.IdEntregable
  LEFT JOIN c_actividad AS ac ON ac.IdActividad=en.idActividad
WHERE ac.IdActividad = ".$id_actividad." ";
$resultado = $catalogo->obtenerLista($consultaentregable);
 while ($row = mysqli_fetch_array($resultado)) {
                                    $s = '';
                                    if ($row['IdEntregable'] == $id_actividad) {
                                    $s = 'selected = "selected"';
                                    }
                                    $html .= '<option value = "' . $row['IdEntregable'] . '" ' . $s . '>' . $row['Nombre'].'</option>';
                                    }
 
echo $html;
?>