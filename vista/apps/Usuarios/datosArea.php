<?php
$id_Area = $_POST["id"];

include_once('../../../WEB-INF/Classes/Catalogo.class.php');

$catalogo = new Catalogo();

?>
<html>

<head>
    <title>Museo del Palacio de Bellas Artes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style type="text/css">
        a:hover {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table class="table table-striped table-bordered table-responsive" style="width:100%" id="datosarea">
                    <thead>
                    <tr>
                            <th>Nombre</th>
                            <th>Tipo de Personal</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $consulta ="SELECT Concat(P.Nombre,' ',P.Apellido_Paterno,' ',P.Apellido_Materno)   AS Nombre, CE.Nombre AS Clasificacion
                        FROM c_usuario U INNER JOIN c_personas P ON U.IdPersona=P.id_Personas
                        INNER JOIN c_area A ON P.idArea=A.Id_Area
                        LEFT JOIN k_clasificacionPersona CP ON P.id_Personas=CP.IdPersona
                        LEFT JOIN c_clasificacionEmpleado CE ON CP.IdClasificacion=CE.IdClasificacionEmpleado
                        WHERE A.estatus=1 AND U.Activo=1 AND P.idArea=" . $id_Area;
                        $resultConsulta = $catalogo->obtenerLista($consulta);
                        while ($row = mysqli_fetch_array($resultConsulta)) {

                            echo '<tr>';
                            echo '<td style="text-align:left; vertical-align:middle">' . $row['Nombre'] . '</td>';
                            echo '<td> ' . $row ["Clasificacion"] .'</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</body>
<script>
    $(document).ready(function() {

        // DataTable
        var table = $('#datosarea').DataTable();
        table.destroy();
        table = $('#datosarea').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
            },
            "scrollX": true,
            responsive: false,
            pageLength: 100,
            "scrollY": "370px",
            "scrollCollapse": true,
            "paging": true
        });

    });
</script>

</html>
