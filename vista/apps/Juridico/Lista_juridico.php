<?php

//include_once ($_SERVER['DOCUMENT_ROOT'].'/sie/WEB-INF/Classes/Catalogo.class.php');
//$catalogo = new Catalogo();
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();


?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link href="../../../resources/css/bootstrap-select.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="../../../resources/js/bootstrap-select.js"></script>

    <script src="../../../resources/js/sweetAlert.js"></script>
    <script src="../../../resources/js/bootstrap/bootstrapValidator.js"></script>
    <script src="../../../resources/js/aplicaciones/Juridico/Alta_juridico.js"></script>

    <title>::.Jurídico.::</title>
</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1">Aplicaciones</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Jurídico</a></div>
    <?php
    if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
        $user = $_GET['nombreUsuario'];
        echo '<div class="well2 wr">';
        echo '<a style="color:#fefefe; cursor: pointer;" href="javascript:window.location.reload(true)">Catálogos</a> / ';
        echo '<a style="color:#fefefe; cursor: pointer;" href="Lista_Instrumento.php?usuario=' . $user . '">Tipo Instrumento</a> / ';
        echo ' <a style="color:#fefefe; cursor: pointer;" href="Lista_Subtipo.php?usuario=' . $user . '">Subtipo</a>';
        echo '</div>';
    } else {
        $user = "User_desconocido";
        echo '<div class="well2 wr">';
        echo '<a style="color:#fefefe; cursor: pointer;" href="javascript:window.location.reload(true)">Catalogos</a> / ';
        echo '<a style="color:#fefefe; cursor: pointer;" href="Lista_Instrumento.php?usuario=' . $user . '">Tipo Instrumento</a> / ';
        echo ' <a style="color:#fefefe; cursor: pointer;" href="Lista_Subtipo.php?usuario=' . $user . '">Subtipo</a>';
        
        echo '</div>';
    }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <?php
                if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
                    $user = $_GET['nombreUsuario'];

                    //echo $user;
                    echo '<a style="color:purple;" href="Alta_juridico.php?accion=guardar&usuario=' . $user . '"' . '>agregar +</a> / <a style="color:purple; cursor: pointer;" href="index.php?usuario=' . $user . '">Indicador</a>';
                } else {
                    $user = "User_desconocido";

                    //echo $user;
                    echo '<a style="color:purple;" href="Alta_juridico.php?accion=guardar&usuario=' . $user . '"' . '>agregar +</a> / <a style="color:purple; cursor: pointer;" href="index.php?usuario=' . $user . '">Indicador</a>';
                }
                ?>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <table id="tJuridico" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Año</th>
                            <th>Exposición</th>
                            <th>Contraparte</th>
                            <th>Instrumento jurídico</th>
                            <th>Tipo de contrato</th>
                            <th>Nacional/Internacinal</th>
                            <th>Objeto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $consulta = "SELECT Id_juridico,p.Periodo,e.tituloFinal,ja.nombre AS instrumento,jb.nombre AS subtipo, j.Tipo_contrato,j.Objeto, j.Fee_pago, j.Pago_seguro,j.Comite_transporte,j.Fecha_pago_contraparte,j.Num_obra,j.Borrador,Contraparte_gestor FROM c_juridico j INNER JOIN c_instrumentoJuridico ja ON ja.idInstrumento = j.Id_Instrumento INNER JOIN c_instrumentoJuridico jb ON jb.idInstrumento = j.Id_subtipo INNER JOIN c_periodo p ON p.Id_Periodo = j.Id_periodo LEFT JOIN c_exposicionTemporal e on e.idExposicion=j.Id_Exposicion";
                        //echo $consulta;
                        if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
                            $ValUser = "'" . $user . "'";
                        } else {
                            $user = "User_desconocido";
                            $ValUser = "'" . $user . "'";
                        }
                        $resultConsulta = $catalogo->obtenerLista($consulta);

                        while ($row = mysqli_fetch_array($resultConsulta)) {

                            echo '<tr>';
                            echo '<td><a style="color:purple;cursor:pointer" onclick="eliminar(' . $row['Id_juridico'] . ')"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;
                            <a style="color:purple;cursor:pointer" onclick="modificar(' . $row['Id_juridico'] . ',' . $ValUser . ')"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;
                            <a style="color:purple;cursor:pointer"  onclick="loadDynamicContentModal(' . $row['Id_juridico'] . ')" ><span class="glyphicon glyphicon-plus-sign"></span></a></td>';

                            echo '<td>' . $row['Periodo'] . '</td>';
                            echo '<td>' . $row['tituloFinal'] . '</td>';
                            echo '<td>' . $row['Contraparte_gestor'] . '</td>';
                            echo '<td>' . $row['instrumento'] . '</td>';
                            echo '<td>' . $row['subtipo'] . '</td>';
                            if ($row['Tipo_contrato'] == 1) {
                                echo '<td>Nacional</td>';
                            } else {
                                echo '<td>Internacional</td>';
                            }

                            echo '<td>' . $row['Objeto'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <div class="modal fade" id="bootstrap-modal" role="dialog">
        <div class="modal-dialog" role="document" style="width: 800">
            <!-- Modal contenido-->
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                    <div id="conte-modal"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


</body>

</html>