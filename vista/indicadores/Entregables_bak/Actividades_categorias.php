<?php
$id_eje = $_POST["eje"];
$id_categoria = $_POST["categoria"];
$periodo = $_POST["periodo"];
$query = "";
$total_e = 0;
$where_categoria = "";
$Total_entregables = 0;
$Total_entregables_obtenidos = 0;
$Id_Actividad = "";

if ($id_eje > 0) {
    $where_categoria = " AND e.idEje=$id_eje";
}
include_once('../../../WEB-INF/Classes/Catalogo.class.php');

$catalogo = new Catalogo();
$query = "SELECT ac.IdActividad, CONCAT( ac.Numeracion, ac.Nombre ) actividad,
(SELECT COUNT( ka.id_archivo ) FROM k_archivoactividad ka LEFT JOIN c_documento d on d.id_documento=ka.id_archivo WHERE ka.id_actividad = ac.IdActividad AND d.id_tipo in(9,10,14) ) entregables,
(SELECT COUNT( ka.id_archivo ) FROM k_archivoactividad ka LEFT JOIN c_documento d on d.id_documento=ka.id_archivo WHERE ka.id_actividad = ac.IdActividad AND d.id_tipo in(9) ) total_pr,
(SELECT COUNT( ka.id_archivo ) FROM k_archivoactividad ka LEFT JOIN c_documento d on d.id_documento=ka.id_archivo WHERE ka.id_actividad = ac.IdActividad AND d.id_tipo in(10) ) total_f,
(SELECT COUNT( ka.id_archivo ) FROM k_archivoactividad ka LEFT JOIN c_documento d on d.id_documento=ka.id_archivo WHERE ka.id_actividad = ac.IdActividad AND d.id_tipo in(14) ) total_p
FROM c_actividad ac 
INNER JOIN c_periodo p ON p.Id_Periodo = ac.Periodo INNER JOIN c_eje e ON e.idEje = ac.IdEje 
WHERE  p.Id_Periodo = $periodo AND ac.IdNivelActividad = 1 AND ac.Idcategoria = $id_categoria $where_categoria";
//echo$query;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>categorias</title>
    <link rel="stylesheet" type="text/css" href="../../../resources/css/Indicador_entregables.css" />

</head>

<body>
    <div class="container">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table id="tabla_principal" class="table table-principal">
                    <thead class="table-header">
                        <tr>
                            <th class="Actividad">Actividad General</th>
                            <th class="Entregable">Entregables</th>
                            <th class="Entregable_pre">Preliminar</th>
                            <th class="Entregable_pro">En proceso</th>
                            <th class="Entregable_fin">Final</th>
                        </tr>
                    </thead>
                    <tbody class="table-body " id="table_principal_body">
                        <?php
                        $resultConsulta = $catalogo->obtenerLista($query);
                        while ($row = mysqli_fetch_array($resultConsulta)) {
                            $Id_Actividad = $row['IdActividad'];
                            $nombre_actividad = $row['actividad'];
                            $total_En = $row['entregables'];
                            $total_En_pre = $row['total_pr'];
                            $total_En_pro = $row['total_p'];
                            $total_En_fin = $row['total_f'];
                        ?>
                            <tr id="row_<?php echo $Id_Actividad; ?>" class="nivel-1acordeon">
                                <td class="Actividad" onclick="muestraGeneral(<?php echo $Id_Actividad ?>);"><span><?php echo $nombre_actividad; ?></span> <span class="toggle-icon"><i id="chev" class="fas fa-chevron-left" style="margin-top: 2px;"></i><i id="1" class="fas fa-chevron-down" style="display: none;"></i></span></td>
                                <td class="Entregable"><a onclick="muestraTab(<?php echo $Id_Actividad ?>,1);"><?php echo $total_En; ?></a></td>
                                <td class="Entregable_pre"><a onclick="muestraTab(<?php echo $Id_Actividad ?>,1);"><?php echo $total_En_pre; ?></a></td>
                                <td class="Entregable_pro"><a onclick="muestraTab(<?php echo $Id_Actividad ?>,1);"><?php echo $total_En_pro; ?></a></td>
                                <td class="Entregable_fin"><a onclick="muestraTab(<?php echo $Id_Actividad ?>,1);"><?php echo $total_En_fin; ?></a></td>
                            </tr>

                        <?php }  ?>
              
                    </tbody>
                    <tfoot>
                        <tr class="table-header">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12" id="muestraTabla">
            </div>

        </div>
    </div>

</body>
<script>
    bandera_primer_clic = [];

    function muestraTab(Id_actividad, tipo) {
        var Id_actividad = Id_actividad;
        var tipo = tipo;
        $.post("lista_entregables.php", {
            Id_actividad: Id_actividad,
            tipo: tipo
        }, function(data) {
            $("#muestraTabla").html('');
            $("#muestraTabla").html(data);
        });
    }

    function muestraGeneral(Id_actividad) {
        var Id_actividad = Id_actividad;
        $("#muestraTabla").html('');
        if (!bandera_primer_clic.includes("row_" + Id_actividad)) {
            bandera_primer_clic.push("row_" + Id_actividad);
            $.post("Actividad_general.php", {
                    Id_actividad: Id_actividad,
                },
                function(data) {
                    $('#row_' + Id_actividad).after(data);

                });
        } else {
            ocultar_mostrar(Id_actividad);
        }
    }

    function ocultar_mostrar(Id_actividad) {
        var sig_row = $('.hija');
        sig_row.each(function(i) {
            if ($(this).data('id') == Id_actividad) {
                $(this).toggle();
            }

        })
    }
</script>

</html>