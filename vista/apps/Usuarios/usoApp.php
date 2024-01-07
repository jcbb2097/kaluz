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
        <div class="col-md-6 col-sm-6 col-xs-6">
          <select class="selectpicker form-control input-sm" data-live-search="true" title="Seleccione persona" data-hide-disabled="true" name="APP" id="APP">
            <?php
              $usuarios = "SELECT * FROM c_aplicaciones  order by Descripcion";
              $result = $catalogo->obtenerLista($usuarios);
              while ($row = mysqli_fetch_array($result)){
                echo '<option value="'.$row['idAplicacion'].'">'.$row['Descripcion'].'</option>';
              }
             ?>
          </select>

        </div>

      </div>
      <br><br>
        <div class="row">
          <div id="recargar">
            <div class="col-md-8 col-sm-8 col-xs-8">
                <table class="table table-striped table-bordered table-responsive" style="width:100%" id="usoApp">
                    <thead>
                        <tr>
                            <th>Aplicación</th>
                            <th>Uso</th>
                            <th>Nombre/s</th>
                            <th>Tipo de Personal</th>

                        </tr>
                    </thead>
                    <tbody id="body_usoApp">
                            <?php

                            $Consulta = "SELECT A.Descripcion AS Aplicación, COUNT(UL.idApp) AS Uso,P.Apellido_Paterno AS ApellidoP,P.Apellido_Materno AS ApellidoM, P.Nombre AS Nombre, CE.Nombre AS Clasificacion
                            FROM c_personas P INNER JOIN c_usuario U ON P.id_Personas=U.IdPersona
                            INNER JOIN k_usuarioLog UL ON U.IdUsuario=UL.idUsuario
                            INNER JOIN c_aplicaciones A ON UL.idApp=A.idAplicacion
                            LEFT JOIN k_clasificacionPersona CP ON P.id_Personas=CP.IdPersona
                            LEFT JOIN c_clasificacionEmpleado CE ON CP.IdClasificacion=CE.IdClasificacionEmpleado
                            WHERE U.Activo=1  GROUP BY UL.idUsuario, UL.idApp ORDER BY P.Nombre";
                            $resul = $catalogo->obtenerLista($Consulta);

                            ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-4">
              <figure class="highcharts-figure">
                <div id="conr" style="width:220%; height:270%; text-align=center;"></div>
              </figure>
            </div>
            </div>
        </div>
    </div>
</body>
<script>
var table = $('#usoApp').DataTable();
$(document).ready(function() {

  table.destroy();
  table = $('#usoApp').DataTable({

      "language": {
          "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      },

      responsive: false,
      pageLength: 10,
      "paging": true
  });

});

$( "#APP" ).change(function() {
let app = $( "#APP" ).val();
$("#recargar").load("tablas.php?action=usoApp&valor="+app);

  // $.post("tablas.php",{valor:app, action:"usoApp"}, function(data)
  // {
  //
  //   $('#usoApp > tbody').html(data);
  //
  // });
});


</script>
<script type="text/JavaScript">

Highcharts.chart('container', {
  chart:{
    type: 'column',

  },
  title: {
    text: 'Aplicación por persona'
  },

  xAxis: {
    title: {
      text: 'Usuario'
    },
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
      text: 'Uso'
    }

  },

  series: [{
    name: 'Veces Usado'
    ,
    data:
    [<?php
            $resul = $catalogo->obtenerLista($Consulta);
            while ($row = mysqli_fetch_array($resul)) {

                                echo "['" . $row ["Nombre"] ."'," . $row ["Uso"]."],";

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
