<?php

include_once("Catalogo.class.php");

class mosaicos
{

    function tipo_publicacion($tipo)
    {
        $catalogo = new Catalogo();
        $Num_Publicacion = array();
        $consulta = "SELECT p.Nombre,(SELECT COUNT(f.IdLibro) FROM c_formatoLibro as f WHERE f.IdTipoPublicacion=p.IdTipoPublicacion) as total FROM c_tipoPublicacion as p ";
        $resultado = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            array_push($Num_Publicacion, $row['total']);
        }
        return $Num_Publicacion;
    }

    function Autores()
    {
        $catalogo = new Catalogo();
        $Num_Autores = array();
        $Nacional = 0;
        $Internacional = 0;
        $consulta = "SELECT
        p.id_PaisNac,cl.AnioPublicacion
        FROM
            c_personas AS p
            INNER JOIN c_rolPersona AS rp ON rp.id_Persona = p.id_Personas
            INNER JOIN c_textosLibro AS ctl ON p.id_Personas=ctl.id_Personas
            INNER JOIN c_libro AS cl ON ctl.IdLibro=cl.IdLibro
            WHERE rp.id_Rol=133";
        $resultado = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            if ($row['id_PaisNac'] == 117) {
                $Nacional++;
            }
            if ($row['id_PaisNac'] != 0 && $row['id_PaisNac'] != 117) {
                $Internacional++;
            }
        }
        array_push($Num_Autores, $Nacional);
        array_push($Num_Autores, $Internacional);
        return $Num_Autores;
    }
    function Tiraje()
    {
        $catalogo = new Catalogo();
        $Num_Tiraje = array();
        $consulta = "SELECT SUM(TirajeEspanol) español , SUM(TirajeIngles) ingles FROM `c_caracTecnicasLibro`";
        $resultado = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            array_push($Num_Tiraje, $row['español']);
            array_push($Num_Tiraje, $row['ingles']);
        }

        return $Num_Tiraje;
    }
    function Textos()
    {
        $catalogo = new Catalogo();
        $Num_Textos = array();
        $Ineditos = 0;
        $Publicados = 0;
        $consulta = "SELECT ctl.IdLibro, l.Titulo, 
                    SUBSTR(l.AnioPublicacion,1,4) AS Ano, 
                    (SELECT count(ct.Inedito) FROM c_textosLibro ct INNER JOIN c_libro AS cl ON ct.IdLibro=cl.IdLibro WHERE Inedito=0) AS PublicadosAnteriormente, 
                    sum(ctl.Inedito) AS Inedito
                    FROM c_textosLibro AS ctl
                    INNER JOIN c_libro AS l
                    ON ctl.IdLibro=l.IdLibro
					GROUP BY ctl.IdLibro, l.Titulo";
        $resultado = $catalogo->obtenerLista($consulta);
        $row = mysqli_fetch_array($resultado);
        $Publicados = $row['PublicadosAnteriormente'];
        $Ineditos = $row['Inedito'];
 
        array_push($Num_Textos, $Ineditos);
        array_push($Num_Textos, $Publicados);
        return $Num_Textos;
    }
    function Producciones()
    {
        $catalogo = new Catalogo();
        $Num_Producciones = array();
        $MPBA = 0;
        $Co = 0;
        $consulta = "SELECT IdInstitucionesLibro FROM `c_formatoLibro`";
        $resultado = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            if ($row['IdInstitucionesLibro'] == 11) {
                $MPBA++;
            } else {
                $Co++;
            }
        }
        array_push($Num_Producciones, $MPBA);
        array_push($Num_Producciones, $Co);
        return $Num_Producciones;
    }

    function Producciones2()
    {
        $catalogo = new Catalogo();
        $Num_Producciones = array();
        $CONCEPTOINTERNOMPBA = 0;
        $COPRODUCCION = 0;
        $consulta = "SELECT cfl.IdLibro, cfl.IdConceptoLibro, cl.AnioPublicacion, (SELECT COUNT(IdConceptoLibro) 
        FROM c_formatoLibro AS cfl) AS total
        FROM c_formatoLibro AS cfl
        inner join c_tipoConceptoLibro AS ctcl
        ON cfl.IdConceptoLibro=ctcl.IdConceptoLibro
        INNER JOIN c_libro AS cl
        ON cfl.IdLibro=cl.IdLibro";

        $result_name3 = $catalogo->obtenerLista($consulta);
        while ($row3 = mysqli_fetch_array($result_name3)) {
            if($row3['IdConceptoLibro']==1){
                $CONCEPTOINTERNOMPBA +=1;
            }
            if($row3['IdConceptoLibro']==3){
                $COPRODUCCION +=1;
            }
        }
        array_push($Num_Producciones, $CONCEPTOINTERNOMPBA);
        array_push($Num_Producciones, $COPRODUCCION);
        return $Num_Producciones;
    }

    function Premios_ferias()
    {
        $catalogo = new Catalogo();
        $Num_Producciones = array();
        $consulta = "SELECT COUNT(Id_feria) AS feria FROM c_feria";
        $consulta2 = "SELECT COUNT(Id_premio) AS premio FROM c_premio";
        $resultado = $catalogo->obtenerLista($consulta);
        $resultado2 = $catalogo->obtenerLista($consulta2);
        $row = mysqli_fetch_array($resultado);
            array_push($Num_Producciones, $row['feria']);

        $row2 = mysqli_fetch_array($resultado2);
            array_push($Num_Producciones, $row2['premio']);

        return $Num_Producciones;
    }
    function tipo_publicacion2($tipo)
    {
        $catalogo = new Catalogo();
        $Num_Publicacion = array();
        $consulta = "SELECT p.Nombre,(SELECT SUM(f.Pz) FROM c_formatoLibro as f WHERE f.IdTipoPublicacion=p.IdTipoPublicacion) as total FROM c_tipoPublicacion as p";
        $resultado = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            array_push($Num_Publicacion, $row['total']);
        }
        return $Num_Publicacion;
    }

}
