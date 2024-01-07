<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once ('../../Classes/GestionarTextos.class.php');
include_once("../../Classes/Catalogo.class.php");
include_once ('../../Classes/ArchivoCompartido.class.php');
include_once ('../../Classes/EntregableEspecifico.class.php');

//echo "accion".$_POST['accion'];
$catalogo = new Catalogo();
$obj = new GestionarTextos();
$objE = new EntregableEspecifico();
$objAC = new ArchivoCompartido();

$nombreEntregable = "";
$carpeta = "";
$IdArchPreliminar = "";
			$NombreArchivoPre="";
			
			$FechaPlaneadaPreliminar="";
			$FechaRealPreliminar="";
			
if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

           //echo "Entra:";
          /*************c_documento******************////////////// 
          if($parametros['tipoTexto'] == 1){
            $nombreEntregable = "Texto insticucional Sria. Cultura";
            $carpeta = "TextoSC";
          }elseif ($parametros['tipoTexto'] == 2) {
            $nombreEntregable = "Texto insticucional INBAL";
            $carpeta = "TextoINBAL";
          }elseif ($parametros['tipoTexto'] == 3) {
            $nombreEntregable = "Texto insticucional MPBA";
            $carpeta = "TextoMPBA";
          }elseif ($parametros['tipoTexto'] == 4) {
            $nombreEntregable = "Texto insticucional Patrocinador";
            $carpeta = "TextoPatrocinador";
          }elseif ($parametros['tipoTexto'] == 5) {
            $nombreEntregable = "Texto insticucional Coeditor/Otros";
            $carpeta = "TextoCoeOtros";
          }   
          /*************c_documento******************//////////////    
           $Id_Libro=$_POST['IdLibro'];
		   $IdArchPreliminar = $parametros['IdArchivoPre'];
			$NombreArchivoPre=$parametros['nombreArchPre'];
			
			$FechaPlaneadaPreliminar=$parametros['fechaPlaneadaPre'];
			$FechaRealPreliminar=$parametros['fechaRealPre'];
			
			
			
			
            $IdArchFinal = $parametros['IdArchivoFinal'];
            $exito = true;
            $agregoArchivo = false;
            $objAC->setUsuarioUltimaModificacion($_POST['usuario']);
            $objAC->setPantalla('Controller_gestionarInstitucionales(Publicaciones)');
            $objAC->setId_usuario('NULL');
            $objAC->setAnio($parametros['anio']);
            $objAC->setId_tipo('9');
            $objAC->setId_area('16');
            $objAC->setId_destino('NULL');
            $objAC->setId_destino2('NULL');
            if($parametros['nombreArchPre'] != ""){
                $objAC->setDescripcion($parametros['nombreArchPre']);
            }else{
                $objAC->setDescripcion('Entregable '.$nombreEntregable.' '.$parametros['titulo'].',Texto: '.$parametros['tituloTexto'] );
                $objAC->setUsuarioCreacion($_POST['usuario']);
            }
            
			
            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/GestionarInstitucionales/".$carpeta."/TextoEntPreliminar/";
            $objAC->setRuta('../../../'.$rutaPDF);

            if (isset($_FILES[0])) {
                $agregoArchivo = true;
                //echo '1';
                if (file_exists("../../../" . $rutaPDF . $_FILES[0]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $nameimg = $rutaPDF . "(1)" . $archivo;
                    //$count =1;
                    $namesoloimagen= "(1)".$archivo;

               } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $nameimg = $rutaPDF .  $resultado;
					
                    $namesoloimagen= $resultado;
                }
                
                $objAC->setPdfcedulafiscal($namesoloimagen);
			
	
                move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
            } else {
                $agregoArchivo = false;
                $objAC->setPdfcedulafiscal("");
            }

            if($agregoArchivo){
                $objAC->setId_documento($IdArchPreliminar);
                if($IdArchPreliminar != "" && $objAC->editaracuerdo()){
                    echo "<br>El archivo del entregable <b><i>".$nombreEntregable." (Preliminar)</i></b> ha sido modificado";
                }else{
                    //echo "Error:Entra aqui";
                    if($objAC->nuevoAcuerdo()){
                    $IdArchPreliminar = $objAC->getId_documento();
                    //$exito = true;
                    }else{
                    echo 'Error: El archivo para el entregable <b>'.$nombreEntregable.' (Preliminar) de libro<i>'.$parametros['titulo'].'</i></b> no se generó, intente nuevamente';
                      return;
                    }
                }
                
            }

           
            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/GestionarInstitucionales/".$carpeta."/TextoEntFinal/";
            $objAC->setRuta('../../../'.$rutaPDF);
            if($parametros['nombreArchFinal'] != ""){
                $objAC->setDescripcion($parametros['nombreArchFinal']);
                $objAC->setUsuarioCreacion($_POST['usuario']);
            }else{
                $objAC->setDescripcion('Entregable '.$nombreEntregable.' Final del libro '.$parametros['titulo'].',Texto: '.$parametros['tituloTexto']);
            }
            
            $objAC->setId_tipo('10');
            $agregoArchivo = false;

            if (isset($_FILES[1])) {
                $agregoArchivo = true;
                if (file_exists("../../../" . $rutaPDF . $_FILES[1]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[1]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[1]['name'];

                    $nameimg = $rutaPDF . "(1)" . $archivo;
                    //$count =1;
                    $namesoloimagen= "(1)".$archivo;

               } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[1]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[1]['name'];

                    $nameimg = $rutaPDF .  $resultado;
                    $namesoloimagen= $resultado;
                }
                
                $objAC->setPdfcedulafiscal($namesoloimagen);

                move_uploaded_file($_FILES[1]['tmp_name'], "../../../" . $nameimg);
            } else {
                
                $objAC->setPdfcedulafiscal("");
            }
            if($agregoArchivo){
                $objAC->setId_documento($IdArchFinal);
                if($IdArchFinal != "" && $objAC->editaracuerdo()){
                    echo "<br>El archivo del entregable <b><i>".$nombreEntregable." (Final)</i></b> ha sido modificado";
                }else{
                    //echo "Error:Entra aqui";
                    if($objAC->nuevoAcuerdo()){
                    $IdArchFinal = $objAC->getId_documento();
                    //$exito = true;
                    }else{
                    echo 'Error: El archivo para el entregable <b>'.$nombreEntregable.' (Final) de libro<i>'.$parametros['titulo'].'</i></b> no se generó, intente nuevamente';
                      return;
                    }
                }
                
            }


             /*************c_entregableEspecifico***********//////////
            $objE->setIdArchPreliminar($IdArchPreliminar);
			//$objE->setIdArchivoPreliminar($IdArchPreliminar);
            $objE->setIdArchFinal($IdArchFinal);
            $objE->setIdEntregable($parametros['IdEntregable']);
            if($parametros['nombreEntEsp'] != ""){
                $objE->setDescripcion($parametros['nombreEntEsp']);
            }else{
                $objE->setDescripcion($nombreEntregable.' del libro '.$parametros['titulo'].',Texto: '.$parametros['tituloTexto']);
            }
            
            $objE->setFechaPlaneadaPreliminar($parametros['fechaPlaneadaPre']);
            $objE->setFechaRealPreliminar($parametros['fechaRealPre']);
            $objE->setFechaPlaneadaFinal($parametros['fechaPlaneadaFin']);
            $objE->setFechaRealFinal($parametros['fechaRealFin']);
                if ($IdArchPreliminar != "" || $IdArchFinal != "") {
                            
                    if($objE->agregarEntregableEspecifico()){
                        $exito = true;
                        $IdEntregableEspecif = $objE->getIdEntregableEspecifico();
                        $obj->setIdEntregableTextoFinal($IdEntregableEspecif);
                        for($i=0 ; $i<2; $i++){
                            $objE->setIdEntregableEspecifico($IdEntregableEspecif);
                            $objE->setIdCheckList($parametros['IdChkList'.$i]);
                            if( isset($parametros['vobo'.$i]) && $parametros['vobo'.$i] == "on"){
                                $objE->setValor(1);
                            }else{
                                $objE->setValor(0);
                            }
                            if($objE->agregarEntregableEspecifCheck()){
                                echo '<br><small>1Vobo '.($i+1).' se agregó correctamente</small>';
                            }else{
                             echo '<br><small>Vobo '.($i+1).' no se pudo agregar</small>';   
                            }
                        }
                        
                    }else{
                        $exito = false;
                        echo "<br><br><small>Error: No se pudo ligar el entregable,comuniquelo al equipo de sistemas</small>";
                    }
                }else{
                    echo "<br><br><small>Aviso: No se ligó ningún entregable, más adelante puede agregarlo actualizando el libro</small>";
                }       
            
            /************c_textosLibro***********/
              $obj->setIdTexto($_POST['id']); 
              $obj->setIdLibro($_POST['IdLibro']);
              $obj->setIdAutor($parametros['autor']);
              $obj->setTituloTexto($parametros['tituloTexto']);
              //$obj->setNumCuartillas($parametros['numCuartillas']);
              $obj->setIdTipoTexto($parametros['tipoTexto']);
              $obj->setIdInstitucion($parametros['InstitucionAutor']);
              
              $obj->setUsuarioCreacion($_POST['usuario']);
              $obj->setUsuarioUltimaModificacion($_POST['usuario']);
              $obj->setPantalla('Controller_gestionarInstitucionales');
            
            /*********************************************************************/ 
            /***************Ficha Informativa******************************/

              $rutaPDF2 = $parametros['path0'];
              $index = 2;
                if (isset($_FILES[$index])) {
                    //echo '1';
                    if (file_exists("../../../" . $rutaPDF2 . $_FILES[$index]['name'])) {
                        //echo '<br>2<br>';
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.',  $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 . "(1)" . $archivo;
                        //$count =1;
                        $namesoloimagen= "(1)".$archivo;

                      
                   } else {

                        //echo "<br>3<br>";
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.', $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 .  $resultado;
                        $namesoloimagen= $resultado;
                    }
                    //echo '<br>4<br>';
                    $obj->setRutaEntregableEspFichaInformativa($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableEspFichaInformativa("");
                }

              /********************************************************************/
              /***********************Elaborar prop para Vo.bo***************************/
             
               
              $obj->setfechaEnvioElabPropVobo($parametros['fechaEnvioPropVobo']);
              $obj->setFechaEntregaPlaneadaElabPropVobo($parametros['fechaEntregaPlaneadaPropVobo']);
              $obj->setFechaEntregaRealElabPropVobo($parametros['fechaEntregaRealPropVobo']);
              $obj->setIdProveedorElabPropVobo($parametros['IdProveedor']);
              if(isset($parametros['checkEnvInfoProy']) && $parametros['checkEnvInfoProy'] == 'on'){
                $obj->getCheckEnvInfoProy(1);
              }else{
                $obj->getCheckEnvInfoProy(0);
              }
              if(isset($parametros['checkRecibirProp']) && $parametros['checkRecibirProp'] == 'on'){
                 $obj->setCheckRecibirProp(1);
              }else{
                 $obj->setCheckRecibirProp(0);
              }
                $rutaPDF2 = $parametros['path1'];
                $index = 3;
                if (isset($_FILES[$index])) {
                    //echo '1';
                    if (file_exists("../../../" . $rutaPDF2 . $_FILES[$index]['name'])) {
                        //echo '<br>2<br>';
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.',  $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 . "(1)" . $archivo;
                        //$count =1;
                        $namesoloimagen= "(1)".$archivo;

                      
                   } else {

                        //echo "<br>3<br>";
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.', $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 .  $resultado;
                        $namesoloimagen= $resultado;
                    }
                    //echo '<br>4<br>';
                    $obj->setRutaEntregableElabPropuestaVobo($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableElabPropuestaVobo("");
                }
                
                
              /********************************************************************/
              /***********************Realizar Corrección de estilo***************************/
              $obj->setfechaEnvioVoboDireccion($parametros['fechaEnvioVoboDireccion']);
              $obj->setfechaEntregaVoboDireccion($parametros['fechaEntregaVoboDireccion']);
               if( isset($parametros['checkEnviarProp']) && $parametros['checkEnviarProp'] == 'on'){
                    $obj->setCheckEnviarPropVoboDir(1);
                  }else{
                    $obj->setCheckEnviarPropVoboDir(0);
                  }
               if( isset($parametros['checkRecibirTxtAutorizado']) && $parametros['checkRecibirTxtAutorizado'] == 'on'){
                    $obj->setCheckRecibirTextoAutorizadoVoboDir(1);
                }else{
                    $obj->setCheckRecibirTextoAutorizadoVoboDir(0);
                }    
              $rutaPDF2 = $parametros['path2'];
                $index = 4;
                if (isset($_FILES[$index])) {
                    //echo '1';
                    if (file_exists("../../../" . $rutaPDF2 . $_FILES[$index]['name'])) {
                        //echo '<br>2<br>';
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.',  $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 . "(1)" . $archivo;
                        //$count =1;
                        $namesoloimagen= "(1)".$archivo;

                      
                   } else {

                        //echo "<br>3<br>";
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.', $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 .  $resultado;
                        $namesoloimagen= $resultado;
                    }
                    //echo '<br>4<br>';
                    $obj->setRutaSolVoboDireccion($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaSolVoboDireccion("");
                }

                
                /******************* REALIZAR CORRECCIÓN DE ESTILO **********************/
                
                
                $obj->setIdCorrectorEstiloTextoCorregido($parametros['correctorEstilo']);
                $obj->setFechaEnvioTextoCorregido($parametros['fechaEnvioTxtCorregido']);
                $obj->setFechaEntregaTextoCorregido($parametros['fechaEntregaTxtCorregido']);
                $rutaPDF2 = $parametros['path3'];
                $index = 5;
                if (isset($_FILES[$index])) {
                    //echo '1';
                    if (file_exists("../../../" . $rutaPDF2 . $_FILES[$index]['name'])) {
                        //echo '<br>2<br>';
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.',  $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 . "(1)" . $archivo;
                        //$count =1;
                        $namesoloimagen= "(1)".$archivo;

                      
                   } else {

                        //echo "<br>3<br>";
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.', $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 .  $resultado;
                        $namesoloimagen= $resultado;
                    }
                    //echo '<br>4<br>';
                    $obj->setRutaEntregableTextoCorregido($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableTextoCorregido("");
                }


                $obj->setFechaEnvioTextoTraducido($parametros['fechaEnvioTxtTraducido']);
                /*$obj->setFechaEntregaPlaneadaTextoTraducido($parametros['fechaEntregaPlaneadaTxtTraducido']);*/
                $obj->setfechaEntregaRealTextoTraducido($parametros['fechaEntregaRealTxtTraducido']);
                $obj->setIdTraductorTextoTraducido($parametros['traductorTextTraducido']);
                
                $rutaPDF2 = $parametros['path4'];
                $index = 6;
                
                if (isset($_FILES[$index])) {
                    //echo '1';
                    if (file_exists("../../../" . $rutaPDF2 . $_FILES[$index]['name'])) {
                        //echo '<br>2<br>';
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.',  $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 . "(1)" . $archivo;
                        //$count =1;
                        $namesoloimagen= "(1)".$archivo;

                      
                   } else {

                        //echo "<br>3<br>";
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.', $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 .  $resultado;
                        $namesoloimagen= $resultado;
                    }
                    //echo '<br>4<br>';
                    $obj->setRutaEntregableTextoTraducido($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableTextoTraducido("");
                }
                
                /*********************SOLICITAR VOBO FINAL AUTOR*******************************/
                
                if( isset($parametros['checkboxVoboFinalAutor']) && $parametros['checkboxVoboFinalAutor'] == 'on'){
                $obj->setCheckVoboFinalAutor(1);
                }else{
                    $obj->setCheckVoboFinalAutor(0);
                }

                $obj->setFechaEnvioVoboFinal($parametros['fechaEnvioVoboFinalAutor']);
                /*$obj->setFechaEntregaPlaneadaVoboFina($parametros['fechaEntregaPlaneadaFinalAutor']);*/
                $obj->setFechaEntregaRealVoboFinal($parametros['fechaEntregaRealFinalAutor']);
                
                $rutaPDF2 = $parametros['path5'];
                $index = 7;
                
                
                if (isset($_FILES[$index])) {
                    //echo '1';
                    if (file_exists("../../../" . $rutaPDF2 . $_FILES[$index]['name'])) {
                        //echo '<br>2<br>';
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.',  $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 . "(1)" . $archivo;
                        //$count =1;
                        $namesoloimagen= "(1)".$archivo;

                      
                   } else {

                        //echo "<br>3<br>";
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.', $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 .  $resultado;
                        $namesoloimagen= $resultado;
                    }
                    //echo '<br>4<br>';
                    $obj->setRutaEntregableVoboFinal($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableVoboFinal("");
                }
				 $objE->setIdEntregableEspecifico($parametros['IdEntregableEspVer']);
          //  $objE->setIdArchivoPreliminar($IdArchPreliminar);
            /******************************************************************************/   
            if($exito && $obj->agregarTexto() && $objE->agregarEntregableEspecifico()){
			
                echo "<br><br>Éxito: El registro se guardo correctamente";    
            }else{
                echo '<br><br>Error: 1El registro no se ha podido guardar';
            }
            //return;

            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

           if($parametros['tipoTexto'] == 1){
            $nombreEntregable = "Texto insticucional Sria. Cultura";
            $carpeta = "TextoSC";
          }else if ($parametros['tipoTexto'] == 2) {
            $nombreEntregable = "Texto insticucional INBAL";
            $carpeta = "TextoINBAL";
          }else if ($parametros['tipoTexto'] == 3) {
            $nombreEntregable = "Texto insticucional MPBA";
            $carpeta = "TextoMPBA";
          }else if ($parametros['tipoTexto'] == 4) {
            $nombreEntregable = "Texto insticucional Patrocinador";
            $carpeta = "TextoPatrocinador";
          }else if ($parametros['tipoTexto'] == 5) {
            $nombreEntregable = "Texto insticucional Coeditor/Otros";
            $carpeta = "TextoCoeOtros";
          }  else if ($parametros['tipoTexto'] == 7) {
            $nombreEntregable = "Texto insticucional Coeditor/Otros";
            $carpeta = "TextoCoeOtros";
          }  
				echo $parametros['tipoTexto'];
          /*************c_documento******************//////////////    
            $IdArchPreliminar = $parametros['IdArchivoPre'];
            $IdArchFinal = $parametros['IdArchivoFinal'];
            $exito = true;
            $agregoArchivo = false;
            $objAC->setUsuarioUltimaModificacion($_POST['usuario']);
            $objAC->setPantalla('Controller_gestionarInstitucionales(Publicaciones)');
            $objAC->setId_usuario('NULL');
            $objAC->setAnio($parametros['anio']);
            $objAC->setId_tipo('9');
            $objAC->setId_area('16');
            $objAC->setId_destino('NULL');
            $objAC->setId_destino2('NULL');
            if($parametros['nombreArchPre'] != ""){
                $objAC->setDescripcion($parametros['nombreArchPre']);
            }else{
                $objAC->setDescripcion('Entregable '.$nombreEntregable.' '.$parametros['titulo'].',Texto: '.$parametros['tituloTexto'] );
                $objAC->setUsuarioCreacion($_POST['usuario']);
            }
            if($carpeta=="TextoPatrocinador"){
				$rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/GestionarInstitucionales/".$carpeta."/TextoFinalPreliminar/";
			}else{$rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/GestionarInstitucionales/".$carpeta."/TextoEntPreliminar/";}
            
			
            $objAC->setRuta('../../../'.$rutaPDF);

            if (isset($_FILES[0])) {
                $agregoArchivo = true;
                //echo '1';
                if (file_exists("../../../" . $rutaPDF . $_FILES[0]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $nameimg = $rutaPDF . "(1)" . $archivo;
                    //$count =1;
                    $namesoloimagen= "(1)".$archivo;

               } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $nameimg = $rutaPDF .  $resultado;
                    $namesoloimagen= $resultado;
                }
                
                $objAC->setPdfcedulafiscal($namesoloimagen);
				  move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
				  
				  	$obj->setRutaArchivoPreliminar("../../../" . $nameimg);
				$obj->setIdArchPreliminar($IdArchPreliminar);
			$obj->setNombreArchivoPr($archivo);
			$obj->setFechaPlaneadaPreliminar($parametros['fechaPlaneadaPre']);
			$obj->setFechaRealPreliminar($parametros['fechaRealPre']);
			  

               
            } else {
                $agregoArchivo = false;
                $objAC->setPdfcedulafiscal("");
            }

            if($agregoArchivo){
                $objAC->setId_documento($IdArchPreliminar);
                if($IdArchPreliminar != "" && $objAC->editaracuerdo()){
                    echo "<br>El archivo del entregable <b><i>".$nombreEntregable." (Preliminar)</i></b> ha sido modificado";
                }else{
                    //echo "Error:Entra aqui";
                    if($objAC->nuevoAcuerdo()){
                    $IdArchPreliminar = $objAC->getId_documento();
                    //$exito = true;
                    }else{
                    echo 'Error: El archivo para el entregable <b>'.$nombreEntregable.' (Preliminar) de libro<i>'.$parametros['titulo'].'</i></b> no se generó, intente nuevamente';
                      return;
                    }
                }
                
            }

           
            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/GestionarInstitucionales/".$carpeta."/TextoEntFinal/";
            $objAC->setRuta('../../../'.$rutaPDF);
            if($parametros['nombreArchFinal'] != ""){
                $objAC->setDescripcion($parametros['nombreArchFinal']);
                $objAC->setUsuarioCreacion($_POST['usuario']);
            }else{
                $objAC->setDescripcion('Entregable '.$nombreEntregable.' Final del libro '.$parametros['titulo'].',Texto: '.$parametros['tituloTexto']);
            }
        
        $objAC->setId_tipo('10');
        $agregoArchivo = false;
            if (isset($_FILES[1])) {
                $agregoArchivo = true;
                if (file_exists("../../../" . $rutaPDF . $_FILES[1]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[1]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[1]['name'];

                    $nameimg = $rutaPDF . "(1)" . $archivo;
                    //$count =1;
                    $namesoloimagen= "(1)".$archivo;

               } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[1]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[1]['name'];

                    $nameimg = $rutaPDF .  $resultado;
                    $namesoloimagen= $resultado;
                }
                
                $objAC->setPdfcedulafiscal($namesoloimagen);

                move_uploaded_file($_FILES[1]['tmp_name'], "../../../" . $nameimg);
            } else {
                
                $objAC->setPdfcedulafiscal("");
            }
            if($agregoArchivo){
                $objAC->setId_documento($IdArchFinal);
                if($IdArchFinal != "" && $objAC->editaracuerdo()){
                    echo "<br>El archivo del entregable <b><i>".$nombreEntregable." (Final)</i></b> ha sido modificado";
                }else{
                    //echo "Error:Entra aqui";
                    if($objAC->nuevoAcuerdo()){
                    $IdArchFinal = $objAC->getId_documento();
                    //$exito = true;
                    }else{
                    echo 'Error: El archivo para el entregable <b>'.$nombreEntregable.' (Final) de libro<i>'.$parametros['titulo'].'</i></b> no se generó, intente nuevamente';
                      return;
                    }
                }
                
            }

            //return;
             /*************c_entregableEspecifico***********//////////
            $objE->setIdArchPreliminar($IdArchPreliminar);
            $objE->setIdArchFinal($IdArchFinal);
            $objE->setIdEntregable($parametros['IdEntregable']);
            if($parametros['nombreEntEsp'] != ""){
                $objE->setDescripcion($parametros['nombreEntEsp']);
            }else{
                $objE->setDescripcion($nombreEntregable.' del libro '.$parametros['titulo'].',Texto: '.$parametros['tituloTexto']);
            }
            
            $objE->setFechaPlaneadaPreliminar($parametros['fechaPlaneadaPre']);
            $objE->setFechaRealPreliminar($parametros['fechaRealPre']);
            $objE->setFechaPlaneadaFinal($parametros['fechaPlaneadaFin']);
            $objE->setFechaRealFinal($parametros['fechaRealFin']);

            if($parametros['IdEntregableEsp'] != ""){
                $IdEntregableEspecif = $parametros['IdEntregableEsp'];
                $objE->setIdEntregableEspecifico($parametros['IdEntregableEsp']);

                if ($IdArchPreliminar != "" || $IdArchFinal != "") {
                            
                    if($objE->editarEntregableEspecifico()){
                        $exito = true;
                        
                        $obj->setIdEntregableTextoFinal($IdEntregableEspecif);
                        for($i=0 ; $i<2 ; $i++){
                            $objE->setIdEntregableEspecifico($IdEntregableEspecif);
                            $objE->setIdCheckList($parametros['IdChkList'.$i]);
                            if( isset($parametros['vobo'.$i]) && $parametros['vobo'.$i] == "on"){
                                $objE->setValor(1);
                            }else{
                                $objE->setValor(0);
                            }
                            if($objE->agregarEntregableEspecifCheck()){
							 echo '<br><small>2Vobo '.($i+1).' se modificó correctamente 1</small>';
                            }else{
                             echo '<br><small>Vobo '.($i+1).' no se pudo modificar</small>';   
                            }
                        }
                        
                    }else{
                        $exito = false;
                        echo "<br><br><small>Error: No se pudo actualizar el entregable,comuniquelo al equipo de sistemas</small>";
                    }
                }else{
                    $exito = false;
                        echo "<br><br><small>Error: No se pudo ligar el entregable,comuniquelo al equipo de sistemas</small>";
                }
            }else{
                if ($IdArchPreliminar != "" || $IdArchFinal != "") {
                            
                    if($objE->agregarEntregableEspecifico()){
                        $exito = true;
                        $IdEntregableEspecif = $objE->getIdEntregableEspecifico();
                        $obj->setIdEntregableTextoFinal($IdEntregableEspecif);
						     if( isset($parametros['vobo0']) && $parametros['vobo0'] == 'on'){
                    $objE->setcheckDefinirTemas(1);
                  }else{
                    $objE->setcheckDefinirTemas(0);
                  }
               if( isset($parametros['vobo1']) && $parametros['vobo1'] == 'on'){
                    $objE->setcheckDefinirAgradecimiento(1);
                }else{
                    $objE->setcheckDefinirAgradecimiento(0);
                } 
                        for($i=0 ; $i<2 ; $i++){
                            $objE->setIdEntregableEspecifico($IdEntregableEspecif);
                            $objE->setIdCheckList($parametros['IdChkList'.$i]);
                            if( isset($parametros['vobo'.$i]) && $parametros['vobo'.$i] == "on"){
                                $objE->setValor(1);
                            }else{
                                $objE->setValor(0);
                            }
                            if($objE->agregarEntregableEspecifCheck()){
                                echo '<br><small>3Vobo '.($i+1).' se agregó correctamente 2</small>';
                            }else{
                             echo '<br><small>Vobo '.($i+1).' no se pudo agregar</small>';   
                            }
                        }
                        
                    }else{
                        $exito = false;
                        echo "<br><br><small>Error: No se pudo ligar el entregable,comuniquelo al equipo de sistemas</small>";
                    }
                }else{
                    echo "<br><br><small>Aviso: No se ligó ningún entregable, más adelante puede agregarlo actualizando el libro</small>";
                }       
            }
            //echo "<br>registro SC<br>";
            //return;
            /************c_textosLibro***********/
              $obj->setIdTexto($_POST['id']); 
              $obj->setIdLibro($_POST['IdLibro']);
              $obj->setIdAutor($parametros['autor']);
              $obj->setTituloTexto($parametros['tituloTexto']);
              //$obj->setNumCuartillas($parametros['numCuartillas']);
              $obj->setIdTipoTexto($parametros['tipoTexto']);
              $obj->setIdInstitucion($parametros['InstitucionAutor']);
              $obj->setUsuarioUltimaModificacion($_POST['usuario']);
              $obj->setPantalla('controller_gestionarInstitucionales');
            /***************Ficha Informativa******************************/

              $rutaPDF2 = $parametros['path0'];
              $index = 2;
                if (isset($_FILES[$index])) {
                    //echo '1';
                    if (file_exists("../../../" . $rutaPDF2 . $_FILES[$index]['name'])) {
                        //echo '<br>2<br>';
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.',  $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 . "(1)" . $archivo;
                        //$count =1;
                        $namesoloimagen= "(1)".$archivo;

                      
                   } else {

                        //echo "<br>3<br>";
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.', $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 .  $resultado;
                        $namesoloimagen= $resultado;
                    }
                    //echo '<br>4<br>';
                    $obj->setRutaEntregableEspFichaInformativa($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableEspFichaInformativa("");
                }

              /********************************************************************/
              /***********************Elaborar prop para Vo.bo***************************/
             
              if(isset($parametros['fechaEnvioPropVobo'])){
                 $obj->setfechaEnvioElabPropVobo($parametros['fechaEnvioPropVobo']);
              } 
              if(isset($parametros['fechaEntregaPlaneadaPropVobo'])){
                $obj->setFechaEntregaPlaneadaElabPropVobo($parametros['fechaEntregaPlaneadaPropVobo']);
              }
              if(isset($parametros['fechaEntregaRealPropVobo'])){
                $obj->setFechaEntregaRealElabPropVobo($parametros['fechaEntregaRealPropVobo']);
              }
              if(isset($parametros['fechaEntregaRealPropVobo'])){
                 $obj->setIdProveedorElabPropVobo($parametros['IdProveedor']);
              }
             
              if(isset($parametros['checkEnvInfoProy']) && $parametros['checkEnvInfoProy'] == 'on'){
                $obj->setCheckEnvInfoProy(1);
              }else{
                $obj->setCheckEnvInfoProy(0);
              }
              if(isset($parametros['checkRecibirProp']) && $parametros['checkRecibirProp'] == 'on'){
                 $obj->setCheckRecibirProp(1);
              }else{
                 $obj->setCheckRecibirProp(0);
              }
                $rutaPDF2 = $parametros['path1'];
                $index = 3;
                if (isset($_FILES[$index])) {
                    //echo '1';
                    if (file_exists("../../../" . $rutaPDF2 . $_FILES[$index]['name'])) {
                        //echo '<br>2<br>';
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.',  $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 . "(1)" . $archivo;
                        //$count =1;
                        $namesoloimagen= "(1)".$archivo;

                      
                   } else {

                        //echo "<br>3<br>";
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.', $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 .  $resultado;
                        $namesoloimagen= $resultado;
                    }
                    //echo '<br>4<br>';
                    $obj->setRutaEntregableElabPropuestaVobo($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableElabPropuestaVobo("");
                }
                
                
              /********************************************************************/
              /***********************Realizar Corrección de estilo***************************/
              $obj->setfechaEnvioVoboDireccion($parametros['fechaEnvioVoboDireccion']);
              $obj->setfechaEntregaVoboDireccion($parametros['fechaEntregaVoboDireccion']);
               if( isset($parametros['checkEnviarProp']) && $parametros['checkEnviarProp'] == 'on'){
                    $obj->setCheckEnviarPropVoboDir(1);
                  }else{
                    $obj->setCheckEnviarPropVoboDir(0);
                  }
               if( isset($parametros['checkRecibirTxtAutorizado']) && $parametros['checkRecibirTxtAutorizado'] == 'on'){
                    $obj->setCheckRecibirTextoAutorizadoVoboDir(1);
                }else{
                    $obj->setCheckRecibirTextoAutorizadoVoboDir(0);
                }    
              $rutaPDF2 = $parametros['path2'];
                $index = 4;
                if (isset($_FILES[$index])) {
                    //echo '1';
                    if (file_exists("../../../" . $rutaPDF2 . $_FILES[$index]['name'])) {
                        //echo '<br>2<br>';
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.',  $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 . "(1)" . $archivo;
                        //$count =1;
                        $namesoloimagen= "(1)".$archivo;

                      
                   } else {

                        //echo "<br>3<br>";
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.', $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 .  $resultado;
                        $namesoloimagen= $resultado;
                    }
                    //echo '<br>4<br>';
                    $obj->setRutaSolVoboDireccion($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaSolVoboDireccion("");
                }

                
                /******************* REALIZAR CORRECCIÓN DE ESTILO **********************/
                
                
                $obj->setIdCorrectorEstiloTextoCorregido($parametros['correctorEstilo']);
                $obj->setFechaEnvioTextoCorregido($parametros['fechaEnvioTxtCorregido']);
                $obj->setFechaEntregaTextoCorregido($parametros['fechaEntregaTxtCorregido']);
                $rutaPDF2 = $parametros['path3'];
                $index = 5;
                if (isset($_FILES[$index])) {
                    //echo '1';
                    if (file_exists("../../../" . $rutaPDF2 . $_FILES[$index]['name'])) {
                        //echo '<br>2<br>';
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.',  $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 . "(1)" . $archivo;
                        //$count =1;
                        $namesoloimagen= "(1)".$archivo;

                      
                   } else {

                        //echo "<br>3<br>";
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.', $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 .  $resultado;
                        $namesoloimagen= $resultado;
                    }
                    //echo '<br>4<br>';
                    $obj->setRutaEntregableTextoCorregido($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableTextoCorregido("");
                }


                $obj->setFechaEnvioTextoTraducido($parametros['fechaEnvioTxtTraducido']);
                /*$obj->setFechaEntregaPlaneadaTextoTraducido($parametros['fechaEntregaPlaneadaTxtTraducido']);*/
                $obj->setfechaEntregaRealTextoTraducido($parametros['fechaEntregaRealTxtTraducido']);
                $obj->setIdTraductorTextoTraducido($parametros['traductorTextTraducido']);
                
                $rutaPDF2 = $parametros['path4'];
                $index = 6;
                
                if (isset($_FILES[$index])) {
                    //echo '1';
                    if (file_exists("../../../" . $rutaPDF2 . $_FILES[$index]['name'])) {
                        //echo '<br>2<br>';
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.',  $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 . "(1)" . $archivo;
                        //$count =1;
                        $namesoloimagen= "(1)".$archivo;

                      
                   } else {

                        //echo "<br>3<br>";
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.', $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 .  $resultado;
                        $namesoloimagen= $resultado;
                    }
                    //echo '<br>4<br>';
                    $obj->setRutaEntregableTextoTraducido($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableTextoTraducido("");
                }
                
                /*********************SOLICITAR VOBO FINAL AUTOR*******************************/
                
                if( isset($parametros['checkboxVoboFinalAutor']) && $parametros['checkboxVoboFinalAutor'] == 'on'){
                $obj->setCheckVoboFinalAutor(1);
                }else{
                    $obj->setCheckVoboFinalAutor(0);
                }

                $obj->setFechaEnvioVoboFinal($parametros['fechaEnvioVoboFinalAutor']);
                /*$obj->setFechaEntregaPlaneadaVoboFina($parametros['fechaEntregaPlaneadaFinalAutor']);*/
                $obj->setFechaEntregaRealVoboFinal($parametros['fechaEntregaRealFinalAutor']);
                
                $rutaPDF2 = $parametros['path5'];
                $index = 7;
                
                
                if (isset($_FILES[$index])) {
                    //echo '1';
                    if (file_exists("../../../" . $rutaPDF2 . $_FILES[$index]['name'])) {
                        //echo '<br>2<br>';
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.',  $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 . "(1)" . $archivo;
                        //$count =1;
                        $namesoloimagen= "(1)".$archivo;

                      
                   } else {

                        //echo "<br>3<br>";
                        $archivo = $_FILES[$index]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.', $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[$index]['name'];

                        $nameimg = $rutaPDF2 .  $resultado;
                        $namesoloimagen= $resultado;
                    }
                    //echo '<br>4<br>';
                    $obj->setRutaEntregableVoboFinal($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableVoboFinal("");
                }

               
              /*********************************************************************/
              
            if($exito && $obj->editarTexto() && $obj->agregarSecretariaTextoPreliminar() && $obj->agregarINBALTextoPreliminar() && $obj->agregarMPBATextoPreliminar() && $obj->agregarPatrocinadorTextoPreliminar()){
              echo "<br><br>Éxito: El registro se modificó correctamente 3";
			 
            }else{
				echo "EXITO:".$exito;
              echo '<br><br>Error: 2El registro no se ha podido guardar';
            }

            break;
		 case 'eliminarPatrocinador':

             
                $ruta = "../../../resources/aplicaciones/Entregables/Publicaciones/DefinirFormato/Preliminar/";
          
           $obj->setIdTextoPatrocinador($_POST['IdTextoPatrocinador']);
           
            //echo$rutaConNameFile;
              if($obj->eliminarEntregableEspecificoVersionPatrocinador()){
            echo'Archivo eliminado'; 
            
         }else{
            echo 'Error: No se pudo eliminar la relación del archivo con la versión del archivo'; 
        } 
		 break;	
        case 'eliminarMPBA':

             
                $ruta = "../../../resources/aplicaciones/Entregables/Publicaciones/DefinirFormato/Preliminar/";
          
           $obj->setIdTextoMPBA($_POST['IdTextoDireccionMPBA']);
           
            //echo$rutaConNameFile;
              if($obj->eliminarEntregableEspecificoVersionMPBA()){
            echo'Archivo eliminado'; 
            
         }else{
            echo 'Error: No se pudo eliminar la relación del archivo con la versión del archivo'; 
        } 
		 break;
		 case 'eliminarINBAL':

             
                $ruta = "../../../resources/aplicaciones/Entregables/Publicaciones/DefinirFormato/Preliminar/";
          
           $obj->setIdTextoINBAL($_POST['IdTextoINBAL']);
           
            //echo$rutaConNameFile;
              if($obj->eliminarEntregableEspecificoVersionINBAL()){
            echo'Archivo eliminado'; 
            
         }else{
            echo 'Error: No se pudo eliminar la relación del archivo con la versión del archivo'; 
        } 

            break;
		case 'eliminar':

             
                $ruta = "../../../resources/aplicaciones/Entregables/Publicaciones/DefinirFormato/Preliminar/";
          
           $obj->setIdTextoSC($_POST['IdTextoSC']);
           
            //echo$rutaConNameFile;
              if($obj->eliminarEntregableEspecificoVersion()){
            echo'Archivo eliminado'; 
            
         }else{
            echo 'Error: No se pudo eliminar la relación del archivo con la versión del archivo'; 
        } 

            break;	
			
	case 'ModalDFPatrocinador':
			$rutaPDF = "";
				 if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
						 $obj->setRutaArchivoPreliminar($parametros['rutaArchivoPreliminar']);	
	
			   $obj->setPantalla('controller_gestionarInstitucionales');
			

            if (isset($_FILES)) {
                $agregoArchivo = true;
                echo 'El archivo es recibido';
				$rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/GestionarInstitucionales/TextoPatrocinador/TextoFinalPreliminar/";
				$file = $_FILES['entregablePreliminarMenu0'];
                if (file_exists("../../../" . $rutaPDF . $file['name'])) {
                    //echo '<br>2<br>';
					$file = $file['entregablePreliminarMenu0'];
                    $archivo = $file['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $file['name'];

                    $nameimg = $rutaPDF . "(1)" . $archivo;
                    //$count =1;
                    $namesoloimagen= "(1)".$archivo;

               } else {

                    //echo "<br>3<br>";
                    $archivo = $file['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $file['name'];

                    $nameimg = $rutaPDF .  $resultado;
                    $namesoloimagen= $resultado;
                }
                
            $objAC->setRuta('../../../'.$rutaPDF);
			  
			 $objAC->setPdfcedulafiscal($namesoloimagen);
				  move_uploaded_file($file['tmp_name'], "../../../" . $nameimg);
				  
				  $IdArchPreliminar = $parametros['IdArchivoPre'];
				   	$obj->setRutaArchivoPreliminar("../../../" . $nameimg);
				$obj->setIdArchPreliminar($IdArchPreliminar);
			$obj->setNombreArchivoPr($archivo);
			

            } else {
				
                $agregoArchivo = false;
                $objAC->setPdfcedulafiscal("");
            }
			
			  $obj->setIdLibro($_POST['IdLibro']);
			  $obj->setFechaPlaneadaPreliminar($parametros['FechaPlaneadaPreliminar']);
			$obj->setFechaRealPreliminar($parametros['FechaRealPreliminar']);
			
			
			 if($obj->agregarPatrocinadorTextoPreliminar()){
              echo "<br><br>Éxito: El registro se modificó correctamente 3";
			 
            }else{
              echo '<br><br>Error: 3El registro no se ha podido guardar';
            }
			
			break;
	
	case 'ModalDFMPBA':
					$rutaPDF = "";
				 if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
						 $obj->setRutaArchivoPreliminar($parametros['rutaArchivoPreliminar']);	
	
			   $obj->setPantalla('controller_gestionarInstitucionales');
			

            if (isset($_FILES)) {
                $agregoArchivo = true;
                echo 'El archivo es recibido';
				$rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/GestionarInstitucionales/TextoMPBA/TextoEntPreliminar/";
				$file = $_FILES['entregablePreliminarMenu0'];
                if (file_exists("../../../" . $rutaPDF . $file['name'])) {
                    //echo '<br>2<br>';
					$file = $file['entregablePreliminarMenu0'];
                    $archivo = $file['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $file['name'];

                    $nameimg = $rutaPDF . "(1)" . $archivo;
                    //$count =1;
                    $namesoloimagen= "(1)".$archivo;

               } else {

                    //echo "<br>3<br>";
                    $archivo = $file['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $file['name'];

                    $nameimg = $rutaPDF .  $resultado;
                    $namesoloimagen= $resultado;
                }
                
            $objAC->setRuta('../../../'.$rutaPDF);
			  
			 $objAC->setPdfcedulafiscal($namesoloimagen);
				  move_uploaded_file($file['tmp_name'], "../../../" . $nameimg);
				  
				  $IdArchPreliminar = $parametros['IdArchivoPre'];
				   	$obj->setRutaArchivoPreliminar("../../../" . $nameimg);
				$obj->setIdArchPreliminar($IdArchPreliminar);
			$obj->setNombreArchivoPr($archivo);
			

            } else {
				
                $agregoArchivo = false;
                $objAC->setPdfcedulafiscal("");
            }
			
			  $obj->setIdLibro($_POST['IdLibro']);
			  $obj->setFechaPlaneadaPreliminar($parametros['FechaPlaneadaPreliminar']);
			$obj->setFechaRealPreliminar($parametros['FechaRealPreliminar']);
			
			
			 if($obj->agregarMPBATextoPreliminar()){
              echo "<br><br>Éxito: El registro se modificó correctamente 3";
			 
            }else{
              echo '<br><br>Error: 4El registro no se ha podido guardar';
            }

				break;
	case 'ModalDFINBAL':
					$rutaPDF = "";
				 if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
						 $obj->setRutaArchivoPreliminar($parametros['rutaArchivoPreliminar']);	
	
			   $obj->setPantalla('controller_gestionarInstitucionales');
			

            if (isset($_FILES)) {
                $agregoArchivo = true;
                echo 'El archivo es recibido';
				$rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/GestionarInstitucionales/TextoINBAL/TextoEntPreliminar/";
				$file = $_FILES['entregablePreliminarMenu0'];
                if (file_exists("../../../" . $rutaPDF . $file['name'])) {
                    //echo '<br>2<br>';
					$file = $file['entregablePreliminarMenu0'];
                    $archivo = $file['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $file['name'];

                    $nameimg = $rutaPDF . "(1)" . $archivo;
                    //$count =1;
                    $namesoloimagen= "(1)".$archivo;

               } else {

                    //echo "<br>3<br>";
                    $archivo = $file['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $file['name'];

                    $nameimg = $rutaPDF .  $resultado;
                    $namesoloimagen= $resultado;
                }
                
            $objAC->setRuta('../../../'.$rutaPDF);
			  
			 $objAC->setPdfcedulafiscal($namesoloimagen);
				  move_uploaded_file($file['tmp_name'], "../../../" . $nameimg);
				  
				  $IdArchPreliminar = $parametros['IdArchivoPre'];
				   	$obj->setRutaArchivoPreliminar("../../../" . $nameimg);
				$obj->setIdArchPreliminar($IdArchPreliminar);
			$obj->setNombreArchivoPr($archivo);
			

            } else {
				
                $agregoArchivo = false;
                $objAC->setPdfcedulafiscal("");
            }
			
			  $obj->setIdLibro($_POST['IdLibro']);
			  $obj->setFechaPlaneadaPreliminar($parametros['FechaPlaneadaPreliminar']);
			$obj->setFechaRealPreliminar($parametros['FechaRealPreliminar']);
			
			
			 if($obj->agregarINBALTextoPreliminar()){
              echo "<br><br>Éxito: El registro se modificó correctamente 3";
			 
            }else{
              echo '<br><br>Error: 5El registro no se ha podido guardar';
            }

				break;
	case 'ModalDF':
			$rutaPDF = "";
				 if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
						 $obj->setRutaArchivoPreliminar($parametros['rutaArchivoPreliminar']);	
	
			   $obj->setPantalla('controller_gestionarInstitucionales');
			

            if (isset($_FILES)) {
                $agregoArchivo = true;
                echo 'El archivo es recibido';
				$rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/GestionarInstitucionales/TextoSC/TextoEntPreliminar/";
				$file = $_FILES['entregablePreliminarMenu0'];
                if (file_exists("../../../" . $rutaPDF . $file['name'])) {
                    //echo '<br>2<br>';
					$file = $file['entregablePreliminarMenu0'];
                    $archivo = $file['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $file['name'];

                    $nameimg = $rutaPDF . "(1)" . $archivo;
                    //$count =1;
                    $namesoloimagen= "(1)".$archivo;

               } else {

                    //echo "<br>3<br>";
                    $archivo = $file['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $file['name'];

                    $nameimg = $rutaPDF .  $resultado;
                    $namesoloimagen= $resultado;
                }
                
            $objAC->setRuta('../../../'.$rutaPDF);
			  
			 $objAC->setPdfcedulafiscal($namesoloimagen);
				  move_uploaded_file($file['tmp_name'], "../../../" . $nameimg);
				  
				  $IdArchPreliminar = $parametros['IdArchivoPre'];
				   	$obj->setRutaArchivoPreliminar("../../../" . $nameimg);
				$obj->setIdArchPreliminar($IdArchPreliminar);
			$obj->setNombreArchivoPr($archivo);
			

            } else {
				
                $agregoArchivo = false;
                $objAC->setPdfcedulafiscal("");
            }
			
			  $obj->setIdLibro($_POST['IdLibro']);
			  $obj->setFechaPlaneadaPreliminar($parametros['FechaPlaneadaPreliminar']);
			$obj->setFechaRealPreliminar($parametros['FechaRealPreliminar']);
			
			
			 if($obj->agregarSecretariaTextoPreliminar() ){
              echo "<br><br>Éxito: El registro se modificó correctamente 3";
			 
            }else{
              echo '<br><br>Error: 6El registro no se ha podido guardar';
            }

            break;

    }
}