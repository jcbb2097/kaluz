<?php
include_once __DIR__."/../../source/controller/PerfilController.php";
include_once __DIR__."/../../source/controller/PersonaController.php";	
include_once __DIR__."/../../source/controller/UsuarioController.php";

	if(isset($_GET['idUsuario']))
	{
		$idUsuario = $_GET['idUsuario'];
		$usuarioControllerAct = new UsuarioController();
		$usuarioAct = $usuarioControllerAct -> mostrarUsuario($idUsuario);
		$titulo = "Modificar usuario";
		
	}else{
		
		$titulo = "Agregar usuario";
	}
	
	$perfilAct = new PerfilController();
	$perfiles = $perfilAct -> mostrarPerfiles();
	
	$personaAct = new PersonaController();
	$personas = $personaAct -> mostrarPersonas();
	
	$cadenaPerfiles ="";
	$obtPerfil = 0;
	if(isset($usuarioAct)){ $obtPerfil = $usuarioAct ->getIdPerfil();}
	foreach($perfiles as $perfil)
	{
		$cadenaPerfiles .= "<option value='".$perfil ->getIdPerfil()."' ".(($perfil ->getIdPerfil() == $obtPerfil)?'selected="selected"':"").">".$perfil ->getDescripcion()."</option>";
	}
	
	$cadenaPersonas ="";
	foreach($personas as $persona)
	{
		$cadenaPersonas .= "<option value='".$persona ->getIdPersona()."'>".$persona ->getNombrePersona()."</option>";
	}
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<title>::.FORMULARIO USUARIOS.::</title>
	<link rel="stylesheet" type="text/css" href="../../resources/font/index.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../resources/css/aplicaciones/usuarios.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
	<link href="../../resources/css/bootstrap-select.css" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
	<script src="../../resources/js/aplicaciones/usuarios.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
	<script src="../../resources/js/bootstrap-select.js"></script>
	
</head>
<body >
<div class="well well-sm"><a style="color:#fefefe;" href="../aplicaciones.php?tipoPerfil=1">Aplicaciones</a> / <a style="color:#fefefe;" href="controlUsuarios.php">Control de usuarios</a> / <?php echo $titulo;?></div>

<div class="container-fluid">
	<div class="row">
	</div>
	
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<form class="form-horizontal" id="formUsuario" name="formUsuario">
				<div class="form-group form-group-sm">
					<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="sel3">Persona</label>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<?php
							if(isset($usuarioAct))
							{	
								echo "<select  id='idPersona' name='idPersona'  class='form-control input-sm' required><option value='".$usuarioAct -> getIdPersona()."'>".$usuarioAct -> getNombreUsuario()."</option></select>";
							}
							else
							{
						?>
						<select id="idPersona" name="idPersona"  class="selectpicker form-control input-sm" data-live-search="true" title="Seleccione persona" data-hide-disabled="true" required>
							<?php echo $cadenaPersonas;?>
						</select>
						<?php
							}
						?>
					</div>
				</div>
				<div class="form-group form-group-sm">
					<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="sm">Usuario</label>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<input class="form-control" type="text" id="usuario" name="usuario" value="<?php if(isset($usuarioAct)){echo $usuarioAct -> getUsuario();} ?>" required>
					</div>
				</div>
				<div class="form-group form-group-sm">
					<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="sm">Contraseña</label>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<input class="form-control" type="password" id="password" name="password" value="<?php if(isset($usuarioAct)){echo $usuarioAct -> getPassword();} ?>" required>
					</div>
				</div>
				<div class="form-group form-group-sm">
					<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="sel3">Perfil</label>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<select class="form-control input-sm" id="idPerfil" name="idPerfil">
							<?php echo $cadenaPerfiles; ?>
						</select>
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
					if(isset($usuarioAct))
					{
						echo "<input type='hidden' id='txtIdUsuario' name='txtIdUsuario' value='".$usuarioAct -> getIdUsuario()."'></input>";
					}
				?>
			</form>
		</div>
	</div>
</div>
</body>
</html>