<?php

include_once('../../../WEB-INF/Classes/Catalogo.class.php');

$catalogo = new Catalogo();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <style type="text/css">
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
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-8">
                <table class="table table-striped table-bordered table-responsive" style="width:100%" id="appAcc">
                    <thead>
                        <tr>
                            <th>Acceso</th>
                            <th>Aplicación</th>
                            <th>Nombre</th>
                            <th>Tipo de Personal</th>

                        </tr>
                    </thead>
                    <tbody>
                            <?php
                            $Consulta = "SELECT A.Descripcion AS Aplicacion,Concat(P.Nombre,' ',P.Apellido_Paterno,' ',P.Apellido_Materno) AS Nombre, CE.Nombre AS Clasificacion, UL.Fecha AS Fecha
                            FROM c_personas P INNER JOIN c_usuario U ON P.id_Personas=U.IdPersona
                            INNER JOIN k_usuarioLog UL ON U.IdUsuario=UL.idUsuario
                            INNER JOIN c_aplicaciones A ON UL.idApp=A.idAplicacion
                            LEFT JOIN k_clasificacionPersona CP ON P.id_Personas=CP.IdPersona
                            LEFT JOIN c_clasificacionEmpleado CE ON CP.IdClasificacion=CE.IdClasificacionEmpleado
                            WHERE U.Activo=1
                            ORDER BY Fecha DESC";
                            $resul = $catalogo->obtenerLista($Consulta);
                            while ($row = mysqli_fetch_array($resul)) {
                                echo '<tr>';
                                echo "<p>";
                                echo '<td> ' . $row ["Fecha"] .'</td>';
                                echo '<td> ' . $row ["Aplicacion"] .'</td>';
                                echo '<td style="text-align:center; vertical-align:middle">' . $row['Nombre'] . '</td>';
                                echo '<td> ' . $row ["Clasificacion"] .'</td>';
                                echo "</p>";
                                echo '</tr>';
                            }
                            ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
              <figure class="highcharts-figure">
                <div id="container" style="width:220%; height:270%; text-align=center;"></div>
              </figure>
            </div>

        </div>
    </div>
</body>
<script>

$(document).ready(function() {

// DataTable
var table = $('#appAcc').DataTable();
table.destroy();

table = $('#appAcc').DataTable({
    order:[],
    "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },

    responsive: false,
    pageLength: 10,
    "paging": true
});

});

</script>

<script type="text/JavaScript">

Highcharts.chart('container', {
  chart:{
    type: 'spline',
  },
  title: {
    text: 'Total de Accesos por día'
  },

  xAxis: {
    type: 'category',
    labels: {
      style: {
        fontSize: '10px',
        fontFamily: 'Verdana, sans-serif'
      }
    }

  },
  yAxis: {
    min: 0,
    title: {
      text: 'Número de accesos'
    }

  },

  series: [{
    name: 'Accesos',
    data:
    [<?php
           $Accesos = "SELECT Date_format(u.fecha,'%d/%m/%Y') AS Dia, COUNT(*) AS Acceso
                      FROM k_usuarioLog u
                      WHERE u.fecha > DATE_ADD(NOW(),INTERVAL -30 DAY)
                      GROUP BY dia
                      ORDER BY u.fecha";
                      $resul = $catalogo->obtenerLista($Accesos);
                      while ($row = mysqli_fetch_array($resul)) {

                           echo "['" . $row ["Dia"] ."'," . $row ["Acceso"]."],";

                 }
                   ?>]
    ,
    dataLabels: {
      enabled: true,
      rotation: 0,
      color: '#FFFFFF',
      align: 'right',
      y: 10, // 10 pixels down from the top
      style: {
        fontSize: '10px',
        fontFamily: 'Verdana, sans-serif'
      }
    }
  }]
});


</script>

</html>
