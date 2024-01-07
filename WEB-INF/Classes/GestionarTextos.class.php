<?php

include_once("Catalogo.class.php");

class GestionarTextos{
	  private $IdArchPreliminar;
		private	$NombreArchivoPr;

		private	$FechaPlaneadaPreliminar;
		private	$FechaRealPreliminar;
		private $RutaArchivoPreliminar;
		private $IdTextoSC;
		private $contadorCampos;
		private $contadorCamposVacios;
		private $IdTextoINBAL;
		private $IdTextoMPBA;
		private $IdTextoPatrocinador;
		private $IdTextoCoeditorO;
	private $IdTexto;
	private $IdLibro;
	private $id_Personas;
	private $IdAutor;
	private $id_autor;
	private $IdInstitucion;
	private $Inedito;
	private $IdEntregableTextoFinal;
	private $rutaEntregableTextoFinal;
	private $tituloTexto;
	private $numCuartillas;
	private $IdTipoTexto;
	private $IdEntregableCartaSolicitud;
	private $rutaEntregableCartaSolicitud;
	private $fechaEnvioCartaSolicitud;
	private $fechaAceptacionCartaSolicitud;
	private $IdEntregableTextoPreliminarSolicitar;
	private $rutaEntregableTextoPreliminarSolicitar;
	private $fechaEntregaPlaneadaTextoPreliminar;
	private $fechaEntregaRealTextoPreliminar;
	private $IdEntregableResumenSolicitar;
	private $rutaEntregableResumenSolicitar;
	private $sinopsisSolicitar;
	private $IdEntregableConvenioFirmado;
	private $rutaEntregableConvenioFirmado;
	private $fechaEnvioAutorConvenioFirmado;
	private $fechaEntregaPlaneadaAutorConvenioFirmado;
	private $fechaEntregaRealAutorConvenioFirmado;
	private $IdEntregableBasesConvenio;
	private $rutaEntregableBasesConvenio;
	private $fechaEnvioJuridicoConvenio;
	private $fechaEntregaJuridicoConvenio;
	private $IdEntregableTextoEditado;
	private $rutaEntregableTextoEditado;
	private $IdEntregableComentariosEditor;
	private $rutaEntregableComentariosEditor;
	private $IdEntregableObservacionesVoboAutor;
	private $rutaEntregableObservacionesVoboAutor;
	private $fechaEnvioObservacionesVoboAutor;
	private $fechaEntregaPlaneadaObservacionesVoboAutor;
	private $fechaEntregaRealObservacionesVoboAutor;
	private $IdEntregableTextoTraducido;
	private $rutaEntregableTextoTraducido;
	private $IdTraductorTextoTraducido;
	private $IdiomaOriginal;
	private $IdiomaATraducir;
	private $fechaEnvioTextoTraducido;
	private $fechaEntregaPlaneadaTextoTraducido;
	private $fechaEntregaRealTextoTraducido;
	private $IdEntregableCotejoTraduccion;
	private $rutaEntregableCotejoTraduccion;
	private $IdTraductorCotejoTraduccion;
	private $fechaEnvioCotejoTraduccion;
	private $fechaEntregaPlaneadaCotejoTraduccion;
	private $fechaEntregaRealCotejoTraduccion;
	private $IdEntregableTextoCorregido;
	private $rutaEntregableTextoCorregido;
	private $IdCorrectorEstiloTextoCorregido;
	private $fechaEnvioTextoCorregido;
	private $fechaEntregaTextoCorregido;
	private $fechaEntregaRealTextoCorregido;
	private $IdEntregableVoboFinal;
	private $rutaEntregableVoboFinal;
	private $fechaEnvioVoboFinal;
	private $fechaEntregaPlaneadaVoboFina;
	private $fechaEntregaRealVoboFinal;
	private $IdEntregableResumenVoboFinal;
	private $rutaEntregableResumenVoboFinal;
	private $sinopsisVoboFinal;
	private $IdEntregableEspFichaInformativa;
	private $rutaEntregableEspFichaInformativa;
	private $IdEntregableElabPropuestaVobo;
	private $rutaEntregableElabPropuestaVobo;
	private $fechaEnvioElabPropVobo;
	private $fechaEntregaPlaneadaElabPropVobo;
	private $fechaEntregaRealElabPropVobo;
	private $IdProveedorElabPropVobo;
	private $IdSolVoboDireccion;
	private $rutaSolVoboDireccion;
	private $fechaEnvioVoboDireccion;
	private $fechaEntregaVoboDireccion;
	private $UsuarioCreacion;
	private $FechaCreacion;
	private $UsuarioUltimaModificacion;
	private $FechaUltimaModificacion;
	private $Pantalla;

	private $checkCartaSolicitud;
	private $checkBasesConvenio;
	private $checkConvenioFirmado;
	private $checkComentariosEditor;
	private $checkVoboFinalAutor;
	private $checkEnviarPropVoboDir;
	private $checkRecibirTextoAutorizadoVoboDir;
		
    private $checkEnvInfoProy;
    private $checkRecibirProp;

	public function obtenerIdsTextos($IdLibro){
		$consulta = "SELECT IdTexto,IdEntregableTextoFinal,tituloTexto FROM c_textosLibro WHERE 
				IdLibro = ".$IdLibro." ORDER BY tituloTexto;";

			//echo $consulta;	
			$catalogo = new Catalogo();
        	$query = $catalogo->obtenerLista($consulta);

        	return $query;
	}
		public function obtenerCampos($IdTexto){
	$contadorCampos = 0;
	$contadorCampos2 = 0;
	$consulta =	"SELECT 
				 IdTexto,
				 IdAutor,
				 Inedito,
				 IdInstitucion,
				 IdEntregableTextoFinal,
				 tituloTexto,
				 numCuartillas,
				 IdTipoTexto,
				 IdEntregableCartaSolicitud,
				 rutaEntregableCartaSolicitud,
				 fechaEnvioCartaSolicitud,
				 fechaAceptacionCartaSolicitud,
				 checkCartaSolicitud,
				 IdEntregableTextoPreliminarSolicitar,
				 rutaEntregableTextoPreliminarSolicitar,
				 fechaEntregaPlaneadaTextoPreliminar,
				 fechaEntregaRealTextoPreliminar,
				 IdEntregableResumenSolicitar,
				 rutaEntregableResumenSolicitar,
				 sinopsisSolicitar,
				 IdEntregableConvenioFirmado,
				 rutaEntregableConvenioFirmado,
				 fechaEnvioAutorConvenioFirmado,
				 checkConvenioFirmado,
				 fechaEntregaPlaneadaAutorConvenioFirmado,
				 fechaEntregaRealAutorConvenioFirmado,
				 IdEntregableBasesConvenio,
				 rutaEntregableBasesConvenio,
				 checkBasesConvenio,
				 fechaEnvioJuridicoConvenio,
				 fechaEntregaJuridicoConvenio,
				 IdEntregableTextoEditado,
				 rutaEntregableTextoEditado,
				 IdEntregableComentariosEditor,
				 checkComentariosEditor,
				 rutaEntregableComentariosEditor,
				 IdEntregableObservacionesVoboAutor,
				 rutaEntregableObservacionesVoboAutor,
				 fechaEnvioObservacionesVoboAutor,
				 fechaEntregaPlaneadaObservacionesVoboAutor,
				 fechaEntregaRealObservacionesVoboAutor,
				 IdEntregableTextoTraducido,
				 IdTraductorTextoTraducido,
				 IdiomaOriginal,
				 IdiomaATraducir,
				 rutaEntregableTextoTraducido,
				 fechaEnvioTextoTraducido,
				 fechaEntregaPlaneadaTextoTraducido,
				 fechaEntregaRealTextoTraducido,
				 IdEntregableCotejoTraduccion,
				 rutaEntregableCotejoTraduccion,
				 IdTraductorCotejoTraduccion,
				 fechaEnvioCotejoTraduccion,
				 fechaEntregaPlaneadaCotejoTraduccion,
				 fechaEntregaRealCotejoTraduccion,
				 IdEntregableTextoCorregido,
				 rutaEntregableTextoCorregido,
				 IdCorrectorEstiloTextoCorregido,
				 fechaEnvioTextoCorregido,
				 fechaEntregaTextoCorregido,
				 fechaEntregaRealTextoCorregido,
				 IdEntregableVoboFinal,rutaEntregableVoboFinal,
				 checkVoboFinalAutor,
				 fechaEnvioVoboFinal,
				 fechaEntregaPlaneadaVoboFina,
				 fechaEntregaRealVoboFinal,
				 IdEntregableResumenVoboFinal,
				 rutaEntregableResumenVoboFinal,
				 sinopsisVoboFinal,
				 IdEntregableEspFichaInformativa,
				 rutaEntregableEspFichaInformativa,
				 IdEntregableElabPropuestaVobo,
				 rutaEntregableElabPropuestaVobo,
				 fechaEnvioElabPropVobo,
				 fechaEntregaPlaneadaElabPropVobo,
				 fechaEntregaRealElabPropVobo,
				 checkEnvInfoProy,
				 checkRecibirProp,
				 IdProveedorElabPropVobo,
				 IdSolVoboDireccion,
				 rutaSolVoboDireccion,
				 fechaEnvioVoboDireccion,
				 fechaEntregaVoboDireccion,
				 checkEnviarPropVoboDir,
				 checkRecibirTextoAutorizadoVoboDir

				FROM
					`c_textosLibro`
				WHERE 
				IdTexto = ".$IdTexto.";";

				 $catalogo = new Catalogo();
            	$query = $catalogo->obtenerLista($consulta);

            	//echo $consulta;
            	//return $query;
            	while ($rs = mysqli_fetch_array($query)) {
                   
           
					//$this->id_Personas = $rs[''];
					$this->IdAutor = $rs['IdAutor'];
					$this->IdInstitucion = $rs['IdInstitucion'];
					$this->Inedito = $rs['Inedito'];
					$this->IdEntregableTextoFinal = $rs['IdEntregableTextoFinal'] ;
					//$this->rutaEntregableTextoFinal = $rs['Inedito'];
					$this->tituloTexto = $rs['tituloTexto'];
					$this->numCuartillas = $rs['numCuartillas'];
					$this->IdTipoTexto = $rs['IdTipoTexto'];
					$this->IdEntregableCartaSolicitud = $rs['IdEntregableCartaSolicitud'];
					$this->rutaEntregableCartaSolicitud = $rs['rutaEntregableCartaSolicitud'];
					$this->fechaEnvioCartaSolicitud = $rs['fechaEnvioCartaSolicitud'];
					$this->fechaAceptacionCartaSolicitud = $rs['fechaAceptacionCartaSolicitud'];
					$this->checkCartaSolicitud = $rs['checkCartaSolicitud']; 
					$this->IdEntregableTextoPreliminarSolicitar = $rs['IdEntregableTextoPreliminarSolicitar'];
					$this->rutaEntregableTextoPreliminarSolicitar = $rs['rutaEntregableTextoPreliminarSolicitar'];
					$this->fechaEntregaPlaneadaTextoPreliminar = $rs['fechaEntregaPlaneadaTextoPreliminar'];
					$this->fechaEntregaRealTextoPreliminar = $rs['fechaEntregaRealTextoPreliminar'];
					$this->IdEntregableResumenSolicitar = $rs['IdEntregableResumenSolicitar'];
					$this->rutaEntregableResumenSolicitar = $rs['rutaEntregableResumenSolicitar'];
					$this->sinopsisSolicitar = $rs['sinopsisSolicitar'];
					$this->IdEntregableConvenioFirmado = $rs['IdEntregableConvenioFirmado'];
					$this->rutaEntregableConvenioFirmado = $rs['rutaEntregableConvenioFirmado'];
					$this->checkConvenioFirmado = $rs['checkConvenioFirmado'];
					$this->fechaEnvioAutorConvenioFirmado = $rs['fechaEnvioAutorConvenioFirmado'];
					$this->fechaEntregaPlaneadaAutorConvenioFirmado = $rs['fechaEntregaPlaneadaAutorConvenioFirmado'];
					$this->fechaEntregaRealAutorConvenioFirmado = $rs['fechaEntregaRealAutorConvenioFirmado'];
					$this->IdEntregableBasesConvenio = $rs['IdEntregableBasesConvenio'];
					$this->rutaEntregableBasesConvenio = $rs['rutaEntregableBasesConvenio'];
					$this->checkBasesConvenio = $rs['checkBasesConvenio'];
					$this->fechaEnvioJuridicoConvenio = $rs['fechaEnvioJuridicoConvenio'];
					$this->fechaEntregaJuridicoConvenio = $rs['fechaEntregaJuridicoConvenio'];
					$this->IdEntregableTextoEditado = $rs['IdEntregableTextoEditado'];
					$this->rutaEntregableTextoEditado = $rs['rutaEntregableTextoEditado'];
					$this->IdEntregableComentariosEditor = $rs['IdEntregableComentariosEditor'];
					$this->checkComentariosEditor = $rs['checkComentariosEditor'];
					$this->rutaEntregableComentariosEditor = $rs['rutaEntregableComentariosEditor'];
					$this->IdEntregableObservacionesVoboAutor = $rs['IdEntregableObservacionesVoboAutor'];
					$this->rutaEntregableObservacionesVoboAutor = $rs['rutaEntregableObservacionesVoboAutor'];
					$this->fechaEnvioObservacionesVoboAutor = $rs['fechaEnvioObservacionesVoboAutor'];
					$this->fechaEntregaPlaneadaObservacionesVoboAutor = $rs['fechaEntregaPlaneadaObservacionesVoboAutor'];
					$this->fechaEntregaRealObservacionesVoboAutor = $rs['fechaEntregaRealObservacionesVoboAutor'];
					$this->IdEntregableTextoTraducido = $rs['IdEntregableTextoTraducido'];
					$this->rutaEntregableTextoTraducido = $rs['rutaEntregableTextoTraducido'];
					$this->IdTraductorTextoTraducido = $rs['IdTraductorTextoTraducido'];
					$this->IdiomaOriginal = $rs['IdiomaOriginal'];
					$this->IdiomaATraducir = $rs['IdiomaATraducir'];
					$this->fechaEnvioTextoTraducido = $rs['fechaEnvioTextoTraducido'];
					$this->fechaEntregaPlaneadaTextoTraducido = $rs['fechaEntregaPlaneadaTextoTraducido'];
					$this->fechaEntregaRealTextoTraducido = $rs['fechaEntregaRealTextoTraducido'];
					$this->IdEntregableCotejoTraduccion = $rs['IdEntregableCotejoTraduccion'];
					$this->rutaEntregableCotejoTraduccion = $rs['rutaEntregableCotejoTraduccion'];
					$this->IdTraductorCotejoTraduccion = $rs['IdTraductorCotejoTraduccion'];
					$this->fechaEnvioCotejoTraduccion = $rs['fechaEnvioCotejoTraduccion'];
					$this->fechaEntregaPlaneadaCotejoTraduccion = $rs['fechaEntregaPlaneadaCotejoTraduccion'];
					$this->fechaEntregaRealCotejoTraduccion = $rs['fechaEntregaRealCotejoTraduccion'];
					$this->IdEntregableTextoCorregido = $rs['IdEntregableTextoCorregido'];
					$this->rutaEntregableTextoCorregido = $rs['rutaEntregableTextoCorregido'];
					$this->IdCorrectorEstiloTextoCorregido = $rs['IdCorrectorEstiloTextoCorregido'];
					$this->fechaEnvioTextoCorregido = $rs['fechaEnvioTextoCorregido'];
					$this->fechaEntregaTextoCorregido = $rs['fechaEntregaTextoCorregido'];
					$this->fechaEntregaRealTextoCorregido = $rs['fechaEntregaRealTextoCorregido'];
					$this->IdEntregableVoboFinal = $rs['IdEntregableVoboFinal'];
					$this->rutaEntregableVoboFinal = $rs['rutaEntregableVoboFinal'];
					$this->checkVoboFinalAutor = $rs['checkVoboFinalAutor'];
					$this->fechaEnvioVoboFinal = $rs['fechaEnvioVoboFinal'];
					$this->fechaEntregaPlaneadaVoboFina = $rs['fechaEntregaPlaneadaVoboFina'];
					$this->fechaEntregaRealVoboFinal = $rs['fechaEntregaRealVoboFinal'];
					$this->IdEntregableResumenVoboFinal = $rs['IdEntregableResumenVoboFinal'];
					$this->rutaEntregableResumenVoboFinal = $rs['rutaEntregableResumenVoboFinal'];
					$this->sinopsisVoboFinal = $rs['sinopsisVoboFinal'];
					$this->IdEntregableEspFichaInformativa = $rs['IdEntregableEspFichaInformativa'];
					$this->rutaEntregableEspFichaInformativa = $rs['rutaEntregableEspFichaInformativa'];
					$this->IdEntregableElabPropuestaVobo = $rs['IdEntregableElabPropuestaVobo'];
					$this->rutaEntregableElabPropuestaVobo = $rs['rutaEntregableElabPropuestaVobo'];
					$this->fechaEnvioElabPropVobo = $rs['fechaEnvioElabPropVobo'];
					$this->fechaEntregaPlaneadaElabPropVobo = $rs['fechaEntregaPlaneadaElabPropVobo'];
					$this->fechaEntregaRealElabPropVobo = $rs['fechaEntregaRealElabPropVobo'];
					$this->checkEnvInfoProy = $rs['checkEnvInfoProy'];
					$this->checkRecibirProp = $rs['checkRecibirProp'];
					$this->IdProveedorElabPropVobo = $rs['IdProveedorElabPropVobo'];
					$this->IdSolVoboDireccion = $rs['IdSolVoboDireccion'];
					$this->rutaSolVoboDireccion = $rs['rutaSolVoboDireccion'];
					$this->fechaEnvioVoboDireccion = $rs['fechaEnvioVoboDireccion'];
					$this->fechaEntregaVoboDireccion = $rs['fechaEntregaVoboDireccion'];
					$this->checkEnviarPropVoboDir = $rs['checkEnviarPropVoboDir'];
				 	$this->checkRecibirTextoAutorizadoVoboDir = $rs['checkRecibirTextoAutorizadoVoboDir'];
	

		
        if (!isset($this->IdiomaOriginal) || $this->IdiomaOriginal == NULL || $this->IdiomaOriginal == ""){
            $this->IdiomaOriginal = "NULL";
        }else{$contadorCampos=$contadorCampos+1;}
        if (!isset($this->IdiomaATraducir) || $this->IdiomaATraducir == NULL || $this->IdiomaATraducir == ""){
            $this->IdiomaATraducir = "NULL";
        }else{$contadorCampos=$contadorCampos+1;}
			if (!isset($this->tituloTexto) || $this->tituloTexto == NULL || $this->tituloTexto == ""){
            $this->tituloTexto = "NULL";
        }else{$contadorCampos=$contadorCampos+1;}
		
		
		if (!isset($this->IdTipoTexto) || $this->IdTipoTexto == NULL || $this->IdTipoTexto == ""){
            $this->IdTipoTexto = "NULL";
        }else{$contadorCampos2=$contadorCampos2+1;}
		if (!isset($this->rutaEntregableEspFichaInformativa) || $this->rutaEntregableEspFichaInformativa == NULL || $this->rutaEntregableEspFichaInformativa == ""){
            //$this->Imagen = "NULL";
            $rutaFichaInformativa = "";
        }else{
			$contadorCampos=$contadorCampos+1;
        	$rutaFichaInformativa =  ",rutaEntregableEspFichaInformativa = "."'".$this->rutaEntregableEspFichaInformativa."'";
        }
		
		
		
		if (!isset($this->IdAutor) || $this->IdAutor == NULL || $this->IdAutor == ""){
            $this->IdAutor = "NULL";
        }else{$contadorCampos=$contadorCampos+1;}
		if (!isset($this->IdInstitucion) || $this->IdInstitucion == NULL || $this->IdInstitucion == ""){
            $this->IdInstitucion = "NULL";
        }else{$contadorCampos=$contadorCampos+1;}
		
		//////////////////////////////////////////////////////
        if (!isset($this->fechaEnvioCotejoTraduccion) || $this->fechaEnvioCotejoTraduccion == NULL || $this->fechaEnvioCotejoTraduccion == ""){
            $this->fechaEnvioCotejoTraduccion = "0000-00-00";
        }else{$contadorCampos=$contadorCampos+1;}
		 if (!isset($this->fechaEntregaRealCotejoTraduccion) || $this->fechaEntregaRealCotejoTraduccion == NULL || $this->fechaEntregaRealCotejoTraduccion == ""){
            $this->fechaEntregaRealCotejoTraduccion = "0000-00-00";
        }else{$contadorCampos=$contadorCampos+1;}
		if (!isset($this->fechaEnvioTextoCorregido) || $this->fechaEnvioTextoCorregido == NULL || $this->fechaEnvioTextoCorregido == ""){
            $this->fechaEnvioTextoCorregido = "0000-00-00";
        }else{$contadorCampos=$contadorCampos+1;}
        if (!isset($this->fechaEntregaTextoCorregido) || $this->fechaEntregaTextoCorregido == NULL || $this->fechaEntregaTextoCorregido == ""){
            $this->fechaEntregaTextoCorregido = "0000-00-00";
        }else{$contadorCampos=$contadorCampos+1;}
			   if (!isset($this->fechaEntregaVoboDireccion) || $this->fechaEntregaVoboDireccion == NULL || $this->fechaEntregaVoboDireccion == ""){
            $this->fechaEntregaVoboDireccion = "0000-00-00";
        }else{$contadorCampos=$contadorCampos+1;}
        if (!isset($this->fechaEnvioVoboDireccion) || $this->fechaEnvioVoboDireccion == NULL || $this->fechaEnvioVoboDireccion == ""){
            $this->fechaEnvioVoboDireccion = "0000-00-00";
        }else{$contadorCampos=$contadorCampos+1;}
		  if (!isset($this->fechaEnvioElabPropVobo) || $this->fechaEnvioElabPropVobo == NULL || $this->fechaEnvioElabPropVobo == ""){
            $this->fechaEnvioElabPropVobo = "0000-00-00";
        }else{$contadorCampos=$contadorCampos+1;}
        if (!isset($this->fechaEntregaPlaneadaElabPropVobo) || $this->fechaEntregaPlaneadaElabPropVobo == NULL || $this->fechaEntregaPlaneadaElabPropVobo == ""){
            $this->fechaEntregaPlaneadaElabPropVobo = "0000-00-00";
        }else{$contadorCampos=$contadorCampos+1;}
        if (!isset($this->fechaEntregaRealElabPropVobo) || $this->fechaEntregaRealElabPropVobo == NULL || $this->fechaEntregaRealElabPropVobo == ""){
            $this->fechaEntregaRealElabPropVobo = "0000-00-00";
        }else{$contadorCampos=$contadorCampos+1;}
		
        if (!isset($this->fechaEntregaPlaneadaTextoPreliminar) || $this->fechaEntregaPlaneadaTextoPreliminar == NULL || $this->fechaEntregaPlaneadaTextoPreliminar == ""){
            $this->fechaEntregaPlaneadaTextoPreliminar = "0000-00-00";
        }else{$contadorCampos=$contadorCampos+1;}
        if (!isset($this->fechaEntregaRealTextoPreliminar) || $this->fechaEntregaRealTextoPreliminar == NULL || $this->fechaEntregaRealTextoPreliminar == ""){
            $this->fechaEntregaRealTextoPreliminar = "0000-00-00";
        }else{$contadorCampos=$contadorCampos+1;}
	   if (!isset($this->fechaEntregaPlaneadaCotejoTraduccion) || $this->fechaEntregaPlaneadaCotejoTraduccion == NULL || $this->fechaEntregaPlaneadaCotejoTraduccion == ""){
            $this->fechaEntregaPlaneadaCotejoTraduccion = "0000-00-00";
        }else{$contadorCampos=$contadorCampos+1;}
        if (!isset($this->fechaEnvioVoboFinal) || $this->fechaEnvioVoboFinal == NULL || $this->fechaEnvioVoboFinal == ""){
            $this->fechaEnvioVoboFinal = "0000-00-00";
        }else{$contadorCampos=$contadorCampos+1;}
        if (!isset($this->fechaEntregaRealVoboFinal) || $this->fechaEntregaRealVoboFinal == NULL || $this->fechaEntregaRealVoboFinal == ""){
            $this->fechaEntregaRealVoboFinal = "0000-00-00";
        }else{$contadorCampos=$contadorCampos+1;}
    

  
     
       

		
        
        
        
		
        if (!isset($this->rutaEntregableTextoPreliminarSolicitar) || $this->rutaEntregableTextoPreliminarSolicitar == NULL || $this->rutaEntregableTextoPreliminarSolicitar == ""){
            //$this->Imagen = "NULL";
            $rutaTextoPre = "";
        }else{
			$contadorCampos=$contadorCampos+1;
        	$rutaTextoPre =  ",rutaEntregableTextoPreliminarSolicitar = "."'".$this->rutaEntregableTextoPreliminarSolicitar."'";
        }

        if (!isset($this->rutaEntregableTextoEditado) || $this->rutaEntregableTextoEditado == NULL || $this->rutaEntregableTextoEditado == ""){
            //$this->Imagen = "NULL";
            $rutaTextoEditado = "";
        }else{
			$contadorCampos=$contadorCampos+1;
        	$rutaTextoEditado =  ",rutaEntregableTextoEditado = "."'".$this->rutaEntregableTextoEditado."'";
        }
       
		
		/////////////////////////////////////////
        if (!isset($this->rutaEntregableVoboFinal) || $this->rutaEntregableVoboFinal == NULL || $this->rutaEntregableVoboFinal == ""){
            //$this->Imagen = "NULL";
            $rutaVoboFinal = "";
        }else{
			$contadorCampos=$contadorCampos+1;
        	$rutaVoboFinal =  ",rutaEntregableVoboFinal = "."'".$this->rutaEntregableVoboFinal."'";
        }
		 if (!isset($this->rutaEntregableTextoTraducido) || $this->rutaEntregableTextoTraducido == NULL || $this->rutaEntregableTextoTraducido == ""){
            //$this->Imagen = "NULL";
            $rutaTextoTraducido = "";
        }else{
			$contadorCampos=$contadorCampos+1;
        	$rutaTextoTraducido =  ",rutaEntregableTextoTraducido = "."'".$this->rutaEntregableTextoTraducido."'";
        }
		 if (!isset($this->rutaEntregableTextoCorregido) || $this->rutaEntregableTextoCorregido == NULL || $this->rutaEntregableTextoCorregido == ""){
            //$this->Imagen = "NULL";
            $rutaTextoCorregido = "";
        }else{
			$contadorCampos=$contadorCampos+1;
        	$rutaTextoCorregido =  ",rutaEntregableTextoCorregido = "."'".$this->rutaEntregableTextoCorregido."'";
        }
		if (!isset($this->rutaSolVoboDireccion) || $this->rutaSolVoboDireccion == NULL || $this->rutaSolVoboDireccion == ""){
            //$this->Imagen = "NULL";
            $rutaVoboDireccion = "";
        }else{
			$contadorCampos=$contadorCampos+1;
        	$rutaVoboDireccion =  ",rutaSolVoboDireccion = "."'".$this->rutaSolVoboDireccion."'";
        }
		if (!isset($this->rutaEntregableElabPropuestaVobo) || $this->rutaEntregableElabPropuestaVobo == NULL || $this->rutaEntregableElabPropuestaVobo == ""){
            //$this->Imagen = "NULL";
            $rutaPropVobo = "";
        }else{
			$contadorCampos=$contadorCampos+1;
        	$rutaPropVobo =  ",rutaEntregableElabPropuestaVobo = "."'".$this->rutaEntregableElabPropuestaVobo."'";
        }
		  
		/////////////////////////////////////////
 		
        if (!isset($this->checkEnviarPropVoboDir) || $this->checkEnviarPropVoboDir == NULL || $this->checkEnviarPropVoboDir == ""){
            $this->checkEnviarPropVoboDir = "NULL";
        }else{$contadorCampos=$contadorCampos+1;}
        if (!isset($this->checkRecibirTextoAutorizadoVoboDir) || $this->checkRecibirTextoAutorizadoVoboDir == NULL || $this->checkRecibirTextoAutorizadoVoboDir == ""){
            $this->checkRecibirTextoAutorizadoVoboDir = "NULL";
        }else{$contadorCampos=$contadorCampos+1;}

     
	} return $contadorCampos2;
		}
	public function obtenerTexto($IdTexto){

		$consulta =	"SELECT 
				 IdTexto,
				 IdAutor,
				 Inedito,
				 IdInstitucion,
				 IdEntregableTextoFinal,
				 tituloTexto,
				 numCuartillas,
				 IdTipoTexto,
				 IdEntregableCartaSolicitud,
				 rutaEntregableCartaSolicitud,
				 fechaEnvioCartaSolicitud,
				 fechaAceptacionCartaSolicitud,
				 checkCartaSolicitud,
				 IdEntregableTextoPreliminarSolicitar,
				 rutaEntregableTextoPreliminarSolicitar,
				 fechaEntregaPlaneadaTextoPreliminar,
				 fechaEntregaRealTextoPreliminar,
				 IdEntregableResumenSolicitar,
				 rutaEntregableResumenSolicitar,
				 sinopsisSolicitar,
				 IdEntregableConvenioFirmado,
				 rutaEntregableConvenioFirmado,
				 fechaEnvioAutorConvenioFirmado,
				 checkConvenioFirmado,
				 fechaEntregaPlaneadaAutorConvenioFirmado,
				 fechaEntregaRealAutorConvenioFirmado,
				 IdEntregableBasesConvenio,
				 rutaEntregableBasesConvenio,
				 checkBasesConvenio,
				 fechaEnvioJuridicoConvenio,
				 fechaEntregaJuridicoConvenio,
				 IdEntregableTextoEditado,
				 rutaEntregableTextoEditado,
				 IdEntregableComentariosEditor,
				 checkComentariosEditor,
				 rutaEntregableComentariosEditor,
				 IdEntregableObservacionesVoboAutor,
				 rutaEntregableObservacionesVoboAutor,
				 fechaEnvioObservacionesVoboAutor,
				 fechaEntregaPlaneadaObservacionesVoboAutor,
				 fechaEntregaRealObservacionesVoboAutor,
				 IdEntregableTextoTraducido,
				 IdTraductorTextoTraducido,
				 IdiomaOriginal,
				 IdiomaATraducir,
				 rutaEntregableTextoTraducido,
				 fechaEnvioTextoTraducido,
				 fechaEntregaPlaneadaTextoTraducido,
				 fechaEntregaRealTextoTraducido,
				 IdEntregableCotejoTraduccion,
				 rutaEntregableCotejoTraduccion,
				 IdTraductorCotejoTraduccion,
				 fechaEnvioCotejoTraduccion,
				 fechaEntregaPlaneadaCotejoTraduccion,
				 fechaEntregaRealCotejoTraduccion,
				 IdEntregableTextoCorregido,
				 rutaEntregableTextoCorregido,
				 IdCorrectorEstiloTextoCorregido,
				 fechaEnvioTextoCorregido,
				 fechaEntregaTextoCorregido,
				 fechaEntregaRealTextoCorregido,
				 IdEntregableVoboFinal,rutaEntregableVoboFinal,
				 checkVoboFinalAutor,
				 fechaEnvioVoboFinal,
				 fechaEntregaPlaneadaVoboFina,
				 fechaEntregaRealVoboFinal,
				 IdEntregableResumenVoboFinal,
				 rutaEntregableResumenVoboFinal,
				 sinopsisVoboFinal,
				 IdEntregableEspFichaInformativa,
				 rutaEntregableEspFichaInformativa,
				 IdEntregableElabPropuestaVobo,
				 rutaEntregableElabPropuestaVobo,
				 fechaEnvioElabPropVobo,
				 fechaEntregaPlaneadaElabPropVobo,
				 fechaEntregaRealElabPropVobo,
				 checkEnvInfoProy,
				 checkRecibirProp,
				 IdProveedorElabPropVobo,
				 IdSolVoboDireccion,
				 rutaSolVoboDireccion,
				 fechaEnvioVoboDireccion,
				 fechaEntregaVoboDireccion,
				 checkEnviarPropVoboDir,
				 checkRecibirTextoAutorizadoVoboDir

				FROM
					`c_textosLibro`
				WHERE 
				IdTexto = ".$IdTexto.";";

				 $catalogo = new Catalogo();
            	$query = $catalogo->obtenerLista($consulta);

            	//echo $consulta;
            	//return $query;
            	while ($rs = mysqli_fetch_array($query)) {
                   
           
					//$this->id_Personas = $rs[''];
					$this->IdAutor = $rs['IdAutor'];
					$this->IdInstitucion = $rs['IdInstitucion'];
					$this->Inedito = $rs['Inedito'];
					$this->IdEntregableTextoFinal = $rs['IdEntregableTextoFinal'] ;
					//$this->rutaEntregableTextoFinal = $rs['Inedito'];
					$this->tituloTexto = $rs['tituloTexto'];
					$this->numCuartillas = $rs['numCuartillas'];
					$this->IdTipoTexto = $rs['IdTipoTexto'];
					$this->IdEntregableCartaSolicitud = $rs['IdEntregableCartaSolicitud'];
					$this->rutaEntregableCartaSolicitud = $rs['rutaEntregableCartaSolicitud'];
					$this->fechaEnvioCartaSolicitud = $rs['fechaEnvioCartaSolicitud'];
					$this->fechaAceptacionCartaSolicitud = $rs['fechaAceptacionCartaSolicitud'];
					$this->checkCartaSolicitud = $rs['checkCartaSolicitud']; 
					$this->IdEntregableTextoPreliminarSolicitar = $rs['IdEntregableTextoPreliminarSolicitar'];
					$this->rutaEntregableTextoPreliminarSolicitar = $rs['rutaEntregableTextoPreliminarSolicitar'];
					$this->fechaEntregaPlaneadaTextoPreliminar = $rs['fechaEntregaPlaneadaTextoPreliminar'];
					$this->fechaEntregaRealTextoPreliminar = $rs['fechaEntregaRealTextoPreliminar'];
					$this->IdEntregableResumenSolicitar = $rs['IdEntregableResumenSolicitar'];
					$this->rutaEntregableResumenSolicitar = $rs['rutaEntregableResumenSolicitar'];
					$this->sinopsisSolicitar = $rs['sinopsisSolicitar'];
					$this->IdEntregableConvenioFirmado = $rs['IdEntregableConvenioFirmado'];
					$this->rutaEntregableConvenioFirmado = $rs['rutaEntregableConvenioFirmado'];
					$this->checkConvenioFirmado = $rs['checkConvenioFirmado'];
					$this->fechaEnvioAutorConvenioFirmado = $rs['fechaEnvioAutorConvenioFirmado'];
					$this->fechaEntregaPlaneadaAutorConvenioFirmado = $rs['fechaEntregaPlaneadaAutorConvenioFirmado'];
					$this->fechaEntregaRealAutorConvenioFirmado = $rs['fechaEntregaRealAutorConvenioFirmado'];
					$this->IdEntregableBasesConvenio = $rs['IdEntregableBasesConvenio'];
					$this->rutaEntregableBasesConvenio = $rs['rutaEntregableBasesConvenio'];
					$this->checkBasesConvenio = $rs['checkBasesConvenio'];
					$this->fechaEnvioJuridicoConvenio = $rs['fechaEnvioJuridicoConvenio'];
					$this->fechaEntregaJuridicoConvenio = $rs['fechaEntregaJuridicoConvenio'];
					$this->IdEntregableTextoEditado = $rs['IdEntregableTextoEditado'];
					$this->rutaEntregableTextoEditado = $rs['rutaEntregableTextoEditado'];
					$this->IdEntregableComentariosEditor = $rs['IdEntregableComentariosEditor'];
					$this->checkComentariosEditor = $rs['checkComentariosEditor'];
					$this->rutaEntregableComentariosEditor = $rs['rutaEntregableComentariosEditor'];
					$this->IdEntregableObservacionesVoboAutor = $rs['IdEntregableObservacionesVoboAutor'];
					$this->rutaEntregableObservacionesVoboAutor = $rs['rutaEntregableObservacionesVoboAutor'];
					$this->fechaEnvioObservacionesVoboAutor = $rs['fechaEnvioObservacionesVoboAutor'];
					$this->fechaEntregaPlaneadaObservacionesVoboAutor = $rs['fechaEntregaPlaneadaObservacionesVoboAutor'];
					$this->fechaEntregaRealObservacionesVoboAutor = $rs['fechaEntregaRealObservacionesVoboAutor'];
					$this->IdEntregableTextoTraducido = $rs['IdEntregableTextoTraducido'];
					$this->rutaEntregableTextoTraducido = $rs['rutaEntregableTextoTraducido'];
					$this->IdTraductorTextoTraducido = $rs['IdTraductorTextoTraducido'];
					$this->IdiomaOriginal = $rs['IdiomaOriginal'];
					$this->IdiomaATraducir = $rs['IdiomaATraducir'];
					$this->fechaEnvioTextoTraducido = $rs['fechaEnvioTextoTraducido'];
					$this->fechaEntregaPlaneadaTextoTraducido = $rs['fechaEntregaPlaneadaTextoTraducido'];
					$this->fechaEntregaRealTextoTraducido = $rs['fechaEntregaRealTextoTraducido'];
					$this->IdEntregableCotejoTraduccion = $rs['IdEntregableCotejoTraduccion'];
					$this->rutaEntregableCotejoTraduccion = $rs['rutaEntregableCotejoTraduccion'];
					$this->IdTraductorCotejoTraduccion = $rs['IdTraductorCotejoTraduccion'];
					$this->fechaEnvioCotejoTraduccion = $rs['fechaEnvioCotejoTraduccion'];
					$this->fechaEntregaPlaneadaCotejoTraduccion = $rs['fechaEntregaPlaneadaCotejoTraduccion'];
					$this->fechaEntregaRealCotejoTraduccion = $rs['fechaEntregaRealCotejoTraduccion'];
					$this->IdEntregableTextoCorregido = $rs['IdEntregableTextoCorregido'];
					$this->rutaEntregableTextoCorregido = $rs['rutaEntregableTextoCorregido'];
					$this->IdCorrectorEstiloTextoCorregido = $rs['IdCorrectorEstiloTextoCorregido'];
					$this->fechaEnvioTextoCorregido = $rs['fechaEnvioTextoCorregido'];
					$this->fechaEntregaTextoCorregido = $rs['fechaEntregaTextoCorregido'];
					$this->fechaEntregaRealTextoCorregido = $rs['fechaEntregaRealTextoCorregido'];
					$this->IdEntregableVoboFinal = $rs['IdEntregableVoboFinal'];
					$this->rutaEntregableVoboFinal = $rs['rutaEntregableVoboFinal'];
					$this->checkVoboFinalAutor = $rs['checkVoboFinalAutor'];
					$this->fechaEnvioVoboFinal = $rs['fechaEnvioVoboFinal'];
					$this->fechaEntregaPlaneadaVoboFina = $rs['fechaEntregaPlaneadaVoboFina'];
					$this->fechaEntregaRealVoboFinal = $rs['fechaEntregaRealVoboFinal'];
					$this->IdEntregableResumenVoboFinal = $rs['IdEntregableResumenVoboFinal'];
					$this->rutaEntregableResumenVoboFinal = $rs['rutaEntregableResumenVoboFinal'];
					$this->sinopsisVoboFinal = $rs['sinopsisVoboFinal'];
					$this->IdEntregableEspFichaInformativa = $rs['IdEntregableEspFichaInformativa'];
					$this->rutaEntregableEspFichaInformativa = $rs['rutaEntregableEspFichaInformativa'];
					$this->IdEntregableElabPropuestaVobo = $rs['IdEntregableElabPropuestaVobo'];
					$this->rutaEntregableElabPropuestaVobo = $rs['rutaEntregableElabPropuestaVobo'];
					$this->fechaEnvioElabPropVobo = $rs['fechaEnvioElabPropVobo'];
					$this->fechaEntregaPlaneadaElabPropVobo = $rs['fechaEntregaPlaneadaElabPropVobo'];
					$this->fechaEntregaRealElabPropVobo = $rs['fechaEntregaRealElabPropVobo'];
					$this->checkEnvInfoProy = $rs['checkEnvInfoProy'];
					$this->checkRecibirProp = $rs['checkRecibirProp'];
					$this->IdProveedorElabPropVobo = $rs['IdProveedorElabPropVobo'];
					$this->IdSolVoboDireccion = $rs['IdSolVoboDireccion'];
					$this->rutaSolVoboDireccion = $rs['rutaSolVoboDireccion'];
					$this->fechaEnvioVoboDireccion = $rs['fechaEnvioVoboDireccion'];
					$this->fechaEntregaVoboDireccion = $rs['fechaEntregaVoboDireccion'];
					$this->checkEnviarPropVoboDir = $rs['checkEnviarPropVoboDir'];
				 	$this->checkRecibirTextoAutorizadoVoboDir = $rs['checkRecibirTextoAutorizadoVoboDir'];
				 	


                }

	}

	public function agregarTexto(){

		if (!isset($this->IdEntregableTextoFinal) || $this->IdEntregableTextoFinal == NULL || $this->IdEntregableTextoFinal == ""){
            $this->IdEntregableTextoFinal = "NULL";
        }
		
		if (!isset($this->IdLibro) || $this->IdLibro == NULL || $this->IdLibro == ""){
            $this->IdLibro = "NULL";
        }
        if (!isset($this->Inedito) || $this->Inedito == NULL || $this->Inedito == ""){
            $this->Inedito = "NULL";
        }
        if (!isset($this->IdAutor) || $this->IdAutor == NULL || $this->IdAutor == ""){
            $this->IdAutor = "NULL";
        }
        if (!isset($this->IdTraductorTextoTraducido) || $this->IdTraductorTextoTraducido == NULL || $this->IdTraductorTextoTraducido == ""){
            $this->IdTraductorTextoTraducido = "NULL";
        }
        if (!isset($this->IdiomaOriginal) || $this->IdiomaOriginal == NULL || $this->IdiomaOriginal == ""){
            $this->IdiomaOriginal = "NULL";
        }
        if (!isset($this->IdiomaATraducir) || $this->IdiomaATraducir == NULL || $this->IdiomaATraducir == ""){
            $this->IdiomaATraducir = "NULL";
        }
        if (!isset($this->IdTraductorCotejoTraduccion) || $this->IdTraductorCotejoTraduccion == NULL || $this->IdTraductorCotejoTraduccion == ""){
            $this->IdTraductorCotejoTraduccion = "NULL";
        }
        if (!isset($this->IdCorrectorEstiloTextoCorregido) || $this->IdCorrectorEstiloTextoCorregido == NULL || $this->IdCorrectorEstiloTextoCorregido == ""){
            $this->IdCorrectorEstiloTextoCorregido = "NULL";
        }
        if (!isset($this->IdInstitucion) || $this->IdInstitucion == NULL || $this->IdInstitucion == ""){
            $this->IdInstitucion = "NULL";
        }
        if (!isset($this->numCuartillas) || $this->numCuartillas == NULL || $this->numCuartillas == ""){
            $this->numCuartillas = "NULL";
        }
        if (!isset($this->IdProveedorElabPropVobo) || $this->IdProveedorElabPropVobo == NULL || $this->IdProveedorElabPropVobo == ""){
            $this->IdProveedorElabPropVobo = "NULL";
        }

       if (!isset($this->fechaEntregaPlaneadaTextoPreliminar) || $this->fechaEntregaPlaneadaTextoPreliminar == NULL || $this->fechaEntregaPlaneadaTextoPreliminar == ""){
            $this->fechaEntregaPlaneadaTextoPreliminar = "0000-00-00";
        }
        if (!isset($this->fechaEntregaRealTextoPreliminar) || $this->fechaEntregaRealTextoPreliminar == NULL || $this->fechaEntregaRealTextoPreliminar == ""){
            $this->fechaEntregaRealTextoPreliminar = "0000-00-00";
        }
        if (!isset($this->fechaEnvioCartaSolicitud) || $this->fechaEnvioCartaSolicitud == NULL || $this->fechaEnvioCartaSolicitud == ""){
            $this->fechaEnvioCartaSolicitud = "0000-00-00";
        }
        if (!isset($this->fechaAceptacionCartaSolicitud) || $this->fechaAceptacionCartaSolicitud == NULL || $this->fechaAceptacionCartaSolicitud == ""){
            $this->fechaAceptacionCartaSolicitud = "0000-00-00";
        }
        if (!isset($this->fechaEnvioAutorConvenioFirmado) || $this->fechaEnvioAutorConvenioFirmado == NULL || $this->fechaEnvioAutorConvenioFirmado == ""){
            $this->fechaEnvioAutorConvenioFirmado = "0000-00-00";
        }
        if (!isset($this->fechaEntregaPlaneadaAutorConvenioFirmado) || $this->fechaEntregaPlaneadaAutorConvenioFirmado == NULL || $this->fechaEntregaPlaneadaAutorConvenioFirmado == ""){
            $this->fechaEntregaPlaneadaAutorConvenioFirmado = "0000-00-00";
        }
        if (!isset($this->fechaEntregaRealAutorConvenioFirmado) || $this->fechaEntregaRealAutorConvenioFirmado == NULL || $this->fechaEntregaRealAutorConvenioFirmado == ""){
            $this->fechaEntregaRealAutorConvenioFirmado = "0000-00-00";
        }
        if (!isset($this->fechaEnvioJuridicoConvenio) || $this->fechaEnvioJuridicoConvenio == NULL || $this->fechaEnvioJuridicoConvenio == ""){
            $this->fechaEnvioJuridicoConvenio = "0000-00-00";
        }
        if (!isset($this->fechaEntregaJuridicoConvenio) || $this->fechaEntregaJuridicoConvenio == NULL || $this->fechaEntregaJuridicoConvenio == ""){
            $this->fechaEntregaJuridicoConvenio = "0000-00-00";
        }
        if (!isset($this->fechaEnvioObservacionesVoboAutor) || $this->fechaEnvioObservacionesVoboAutor == NULL || $this->fechaEnvioObservacionesVoboAutor == ""){
            $this->fechaEnvioObservacionesVoboAutor = "0000-00-00";
        }
        if (!isset($this->fechaEntregaPlaneadaObservacionesVoboAutor) || $this->fechaEntregaPlaneadaObservacionesVoboAutor == NULL || $this->fechaEntregaPlaneadaObservacionesVoboAutor == ""){
            $this->fechaEntregaPlaneadaObservacionesVoboAutor = "0000-00-00";
        }
        if (!isset($this->fechaEntregaRealObservacionesVoboAutor) || $this->fechaEntregaRealObservacionesVoboAutor == NULL || $this->fechaEntregaRealObservacionesVoboAutor == ""){
            $this->fechaEntregaRealObservacionesVoboAutor = "0000-00-00";
        }
        if (!isset($this->fechaEnvioTextoTraducido) || $this->fechaEnvioTextoTraducido == NULL || $this->fechaEnvioTextoTraducido == ""){
            $this->fechaEnvioTextoTraducido = "0000-00-00";
        }
        if (!isset($this->fechaEntregaPlaneadaTextoTraducido) || $this->fechaEntregaPlaneadaTextoTraducido == NULL || $this->fechaEntregaPlaneadaTextoTraducido == ""){
            $this->fechaEntregaPlaneadaTextoTraducido = "0000-00-00";
        }
        if (!isset($this->fechaEntregaRealTextoTraducido) || $this->fechaEntregaRealTextoTraducido == NULL || $this->fechaEntregaRealTextoTraducido == ""){
            $this->fechaEntregaRealTextoTraducido = "0000-00-00";
        }
        if (!isset($this->fechaEnvioCotejoTraduccion) || $this->fechaEnvioCotejoTraduccion == NULL || $this->fechaEnvioCotejoTraduccion == ""){
            $this->fechaEnvioCotejoTraduccion = "0000-00-00";
        }
        if (!isset($this->fechaEntregaPlaneadaCotejoTraduccion) || $this->fechaEntregaPlaneadaCotejoTraduccion == NULL || $this->fechaEntregaPlaneadaCotejoTraduccion == ""){
            $this->fechaEntregaPlaneadaCotejoTraduccion = "0000-00-00";
        }
        if (!isset($this->fechaEntregaRealCotejoTraduccion) || $this->fechaEntregaRealCotejoTraduccion == NULL || $this->fechaEntregaRealCotejoTraduccion == ""){
            $this->fechaEntregaRealCotejoTraduccion = "0000-00-00";
        }
        if (!isset($this->fechaEnvioVoboFinal) || $this->fechaEnvioVoboFinal == NULL || $this->fechaEnvioVoboFinal == ""){
            $this->fechaEnvioVoboFinal = "0000-00-00";
        }
        if (!isset($this->fechaEntregaPlaneadaVoboFina) || $this->fechaEntregaPlaneadaVoboFina == NULL || $this->fechaEntregaPlaneadaVoboFina == ""){
            $this->fechaEntregaPlaneadaVoboFina = "0000-00-00";
        }
        if (!isset($this->fechaEntregaRealVoboFinal) || $this->fechaEntregaRealVoboFinal == NULL || $this->fechaEntregaRealVoboFinal == ""){
            $this->fechaEntregaRealVoboFinal = "0000-00-00";
        }
        if (!isset($this->fechaEnvioElabPropVobo) || $this->fechaEnvioElabPropVobo == NULL || $this->fechaEnvioElabPropVobo == ""){
            $this->fechaEnvioElabPropVobo = "0000-00-00";
        }
        if (!isset($this->fechaEntregaPlaneadaElabPropVobo) || $this->fechaEntregaPlaneadaElabPropVobo == NULL || $this->fechaEntregaPlaneadaElabPropVobo == ""){
            $this->fechaEntregaPlaneadaElabPropVobo = "0000-00-00";
        }
        if (!isset($this->fechaEntregaRealElabPropVobo) || $this->fechaEntregaRealElabPropVobo == NULL || $this->fechaEntregaRealElabPropVobo == ""){
            $this->fechaEntregaRealElabPropVobo = "0000-00-00";
        }
        if (!isset($this->fechaEntregaRealElabPropVobo) || $this->fechaEntregaRealElabPropVobo == NULL || $this->fechaEntregaRealElabPropVobo == ""){
            $this->fechaEntregaRealElabPropVobo = "0000-00-00";
        }
        if (!isset($this->fechaEntregaVoboDireccion) || $this->fechaEntregaVoboDireccion == NULL || $this->fechaEntregaVoboDireccion == ""){
            $this->fechaEntregaVoboDireccion = "0000-00-00";
        }
        if (!isset($this->fechaEnvioVoboDireccion) || $this->fechaEnvioVoboDireccion == NULL || $this->fechaEnvioVoboDireccion == ""){
            $this->fechaEnvioVoboDireccion = "0000-00-00";
        }
        if (!isset($this->fechaEnvioTextoCorregido) || $this->fechaEnvioTextoCorregido == NULL || $this->fechaEnvioTextoCorregido == ""){
            $this->fechaEnvioTextoCorregido = "0000-00-00";
        }
        if (!isset($this->fechaEntregaTextoCorregido) || $this->fechaEntregaTextoCorregido == NULL || $this->fechaEntregaTextoCorregido == ""){
            $this->fechaEntregaTextoCorregido = "0000-00-00";
        }
        if (!isset($this->fechaEntregaRealTextoCorregido ) || $this->fechaEntregaRealTextoCorregido == NULL || $this->fechaEntregaRealTextoCorregido == ""){
            $this->fechaEntregaRealTextoCorregido = "0000-00-00";
        }

        if (!isset($this->rutaEntregableCartaSolicitud) || $this->rutaEntregableCartaSolicitud == NULL || $this->rutaEntregableCartaSolicitud == ""){
            //$this->Imagen = "NULL";
            $rutaCartaSol = "NULL";
        }else{
        	$rutaCartaSol =  "'".$this->rutaEntregableCartaSolicitud."'";
        }
        if (!isset($this->rutaEntregableTextoPreliminarSolicitar) || $this->rutaEntregableTextoPreliminarSolicitar == NULL || $this->rutaEntregableTextoPreliminarSolicitar == ""){
            //$this->Imagen = "NULL";
            $rutaTextoPre = "NULL";
        }else{
        	$rutaTextoPre =  "'".$this->rutaEntregableTextoPreliminarSolicitar."'";
        }
        if (!isset($this->rutaEntregableResumenSolicitar) || $this->rutaEntregableResumenSolicitar == NULL || $this->rutaEntregableResumenSolicitar == ""){
            //$this->Imagen = "NULL";
            $rutaResumenSol = "NULL";
        }else{
        	$rutaResumenSol =  "'".$this->rutaEntregableResumenSolicitar."'";
        }
        if (!isset($this->rutaEntregableConvenioFirmado) || $this->rutaEntregableConvenioFirmado == NULL || $this->rutaEntregableConvenioFirmado == ""){
            //$this->Imagen = "NULL";
            $rutaConvenioFirmado = "NULL";
        }else{
        	$rutaConvenioFirmado =  "'".$this->rutaEntregableConvenioFirmado."'";
        }
        if (!isset($this->rutaEntregableBasesConvenio) || $this->rutaEntregableBasesConvenio == NULL || $this->rutaEntregableBasesConvenio == ""){
            //$this->Imagen = "NULL";
            $rutaBasesConvenio = "NULL";
        }else{
        	$rutaBasesConvenio =  "'".$this->rutaEntregableBasesConvenio."'";
        }
        if (!isset($this->rutaEntregableTextoEditado) || $this->rutaEntregableTextoEditado == NULL || $this->rutaEntregableTextoEditado == ""){
            //$this->Imagen = "NULL";
            $rutaTextoEditado = "NULL";
        }else{
        	$rutaTextoEditado =  "'".$this->rutaEntregableTextoEditado."'";
        }
        if (!isset($this->rutaEntregableComentariosEditor) || $this->rutaEntregableComentariosEditor == NULL || $this->rutaEntregableComentariosEditor == ""){
            //$this->Imagen = "NULL";
            $rutaComentEditor = "NULL";
        }else{
        	$rutaComentEditor =  "'".$this->rutaEntregableComentariosEditor."'";
        }
        if (!isset($this->rutaEntregableObservacionesVoboAutor) || $this->rutaEntregableObservacionesVoboAutor == NULL || $this->rutaEntregableObservacionesVoboAutor == ""){
            //$this->Imagen = "NULL";
            $rutaObsVoboAutor = "NULL";
        }else{
        	$rutaObsVoboAutor =  "'".$this->rutaEntregableObservacionesVoboAutor."'";
        }
        if (!isset($this->rutaEntregableTextoTraducido) || $this->rutaEntregableTextoTraducido == NULL || $this->rutaEntregableTextoTraducido == ""){
            //$this->Imagen = "NULL";
            $rutaTextoTraducido = "NULL";
        }else{
        	$rutaTextoTraducido =  "'".$this->rutaEntregableTextoTraducido."'";
        }
        if (!isset($this->rutaEntregableCotejoTraduccion) || $this->rutaEntregableCotejoTraduccion == NULL || $this->rutaEntregableCotejoTraduccion == ""){
            //$this->Imagen = "NULL";
            $rutaCotejoTraduccion = "NULL";
        }else{
        	$rutaCotejoTraduccion =  "'".$this->rutaEntregableCotejoTraduccion."'";
        }

        if (!isset($this->rutaEntregableTextoCorregido) || $this->rutaEntregableTextoCorregido == NULL || $this->rutaEntregableTextoCorregido == ""){
            //$this->Imagen = "NULL";
            $rutaTextoCorregido = "NULL";
        }else{
        	$rutaTextoCorregido =  "'".$this->rutaEntregableTextoCorregido."'";
        }
        if (!isset($this->rutaEntregableVoboFinal) || $this->rutaEntregableVoboFinal == NULL || $this->rutaEntregableVoboFinal == ""){
            //$this->Imagen = "NULL";
            $rutaVoboFinal = "NULL";
        }else{
        	$rutaVoboFinal =  "'".$this->rutaEntregableVoboFinal."'";
        }
        if (!isset($this->rutaEntregableResumenVoboFinal) || $this->rutaEntregableResumenVoboFinal == NULL || $this->rutaEntregableResumenVoboFinal == ""){
            //$this->Imagen = "NULL";
            $rutaResumenVoboFinal = "NULL";
        }else{
        	$rutaResumenVoboFinal =  "'".$this->rutaEntregableResumenVoboFinal."'";
        }
        if (!isset($this->rutaEntregableEspFichaInformativa) || $this->rutaEntregableEspFichaInformativa == NULL || $this->rutaEntregableEspFichaInformativa == ""){
            
            $rutaFichaInformativa = "NULL";
        }else{
        	$rutaFichaInformativa = "'".$this->rutaEntregableEspFichaInformativa."'";
        }
        if (!isset($this->rutaEntregableElabPropuestaVobo) || $this->rutaEntregableElabPropuestaVobo == NULL || $this->rutaEntregableElabPropuestaVobo == ""){
            
            $rutaPropVobo = "NULL";
        }else{
        	$rutaPropVobo =  "'".$this->rutaEntregableElabPropuestaVobo."'";
        }

        if (!isset($this->rutaSolVoboDireccion) || $this->rutaSolVoboDireccion == NULL || $this->rutaSolVoboDireccion == ""){
            
            $rutaVoboDireccion = "NULL";
        }else{
        	$rutaVoboDireccion =  "'".$this->rutaSolVoboDireccion."'";
        }
        if (!isset($this->checkCartaSolicitud) || $this->checkCartaSolicitud == NULL || $this->checkCartaSolicitud == ""){
            $this->checkCartaSolicitud = "NULL";
        }
        if (!isset($this->checkConvenioFirmado) || $this->checkConvenioFirmado == NULL || $this->checkConvenioFirmado == ""){
            $this->checkConvenioFirmado = "NULL";
        }
        if (!isset($this->checkBasesConvenio) || $this->checkBasesConvenio == NULL || $this->checkBasesConvenio == ""){
            $this->checkBasesConvenio = "NULL";
        }
        if (!isset($this->checkComentariosEditor) || $this->checkComentariosEditor == NULL || $this->checkComentariosEditor == ""){
            $this->checkComentariosEditor = "NULL";
        }
        if (!isset($this->checkVoboFinalAutor) || $this->checkVoboFinalAutor == NULL || $this->checkVoboFinalAutor == ""){
            $this->checkVoboFinalAutor = "NULL";
        }
        if (!isset($this->checkEnviarPropVoboDir) || $this->checkEnviarPropVoboDir == NULL || $this->checkEnviarPropVoboDir == ""){
            $this->checkEnviarPropVoboDir = "NULL";
        }
        if (!isset($this->checkRecibirTextoAutorizadoVoboDir) || $this->checkRecibirTextoAutorizadoVoboDir == NULL || $this->checkRecibirTextoAutorizadoVoboDir == ""){
            $this->checkRecibirTextoAutorizadoVoboDir = "NULL";
        }
        if (!isset($this->checkEnvInfoProy) || $this->checkEnvInfoProy == NULL || $this->checkEnvInfoProy == ""){
            $this->checkEnvInfoProy = "NULL";
        }
        if (!isset($this->checkRecibirProp) || $this->checkRecibirProp == NULL || $this->checkRecibirProp == ""){
            $this->checkRecibirProp = "NULL";
        }

		$insert ="INSERT INTO c_textosLibro (IdLibro,
IdAutor,
IdInstitucion,
Inedito,
IdEntregableTextoFinal,
tituloTexto,
numCuartillas,
IdTipoTexto,
rutaEntregableCartaSolicitud,
fechaEnvioCartaSolicitud,
fechaAceptacionCartaSolicitud,
checkCartaSolicitud,
rutaEntregableTextoPreliminarSolicitar,
fechaEntregaPlaneadaTextoPreliminar,
fechaEntregaRealTextoPreliminar,
rutaEntregableResumenSolicitar,
sinopsisSolicitar,
rutaEntregableConvenioFirmado,
checkConvenioFirmado,
fechaEnvioAutorConvenioFirmado,
fechaEntregaPlaneadaAutorConvenioFirmado,
fechaEntregaRealAutorConvenioFirmado,
rutaEntregableBasesConvenio,
checkBasesConvenio,
fechaEnvioJuridicoConvenio,
fechaEntregaJuridicoConvenio,
rutaEntregableTextoEditado,
rutaEntregableComentariosEditor,
checkComentariosEditor,
rutaEntregableObservacionesVoboAutor,
fechaEnvioObservacionesVoboAutor,
fechaEntregaPlaneadaObservacionesVoboAutor,
fechaEntregaRealObservacionesVoboAutor,
rutaEntregableTextoTraducido,
IdTraductorTextoTraducido,
IdiomaOriginal,
IdiomaATraducir,
fechaEnvioTextoTraducido,
fechaEntregaPlaneadaTextoTraducido,
fechaEntregaRealTextoTraducido,
rutaEntregableCotejoTraduccion,
IdTraductorCotejoTraduccion,
fechaEnvioCotejoTraduccion,
fechaEntregaPlaneadaCotejoTraduccion,
fechaEntregaRealCotejoTraduccion,
rutaEntregableTextoCorregido,
IdCorrectorEstiloTextoCorregido,
fechaEnvioTextoCorregido,
fechaEntregaTextoCorregido,
fechaEntregaRealTextoCorregido,
rutaEntregableVoboFinal,
checkVoboFinalAutor,
fechaEnvioVoboFinal,
fechaEntregaPlaneadaVoboFina,
fechaEntregaRealVoboFinal,
rutaEntregableResumenVoboFinal,
sinopsisVoboFinal,
rutaEntregableEspFichaInformativa,
rutaEntregableElabPropuestaVobo,
fechaEnvioElabPropVobo,
fechaEntregaPlaneadaElabPropVobo,
fechaEntregaRealElabPropVobo,
checkEnvInfoProy,
checkRecibirProp,
IdProveedorElabPropVobo,
rutaSolVoboDireccion,
fechaEnvioVoboDireccion,
fechaEntregaVoboDireccion,
checkEnviarPropVoboDir,
checkRecibirTextoAutorizadoVoboDir,
UsuarioCreacion,
FechaCreacion,
UsuarioUltimaModificacion,
FechaUltimaModificacion,
Pantalla
) VALUES (".$this->IdLibro.",".$this->IdAutor.",".$this->IdInstitucion.",".$this->Inedito.",".$this->IdEntregableTextoFinal.",'".$this->tituloTexto."',".$this->numCuartillas.",".$this->IdTipoTexto.",".$rutaCartaSol.",'".$this->fechaEnvioCartaSolicitud."','".$this->fechaAceptacionCartaSolicitud."',".$this->checkCartaSolicitud.",".$rutaTextoPre.",'".$this->fechaEntregaPlaneadaTextoPreliminar."','".$this->fechaEntregaRealTextoPreliminar."',".$rutaResumenSol.",'".$this->sinopsisSolicitar."',".$rutaConvenioFirmado.",".$this->checkConvenioFirmado.",'".$this->fechaEnvioAutorConvenioFirmado."','".$this->fechaEntregaPlaneadaAutorConvenioFirmado."','".$this->fechaEntregaRealAutorConvenioFirmado."',".$rutaBasesConvenio.",".$this->checkBasesConvenio.",'".$this->fechaEnvioJuridicoConvenio."','".$this->fechaEntregaJuridicoConvenio."',".$rutaTextoEditado.",".$rutaComentEditor.",".$this->checkComentariosEditor.",".$rutaObsVoboAutor.",'".$this->fechaEnvioObservacionesVoboAutor."','".$this->fechaEntregaPlaneadaObservacionesVoboAutor."','".$this->fechaEntregaRealObservacionesVoboAutor."',".$rutaTextoTraducido.",".$this->IdTraductorTextoTraducido.",".$this->IdiomaOriginal.",".$this->IdiomaATraducir.",'".$this->fechaEnvioTextoTraducido."','".$this->fechaEntregaPlaneadaTextoTraducido."','".$this->fechaEntregaRealTextoTraducido."',".$rutaCotejoTraduccion.",".$this->IdTraductorCotejoTraduccion.",'".$this->fechaEnvioCotejoTraduccion."','".$this->fechaEntregaPlaneadaCotejoTraduccion."','".$this->fechaEntregaRealCotejoTraduccion."',".$rutaTextoCorregido.",".$this->IdCorrectorEstiloTextoCorregido.",'".$this->fechaEnvioTextoCorregido."','".$this->fechaEntregaTextoCorregido."','".$this->fechaEntregaRealTextoCorregido."',".$rutaVoboFinal.",".$this->checkVoboFinalAutor.",'".$this->fechaEnvioVoboFinal."','".$this->fechaEntregaPlaneadaVoboFina."','".$this->fechaEntregaRealVoboFinal."',".$rutaResumenVoboFinal.",'".$this->sinopsisVoboFinal."',".$rutaFichaInformativa.",".$rutaPropVobo.",'".$this->fechaEnvioElabPropVobo."','".$this->fechaEntregaPlaneadaElabPropVobo."','".$this->fechaEntregaRealElabPropVobo."',".$this->checkEnvInfoProy.",".$this->checkRecibirProp.",".$this->IdProveedorElabPropVobo.",".$rutaVoboDireccion.",'".$this->fechaEnvioVoboDireccion."','".$this->fechaEntregaVoboDireccion."',".$this->checkEnviarPropVoboDir.",".$this->checkRecibirTextoAutorizadoVoboDir.",'".$this->UsuarioCreacion."',NOW(),'".$this->UsuarioUltimaModificacion."',NOW(),'".$this->Pantalla."');";

  		$catalogo = new Catalogo();

  		//echo "<br>".$insert."<br>";

  		$this->IdTexto = $catalogo->insertarRegistro($insert);

        if ($this->IdTexto == 0 || $this->IdTexto == null) {
            return false;
        }
        return true;

	}

	public function setcontadorCampos($contadorCampos){
        $this->contadorCampos = $contadorCampos;
   	}
	public function getcontadorCampos($contadorCampos){
		
        $this->contadorCampos = $contadorCampos;
   	}
	public function setIdTextoSC($IdTextoSC){
		
        $this->IdTextoSC = $IdTextoSC;
   	}
	public function getIdTextoMPBA($IdTextoMPBA){
		
        $this->IdTextoMPBA = $IdTextoMPBA;
   	}
	public function setIdTextoMPBA($IdTextoMPBA){
		
        $this->IdTextoMPBA = $IdTextoMPBA;
   	}
	public function getIdTextoPatrocinador($IdTextoPatrocinador){
		
        $this->IdTextoPatrocinador = $IdTextoPatrocinador;
   	}
	public function setIdTextoPatrocinador($IdTextoPatrocinador){
		
        $this->IdTextoPatrocinador = $IdTextoPatrocinador;
   	}
	public function getIdTextoCoeditorO($IdTextoCoeditorO){
		
        $this->IdTextoCoeditorO = $IdTextoCoeditorO;
   	}
	public function setIdTextoCoeditorO($IdTextoCoeditorO){
		
        $this->IdTextoCoeditorO = $IdTextoCoeditorO;
   	}
	public function getIdTextoSC($IdTextoSC){
		
        $this->IdTextoSC = $IdTextoSC;
   	}
	
	public function setIdTextoINBAL($IdTextoINBAL){
        $this->IdTextoINBAL = $IdTextoINBAL;
   	}
	public function getIdTextoINBAL($IdTextoINBAL){
        $this->IdTextoINBAL = $IdTextoINBAL;
   	}
	public function setIdLibro($IdLibro){
        $this->IdLibro = $IdLibro;
   	}
		public function setIdArchPreliminar($IdArchPreliminar){
        $this->IdArchPreliminar = $IdArchPreliminar;
   	}
		public function setNombreArchivoPr($NombreArchivoPr){
        $this->NombreArchivoPr = $NombreArchivoPr;
   	}
		public function setFechaPlaneadaPreliminar($FechaPlaneadaPreliminar){
        $this->FechaPlaneadaPreliminar = $FechaPlaneadaPreliminar;
   	}
		public function setFechaRealPreliminar($FechaRealPreliminar){
        $this->FechaRealPreliminar = $FechaRealPreliminar;
   	}
	public function setRutaArchivoPreliminar($RutaArchivoPreliminar){
        $this->RutaArchivoPreliminar = $RutaArchivoPreliminar;
   	}
	
		public function getIdArchPreliminar($IdArchPreliminar){
        $this->IdArchPreliminar = $IdArchPreliminar;
   	}
		public function getNombreArchivoPr($NombreArchivoPr){
        $this->NombreArchivoPr = $NombreArchivoPr;
   	}
		public function getFechaPlaneadaPreliminar($FechaPlaneadaPreliminar){
        $this->FechaPlaneadaPreliminar = $FechaPlaneadaPreliminar;
   	}
		public function getFechaRealPreliminar($FechaRealPreliminar){
        $this->FechaRealPreliminar = $FechaRealPreliminar;
   	}
	public function getRutaArchivoPreliminar($RutaArchivoPreliminar){
        $this->RutaArchivoPreliminar = $RutaArchivoPreliminar;
   	}
	
public function agregarSecretariaTextoPreliminar() {
		$consulta = ('INSERT INTO c_textoSecretariaCulturaLibro(IdEntregablePropVobo,Nombre,fechaEnvioPropVobo, fechaEntregaPlaneadaPropVobo, fechaEntregaRealPropVobo, rutaEntregablePropVobo,Id_libro)
            VALUES('.$this->IdArchPreliminar.',"'.$this->NombreArchivoPr.'",NOW(),"'.$this->FechaPlaneadaPreliminar.'","' .$this->FechaRealPreliminar.'","'.$this->RutaArchivoPreliminar. '",' .$this->IdLibro.');');

		$catalogo = new Catalogo();

  		//echo "<br>".$consulta."<br>";

  	 $catalogo->insertarRegistro($consulta);

        return true;
	}
public function agregarCoeditorOtrosTextoPreliminar(){
	$consulta = ('INSERT INTO c_textoCoeditorOtrosLibro(IdTextoPreliminar,Nombre,fechaEntregaReal, fechaEnvioTextoPreliminar, fechaEntregaPreliminar, rutaTextoPreliminar,IdLibro)
            VALUES('.$this->IdArchPreliminar.',"'.$this->NombreArchivoPr.'",NOW(),"'.$this->FechaPlaneadaPreliminar.'","' .$this->FechaRealPreliminar.'","'.$this->RutaArchivoPreliminar. '",' .$this->IdLibro.');');

		$catalogo = new Catalogo();

  		//echo "<br>".$consulta."<br>";
       
  	 $catalogo->insertarRegistro($consulta);

        return true;
}
public function agregarINBALTextoPreliminar() {
		$consulta = ('INSERT INTO c_textoINBALLibro(IdTextoPreliminar,Nombre,fechaEnvioPropVobo, fechaEntregaPropVobo, fechaEntregaRealPropVobo, rutaEntregablePropVobo,Id_libro)
            VALUES('.$this->IdArchPreliminar.',"'.$this->NombreArchivoPr.'",NOW(),"'.$this->FechaPlaneadaPreliminar.'","' .$this->FechaRealPreliminar.'","'.$this->RutaArchivoPreliminar. '",' .$this->IdLibro.');');

		$catalogo = new Catalogo();

  		//echo "<br>".$consulta."<br>";
            
  	 $catalogo->insertarRegistro($consulta);

        return true;
	}	
public function agregarPatrocinadorTextoPreliminar(){
$consulta = ('INSERT INTO c_textoPatrocinadorLibro(IdTextoPreliminar,Nombre,fechaEntregaReal, fechaEnvioTextoInstitucionalPreliminar, fechaEntregaInstitucionalPreliminar, rutaTextoPreliminar,IdLibro)
            VALUES('.$this->IdArchPreliminar.',"'.$this->NombreArchivoPr.'",NOW(),"'.$this->FechaPlaneadaPreliminar.'","' .$this->FechaRealPreliminar.'","'.$this->RutaArchivoPreliminar. '",' .$this->IdLibro.');');

		$catalogo = new Catalogo();

  		//echo "<br>".$consulta."<br>";
       
  	 $catalogo->insertarRegistro($consulta);

        return true;
}	
public function agregarMPBATextoPreliminar(){
$consulta = ('INSERT INTO c_textoDireccionMPBALibro(IdTextoPreliminar,Nombre,fechaEnvioPropTexto, fechaEntregaPlaneadaPropTexto, fechaEntregaRealPropTexto, rutaEntregablePropTexto,IdLibro)
            VALUES('.$this->IdArchPreliminar.',"'.$this->NombreArchivoPr.'",NOW(),"'.$this->FechaPlaneadaPreliminar.'","' .$this->FechaRealPreliminar.'","'.$this->RutaArchivoPreliminar. '",' .$this->IdLibro.');');

		$catalogo = new Catalogo();

  		//echo "<br>".$consulta."<br>";
       
  	 $catalogo->insertarRegistro($consulta);

        return true;
}	
	  public function eliminarEntregableEspecificoVersion(){
        $consulta = ("DELETE FROM c_textoSecretariaCulturaLibro WHERE IdTextoSC = ".$this->IdTextoSC.";");
        $catalogo = new Catalogo();
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_textoSecretariaCulturaLibro', 'IdTextoSC = '.$this->IdTextoSC);
        //echo "<br>$consulta<br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
	public function eliminarEntregableEspecificoVersionPatrocinador(){
        $consulta = ("DELETE FROM c_textoPatrocinadorLibro WHERE IdTextoPatrocinador = ".$this->IdTextoPatrocinador.";");
        $catalogo = new Catalogo();
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'IdTextoPatrocinador', 'IdTextoPatrocinador = '.$this->IdTextoPatrocinador);
        //echo "<br>$consulta<br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
	public function eliminarEntregableEspecificoVersionCoeditorOtros(){
        $consulta = ("DELETE FROM c_textoCoeditorOtrosLibro WHERE IdTextoCoeditorO = ".$this->IdTextoCoeditorO.";");
        $catalogo = new Catalogo();
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'IdTextoCoeditorO', 'IdTextoCoeditorO = '.$this->IdTextoCoeditorO);
        //echo "<br>$consulta<br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
	
	public function eliminarEntregableEspecificoVersionINBAL(){
        $consulta = ("DELETE FROM c_textoINBALLibro WHERE IdTextoINBAL = ".$this->IdTextoINBAL.";");
        $catalogo = new Catalogo();
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_textoINBALLibro', 'IdTextoINBAL = '.$this->IdTextoINBAL);
        //echo "<br>$consulta<br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
	public function eliminarEntregableEspecificoVersionMPBA(){
        $consulta = ("DELETE FROM c_textoDireccionMPBALibro WHERE IdTextoDireccionMPBA = ".$this->IdTextoMPBA.";");
        $catalogo = new Catalogo();
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_textoINBALLibro', 'IdTextoDireccionMPBA = '.$this->IdTextoMPBA);
        //echo "<br>$consulta<br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
	public function editarTexto(){
		if (!isset($this->IdEntregableTextoFinal) || $this->IdEntregableTextoFinal == NULL || $this->IdEntregableTextoFinal == ""){
            $this->IdEntregableTextoFinal = "NULL";
        }
		
		if (!isset($this->IdLibro) || $this->IdLibro == NULL || $this->IdLibro == ""){
            $this->IdLibro = "NULL";
        }
        if (!isset($this->Inedito) || $this->Inedito == NULL || $this->Inedito == ""){
            $this->Inedito = "NULL";
        }
        if (!isset($this->IdAutor) || $this->IdAutor == NULL || $this->IdAutor == ""){
            $this->IdAutor = "NULL";
        }
        if (!isset($this->IdTraductorTextoTraducido) || $this->IdTraductorTextoTraducido == NULL || $this->IdTraductorTextoTraducido == ""){
            $this->IdTraductorTextoTraducido = "NULL";
        }
        if (!isset($this->IdiomaOriginal) || $this->IdiomaOriginal == NULL || $this->IdiomaOriginal == ""){
            $this->IdiomaOriginal = "NULL";
        }
        if (!isset($this->IdiomaATraducir) || $this->IdiomaATraducir == NULL || $this->IdiomaATraducir == ""){
            $this->IdiomaATraducir = "NULL";
        }
        if (!isset($this->IdTraductorCotejoTraduccion) || $this->IdTraductorCotejoTraduccion == NULL || $this->IdTraductorCotejoTraduccion == ""){
            $this->IdTraductorCotejoTraduccion = "NULL";
        }
        if (!isset($this->IdCorrectorEstiloTextoCorregido) || $this->IdCorrectorEstiloTextoCorregido == NULL || $this->IdCorrectorEstiloTextoCorregido == ""){
            $this->IdCorrectorEstiloTextoCorregido = "NULL";
        }
        if (!isset($this->IdInstitucion) || $this->IdInstitucion == NULL || $this->IdInstitucion == ""){
            $this->IdInstitucion = "NULL";
        }
        if (!isset($this->numCuartillas) || $this->numCuartillas == NULL || $this->numCuartillas == ""){
            $this->numCuartillas = "NULL";
        }
        if (!isset($this->IdProveedorElabPropVobo) || $this->IdProveedorElabPropVobo == NULL || $this->IdProveedorElabPropVobo == ""){
            $this->IdProveedorElabPropVobo = "NULL";
        }

        if (!isset($this->fechaEntregaPlaneadaTextoPreliminar) || $this->fechaEntregaPlaneadaTextoPreliminar == NULL || $this->fechaEntregaPlaneadaTextoPreliminar == ""){
            $this->fechaEntregaPlaneadaTextoPreliminar = "0000-00-00";
        }
        if (!isset($this->fechaEntregaRealTextoPreliminar) || $this->fechaEntregaRealTextoPreliminar == NULL || $this->fechaEntregaRealTextoPreliminar == ""){
            $this->fechaEntregaRealTextoPreliminar = "0000-00-00";
        }
        if (!isset($this->fechaEnvioCartaSolicitud) || $this->fechaEnvioCartaSolicitud == NULL || $this->fechaEnvioCartaSolicitud == ""){
            $this->fechaEnvioCartaSolicitud = "0000-00-00";
        }
        if (!isset($this->fechaAceptacionCartaSolicitud) || $this->fechaAceptacionCartaSolicitud == NULL || $this->fechaAceptacionCartaSolicitud == ""){
            $this->fechaAceptacionCartaSolicitud = "0000-00-00";
        }
        if (!isset($this->fechaEnvioAutorConvenioFirmado) || $this->fechaEnvioAutorConvenioFirmado == NULL || $this->fechaEnvioAutorConvenioFirmado == ""){
            $this->fechaEnvioAutorConvenioFirmado = "0000-00-00";
        }
        if (!isset($this->fechaEntregaPlaneadaAutorConvenioFirmado) || $this->fechaEntregaPlaneadaAutorConvenioFirmado == NULL || $this->fechaEntregaPlaneadaAutorConvenioFirmado == ""){
            $this->fechaEntregaPlaneadaAutorConvenioFirmado = "0000-00-00";
        }
        if (!isset($this->fechaEntregaRealAutorConvenioFirmado) || $this->fechaEntregaRealAutorConvenioFirmado == NULL || $this->fechaEntregaRealAutorConvenioFirmado == ""){
            $this->fechaEntregaRealAutorConvenioFirmado = "0000-00-00";
        }
        if (!isset($this->fechaEnvioJuridicoConvenio) || $this->fechaEnvioJuridicoConvenio == NULL || $this->fechaEnvioJuridicoConvenio == ""){
            $this->fechaEnvioJuridicoConvenio = "0000-00-00";
        }
        if (!isset($this->fechaEntregaJuridicoConvenio) || $this->fechaEntregaJuridicoConvenio == NULL || $this->fechaEntregaJuridicoConvenio == ""){
            $this->fechaEntregaJuridicoConvenio = "0000-00-00";
        }
        if (!isset($this->fechaEnvioObservacionesVoboAutor) || $this->fechaEnvioObservacionesVoboAutor == NULL || $this->fechaEnvioObservacionesVoboAutor == ""){
            $this->fechaEnvioObservacionesVoboAutor = "0000-00-00";
        }
        if (!isset($this->fechaEntregaPlaneadaObservacionesVoboAutor) || $this->fechaEntregaPlaneadaObservacionesVoboAutor == NULL || $this->fechaEntregaPlaneadaObservacionesVoboAutor == ""){
            $this->fechaEntregaPlaneadaObservacionesVoboAutor = "0000-00-00";
        }
        if (!isset($this->fechaEntregaRealObservacionesVoboAutor) || $this->fechaEntregaRealObservacionesVoboAutor == NULL || $this->fechaEntregaRealObservacionesVoboAutor == ""){
            $this->fechaEntregaRealObservacionesVoboAutor = "0000-00-00";
        }
        if (!isset($this->fechaEnvioTextoTraducido) || $this->fechaEnvioTextoTraducido == NULL || $this->fechaEnvioTextoTraducido == ""){
            $this->fechaEnvioTextoTraducido = "0000-00-00";
        }
        if (!isset($this->fechaEntregaPlaneadaTextoTraducido) || $this->fechaEntregaPlaneadaTextoTraducido == NULL || $this->fechaEntregaPlaneadaTextoTraducido == ""){
            $this->fechaEntregaPlaneadaTextoTraducido = "0000-00-00";
        }
        if (!isset($this->fechaEntregaRealTextoTraducido) || $this->fechaEntregaRealTextoTraducido == NULL || $this->fechaEntregaRealTextoTraducido == ""){
            $this->fechaEntregaRealTextoTraducido = "0000-00-00";
        }
        if (!isset($this->fechaEnvioCotejoTraduccion) || $this->fechaEnvioCotejoTraduccion == NULL || $this->fechaEnvioCotejoTraduccion == ""){
            $this->fechaEnvioCotejoTraduccion = "0000-00-00";
        }
        if (!isset($this->fechaEntregaPlaneadaCotejoTraduccion) || $this->fechaEntregaPlaneadaCotejoTraduccion == NULL || $this->fechaEntregaPlaneadaCotejoTraduccion == ""){
            $this->fechaEntregaPlaneadaCotejoTraduccion = "0000-00-00";
        }
        if (!isset($this->fechaEntregaRealCotejoTraduccion) || $this->fechaEntregaRealCotejoTraduccion == NULL || $this->fechaEntregaRealCotejoTraduccion == ""){
            $this->fechaEntregaRealCotejoTraduccion = "0000-00-00";
        }
        if (!isset($this->fechaEnvioVoboFinal) || $this->fechaEnvioVoboFinal == NULL || $this->fechaEnvioVoboFinal == ""){
            $this->fechaEnvioVoboFinal = "0000-00-00";
        }
        if (!isset($this->fechaEntregaPlaneadaVoboFina) || $this->fechaEntregaPlaneadaVoboFina == NULL || $this->fechaEntregaPlaneadaVoboFina == ""){
            $this->fechaEntregaPlaneadaVoboFina = "0000-00-00";
        }
        if (!isset($this->fechaEntregaRealVoboFinal) || $this->fechaEntregaRealVoboFinal == NULL || $this->fechaEntregaRealVoboFinal == ""){
            $this->fechaEntregaRealVoboFinal = "0000-00-00";
        }
        if (!isset($this->fechaEnvioElabPropVobo) || $this->fechaEnvioElabPropVobo == NULL || $this->fechaEnvioElabPropVobo == ""){
            $this->fechaEnvioElabPropVobo = "0000-00-00";
        }
        if (!isset($this->fechaEntregaPlaneadaElabPropVobo) || $this->fechaEntregaPlaneadaElabPropVobo == NULL || $this->fechaEntregaPlaneadaElabPropVobo == ""){
            $this->fechaEntregaPlaneadaElabPropVobo = "0000-00-00";
        }
        if (!isset($this->fechaEntregaRealElabPropVobo) || $this->fechaEntregaRealElabPropVobo == NULL || $this->fechaEntregaRealElabPropVobo == ""){
            $this->fechaEntregaRealElabPropVobo = "0000-00-00";
        }
        if (!isset($this->fechaEntregaRealElabPropVobo) || $this->fechaEntregaRealElabPropVobo == NULL || $this->fechaEntregaRealElabPropVobo == ""){
            $this->fechaEntregaRealElabPropVobo = "0000-00-00";
        }
        if (!isset($this->fechaEntregaVoboDireccion) || $this->fechaEntregaVoboDireccion == NULL || $this->fechaEntregaVoboDireccion == ""){
            $this->fechaEntregaVoboDireccion = "0000-00-00";
        }
        if (!isset($this->fechaEnvioVoboDireccion) || $this->fechaEnvioVoboDireccion == NULL || $this->fechaEnvioVoboDireccion == ""){
            $this->fechaEnvioVoboDireccion = "0000-00-00";
        }
        if (!isset($this->fechaEnvioTextoCorregido) || $this->fechaEnvioTextoCorregido == NULL || $this->fechaEnvioTextoCorregido == ""){
            $this->fechaEnvioTextoCorregido = "0000-00-00";
        }
        if (!isset($this->fechaEntregaTextoCorregido) || $this->fechaEntregaTextoCorregido == NULL || $this->fechaEntregaTextoCorregido == ""){
            $this->fechaEntregaTextoCorregido = "0000-00-00";
        }
        if (!isset($this->fechaEntregaRealTextoCorregido ) || $this->fechaEntregaRealTextoCorregido == NULL || $this->fechaEntregaRealTextoCorregido == ""){
            $this->fechaEntregaRealTextoCorregido = "0000-00-00";
        }
        
        if (!isset($this->rutaEntregableCartaSolicitud) || $this->rutaEntregableCartaSolicitud == NULL || $this->rutaEntregableCartaSolicitud == ""){
            //$this->Imagen = "NULL";
            $rutaCartaSol = "";
        }else{
        	$rutaCartaSol =  ",rutaEntregableCartaSolicitud = "."'".$this->rutaEntregableCartaSolicitud."'";
        }
        if (!isset($this->rutaEntregableTextoPreliminarSolicitar) || $this->rutaEntregableTextoPreliminarSolicitar == NULL || $this->rutaEntregableTextoPreliminarSolicitar == ""){
            //$this->Imagen = "NULL";
            $rutaTextoPre = "";
        }else{
        	$rutaTextoPre =  ",rutaEntregableTextoPreliminarSolicitar = "."'".$this->rutaEntregableTextoPreliminarSolicitar."'";
        }
        if (!isset($this->rutaEntregableResumenSolicitar) || $this->rutaEntregableResumenSolicitar == NULL || $this->rutaEntregableResumenSolicitar == ""){
            //$this->Imagen = "NULL";
            $rutaResumenSol = "";
        }else{
        	$rutaResumenSol =  ",rutaEntregableResumenSolicitar = "."'".$this->rutaEntregableResumenSolicitar."'";
        }
        if (!isset($this->rutaEntregableConvenioFirmado) || $this->rutaEntregableConvenioFirmado == NULL || $this->rutaEntregableConvenioFirmado == ""){
            //$this->Imagen = "NULL";
            $rutaConvenioFirmado = "";
        }else{
        	$rutaConvenioFirmado =  ",rutaEntregableConvenioFirmado = "."'".$this->rutaEntregableConvenioFirmado."'";
        }
        if (!isset($this->rutaEntregableBasesConvenio) || $this->rutaEntregableBasesConvenio == NULL || $this->rutaEntregableBasesConvenio == ""){
            //$this->Imagen = "NULL";
            $rutaBasesConvenio = "";
        }else{
        	$rutaBasesConvenio =  ",rutaEntregableBasesConvenio = "."'".$this->rutaEntregableBasesConvenio."'";
        }
        if (!isset($this->rutaEntregableTextoEditado) || $this->rutaEntregableTextoEditado == NULL || $this->rutaEntregableTextoEditado == ""){
            //$this->Imagen = "NULL";
            $rutaTextoEditado = "";
        }else{
        	$rutaTextoEditado =  ",rutaEntregableTextoEditado = "."'".$this->rutaEntregableTextoEditado."'";
        }
        if (!isset($this->rutaEntregableComentariosEditor) || $this->rutaEntregableComentariosEditor == NULL || $this->rutaEntregableComentariosEditor == ""){
            //$this->Imagen = "NULL";
            $rutaComentEditor = "";
        }else{
        	$rutaComentEditor =  ",rutaEntregableComentariosEditor = "."'".$this->rutaEntregableComentariosEditor."'";
        }
        if (!isset($this->rutaEntregableObservacionesVoboAutor) || $this->rutaEntregableObservacionesVoboAutor == NULL || $this->rutaEntregableObservacionesVoboAutor == ""){
            //$this->Imagen = "NULL";
            $rutaObsVoboAutor = "";
        }else{
        	$rutaObsVoboAutor =  ",rutaEntregableObservacionesVoboAutor = "."'".$this->rutaEntregableObservacionesVoboAutor."'";
        }
        if (!isset($this->rutaEntregableTextoTraducido) || $this->rutaEntregableTextoTraducido == NULL || $this->rutaEntregableTextoTraducido == ""){
            //$this->Imagen = "NULL";
            $rutaTextoTraducido = "";
        }else{
        	$rutaTextoTraducido =  ",rutaEntregableTextoTraducido = "."'".$this->rutaEntregableTextoTraducido."'";
        }
        if (!isset($this->rutaEntregableCotejoTraduccion) || $this->rutaEntregableCotejoTraduccion == NULL || $this->rutaEntregableCotejoTraduccion == ""){
            //$this->Imagen = "NULL";
            $rutaCotejoTraduccion = "";
        }else{
        	$rutaCotejoTraduccion =  ",rutaEntregableCotejoTraduccion = "."'".$this->rutaEntregableCotejoTraduccion."'";
        }

        if (!isset($this->rutaEntregableTextoCorregido) || $this->rutaEntregableTextoCorregido == NULL || $this->rutaEntregableTextoCorregido == ""){
            //$this->Imagen = "NULL";
            $rutaTextoCorregido = "";
        }else{
        	$rutaTextoCorregido =  ",rutaEntregableTextoCorregido = "."'".$this->rutaEntregableTextoCorregido."'";
        }
        if (!isset($this->rutaEntregableVoboFinal) || $this->rutaEntregableVoboFinal == NULL || $this->rutaEntregableVoboFinal == ""){
            //$this->Imagen = "NULL";
            $rutaVoboFinal = "";
        }else{
        	$rutaVoboFinal =  ",rutaEntregableVoboFinal = "."'".$this->rutaEntregableVoboFinal."'";
        }
        if (!isset($this->rutaEntregableResumenVoboFinal) || $this->rutaEntregableResumenVoboFinal == NULL || $this->rutaEntregableResumenVoboFinal == ""){
            //$this->Imagen = "NULL";
            $rutaResumenVoboFinal = "";
        }else{
        	$rutaResumenVoboFinal =  ",rutaEntregableResumenVoboFinal = "."'".$this->rutaEntregableResumenVoboFinal."'";
        }

        if (!isset($this->rutaEntregableEspFichaInformativa) || $this->rutaEntregableEspFichaInformativa == NULL || $this->rutaEntregableEspFichaInformativa == ""){
            //$this->Imagen = "NULL";
            $rutaFichaInformativa = "";
        }else{
        	$rutaFichaInformativa =  ",rutaEntregableEspFichaInformativa = "."'".$this->rutaEntregableEspFichaInformativa."'";
        }
        if (!isset($this->rutaEntregableElabPropuestaVobo) || $this->rutaEntregableElabPropuestaVobo == NULL || $this->rutaEntregableElabPropuestaVobo == ""){
            //$this->Imagen = "NULL";
            $rutaPropVobo = "";
        }else{
        	$rutaPropVobo =  ",rutaEntregableElabPropuestaVobo = "."'".$this->rutaEntregableElabPropuestaVobo."'";
        }

        if (!isset($this->rutaSolVoboDireccion) || $this->rutaSolVoboDireccion == NULL || $this->rutaSolVoboDireccion == ""){
            //$this->Imagen = "NULL";
            $rutaVoboDireccion = "";
        }else{
        	$rutaVoboDireccion =  ",rutaSolVoboDireccion = "."'".$this->rutaSolVoboDireccion."'";
        }

        if (!isset($this->checkCartaSolicitud) || $this->checkCartaSolicitud == NULL || $this->checkCartaSolicitud == ""){
            $this->checkCartaSolicitud = "NULL";
        }
        if (!isset($this->checkConvenioFirmado) || $this->checkConvenioFirmado == NULL || $this->checkConvenioFirmado == ""){
            $this->checkConvenioFirmado = "NULL";
        }
        if (!isset($this->checkBasesConvenio) || $this->checkBasesConvenio == NULL || $this->checkBasesConvenio == ""){
            $this->checkBasesConvenio = "NULL";
        }
        if (!isset($this->checkComentariosEditor) || $this->checkComentariosEditor == NULL || $this->checkComentariosEditor == ""){
            $this->checkComentariosEditor = "NULL";
        }
        if (!isset($this->checkVoboFinalAutor) || $this->checkVoboFinalAutor == NULL || $this->checkVoboFinalAutor == ""){
            $this->checkVoboFinalAutor = "NULL";
        }
        if (!isset($this->checkEnviarPropVoboDir) || $this->checkEnviarPropVoboDir == NULL || $this->checkEnviarPropVoboDir == ""){
            $this->checkEnviarPropVoboDir = "NULL";
        }
        if (!isset($this->checkRecibirTextoAutorizadoVoboDir) || $this->checkRecibirTextoAutorizadoVoboDir == NULL || $this->checkRecibirTextoAutorizadoVoboDir == ""){
            $this->checkRecibirTextoAutorizadoVoboDir = "NULL";
        }

        if (!isset($this->checkEnvInfoProy) || $this->checkEnvInfoProy == NULL || $this->checkEnvInfoProy == ""){
            $this->checkEnvInfoProy = "NULL";
        }
        if (!isset($this->checkRecibirProp) || $this->checkRecibirProp == NULL || $this->checkRecibirProp == ""){
            $this->checkRecibirProp = "NULL";
        }


        $insert ="UPDATE c_textosLibro SET IdLibro = ".$this->IdLibro."
,IdAutor = ".$this->IdAutor.",IdInstitucion = ".$this->IdInstitucion.",Inedito = ".$this->Inedito.",IdEntregableTextoFinal =".$this->IdEntregableTextoFinal.",tituloTexto = '".$this->tituloTexto."',numCuartillas = ".$this->numCuartillas.",IdTipoTexto = ".$this->IdTipoTexto."".$rutaCartaSol.",fechaEnvioCartaSolicitud = '".$this->fechaEnvioCartaSolicitud."'
,fechaAceptacionCartaSolicitud = '".$this->fechaAceptacionCartaSolicitud."'
,checkCartaSolicitud = ".$this->checkCartaSolicitud."".$rutaTextoPre.",fechaEntregaPlaneadaTextoPreliminar = '".$this->fechaEntregaPlaneadaTextoPreliminar."'
,fechaEntregaRealTextoPreliminar = '".$this->fechaEntregaRealTextoPreliminar."'".$rutaResumenSol."
,sinopsisSolicitar = '".$this->sinopsisSolicitar."'".$rutaConvenioFirmado."
,checkConvenioFirmado=".$this->checkConvenioFirmado.",fechaEnvioAutorConvenioFirmado = '".$this->fechaEnvioAutorConvenioFirmado."'
,fechaEntregaPlaneadaAutorConvenioFirmado = '".$this->fechaEntregaPlaneadaAutorConvenioFirmado."'
,fechaEntregaRealAutorConvenioFirmado = '".$this->fechaEntregaRealAutorConvenioFirmado."'".$rutaBasesConvenio.",checkBasesConvenio =". $this->checkBasesConvenio." 
,fechaEnvioJuridicoConvenio = '".$this->fechaEnvioJuridicoConvenio."'
,fechaEntregaJuridicoConvenio = '".$this->fechaEntregaJuridicoConvenio."'".$rutaTextoEditado."
".$rutaComentEditor.",checkComentariosEditor = ".$this->checkComentariosEditor." ".$rutaObsVoboAutor."
,fechaEnvioObservacionesVoboAutor = '".$this->fechaEnvioObservacionesVoboAutor."'
,fechaEntregaPlaneadaObservacionesVoboAutor = '".$this->fechaEntregaPlaneadaObservacionesVoboAutor."'
,fechaEntregaRealObservacionesVoboAutor = '".$this->fechaEntregaRealObservacionesVoboAutor."'".$rutaTextoTraducido.",IdTraductorTextoTraducido = ".$this->IdTraductorTextoTraducido."
,IdiomaOriginal = ".$this->IdiomaOriginal.",IdiomaATraducir = ".$this->IdiomaATraducir."
,fechaEnvioTextoTraducido = '".$this->fechaEnvioTextoTraducido."'
,fechaEntregaPlaneadaTextoTraducido = '".$this->fechaEntregaPlaneadaTextoTraducido."'
,fechaEntregaRealTextoTraducido = '".$this->fechaEntregaRealTextoTraducido."'".$rutaCotejoTraduccion.",IdTraductorCotejoTraduccion = ".$this->IdTraductorCotejoTraduccion."
,fechaEnvioCotejoTraduccion = '".$this->fechaEnvioCotejoTraduccion."'
,fechaEntregaPlaneadaCotejoTraduccion = '".$this->fechaEntregaPlaneadaCotejoTraduccion."'
,fechaEntregaRealCotejoTraduccion = '".$this->fechaEntregaRealCotejoTraduccion."'".$rutaTextoCorregido.",IdCorrectorEstiloTextoCorregido = ".$this->IdCorrectorEstiloTextoCorregido.",fechaEnvioTextoCorregido = '".$this->fechaEnvioTextoCorregido."'
,fechaEntregaTextoCorregido = '".$this->fechaEntregaTextoCorregido."',fechaEntregaRealTextoCorregido = '0000-00-00'".$rutaVoboFinal.",checkVoboFinalAutor=".$this->checkVoboFinalAutor.",fechaEnvioVoboFinal = '".$this->fechaEnvioVoboFinal."',fechaEntregaPlaneadaVoboFina = '".$this->fechaEntregaPlaneadaVoboFina."',fechaEntregaRealVoboFinal = '".$this->fechaEntregaRealVoboFinal."'".$rutaResumenVoboFinal.",sinopsisVoboFinal = '".$this->sinopsisVoboFinal."'".$rutaFichaInformativa."".$rutaPropVobo.",fechaEnvioElabPropVobo = '".$this->fechaEnvioElabPropVobo."'
,fechaEntregaPlaneadaElabPropVobo = '".$this->fechaEntregaPlaneadaElabPropVobo."',fechaEntregaRealElabPropVobo = '".$this->fechaEntregaRealElabPropVobo."',checkEnvInfoProy = ".$this->checkEnvInfoProy.",checkRecibirProp = ".$this->checkRecibirProp."
,IdProveedorElabPropVobo = ".$this->IdProveedorElabPropVobo."".$rutaVoboDireccion.",fechaEnvioVoboDireccion = '".$this->fechaEnvioVoboDireccion."'
,fechaEntregaVoboDireccion = '".$this->fechaEntregaVoboDireccion."',checkEnviarPropVoboDir =".$this->checkEnviarPropVoboDir." ,checkRecibirTextoAutorizadoVoboDir =".$this->checkRecibirTextoAutorizadoVoboDir.",UsuarioUltimaModificacion = '".$this->UsuarioUltimaModificacion."',FechaUltimaModificacion = NOW(),Pantalla = '".$this->Pantalla."' WHERE IdTexto=".$this->IdTexto.";";
  		
		
		$catalogo = new Catalogo();

  		//echo "<br>".$insert."<br>";

  		$query = $catalogo->ejecutaConsultaActualizacion($insert,'', '');

        if ($query == 1) {
            return true;
        }
        return false;
	}
		
	
	public function setIdTexto($IdTexto){
        $this->IdTexto = $IdTexto;
   	}
   	public function getIdTexto(){
       return $this->IdTexto;
   	}
   	public function getIdLibro(){
       return $this->IdLibro;
   	}
	public function setIdAutor($IdAutor){
        $this->IdAutor = $IdAutor;
   	}
   	public function getIdAutor(){
       return $this->IdAutor;
   	}
	public function setInedito($Inedito){
        $this->Inedito = $Inedito;
   	}
   	public function getInedito(){
       return $this->Inedito;
   	}
	
   	public function setIdEntregableTextoFinal($IdEntregableTextoFinal){
        $this->IdEntregableTextoFinal = $IdEntregableTextoFinal;
   	}
   	public function getIdEntregableTextoFinal(){
       return $this->IdEntregableTextoFinal;
   	}

   	public function setTituloTexto($tituloTexto){
        $this->tituloTexto = $tituloTexto;
   	}
   	public function getTituloTexto(){
       return $this->tituloTexto;
   	}
	
	public function setNumCuartillas($numCuartillas){
        $this->numCuartillas = $numCuartillas;
   	}
   	public function getNumCuartillas(){
       return $this->numCuartillas;
   	}

   	public function setIdTipoTexto($IdTipoTexto){
        $this->IdTipoTexto = $IdTipoTexto;
   	}
   	public function getIdTipoTexto(){
       return $this->IdTipoTexto;
   	}
	
	public function setIdEntregableCartaSolicitud($IdEntregableCartaSolicitud){
        $this->IdEntregableCartaSolicitud = $IdEntregableCartaSolicitud;
   	}
   	public function getIdEntregableCartaSolicitud(){
       return $this->IdEntregableCartaSolicitud;
   	}
	public function setFechaEnvioCartaSolicitud($fechaEnvioCartaSolicitud){
        $this->fechaEnvioCartaSolicitud = $fechaEnvioCartaSolicitud;
   	}
   	public function getFechaEnvioCartaSolicitud(){
       return $this->fechaEnvioCartaSolicitud;
   	}
	public function setFechaAceptacionCartaSolicitud($fechaAceptacionCartaSolicitud){
        $this->fechaAceptacionCartaSolicitud = $fechaAceptacionCartaSolicitud;
   	}
   	public function getFechaAceptacionCartaSolicitud(){
       return $this->fechaAceptacionCartaSolicitud;
   	}
	
	public function setIdEntregableTextoPreliminarSolicitar($IdEntregableTextoPreliminarSolicitar){
        $this->IdEntregableTextoPreliminarSolicitar = $IdEntregableTextoPreliminarSolicitar;
   	}
   	public function getIdEntregableTextoPreliminarSolicitar(){
       return $this->IdEntregableTextoPreliminarSolicitar;
   	}
	
	public function setFechaEntregaPlaneadaTextoPreliminar($fechaEntregaPlaneadaTextoPreliminar){
        $this->fechaEntregaPlaneadaTextoPreliminar = $fechaEntregaPlaneadaTextoPreliminar;
   	}
   	public function getFechaEntregaPlaneadaTextoPreliminar(){
       return $this->fechaEntregaPlaneadaTextoPreliminar;
   	}
	
	public function setFechaEntregaRealTextoPreliminar($fechaEntregaRealTextoPreliminar){
        $this->fechaEntregaRealTextoPreliminar = $fechaEntregaRealTextoPreliminar;
   	}
   	public function getFechaEntregaRealTextoPreliminar(){
       return $this->fechaEntregaRealTextoPreliminar;
   	}

   	public function setIdEntregableResumenSolicitar($IdEntregableResumenSolicitar){
        $this->IdEntregableResumenSolicitar = $IdEntregableResumenSolicitar;
   	}
   	public function getIdEntregableResumenSolicitar(){
       return $this->IdEntregableResumenSolicitar;
   	}
	
	public function setSinopsisSolicitar($sinopsisSolicitar){
        $this->sinopsisSolicitar = $sinopsisSolicitar;
   	}
   	public function getSinopsisSolicitar(){
       return $this->sinopsisSolicitar;
   	}
	
	public function setIdEntregableConvenioFirmado($IdEntregableConvenioFirmado){
        $this->IdEntregableConvenioFirmado = $IdEntregableConvenioFirmado;
   	}
   	public function getIdEntregableConvenioFirmado(){
       return $this->IdEntregableConvenioFirmado;
   	}
	
	public function setFechaEnvioAutorConvenioFirmado($fechaEnvioAutorConvenioFirmado){
        $this->fechaEnvioAutorConvenioFirmado = $fechaEnvioAutorConvenioFirmado;
   	}
   	public function getFechaEnvioAutorConvenioFirmado(){
       return $this->fechaEnvioAutorConvenioFirmado;
   	}
	
	public function setFechaEntregaPlaneadaAutorConvenioFirmado($fechaEntregaPlaneadaAutorConvenioFirmado){
        $this->fechaEntregaPlaneadaAutorConvenioFirmado = $fechaEntregaPlaneadaAutorConvenioFirmado;
   	}
   	public function getFechaEntregaPlaneadaAutorConvenioFirmado(){
       return $this->fechaEntregaPlaneadaAutorConvenioFirmado;
   	}
	
	public function setfechaEntregaRealAutorConvenioFirmado($fechaEntregaRealAutorConvenioFirmado){
        $this->fechaEntregaRealAutorConvenioFirmado = $fechaEntregaRealAutorConvenioFirmado;
   	}
   	public function getfechaEntregaRealAutorConvenioFirmado(){
       return $this->fechaEntregaRealAutorConvenioFirmado;
   	}
	
	public function setIdEntregableBasesConvenio($IdEntregableBasesConvenio){
        $this->IdEntregableBasesConvenio = $IdEntregableBasesConvenio;
   	}
   	public function getIdEntregableBasesConvenio(){
       return $this->IdEntregableBasesConvenio;
   	}
	
	public function setFechaEnvioJuridicoConvenio($fechaEnvioJuridicoConvenio){
        $this->fechaEnvioJuridicoConvenio = $fechaEnvioJuridicoConvenio;
   	}
   	public function getFechaEnvioJuridicoConvenio(){
       return $this->fechaEnvioJuridicoConvenio;
   	}
   	public function setFechaEntregaJuridicoConvenio($fechaEntregaJuridicoConvenio){
        $this->fechaEntregaJuridicoConvenio = $fechaEntregaJuridicoConvenio;
   	}
   	public function getFechaEntregaJuridicoConvenio(){
       return $this->fechaEntregaJuridicoConvenio;
   	}
	
	public function setIdEntregableTextoEditado($IdEntregableTextoEditado){
        $this->IdEntregableTextoEditado = $IdEntregableTextoEditado;
   	}
   	public function getIdEntregableTextoEditado(){
       return $this->IdEntregableTextoEditado;
   	}
	
	public function setIdEntregableComentariosEditor($IdEntregableComentariosEditor){
        $this->IdEntregableComentariosEditor = $IdEntregableComentariosEditor;
   	}
   	public function getIdEntregableComentariosEditor(){
       return $this->IdEntregableComentariosEditor;
   	}
	
	public function setIdEntregableObservacionesVoboAutor($IdEntregableObservacionesVoboAutor){
        $this->IdEntregableObservacionesVoboAutor = $IdEntregableObservacionesVoboAutor;
   	}
   	public function getIdEntregableObservacionesVoboAutor(){
       return $this->IdEntregableObservacionesVoboAutor;
   	}
	
	public function setFechaEnvioObservacionesVoboAutor($fechaEnvioObservacionesVoboAutor){
        $this->fechaEnvioObservacionesVoboAutor = $fechaEnvioObservacionesVoboAutor;
   	}
   	public function getfechaEnvioObservacionesVoboAutor(){
       return $this->fechaEnvioObservacionesVoboAutor;
   	}

   	public function setFechaEntregaPlaneadaObservacionesVoboAutor($fechaEntregaPlaneadaObservacionesVoboAutor){
        $this->fechaEntregaPlaneadaObservacionesVoboAutor = $fechaEntregaPlaneadaObservacionesVoboAutor;
   	}
   	public function getFechaEntregaPlaneadaObservacionesVoboAutor(){
       return $this->fechaEntregaPlaneadaObservacionesVoboAutor;
   	}
	
	public function setFechaEntregaRealObservacionesVoboAutor($fechaEntregaRealObservacionesVoboAutor){
        $this->fechaEntregaRealObservacionesVoboAutor = $fechaEntregaRealObservacionesVoboAutor;
   	}
   	public function getFechaEntregaRealObservacionesVoboAutor(){
       return $this->fechaEntregaRealObservacionesVoboAutor;
   	}
	
	public function setIdEntregableTextoTraducido($IdEntregableTextoTraducido){
        $this->IdEntregableTextoTraducido = $IdEntregableTextoTraducido;
   	}
   	public function getIdEntregableTextoTraducido(){
       return $this->IdEntregableTextoTraducido;
   	}
	
	public function setIdTraductorTextoTraducido($IdTraductorTextoTraducido){
        $this->IdTraductorTextoTraducido = $IdTraductorTextoTraducido;
   	}
   	public function getIdTraductorTextoTraducido(){
       return $this->IdTraductorTextoTraducido;
   	}
	
	public function setIdiomaOriginal($IdiomaOriginal){
        $this->IdiomaOriginal = $IdiomaOriginal;
   	}
   	public function getIdiomaOriginal(){
       return $this->IdiomaOriginal;
   	}

   	public function setIdiomaATraducir($IdiomaATraducir){
        $this->IdiomaATraducir = $IdiomaATraducir;
   	}
   	public function getIdiomaATraducir(){
       return $this->IdiomaATraducir;
   	}
	
	public function setFechaEnvioTextoTraducido($fechaEnvioTextoTraducido){
        $this->fechaEnvioTextoTraducido = $fechaEnvioTextoTraducido;
   	}
   	public function getFechaEnvioTextoTraducido(){
       return $this->fechaEnvioTextoTraducido;
   	}
	
	public function setFechaEntregaPlaneadaTextoTraducido($fechaEntregaPlaneadaTextoTraducido){
        $this->fechaEntregaPlaneadaTextoTraducido = $fechaEntregaPlaneadaTextoTraducido;
   	}
   	public function getFechaEntregaPlaneadaTextoTraducido(){
       return $this->fechaEntregaPlaneadaTextoTraducido;
   	}

   	public function setfechaEntregaRealTextoTraducido($fechaEntregaRealTextoTraducido){
        $this->fechaEntregaRealTextoTraducido = $fechaEntregaRealTextoTraducido;
   	}
   	public function getfechaEntregaRealTextoTraducido(){
       return $this->fechaEntregaRealTextoTraducido;
   	}
	
	public function setIdEntregableCotejoTraduccion($IdEntregableCotejoTraduccion){
        $this->IdEntregableCotejoTraduccion = $IdEntregableCotejoTraduccion;
   	}
   	public function getIdEntregableCotejoTraduccion(){
       return $this->IdEntregableCotejoTraduccion;
   	}
	
	public function setIdTraductorCotejoTraduccion($IdTraductorCotejoTraduccion){
        $this->IdTraductorCotejoTraduccion = $IdTraductorCotejoTraduccion;
   	}
   	public function getIdTraductorCotejoTraduccion(){
       return $this->IdTraductorCotejoTraduccion;
   	}
	
	public function setFechaEnvioCotejoTraduccion($fechaEnvioCotejoTraduccion){
        $this->fechaEnvioCotejoTraduccion = $fechaEnvioCotejoTraduccion;
   	}
   	public function getFechaEnvioCotejoTraduccion(){
       return $this->fechaEnvioCotejoTraduccion;
   	}

   	public function setFechaEntregaPlaneadaCotejoTraduccion($fechaEntregaPlaneadaCotejoTraduccion){
        $this->fechaEntregaPlaneadaCotejoTraduccion = $fechaEntregaPlaneadaCotejoTraduccion;
   	}
   	public function getFechaEntregaPlaneadaCotejoTraduccion(){
       return $this->fechaEntregaPlaneadaCotejoTraduccion;
   	}
	
	public function setFechaEntregaRealCotejoTraduccion($fechaEntregaRealCotejoTraduccion){
        $this->fechaEntregaRealCotejoTraduccion = $fechaEntregaRealCotejoTraduccion;
   	}
   	public function getFechaEntregaRealCotejoTraduccion(){
       return $this->fechaEntregaRealCotejoTraduccion;
   	}

   	public function setIdEntregableTextoCorregido($IdEntregableTextoCorregido){
        $this->IdEntregableTextoCorregido = $IdEntregableTextoCorregido;
   	}
   	public function getIdEntregableTextoCorregido(){
       return $this->IdEntregableTextoCorregido;
   	}

   	public function setIdCorrectorEstiloTextoCorregido($IdCorrectorEstiloTextoCorregido){
        $this->IdCorrectorEstiloTextoCorregido = $IdCorrectorEstiloTextoCorregido;
   	}
   	public function getIdCorrectorEstiloTextoCorregido(){
       return $this->IdCorrectorEstiloTextoCorregido;
   	}
	
	public function setFechaEnvioTextoCorregido($fechaEnvioTextoCorregido){
        $this->fechaEnvioTextoCorregido = $fechaEnvioTextoCorregido;
   	}
   	public function getFechaEnvioTextoCorregido(){
       return $this->fechaEnvioTextoCorregido;
   	}
	
   	public function setFechaEntregaTextoCorregido($fechaEntregaTextoCorregido){
        $this->fechaEntregaTextoCorregido = $fechaEntregaTextoCorregido;
   	}
   	public function getFechaEntregaTextoCorregido(){
       return $this->fechaEntregaTextoCorregido;
   	}

   	public function setfechaEntregaRealTextoCorregido($fechaEntregaRealTextoCorregido){
        $this->fechaEntregaRealTextoCorregido = $fechaEntregaRealTextoCorregido;
   	}
   	public function getfechaEntregaRealTextoCorregido(){
       return $this->fechaEntregaRealTextoCorregido;
   	}
	
    public function setIdEntregableVoboFinal($IdEntregableVoboFinal){
        $this->IdEntregableVoboFinal = $IdEntregableVoboFinal;
   	}
   	public function getIdEntregableVoboFinal(){
       return $this->IdEntregableVoboFinal;
   	}

   	public function setFechaEnvioVoboFinal($fechaEnvioVoboFinal){
        $this->fechaEnvioVoboFinal = $fechaEnvioVoboFinal;
   	}
   	public function getFechaEnvioVoboFinal(){
       return $this->fechaEnvioVoboFinal;
   	}
	
	public function setFechaEntregaPlaneadaVoboFina($fechaEntregaPlaneadaVoboFina){
        $this->fechaEntregaPlaneadaVoboFina = $fechaEntregaPlaneadaVoboFina;
   	}
   	public function getFechaEntregaPlaneadaVoboFina(){
       return $this->fechaEntregaPlaneadaVoboFina;
   	}

   	public function setFechaEntregaRealVoboFinal($fechaEntregaRealVoboFinal){
        $this->fechaEntregaRealVoboFinal = $fechaEntregaRealVoboFinal;
   	}
   	public function getFechaEntregaRealVoboFinal(){
       return $this->fechaEntregaRealVoboFinal;
   	}
	
   	public function setIdEntregableResumenVoboFinal($IdEntregableResumenVoboFinal){
        $this->IdEntregableResumenVoboFinal = $IdEntregableResumenVoboFinal;
   	}
   	public function getIdEntregableResumenVoboFinal(){
       return $this->IdEntregableResumenVoboFinal;
   	}

	public function setSinopsisVoboFinal($sinopsisVoboFinal){
        $this->sinopsisVoboFinal = $sinopsisVoboFinal;
   	}
   	public function getSinopsisVoboFinal(){
       return $this->sinopsisVoboFinal;
   	}
	
	public function setIdEntregableEspFichaInformativa($IdEntregableEspFichaInformativa){
        $this->IdEntregableEspFichaInformativa = $IdEntregableEspFichaInformativa;
   	}
   	public function getIdEntregableEspFichaInformativa(){
       return $this->IdEntregableEspFichaInformativa;
   	}

	public function setIdEntregableElabPropuestaVobo($IdEntregableElabPropuestaVobo){
        $this->IdEntregableElabPropuestaVobo = $IdEntregableElabPropuestaVobo;
   	}
   	public function getIdEntregableElabPropuestaVobo(){
       return $this->IdEntregableElabPropuestaVobo;
   	}
   	public function setfechaEnvioElabPropVobo($fechaEnvioElabPropVobo){
        $this->fechaEnvioElabPropVobo = $fechaEnvioElabPropVobo;
   	}
   	public function getfechaEnvioElabPropVobo(){
       return $this->fechaEnvioElabPropVobo;
   	}
	
	public function setFechaEntregaPlaneadaElabPropVobo($fechaEntregaPlaneadaElabPropVobo){
        $this->fechaEntregaPlaneadaElabPropVobo = $fechaEntregaPlaneadaElabPropVobo;
   	}
   	public function getFechaEntregaPlaneadaElabPropVobo(){
       return $this->fechaEntregaPlaneadaElabPropVobo;
   	}
	
	public function setFechaEntregaRealElabPropVobo($fechaEntregaRealElabPropVobo){
        $this->fechaEntregaRealElabPropVobo = $fechaEntregaRealElabPropVobo;
   	}
   	public function getFechaEntregaRealElabPropVobo(){
       return $this->fechaEntregaRealElabPropVobo;
   	}
	
	public function setIdProveedorElabPropVobo($IdProveedorElabPropVobo){
        $this->IdProveedorElabPropVobo = $IdProveedorElabPropVobo;
   	}
   	public function getIdProveedorElabPropVobo(){
       return $this->IdProveedorElabPropVobo;
   	}

   	public function setIdSolVoboDireccion($IdSolVoboDireccion){
        $this->IdSolVoboDireccion = $IdSolVoboDireccion;
   	}
   	public function getIdSolVoboDireccion(){
       return $this->IdSolVoboDireccion;
   	}
	
	public function setfechaEnvioVoboDireccion($fechaEnvioVoboDireccion){
        $this->fechaEnvioVoboDireccion = $fechaEnvioVoboDireccion;
   	}
   	public function getfechaEnvioVoboDireccion(){
       return $this->fechaEnvioVoboDireccion;
   	}
	
	public function setfechaEntregaVoboDireccion($fechaEntregaVoboDireccion){
        $this->fechaEntregaVoboDireccion = $fechaEntregaVoboDireccion;
   	}
   	public function getfechaEntregaVoboDireccion(){
       return $this->fechaEntregaVoboDireccion;
   	}
	
	public function setUsuarioCreacion($UsuarioCreacion){
        $this->UsuarioCreacion = $UsuarioCreacion;
   	}
   	public function getUsuarioCreacion(){
       return $this->UsuarioCreacion;
   	}
    
    public function setUsuarioUltimaModificacion($UsuarioUltimaModificacion){
        $this->UsuarioUltimaModificacion = $UsuarioUltimaModificacion;
   	}
   	public function getUsuarioUltimaModificacion(){
       return $this->UsuarioUltimaModificacion;
   	}
	
	public function setPantalla($Pantalla){
        $this->Pantalla = $Pantalla;
   	}
   	public function getPantalla(){
       return $this->Pantalla;
   	}

   	public function setCheckCartaSolicitud($checkCartaSolicitud){
   		$this->checkCartaSolicitud = $checkCartaSolicitud;
   	}

   	public function getCheckCartaSolicitud(){
   		return $this->checkCartaSolicitud;
   	}
   	public function setCheckBasesConvenio($checkBasesConvenio){
   		$this->checkBasesConvenio = $checkBasesConvenio;
   	}

   	public function getCheckBasesConvenio(){
   		return $this->checkBasesConvenio;
   	}

   	public function setIdInstitucion($IdInstitucion){
   		$this->IdInstitucion = $IdInstitucion;
   	}

   	public function getIdInstitucion(){
   		return $this->IdInstitucion;
   	}

   	public function setCheckConvenioFirmado($checkConvenioFirmado){
   		$this->checkConvenioFirmado = $checkConvenioFirmado;
   	}

   	public function getCheckConvenioFirmado(){
   		return $this->checkConvenioFirmado;
   	}

   	public function setCheckComentariosEditor($checkComentariosEditor){
   		$this->checkComentariosEditor = $checkComentariosEditor;
   	}

   	public function getCheckComentariosEditor(){
   		return $this->checkComentariosEditor;
   	}
   	public function setcheckVoboFinalAutor($checkVoboFinalAutor){
   		$this->checkVoboFinalAutor = $checkVoboFinalAutor;
   	}

   	public function getcheckVoboFinalAutor(){
   		return $this->checkVoboFinalAutor;
   	}
   	public function setRutaEntregableComentariosEditor($rutaEntregableComentariosEditor){
   		$this->rutaEntregableComentariosEditor = $rutaEntregableComentariosEditor;
   	}

   	public function getRutaEntregableComentariosEditor(){
   		return $this->rutaEntregableComentariosEditor;
   	}

   	public function setRutaEntregableCartaSolicitud($rutaEntregableCartaSolicitud){
   		$this->rutaEntregableCartaSolicitud = $rutaEntregableCartaSolicitud;
   	}

   	public function getRutaEntregableCartaSolicitud(){
   		return $this->rutaEntregableCartaSolicitud;
   	}
   	public function setRutaEntregableResumenSolicitar($rutaEntregableResumenSolicitar){
   		$this->rutaEntregableResumenSolicitar = $rutaEntregableResumenSolicitar;
   	}

   	public function getRutaEntregableResumenSolicitar(){
   		return $this->rutaEntregableResumenSolicitar;
   	}
   	public function setRutaEntregableConvenioFirmado($rutaEntregableConvenioFirmado){
   		$this->rutaEntregableConvenioFirmado = $rutaEntregableConvenioFirmado;
   	}

   	public function getRutaEntregableConvenioFirmado(){
   		return $this->rutaEntregableConvenioFirmado;
   	}

   	public function setRutaEntregableBasesConvenio($rutaEntregableBasesConvenio){
   		$this->rutaEntregableBasesConvenio = $rutaEntregableBasesConvenio;
   	}

   	public function getRutaEntregableBasesConvenio(){
   		return $this->rutaEntregableBasesConvenio;
   	}
   	public function setRutaEntregableTextoEditado($rutaEntregableTextoEditado){
   		$this->rutaEntregableTextoEditado = $rutaEntregableTextoEditado;
   	}

   	public function getRutaEntregableTextoEditado(){
   		return $this->rutaEntregableTextoEditado;
   	}

   	public function setRutaEntregableObservacionesVoboAutor($rutaEntregableObservacionesVoboAutor){

   		$this->rutaEntregableObservacionesVoboAutor = $rutaEntregableObservacionesVoboAutor;
   	}

   	public function getRutaEntregableObservacionesVoboAutor(){
   		return $this->rutaEntregableObservacionesVoboAutor;
   	}

   	public function setRutaEntregableTextoTraducido($rutaEntregableTextoTraducido){

   		$this->rutaEntregableTextoTraducido = $rutaEntregableTextoTraducido;
   	}

   	public function getRutaEntregableTextoTraducido(){
   		return $this->rutaEntregableTextoTraducido;
   	}

   	public function setRutaEntregableCotejoTraduccion($rutaEntregableCotejoTraduccion){

   		$this->rutaEntregableCotejoTraduccion = $rutaEntregableCotejoTraduccion;
   	}

   	public function getRutaEntregableCotejoTraduccion(){
   		return $this->rutaEntregableCotejoTraduccion;
   	}
   	public function setRutaEntregableTextoCorregido($rutaEntregableTextoCorregido){

   		$this->rutaEntregableTextoCorregido = $rutaEntregableTextoCorregido;
   	}

   	public function getRutaEntregableTextoCorregido(){
   		return $this->rutaEntregableTextoCorregido;
   	}

   	public function setRutaEntregableVoboFinal($rutaEntregableVoboFinal){

   		$this->rutaEntregableVoboFinal = $rutaEntregableVoboFinal;
   	}

   	public function getRutaEntregableVoboFinal(){
   		return $this->rutaEntregableVoboFinal;
   	}

   	public function setRutaEntregableResumenVoboFinal($rutaEntregableResumenVoboFinal){

   		$this->rutaEntregableResumenVoboFinal = $rutaEntregableResumenVoboFinal;
   	}

   	public function getRutaEntregableResumenVoboFinal(){
   		return $this->rutaEntregableResumenVoboFinal;
   	}
   	public function setRutaEntregableTextoPreliminarSolicitar($rutaEntregableTextoPreliminarSolicitar){

   		$this->rutaEntregableTextoPreliminarSolicitar = $rutaEntregableTextoPreliminarSolicitar;
   	}

   	public function getRutaEntregableTextoPreliminarSolicitar(){
   		return $this->rutaEntregableTextoPreliminarSolicitar;
   	}

   	public function setRutaEntregableEspFichaInformativa($rutaEntregableEspFichaInformativa){

   		$this->rutaEntregableEspFichaInformativa = $rutaEntregableEspFichaInformativa;
   	}

   	public function getRutaEntregableEspFichaInformativa(){
   		return $this->rutaEntregableEspFichaInformativa;
   	}

   	public function setRutaEntregableElabPropuestaVobo($rutaEntregableElabPropuestaVobo){

   		$this->rutaEntregableElabPropuestaVobo = $rutaEntregableElabPropuestaVobo;
   	}

   	public function getRutaEntregableElabPropuestaVobo(){
   		return $this->rutaEntregableElabPropuestaVobo;
   	}

   	public function setRutaSolVoboDireccion($rutaSolVoboDireccion){

   		$this->rutaSolVoboDireccion = $rutaSolVoboDireccion;
   	}

   	public function getRutaSolVoboDireccion(){
   		return $this->rutaSolVoboDireccion;
   	}

   	public function setCheckEnviarPropVoboDir($checkEnviarPropVoboDir){

   		$this->checkEnviarPropVoboDir = $checkEnviarPropVoboDir;
   	}

   	public function getCheckEnviarPropVoboDir(){
   		return $this->checkEnviarPropVoboDir;
   	}

   	public function setCheckRecibirTextoAutorizadoVoboDir($checkRecibirTextoAutorizadoVoboDir){

   		$this->checkRecibirTextoAutorizadoVoboDir = $checkRecibirTextoAutorizadoVoboDir;
   	}

   	public function getCheckRecibirTextoAutorizadoVoboDir(){
   		return $this->checkRecibirTextoAutorizadoVoboDir;
   	}

   	public function setCheckEnvInfoProy($checkEnvInfoProy){

   		$this->checkEnvInfoProy = $checkEnvInfoProy;
   	}

   	public function getCheckEnvInfoProy(){
   		return $this->checkEnvInfoProy;
   	}

   	public function setCheckRecibirProp($checkRecibirProp){

   		$this->checkRecibirProp = $checkRecibirProp;
   	}

   	public function getCheckRecibirProp(){
   		return $this->checkRecibirProp;
   	}
}