<?php
session_start();
include_once __DIR__."/../../../source/dao/clases/LoggedinTime.php";


if(!isset($_SESSION['user_session']))
{
?>
<script>
	top.location.href="../login.php";
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
?>
<?php
include_once("../../../WEB-INF/Classes/Conexion.class.php");

$db = new Conexion();

$db->Conectar();
  $cadena = "";
  $query_lista = "SELECT * From c_parametros";
  $result1 = $db->Ejecutar($query_lista);
  while($row = mysqli_fetch_array($result1)){
    $cadena .= "<tr>".
                  "<td>".
                    "<a style='color:black;cursor:pointer' onclick='eliminarParametro(".$row['IdParametro'].")'><span class='glyphicon glyphicon-trash'></span></a>".
                    "&nbsp;&nbsp;<a style='color:black;cursor:pointer' onclick='modificarParam(".$row['IdParametro'].")'><span class='glyphicon glyphicon-pencil'></span></a>".
                  "</td>".
                  "<td>".
                    $row['IdParametro'].
                  "</td>".
                  "<td>".
                    $row['Parametro'].
                  "</td>".
                  "<td>".
                    $row['Descripcion'].
                  "</td>".
                  "<td>".
                    $row['Valor'].
                  "</td>";
  }

$db->Desconectar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<title>::.Parámetros.::</title>
	<link rel="stylesheet" type="text/css" href="../../../resources/font/index.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/usuarios.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
	<script src="../../../resources/js/aplicaciones/parametros.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
	<style>
	.dataTables_scrollBody::-webkit-scrollbar {
    -webkit-appearance: none;
}

.dataTables_scrollBody::-webkit-scrollbar:vertical {
    width:5px;
}

.dataTables_scrollBody::-webkit-scrollbar-button:increment,.dataTables_scrollBody::-webkit-scrollbar-button {
    display: none;
}

.dataTables_scrollBody::-webkit-scrollbar:horizontal {
    height: 10px;
}

.dataTables_scrollBody::-webkit-scrollbar-thumb {
	    background-color: #cbcbca;
    border-radius: 4px;
    border: 1px solid #5a274f;
}

.dataTables_scrollBody::-webkit-scrollbar-track {
    border-radius: 10px;
}
	</style>
</head>
<body >
<div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1">Aplicaciones</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Parámetros</a></div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 col-sm-4 col-xs-12">
			<a href="parametros.php">agregar +</a>
		</div>
		<div  class="col-md-4 col-sm-4 col-xs-12">
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12">
		</div>
	</div><br>

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<table id="usuarios" class="table table-striped table-bordered" style="width:100%">
				<thead style="font-size:11px">
					<tr>
            <th></th>
						<th>Id</th>
						<th>Parámetro</th>
						<th>Descripción</th>
						<th>Valor</th>
					</tr>
				</thead>
				<tbody>
					<?php echo $cadena; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</body>
</html>
