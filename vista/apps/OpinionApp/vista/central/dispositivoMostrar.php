<?php
/*created by leasim*/
	include_once __DIR__."/../../source/controller/DispositivoController.php";
	
	$idUsuario = $_POST["idUsuario"];
	$titulo = $_POST["titulo"];
	
	$act = new DispositivoController();
	$dispositivos = $act -> mostrarDispositivos();
	
	$cadena = "";
				
	foreach ($dispositivos as $disp)
	{
		$cadena.="<tr>"
				."<td>".$disp -> getNombre()."</td>"
				."<td>".$disp -> getInventario()."</td>"
				."<td>".$disp -> getMarca()."</td>"
				."<td>".$disp -> getModelo()."</td>"
				."<td>".$disp -> getFechaCompra()."</td>"
				."<td>".$disp -> getSerie()."</td>"
				."<td>".$disp -> getControl()."</td>"
				."<td>".$disp -> getAccesorio()."</td>"
				."<td>".$disp -> getObservacion()."</td>"
				."<td>".$disp -> getNombreEstatusDispositivo()."</td>"
				."<td>".$disp -> getEspacio()."</td>"
				."<td>".$disp -> getNombreEje()."</td>"
				."<td>".$disp -> getNombreArea()."</td>"
				."<td>".$disp -> getNombreActividad()."</td>"
				."<td>".$disp -> getPersonaUsa()."</td>"
				."<td>".$disp -> getPersonaResguarda()."</td>"
				."</tr>";
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <style>
	div.dt-buttons {
		position: relative;
		float: left;
		top: 33px;
		z-index: 100;
	}
	table.dataTable thead .sorting::after {
		opacity: 1;
	}
	.labelC{
		font-family: 'Muli-SemiBold';
		border-radius: 0px;
		font-size: 10px;
		padding: 5px;
		color:white;
		background-color:#4d4d57;
	}
	
	/*jquery confirm*/
	
	.jconfirm .jconfirm-box div.jconfirm-title-c .jconfirm-title {
		font-size: 12px;
		font-family: 'Muli-Bold';
	}
	
	.btnC{
		font-size: 11px !important;
		border-radius: 0px !important;
		font-family: 'Muli-SemiBold';
	}
	
	/**/
	
	.form-control{
		border-radius: 0px;
		font-size: 12px;
		height: 25px;
		font-family: 'Muli-Regular';
	}
	
	label{
		font-size: 12px;
		font-family: 'Muli-Bold';
	}
	
	.titleRuta{
		font-size: 11px;
    font-family: 'Muli-Bold';
	}
  </style>
</head>
<body>
<div class="container-fluid" >
	<div class="row ruta">
		<div class="col-md-12 col-sm-12 col-xs-12 titleRuta">
			<?php echo $titulo; ?>
		</div>
	</div>

	<div class="table-responsive">
		<table id="dispositivoDato" class="table table-striped table-bordered table-condensed"  width="100%">
			<thead style="font-size:10px;background-color: #4d4d57;color: white;font-family: 'Muli-SemiBold';">
				<tr>
					<th>Dispositivo</th>
					<th>Inventario</th>
					<th>Marca</th>
					<th>Modelo</th>
					<th>Fecha Compra</th>
					<th>Serie</th>
					<th>Control</th>
					<th>Accesorios</th>
					<th>Observación</th>
					<th>Estatus</th>
					<th>Ubicación</th>
					<th>Eje</th>
					<th>Área</th>
					<th>Actividad</th>
					<th>Usa</th>
					<th>Resguarda</th>
				</tr>
			</thead>
			<tbody style="font-size:10px">
			<?php
				echo $cadena;
			?>	 	
			</tbody>
		</table>
	</div>
</div>


<style>
.text-wrap{
    white-space:normal;
}
.width-50{
    width:40px;
}
</style>
<script>
$(document).ready(function() {

	var table = $('#dispositivoDato').DataTable();
	table.destroy();
	
	
	var table = $('#dispositivoDato').DataTable(
	{
		pageLength: 25,
		"lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Todo"]],
		
		"language": 
		{
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
		dom: 'Blfrtip',
		buttons: [
           
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel'
            },
           /*
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF'
            }*/
        ],
        /*buttons: [
            //'copy', 'csv', 'excel', 'print'
			'excel'
        ],*/
		"scrollX": true,
		"order": [[ 0, "asc" ]],
		responsive: false,
		"scrollY":        "370px",
        "scrollCollapse": true,
        "paging": true,
		columnDefs:[
          
        ]
		
		
		
	});	
});
</script>

</body>
</html>
