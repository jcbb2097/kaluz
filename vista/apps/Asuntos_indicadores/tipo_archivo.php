<?php


session_start();
if(!isset($_SESSION['user_session']))
{
?>
<script>
    top.location.href="../../login.php";
    window.reload();
</script>
<?php
}

if (isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "") $nombreUsuario = $_GET['nombreUsuario']; else $nombreUsuario = "";
if (isset($_GET['idUsuario']) && $_GET['idUsuario'] != "") $idUsuario = $_GET['idUsuario']; else $idUsuario = "";
if (isset($_GET['Id_eje']) && $_GET['Id_eje'] != "") $Id_eje = $_GET['Id_eje']; else $Id_eje = "";
if (isset($_GET['ACME']) && $_GET['ACME'] != "") $ACME = $_GET['ACME']; else $ACME = "";
if (isset($_GET['cate']) && $_GET['cate'] != "") $cate = $_GET['cate']; else $cate = "";
if (isset($_GET['subcate']) && $_GET['subcate'] != "") $subcate = $_GET['subcate']; else $subcate = "";
if (isset($_GET['AGBL']) && $_GET['AGBL'] != "") $AGBL = $_GET['AGBL']; else $AGBL = "";
if (isset($_GET['AGENE']) && $_GET['AGENE'] != "") $AGENE = $_GET['AGENE']; else $AGENE = "";
if (isset($_GET['periodo']) && $_GET['periodo'] != "") $periodo = $_GET['periodo']; else $periodo = "";
if (isset($_GET['check']) && $_GET['check'] != "") $check = $_GET['check']; else $check = "";
if (isset($_GET['tipo_entregable']) && $_GET['tipo_entregable'] != "") $tipo_entregable = $_GET['tipo_entregable']; else $tipo_entregable = "";
if (isset($_GET['origen_asunto']) && $_GET['origen_asunto'] != "") $origen_asunto = $_GET['origen_asunto']; else $origen_asunto = "";
if (isset($_GET['origen']) && $_GET['origen'] != "") $origen = $_GET['origen']; else $origen = "";


 ?>

 <html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Tipo archivo</title>


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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="../../../resources/js/sweetAlert.js"></script>
    <script src="../../../resources/js/bootstrap/bootstrapValidator.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="row">



        <center>
          <div class="col-md-12 col-sm-12 col-xs-12 text-center"  >
            <label class="control-label " for="archivo">* Selecciona el tipo de archivo a adjuntar:</label>
              <select id="archivo" class="form-control" name="archivo" >
                <option value="0">Selecciona una opción</option>
                  <option value="1">Archivo de entregable</option>
                  <option value="2">Archivo compartido</option>
                  <option value="3">Archivo de normatividad</option>
              </select>
          </div>
        </center>
      </div>
    </div>
  </body>
  <script type="text/javascript">
    $("#archivo").change(function (event){
      var padre = $(window.parent.document);

      // var usr = $(padre).find( "#idusr" ).val();
      // let nombreusr = $(padre).find( "#nombreusr" ).val();
      // let ideje = $(padre).find( "#ideje" ).val();
      // let act = $(padre).find( "#acme" ).val();
      // let categoria = $(padre).find( "#categoria" ).val();
      // let subcategoria = $(padre).find( "#subcategoria" ).val();
      // let act_glob = $(padre).find( "#act_glob" ).val();
      // let act_gen = $(padre).find( "#act_gen" ).val();
      // let periodo = $(padre).find( "#periodo" ).val();
      // let check = $(padre).find( "#check" ).val();
      // let tipoentregable = $(padre).find( "#tipoentregable" ).val();
      // let asunto = $(padre).find( "#asunto" ).val();

      var usr = <?php echo $idUsuario ; ?>;
      let nombreusr = "<?php echo $nombreUsuario ; ?>";
      let ideje ="<?php echo $Id_eje ; ?>";
      let act = "<?php echo $ACME ; ?>";
      let categoria = "<?php echo $cate ; ?>";
      let subcategoria = "<?php echo $subcate ; ?>";
      let act_glob = "<?php echo $AGBL ; ?>";
      let act_gen = "<?php echo $AGENE ; ?>";
      let periodo = "<?php echo $periodo ; ?>";
      let check = "<?php echo $check ; ?>";
      let tipoentregable = "<?php echo $tipo_entregable ; ?>";
      let asunto = "<?php echo $origen_asunto ; ?>";
      let origen = "<?php echo $origen ; ?>";
      let app = "";
      let archivo = $("#archivo").val();
      console.log(archivo);


      switch (archivo) {
        case "1":
            app = "../ArchivosEntregables/Alta_entregable_2.php";
          break;
          case "2":
              app = "../ArchivosCompartidos/Alta_archivo.php";
            break;
            case "3":
              app = "../ArchivosNormatividad/Alta_normatividad.php";
              break;
        default:
          alert("Seleccione un tipo de archivo para continuar");
          break;
      }
      if(app != ""){
        var url = app+"?accion=guardar&tipoPerfil=1&nombreUsuario="+nombreusr+"&idUsuario="+usr+"&plan=1&Id_eje="+ideje+"&ACME="+act+
        "&cate="+categoria+"&subcate="+subcategoria+"&AGBL="+act_glob+"&AGENE="+act_gen+"&periodo="+periodo+"&check="+check+
        "&subcheck=&regreso=&tipo_entregable="+tipoentregable+"&origen_asunto="+asunto+"&origen="+origen;
        var frame = $(padre).find('#frame_archivos');
        frame.attr('src',url).show();

      }

    });

  </script>
</html>
