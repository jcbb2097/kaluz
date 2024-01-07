<?php

include_once('../../../WEB-INF/Classes/Catalogo.class.php');

$catalogo = new Catalogo();
$totalPerfil = 0;
?>
<!DOCTYPE html>
<html lang="es">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css">
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/highcharts-3d.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>

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
                <table class="table table-striped table-bordered table-responsive" style="width:100%" id="userPerfil">
                <thead>
                        <tr>
                            <th>Perfil</th>
                            <th>Usuarios</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                            $Perfil = "SELECT U.IdPerfil AS ID, CONCAT(U.IdPerfil,'.-',P.descripcion) AS Perfil, COUNT(U.IdPerfil) AS Usuarios, PE.Nombre AS Nombre
                            FROM c_perfil P INNER JOIN c_usuario U ON P.IdPerfil=U.idPerfil 
									          INNER JOIN c_personas PE ON U.IdPersona=PE.id_Personas WHERE U.Activo=1
                            GROUP BY P.descripcion, U.IdPerfil ORDER BY U.IdPerfil";
                            $resul = $catalogo->obtenerLista($Perfil);
                            while ($row = mysqli_fetch_array($resul)) {
                              $modal = "'" . $row['Nombre'] . "'";

                                echo '<tr>';
                                echo "<p>";
                                echo '<td> ' . $row ["Perfil"] .'</td>';  
                                echo '<td style="text-align:center; vertical-align:middle"><a style="color:blue;" onclick="muestraDetalle(' . $row['ID'] . ',1);mostrarModal(' . $modal . ',0)">' . $row['Usuarios'] . '</a></td>';
                                echo "</p>";
                                echo "</p>";
                                echo '</tr>';

                                $totalPerfil = $totalPerfil + $row['Usuarios'];
                            }
                            ?>
                    </tbody>  
                    <tfoot>
                        <tr>
                            <th> Total:</th>
                            <th style="text-align:center;"><?php echo $totalPerfil; ?></th>
                        </tr>
                    </tfoot>  
                </table>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
              <figure class="highcharts-figure">
                <div id="container" style="width:220%; height:100%;"></div>
              </figure>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <input type="hidden" id="periodo" name="opcion" />
                <div style="top: 33px;" class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content" style="left: -145px;width: 888px;">
                            <div class="modal-header h" style="padding: 7px 5px;">
                                <button type="button" class="close" data-dismiss="modal" style=" color: rgb(255, 255, 255);">&times;</button>
                                <div class="modal-title" style=" color: rgb(255, 255, 255); font-size: 11px;text-align: center;" id="modalTitle">Detalle</div>
                            </div>
                            <div class="modal-body detalle" style="padding: 31px 5px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
                
    <script>

function muestraDetalle(id) {
   
    $(".h").css('background-color', "#4d4d57");
    $("#myModal").modal({
        backdrop: false
    });
    $.post("datosPerfil.php", {
        id: id,
    }, function(data) {
        $(".detalle").html('');
        $(".detalle").html(data);
    });
}

function mostrarModal(nombre) {
    var titulo;
    titulo = 'Usuarios';
    $("#modalTitle").html(titulo);
    $("#myModal").modal("show");
}

$(document).ready(function() {

// DataTable
var table = $('#userPerfil').DataTable();
table.destroy();
table = $('#userPerfil').DataTable({
order:[],
"language": {
    "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
},

"scrollX": false,
responsive: false,
pageLength: 100,

"scrollCollapse": false,
"paging": false
});

});


</script>

</body>
<script type="text/JavaScript">

Highcharts.chart('container', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'USUARIOS POR PERFIL'
  },
  
  xAxis: {
    type: 'category',
    labels: {
      rotation: -45,
      style: {
        fontSize: '13px',
        fontFamily: 'Verdana, sans-serif'
      }
    }
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Número de usuarios por perfil'
    }
    
  },

  series: [{
    name: 'Usuarios',
    data: 
    [<?php 
            $resul = $catalogo->obtenerLista($Perfil);
            while ($row = mysqli_fetch_array($resul)) { 
                                
                                echo "['" . $row ["Perfil"] ."'," . $row ["Usuarios"]."],";
                            
                            }  ?>]
    ,
    dataLabels: {
      enabled: true,
      rotation: 0,
      color: '#FFFFFF',
      align: 'right',
      y: 10, // 10 pixels down from the top
      style: {
        fontSize: '13px',
        fontFamily: 'Verdana, sans-serif'
      }
    }
  }]
});


</script>
</html>