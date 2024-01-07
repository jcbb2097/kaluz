<?php

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once ('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();


$user="";

if (isset($_GET['nombreUsuario']) && $_GET != "") {
	$user = $_GET['nombreUsuario'];
}else{
	$user = "User_desconocido";
}

?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

        <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css"/>
        <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css"/>

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
        <script src="../../../resources/js/aplicaciones/ActividadesMetas/filtro_actividadesMetas.js"></script>

        <style type="text/css">
            legend {
                font-family: 'Muli-SemiBold';
                font-size: 18px;
            }
            .panel-heading{
                background-color:#4d4d57;
                border: 1px solid #4d4d57;

            }
            .panel{
                border: 1px solid #4d4d57;
            }
            .panel-footer{
                background-color:#4d4d57;
                border: 1px solid #4d4d57;
            }
        </style>
        <title>::.Filtor actividades y metas.::</title>

    </head>
    <body>
        <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1">Aplicaciones</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Filtro actividades y metas</a></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">

                </div>
            </div>
            <br>
            <div class="row">
                <!--<div class="col-md-12 col-sm-12 col-xs-12">
                </div>-->
                <div class="col-md-4 col-sm-4 col-xs-12"></div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <!--<div class="container-fluid">-->
                        <div class="panel">
                            <div class="panel-heading"><br></div>
                                <div class="panel-body">
                                <fieldset>
                                <legend>Filtro actividades y metas</legend>
                                    <form class="form-horizontal" id="formFiltroAM">
                                        <div class="row">
                                            <div class="form-group form-group-sm">
                                                <label for="eje" class="col-md-2 col-sm-2 col-xs-2 control-label">*Eje</label>
                                                <div class="col-md-8 col-sm-8 col-xs-8">
                                                    <select class="form-control" id="eje" name="eje">
                                                        <option value="">Seleccione un eje</option>
                                                    <?php
                                                    $consultaEje= "SELECT idEje,CONCAT(orden,'. ',Nombre) AS Eje FROM `c_eje` WHERE estatus=1 ORDER BY orden;";

                                                        $resultEje = $catalogo->obtenerLista($consultaEje);


                                                        while ($row =mysqli_fetch_array($resultEje)){

                                                          echo "<option value='".$row['idEje']."'>".$row['Eje']."</option>";
                                                        }
                                                    ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group form-group-sm">
                                                <label for="periodo" class="col-md-2 col-sm-2 col-xs-2 control-label">*Tipo</label>
                                                <div class="col-md-8 col-sm-8 col-xs-8">
                                                    <select class="form-control" id="tipo" name="tipo">
                                                        <option value="">Seleccione un tipo</option>
                                                        <?php
                                                            $consultaTipo = "SELECT IdTipo,Nombre FROM `c_tipoActividadMeta` WHERE Activo=1 ORDER BY Nombre;";
                                                            $resultTipo = $catalogo->obtenerLista($consultaTipo);


                                                            while ($row =mysqli_fetch_array($resultTipo)){

                                                              echo "<option value='".$row['IdTipo']."'>".$row['Nombre']."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                           </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group form-group-sm">
                                                <label for="periodo" class="col-md-2 col-sm-2 col-xs-2 control-label">*Periodo</label>
                                                <div class="col-md-8 col-sm-8 col-xs-8">
                                                    <select class="form-control" id="periodo" name="periodo">
                                                        <option value="">Seleccione un periodo</option>
                                                        <?php
                                                         $Year = date("Y");
                                                        $consultaPeriodo = "SELECT Id_Periodo,Periodo FROM `c_periodo` WHERE Vista=1 ORDER BY Periodo desc;";
                                                        $resultPeriodo= $catalogo->obtenerLista($consultaPeriodo);
                                                            while ($row =mysqli_fetch_array($resultPeriodo)){
                                                                $s="";
                                                                if($row['Periodo']==$Year){
                                                                    echo $s="selected";
                                                                }
                                                              echo "<option value='".$row['Id_Periodo']."' ".$s.">".$row['Periodo']."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                           </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group form-group-sm">
                                                <label for="periodo" class="col-md-2 col-sm-2 col-xs-2 control-label"></label>
                                                <div class="col-md-8 col-sm-8 col-xs-8">
                                                    <button type="button" class="btn btn-default btn-xs" id="enviar">Filtrar</button>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="usuario" id="usuario" value="<?php echo($user);?>">
                                    </form>
                                </div>
                                </fieldset>
                            <div class="panel-footer"><br></div>
                        </div>
                    <!--</div>-->
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">

                </div>
            </div>
            <br>
        </div>
    </body>
</html>
