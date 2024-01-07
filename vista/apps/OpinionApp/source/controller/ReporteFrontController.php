<?php
/*created by leasim */

	include_once __DIR__."/Validacion.php";
	include_once __DIR__."/OpinionController.php";
	
	$accion = Validacion::sanearCadena($_POST['action']);
	
	if($accion != "")
	{
		switch ($accion)
		{  
			case 'guardar':
				$descripcion = Validacion::sanearCadena($_POST['descripcion']);
				$idOrigen = Validacion::sanearCadena($_POST['idOrigen']);
				$idTipo = Validacion::sanearCadena($_POST['idTipo']);
				$idProceso = 1;
				$estatus = 1;		
				date_default_timezone_set('America/Mexico_City');
				if($idOrigen == 3){
					$fechaCreo = Validacion::sanearCadena($_POST['fecha']);
				}else{
					$fechaCreo = date("Y-m-d H:i");
				}
				

				$nombre = Validacion::sanearCadena($_POST['nombre']);
				$apPat = Validacion::sanearCadena($_POST['apPat']);
				$apMat = Validacion::sanearCadena($_POST['apMat']);
				$email = Validacion::sanearCadena($_POST['email']);
				
				if(isset($_POST['edad']))
				{
					if ($_POST['edad'] != null){ $edad = $_POST['edad']; }
					else{ $edad = null; }	
				}
				else{ $edad = null; }

				if(isset($_POST['idPais']))
				{
					if ($_POST['idPais'] != null){ $idPais = $_POST['idPais']; }
					else{ $idPais = null; }	
				}
				else{ $idPais = null; }

				if(isset($_POST['telefono']))
				{
					if ($_POST['telefono'] != null){ $telefono = $_POST['telefono']; }
					else{ $telefono = null; }	
				}
				else{ $telefono = null; }

				if(isset($_POST['idEstado']))
				{
					if ($_POST['idEstado'] != null){ $idEstado = $_POST['idEstado']; }
					else{ $idEstado = null; }	
				}
				else{ $idEstado = null; }
				
				if(isset($_POST['idGenero']))
				{
					if ($_POST['idGenero'] != null){ $idGenero = $_POST['idGenero']; }
					else{ $idGenero = null; }	
				}
				else{ $idGenero = null; }

				if(isset($_POST['usuarioCreo']))
				{
					if ($_POST['usuarioCreo'] != null){ $usuarioCreo = $_POST['usuarioCreo']; }
					else{ $usuarioCreo = null; }	
				}
				else{ $usuarioCreo = null; }

				if(isset($_POST['fechaCrea']))
				{
					if ($_POST['fechaCrea'] != null){ $fechaCrea = $_POST['fechaCrea']; }
					else{ $fechaCrea = null; }	
				}
				else{ $fechaCrea = null; }
				
				$controladorAct = new OpinionController();
				echo ($controladorAct -> almacenarOpinion($descripcion,$fechaCreo,$idOrigen,$idTipo,$idProceso,$estatus,$nombre,$apPat,$apMat,$edad,$email,$telefono,$idPais,$idEstado,$idGenero,$usuarioCreo,$fechaCrea));
				break;
			
			case 'modificar':
				$id = Validacion::sanearCadena($_POST['id']);
				$nombre = Validacion::sanearCadena($_POST['nombre']);
				$descripcion = Validacion::sanearCadena($_POST['descripcion']);
				$estatus = 1;
				$usuarioMod = Validacion::sanearCadena($_POST['usuarioMod']);
				
				date_default_timezone_set('America/Mexico_City');
				$fechaMod = date("Y-m-d H:i");
				
				$controladorAct = new SeguridadController();
				echo $controladorAct -> actualizarDispositivo($id,$nombre,$descripcion,$estatus,$usuarioMod,$fechaMod);
				break;
				
			case 'eliminar':
				$id = Validacion::sanearCadena($_POST['id']);
				
				$controladorAct = new SeguridadController();
				echo $controladorAct -> eliminarDispositivo($id);
				break;
				
			default:
				echo "No se pudo realizar la acción requerida";		
		}	
	}
	else
	{
		echo "No se pudo realizar la acción requerida";
	}
				
?>