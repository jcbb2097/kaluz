<?php
require_once 'libs/controller.php';
require_once 'controlador/Config1.php';
require_once 'controlador/ConexionPDO.php';
//require_once 'libs/app.php';

require_once 'libs/model.php';
require_once 'libs/view.php';
require_once 'models/entidades/area.php';
require_once 'models/entidades/actividad.php';
require_once 'models/entidades/asunto.php';
require_once 'models/entidades/mensaje.php';
require_once 'models/entidades/exposicion.php';
require_once 'models/entidades/indicadorPortada.php';
require_once 'models/entidades/invitado.php';
require_once 'models/entidades/entregable.php';
require_once 'models/entidades/check.php';
require_once 'models/entidades/archivo.php';
require_once 'models/entidades/usuario.php';
//$app = new App();

$accion = $_REQUEST['action'];
if($accion != "") {
	switch ($accion) {
		case 'actividadEje':
			$anio = $_POST['anio'];
			$eje = $_POST['eje'];
			$orden = $_POST['orden'];
			$tipo = $_POST['tipo'];
			/*$actC = new ActividadController();
			$actC -> cargarModelo('actividad');
			$actividades = $actC -> obtenerGlobales ($eje,$anio);
			foreach ($actividades as $act) {
				echo '<option value="'.$act -> getId().'">'.$act -> getNombre().'</option>';
			}*/
			require_once 'controlador/ActividadController.php';
			$actC = new ActividadController();
			$actC -> cargarModelo('Actividad');
			$actividades = $actC -> obtenerGlobales ($eje,$anio,$orden,$tipo);
			foreach ($actividades as $act) {
				$idArea=$act->getIdArea();
				$area=$act->getArea();
				if($idArea==null){
					$idArea = "-";
					$Area = "-";
				}
				echo '<option orden="'.$act->getOrden().'" value="'.$act -> getId().'" idEnc="'.$act->getIdEncargado().'" nombre="'.$act -> getEncargado().'" area="'.$area.'" idA="'.$idArea.'">'.$act->getOrden().' '.$act -> getNombre().'</option>';
				//echo '<span type="" id="actEnc'.$act -> getId().'" hidden>'.$act -> getEncargado().'</span><span id="actArea'.$act -> getId().'" hidden>'.$act -> getArea().'</span>';
			}
		break;
		case 'actividad':
			require_once 'controlador/ActividadController.php';
			$superior = $_POST['actividad'];
			$orden = $_POST['orden'];
			$actC = new ActividadController();
			$actC -> cargarModelo('Actividad');
			$actividades = $actC -> obtenerActividades ($superior,$orden);
			foreach ($actividades as $act) {
				$idArea=$act->getIdArea();
				$area=$act->getArea();
				if($idArea==null){
					$idArea = "-";
					$Area = "-";
				}
				echo '<option orden="'.$act->getOrden().'" value="'.$act -> getId().'" idEnc="'.$act->getIdEncargado().'" nombre="'.$act -> getEncargado().'" area="'.$area.'" idA="'.$idArea.'">'.$act->getOrden().' '.$act -> getNombre().'</option>';
				//echo '<input type="hidden" id="actEnc'.$act -> getId().'" value="'.$act -> getEncargado().'"><input type="hidden" id="actArea'.$act -> getId().'" value="'.$act -> getArea().'">';
			}
		break;
		case 'nombreAct':
			require_once 'controlador/EntregableController.php';
			$indC = new EntregableController();
			$indC -> cargarModelo('Entregable');
			echo $indC -> obtenerNombre();
		break;
		case 'mensajes':
			require_once 'controlador/MensajeController.php';
			$idConversacion = $_POST['idConversacion'];
			$idUsuario = $_POST['idUsuario'];
			$idArea = $_POST['idArea'];
			$idAreaU = isset($_POST['idAreaU']) ? $_POST['idAreaU'] : $idArea;
			$opcion = $_POST['opcion'];
			$tipo = $_POST['tipo'];
			$estatus = isset($_REQUEST['estatus']) ? $_REQUEST['estatus'] : '0';
			$anio = $_POST['anio'];
			$eje = isset($_POST['idEje']) ? $_POST['idEje'] : '0';
			$indExt = isset($_REQUEST['ind']) ? $_REQUEST['ind'] : '0';
			$filtroa = isset($_REQUEST['filtroa']) ? $_REQUEST['filtroa'] : '0';

			$msjC = new MensajeController();
			$msjC -> cargarModelo('Mensaje');
			$msjC -> vista -> idConversacion = $idConversacion;
			$msjC -> vista -> idUsuario = $idUsuario;
			$msjC -> vista -> idArea = $idArea;
			$msjC -> vista -> idAreaU = $idAreaU;
			$msjC -> vista -> anio = $anio;
			$msjC -> vista -> opcion = $opcion;
			$msjC -> vista -> tipo = $tipo;
			$msjC -> vista -> estatus = $estatus;
			$msjC -> vista -> idEje = $eje;
			$msjC -> vista -> mensajes = $msjC -> obtenerMensajes($idConversacion);
			$msjC -> vista -> indExt = $indExt;
			$msjC -> vista -> filtroa = $filtroa;
			
			require_once 'controlador/AsuntoController.php';
			$asnC = new AsuntoController();
			$asnC -> cargarModelo('Asunto');
			$asunto = $asnC -> model -> getAsunto($idConversacion);
			$msjC -> vista -> asunto = $asunto;

			require_once 'controlador/ActividadController.php';
			$actC = new ActividadController();
			$actC -> cargarModelo('Actividad');
			$acts = $actC -> model -> getActividad(['idConversacion' => $idConversacion]);

			if($acts[4]->getId() != '0') {
				$msjC -> vista -> idActividad = $acts[4] -> getId();
			} else if($acts[3]->getId() != '0') {
				$msjC -> vista -> idActividad = $acts[3] -> getId();
			} else if($acts[2]->getId() != '0') {
				$msjC -> vista -> idActividad = $acts[2] -> getId();
			} else if($acts[1]->getId() != '0'){
				$msjC -> vista -> idActividad = $acts[1] -> getId();
			}
			$msjC -> vista -> idEntregable = $acts[0]->getIdEntregable();
			$msjC -> vista -> actividades = $acts;
			$msjC -> vista -> compartidos = $acts[0]->getCompartidos();
			$msjC -> vista -> normatividad = $acts[0]->getNormatividad();

			require_once 'controlador/EntregableController.php';
			$indC = new EntregableController();
			$indC -> cargarModelo('Entregable');
			$msjC -> vista -> indEnt2 = $indC -> obtenerGeneralEntregables($acts[0]->getIdEntregable());
			$msjC -> vista -> indIns = $indC -> obtenerGeneralInsumos($acts[0]->getIdEntregable());
			$msjC -> vista -> indImp = $indC -> obtenerGeneralImpacto($acts[0]->getIdEntregable());
			$msjC -> vista -> renderizar('conversacion/conversacion');
		break;
		case 'exposiciones':
			require_once 'controlador/ExposicionController.php';
			$controladorExpo = new ExposicionController();
			$controladorExpo -> cargarModelo('Exposicion');
			$expos = $controladorExpo -> obtenerExposicionesAnio();
			foreach ($expos as $expo) {
				echo '<option value="'.$expo->getIdExposicion().'">'.$expo->getTitulo().'</option>';
			}
		break;
		case 'ejes':
		break;
		case 'mosaico':
			require_once 'controlador/IndicadorController.php';
			$indC = new IndicadorController();
			$indC -> cargarModelo('Indicador');
			$indC -> renderMosaico();
		break;
		case 'invitados':
			require_once 'controlador/InvitadoController.php';
			$indC = new InvitadoController();
			$indC -> cargarModelo('Invitado');
			$indC -> renderInvitados();
		break;
		case 'entregables':
			require_once 'controlador/EntregableController.php';
			$indC = new EntregableController();
			$indC -> cargarModelo('Entregable');
			$indC -> renderTabla();
		break;
		case 'insumos':
			require_once 'controlador/EntregableController.php';
			$indC = new EntregableController();
			$indC -> cargarModelo('Entregable');
			echo $indC -> obtenerInsumos();

		break;
		case 'catEnt':
			require_once 'controlador/EntregableController.php';
			$indC = new EntregableController();
			$indC -> cargarModelo('Entregable');
			//echo $indC -> obtenerCategoria();
			echo $indC -> obtenerEntregableNoTemporal();
		break;
		case 'entregableAct':
			require_once 'controlador/EntregableController.php';
			$indC = new EntregableController();
			$indC -> cargarModelo('Entregable');
			echo $indC -> obtenerEntregableActividad();
		break;
		case 'insumosGeneral':
			$idEntregable = $_POST['idEntregable'];
			require_once 'controlador/EntregableController.php';
			$indC = new EntregableController();
			$indC -> cargarModelo('Entregable');
			$items = $indC -> obtenerGeneralInsumos($idEntregable);

			$dato = ['itotal' => $items[0]->getAux(), 'iavance' => $items[0]->getFechaInicio(), 'ifinal' => $items[0]->getAnio(), 'ipre' => $items[0]->getIdExposicion()];
			header('Content-Type: application/json');
			echo json_encode($dato);
		break;
		case 'nuevo':
			require_once 'controlador/AsuntoController.php';
			$nC = new AsuntoController();
			$nC -> cargarModelo('Asunto');
			echo $nC -> cargarNuevoExterno();
		break;
		case 'archivos':
			require_once 'controlador/ArchivoController.php';
			$nC = new ArchivoController();
			$nC -> cargarModelo('Archivo');
			echo $nC -> mostrarVersiones();
		break;
		case 'usuarios':
			require_once 'controlador/UsuarioController.php';
			$nC = new UsuarioController();
			$nC -> cargarModelo('Usuario');
			$users = $nC -> obtenerUsuarios();
			foreach ($users as $us) {
				echo '<option value="'.$us -> getIdPersona().'">'.$us->getNombre().' '.$us -> getApellidoP().'</option>';
			}
		break;
		case 'compartidos':
			require_once 'controlador/ArchivoController.php';
			$nC = new ArchivoController();
			$nC -> cargarModelo('Archivo');
			echo $nC -> mostrarCompartidos();
		break;
		default:
			echo "No se pudo ejecutar la acción requerida";
		break;
	}
} else {
	echo "No se pudo ejecutar la acción requerida";
}


//echo $app->actividades($eje,$anio);

?>