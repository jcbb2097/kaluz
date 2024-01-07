<?php
include_once("../../../WEB-INF/Classes/Conexion.class.php");

$db = new Conexion();

$db->Conectar();

	if(isset($_GET['idparam'])){
		$idparam = $_GET['idparam'];
		$titulo = "Modificar parámetro";
	}else{
		$titulo = "Agregar parámetro";
		$idparam = 0;
	}

	$cadenaPersonas ="";
if(isset($_GET['idparam'])){
	$query_lista = "SELECT * From c_parametros where IdParametro = $idparam";
	$result1 = $db->Ejecutar($query_lista);
	while($row = mysqli_fetch_array($result1)){
		$parametro = $row['Parametro'];
		$desc = $row['Descripcion'];
		$valor = $row['Valor'];
	}
}

$db->Desconectar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<title>::.FORMULARIO PARÁMETROS.::</title>
	<link rel="stylesheet" type="text/css" href="../../../resources/font/index.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/usuarios.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
	<link href="../../../resources/css/bootstrap-select.css" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
	<script src="../../../resources/js/aplicaciones/parametros.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
	<script src="../../../resources/js/bootstrap-select.js"></script>

</head>
<body >
	<div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1">Aplicaciones</a> / <a style="color:#fefefe;" href="lista_parametros.php">Parámetros</a> / <?php echo $titulo;?></div>

<div class="container-fluid">
	<div class="row">
	</div>

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<form class="form-horizontal" id="formUsuario" name="formUsuario">

				<div class="form-group form-group-sm">
					<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="sm">Parámetro</label>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<input class="form-control" type="text" id="parametro" name="parametro" value="<?php if(isset($idparam)){echo $parametro;} ?>" required>
					</div>
				</div>
				<div class="form-group form-group-sm">
					<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="sm">Descripción</label>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<input class="form-control" type="text" id="descripcion" name="descripcion" value="<?php if(isset($idparam)){echo $desc;} ?>" required>
					</div>
				</div>
				<div class="form-group form-group-sm">
					<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="sel3">Valor</label>
					<div class="col-md-4 col-sm-4 col-xs-4">
							<textarea  rows="10" cols="50" class="form-control" type="text" id="valor" name="valor" required><?php if(isset($idparam)){echo $valor;} ?></textarea>
					</div>
				</div>
				<div class="form-group form-group-sm">
					<div class="col-md-2 col-sm-2 col-xs-2">

					</div>
					<div class="col-md-6 col-sm-6 col-xs-6">
						<button type="submit" class="btn btn-default btn-xs">Guardar</button>
					</div>

				</div>
				<?php

						echo "<input type='hidden' id='id_par' name='id_par' value='".$idparam."'></input>";

				?>
			</form>
		</div>
	</div>
</div>
</body>
</html>
