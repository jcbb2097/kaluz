<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once ('../../Classes/DefinirFormato.class.php');
include_once ('../../Classes/ArchivoCompartido.class.php');
include_once ('../../Classes/EntregableEspecifico.class.php');
include_once("../../Classes/Catalogo.class.php");
//echo "accion".$_POST['accion'];
$catalogo = new Catalogo();
$obj = new DefinirFormato();
$objE = new EntregableEspecifico();
$objAC = new ArchivoCompartido();
if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
        
        
        /***********c_libro**************************/
        $obj->setIdActividad($parametros['actividad']);
        $obj->setTitulo($parametros['titulo']);
        $obj->setISBN($parametros['isbn']);
        $obj->setIdPeriodo($parametros['anio']);
        $obj->setIdExposicion($parametros['exposicion']);
        $obj->setResena($parametros['resena']);
        $obj->setISSN($parametros['issn']);
        $obj->setEstado($parametros['estado']);
        $obj->setAnioPublicacion($parametros['fechaPublicacion']);

        $obj->setUsuarioUltimaModificiacion($_POST['usuario']);
        $obj->setUsuarioCreacion($_POST['usuario']);
        $obj->setPantalla('Controller_definirFormato');


        if( (isset($parametros['concepto']) && $parametros['concepto'] == 2) || (isset($parametros['concepto']) && $parametros['concepto'] == 3) ){
            $obj->setIdInstitucionesLibro($parametros['instituciones']);
        }else{
            $obj->setIdInstitucionesLibro("");
        }
        $rutaimg = "resources/aplicaciones/imagenes/Publicaciones/";
            if (isset($_FILES[2])) {
                //echo '1';
                if (file_exists("../../../" . $rutaimg . $_FILES[2]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[2]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[2]['name'];

                    $nameimg = $rutaimg . "(1)" . $archivo;
                   
                    $namesoloimagen= "(1)".$archivo;

                   
               } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[2]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[2]['name'];

                    $nameimg = $rutaimg .  $resultado;
                    $namesoloimagen= $resultado;
                }
                //echo '<br>4<br>';
                $obj->setImagen($namesoloimagen);

                move_uploaded_file($_FILES[2]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setImagen("");
            }
            $rutaPDF = "resources/aplicaciones/PDF/Publicaciones/";
            if (isset($_FILES[3])) {
                //echo '1';
                if (file_exists("../../../" . $rutaPDF . $_FILES[3]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[3]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[3]['name'];

                    $nameimg = $rutaPDF . "(1)" . $archivo;
                   
                    $namesoloimagen= "(1)".$archivo;

                   
               } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[3]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[3]['name'];

                    $nameimg = $rutaPDF .  $resultado;
                    $namesoloimagen= $resultado;
                }
                //echo '<br>4<br>';
                $obj->setPDF($namesoloimagen);

                move_uploaded_file($_FILES[3]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setPDF("");
            }
            $rutaPDF2 = "vista/apps/Publicaciones/pdfIndice/";
            if (isset($_FILES[4])) {
                //echo '1';
                if (file_exists("../../../" . $rutaPDF2 . $_FILES[4]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[4]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[4]['name'];

                    $nameimg = $rutaPDF2 . "(1)" . $archivo;
                    //$count =1;
                    $namesoloimagen= "(1)".$archivo;

                  
               } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[4]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[4]['name'];

                    $nameimg = $rutaPDF2 .  $resultado;
                    $namesoloimagen= $resultado;
                }
                //echo '<br>4<br>';
                $obj->setPDFindice($namesoloimagen);

                move_uploaded_file($_FILES[4]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '<br>5<br>';
                $obj->setPDFindice("");
            }
        if ($obj->agregarLibro()) {

            $IdLibro = $obj->getIdLibro();
            $obj->setIdLibro($IdLibro);
            $objE->setIdEntregable($parametros['IdEntregable']);
            $objE->setDescripcion('Formato definido del libro '.$parametros['titulo']);
            /*************c_documento******************//////////////    
            $IdArchPreliminar = "";
            $IdArchFinal = "";
            $exito = false;

            $objAC->setUsuarioUltimaModificacion($_POST['usuario']);
            $objAC->setUsuarioCreacion($_POST['usuario']);
            $objAC->setPantalla('Controller_definirFormato(Publicaciones)');
            $objAC->setId_usuario('NULL');
            $objAC->setAnio($parametros['anio']);
            $objAC->setId_tipo('9');
            $objAC->setId_area('16');
            $objAC->setId_destino('NULL');
            $objAC->setId_destino2('NULL');
            $objAC->setDescripcion('Archivo Definir formato Preliminar del libro'.$parametros['titulo']);
            $exito = true;
            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/DefinirFormato/Preliminar/";
            $agregoArchivo = false;
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
            if($objAC->nuevoAcuerdo()){
            $IdArchPreliminar = $objAC->getId_documento();
            //$exito = true;
            }else{
            echo 'Warning: El archivo para el entregable <b>Definir formato Preliminar de libro<i>'.$parametros['titulo'].'</i></b> nose generó, intente nuevamente';
            //return;
            }
        }
        $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/DefinirFormato/Final/";
        $objAC->setDescripcion('Archivo Definir formato Final del libro '.$parametros['titulo']);
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
            if($objAC->nuevoAcuerdo()){
                $IdArchFinal =$objAC->getId_documento();
                //$exito = true;
            }else{
            echo 'Warning: El archivo para el entregable <b>Formato definido Final de libro<i>'.$parametros['titulo'].'</i></b> nose generó, intente nuevamente';
            //return;
            }
        }    
            //echo "<br>IdArchPreliminar: ".$IdArchPreliminar;
            //echo "<br>IdArchFinal: ".$IdArchFinal;
            /*************c_entregableEspecifico***********//////////
                
            $objE->setIdArchPreliminar($IdArchPreliminar);
            $objE->setIdArchFinal($IdArchFinal);
            $objE->setIdEntregable($parametros['IdEntregable']);
            $objE->setDescripcion('Formato definido de libro '.$parametros['titulo']);
            $objE->setFechaPlaneadaPreliminar($parametros['fechaPlaneadaPre']);
            $objE->setFechaRealPreliminar($parametros['fechaRealPre']);
            $objE->setFechaPlaneadaFinal($parametros['fechaPlaneadaFin']);
            $objE->setFechaRealFinal($parametros['fechaRealFin']);
            /************k_checks************//////////////
            $objE->setFechaRealFinal($parametros['fechaRealFin']);
            /**************c_formatoLibro********************/
            $obj->setIdEditorPersona($parametros['editor']);
            $obj->setIdTipoPublicacion($parametros['tipoPublicacion']);
            $obj->setIdSoporte($parametros['soporte']);
            $obj->setIdConceptoLibro($parametros['concepto']);

            if(($IdArchPreliminar != "" && $objE->agregarEntregableEspecifico()) || ($IdArchFinal != "" && $objE->agregarEntregableEspecifico())){
                

                $IdEntregableEspecif = $objE->getIdEntregableEspecifico();
                
                $obj->setIdEntregableDF($IdEntregableEspecif);
                $obj->setRutaEntregableDF("");
                for($i=0 ; $i<2 ; $i++){
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
                }
                
                    if($obj->agregarDefinirFormato()){
                    $IdFormatoLibro = $obj->getIdFormatoLibro();
                    $obj->setIdFormatoLibro($IdFormatoLibro);
                    if (isset($parametros['coedicion'])) {

                      $coedicion = $parametros['coedicion'];

                      for ($i=0; $i<count($coedicion); $i++)
                      {
                        
                        $obj->setCoedicion($coedicion[$i]);
                        if($obj->agregarCoedicion()){
                          continue;
                        }
                      }
                    }

                        echo "Éxito: El registro se guardo correctamente";
                  }else{
                    echo 'Warning: El registro no se ha podido guardar completamente...Vaya al menú <b>Actualizar libro</b> y verifique que esten todos los datos';
                  }

            }else{
                $obj->setIdEntregableDF("");
                $obj->setRutaEntregableDF("");
             if($obj->agregarDefinirFormato()){
                $IdFormatoLibro = $obj->getIdFormatoLibro();
                $obj->setIdFormatoLibro($IdFormatoLibro);
                if (isset($parametros['coedicion'])) {

                  $coedicion = $parametros['coedicion'];

                  for ($i=0; $i<count($coedicion); $i++)
                  {
                    
                    $obj->setCoedicion($coedicion[$i]);
                    if($obj->agregarCoedicion()){
                      continue;
                    }
                  }
                }
                    
                    echo "Éxito: El registro se guardo correctamente";
                    echo "<br><br><small>Aviso: No se ligó ningún entregable, más adelante puede agregarlo actualizando el libro</small>";
              }else{
                echo 'Warning: El registro no se ha podido guardar completamente...Vaya al menú <b>Actualizar libro</b> y verifique que esten todos los datos';
              }   
            }/*else{
                echo '<br>Aviso: No ingreso ningún entregable,más tarde';
            }*/
        }else{
            echo 'Error: El registro no se ha podido guardar';
        }                  
        
            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            /*************c_documento******************//////////////    
            $IdArchPreliminar = $parametros['IdArchivoPre'];
            $IdArchFinal = $parametros['IdArchivoFinal'];
            $exito = false;
            $agregoArchivo = false;
            $objAC->setUsuarioUltimaModificacion($_POST['usuario']);
            $objAC->setPantalla('Controller_definirFormato(Publicaciones)');
            $objAC->setId_usuario('NULL');
            $objAC->setAnio($parametros['anio']);
            $objAC->setId_tipo('9');
            $objAC->setId_area('16');
            $objAC->setId_destino('NULL');
            $objAC->setId_destino2('NULL');
            if($parametros['nombreArchPre'] != ""){
                $objAC->setDescripcion($parametros['nombreArchPre']);
            }else{
                $objAC->setDescripcion('Archivo Definir formato Preliminar del libro '.$parametros['titulo']);
            }
            
            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/DefinirFormato/Preliminar/";
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
                    echo "<br>El archivo del entregable <b><i>Formato definido (Final)</i></b> ha sido modificado";
                }else{
                    //echo "Error:Entra aqui";
                    if($objAC->nuevoAcuerdo()){
                    $IdArchPreliminar = $objAC->getId_documento();
                    //$exito = true;
                    }else{
                    echo 'Error: El archivo para el entregable <b>Definir formato Preliminar (Final) de libro<i>'.$parametros['titulo'].'</i></b> nose generó, intente nuevamente';
                      return;
                    }
                }
                
            }
            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/DefinirFormato/Final/";
            if($parametros['nombreArchFinal'] != ""){
                $objAC->setDescripcion($parametros['nombreArchFinal']);
            }else{
                $objAC->setDescripcion('Archivo Definir formato Final del libro '.$parametros['titulo']);
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
                    echo "<br>El archivo del entregable <b><i>Formato definido (Preliminar)</i></b> ha sido modificado";
                }else{
                    //echo "Error:Entra aqui";
                    if($objAC->nuevoAcuerdo()){
                    $IdArchFinal = $objAC->getId_documento();
                    //$exito = true;
                    }else{
                    echo 'Error: El archivo para el entregable <b>Definir formato Final de libro<i>'.$parametros['titulo'].'</i></b> nose generó, intente nuevamente';
                      return;
                    }
                }
                
            }
            /*************c_entregableEspecifico***********//////////
                
            $objE->setIdArchPreliminar($IdArchPreliminar);
            $objE->setIdArchFinal($IdArchFinal);
            $objE->setIdEntregable($parametros['IdEntregable']);
            $objE->setDescripcion('Formato definido de libro '.$parametros['titulo']);
            $objE->setFechaPlaneadaPreliminar($parametros['fechaPlaneadaPre']);
            $objE->setFechaRealPreliminar($parametros['fechaRealPre']);
            $objE->setFechaPlaneadaFinal($parametros['fechaPlaneadaFin']);
            $objE->setFechaRealFinal($parametros['fechaRealFin']);
            $IdEntreEspDF = "";
            $IdEntregableEspecif = "";
            /*if($parametros['IdEntregableEsp'] != ""){
                $IdEntreEspDF=$parametros['IdEntregableEsp'];
                $objE->setIdEntregableEspecifico($parametros['IdEntregableEsp']);
                $objE->eliminarEspecifCheckByIdEntregEspecif();

            }*/
        if($parametros['IdEntregableEsp'] != ""){
            $IdEntreEspDF=$parametros['IdEntregableEsp'];
            $IdEntregableEspecif = $parametros['IdEntregableEsp'];
            $objE->setIdEntregableEspecifico($parametros['IdEntregableEsp']);
            //$objE->eliminarEspecifCheckByIdEntregEspecif();

            /*if(($IdArchPreliminar != "" && $objE->editarEntregableEspecifico()) || ($IdArchFinal != "" && $objE->editarEntregableEspecifico())){*/
            if ($IdArchPreliminar != "" || $IdArchFinal != ""){    
                if($objE->editarEntregableEspecifico()){
                //$IdEntregableEspecif = $objE->getIdEntregableEspecifico();
                
                //$obj->setIdEntregableDF($IdEntregableEspecif);
                //$obj->setRutaEntregableDF("");
                    for($i=0 ; $i<2 ; $i++){
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
                    }
                    
                }else{
                    echo "<br><br><small>Aviso: No se pudo Actualizar el entregable</small>";
                }
            }    
        }else{
            //echo "<br>Entra<br>";
            if ($IdArchPreliminar != "" || $IdArchFinal != "") {
                            
                if($objE->agregarEntregableEspecifico()){
                    
                    $IdEntregableEspecif = $objE->getIdEntregableEspecifico();
                    
                    //$obj->setIdEntregableDF($IdEntregableEspecif);
                    //$obj->setRutaEntregableDF("");
                    for($i=0 ; $i<2 ; $i++){
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
                    }
                    
                }else{
                    echo "<br><br><small>Aviso: No se ligó ningún entregable, más adelante puede agregarlo actualizando el libro</small>";
                }
            }    
        }                
                /***********c_libro**************************/
                    $obj->setIdLibro($_POST['id']);
                    $obj->setIdActividad($parametros['actividad']);
                    $obj->setTitulo($parametros['titulo']);
                    $obj->setISBN($parametros['isbn']);
                    $obj->setIdPeriodo($parametros['anio']);
                    $obj->setIdExposicion($parametros['exposicion']);
                    $obj->setResena($parametros['resena']);
                    $obj->setISSN($parametros['issn']);
                    $obj->setEstado($parametros['estado']);
                    $obj->setAnioPublicacion($parametros['fechaPublicacion']);

                    $obj->setUsuarioUltimaModificiacion($_POST['usuario']);
                    $obj->setPantalla('Controller_definirFormato');
                    /***********c_formatoLibro************************/
                    $obj->setIdEditorPersona($parametros['editor']);
                    $obj->setIdTipoPublicacion($parametros['tipoPublicacion']);
                    $obj->setIdSoporte($parametros['soporte']);
                    $obj->setIdConceptoLibro($parametros['concepto']);
                    $obj->setIdEntregableDF($IdEntregableEspecif);
                    if( (isset($parametros['concepto']) && $parametros['concepto'] == 2) || (isset($parametros['concepto']) && $parametros['concepto'] == 3) ){
                    $obj->setIdInstitucionesLibro($parametros['instituciones']);
                  }else{
                    $obj->setIdInstitucionesLibro("");
                  }

                  $rutaimg = "resources/aplicaciones/imagenes/Publicaciones/";
            if (isset($_FILES[2])) {
                //echo '1';
                if (file_exists("../../../" . $rutaimg . $_FILES[2]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[2]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[2]['name'];

                    $nameimg = $rutaimg . "(1)" . $archivo;
                   
                    $namesoloimagen= "(1)".$archivo;

                   
               } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[2]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[2]['name'];

                    $nameimg = $rutaimg .  $resultado;
                    $namesoloimagen= $resultado;
                }
                //echo '<br>4<br>';
                $obj->setImagen($namesoloimagen);

                move_uploaded_file($_FILES[2]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setImagen("");
            }
            $rutaPDF = "resources/aplicaciones/PDF/Publicaciones/";
            if (isset($_FILES[3])) {
                //echo '1';
                if (file_exists("../../../" . $rutaPDF . $_FILES[3]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[3]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[3]['name'];

                    $nameimg = $rutaPDF . "(1)" . $archivo;
                   
                    $namesoloimagen= "(1)".$archivo;

                   
               } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[3]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[3]['name'];

                    $nameimg = $rutaPDF .  $resultado;
                    $namesoloimagen= $resultado;
                }
                //echo '<br>4<br>';
                $obj->setPDF($namesoloimagen);

                move_uploaded_file($_FILES[3]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setPDF("");
            }
            $rutaPDF2 = "vista/apps/Publicaciones/pdfIndice/";
            if (isset($_FILES[4])) {
                //echo '1';
                if (file_exists("../../../" . $rutaPDF2 . $_FILES[4]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[4]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[4]['name'];

                    $nameimg = $rutaPDF2 . "(1)" . $archivo;
                    //$count =1;
                    $namesoloimagen= "(1)".$archivo;

                  
               } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[4]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[4]['name'];

                    $nameimg = $rutaPDF2 .  $resultado;
                    $namesoloimagen= $resultado;
                }
                //echo '<br>4<br>';
                $obj->setPDFindice($namesoloimagen);

                move_uploaded_file($_FILES[4]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '<br>5<br>';
                $obj->setPDFindice("");
            } 
                 
                    if($obj->editarDefinirFormato() && $obj->editarLibro()){
                        /*if($IdEntreEspDF != ""){
                            $objE->eliminarEntregableEspecifico($IdEntreEspDF);
                        }*/
                        $obj->obtenerDefinirFormato();    
                        $IdFormatoLibro = $obj->getIdFormatoLibro();
                        $obj->setIdFormatoLibro($IdFormatoLibro);
                        $obj->eliminarCoedicion();
                        if (isset($parametros['coedicion'])) {

                          $coedicion = $parametros['coedicion'];

                          for ($i=0; $i<count($coedicion); $i++)
                          {
                            
                            $obj->setCoedicion($coedicion[$i]);
                            if($obj->agregarCoedicion()){
                              continue;
                            }
                          }
                        }

                        echo "<br><br>Éxito: El registro se modificó correctamente";
                    }else{
                    echo '<br><br>Error: El registro no se ha podido modificar completamente...Vuelva al menú <b>Actualizar libro</b> y verifique que esten todos los datos e intentelo de nuevo';
                    }    
        
            break;
        case 'eliminar':

            break;
    }
}