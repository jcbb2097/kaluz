<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once('../../Classes/DefinirColaboradores.class.php');
include_once("../../Classes/Catalogo.class.php");
include_once('../../Classes/ArchivoCompartido.class.php');
include_once('../../Classes/EntregableEspecifico.class.php');
include_once('../../Classes/entregableEspecificoVersion.class.php');
//echo "accion".$_POST['accion'];
$catalogo = new Catalogo();
$obj = new DefinirColaboradores();
$objE = new EntregableEspecifico();
$objAC = new ArchivoCompartido();
$EnVer = new entregableEspecificoVersion();
if (isset($_POST['accion']) && $_POST['accion'] != "") {

  switch ($_POST['accion']) {
    case 'guardar':
      if (isset($_POST['form'])) {
        $parametros = array();
        parse_str($_POST['form'], $parametros);
      }

      //echo "Entra:";
      /*************c_documento******************/ /////////////    
      $IdArchPreliminar = "";
      $IdArchFinal = "";
      $exito = false;

      $objAC->setUsuarioUltimaModificacion($_POST['usuario']);
      $objAC->setUsuarioCreacion($_POST['usuario']);
      $objAC->setPantalla('Controller_definirColaboradores(Publicaciones)');
      $objAC->setId_usuario('NULL');
      $objAC->setAnio($parametros['anio']);
      $objAC->setId_tipo('9');
      $objAC->setId_area('16');
      $objAC->setId_destino('NULL');
      $objAC->setId_destino2('NULL');
      $objAC->setDescripcion('Archivo Colaboradores Definido del libro ' . $parametros['titulo']);

      $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/DefinirColaboradores/Preliminar/";
      $agregoArchivo = false;
      if (isset($_FILES[0])) {
        $agregoArchivo = true;
        //echo '1';
        if (file_exists("../../../" . $rutaPDF . $_FILES[0]['name'])) {
          //echo '<br>2<br>';
          $archivo = $_FILES[0]['name'];
          $resultado = str_replace(" ", "_", $archivo);
          $explode = explode('.',  $resultado);
          $extension = array_pop($explode);

          $nombre = $_FILES[0]['name'];

          $nameimg = $rutaPDF . "(1)" . $archivo;
          //$count =1;
          $namesoloimagen = "(1)" . $archivo;
        } else {

          //echo "<br>3<br>";
          $archivo = $_FILES[0]['name'];
          $resultado = str_replace(" ", "_", $archivo);
          $explode = explode('.', $resultado);
          $extension = array_pop($explode);

          $nombre = $_FILES[0]['name'];

          $nameimg = $rutaPDF .  $resultado;
          $namesoloimagen = $resultado;
        }

        $objAC->setPdfcedulafiscal($namesoloimagen);

        move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
      } else {
        $agregoArchivo = false;
        $objAC->setPdfcedulafiscal("");
      }

      if ($agregoArchivo) {
        if ($objAC->nuevoAcuerdo()) {
          $IdArchPreliminar = $objAC->getId_documento();
          //$exito = true;
        } else {
          echo 'Warning: El archivo para el entregable <b>Colaboradores definido (Preliminar) de libro <i>' . $parametros['titulo'] . '</i></b> no se generó, intente nuevamente';
          //return;
        }
      }

      $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/DefinirColaboradores/Final/";
      $objAC->setDescripcion('Archivo Colaboradores definido Final del libro ' . $parametros['titulo']);
      $objAC->setId_tipo('10');
      $agregoArchivo = false;
      if (isset($_FILES[1])) {
        $agregoArchivo = true;
        if (file_exists("../../../" . $rutaPDF . $_FILES[1]['name'])) {
          //echo '<br>2<br>';
          $archivo = $_FILES[1]['name'];
          $resultado = str_replace(" ", "_", $archivo);
          $explode = explode('.',  $resultado);
          $extension = array_pop($explode);

          $nombre = $_FILES[1]['name'];

          $nameimg = $rutaPDF . "(1)" . $archivo;
          //$count =1;
          $namesoloimagen = "(1)" . $archivo;
        } else {

          //echo "<br>3<br>";
          $archivo = $_FILES[1]['name'];
          $resultado = str_replace(" ", "_", $archivo);
          $explode = explode('.', $resultado);
          $extension = array_pop($explode);

          $nombre = $_FILES[1]['name'];

          $nameimg = $rutaPDF .  $resultado;
          $namesoloimagen = $resultado;
        }

        $objAC->setPdfcedulafiscal($namesoloimagen);

        move_uploaded_file($_FILES[1]['tmp_name'], "../../../" . $nameimg);
      } else {

        $objAC->setPdfcedulafiscal("");
      }
      if ($agregoArchivo) {
        if ($objAC->nuevoAcuerdo()) {
          $IdArchFinal = $objAC->getId_documento();
          //$exito = true;
        } else {
          echo 'Warning: El archivo para el entregable <b>Colaboradores definido (Final) de libro <i>' . $parametros['titulo'] . '</i></b> no se generó, intente nuevamente';
          //return;
        }
      }
      /*************c_entregableEspecifico***********/ /////////
      $objE->setIdArchPreliminar($IdArchPreliminar);
      $objE->setIdArchFinal($IdArchFinal);
      $objE->setIdEntregable($parametros['IdEntregable']);
      $objE->setDescripcion('Definir Colaboradores del libro ' . $parametros['titulo']);
      $objE->setFechaPlaneadaPreliminar($parametros['fechaPlaneadaPre']);
      $objE->setFechaRealPreliminar($parametros['fechaRealPre']);
      $objE->setFechaPlaneadaFinal($parametros['fechaPlaneadaFin']);
      $objE->setFechaRealFinal($parametros['fechaRealFin']);
      $IdEntregableEspecif = "";
      $exito = true;

      if ($IdArchPreliminar != "" || $IdArchFinal != "") {

        if ($objE->agregarEntregableEspecifico()) {
          $exito = true;
          $IdEntregableEspecif = $objE->getIdEntregableEspecifico();
          $obj->setIdEntregableEsp($IdEntregableEspecif);

          for ($i = 0; $i < 1; $i++) {
            $objE->setIdEntregableEspecifico($IdEntregableEspecif);
            $objE->setIdCheckList($parametros['IdChkList' . $i]);
            if (isset($parametros['vobo' . $i]) && $parametros['vobo' . $i] == "on") {
              $objE->setValor(1);
            } else {
              $objE->setValor(0);
            }
            if ($objE->agregarEntregableEspecifCheck()) {
              echo '<br><small>Vobo ' . ($i + 1) . ' se agregó correctamente</small>';
            } else {
              echo '<br><small>Vobo ' . ($i + 1) . ' no se pudo agregar</small>';
            }
          }
        } else {
          $exito = false;
          echo "<br><br><small>Error: No se pudo ligar el entregable,comuniquelo al equipo de sistemas</small>";
        }
      } else {
        echo "<br><br><small>Aviso: No se ligó ningún entregable, más adelante puede agregarlo actualizando el libro</small>";
      }

      /*************c_colaboradorLibro***********/ /////////    
      $obj->setIdLibro($_POST['id']);
      $obj->setIdCorrectorEstilo($parametros['correctorEstilo']);
      $obj->setIdtraductor($parametros['traductor']);
      $obj->setIdDisenador($parametros['disenador']);
      $obj->setIdIlustrador($parametros['ilustrador']);
      $obj->setIdPreprensista($parametros['preprensista']);
      $obj->setIdImprenta($parametros['imprenta']);

      if (isset($parametros['chkcorrectorEstilo']) && $parametros['chkcorrectorEstilo'] == "on") {
        $obj->setCheckCorrectorEstilo(1);
      } else {
        $obj->setCheckCorrectorEstilo(0);
      }
      if (isset($parametros['chkTraductor']) && $parametros['chkTraductor'] == "on") {
        $obj->setCheckTraductor(1);
      } else {
        $obj->setCheckTraductor(0);
      }
      if (isset($parametros['chkDisenador']) && $parametros['chkDisenador'] == "on") {
        $obj->setCheckDisenador(1);
      } else {
        $obj->setCheckDisenador(0);
      }
      if (isset($parametros['chkIlustrador']) && $parametros['chkIlustrador'] == "on") {
        $obj->setCheckIlustrador(1);
      } else {
        $obj->setCheckIlustrador(0);
      }
      if (isset($parametros['chkPreprensista']) && $parametros['chkPreprensista'] == "on") {
        $obj->setCheckPreprensista(1);
      } else {
        $obj->setCheckPreprensista(0);
      }
      if (isset($parametros['chkImprenta']) && $parametros['chkImprenta'] == "on") {
        $obj->setCheckImprenta(1);
      } else {
        $obj->setCheckImprenta(0);
      }

      $obj->setUsuarioUltimaModificiacion($_POST['usuario']);
      $obj->setUsuarioCreacion($_POST['usuario']);
      $obj->setPantalla('Controller_definirColaboradores');

      if ($exito && $obj->agregarDefinirColaboradores()) {
        echo "<br><br>Éxito: El registro se guardo correctamente";
      } else {
        echo '<br><br>Error: El registro no se ha podido guardar';
      }
      break;
    case 'editar':
      if (isset($_POST['form'])) {
        $parametros = array();
        parse_str($_POST['form'], $parametros);
      }

      /*************c_documento******************/ /////////////    
      $IdArchPreliminar = $parametros['IdArchivoPre'];
      $IdArchFinal = $parametros['IdArchivoFinal'];
      $exito = false;
      $agregoArchivo = false;
      $objAC->setUsuarioUltimaModificacion($_POST['usuario']);
      $objAC->setPantalla('Controller_definirColaboradores(Publicaciones)');
      $objAC->setId_usuario('NULL');
      $objAC->setAnio($parametros['anio']);
      $objAC->setId_tipo('9');
      $objAC->setId_area('16');
      $objAC->setId_destino('NULL');
      $objAC->setId_destino2('NULL');
      if ($parametros['nombreArchPre'] != "") {
        $objAC->setDescripcion($parametros['nombreArchPre']);
      } else {
        $objAC->setDescripcion('Archivo Colaboradores Definido del libro ' . $parametros['titulo']);
      }

      $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/DefinirColaboradores/Preliminar/";
      if (isset($_FILES[0])) {
        $agregoArchivo = true;
        //echo '1';
        if (file_exists("../../../" . $rutaPDF . $_FILES[0]['name'])) {
          //echo '<br>2<br>';
          $archivo = $_FILES[0]['name'];
          $resultado = str_replace(" ", "_", $archivo);
          $explode = explode('.',  $resultado);
          $extension = array_pop($explode);

          $nombre = $_FILES[0]['name'];

          $nameimg = $rutaPDF . "(1)" . $archivo;
          //$count =1;
          $namesoloimagen = "(1)" . $archivo;
        } else {

          //echo "<br>3<br>";
          $archivo = $_FILES[0]['name'];
          $resultado = str_replace(" ", "_", $archivo);
          $explode = explode('.', $resultado);
          $extension = array_pop($explode);

          $nombre = $_FILES[0]['name'];

          $nameimg = $rutaPDF .  $resultado;
          $namesoloimagen = $resultado;
        }

        $objAC->setPdfcedulafiscal($namesoloimagen);

        move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
      } else {
        $agregoArchivo = false;
        $objAC->setPdfcedulafiscal("");
      }

      if ($agregoArchivo) {
        $objAC->setId_documento($IdArchPreliminar);
        if ($IdArchPreliminar != "" && $objAC->editaracuerdo()) {
          echo "<br>El archivo del entregable <b><i>Colaboradores definido (Preliminar)</i></b> ha sido modificado";
        } else {
          //echo "Error:Entra aqui";
          if ($objAC->nuevoAcuerdo()) {
            $IdArchPreliminar = $objAC->getId_documento();
            $EnVer->setIdEntregableEspecifico($parametros['IdEntregableEsp']);
            $EnVer->setIdArchivoPreliminar($IdArchPreliminar);
            $EnVer->agregarEntregableEspecificoVersion();
            //$exito = true;
          } else {
            echo 'Error: El archivo para el entregable <b>Colaboradores definido (Preliminar) de libro<i>' . $parametros['titulo'] . '</i></b> no se generó, intente nuevamente';
            return;
          }
        }
      }
      $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/DefinirColaboradores/Final/";
      if ($parametros['nombreArchFinal'] != "") {
        $objAC->setDescripcion($parametros['nombreArchFinal']);
      } else {
        $objAC->setDescripcion('Archivo Colaboradores Definido Final del libro ' . $parametros['titulo']);
      }

      $objAC->setId_tipo('10');
      $agregoArchivo = false;
      if (isset($_FILES[1])) {
        $agregoArchivo = true;
        if (file_exists("../../../" . $rutaPDF . $_FILES[1]['name'])) {
          //echo '<br>2<br>';
          $archivo = $_FILES[1]['name'];
          $resultado = str_replace(" ", "_", $archivo);
          $explode = explode('.',  $resultado);
          $extension = array_pop($explode);

          $nombre = $_FILES[1]['name'];

          $nameimg = $rutaPDF . "(1)" . $archivo;
          //$count =1;
          $namesoloimagen = "(1)" . $archivo;
        } else {

          //echo "<br>3<br>";
          $archivo = $_FILES[1]['name'];
          $resultado = str_replace(" ", "_", $archivo);
          $explode = explode('.', $resultado);
          $extension = array_pop($explode);

          $nombre = $_FILES[1]['name'];

          $nameimg = $rutaPDF .  $resultado;
          $namesoloimagen = $resultado;
        }

        $objAC->setPdfcedulafiscal($namesoloimagen);

        move_uploaded_file($_FILES[1]['tmp_name'], "../../../" . $nameimg);
      } else {

        $objAC->setPdfcedulafiscal("");
      }
      if ($agregoArchivo) {
        $objAC->setId_documento($IdArchFinal);
        if ($IdArchFinal != "" && $objAC->editaracuerdo()) {
          echo "<br>El archivo del entregable <b><i>Colaboradores definido  (Final)</i></b> ha sido modificado";
        } else {
          //echo "Error:Entra aqui";
          if ($objAC->nuevoAcuerdo()) {
            $IdArchFinal = $objAC->getId_documento();
            //$exito = true;
          } else {
            echo 'Error: El archivo para el entregable <b>Colaboradores definido (Final) de libro<i>' . $parametros['titulo'] . '</i></b> no se generó, intente nuevamente';
            return;
          }
        }
      }
      /*************c_entregableEspecifico***********/ /////////
      $objE->setIdArchPreliminar($IdArchPreliminar);
      $objE->setIdArchFinal($IdArchFinal);
      $objE->setIdEntregable($parametros['IdEntregable']);
      $objE->setDescripcion('Definir Colaboradores del libro ' . $parametros['titulo']);
      $objE->setFechaPlaneadaPreliminar($parametros['fechaPlaneadaPre']);
      $objE->setFechaRealPreliminar($parametros['fechaRealPre']);
      $objE->setFechaPlaneadaFinal($parametros['fechaPlaneadaFin']);
      $objE->setFechaRealFinal($parametros['fechaRealFin']);


      $obj->setIdLibro($_POST['id']);
      $obj->setIdCorrectorEstilo($parametros['correctorEstilo']);
      $obj->setIdtraductor($parametros['traductor']);
      $obj->setIdDisenador($parametros['disenador']);
      $obj->setIdIlustrador($parametros['ilustrador']);
      $obj->setIdPreprensista($parametros['preprensista']);
      $obj->setIdImprenta($parametros['imprenta']);

      if (isset($parametros['chkcorrectorEstilo']) && $parametros['chkcorrectorEstilo'] == "on") {
        $obj->setCheckCorrectorEstilo(1);
      } else {
        $obj->setCheckCorrectorEstilo(0);
      }
      if (isset($parametros['chkTraductor']) && $parametros['chkTraductor'] == "on") {
        $obj->setCheckTraductor(1);
      } else {
        $obj->setCheckTraductor(0);
      }
      if (isset($parametros['chkDisenador']) && $parametros['chkDisenador'] == "on") {
        $obj->setCheckDisenador(1);
      } else {
        $obj->setCheckDisenador(0);
      }
      if (isset($parametros['chkIlustrador']) && $parametros['chkIlustrador'] == "on") {
        $obj->setCheckIlustrador(1);
      } else {
        $obj->setCheckIlustrador(0);
      }
      if (isset($parametros['chkPreprensista']) && $parametros['chkPreprensista'] == "on") {
        $obj->setCheckPreprensista(1);
      } else {
        $obj->setCheckPreprensista(0);
      }
      if (isset($parametros['chkImprenta']) && $parametros['chkImprenta'] == "on") {
        $obj->setCheckImprenta(1);
      } else {
        $obj->setCheckImprenta(0);
      }

      $obj->setUsuarioUltimaModificiacion($_POST['usuario']);
      $obj->setPantalla('Controller_definirColaboradores');
      $exito = true;

      if ($parametros['IdEntregableEsp'] != "") {
        $IdEntregableEspecif = $parametros['IdEntregableEsp'];
        $objE->setIdEntregableEspecifico($parametros['IdEntregableEsp']);

        if ($IdArchPreliminar != "" || $IdArchFinal != "") {

          if ($objE->editarEntregableEspecifico()) {
            $exito = true;

            $obj->setIdEntregableEsp($IdEntregableEspecif);
            for ($i = 0; $i < 1; $i++) {
              $objE->setIdEntregableEspecifico($IdEntregableEspecif);
              $objE->setIdCheckList($parametros['IdChkList' . $i]);
              if (isset($parametros['vobo' . $i]) && $parametros['vobo' . $i] == "on") {
                $objE->setValor(1);
              } else {
                $objE->setValor(0);
              }
              if ($objE->editarEntregableEspecifCheck()) {
              //  echo '<br><small>Vobo ' . ($i + 1) . ' se modificó correctamente</small>';
              } else {
               // echo '<br><small>Vobo ' . ($i + 1) . ' no se pudo modificar</small>';
              }
            }
          } else {
            $exito = false;
            echo "<br><br><small>Error: No se pudo actualizar el entregable,comuniquelo al equipo de sistemas</small>";
          }
        } else {
          $exito = false;
          echo "<br><br><small>Error: No se pudo ligar el entregable,comuniquelo al equipo de sistemas</small>";
        }
      } else {
        if ($IdArchPreliminar != "" || $IdArchFinal != "") {

          if ($objE->agregarEntregableEspecifico()) {
            $exito = true;
            $IdEntregableEspecif = $objE->getIdEntregableEspecifico();
            $obj->setIdEntregableEsp($IdEntregableEspecif);
            for ($i = 0; $i < 1; $i++) {
              $objE->setIdEntregableEspecifico($IdEntregableEspecif);
              $objE->setIdCheckList($parametros['IdChkList' . $i]);
              if (isset($parametros['vobo' . $i]) && $parametros['vobo' . $i] == "on") {
                $objE->setValor(1);
              } else {
                $objE->setValor(0);
              }
              if ($objE->agregarEntregableEspecifCheck()) {
                echo '<br><small>Vobo ' . ($i + 1) . ' se agregó correctamente</small>';
              } else {
                echo '<br><small>Vobo ' . ($i + 1) . ' no se pudo agregar</small>';
              }
            }
          } else {
            $exito = false;
            echo "<br><br><small>Error: No se pudo ligar el entregable,comuniquelo al equipo de sistemas</small>";
          }
        } else {
          echo "<br><br><small>Aviso: No se ligó ningún entregable, más adelante puede agregarlo actualizando el libro</small>";
        }
      }

      if ($exito && $obj->editarDefinirColaboradores()) {
        echo "<br><br>Éxito: El registro se modificó correctamente";
      } else {
        echo '<br><br>Error: El registro no se ha podido modificar';
      }
      break;
    case 'eliminar':


      break;
  }
}
