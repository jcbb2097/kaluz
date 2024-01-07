<?php
$id_eje = $_POST["eje"];
$id_categoria = $_POST["categoria"];
$periodo = $_POST["periodo"];
$query = "";
$total_e = 0;

include_once('../../../WEB-INF/Classes/Catalogo.class.php');

$catalogo = new Catalogo();
$query = "SELECT a.Id_Area,a.Nombre,COUNT(d.id_documento) entregables FROM c_documento as d INNER JOIN c_area a on a.Id_Area=d.id_area 
WHERE d.anio=$periodo AND d.IdCategoriadeEje=$id_categoria
GROUP BY a.Nombre ";
//echo $query;
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
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
            <table id="tabla_principal" class="table table-principal">
                    <thead class="table-header">
                        <tr>
                            <th>Área</th>
                            <th># Entregable</th>
                        </tr>
                    </thead>
                    <tbody class="table-body " id="table_principal_body">
                        <?php
                        $resultConsulta = $catalogo->obtenerLista($query);
                        while ($row = mysqli_fetch_array($resultConsulta)) {
                            echo '<tr>';
                            echo "<td class='Actividad'>" . $row['Nombre'] . "</td>";
                            echo "<td class='Entregable'>" . $row['entregables'] . "</td>";
                            echo '</tr>';
                            $total_e = $total_e + $row['entregables'];
                        }
                        ?>
                    </tbody>
                    <tfoot class="table-header">
                        <th>Total</th>
                        <th><?php echo $total_e; ?></th>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6" id="muestraGeneral">
            </div>
        </div>
        <div class="row" id="muestraTabla">

        </div>
    </div>
</body>
<script>

</script>

</html>