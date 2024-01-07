<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once ('../../Classes/indicador.class.php');
include_once("../../Classes/Catalogo.class.php");
$catalogo = new Catalogo();
$indicador = new indicador();
if (isset($_POST['accion']) && $_POST['accion'] != "") {
   
}