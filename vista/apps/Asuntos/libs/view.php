<?php

class View {
 
 function __construct() {

 }

 function renderizar($vistaNombre) {
 	require 'views/'.$vistaNombre.'.php';
 }

}

?>