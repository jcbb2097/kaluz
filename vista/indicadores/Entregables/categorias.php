<?php
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once('../../../WEB-INF/Classes/Indicador_entregables.class.php');
$catalogo = new Catalogo();
$Entregable = new Indicador_entregable();
$total_e = 0;
$total_ep = 0;
$total_epr = 0;
$total_ef = 0;
$Eje = "";
$periodo = "";
$categoria = "";
$sub_categoria = "";
$where_eje = "";
$where_ano = "";
$where_ano2 = "";
$where_categoria = "";
$where_subcategoria = "";

$Eje = $_POST["eje"];
$categoria = $_POST["cate"];
$sub_categoria = $_POST["subcate"];
if (isset($_POST['anio']) && $_POST['anio'] != "") {
    $periodo = $_POST["anio"];
    if ($periodo != 'todos') {
        $where_ano = " AND d.anio=" . $periodo;
        $where_ano2 = "where p.Id_Periodo=" . $periodo;
    }
}

if ($Eje != 0 && $categoria <= 0) {
    $where_eje = " AND e.idEje=" . $Eje." AND ce.nivelCategoria=1";
} elseif ($Eje != 0 && $categoria != 0 && $sub_categoria <= 0) {
    $where_categoria = " AND ce.idCategoriaPadre=" . $categoria . " or ce.idCategoria=" . $categoria;
} elseif ($Eje != 0 && $categoria != 0 && $sub_categoria != 0) {
    $where_subcategoria = " AND ce.idCategoria=" . $sub_categoria;
}
$estatus = "";
$totales = $Entregable->Total_entregables($periodo, $Eje, $categoria, $estatus);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title></title>
</head>
<style>
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

    .my-custom-scrollbar-gen {
        position: relative;
        height: 550px;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }


    .my-custom-scrollbar-gen::-webkit-scrollbar {
        -webkit-appearance: none;
    }

    .my-custom-scrollbar-gen::-webkit-scrollbar:vertical {
        width: 10px;
    }

    .my-custom-scrollbar-gen::-webkit-scrollbar-button:increment,
    .my-custom-scrollbar-gen::-webkit-scrollbar-button {
        display: none;
    }

    .my-custom-scrollbar-gen::-webkit-scrollbar:horizontal {
        height: 10px;
    }

    .my-custom-scrollbar-gen::-webkit-scrollbar-thumb {
        /* background-color: #797979;
    border-radius: 20px;
    border: 2px solid #f1f2f3;
	border-radius: 0px;
    border: 2px solid #464456;*/
        background-color: #cbcbca;
        border-radius: 4px;
        border: 1px solid #5a274f;
    }

    .my-custom-scrollbar-gen::-webkit-scrollbar-track {
        border-radius: 10px;
    }

    .camColor {
        background-color: #f3f3f3;
    }

    .table .table-body tr>td {
        font-size: 10px;
        font-weight: 600;
        padding: 4px 8px 3px;
        border-right: 1px solid #444444;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="table-wrapper-scroll-y my-custom-scrollbar-gen">
                    <table id="tabla_principal" class="table table-principal">
                        <thead class="table-header">
                            <tr>
                                <th>Eje</th>
                                <th>Categorías / Subcategorías</th>
                                <th>Entregables (<?php echo $totales[0]; ?>)</th>
                                <th>Inicial (<?php echo $totales[2]; ?>)</th>
                                <th>En proceso (<?php echo $totales[3]; ?>)</th>
                                <th>Final (<?php echo $totales[1]; ?>)</th>
                            </tr>
                        </thead>
                        <tbody class="table-body " id="table_principal_body">
                            <?php
                            $consulta = "SELECT DISTINCT e.idEje,ce.idCategoria,ce.descCategoria,CONCAT( e.orden, '.- ', e.Nombre ) Nombre,
                        (SELECT	COUNT( ka.id_archivo ) FROM k_archivoactividad ka LEFT JOIN c_documento d ON d.id_documento = ka.id_archivo WHERE d.IdCategoriadeEje=ce.idCategoria AND d.id_tipo  in(9,10,14) $where_ano) total,
                        (SELECT	COUNT( ka.id_archivo ) FROM k_archivoactividad ka LEFT JOIN c_documento d ON d.id_documento = ka.id_archivo WHERE d.IdCategoriadeEje=ce.idCategoria AND d.id_tipo = 9 $where_ano ) total_pr,
                        (SELECT	COUNT( ka.id_archivo ) FROM k_archivoactividad ka LEFT JOIN c_documento d ON d.id_documento = ka.id_archivo WHERE d.IdCategoriadeEje=ce.idCategoria AND d.id_tipo = 10 $where_ano) total_f,
                        (SELECT	COUNT( ka.id_archivo ) FROM k_archivoactividad ka LEFT JOIN c_documento d ON d.id_documento = ka.id_archivo WHERE d.IdCategoriadeEje=ce.idCategoria AND d.id_tipo = 14 $where_ano) total_p
                        FROM c_eje e 	
                        INNER JOIN c_categoriasdeejes ce on ce.idEje=e.idEje
                        INNER JOIN c_periodo p on p.Periodo=ce.anio
	                    $where_ano2 $where_eje $where_categoria $where_subcategoria";
                            $resultConsulta = $catalogo->obtenerLista($consulta);
                            while ($row = mysqli_fetch_array($resultConsulta)) {
                                $modal = "'" . $row['Nombre'] . "'";
                                $categoria = "'" . $row['descCategoria'] . "'";
                                echo '<tr>';
                                echo '<td style="text-align:left; font-weight: bold;">' . $row['Nombre'] . '</td>';
                                echo '<td><a onclick="muestraDetalle3(' . $row['idEje'] . ',' . $row['idCategoria'] . ');mostrarModal3(' . $categoria . ')">' . $row['descCategoria'] . '</a></td>';
                                echo '<td style="text-align:center; vertical-align:middle"><a style="color:black;" onclick="muestraDetalle(' . $row['idEje'] . ',1,' . $row['idCategoria'] . ');mostrarModal(' . $modal . ',0)">' . $row['total'] . '</a></td>';
                                echo '<td style="text-align:center; vertical-align:middle"><a style="color:#dfa739" onclick="muestraDetalle(' . $row['idEje'] . ',9,' . $row['idCategoria'] . ');mostrarModal(' . $modal . ',1)">' . $row['total_pr'] . '</a></td>';
                                echo '<td style="text-align:center; vertical-align:middle"><a style="color:#dbd909" onclick="muestraDetalle(' . $row['idEje'] . ',14,' . $row['idCategoria'] . ');mostrarModal(' . $modal . ',2)">' . $row['total_p'] . '</a></td>';
                                echo '<td style="text-align:center; vertical-align:middle"><a style="color:#33ab15" onclick="muestraDetalle(' . $row['idEje'] . ',10,' . $row['idCategoria'] . ');mostrarModal(' . $modal . ',3)">' . $row['total_f'] . '</a></td>';
                                echo '</tr>';
                                $total_e = $total_e + $row['total'];
                                $total_ep = $total_ep + $row['total_p'];
                                $total_epr = $total_epr + $row['total_pr'];
                                $total_ef = $total_ef + $row['total_f'];
                            }
                            ?>
                        </tbody>
                        <tfoot class="table-header">
                            <th>Eje</th>
                            <th>Categoría</th>
                            <th>Entregables (<?php echo $total_e; ?>)</th>
                            <th>Inicial (<?php echo $total_epr; ?>)</th>
                            <th>En proceso (<?php echo $total_ep; ?>)</th>
                            <th>Final (<?php echo $total_ef; ?>)</th>
                        </tfoot>
                    </table>
                </div>
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
                                <button type="button" class="close" data-dismiss="modal" style="color: whitesmoke;">&times;</button>
                                <div class="modal-title" style=" color: rgb(255, 255, 255); font-size: 11px;text-align: center;" id="modalTitle">Opiniones detalle</div>
                            </div>
                            <div class="modal-body detalle" style="padding: 31px 5px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function muestraDetalle(id, tipo, categoria) {
        var periodo = $('#periodo').val();
        $(".h").css('background-color', "#4d4d57");
        $("#myModal").modal({
            backdrop: false
        });
        $.post("datos_eje.php", {
            id: id,
            tipo: tipo,
            periodo: periodo,
            categoria: categoria
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
        titulo = 'Entregables' + sub + ' del eje ' + nombre;
        $("#modalTitle").html(titulo);
        $("#myModal").modal("show");
    }

    function mostrarModal2(nombre) {
        var titulo;
        titulo = 'Global del eje ' + nombre;
        $("#modalTitle").html(titulo);
        $("#myModal").modal("show");
    }

    function mostrarModal3(nombre) {
        var titulo;
        titulo = 'Categoría: ' + nombre;
        $("#modalTitle").html(titulo);
        $("#myModal").modal("show");
    }


    function muestraDetalle3(id_eje, id_categoria) {
        var periodo = $('#periodo').val();
        $(".h").css('background-color', "#4d4d57");
        $("#myModal").modal({
            backdrop: false
        });
        $.post("index_categorias.php", {
            Id_eje: id_eje,
            Id_categoria: id_categoria,
            periodo: periodo
        }, function(data) {
            $(".detalle").html('');
            $(".detalle").html(data);
        });
    }
</script>

</html>