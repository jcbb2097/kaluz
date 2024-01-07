<?php
//include_once ($_SERVER['DOCUMENT_ROOT'].'/sie/WEB-INF/Classes/Catalogo.class.php');
//$catalogo = new Catalogo();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();

$Aplicacion="Instrumentos Jurídicos";
$MiTipoPerfil=1;//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiIdUsr=999;
$MiNomUsr="SinUsr";
if ((isset($_GET['tipoPerfil']) && $_GET['tipoPerfil'] != ""))          { $MiTipoPerfil=$_GET['tipoPerfil']; }
if ((isset($_GET['idUsuario']) && $_GET['idUsuario'] != ""))            { $MiIdUsr=     $_GET['idUsuario']; }
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != ""))    { $MiNomUsr=    $_GET['nombreUsuario']; }
$MiNomUsr=str_replace(" ", "%20", $MiNomUsr);
$MisParam="tipoPerfil=".$MiTipoPerfil."&idUsuario=".$MiIdUsr."&nombreUsuario=".$MiNomUsr; //Para pasar parametros a la siguiente liga

$AnioActual=date("Y"); //Año actual para mostrar por default
$AnioActual="2020";
$VarWhere= " ";

$FiltroAnio="";
if (isset($_GET['F_IdAnio']) && $_GET['F_IdAnio'] != "")
{
    if ($_GET['F_IdAnio']=="Sin información")
        { $VarWhere= " WHERE isnull(p.Periodo) "; } //Para fechas nulas
    elseif ($_GET['F_IdAnio']=="Todos") //Para todos los años
        { $VarWhere= " WHERE 1=1 "; }
    else { $VarWhere= " WHERE p.Periodo='".$_GET['F_IdAnio']."' "; }
}
else {$VarWhere= " WHERE p.Periodo='".$AnioActual."' "; }

$FiltroEje=""; //Se inicializa la variable
if ((isset($_GET['F_IdEje']) && $_GET['F_IdEje'] != "")) //Si el parametro existe se procesa
{   if ($_GET['F_IdEje']!="0") {$FiltroEje =" AND j.Id_eje=".$_GET['F_IdEje'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $FiltroEje="  AND isnull(j.Id_eje)"; } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroArea="";
if ((isset($_GET['F_IdArea']) && $_GET['F_IdArea'] != ""))
{   if ($_GET['F_IdArea']!="0") {$FiltroArea =" AND j.IdArea=".$_GET['F_IdArea'];}
    else {  $FiltroArea="  AND isnull(j.IdArea)"; }
}

$FiltroLugar="";
if ((isset($_GET['F_IdTipoContNal']) && $_GET['F_IdTipoContNal'] != ""))
{   if ($_GET['F_IdTipoContNal']!="0") {$FiltroLugar =" AND j.Tipo_contrato=".$_GET['F_IdTipoContNal'];}
    else {  $FiltroLugar="  AND isnull(j.Tipo_contrato)"; }
}

$FiltroTipoContrato="";
if ((isset($_GET['F_IdTipoCont']) && $_GET['F_IdTipoCont'] != ""))
{   if ($_GET['F_IdTipoCont']!="0") {$FiltroTipoContrato =" AND j.Id_subtipo=".$_GET['F_IdTipoCont'];}
    else {  $FiltroTipoContrato="  AND isnull(j.Id_subtipo)"; }
}

$FiltroExpo="";
if ((isset($_GET['F_IdExpoTemp']) && $_GET['F_IdExpoTemp'] != ""))
{   if ($_GET['F_IdExpoTemp']!="0") { $FiltroExpo =" AND j.Id_Exposicion=".$_GET['F_IdExpoTemp']; }
    else  { $FiltroExpo="  AND isnull(j.Id_Exposicion)"; }
}

$FiltroEstatus="";
if ((isset($_GET['F_IdEstatus']) && $_GET['F_IdEstatus'] != ""))
{   $FiltroEstatus="  AND j.EstatusAvance = " . $_GET['idParametroEstatus']; 
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
    <script src="../../../resources/js/aplicaciones/Juridico/Alta_juridico.js"></script>
    <title>::.Jurídico.::</title>
</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?<?php echo $MisParam; ?>">Aplicaciones</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Jurídico</a></div>
        <div class="well2 wr">
            <a style="color:#fefefe; cursor: pointer;" href="javascript:window.location.reload(true)">Catálogos</a> /
            <a style="color:#fefefe; cursor: pointer;" href="Lista_Instrumento.php?usuario='<?php echo $MiNomUsr; ?>'">Tipo Instrumento</a> /
            <a style="color:#fefefe; cursor: pointer;" href="Lista_Subtipo.php?usuario='<?php echo $MiNomUsr; ?>'">Subtipo</a>
        </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                    <a style="color:purple;" href="Alta_juridico.php?accion=guardar&usuario='<?php echo $MiNomUsr; ?>'"' . '>agregar +</a> / <a style="color:purple; cursor: pointer;" href="vista.php?<?php echo $MisParam; ?>">Indicador</a>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12"></div>
            <div class="col-md-4 col-sm-4 col-xs-12"></div>
        </div><br>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table id="tJuridico" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Año</th>
                            <th>Proyecto</th>
                            <th>Contraparte</th>
                            <th>Instrumento jurídico</th>
                            <!--th>Tipo de contrato</th-->
                            <th>Jurisdicción</th>
                            <th>Objeto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $consulta = "
                            SELECT Id_juridico,p.Periodo,e.tituloFinal,ja.nombre AS instrumento,
                            jb.nombre AS subtipo, j.Tipo_contrato,j.Objeto, j.Fee_pago, j.Pago_seguro,j.Comite_transporte,
                            j.Fecha_pago_contraparte,j.Num_obra,j.Borrador,j.Contraparte_gestor,j.Archivo
                            FROM c_juridico j
                            LEFT JOIN c_instrumentoJuridico ja ON ja.idInstrumento = j.Id_Instrumento
                            LEFT JOIN c_instrumentoJuridico jb ON jb.idInstrumento = j.Id_subtipo
                            LEFT JOIN c_periodo p ON p.Id_Periodo = j.Id_periodo
                            LEFT JOIN c_exposicionTemporal e on e.idExposicion=j.Id_Exposicion
                            ".$VarWhere." ".$FiltroEje.$FiltroArea
                            .$FiltroLugar.$FiltroTipoContrato.$FiltroExpo.$FiltroEstatus;
                        //echo $consulta;
                        $ValUser = "'".$MiNomUsr."'";
                        $resultConsulta = $catalogo->obtenerLista($consulta);
                        while ($row = mysqli_fetch_array($resultConsulta)) {
                            echo '<tr>';
                            echo '<td><a style="color:purple;cursor:pointer" onclick="eliminar(' . $row['Id_juridico'] . ')"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;
                            <a style="color:purple;cursor:pointer" onclick="modificar(' . $row['Id_juridico'] . ',' . $ValUser . ')"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;
                            <a style="color:purple;cursor:pointer"  onclick="loadDynamicContentModal(' . $row['Id_juridico'] . ')" ><span class="glyphicon glyphicon-plus-sign"></span></a></td>';
                            echo '<td>' . $row['Periodo'] . '</td>';
                            echo '<td>' . $row['tituloFinal'] . '</td>';
                            echo '<td>' . $row['Contraparte_gestor'] . '</td>';
                            echo '<td>' . $row['instrumento'] ;

                            if ($row['Archivo'] != '') { //Si tiene archivo muestra la liga.
                                $ruta = '../../../resources/aplicaciones/PDF/Juridico/'.$row['Archivo'];
                                echo '<a target="_blank" href="'.$ruta.'" ><i class="glyphicon glyphicon-file"></i> </a></td>';
                            }

                            //echo '<td>' . $row['subtipo'] . '</td>';
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