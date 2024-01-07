<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once __DIR__ . "/../../../source/dao/clases/LoggedinTime.php";
$catalogo = new Catalogo();
$where_ano = "";
$total_e=0;
$total_ep=0;
$total_epr=0;
$total_ef=0;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <title>::.SIE.::</title>
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table class="table table-striped table-bordered table-responsive" style="width:100%" id="myTable">
                    <thead>
                        <tr>
                            <th>Eje</th>
                            <th>Entregables</th>
                            <th>Preliminar</th>
                            <th>En proceso</th>
                            <th>Final</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $consulta = "SELECT e.idEje, CONCAT( e.orden, '.- ', e.Nombre ) Nombre,
                        (SELECT	COUNT( ka.id_archivo ) FROM k_archivoactividad ka LEFT JOIN c_documento d ON d.id_documento = ka.id_archivo WHERE
                        ka.id_proyecto = e.idEje AND d.id_tipo $where_ano in(9,10,14)) total,
                        (SELECT	COUNT( ka.id_archivo ) FROM k_archivoactividad ka LEFT JOIN c_documento d ON d.id_documento = ka.id_archivo WHERE
                        ka.id_proyecto = e.idEje AND d.id_tipo = 9 $where_ano ) total_pr,
                        (SELECT	COUNT( ka.id_archivo ) FROM k_archivoactividad ka LEFT JOIN c_documento d ON d.id_documento = ka.id_archivo WHERE
                        ka.id_proyecto = e.idEje AND d.id_tipo = 10 $where_ano) total_f,
                        (SELECT	COUNT( ka.id_archivo ) FROM k_archivoactividad ka LEFT JOIN c_documento d ON d.id_documento = ka.id_archivo WHERE
                        ka.id_proyecto = e.idEje AND d.id_tipo = 14 $where_ano) total_p
                        FROM c_eje e";
                        $resultConsulta = $catalogo->obtenerLista($consulta);
                        //echo$consulta;
                        while ($row = mysqli_fetch_array($resultConsulta)) {
                            $modal = "'" . $row['Nombre'] . "'";
                            echo '<tr>';
                            echo '<td><a onclick="muestraDetalle(' . $row['idEje'] . ',1);mostrarModal(' . $modal . ',0)">' . $row['Nombre'] . '</a></td>';
                            echo '<td><a style="color:black;" onclick="muestraDetalle(' . $row['idEje'] . ',1);mostrarModal(' . $modal . ',0)">' . $row['total'] . '</a></td>';
                            echo '<td><a style="color:#dfa739" onclick="muestraDetalle(' . $row['idEje'] . ',9);mostrarModal(' . $modal . ',1)">' . $row['total_pr'] . '</a></td>';
                            echo '<td><a style="color:#dbd909" onclick="muestraDetalle(' . $row['idEje'] . ',14);mostrarModal(' . $modal . ',2)">' . $row['total_p'] . '</a></td>';
                            echo '<td><a style="color:#33ab15" onclick="muestraDetalle(' . $row['idEje'] . ',10);mostrarModal(' . $modal . ',3)">' . $row['total_f'] . '</a></td>';
                            echo '</tr>';
                            $total_e = $total_e + $row['total'];
                            $total_ep = $total_ep + $row['total_p'];
                            $total_epr = $total_epr + $row['total_pr'];
                            $total_ef = $total_ef + $row['total_f'];   
                        }
                        ?>
                        <tr>
                            <th> Total:</th>
                            <th><?php echo$total_e;?></th>
                            <th><?php echo$total_epr;?></th>
                            <th><?php echo$total_ep;?></th>
                            <th><?php echo$total_ef;?></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div style="top: 33px;" class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content" style="left: -145px;width: 888px;">
                            <div class="modal-header h" style="padding: 7px 5px;">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    function muestraDetalle(id, tipo) {
        $(".h").css('background-color', "#4d4d57");
        $("#myModal").modal({
            backdrop: false
        });
        $.post("datos_eje.php", {
            id: id,
            tipo: tipo
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
        }else{
            sub='';
        }
        titulo = 'Entregables' + sub + ' del eje ' + nombre;
        $("#modalTitle").html(titulo);
        $("#myModal").modal("show");
    }
</script>

</html>