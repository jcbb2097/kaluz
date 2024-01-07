
<style>
label{
	font-size: 12px;
}
.form-group {
    margin-bottom: 5px;
}
</style>
<br>
<div class="container-fluid">
	<div class='row'>
		<div class='col-md-12 col-sm-12 col-xs-12'>
		<p style="font-size: 14px;font-family: 'Muli-Bold';">Cálculo de importes de factura para Persona física con actividad empresarial</p>
		<p style="font-size: 13px;font-family: 'Muli-Regular';">Ingrese valor <b>bruto</b> o <b>neto</b> para obtener los importes deseados</p>
		</div>
	</div>
	<br>
	<div class='row'>
		<div class='col-md-6 col-sm-6 col-xs-12'>
			<div class="form-group">
				<label for="inputsm">Importe (bruto) <i data-toggle="tooltip" data-placement="top" title="En dicha cantidad no se incluyen impuestos ni deducciones o descuentos" class="fas fa-question-circle"></i></label>
				<input type='number' id="importe" name='importe' class="form-control input-sm  " />
			</div>
			<div class="form-group">
				<label for="inputsm">IVA</label>
				<input type='number' id="iva" name='iva' class="form-control input-sm  " readonly />
			</div>
			<div class="form-group">
				<label for="inputsm">Subtotal</label>
				<input type='number' id="subtotal" name='subtotal' class="form-control input-sm  " readonly />
			</div>
			<div class="form-group">
				<label for="inputsm">Ret ISR</label>
				<input type='number' id="retisr" name='retisr' class="form-control input-sm  "  readonly />
			</div>
			<div class="form-group">
				<label for="inputsm">Ret IVA</label>
				<input type='number' id="retiva" name='retiva' class="form-control input-sm  " readonly  />
			</div>
			<div class="form-group">
				<label for="inputsm">Total (neto) <i data-toggle="tooltip" data-placement="top" title="Cantidad final a recibir" class="fas fa-question-circle"></i></label>
				<input type='number' id="total" name='total' class="form-control input-sm  " />
			</div>
		</div>
	</div>
	<div class='row'>
		<div class='col-md-12 col-sm-12 col-xs-12'>
		<p style="font-size: 12px;    font-family: 'Muli-Bold';">Esta información es solo para referencia del importe acordado, es responsabilidad del proveedor o prestador de servicios verificar que la información sea correcta de acuerdo a la ley vigente. </p>
		</div>
	</div>
</div>

</body>
<script>

$("#importe").keyup(function(event) {
		calcularBrutoPM();
});

$("#total").keyup(function(event) {
		calcularNetoPM();
});

function calcularBrutoPM(){
	/*fijas*/
	var iva = 0.16;
	
	/**/
	var total = 0.0;
	var ivaNumero = 0.0;
	var subtotal = 0.0;
	
	var importe = $("#importe").val();
	
	
	ivaNumero = (importe * iva);
	subtotal =  (parseFloat(importe) + parseFloat(ivaNumero));
	total =  (parseFloat(importe) + parseFloat(ivaNumero));
	
	$("#iva").val(ivaNumero.toFixed(2));
	$("#subtotal").val(subtotal.toFixed(2));
	$("#total").val(total.toFixed(2));
}

function calcularNetoPM(){
	
	/**/
	var total = 0.0;
	var ivaNumero = 0.0;
	var subtotal = 0.0;
	var importeSinIva = 0.0;
	
	var total = $("#total").val();
	
	
	importeSinIva = (total / 1.16);
	subtotal =  total;
	ivaNumero = subtotal - importeSinIva;
	
	$("#iva").val(ivaNumero.toFixed(2));
	$("#subtotal").val(subtotal);
	$("#importe").val(importeSinIva.toFixed(2));
}

</script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
</html>