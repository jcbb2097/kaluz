<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();

/*$FiltroEjeAño=""; //Se inicializa la variable
if ((isset($_GET['ejeaño']) && $_GET['ejeaño'] != "")) //Si el parametro existe se procesa
{   if ($_GET['ejeaño']!="0") {$FiltroEjeAño =" AND a.Periodo= ".$_GET['ejeaño'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $FiltroEjeAño="  AND isnull(aa.id_proyecto)"; } //Si el parametro es igual a 0 se buscan los NULOS
}*/

$Areainvitada=""; //Se inicializa la variable
if ((isset($_GET['areainvitada']) && $_GET['areainvitada'] != "")) //Si el parametro existe se procesa
{   if ($_GET['areainvitada']!="0") {$Areainvitada ="".$_GET['areainvitada'];} //Si el parametro es diferente de 0 se busca el valor
    else {$Areainvitada=""; } //Si el parametro es igual a 0 se buscan los NULOS
}

$idarea=""; //Se inicializa la variable
if ((isset($_GET['idacuerdo']) && $_GET['idacuerdo'] != "")) //Si el parametro existe se procesa
{   if ($_GET['idacuerdo']!="0") {$idarea ="".$_GET['idacuerdo'];} //Si el parametro es diferente de 0 se busca el valor
    else { $idarea=""; } //Si el parametro es igual a 0 se buscan los NULOS
}

//echo $Areainvitada." ".$idarea;

$consulta = "DELETE FROM k_acuerdoarea WHERE id_Acuerdo = $idarea AND id_Area_invitada=$Areainvitada";
//echo "<br><br>$consulta<br><br>";
$query = $catalogo->ejecutaConsultaActualizacion($consulta, "k_acuerdoarea", "id_Acuerdo=".$idacuerdo." and id_Area_invitada=".$areainvitada);
?>

<script languaje='javascript' type='text/javascript'>window.close();</script>
