<?php
$id_eje = $_POST["eje"];
$id_categoria = $_POST["categoria"];
$periodo = $_POST["periodo"];
$query = "";
$total_e = 0;

include_once('../../../WEB-INF/Classes/Catalogo.class.php');

$catalogo = new Catalogo();
$query = "SELECT CONCAT(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno) persona ,COUNT(d.id_documento) entregables FROM c_documento d INNER JOIN c_usuario u on u.IdUsuario=d.id_usuario
INNER JOIN c_personas p on p.id_Personas=u.IdPersona WHERE d.anio=$periodo and d.IdCategoriadeEje=$id_categoria GROUP BY p.Nombre";
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
                            <th>Responsable</th>
                            <th># Entregable</th>
                        </tr>
                    </thead>
                    <tbody class="table-body " id="table_principal_body">
                        <?php
                        $resultConsulta = $catalogo->obtenerLista($query);
                        while ($row = mysqli_fetch_array($resultConsulta)) {
                            echo '<tr>';
                            echo "<td class='Actividad'>" . $row['persona'] . "</td>";
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