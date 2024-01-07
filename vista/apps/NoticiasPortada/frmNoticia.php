<?php
include_once __DIR__."/../../../source/controller/NoticiaController.php";

	$tipoPerfil = $_GET["tipoPerfil"];
	$idUsuario = $_GET["idUsuario"];
	$nombreUsuario = $_GET["nombreUsuario"];
	
	if(isset($_GET['idNoticia']))
	{
		$idNoticia = $_GET['idNoticia'];
		$noticiaControllerAct = new NoticiaController();
		$noticiaAct = $noticiaControllerAct -> mostrarNoticia($idNoticia);
		$tipo = $noticiaAct -> getTipo();
		$titulo = "Modificar Noticia";
		
	}else{
		
		$titulo = "Agregar Noticia";
		$tipo = "";
	}
	

	
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<title>::.FORMULARIO NOTICIA.::</title>
	<link rel="stylesheet" type="text/css" href="../../../resources/font/index.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/noticiasPortada.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
	<script src="../../../resources/js/aplicaciones/noticiasPortada.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
	
</head>
<body >
<div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=<?php echo $tipoPerfil; ?>&idUsuario=<?php echo $idUsuario; ?>&nombreUsuario=<?php echo $nombreUsuario; ?>">Aplicaciones</a> / <a style="color:#fefefe;" href="noticiasPortada.php?tipoPerfil=<?php echo $tipoPerfil; ?>&idUsuario=<?php echo $idUsuario; ?>&nombreUsuario=<?php echo $nombreUsuario; ?>">Noticias portada</a> / <?php echo $titulo;?></div>

<div class="container-fluid">
	<div class="row">
	</div>
	
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<form class="form-horizontal" id="formNoticias" name="formNoticias">
				<div class="form-group form-group-sm">
					<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="sel3">Tipo noticia</label>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<select id="tipo" name="tipo"  class=" form-control input-sm" required>
							<option value="">Seleccione...</option>
							<option value="Interna" <?php if($tipo === 'Interna'){echo "selected";} ?>>Interna</option>
							<option value="Externa" <?php if($tipo === 'Externa'){echo "selected";} ?>>Externa</option>
						</select>
					</div>
				</div>
				<div class="form-group form-group-sm">
					<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="sm">Descripcion</label>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<textarea class="form-control" rows="5" id="descripcion" name="descripcion" required><?php if(isset($noticiaAct)){echo $noticiaAct -> getDescripcion();} ?></textarea>
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
					if(isset($noticiaAct))
					{
						echo "<input type='hidden' id='txtIdNoticia' name='txtIdNoticia' value='".$noticiaAct -> getIdNoticia()."'></input>";
					}
				?>
			</form>
		</div>
	</div>
</div>
</body>
</html>