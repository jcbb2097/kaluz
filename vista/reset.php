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
<?php
if(isset($_GET["t"])){
  $token = $_GET["t"];
}
 ?>

      </div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

        <center>
            <center>
              <h1>Nueva contraseña</h1>
            </center>
            <br>
            <center>
              <label for="pass1">Nueva contraseña :</label>
               <input type="text" name="pass1" id="pass1" value="">
            </center>
            <br>
            <center>
              <label for="pass1">Repetir contraseña :</label>
               <input type="text" name="pass2" id="pass2" value="">
            </center>
            <br>
            <center>
              <input type="button"  id="btn" onclick="procesa()" name="" value="Cambiar contraseña" style="background-color: #e0e0e0;font-family:'Muli-Bold';border-radius: 0px;" class="btn btn-default">
            </center>
            <br><br><br>
            <span id="result_data_3" style="">



    				</span>
        </center>


        </div>
        <input type="hidden" id="token" value="<?php echo $token; ?>">
      </div>
      <br><br><br><br>
    </div>
  </body>
  <script type="text/javascript">

    function procesa(){
      let p1 = $("#pass1").val();
      let p2 = $("#pass2").val();
        if(p1 != p2){
          $("#result_data_3").html('<div style="margin-bottom: -21px;" class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign" id="data_result " > <span style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif;">Las contraseñas no coinciden</span> </span></div>');
        }else{
          let string = $("#pass1").val();
          let token = $("#token").val();
             $.post("reasigna.php",{cadena : string, token : token}, function(data) {
               //inhabilitar botones
               $("#pass1").hide();
               $("#pass2").hide();
               $("#btn").hide();
               $("#result_data_3").html(data);
               $("#result_data_3").append('<br><br><a href="login.php">ir al inicio</a>');


             });
        }

    }
  </script>

</html>
