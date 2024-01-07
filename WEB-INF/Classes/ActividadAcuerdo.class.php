<?php

include_once("Catalogo.class.php");

class actividades {

    private $id_acuerdoactividad;
    private $id_acuerdo;
    private $id_proyecto;
    private $id_exposicion;
    private $id_actividad1;
    private $id_actividad2;
    private $id_actividad3;
    private $id_actividad4;
    private $id_tipo;
    private $resolucion;
    private $realizado_act;
    private $id_categoria;
    private $id_subcategoria;
    private $descripcion_acuerdo;
    private $tipo_acuerdo;
    private $check;
    private $subcheck;
    private $acuerdoestatus;
    private $responsableacuerdo;
    private $fechacompromiso;

    //tamaños actividades
    private $tamanoArt;
    private $tamanoArtedit;

    public function getActividades() {
        $catalogo = new Catalogo();
       $consultaAcuerdo = "SELECT * FROM k_acuerdoactividad WHERE k_acuerdoactividad.id_acuerdo = " . $this->id_acuerdo;
        $resultAcuerdo = $catalogo->obtenerLista($consultaAcuerdo);
        return $resultAcuerdo;
    }

    public function getActividadesTodos() {
        $catalogo = new Catalogo();
        $consultaAcuerdo = "SELECT ka.id_acuerdoactividad, ka.id_acuerdo, ka.id_proyecto, ka.id_exposicion, ka.id_actividad1, ka.id_actividad2, ka.id_actividad3, ka.id_actividad4, ka.id_tipo, ka.resolucion, 
       ka.estatus, ka.id_categoria, ka.id_subcategoria, ka.DescAcuerdo, ka.TipoAcuerdo, ka.Id_check, ka.subcheck, ka.Id_acuerdoestatus, ka.Id_persona, CONCAT(ps.Nombre, ' ', ps.Apellido_Paterno, ' ', ps.Apellido_Materno)AS nombre, an.Periodo, ka.firma, ka.fechacompromiso, ca.id_area
       FROM k_acuerdoactividad ka
       INNER JOIN c_acuerdospdf ca ON ca.id_acuerdo_escrito = ka.id_acuerdo
       INNER JOIN c_periodo AS an ON an.Id_Periodo = ca.anio 
       INNER JOIN c_personas AS ps ON ps.id_Personas = ka.Id_persona
       WHERE " . $this->ejeanioTodos ." " . $this->ejeidTodos . " ORDER BY ka.id_acuerdoactividad desc";
        $resultAcuerdoTodos = $catalogo->obtenerLista($consultaAcuerdo);
        return $resultAcuerdoTodos;
    }

    public function getActividadesTodosFiltro() {
        $catalogo = new Catalogo();
       $consultaAcuerdo = "SELECT ka.id_acuerdoactividad, ka.id_acuerdo, ka.id_proyecto, ka.id_exposicion, ka.id_actividad1, ka.id_actividad2, ka.id_actividad3, ka.id_actividad4, ka.id_tipo, ka.resolucion, 
       ka.estatus, ka.id_categoria, ka.id_subcategoria, ka.DescAcuerdo, ka.TipoAcuerdo, ka.Id_check, ka.subcheck, ka.Id_acuerdoestatus, ka.Id_persona, CONCAT(ps.Nombre, ' ', ps.Apellido_Paterno, ' ', ps.Apellido_Materno)AS nombre, an.Periodo , ka.firma, ka.fechacompromiso, ca.id_area
       FROM k_acuerdoactividad ka
       INNER JOIN c_acuerdospdf ca ON ca.id_acuerdo_escrito = ka.id_acuerdo
       INNER JOIN c_periodo AS an ON an.Id_Periodo = ca.anio 
       INNER JOIN c_personas AS ps ON ps.id_Personas = ka.Id_persona
       WHERE " . " ". $this->ejeanioTodos . $this->ejeidTodos . " and ka.Id_acuerdoestatus =" . $this->filtroTodos . " ORDER BY ka.id_acuerdoactividad desc";
        $resultAcuerdoTodos = $catalogo->obtenerLista($consultaAcuerdo);
        return $resultAcuerdoTodos;
    }

    public function acuerdoac() {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO k_acuerdoactividad(id_acuerdo,id_proyecto,id_exposicion,id_actividad1,id_actividad2,id_actividad3,id_actividad4,id_tipo,resolucion,estatus,id_categoria,id_subcategoria,DescAcuerdo,TipoAcuerdo,Id_check,subcheck,Id_acuerdoestatus,Id_persona)
                VALUES(  $this->id_acuerdo  , $this->id_proyecto , $this->id_exposicion , $this->id_actividad1 , $this->id_actividad2 , $this->id_actividad3 , $this->id_actividad4 , $this->id_tipo ,' $this->resolucion ',$this->realizado_act,$this->id_categoria,$this->id_subcategoria,'$this->descripcion_acuerdo','$this->tipo_acuerdo',$this->check,$this->subcheck,$this->acuerdoestatus,$this->responsableacuerdo);";
        $this->id_acuerdoactividad = $catalogo->insertarRegistro($insert);
        //echo "<br><br>$insert<br><br>";
        //$this->AgregarAreaInvitadaAct($this->responsableacuerdo);
        if ($this->id_acuerdoactividad == 0 || $this->id_acuerdoactividad == null) {
            return false;
        }
        return true;
    }

    public function editaractividades() {
        $catalogo = new Catalogo();
        $consulta = "UPDATE k_acuerdoactividad SET id_proyecto=$this->id_proyecto,id_exposicion=$this->id_exposicion,id_actividad1=$this->id_actividad1,id_actividad2=$this->id_actividad2,id_actividad3=$this->id_actividad3,id_actividad4=$this->id_actividad4,id_tipo=$this->id_tipo,id_categoria=$this->id_categoria,id_subcategoria=$this->id_subcategoria,resolucion='$this->resolucion',estatus=$this->realizado_act,DescAcuerdo='$this->descripcion_acuerdo',TipoAcuerdo='$this->tipo_acuerdo',Id_check=$this->check,subcheck=$this->subcheck,Id_acuerdoestatus=$this->acuerdoestatus,Id_persona=$this->responsableacuerdo WHERE id_acuerdoactividad = $this->id_acuerdoactividad;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'k_acuerdoactividad', 'id_acuerdoactividad = ' . $this->id_acuerdoactividad);
        //echo "<br><br>$consulta<br><br>";
        $count = 0;
        $validafirmasexisten = "SELECT Id_acuerdoestatus FROM k_acuerdoactividad WHERE id_Acuerdo =$this->id_acuerdo;";
        $resulvalida = $catalogo->obtenerLista($validafirmasexisten);
        //echo $validafirmasexisten;
        while ($row = mysqli_fetch_array($resulvalida)) {
        //echo $row['estatus']."<br>";
        if($row['Id_acuerdoestatus'] != "2"){
        //echo "faltan";
        $query="UPDATE c_acuerdospdf SET estatus = 0, fecha_realizado=NULL where id_acuerdo_escrito=".$this->id_acuerdo;
        //echo $query;
        $query = $catalogo->ejecutaConsultaActualizacion($query, 'c_acuerdospdf', 'id_acuerdo_escrito='.$this->id_acuerdo);
        }else{
        //echo "<br>esta lleno";
        $count++;
        $validallenadopdf = "SELECT count(*) as total FROM k_acuerdoactividad WHERE id_Acuerdo=$this->id_acuerdo;";
        $resul = $catalogo->obtenerLista($validallenadopdf);
        while ($row = mysqli_fetch_array($resul)) {
          $totalregistros = $row['total'];
        }
        //echo $totalregistros;
        if ($count == $totalregistros){
        $query="UPDATE c_acuerdospdf SET estatus = 1, fecha_realizado= NOW() where id_acuerdo_escrito=".$this->id_acuerdo;
        //echo $query;
        $query = $catalogo->ejecutaConsultaActualizacion($query, 'c_acuerdospdf', 'id_acuerdo_escrito='.$this->id_acuerdo);
        }
    }
    }
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function editaractividadesuno() {
        $catalogo = new Catalogo();

        $consulta = "UPDATE k_acuerdoactividad SET 
        DescAcuerdo='$this->descripcion_acuerdo',
        id_tipo='$this->id_tipo',
        TipoAcuerdo='$this->tipo_acuerdo',
        id_proyecto='$this->id_proyecto',
        id_categoria='$this->id_categoria',
        Id_persona=$this->responsableacuerdo,
        resolucion='$this->resolucion',
        fechacompromiso='$this->fechacompromiso',
        Id_acuerdoestatus='$this->acuerdoestatus'
        where id_acuerdoactividad = '$this->id_acuerdoactividad'";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'k_acuerdoactividad', 'id_acuerdoactividad = ' . $this->id_acuerdoactividad);

        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function Eliminaractividad() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM k_acuerdoactividad WHERE id_acuerdo = $this->id_acuerdo;";
        // echo "<br><br>$consulta<br><br>";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "k_acuerdoactividad", "id_acuerdo = " . $this->id_acuerdo);
        if ($query == 1) {
            return true;
        }
        return false;
    }


    public function Eliminaractividadedit() {
        $catalogo = new Catalogo();
        $idrecuperadoacuerdo="";
        
        //actualiza campos de destino
        $validafirmasexisten = "SELECT id_acuerdo FROM k_acuerdoactividad WHERE id_acuerdoactividad =$this->id_acuerdoactividad;";
        $resulvalida = $catalogo->obtenerLista($validafirmasexisten);
        //echo $validafirmasexisten;
        while ($row = mysqli_fetch_array($resulvalida)) {
            $idrecuperadoacuerdo=$row['id_acuerdo'];
        }


        $consultaactualizar = "UPDATE c_acuerdospdf SET id_destino=$this->tamanoArt  WHERE id_acuerdo_escrito = $idrecuperadoacuerdo;";
        //echo $consultaactualizar;
        $query = $catalogo->ejecutaConsultaActualizacion($consultaactualizar, 'c_acuerdospdf', 'id_acuerdo_escrito = ' . $idrecuperadoacuerdo);


        $consulta = "DELETE FROM k_acuerdoactividad WHERE id_acuerdoactividad = $this->id_acuerdoactividad;";
        // echo "<br><br>$consulta<br><br>";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "k_acuerdoactividad", "id_acuerdoactividad = " . $this->id_acuerdoactividad);


        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function editarcheck() {
        $catalogo = new Catalogo();
        $consulta = "UPDATE k_acuerdoactividad SET id_proyecto=$this->id_proyecto,id_exposicion=$this->id_exposicion,id_actividad1=$this->id_actividad1,id_actividad2=$this->id_actividad2,id_actividad3=$this->id_actividad3,id_actividad4=$this->id_actividad4,id_tipo=$this->id_tipo,id_categoria=$this->id_categoria,id_subcategoria=$this->id_subcategoria,resolucion='$this->resolucion',estatus=$this->realizado_act,DescAcuerdo='$this->descripcion_acuerdo',TipoAcuerdo='$this->tipo_acuerdo',Id_check=$this->check,subcheck=$this->subcheck,Id_acuerdoestatus=$this->acuerdoestatus,Id_persona=$this->responsableacuerdo WHERE id_acuerdoactividad = $this->id_acuerdoactividad;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'k_acuerdoactividad', 'id_acuerdoactividad = ' . $this->id_acuerdoactividad);
        //echo "<br><br>$consulta<br><br>";
        $count = 0;
        $validafirmasexisten = "SELECT Id_acuerdoestatus FROM k_acuerdoactividad WHERE id_Acuerdo =$this->id_acuerdo;";
        $resulvalida = $catalogo->obtenerLista($validafirmasexisten);
        //echo $validafirmasexisten;
        while ($row = mysqli_fetch_array($resulvalida)) {
        //echo $row['estatus']."<br>";
        if($row['Id_acuerdoestatus'] != "2"){
        $query="UPDATE c_acuerdospdf SET estatus = 0, fecha_realizado=NULL where id_acuerdo_escrito=".$this->id_acuerdo;
        //echo $query;
        $query = $catalogo->ejecutaConsultaActualizacion($query, 'c_acuerdospdf', 'id_acuerdo_escrito='.$this->id_acuerdo);
        }else{
        //echo "<br>esta lleno";
        $count++;
        $validallenadopdf = "SELECT count(*) as total FROM k_acuerdoactividad WHERE id_Acuerdo=$this->id_acuerdo;";
        $resul = $catalogo->obtenerLista($validallenadopdf);
        while ($row = mysqli_fetch_array($resul)) {
          $totalregistros = $row['total'];
        }
        //echo $totalregistros;
        if ($count == $totalregistros){
        $query="UPDATE c_acuerdospdf SET estatus = 1, fecha_realizado= NOW() where id_acuerdo_escrito=".$this->id_acuerdo;
        //echo $query;
        $query = $catalogo->ejecutaConsultaActualizacion($query, 'c_acuerdospdf', 'id_acuerdo_escrito='.$this->id_acuerdo);
        }
    }
    }
        if ($query == 1) {
            return true;
        }
        return false;
    }


    //ingresar en areas por responsable
    public function agregarAreaInvitadaAct(){
        $idconsulta="";
        $obtenerarearesponsable="";
        $catalogo = new Catalogo();
        $consulta="SELECT MAX(id_acuerdo_escrito) AS id FROM c_acuerdospdf";
        $resultado = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            $idconsulta=$row['id'];
        }

        $consulta3="SELECT distinct a.Id_Area,a.Nombre FROM c_personas as p 
        JOIN c_area a ON a.Id_Area=p.idArea
        WHERE a.tipoArea=1 AND a.estatus=1 AND p.id_Personas=".$this->responsableacuerdo;
        $resultado3 = $catalogo->obtenerLista($consulta3);
        while ($row3 = mysqli_fetch_array($resultado3)) {
            $obtenerarearesponsable=$row3['Id_Area'];
        }

        $insert2 = "INSERT INTO k_acuerdoarea(id_Acuerdo,id_Area_invitada,firma)
            VALUES( " . $idconsulta . "," . $obtenerarearesponsable . ",null);";
        $this->id_acuerdoactividad = $catalogo->insertarRegistro($insert2);
    if ($this->id_acuerdoactividad == 0 || $this->id_acuerdoactividad == null) {
            return false;
        }
        return true;
    }

    function getId_acuerdoactividad() {
        return $this->id_acuerdoactividad;
    }

    function getId_acuerdo() {
        return $this->id_acuerdo;
    }

    function getId_proyecto() {
        return $this->id_proyecto;
    }

    function getId_exposicion() {
        return $this->id_exposicion;
    }

    function getId_actividad1() {
        return $this->id_actividad1;
    }

    function getId_actividad2() {
        return $this->id_actividad2;
    }

    function getId_actividad3() {
        return $this->id_actividad3;
    }

    function getId_actividad4() {
        return $this->id_actividad4;
    }

    function getId_tipo() {
        return $this->id_tipo;
    }

    function getResolucion() {
        return $this->resolucion;
    }

    function getdescripcion_categoria() {
        return $this->descripcion_categoria;
    }

    function getcheck() {
        return $this->check;
    }

    function getsubcheck() {
        return $this->subcheck;
    }

    function getacuerdoestatus() {
        return $this->acuerdoestatus;
    }

    function getresponsableacuerdo() {
        return $this->responsableacuerdo;
    }

    function getTamanoArt() {
        return $this->tamanoArt;
    }

    function getTamanoArtedit() {
        return $this->tamanoArtedit;
    }

    function setresponsableacuerdo($responsableacuerdo) {
        $this->responsableacuerdo = $responsableacuerdo;
    }
  
    function setId_acuerdoactividad($id_acuerdoactividad) {
        $this->id_acuerdoactividad = $id_acuerdoactividad;
    }

    function setId_acuerdo($id_acuerdo) {
        $this->id_acuerdo = $id_acuerdo;
    }

    function setejeidTodos($ejeidTodos) {
        $this->ejeidTodos = $ejeidTodos;
    }

    function setejeanioTodos($ejeanioTodos) {
        $this->ejeanioTodos = $ejeanioTodos;
    }

    function setfiltroTodos($filtroTodos) {
        $this->filtroTodos = $filtroTodos;
    }

    function setId_proyecto($id_proyecto) {
        $this->id_proyecto = $id_proyecto;
    }

    function setId_exposicion($id_exposicion) {
        $this->id_exposicion = $id_exposicion;
    }

    function setId_actividad1($id_actividad1) {
        $this->id_actividad1 = $id_actividad1;
    }

    function setId_actividad2($id_actividad2) {
        $this->id_actividad2 = $id_actividad2;
    }

    function setId_actividad3($id_actividad3) {
        $this->id_actividad3 = $id_actividad3;
    }

    function setId_actividad4($id_actividad4) {
        $this->id_actividad4 = $id_actividad4;
    }

    function setId_tipo($id_tipo) {
        $this->id_tipo = $id_tipo;
    }

    function setResolucion($resolucion) {
        $this->resolucion = $resolucion;
    }

    function setfechacompromiso($fechacompromiso) {
        $this->fechacompromiso = $fechacompromiso;
    }

    function setdescripcion_acuerdo($descripcion_acuerdo) {
        $this->descripcion_acuerdo = $descripcion_acuerdo;
    }

    function settipo_acuerdo($tipo_acuerdo) {
        $this->tipo_acuerdo = $tipo_acuerdo;
    }

    function setcheck($check) {
        $this->check = $check;
    }

    function setsubcheck($subcheck) {
        $this->subcheck = $subcheck;
    }

    function setacuerdoestatus($acuerdoestatus) {
        $this->acuerdoestatus = $acuerdoestatus;
    }

    function setTamanoArt($tamanoArt) {
        $this->tamanoArt = $tamanoArt;
    }

    function setTamanoArtedit($tamanoArtedit) {
        $this->tamanoArtedit = $tamanoArtedit;
    }

    /**
     * Get the value of realizado_act
     */ 
    public function getRealizado_act()
    {
        return $this->realizado_act;
    }

    /**
     * Set the value of realizado_act
     *
     * @return  self
     */ 
    public function setRealizado_act($realizado_act)
    {
        $this->realizado_act = $realizado_act;

        return $this;
    }

    /**
     * Get the value of id_categoria
     */ 
    public function getId_categoria()
    {
        return $this->id_categoria;
    }

    /**
     * Set the value of id_categoria
     *
     * @return  self
     */ 
    public function setId_categoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;

        return $this;
    }

    /**
     * Get the value of id_subcategoria
     */ 
    public function getId_subcategoria()
    {
        return $this->id_subcategoria;
    }

    /**
     * Set the value of id_subcategoria
     *
     * @return  self
     */ 
    public function setId_subcategoria($id_subcategoria)
    {
        $this->id_subcategoria = $id_subcategoria;

        return $this;
    }
}