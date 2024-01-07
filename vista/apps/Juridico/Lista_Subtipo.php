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
    <script src="../../../resources/js/aplicaciones/Juridico/Alta_subtipo.js"></script>

    <title>::.Jurídico.::</title>
</head>
<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1">Aplicaciones</a> / <a style="color:#fefefe;" href="Lista_juridico.php">Jurídico</a> / <a style="color:#fefefe;" href="">Catálogos</a> / <a style="color:#fefefe;" href="">Subtipo</a></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <?php
                if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
                    $user = $_GET['nombreUsuario'];

                    //echo $user;
                    echo '<a style="color:purple;" href="Alta_subtipo.php?accion=guardar&usuario=' . $user . '"' . '>agregar +</a>';
                } else {
                    $user = "User_desconocido";

                    //echo $user;
                    echo '<a style="color:purple;" href="Alta_subtipo.php?accion=guardar&usuario=' . $user . '"' . '>agregar +</a>';
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
                            <th>Subtipo instrumento jurídico</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $consulta = "SELECT j.idInstrumento,j.nombre FROM c_instrumentoJuridico as j where j.tipo=2 ORDER BY j.nombre";
                        $resultConsulta = $catalogo->obtenerLista($consulta);

                        while ($row = mysqli_fetch_array($resultConsulta)) {

                            echo '<tr>';
                            echo '<td><a style="color:purple;cursor:pointer" onclick="eliminar3(' . $row['idInstrumento'] . ')"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;
                            <a style="color:purple;cursor:pointer" onclick="modificar(' . $row['idInstrumento'].')"><span class="glyphicon glyphicon-pencil"></span></a>';
                            echo '<td>' . $row['nombre'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>