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
if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

           //echo "Entra:";
          /*************c_documento******************//////////////    
            $IdArchPreliminar = $parametros['IdArchivoPre'];
            $IdArchFinal = $parametros['IdArchivoFinal'];
            $exito = true;
            $agregoArchivo = false;
            $objAC->setUsuarioUltimaModificacion($_POST['usuario']);
            $objAC->setPantalla('Controller_gestionarEnsayo(Publicaciones)');
            $objAC->setId_usuario('NULL');
            $objAC->setAnio($parametros['anio']);
            $objAC->setId_tipo('9');
            $objAC->setId_area('16');
            $objAC->setId_destino('NULL');
            $objAC->setId_destino2('NULL');
            if($parametros['nombreArchPre'] != ""){
                $objAC->setDescripcion($parametros['nombreArchPre']);
            }else{
                $objAC->setDescripcion('Entregable ensayo Preliminar del libro '.$parametros['titulo'].',Texto: '.$parametros['tituloTexto'] );
                $objAC->setUsuarioCreacion($_POST['usuario']);
            }
            
            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/EnsayoPreliminar/";
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
                    echo "<br>El archivo del entregable <b><i>Ensayo (Preliminar)</i></b> ha sido modificado";
                }else{
                    //echo "Error:Entra aqui";
                    if($objAC->nuevoAcuerdo()){
                    $IdArchPreliminar = $objAC->getId_documento();
                    //$exito = true;
                    }else{
                    echo 'Error: El archivo para el entregable <b>Ensayo (Preliminar) de libro<i>'.$parametros['titulo'].'</i></b> no se generó, intente nuevamente';
                      return;
                    }
                }
                
            }

           
            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/EnsayoFinal/";
            $objAC->setRuta('../../../'.$rutaPDF);
            if($parametros['nombreArchFinal'] != ""){
                $objAC->setDescripcion($parametros['nombreArchFinal']);
                $objAC->setUsuarioCreacion($_POST['usuario']);
            }else{
                $objAC->setDescripcion('Entregable ensayo Final del libro '.$parametros['titulo'].',Texto: '.$parametros['tituloTexto']);
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
                    echo "<br>El archivo del entregable <b><i>Ensayo  (Final)</i></b> ha sido modificado";
                }else{
                    //echo "Error:Entra aqui";
                    if($objAC->nuevoAcuerdo()){
                    $IdArchFinal = $objAC->getId_documento();
                    //$exito = true;
                    }else{
                    echo 'Error: El archivo para el entregable <b>Ensayo (Final) de libro<i>'.$parametros['titulo'].'</i></b> no se generó, intente nuevamente';
                      return;
                    }
                }
                
            }

             /*************c_entregableEspecifico***********//////////
            $objE->setIdArchPreliminar($IdArchPreliminar);
            $objE->setIdArchFinal($IdArchFinal);
            $objE->setIdEntregable($parametros['IdEntregable']);
            if($parametros['nombreEntEsp'] != ""){
                $objE->setDescripcion($parametros['nombreEntEsp']);
            }else{
                $objE->setDescripcion('Ensayo final del libro '.$parametros['titulo'].',Texto: '.$parametros['tituloTexto']);
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
                        /*for($i=0 ; $i<1 ; $i++){
                            $objE->setIdEntregableEspecifico($IdEntregableEspecif);
                            $objE->setIdCheckList($parametros['IdChkList'.$i]);
                            if( isset($parametros['vobo'.$i]) && $parametros['vobo'.$i] == "on"){
                                $objE->setValor(1);
                            }else{
                                $objE->setValor(0);
                            }
                            if($objE->agregarEntregableEspecifCheck()){
                                echo '<br><small>Vobo '.($i+1).' se agregó correctamente</small>';
                            }else{
                             echo '<br><small>Vobo '.($i+1).' no se pudo agregar</small>';   
                            }
                        }*/
                        
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
              $obj->setNumCuartillas($parametros['numCuartillas']);
              $obj->setIdTipoTexto($parametros['tipoTexto']);
              $obj->setIdInstitucion($parametros['InstitucionAutor']);
              $obj->setUsuarioCreacion($_POST['usuario']);
              $obj->setUsuarioUltimaModificacion($_POST['usuario']);
              $obj->setPantalla('Controller_gestionarEnsayo');

              /***************SolicitarTextoAutor**********************************/
              $obj->setFechaEnvioCartaSolicitud($parametros['fechaEnvioCartaSol']);
              $obj->setFechaAceptacionCartaSolicitud($parametros['fechaAceptacionCartaSol']);
              if( isset($parametros['checkCartaSol']) && $parametros['checkCartaSol'] == 'on'){
                $obj->setCheckCartaSolicitud(1);
              }else{
                $obj->setCheckCartaSolicitud(0);
              }
              $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/CartaSolicitud/";
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
                    $obj->setRutaEntregableCartaSolicitud($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableCartaSolicitud("");
                }

                $obj->setFechaEntregaPlaneadaTextoPreliminar($parametros['fechaEntregaPlaneadaTxtPre']);
                $obj->setFechaEntregaRealTextoPreliminar($parametros['fechaEntregaRealTxtPre']);

                $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/TextoPreliminar/";
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
                    $obj->setRutaEntregableTextoPreliminarSolicitar($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableTextoPreliminarSolicitar("");
                }
                $obj->setFechaEntregaPlaneadaTextoPreliminar($parametros['fechaEntregaPlaneadaTxtPre']);
                $obj->setFechaEntregaRealTextoPreliminar($parametros['fechaEntregaRealTxtPre']);
                
                $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/ResumenSol/";

                //echo "<br>Aqui textarea:".$parametros['sinopsisResumen']."</br>";
                $obj->setSinopsisSolicitar($parametros['sinopsisResumenTextAutor']);
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
                    $obj->setRutaEntregableResumenSolicitar($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableResumenSolicitar("");
                }  
              /********************************************************************/
              /***********************FORMALIZAR CONVENIO***************************/
              //echo "<br>Aqui textarea:".$parametros['sinopsisResumen']."</br>";
               if( isset($parametros['checkConvenioFirmado']) && $parametros['checkConvenioFirmado'] == 'on'){
                $obj->setCheckConvenioFirmado(1);
              }else{
                $obj->setCheckConvenioFirmado(0);
              }
              $obj->setFechaEnvioAutorConvenioFirmado($parametros['fechaEnvioConvFirmado']);
              $obj->setFechaEntregaPlaneadaAutorConvenioFirmado($parametros['fechaPlaneadaConvFirmado']);
              $obj->setfechaEntregaRealAutorConvenioFirmado($parametros['fechaEntregaConvFirmado']);
                $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/ConvenioFirmado/";
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
                    $obj->setRutaEntregableConvenioFirmado($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableConvenioFirmado("");
                }

                $obj->setFechaEnvioJuridicoConvenio($parametros['fechaEnvioJuridico']);
                $obj->setFechaEntregaJuridicoConvenio($parametros['fechaEntregaJuridico']);
                 if( isset($parametros['checkBasesConvenio']) && $parametros['checkBasesConvenio'] == 'on'){
                    $obj->setCheckBasesConvenio(1);
                  }else{
                    $obj->setCheckBasesConvenio(0);
                  }
                $rutaPDF2 = "/resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/BasesConvenio/";
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
                    $obj->setRutaEntregableBasesConvenio($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableBasesConvenio("");
                }
              /********************************************************************/
              /*****************************EDITAR TEXTOS***************************/
             
              $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/";
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
                    $obj->setRutaEntregableTextoEditado($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableTextoEditado("");
                }

                $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/ComentariosEditor/";
                if( isset($parametros['checkComentariosEditor']) && $parametros['checkComentariosEditor'] == 'on'){
                $obj->setCheckComentariosEditor(1);
                  }else{
                    $obj->setCheckComentariosEditor(0);
                  }
                $index = 8;
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
                    $obj->setRutaEntregableComentariosEditor($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableComentariosEditor("");
                }

                $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/ObsVoboAutor/";
                $obj->setfechaEnvioObservacionesVoboAutor($parametros['fechaEnvioObsVoboAutor']);
                 $obj->setFechaEntregaPlaneadaObservacionesVoboAutor($parametros['fechaEntregaPlaneadaObsVoboAutor']);
                $obj->setFechaEntregaRealObservacionesVoboAutor($parametros['fechaEntregaRealObsVoboAutor']);
                $index = 9;
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
                    $obj->setRutaEntregableObservacionesVoboAutor($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableObservacionesVoboAutor("");
                }

                $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/TextoTraducido/";
                $obj->setFechaEnvioTextoTraducido($parametros['fechaEnvioTxtTraducido']);
                 $obj->setFechaEntregaPlaneadaTextoTraducido($parametros['fechaEntregaPlaneadaTxtTraducido']);
                $obj->setfechaEntregaRealTextoTraducido($parametros['fechaEntregaRealTxtTraducido']);
                $obj->setIdTraductorTextoTraducido($parametros['traductorTextTraducido']);
                $obj->setIdiomaATraducir($parametros['idiomaTraducir']);
                $obj->setIdiomaOriginal($parametros['idiomaOriginal']);
                $index = 10;
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

                $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/CotejoTraduccion/";
                $obj->setFechaEnvioCotejoTraduccion($parametros['fechaEnvioCotejoTraduccion']);
                 $obj->setFechaEntregaPlaneadaCotejoTraduccion($parametros['fechaEntregaPlaneadaCotejoTraduccion']);
                $obj->setFechaEntregaRealCotejoTraduccion($parametros['fechaEntregaRealCotejoTraduccion']);
                $obj->setIdTraductorCotejoTraduccion($parametros['TraductorCotejo']);
               
                $index = 11;
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
                    $obj->setRutaEntregableCotejoTraduccion($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableCotejoTraduccion("");
                }

                $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/TextoCorregido/";
                
                $obj->setIdCorrectorEstiloTextoCorregido($parametros['correctorEstilo']);
               
                $index = 12;
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
                /*********************SOLICITAR VOBO FINAL AUTOR*******************************/
                $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/VoboFinal/";
                
                if( isset($parametros['checkboxVoboFinalAutor']) && $parametros['checkboxVoboFinalAutor'] == 'on'){
                $obj->setCheckVoboFinalAutor(1);
                }else{
                    $obj->setCheckVoboFinalAutor(0);
                }

                $obj->setFechaEnvioVoboFinal($parametros['fechaEnvioVoboFinalAutor']);
                $obj->setFechaEntregaPlaneadaVoboFina($parametros['fechaEntregaPlaneadaFinalAutor']);
                $obj->setFechaEntregaRealVoboFinal($parametros['fechaEntregaRealFinalAutor']);
               
                $index = 13;
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

                $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/ResumenFinal/";
                
                $obj->setSinopsisVoboFinal($parametros['sinopsisResumen']);
               
                $index = 14;
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
                    $obj->setRutaEntregableResumenVoboFinal($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableResumenVoboFinal("");
                }
              /*********************************************************************/    
            if($exito && $obj->agregarTexto()){
                echo "<br><br>Éxito: El registro se guardo correctamente";    
            }else{
                echo 'Error: El registro no se ha podido guardar';
            }
            //return;

            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

           
          /*************c_documento******************//////////////    
            $IdArchPreliminar = $parametros['IdArchivoPre'];
            $IdArchFinal = $parametros['IdArchivoFinal'];
            $exito = true;
            $agregoArchivo = false;
            $objAC->setUsuarioUltimaModificacion($_POST['usuario']);
            $objAC->setPantalla('Controller_gestionarEnsayo(Publicaciones)');
            $objAC->setId_usuario('NULL');
            $objAC->setAnio($parametros['anio']);
            $objAC->setId_tipo('9');
            $objAC->setId_area('16');
            $objAC->setId_destino('NULL');
            $objAC->setId_destino2('NULL');
            if($parametros['nombreArchPre'] != ""){
                $objAC->setDescripcion($parametros['nombreArchPre']);
            }else{
                $objAC->setDescripcion('Entregable ensayo Preliminar del libro '.$parametros['titulo'].',Texto: '.$parametros['tituloTexto'] );
                $objAC->setUsuarioCreacion($_POST['usuario']);
            }
            
            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/EnsayoPreliminar/";
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
                    echo "<br>El archivo del entregable <b><i>Ensayo (Preliminar)</i></b> ha sido modificado";
                }else{
                    //echo "Error:Entra aqui";
                    if($objAC->nuevoAcuerdo()){
                    $IdArchPreliminar = $objAC->getId_documento();
                    //$exito = true;
                    }else{
                    echo 'Error: El archivo para el entregable <b>Ensayo (Preliminar) de libro<i>'.$parametros['titulo'].'</i></b> no se generó, intente nuevamente';
                      return;
                    }
                }
                
            }

           
            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/EnsayoFinal/";
            $objAC->setRuta('../../../'.$rutaPDF);
            if($parametros['nombreArchFinal'] != ""){
                $objAC->setDescripcion($parametros['nombreArchFinal']);
                $objAC->setUsuarioCreacion($_POST['usuario']);
            }else{
                $objAC->setDescripcion('Entregable ensayo Final del libro '.$parametros['titulo'].',Texto: '.$parametros['tituloTexto']);
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
                    echo "<br>El archivo del entregable <b><i>Ensayo  (Final)</i></b> ha sido modificado";
                }else{
                    //echo "Error:Entra aqui";
                    if($objAC->nuevoAcuerdo()){
                    $IdArchFinal = $objAC->getId_documento();
                    //$exito = true;
                    }else{
                    echo 'Error: El archivo para el entregable <b>Ensayo (Final) de libro<i>'.$parametros['titulo'].'</i></b> no se generó, intente nuevamente';
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
                $objE->setDescripcion('Ensayo final del libro '.$parametros['titulo'].',Texto: '.$parametros['tituloTexto']);
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
                        /*for($i=0 ; $i<1 ; $i++){
                            $objE->setIdEntregableEspecifico($IdEntregableEspecif);
                            $objE->setIdCheckList($parametros['IdChkList'.$i]);
                            if( isset($parametros['vobo'.$i]) && $parametros['vobo'.$i] == "on"){
                                $objE->setValor(1);
                            }else{
                                $objE->setValor(0);
                            }
                            if($objE->editarEntregableEspecifCheck()){
                            echo '<br><small>Vobo '.($i+1).' se modificó correctamente</small>';
                            }else{
                             echo '<br><small>Vobo '.($i+1).' no se pudo modificar</small>';   
                            }
                        }*/
                        
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
                        /*for($i=0 ; $i<1 ; $i++){
                            $objE->setIdEntregableEspecifico($IdEntregableEspecif);
                            $objE->setIdCheckList($parametros['IdChkList'.$i]);
                            if( isset($parametros['vobo'.$i]) && $parametros['vobo'.$i] == "on"){
                                $objE->setValor(1);
                            }else{
                                $objE->setValor(0);
                            }
                            if($objE->agregarEntregableEspecifCheck()){
                                echo '<br><small>Vobo '.($i+1).' se agregó correctamente</small>';
                            }else{
                             echo '<br><small>Vobo '.($i+1).' no se pudo agregar</small>';   
                            }
                        }*/
                        
                    }else{
                        $exito = false;
                        echo "<br><br><small>Error: No se pudo ligar el entregable,comuniquelo al equipo de sistemas</small>";
                    }
                }else{
                    echo "<br><br><small>Aviso: No se ligó ningún entregable, más adelante puede agregarlo actualizando el libro</small>";
                }       
            }

            
            /************c_textosLibro***********/
              $obj->setIdTexto($_POST['id']); 
              $obj->setIdLibro($_POST['IdLibro']);
              $obj->setIdAutor($parametros['autor']);
              $obj->setTituloTexto($parametros['tituloTexto']);
              $obj->setNumCuartillas($parametros['numCuartillas']);
              $obj->setIdTipoTexto($parametros['tipoTexto']);
              $obj->setIdInstitucion($parametros['InstitucionAutor']);
              $obj->setUsuarioUltimaModificacion($_POST['usuario']);

              /***************SolicitarTextoAutor**********************************/
              $obj->setFechaEnvioCartaSolicitud($parametros['fechaEnvioCartaSol']);
              $obj->setFechaAceptacionCartaSolicitud($parametros['fechaAceptacionCartaSol']);
              if( isset($parametros['checkCartaSol']) && $parametros['checkCartaSol'] == 'on'){
                $obj->setCheckCartaSolicitud(1);
              }else{
                $obj->setCheckCartaSolicitud(0);
              }
              $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/CartaSolicitud/";
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
                    $obj->setRutaEntregableCartaSolicitud($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableCartaSolicitud("");
                }

                $obj->setFechaEntregaPlaneadaTextoPreliminar($parametros['fechaEntregaPlaneadaTxtPre']);
                $obj->setFechaEntregaRealTextoPreliminar($parametros['fechaEntregaRealTxtPre']);

                $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/TextoPreliminar/";
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
                    $obj->setRutaEntregableTextoPreliminarSolicitar($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableTextoPreliminarSolicitar("");
                }
                $obj->setFechaEntregaPlaneadaTextoPreliminar($parametros['fechaEntregaPlaneadaTxtPre']);
                $obj->setFechaEntregaRealTextoPreliminar($parametros['fechaEntregaRealTxtPre']);
                
                $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/ResumenSol/";

                //echo "<br>Aqui textarea:".$parametros['sinopsisResumen']."</br>";
                $obj->setSinopsisSolicitar($parametros['sinopsisResumenTextAutor']);
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
                    $obj->setRutaEntregableResumenSolicitar($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableResumenSolicitar("");
                }  
              /********************************************************************/
              /***********************FORMALIZAR CONVENIO***************************/
              //echo "<br>Aqui textarea:".$parametros['sinopsisResumen']."</br>";
               if( isset($parametros['checkConvenioFirmado']) && $parametros['checkConvenioFirmado'] == 'on'){
                $obj->setCheckConvenioFirmado(1);
              }else{
                $obj->setCheckConvenioFirmado(0);
              }
              $obj->setFechaEnvioAutorConvenioFirmado($parametros['fechaEnvioConvFirmado']);
              $obj->setFechaEntregaPlaneadaAutorConvenioFirmado($parametros['fechaPlaneadaConvFirmado']);
              $obj->setfechaEntregaRealAutorConvenioFirmado($parametros['fechaEntregaConvFirmado']);
                $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/ConvenioFirmado/";
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
                    $obj->setRutaEntregableConvenioFirmado($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableConvenioFirmado("");
                }

                $obj->setFechaEnvioJuridicoConvenio($parametros['fechaEnvioJuridico']);
                $obj->setFechaEntregaJuridicoConvenio($parametros['fechaEntregaJuridico']);
                 if( isset($parametros['checkBasesConvenio']) && $parametros['checkBasesConvenio'] == 'on'){
                    $obj->setCheckBasesConvenio(1);
                  }else{
                    $obj->setCheckBasesConvenio(0);
                  }
                $rutaPDF2 = "/resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/BasesConvenio/";
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
                    $obj->setRutaEntregableBasesConvenio($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableBasesConvenio("");
                }
              /********************************************************************/
              /*****************************EDITAR TEXTOS***************************/
             
              $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/";
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
                    $obj->setRutaEntregableTextoEditado($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableTextoEditado("");
                }

                $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/ComentariosEditor/";
                if( isset($parametros['checkComentariosEditor']) && $parametros['checkComentariosEditor'] == 'on'){
                $obj->setCheckComentariosEditor(1);
                  }else{
                    $obj->setCheckComentariosEditor(0);
                  }
                $index = 8;
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
                    $obj->setRutaEntregableComentariosEditor($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableComentariosEditor("");
                }

                $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/ObsVoboAutor/";
                $obj->setfechaEnvioObservacionesVoboAutor($parametros['fechaEnvioObsVoboAutor']);
                 $obj->setFechaEntregaPlaneadaObservacionesVoboAutor($parametros['fechaEntregaPlaneadaObsVoboAutor']);
                $obj->setFechaEntregaRealObservacionesVoboAutor($parametros['fechaEntregaRealObsVoboAutor']);
                $index = 9;
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
                    $obj->setRutaEntregableObservacionesVoboAutor($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableObservacionesVoboAutor("");
                }

                $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/TextoTraducido/";
                $obj->setFechaEnvioTextoTraducido($parametros['fechaEnvioTxtTraducido']);
                 $obj->setFechaEntregaPlaneadaTextoTraducido($parametros['fechaEntregaPlaneadaTxtTraducido']);
                $obj->setfechaEntregaRealTextoTraducido($parametros['fechaEntregaRealTxtTraducido']);
                $obj->setIdTraductorTextoTraducido($parametros['traductorTextTraducido']);
                $obj->setIdiomaATraducir($parametros['idiomaTraducir']);
                $obj->setIdiomaOriginal($parametros['idiomaOriginal']);
                $index = 10;
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

                $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/CotejoTraduccion/";
                $obj->setFechaEnvioCotejoTraduccion($parametros['fechaEnvioCotejoTraduccion']);
                 $obj->setFechaEntregaPlaneadaCotejoTraduccion($parametros['fechaEntregaPlaneadaCotejoTraduccion']);
                $obj->setFechaEntregaRealCotejoTraduccion($parametros['fechaEntregaRealCotejoTraduccion']);
                $obj->setIdTraductorCotejoTraduccion($parametros['TraductorCotejo']);
               
                $index = 11;
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
                    $obj->setRutaEntregableCotejoTraduccion($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableCotejoTraduccion("");
                }

                $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/TextoCorregido/";
                
                $obj->setIdCorrectorEstiloTextoCorregido($parametros['correctorEstilo']);
               
                $index = 12;
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
                /*********************SOLICITAR VOBO FINAL AUTOR*******************************/
                $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/VoboFinal/";
                
                if( isset($parametros['checkboxVoboFinalAutor']) && $parametros['checkboxVoboFinalAutor'] == 'on'){
                $obj->setCheckVoboFinalAutor(1);
                }else{
                    $obj->setCheckVoboFinalAutor(0);
                }

                $obj->setFechaEnvioVoboFinal($parametros['fechaEnvioVoboFinalAutor']);
                $obj->setFechaEntregaPlaneadaVoboFina($parametros['fechaEntregaPlaneadaFinalAutor']);
                $obj->setFechaEntregaRealVoboFinal($parametros['fechaEntregaRealFinalAutor']);
               
                $index = 13;
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

                $rutaPDF2 = "resources/aplicaciones/Entregables/Publicaciones/GestionarEnsayo/ResumenFinal/";
                
                $obj->setSinopsisVoboFinal($parametros['sinopsisResumen']);
               
                $index = 14;
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
                    $obj->setRutaEntregableResumenVoboFinal($namesoloimagen);

                    move_uploaded_file($_FILES[$index]['tmp_name'], "../../../" . $nameimg);
                } else {
                    //echo '<br>5<br>';
                    $obj->setRutaEntregableResumenVoboFinal("");
                }
              /*********************************************************************/
              /*$obj->setAnioEdicion($parametros['anioEdicion']);
              $obj->setTirajeBilingue($parametros['tirajeBilingue']);
              $obj->setTirajeEspanol($parametros['tirajeEspanol']);
              $obj->setTirajeIngles($parametros['tirajeIngles']);
              $obj->setTirajeTotal($parametros['tirajeTotal']*/ 
              //$exito=true;
            if($exito && $obj->editarTexto()){

                /*$obj->obtenerCaracteristicasTecnicas();
                $IdCaracTecnica = $obj->getIdCaracTecnicas();
                $obj->setIdCaracTecnicas($IdCaracTecnica);
                $obj->eliminarPapelRecubrimiento();

                while ($totalPaPelRecubrimiento > $cont){

                  if (!isset($parametros['tipoPapelR' . $aux])){
                      $aux += 1;
                      continue;
                  }
                  $obj->setIdTipoPapelRecubrimiento($parametros['tipoPapelR' . $aux]);
                  $obj->setNumeroPaginas($parametros['paginasPapelR' . $aux]);
                  $obj->setDescripcionPapelRecubrimiento($parametros['descPapelR' . $aux]);
                  $obj->agregarPapelRecubrimiento();
                  $aux += 1;
                  $cont += 1;
                }
                $obj->eliminarImpresion();
                while ($totalImp > $contImp){

                  if (!isset($parametros['tipoImpresion' . $auxImp])){
                      $auxImp += 1;
                      continue;
                  }
                  $obj->setIdTipoImpresion($parametros['tipoImpresion' . $auxImp]);
                  $obj->setDescripcionImpresion($parametros['descImpresion' . $auxImp]);

                  $obj->agregarImpresion();
                  $auxImp += 1;
                  $contImp += 1;
                }
                $obj->eliminarAcabado();
                while ($totalAcabado > $contAcabado){

                  if (!isset($parametros['tipoAcabado' . $auxAcabado])){
                      $auxAcabado += 1;
                      continue;
                  }
                  $obj->setIdTipoAcabado($parametros['tipoAcabado' . $auxAcabado]);
                  $obj->setDescripcionAcabado($parametros['descAcabado' . $auxAcabado]);

                  $obj->agregarAcabado();
                  $auxAcabado += 1;
                  $contAcabado += 1;
                }*/

              echo "<br><br>Éxito: El registro se modificó correctamente";
            }else{
              echo '<br><br>Error: El registro no se ha podido guardar';
            }

            break;
        case 'eliminar':


            break;
    }
}