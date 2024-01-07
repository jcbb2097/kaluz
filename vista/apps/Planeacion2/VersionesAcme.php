<?php
session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$nombreUsuario = "";
$idUsuario = "1";
if (isset($_SESSION['user_session']) ){ $Id_usuario = $_SESSION['user_session']; }
if (isset($_POST['Id_actividad']) && $_POST['Id_actividad'] != "") {
    $Id_actividad = $_POST["Id_actividad"];
    $tipo = $_POST["tipo"];
    $Id_categoria = $_POST["Id_categoria"];
    $periodo = $_POST["periodo"];

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
        $consulta = "SELECT DISTINCTROW
        d.id_documento,d.descripcion, d.ruta,d.pdf,per.Periodo,
            t.tipo,t.id_tipo,cate.descCategoria AS categoria,CONCAT( aa.Numeracion, a.Nombre ) actividad,
            a.IdTipoActividad,per.Periodo AS fecha,a.nombre as area
    FROM
        c_actividad a
        LEFT JOIN k_actividad_categoria aa ON aa.IdActividad = a.IdActividad
        LEFT JOIN c_documento d ON d.id_documento = aa.Archivo
        LEFT JOIN c_area ar ON ar.Id_Area = d.id_area
        LEFT JOIN k_checklist_actividad ch ON ch.IdActividad = a.IdActividad
        LEFT JOIN c_checkList c ON c.IdCheckList = ch.IdCheckList
        LEFT JOIN c_periodo per ON d.anio = per.Id_Periodo
         LEFT JOIN c_categoriasdeejes cate ON cate.idCategoria = d.IdCategoriadeEje
        INNER JOIN c_tipo_documento AS t ON t.id_tipo = d.id_tipo
    WHERE
        aa.IdActividad = $Id_actividad
        AND aa.IdCategoria = $Id_categoria
        AND aa.IdPeriodo = $periodo
        AND c.Nivel = 3
        AND d.id_tipo IN ( 9, 10, 14 )
    ORDER BY
        FIELD ( d.id_tipo, 10, 14, 9 ),
        d.fechaCreacion";
        //echo $consulta;
        $resultEntregable = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultEntregable)) {
            $id_archivo = $row['id_documento'];
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
            $eliminar = "";
            $ruta_edita = "../ArchivosEntregables/Alta_entregable_2.php?accion=editar2&id=" . $id_archivo . "&tipoPerfil=1&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $idUsuario . "&regreso=2&plan=2";
            $editar = "onclick='edita($idUsuario,13,\"$ruta_edita\")'";
            if ($Id_usuario == 1064 || $Id_usuario == 5 || $Id_usuario == 1 || $Id_usuario == 1145) {
            $eliminar = "onclick='elimina($idUsuario,13,$id_archivo);'";
            }
            echo '<td>';
            echo '<a style="cursor:pointer;left: 6px;position: relative;color: purple;" ' . $eliminar . '><span><i data-toggle="tooltip" data-placement="bottom" data-original-title="Borrar evidencia" class="fas fa-trash-alt"></i></span></a>';
            echo '<a style="cursor:pointer;left: 12px;position: relative;color: purple;" ' . $editar . '><span><i data-toggle="tooltip" data-placement="bottom" data-original-title="Editar evidencia" class="far fa-edit"></i></span></a>';
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
