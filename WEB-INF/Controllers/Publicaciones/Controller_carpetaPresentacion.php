<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once ('../../Classes/CarpetaPresentacion.class.php');
include_once ('../../Classes/EntregableEspecifico.class.php');
include_once("../../Classes/Catalogo.class.php");
include_once ('../../Classes/ArchivoCompartido.class.php');
//echo "accion".$_POST['accion'];
$catalogo = new Catalogo();
$obj = new CarpetaPresentacion();
$objE = new EntregableEspecifico();
$objAC = new ArchivoCompartido();
if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
           
            /*************c_documento******************//////////////    
            $IdArchPreliminar = "";
            $IdArchFinal = "";
            $exito = false;

            $objAC->setUsuarioUltimaModificacion($_POST['usuario']);
            $objAC->setUsuarioCreacion($_POST['usuario']);
            $objAC->setPantalla('Controller_carpetaPresentacion(Publicaciones)');
            $objAC->setId_usuario('NULL');
            $objAC->setAnio($parametros['anio']);
            $objAC->setId_tipo('9');
            $objAC->setId_area('16');
            $objAC->setId_destino('NULL');
            $objAC->setId_destino2('NULL');
            $objAC->setDescripcion('Archivo Elaborar índice para carpeta del libro '.$parametros['titulo']);
            
            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/ElaborarCarpetaPresentacion/ElaborarIndiceCarpeta/Preliminar/";
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
                    echo 'Warning: El archivo para el entregable <b>Elaborar índice para carpeta (Preliminar) de libro <i>'.$parametros['titulo'].'</i></b> no se generó, intente nuevamente';
                    //return;
                    }
                }

            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/ElaborarCarpetaPresentacion/ElaborarIndiceCarpeta/Final/";
            $objAC->setDescripcion('Archivo Elaborar índice para carpeta Final del libro '.$parametros['titulo']);
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
                echo 'Warning: El archivo para el entregable <b>Elaborar índice para carpeta (Final) de libro <i>'.$parametros['titulo'].'</i></b> no se generó, intente nuevamente';
                //return;
                }
            }
            /*************c_entregableEspecifico***********//////////
            $objE->setIdArchPreliminar($IdArchPreliminar);
            $objE->setIdArchFinal($IdArchFinal);
            $objE->setIdEntregable($parametros['IdEntregable']);
            $objE->setDescripcion('Elaborar carpeta de CarpetaPresentación (Entregable Elaborar índice para carpeta)  del libro '.$parametros['titulo']);
            $objE->setFechaPlaneadaPreliminar($parametros['fechaPlaneadaPre0']);
            $objE->setFechaRealPreliminar($parametros['fechaRealPre0']);
            $objE->setFechaPlaneadaFinal($parametros['fechaPlaneadaFin0']);
            $objE->setFechaRealFinal($parametros['fechaRealFin0']);
            $IdEntregableEspecifElabIndiceCarpeta = "";
            $exito=true;

            if ($IdArchPreliminar != "" || $IdArchFinal != "") {
                            
                if($objE->agregarEntregableEspecifico()){
                    $exito = true;
                    $IdEntregableEspecifElabIndiceCarpeta = $objE->getIdEntregableEspecifico();
                    $obj->setIdEntregableElaborarIndiceCarpeta($IdEntregableEspecifElabIndiceCarpeta);

                    for($i=0 ; $i<1 ; $i++){
                        $objE->setIdEntregableEspecifico($IdEntregableEspecifElabIndiceCarpeta);
                        $objE->setIdCheckList($parametros['IdChkList0'.$i]);
                        if( isset($parametros['vobo0'.$i]) && $parametros['vobo0'.$i] == "on"){
                            $objE->setValor(1);
                        }else{
                            $objE->setValor(0);
                        }
                        if($objE->agregarEntregableEspecifCheck()){
                            echo '';
                        }else{
                         echo '';   
                        }
                    }
                    
                }else{
                    $exito = false;
                    echo "<br><br><small>Error: No se pudo ligar el entregable,comuniquelo al equipo de sistemas</small>";
                }
            }else{
                    echo "<br><br><small>Aviso: No se ligó ningún entregable, más adelante puede agregarlo actualizando el libro</small>";
            }

            /*************c_documento******************//////////////    
            $IdArchPreliminar = "";
            $IdArchFinal = "";
            $exitoDos = false;

            $objAC->setUsuarioUltimaModificacion($_POST['usuario']);
            $objAC->setUsuarioCreacion($_POST['usuario']);
            $objAC->setPantalla('Controller_carpetaPresentacion(Publicaciones)');
            $objAC->setId_usuario('NULL');
            $objAC->setAnio($parametros['anio']);
            $objAC->setId_tipo('9');
            $objAC->setId_area('16');
            $objAC->setId_destino('NULL');
            $objAC->setId_destino2('NULL');
            $objAC->setDescripcion('Archivo Elaborar sinopsis del catálogo del libro '.$parametros['titulo']);
            
            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/ElaborarCarpetaPresentacion/ElaborarSinopsisCatalogo/Preliminar/";
                $agregoArchivo = false;
                if (isset($_FILES[2])) {
                    $agregoArchivo = true;
                    //echo '1';
                    if (file_exists("../../../" . $rutaPDF . $_FILES[2]['name'])) {
                        //echo '<br>2<br>';
                        $archivo = $_FILES[2]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.',  $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[2]['name'];

                        $nameimg = $rutaPDF . "(1)" . $archivo;
                        //$count =1;
                        $namesoloimagen= "(1)".$archivo;

                   } else {

                        //echo "<br>3<br>";
                        $archivo = $_FILES[2]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.', $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[2]['name'];

                        $nameimg = $rutaPDF .  $resultado;
                        $namesoloimagen= $resultado;
                    }
                    
                    $objAC->setPdfcedulafiscal($namesoloimagen);

                    move_uploaded_file($_FILES[2]['tmp_name'], "../../../" . $nameimg);
                } else {
                    $agregoArchivo = false;
                    $objAC->setPdfcedulafiscal("");
                }
            
                if($agregoArchivo){
                    if($objAC->nuevoAcuerdo()){
                    $IdArchPreliminar = $objAC->getId_documento();
                    //$exito = true;
                    }else{
                    echo 'Warning: El archivo para el entregable <b>Elaborar sinopsis del catálogo (Preliminar) de libro <i>'.$parametros['titulo'].'</i></b> no se generó, intente nuevamente';
                    //return;
                    }
                }

            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/ElaborarCarpetaPresentacion/ElaborarSinopsisCatalogo/Final/";
            $objAC->setDescripcion('Archivo Elaborar sinopsis del catálogo Final del libro '.$parametros['titulo']);
            $objAC->setId_tipo('10');
            $agregoArchivo = false;
                if (isset($_FILES[3])) {
                    $agregoArchivo = true;
                    if (file_exists("../../../" . $rutaPDF . $_FILES[3]['name'])) {
                        //echo '<br>2<br>';
                        $archivo = $_FILES[3]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.',  $resultado);
                        $extension = array_pop($explode);

                        $nombre = $_FILES[3]['name'];

                        $nameimg = $rutaPDF . "(1)" . $archivo;
                        //$count =1;
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
                    
                    $objAC->setPdfcedulafiscal($namesoloimagen);

                    move_uploaded_file($_FILES[3]['tmp_name'], "../../../" . $nameimg);
                } else {
                    
                    $objAC->setPdfcedulafiscal("");
                }
            if($agregoArchivo){
                if($objAC->nuevoAcuerdo()){
                    $IdArchFinal =$objAC->getId_documento();
                    //$exito = true;
                }else{
                echo 'Warning: El archivo para el entregable <b>Elaborar sinopsis del catálogo (Final) de libro <i>'.$parametros['titulo'].'</i></b> no se generó, intente nuevamente';
                //return;
                }
            }
            /*************c_entregableEspecifico***********//////////
            $objE->setIdArchPreliminar($IdArchPreliminar);
            $objE->setIdArchFinal($IdArchFinal);
            $objE->setIdEntregable($parametros['IdEntregable']);
            $objE->setDescripcion('Elaborar carpeta de CarpetaPresentación (Elaborar sinopsis del catálogo)  del libro '.$parametros['titulo']);
            $objE->setFechaPlaneadaPreliminar($parametros['fechaPlaneadaPre1']);
            $objE->setFechaRealPreliminar($parametros['fechaRealPre1']);
            $objE->setFechaPlaneadaFinal($parametros['fechaPlaneadaFin1']);
            $objE->setFechaRealFinal($parametros['fechaRealFin1']);
            $IdEntregableEspecifElabSinopCatalogo = "";
            $exitoDos=true;

            if ($IdArchPreliminar != "" || $IdArchFinal != "") {
                            
                if($objE->agregarEntregableEspecifico()){
                    $exitoDos = true;
                    $IdEntregableEspecifElabSinopCatalogo = $objE->getIdEntregableEspecifico();
                    $obj->setIdEntregableSinopsisCatalogo($IdEntregableEspecifElabSinopCatalogo);
                    for($i=0 ; $i<12 ; $i++){
                        $objE->setIdEntregableEspecifico($IdEntregableEspecifElabSinopCatalogo);
                        $objE->setIdCheckList($parametros['IdChkList1'.$i]);
                        if( isset($parametros['vobo1'.$i]) && $parametros['vobo1'.$i] == "on"){
                            $objE->setValor(1);
                        }else{
                            $objE->setValor(0);
                        }
                        if($objE->agregarEntregableEspecifCheck()){
                            echo '';
                        }else{
                         echo '';   
                        }
                    }
                    
                }else{
                    echo "4";
                    $exitoDos = false;
                    echo "<br><br><small>Error: No se pudo ligar el entregable,comuniquelo al equipo de sistemas</small>";
                }
            }else{
                    echo "<br><br><small>Aviso: No se ligó ningún entregable, más adelante puede agregarlo actualizando el libro</small>";
            }

            $obj->setIdLibro($_POST['id']);
            $obj->setUsuarioUltimaModificiacion($_POST['usuario']);
            $obj->setUsuarioCreacion($_POST['usuario']);
            $obj->setPantalla('Controller_carpetaPresentacion');

            if( $exito && $exitoDos &&  $obj->agregarCarpetaPresentacion() ){
                
               echo "<br><br>Éxito: El registro se guardo correctamente";
               
            }else{
              echo '<br><br >Error: El registro no se ha podido guardar completamente';
            }
          
            break;

        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
                /*print_r($parametros);*/
            }
            /*************c_documento******************//////////////    
            $IdArchPreliminar = $parametros['IdArchivoPre0'];
            $IdArchFinal = $parametros['IdArchivoFinal0'];
            $exito = false;
            $agregoArchivo = false;
            $objAC->setUsuarioUltimaModificacion($_POST['usuario']);
            $objAC->setPantalla('Controller_carpetaPresentacion(Publicaciones)');
            $objAC->setId_usuario('NULL');
            $objAC->setAnio($parametros['anio']);
            $objAC->setId_tipo('9');
            $objAC->setId_area('16');
            $objAC->setId_destino('NULL');
            $objAC->setId_destino2('NULL');
            if($parametros['nombreArchPre0'] != ""){
                $objAC->setDescripcion($parametros['nombreArchPre0']);
            }else{
                $objAC->setDescripcion('Archivo Elaborar índice para carpeta del libro '.$parametros['titulo']);
            }
            
            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/ElaborarCarpetaPresentacion/ElaborarIndiceCarpeta/Preliminar/";
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
                    echo "<br>El archivo del entregable <b><i>Elaborar índice para Carpeta (Preliminar)</i></b> ha sido modificado";
                }else{
                    //echo "Error:Entra aqui";
                    if($objAC->nuevoAcuerdo()){
                    $IdArchPreliminar = $objAC->getId_documento();
                    $exito = true;
                    }else{
                    echo 'Error: El archivo para el entregable <b>Elaborar índice para Carpeta (Preliminar) de libro<i>'.$parametros['titulo'].'</i></b> no se generó, intente nuevamente';
                      return;
                    }
                }
                
            }
            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/ElaborarCarpetaPresentacion/ElaborarIndiceCarpeta/Final/";
            if($parametros['nombreArchFinal0'] != ""){
                $objAC->setDescripcion($parametros['nombreArchFinal0']);
            }else{
                $objAC->setDescripcion('Archivo Elaborar índice para carpeta Final del libro '.$parametros['titulo']);
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
                    echo "<br>El archivo del entregable <b><i>Elaborar índice para carpeta  (Final)</i></b> ha sido modificado";
                }else{
                    //echo "Error:Entra aqui";
                    if($objAC->nuevoAcuerdo()){
                    $IdArchFinal = $objAC->getId_documento();
                    $exito = true;
                    }else{
                    echo 'Error: El archivo para el entregable <b>Elaborar índice para carpeta (Final) de libro<i>'.$parametros['titulo'].'</i></b> no se generó, intente nuevamente';
                      return;
                    }
                }
                
            }
             /*************c_entregableEspecifico***********//////////
            $objE->setIdArchPreliminar($IdArchPreliminar);
            $objE->setIdArchFinal($IdArchFinal);
            $objE->setIdEntregable($parametros['IdEntregable']);
            $objE->setDescripcion('Elaborar carpeta de CarpetaPresentación (Entregable Elaborar índice para carpeta) del libro '.$parametros['titulo']);
            $objE->setFechaPlaneadaPreliminar($parametros['fechaPlaneadaPre0']);
            $objE->setFechaRealPreliminar($parametros['fechaRealPre0']);
            $objE->setFechaPlaneadaFinal($parametros['fechaPlaneadaFin0']);
            $objE->setFechaRealFinal($parametros['fechaRealFin0']);
            $exito=true;

            if($parametros['IdEntregableEsp0'] != ""){
                $IdEntregableEspecif = $parametros['IdEntregableEsp0'];
                $objE->setIdEntregableEspecifico($parametros['IdEntregableEsp0']);

                if ($IdArchPreliminar != "" || $IdArchFinal != "") {
                            
                    if($objE->editarEntregableEspecifico()){
                        $exito = true;
                        
                        $obj->setIdEntregableElaborarIndiceCarpeta($IdEntregableEspecif);
                        for($i=0 ; $i<1 ; $i++){
                            $objE->setIdEntregableEspecifico($IdEntregableEspecif);
                            $objE->setIdCheckList($parametros['IdChkList0'.$i]);
                            if( isset($parametros['vobo0'.$i]) && $parametros['vobo0'.$i] == "on"){
                                $objE->setValor(1);
                            }else{
                                $objE->setValor(0);
                            }
                            if($objE->editarEntregableEspecifCheck()){
                            echo '';
                            }else{
                             echo '';   
                            }
                        }
                        
                    }else{
                        $exito = false;
                        echo "<br><br><small>Error: No se pudo actualizar el entregable,comuniquelo al equipo de sistemas</small>";
                    }
                }else{
                    $exito = false;
                        echo "<br><br><small>Error: No se pudo ligar el entregable,comuniquelo al equipo de sistemas1</small>";
                }
            }else{
                if ($IdArchPreliminar != "" || $IdArchFinal != "") {
                            
                    if($objE->agregarEntregableEspecifico()){
                        $exito = true;
                        $IdEntregableEspecif = $objE->getIdEntregableEspecifico();
                        $obj->setIdEntregableElaborarIndiceCarpeta($IdEntregableEspecif);
                        for($i=0 ; $i<1 ; $i++){
                            $objE->setIdEntregableEspecifico($IdEntregableEspecif);
                            $objE->setIdCheckList($parametros['IdChkList0'.$i]);
                            if( isset($parametros['vobo0'.$i]) && $parametros['vobo0'.$i] == "on"){
                                $objE->setValor(1);
                            }else{
                                $objE->setValor(0);
                            }
                            if($objE->agregarEntregableEspecifCheck()){
                                echo '';
                            }else{
                             echo '';   
                            }
                        }
                        
                    }else{
                        $exito = false;
                        echo "<br><br><small>Error: No se pudo ligar el entregable,comuniquelo al equipo de sistemas2</small>";
                    }
                }else{
                    echo "<br><br><small>Aviso: No se ligó ningún entregable, más adelante puede agregarlo actualizando el libro</small>";
                }       
            }
            
            /*************c_documento******************//////////////    
            $IdArchPreliminar = $parametros['IdArchivoPre1'];
            $IdArchFinal = $parametros['IdArchivoFinal1'];
            $agregoArchivo = false;
            $objAC->setUsuarioUltimaModificacion($_POST['usuario']);
            $objAC->setPantalla('Controller_carpetaPresentacion(Publicaciones)');
            $objAC->setId_usuario('NULL');
            $objAC->setAnio($parametros['anio']);
            $objAC->setId_tipo('9');
            $objAC->setId_area('16');
            $objAC->setId_destino('NULL');
            $objAC->setId_destino2('NULL');
            if($parametros['nombreArchPre1'] != ""){
                $objAC->setDescripcion($parametros['nombreArchPre1']);
            }else{
                $objAC->setDescripcion('Archivo Elaborar sinopsis del catálogo del libro '.$parametros['titulo']);
            }
            
            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/ElaborarCarpetaPresentacion/ElaborarSinopsisCatalogo/Preliminar/";
            if (isset($_FILES[2])) {
                $agregoArchivo = true;
                //echo '1';
                if (file_exists("../../../" . $rutaPDF . $_FILES[2]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[2]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[2]['name'];

                    $nameimg = $rutaPDF . "(1)" . $archivo;
                    //$count =1;
                    $namesoloimagen= "(1)".$archivo;

               } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[2]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[2]['name'];

                    $nameimg = $rutaPDF .  $resultado;
                    $namesoloimagen= $resultado;
                }
                
                $objAC->setPdfcedulafiscal($namesoloimagen);

                move_uploaded_file($_FILES[2]['tmp_name'], "../../../" . $nameimg);
            } else {
                $agregoArchivo = false;
                $objAC->setPdfcedulafiscal("");
            }
            
            if($agregoArchivo){
                $objAC->setId_documento($IdArchPreliminar);
                if($IdArchPreliminar != "" && $objAC->editaracuerdo()){
                    echo "<br>El archivo del entregable <b><i>Elaborar sinopsis del catálogo (Preliminar)</i></b> ha sido modificado";
                }else{
                    //echo "Error:Entra aqui";
                    if($objAC->nuevoAcuerdo()){
                    $IdArchPreliminar = $objAC->getId_documento();
                    $exito = true;
                    }else{
                    echo 'Error: El archivo para el entregable <b>Elaborar sinopsis del catálogo (Preliminar) de libro<i>'.$parametros['titulo'].'</i></b> no se generó, intente nuevamente';
                      return;
                    }
                }
                
            }
            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/ElaborarCarpetaPresentacion/ElaborarSinopsisCatalogo/Final/";
            if($parametros['nombreArchFinal1'] != ""){
                $objAC->setDescripcion($parametros['nombreArchFinal1']);
            }else{
                $objAC->setDescripcion('Archivo Elaborar sinopsis del catálogo Final del libro '.$parametros['titulo']);
            }
        
        $objAC->setId_tipo('10');
        $agregoArchivo = false;
            if (isset($_FILES[3])) {
                $agregoArchivo = true;
                if (file_exists("../../../" . $rutaPDF . $_FILES[3]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[3]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[3]['name'];

                    $nameimg = $rutaPDF . "(1)" . $archivo;
                    //$count =1;
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
                
                $objAC->setPdfcedulafiscal($namesoloimagen);

                move_uploaded_file($_FILES[3]['tmp_name'], "../../../" . $nameimg);
            } else {
                
                $objAC->setPdfcedulafiscal("");
            }
            if($agregoArchivo){
                $objAC->setId_documento($IdArchFinal);
                if($IdArchFinal != "" && $objAC->editaracuerdo()){
                    echo "<br>El archivo del entregable <b><i>Elaborar sinopsis del catálogo  (Final)</i></b> ha sido modificado";
                }else{
                    //echo "Error:Entra aqui";
                    if($objAC->nuevoAcuerdo()){
                    $IdArchFinal = $objAC->getId_documento();
                    $exito = true;
                    }else{
                    echo 'Error: El archivo para el entregable <b>Elaborar sinopsis del catálogo (Final) de libro<i>'.$parametros['titulo'].'</i></b> no se generó, intente nuevamente';
                      return;
                    }
                }
                
            }
             /*************c_entregableEspecifico***********//////////
            $objE->setIdArchPreliminar($IdArchPreliminar);
            $objE->setIdArchFinal($IdArchFinal);
            $objE->setIdEntregable($parametros['IdEntregable']);
            $objE->setDescripcion('Elaborar carpeta de CarpetaPresentación (Elaborar sinopsis del catálogo) del libro '.$parametros['titulo']);
            $objE->setFechaPlaneadaPreliminar($parametros['fechaPlaneadaPre1']);
            $objE->setFechaRealPreliminar($parametros['fechaRealPre1']);
            $objE->setFechaPlaneadaFinal($parametros['fechaPlaneadaFin1']);
            $objE->setFechaRealFinal($parametros['fechaRealFin1']);
            $exitoDos=true;

            if($parametros['IdEntregableEsp1'] != ""){

                //print_r($parametros);
                $IdEntregableEspecif = $parametros['IdEntregableEsp1'];
                $objE->setIdEntregableEspecifico($parametros['IdEntregableEsp1']);

                if ($IdArchPreliminar != "" || $IdArchFinal != "") {
                            
                    if($objE->editarEntregableEspecifico()){
                        $exitoDos = true;
                        
                        $obj->setIdEntregableSinopsisCatalogo($IdEntregableEspecif);
                        for($i=0 ; $i<12 ; $i++){
                            $objE->setIdEntregableEspecifico($IdEntregableEspecif);
                            $objE->setIdCheckList($parametros['IdChkList1'.$i]);
                            if( isset($parametros['vobo1'.$i]) && $parametros['vobo1'.$i] == "on"){
                                $objE->setValor(1);
                            }else{
                                $objE->setValor(0);
                            }
                            if($objE->editarEntregableEspecifCheck()){
                            echo '';
                            }else{
                             echo '';   
                            }
                        }
                        
                    }else{
                        $exitoDos = false;
                        //echo "1";
                        echo "<br><br><small>Error: No se pudo actualizar el entregable,comuniquelo al equipo de sistemas</small>";
                    }
                }else{
            
                            
                    if($objE->agregarEntregableEspecifico()){
                        $exitoDos = true;
                        $IdEntregableEspecif = $objE->getIdEntregableEspecifico();
                        $obj->setIdEntregableSinopsisCatalogo($IdEntregableEspecif);
                        for($i=0 ; $i<12 ; $i++){
                            $objE->setIdEntregableEspecifico($IdEntregableEspecif);
                            $objE->setIdCheckList($parametros['IdChkList1'.$i]);
                            if( isset($parametros['vobo1'.$i]) && $parametros['vobo1'.$i] == "on"){
                                $objE->setValor(1);
                            }else{
                                $objE->setValor(0);
                            }
                            if($objE->agregarEntregableEspecifCheck()){
                                echo '';
                            }else{
                             echo '';   
                            }
                        }
                        
                    }else{
                        //echo "3";
                        $exitoDos = false;
                        echo "<br><br><small>Error: No se pudo ligar el entregable,comuniquelo al equipo de sistemas4</small>";
                    }
                      
            }

        }       

        if($_POST['id']=='undefined'){

            $consultaLibro = "SELECT * from c_libro where Titulo='".$parametros["titulo"]."'";

            /*echo $consultaLibro;*/

            $resultLibro = $catalogo->obtenerLista($consultaLibro);

            $filaLibro = mysqli_fetch_array($resultLibro);

            $IdLibro = $filaLibro['IdLibro'];

            $obj->setIdLibro($IdLibro);

        }else{

            $obj->setIdLibro($_POST['id']);
        }
            $obj->setUsuarioUltimaModificiacion($_POST['usuario']);
            $obj->setUsuarioCreacion($_POST['usuario']);
            $obj->setPantalla('Controller_carpetaPresentacion');

            //echo "<br>e 1:".$exito;
            //echo "<br>e 2:".$exitoDos;

            /*print_r($obj->editarCarpetaPresentacion());*/

            if($exito && $exitoDos && $obj->editarCarpetaPresentacion()){
                
               echo "<br>Éxito: El registro se editó correctamente";
               
            }else{
              echo '<br>Error: El registro no se ha podido editar completamente';
            }
            /*$obj->setIdEntregableElaborarIndiceCarpeta($parametros['IdEntregableEspUno']);
            $obj->setIdEntregableSinopsisCatalogo($parametros['IdEntregableEspDos']);
            $total = $parametros['totalVobos'];
            
            $exito = true;
            for($i=0; $i < $total ; $i++){
                
                $objE->setIdEntregableEspecifico($parametros['IdEntregableEspDos']);
                $objE->setIdCheckList($parametros['IdChkList'.$i]);
          
                if(isset($parametros['vobo'.$i]) && $parametros['vobo'.$i] == "on"){
                  $objE->setValor(1);
                }else{
                 
                  $objE->setValor(0);
                }
                if($objE->editarEntregableEspecifCheck()){
                    echo '<br>Éxito: El entregable con el Vo.bo no.'.($i+1).' se editó';
                }else{
                    echo '<br>Error: El entregable no se ha enlazado con el Vo.bo no.'.($i+1).'No se pudo editar';   
                }

            }
                  
            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/ElaborarCarpetaPresentacion/";
            if (isset($_FILES[0])) {
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
                //echo '<br>4<br>';
                $obj->setRutaEntregableElaborarIndiceCarpeta($namesoloimagen);

                move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setRutaEntregableElaborarIndiceCarpeta("");
            }

            if (isset($_FILES[1])) {
                //echo '1';
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
                //echo '<br>4<br>';
                $obj->setRutaEntregableSinopsisCatalogo($namesoloimagen);

                move_uploaded_file($_FILES[1]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setRutaEntregableSinopsisCatalogo("");
            }*/
            
            break;

        case 'eliminar':
          //echo "Entra controller eliminar";


            break;
    }
}