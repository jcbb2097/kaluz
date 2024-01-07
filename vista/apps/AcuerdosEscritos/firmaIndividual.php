<?php
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$nombreUsuario = "SinUsr";

$IdAcuerdo=""; //Se inicializa la variable
if ((isset($_GET['idAcuerdoI']) && $_GET['idAcuerdoI'] != "")) //Si el parametro existe se procesa
{   if ($_GET['idAcuerdoI']!="0") {$IdAcuerdo ="".$_GET['idAcuerdoI'];} //Si el parametro es diferente de 0 se busca el valor
    else { $IdAcuerdo="0"; } //Si el parametro es igual a 0 se buscan los NULOS
}

$TipoPerfil=""; //Se inicializa la variable
if ((isset($_GET['tipoPerfil']) && $_GET['tipoPerfil'] != "")) //Si el parametro existe se procesa
{   if ($_GET['tipoPerfil']!="0") {$TipoPerfil ="".$_GET['tipoPerfil']; 
} //Si el parametro es diferente de 0 se busca el valor
    else { $TipoPerfil="Sin valor"; } //Si el parametro es igual a 0 se buscan los NULOS
}

$idUsuario=""; //Se inicializa la variable
if ((isset($_GET['idUsuario']) && $_GET['idUsuario'] != "")) //Si el parametro existe se procesa
{   if ($_GET['idUsuario']!="0") {$idUsuario ="".$_GET['idUsuario'];
} //Si el parametro es diferente de 0 se busca el valor
    else { $idUsuario="Sin valor"; } //Si el parametro es igual a 0 se buscan los NULOS
}
//echo $idUsuario;

$NombreTipoPerfil = "";
$consultanombre1 = "SELECT  a.Id_Area as Id_Area,a.Nombre as Nombre FROM c_usuario AS u
LEFT JOIN c_personas AS p ON p.id_Personas=u.IdPersona
LEFT JOIN c_area AS a ON a.Id_Area=p.idArea
WHERE idUsuario=$idUsuario";
$resulvanombre1 = $catalogo->obtenerLista($consultanombre1);
    while ($row1 = mysqli_fetch_array($resulvanombre1)) {
           $NombreTipoPerfil = $row1['Id_Area'];
    }
$url = "./Alta_acuerdo.php?accion=editar&id=$IdAcuerdo&tipoPerfil=$TipoPerfil&nombreUsuario=SinUsr&idUsuario=$idUsuario";

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link href="../../../resources/css/bootstrap-select.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="../../../resources/js/bootstrap-select.js"></script>

    <script src="../../../resources/js/sweetAlert.js"></script>
    <script src="../../../resources/js/bootstrap/bootstrapValidator.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Firmar Pdf</title>
<script src="jquery.min.js"></script>
<script src="signature_pad.js"></script>

<body>
  <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Aplicaciones</a> / 
        <a style="color:#fefefe;" href="Vista.php?usuario=<?php echo $nombreUsuario; ?>&nombreUsuario=<?= $nombreUsuario ?>&tipoPerfil=1&idUsuario=<?= $idUsuario ?>">Acuerdos</a> /
        <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Guardar Firma</a></div>
    <div class="well2 wr">
        <a style="color:#fefefe;" href="Vista.php?usuario=<?php echo $nombreUsuario; ?>&nombreUsuario=<?= $nombreUsuario ?>&tipoPerfil=1&idUsuario=<?= $idUsuario ?>">Indicadores</a> /
        <a style="color:#fefefe; cursor: pointer;" href="Lista_acuerdos.php?nombreUsuario=<?= $nombreUsuario ?>&tipoPerfil=1&idUsuario=<?= $idUsuario ?>">Lista Acuerdos</a> /
        <a style="color:#fefefe; cursor: pointer;" href="Acuerdosfocos.php?usuario=<?php echo $nombreUsuario; ?>&nombreUsuario=<?= $nombreUsuario ?>&tipoPerfil=1&idUsuario=<?= $idUsuario ?>">Focos</a> /
        <a style="color:#fefefe; cursor: pointer;" href="Alta_acuerdo.php?accion=guardar&tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Agregar +</a>  
    </div>

<!-- Contenedor y Elemento Canvas -->
  <center>
  <div id="signature-pad" class="signature-pad" >
      <div class="description">Dibujar aqui tu firma</div>
    <div class="signature-pad--body">
      <canvas style="width: 240px; height: 220px; border: 1px black solid; " id="canvas"></canvas>
    </div>
  </div>

<!-- Formulario que recoge los datos y los enviara al servidor -->
 <form id="form" action="./savedrawIndividual.php" method="post">
    
    <input type="hidden" id="tipoPerfil" name="tipoPerfil" value="<?php echo $TipoPerfil; ?>">
    <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $idUsuario; ?>">
    <input type="hidden" name="base64" value="" id="base64">
    <input type="hidden" name="idacuerdo" value="<?php echo $IdAcuerdo; ?>" id="idacuerdo">
    <br>
    <button id="saveandfinish" class="btn btn-default btn-xs">Guardar y Firmar</button>
    <button type="button" class="btn btn-default btn-xs" id="back">Regresar</a>
</form>
</center>
<?php
//echo $AreaInvitada;
//echo $IdAcuerdo;
?>

<script type="text/javascript">

var wrapper = document.getElementById("signature-pad");

var canvas = wrapper.querySelector("canvas");
var signaturePad = new SignaturePad(canvas, {
  backgroundColor: 'rgb(255, 255, 255)'
});

function resizeCanvas() {

  var ratio =  Math.max(window.devicePixelRatio || 1, 1);

  canvas.width = canvas.offsetWidth * ratio;
  canvas.height = canvas.offsetHeight * ratio;
  canvas.getContext("2d").scale(ratio, ratio);

  signaturePad.clear();
}

window.onresize = resizeCanvas;
resizeCanvas();

</script>
<script>

   document.getElementById('form').addEventListener("submit",function(e){

    var ctx = document.getElementById("canvas");
      var image = ctx.toDataURL(); // data:image/png....
      document.getElementById('base64').value = image;
   },false);

</script>
<script type="text/javascript">
    var back = document.getElementById('back'); // Suponiendo que la identificación del elemento del botón de retorno está de vuelta
    back.onclick = function() {
        history.back(); // Regresa a la página anterior, también se puede escribir como history.go (-1)
    };

function mostrar() {
 Swal.fire({
  icon: 'error',
  title: 'Ya esta firmado',
  showConfirmButton: false,
  timer: 2000
}).then(function() {
    <?php
    echo 'window.location.replace("'.$url.'")';
    ?>
});
}

function nopuedefirmar() {
 Swal.fire({
  icon: 'error',
  title: 'No puedes firmar este acuerdo',
  showConfirmButton: false,
  timer: 2000
}).then(function() {
    <?php
    echo 'window.history.back()';
    ?>
});
}

function nopuedefirmarsdatos() {
 Swal.fire({
  icon: 'error',
  title: 'No existe receptor del acuerdo',
  showConfirmButton: false,
  timer: 2000
}).then(function() {
    <?php
    echo 'window.history.back()';
    ?>
});
}
</script>
  </body>
</html>
<?php 

if(isset($_GET['responsableacuerdo']) and isset($_GET['PersonaAcuerdo'])) {
 $responsableacuerdo = $_GET['responsableacuerdo'];
 $PersonaAcuerdo = $_GET['PersonaAcuerdo'];

  if($responsableacuerdo != $PersonaAcuerdo){
    echo '<script type="text/javascript">';
    //echo 'alert("No puedes firmar esta área");';
    echo 'nopuedefirmar();';
    
   //echo 'window.location.replace("'.$url.'")';
    echo '</script>';
  }
}else{
        echo '<script type="text/javascript">';
        //echo 'alert("No puedes firmar esta área");';
        echo 'nopuedefirmarsdatos();';
        //echo 'window.location.replace("'.$url.'")';
        echo '</script>';

}




//valida si ya esta firmado    
$estafirmado = "";
/* $validarsiestafirmado = "SELECT acua.firma as firma FROM k_acuerdoarea acua
WHERE acua.id_Acuerdo=$IdAcuerdo AND acua.id_Area_invitada=$AreaInvitada";
$resulfirma = $catalogo->obtenerLista($validarsiestafirmado);
    while ($row2 = mysqli_fetch_array($resulfirma)) {
           $estafirmado = $row2['firma'];
    }
    if ($estafirmado != "") {
        //$url = "./Alta_acuerdo.php?accion=editar&id=$IdAcuerdo&tipoPerfil=$TipoPerfil&nombreUsuario=SinUsr&idUsuario=$idUsuario";
        echo '<script type="text/javascript">';
        //echo 'alert("Ya esta firmado");';
        echo 'mostrar();';
        //echo 'window.location.replace("'.$url.'")';
        echo '</script>';
        //header("Location: ./Alta_acuerdo.php?accion=editar&id=$IdAcuerdo&tipoPerfil=$TipoPerfil&nombreUsuario=SinUsr&idUsuario=$idUsuario");
    }else{

    }
    */
?>