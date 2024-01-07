<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();

/*
session_start();
include_once __DIR__."/../../../source/dao/clases/LoggedinTime.php";
include_once __DIR__."/../../../source/controller/UsuarioController.php";
include_once __DIR__."/../../../source/controller/EjeController.php";
include_once __DIR__."/../../../source/controller/AreaController.php";
include_once __DIR__."/../../../source/controller/NoticiaController.php";
*/
/*
if(!isset($_SESSION['user_session']))
{
?>
<script>
    top.location.href="../../login.php";
    window.reload();
</script>
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
$nombre = isset($_GET['accion']) ? $_GET['accion'] : null;
if ($nombre == null) {
    include_once("../../../WEB-INF/Classes/Institucion2.class.php");
} else {
    include_once("../../../../WEB-INF/Classes/Institucion2.class.php");
}

$Aplicacion="Instituciones";
$MiTipoPerfil=1;//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiIdUsr=999;
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
    else { $FiltroAnio= " AND pa.AnioLaborado=".$AnioActual." "; }
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
<html lang="en">
<head>
    <!-- <title>Instituciones</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css"/>
    
<script src="resources/js/paginas/Institucion/Alta_institucion.js"></script>
        
         <script src="resources/bootstrap-3.3.7/js/bootstrap.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" href="resources/bootstrap-3.3.7/css/bootstrap.css">
        <link rel="stylesheet" href="resources/bootstrap-3.3.7/css/bootstrap-theme.css">
        <link href="resources/css/jquery-ui.css" rel="stylesheet" type="text/css" />
        <script src="resources/js/jquery-ui.js"></script>
        <script src="resources/js/jquery/jquery.validate.js"></script>
        <script src="resources/js/funciones.js"></script>
        <script src="resources/js/sweetAlert.js"></script>
        <script src="resources/js/locale/datepicker-es.js"></script>
        <script src="resources/js/bootstrap/bootstrapValidator.js"></script> -->

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
        <script src="../../../resources/js/aplicaciones/Institucion/Alta_institucion.js"></script>
        <!-- <script src="../../../resources/js/aplicaciones/Institucion/funciones.js"></script> -->

        <title>::.INSTITUCIONES.::</title>
     
<!--<script type="text/javascript">

            $(document).ready(function () {
                   var espanol = {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ Instituciones",
        "sZeroRecords": "<div class='alert alert-info'><strong>Lo sentimos No hay Instituciones relacionadas con tu búsqueda.</strong></div>",
         "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando las Instituciones del _START_ al _END_ de un total de _TOTAL_ Instituciones",
       "sInfoEmpty": "Mostrando Instituciones del 0 al 0 de un total de 0 Instituciones",
        "sInfoFiltered": "(filtrado de un total de _MAX_ Instituciones)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "\u00daltimo",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    };
    table = $('#tInstitucion').DataTable({
        "oLanguage": espanol,
        "paging": true,
        "info": true,
        "pageLength": 10,
        destroy: true

    });
				
				
            });
        </script> --> 
    </head>
<body>
	<div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=<?php echo $MiTipoPerfil; ?>">Aplicaciones</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)"><?php echo $Aplicacion; ?></a></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                <a style="color:purple; font-family: Muli-SemiBold;" href="Alta_institucion.php?accion=guardar&usuario='<?php echo $MiNomUsr; ?>'">agregar +</a>
                        /  <a style="color:purple; font-family: Muli-SemiBold;" href="vista.php?accion=guardar&usuario='<?php echo $MiNomUsr; ?>'">  Indicadores</a>
                </div>
                <div  class="col-md-4 col-sm-4 col-xs-12"> </div>
                <div class="col-md-4 col-sm-4 col-xs-12">  </div>
            </div><br>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <table id="tPersonas" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th >Nombre</th>
                            <th>País</th>
                            <th>Sector</th>
                            <th >Giro</th>
                            <th>Subgiro</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                            $consulta=" SELECT i.Nombre,i.Id_institucion,i.Id_pais,i.Id_sector,i.Id_giro,i.Id_subgiro,
                            c_sector.nombre AS Sector,c_pais.Nombre AS Pais,k_subgiro.Id_subgiro,c_subgiro.nombre AS Subgiro,
                            c_giro.nombre AS Giro
                            FROM c_institucion i
                            LEFT JOIN c_sector ON i.Id_sector = c_sector.Id_sector
                            LEFT JOIN c_pais ON i.Id_pais = c_pais.id_Pais
                            LEFT JOIN k_subgiro ON i.Id_subgiro = k_subgiro.Id_subgiro
                            LEFT JOIN c_subgiro ON k_subgiro.Id_subgiro2 = c_subgiro.Id_subgiro
                            LEFT JOIN c_giro ON i.Id_giro = c_giro.Id_giro
                            ORDER BY Nombre
                            ";
                            $ValUser = "'".$MiNomUsr."'";
                            $resultActividades=$catalogo->obtenerLista($consulta);
                        while ($rowActividades = mysqli_fetch_array($resultActividades)) {
                            echo '<tr>';
                            echo '<td><a style="color:black;cursor:pointer" onclick="eliminar('.$rowActividades['Id_institucion'].')"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;<a style="color:black;cursor:pointer" onclick="modificar('.$rowActividades['Id_institucion'].','.$ValUser.')"><span class="glyphicon glyphicon-pencil"></span></a></td>';
                            echo '<td>' . $rowActividades['Id_institucion'] . '</td>';
                            echo '<td>' . $rowActividades['Nombre'] . '</td>';
                            echo '<td>' . $rowActividades['Pais'] . '</td>';
                            echo '<td>' . $rowActividades['Sector'] . '</td>';
                            echo '<td>' . $rowActividades['Giro'] . '</td>';
                            echo '<td>' . $rowActividades['Subgiro'] .'</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
</body>
</html>