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

$nombre = isset($_GET['accion']) ? $_GET['accion'] : null;
include_once("../../../WEB-INF/Classes/Personas.class.php");
$catalogo = new Catalogo();
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
    <title>::.PERSONAS.::</title>
</head>
<body>
	<div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1">Aplicaciones</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Personas</a></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                	<?php
                        if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
                             $user = $_GET['nombreUsuario'];

                            //echo $user;
                            echo '<a style="color:purple; font-family: Muli-SemiBold;" href="alta_persona.php?accion=guardar&usuario='.$user.'"'.'>agregar +</a>';

                        }else{
                            $user="User_desconocido";

                            //echo $user;
                            echo '<a style="color:purple; font-family: Muli-SemiBold;" href="alta_persona.php?accion=guardar&usuario='.$user.'"'.'>agregar +</a>';
                        }

                    ?>
                    </div>
                <div  class="col-md-4 col-sm-4 col-xs-12">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                </div>
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
                            <!-- <th>Seudónimo</th> -->
                            <th>CURP</th>
                            <TH>RFC</TH>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $consulta = "SELECT * FROM c_personas WHERE Activo=1";
                            if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
                                $ValUser = "'".$user."'";
                            }else{
                                $user="User_desconocido";
                                $ValUser = "'".$user."'";
                            }
                            $resultPersonas=$catalogo->obtenerLista($consulta);
                        while ($rowPersonas = mysqli_fetch_array($resultPersonas)) {
                            $tipoPersona=$rowPersonas['id_TipoPersona']=="1"?"Interno</td>": $rowPersonas['id_TipoPersona']=="2"?"Externo</td>":"No Aplica";
                            echo '<tr>';
                            echo '<td><a style="color:black;cursor:pointer" onclick="eliminar('.$rowPersonas['id_Personas'].')"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;<a style="color:black;cursor:pointer" onclick="modificar('.$rowPersonas['id_Personas'].','.$ValUser.')"><span class="glyphicon glyphicon-pencil"></span></a></td>';
                            echo '<td>' . $tipoPersona . '</td>';
                            echo '<td>' . $rowPersonas['Nombre'] . '</td>';
                            echo '<td>' . $rowPersonas['Apellido_Paterno'] . '</td>';  
                            echo '<td>' . $rowPersonas['Apellido_Materno'] . '</td>';
                            //echo '<td>' . $rowPersonas['Apodo'] . '</td>';
                            echo '<td>' . $rowPersonas['CURP'] . '</td>';
                            echo '<td>' . $rowPersonas['RFC'] .'</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
</body>
</html>