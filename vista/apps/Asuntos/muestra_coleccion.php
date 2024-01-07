<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);


include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$IdLibro="";
$where = "";
$Id = "";
$pagina = "";
$user ="";
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
     $user = $_GET['nombreUsuario'];
   $compara="User_desconocido";
              
            if($user==$compara)
            {
                $user="1";
            }

}else{
    $user="1";

}

if (isset($_GET['IdLibro']) && $_GET['IdLibro'] !="") {
    $IdLibro = $_GET['IdLibro'];
    //$Id= $_GET['IdLibro'];
}
?>

<html lang="es">
 <title>::.PUBLICACIONES.::</title>
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    
	<title>::.Menu Ficha técnica Publicaciones.::</title>
    <style type="text/css">
	.container2{
      background-color: #f3f3f3;
      padding: 10px;
      border-radius: 10px;
      margin-left: 10px;
      width: 98.5%;
    }
    .title{
      font-size: 24px;
      font-weight:bold;
      color: #3c3c3c;
      margin-right:40px;
    }
    .title-row2{
      height: 44px;
      margin-left: -10px;
      margin-right: -10px;
    }

    figure.jsx-3352531170n {
        cursor: pointer;
        position: relative;
        padding: 0;
        margin: 0;
        display: -webkit-inline-box;
        display: -webkit-inline-flex;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-box-pack: center;
        -webkit-justify-content: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-align-items: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;

    }

    .icon.jsx-3352531170n {
        width: 18px;
        height: 18px;
        margin-top: 10px;
        margin-right:3px;
    }
    .general{
      margin-top:20px;
    }
    .subtitulo{
      color:#a9a9a9;
    }
    .cuerpo{
      font-size:12px;

    }
    .info{
      margin-left:5px;
    }
    .contenido-tab{
      text-align: justify;
      padding-top:10px;
      padding-bottom:20px;
      padding-left:10px;
      padding-right:10px;
      line-height:1.6;

    }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
      background-color: #f3f3f3;
      color: #4b0b09;
    }
    .taba{
      color:#a9a9a9;
      text-decoration: none;
      font-size: 11px;
    }
    .taba:hover {
      color:#a9a9a9;
      text-decoration: none;
    }
    .badge{
      font-size: 9px;
      height: 16px;
      width: 16px;
      margin-bottom:19px;
      margin-left:-7px;
      background-color:#3c3c3c;
    }
    .con-badge{
      color:#5d5d5d;
    }
    .sin-badge{
      color:#5d5d5d29;
      margin-left:4px;
    }
    .img-portada{
      width: 130px;
    }
	@media screen and (max-height: 220px) {
      .res{
      overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 6;
    -webkit-box-orient: vertical;
	height: 145px;
    }
}

    .nav>li>a{
      padding: 10px 9px;
    }
    .extra{
      width: 900px;

    }
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #cacaca;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }

    .dropdown-content a {
      padding: 3px 8px;
      text-decoration: none;
      display: block;
    }
    .sub{
      font-size: 11px;
    }

    .dropdown-content a:hover {background-color: #dedede;}

    .dropdown:hover .dropdown-content {display: block;}

    .dropdown:hover {cursor: pointer;}
    .prim{
      font-weight: 900;
      font-size: 12px;
      color: #333333;

    }
    .seg{
font-size:11px;
font-weight: 400;
color:#636363;
    }
    .prim2{
      font-weight: 900;
      font-size: 12px;
      color: #333333;
      padding-bottom: 10px;
    }

    body{
      font-family: 'Muli-Regular';
    }
       /*Div que contiene el filtro Seleccione un filtro*/
    .rtitulo{
          padding-left: 20px !important;
    }
     /*fin Div que contiene el filtro Seleccione un filtro*/
    .tit{
          font-size: 12px;
          font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    }
    .select-input {
            margin-right: 6px;
        }
    .select-input {
            position: relative;
            display: inline-block;
            margin-right: 10px;
    }
    .slibro{
          font-family: 'Muli', sans-serif;
          font-size: 12px;
          font-weight: 400;
          color: #BFBFC2;
          padding: 2px;
          border: none;
          outline: none;
          border: .5px double transparent;
          background-color: #efefef;
          height: 24px;

          -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin-top: 2px;
        text-overflow: '';
        text-indent: 0.01px;
        border-radius: 0px!important;
        max-width: 400px;
    }
    .flecha{
            color: #2D2D30;
            pointer-events: none;
            position: absolute;
            -webkit-transform: rotate(90deg);
            -ms-transform: rotate(90deg);
            transform: rotate(90deg);
            right: 8px;
            top: 35%;
            font-size: 9px;
    }

    .guardar{

          background-color: #4D4D57 !important;
          color:white !important;
          background: #ffffff;
          color: #4D4D57;
          border: none;
          border-radius: 4px;
          padding: 3px 8px;
          font-family: 'Muli', sans-serif;
          font-size: 12px;
          font-weight: 400;
          cursor: pointer !important;
        }



     /* Fin Estilos select con filtro */

     .lvl1{
       border-radius: 5px 5px 0px 0px;
       background-color: red;
     }
     .lvl2{
       border-radius: 5px 5px 0px 0px;
       background-color: #cccccc;
     }
     .lvl3{
       border-radius: 5px 5px 0px 0px;
       background-color: #efefef;
     }

     .mov {
       max-width: 100px;
       overflow: hidden;
     }

     .mov .mova{

       white-space: nowrap;
       transform: translateX(0);
       transition: 5s;

     }
     .mov:hover .mova{
       transform: translateX(calc(-210px));
       transition: 8s;
     }

     .mov .mova2{

       white-space: nowrap;
       transform: translateX(0);
       transition: 5s;

     }
     .mov:hover .mova2{
       transform: translateX(calc(-70px));
       transition: 8s;
     }
     .wSub {
       display: none !important;
     }
     .wSubSub {
       display: none !important;
     }
    </style>
    <script>
    $(document).ready(function() {
    $('[data-toggle=tooltip]').tooltip();
    });
    </script>  
</head>
<body>
<div class="container-fluid">
            <div class="row">
                <div id="ContenidosParticular">
                    <div class="col-md-12 col-sm-12 col-xs-12 container">
                          <section class="card-group">


<?php

                            $con=-1;
                            if (isset($_GET['IdLibro']) && $_GET['IdLibro'] !="") {
                                //$IdLibro = "&IdLibro=".$_GET['IdLibro'];
                                $where = "WHERE IdLibro = ".$_GET['IdLibro'];
                            }
							$SELECT="select id_autor from c_libro ".$where;
                            $SELECTACT="select IdActividad from c_libro ".$where;
							$consulta_enlaceExterno="select * from c_enlaceLibro ".$where;
							$consulta_Activ="select A.Nombre as NombreActividad,Ar.Nombre as NombreArea,Ej.Nombre as NombreEje from c_actividad A
							INNER JOIN c_area Ar ON A.IdArea=Ar.Id_Area 
							INNER JOIN c_eje Ej ON A.IdEje=Ej.idEje where A.IdActividad IN (".$SELECTACT.")" ;	
							$consulta_libros="SELECT l.IdLibro,l.Titulo,l.Imagen,l.PDF,l.Resena,l.ISBN,1.Telefono,l.AnioPublicacion FROM c_libro as l ".$where." ORDER BY l.Titulo";
						    $consulta_libroTecnico="select * FROM c_caracTecnicasLibro ct INNER JOIN c_tipoPortada tp ON ct.IdTipoPortada=tp.IdTipoPortada ".$where;
							$consulta_3pagTextos="
							select tl.IdTexto,tl.IdLibro,tl.IdAutor,tl.IdInstitucion,tl.tituloTexto,tl.IdTipoTexto,tl.numCuartillas,oi.Id_Indice from c_textosLibro as tl 
							INNER JOIN c_ordenIndice as oi ON oi.Id_Texto=tl.IdTexto
							where oi.Id_Libro=".$_GET['IdLibro']." AND tl.IdLibro=".$_GET['IdLibro']."  and oi.Id_Libro=52 order by oi.Id_Indice";
							$SELECT="select IdAutor from c_textosLibro ".$where;
                            $consulta_catalogos="
							select DISTINCT t1.id_Personas,t1.Nombre,t1.Apellido_Paterno,t1.Apellido_Materno,t1.ResenaCurricular FROM c_personas t1 
							INNER JOIN c_textosLibro t2 ON t1.id_Personas=t2.IdAutor 
							where t1.id_Personas IN (".$SELECT.") and t2.IdLibro =".$_GET['IdLibro'];
							$consulta_catalogosIndice="select t1.id_Personas,t1.Nombre,t1.Apellido_Paterno,t1.Apellido_Materno,t1.ResenaCurricular, oi.Id_Indice 
							FROM c_personas t1 
							INNER JOIN c_textosLibro t2 ON t1.id_Personas=t2.IdAutor
							INNER JOIN c_ordenIndice as oi ON oi.Id_Texto=t2.IdTexto
							where t1.id_Personas IN (".$SELECT.") and t2.IdLibro =".$_GET['IdLibro']."  and oi.Id_Libro=52 order by oi.Id_Indice";

								$consulta_catalogos2="
							select DISTINCT t1.id_Personas,t1.Nombre,t1.Apellido_Paterno,t1.Apellido_Materno,t1.ResenaCurricular FROM c_personas t1 
							INNER JOIN c_textosLibro t2 ON t1.id_Personas=t2.IdAutor 
							where t1.id_Personas IN (".$SELECT.") and t2.IdLibro =".$_GET['IdLibro']." LIMIT 5";
							$consulta_autoresTexto="
							select concat(A.Nombre,' ', A.Apellido_Paterno) as NombreCompleto, A.ocupacion,A.dependencia,A.Correo,A.Telefono,
		                    concat(A.Dia_nacimiento, '/', A.Mes_nacimiento, '/', A.Anio_nacimiento) as FechaNacimiento,oi.Id_Indice,
		 						L.tituloTexto , L.IdTexto, tt.Nombre, P.Nombre as Pais
								from c_personas A
								INNER JOIN c_textosLibro L ON A.id_Personas = L.IdAutor 
								INNER JOIN c_tipotextos tt ON L.IdTipoTexto=tt.IdTipoTexto
									INNER JOIN c_pais P ON A.id_PaisNac=P.id_Pais
										INNER JOIN c_ordenIndice oi ON oi.Id_Texto=L.IdTexto
								WHERE A.id_Personas IN (SELECT id_Personas
								FROM c_personas 
								WHERE A.id_Personas IN(SELECT IdAutor  FROM c_textosLibro WHERE c_textosLibro.IdLibro=".$_GET['IdLibro'].")) and L.IdLibro=".$_GET['IdLibro']." order by oi.Id_Indice asc";
						    
							
							$consulta_imagenes="select * from c_gestionarImagenesLibro ".$where;
							 $consulta_disenoyformacion="select Form.rutaPropuestaGrafica, Form.FechaEntregaIndice, Form.rutaMaqueta, Form.Rutaindice ,
							dis.Descripcion as disenador, il.Descripcion as ilustrador
							from c_disenioFormacionLibro Form 
							INNER JOIN c_diseñador dis ON Form.IdDisenador=dis.IdDiseñador 
							INNER JOIN c_ilustrador il ON Form.IdIlustrador=il.IdIlustrador ".$where;
							$consulta_impresion="select k.prePrensa,k.RutaPruebasColor,k.FechaEntregaPruebasColor,k.RutaVboPieImprenta,
							k.FechaEntregaPieImprenta,k.FechaEntregaVboSTecnicaImpFinal,k.RutaVoboSTecnicaImpFinal,
						    c.Descripcion from c_impresion k
							INNER JOIN c_imprenta c ON k.IdImprenta=c.IdImprenta ".$where;
							
							$consulta_costosypresupuestos="select cyp.MontoPresupuesto,cyp.RutaExcelPresupuesto,cyp.FechaEntregaPresupuesto
							,cyp.PresupuestoOrigenes,cyp.PresupuestoEjercido,cyp.CostoTiraje
							,cyp.PorcentajeCoedicion,cyp.CostoProduccion, cyp.CostoProduccionUnitario,cyp.PVP,pv.Nombre
							,cyp.Reimpresion,cyp.Patrocinador
							 from c_costosypresupuestos cyp
							INNER JOIN c_puntosventa pv ON cyp.IdPuntosDeVenta=pv.IdPuntosVenta ".$where;
							$consulta_premios="select * from c_premio ".$where;
							$consulta_usuario="select * from c_usuario where IdUsuario=".$user;
							$consulta_presentacion="select p.fecha,p.invitacion_pdf,evidencia_pdf,p.catalogo_micrositio, s.nombre_sede, concat(mm.Nombre,' ',mm.Apellido_Paterno,' ',mm.Apellido_Materno) as ponente, concat(cc.Nombre,' ',cc.Apellido_Paterno,' ',cc.Apellido_Materno) as moderador
							from c_presentacion p INNER JOIN c_sedes s ON s.sed_id_sede=p.sed_id_sede 
							INNER JOIN c_personas mm on mm.id_Personas=p.ponente
							INNER JOIN c_personas cc on cc.id_Personas=p.moderador WHERE p.id_Libro = ".$_GET['IdLibro'];
					
					$resultConsultaPresentacion=$catalogo->obtenerLista($consulta_presentacion);
							 $resultConsultaLibro2 = $catalogo->obtenerLista($consulta_libros);
                             $resultConsulta = $catalogo->obtenerLista($consulta_catalogos);
							 $resultConsultaIndice = $catalogo->obtenerLista($consulta_catalogosIndice);
							 $resultConsultaTec=$catalogo->obtenerLista($consulta_libroTecnico);
							 $resultConsulta3pagTexto=$catalogo->obtenerLista($consulta_3pagTextos);
							 $resultConsulta3pagTextos=$catalogo->obtenerLista($consulta_3pagTextos);
							 $resultConsulta3pagTextoss=$catalogo->obtenerLista($consulta_3pagTextos);
							 $resultConsultaAutoresTexto=$catalogo->obtenerLista($consulta_autoresTexto);
							 $resultConsultaAutoresTextoN=$catalogo->obtenerLista($consulta_catalogos2); 
							 $resultConsultaImagenes=$catalogo->obtenerLista($consulta_imagenes);
						     $resultConsultaDisenador=$catalogo->obtenerLista($consulta_disenoyformacion);
							 $resultConsultaImpresion=$catalogo->obtenerLista($consulta_impresion);
							 $resultConsultaCostosyPresupuestos=$catalogo->obtenerLista($consulta_costosypresupuestos);
							 $resultConsultaPremios=$catalogo->obtenerLista($consulta_premios);
							 $resultConsultaUsuario=$catalogo->obtenerLista($consulta_usuario);
							 $resultConsultaActividad=$catalogo->obtenerLista($consulta_Activ);
							 $resultConsultaEnlaceExterno=$catalogo->obtenerLista($consulta_enlaceExterno);
							
							$linkMuestraIndiceCompletoPDF="";
							$medidaFinal="";
							$numPaginas="";
						    $anioEdicion="";
							$ISBNN="";
							$resenaCurricular="";					
								$TirajeTotal="";
								$Tirajeespañol="";
								$Tirajeingles="";
								$anioEdicion="";
								$ImagenesCatalograficas="";
							$ImagenesComplementarias="";
							$TotalImagenes="";
							$rutaComplementarias="";
							$rutaCatalograficas="";
							$rutaAmbas="";
							$FechaEntregaComplementarias="";
							$FechaEntrega="";
							$FechaEntregaAmbas="";
									$rutaPropuestaGrafica="";
									$FechaEntregaIndice="";
									$rutaMaqueta="";
									$RutaIndice="";
									$disenador="";
									$ilustrador="";
							$prePrensa="";
							$RutaPruebasColor="";
							$FechaEntregaPruebasColor="";
							$RutaVboPieImprenta="";
							$FechaEntregaPieImprenta="";
							$FechaEntregaVboSTecnicaImpFinal="";
							$RutaVoboSTecnicaImpFinal="";
							$Descripcion="";
									 $MontoPresupuesto="";
									 $RutaExcelPresupuesto="";
									 $FechaEntregaPresupuesto="";
									 $PresupuestoOrigenes="";
									 $PresupuestoEjercido="";
									 $CostoTiraje="";
									 $PorcentajeCoedicion="";
									 $CostoProduccion="";
									 $CostoProduccionUnitario="";
									 $PVP="";
									 $NombrePV="";
									 $Reimpresion="";
									 $Patrocinador="";
												$Nombre="";
												$Apellido_Paterno="";
												$Apellido_Materno="";
												$Anio_nacimiento="";
												$Resena="";
							$NombrePremio="";
							$CategoriaPremio="";
							$FechaPremio="";
							$ConvocantePremio="";
							$Costo_premio="";
						$NombreActividad="";
							$NombreEje="";
							$NombreArea="";
							$Tirajebilingue="";
							$numero_filas="";	
								$fechaPresentacion="";
							$invitacion_pdf="";
							$evidencia_pdf="";
							$catalogo_micrositio="";
							$nombre_sede="";
							$ponente="";
							$moderador="";
							$ligaEnlaceExterno="";
							$descripcionEnlace="";
					while ($rowActividad = mysqli_fetch_array($resultConsultaActividad)  ) {
							$NombreActividad=$rowActividad['NombreActividad'];
							$NombreEje=$rowActividad['NombreEje'];
							$NombreArea=$rowActividad['NombreArea'];
							}
							
							
					while ($rowUsuario = mysqli_fetch_array($resultConsultaUsuario)  ) {
							$TipoUsuario=$rowUsuario['IdPerfil'];

							}		
						while ($rowImagenes = mysqli_fetch_array($resultConsultaImagenes)  ) {
							$ImagenesCatalograficas=$rowImagenes['ImagenesCatalograficas'];
							$ImagenesComplementarias=$rowImagenes['ImagenesComplementarias'];
							$TotalImagenes=$rowImagenes['TotalImagenes'];
							$rutaComplementarias=$rowImagenes['rutaComplementarias'];
							$rutaCatalograficas=$rowImagenes['rutaCatalograficas'];
							$rutaAmbas=$rowImagenes['rutaAmbas'];
							$FechaEntregaComplementarias=$rowImagenes['FechaEntregaComplementarias'];
							$FechaEntrega=$rowImagenes['FechaEntregaCatalograficas'];
							$FechaEntregaAmbas=$rowImagenes['FechaEntregaAmbas'];
							}
					while ($rowDiseno = mysqli_fetch_array($resultConsultaDisenador)  ) {
							        $rutaPropuestaGrafica=$rowDiseno['rutaPropuestaGrafica'];
									$FechaEntregaIndice=$rowDiseno['FechaEntregaIndice'];
									$rutaMaqueta=$rowDiseno['rutaMaqueta'];
									$RutaIndice=$rowDiseno['Rutaindice'];
									$disenador=$rowDiseno['disenador'];
									$ilustrador=$rowDiseno['ilustrador'];
							
							}
					while ($rowImpresion = mysqli_fetch_array($resultConsultaImpresion)  ) {
							$prePrensa=$rowImpresion['prePrensa'];
							$RutaPruebasColor=$rowImpresion['RutaPruebasColor'];
							$FechaEntregaPruebasColor=$rowImpresion['FechaEntregaPruebasColor'];
							$RutaVboPieImprenta=$rowImpresion['RutaVboPieImprenta'];
							$FechaEntregaPieImprenta=$rowImpresion['FechaEntregaPieImprenta'];
							$FechaEntregaVboSTecnicaImpFinal=$rowImpresion['FechaEntregaVboSTecnicaImpFinal'];
							$RutaVoboSTecnicaImpFinal=$rowImpresion['RutaVoboSTecnicaImpFinal'];
							$Descripcion=$rowImpresion['Descripcion'];
							
							}	
					while ($rowCostosyPresupuestos = mysqli_fetch_array($resultConsultaCostosyPresupuestos)  ) {
									 $MontoPresupuesto=$rowCostosyPresupuestos['MontoPresupuesto'];
									 $RutaExcelPresupuesto=$rowCostosyPresupuestos['RutaExcelPresupuesto'];
									 $FechaEntregaPresupuesto=$rowCostosyPresupuestos['FechaEntregaPresupuesto'];
									 $PresupuestoOrigenes=$rowCostosyPresupuestos['PresupuestoOrigenes'];
									 $PresupuestoEjercido=$rowCostosyPresupuestos['PresupuestoEjercido'];
									 $CostoTiraje=$rowCostosyPresupuestos['CostoTiraje'];
									 $PorcentajeCoedicion=$rowCostosyPresupuestos['PorcentajeCoedicion'];
									 $CostoProduccion=$rowCostosyPresupuestos['CostoProduccion'];
									 $CostoProduccionUnitario=$rowCostosyPresupuestos['CostoProduccionUnitario'];
									 $PVP=$rowCostosyPresupuestos['PVP'];
									 $NombrePV=$rowCostosyPresupuestos['Nombre'];
									 $Reimpresion=$rowCostosyPresupuestos['Reimpresion'];
									 $Patrocinador=$rowCostosyPresupuestos['Patrocinador'];
							
							}
					
                        while ($row4=mysqli_fetch_array($resultConsultaTec) ) {
								$TirajeTotal=$row4['TirajeTotal'];
								$Tirajeespañol=$row4['TirajeEspanol'];
								$Tirajeingles=$row4['TirajeIngles'];
								$Tirajebilingue=$row4['TirajeBilingue'];
								$anioEdicion=$row4['AnioEdicion'];
								$numPaginas=$row4['numPaginas'];
								$medidaFinal=$row4['medidaFinal'];
								$TipoTapa=$row4['Nombre'];
								}	
						
						while ($row3 = mysqli_fetch_array($resultConsultaLibro2)) {
						$IdLibro=$row3['IdLibro'];
						$Imagen3=$row3['Imagen'];
						$Titulo3=$row3['Titulo'];
						$AnioPublicacion=$row3['AnioPublicacion'];
						$Resena=$row3['Resena'];
						$ISBN=$row3['ISBN'];
						}		
						if($Imagen3==""){
							$Imagen3="defaultPortada.png";
						}
                    $linkMuestraIndiceCompletoPDF="../../../vista/apps/Publicaciones/pdfIndice/".$IdLibro."_Indice.pdf";
							$linkMuestraLibroCompleto="../../../resources/aplicaciones/PDF/Publicaciones/".$IdLibro."_libro.pdf" ;
							$linkMuestraImagenesComplementarias="../../../resources/aplicaciones/Entregables/Publicaciones/GestionarImagenes/".$rutaComplementarias;
$Año = date('Y');
$hoy = date("Y-m-d");
$id_entregable="";
		$consultaEntregable = "SELECT fl.IdEntregEspecifico as IdEntregEspecifico FROM c_formatoLibro as cfl
			INNER JOIN c_entregableEspecifico as fl ON  cfl.IdEntregableFormatoLibro=fl.IdEntregEspecifico ".$where;
			
			$resultConsultaEntreg=$catalogo->obtenerLista($consultaEntregable);
		   while ($rowEntregable= mysqli_fetch_array($resultConsultaEntreg)) {
						$id_entregable=$rowEntregable['IdEntregEspecifico'];
						}
			$onClick = "onclick=\"cambiarContenido('#Contenidos','alta_definirFormato.php?accion=editar&IdLibro=$IdLibro' );\"";
			 $onClick2 = "href=\"https://www.administro.mx/siekaluz/sie/vista/apps/Asuntos/index.php?ac=8&idEntregable=" . $id_entregable . "&idUsuario=" . $user . "&idAreaU=" . $NombreArea . "\"";
                   
?>
<div class="container container2" >
      <div class="row title-row2" >
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 col-10">
<a class="alineadoTextoImagenArriba" align="right" href="../../../vista/apps/Publicaciones/muestra_pdfColeccion.php?linkPDF=<?php echo $linkMuestraLibroCompleto;?>" target="_blank">		
          <label class="title"><?php echo $Titulo3;?></label>
		  </a>
          <figure class="jsx-3352531170n medium"><i class="far fa-address-book fa-lg sin-badge"></i><span class="jsx-3352531170n caption"></span></figure>
          <figure class="jsx-3352531170n medium"><i class="far fa-address-book fa-lg sin-badge"></i><span class="jsx-3352531170n caption"></span></figure>
          <figure class="jsx-3352531170n medium"><i class="far fa-address-book fa-lg sin-badge"></i><span class="jsx-3352531170n caption"></span></figure>
          <figure class="jsx-3352531170n medium"><i class="far fa-address-book fa-lg sin-badge"></i><span class="jsx-3352531170n caption"></span></figure>
          <figure class="jsx-3352531170n medium"><i class="far fa-address-book fa-lg sin-badge"></i><span class="jsx-3352531170n caption"></span></figure>
          <figure class="jsx-3352531170n medium"><i class="far fa-address-book fa-lg sin-badge"></i><span class="jsx-3352531170n caption"></span></figure>
          <figure class="jsx-3352531170n medium"><i class="far fa-address-book fa-lg sin-badge"></i><span class="jsx-3352531170n caption"></span></figure>
          <figure class="jsx-3352531170n medium"><i class="far fa-address-book fa-lg sin-badge"></i><span class="jsx-3352531170n caption"></span></figure>

        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-2" align="right">
          <figure class="jsx-3352531170n medium" ><a <?php echo $onClick2 ?>><img src="../../../resources/icon/envelope.svg" class="jsx-3352531170n icon default"><span class="jsx-3352531170n caption"></span></a></figure>
          <figure class="jsx-3352531170n medium" > <a  <?php echo $onClick;?>><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170n icon default"></a><span class="jsx-3352531170n caption"></span></figure>
          <figure class="jsx-3352531170n medium" ><i class="fas fa-times fa-lg" style="color:#ff000094;"></i><span class="jsx-3352531170n caption"></span></figure>
          
		</div>
		 <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 col-10" >
            <label class="cuerpo subtitulo">Autor</label><label class="cuerpo info"><?php
			 
			$numero_filas=mysqli_num_rows($resultConsultaAutoresTextoN);
			$cont=0;
			while ($rowAutoresTextos2 = mysqli_fetch_array($resultConsultaAutoresTextoN)  ) {
				$cont+=1; 
			
				if($cont==$numero_filas){
					
				
				echo  ' '.$rowAutoresTextos2['Nombre'].' '.$rowAutoresTextos2['Apellido_Paterno'].'.' ;
				}else {
				echo  ' '.$rowAutoresTextos2['Nombre'].' '.$rowAutoresTextos2['Apellido_Paterno'].',' ;
				}
				 }?></label>
           
	</div>
      </div>
	 <br> 
		
      <div class="row general">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-2" >
          <a class="alineadoTextoImagenArriba" align="right" href="../../../vista/apps/Publicaciones/muestra_pdfColeccion.php?linkPDF=<?php echo $linkMuestraIndiceCompletoPDF;?>" target="_blank">
		
		<img class="img-portada" src="../../../resources/aplicaciones/imagenes/Publicaciones/<?php echo $Imagen3;?>" alt="">
		  </a>
          <!-- comienza el indice -->
          
          <!-- termina el indice -->

        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 col-10" >
		
            
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3" >
            <label class="cuerpo subtitulo">Año</label> <label class="cuerpo info"><?php echo $AnioPublicacion;?></label>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 col-5" >
            <label class="cuerpo subtitulo">Actividad</label> <label class="cuerpo info"><?php echo $NombreActividad;?></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4" >
            <label class="cuerpo subtitulo">ISBN</label> <label class="cuerpo info"><?php echo $ISBN;?></label>
            </div>
       <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4" >
	
            <label class="cuerpo subtitulo">Eje</label> <label class="cuerpo info"><?php echo $NombreEje;?></label>
          </div>
			
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4" >
            <label class="cuerpo subtitulo">Área</label> <label class="cuerpo info"><?php echo $NombreArea;?></label>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12" style="margin-top:10px;">
            <label class="cuerpo subtitulo">Reseña</label> <label class="cuerpo info res"><?php echo $Resena;?></label>
            </div>
        </div>


      </div>


      <ul class="nav nav-tabs" style="margin-top:10px;">
    <li class="active"><a class="taba" data-toggle="tab" href="#res">Curricular</a></li>
    <li class="taba"><a class="taba" data-toggle="tab" href="#indice">Índice</a></li>
    <li class="taba"><a class="taba" data-toggle="tab" href="#textos">Textos</a></li>
    <li class="taba"><a class="taba" data-toggle="tab" href="#ficha">Ficha</a></li>
    <li class="taba"><a class="taba" data-toggle="tab" href="#imagenes">Imágenes</a></li>
    <li class="taba"><a class="taba" data-toggle="tab" href="#diseno">Diseño y Formación</a></li>
    <li class="taba"><a class="taba" data-toggle="tab" href="#impresion">Impresión</a></li>
    <li class="taba"><a class="taba" data-toggle="tab" href="#costos">Costos y Presupuestos</a></li>
    <li class="taba"><a class="taba" data-toggle="tab" href="#premios">Premios</a></li>
    <li class="taba"><a class="taba" data-toggle="tab" href="#presentacion">Presentación</a></li>
  </ul>

  <div class="tab-content" >
    <div id="res" class="tab-pane fade in active">
      <p class="contenido-tab">
      <?php
while ($row = mysqli_fetch_array($resultConsulta)) {
	
	echo '<label style="font-size:13px;font-weight:400;color:#2b2b2b;">'.$row['Nombre'].' '.$row['Apellido_Paterno'].' '.$row['Apellido_Materno'].'</label><br><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;'.$row['ResenaCurricular'].'</label><br>'
	;
							}


	  ?>
      </p>
    </div>
	
	<div id="indice" class="tab-pane fade in">
      <div class="" style="margin-top: 10px;">
	 <div style="float:left;width:33%; text-align:left;" class="papa">
				<?php
				
				
				while ($rowAutorTexto = mysqli_fetch_array($resultConsultaIndice)  ) {
					
							echo'<p><label class="prim2">'.$rowAutorTexto['Nombre'].' '.$rowAutorTexto['Apellido_Paterno'].' '.$rowAutorTexto['Apellido_Materno'].' &nbsp;<text class="seg"></text></label> 
											</p>	';													}
											
							  ?>
                </div>
        <div style="float:left;width:33%; text-align:left;" class="papa">
				<?php

				$Contador1=131;
				if($TipoUsuario==1){
					$IdTexto3Pag="";
					$TituloTexto3Pag="";
				while ($row3pagTextos = mysqli_fetch_array($resultConsulta3pagTextos)  ) {
					$IdTexto3Pag=$row3pagTextos['IdTexto'];
					$TituloTexto3Pag=$row3pagTextos['tituloTexto'];
					$Contador1+=1;
                       $linkMuestraPDFTextoIndices="../../../vista/apps/Publicaciones/pdfTextos/".$IdTexto3Pag."_texto.pdf";
							$linkMuestraPDFTexto3pagIndice="../../../vista/apps/Publicaciones/pdf3pag/".$IdTexto3Pag."_3pag.pdf";						
													
							echo'<p><a  class="sub2" href=../../../vista/apps/Publicaciones/muestra_pdfColeccion.php?linkPDF='.$linkMuestraPDFTextoIndices.' target="_blank"><label class="prim2">&nbsp;<text class="seg">'.$TituloTexto3Pag.'</text></label> </a>
											</p>	';													}}
							  ?>
                </div>

			
			<div style="float:right;width:33%; text-align:left;" class="papa">
						<?php
						$Contador=131;
				if($TipoUsuario==1){
				while ($row3pagTextoss = mysqli_fetch_array($resultConsulta3pagTextoss)  ) {
					   $Contador+=1;
										$linkMuestraPDFTexto3pagIndice="../../../vista/apps/Publicaciones/pdf3pag/".$row3pagTextoss['IdTexto']."_3pag.pdf";			
													
							echo'
								<p>			
								<a  class="sub2" href=../../../vista/apps/Publicaciones/muestra_pdfColeccion.php?linkPDF='.$linkMuestraPDFTexto3pagIndice.' target="_blank"><label class="prim2">&nbsp;<text class="seg">Ver 3 páginas del texto</text></label> </a>				
										</p>		';													
												
												}}else {
												while ($row3pagTextoss = mysqli_fetch_array($resultConsulta3pagTextoss)  ) {
					   $Contador+=1;
										$linkMuestraPDFTexto3pagIndice="../../../vista/apps/Publicaciones/pdf3pag/".$row3pagTextoss['IdTexto']."_3pag.pdf";			
													
							echo'
								<p>			
								<a  class="sub2" href=../../../vista/apps/Publicaciones/muestra_pdfColeccion.php?linkPDF='.$linkMuestraPDFTexto3pagIndice.' target="_blank"><label class="prim2">&nbsp;<text class="seg">Ver 3 páginas del texto</text></label> </a>				
										</p>		';													
												
												}}
							  ?>
            </div>
      </div>
    </div>
	<div id="textos" class="tab-pane fade in">
      <?php 
	 
	  while ($rowAutoresTextos = mysqli_fetch_array($resultConsultaAutoresTexto)  ) {
								 $linkMuestraTextoTituloPDF="../../../vista/apps/Publicaciones/pdfTextos/".$rowAutoresTextos['IdTexto']."_texto.pdf";
	echo '				<div class="row" style="margin-top:15px;margin-left: 5px !important;">
						<table class="tbl-ind">
						<thead class="tbl-header">
						<tr><th colspan="2" class="tbl-th">Tipo de Texto: '.$rowAutoresTextos['Nombre'].'</th>
						
						<th class="tbl-th">Título: <a style="color:white;" href=../../../vista/apps/Publicaciones/muestra_pdfColeccion.php?linkPDF='.$linkMuestraTextoTituloPDF.' target="_blank">'.$rowAutoresTextos['tituloTexto'].'</a></th>
						</tr></thead>
						<tbody>
						<tr>
						<td class="tbl-td">Autor: </td>
      <td class="tbl-td">
       ' . $rowAutoresTextos['NombreCompleto'] . '
      </td>
      <td class="tbl-td">
        Carta de solicitud de texto(PDF):
      </td>
    </tr>

    <tr>
      <td class="tbl-td">
        ¿Factura el autor?:
      </td>
      <td class="tbl-td">
        No
      </td>
      <td class="tbl-td">
        Comprobante de solicitud de texto(PDF):
      </td>
    </tr>

    <tr>
      <td class="tbl-td" colspan="2">
        Institución:
      </td>
      <td class="tbl-td">
        Documento de texto versión inicial:
      </td>
    </tr>

    <tr>
      <td class="tbl-td" colspan="2">
        Coordinador del autor:
      </td>
      <td class="tbl-td">
        Documento de texto versión final:
      </td>
    </tr>

    <tr>
      <td class="tbl-td" colspan="2">
        Nacionalidad del autor: ' . $rowAutoresTextos['Pais'] . '
      </td>
	  
      <td class="tbl-td">
        Texto corregido para validación del autor (PDF):
      </td>
    </tr>

    <tr>
      <td class="tbl-td" colspan="2">
        Nacionalidad de la institución:
      </td>
      <td class="tbl-td">
        Fecha entrega texto corregido para validación del autor:
      </td>
    </tr>

    <tr>
      <td class="tbl-td" colspan="2">
        Fecha Cumpleaños del autor:' . $rowAutoresTextos['FechaNacimiento'] . '
      </td>
	  
      <td class="tbl-td">
        Visto bueno de corrección de estilo del autor (PDF):
      </td>
    </tr>

    <tr>
      <td class="tbl-td" colspan="2">
        Teléfono:' . $rowAutoresTextos['Telefono'] . '
      </td>
      <td class="tbl-td">
        Fecha de entrega de visto bueno de corrección de estilo del autor:
      </td>
    </tr>

    <tr>
      <td class="tbl-td" colspan="2">
        Correo:' . $rowAutoresTextos['Correo'] . '
      </td>
      <td class="tbl-td">
        Documento de traducción para validación del autor:
      </td>
    </tr>

    <tr>
      <td class="tbl-td" colspan="2">
        Comentarios del autor:
      </td>
      <td class="tbl-td">
        Fecha entrega de traducción para validación del autor:
      </td>
    </tr>

    <tr>
      <td class="tbl-td" colspan="2">
          Fecha petición de texto:
      </td>
      <td class="tbl-td">
        Visto bueno de traducción del autor (PDF):
      </td>
    </tr>

    <tr>
      <td class="tbl-td" colspan="2">
          Fecha Convenida:
      </td>
      <td class="tbl-td">
        Documento de frases para redes sociales:
      </td>
    </tr>

    <tr>
      <td class="tbl-td" colspan="2">
          Fecha Entrega:
      </td>
      <td class="tbl-td">
        Fecha entrega de frases para redes sociales:
      </td>
    </tr>

    <tr>
      <td class="tbl-td" colspan="2">
          Traductor:
      </td>
      <td class="tbl-td">

      </td>
    </tr>

    <tr>
      <td class="tbl-td" colspan="2">
          Corrector de estilo:
      </td>
      <td class="tbl-td">

      </td>
    </tr>

    <tr>
      <td class="tbl-td" colspan="2">
          Número de páginas:
      </td>
      <td class="tbl-td">

      </td>
    </tr>

    <tr>
      <td class="tbl-td">
          Descripción convenio
      </td>
      <td class="tbl-td">
          Fecha Entrega Convenio
      </td>
      <td class="tbl-td">
        Convenio (PDF)
      </td>
    </tr>

    <tr>
      <td class="tbl-td">
          Descripción cita
      </td>
      <td class="tbl-td" colspan="2">
        Fecha Entrega cita

      </td>
    </tr>


  </tbody>
</table>
<br><br>

</div>';			 
				
				
				}
				
?>				 
    </div>
	
	



  <div id="ficha" class="tab-pane fade in">
      <p class="contenido-tab">
       
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Características técnicas:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo ''.$medidaFinal. ', '.$numPaginas.' páginas, '.$anioEdicion.'';?></label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Tipo de edición:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;</label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Coeditor:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;</label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Fecha de actualización:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;</label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Nombre de quién actualizó:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;</label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Comentario de actualización:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;</label><br>
		<label style="font-size:13px;font-weight:400;color:#2b2b2b;">Tiraje Total:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp; <?php echo $TirajeTotal;?></label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Tiraje español:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo $Tirajeespañol;?></label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Tiraje inglés:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp<?php echo $Tirajeingles;?>;</label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Tiraje bilingüe:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo $Tirajebilingue;?></label><br>
      </p>
    </div>
    <div id="imagenes" class="tab-pane fade in">
      <p class="contenido-tab">
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Imágenes Catalográficas:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo $ImagenesCatalograficas;?></label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Imágenes complementarias:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo $ImagenesComplementarias;?></label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Total Imágenes: </label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo $TotalImagenes;?></label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Imágenes Catalográficas(PDF):</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;</label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Imágenes complementarias(PDF):</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<a  class="sub2" href="../../../vista/apps/Publicaciones/muestra_pdfColeccion.php?linkPDF=<?php echo $linkMuestraImagenesComplementarias;?>" target="_blank"><label class="prim2"><text class="seg">
		
<?php 
if($rutaComplementarias==""){

}else{
echo 'Ver PDF';
}
?></text></label> </a></label><br>
        
       
      </p>
    </div>

    <div id="diseno" class="tab-pane fade in">
      <div class="row" style="margin-top:15px;margin-left: 5px !important;">
<table class="tbl-ind">
  <thead class="tbl-header">
      <tr>
          <th class="tbl-th">Diseñador</th>
          <th class="tbl-th">Ilustrador</th>
          <th class="tbl-th">Propuesta gráfica</th>
          <th class="tbl-th">Maqueta</th>
        
      </tr>
  </thead>
  <tbody>
    <tr>
      <td class="tbl-td">
	  <?php echo $disenador;?>
      </td>
      <td class="tbl-td">
        <?php echo $ilustrador;?>
      </td>
      <td class="tbl-td">
		<?php echo $rutaPropuestaGrafica;?>
      </td>
      <td class="tbl-td">
		<?php echo $rutaMaqueta;?>
      </td>
    
    </tr>
  </tbody>
</table>
</div>
    </div>
	
    <div id="impresion" class="tab-pane fade in">
      <p class="contenido-tab">
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Preprensa:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo $prePrensa;?></label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Imprenta:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo $Descripcion;?></label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Pruebas de color: </label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;</label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;"> Fecha de entrega pruebas de color:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo $FechaEntregaPruebasColor;?></label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Visto bueno a pie de imprenta(PDF):</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;</label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Fecha entrega visto bueno a pie de imprenta: </label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo $FechaEntregaPieImprenta;?></label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Visto bueno para impresión final de sub. tecnica:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;</label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Fecha entrega para impresión final de sub. tecnica:  </label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php$FechaEntregaVboSTecnicaImpFinal;?></label><br>

      </p>
    </div>

    

    <div id="costos" class="tab-pane fade in">
      <p class="contenido-tab">
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Monto del presupuesto: </label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo $MontoPresupuesto;?></label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Presupuesto(Excel):</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;</label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Fecha entrega de presupuesto: </label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo $FechaEntregaPresupuesto;?></label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Presupuesto por orígenes :</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo $PresupuestoOrigenes;?></label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Presupuesto ejercido:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo $PresupuestoEjercido;?></label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Costo del tiraje: </label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo $CostoTiraje;?></label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Porcentaje de coedición</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo $PorcentajeCoedicion;?></label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Costo de producción general: </label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo $CostoProduccion;?></label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Costo de producción unitario:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo $CostoProduccionUnitario;?></label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">PVP:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo $PVP;?></label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Punto de venta:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo $NombrePV;?></label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Reimpresión :</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo $Reimpresion;?></label><br>
        <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Patrocinador:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;<?php echo $Patrocinador;?></label><br>
      </p>
    </div>

    <div id="premios" class="tab-pane fade in">
      <div class="row" style="margin-top:15px;margin-left: 5px !important;">
<table class="tbl-ind">
  <thead class="tbl-header">
      <tr>
          <th class="tbl-th">Nombre</th>
          <th class="tbl-th">Categoría</th>
          <th class="tbl-th">Fecha</th>
          <th class="tbl-th">Convocante</th>
          <th class="tbl-th">Costo del premio</th>
      </tr>
  </thead>
  <tbody>
  <?php	while ($rowPremios = mysqli_fetch_array($resultConsultaPremios)  ) {
									 $NombrePremio=$rowPremios['Nombre'];
									$CategoriaPremio=$rowPremios['Categoria'];
									$FechaPremio=$rowPremios['Fecha'];
									$ConvocantePremio=$rowPremios['Convocante'];
									$Costo_premio=$rowPremios['Costo_premio'];
							echo ' 
						<tr>
      <td class="tbl-td">
        '.$NombrePremio.'
      </td>
      <td class="tbl-td">
      '. $CategoriaPremio.'
      </td>
      <td class="tbl-td">
 '.$FechaPremio.'
      </td>
      <td class="tbl-td">
'.$ConvocantePremio.'
      </td>
      <td class="tbl-td">
'. $Costo_premio.'
      </td>
    </tr>
					';	}?>
    
  </tbody>
</table>
</div>
    </div>

    <div id="presentacion" class="tab-pane fade in">
      <div class="row" style="margin-top:15px;margin-left: 5px !important;">
<table class="tbl-ind">
  <thead class="tbl-header">
      <tr>
          <th class="tbl-th">Sede</th>
          <th class="tbl-th">Fecha</th>
          <th class="tbl-th">Ponentes</th>
          <th class="tbl-th">Moderador</th>
          <th class="tbl-th">Invitación(PDF)</th>
          <th class="tbl-th">Evidencia(PDF)</th>
            <th class="tbl-th">Enlace de catálogo en micrositio</th>
      </tr>
  </thead>
  <tbody>
  <?php while ($rowPresentacion = mysqli_fetch_array($resultConsultaPresentacion)  ) {
 echo '   <tr>
	
							
					      <td class="tbl-td">
        &nbsp;  '.$rowPresentacion['nombre_sede'].'
      </td>
      <td class="tbl-td">
        &nbsp; '.$rowPresentacion['fecha'].'
      </td>
      <td class="tbl-td">
        &nbsp  '.$rowPresentacion['ponente'].'
      </td>
      <td class="tbl-td">
        &nbsp; '.$rowPresentacion['moderador'].'
      </td>
      <td class="tbl-td">
        &nbsp; '.$rowPresentacion['invitacion_pdf'].'
      </td>
      <td class="tbl-td">
        &nbsp;'.$rowPresentacion['evidencia_pdf'].'
      <td class="tbl-td">
        &nbsp; '.$rowPresentacion['catalogo_micrositio'].'
      </td>		
							
							
							

    </tr>';}?>
  </tbody>
</table>
</div>
<br>
<?php
$totalFilas2    =   0;
$totalFilas2    =    mysqli_num_rows($resultConsultaEnlaceExterno);
if ($totalFilas2==0){
echo '<p class="contenido-tab">
  <label style="font-size:16px;font-weight:400;color:#2b2b2b;">Enlace Externo</label><br>
  <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Descripción:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;</label><br>
  <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Enlace (video):</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;</label><br>
</p>';}?>
<?php
while ($rowEnlaceExterno = mysqli_fetch_array($resultConsultaEnlaceExterno)  ) {
							$ligaEnlaceExterno=$rowEnlaceExterno['liga'];
							$descripcionEnlace=$rowEnlaceExterno['descripcionEnlace'];
							
							echo '<p class="contenido-tab">
  <label style="font-size:16px;font-weight:400;color:#2b2b2b;">Enlace Externo</label><br>
  <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Descripción:</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;'.$descripcionEnlace.'</label><br>
  <label style="font-size:13px;font-weight:400;color:#2b2b2b;">Enlace (video):</label><label style="font-size:13px;font-weight:bold;color:#6d6d6d;">&nbsp;'.$ligaEnlaceExterno.'</label><br>
</p>';
			}?>



    </div>
  </div>

    </div>
				

              

<script src="https://kit.fontawesome.com/b0bf195d6d.js" crossorigin="anonymous"></script>

		</body>


		</html>
