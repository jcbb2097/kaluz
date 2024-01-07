<?php

include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$total_e = 0;
$Total_entregables = 0;
$Total_entregables_obtenidos = 0;
if (isset($_POST['Id_actividad']) && $_POST['Id_actividad'] != "") {
    $Id_actividad = $_POST["Id_actividad"];
}
$query = "SELECT ac.IdActividad,CONCAT( ac.Numeracion, ac.Nombre,' (',tac.Nombre,')' ) actividad,
(SELECT COUNT( ka.id_archivo ) FROM k_archivoactividad ka LEFT JOIN c_documento d on d.id_documento=ka.id_archivo WHERE ka.id_actividad = ac.IdActividad AND d.id_tipo in(9,10,14) ) entregables,
(SELECT COUNT( ka.id_archivo ) FROM k_archivoactividad ka LEFT JOIN c_documento d on d.id_documento=ka.id_archivo WHERE ka.id_actividad = ac.IdActividad AND d.id_tipo in(9) ) total_pr,
(SELECT COUNT( ka.id_archivo ) FROM k_archivoactividad ka LEFT JOIN c_documento d on d.id_documento=ka.id_archivo WHERE ka.id_actividad = ac.IdActividad AND d.id_tipo in(10) ) total_f,
(SELECT COUNT( ka.id_archivo ) FROM k_archivoactividad ka LEFT JOIN c_documento d on d.id_documento=ka.id_archivo WHERE ka.id_actividad = ac.IdActividad AND d.id_tipo in(14) ) total_p
FROM c_actividad ac 
INNER JOIN c_nivelActividadMeta tac on tac.IdNivel=ac.IdNivelActividad 
WHERE ac.IdActividadSuperior=$Id_actividad";
$resultConsulta = $catalogo->obtenerLista($query);
while ($row = mysqli_fetch_array($resultConsulta)) {
    $Id_Actividad_hija = $row['IdActividad'];
    $nombre_actividad = $row['actividad'];
    $total_En = $row['entregables'];
    $total_En_pre = $row['total_pr'];
    $total_En_pro = $row['total_p'];
    $total_En_fin = $row['total_f'];
?>

       
        <tr id="row_Hija_<?php echo $Id_actividad;?>" data-id="<?php echo$Id_actividad;?>" class="hija" style='background : #cacaca;'>
            <td class="Actividad" onclick="muestraGeneral(<?php echo $Id_Actividad_hija ?>);"><span><?php echo $nombre_actividad; ?></span> <span class="toggle-icon"></span></td>
            <td class="Entregable"><a onclick=""><?php echo $total_En; ?></a></td>
            <td class="Entregable_pre"><a onclick=""><?php echo $total_En_pre; ?></a></td>
            <td class="Entregable_pro"><a onclick=""><?php echo $total_En_pro; ?></a></td>
            <td class="Entregable_fin"><a onclick=""><?php echo $total_En_fin; ?></a></td>
        </tr>
 
<?php }  ?>
</body>

</html>