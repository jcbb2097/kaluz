<?php
session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$nombreUsuario = "";
$idUsuario = "1";
if (isset($_POST['Id_actividad']) && $_POST['Id_actividad'] != "") {
    $Id_actividad = $_POST["Id_actividad"];
    $tipo = $_POST["tipo"];
    $Id_check = $_POST["Id_check"];
    $Id_categoria = $_POST["Id_categoria"];
    $periodo = $_POST["periodo"];
    $Id_usuario = $_SESSION['user_session'];
    //if (isset($_SESSION['user_session']) ){ $Id_usuario = $_SESSION['user_session']; }
    //$Id_usuario = $_POST['Id_usuario'];
}
?>

<table class="table table-bordered" id="datos">
    <thead class="table-header">
        <tr style="background-color: #5a274f;color: white;">
            <th class="Actividad">Descripción </th>
            <th class="Actividad">Tipo entregable</th>
            <th class="Actividad">Área</th>
            <th class="Actividad">Año</th>
            <th class="Actividad">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $consulta = "SELECT
        d.id_documento,
        d.descripcion,
        d.ruta,
        d.pdf,
        a.Nombre AS area,
        per.Periodo,
        t.tipo,
        t.id_tipo,
        chek.IdCheckList,
        chek.Nombre AS checklist,
        cate.descCategoria AS categoria,
        CONCAT( ac.Numeracion, ac.Nombre ) actividad,
        ac.IdTipoActividad,
        CONCAT( e.orden, '.-', e.Nombre ) eje,
        p.Periodo AS fecha , chek.Nivel
    FROM
        c_documento AS d
        INNER JOIN c_area AS a ON a.Id_Area = d.id_area
        INNER JOIN c_tipo_documento AS t ON t.id_tipo = d.id_tipo
        LEFT JOIN k_archivoactividad k_ar ON d.id_documento = k_ar.id_archivo
/*         LEFT JOIN c_exposicionTemporal expo ON k_ar.id_exposicion = expo.idExposicion */
        LEFT JOIN c_periodo per ON d.anio = per.Id_Periodo
        LEFT JOIN c_actividad ac ON ac.IdActividad = k_ar.id_actividad
        LEFT JOIN c_eje e ON e.idEje = k_ar.id_proyecto
        LEFT JOIN c_categoriasdeejes cate ON cate.idCategoria = d.IdCategoriadeEje
        LEFT JOIN c_checkList chek ON chek.IdCheckList = d.Id_check
        INNER JOIN c_periodo p on p.Id_Periodo=d.anio
        WHERE
	d.id_tipo IN ( 9, 10, 14 ) AND cate.idCategoria=$Id_categoria and ac.IdActividad=$Id_actividad AND chek.IdCheckList=$Id_check AND ac.IdTipoActividad=$tipo
    ORDER BY FIELD (d.id_tipo,10,14,9),p.Periodo desc";
        //echo $consulta;
        $resultEntregable = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultEntregable)) {
            $id_archivo = $row['id_documento'];
            $Nivel = $row['Nivel'];

            if ($row['id_tipo'] == 9) $color_texto = "#dfa739";
            if ($row['id_tipo'] == 10) $color_texto = "#33ab15";
            if ($row['id_tipo'] == 14) $color_texto = "#dbd909";
            echo '<tr>';
            echo '<td>' . $row['descripcion'] . '</td>';
            $ruta = $row['ruta'] . $row['pdf'];
            if ($row['id_tipo'] == 3) {
                echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
            } else if ($row['id_tipo'] == 4) {
                echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-book"></i></a></td>';
            } else if ($row['id_tipo'] == 5) {
                echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-film"></i></a></td>';
            } else if ($row['id_tipo'] == 6) {
                echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-volume-up"></i></a></td>';
            } else if ($row['id_tipo'] == 7) {
                echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-tasks"></i></a></td>';
            } else if ($row['id_tipo'] == 8) {
                echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-picture"></i></a></td>';
            } else if ($row['id_tipo'] == 9 || $row['id_tipo'] == 10 || $row['id_tipo'] == 14) {
                if ($row['pdf'] == "link") { //si es un link a un archivo
                    echo '<td><a target="_blank" href="' . $row['ruta'] . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-link"></i></a></td>';
                } else {
                    echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
                }
            } else {
                echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
            }
            echo '<td>' . $row['area'] . '</td>';
            echo '<td>' . $row['fecha'] . '</td>';
            $anadido = "";
            if($Nivel == 3){ //en caso de ser check de actividad o global para diferenciarlo
              $anadido = "&check_global=".$Id_check;
            }
            $ruta_edita = "../ArchivosEntregables/Alta_entregable_2.php?accion=editar2&id=" . $id_archivo . "&tipoPerfil=1&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $idUsuario . "&regreso=2&plan=2$anadido";
            $editar = "onclick='edita($idUsuario,13,\"$ruta_edita\")'";
            $eliminar  ="";
            if ($Id_usuario == 1064 || $Id_usuario == 5 || $Id_usuario == 1 || $Id_usuario == 1145) {
                $eliminar = "onclick='elimina($idUsuario,13,$id_archivo);'";
            }
            echo '<td>';
            if($eliminar != ""){
              echo '<a style="cursor:pointer;left: 6px;position: relative;color: purple;" ' . $eliminar . '><span><i data-toggle="tooltip" data-placement="bottom" data-original-title="Borrar evidencia" class="fas fa-trash-alt"></i></span></a>';
            }
            echo '<a style="cursor:pointer;left: 12px;position: relative;color: purple;" ' . $editar . '><span><i data-toggle="tooltip" data-placement="bottom" data-original-title="Editar evidencia" class="fas fa-pen"></i></span></a>';
            echo '</td>';
            echo '</tr>';
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
            "searching": false,
            pageLength: 100,
            "order": [],
            "paging": false
        });

    });

    function eliminar(Id) {
        //var con = "'"+controller+"'";
        $.confirm({
            icon: 'glyphicon glyphicon-minus-sign',
            title: '¿Desea eliminar el entregable?',
            content: 'No podrás revertir los cambios',
            autoClose: 'cancelar|8000',
            type: 'dark',
            typeAnimated: true,
            buttons: {
                aceptar: {
                    btnClass: 'btn-dark',
                    action: function() {
                        $.post('../../../WEB-INF/Controllers/ArchivosCompartidos/Controler_archivo.php', {
                            id: Id,
                            accion: "eliminar"
                        }, function(data) {
                            if (data.toString().indexOf("Error:") === -1) {
                                //$.dialog(data);
                                $.confirm({
                                    icon: 'glyphicon glyphicon-ok-sign',
                                    title: data,
                                    content: '',
                                    type: 'dark',
                                    buttons: {
                                        aceptar: {
                                            action: function() {
                                                location.reload();
                                            }

                                        }
                                    }
                                });
                                //location.reload();
                            } else {
                                $.confirm({
                                    icon: 'glyphicon glyphicon-remove-sign',
                                    title: data,
                                    content: '',
                                    type: 'red',
                                    buttons: {
                                        aceptar: {
                                            action: function() {
                                                location.reload();
                                            }

                                        }
                                    }
                                });
                                //$.dialog(data);
                            }
                            //location.reload();
                        });
                    }
                },
                cancelar: function() {
                    //$.alert('Cancelado!');
                }
            }
        });
    }
</script>
