<?php

include_once('../../../WEB-INF/Classes/Catalogo.class.php');

$catalogo = new Catalogo();

if(isset($_REQUEST['action'])){
  $accion  = $_REQUEST['action'];
}
if(isset($_REQUEST['valor'])){
  $valor  = $_REQUEST['valor'];
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">

        <div class="col-md-8 col-sm-8 col-xs-8">
          <table class="table table-striped table-bordered table-responsive" style="width:100%" id="tabla">
            <?php
            switch ($accion) {
              case 'AppPerson':
                    echo "<thead>
                        <tr>
                            <th>Aplicacion</th>
                            <th>Nombre/s</th>
                            <th>Tipo de Personal</th>
                        </tr>
                    </thead>";
                    echo "<tbody >";
                    $Consulta = "SELECT UL.idApp AS ID,A.Descripcion AS Tipo,CONCAT(P.Nombre,' ',P.Apellido_Paterno,' ',P.Apellido_Materno) AS nombre, CE.Nombre AS Clasificacion
                    FROM c_personas P INNER JOIN c_usuario U ON P.id_Personas=U.IdPersona
                    INNER JOIN k_usuarioLog UL ON U.IdUsuario=UL.idUsuario
                    INNER JOIN c_aplicaciones A ON UL.idApp=A.idAplicacion
                    LEFT JOIN k_clasificacionPersona CP ON P.id_Personas=CP.IdPersona
                    LEFT JOIN c_clasificacionEmpleado CE ON CP.IdClasificacion=CE.IdClasificacionEmpleado
                    WHERE U.Activo=1  and P.id_Personas = $valor";
                    $resul = $catalogo->obtenerLista($Consulta);
                    while ($row = mysqli_fetch_array($resul)) {
                        echo '<tr>';
                        echo "<p>";
                        echo '<td> ' . $row ["Tipo"] .'</td>';
                        echo '<td style="text-align:center; vertical-align:middle">' . $row['nombre'] . '</td>';
                        echo '<td> ' . $row ["Clasificacion"] .'</td>';
                        echo "</p>";
                        echo '</tr>';
                    }
                    echo "</tbody >";
                break;
              case 'usoApp':
              echo "<thead>
                  <tr>
                    <th>Aplicación</th>
                    <th>Uso</th>
                    <th>Nombre/s</th>
                    <th>Tipo de Personal</th>
                  </tr>
              </thead>";
              echo "<tbody >";
                      $Consulta = "SELECT A.Descripcion AS Aplicación, COUNT(UL.idApp) AS Uso,
                      Concat(P.Nombre,' ',P.Apellido_Paterno,' ',P.Apellido_Materno) AS Nombre, CE.Nombre AS Clasificacion
                      FROM c_personas P INNER JOIN c_usuario U ON P.id_Personas=U.IdPersona
                      INNER JOIN k_usuarioLog UL ON U.IdUsuario=UL.idUsuario
                      INNER JOIN c_aplicaciones A ON UL.idApp=A.idAplicacion
                      LEFT JOIN k_clasificacionPersona CP ON P.id_Personas=CP.IdPersona
                      LEFT JOIN c_clasificacionEmpleado CE ON CP.IdClasificacion=CE.IdClasificacionEmpleado
                      WHERE U.Activo=1 AND  A.idAplicacion = $valor GROUP BY UL.idUsuario, UL.idApp ORDER BY P.Nombre";
                      $resul = $catalogo->obtenerLista($Consulta);
                      while ($row = mysqli_fetch_array($resul)) {
                          echo '<tr>';
                          echo "<p>";
                          echo '<td> ' . $row ["Aplicación"] .'</td>';
                          echo '<td> ' . $row ["Uso"] .'</td>';
                          echo '<td style="text-align:center; vertical-align:middle">' . $row['Nombre'] . '</td>';
                          echo '<td> ' . $row ["Clasificacion"] .'</td>';
                          echo "</p>";
                          echo '</tr>';
                      }
                      echo "</tbody >";
                  break;

              default:
                // code...
                break;
            }

            ?>
          </table>
        </div>
      </div>
    </div>
  </body>
  <script>

  $(document).ready(function() {

  // DataTable
  var table = $('#tabla').DataTable();
  table.destroy();
  table = $('#tabla').DataTable({

      "language": {
          "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      },

      responsive: false,
      pageLength: 10,
      "paging": true
  });

  });
  </script>
</html>
