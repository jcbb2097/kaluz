<?php

include_once("Parametros.class.php");
include_once("Catalogo.class.php");

class Session {

    private $id_usu;
    private $usuario;
    private $password;
    private $id_empresa;
    private $nombre_empresa;
    private $empresa;

    function getLogin($usuario, $password) {
        $consulta = ("SELECT IdUsuario, `Password` FROM c_usuario WHERE Usuario = '$usuario' AND Password = '$password'; ");          
        $catalogo = new Catalogo();
        if (isset($this->empresa)) {
            $catalogo->setEmpresa($this->empresa);
        }
        //echo "<br><br>".$consulta."<br><br>";
        $query = $catalogo->obtenerLista($consulta);        
        while ($rs = mysql_fetch_array($query)) {            
            $this->id_usu = $rs['IdUsuario'];
            $this->usuario = $usuario;
            $this->password = $password;
            return $this->id_usu;
        }
        return "";
    }
   
    function getLoginWeb($usuario, $password) {
        $consulta = ("SELECT IdUsuario, `Password` FROM c_usuario WHERE Usuario = '$usuario' AND Password = '$password' AND IdTipoUsuario IN (1,2) AND Activo = 1 ; ");          
        $catalogo = new Catalogo(); 
       // echo '<br><br>'.$consulta.'<br><br>';
        $query = $catalogo->obtenerLista($consulta);        
        while ($rs = mysql_fetch_array($query)) {            
            $this->id_usu = $rs['IdUsuario'];
            $this->usuario = $usuario;
            $this->password = $password;
            return $this->id_usu;
        }
        return "";
    }
    
    public function desencriptarContrasena($password){  
        //Se toman solo los caracteres que forman el real password
        $password_real = substr($password, 0, 8);
        $password_real .= substr($password, 13, 10);
        $password_real .= substr($password, 28, 8);
        $password_real .= substr($password, 41, strlen($password)-1);
        return $password_real;
    }
    
    /**
     * Regresa una clave unica activa para el usuario actual
     * @param type $sizeClave tamanio de la clave     
     * @return type
     */
    public function generarClaveSession($sizeClave) {
        $clave = "";
        $clave_existe = false;
        $respuesta = array();
        $catalogo = new Catalogo();
        if (isset($this->empresa)) {
            $catalogo->setEmpresa($this->empresa);
        }

        $parametros = new Parametros();
        if (isset($this->empresa)) {
            $parametros->setEmpresa($this->empresa);
        }
        
        //Obtenemos el maximo de minutos que una session puede estar activa
        $max_minute = 240; //Valor por default
        if ($parametros->getRegistroById(6)) {//Valor configurado en la bd
            $max_minute = (int) $parametros->getValor();
        }
                
        
        $consulta = "SELECT IdSession, ClaveSession, FechaCreacion FROM c_session 
                WHERE IdUsuario = $this->id_usu AND Activo = 1 AND TIMESTAMPDIFF(MINUTE,FechaCreacion,NOW()) < $max_minute 
                ORDER BY IdSession LIMIT 0,1;";        
        $result = $catalogo->obtenerLista($consulta);
        if (mysql_num_rows($result) > 0) {//Si el usuario actual ya tiene una clave activa, se regresa esa clave
            while ($rs = mysql_fetch_array($result)) {                
                $respuesta['IdSession'] = $rs['ClaveSession'];                
            }
            return $respuesta;
        } else {//Si el usuario no tiene clave activa se genera una nueva                         
            //Desactivamos cualquier Session activa
            $consulta = "UPDATE c_session SET Activo = 0 WHERE IdUsuario = $this->id_usu;";
            $catalogo->obtenerLista($consulta);
            do {//Se repite el proceso hasta que se encuentra una clave valida
                $clave = $this->generarClavealeatoria($sizeClave); //Generamos la clave aleatoria            
                $consulta = "SELECT IdSession FROM c_session WHERE ClaveSession = '$clave' AND Activo = 1;";
                $result = $catalogo->obtenerLista($consulta);
                if (mysql_num_rows($result) > 0) { //Si la clave ya existes y está vigente, se tiene que volver a generar otra
                    $clave_existe = true;
                } else {//Si la clave no existe, la insertamos en la BD y la devolvemos como resultado del método
                    $hoy = getdate();
                    //$fechaCreacion = $hoy['year']."-".$hoy['mon']."-".$hoy['mday']." ".$hoy['hours'].":".$hoy['minutes'].":".$hoy['seconds'];
                    $consulta = "INSERT INTO c_session(IdSession, ClaveSession, IdUsuario, Activo, FechaCreacion) VALUES(0,'$clave',$this->id_usu,1,NOW());";
                    $idSession = $catalogo->insertarRegistro($consulta);
                    if ($idSession != NULL && $idSession != 0) {
                        $clave_existe = false;
                        //$respuesta['FechaCreacion'] = $fechaCreacion;
                        $respuesta['IdSession'] = $clave;
                        //$respuesta['DuracionMinutos'] = $max_minute;
                    }
                }
            } while ($clave_existe);
        }
        return $respuesta;
    }
    
    /**
     * Genera una clave alfanumerica de tamanio "n"
     * @param type $sizeClave tamanio de la clave
     * @return type
     */
    function generarClavealeatoria($sizeClave) {
        //Se define una cadena de caractares. Te recomiendo que uses esta.
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890?[]=*-+.";
        //Obtenemos la longitud de la cadena de caracteres
        $longitudCadena = strlen($cadena);

        //Se define la variable que va a contener la contraseña
        $pass = "";
        //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras        
        $longitudPass = $sizeClave;

        //Creamos la contraseña
        for ($i = 1; $i <= $longitudPass; $i++) {
            //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
            $pos = rand(0, $longitudCadena - 1);

            //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
            $pass .= substr($cadena, $pos, 1);
        }
        return $pass;
    }
    
    public function logginWithSession($clave) {
        $consulta = "SELECT IdSession, FechaCreacion, IdUsuario FROM c_session WHERE ClaveSession = '$clave' AND Activo = 1;";
        $catalogo = new Catalogo();
        if (isset($this->empresa)) {
            $catalogo->setEmpresa($this->empresa);
        }
        $result = $catalogo->obtenerLista($consulta);

        if (mysql_num_rows($result) > 0) {//Si existe una session activa para esa clave            
            $parametros = new Parametros();
            if (isset($this->empresa)) {
                $parametros->setEmpresa($this->empresa);
            }
            //Obtenemos el maximo de minutos que una session puede estar activa
            $max_minute = 240; //Valor por default
            if ($parametros->getRegistroById(6)) {//Valor configurado en la bd
                $max_minute = (int) $parametros->getValor();
            }

            while ($rs = mysql_fetch_array($result)) {//Recorremos la session activa
                $consulta = "SELECT TIMESTAMPDIFF(MINUTE,'" . $rs['FechaCreacion'] . "',NOW()) AS Time;";
                $resultTime = $catalogo->obtenerLista($consulta);
                while ($rs2 = mysql_fetch_array($resultTime)) {
                    $tiempo_transcurrido = (int) $rs2['Time'];
                    if ($tiempo_transcurrido > $max_minute) {//Si la session ha estado activa mas del tiempo permitido
                        $consulta = "UPDATE c_session SET Activo = 0 WHERE IdUsuario = " . $rs['IdUsuario'] . ";";
                        $catalogo->obtenerLista($consulta);
                        return -2;
                    } else {//Si la session sigue activa correctamente
                        return $rs['IdUsuario'];
                    }
                }
                return -3;
            }
        } else {//Esta clave ya no esta activa
            return -1;
        }
    }

    
    function revalidarSesion($IdSession){
        $consulta = "SELECT IdUsuario FROM `c_session` WHERE ClaveSession = '$IdSession' AND Activo = 1;";
        $catalogo = new Catalogo();
        if (isset($this->empresa)) {
            $catalogo->setEmpresa($this->empresa);
        }
        $result = $catalogo->obtenerLista($consulta);
        if(mysql_num_rows($result) > 0){            
            while($rs = mysql_fetch_array($result)){                
                $this->id_usu = $rs['IdUsuario'];                
                $respuesta = $this->generarClaveSession(32,$IdSession);
                $respuesta['IdUsuario'] = $this->getId_usu();                
                return $respuesta;
            }
        }else{
            return -1;
        }
    }
    
    public function getId_usu() {
        return $this->id_usu;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getId_empresa() {
        return $this->id_empresa;
    }

    public function getNombre_empresa() {
        return $this->nombre_empresa;
    }

    public function setNombre_empresa($nombre_empresa) {
        $this->nombre_empresa = $nombre_empresa;
    }

    public function getEmpresa() {
        return $this->empresa;
    }

    public function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    function setId_usu($id_usu) {
        $this->id_usu = $id_usu;
    }


}

?>
