<html>
  <head>
    <title>Museo del Palacio de Bellas Artes</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

        <title>::.SIE.::</title>
      	<link rel="stylesheet" type="text/css" href="../resources/font/index.css"/>
      	<link rel="stylesheet" type="text/css" href="../resources/css/scroll.css"/>
      	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      	<script type="text/javascript" src="../resources/js/validation.min.js"></script>
  </head>



  <body bgcolor="#FFFFFF">
    <div class="container-fluid">
      <div class="row">


      </div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

        <center>
            <center>
              <h1>Correo electrónico</h1>
            </center>
            <br>
            <center>

                <input type="text" name="correo" id="correo" value="" class="col-md-12 col-sm-12 col-xs-12">

            </center>
            <br><br><br>
            <center>
              <input type="button"  onclick="procesa()" name="" value="Recuperar contraseña" style="background-color: #e0e0e0;font-family:'Muli-Bold';border-radius: 0px;" class="btn btn-default">
            </center>
            <br><br>
            <span id="result_data" style="">



    				</span>
        </center>


        </div>
      </div>
      <br><br><br><br>
    </div>
  </body>
  <script type="text/javascript">

    function procesa(){

       let correo = $("#correo").val();
          $.post("Enviar_correo.php",{correo : correo}, function(data) {
            $("#result_data").html(data);
          });
    }
  </script>

</html>
