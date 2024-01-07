<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once ('../../Classes/CoordinarDisenioFormacion.class.php');
include_once("../../Classes/Catalogo.class.php");
//echo "accion".$_POST['accion'];
$catalogo = new Catalogo();
$obj = new CoordinarDisenioFormacion();


if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

            $totalDetallesC = $parametros['totalDetallesC'];
                $cont1=0;
                $aux1=0;
                
                $rutapdfPropuestaGrafica ="resources/aplicaciones/Entregables/Publicaciones/DisenioFormacion/";
                $rutapdfMaqueta="resources/aplicaciones/Entregables/Publicaciones/DisenioFormacion/";
                $rutaIndice="resources/aplicaciones/Entregables/Publicaciones/DisenioFormacion/";
                $nM=0;
                $nPG=$nM+1;
                $nIndice=$nPG+1;
                //echo '<br><br>'.$nM.'<br><br>';
                //$rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/DisenioFormacion/";
                $obj->setIdLibro($_POST['id']);
                $obj->setUsuarioUltimaModificiacion($_POST['usuario']);
                $obj->setUsuarioCreacion($_POST['usuario']);
                $obj->setPantalla('Controller_CoordinarDisenioFormacion.php');
                while ($totalDetallesC > $cont1){
                    if (!isset($parametros['disenador' . $aux1])){
                        $aux1 += 1;
                        continue;
                    }
              
                    $obj->setIdDisenador($parametros['disenador' . $aux1]);
                    $obj->setIdIlustrador($parametros['ilustrador' . $aux1]);
                    $obj->setFechaIndice($parametros['fechaEntregaIndice'.$aux1]);

                    if (isset($_FILES[$nM])) {
                        if (file_exists("../../../../" . $rutapdfMaqueta . $_FILES[$nM]['name'])) {
                            $archivo = $_FILES[$nM]['name'];
                            $resultado = str_replace(" ", "_",$archivo);
                            $explode = explode('.',  $resultado);
                            $extension = array_pop($explode);

                            $nombre = $_FILES[$nM]['name'];

                            $nameimg = $rutapdfMaqueta ."(".$_POST['id'].")" . $archivo;
                          
                            $namesoloimagen= "(".$_POST['id'].")".$archivo;
                           
                          
                        } else {
                            
                            $archivo = $_FILES[$nM]['name'];
                            $resultado = str_replace(" ", "_",$archivo);
                            $explode = explode('.', $resultado);
                            $extension = array_pop($explode);

                            $nombre = $_FILES[$nM]['name'];

                            $nameimg = $rutapdfMaqueta .  $resultado;
                            $namesoloimagen= $resultado;
                           
                        }
                       
                        $obj->setPDFMaqueta($namesoloimagen);
                            
                        move_uploaded_file($_FILES[$nM]['tmp_name'], "../../../" . $nameimg);
                        } else {
                            //echo'8';
                            $obj->setPDFMaqueta("");
                        }
                    
                    if (isset($_FILES[$nPG])) {
                        if (file_exists("../../../../" . $rutapdfPropuestaGrafica . $_FILES[$nPG]['name'])) {
                            
                          
                            $archivo = $_FILES[$nPG]['name'];
                            $resultado = str_replace(" ", "_",$archivo);
                            $explode = explode('.',  $resultado);
                            $extension = array_pop($explode);

                            $nombre = $_FILES[$nPG]['name'];

                            $nameimg = $rutapdfPropuestaGrafica ."(".$_POST['id'].")" . $archivo;
                            
                            $namesoloimagen= "(".$_POST['id'].")".$archivo;
                           
                        } else {
                          
                            $archivo = $_FILES[$nPG]['name'];
                            $resultado = str_replace(" ", "_",$archivo);
                            $explode = explode('.', $resultado);
                            $extension = array_pop($explode);

                            $nombre = $_FILES[$nPG]['name'];

                            $nameimg = $rutapdfPropuestaGrafica .  $resultado;
                            $namesoloimagen= $resultado;
                          
                        }
                        $obj->setPDFPropuestaGrafica($namesoloimagen);
                     
                        
                        move_uploaded_file($_FILES[$nPG]['tmp_name'], "../../../" . $nameimg);
                        
                    } else {
                    
                        $obj->setPDFPropuestaGrafica("");
                    }
                    
                    if (isset($_FILES[$nIndice])) {
                        if (file_exists("../../../../" . $rutaIndice . $_FILES[$nIndice]['name'])) {
                            
                            
                            $archivo = $_FILES[$nIndice]['name'];
                            $resultado = str_replace(" ", "_",$archivo);
                            $explode = explode('.',  $resultado);
                            $extension = array_pop($explode);

                            $nombre = $_FILES[$nIndice]['name'];

                            $nameimg = $rutaIndice ."(".$_POST['id'].")" . $archivo;
                           
                            $namesoloimagen= "(".$_POST['id'].")".$archivo;
                         
                        } else {
                           
                            $archivo = $_FILES[$nIndice]['name'];
                            $resultado = str_replace(" ", "_",$archivo);
                            $explode = explode('.', $resultado);
                            $extension = array_pop($explode);

                            $nombre = $_FILES[$nIndice]['name'];

                            $nameimg = $rutaIndice .  $resultado;
                            $namesoloimagen= $resultado;
                        
                        }
                        $obj->setPdfIndice($namesoloimagen);
                  
                        move_uploaded_file($_FILES[$nIndice]['tmp_name'], "../../../" . $nameimg);
                        
                    } else {
                      
                        $obj->setPdfIndice("");
                    }
                    
                    if($obj->agregarCoordinarDisenioFormacion()){

                       echo "Éxito: El registro se guardo correctamente<br>";
                    }else{
                      echo 'Error: El registro no se ha podido guardar, actualice y vuelva a intentar';
                    }
                   
                    
                    $nM=$nIndice+1;
                    $nPG=$nM+1;
                    $nIndice=$nPG+1;
                
                    $aux1 += 1;
                    $cont1 += 1;
                    
                    
                }


          
            /*if (isset($_FILES[0])) {
                //echo '1';
                if (file_exists("../../../" . $rutaPDF . $_FILES[0]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $nameimg = $rutaPDF ."(".$_POST['id'].")" . $archivo;
                    //$count =1;
                    $namesoloimagen= "(".$_POST['id'].")".$archivo;

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
                $obj->setRutaCatalograficas($namesoloimagen);

                move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setRutaCatalograficas("");
            }*/

            
            /*if($obj->agregarCoordinarDisenioFormacion()){

               echo "Éxito: El registro se guardo correctamente";
            }else{
              echo 'Error: El registro no se ha podido guardar';
            }*/
            break;
        case 'editar':

            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

             $totalDetallesC = $parametros['totalDetallesC'];
                $cont1=0;
                $aux1=0;
                
                $rutapdfPropuestaGrafica ="resources/aplicaciones/Entregables/Publicaciones/DisenioFormacion/";
                $rutapdfMaqueta="resources/aplicaciones/Entregables/Publicaciones/DisenioFormacion/";
                $rutaIndice="resources/aplicaciones/Entregables/Publicaciones/DisenioFormacion/";
                $nM=0;
                $nPG=$nM+1;
                $nIndice=$nPG+1;
                $RutaMaqueta = "";
                $RutaPropuestaGrafica = "";
                $RutaIndice = "";
                //echo '<br><br>'.$nM.'<br><br>';
                //$rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/DisenioFormacion/";
                $obj->setIdLibro($_POST['id']);
                $obj->setUsuarioUltimaModificiacion($_POST['usuario']);
                $obj->setUsuarioCreacion($_POST['usuario']);
                $obj->setPantalla('Controller_CoordinarDisenioFormacion.php');
                $obj->eliminarDisenioFormacio();
                while ($totalDetallesC > $cont1){
                    if (!isset($parametros['disenador' . $aux1])){
                        $aux1 += 1;
                        continue;
                    }
              
                    $obj->setIdDisenador($parametros['disenador' . $aux1]);
                    $obj->setIdIlustrador($parametros['ilustrador' . $aux1]);
                    $obj->setFechaIndice($parametros['fechaEntregaIndice'.$aux1]);
                    if (isset($parametros['pdfMaquetaE' . $aux1])){
                        $RutaMaqueta=$parametros['pdfMaquetaE' . $aux1];    
                    }
                    if (isset($parametros['pdfPropuestaGraficaE' . $aux1])){
                        $RutaPropuestaGrafica=$parametros['pdfPropuestaGraficaE' . $aux1];    
                    }
                    if (isset($parametros['pdfindiceE' . $aux1])){
                        $RutaIndice=$parametros['pdfindiceE' . $aux1];    
                    }
                    if (isset($_FILES[$nM])) {
                        if (file_exists("../../../../" . $rutapdfMaqueta . $_FILES[$nM]['name'])) {
                            $archivo = $_FILES[$nM]['name'];
                            $resultado = str_replace(" ", "_",$archivo);
                            $explode = explode('.',  $resultado);
                            $extension = array_pop($explode);

                            $nombre = $_FILES[$nM]['name'];

                            $nameimg = $rutapdfMaqueta ."(".$_POST['id'].")" . $archivo;
                          
                            $namesoloimagen= "(".$_POST['id'].")".$archivo;
                           
                          
                        } else {
                            
                            $archivo = $_FILES[$nM]['name'];
                            $resultado = str_replace(" ", "_",$archivo);
                            $explode = explode('.', $resultado);
                            $extension = array_pop($explode);

                            $nombre = $_FILES[$nM]['name'];

                            $nameimg = $rutapdfMaqueta .  $resultado;
                            $namesoloimagen= $resultado;
                           
                        }
                       
                        $obj->setPDFMaqueta($namesoloimagen);
                            
                        move_uploaded_file($_FILES[$nM]['tmp_name'], "../../../" . $nameimg);
                        } else {
                            //echo'8';
                            $obj->setPDFMaqueta($RutaMaqueta);
                        }
                    
                    if (isset($_FILES[$nPG])) {
                        if (file_exists("../../../../" . $rutapdfPropuestaGrafica . $_FILES[$nPG]['name'])) {
                            
                          
                            $archivo = $_FILES[$nPG]['name'];
                            $resultado = str_replace(" ", "_",$archivo);
                            $explode = explode('.',  $resultado);
                            $extension = array_pop($explode);

                            $nombre = $_FILES[$nPG]['name'];

                            $nameimg = $rutapdfPropuestaGrafica ."(".$_POST['id'].")" . $archivo;
                            
                            $namesoloimagen= "(".$_POST['id'].")".$archivo;
                           
                        } else {
                          
                            $archivo = $_FILES[$nPG]['name'];
                            $resultado = str_replace(" ", "_",$archivo);
                            $explode = explode('.', $resultado);
                            $extension = array_pop($explode);

                            $nombre = $_FILES[$nPG]['name'];

                            $nameimg = $rutapdfPropuestaGrafica .  $resultado;
                            $namesoloimagen= $resultado;
                          
                        }
                        $obj->setPDFPropuestaGrafica($namesoloimagen);
                     
                        
                        move_uploaded_file($_FILES[$nPG]['tmp_name'], "../../../" . $nameimg);
                        
                    } else {
                    
                        $obj->setPDFPropuestaGrafica($RutaPropuestaGrafica);
                    }
                    
                    if (isset($_FILES[$nIndice])) {
                        if (file_exists("../../../../" . $rutaIndice . $_FILES[$nIndice]['name'])) {
                            
                            
                            $archivo = $_FILES[$nIndice]['name'];
                            $resultado = str_replace(" ", "_",$archivo);
                            $explode = explode('.',  $resultado);
                            $extension = array_pop($explode);

                            $nombre = $_FILES[$nIndice]['name'];

                            $nameimg = $rutaIndice ."(".$_POST['id'].")" . $archivo;
                           
                            $namesoloimagen= "(".$_POST['id'].")".$archivo;
                         
                        } else {
                           
                            $archivo = $_FILES[$nIndice]['name'];
                            $resultado = str_replace(" ", "_",$archivo);
                            $explode = explode('.', $resultado);
                            $extension = array_pop($explode);

                            $nombre = $_FILES[$nIndice]['name'];

                            $nameimg = $rutaIndice .  $resultado;
                            $namesoloimagen= $resultado;
                        
                        }
                        $obj->setPdfIndice($namesoloimagen);
                  
                        move_uploaded_file($_FILES[$nIndice]['tmp_name'], "../../../" . $nameimg);
                        
                    } else {
                      
                        $obj->setPdfIndice($RutaIndice);
                    }
                    
                    if($obj->agregarCoordinarDisenioFormacion()){

                       echo "Éxito: El registro se guardo correctamente<br>";
                    }else{
                      echo 'Error: El registro no se ha podido guardar, actualice y vuelva a intentar';
                    }
                   
                    
                    $nM=$nIndice+1;
                    $nPG=$nM+1;
                    $nIndice=$nPG+1;
                
                    $aux1 += 1;
                    $cont1 += 1;
                    
                    
                }
          
            break;

        case 'eliminar':
          //echo "Entra controller eliminar";


            break;
    }
}