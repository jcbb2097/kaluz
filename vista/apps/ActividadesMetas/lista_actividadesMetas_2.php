<?php

//include_once ($_SERVER['DOCUMENT_ROOT'].'/sie/WEB-INF/Classes/Catalogo.class.php');
//$catalogo = new Catalogo();
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once ('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();

$where = "";
if ((isset($_GET['IdEje']) && $_GET['IdEje'] != "") && (isset($_GET['IdTipo']) && $_GET['IdTipo'] != "") && (isset($_GET['IdPeriodo']) && $_GET['IdPeriodo'] != "")) {
        $IdEje = $_GET['IdEje'];
        $IdTipo = $_GET['IdTipo'];
        $IdPeriodo = $_GET['IdPeriodo'];

        $where ="WHERE cc.Periodo =".$IdPeriodo." AND cc.IdEje=".$IdEje." AND cc.IdTipoActividad=".$IdTipo;
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
        <script src="../../../resources/js/aplicaciones/ActividadesMetas/alta_actividadesMetas.js"></script>

        <title>::.Actividdades y Metas.::</title>

    </head>
    <body>
        <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1">Aplicaciones</a>/ <a style="color:#fefefe;" href="filtro_ActividadesMetas.php?nombreUsuario=<?php echo($_GET['nombreUsuario']); ?> ">Filtro actividades y metas</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Actividades y Metas</a></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <?php
                        if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
                             $user = $_GET['nombreUsuario'];

                            //echo $user;
                            echo '<a style="color:purple;" href="alta_actividadesMetas.php?accion=guardar&usuario='.$user.'&IdEje='.$IdEje.'&IdTipo='.$IdTipo.'&IdPeriodo='.$IdPeriodo.'"'.'>agregar +</a>';


                        }else{
                            $user="User_desconocido";

                            //echo $user;
                            echo '<a style="color:purple;" href="alta_actividadesMetas.php?accion=guardar&usuario='.$user.'&IdEje='.$IdEje.'&IdTipo='.$IdTipo.'&IdPeriodo='.$IdPeriodo.'"'.'>agregar +</a>';
                        }

                    ?>
                    <input type="hidden" name="IdEje" id="IdEje" value="<?php echo($IdEje); ?>">
                    <input type="hidden" name="IdPeriodo" id="IdPeriodo" value="<?php echo($IdPeriodo); ?>">
                    <input type="hidden" name="IdTipo" id="IdTipo" value="<?php echo($IdTipo); ?>">
                </div>
                <div  class="col-md-4 col-sm-4 col-xs-12">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                   <table id="tAM" class="table table-striped table-bordered" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th></th>
                                <th>Actividad</th>
                                <th>Responsable</th>
                                <th>Area</th>
                                <th>Entregable</th>
                                <th>Insumos</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $consulta ="SELECT
                                        cc.IdActividad,CONCAT(cc.Numeracion,cc.Nombre) as actividad,
                                     	CONCAT(cet.Nombre,' ',cet.Apellido_Paterno,' ',cet.Apellido_Materno) AS Responsable,
                                    	ca.Nombre AS area,ce.Nombre AS entregable,ce.IdEntregable, GROUP_CONCAT('->',ins.Nombre,'<br>' SEPARATOR '') as insumo
                                    FROM c_actividad AS cc
                                    INNER JOIN c_eje AS cp ON cp.idEje = cc.IdEje
                                    LEFT JOIN c_personas AS cet ON cet.id_Personas = cc.IdResponsable
                                    LEFT JOIN c_area AS ca ON ca.Id_Area = cc.IdArea
                                    LEFT JOIN c_entregable AS ce ON  ce.idActividad = cc.IdActividad
                                    LEFT JOIN k_entregableinsumo AS kei ON kei.IdEntregable = ce.IdEntregable
                                    LEFT JOIN c_entregable AS ins ON  ins.IdEntregable = kei.IdInsumo  ".$where." GROUP BY cc.IdActividad ";
                            //echo $consulta;
                            if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
                                $ValUser = "'".$user."'";
                            }else{
                                $user="User_desconocido";
                                $ValUser = "'".$user."'";
                            }
                            $resultConsulta = $catalogo->obtenerLista($consulta);

                            while ($row = mysqli_fetch_array($resultConsulta)) {
                                echo '<tr>';
                                echo '<td><a style="color:purple;cursor:pointer" onclick="eliminar('.$row['IdActividad'].','.$row['IdEntregable'].')"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;<a style="color:purple;cursor:pointer" onclick="modificar('.$row['IdActividad'].','.$ValUser.')"><span class="glyphicon glyphicon-pencil"></span></a></td>';
                                echo '<td>' . $row['actividad'] . '</td>';
                                echo '<td>' . $row['Responsable'] . '</td>';
                                echo '<td>' . $row['area'] . '</td>';
                                echo '<td>' . $row['entregable'] . '</td>';
                                echo '<td>' . $row['insumo'] . '</td>';
                            }

                            ?>
                       </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
