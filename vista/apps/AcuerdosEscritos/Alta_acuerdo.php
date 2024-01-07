<?php
//Aplicacion modificada por : Jose carlos 19/08/2021 //
//clases que usa el formulario
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once('../../../WEB-INF/Classes/AcuerdoEscrito.class.php');
include_once('../../../WEB-INF/Classes/ActividadAcuerdo.class.php');
include_once('../../../WEB-INF/Classes/AreaAcuerdo.class.php');
$catalogo = new Catalogo();
$acuerdo = new documento();
//variables del formulario
date_default_timezone_set('America/Mexico_City');
$zonahoraria = date_default_timezone_get();


$editar = false;
$añoactual = date("Y");
$tipoPerfil = $_GET["tipoPerfil"];
$nombreUsuario = $_GET["nombreUsuario"];
$idUsuario = $_GET["idUsuario"];
$periodo_actual = $acuerdo->PeriodoActual($añoactual);
$periodo2 = "";
$descripcion = "";
$estatus = "";
$fecha_convoca = "";
$fecha_realiza = "";
$categoria = "";
$subcategoria = "";
$eje = "";
$PDF = "";
$PDFid = "";
$exposicion = "";
$idacuerdo = "";
$contadorac = 0;
$contadorar = 0;
$contadorperiodoeje = "";
$Actividad = "";
$check = "";
$Subcheck = "";
$acuerdoestatus = "";
$usuario = "";
$area = "";
$tipo = "";
$mostrarres = "";
$responsableacuerdo = "";
$url = "./Lista_acuerdos.php?tipoPerfil=$tipoPerfil&nombreUsuario=SinUsr&idUsuario=$idUsuario";

$periodoFiltro = "";
$indicadorFiltro = "";

//147 id de rol de resposable de acuerdo
$portada = isset($_GET['portada']) ? $_GET['portada'] : false;
$tipo_acuerdo = isset($_GET['tipo_acuerdo']) ? $_GET['tipo_acuerdo'] : false;
$ejeid = isset($_GET['ejeid']) ? $_GET['ejeid'] : false;

$acuerdo_actividad_id = isset($_GET['id']) ? $_GET['id'] : false;

if (isset($_GET['accion']) && $_GET['accion'] != "") {
    if ($_GET['accion'] == "eliminar") {
        $eliminar_query = "DELETE FROM c_acuerdospdf WHERE id_acuerdo_escrito = $acuerdo_actividad_id";
        $res = $catalogo->ejecutaConsultaActualizacion($eliminar_query, "c_acuerdospdf", "id_acuerdo_escrito = " . $acuerdo_actividad_id);
        header("Location:Lista_acuerdos.php");
    }
    echo '<input type="hidden" id="accion" name="accion" value="' . $_GET['accion'] . '" />';
    echo '<input type="hidden" id="tipoPerfil" name="tipoPerfil" value="' . $_GET['tipoPerfil'] . '"/>';
    echo '<input type="hidden" id="nombreUsuario" name="nombreUsuario" value="' . $_GET['nombreUsuario'] . '"/>';
    echo '<input type="hidden" id="idUsuario" name="idUsuario" value="' . $_GET['idUsuario'] . '"/>';

    echo '<input type="hidden" id="portada" name="portada" value="' . $portada . '"/>';
    echo '<input type="hidden" id="tipo_acuerdo" name="tipo_acuerdo" value="' . $tipo_acuerdo . '"/>';
    echo '<input type="hidden" id="ejeid" name="ejeid" value="' . $ejeid . '"/>';

    if ($_GET['accion'] == "editar") {
        $editar = true;
        echo '<input type="hidden" id="id" name="id" value="' . $_GET['id'] . '"/>';
    } else {
        echo '<input type="hidden" id="id" name="id" value="0"/>';
    }
}

if ($editar == true) {
    $acuerdo->setId_acuerdo_escrito($_GET['id']);
    $objAcuerdoEscrito = new actividades();
    $idacuerdo = $_GET['id'];
    $acuerdo->getAcuerdo($_GET['id']);
    $periodo2 = $acuerdo->getAnio();
    $tipo = $acuerdo->getId_tipo();
    $area = $acuerdo->getId_area();
    $usuario = $acuerdo->getId_usuario();
    $descripcion = $acuerdo->getDescripcion();
    $contadorac = $acuerdo->getId_destino();
   //echo "contador : " . $contadorac;
    $contadorar = $acuerdo->getId_destino2();
    $fecha_convoca = $acuerdo->getFecha_convocado();
    $fecha_realiza = $acuerdo->getFecha_realizado();
    $PDF = $acuerdo->getPdfcedulafiscal();
    $PDFid = $acuerdo->getPdfid();
    $estatus = $acuerdo->getEstatus();
    $objAcuerdoEscrito->setId_acuerdo($_GET['id']);
    $tituloStatus = "";
    if(isset($_GET['ejeidTodos'])){
       
        #AÑOS 
        if ($_GET['ejeañoTodos'] != "Todos"){
           $filtroAnio = " an.Periodo =" . $_GET['ejeañoTodos'];      
           
           if ($_GET['ejeidTodos'] != "todos"){
              if($_GET['indicador'] == "receptor"){
                  $filtroEje = " and ka.id_persona =" . $_GET['ejeidTodos'];
              }else if ($_GET['indicador'] == "emisor") {
                  $filtroEje = " and ca.id_usuario =" . $_GET['ejeidTodos'];
              }else if ($_GET['indicador'] == "acuerdo") {
                  $filtroEje = " and ka.TipoAcuerdo =" . " '" . $_GET['ejeidTodos'] . "'";
              }else if ($_GET['indicador'] == "documento") {
                  $filtroEje = " and ka.id_tipo =" . $_GET['ejeidTodos'];
              } else if ($_GET['indicador'] == "anio") {
                $filtroEje = " an.Id_Periodo = " . $_GET['ejeidTodos'];
              }else if ($_GET['indicador'] == "expo") {
                $filtroEje = " and ka.id_exposicion = " . $_GET['ejeidTodos'];
              } else if ($_GET['indicador'] == "areas") {
                $filtroEje = " and ca.id_area = " . $_GET['ejeidTodos'];
              } else {
                  $filtroEje = " and ka.id_proyecto =" . $_GET['ejeidTodos'];
              }
            
           }else {
               $filtroEje = "";
           }

        }else {
            $filtroAnio = "";

            if ($_GET['ejeidTodos'] != "todos"){
                if($_GET['indicador'] == "receptor"){
                    $filtroEje = " and ka.id_persona =" . $_GET['ejeidTodos'];
                }else if ($_GET['indicador'] == "emisor") {
                    $filtroEje = " and ca.id_usuario =" . $_GET['ejeidTodos'];
                }else if ($_GET['indicador'] == "acuerdo") {
                    $filtroEje = " and ka.TipoAcuerdo =" . " '" . $_GET['ejeidTodos'] . "'";
                }else if ($_GET['indicador'] == "documento") {
                    $filtroEje = " and ka.id_tipo =" . $_GET['ejeidTodos'];
                } else if ($_GET['indicador'] == "anio") {
                  $filtroEje = " an.Id_Periodo = " . $_GET['ejeidTodos'];
                }else if ($_GET['indicador'] == "expo") {
                  $filtroEje = " and ka.id_exposicion = " . $_GET['ejeidTodos'];
                } else if ($_GET['indicador'] == "areas") {
                    $filtroEje = " ca.id_area = " . $_GET['ejeidTodos'];
                } else{
                    $filtroEje = " ka.id_proyecto =" . $_GET['ejeidTodos'];
                }
              
             }else {
                 $filtroEje = "";
             }
        }

        $objAcuerdoEscrito->setejeidTodos($filtroEje);
        $objAcuerdoEscrito->setejeanioTodos($filtroAnio);
        if($_GET['varFiltro'] == "todos"){
            $resultAcuerdoActividad = $objAcuerdoEscrito->getActividadesTodos();
            $resultAcuerdoActividad2 = $objAcuerdoEscrito->getActividadesTodos();
        } else {
            $statusFiltro = "";
            if($_GET['varFiltro'] == "realizado")
            {
                $statusFiltro = "2";
                $tituloStatus = " con status realizado";
            }
            if($_GET['varFiltro'] == "enproceso")
            {
                $statusFiltro = "1";
                $tituloStatus = " con status en proceso";
            }
            if($_GET['varFiltro'] == "atendido")
            {
                $statusFiltro = "4";
                $tituloStatus = " con status atendido";
            }
            if($_GET['varFiltro'] == "cancelado")
            {
                $statusFiltro = "3";
                $tituloStatus = " con status cancelado";
            }
            if($_GET['varFiltro'] == "sinrealizar")
            {
                $statusFiltro = "5";
                $tituloStatus = " con status sin realizar";
            }
            if($_GET['varFiltro'] == "norealizado")
            {
                $statusFiltro = "6";
                $tituloStatus = " sin realizar";
            }

            $objAcuerdoEscrito->setfiltroTodos($statusFiltro);
            $resultAcuerdoActividad = $objAcuerdoEscrito->getActividadesTodosFiltro();
            $resultAcuerdoActividad2 = $objAcuerdoEscrito->getActividadesTodosFiltro();
        }
        $datosAcuerdos = mysqli_fetch_array($resultAcuerdoActividad2);

        #titulos de acuerdos 
        if($_GET['indicador'] == "receptor"){
            $tituloTipoFiltro = "de " . $datosAcuerdos['nombre'];
        }else if ($_GET['indicador'] == "emisor") {
            $tituloTipoFiltro = "emitidos por " . $datosAcuerdos['nombre'];
        }else if ($_GET['indicador'] == "acuerdo") {
            $tituloTipoFiltro = "del Tipo acuerdo " . $_GET['ejeidTodos'];
        } else if ($_GET['indicador'] == "documento"){
            if($_GET['ejeidTodos'] == "1") {
                $nombreDocumento = "Acuerdo Interno";
            }else{
                $nombreDocumento = "Acuerdo Externo";
            }
            $tituloTipoFiltro = "del Tipo documento " . $nombreDocumento;
        } else if ($_GET['indicador'] == "anio") {
            $tituloTipoFiltro = "del año " . $_GET['ejeidTodos'];
        } else if ($_GET['indicador'] == "expo") {
            $tituloTipoFiltro = "de la exposición " . $_GET['ejeidTodos'];
        } else if ($_GET['indicador'] == "areas") {
            $tituloTipoFiltro = "del área " . $_GET['ejeidTodos'];
        } else{
            $tituloTipoFiltro = "del eje " . $_GET['ejeidTodos'];
        }
        
    }else {
        $resultAcuerdoActividad = $objAcuerdoEscrito->getActividades();
    }
    $totalAcuerdos = mysqli_num_rows($resultAcuerdoActividad);
    echo '<input type="hidden" id="ons" name="ons" value="' . $estatus . '"/>';


    $count = 0;

    $validafirmasexisten = "SELECT firma FROM k_acuerdoarea WHERE id_Acuerdo=$idacuerdo";
    //echo $validafirmasexisten;
    $resulvalida = $catalogo->obtenerLista($validafirmasexisten);
    while ($row = mysqli_fetch_array($resulvalida)) {
        //echo $row['firma']."<br>";
        if ($row['firma'] == "") {
            //echo "<br>faltan";
        } else {
            //echo "<br>esta lleno";
            $count++;
            $validallenadopdf = "SELECT count(*) as total FROM k_acuerdoarea WHERE id_Acuerdo=$idacuerdo";
            $resul = $catalogo->obtenerLista($validallenadopdf);
            while ($row = mysqli_fetch_array($resul)) {
                $totalregistros = $row['total'];
            }
            //echo $totalregistros;
            if ($count == $totalregistros) {
                //echo "No se puede editar ya esta firmado";
                echo '<head>';
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                echo '</head>';
                //echo '<script language="javascript">alert("No se puede editar porque ya está firmado");</script>';
?>
                <script type="text/javascript">
                    function mostrar() {
                        Swal.fire({
                            icon: 'error',
                            title: 'No se puede editar porque ya está firmado el acuerdo',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(function() {
                            <?php
                            echo 'window.location.replace("' . $url . '")';
                            ?>
                        });
                    }
                    <?php
                    echo 'mostrar();';
                    ?>
                </script>
<?php
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <title>::.FORMULARIO ACUERDO ESCRITO.::</title>

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
    <script src="./Acciones_acuerdo.js"></script>
    <script src="./Alta_acuerdo.js"></script>
    <script src="libreria/ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Aplicaciones</a> /
        <a style="color:#fefefe;" href="Vista.php?usuario=<?php echo $nombreUsuario; ?>&nombreUsuario=<?= $nombreUsuario ?>&tipoPerfil=<?= $tipoPerfil ?>&idUsuario=<?= $idUsuario ?>">Acuerdos</a> /
        <a style="color:#fefefe;" href="Vista.php?usuario=<?php echo $nombreUsuario; ?>&nombreUsuario=<?= $nombreUsuario ?>&tipoPerfil=<?= $tipoPerfil ?>&idUsuario=<?= $idUsuario ?>">Indicadores</a> /
        <a style="color:#fefefe; cursor: pointer;" href="Lista_acuerdos.php?nombreUsuario=<?= $nombreUsuario ?>&tipoPerfil=<?= $tipoPerfil ?>&idUsuario=<?= $idUsuario ?>">Lista Acuerdos</a> /
       <!-- <a style="color:#fefefe; cursor: pointer;" href="Acuerdosfocos.php?usuario=<?php echo $nombreUsuario; ?>&nombreUsuario=<?= $nombreUsuario ?>&tipoPerfil=<?= $tipoPerfil ?>&idUsuario=<?= $idUsuario ?>">Focos</a> / -->
    <!--   <a style="color: #fbff00;text-decoration: underline;" href="javascript:window.location.reload(true)">Acuerdo Nuevo 1</a> -->
        <a style="color:#fefefe; cursor: pointer;" href="Alta_acuerdo.php?accion=guardar&tipoPerfil=1&nombreUsuario=<?= $nombreUsuario ?>&idUsuario=<?= $idUsuario ?>&tipoPerfil=<?= $tipoPerfil ?>;">Acuerdo Nuevo</a> 
        <a class="fa fa-undo" style="color:#fefefe; position: absolute;right: 21px;cursor:pointer;" href="Vista.php?usuario=<?php echo $nombreUsuario; ?>&nombreUsuario=<?= $nombreUsuario ?>&tipoPerfil=<?= $tipoPerfil ?>&idUsuario=<?= $idUsuario ?>"></a>
      <!--   <i onclick="history.back()" data-toggle="tooltip" data-placement="bottom" title="" style="position: absolute;right: 21px;cursor:pointer;" class="fa fa-undo" aria-hidden="true" data-original-title="Regresar"></i> -->
    </div>
    <div class="well2 wr">
                    <?php 
                    if(isset($_GET['varFiltro'])) {
                        
                        echo '<p style="color:#fefefe;"> Se muestran <STRONG style="color: #8dc9f9; font-size: 11px;">'. $totalAcuerdos .'</STRONG> Acuerdos '.$tituloTipoFiltro. $tituloStatus.'</p>';
                    }    
                   // echo "id : " . $idUsuario;
                   // echo "nombre: " . $nombreUsuario;  
                   $consultapersonas = "SELECT distinct p.id_Personas, CONCAT(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno)as nombre, usr.IdUsuario as id
                                FROM c_personas as p
                                JOIN c_rolPersona rp ON p.id_Personas=rp.id_Persona
                                JOIN c_usuario usr ON usr.IdPersona = p.id_Personas
                                WHERE rp.id_Rol=141 and usr.IdUsuario = '$idUsuario'
                                ORDER BY nombre";
                                $resulpersona = $catalogo->obtenerLista($consultapersonas);

                                if (mysqli_num_rows($resulpersona) > 0) {
                                    $emisorLogin = "1";
                                } else {
                                    $emisorLogin = "0";
                                }            
                    ?>        
    </div>
    <div id="container">
        <form class="form-horizontal" id="formAcuerdoEscrito" name="formAcuerdoEscrito">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php 
                    if(isset($_GET['varFiltro'])) {

                    }else {                    
                    ?>
                    <div class="form-group form-group-sm">
                        <!-- zeus-->
                        <!-- <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">* Temas generales numerados:</label> -->
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion" style="font-size: 11px;">* Temas de la reunión: </label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" style="height: 100px; width: 630px; font-size: 11px;" maxlength="1000"><?php echo $descripcion; ?></textarea>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4" style="display: none">
                            <div class="custom-control custom-checkbox" style="display: none">
                                <?php
                                if ($editar == true && $estatus == 0) {
                                    echo '<input type="checkbox" class="custom-control-input" id="realizado" name="realizado">';
                                } elseif ($editar == true && $estatus == 1) {
                                    echo '<input type="checkbox" class="custom-control-input" id="realizado" name="realizado" checked="">';
                                } else {
                                    echo '<input type="checkbox" class="custom-control-input" id="realizado" name="realizado">';
                                }
                                ?>
                                <label class="custom-control-label" for="realizado">Realizado:</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm" style="margin-top: -12px;">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">* Periodo:</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="ano" class="form-control" name="ano" style="width: 280px; font-size: 11px;" onchange="Categorias();actividades1();Categorias(0);actividades1(0);Categorias(1);actividades1(1);Categorias(2);actividades1(2);Categorias(3);actividades1(3);Categorias(4);actividades1(4);Categorias(5);actividades1(5);Categorias(6);actividades1(6);Categorias(7);actividades1(7);Categorias(8);actividades1(8);Categorias(9);actividades1(9);Categorias(10);actividades1(10);Categorias(11);actividades1(11);Categorias(12);actividades1(12);Categorias(13);actividades1(13);Categorias(14);actividades1(14);Categorias(15);actividades1(15);Categorias(16);actividades1(16);Categorias(17);actividades1(17);Categorias(18);actividades1(18);Categorias(19);actividades1(19);Categorias(20);actividades1(20);Categorias(21);actividades1(21);Categorias(22);actividades1(22);Categorias(23);actividades1(23);Categorias(24);actividades1(24);Categorias(25);actividades1(25);Categorias(26);actividades1(26);Categorias(27);actividades1(27);Categorias(28);actividades1(28);Categorias(29);actividades1(29);Categorias(30);actividades1(30);Categorias(31);actividades1(31);Categorias(32);actividades1(32);Categorias(33);actividades1(33);Categorias(34);actividades1(34);Categorias(35);actividades1(35);Categorias(36);actividades1(36);Categorias(37);actividades1(37);Categorias(38);actividades1(38);Categorias(39);actividades1(39);Categorias(40);actividades1(40);Categorias(41);actividades1(41);Categorias(42);actividades1(42);Categorias(43);actividades1(43);Categorias(44);actividades1(44);Categorias(45);actividades1(45);Categorias(46);actividades1(46);Categorias(47);actividades1(47);Categorias(48);actividades1(48);Categorias(49);actividades1(49);Categorias(50);actividades1(50);">
                                <option value="">Seleccione</option>
                                <?php
                                $Ano = "SELECT p.Id_Periodo,p.Periodo FROM c_periodo as p WHERE p.CPE_ESTATUS=1 and Periodo>2019 ORDER BY p.Periodo DESC";
                                $resulaño = $catalogo->obtenerLista($Ano);
                                while ($row = mysqli_fetch_array($resulaño)) {
                                    if ($periodo2 == $row['Id_Periodo'] && $editar == true) {
                                        $selected = "selected";
                                    } else if ($periodo_actual == $row['Id_Periodo'] && $editar == false) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option value='" . $row['Id_Periodo'] . "' " . $selected . ">" . $row['Periodo'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="Fechac" style="font-size: 11px; ">* Fecha convoca:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <input id="fechac" name="fechac" type="date" style="width: 170px;" class="form-control" style="font-size: 11px; " value="<?php echo $fecha_convoca; ?>">
                        </div>
                        <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="Fechar" style="display: none; font-size: 11px;"> Fecha realizado:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3" style="display: none">
                            <input id="fechaf" name="fechaf" type="date" style="width: 155px;" class="form-control" value="<?php echo $fecha_realiza; ?>">
                        </div>
                    </div>
                    <div class="form-group form-group-sm" style="margin-top: -12px;">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">* Emisor del acuerdo:</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="persona" class="form-control" name="persona" style="width: 280px; font-size: 11px;">
                                <option value="">Seleccione</option>
                                <?php
                               $usuarioLogin = $idUsuario;
                               $PersonaAcuerdo = $usuario;
                              echo "consulta : " . $consultapersonas = "SELECT distinct p.id_Personas, CONCAT(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno)as nombre, usr.IdUsuario as id
                                FROM c_personas as p
                                JOIN c_rolPersona rp ON p.id_Personas=rp.id_Persona
                                JOIN c_usuario usr ON usr.IdPersona = p.id_Personas
                                WHERE usr.IdUsuario = '$usuarioLogin'
                                ORDER BY nombre";
                                $resulpersona = $catalogo->obtenerLista($consultapersonas);
                                $row = mysqli_fetch_array($resulpersona);
                                $personaLogin = $row['id_Personas'];

                                if ($personaLogin == $PersonaAcuerdo) {
                                    $emisorLogin = "1";
                                } else {
                                    $emisorLogin = "0";
                                }
                              
                                $consultapersonas = "SELECT distinct p.id_Personas, CONCAT(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno)as nombre
                                FROM c_personas as p
                                JOIN c_rolPersona rp ON p.id_Personas=rp.id_Persona
                                WHERE rp.id_Rol=141 
                                ORDER BY nombre";
                                $resulpersona = $catalogo->obtenerLista($consultapersonas);
                                while ($row = mysqli_fetch_array($resulpersona)) {
                                    if ($usuario == $row['id_Personas']) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }

                                    echo "usuario : " . $usuario;
                                    echo "id : " . $_GET['id'];

                                    if($emisorLogin == "1") {
                                        echo "<option value='" . $row['id_Personas'] . "' " . $selected . ">" . $row['nombre'] . "</option>";
                                    } else {
                                        if ($usuario == $row['id_Personas']) {
                                            echo "<option value='" . $row['id_Personas'] . "' " . $selected . ">" . $row['nombre'] . "</option>";
                                        }elseif($usuario == ""){
                                            echo "<option value='" . $row['id_Personas'] . "' " . $selected . ">" . $row['nombre'] . "</option>";
                                        }
                                    }                                
                                }
                                ?>
                            </select>
                        </div>
                       <!-- <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="Fechacom" style="font-size: 11px; ">* Fecha compromiso:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <input id="fechacom" name="fechacom" type="date" style="width: 170px;" class="form-control" style="font-size: 11px; " value="<?php echo $fecha_convoca; ?>">
                        </div> -->
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="display:none">* Área que convoca:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3" style="display:none">
                            <select id="area" class="form-control" name="area" onchange="" style="width: 170px; ">
                                <?php
                                if ($editar == false) {
                                    $consultaperiodo = "SELECT Id_Area,Nombre FROM c_area WHERE tipoArea=1 AND estatus=1 and Id_Area=5 ORDER BY Nombre";
                                    $resultado = $catalogo->obtenerLista($consultaperiodo);
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['Id_Area'] == $area) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['Id_Area'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                    }
                                } else {
                                    $consultaperiodonuevo = "SELECT distinct a.Id_Area,a.Nombre FROM c_personas as p
                                JOIN c_area a ON a.Id_Area=p.idArea
                                WHERE a.tipoArea=1 AND a.estatus=1 AND p.id_Personas=" . $usuario;
                                    $resultadonuevo = $catalogo->obtenerLista($consultaperiodonuevo);
                                    while ($rownuevo = mysqli_fetch_array($resultadonuevo)) {
                                        $s = '';
                                        if ($rownuevo['Id_Area'] == $area) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $rownuevo['Id_Area'] . '" ' . $s . '>' . $rownuevo['Nombre'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <!--<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Categoría del acuerdo:</label>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <select id="categoria" class="form-control" name="categoria" style="width: 155px;">
                                <?php
                                /*$consultaperiodo2 = "SELECT d.id_tipo,d.tipo FROM c_tipo_documento as d WHERE d.id_tipo <=2";
                                $resultado88 = $catalogo->obtenerLista($consultaperiodo2);
                                echo '<option value="">Seleccione una opción</option>';
                                while ($row = mysqli_fetch_array($resultado88)) {
                                    $s = '';
                                    if ($row['id_tipo'] == $tipo) {
                                        $s = 'selected="selected"';
                                    }
                                    echo '<option value="' . $row['id_tipo'] . '" ' . $s . '>' . $row['tipo'] . '</option>';
                                }*/
                                ?>
                            </select>
                        </div>-->
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px; font-size: 11px;">* Categoría del acuerdo:</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select id="categoria" class="form-control" name="categoria" style="width: 170px; font-size: 11px;">
                                <?php
                                $consultaperiodo2 = "SELECT d.id_tipo,d.tipo FROM c_tipo_documento as d WHERE d.id_tipo <=2";
                                $resultado88 = $catalogo->obtenerLista($consultaperiodo2);
                                echo '<option value="">Seleccione</option>';
                                while ($row = mysqli_fetch_array($resultado88)) {
                                    $s = '';
                                    if ($row['id_tipo'] == $tipo) {
                                        $s = 'selected="selected"';
                                    }
                                    echo '<option value="' . $row['id_tipo'] . '" ' . $s . '>' . $row['tipo'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm" style="margin-top: -12px;">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="imagen" style="font-size: 11px;"> PDF</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input type="file" id="pdf" name="pdf" class="form-control" accept=".pdf" style="width: 280px; font-size: 11px;" />
                            <?php
                            if ($editar == true && $PDF != "") {
                                if ($PDF == "") {
                                } else {
                                    $ruta = '../../../resources/aplicaciones/PDF/AcuerdosEscritos/' . $PDF;
                                    echo '<a target="_blank" href="' . $ruta . '" ><i class="glyphicon glyphicon-file"></i> PDF Subido</a>';
                                }
                            }
                            if ($editar == true && $PDFid != "") {
                    
                                $ruta = 'Acuerdopdf.php?nombreUsuario=' . $nombreUsuario . '&idUsuario=' . $idUsuario . '&IDacuerdoedit=' . $idacuerdo;
                                echo ' <a href="' . $ruta . '" ><i class="glyphicon glyphicon-file"></i> PDF Creado</a>';
                            }
                            ?>
                        </div>
                        <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO"><button id="mas" name="mas" type="button" class="btn btn-xs" onclick="nuevaactividad();CKnuevo();"><i class="glyphicon glyphicon-plus"> Nuevo Acuerdo</i></button></label>
                    </div>
                   
                    <div class="form-group form-group-sm" style="margin-top: -12px;">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">Invitar a:</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="invA" class="form-control form-control-sm mx-0 px-0 w-50" style="display:inline-block;">
                                <?php
                                $consultaperiodo = "SELECT Id_Area,Nombre FROM c_area WHERE tipoArea=1 AND estatus=1 ORDER BY Nombre";
                                $resultado = $catalogo->obtenerLista($consultaperiodo);
                                echo ' <option value = "">Seleccione</option>';
                                while ($row = mysqli_fetch_array($resultado)) {
                                    $s = '';
                                    echo '<option value = "' . $row['Id_Area'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                }
                                ?>
                            </select>
                            <button id="agregarAreas" type="button" class="btn btn-info btn-sm" onclick="invarea();"><i class="glyphicon glyphicon-plus-sign"></i></button>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2" id="involucrados">
                            <?php
                            if ($editar == TRUE) {
                                $contador = 0;
                                $consultaareasin = "SELECT acu.id_Acuerdo as id_Acuerdo,acu.id_Acuerdo_area,acu.id_Area_invitada,a.Nombre, acu.firma FROM k_acuerdoarea AS acu INNER JOIN c_area as a on a.Id_Area=acu.id_Area_invitada WHERE acu.id_Acuerdo =$idacuerdo";
                                $resultadoarea = $catalogo->obtenerLista($consultaareasin);
                                while ($row = mysqli_fetch_array($resultadoarea)) {
                                    if($row["firma"] != ""){
                                        echo '<span style="background-color: green;" id = "areaI' . $row["id_Area_invitada"] . '"class = "badge badge-dark disable-select"><a style="color:#ffffff;" href="firma.php?areainvitada=' . $row["id_Area_invitada"] . '&idacuerdo=' . $idacuerdo . '&tipoPerfil=' . $tipoPerfil . '&idUsuario=' . $idUsuario . '">' . $row["Nombre"] . " (FIRMADO)".'</a> <i class = "glyphicon glyphicon-remove" onclick = "eliminarArea(' . $row["id_Area_invitada"] . ',' . $row["id_Acuerdo"] . ');" style = "font-size:9px;"></i></span>';
                                        echo '<input id = "invA' . $row["id_Area_invitada"] . '" name = "invitados' . $contador . '" value = "' . $row["id_Area_invitada"] . '" type = "hidden">';
                                    } else {
                                        echo '<span style="background-color: red;" id = "areaI' . $row["id_Area_invitada"] . '"class = "badge badge-dark disable-select"><a style="color:#ffffff;" href="firma.php?areainvitada=' . $row["id_Area_invitada"] . '&idacuerdo=' . $idacuerdo . '&tipoPerfil=' . $tipoPerfil . '&idUsuario=' . $idUsuario . '">' . $row["Nombre"] . " (FIRMAR AQUI)".'</a> <i class = "glyphicon glyphicon-remove" onclick = "eliminarArea(' . $row["id_Area_invitada"] . ',' . $row["id_Acuerdo"] . ');" style = "font-size:9px;"></i></span>';
                                        echo '<input id = "invA' . $row["id_Area_invitada"] . '" name = "invitados' . $contador . '" value = "' . $row["id_Area_invitada"] . '" type = "hidden">';
                                    }
                                    
                                    $contador++;
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group form-group-sm" style="margin-top: -12px;">
                         <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="imagen" style="font-size: 11px;"></label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                         <?php 
                              if(isset($_GET['ejeidTodos'])) {

                              }else {

                                if ($editar == true) {
                             ?>
                             
                                 <button type="button" class="btn btn-default btn-xs" id="guardar" onClick="CKupdate();">Guardar reunión</button> 
                                 <?php 
                                }
                            }
                            ?>
                         <?php 
                         }
                         ?>
                     </div>
                    </div>
                   
                    <?php if ($editar == true) {
                        $indice = 0;
                        $numerodeacuerodos = 1;
                        $IdProyecto = 0;
                        $IdExposición = 0;
                        $IdTipoConcepto = 0;
                        $IdGlobal = 0;
                        $IdGeneral = 0;
                        $Id_categoria = 0;
                        $Id_subcategoria = 0;
                        $Descripcion_acuerdo = 0;
                        $Tipo_acuerdo = 0;
                        $estatus = 0;
                        $Check = 0;
                        $Subcheck = 0;
                        $acuerdoestatus = 0;
                        $acuerdoestatus = 0;
                        $responsableacuerdo = 0;
                        $firmaReceptor = "0";
                       // $totalAcuerdos = mysqli_num_rows($resultAcuerdoActividad);
                       // echo "total acuerdos: ".  $totalAcuerdos;
                        while ($rowAcuerdoActividad = mysqli_fetch_array($resultAcuerdoActividad)) {
                            
                            $Ideditar = $rowAcuerdoActividad['id_acuerdoactividad'];
                            $IdProyecto = $rowAcuerdoActividad['id_proyecto'];
                            $IdExposición = $rowAcuerdoActividad['id_exposicion'];
                            $IdTipoConcepto = $rowAcuerdoActividad['id_tipo'];
                            $IdGlobal = $rowAcuerdoActividad['id_actividad1'];
                            $IdGeneral = $rowAcuerdoActividad['id_actividad2'];
                            $IdParticular = $rowAcuerdoActividad['id_actividad3'];
                            $IdSubActividad = $rowAcuerdoActividad['id_actividad4'];
                            $resdsd = $rowAcuerdoActividad['resolucion'];
                            $Id_categoria = $rowAcuerdoActividad['id_categoria'];
                            $Id_subcategoria = $rowAcuerdoActividad['id_subcategoria'];
                            $Descripcion_acuerdo = $rowAcuerdoActividad['DescAcuerdo'];
                            $Tipo_acuerdo = $rowAcuerdoActividad['TipoAcuerdo'];
                            $estatus = $rowAcuerdoActividad['estatus'];
                            $Check = $rowAcuerdoActividad['Id_check'];
                            $Subcheck = $rowAcuerdoActividad['subcheck'];
                            $acuerdoestatus = $rowAcuerdoActividad['Id_acuerdoestatus'];
                            $responsableacuerdo = $rowAcuerdoActividad['Id_persona'];
                            $idReunion = $rowAcuerdoActividad['id_acuerdo'];
                            $fechacompromiso = $rowAcuerdoActividad['fechacompromiso'];
                            $firmaReceptor = $rowAcuerdoActividad['firma'];
                            if ($IdGeneral > 0) {
                                $Actividad = $IdGeneral;
                            } else {
                                $Actividad = $IdGlobal;
                            }
                    ?>
                            <script type="text/javascript">
                                function visualizar(indice) {
                                    var x = document.getElementById("escondervisualizar8" + indice);
                                    var x1 = document.getElementById("escondervisualizar1" + indice);
                                    var x2 = document.getElementById("escondervisualizar2" + indice);
                                   // var x3 = document.getElementById("escondervisualizar3" + indice);
                                    var x4 = document.getElementById("escondervisualizar4" + indice);
                                    var x5 = document.getElementById("escondervisualizar5" + indice);
                                    var x6 = document.getElementById("escondervisualizar6" + indice);
                                    var x7 = document.getElementById("escondervisualizar7" + indice);
                                    var x8 = document.getElementById("escondervisualizarboton" + indice);
                                    //var x8 = document.getElementById("escondervisualizar8"+indice);
                                    if (x.style.display === "none") {
                                        x.style.display = "block";
                                        x1.style.display = "block";
                                        x2.style.display = "block";
                                      //  x3.style.display = "block";
                                        x4.style.display = "block";
                                        x5.style.display = "block";
                                        x6.style.display = "block";
                                        x7.style.display = "block";
                                        x8.style.display = "block";
                                    } else {
                                        x.style.display = "none";
                                        x1.style.display = "none";
                                        x2.style.display = "none";
                                      //  x3.style.display = "none";
                                        x4.style.display = "none";
                                        x5.style.display = "none";
                                        x6.style.display = "none";
                                        x7.style.display = "none";
                                        x8.style.display = "none";
                                    }
                                }
                            </script>
                            <hr style="display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0; border-top: 1px solid black;">
                            <?php 
                             if(isset($_GET['varFiltro'])){
                              $consultareunion = "SELECT ar.id_usuario, CONCAT(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno)as nombre, ar.fecha_convocado, anio FROM c_acuerdospdf ar 
                                                  LEFT JOIN c_personas p ON p.id_Personas = ar.id_usuario
                                                  WHERE ar.id_acuerdo_escrito = " . $idReunion;
                                                    $resulreunion = $catalogo->obtenerLista($consultareunion);
                                                    $datosReunion = mysqli_fetch_array($resulreunion);
                                                    $usuario = $datosReunion['id_usuario'];

                             
                            
                            ?>
                            <div class="form-group form-group-sm" style="margin-top: -12px;">
                                <label class="col-md-6 col-sm-6 col-xs-6  control-label" for="AÑO" style="width: 300px; font-size: 11px;" >Emisor del acuerdo: <?php echo $datosReunion['nombre']; ?></label>
                                <label class="col-md-6 col-sm-6 col-xs-6  control-label" for="AÑO" style="width: 190px; font-size: 11px;" >Fecha convoca: <?php echo $datosReunion['fecha_convocado']; ?></label>
                                <input type="hidden" id="anioIndicador<?php echo $indice; ?>" name="anioIndicador<?php echo $indice; ?>" value="<?php echo $datosReunion['anio']; ?>" />

                            </div>
                            <?php 
                            }
                            ?>
                            <div class="form-group form-group-sm">
                                <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO" style="width: 110px; color: #2196F3;font-size: 9px;"><button id="mas" name="mas" type="button" class="btn btn-xs" onclick="eliminaractividadedit(<?php echo $rowAcuerdoActividad['id_acuerdoactividad']; ?>)"><i class="glyphicon glyphicon-trash"></i></button> Acuerdo <?php echo $numerodeacuerodos; ?></label>
                                <?php 
                                if(isset($_GET['ejeidTodos'])) {

                                ?>
                                 <button type="button" class="btn btn-default btn-xs" onclick="visualizar(<?php echo $indice; ?>)">Editar</button>
                                <?php
                                }else {

                                ?>
                                <button type="button" class="btn btn-default btn-xs" onclick="visualizar(<?php echo $indice; ?>)">Editar</button>
                               <?php 
                               }
                               ?>
                               <FONT SIZE=1><?php
                                                if ($IdGeneral == "") {
                                                    $consulparamostar = "SELECT a.IdActividad, CONCAT(a.Numeracion,a.Nombre) actividad FROM c_actividad a WHERE a.IdEje=$IdProyecto AND a.IdNivelActividad=1 AND IdTipoActividad=$IdTipoConcepto and a.IdActividad=$IdGlobal ORDER BY a.Orden";
                                                    //echo $consulparamostar;
                                                    $resultadomostar = $catalogo->obtenerLista($consulparamostar);
                                                    while ($rowmostrar = mysqli_fetch_array($resultadomostar)) {
                                                        echo " <b>Global:</b>" . $rowmostrar['actividad'] . "     ";
                                                    }
                                                } else {
                                                    $consultamostrarglobal = "SELECT a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad
                                        FROM c_actividad a
                                        WHERE a.IdEje = $IdProyecto AND a.IdNivelActividad = 2 AND a.IdTipoActividad = $IdTipoConcepto AND a.IdActividad=$IdGeneral
                                        ORDER BY a.Orden";
                                                    $resultadomostar1 = $catalogo->obtenerLista($consultamostrarglobal);
                                                    while ($rowmostrar1 = mysqli_fetch_array($resultadomostar1)) {
                                                        echo " <b>General:</b>" . $rowmostrar1['actividad'] . "     ";
                                                    }
                                                }
                                                if ($Subcheck == "" or $Subcheck == 0) {
                                                    if ($Check == "") {
                                                    } else {
                                                        $consultacheck111 = "SELECT DISTINCT ch.IdCheckList,ch.Nombre
                                    FROM c_checkList ch INNER JOIN k_checklist_actividad che ON che.IdCheckList = ch.IdCheckList LEFT JOIN k_checkList_anios kche ON kche.IdCheckList=ch.IdCheckList
                            LEFT JOIN c_periodo p ON p.Periodo=kche.Anio
                                    WHERE che.IdActividad=$Actividad AND p.Id_Periodo=9 AND ch.Nivel=1 and ch.IdCheckList=$Check AND kche.Visible=1";
                                                        //echo $consultacheck111;
                                                        $resultado611 = $catalogo->obtenerLista($consultacheck111);
                                                        while ($rowmostrar3 = mysqli_fetch_array($resultado611)) {
                                                            echo "<b>Check:</b>" . $rowmostrar3['Nombre'] . "     ";
                                                        }
                                                    }
                                                } else {
                                                    if ($Check == "") {
                                                    } else {
                                                        $consultacheck222 = "SELECT DISTINCT
                                    ch.IdCheckList,
                                    ch.Nombre
                                    FROM
                                    c_checkList ch
                                    INNER JOIN k_checklist_actividad che ON che.IdCheckList = ch.IdCheckList LEFT JOIN k_checkList_anios kche ON kche.IdCheckList=ch.IdCheckList
                            LEFT JOIN c_periodo p ON p.Periodo=kche.Anio
                                    WHERE che.IdActividad=$Actividad AND p.Id_Periodo=9 AND ch.Nivel=2 AND ch.IdCheckList=$Subcheck AND kche.Visible=1";
                                                        //echo $consultacheck222;
                                                        $resultado622 = $catalogo->obtenerLista($consultacheck222);
                                                        while ($rowmostrar4 = mysqli_fetch_array($resultado622)) {
                                                            echo "<b>Sub-Check:</b>" . $rowmostrar4['Nombre'] . "     ";
                                                        }
                                                    }
                                                }
                                                if ($responsableacuerdo == "") {
                                                } else {
                                                    $consultapersonas11 = "SELECT distinct p.id_Personas, CONCAT(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno)as nombre
                                FROM c_personas as p
                                JOIN c_rolPersona rp ON p.id_Personas=rp.id_Persona
                                WHERE rp.id_Rol=148 and p.id_Personas=$responsableacuerdo
                                ORDER BY nombre";
                                                    $resulpersona11 = $catalogo->obtenerLista($consultapersonas11);
                                                    while ($rowres = mysqli_fetch_array($resulpersona11)) {
                                                        echo "<b>Receptor:</b>" . $rowres['nombre'] . "     ";
                                                    }
                                                }
                                                ?>
                                </FONT>
                            </div>
                           
                            <div class="form-group form-group-sm" style="margin-top: -12px;">
                                <label class="col-md-3 col-sm-3 col-xs-3  control-label" for="AÑO" style="width: 152px; font-size: 11px;" >* Descripción Acuerdo: </label>
                                <div class="col-md-10 col-sm-10 col-xs-10" style="width: 728px;">
                                    <textarea class="form-control" id="descripcionacuerdo<?php echo $indice; ?>" name="descripcionacuerdo<?php echo $indice; ?>" style="font-size: 11px; height: 100px;  width:500px;"><?php echo $Descripcion_acuerdo; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group form-group-sm" id="escondervisualizar8<?php echo $indice; ?>" style="display: none; margin-top: -12px;">
                                <label class="col-md-2 col-sm-2 col-xs-2 control-label" for="AÑO" style="font-size: 11px;">* Actividad/Meta:</label>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <select id="acme<?php echo $indice; ?>" class="form-control" name="acme<?php echo $indice; ?>" onchange="actividades11(<?php echo $indice; ?>);actividades111(<?php echo $indice; ?>);" style="width: 260px; font-size: 11px;">
                                        <?php if ($IdTipoConcepto == 1) {
                                            echo '<option value="1" selected="selected">Actividad</option>';
                                            echo '<option value="2">Meta</option>';
                                        } else {
                                            echo '<option value="1">Actividad</option>';
                                            echo '<option value="2" selected="selected">Meta</option>';
                                        } ?>
                                    </select>
                                </div>
                                <label class="col-md-3 col-sm-3 col-xs-3  control-label" for="AÑO" style="width: 152px; font-size: 11px;">* Tipo Acuerdo:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="tipoacuerdo<?php echo $indice; ?>" class="form-control" name="tipoacuerdo<?php echo $indice; ?>" style="width: 240px; font-size: 11px;">
                                        <option value="">Seleccione</option>
                                        <?php
                                        $selectconocimiento = "";
                                        $selectproblematica = "";
                                        $selectsolicitud = "";
                                        $selectsugerencia = "";
                                        if ($Tipo_acuerdo == "Conocimiento") $selectconocimiento = "Selected";

                                        if ($Tipo_acuerdo == "Problemática") $selectproblematica = "Selected";

                                        if ($Tipo_acuerdo == "Solicitud") $selectsolicitud = "Selected";

                                        if ($Tipo_acuerdo == "Sugerencia") $selectsugerencia = "Selected";
                                        ?>
                                        <option value="Conocimiento" <?php echo $selectconocimiento ?>>Conocimiento</option>
                                        <option value="Problemática" <?php echo $selectproblematica ?>>Problemática</option>
                                        <option value="Solicitud" <?php echo $selectsolicitud ?>>Solicitud</option>
                                        <option value="Sugerencia" <?php echo $selectsugerencia ?>>Sugerencia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-sm" id="escondervisualizar1<?php echo $indice; ?>" style="display: none; margin-top: -12px;">
                                <input type="hidden" id="id_edit<?php echo $indice; ?>" name="id_edit<?php echo $indice; ?>" value="<?php echo $Ideditar; ?>" />
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="width: 152px; font-size: 11px;" >* Eje:</label>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <select id="Eje<?php echo $indice; ?>" style="width: 260px; font-size: 11px;" class="form-control" name="Eje<?php echo $indice; ?>" onchange="Categorias(<?php echo $indice; ?>);actividades1(<?php echo $indice; ?>);">
                                        <?php
                                        $consultagiro = "SELECT e.idEje,e.Nombre FROM c_eje as e";
                                        $resultado = $catalogo->obtenerLista($consultagiro);
                                        echo '<option value="">Seleccione</option>';
                                        while ($row = mysqli_fetch_array($resultado)) {
                                            $s = '';
                                            if ($row['idEje'] == $IdProyecto) {
                                                $s = 'selected="selected"';
                                            }
                                            echo '<option value="' . $row['idEje'] . '" ' . $s . '>' . $row['idEje'] . '. ' . $row['Nombre'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label class="col-md-2 col-sm-2 col-xs-2 control-label" for="AÑO" style="font-size: 11px;">Categoría:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="cate<?php echo $indice; ?>" class="form-control" name="cate<?php echo $indice; ?>" onchange="Sub_Categorias(<?php echo $indice; ?>);actividades11(<?php echo $indice; ?>);" style="width: 240px; font-size: 11px;">
                                        <option value="0">Seleccione</option>
                                        <?php

                                        if ($Id_categoria != "") {
                                            $consultagiro = "SELECT distinct ce.idCategoria,ce.descCategoria FROM c_categoriasdeejes ce LEFT JOIN k_categoriasdeejes_anios kca ON kca.idCategoria=ce.idCategoria
                            LEFT JOIN c_periodo p on p.Periodo=kca.Anio WHERE ce.nivelCategoria=1 AND p.Id_Periodo=9 AND ce.idEje=$IdProyecto AND kca.Visible=1 ORDER BY ce.orden";
                                            $resultado = $catalogo->obtenerLista($consultagiro);

                                            while ($row = mysqli_fetch_array($resultado)) {
                                                $s = '';
                                                if ($row['idCategoria'] == $Id_categoria) {
                                                    $s = 'selected="selected"';
                                                }
                                                echo '<option value="' . $row['idCategoria'] . '" ' . $s . '>' . $row['descCategoria'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-sm" id="escondervisualizar2<?php echo $indice; ?>" style="display: none; margin-top: -12px; font-size: 11px;">
                                <label class="col-md-3 col-sm-3 col-xs-3  control-label" for="AÑO" style="width: 152px; font-size: 11px;">Sub categoría:</label>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <select id="subcate<?php echo $indice; ?>" class="form-control" name="subcate<?php echo $indice; ?>" onchange="actividades111(<?php echo $indice; ?>);" style="width: 260px; font-size: 11px;">
                                        <?php
                                        if ($Id_subcategoria) {
                                            $consultagiro = "SELECT distinct ce.idCategoria,ce.descCategoria FROM c_categoriasdeejes ce LEFT JOIN k_categoriasdeejes_anios kca ON kca.idCategoria=ce.idCategoria
                            LEFT JOIN c_periodo p on p.Periodo=kca.Anio WHERE ce.idCategoriaPadre=$Id_categoria and  kca.Visible=1 and p.Id_Periodo=9 ORDER BY ce.orden";
                                            $resultado = $catalogo->obtenerLista($consultagiro);
                                            echo '<option value="">Seleccione</option>';
                                            while ($row = mysqli_fetch_array($resultado)) {
                                                $s = '';
                                                if ($row['idCategoria'] == $Id_subcategoria) {
                                                    $s = 'selected="selected"';
                                                }
                                                echo '<option value="' . $row['idCategoria'] . '" ' . $s . '>' . $row['descCategoria'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-sm" id="escondervisualizar3<?php echo $indice; ?>" style="display: none;">
                                <label class="col-md-3 col-sm-3 col-xs-3  control-label" for="AÑO" style="width: 152px;">Exposición Temporal:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="Expotem<?php echo $indice; ?>" class="form-control" name="Expotem<?php echo $indice; ?>" style="width: 700px;">
                                        <?php
                                        $consultaperiodo6 = "SELECT et.idExposicion,CONCAT ('(',et.anio,') ',et.tituloFinal) as tituloFinal
                                    FROM c_exposicionTemporal et
                                    where et.estatus=1 AND et.anio>1
                                    ORDER BY et.anio desc";
                                        $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
                                        echo '<option value = "">Seleccione</option>';
                                        while ($row = mysqli_fetch_array($resultado6)) {
                                            $s = '';
                                            if ($row['idExposicion'] == $IdExposición) {
                                                $s = 'selected = "selected"';
                                            }
                                            echo '<option value = "' . $row['idExposicion'] . '" ' . $s . '>' . $row['tituloFinal'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-sm" id="escondervisualizar4<?php echo $indice; ?>" style="display: none; margin-top: -12px;">
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">* Global:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="ActvGlobal<?php echo $indice; ?>" class="form-control" name="ActvGlobal<?php echo $indice; ?>" onchange="actividades2(<?php echo $indice; ?>);checklist(<?php echo $indice; ?>);responsableactividad(<?php echo $indice; ?>);" style="width: 700px; font-size: 11px;">
                                        <?php
                                        if($Id_categoria != "" && $Id_categoria != 0){
                                          if ($Id_subcategoria > 0) {
                                              $where = "AND kac.Idcategoria=$Id_subcategoria";
                                          } else {
                                              $where = "AND kac.Idcategoria=$Id_categoria";
                                          }
                                        }else{
                                          $where = "";
                                        }

                                       echo $consultaperiodo6 = "SELECT a.IdActividad, CONCAT(a.Numeracion,a.Nombre) actividad FROM c_actividad a 
                                       LEFT JOIN k_actividad_categoria kac ON kac.IdActividad=a.IdActividad
                                 WHERE a.IdEje=$IdProyecto AND a.IdNivelActividad=1 AND a.IdTipoActividad=$IdTipoConcepto $where AND kac.IdPeriodo=9 ORDER BY kac.Orden";
                                        $resultado6 = $catalogo->obtenerLista($consultaperiodo6);

                                        echo '<option value = "">Seleccione</option>';
                                        while ($row = mysqli_fetch_array($resultado6)) {
                                            $s = '';
                                            if ($row['IdActividad'] == $IdGlobal) {
                                                $s = 'selected = "selected"';
                                            }
                                            echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group form-group-sm" id="escondervisualizar5<?php echo $indice; ?>" style="display: none; margin-top: -12px;">
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">General:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="ActvGeneral<?php echo $indice; ?>" class="form-control" name="ActvGeneral<?php echo $indice; ?>" onchange="actividades3(<?php echo $indice; ?>);checklist(<?php echo $indice; ?>);responsableactividad(<?php echo $indice; ?>);" style="width: 700px; font-size: 11px;">
                                        <?php
                                        $consultaperiodo6 = "SELECT a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad
                                        FROM c_actividad a LEFT JOIN k_actividad_anios ka ON ka.IdActividad=a.IdActividad
                                        LEFT JOIN c_periodo p on p.Periodo=ka.Anio
                                        WHERE a.IdEje = $IdProyecto AND a.IdNivelActividad = 2 AND a.IdTipoActividad = $IdTipoConcepto AND a.IdActividadSuperior=$IdGlobal AND ka.Visible=1 and p.Id_Periodo=9
                                        ORDER BY a.Orden";
                                        $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
                                        echo '<option value = "">Seleccione</option>';
                                        while ($row = mysqli_fetch_array($resultado6)) {
                                            $s = '';
                                            if ($row['IdActividad'] == $IdGeneral) {
                                                $s = 'selected = "selected"';
                                            }
                                            echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-sm" style="display:none">
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO"> Particular:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="ActvParticular<?php echo $indice; ?>" class="form-control" name="ActvParticular<?php echo $indice; ?>" onchange="actividades4(<?php echo $indice; ?>);" style="width: 700px;">
                                        <?php
                                        if ($IdGeneral) {
                                            $consultaperiodo6 = "SELECT a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad
                                            FROM c_actividad a
                                            WHERE a.IdEje = $IdProyecto AND a.IdNivelActividad = 3 AND a.IdTipoActividad = $IdTipoConcepto AND a.IdActividadSuperior=$IdGeneral
                                            ORDER BY a.Orden";
                                            $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
                                            echo '<option value = "">Seleccione</option>';
                                            while ($row = mysqli_fetch_array($resultado6)) {
                                                $s = '';
                                                if ($row['IdActividad'] == $IdParticular) {
                                                    $s = 'selected = "selected"';
                                                }
                                                echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-sm" style="display:none">
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO"> SubActividad/Meta:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="SubActividad<?php echo $indice; ?>" class="form-control" name="SubActividad<?php echo $indice; ?>" style="width: 700px;">
                                        <?php
                                        if ($IdParticular) {
                                            $consultaperiodo6 = "SELECT a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad
                                        FROM c_actividad a
                                        WHERE a.IdEje = $IdProyecto AND a.IdNivelActividad = 4 AND a.IdTipoActividad = $IdTipoConcepto AND a.IdActividadSuperior=$IdParticular
                                        ORDER BY a.Orden";
                                            $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
                                            echo '<option value = "">Seleccione</option>';
                                            while ($row = mysqli_fetch_array($resultado6)) {
                                                $s = '';
                                                if ($row['IdActividad'] == $IdSubActividad) {
                                                    $s = 'selected = "selected"';
                                                }
                                                echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!--para check -->
                            <div class="form-group form-group-sm" id="escondervisualizar6<?php echo $indice; ?>" style="display: none; margin-top: -12px;">
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">Check:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="check<?php echo $indice; ?>" class="form-control" name="check<?php echo $indice; ?>" onchange="subchecklist(<?php echo $indice; ?>);responsablecheck(<?php echo $indice; ?>); " style="width: 700px; font-size: 11px;">
                                        <?php
                                        if ($editar == true) {
                                            $consultacheck = "SELECT DISTINCT ch.IdCheckList,ch.Nombre
                                            FROM c_checkList ch INNER JOIN k_checklist_actividad che ON che.IdCheckList = ch.IdCheckList 
                                            LEFT JOIN k_checkList_anios kche ON kche.IdCheckList=ch.IdCheckList
                                            LEFT JOIN c_periodo p ON p.Periodo=kche.Anio
                                            WHERE che.IdActividad=$Actividad AND p.Id_Periodo=9 AND ch.Nivel=1 AND kche.Visible=1";
                                            //cbc 2022-jul-31 Se cambió el query para solo traer checks y no subchecks.
                                            $consultacheck = "SELECT ch.IdCheckList,ch.Nombre
                                            FROM c_checkList ch 
                                            JOIN k_checklist_actividad che ON che.IdCheckList = ch.IdCheckList 
                                            WHERE che.IdActividad=$Actividad AND che.Id_Periodo=9 AND ch.Nivel=1";

                                            $resultado6 = $catalogo->obtenerLista($consultacheck);
                                            echo '<option value = "NULL">Seleccione</option>';
                                            while ($row = mysqli_fetch_array($resultado6)) {
                                                $s = '';
                                                if ($row['IdCheckList'] == $Check) {
                                                    $s = 'selected = "selected"';
                                                }
                                                echo '<option value = "' . $row['IdCheckList'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="escondervisualizar7<?php echo $indice; ?>" style="display: none; margin-top: -12px;">
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">Sub-Check:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="Subcheck<?php echo $indice; ?>" class="form-control" name="Subcheck<?php echo $indice; ?>" onchange="responsablecheck(<?php echo $indice; ?>);" style="width: 700px; font-size: 11px;">
                                        <?php
                                        if ($editar == true && $Subcheck > 1) {
                                            $consultacheck = "SELECT DISTINCT ch.IdCheckList, ch.Nombre
                                            FROM c_checkList ch
                                            INNER JOIN k_checklist_actividad che ON che.IdCheckList = ch.IdCheckList
                                            LEFT JOIN k_checkList_anios kche ON kche.IdCheckList=ch.IdCheckList
                                            LEFT JOIN c_periodo p ON p.Periodo=kche.Anio
                                            WHERE che.IdActividad=$Actividad AND p.Id_Periodo=9 AND ch.Nivel=2 AND ch.IdCheckListPadre=$Check AND kche.Visible=1";
                                            //cbc 31jul2022 Se cambia el query para simplificar
                                            echo $consultacheck = "SELECT ch.IdCheckList, ch.Nombre
                                            FROM c_checkList ch
                                            INNER JOIN k_checklist_actividad che ON che.IdCheckList = ch.IdCheckList
                                            WHERE che.IdActividad=$Actividad AND che.Id_Periodo=9 AND ch.Nivel=2 AND ch.IdCheckListPadre=$Check";

                                            $resultado6 = $catalogo->obtenerLista($consultacheck);
                                            echo '<option value = "NULL">Seleccione</option>';
                                            while ($row = mysqli_fetch_array($resultado6)) {
                                                $s = '';
                                                if ($row['IdCheckList'] == $Subcheck) {
                                                    $s = 'selected = "selected"';
                                                }
                                                echo '<option value = "' . $row['IdCheckList'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                            }
                                        } elseif ($editar == true && $Subcheck == "") {
                                            echo ' <option value="0">Seleccione</option>';
                                        }


                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-group-sm" style="margin-top: -12px;">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="Fechac" style="font-size: 11px; ">* Fecha compromiso:</label>
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <input id="fechacomp<?php echo $indice; ?>" name="fechacomp<?php echo $indice; ?>" type="date" style="width: 170px;" class="form-control" style="font-size: 11px; " value="<?php echo $fechacompromiso; ?>">
                                </div>
                            </div>
                            <div class="form-group form-group-sm" style="margin-top: -12px;">
                                
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion" style="font-size: 11px;">Resolución: </label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <input id="idacuerdo<?php echo $indice; ?>" name="idacuerdo<?php echo $indice; ?>" type="hidden" value="<?php echo $rowAcuerdoActividad['id_acuerdoactividad']; ?>">
                                    <textarea class="form-control" id="resolucion<?php echo $indice; ?>" name="resolucion<?php echo $indice; ?>" rows="2" style="height: 70px; width: 700px; font-size: 11px;"><?php echo $resdsd; ?></textarea>
                                </div>
                                <?php
                                //echo $estatus;
                                $check_realizado = "";
                                if ($estatus == "1") {
                                    $check_realizado = "checked";
                                } else {
                                    $check_realizado = "";
                                }
                                /*$consultaGeneral =  "SELECT estatus FROM k_acuerdoactividad WHERE id_acuerdo = $idacuerdo AND id_actividad1 =$IdGlobal";
                                $resultGeneral = $catalogo->obtenerLista($consultaGeneral);
                                $check_realizado = "";
                                while ($row = mysqli_fetch_array($resultGeneral)) {
                                    if ($row['estatus'] == $estatus) $check_realizado = "checked";
                                } */
                                ?>
                                <!--<label class="col-md-4 col-sm-4 col-xs-4  control-label" for="AÑO">Realizado:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <input type="checkbox" class="custom-control-input" id="realizadoact<?php echo $indice; ?>" name="realizadoact<?php echo $indice; ?>" <?php echo $check_realizado; ?>>
                                </div>-->
                            </div>
                            <div class="form-group form-group-sm" style="margin-top: -12px;">
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">Acuerdo estatus:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="acuerdoestatus<?php echo $indice; ?>" class="form-control" name="acuerdoestatus<?php echo $indice; ?>" style="width: 700px; font-size: 11px;">
                                        <?php
                                       echo $consultaacuerdoestatus = "SELECT aest.Id_acuerdoestatus AS Id_acuerdoestatus, aest.Descripcion AS des FROM c_acuerdoestatus AS aest";
                                        $resultadoacuerdoestatus = $catalogo->obtenerLista($consultaacuerdoestatus);
                                        echo '<option value = "">Seleccione</option>';
                                        while ($rowae = mysqli_fetch_array($resultadoacuerdoestatus)) {
                                            $s = '';
                                            if ($rowae['Id_acuerdoestatus'] == $acuerdoestatus) {
                                                $s = 'selected = "selected"';
                                            }
                                            if($emisorLogin == "1") {
                                                if($rowae['Id_acuerdoestatus'] != "4") {
                                                    echo '<option value = "' . $rowae['Id_acuerdoestatus'] . '" ' . $s . '>' . $rowae['des'] . '</option>';
                                                }else {
                                                    if ($rowae['Id_acuerdoestatus'] == $acuerdoestatus) {
                                                        echo '<option value = "' . $rowae['Id_acuerdoestatus'] . '" ' . $s . '>' . $rowae['des'] . '</option>';
                                                    }
                                                }
                                            }
                                            if($emisorLogin == "0") {
                                                if($rowae['Id_acuerdoestatus'] == "4") {
                                                        echo '<option value = "' . $rowae['Id_acuerdoestatus'] . '" ' . $s . '>' . $rowae['des'] . '</option>';
                                                }else {
                                                    if ($rowae['Id_acuerdoestatus'] == $acuerdoestatus) {
                                                        echo '<option value = "' . $rowae['Id_acuerdoestatus'] . '" ' . $s . '>' . $rowae['des'] . '</option>';
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <?php
                            $styleres = "";
                            if ($tipo == 2) {
                                $styleres = 'style="display:none"';
                            } else {
                                $styleres = "";
                            }
                            ?>
                            <div style="margin-top: -12px;" class="form-group form-group-sm" <?php echo $styleres; ?>>
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">Receptor del acuerdo :</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="responsableacuerdo<?php echo $indice; ?>" class="form-control" name="responsableacuerdo<?php echo $indice; ?>" style="width: 700px; font-size: 11px;">
                                        <?php
										
			 
                                         echo "usuarioLog : " . $usuarioLogin = $idUsuario;
                                         echo "persona acuerdo : " . $PersonaAcuerdo = $usuario;

                                         echo $consultapersonas = "SELECT distinct p.id_Personas, CONCAT(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno)as nombre, usr.IdUsuario as id
                                          FROM c_personas as p
                                          JOIN c_rolPersona rp ON p.id_Personas=rp.id_Persona
                                          JOIN c_usuario usr ON usr.IdPersona = p.id_Personas
                                          WHERE usr.IdUsuario = '$usuarioLogin'
                                          ORDER BY nombre";
                                          $resulpersona = $catalogo->obtenerLista($consultapersonas);
                                          $row = mysqli_fetch_array($resulpersona);
                                          $personaLogin = $row['id_Personas'];
          
                                          if ($personaLogin == $PersonaAcuerdo) {
                                              $emisorLogin = "1";
                                          } else {
                                              $emisorLogin = "0";
                                          }

                                        $consultapersonas = "SELECT distinct p.id_Personas, CONCAT(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno)as nombre
                                FROM c_personas as p
                                JOIN c_rolPersona rp ON p.id_Personas=rp.id_Persona
                                WHERE rp.id_Rol=148
                                ORDER BY nombre";					
								
								
                                        $resulpersona = $catalogo->obtenerLista($consultapersonas);
                                        echo '<option value = "">Seleccione</option>';
                                        while ($row = mysqli_fetch_array($resulpersona)) {
                                            if ($responsableacuerdo == $row['id_Personas']) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }

                                            if($emisorLogin == "1") {
                                                echo "<option value='" . $row['id_Personas'] . "' " . $selected . ">" . $row['nombre'] . "</option>";
                                            } else {
                                                if ($responsableacuerdo == $row['id_Personas']) {
                                                    echo "<option value='" . $row['id_Personas'] . "' " . $selected . ">" . $row['nombre'] . "</option>";
                                                }
                                            }     
                                        }
								
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div style="margin-top: -12px;" class="form-group form-group-sm" <?php echo $styleres; ?>>
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">Firma:</label>
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <?php 
                                if ($firmaReceptor != null or $firmaReceptor != "") {
                                ?>
                              <img src="./firmaspdf/<?php echo $firmaReceptor;?>" style="width: 100;height: 80;border: double;">
                              <?php } else { 
                                 echo '<span style="background-color: red;" id = "areaI' . $row["id_Area_invitada"] . '"class = "badge badge-dark disable-select"><a style="color:#ffffff;" href="firmaIndividual.php?idAcuerdoI=' . $Ideditar . '&tipoPerfil=' . $tipoPerfil . '&idUsuario=' . $idUsuario . '&responsableacuerdo=' . $responsableacuerdo . '&PersonaAcuerdo=' . $personaLogin . '">' . " " . " (FIRMAR AQUI)".'</a> <i class = "glyphicon glyphicon-remove" style = "font-size:9px;"></i></span>';
                                }
                                ?>
                            </div>
                              
                        </div>
                            <?php
                            // if(isset($_GET['ejeidTodos'])) {
                                if ($editar == true) {
                            ?>
                            <div class="form-group form-group-sm" id="escondervisualizarboton<?php echo $indice; ?>" style="display: none;">
                               <div class="col-md-2 col-sm-2 col-xs-2">
                               </div>
                               <div class="col-md-6 col-sm-6 col-xs-6">
                               <button type="button" class="btn btn-default btn-xs" id="guardarTodo<?php echo $indice; ?>" onclick="CKupdate2(); guardaunAcuerdo(<?php echo $indice; ?>);">Guardar</button>
                              
                               </div>
                            </div>
                            <?php 
                            }
                            ?>
                        <!--    <div class="form-group form-group-sm">
                               <div class="col-md-2 col-sm-2 col-xs-2">
                               </div>
                               <div class="col-md-6 col-sm-6 col-xs-6">
                               <button type="button" class="btn btn-default btn-xs" id="guardar" onClick="CKupdate();">Guardar</button>
                               </div>
                            </div> -->

                        <?php $indice++;
                            $numerodeacuerodos++;
                        } ?>
                    <?php } else { ?>
                        <hr style="display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0; border-top: 1px solid black;">
                        <div class="form-group form-group-sm" style="margin-top: -12px;">
                            <label class="col-md-3 col-sm-3 col-xs-3  control-label" for="AÑO" style="width: 152px; font-size: 11px;" >* Descripción Acuerdo:</label>
                            <div class="col-md-10 col-sm-10 col-xs-10" style="width: 728px;">
                                <textarea class="form-control" id="descripcionacuerdo" name="descripcionacuerdo" rows="3" style="height: 100px; width: 500px; font-size: 11px;" maxlength="1000"></textarea>
                            </div>
                        </div>
                        <div class="form-group form-group-sm" style="margin-top: -12px;">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">* Actividad/Meta:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="acme" class="form-control" name="acme" onchange="actividades11();actividades111();" style="width: 260px; font-size: 11px;">
                                    <option value="1">Actividad</option>
                                    <option value="2">Meta</option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="form-group form-group-sm" style="margin-top: -12px;">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="width: 152px; font-size: 11px;">* Tipo Acuerdo:</label>
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <select id="tipoacuerdo" class="form-control" name="tipoacuerdo" style="width: 240px; font-size: 11px;">
                                    <option value="">Seleccione</option>
                                    <option value="Conocimiento">Conocimiento</option>
                                    <option value="Problemática">Problemática</option>
                                    <option value="Solicitud">Solicitud</option>
                                    <option value="Sugerencia">Sugerencia</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm" style="margin-top: -12px;">
                            <label class="col-md-3 col-sm-3 col-xs-3  control-label" for="AÑO" style="width: 152px; font-size: 11px;">* Eje:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="Eje" style="width: 260px; font-size: 11px;" class="form-control" name="Eje" onchange="Categorias();actividades1();">
                                    <?php
                                    $consultagiro = "SELECT e.idEje,e.Nombre FROM c_eje as e ";
                                    $resultado = $catalogo->obtenerLista($consultagiro);
                                    echo '<option value = "">Seleccione</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['idEje'] == $eje) {
                                            $s = 'selected = "selected"';
                                        }
                                        echo '<option value = "' . $row['idEje'] . '" ' . $s . '>' . $row['idEje'] . '. ' . $row['Nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;"> Categoría:</label>
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <select id="cate" class="form-control" name="cate" onchange="Sub_Categorias();actividades11();" style="width: 240px; font-size: 11px;">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm" style="margin-top: -12px; margin-top: -12px; font-size: 11px;">
                            <label class="col-md-3 col-sm-3 col-xs-3  control-label" for="AÑO" style="width: 152px; font-size: 11px;">Sub categoría:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="subcate" class="form-control" name="subcate" onchange="actividades111();" style="width: 260px; font-size: 11px;">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="form-group form-group-sm" style="margin-top: -12px; display: none;">
                            <label class="col-md-3 col-sm-3 col-xs-3  control-label" for="AÑO" style="width: 152px; font-size: 11px;">Exposición Temporal:</label>
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <select id="Expotem" class="form-control" name="Expotem" style="width: 700px; font-size: 11px;">
                                    <?php
                                    //$consultaperiodo6 = "SELECT e.idExposicion,e.tituloFinal FROM c_exposicionTemporal as e WHERE e.estatus=1 ORDER BY e.tituloFinal ";
                                    $consultaperiodo6 = "SELECT et.idExposicion,CONCAT ('(',et.anio,') ',et.tituloFinal) as tituloFinal
                                    FROM c_exposicionTemporal et
                                    where et.estatus=1 AND et.anio>1
                                    ORDER BY et.anio desc";
                                    $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
                                    echo '<option value = "">Seleccione</option>';
                                    while ($row = mysqli_fetch_array($resultado6)) {
                                        $s = '';
                                        if ($row['idExposicion'] == $exposicion) {
                                            $s = 'selected = "selected"';
                                        }
                                        echo '<option value = "' . $row['idExposicion'] . '" ' . $s . '>' . $row['tituloFinal'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm" style="margin-top: -12px;">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">* Global:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="ActvGlobal" class="form-control" name="ActvGlobal" onchange="actividades2();checklist();responsableactividad();" style="width: 700px; font-size: 11px;">
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm" style="margin-top: -12px;">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">General:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="ActvGeneral" class="form-control" name="ActvGeneral" onchange="actividades3();checklist();responsableactividad();" style="width: 700px;">

                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm" style="display:none; margin-top: -12px;">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">Particular:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="ActvParticular" class="form-control" name="ActvParticular" onchange="actividades4();" style="width: 700px; font-size: 11px;">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm" style="display:none; margin-top: -12px;" >
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">SubActividad/Meta:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="SubActividad" class="form-control" name="SubActividad" style="width: 700px; font-size: 11px;">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <!--para check -->
                        <div class="form-group form-group-sm" style="margin-top: -12px;">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">Check:</label>
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <select id="check" class="form-control" name="check" onchange="subchecklist();responsablecheck(); " style="width: 700px; font-size: 11px;">
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-group-sm" style="margin-top: -12px; display: none;" id="ocultaSubcheck">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">Sub-Check:</label>
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <select id="Subcheck" class="form-control" name="Subcheck" onchange="responsablecheck();" style="width: 700px; font-size: 11px;">
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-group-sm" style="margin-top: -12px;">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">Acuerdo estatus:</label>
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <select id="acuerdoestatus" class="form-control" name="acuerdoestatus" style="width: 700px; font-size: 11px;">
                                    <?php
                                    $consultaacuerdoestatus = "SELECT aest.Id_acuerdoestatus AS Id_acuerdoestatus, aest.Descripcion AS des FROM c_acuerdoestatus AS aest where Id_acuerdoestatus = 1";
                                    $resultadoacuerdoestatus = $catalogo->obtenerLista($consultaacuerdoestatus);
                                   // echo '<option value = "">Seleccione</option>';
                                    while ($rowae = mysqli_fetch_array($resultadoacuerdoestatus)) {
                                        $s = '';
                                        if ($rowae['Id_acuerdoestatus'] == "1") {
                                            $s = 'selected = "selected"';
                                        }
                                        echo '<option value = "' . $rowae['Id_acuerdoestatus'] . '" ' . $s . '>' . $rowae['des'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-group-sm" style="margin-top: -12px;">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="font-size: 11px;">Receptor del acuerdo:</label>
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <select id="responsableacuerdo" class="form-control" name="responsableacuerdo" style="width: 700px; font-size: 11px;">
                                    <?php
                                    $consultapersonas = "SELECT distinct p.id_Personas, CONCAT(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno)as nombre
                                FROM c_personas as p
                                JOIN c_rolPersona rp ON p.id_Personas=rp.id_Persona
                                WHERE rp.id_Rol=148
                                ORDER BY nombre";
                                    $resulpersona = $catalogo->obtenerLista($consultapersonas);
                                    echo '<option value = "">Seleccione</option>';
                                    while ($row = mysqli_fetch_array($resulpersona)) {
                                        if ($responsableacuerdo == $row['id_Personas']) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                        echo "<option value='" . $row['id_Personas'] . "' " . $selected . ">" . $row['nombre'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                       
                        <div class="form-group form-group-sm" style="margin-top: -12px;">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion" style="font-size: 11px;">Resolución:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <textarea class="form-control" id="resolucion" name="resolucion" rows="2" style="height: 70px; width: 700px; font-size: 11px;"></textarea>
                            </div>
                            <!--<label class="col-md-4 col-sm-4 col-xs-4  control-label" for="AÑO">Realizado:</label>
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <input type="checkbox" class="custom-control-input" id="realizadoact" name="realizadoact">
                            </div>-->
                        </div>

                      <!--   <div class="form-group form-group-sm">
                          <div class="col-md-2 col-sm-2 col-xs-2">
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-6">
                          <button type="button" class="btn btn-default btn-xs" id="guardar" onClick="CKupdate();">Guardar</button>
                          </div>
                        </div> -->

                    <?php } ?>
                    <div id="nuevaactividad">

                    </div>
                   
                    <div class="form-group form-group-sm">
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <?php
                            echo '<input type="hidden" id="tamanoArt" name="tamanoArt" value="' . $contadorac . '"/>';
                            echo '<input type="hidden" id="tamanoArtedit" name="tamanoArtedit" value="' . $contadorac . '"/>';
                            echo '<input type="hidden" id="tamanoAreas" name="tamanoAreas" value="' . $contadorar . '"/>';
                            ?>
                        </div>
                        <?php 
                         if(isset($_GET['ejeidTodos'])) {

                         }else {

                         
                        ?>
                        <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO"><button id="mas" name="mas" type="button" class="btn btn-xs" onclick="nuevaactividad();CKnuevo();"><i class="glyphicon glyphicon-plus">Nuevo Acuerdo</i></button></label>
                       <?php 
                       }
                       ?>

                    </div>
                    <div class="form-group form-group-sm">
                    <div class="col-md-2 col-sm-2 col-xs-2">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                         <?php 
                              if(isset($_GET['ejeidTodos'])) {

                              }else {

                                if ($editar == false) {
                             ?>
                             
                                 <button type="button" class="btn btn-default btn-xs" id="guardar" onClick="CKupdate();">Guardar </button> 
                                 <?php 
                                }
                            }
                         ?>
                            <a href="Vista.php?nombreUsuario=<?= $nombreUsuario ?>" class="btn btn-default btn-xs">Regresar</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>

<script>
    <?php
    if ($editar == true) {
        if(isset($_GET['ejeidTodos'])){   
       // $totalAcuerdos = "5";    
    ?>
            window.onload = function() {
            for (i = 0; i < <?php echo $totalAcuerdos; ?>; i++) {
                var editor = CKEDITOR.replace('descripcionacuerdo' + i, {
                    filebrowserUploadUrl: 'ck_upload.php',
                    filebrowserUploadMethod: 'form',
                    height: 200,
                    width: 700,
                    removePlugins: 'elementspath',
                });
            }
        }

    <?php 
    }else{
    ?>
        window.onload = function() {
            for (i = 0; i < <?php echo $contadorac; ?>; i++) {
                var editor = CKEDITOR.replace('descripcionacuerdo' + i, {
                    filebrowserUploadUrl: 'ck_upload.php',
                    filebrowserUploadMethod: 'form',
                    height: 200,
                    width: 700,
                    removePlugins: 'elementspath',
                });
            }
        }
    <?php
    }} else {
    ?>
        window.onload = function() {
            var editor = CKEDITOR.replace('descripcionacuerdo', {
                filebrowserUploadUrl: 'ck_upload.php',
                filebrowserUploadMethod: 'form',
                height: 200,
                width: 700,
                removePlugins: 'elementspath',
            });
        }
    <?php
    }
    ?>

    function CKupdate() {
        for (instance in CKEDITOR.instances)
            CKEDITOR.instances[instance].updateElement();
    }

    function CKupdate2() {
        for (instance in CKEDITOR.instances)
            CKEDITOR.instances[instance].updateElement();
    }

    function CKnuevo() {
        var valornuevo = document.getElementById("tamanoArt").value;
        var indicevalornuevo = valornuevo - 1;
        var editornuevo = CKEDITOR.replace('descripcionacuerdo' + indicevalornuevo + '', {
            filebrowserUploadUrl: 'ck_upload.php',
            filebrowserUploadMethod: 'form',
            height: 200,
            removePlugins: 'elementspath',
        });
    }

   /* var textarea = document.querySelector('textarea');

    textarea.addEventListener('keydown', autosize);
             
    function autosize(){
     var el = this;
    setTimeout(function(){
    el.style.cssText = 'height:auto; padding:0';
    el.style.cssText = 'height:' + el.scrollHeight + 'px';
     },0);
   }*/
</script>
