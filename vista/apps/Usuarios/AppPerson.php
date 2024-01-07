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
          <select class="selectpicker form-control input-sm" data-live-search="true" title="Seleccione persona" data-hide-disabled="true" name="persona" id="persona">
            <?php
              $usuarios = "SELECT per.id_Personas, CONCAT(per.Nombre,' ',per.Apellido_Paterno,' ',per.Apellido_Materno) AS nombre
                           FROM c_personas per
                           JOIN c_usuario U ON per.id_Personas=U.IdPersona
                           JOIN k_usuarioLog UL ON U.IdUsuario=UL.idUsuario
                            WHERE per.Activo = 1
                            GROUP BY id_Personas";
              $result = $catalogo->obtenerLista($usuarios);
              while ($row = mysqli_fetch_array($result)){
                echo '<option value="'.$row['id_Personas'].'">'.$row['nombre'].'</option>';
              }
             ?>
          </select>

        </div>

      </div>
        <div class="row">
          <div id="recargar">
              <div class="col-md-8 col-sm-8 col-xs-8">
                  <table class="table table-striped table-bordered table-responsive" style="width:100%" id="userApp">
                      <thead>
                          <tr>
                              <th>Aplicacion</th>
                              <th>Nombre/s</th>
                              <th>Tipo de Personal</th>
                          </tr>
                      </thead>
                      <tbody id="body_userapp">
                              <?php
                              $Consulta = "SELECT UL.idApp AS ID,A.Descripcion AS Tipo,CONCAT(P.Nombre,' ',P.Apellido_Paterno,' ',P.Apellido_Materno) AS nombre, CE.Nombre AS Clasificacion
                              FROM c_personas P INNER JOIN c_usuario U ON P.id_Personas=U.IdPersona
                              INNER JOIN k_usuarioLog UL ON U.IdUsuario=UL.idUsuario
                              INNER JOIN c_aplicaciones A ON UL.idApp=A.idAplicacion
                              LEFT JOIN k_clasificacionPersona CP ON P.id_Personas=CP.IdPersona
                              LEFT JOIN c_clasificacionEmpleado CE ON CP.IdClasificacion=CE.IdClasificacionEmpleado
                              WHERE U.Activo=1";
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
                              ?>
                      </tbody>
                  </table>
              </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
              <figure class="highcharts-figure">
                <div id="contaner" style="width:220%; height:270%; text-align=center;"></div>
              </figure>
            </div>
        </div>
    </div>
</body>
<script>

$(document).ready(function() {

// DataTable
var table = $('#userApp').DataTable();
table.destroy();
table = $('#userApp').DataTable({

    "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },

    responsive: false,
    pageLength: 10,
    "paging": true
});

});

$( "#persona" ).change(function() {

  let persona = $( "#persona" ).val();
  $("#recargar").load("tablas.php?action=AppPerson&valor="+persona);
});



</script>

<script type="text/JavaScript">

Highcharts.chart('container', {
  chart:{
    type: 'scatter',
    zoomType: 'xy'
  },
  title: {
    text: 'Aplicación por persona'
  },

  xAxis: {
    type: 'category',
    labels: {
      rotation: -45,
      style: {
        fontSize: '10px',
        fontFamily: 'Verdana, sans-serif'
      }
    }

  },
  yAxis: {
    min: 0,
    title: {
      text: 'Aplicación'
    }

  },

  series: [{
    name: 'Aplicación',
    data:
    [<?php
            $resul = $catalogo->obtenerLista($Consulta);
            while ($row = mysqli_fetch_array($resul)) {

                                echo "['" . $row ["Usuario"] ."'," . $row ["ID"]."],";

                            }  ?>]
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
