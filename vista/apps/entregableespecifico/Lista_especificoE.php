<?php
//include_once ($_SERVER['DOCUMENT_ROOT'].'/sie/WEB-INF/Classes/Catalogo.class.php');
//$catalogo = new Catalogo();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();

$Aplicacion="Entregables Especificos";
$MiTipoPerfil=1;//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiIdUsr=999;
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
        { $FiltroAnio= " AND isnull(pe.Id_Periodo) "; } //Para fechas nulas
    elseif ($_GET['F_IdAnio']=="Todos") //Para todos los años
        { $FiltroAnio= " =1 "; }
    else { $FiltroAnio= " AND pe.Id_Periodo='".$_GET['F_IdAnio']."' "; }
}
else {$FiltroAnio= ""; }

$FiltroEje=""; //Se inicializa la variable
if ((isset($_GET['F_IdEje']) && $_GET['F_IdEje'] != "")) //Si el parametro existe se procesa
{   if ($_GET['F_IdEje']!="0") {$FiltroEje =" AND ej.idEje= ".$_GET['F_IdEje'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $FiltroEje="  AND isnull(ej.idEje)"; } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroArea="";
if ((isset($_GET['F_IdArea']) && $_GET['F_IdArea'] != ""))
{   if ($_GET['F_IdArea']!="0") {$FiltroArea =" AND ar.Id_Area=".$_GET['F_IdArea'];}
    else {  $FiltroArea="  AND isnull(ar.Id_Area)"; }
}

$FiltroExp=""; //Se inicializa la variable
if ((isset($_GET['F_IdExp']) && $_GET['F_IdExp'] != "")) //Si el parametro existe se procesa
{   if ($_GET['F_IdExp']!="0") {$FiltroExp =" AND ep.idExposicion= ".$_GET['F_IdExp'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $FiltroExp="  AND isnull(ep.idExposicion)"; } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroInter="";
if ((isset($_GET['F_IdInter']) && $_GET['F_IdInter'] != ""))
{   if ($_GET['F_IdInter']!="0") {$FiltroInter =" AND i.idIntervalo=".$_GET['F_IdInter'];}
    else {  $FiltroInter="  AND isnull(i.idIntervalo)"; }
}

$FiltroAct="";
if ((isset($_GET['F_IdAct']) && $_GET['F_IdAct'] != ""))
{   if ($_GET['F_IdAct']!="0") {$FiltroAct =" AND a.IdActividad=".$_GET['F_IdAct'];}
    else {  $FiltroAct="  AND isnull(a.IdActividad)"; }
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
    <script src="Alta_especificoE.js"></script>
    <title>::.Entregables Especifico.::</title>
</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?<?php echo $MisParam; ?>">Aplicaciones</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Entregable Especifico</a></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                    <a style="color:purple;" href="Alta_especificoE.php?accion=guardar&usuario='<?php echo $MiNomUsr; ?>'"' . '>agregar +</a>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12"></div>
            <div class="col-md-4 col-sm-4 col-xs-12"></div>
        </div><br>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table id="tRolpersona" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                            <th></th>
                            <th>Nombre de la Actividad</th>
                            <th>Nombre del entregable</th>
                            <th>Descripción</th>
                            <th>Avance</th>
                            <th>Exposición Temporal</th>
                            <th>Intervalo</th>
                            <th>Nombre Libro</th>
                    </thead>
                    <tbody>
                        <?php
                        $consulta = "SELECT ee.IdEntregEspecifico,ee.Descripcion AS descEE, ee.avance,e.IdEntregable,e.Nombre AS nomEntr, ep.idExposicion,
                        ep.tituloFinal,i.idIntervalo,i.descripcion AS desclib,a.IdActividad,CONCAT(a.Numeracion,' ',a.Nombre) AS nomAct,l.IdLibro, l.Titulo,ar.Id_Area,ar.Nombre AS nomarea
                        FROM c_entregableEspecifico ee 
                        LEFT JOIN c_entregable e ON e.IdEntregable=ee.IdEntregable 
                        LEFT JOIN  c_exposicionTemporal ep ON ep.idExposicion=ee.idExp
                        LEFT JOIN c_intervalo i ON i.idIntervalo=ee.idintervalo
                        LEFT JOIN c_actividad a ON a.IdActividad=e.idActividad
                        LEFT JOIN c_libro l ON l.IdLibro=ee.IdLibro
                        LEFT JOIN c_area ar ON ar.Id_Area=a.IdArea
                        LEFT JOIN c_eje ej ON ej.idEje=a.IdEje
			LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.Periodo
                        WHERE 1  $FiltroEje $FiltroArea $FiltroAnio $FiltroExp $FiltroAct $FiltroInter
                        ORDER BY ee.IdEntregEspecifico ASC";
                        //".$VarWhere."




                        $resultConsulta = $catalogo->obtenerLista($consulta);
                        while ($row = mysqli_fetch_array($resultConsulta)) {

                            echo '<tr>';
                            echo '<td><a style="color:black;cursor:pointer" onclick="eliminar('.$row['IdEntregEspecifico'].')"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;<a style="color:black;cursor:pointer" onclick="modificar('.$row['IdEntregEspecifico'].')"><span class="glyphicon glyphicon-pencil"></span></a></td>';
                        ?>
                            <td><?php echo $row['nomAct']; ?></td>
                            <td><?php echo $row['nomEntr']; ?></td>
                            <td><?php echo $row['descEE']; ?></td>
                            <td><?php echo $row['avance']; ?></td>
                            <td><?php echo $row['tituloFinal']; ?></td>
                            <td><?php echo $row['desclib']; ?></td>
                            <td><?php echo $row['Titulo']; ?></td>
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
