<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$nombre = isset($_GET['accion']) ? $_GET['accion'] : null;
include_once("../../../WEB-INF/Classes/Personas.class.php");
session_start();
/*
session_start();
include_once __DIR__."/../../../source/dao/clases/LoggedinTime.php";
include_once __DIR__."/../../../source/controller/UsuarioController.php";
include_once __DIR__."/../../../source/controller/EjeController.php";
include_once __DIR__."/../../../source/controller/AreaController.php";
include_once __DIR__."/../../../source/controller/NoticiaController.php";

if(!isset($_SESSION['user_session']))
{

?>
<script> top.location.href="../../login.php"; window.reload(); </script>
<?php
}
if(isset($_SESSION["user_session"]))
{
    if(isLoginSessionExpired())
    {
?>
<script>  top.location.href="../../logout.php?session_expired=1"; </script>
<?php
    }
}
*/

$Aplicacion="Personas";
$MiTipoPerfil=1;//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiIdUsr=$_SESSION['user_session'];
$MiNomUsr="SinUsr";
if ((isset($_GET['tipoPerfil']) && $_GET['tipoPerfil'] != ""))          { $MiTipoPerfil=$_GET['tipoPerfil']; }
if ((isset($_GET['idUsuario']) && $_GET['idUsuario'] != ""))            { $MiIdUsr=     $_GET['idUsuario']; }
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != ""))    { $MiNomUsr=    $_GET['nombreUsuario']; }
$MiNomUsr=str_replace(" ", "%20", $MiNomUsr);
$MisParam="tipoPerfil=".$MiTipoPerfil."&idUsuario=".$MiIdUsr."&nombreUsuario=".$MiNomUsr; //Para pasar parametros a la siguiente liga

$AnioActual=date("Y"); //Año actual para mostrar por default
$AnioActual=date("2020");
$VarWhere= " ";

$FiltroAnio=" ";
if (isset($_GET['F_IdAnio']) && $_GET['F_IdAnio'] != "")
{
    if ($_GET['F_IdAnio']=="Sin información")
        { $FiltroAnio= " "; }
    elseif ($_GET['F_IdAnio']=="Todos") //Para todos los años
        { $FiltroAnio= " "; }
    else { 
        $FiltroAnio= " AND pa.AnioLaborado=".$AnioActual." "; 
        //$FiltroAnio= ""; 
}
}

$FiltroEje=""; //Se inicializa la variable
if ((isset($_GET['F_IdEje']) && $_GET['F_IdEje'] != "")) //Si el parametro existe se procesa
{   if ($_GET['F_IdEje']!="0") {$FiltroEje =" AND p.idEje=".$_GET['F_IdEje'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $FiltroEje="  AND isnull(p.idEje)"; } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroArea="";
if ((isset($_GET['F_IdArea']) && $_GET['F_IdArea'] != ""))
{   if ($_GET['F_IdArea']!="0") {$FiltroArea =" AND p.idArea=".$_GET['F_IdArea'];}
    else {  $FiltroArea=" AND isnull(p.idArea)"; }
}

$FiltroClasif="";
if ((isset($_GET['F_IdClasif']) && $_GET['F_IdClasif'] != ""))
{   if ($_GET['F_IdClasif']!="0") {$FiltroClasif =" AND ce.IdClasificacionEmpleado=".$_GET['F_IdClasif'];}
    else {  $FiltroClasif="  AND isnull(ce.IdClasificacionEmpleado)"; }
}

$FiltroTipo="";
if ((isset($_GET['F_IdTipoCont']) && $_GET['F_IdTipoCont'] != ""))
{   if ($_GET['F_IdTipoCont']!="0") {$FiltroTipo =" AND p.id_TipoPersona=".$_GET['F_IdTipoCont'];}
    else {  $FiltroTipo="  AND isnull(p.id_TipoPersona)"; }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css"/>
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="../../../resources/css/bootstrap-select.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="../../../resources/js/bootstrap-select.js"></script>
    <script src="../../../resources/js/sweetAlert.js"></script>
    <script src="../../../resources/js/bootstrap/bootstrapValidator.js"></script>
    <script src="../../../resources/js/aplicaciones/Personas/alta_persona.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <title>::.PERSONAS.::</title>
</head>
<body>
	<div class="well well-sm">
        <a style="color:#fefefe;" href="../../aplicaciones.php?<?php echo $MisParam;?>">Aplicaciones</a> / 
        <a style="color:#fefefe;" href="lista_personas.php?<?php echo $MisParam;?>"><?php echo $Aplicacion; ?></a> /
        <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Lista Personas</a>
    </div>
    <div class="well2 wr">
        <a style="color:#fefefe; cursor: pointer;" href="vista.php?<?php echo $MisParam;?>">Indicadores</a> /
        <a style="color:#fefefe; cursor: pointer;" href="lista_personas.php?<?php echo $MisParam;?>">Lista Personas</a> / 
        <a style="color:#fefefe; cursor: pointer;" href="alta_persona.php?accion=guardar&usuario='<?php echo $MiNomUsr; ?>'">Agregar +</a>
    </div>
        <div class="container-fluid">
            <div class="row">
                <!--<div class="col-md-4 col-sm-4 col-xs-12">
                    <a style="color:purple; font-family: Muli-SemiBold;" href="alta_persona.php?accion=guardar&usuario='<?php echo $MiNomUsr; ?>'">agregar +</a>
                        /  <a style="color:purple; font-family: Muli-SemiBold;" href="vista.php?accion=guardar&usuario='<?php echo $MiNomUsr; ?>'">  Indicadores</a>
                </div>-->
                <div  class="col-md-4 col-sm-4 col-xs-12"> <?php if(isset($_GET['F_IdClasif']) &&  $_GET['F_IdClasif'] == 24)echo "<a href='#' onclick='muestragrafica()'>Ver gráfica</a>"; ?> </div>
                <div class="col-md-4 col-sm-4 col-xs-12">  </div>
            </div><br>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <table id="tPersonas" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Tipo de Persona</th>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
							              <th>Área</th>
                            <th>Eje</th>
                            <th>CURP</th>
                            <TH>RFC</TH>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $consulta = " SELECT a.Nombre AS NomArea, p.*, j.Archivo,CONCAT(eje.idEje,'.',eje.Nombre) AS eje,
							(SELECT COUNT(*) FROM c_actividad a WHERE a.IdResponsable=p.id_Personas AND a.idtipoActividad=1 and a.anio=2020 AND a.idEje<12) as NumActiv,
							ce.Nombre as categoria
                            FROM c_personas p
                            LEFT JOIN k_clasificacionPersona cp ON cp.IdPersona=p.id_Personas
                            LEFT JOIN c_clasificacionEmpleado ce ON ce.IdClasificacionEmpleado=cp.IdClasificacion
                            LEFT JOIN k_personasAnios pa ON pa.IdPersona=p.id_Personas
                            LEFT JOIN c_area a ON a.Id_Area=p.idArea
                            JOIN c_eje eje ON p.idEje = eje.idEje
							LEFT JOIN k_juridicoPersona jp ON jp.IdPersona=p.id_Personas
                            LEFT JOIN c_juridico j ON j.Id_juridico=jp.IdJuridico
                            WHERE  p.Activo=1 ".$FiltroAnio.$FiltroArea.$FiltroEje.$FiltroClasif.$FiltroTipo."
                             order by p.Nombre asc";
                           //echo $consulta;
                            $ValUser = "'".$MiNomUsr."'";
                            $resultPersonas=$catalogo->obtenerLista($consulta);
                            $numeracion = 0;
                        while ($rowPersonas = mysqli_fetch_array($resultPersonas)) {
                            $expediente = "";
                            $numeracion++;
                            if ($rowPersonas['id_TipoPersona']=="1") { $tipoPersona='Interno';}
                            else if ($rowPersonas['id_TipoPersona']=="2") { $tipoPersona='Externo';}
                            else {$tipoPersona='N/A';}
                            echo '<tr>';
                            echo '<td>'.$numeracion.'.- <a style="color:black;cursor:pointer" onclick="eliminar('.$rowPersonas['id_Personas'].')"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;<a style="color:black;cursor:pointer" onclick="modificar('.$rowPersonas['id_Personas'].','.$ValUser.')"><span class="glyphicon glyphicon-pencil"></span></a></td>';
                            echo '<td>'.$tipoPersona.'/'.$rowPersonas['categoria'].'</td>';
                            echo '<td>'.$rowPersonas['Nombre'].'<br>';

							if ($rowPersonas['Archivo'] != '') { //Si tiene archivo muestra la liga.
                                $ruta = '../../../resources/aplicaciones/PDF/Juridico/'.$rowPersonas['Archivo'];
                                echo '<a target="_blank" href="'.$ruta.'" ><i class="glyphicon glyphicon-file"></i> </a>';
                            }
                            if($rowPersonas['expediente'] != '')$expediente = "<a href='".$rowPersonas['expediente']."' target='_blank'>[Expediente]</a>";

							echo '(Num.Act: <a onclick="muestraDetalle('.$rowPersonas['id_Personas'].')" href="#" >'.$rowPersonas['NumActiv'].'</a> ) '.$expediente.'</td>';


                            echo '<td>'.$rowPersonas['Apellido_Paterno'].'</td>';
                            echo '<td>'.$rowPersonas['Apellido_Materno'].'</td>';
							              echo '<td>'.$rowPersonas['NomArea'].'</td>';
                            echo '<td>'.$rowPersonas['eje'].'</td>';
                            echo '<td>'.$rowPersonas['CURP'].'</td>';
                            echo '<td>'.$rowPersonas['RFC'].'</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>
        <!-- Modal -->
        <div style="top: 20px;" class="modal fade" id="myModal" role="dialog">
        	<div class="modal-dialog">
        		<!-- Modal content-->
        		<div class="modal-content" style="right:138px;width: 877px;">
        			<div class="modal-header h" style="padding: 7px 5px;color:#ffffff;font-size: 1.2rem;">
        				<button type="button" class="close" data-dismiss="modal">&times;</button>
        				Detalle
        			</div>
        			<div class="modal-body detalle" style="padding: 31px 5px;"></div>
        		</div>
            </div>
        </div>

</body>
<script>
function muestraDetalle(idpersona){

	$(".h").css('background-color',"#4d4d57");
	$("#myModal").modal({backdrop: false});
	$.post("verActividades.php?idPer="+idpersona,{}, function(data) {
		$(".detalle").html('');
		$(".detalle").html(data);
	});

}
function muestragrafica(){

	$(".h").css('background-color',"#4d4d57");
	$("#myModal").modal({backdrop: false});
	$.post("graficas_detalle.php",{}, function(data) {
		$(".detalle").html('');
		$(".detalle").html(data);
	});

}

</script>
</html>
