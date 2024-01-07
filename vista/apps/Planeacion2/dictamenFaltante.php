<?php
	include_once __DIR__."/../Piezas/source/controller/ObjetivoController.php";
	
	$idExposicion = $_POST["idExposicion"];
	$tipo = $_POST["tipo"];
	
	
	$act = new ObjetivoController();
	$i = 1;
	$cadena = "";
	
	
	
	if($tipo == 1)
	{
		
		
		$dictamenes = $act ->mostrarDictamenEntradaFaltante($idExposicion);
	
		
		$ruta = "../Piezas/resources/img/obras/";
		$rutaDictamen = "../Piezas/resources/dictamen/".$idExposicion."/";
	
		foreach($dictamenes as $dic)
		{
			$cadena .= "<tr><td>".$i."</td><td><a href='".$rutaDictamen.$dic->getArchivo()."' target='_blank'>".$dic->getArchivo()."</a></td><td style='width: 100px;'><img src='".$ruta.$dic -> getImagen()."' class='img-responsive img-thumbnail imindex' style=' min-width: 100px;'></td><td>".$dic->getTitulo()."</td><td>".$dic->getAutor()."</td><td>".$dic->getNombreColeccion().$dic->getNombrePersona()."</td></tr>";
		$i++;
			
		}
	
		
	}else if($tipo == 2)
	{
		
		
		$dictamenes = $act ->mostrarDictamenSalidaFaltante($idExposicion);
	
		$cadena = "";
		$ruta = "../Piezas/resources/img/obras/";
		$rutaDictamen = "../Piezas/resources/dictamen/".$idExposicion."/";
	
		foreach($dictamenes as $dic)
		{
			$cadena .= "<tr><td>".$i."</td><td><a href='".$rutaDictamen.$dic->getArchivo()."' target='_blank'>".$dic->getArchivo()."</a></td><td style='width: 100px;'><img src='".$ruta.$dic -> getImagen()."' class='img-responsive img-thumbnail imindex' style=' min-width: 100px;'></td><td>".$dic->getTitulo()."</td><td>".$dic->getAutor()."</td><td>".$dic->getNombreColeccion().$dic->getNombrePersona()."</td></tr>";
			$i++;
		}
	
		
	}

?>
<style>
.img-thumbnail {
    display: inline-block;
    max-width: 30% !important;
    height: auto !important;
    padding: 4px;
    line-height: 1.42857;
    background-color: rgb(255, 255, 255);
    border: 1px solid rgb(221, 221, 221);
    border-radius: 4px;
    transition: all 0.2s ease-in-out 0s;
}

.dataTables_scrollHead{
	height: 34px;
}
.pcl{
		font-size: 10px;
    font-family: 'Muli-Bold';
    margin-left: 15px;
	}
.pcl2{
		font-size: 10px;
    font-family: 'Muli-Bold';
   
	}
</style>
<p class='pcl2'>Dictámenes faltantes</p>
<table class="table table-bordered" id="datosDictamen2">
    <thead style='font-family: "Muli-SemiBold"; font-size: 10px;' class="table-header">
        <tr style="background-color: #5a274f;color: white;">
            <th class="Actividad"># </th>
            <th class="Actividad">Dictamen</th>
            <th class="Actividad">Imagen</th>
            <th class="Actividad">Título</th>
            <th class="Actividad">Autor</th>
			<th class="Actividad">Colección</th>
        </tr>
    </thead>
    <tbody style='font-size:10px;'>
	<?php echo $cadena;?>
    </tbody>

</table>
<script>
    $(document).ready(function() {

        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });

        // DataTable
        var table = $('#datosDictamen2').DataTable();
        table.destroy();
        table = $('#datosDictamen2').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
            },
            "searching": false,
            pageLength: 100,
            "order": [],
            "paging": true,
			"scrollX": true,
			"scrollY": "370px",
			"scrollCollapse": true,
			responsive: false,
        });

    });

    
	
	
	
		
</script>