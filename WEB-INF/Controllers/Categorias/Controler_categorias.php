<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);


include_once("../../Classes/CategoriaEje.class.php");
include_once("../../Classes/Catalogo.class.php");

$obj = new categoria_eje();
$catalogo = new Catalogo();
$subcategorias = "";
$subcategoriasedita = "";
if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setAnio($parametros['ano']);
            $obj->setIdEje($parametros['eje']);
            $obj->setDescCategoria($parametros['descripcion']);
            $obj->setNivelCategoria(1);
            if (isset($parametros['ordencate']) && $parametros['ordencate'] != "") {
                $obj->setordencate($parametros['ordencate']);
            }else {
                $obj->setordencate('NULL');
            }
            $subcategorias = $parametros['subcate'];

            if ($obj->nuevaCategoria()) {
                echo "Éxito: Categoría guardada correctamente";
                if (isset($parametros['dessubcate0']) && $parametros['dessubcate0'] != "") {
                    $IDIndicador = $obj->getIdCategoria();
                    for ($i = 0; $i <= $subcategorias; $i++) {
                        $obj->setAnio($parametros['ano']);
                        $obj->setIdEje($parametros['eje']);
                        $obj->setNivelCategoria(2);
                        $obj->setDescCategoria($parametros['dessubcate' . $i]);
                        if (isset($parametros['expo' . $i]) && $parametros['expo' . $i] != "") {
                            $obj->setIdExposicion($parametros['expo' . $i]);
                        } else {
                            $obj->setIdExposicion('NULL');
                        }
                        if (isset($parametros['ordensubcate' . $i]) && $parametros['ordensubcate' . $i] != "") {
                            $obj->setordensubcate($parametros['ordensubcate' . $i]);
                        } else {
                            $obj->setordensubcate('NULL');
                        }
                        $obj->setIdCategoriaPadre($IDIndicador);
                        if ($obj->nuevaSubcategoria()) {
                        }
                    }
                }
            } else {
                echo 'Error: No se ha podido crear la categoría';
            }
            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setAnio($parametros['ano']);
            $obj->setIdEje($parametros['eje']);
            $obj->setDescCategoria($parametros['descripcion']);
            if (isset($parametros['ordencate']) && $parametros['ordencate'] != "") {
                $obj->setordencate($parametros['ordencate']);
            }else {
                $obj->setordencate('NULL');
            }
            $obj->setIdCategoria($_POST['id']);
            $IDIndicador = $_POST['id'];
            $subcategorias = $parametros['subcate'];
            $subcategoriasedita = $parametros['subcateedi'];
            if ($obj->editarCategoria()) {
                echo 'Éxito: La categoría a sido modificada';
                if ($subcategorias > 0) {
                    for ($i = 1; $i <= $subcategorias; $i++) {
                        //$indice = 1;
                        $obj->setIdCategoriaPadre($IDIndicador);
                        $obj->setDescCategoria($parametros['dessubcate' . $i]);
                        $obj->setNivelCategoria(2);
                        if (isset($parametros['expo' . $i]) && $parametros['expo' . $i] != "") {
                            $obj->setIdExposicion($parametros['expo' . $i]);
                        } else {
                            $obj->setIdExposicion('NULL');
                        }
                        if (isset($parametros['ordensubcate' . $i]) && $parametros['ordensubcate' . $i] != "") {
                            $obj->setordensubcate($parametros['ordensubcate' . $i]);
                        } else {
                            $obj->setordensubcate('NULL');
                        }
                        if ($obj->nuevaSubcategoria()) {
                        }
                        //$indice++;
                    }
                }
                if ($subcategoriasedita > 0) {
                    for ($i = 0; $i < $subcategoriasedita; $i++) {
                        $obj->setIdCategoria($parametros['idsub' . $i]);
                        $obj->setDescCategoria($parametros['dessubcateed' . $i]);
                        if (isset($parametros['expoed' . $i]) && $parametros['expoed' . $i] != "") {
                            $obj->setIdExposicion($parametros['expoed' . $i]);
                        } else {
                            $obj->setIdExposicion('NULL');
                        }
                        if (isset($parametros['ordensubcateedit' . $i]) && $parametros['ordensubcateedit' . $i] != "") {
                            $obj->setordensubcate($parametros['ordensubcateedit' . $i]);
                        } else {
                            $obj->setordensubcate('NULL');
                        }
                        if ($obj->editarSubcategoria()) {
                        }
                    }
                }
            } else {
                echo 'Error: No se ha podido modificar la categoría';
            }
            break;
        case 'eliminar':
            $ID = array();
            $IDIndicador = $_POST['id'];
            $consulta_sub = 'SELECT ce.idCategoria FROM c_categoriasdeejes ce WHERE ce.idCategoriaPadre=' . $IDIndicador;
            $resultConsulta = $catalogo->obtenerLista($consulta_sub);
            while ($row = mysqli_fetch_array($resultConsulta)) {
                array_push($ID, $row['idCategoria']);
            }
            for ($i = 0; $i < count($ID); $i++) {
                $obj->setIdCategoria($ID[$i]);
                if ($obj->eliminaSubcategoria()) {
                }
            }
            $obj->setIdCategoria($IDIndicador);
            if ($obj->eliminaCategoria()) {
                echo 'Éxito: Se ha eliminado la categoría';
            } else {
                echo 'Error: No se ha podido eliminar la categoría';
            }

            break;
        case 'eliminarsub':
            $obj->setIdCategoria($_POST['id']);
            if ($obj->eliminaSubcategoria()) {
                echo 'Éxito: Se ha eliminado la subcategoría';
            } else {
                echo 'Error: No se ha podido eliminar la subcategoría';
            }
            break;
    }
}
