<?php

include_once('../../../WEB-INF/Classes/Catalogo.class.php');

$catalogo = new Catalogo();
$where_ano = "";
$total_e = 0;
$total_ep = 0;
$total_epr = 0;
$total_ef = 0;
$periodo = $_POST["anio"];

if ($periodo != 'todos') {
    $where_ano = " and d.anio=" . $periodo;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title></title>
    <style type="text/css">
        .table.table-principal .table-header {
            background-color: #444444;
            color: #ffffff;
        }

        .table.table-principal .table-footer {
            background-color: #444444;
            color: #ffffff;
        }

        .table.table-principal .table-body th {
            background-color: #ffffff;
        }



        .table.table-principal .table-header th {
            font-size: 10px;
            font-weight: 600;
            text-align: middle;
            padding: 3px 8px 3px;
            text-align: center;

        }

        a:hover {
            cursor: pointer;
        }

        .font {
            font-family: 'Muli-SemiBold';
            font-size: 11px;
        }

        .modalTitle {
            box-sizing: border-box;
            color: rgb(255, 255, 255);
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 11px;
            line-height: 15.7167px;
            margin-bottom: 0px;
            margin-left: 0px;
            margin-right: 0px;
            margin-top: 0px;
            text-align: center
        }
        .table .table-body tr>td {
        font-size: 10px;
        font-weight: 600;
        padding: 4px 8px 3px;
        border-right: 1px solid #444444;
    }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
            <table id="tabla_principal" class="table table-principal">
                        <thead class="table-header">
                        <tr>
                            <th>Área</th>
                            <th>Entregables</th>
                            <th>Preliminar</th>
                            <th>En proceso</th>
                            <th>Final</th>
                        </tr>
                    </thead>
                    <tbody class="table-body " id="table_principal_body">
                        <?php
                        $consulta = "SELECT
                        a.Id_Area,
                        a.Nombre,
                        (SELECT COUNT(d.id_documento) FROM c_documento d WHERE d.id_area=a.id_area AND d.id_tipo in(9,10,14) $where_ano) total,
                        (SELECT COUNT(d.id_documento) FROM c_documento d WHERE d.id_area=a.id_area AND d.id_tipo = 9 $where_ano) total_pr,
                        (SELECT COUNT(d.id_documento) FROM c_documento d WHERE d.id_area=a.id_area AND d.id_tipo = 10 $where_ano) total_f,
                        (SELECT COUNT(d.id_documento) FROM c_documento d WHERE d.id_area=a.id_area AND d.id_tipo = 14 $where_ano) total_p
                        FROM c_area a WHERE a.estatus=1 AND ISNULL(a.idAreaPadre)";
                        $resultConsulta = $catalogo->obtenerLista($consulta);
                        //echo$consulta;
                        while ($row = mysqli_fetch_array($resultConsulta)) {
                            $modal = "'" . $row['Nombre'] . "'";
                            echo '<tr>';
                            echo '<td style="text-align:left; font-weight: bold;">'.$row['Nombre'].'</td>';
                            echo '<td style="text-align:center; vertical-align:middle"><a style="color:black;" onclick="muestraDetalle(' . $row['Id_Area'] . ',1);mostrarModal(' . $modal . ',0)">' . $row['total'] . '</a></td>';
                            echo '<td style="text-align:center; vertical-align:middle"><a style="color:#dfa739" onclick="muestraDetalle(' . $row['Id_Area'] . ',9);mostrarModal(' . $modal . ',1)">' . $row['total_pr'] . '</a></td>';
                            echo '<td style="text-align:center; vertical-align:middle"><a style="color:#dbd909" onclick="muestraDetalle(' . $row['Id_Area'] . ',14);mostrarModal(' . $modal . ',2)">' . $row['total_p'] . '</a></td>';
                            echo '<td style="text-align:center; vertical-align:middle"><a style="color:#33ab15" onclick="muestraDetalle(' . $row['Id_Area'] . ',10);mostrarModal(' . $modal . ',3)">' . $row['total_f'] . '</a></td>';
                            echo '</tr>';
                            $total_e = $total_e + $row['total'];
                            $total_ep = $total_ep + $row['total_p'];
                            $total_epr = $total_epr + $row['total_pr'];
                            $total_ef = $total_ef + $row['total_f'];
                        }
                        ?>
                    </tbody>
                    <tfoot class="table-header">
                        <tr>
                            <th> Total:</th>
                            <th><?php echo $total_e; ?></th>
                            <th><?php echo $total_epr; ?></th>
                            <th><?php echo $total_ep; ?></th>
                            <th><?php echo $total_ef; ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <input type="hidden" id="periodo" name="opcion" value="<?php echo $periodo ?>" />
                <div style="top: 33px;" class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content" style="left: -145px;width: 888px;">
                            <div class="modal-header h" style="padding: 7px 5px;">
                                <button type="button" class="close" data-dismiss="modal" style=" color: rgb(255, 255, 255);">&times;</button>
                                <div class="modal-title" style=" color: rgb(255, 255, 255); font-size: 11px;text-align: center;" id="modalTitle">Opiniones detalle</div>
                            </div>
                            <div class="modal-body detalle" style="padding: 31px 5px;"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {

        // DataTable
        var table = $('#tabla_principal').DataTable();
        table.destroy();
        table = $('#tabla_principal').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
            }
        });

    });


    function muestraDetalle(id, tipo) {
        var periodo = $('#periodo').val();
        $(".h").css('background-color', "#4d4d57");
        $("#myModal").modal({
            backdrop: false
        });
        $.post("datos_area.php", {
            id: id,
            tipo: tipo,
            periodo: periodo
        }, function(data) {
            $(".detalle").html('');
            $(".detalle").html(data);
        });
    }

    function mostrarModal(nombre, tipo) {
        var titulo;
        var sub;
        if (tipo == 1) {
            sub = ' preliminares ';
        } else if (tipo == 2) {
            sub = ' en proceso ';
        } else if (tipo == 3) {
            sub = ' finales ';
        } else {
            sub = '';
        }
        titulo = 'Entregables' + sub + ' del área ' + nombre;
        $("#modalTitle").html(titulo);
        $("#myModal").modal("show");
    }

    function mostrarModal2(nombre) {
        var titulo;
        titulo = 'Global del área ' + nombre;
        $("#modalTitle").html(titulo);
        $("#myModal").modal("show");
    }

    function muestraDetalle2(id, tipo) {
        var periodo = $('#periodo').val();
        $(".h").css('background-color', "#4d4d57");
        $("#myModal").modal({
            backdrop: false
        });
        $.post("datos_generales_area.php", {
            id: id,
            tipo: tipo,
            periodo: periodo
        }, function(data) {
            $(".detalle").html('');
            $(".detalle").html(data);
        });
    }
</script>

</html>