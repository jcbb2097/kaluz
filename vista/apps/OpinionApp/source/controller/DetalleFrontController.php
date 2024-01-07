<?php
/*created by leasim */

	include_once __DIR__."/Validacion.php";
	include_once __DIR__."/DetalleController.php";
	
	$accion = Validacion::sanearCadena($_POST['action']);
	
	if($accion != "")
	{
		switch ($accion)
		{  
			case 'turnado':
				$idOpinion = Validacion::sanearCadena($_POST['idOpinion']);
				$idEje = Validacion::sanearCadena($_POST['idEje']);
				$idArea = Validacion::sanearCadena($_POST['idArea']);
				if(isset($_POST['idExposicion'])){
					if ($_POST['idExposicion'] != null){ $idExposicion = $_POST['idExposicion']; }
					else{ $idExposicion = null; }	
				}
				else{ $idExposicion = null; }

				if(isset($_POST['idCategoria'])){
					if ($_POST['idCategoria'] != null){ $idCategoria = $_POST['idCategoria']; }
					else{ $idCategoria = null; }	
				}
				else{ $idCategoria = null; }

				if(isset($_POST['idSubCategoria'])){
					if ($_POST['idSubCategoria'] != null){ $idSubcategoria = $_POST['idSubCategoria']; }
					else{ $idSubcategoria = null; }	
				}
				else{ $idSubcategoria = null; }

				if(isset($_POST['idActividadGlobal'])){
					if ($_POST['idActividadGlobal'] != null){ $idActividadGlobal = $_POST['idActividadGlobal']; }
					else{ $idActividadGlobal = null; }	
				}
				else{ $idActividadGlobal = null; }

				if(isset($_POST['idActividadGeneral'])){
					if ($_POST['idActividadGeneral'] != null){ $idActividadGeneral = $_POST['idActividadGeneral']; }
					else{ $idActividadGeneral = null; }	
				}
				else{ $idActividadGeneral = null; }

				if(isset($_POST['idCheck'])){
					if ($_POST['idCheck'] != null){ $idCheck = $_POST['idCheck']; }
					else{ $idCheck = null; }	
				}
				else{ $idCheck = null; }

				if(isset($_POST['idSubCheck'])){
					if ($_POST['idSubCheck'] != null){ $idSubcheck = $_POST['idSubCheck']; }
					else{ $idSubcheck = null; }	
				}
				else{ $idSubcheck = null; }

				$idPersonaResponde = Validacion::sanearCadena($_POST['idPersona']);
	
				date_default_timezone_set('America/Mexico_City');
				$fechaTurnado = date("Y-m-d H:i");

				$idUsuario = Validacion::sanearCadena($_POST['idUsuario']);
				
				$controladorAct = new DetalleController();
				echo ($controladorAct -> almacenarTurnarOpinion($idOpinion,$idEje,$idArea,$idExposicion,$idCategoria,$idSubcategoria,$idActividadGlobal,$idActividadGeneral,$idCheck,$idSubcheck,$fechaTurnado,$idUsuario,$idPersonaResponde));
				break;

			case 'modificarTurnado':
					$idOpinion = Validacion::sanearCadena($_POST['idOpinion']);
					$idEje = Validacion::sanearCadena($_POST['idEje']);
					$idArea = Validacion::sanearCadena($_POST['idArea']);
					if(isset($_POST['idExposicion'])){
						if ($_POST['idExposicion'] != null){ $idExposicion = $_POST['idExposicion']; }
						else{ $idExposicion = null; }	
					}
					else{ $idExposicion = null; }
	
					if(isset($_POST['idCategoria'])){
						if ($_POST['idCategoria'] != null){ $idCategoria = $_POST['idCategoria']; }
						else{ $idCategoria = null; }	
					}
					else{ $idCategoria = null; }
	
					if(isset($_POST['idSubCategoria'])){
						if ($_POST['idSubCategoria'] != null){ $idSubcategoria = $_POST['idSubCategoria']; }
						else{ $idSubcategoria = null; }	
					}
					else{ $idSubcategoria = null; }
	
					if(isset($_POST['idActividadGlobal'])){
						if ($_POST['idActividadGlobal'] != null){ $idActividadGlobal = $_POST['idActividadGlobal']; }
						else{ $idActividadGlobal = null; }	
					}
					else{ $idActividadGlobal = null; }
	
					if(isset($_POST['idActividadGeneral'])){
						if ($_POST['idActividadGeneral'] != null){ $idActividadGeneral = $_POST['idActividadGeneral']; }
						else{ $idActividadGeneral = null; }	
					}
					else{ $idActividadGeneral = null; }
	
					if(isset($_POST['idCheck'])){
						if ($_POST['idCheck'] != null){ $idCheck = $_POST['idCheck']; }
						else{ $idCheck = null; }	
					}
					else{ $idCheck = null; }
	
					if(isset($_POST['idSubCheck'])){
						if ($_POST['idSubCheck'] != null){ $idSubcheck = $_POST['idSubCheck']; }
						else{ $idSubcheck = null; }	
					}
					else{ $idSubcheck = null; }
	
					$idPersonaResponde = Validacion::sanearCadena($_POST['idPersona']);
		
					date_default_timezone_set('America/Mexico_City');
					$fechaTurnado = date("Y-m-d H:i");
	
				
					
					$controladorAct = new DetalleController();
					echo ($controladorAct -> actualizarOpinionTurnada($idOpinion,$idEje,$idArea,$idExposicion,$idCategoria,$idSubcategoria,$idActividadGlobal,$idActividadGeneral,$idCheck,$idSubcheck,$fechaTurnado,$idPersonaResponde));
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