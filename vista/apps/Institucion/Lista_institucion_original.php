<?php

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
    include_once("../../../WEB-INF/Classes/Institucion2.class.php");
} else {
    include_once("../../../../WEB-INF/Classes/Institucion2.class.php");
}
$catalogo = new Catalogo();


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
    <!-- <div class="container-fluid" id="contenidos">
   <h1>Instituciones</h1>   
   <ul class="nav nav-tabs"> 
    <li role="presentation" class="active" ><a href="#" onclick="cambiarContenidos('#contenidos','Institucion/Lista_instirucion.php' );" >Home</a></li> -->

    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1">Aplicaciones</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Instituciones</a></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <?php
                        if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
                             $user = $_GET['nombreUsuario'];

                            //echo $user;
                            echo '<a style="color:purple; font-family: Muli-SemiBold;" href="Alta_institucion.php?accion=guardar&usuario='.$user.'"'.'>agregar +</a>';

                        }else{
                            $user="User_desconocido";

                            //echo $user;
                            echo '<a style="color:purple; font-family: Muli-SemiBold;" href="Alta_institucion.php?accion=guardar&usuario='.$user.'"'.'>agregar +</a>';
                        }

                    ?>
                    <!-- <a href="Alta_institucion.php" style="font-family: Muli-Regular">agregar +</a> -->
                </div>
                <div  class="col-md-4 col-sm-4 col-xs-12">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                </div>
            </div><br>

   <!-- <?php 
  
  //echo "<li role=\"presentation\"><a href=\"#\"id=\"editarConsulta\" onclick=\"cambiarContenidos('#contenidos','Institucion/Alta_institucion.php?accion=guardar' );\"><span class=\"glyphicon glyphicon-plus\"></span>&nbsp;Añadir Institución</a></li>";

   ?>-->
   <!-- <li role="presentation"><a href="http://palacioba.ddns.net:8081/palacio/soe/intranet/proyectos/Index.jsp"><span class="glyphicon glyphicon-arrow-left"></span>Regresar</a></li>
</ul>
    <div class="row">

   <div id="dTInstitucion" style="display:block;"> -->

    <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    
                <table id="tInstitucion" class="table table-striped table-bordered" style="width:100%">
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

                            $consulta="SELECT
                                c_institucion.Nombre,
                                c_institucion.Id_institucion,
                                c_institucion.Id_pais,
                                c_institucion.Id_sector,
                                c_institucion.Id_giro,
                                c_institucion.Id_subgiro,
                                c_sector.nombre AS Sector,
                                c_pais.Nombre AS Pais,
                                k_subgiro.Id_subgiro,
                                c_subgiro.nombre AS Subgiro,
                                c_giro.nombre AS Giro
                            FROM
                                c_institucion
                            INNER JOIN c_sector ON c_institucion.Id_sector = c_sector.Id_sector
                            INNER JOIN c_pais ON c_institucion.Id_pais = c_pais.id_Pais
                            INNER JOIN k_subgiro ON c_institucion.Id_subgiro = k_subgiro.Id_subgiro
                            INNER JOIN c_subgiro ON k_subgiro.Id_subgiro2 = c_subgiro.Id_subgiro
                            INNER JOIN c_giro ON c_institucion.Id_giro = c_giro.Id_giro
                            ORDER BY
                                Nombre
                            ";
                            if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
                                $ValUser = "'".$user."'";
                            }else{
                                $user="User_desconocido";
                                $ValUser = "'".$user."'";
                            }
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
                            //$url = "Institucion/Alta_institucion.php";
                         
                           
                            ?>
                       <?php
                       
                           
                   /*$id=$rowActividades['Id_institucion'];
                   $onClick="onclick=\"cambiarContenidos('#contenidos','Institucion/Alta_institucion.php?accion=editar&id=$id' );\"";
 echo "<button  class=\"btn btn-info btn-xs\" id=\"editarConsulta\" $onClick>";
 echo '<span class="glyphicon glyphicon-edit"></span>&nbsp;Editar</button>' ;*/

                
                        ?>
                        <?php
                              
                            /*echo '</td>';
                            echo '<td>';
                               
                            
                             echo '<button class="btn btn-danger btn-xs"   onclick="eliminarInstitucion(' . $rowActividades['Id_institucion'] . ' );"><span class="glyphicon glyphicon-trash"></span>&nbsp;Eliminar</button>';
                            
                            echo '</td>';
                            echo '</tr>';*/
                           
                           
                        }
                        ?>
              

                    </tbody>
                            
             </table>
        </tfoot>
            </div> 
                 </div>
                

  <div id="divIndicadores" style="display:none;">

                <table class="table table-condensed table-striped" style="border-collapse:collapse;text-align: center;">

                    <tr>
                        <td style="min-width: 350px; height: auto; margin: 0 auto; text-align: right;"><div id="indicador1_1"></div></td>

                        <td style="min-width: 350px; height: auto; margin: 0 auto; text-align: left;"><div id="indicador1_2"></div></td>
                    </tr>
                </table>

</div>


</div>
    </body>
</html>