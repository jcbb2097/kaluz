<?php
/*if ((!isset($_COOKIE['user']) || $_COOKIE['user'] == "") || (!isset($_COOKIE['IdSession']) || strlen($_COOKIE['IdSession']) != 15)) {
    header("Location: ../../index.php");
}*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
$nombre = isset($_GET['accion']) ? $_GET['accion'] : null;
if ($nombre == null) {
    include_once("../../../WEB-INF/Classes/Indicadores.2.class.php");
} else {
    include_once("../../../WEB-INF/Classes/Indicadores.2.class.php");
}
//$UsuarioPermiso = $_COOKIE['idUsuario'];
$UsuarioPermiso = $_SESSION["user_session"];
include_once("../../../WEB-INF/Classes/Indicadores.2.class.php");
$catalogo = new Catalogo();
$IdMenus = array();
$IdMenuss = array();
$consultaPermisosubmenu = "SELECT
c_usuario.IdUsuario,
k_permisosaplicacion.IdSubmenuAplicacion,
c_perfil.IdPerfil,
c_perfil.descripcion,
c_submenuaplicacion.IdMenuAplicacion,
c_menuaplicacion.IdAplicacion,
k_permisosaplicacion.Altas,
k_permisosaplicacion.Bajas,
k_permisosaplicacion.Modificacion,
k_permisosaplicacion.Consulta
FROM
c_usuario

INNER JOIN c_perfil ON c_usuario.IdPerfil = c_perfil.IdPerfil
INNER JOIN k_permisosaplicacion ON k_permisosaplicacion.IdPerfil = c_perfil.IdPerfil
INNER JOIN c_submenuaplicacion ON k_permisosaplicacion.IdSubmenuAplicacion = c_submenuaplicacion.IdSubMenuAplicacion
INNER JOIN c_menuaplicacion ON c_submenuaplicacion.IdMenuAplicacion = c_menuaplicacion.IdMenuAplicacion
WHERE c_menuaplicacion.IdAplicacion=43 AND c_submenuaplicacion.IdSubMenuAplicacion=129 AND c_usuario.IdUsuario=$UsuarioPermiso
";
$resultPermisosubmenu = $catalogo->obtenerLista($consultaPermisosubmenu);
while ($row2 = mysqli_fetch_array($resultPermisosubmenu)) {
    // $permiso =$row2['EditarPublicaciones'];      
    $Bajas = $row2['Bajas'];
    $Altas = $row2['Altas'];
    $Modificacion = $row2['Modificacion'];
    $cons = $row2['Consulta'];
}
//consulta nivel 2
$consultaMenu = "SELECT
k_perfilmenuaplicacion.IdPerfil,
c_perfil.descripcion,
c_usuario.IdUsuario,
k_perfilmenuaplicacion.IdMenuaplicacion,
k_perfilmenuaplicacion.consulta,
c_menuaplicacion.NombreMenu
FROM
k_perfilmenuaplicacion
INNER JOIN c_perfil ON k_perfilmenuaplicacion.IdPerfil = c_perfil.IdPerfil
INNER JOIN c_usuario ON c_usuario.IdPerfil = c_perfil.IdPerfil
INNER JOIN c_menuaplicacion ON k_perfilmenuaplicacion.IdMenuaplicacion = c_menuaplicacion.IdMenuAplicacion
WHERE c_menuaplicacion.IdAplicacion=43 AND c_usuario.IdUsuario=$UsuarioPermiso
";
$resultPermisomenu = $catalogo->obtenerLista($consultaMenu);
while ($row2 = mysqli_fetch_array($resultPermisomenu)) {
   array_push($IdMenus, $row2['IdMenuaplicacion'], $row2['consulta']);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Indicadores</title>
        <!-- <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   
        
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
        <script src="../../../resources/js/aplicaciones/Indicadores/listaindicadores.js"></script>
        <script src="../../../resources/js/aplicaciones/Indicadores/AltaIndicadores.js"></script>
        <script src="../../../resources/js/aplicaciones/Indicadores/funciones.js"></script>
        
        <style>

            .container {
                    width: 100%;
                    margin: 0 auto;
                    padding-left: 0px;
                    padding-right: 0px;
            }

            .dropdown {
              position: relative;
              display: inline-block;
              margin-left: 19px;
              padding-bottom: 4px;
              height: 30px;
              padding-top: 5px;
              font-family: 'Muli', sans-serif;
            }
            .sel{
              background-color: #4d4c57;
            }
            .sel .dropbtn{
             color:white;
            }
            .lbl {
                    width: 100%;
                    position: relative;
                    display: block;
                    background-color: #ffffff;
                    border: none;
                    height: 19px;
                    font-family: 'Muli', sans-serif;
                    font-size: 14px;
                    font-weight: 400;
                    color: #4d4c57;
                    padding: 0 0 0 2px;
                    outline: none;
                    margin-top: 3px;
            }

            .dropbtn {
              background-color: transparent;
              color: black;
              font-size: 11px;
              font-family: 'Muli', sans-serif;
              font-weight: 500;
              border: none;
            }

            .dropdown-content {
              display: none;
              position: absolute;
              background-color: #cacaca;
              min-width: 160px;
              box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
              z-index: 1;
            }

            .dropdown-content a {
              color: #525252;
              padding: 6px 8px;
              text-decoration: none;
              display: block;
              font-family: 'Muli', sans-serif;
            }
            .sub{
              font-size: 11px;
            }

.dropdown-content a:hover {background-color: #dedede;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover {cursor: pointer;}

.tbl-header{
  background-color: black;
  color:white;
  border-collapse: collapse;
}
.tbl-header, .tbl-td, .tbl-th{
  border: 1px solid black;
  text-align: center;
}
.tbl-td, .tbl-th{
  padding: 4px;
}
.tbl-ind{
  width: 98%;
}
.avance  {

}
.td1{
  max-width: 80px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.td2{
  max-width: 110px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}


.grande{
  min-width: 80px;
}
.line-container.jsx-3213596737 {
    display: block;
    -webkit-box-flex: 1;
    -webkit-flex-grow: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
  height: 6px;
    border-radius: 1.1px;
    background-color: #bbbbbb;
    border: solid 0.1px #000000;
    max-width: 40px;
}

.progress.jsx-3213596737 {
    height: 102%;
    border-radius: 1.1px;
    -webkit-transition: width 1s ease-in, background-color 1s ease-in;
    transition: width 1s ease-in, background-color 1s ease-in;
}
.progress{
  margin-bottom: 0px !important;
}

span.jsx-3213596737 {
    color: #4D4D57;
    font-family: 'Muli', sans-serif;
    font-size: 10px;
    padding-right: 3px;
}
figure{
  cursor: pointer;
}

.pendiente.jsx-3213596737 {
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    -webkit-justify-content: start;
    -ms-flex-pack: justify;
    justify-content: start;
    min-width: 100px;
}

.pendiente.jsx-3213596737 .progress {
    width: 6px;
    height: 6px;
}
.progreso{

}
#tabla{
    margin: auto;
}

body{
        overflow-x: hidden;
}

/*label, input {
    width:200px;
    display:block;
    float:left;
    margin-bottom:10px;
}
label {
    width:145px;
    text-align:right;
    padding-right:10px;
    margin-top:2px;
}*/


br {
    clear:left;
}

.dmenuact{
  border-bottom: 1px solid #4d4d57;
  margin-left: 4px;
}
.menuact{
  padding-top: 3px;
  padding-bottom: 3px;
  margin-right: 6px;
  cursor: pointer;
}
.bac{
  background-color: #4d4d57;
  border-radius: 5px 5px 0px 0px;
}
.pnum{
  color:black;
  font-weight:500;
  font-family: 'Muli', sans-serif;
  font-size: 9px;
  margin: 0;
}
.ptit{
  color:black;
  font-family: 'Muli', sans-serif;
  font-size: 11px;
  font-weight:200;
  text-decoration: underline black;
  margin: 0;
}
.bac > .pnum{
  color:white;
  font-family: 'Muli', sans-serif;
  font-size: 9px;
  margin: 0;
}
.bac > .ptit{
  color:white;
  font-family: 'Muli', sans-serif;
  font-size: 11px;
  font-weight:200;
  text-decoration: underline white;
  margin: 0;
}
.acsub{
  margin-right: 6px;
}
.ppor{
  margin-left: -13px !important;
  font-family: 'Muli', sans-serif;
  font-size: 9px;
  margin: 0;
  color: #00000075;
}
.barraact{
  min-width: 157%;
  margin-left: -13px;
}
.container.jsx-3213596737 {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    min-width: 60px;
    }
.modal-avances{
  border-radius: 50px;
}
.avances-image{
    width: 100%;
    border-radius: 50px 50px 0px 0px;
}
.avances-header-container{
  padding: 0px;
}
.avances-titulo{

  margin-top: -1px;
  font-family: 'Muli-Regular';
  font-size: 14px;
  color: white;
}
.avances-contenido{
  font-family: 'Muli-Regular';
  font-size: 11px;
  color: #e6e6e6bf;
}
.avances-body{
  margin-top: -3px;
  background-color: #404040;
}
.avances-footer-orange{
  padding: 3px;
  border-top: none;
  text-align: center;
  background: rgb(250,220,45);
  background: linear-gradient(90deg, rgba(250,220,45,1) 0%, rgba(255,255,255,1) 38%);
  border-radius: 0px 0px 50px 50px;

}
.avances-footer-green{
  padding: 3px;
  border-top: none;
  text-align: center;
  background: rgb(39,182,58);
  background: linear-gradient(90deg, rgba(39,182,58,1) 0%, rgba(255,255,255,1) 88%);
  border-radius: 0px 0px 50px 50px;

}
.avances-footer-content{
  padding-top: 5px;
  font-family: 'Muli-Regular';
  font-size: 15px;
  color: red;
}
.modal-sm{
  width: 232px;
}
.form-control{
font-size: 11px !important;
margin: 0px !important;
border-radius: none!important;
padding: 0px !important;
}

    </style>
    </head>
    <body>
        <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1">Aplicaciones</a> / <!-- <a style="color:#fefefe;" href="javascript:window.location.reload(true)"> --><a style="color:#fefefe;">Indicadores</a></div>
        <?php
        if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
                        $user = $_GET['nombreUsuario'];}
        ?>
        <div class="row" style="margin-bottom:15px;border-bottom: 2px solid #4d4c5752;margin-left: 5px !important;margin-top: -20px;">
            <div id="proteccion" class="dropdown">
                <button class="dropbtn active"><a style="color:#000;" href="javascript:window.location.reload(true)" >Home</a></button>
            </div>
            <div id="proteccion" class="dropdown">
              <button class="dropbtn" ><a style="color:#000;" href="Alta_indicadores.php?accion=guardar" > + Añadir Indicador</a></button>
               <!-- <button class="dropbtn"  onclick="cambiarContenidos('#contenidos','Alta_indicadores.php?accion=guardar');"> + Añadir Indicador</button>-->
            </div>
            <?php
            if ($IdMenus[2] == 17 && $IdMenus[3] == 1) {
            ?>
            <div id="proteccion" class="dropdown" >
                <?php
                $consultaPermisosubmenu2 = "SELECT
                    c_usuario.IdUsuario,
                    k_permisosaplicacion.IdSubmenuAplicacion,
                    c_perfil.IdPerfil,
                    c_perfil.descripcion,
                    c_submenuaplicacion.IdMenuAplicacion,
                    c_menuaplicacion.IdAplicacion,
                    k_permisosaplicacion.Altas,
                    k_permisosaplicacion.Bajas,
                    k_permisosaplicacion.Modificacion,
                    k_permisosaplicacion.Consulta
                    FROM
                    c_usuario

                    INNER JOIN c_perfil ON c_usuario.IdPerfil = c_perfil.IdPerfil
                    INNER JOIN k_permisosaplicacion ON k_permisosaplicacion.IdPerfil = c_perfil.IdPerfil
                    INNER JOIN c_submenuaplicacion ON k_permisosaplicacion.IdSubmenuAplicacion = c_submenuaplicacion.IdSubMenuAplicacion
                    INNER JOIN c_menuaplicacion ON c_submenuaplicacion.IdMenuAplicacion = c_menuaplicacion.IdMenuAplicacion
                    WHERE c_menuaplicacion.IdAplicacion=43 AND c_usuario.IdUsuario=$UsuarioPermiso
                    ";
                    $resultPermisosubmenu2 = $catalogo->obtenerLista($consultaPermisosubmenu2);
                    while ($row2 = mysqli_fetch_array($resultPermisosubmenu2)) {
                        // $permiso =$row2['EditarPublicaciones'];      
                        array_push($IdMenuss, $row2['IdSubmenuAplicacion'], $row2['Consulta']);
                    }
                ?>
                <select class="form-control" name="dispositivos" onchange="menuss(this.value);">
                  <option value="">Consulta Indicadores</option>
                  <?php
                  if($IdMenuss[2]==130 && $IdMenuss[3]==1){
                    echo "<option value='1'>Eje </option>";
                  }
                  if($IdMenuss[4]==131 && $IdMenuss[5]==1){
                    echo "<option value='2'>Área </option>";
                  }
                  if($IdMenuss[8]==139 && $IdMenuss[9]==1){
                    echo "<option value='3'>Mis Indicadores </option>";
                  }
                  if($IdMenuss[6]==132 && $IdMenuss[7]==1){
                    echo "<option value='4'>Reporte Indicador </option>";
                  }
                    ?>
                </select>
            </div>
            <?php
            }
            ?>
        </div>
        
        <div class="container-fluid">
            
            <!-- <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs"> 
                        <li role="presentation" class="active" ><a href="javascript:window.location.reload(true)" >Home</a></li>
                        <?php
                        /*if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
                        $user = $_GET['nombreUsuario'];}
                        if ($Altas == 1) {
                            echo "<li role=\"presentation\"><a href=\"#\"id=\"editarConsulta\" onclick=\"cambiarContenidos('#contenidos','Alta_indicadores.php?accion=guardar' );\"><span class=\"glyphicon glyphicon-plus\"></span>&nbsp;Añadir Indicador</a></li>";
                        }
                        if ($IdMenus[2] == 17 && $IdMenus[3] == 1) {
                            echo"<li role=\"presentation\"><a href=\"#\"id=\"editarConsulta\" onclick=\"cambiarContenidos('#contenidos', 'Menu_vistaindicadores.php');\"><span class=\"glyphicon glyphicon-indent-right\"></span>&nbsp;Consulta Indicadores</a></li>";
                        }*/
                        ?>
                        <li role="presentation"><a href="http://caomi1.com/SIE2019/aplicaciones/MenuAplicaciones2.php"><span class="glyphicon glyphicon-arrow-left"></span>Regresar</a></li>
                    </ul>
                </div>
            </div><br> -->
       
        <div class="row" id="contenidos">
            <div id="dTindicadores" class="col-md-12 col-sm-12 col-xs-12">
            <!-- <div id="dTindicadores" style="display:block;"> -->
                <table id="tindicadores" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Descripción</th>
                            <th>Eje</th>
                            <th>Actividad</th>
                            <th>Área</th>
                            <th>Aplicación</th>
                            <th>Periodicidad</th>
                            <th>Presentación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        /*$consulta = "SELECT
                                    k_indicadores.Descripcion,
                                    k_indicadores.IdIndicador,
                                    k_indicadores.IdProyecto,
                                    k_indicadores.IdArea,
                                    ca.nombre AS Area,
                                    k_indicadores.IdPresentacion,
                                    k_indicadores.IdAplicacion,
                                    k_indicadores.IdConcepto,
                                    k_indicadores.IdTiempo,
                                    k_indicadores.Interes,
                                    k_indicadores.Consulta,
                                    c_aplicaciones.Descripcion AS Aplicacion,
                                    c_concepto.Nombre AS Actividad,
                                    c_presentacionindicadores.Tipo,
                                    c_tiempoconsulta.Tiempo,
                                    c_proyecto.Nombre AS Eje 
                                FROM
                                    k_indicadores
                                    INNER JOIN c_aplicaciones ON k_indicadores.IdAplicacion = c_aplicaciones.IdAplicacion
                                    INNER JOIN c_concepto ON k_indicadores.IdConcepto = c_concepto.IdConcepto
                                    INNER JOIN c_presentacionindicadores ON k_indicadores.IdPresentacion = c_presentacionindicadores.IdPresentacion
                                    INNER JOIN c_tiempoconsulta ON k_indicadores.IdTiempo = c_tiempoconsulta.IdTiempo
                                    INNER JOIN c_proyecto ON k_indicadores.IdProyecto = c_proyecto.IdProyecto
                                    LEFT JOIN c_area AS ca ON ca.Id_Area = k_indicadores.IdArea 
                                ORDER BY
                                    Descripcion
                                ;";*/
                        $consulta = "SELECT
                              k_indicadores.Descripcion,
                              k_indicadores.IdIndicador,
                              k_indicadores.IdProyecto,
                              k_indicadores.IdArea,
                              ca.nombre AS Area,
                              k_indicadores.IdPresentacion,
                              k_indicadores.IdAplicacion,
                              k_indicadores.IdConcepto,
                              k_indicadores.IdTiempo,
                              k_indicadores.Interes,
                              k_indicadores.Consulta,
                              c_aplicaciones.Descripcion AS Aplicacion,
                              c_actividad.Nombre AS Actividad,
                              c_presentacionindicadores.Tipo,
                              c_tiempoconsulta.Tiempo,
                              c_eje.Nombre AS Eje 
                            FROM
                              k_indicadores
                              LEFT JOIN c_aplicaciones ON k_indicadores.IdAplicacion = c_aplicaciones.IdAplicacion
                              LEFT JOIN c_actividad ON k_indicadores.IdConcepto = c_actividad.IdActividad
                              LEFT JOIN c_presentacionindicadores ON k_indicadores.IdPresentacion = c_presentacionindicadores.IdPresentacion
                              LEFT JOIN c_tiempoconsulta ON k_indicadores.IdTiempo = c_tiempoconsulta.IdTiempo
                              LEFT JOIN c_eje ON k_indicadores.IdProyecto = c_eje.idEje
                              LEFT JOIN c_area AS ca ON ca.Id_Area = k_indicadores.IdArea 
                            ORDER BY
                              Descripcion";
                                if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
                            $ValUser = "".$user."";
                        }else{
                            $user="User_desconocido";
                            $ValUser = "".$user."";
                        }
                        $resultActividades = $catalogo->obtenerLista($consulta);
                        while ($rowActividades = mysqli_fetch_array($resultActividades)) {

                            echo '<tr>';
                            if ($Bajas == 1) {
                                echo '<td><a style="color:black;cursor:pointer" onclick="eliminarIndicador('.$rowActividades['IdIndicador'].')"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;';
                            } 
                            if ($Modificacion == 1) { 
                                //echo '<a style="color:black;cursor:pointer" onclick="modificar('.$rowActividades['IdIndicador'].','.$ValUser.')"><span class="glyphicon glyphicon-pencil"></span></a></td>';
                                //echo '<a style="color:black;cursor:pointer" onclick="cambiarContenidos(#contenidos,modificar('.$rowActividades['IdIndicador'].','.$ValUser.'))"><span class="glyphicon glyphicon-pencil"></span></a></td>';
                              ?>
                                 <a style="color:black;cursor:pointer" onclick="modificar('#contenidos','Alta_indicadores.php?','<?php echo $rowActividades['IdIndicador'];?>','<?php echo $ValUser;?>')"><span class="glyphicon glyphicon-pencil"></span></a></td>
                                 <?php
                            }

                            //echo '<tr id="trFila">';
                            echo '<td>' . $rowActividades['IdIndicador'] . '</td>';
                            echo '<td>' . $rowActividades['Descripcion'] . '</td>';
                            echo '<td>' . $rowActividades['Eje'] . '</td>';
                            echo '<td>' . $rowActividades['Actividad'] . '</td>';
                            echo '<td>' . $rowActividades['Area'] . '</td>';
                            echo '<td>' . $rowActividades['Aplicacion'] . '</td>';
                            echo '<td>' . $rowActividades['Tiempo'] . '</td>';
                            echo '<td>' . $rowActividades['Tipo'] . '</td>';                           
                            //$url = "indicadores/altaIndicador.php";
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
    </body>
</html>