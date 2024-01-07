<?php
class Conexion {
    private $db;
    var $empresa;

    /* private $MYSQL_HOST = "184.168.23.252";
    private $MYSQL_DB = "adminsie_pruebas";
    private $MYSQL_LOGIN = "adminsie_prueba";
    private $MYSQL_PASS = 'SC]wW5^3WdwS'; */
	
    private $MYSQL_HOST = "localhost";
    private $MYSQL_DB = "sie";
    private $MYSQL_LOGIN = "root";
    private $MYSQL_PASS = '';
	
	
	
	
	
//
    public function Conectar() {
        //echo "$this->MYSQL_HOST, $this->MYSQL_DB, $this->MYSQL_LOGIN, $this->MYSQL_PASS";
        $this->db = @mysqli_connect($this->MYSQL_HOST, $this->MYSQL_LOGIN, $this->MYSQL_PASS);
        $return = @mysqli_query($this->db,"SET NAMES 'utf8'");
        $return = @mysqli_query($this->db,"SET time_zone = '-06:00';");

        //echo "<br>Entra conectar";
        if (!$this->db) {

            die('Error de Conexión (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
            exit;
        }

        if(!@mysqli_select_db($this->db,$this->MYSQL_DB)){
            echo "<br/>Error: no se pudo conectar a la BD, revisa los datos de conexion en la base.";
            exit;
        }
        //echo "<br>Entra conectar<br>";

    }

    function Desconectar() {
        if (gettype($this->db) == "resource") {
            mysqli_close($this->db);
        }
    }

    function Ejecutar($query) {
        //echo "<br>Entra Ejecutar ".$query."<br>";
        $resultado = mysqli_query($this->db,$query);

        if (!$resultado) {
            $resultado = mysqli_error($this->db);
        }
        return $resultado;
    }


    function EjecutarInsert($query) {
        //echo "<br>Entra Ejecutar Insert".$query."<br>";
        $resultado = mysqli_query($this->db,$query);
           //echo $resultado;
        if (!$resultado) {
            $resultado = mysqli_error($this->db);
            return  $resultado;
        }else{
			//echo "entras";
            $id =  mysqli_insert_id($this->db);

            return  $id;
        }

    }

    function EjecutarRegresandoFilasAfectadas($query){
        mysqli_query($query);
//        if (!$resultado) {
//            $resultado = mysql_error();
//        }
        return mysqli_affected_rows();
    }

    public function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    public function getMYSQL_HOST() {
        return $this->MYSQL_HOST;
    }

    public function getMYSQL_DB() {
        return $this->MYSQL_DB;
    }

    public function getMYSQL_LOGIN() {
        return $this->MYSQL_LOGIN;
    }

    public function getMYSQL_PASS() {
        return $this->MYSQL_PASS;
    }
	public function getDB() {
        return $this->db;
    }
}

?>
