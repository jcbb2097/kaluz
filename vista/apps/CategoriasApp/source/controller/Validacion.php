<?php

class Validacion
{
	public static function sanearCadena ($cadena)
	{
		if($retorno = htmlspecialchars(trim($cadena)))
		{
			return $retorno;
		}
		else
		{
			return "";
		}
	}
}
?>