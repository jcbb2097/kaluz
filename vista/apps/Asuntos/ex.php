<?php
/*created by leasim*/

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Piezas Exposición</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
 



</head>
<body>
<div class="container-fluid">
<p style="cursor:pointer" onclick="abrir()">probando modal</p>
</div>



</body>
<script>
function abrir()
	{
		alert("entro");
		
		$.confirm({
    title: 'Title',
    content: 'url:grafica.php',
    onContentReady: function () {
        var self = this;
        this.setContentPrepend('<div>Prepended text</div>');
        setTimeout(function () {
            self.setContentAppend('<div>Appended text after 2 seconds</div>');
        }, 2000);
    },
    columnClass: 'medium',
});
		
		
	}
</script>
</html>