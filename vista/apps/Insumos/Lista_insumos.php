<?php
//include_once ($_SERVER['DOCUMENT_ROOT'].'/sie/WEB-INF/Classes/Catalogo.class.php');
//$catalogo = new Catalogo();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();

$Aplicacion="Insumos";
$MiTipoPerfil=1;//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiIdUsr= $_SESSION['user_session'];
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
        { $FiltroAnio= " AND isnull(kcei.Anio) "; } //Para fechas nulas
    elseif ($_GET['F_IdAnio']=="Todos") //Para todos los años
        { $FiltroAnio= " =1 "; }
    else { $FiltroAnio= " AND kcei.Anio='".$_GET['F_IdAnio']."' "; }
}
else {$FiltroAnio= ""; }

$FiltroCheck=""; //Se inicializa la variable
if ((isset($_GET['F_IdCheck']) && $_GET['F_IdCheck'] != "")) //Si el parametro existe se procesa
{   if ($_GET['F_IdCheck']!="0") {$FiltroCheck =" AND kcei.idChecklistEntregable= ".$_GET['F_IdCheck'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $FiltroCheck="  AND isnull(kcei.idChecklistEntregable)"; } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroAct="";
if ((isset($_GET['F_IdAct']) && $_GET['F_IdAct'] != ""))
{   if ($_GET['F_IdAct']!="0") {$FiltroAct =" AND kcei.idActividadEntregable=".$_GET['F_IdAct'];}
    else {  $FiltroAct="  AND isnull(kcei.idActividadEntregable)"; }
}

$FiltroEje=""; //Se inicializa la variable
if ((isset($_GET['F_IdEje']) && $_GET['F_IdEje'] != "")) //Si el parametro existe se procesa
{   if ($_GET['F_IdEje']!="0") {$FiltroEje =" AND a1.IdEje= ".$_GET['F_IdEje'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $FiltroEje="  AND isnull(a1.IdEje)"; } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroArea="";
if ((isset($_GET['F_IdArea']) && $_GET['F_IdArea'] != ""))
{   if ($_GET['F_IdArea']!="0") {$FiltroArea =" AND a1.IdArea=".$_GET['F_IdArea'];}
    else {  $FiltroArea="  AND isnull(a1.IdArea)"; }
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
    <script src="Alta_insumo.js"></script>
    <title>::.Insumos.::</title>
</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?<?php echo $MisParam; ?>">Aplicaciones</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Insumos</a>
        / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Lista Insumos</a></div>
    <div class="well2 wr">
            <a style="color:#fefefe; cursor: pointer;" href="../ActividadesMetas/lista_actividadesMetas.php?<?php echo $MisParam?>"> Actividades y Metas</a> /
            <!--<a style="color:#fefefe; cursor: pointer;" href="../check/vista.php?<?php echo $MisParam?>"> Checklist</a> /-->
            <a style="color:#fefefe; cursor: pointer;" href="vista.php?<?php echo $MisParam; ?>"> Indicadores</a> /
            <a style="color:#fefefe; cursor: pointer;" href="Lista_insumos.php?<?php echo $MisParam; ?>">Lista Insumos</a> /
            <a style="color:#fefefe; cursor: pointer;" href="Alta_insumo.php?accion=guardar&usuario='<?php echo $MiNomUsr; ?>'&<?php echo $MisParam; ?>"' . '>Agregar +</a>
        </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12"></div>
            <div class="col-md-4 col-sm-4 col-xs-12"></div>
        </div><br>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table id="tInsumo" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                            <th></th>
                            <th>Check Insumo</th>
                            <th>Actividad Insumo</th>
                            <th>Nombre Insumo</th>
                            <th>Fecha insumo requerido</th>
                            <th>Check Entregable</th>
                            <th>Actividad Entregable</th>
                            <th>Nombre Entregable</th>
                            <th>Año</th>
                    </thead>
                    <tbody>
                        <?php
                        $consulta ="SELECT kcei.idChecklistInsumoUsado,kcei.idActividadInsumoUsado,kcei.idChecklistEntregable,kcei.idActividadEntregable,kcei.Anio,kcei.FechaInsumoRequerido,
                        CONCAT(che.Nombre,' <b>(',concat(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno),') [',ar.Nombre,']</b>') AS CheckInsumo,CONCAT(a.Numeracion,' ',a.Nombre) AS ActividadInsumo,
                        concat(che1.Nombre,' <b>(',CONCAT(p1.Nombre,' ',p1.Apellido_Paterno,' ',p1.Apellido_Materno),') [',ar1.Nombre,']</b>') AS CheckEntregable,CONCAT(a1.Numeracion,' ',a1.Nombre) AS ActividadEntregable,
                        chea.Entregable AS EntregableInsumo,chea1.Entregable AS Entregable
                        FROM k_checkListEntregableInsumo kcei
                        LEFT JOIN k_checklist_actividad chea ON chea.IdCheckList=kcei.idChecklistInsumoUsado
                        LEFT JOIN k_checklist_actividad chea1 ON chea1.IdCheckList=kcei.idChecklistEntregable
                        LEFT JOIN c_checkList che ON che.IdCheckList=chea.IdCheckList
                        LEFT JOIN c_checkList che1 ON che1.IdCheckList=chea1.IdCheckList
                        LEFT JOIN c_actividad a ON a.IdActividad=kcei.idActividadInsumoUsado
                        LEFT JOIN c_actividad a1 ON a1.IdActividad=kcei.idActividadEntregable
                        LEFT JOIN c_personas p ON p.id_Personas=che.IdResponsable
                        LEFT JOIN c_personas p1 ON p1.id_Personas=a.IdResponsable
                        LEFT JOIN c_area ar ON ar.Id_Area=p.IdArea
                        LEFT JOIN c_area ar1 ON ar1.Id_Area=a1.IdArea
                        WHERE 1 $FiltroCheck $FiltroAct $FiltroAnio $FiltroEje $FiltroArea
                        GROUP BY kcei.idActividadEntregable
                        ORDER BY kcei.FechaInsumoRequerido desc";
                        //echo $consulta;
                        $resultConsulta = $catalogo->obtenerLista($consulta);
                        while ($row = mysqli_fetch_array($resultConsulta)) {

                            echo '<tr>';
                            echo '<td></td>';
                            echo '<td>';
                            $consulta2 ="SELECT kcei.idChecklistInsumoUsado,kcei.idActividadInsumoUsado,kcei.idChecklistEntregable,kcei.idActividadEntregable,kcei.Anio,kcei.FechaInsumoRequerido,
                        CONCAT(che.Nombre,' <b>(',concat(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno),') [',ar.Nombre,']</b>') AS CheckInsumo,CONCAT(a.Numeracion,' ',a.Nombre) AS ActividadInsumo,
                        concat(che1.Nombre,' <b>(',CONCAT(p1.Nombre,' ',p1.Apellido_Paterno,' ',p1.Apellido_Materno),') [',ar1.Nombre,']</b>') AS CheckEntregable,CONCAT(a1.Numeracion,' ',a1.Nombre) AS ActividadEntregable,
                        chea.Entregable AS EntregableInsumo,chea1.Entregable AS Entregable
                        FROM k_checkListEntregableInsumo kcei
                        LEFT JOIN k_checklist_actividad chea ON chea.IdCheckList=kcei.idChecklistInsumoUsado
                        LEFT JOIN k_checklist_actividad chea1 ON chea1.IdCheckList=kcei.idChecklistEntregable
                        LEFT JOIN c_checkList che ON che.IdCheckList=chea.IdCheckList
                        LEFT JOIN c_checkList che1 ON che1.IdCheckList=chea1.IdCheckList
                        LEFT JOIN c_actividad a ON a.IdActividad=kcei.idActividadInsumoUsado
                        LEFT JOIN c_actividad a1 ON a1.IdActividad=kcei.idActividadEntregable
                        LEFT JOIN c_personas p ON p.id_Personas=che.IdResponsable
                        LEFT JOIN c_personas p1 ON p1.id_Personas=a.IdResponsable
                        LEFT JOIN c_area ar ON ar.Id_Area=p.IdArea
                        LEFT JOIN c_area ar1 ON ar1.Id_Area=a1.IdArea
                        where kcei.idChecklistEntregable=".$row['idChecklistEntregable']. " and kcei.idActividadEntregable=".$row['idActividadEntregable'];
                        //echo $consulta2;
                        $resultConsulta2 = $catalogo->obtenerLista($consulta2);
                        while ($row2 = mysqli_fetch_array($resultConsulta2)) {
                            echo '<br><a style="color:black;cursor:pointer" onclick="eliminar('.$row2['idChecklistEntregable'].','.$row2['idActividadEntregable'].','.$row2['idChecklistInsumoUsado'].','.$row2['idActividadInsumoUsado'].')"><span class="glyphicon glyphicon-trash"></span></a> '.$row2["CheckInsumo"];
                        }
                            echo '</td>';
                        ?>
                        <?php
                        
                        echo '<td>';
                        $consulta3 ="SELECT kcei.idChecklistInsumoUsado,kcei.idActividadInsumoUsado,kcei.idChecklistEntregable,kcei.idActividadEntregable,kcei.Anio,kcei.FechaInsumoRequerido,
                        CONCAT(che.Nombre,' <b>(',concat(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno),') [',ar.Nombre,']</b>') AS CheckInsumo,CONCAT(a.Numeracion,' ',a.Nombre) AS ActividadInsumo,
                        concat(che1.Nombre,' <b>(',CONCAT(p1.Nombre,' ',p1.Apellido_Paterno,' ',p1.Apellido_Materno),') [',ar1.Nombre,']</b>') AS CheckEntregable,CONCAT(a1.Numeracion,' ',a1.Nombre) AS ActividadEntregable,
                        chea.Entregable AS EntregableInsumo,chea1.Entregable AS Entregable
                        FROM k_checkListEntregableInsumo kcei
                        LEFT JOIN k_checklist_actividad chea ON chea.IdCheckList=kcei.idChecklistInsumoUsado
                        LEFT JOIN k_checklist_actividad chea1 ON chea1.IdCheckList=kcei.idChecklistEntregable
                        LEFT JOIN c_checkList che ON che.IdCheckList=chea.IdCheckList
                        LEFT JOIN c_checkList che1 ON che1.IdCheckList=chea1.IdCheckList
                        LEFT JOIN c_actividad a ON a.IdActividad=kcei.idActividadInsumoUsado
                        LEFT JOIN c_actividad a1 ON a1.IdActividad=kcei.idActividadEntregable
                        LEFT JOIN c_personas p ON p.id_Personas=che.IdResponsable
                        LEFT JOIN c_personas p1 ON p1.id_Personas=a.IdResponsable
                        LEFT JOIN c_area ar ON ar.Id_Area=p.IdArea
                        LEFT JOIN c_area ar1 ON ar1.Id_Area=a1.IdArea
                        where kcei.idChecklistEntregable=".$row['idChecklistEntregable']. " and kcei.idActividadEntregable=".$row['idActividadEntregable'];
                        $resultConsulta3 = $catalogo->obtenerLista($consulta3);
                        while ($row3 = mysqli_fetch_array($resultConsulta3)) {
                            echo "<br>".$row3["ActividadInsumo"];
                            }
                            echo '</td>';
                        ?>
                        <?php
                        echo '<td>';
                        $consulta4 ="SELECT kcei.idChecklistInsumoUsado,kcei.idActividadInsumoUsado,kcei.idChecklistEntregable,kcei.idActividadEntregable,kcei.Anio,kcei.FechaInsumoRequerido,
                        CONCAT(che.Nombre,' <b>(',concat(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno),') [',ar.Nombre,']</b>') AS CheckInsumo,CONCAT(a.Numeracion,' ',a.Nombre) AS ActividadInsumo,
                        concat(che1.Nombre,' <b>(',CONCAT(p1.Nombre,' ',p1.Apellido_Paterno,' ',p1.Apellido_Materno),') [',ar1.Nombre,']</b>') AS CheckEntregable,CONCAT(a1.Numeracion,' ',a1.Nombre) AS ActividadEntregable,
                        chea.Entregable AS EntregableInsumo,chea1.Entregable AS Entregable
                        FROM k_checkListEntregableInsumo kcei
                        LEFT JOIN k_checklist_actividad chea ON chea.IdCheckList=kcei.idChecklistInsumoUsado
                        LEFT JOIN k_checklist_actividad chea1 ON chea1.IdCheckList=kcei.idChecklistEntregable
                        LEFT JOIN c_checkList che ON che.IdCheckList=chea.IdCheckList
                        LEFT JOIN c_checkList che1 ON che1.IdCheckList=chea1.IdCheckList
                        LEFT JOIN c_actividad a ON a.IdActividad=kcei.idActividadInsumoUsado
                        LEFT JOIN c_actividad a1 ON a1.IdActividad=kcei.idActividadEntregable
                        LEFT JOIN c_personas p ON p.id_Personas=che.IdResponsable
                        LEFT JOIN c_personas p1 ON p1.id_Personas=a.IdResponsable
                        LEFT JOIN c_area ar ON ar.Id_Area=p.IdArea
                        LEFT JOIN c_area ar1 ON ar1.Id_Area=a1.IdArea
                        where kcei.idChecklistEntregable=".$row['idChecklistEntregable']. " and kcei.idActividadEntregable=".$row['idActividadEntregable'];
                        $resultConsulta4 = $catalogo->obtenerLista($consulta4);
                        while ($row4 = mysqli_fetch_array($resultConsulta4)) {
                            echo "<br>".$row4["EntregableInsumo"];
                            }
                            echo '</td>';
                        ?>
                        <?php
                        echo '<td>';
                        $consulta6 ="SELECT kcei.idChecklistInsumoUsado,kcei.idActividadInsumoUsado,kcei.idChecklistEntregable,kcei.idActividadEntregable,kcei.Anio,kcei.FechaInsumoRequerido,
                        CONCAT(che.Nombre,' <b>(',concat(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno),') [',ar.Nombre,']</b>') AS CheckInsumo,CONCAT(a.Numeracion,' ',a.Nombre) AS ActividadInsumo,
                        concat(che1.Nombre,' <b>(',CONCAT(p1.Nombre,' ',p1.Apellido_Paterno,' ',p1.Apellido_Materno),') [',ar1.Nombre,']</b>') AS CheckEntregable,CONCAT(a1.Numeracion,' ',a1.Nombre) AS ActividadEntregable,
                        chea.Entregable AS EntregableInsumo,chea1.Entregable AS Entregable
                        FROM k_checkListEntregableInsumo kcei
                        LEFT JOIN k_checklist_actividad chea ON chea.IdCheckList=kcei.idChecklistInsumoUsado
                        LEFT JOIN k_checklist_actividad chea1 ON chea1.IdCheckList=kcei.idChecklistEntregable
                        LEFT JOIN c_checkList che ON che.IdCheckList=chea.IdCheckList
                        LEFT JOIN c_checkList che1 ON che1.IdCheckList=chea1.IdCheckList
                        LEFT JOIN c_actividad a ON a.IdActividad=kcei.idActividadInsumoUsado
                        LEFT JOIN c_actividad a1 ON a1.IdActividad=kcei.idActividadEntregable
                        LEFT JOIN c_personas p ON p.id_Personas=che.IdResponsable
                        LEFT JOIN c_personas p1 ON p1.id_Personas=a.IdResponsable
                        LEFT JOIN c_area ar ON ar.Id_Area=p.IdArea
                        LEFT JOIN c_area ar1 ON ar1.Id_Area=a1.IdArea
                        where kcei.idChecklistEntregable=".$row['idChecklistEntregable']. " and kcei.idActividadEntregable=".$row['idActividadEntregable'];
                        $resultConsulta6 = $catalogo->obtenerLista($consulta6);
                        while ($row6 = mysqli_fetch_array($resultConsulta6)) {
                            echo "<br>".$row6["FechaInsumoRequerido"];
                            }
                            echo '</td>';
                        ?>
                            <td><?php echo $row['CheckEntregable']; ?></td>
                            <td><?php echo $row['ActividadEntregable']; ?></td>
                            <td><?php echo $row['Entregable']; ?></td>
                            <td><?php echo $row['Anio']; ?></td>
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
