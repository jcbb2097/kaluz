<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

session_start();
include_once __DIR__."/../../../source/dao/clases/LoggedinTime.php";
include_once __DIR__."/../../../source/controller/UsuarioController.php";
include_once __DIR__."/../../../source/controller/EjeController.php";
include_once __DIR__."/../../../source/controller/AreaController.php";
include_once __DIR__."/../../../source/controller/NoticiaController.php";

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
<script>
    top.location.href="../../logout.php?session_expired=1";
</script>
<?php
    }
}

include_once("../../../WEB-INF/Classes/Catalogo.class.php");
include_once("../../../WEB-INF/Classes/Personas.class.php");
$catalogo = new Catalogo();

$Aplicacion="Personas";
$MiTipoPerfil=1;//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiIdUsr=$_SESSION['user_session'];
$MiNomUsr="SinUsr";
if ((isset($_GET['tipoPerfil']) && $_GET['tipoPerfil'] != ""))          { $MiTipoPerfil=$_GET['tipoPerfil']; }
if ((isset($_GET['idUsuario']) && $_GET['idUsuario'] != ""))            { $MiIdUsr=     $_GET['idUsuario']; }
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != ""))    { $MiNomUsr=    $_GET['nombreUsuario']; }
$MiNomUsr=str_replace(" ", "%20", $MiNomUsr);
$MisParam="tipoPerfil=".$MiTipoPerfil."&idUsuario=".$MiIdUsr."&nombreUsuario=".$MiNomUsr; //Para pasar parametros a la siguiente liga


$editar = false;
$id_tipopersona = "";
$idEje = ""; #verificar con datos en tabla
$arrayRol = array();
$id_area = "";
$id_subarea = "";
$relevancia = "";
$nombre = "";
$app = "";
$apm = "";
$seudonimo = "";
$dia = "";
$mes = "";
$anio = "";
$pais_nac = "";
$id_gradoacademico = "";
$id_institucion = "";
$id_institucionE = "";
$cargo = "";
$parentesco = "";
$infoRel = "";
$calle = "";
$num_ext = "";
$num_int = "";
$colonia = "";
$municipio = "";
$id_ciudad = "";
$id_estado = "";
$id_pais = "";
$cp = "";
$correo = "";
$correo_institucional = "";
$rfc = "";
$curp = "";
$estatus = "";
$activo = "";
$UsuarioCreacion = "";
$UsuarioUltimaModificacion = "";

$id_telefono = "";
$id_tipotel = "";
$numero = "";
$ext = "";
$emergencia = "";
$estatustel = "";
$activotel = "";

$resenia = "";
$semblanza = "";
$ocupacion = "";
$id_institucionA = "";

//$registro = array();
if (isset($_GET['accion']) && $_GET['accion'] != "") {
    echo '<input type="hidden" id="accion" name="accion" value="' . $_GET['accion'] . '" />';
    echo '<input type="hidden" id="usuario" name="usuario" value="' . $_GET['usuario'] . '" />';
    $user =$_GET['usuario'];
    if ($_GET['accion'] == "editar") {
        //echo $_GET['id'];
        $editar = true;
        echo '<input type="hidden" id="id" name="id" value="' . $_GET['id'] . '"/>';
    } else {
        echo '<input type="hidden" id="id" name="id" value="0"/>';
    }
}
if ($editar == true) {
    $obj = new Persona();
    $obj->setId_Personas($_GET['id']);
    $obj->getPersona();
    $obj->getNumerotelefonico();

    $id_tipopersona = $obj->getId_tipopersona();
    $idEje = $obj->getIdEje(); #verificar con datos en tabla
    $id_area = $obj->getId_area();
    $id_subarea = $obj->getId_subarea();
    $relevancia = $obj->getRelevancia();
    $nombre = $obj->getNombre();
    $app = $obj->getApp();
    $apm = $obj->getApm();
    $seudonimo = $obj->getSeudonimo();
    $dia = $obj->getDia();
    $mes = $obj->getMes();
    $anio = $obj->getAnio();
    $pais_nac = $obj->getPais_nac();
    $id_gradoacademico = $obj->getId_gradoacademico();
    $id_institucion = $obj->getId_institucion();
    $id_institucionE = $obj->getId_institucionE();
    $cargo = $obj->getCargo();
    $parentesco = $obj->getParentesco();
    $infoRel = $obj->getInfoRel();
    $calle = $obj->getCalle();
    $num_ext = $obj->getNum_ext();
    $num_int = $obj->getNum_int();
    $colonia = $obj->getColonia();
    $municipio = $obj->getMunicipio();
    $id_ciudad = $obj->getId_ciudad();
    $id_estado = $obj->getId_estado();
    $id_pais = $obj->getId_pais();
    $cp = $obj->getCp();
    $correo = $obj->getCorreo();
    $correo_institucional = $obj->getCorreo_institucional();
    $rfc = $obj->getRfc();
    $curp = $obj->getCurp();
    $estatus = $obj->getEstatus();
    $activo = $obj->getActivo();

    $id_telefono = $obj->getId_telefono();
    $id_tipotel = $obj->getId_tipotel();
    $numero = $obj->getNumero();
    $ext = $obj->getExt();
    $emergencia = $obj->getEmergencia();
    $estatustel = $obj->getEstatustel();
    $activotel = $obj->getActivotel();

    $arrayRol = $obj->obtenerRol();

    $resenia = $obj->getResenia();
    $semblanza = $obj->getSemblanza();
    $ocupacion = $obj->getOcupacion();
    $id_institucionA = $obj->getInstitucionA();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>::.FORMULARIO INSTITUCIONES.::</title>
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
    <script src="../../../resources/js/bootstrap/bootstrap-multiselect.js"></script>
    <script src="../../../resources/js/aplicaciones/Personas/alta_persona.js"></script>
    <script src="../../../resources/js/aplicaciones/Personas/funciones.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#rol').multiselect({
              nonSelectedText:'No aplica'
            });
            $('#id_institucion').multiselect({
              nonSelectedText:'No aplica'
            });
        });
    </script>
</head>
<body>
    <div class="well well-sm">
        <a style="color:#fefefe;" href="../../aplicaciones.php?<?php echo $MisParam;?>">Aplicaciones</a> / 
        <a style="color:#fefefe;" href="lista_personas.php?<?php echo $MisParam;?>"><?php echo $Aplicacion; ?></a> /
        <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Agregar Persona</a>
    </div>
    <div class="well2 wr">
        <a style="color:#fefefe; cursor: pointer;" href="vista.php?<?php echo $MisParam;?>">Indicadores</a> /
        <a style="color:#fefefe; cursor: pointer;" href="lista_personas.php?<?php echo $MisParam;?>">Lista Personas</a> / 
        <a style="color:#fefefe; cursor: pointer;" href="alta_persona.php?accion=guardar&usuario='<?php echo $MiNomUsr; ?>'">Agregar +</a>
    </div>
    <div id="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form class="form-horizontal" id="formPersonas" name="formPersonas">
                    <legend>Área</legend>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">* Seleccione Eje</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="idEje" class="form-control" name="idEje">
                                <?php
                                    $consultaeje = "SELECT * FROM c_eje";
                                    $resultado = $catalogo->obtenerLista($consultaeje);
                                    echo '<option value="">Seleccione</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['idEje'] == $idEje) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['idEje'] . '" ' . $s . '>' . $row['idEje'] . '. ' . $row['Nombre'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2 control-label" for="rol">Asignar Rol</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select name="rol[]" id="rol" class="rol" multiple="multiple">
                                <?php
                                    $consultarol = "SELECT * FROM c_rol";
                                    $resultado = $catalogo->obtenerLista($consultarol);
                                    //echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if (in_array($row['id_Rol'], $arrayRol)) {
                                            $s = "selected";
                                        }
                                        echo '<option value="' . $row['id_Rol'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">* Seleccione el área</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="id_area" class="form-control" name="id_area">
                                <?php
                                    $consultaarea = "SELECT * FROM `c_area`";
                                    $resultado = $catalogo->obtenerLista($consultaarea);
                                    echo '<option value="">Seleccione</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['Id_Area'] == $id_area) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['Id_Area'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Seleccione la subarea</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="id_subarea" class="form-control" name="id_subarea">
                                <?php
                                    $consultasubarea = "SELECT * FROM `c_subarea`";
                                    $resultado = $catalogo->obtenerLista($consultasubarea);
                                    echo '<option value="">Seleccione</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['Id_subarea'] == $id_subarea) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['Id_subarea'] . '" ' . $s . '>' . $row['nombre'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <legend>Nombre</legend>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">* Tipo de persona</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="id_tipopersona" class="form-control" name="id_tipopersona">
                                <?php
                                    $consultatper = "SELECT * FROM `c_tipopersona`";
                                    $resultado = $catalogo->obtenerLista($consultatper);
                                    echo '<option value="">Seleccione</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['id_TipoPersona'] == $id_tipopersona) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['id_TipoPersona'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="nombre">* Nombre</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="nombre" name="nombre" class="form-control" type="text" placeholder="Nombre" value="<?php echo $nombre; ?>"/>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="app">* Apellido Paterno</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="app" name="app" class="form-control" type="text" placeholder="Paterno" value="<?php echo $app; ?>"/>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="apm">Apellido Materno</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="apm" name="apm" class="form-control" type="text" placeholder="Materno" value="<?php echo $apm; ?>"/>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="seudonimo">Seudónimo</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="seudonimo" name="seudonimo" class="form-control" type="text" placeholder="Seudónimo" value="<?php echo $seudonimo; ?>"/>
                        </div>
                    </div>
                    <legend>Fecha Nacimiento</legend>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="dia">Día</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="dia" name="dia" class="form-control" type="text" placeholder="Día" value="<?php echo $dia; ?>"/>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Mes</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="mes" class="form-control" name="mes">
                                <option value="00">Seleccione</option>
                                <option value="01">Enero</option>
                                <option value="02">Febrero</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="anio">Año</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="anio" name="anio" class="form-control" type="text" placeholder="Año" value="<?php echo $anio; ?>"/>
                        </div>
                    </div>
                    <legend>Estudios</legend>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Grado académico</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="id_gradoacademico" class="form-control" name="id_gradoacademico">
                                <?php
                                    $consultaga = "SELECT * FROM `c_gradoacademico`";
                                    $resultado = $catalogo->obtenerLista($consultaga);
                                    echo '<option value="">Seleccione</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['id_GradoAcademico'] == $id_gradoacademico) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['id_GradoAcademico'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Institución</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="id_institucion" class="form-control" name="id_institucion" multiple="multiple">
                                <?php
                                    $consultai = "SELECT * FROM `c_institucion`";
                                    $resultado = $catalogo->obtenerLista($consultai);
                                    echo '<option value="">Seleccione</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['Id_institucion'] == $id_institucion) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['Id_institucion'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <legend>Correo Particular</legend>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="correo">Correo</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="correo" name="correo" class="form-control" type="text" placeholder="Correo" value="<?php echo $correo; ?>"/>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="correo_institucional">Correo Institucional</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="correo_institucional" name="correo_institucional" class="form-control" type="text" placeholder="Correo institucional" value="<?php echo $correo_institucional; ?>"/>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Tipo de Teléfono</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="id_tipotel" class="form-control" name="id_tipotel">
                                <?php
                                    $consultatt = "SELECT * FROM `c_tipoTelefonoContacto`";
                                    $resultado = $catalogo->obtenerLista($consultatt);
                                    echo '<option value="">Seleccione</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['id_TelefonoContacto'] == $id_tipotel) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['id_TelefonoContacto'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="numero">Teléfono Contacto</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="numero" name="numero" class="form-control" type="text" placeholder="Telefono Contacto" value="<?php echo $numero; ?>"/>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="ext">Extensión</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="ext" name="ext" class="form-control" type="text" placeholder="Extensión" value="<?php echo $ext; ?>"/>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="rfc">RFC</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="rfc" name="rfc" class="form-control" type="text" placeholder="RFC" value="<?php echo $rfc; ?>"/>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="curp">CURP</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="curp" name="curp" class="form-control" type="text" placeholder="CURP" value="<?php echo $curp; ?>"/>
                        </div>
                    </div>
                    <legend>Dirección</legend>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">País</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="id_pais" class="form-control" name="id_pais" onchange="cargarestado();">
                                <?php
                                //if ($editar == true && $id_pais != "") {
                                    
                                    $consultapais = "SELECT * FROM `c_pais`";
                                    $resultado = $catalogo->obtenerLista($consultapais);
                                    echo '<option value="">Seleccione</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['id_Pais'] == $id_pais) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['id_Pais'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                    }
                               // }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Estado</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="id_estado" class="form-control" name="id_estado" onchange="cargarmunicipio();">
                                <?php
                                if ($editar == true && $id_estado != "") {
                                    echo "IDESTADO: " . $id_estado;
                                    $consultaestado = "SELECT * FROM `c_estado`";
                                    $resultadoe = $catalogo->obtenerLista($consultaestado);
                                    echo '<option value="">Seleccione</option>';
                                    while ($row = mysqli_fetch_array($resultadoe)) {
                                        $s = '';
                                        if ($row['id_Estado'] == $id_estado) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['id_Estado'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Municipio</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="municipio" class="form-control" name="municipio" onchange="cargarcolonia();">
                                <?php
                                if ($editar == true && $municipio != "") {
                                    echo "Municipio: " . $municipio;
                                    $consultaM = "SELECT * FROM `c_municipio`";
                                    $resultado = $catalogo->obtenerLista($consultaM);
                                    echo '<option value="">Seleccione</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['id_Municipio'] == $municipio) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['id_Municipio'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Colonia</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="colonia" class="form-control" name="colonia">
                                <?php
                                if ($editar == true && $colonia != "") {
                                    
                                    $consultaCol = "SELECT * FROM `c_colonia`";
                                    $resultado = $catalogo->obtenerLista($consultaCol);
                                    echo '<option value="">Seleccione</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['id_Colonia'] == $colonia) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['id_Colonia'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="calle">Calle</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="calle" name="calle" class="form-control" type="text" placeholder="Calle" value="<?php echo $calle; ?>"/>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="num_ext">Num. Ext</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="num_ext" name="num_ext" class="form-control" type="text" placeholder="Núm. Ext." value="<?php echo $num_ext; ?>"/>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="num_int">Num. Int</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="num_int" name="num_int" class="form-control" type="text" placeholder="Núm. Int" value="<?php echo $num_int; ?>"/>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="id_ciudad">Ciudad</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="id_ciudad" name="id_ciudad" class="form-control" type="text" placeholder="Ciudad" value="<?php echo $id_ciudad; ?>"/>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="cp">Código Postal</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="cp" name="cp" class="form-control" type="text" placeholder="Código Postal" value="<?php echo $cp; ?>"/>
                        </div>
                    </div>
                    <legend>Otros (Autores de texto)</legend>
                    <div class="row">
                        
                        <div class="form-group form-group-sm">
                            
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="resenia">Reseña curricular</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <textarea name="resenia" id="resenia" cols="38" rows="2" placeholder="Reseña"><?php echo $resenia; ?></textarea>
                                <!-- <input  id="cp" name="cp" class="form-control" type="text" placeholder="Código Postal" value="<?php echo $cp; ?>"/> -->
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="semblanza">Semblanza</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <input  id="semblanza" name="semblanza" class="form-control" type="text" placeholder="Semblanza" value="<?php echo $semblanza; ?>"/>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="ocupacion">Ocupación</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <input  id="ocupacion" name="ocupacion" class="form-control" type="text" placeholder="Ocupacion" value="<?php echo $ocupacion; ?>"/>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Dependencia</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="id_institucionA" class="form-control" name="id_institucionA">
                                <?php
                                    $consultai = "SELECT * FROM `c_institucion` ORDER BY Nombre";
                                    $resultado = $catalogo->obtenerLista($consultai);
                                    echo '<option value="">Seleccione</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['Id_institucion'] == $id_institucionA) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['Id_institucion'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <div class="col-md-2 col-sm-2 col-xs-2">
                  
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <button type="button" class="btn btn-default btn-xs" id="guardar">Guardar</button>
                            <button type="button" class="btn btn-default btn-xs" id="back">Regresar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    var back = document.getElementById('back'); // Suponiendo que la identificación del elemento del botón de retorno está de vuelta
    back.onclick = function() {
        history.back(); // Regresa a la página anterior, también se puede escribir como history.go (-1)
    };
</script>