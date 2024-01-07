<?php

include_once("Conexion.class.php");

require 'PHPMailer/PHPMailerAutoload.php';
/**
 * Description of Mail
 *
 * @author MAGG
 */
class Mail {

    private $from;
    private $to;
    private $subject;
    private $body;
    private $attachPDF;
    private $attachXML;

    function enviarMail_recuperar_password($usuario,$correo) {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth = true;
        $db = new Conexion();
        $db->Conectar();

        $query_lista = "SELECT param.Valor FROM c_parametros param
        WHERE param.Parametro = 'correo_recuperar_contrasena'";

        $result1 = $db->Ejecutar($query_lista);

        while($row = mysqli_fetch_array($result1)){
            $valor = $row['Valor'];
            $valor_array = explode(',',$valor);
            $mail->SMTPSecure = $valor_array[0];
            $mail->Host  = $valor_array[1];
            $mail->Port = $valor_array[2];

            $mail->Username = $valor_array[3];
            $mail->Password = $valor_array[4];

          }

          // $mail->SMTPKeepAlive = true;
          // $mail->Mailer = "smtp";
          //$mail->Port = 465;//$valor_array[2];

          $query_lista = "SELECT param.Valor FROM c_parametros param
          WHERE param.Parametro = 'recuperar_contrasena_liga'";

          $result1 = $db->Ejecutar($query_lista);
          while($r = mysqli_fetch_array($result1)){
            $liga = $r['Valor'];
          }

            //datos de parametros

        $mail->setFrom($mail->Username, 'notificaciones');

        $mail->addAddress($correo,'');
        $mail->Subject = "Recuperar contraseña SIE MUSEO";

        $enconde = base64_encode($usuario);

        $mail->msgHTML("<br/><br/>Para cambiar la contraseña click en el siguiente enlace "
                   ."<a href='".$liga."reset.php?t=" . $enconde."' >Click aqui !</a>");
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $db->Desconectar();
        if($mail->send()){
            return true;
        }else{
            return $mail->ErrorInfo;
        }
        // foreach ($this->to as $value) {
        //     $mail->addAddress($value);
        // }

        /*Poner el nombre de la empresa en los correos*/






        // Activo condificacción utf-8


   //      $mail->SMTPOptions = array(
   //     'ssl' => array(
   //         'verify_peer' => false,
   //         'verify_peer_name' => false,
   //         'allow_self_signed' => true
   //     )
   // );


    }



    public function getAttachPDF() {
        return $this->attachPDF;
    }

    public function getAttachXML() {
        return $this->attachXML;
    }

    public function setAttachPDF($attachPDF) {
        $this->attachPDF = $attachPDF;
    }

    public function setAttachXML($attachXML) {
        $this->attachXML = $attachXML;
    }

    public function getFrom() {
        return $this->from;
    }

    public function setFrom($from) {
        $this->from = $from;
    }

    public function getTo() {
        return $this->to;
    }

    public function setTo($to) {
        $this->to = $to;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }

    public function getBody() {
        return $this->body;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    function generaPass() {
        //Se define una cadena de caractares. Te recomiendo que uses esta.
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        //Obtenemos la longitud de la cadena de caracteres
        $longitudCadena = strlen($cadena);

        //Se define la variable que va a contener la contraseña
        $pass = "";
        //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
        $longitudPass = 12;

        //Creamos la contraseña
        for ($i = 1; $i <= $longitudPass; $i++) {
            //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
            $pos = rand(0, $longitudCadena - 1);

            //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
            $pass .= substr($cadena, $pos, 1);
        }
        return $pass;
    }

    /**
     * Funcion para saber si el id de correo y la clave existen y aun no han sido contestados.
     * @param type $id id del correo enviado
     * @param type $clave clave enviada
     * @return boolean true en caso de existir y no ser contestada, false en caso contrario
     */
    function getClaveGeneralByIDClave($id, $clave) {
        $consulta = ("SELECT * FROM `c_mailgeneral` WHERE id_mail = $id AND clave = MD5('$clave') AND contestada = 0;");
        $catalogo = new Catalogo();
        if(isset($this->empresa)){
            $catalogo->setEmpresa($this->empresa);
        }
        $query = $catalogo->obtenerLista($consulta);
        if (mysql_num_rows($query) > 0) {
            return true;
        }
        return false;
    }

    /**
     * Marca el mail especificado como leido para que no se pueda volver a usar.
     * @param type $id id del mail a cambiar
     * @return boolean true en caso de poder hacer el cambio, false en caso contrario.
     */
    function marcarContestado($id) {
		$tabla = "c_mailgeneral";
		$where = "id_mail = $id";
        $consulta = ("UPDATE `$tabla` SET contestada = 1 WHERE $where;");
        $catalogo = new Catalogo();
        if(isset($this->empresa)){
            $catalogo->setEmpresa($this->empresa);
        }
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, $tabla, $where);
        if ($query == "1") {
            return true;
        }
        return false;
    }


}

?>
