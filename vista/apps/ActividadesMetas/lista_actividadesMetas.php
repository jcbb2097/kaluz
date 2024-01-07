<?php

//include_once ($_SERVER['DOCUMENT_ROOT'].'/sie/WEB-INF/Classes/Catalogo.class.php');
//$catalogo = new Catalogo();
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
session_start();
include_once ('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$MiTipoPerfil=1;//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiIdUsr=$_SESSION['user_session'];
$MiNomUsr="SinUsr";
if ((isset($_GET['tipoPerfil']) && $_GET['tipoPerfil'] != ""))          { $MiTipoPerfil=$_GET['tipoPerfil']; }
if ((isset($_GET['idUsuario']) && $_GET['idUsuario'] != ""))            { $MiIdUsr=     $_GET['idUsuario']; }
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != ""))    { $MiNomUsr=    $_GET['nombreUsuario']; }
$MiNomUsr=str_replace(" ", "%20", $MiNomUsr);
$MisParam="tipoPerfil=".$MiTipoPerfil."&idUsuario=".$MiIdUsr."&nombreUsuario=".$MiNomUsr; //Para pasar parametros a la siguiente liga

$where = "";
$where1 = "";
$where2 = "";
$cat="";
$ejecat="";
$scat = "";

if ((isset($_GET['categoria']) && $_GET['categoria'] != "")) {
    $cat = $_GET["categoria"];
} else {
    $cat = '';
}

if ((isset($_GET['scategoria']) && $_GET['scategoria'] != "")) {
    $scat = $_GET["scategoria"];
} else {
    $scat = '';
}

if ((isset($_GET['IdEje']) && $_GET['IdEje'] != "") && (isset($_GET['IdTipo']) && $_GET['IdTipo'] != "") && (isset($_GET['IdPeriodo']) && $_GET['IdPeriodo'] != "")) {
        $IdEje = $_GET['IdEje'];
        $IdTipo = $_GET['IdTipo'];
        $IdPeriodo = $_GET['IdPeriodo'];
        $ejecat=" AND idEje= ".$_GET['IdEje'];
        //$cat=$_GET['categoria'];
        //$scat = $_GET['scategoria'];
        $where ="WHERE cc.Periodo =".$IdPeriodo." AND cc.IdEje=".$IdEje." AND cc.IdTipoActividad=".$IdTipo;
}
else{
    if ((isset($_POST['IdPeriodo']) && $_POST['IdPeriodo'] != "")){
        $IdPeriodo = $_POST['IdPeriodo'];
        $where2 = "";
        $where1 = "";
        $where="WHERE cc.Periodo =".$IdPeriodo;
    }else{
        $IdPeriodo = "14";
        $where="WHERE cc.Periodo =14";
    }
    if ((isset($_POST['IdEje']) && $_POST['IdEje'] != "")){
        $IdEje = $_POST['IdEje'];
        $where2 = "";
        $where1 = "";
        $ejecat=" AND idEje= ".$IdEje;
        $where.=" AND cc.idEje =".$IdEje;
    }else{
        $IdEje = "";
    }
    if ((isset($_POST['cat']) && $_POST['cat'] != "")){
        $cat = $_POST['cat'];
        $where2 = "";
        $where1 =" AND cce.idCategoria=".$cat;
    }else{
        $cat = "";
    }

    if ((isset($_POST['scat']) && $_POST['scat'] != "")){
        $scat = $_POST['scat'];
        $where1 = "";
        $where2 =" AND cce.idCategoria =".$scat;
    }else{
        $scat = "";
    }

    if ((isset($_POST['Tipo']) && $_POST['Tipo'] != "")){
        $IdTipo = $_POST['Tipo'];
        $where.=" AND cc.IdTipoActividad =".$IdTipo;
    }else{
        $IdTipo = "";
    }
  //  echo "<br>IdPeriodo ".$IdPeriodo;
  //  echo "<br>IdEje ".$IdEje;
  //  echo "<br>IdTipo ".$IdTipo;
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
    <body id="bod">
        <div class="well well-sm">
            <a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1&idUsuario=<?php echo $MiIdUsr; ?>&nombreUsuario=<?php echo $MiNomUsr; ?>">Aplicaciones</a>
            <!--/ <a style="color:#fefefe;" href="filtro_ActividadesMetas.php?nombreUsuario=<?php //echo($_GET['nombreUsuario']); ?> ">Filtro actividades y metas</a>--> / 
            <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Actividades y Metas</a> /
            <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Lista de Actividades y Metas</a>
        </div>
        <div class="well2 wr">
            <?php
                        if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
                             $user = $_GET['nombreUsuario'];

                            //echo $user;
                            echo '<a style="color:#fefefe; cursor: pointer;" href="../Insumos/vista.php">Insumos</a> / ';
                            //echo '<a style="color:#fefefe; cursor: pointer;" href="../Categorias/vista.php">Categorías y subcategorías</a> / ';
                            echo '<a style="color:#fefefe;" href="javascript:window.location.reload(true)">Lista de Actividades y Metas</a> /';
                            echo '<a style="color:#fefefe; cursor: pointer;" href="alta_actividadesMetas.php?accion=guardar&usuario='.$user.'&IdEje='.$IdEje.'&IdTipo='.$IdTipo.'&IdPeriodo='.$IdPeriodo.'"'.'>Agregar +</a>';


                        }else{
                            $user="User_desconocido";

                            //echo $user;
                            echo '<a style="color:#fefefe; cursor: pointer;" href="../Insumos/vista.php">Insumos</a> / ';
                            //echo '<a style="color:#fefefe; cursor: pointer;" href="../Categorias/vista.php">Categorías y subcategorías</a> / ';
                            echo '<a style="color:#fefefe;" href="javascript:window.location.reload(true)">Lista de Actividades y Metas</a> /';
                            echo '<a style="color:#fefefe; cursor: pointer;" href="alta_actividadesMetas.php?accion=guardar&usuario='.$user.'&IdEje='.$IdEje.'&IdTipo='.$IdTipo.'&IdPeriodo='.$IdPeriodo.'"'.'>Agregar +</a>';
                        }

                    ?>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <?php
                        if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
                             $user = $_GET['nombreUsuario'];

                            //echo $user;
                            //echo '<a style="color:purple;" href="alta_actividadesMetas.php?accion=guardar&usuario='.$user.'&IdEje='.$IdEje.'&IdTipo='.$IdTipo.'&IdPeriodo='.$IdPeriodo.'"'.'>agregar +</a>';


                        }else{
                            $user="User_desconocido";

                            //echo $user;
                            //echo '<a style="color:purple;" href="alta_actividadesMetas.php?accion=guardar&usuario='.$user.'&IdEje='.$IdEje.'&IdTipo='.$IdTipo.'&IdPeriodo='.$IdPeriodo.'"'.'>agregar +</a>';
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
                <div class="form-group form-group-sm">
                   <!-- <label for="periodo" class="col-md-2 col-sm-2 col-xs-2 control-label">*Periodo</label>-->
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select class="form-control" id="periodo" name="periodo" onchange="Periodo(this.value);">
                            <option value="">Seleccione un Periodo</option>
                            <?php
                            $Year = date("Y");
                            $consultaPeriodo = "SELECT Id_Periodo,Periodo FROM `c_periodo` WHERE Vista=1 AND Periodo>2019 ORDER BY Periodo desc;";
                            $resultPeriodo= $catalogo->obtenerLista($consultaPeriodo);
                            while ($row =mysqli_fetch_array($resultPeriodo)){
                                $s="";
                                if($row['Id_Periodo']==$IdPeriodo){
                                    echo $s="selected";
                                }
                                echo "<option value='".$row['Id_Periodo']."' ".$s.">".$row['Periodo']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!--<label for="eje" class="col-md-1 col-sm-1 col-xs-1 control-label">*Eje</label>-->
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select class="form-control" id="eje" name="eje" onchange="Seje(this.value);/*ScategoriaE(this.value);*/">
                            <option value="">Seleccione un Eje</option>
                            <?php
                                $consultaEje= "SELECT idEje,CONCAT(orden,'. ',Nombre) AS Eje FROM `c_eje` WHERE estatus=1  ORDER BY orden;";
                                $resultEje = $catalogo->obtenerLista($consultaEje);
                                while ($row =mysqli_fetch_array($resultEje)){
                                $s="";
                                if($row['idEje']==$IdEje){
                                    echo $s="selected";
                                }
                                    echo "<option value='".$row['idEje']."'  ".$s.">".$row['Eje']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select class="form-control" id="categoria" name="categoria" onchange="Cate(this.value);">
                        <option value="">Seleccione una Categoría</option>
                        <?php
                            $consultaTipo = "SELECT IdCategoria, descCategoria FROM `c_categoriasdeejes` WHERE nivelCategoria =1 $ejecat ORDER BY descCategoria;";
                            $resultTipo = $catalogo->obtenerLista($consultaTipo);
                            while ($row =mysqli_fetch_array($resultTipo)){
                                $s="";
                                if($row['IdCategoria']==$cat){
                                    echo $s="selected";
                                }
                                echo "<option value='".$row['IdCategoria']."'  ".$s.">".$row['descCategoria']."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select class="form-control" id="scategoria" name="scategoria" onchange="Scate(this.value);">
                        <option value="">Seleccione una SubCategoría</option>
                        <?php
                            $consultaTipo = "SELECT IdCategoria, descCategoria FROM `c_categoriasdeejes` WHERE nivelCategoria =2 and idCategoriaPadre= '$cat' ORDER BY descCategoria;";
                            $resultTipo = $catalogo->obtenerLista($consultaTipo);
                            while ($row =mysqli_fetch_array($resultTipo)){
                                $s="";
                                if($row['IdCategoria']==$scat){
                                    echo $s="selected";
                                }
                                echo "<option value='".$row['IdCategoria']."'  ".$s.">".$row['descCategoria']."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <!--<label for="periodo" class="col-md-2 col-sm-2 col-xs-2 control-label">*Tipo</label>-->
                </div>
            </div><br>
            <div class="row">
                <div class="form-group form-group-sm">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select class="form-control" id="tipo" name="tipo" onchange="Tipo(this.value);">
                        <option value="">Seleccione un Tipo</option>
                        <?php
                            $consultaTipo = "SELECT IdTipo,Nombre FROM `c_tipoActividadMeta` WHERE Activo=1 ORDER BY Nombre;";
                            $resultTipo = $catalogo->obtenerLista($consultaTipo);
                            while ($row =mysqli_fetch_array($resultTipo)){
                                $s="";
                                if($row['IdTipo']==$IdTipo){
                                    echo $s="selected";
                                }
                                echo "<option value='".$row['IdTipo']."' ".$s.">".$row['Nombre']."</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>    
            </div><br>
            <div id="datos">  
                <div class="row" >
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="tAM" class="table table-striped table-bordered" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th></th>
                                        <th>Eje</th>
                                        <th>Categoría</th>
                                        <th>SubCategoría</th>
                                        <th>Actividad/Meta</th>
                                        <th>Responsable</th>
                                        <th>Área</th>
                                        <th>Nivel</th>
                                        <th>Entregable</th>                        
                                        <!--<th>Insumos</th>-->

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $consulta ="SELECT cc.IdActividad, IFNULL(kea.IdEntregable, 0) AS IdEntregable,
                                    cc.IdTipoActividad AS IdTipoActividad,
	                                IF(cc.Numeracion='', cc.Nombre , CONCAT( cc.Numeracion, cc.Nombre )) AS Actividad,
                                        cnc.Nombre AS Nivel,
                                        cnc.IdNivel,
                                        CONCAT(
                                            cet.Nombre,
                                            ' ',
                                            cet.Apellido_Paterno,
                                            ' ',
                                            cet.Apellido_Materno
                                        ) AS Responsable,
                                        ca.Nombre AS Area,
                                        GROUP_CONCAT(DISTINCT ce.Nombre) as entregables,
                                        GROUP_CONCAT(cei.Nombre) AS Insumos, cpe.Periodo,
                                        concat(cp.idEje, ' .', cp.Nombre ) as eje,
                                        cce.descCategoria,
                                        ccce.descCategoria as Padre
                                        FROM
                                            `c_actividad` AS cc
                                        INNER JOIN c_eje AS cp ON cp.idEje = cc.IdEje
                                        LEFT JOIN c_periodo as cpe on cpe.Id_Periodo = cc.Periodo
                                        LEFT JOIN c_categoriasdeejes as cce on cce.idCategoria = cc.Idcategoria
                                        LEFT JOIN c_categoriasdeejes as ccce on ccce.idCategoria = cce.IdcategoriaPadre
                                        LEFT JOIN c_actividad AS ccDos ON ccDos.IdActividad = cc.IdActividadSuperior
                                        LEFT JOIN c_actividad AS ccTres ON ccTres.IdActividad = ccDos.IdActividadSuperior
                                        LEFT JOIN c_actividad AS ccCuatro ON ccCuatro.IdActividad = ccTres.IdActividadSuperior
                                        LEFT JOIN c_nivelActividadMeta AS cnc ON cnc.IdNivel = cc.IdNivelActividad
                                        LEFT JOIN c_tipoActividadMeta AS ctc ON ctc.IdTipo = cc.IdTipoActividad
                                        LEFT JOIN c_personas AS cet ON cet.id_Personas = cc.IdResponsable
                                        LEFT JOIN c_area AS ca ON ca.Id_Area = cc.IdArea
                                        LEFT JOIN k_entregableActividad AS kea ON kea.IdActividad = cc.IdActividad
                                        LEFT JOIN c_entregable AS ce ON ce.IdEntregable = kea.IdEntregable
                                        LEFT JOIN k_entregableinsumo AS kei ON kei.IdEntregable = ce.IdEntregable
                                        LEFT JOIN c_entregable AS cei ON cei.IdEntregable = kei.IdInsumo ".$where.$where1.$where2." and cc.Nombre IS NOT NULL GROUP BY cc.IdActividad ORDER BY Actividad;";
                                    

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
                                        echo '<td>';
                                        echo '<a style="color:purple;cursor:pointer" onclick="eliminar('.$row['IdActividad'].','.$row['IdEntregable'].')">';
                                        echo '<span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;';
                                        echo '<a style="color:purple;cursor:pointer" onclick="modificar('.$row['IdActividad'].','.$ValUser.')"><span class="glyphicon glyphicon-pencil"></span></a></td>';
                                        echo '<td>' . $row['eje'] . '</td>';
                                        if ($row['Padre'] == "") {
                                            echo '<td>' . $row['descCategoria'] . '</td>';
                                            echo '<td>' . $row['Padre'] . '</td>';
                                        }else{
                                            echo '<td>' . $row['Padre'] . '</td>';
                                            echo '<td>' . $row['descCategoria'] . '</td>';
                                        }
                                        if ($row['IdTipoActividad'] == 1) {
                                        echo '<td>A- '. $row['Actividad'] . '</td>';
                                        } else if ($row['IdTipoActividad'] == 2){
                                        echo '<td>M- ' . $row['Actividad'] . '</td>';
                                        } else{
                                        echo '<td></td>';
                                        }
                                        //echo '<td>' . $row['Actividad'] . '</td>';
                                        echo '<td>' . $row['Responsable'] . '</td>';
                                        echo '<td>' . $row['Area'] . '</td>';
                                        echo '<td>' . $row['Nivel'] . '</td>';                              
                                        echo '<td>' . $row['entregables'] . '</td>';
                                        //echo '<td>' . $row['Insumos'] . '</td>';
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
