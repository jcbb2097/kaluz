<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../../Classes/Catalogo.class.php");
include_once("../../Classes/ArchivoCompartido.class.php");
include_once("../../Classes/ActividadArchivo.class.php");
$catalogo = new Catalogo();
$objAC = new ArchivoCompartido();
$objAA = new actividades();
if (isset($_POST['form'])) {
	$parametros = "";
	$user="";
	parse_str($_POST['form'], $parametros);
	if(isset($parametros['contenido']) && $parametros['contenido']!=""){
		$IdLibro= $parametros['IdLibro'];
		$usuario=$parametros['usuario'];
		$Ideje= $parametros['Ideje'];
		$IdActividad= $parametros['IdActividad'];
		$n_actividad= $parametros['n_actividad'];
		$tipo= $parametros['IdEntregableDirectorioe'];
		$conta=0;
		$archivo="";
		$no_relacion = "";
		$IdArchPreliminar="";
		$resultado= json_decode($parametros['datos']);
		$consulta = "SELECT Usuario FROM c_usuario WHERE IdUsuario=".$usuario;
		$resultConsulta = $catalogo->obtenerLista($consulta);
		while ($row = mysqli_fetch_array($resultConsulta)) {
			$user= $row['Usuario'];
		}
		foreach ($resultado as $key => $val) {
			$id_c=$val->campo; 
			if(isset($parametros[$id_c])){
				 $valor = $parametros[$id_c];
			}else{
				$valor="";
				$parametros[$val->campo]="";
			}
			$anio= 2020;//date('Y');
			$consulta_an= "SELECT Id_Periodo from c_periodo WHERE Periodo =".$anio;
			$resultanio = $catalogo->obtenerLista($consulta_an);
			while ($row_a = mysqli_fetch_array($resultanio)) {
				$anio=$row_a['Id_Periodo'];
			}	
		 	$selecciona_documento = "SELECT $val->campo  FROM $val->tabla WHERE IdLibro=$IdLibro;";
			$resultdocumento = $catalogo->obtenerLista($selecciona_documento);
			if(mysqli_num_rows($resultdocumento)!=0){
				while ($row_mento = mysqli_fetch_array($resultdocumento)) {
					$IdArchPreliminar=$row_mento[$val->campo];
				}	
				if($IdArchPreliminar!="" && $IdArchPreliminar!=0){
					$no_relacion = "si";
				}else{
					$no_relacion = "";
				}
			}else{
				$no_relacion = "";
			}
			//echo $_FILES[0]['name'];;
			$rutaPDF ='sie/resources/aplicaciones/imagenes/ArchivosCompartidos/';
			if($parametros['Entregable'.$conta]==1){
				if (isset($_FILES[0])) {
                    $agregoArchivo = true;
                    if (file_exists("../../../" . $rutaPDF . $_FILES[0]['name'])) {
                        $archivo = $_FILES[0]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.',  $resultado);
                        $extension = array_pop($explode);
                        $nombre = $_FILES[0]['name'];
                        $nameimg = 'resources/aplicaciones/imagenes/ArchivosCompartidos/' . "(1)" . $archivo;
                        $namesoloimagen= "(1)".$archivo;
                   } else {
                        $archivo = $_FILES[0]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.', $resultado);
                        $extension = array_pop($explode);
                        $nombre = $_FILES[0]['name'];
                        $nameimg = 'resources/aplicaciones/imagenes/ArchivosCompartidos/' .  $resultado;
                        $namesoloimagen= $resultado;
                    }
                    $objAC->setPdfcedulafiscal($namesoloimagen);
                    move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
                } else {
                    $agregoArchivo = false;
                    $objAC->setPdfcedulafiscal("");
                }
				$objAC->setId_usuario($usuario);
				$objAC->setRuta($rutaPDF);
				//$pdf=0;
				$objAC->setPdfcedulafiscal($archivo);
				$objAC->setDescripcion('Entregable de publicaciones: '.$n_actividad);
				$objAC->setPantalla('AppPublicaciones');
				$objAC->setAnio($anio);
				$objAC->setId_tipo($tipo);
				$objAC->setId_area('16');
				$objAC->setUsuarioCreacion($user);
				$objAC->setUsuarioUltimaModificacion($user);
				$objAC->setId_destino('NULL');
				$objAC->setId_destino2('NULL');
				$agregoArchivo=true;
				if($agregoArchivo){
					$objAC->setId_documento($IdArchPreliminar);
					if($no_relacion=="si"){
						if($objAC->editaracuerdo()){
						}else{
						}
					}else{
						if($objAC->nuevoAcuerdo()){
							$IdArchPreliminar = $objAC->getId_documento();
							}else{
						}
					}
				}
				$objAA->setId_archivo($IdArchPreliminar);
				$objAA->setId_proyecto($Ideje);
				if($Ideje==7){
					$consulta_expo= "SELECT IdActividad, IdExposicion FROM $val->tabla WHERE IdLibro=$IdLibro;";
					$resultConsulta_expo = $catalogo->obtenerLista($consulta_expo);
					while ($row = mysqli_fetch_array($resultConsulta_expo)) {
						$IdActividad_e= $row['IdActividad'];
						$IdExposicion_e= $row['IdExposicion'];
					}
					$objAA->setId_exposicion($IdExposicion_e);
				}
				$contador_act=4;
				$array_act=array();
				while($IdActividad_e != $IdActividad){
					$consulta_actividades= "SELECT IdActividadSuperior FROM c_actividad where IdActividad=".$IdActividad;
					$resultConsulta_Act = $catalogo->obtenerLista($consulta_actividades);
					while ($row_act = mysqli_fetch_array($resultConsulta_Act)) {
						$IdActividad= $row_act['IdActividadSuperior'];
						array_push($array_act, $IdActividad);
					}
					$contador_act--;
				}
				$total_datos= count($array_act)-1;
				$con_array=1;
				//asort($array_act);
				//print_r($array_act);
				while( 0 <=$total_datos){
					$total_datoss=$total_datos+1;
					$contador_act= "setId_actividad".$con_array;
					$objAA->$contador_act($array_act[$total_datos]);
					$total_datos--;
					$con_array++;
				}
				$objAA->setId_tipo(1);
				if($no_relacion=="si"){
					if($objAA->editaracuerdoac()){
					}else{	
					}
				}else{
					if($objAA->acuerdoac()){
						//$IdArchPreliminar = $objAC->getId_documento();
						}else{
					}
				}
				
				$valor= $IdArchPreliminar;
			}
			$actualizacion1= "UPDATE $val->tabla SET $val->campo='$valor' WHERE IdLibro=$IdLibro;";
			$resultConsulta = $catalogo->obtenerLista($actualizacion1);
			$conta++;
		}

		echo "Actualización Correcta";
	}
}


?>