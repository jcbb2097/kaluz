<?php
/*created by Leasim*/
class Pais implements JsonSerializable
{
	private $id;
	private $nombre;
	function __construct()
	{
		$params = func_get_args();
		//saco el número de parámetros que estoy recibiendo
		$num_params = func_num_args();
		//cada constructor de un número dado de parámetros tendrá un nombre de función
		//atendiendo al siguiente modelo __construct1() __construct2()...
		$funcion_constructor ='__construct'.$num_params;
		//compruebo si hay un constructor con ese número de parámetros
		if (method_exists($this,$funcion_constructor)) 
		{
			//si existía esa función, la invoco, reenviando los parámetros que recibí en el constructor original
			call_user_func_array(array($this,$funcion_constructor),$params);
		}		
	}
	
	function __construct0()
	{
		
	}

	public function jsonSerialize()
    {
        $vars = get_object_vars($this);
		return $vars;
    }
	
	public function getId(){return $this -> id;}
	public function getNombre(){return $this -> nombre;}
	
	public function setId($id){$this -> id = $id;}
	public function setNombre($nombre){$this -> nombre = $nombre;}
	
}

?>