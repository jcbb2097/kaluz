<?php
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$nombreUsuario = "";
$idUsuario = "1";
$onclick = "";
if (isset($_POST['Id_check']) && $_POST['Id_check'] != "") {
    $Id_check = $_POST["Id_check"];
    $onclick = $_POST["Click"];
}

?>

<table class="table table-bordered" id="datos">
    <thead class="table-header">
        <tr style="background-color: #5a274f;color: white;">
            <th class="publicacion">Actividad </th>
            <th class="publicacion">Insumo</th>
            <th class="publicacion">Área</th>
            <th class="publicacion">Entrega</th>
            <th class="avance">Avance</th>
            <th class="publicacion">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $consulta = "SELECT
        ch.Nombre as nombre_insumo,ci.FechaInsumoRequerido,a.Numeracion,ar.Nombre,cha.Avance,e.ruta,pdf,cha.Archivo
    FROM
        k_checkListEntregableInsumo ci
        INNER JOIN k_checklist_actividad cha ON cha.IdCheckList = ci.idChecklistInsumoUsado
        INNER JOIN c_checkList ch on ch.IdCheckList=cha.IdCheckList
        INNER JOIN c_actividad a on a.IdActividad=ci.idActividadInsumoUsado
        INNER JOIN c_area ar on ar.Id_Area=a.IdArea
        INNER JOIN c_documento e on e.id_documento=cha.Archivo
         ORDER BY a.IdEje, a.IdTipoActividad, a.Numeracion";
        //echo$consulta;
        $resultEntregable = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultEntregable)) {
            $ruta = $row['ruta'] . $row['pdf'];
            if ($row['pdf'] == "link" && $row['Archivo'] != '') {
                $onclick_check = 'target="_blank" href="' . $row['ruta'] . '"';
            } elseif ($row['pdf'] != "link" && $row['Archivo'] != '') {
                $onclick_check = 'target="_blank" href="' . $ruta . '"';
            } else {
                $onclick_check = "";
            }
            if ($row['Avance'] == 50) {
                $color = "#dfa739";
            } elseif ($row['Avance'] == 100) {
                $color = "#33ab15";
            } elseif ($row['Avance'] == 25) {
                $color = "#dbd909";
            } else {
                $color = "red";
            }
            echo '<tr>';
            $icono = '<i class="fas fa-file-archive"></i>';
            echo '<td class="Actividad">' . $row['Numeracion'] . '</td>';
            echo '<td class="publicacion">' . $row['nombre_insumo'] . '</td>';
            echo '<td class="Actividad">' . $row['Nombre'] . '</td>';
            echo '<td class="Actividad">' . $row['FechaInsumoRequerido'] . '</td>';
            echo '<td class="avance2" >';
            $avance_checklist = intval($row['Avance']);
            $onclick_versiones = "";
            $onclick_form = '';
            $onclick_insumos = '';
            $onclick_asunto = "href='" . $onclick . "'";

            echo '<progress id="file"  max="100" value="' . $avance_checklist . '"></progress> ' . $avance_checklist . '%';
            echo '</td>';
            echo ' <td class="opciones2">';
            echo '<a style="color:' . $color . ';cursor:pointer;position: relative;left: -4px;" ' . $onclick_check . '><span class="">' . $icono . '</span></a>&nbsp;&nbsp;</a>';
            echo '<a style="cursor:pointer;left: -4px;position: relative;color: purple;" ' . $onclick_versiones . '><span><i  class="far fa-eye"></i></span></a>';
            echo '<a style="cursor:pointer;left: 6px;position: relative;color: purple;"' . $onclick_asunto . '><span><i  class="far fa-edit"></i></span></a>';

            echo '</td>';
        }
        ?>
    </tbody>

</table>
<script>
    $(document).ready(function() {

        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });

        // DataTable
        var table = $('#datos').DataTable();
        table.destroy();
        table = $('#datos').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
            },
            "scrollX": true,
            responsive: false,
            "searching": false,
            pageLength: 100,
            "scrollY": "370px",
            "scrollCollapse": true,
            "paging": false
        });

    });
</script>