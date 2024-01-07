<?php

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Catalogo.class.php");
include_once("Conexion.class.php");

class Institucion2 {

    private $Id_institucion;
    private $Nombre;
    private $Foto;
    private $Id_pais;
    private $Id_sector;
    private $Id_giro;
    private $Id_subgiro;
    private $Id_dependencia;
    private $Calle;
    private $Numeroe;
    private $Numeroi;
    private $Colonia;
    private $Id_ciudad;
    private $Id_estado;
    private $Id_Municipio;
    private $Codigopostal;
    private $Longitud;
    private $Latitud;
    private $Correo;
    private $Telefono;
    private $Extension;
    private $Documentofiscal;
    private $Pdfcedulafiscal;
    private $Rfc;
    private $Facebook;
    private $Instagram;
    private $Twitter;
    private $Paginaweb;
    private $UsuarioCreacion;
    private $FechaCreacion;
    private $UsuarioUltimaModificacion;
    private $FechaUltimaModificacion;
    private $Pantalla;

    //Roles
    private $Rol;
    private $Id_rolInstitucion;

    public function getInstitucion() {
        $catalogo = new Catalogo();
        $consultaInstitucion = "SELECT * FROM c_institucion WHERE c_institucion.Id_institucion = " . $this->Id_institucion;
        $resultInstitucion = $catalogo->obtenerLista($consultaInstitucion);
        while ($row = mysqli_fetch_array($resultInstitucion)) {
            $this->Nombre = $row['Nombre'];
            $this->Foto = $row['Logo'];
            $this->Id_pais = $row['Id_pais'];
            $this->Id_sector = $row['Id_sector'];
            $this->Id_giro = $row['Id_giro'];
            $this->Id_subgiro = $row['Id_subgiro'];
            $this->Id_dependencia = $row['Id_dependencia'];
            $this->Calle = $row['Calle'];
            $this->Numeroe = $row['Numeroe'];
            $this->Numeroi = $row['Numeroi'];
            $this->Colonia = $row['Colonia'];
            $this->Id_ciudad = $row['Id_ciudad'];
            $this->Id_estado = $row['Id_estado'];
            $this->Id_Municipio = $row['Id_Municipio'];
            $this->Codigopostal = $row['Codigopostal'];
            $this->Latitud = $row['Latitud'];
            $this->Longitud = $row['Longitud'];
            $this->Correo = $row['Correo'];
            $this->Telefono = $row['Telefono'];
            $this->Extension = $row['Extension'];
            $this->Documentofiscal = $row['Id_DocFi'];
            $this->Pdfcedulafiscal = $row['Pdfcedulafiscal'];
            $this->Rfc = $row['Rfc'];
            $this->Facebook = $row['Facebook'];
            $this->Instagram = $row['Instagram'];
            $this->Twitter = $row['Twitter'];
            $this->Paginaweb = $row['Paginaweb'];
            $this->UsuarioCreacion = $row['usuarioCreacion'];
            $this->FechaCreacion = $row['FechaCreacion'];
            $this->UsuarioUltimaModificacion = $row['usuarioUltimaModificacion'];
            $this->FechaUltimaModificacion = $row['fechaUltimaModificacion'];
            $this->Pantalla = $row['pantalla'];
            return true;
        }
        return false;
    }
    public function obtenerRegFiscal (){
        $catalogo = new Catalogo();
        $consultaInstitucion = "SELECT ci.Nombre,cdf.nombre as docFiscal FROM c_institucion AS ci
        INNER JOIN c_documentofiscal AS cdf ON cdf.Id_docf = ci.Id_DocFi  WHERE ci.Id_institucion = " . $this->Id_institucion;
        //echo "<br>$consultaInstitucion<br>";
        $resultInstitucion = $catalogo->obtenerLista($consultaInstitucion);
        while ($row = mysqli_fetch_array($resultInstitucion)) {
            $this->Documentofiscal = $row['docFiscal'];
        }
    }
    public function obtenerRol(){
        $catalogo = new Catalogo();
        $rolArray = array();
        $consulta ="SELECT Id_Institucion,Id_rol FROM `c_rolInstitucion` WHERE Id_Institucion = ".$this->Id_institucion;
        //echo $consulta;
        $result = $catalogo->obtenerLista($consulta);
            while ($row = mysqli_fetch_array($result)) {
                array_push($rolArray,$row['Id_rol']);
            }
         return $rolArray;
    }

    public function nuevaInstitucion() {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO c_institucion(Nombre,Logo,Id_pais,Id_sector,Id_giro,Id_subgiro,Id_dependencia,Calle,Numeroe,Numeroi,Colonia,Id_ciudad,Id_estado,Id_Municipio,Codigopostal,Latitud,Longitud,Correo,Telefono,Extension,Id_DocFi,Pdfcedulafiscal,Rfc,Facebook,Instagram,Twitter,Paginaweb,usuarioCreacion,fechaCreacion,usuarioUltimaModificacion,fechaUltimaModificacion,pantalla)
            VALUES('" . $this->Nombre . "','" . $this->Foto . "'," . $this->Id_pais . "," . $this->Id_sector . "," . $this->Id_giro . "," . $this->Id_subgiro . "," . $this->Id_dependencia . ",'" . $this->Calle . "','" . $this->Numeroe . "','" . $this->Numeroi . "','" . $this->Colonia . "','" . $this->Id_ciudad . "'," . $this->Id_estado . ",".$this->Id_Municipio.",'" . $this->Codigopostal . "','".$this->Latitud."','".$this->Longitud."','" . $this->Correo . "','" . $this->Telefono . "','" . $this->Extension . "'," . $this->Documentofiscal . ",'" . $this->Pdfcedulafiscal . "','" . $this->Rfc . "','" . $this->Facebook . "','" . $this->Instagram . "','" . $this->Twitter . "','" . $this->Paginaweb . "','$this->UsuarioCreacion',now(),'$this->UsuarioUltimaModificacion',now(),'$this->Pantalla');";
        $this->Id_institucion = $catalogo->insertarRegistro($insert);
        //echo "<br><br>$insert<br><br>";
        if ($this->Id_institucion == 0 || $this->Id_institucion == null) {
            return false;
        }
        return true;
    }

    public function agregarRol(){

        $insert ="INSERT INTO c_rolInstitucion (Id_Institucion,Id_rol) VALUES (".$this->Id_institucion.",".$this->Rol.");";

        $catalogo = new Catalogo();
        //echo "<br>ROL: ".$insert."<br>";
        $this->Id_rolInstitucion = $catalogo->insertarRegistro($insert);

        if ($this->Id_rolInstitucion == 0 || $this->Id_rolInstitucion == null) {
            return false;
        }
        return true;
    }

    public function editarinstitucion() {
        $catalogo = new Catalogo();
        $consulta = "UPDATE c_institucion SET Nombre='" . $this->Nombre . "',Logo='" . $this->Foto . "',Id_pais=" . $this->Id_pais . ",Id_sector=" . $this->Id_sector . ",Id_giro=" . $this->Id_giro . ",Id_subgiro=" . $this->Id_subgiro . ",Id_dependencia=" . $this->Id_dependencia . ",Calle='" . $this->Calle . "',Numeroe='" . $this->Numeroe . "',Numeroi='" . $this->Numeroi . "',Colonia='" . $this->Colonia . "',Id_ciudad='" . $this->Id_ciudad . "',Id_estado=" . $this->Id_estado . ",Id_Municipio=".$this->Id_Municipio.",Codigopostal='" . $this->Codigopostal ."',Latitud='".$this->Latitud ."',Longitud='".$this->Longitud."',Correo='" . $this->Correo . "',Telefono='" . $this->Telefono . "',Extension='" . $this->Extension . "',Id_DocFi=" . $this->Documentofiscal . ",Pdfcedulafiscal='" . $this->Pdfcedulafiscal . "',Rfc='" . $this->Rfc . "',Facebook='" . $this->Facebook . "',Instagram='" . $this->Instagram . "',Twitter='" . $this->Twitter . "',Paginaweb='" . $this->Paginaweb . "',UsuarioUltimaModificacion = '" . $this->UsuarioUltimaModificacion . "', FechaUltimaModificacion = NOW() WHERE Id_institucion = $this->Id_institucion;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_institucion', 'Id_institucion = ' . $this->Id_institucion);
       //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function editarinstitucion2() {
        $catalogo = new Catalogo();
        $consulta = "UPDATE c_institucion SET Correo='" . $this->Correo  . "',Telefono='" . $this->Telefono. "',Id_DocFi=" . $this->Documentofiscal . ",UsuarioUltimaModificacion = '" . $this->UsuarioUltimaModificacion . "', FechaUltimaModificacion = NOW() WHERE Id_institucion = $this->Id_institucion;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_institucion', 'Id_institucion = ' . $this->Id_institucion);
       //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function eliminarInstitucion() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM c_institucion WHERE Id_institucion = $this->Id_institucion;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "c_institucion", "Id_institucion = " . $this->Id_institucion);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function eliminarRol(){
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM c_rolInstitucion WHERE Id_Institucion =". $this->Id_institucion.";";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "c_rolInstitucion", "Id_Institucion = " . $this->Id_institucion);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    function getId_institucion() {
        return $this->Id_institucion;
    }

    function getNombre() {
        return $this->Nombre;
    }

    function getFoto() {
        return $this->Foto;
    }

    function getId_pais() {
        return $this->Id_pais;
    }

    function getId_sector() {
        return $this->Id_sector;
    }

    function getId_giro() {
        return $this->Id_giro;
    }

    function getId_subgiro() {
        return $this->Id_subgiro;
    }

    function getId_dependencia() {
        return $this->Id_dependencia;
    }

    function getCalle() {
        return $this->Calle;
    }

    function getNumeroe() {
        return $this->Numeroe;
    }

    function getNumeroi() {
        return $this->Numeroi;
    }

    function getColonia() {
        return $this->Colonia;
    }

    function getId_ciudad() {
        return $this->Id_ciudad;
    }

    function getId_estado() {
        return $this->Id_estado;
    }

    function getCodigopostal() {
        return $this->Codigopostal;
    }

    function getCorreo() {
        return $this->Correo;
    }

    function getTelefono() {
        return $this->Telefono;
    }

    function getExtension() {
        return $this->Extension;
    }

    function getDocumentofiscal() {
        return $this->Documentofiscal;
    }

    function getPdfcedulafiscal() {
        return $this->Pdfcedulafiscal;
    }

    function getRfc() {
        return $this->Rfc;
    }

    function getFacebook() {
        return $this->Facebook;
    }

    function getInstagram() {
        return $this->Instagram;
    }

    function getTwitter() {
        return $this->Twitter;
    }

    function getPaginaweb() {
        return $this->Paginaweb;
    }

    function getUsuarioCreacion() {
        return $this->UsuarioCreacion;
    }

    function getFechaCreacion() {
        return $this->FechaCreacion;
    }

    function getUsuarioUltimaModificacion() {
        return $this->UsuarioUltimaModificacion;
    }

    function getFechaUltimaModificacion() {
        return $this->FechaUltimaModificacion;
    }

    function getPantalla() {
        return $this->Pantalla;
    }

    function setId_institucion($Id_institucion) {
        $this->Id_institucion = $Id_institucion;
    }

    function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    function setFoto($Foto) {
        $this->Foto = $Foto;
    }

    function setId_pais($Id_pais) {
        $this->Id_pais = $Id_pais;
    }

    function setId_sector($Id_sector) {
        $this->Id_sector = $Id_sector;
    }

    function setId_giro($Id_giro) {
        $this->Id_giro = $Id_giro;
    }

    function setId_subgiro($Id_subgiro) {
        $this->Id_subgiro = $Id_subgiro;
    }

    function setId_dependencia($Id_dependencia) {
        $this->Id_dependencia = $Id_dependencia;
    }

    function setCalle($Calle) {
        $this->Calle = $Calle;
    }

    function setNumeroe($Numeroe) {
        $this->Numeroe = $Numeroe;
    }

    function setNumeroi($Numeroi) {
        $this->Numeroi = $Numeroi;
    }

    function setColonia($Colonia) {
        $this->Colonia = $Colonia;
    }

    function setId_ciudad($Id_ciudad) {
        $this->Id_ciudad = $Id_ciudad;
    }

    function setId_estado($Id_estado) {
        $this->Id_estado = $Id_estado;
    }

    function setCodigopostal($Codigopostal) {
        $this->Codigopostal = $Codigopostal;
    }

    function setCorreo($Correo) {
        $this->Correo = $Correo;
    }

    function setTelefono($Telefono) {
        $this->Telefono = $Telefono;
    }

    function setExtension($Extension) {
        $this->Extension = $Extension;
    }

    function setDocumentofiscal($Documentofiscal) {
        $this->Documentofiscal = $Documentofiscal;
    }

    function setPdfcedulafiscal($Pdfcedulafiscal) {
        $this->Pdfcedulafiscal = $Pdfcedulafiscal;
    }

    function setRfc($Rfc) {
        $this->Rfc = $Rfc;
    }

    function setFacebook($Facebook) {
        $this->Facebook = $Facebook;
    }

    function setInstagram($Instagram) {
        $this->Instagram = $Instagram;
    }

    function setTwitter($Twitter) {
        $this->Twitter = $Twitter;
    }

    function setPaginaweb($Paginaweb) {
        $this->Paginaweb = $Paginaweb;
    }

    function setUsuarioCreacion($UsuarioCreacion) {
        $this->UsuarioCreacion = $UsuarioCreacion;
    }

    function setFechaCreacion($FechaCreacion) {
        $this->FechaCreacion = $FechaCreacion;
    }

    function setUsuarioUltimaModificacion($UsuarioUltimaModificacion) {
        $this->UsuarioUltimaModificacion = $UsuarioUltimaModificacion;
    }

    function setFechaUltimaModificacion($FechaUltimaModificacion) {
        $this->FechaUltimaModificacion = $FechaUltimaModificacion;
    }

    function setPantalla($Pantalla) {
        $this->Pantalla = $Pantalla;
    }
    function getId_Municipio() {
        return $this->Id_Municipio;
    }

    function setId_Municipio($Id_Municipio) {
        $this->Id_Municipio = $Id_Municipio;
    }
 function getLongitud() {
        return $this->Longitud;
    }

    function getLatitud() {
        return $this->Latitud;
    }

    function setLongitud($Longitud) {
        $this->Longitud = $Longitud;
    }

    function setLatitud($Latitud) {
        $this->Latitud = $Latitud;
    }

    function getRol(){
        return $this->Rol;
    }
    function setRol($Rol){
        $this->Rol = $Rol;
    }

    function getidRolp(){
        return $this->Id_rolInstitucion;
    }

    function setidRolp(){
        $this->Id_rolInstitucion = $Id_rolInstitucion;
    }



   }
