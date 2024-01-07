<?php
/*created by leasim */

	include_once __DIR__."/Validacion.php";
	include_once __DIR__."/EvidenciaController.php";
	
	$accion = Validacion::sanearCadena($_POST['action']);
	
	if($accion != "")
	{
		switch ($accion)
		{  
			case 'guardar':
				$idOpinion = Validacion::sanearCadena($_POST['idOpinion']);
				if(isset($_POST['respuesta']))
				{
					if ($_POST['respuesta'] != null){ $respuesta = $_POST['respuesta']; }
					else{ $respuesta = null; }	
				}
				else{ $respuesta = null; }


				$idUsuario = Validacion::sanearCadena($_POST['idUsuario']);
				date_default_timezone_set('America/Mexico_City');
				$fechaAtendio = date("Y-m-d H:i");
				$estatus = 1;
				$datos = 0;
				$clasificacion = Validacion::sanearCadena($_POST['clasificacion']);

				/*procesando archivo a subir*/
				$tempFile = $_FILES['archivo']['tmp_name'];
				$fileUploaded = explode('.', $_FILES['archivo']['name']);
				$type = end($fileUploaded);
				$fileName = ''.$idOpinion.'_'.$fechaAtendio.'.'.$type;
				$path = getcwd().DIRECTORY_SEPARATOR.'../../resources/evidencia'.DIRECTORY_SEPARATOR;
				$message = '';
				$result = 'err';
				
				if($_FILES['archivo']['name'] != null)
				{
					if(is_uploaded_file($tempFile))
					{
						if(move_uploaded_file($tempFile,$path.$fileName))
						{
							$archivo = $fileName;
							
							
						}else
						{
								$message = 'Error  al cargar archivo, intenta nuevamente';
						}
					}else
					{
								$message = 'No se pudo cargar archivo, intenta nievamente';
					}
				}
				else
				{
					$archivo = '';
						
				}
		
				
				$controladorAct = new EvidenciaController();
				echo ($controladorAct -> almacenarRespuesta($idOpinion,$respuesta,$archivo,$idUsuario,$fechaAtendio,$estatus,$datos,$clasificacion));
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