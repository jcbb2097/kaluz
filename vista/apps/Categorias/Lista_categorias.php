<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once __DIR__ . "/../../../source/dao/clases/LoggedinTime.php";
$catalogo = new Catalogo();

if ((isset($_GET['tipoPerfil']) && $_GET['tipoPerfil'] != "")) {
    $tipoPerfil = $_GET["tipoPerfil"];
} else {
    $tipoPerfil = '';
}
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
    $nombreUsuario = $_GET["nombreUsuario"];
} else {
    $nombreUsuario = '';
}
if ((isset($_GET['idUsuario']) && $_GET['idUsuario'] != "")) {
    $idUsuario = $_GET["idUsuario"];
} else {
    $idUsuario = '';
}

if (!isset($_SESSION['user_session'])) {
?>
    <script>
        top.location.href = "../../login.php";
        window.reload();
    </script>
    <?php
}
if (isset($_SESSION["user_session"])) {
    if (isLoginSessionExpired()) {
    ?>
        <script>
            top.location.href = "../../logout.php?session_expired=1";
        </script>
<?php
    }
}

$FiltroAnio="";
if (isset($_GET['F_IdAnio']) && $_GET['F_IdAnio'] != "")
{
    if ($_GET['F_IdAnio']=="Sin información")
        { $FiltroAnio= " AND isnull(p.Id_Periodo) "; } //Para fechas nulas
    elseif ($_GET['F_IdAnio']=="Todos") //Para todos los años
        { $FiltroAnio= " =1 "; }
    else { $FiltroAnio= " AND p.Periodo='".$_GET['F_IdAnio']."'"; }
}
else {$FiltroAnio= ""; }

$FiltroEje=""; //Se inicializa la variable
if ((isset($_GET['F_IdEje']) && $_GET['F_IdEje'] != "")) //Si el parametro existe se procesa
{   if ($_GET['F_IdEje']!="0") {$FiltroEje =" AND e.IdEje=".$_GET['F_IdEje'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $FiltroEje=" AND isnull(e.IdEje)"; } //Si el parametro es igual a 0 se buscan los NULOS
}

/*$FiltroCategoria=""; //Se inicializa la variable
if ((isset($_GET['F_IdCate']) && $_GET['F_IdCate'] != "")) //Si el parametro existe se procesa
{   if ($_GET['F_IdCate']!="0") {$FiltroCategoria =" AND ce.idCategoria=".$_GET['F_IdCate'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $FiltroCategoria=" AND isnull(ce.idCategoriaPadre)"; } //Si el parametro es igual a 0 se buscan los NULOS
}*/

$FiltroExpo=""; //Se inicializa la variable
if ((isset($_GET['F_IdExpo']) && $_GET['F_IdExpo'] != "")) //Si el parametro existe se procesa
{   if ($_GET['F_IdExpo']!="0") {$FiltroExpo =" AND ce.idExposicion=".$_GET['F_IdExpo']; } //Si el parametro es diferente de 0 se busca el valor
    else {  $FiltroExpo=" AND isnull(ce.idExposicion)"; } //Si el parametro es igual a 0 se buscan los NULOS
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
    <script src="../../../resources/js/aplicaciones/Permisos.js"></script>
    <script src="../../../resources/js/aplicaciones/Categorias/Acciones_categoria.js"></script>
    <title>::.CATEGORIAS.::</title>
</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Aplicaciones</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Categorías y subcategorías</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Lista de Categorías y subcategorías</a></div>
    <div class="well2 wr">
        <a style="color:#fefefe;" href="vista.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Indicadores</a> /
        <a style="color:#fefefe;" href="Lista_categorias.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Lista de Categorías y subcategorías</a> /
        <a style="color:#fefefe; cursor: pointer;" onclick="Alta(<?php echo $idUsuario ?>,56,'Alta_categorias.php?accion=guardar&tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>');">Agregar +</a>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Año</th>
                            <th>Eje</th>
                            <th>Categoría</th>
                            <th>Subcategoría</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $consulta = "SELECT
                        ce.idCategoria,
                        ce.descCategoria,
                        p.Periodo,
                        CONCAT(e.orden,' . -',e.Nombre)eje
                    FROM
                        c_categoriasdeejes ce
                        INNER JOIN c_eje e on e.idEje=ce.idEje
                        INNER JOIN c_periodo p ON p.Id_Periodo=ce.anio
                    WHERE 1 $FiltroAnio $FiltroEje $FiltroExpo
                     AND ce.nivelCategoria=1 
                     ORDER BY ce.idCategoria";
                    //echo$consulta;
                        $resultConsulta = $catalogo->obtenerLista($consulta);
                        while ($row = mysqli_fetch_array($resultConsulta)) {
                            $id_HX = $row['idCategoria'];
                            $ruta_edita = "Alta_categorias.php?accion=editar&id=" . $id_HX . "&usuario=" . $nombreUsuario . "&tipoPerfil=1&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $idUsuario;
                            $editar = "onclick='edita($idUsuario,56,\"$ruta_edita\")'";
                            $eliminar = "onclick='elimina($idUsuario,56,$id_HX);'";

                            echo '<tr>';
                            echo '<td><a style="color:purple;cursor:pointer" ' . $eliminar . '><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;<a style="color:purple;cursor:pointer" ' . $editar . '><span class="glyphicon glyphicon-pencil"></span></a></td>';
                            echo '<td>' . $row['Periodo'] . '</td>';
                            echo '<td>' . $row['eje'] . '</td>';
                            echo '<td>' . $row['descCategoria'] . '</td>';
                            echo '<td>';
                            $consulta_subcate = "SELECT
                            ce.descCategoria
                        FROM
                            c_categoriasdeejes ce
                        WHERE ce.idCategoriaPadre=" . $id_HX . " ORDER BY ce.orden;";
                            $result_actividad = $catalogo->obtenerLista($consulta_subcate);
                            while ($row3 = mysqli_fetch_array($result_actividad)) {
                                echo $row3["descCategoria"] . "<br>";
                            }
                            echo '</td>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {

        // DataTable
        var table = $('#example').DataTable();
        table.destroy();
        table = $('#example').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
            }
        });

    });
    
    //filtros de tabla
    var cont = 0;
    $('#example thead tr').clone(true).appendTo( '#example thead' );
    $('#example thead tr:eq(1) th').each( function (i) {
       cont++;
       if(cont != 1 ){
         var title = $(this).text();
         $(this).html( '<input type="text" style="width : 90px;" placeholder="'+title+'" />' );

         $( 'input', this ).on( 'keyup change', function () {
             if ($('#example').DataTable().column(i).search() !== this.value ) {
                 $('#example').DataTable()
                     .column(i)
                     .search( this.value )
                     .draw();
             }
         } );
       }
   } );
</script>

</html>