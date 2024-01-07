<?php
//include_once ($_SERVER['DOCUMENT_ROOT'].'/sie/WEB-INF/Classes/Catalogo.class.php');
//$catalogo = new Catalogo();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();

date_default_timezone_set('America/Mexico_City');
$Aplicacion="Check List";
$MiTipoPerfil=1;//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiIdUsr=$_SESSION['user_session'];
$MiNomUsr="SinUsr";
if ((isset($_GET['tipoPerfil'])      && $_GET['tipoPerfil'] != ""))          { $MiTipoPerfil=$_GET['tipoPerfil']; }
if ((isset($_GET['idUsuario'])       && $_GET['idUsuario'] != ""))           { $MiIdUsr=     $_GET['idUsuario']; }
if ((isset($_GET['nombreUsuario'])   && $_GET['nombreUsuario'] != ""))       { $MiNomUsr=    $_GET['nombreUsuario']; }
$MiNomUsr=str_replace(" ", "%20", $MiNomUsr);
$MisParam="tipoPerfil=".$MiTipoPerfil."&idUsuario=".$MiIdUsr."&nombreUsuario=".$MiNomUsr; //Para pasar parametros a la siguiente liga

$AnioActual=date("Y"); //Año actual para mostrar por default
$VarWhere= " ";

$FiltroAnio="";
if (isset($_GET['F_IdAnio']) && $_GET['F_IdAnio'] != "")
{
    if ($_GET['F_IdAnio']=="Sin información")
        { $FiltroAnio= " AND isnull(pe.Periodo) "; } //Para fechas nulas
    elseif ($_GET['F_IdAnio']=="Todos") //Para todos los años
        { $FiltroAnio= " =1 "; }
    else { $FiltroAnio= " AND pe.Periodo='".$_GET['F_IdAnio']."' "; }
}
else {$FiltroAnio= ""; }

/*$FiltroAnio=""; //Se inicializa la variable
if ((isset($_GET['F_IdAnio']) && $_GET['F_IdAnio'] != "")) //Si el parametro existe se procesa
{   if ($_GET['F_IdAnio']!="0") {$FiltroAnio =" AND pe.Periodo= ".$_GET['F_IdAnio'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $FiltroAnio="  AND isnull(pe.Periodo)"; } //Si el parametro es igual a 0 se buscan los NULOS
}*/

$FiltroEje=""; //Se inicializa la variable
if ((isset($_GET['F_IdEje']) && $_GET['F_IdEje'] != "")) //Si el parametro existe se procesa
{   if ($_GET['F_IdEje']!="0") {$FiltroEje =" AND ej.IdEje= ".$_GET['F_IdEje'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $FiltroEje="  AND isnull(ej.IdEje)"; } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroArea="";
if ((isset($_GET['F_IdArea']) && $_GET['F_IdArea'] != ""))
{   if ($_GET['F_IdArea']!="0") {$FiltroArea =" AND ar.Id_Area=".$_GET['F_IdArea'];}
    else {  $FiltroArea="  AND isnull(ar.Id_Area)"; }
}

$FiltroEntregables="";
if ((isset($_GET['F_DescEntregableEscpecifico']) && $_GET['F_DescEntregableEscpecifico'] != ""))
{   if ($_GET['F_DescEntregableEscpecifico']!="0") {$FiltroEntregables =" AND ee.Descripcion='".$_GET['F_DescEntregableEscpecifico']."'";}
    else {  $FiltroEntregables="  AND isnull(ee.Descripcion)"; }
}

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
    <script src="Alta_check.js"></script>
    <title>::.Check.::</title>
</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?<?php echo $MisParam; ?>">Aplicaciones</a> / <a style="color:#fefefe;" href="Lista_check.php?<?php echo $MisParam; ?>">CheckList</a> / 
    <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Lista Checklist</a></div>
    <div class="well2 wr">
            <a style="color:#fefefe; cursor: pointer;" href="vista.php?<?php echo $MisParam; ?>"> Indicadores</a> /
            <a style="color:#fefefe; cursor: pointer;" href="Lista_check.php?<?php echo $MisParam; ?>">Lista Checklist</a> /
            <a style="color:#fefefe; cursor: pointer;" href="Alta_check.php?accion=guardar&usuario='<?php echo $MiNomUsr; ?>'&<?php echo $MisParam; ?>"' . '>Agregar +</a>
        </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12"></div>
            <div class="col-md-4 col-sm-4 col-xs-12"></div>
        </div><br>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table id="tCheck" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                            <th></th>
                            <th>Eje</th>
                            <th>Actividad / Meta</th>
                            <th>Área</th>
                            <th>Periodo</th>
                            <th>Nombre Check</th>
                            <!--<th>Check</th>-->
                            <th>SubCheck</th>
                            <!--<th>Nivel </th>
                            <th>Padre </th>
                            <th>SubCheckList</th>-->
                    </thead>
                    <tbody>
                        <?php
                        /*$consulta = "SELECT c.IdCheckList, c.Nombre, c.Descripcion, c.Nivel,(SELECT Nombre FROM c_checkList AS c2 WHERE c.IdCheckListPadre=c2.IdCheckList) AS Padre from c_checkList AS c order BY c.IdCheckList ASC";*/
$consulta = "SELECT if (ISNULL(concat(ej.orden, ' ',ej.Nombre)),'Sin información', concat(ej.orden, ' ',ej.Nombre)) AS DescEje,if (ISNULL(ar.Nombre),'Sin información',ar.Nombre) AS DescArea,if (ISNULL(pe.Periodo),'Sin información', pe.Periodo) AS Anio,che.IdCheckList, che.Nombre, che.Descripcion, che.Nivel,(SELECT Nombre FROM c_checkList AS c2 WHERE che.IdCheckListPadre=c2.IdCheckList) AS Padre,
CONCAT( a.Numeracion, a.Nombre) AS nombreglobal,
 a.IdTipoActividad AS IdTipoActividad  
                            FROM c_checkList che
                            JOIN k_checklist_actividad eche ON eche.IdCheckList=che.IdCheckList
                            LEFT JOIN c_actividad a ON a.IdActividad=eche.IdActividad
                            LEFT JOIN c_eje ej ON ej.idEje=a.IdEje
                            LEFT JOIN c_area ar ON ar.Id_Area=a.IdArea
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.Periodo
                            where 1 $FiltroAnio $FiltroEje $FiltroArea
                            AND che.Nivel=1
                            GROUP BY che.IdCheckList
                            order BY che.IdCheckList ASC";

                        $resultConsulta = $catalogo->obtenerLista($consulta);
                        while ($row = mysqli_fetch_array($resultConsulta)) {
                            echo '<tr>';
                            echo '<td><a style="color:black;cursor:pointer" onclick="eliminar('.$row['IdCheckList'].')"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;<a style="color:black;cursor:pointer" onclick="modificar('.$row['IdCheckList'].')"><span class="glyphicon glyphicon-pencil"></span></a></td>';
                        ?>
                            <td><?php echo $row['DescEje']; ?></td>
                            <?php
                            if ($row['IdTipoActividad'] == 1) {
                                if($row['nombreglobal'] != ""){
                                echo '<td>A- '. $row['nombreglobal'] . '</td>';
                                }else{
                                echo '<td>A- '. $row['nombreglobal'] . '</td>';
                                }
                            } else if ($row['IdTipoActividad'] == 2) {
                                if($row['nombreglobal'] != ""){
                                echo '<td>M- '. $row['nombreglobal'] . '</td>';
                                }else{
                                echo '<td>M- '. $row['nombreglobal'] . '</td>';
                                }
                            } else {
                            echo '<td></td>';
                            }
                            ?>
                            <!--<td><?php //echo $row['NombreActividad']; ?></td>-->
                            <td><?php echo $row['DescArea']; ?></td>
                            <td><?php echo $row['Anio']; ?></td>
                            <td><?php echo $row['Nombre']; ?></td>
                            <!--<td><?php echo $row['Descripcion']; ?></td>
                            <td><?php echo $row['Nivel']; ?></td>
                            <td><?php echo $row['Padre']; ?></td>-->
                            <td>
                            <?php 
                            $consultasubcheck = "SELECT IdCheckList, Nombre FROM c_checkList WHERE IdCheckListPadre=".$row['IdCheckList'];
                            $resultsubcheck = $catalogo->obtenerLista($consultasubcheck);
                            while ($row2 = mysqli_fetch_array($resultsubcheck)) {
                                echo "<br>".$row2["Nombre"].'<a style="color:black;cursor:pointer" onclick="subeliminar('.$row2['IdCheckList'].')"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;<a style="color:black;cursor:pointer" onclick="modificar('.$row2['IdCheckList'].')"><span class="glyphicon glyphicon-pencil"></span></a>';
                            }
                            ?>
                            </td>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
                <br>


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
