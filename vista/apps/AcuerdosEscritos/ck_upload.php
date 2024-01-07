<?php 
$validaservidor="";
if (strpos($_SERVER['HTTP_HOST'], "administro") === false) {
//kaluz para abrir ventana emergente
    if (strpos($_SERVER['HTTP_HOST'], "kaluz") === false) {
        //sie 
        $validaservidor= "siemuseo.com";
        //$validaservidor= "localhost:8080";
    }else{
        $validaservidor= "siekaluz.com";
    }
}else{
$validaservidor= "administro.mx/pruebassie";
}

// Definir ruta de carga de archivos
$upload_dir = array( 
    'img'=> 'imagenesacuerdos/', 
); 
 
// Propiedades de imagen permitidas 
$imgset = array( 
    'maxsize' => 5242880, 
    'maxwidth' => 2000, 
    'maxheight' => 800, 
    'minwidth' => 10, 
    'minheight' => 10,
    'type' => array('bmp', 'gif', 'jpg', 'jpeg', 'png'), 
); 
 
// Si es 0, SOBREESCRIBIRA el archivo existente
define('RENAME_F', 1); 
 
/**
 * Establecer nombre de archivo
 * Si el archivo existe y RENAME_F es 1, configure "img_name_1"
 *
 * $p = dir-ruta, $fn=nombre de archivo para comprobar, $ex=extensión $i=índice para cambiar el nombre
 */ 
function setFName($p, $fn, $ex, $i){ 
    if(RENAME_F ==1 && file_exists($p .$fn .$ex)){ 
        return setFName($p, F_NAME .'_'. ($i +1), $ex, ($i +1)); 
    }else{ 
        return $fn .$ex; 
    } 
} 
 
$re = ''; 
if(isset($_FILES['upload']) && strlen($_FILES['upload']['name']) > 1) { 
 
    define('F_NAME', preg_replace('/\.(.+?)$/i', '', basename($_FILES['upload']['name'])));   
 
    // Obtener nombre de archivo sin extensión
    $sepext = explode('.', strtolower($_FILES['upload']['name'])); 
    $type = end($sepext);    /** gets extension **/ 
     
    // Subir directorio
    $upload_dir = in_array($type, $imgset['type']) ? $upload_dir['img'] : $upload_dir['audio']; 
    $upload_dir = trim($upload_dir, '/') .'/'; 
 
    // Validar tipo de archivo
    if(in_array($type, $imgset['type'])){ 
        // ancho y alto de la imagen 
        list($width, $height) = getimagesize($_FILES['upload']['tmp_name']); 
 
        if(isset($width) && isset($height)) { 
            if($width > $imgset['maxwidth'] || $height > $imgset['maxheight']){ 
                $re .= '\\n Alto x ancho = '. $width .' x '. $height .' \\n El ancho x alto máximo debe ser: '. $imgset['maxwidth']. ' x '. $imgset['maxheight']; 
            } 
 
            if($width < $imgset['minwidth'] || $height < $imgset['minheight']){ 
                $re .= '\\n Alto x ancho = '. $width .' x '. $height .'\\n El ancho x alto mínimo debe ser: '. $imgset['minwidth']. ' x '. $imgset['minheight']; 
            } 
 
            if($_FILES['upload']['size'] > $imgset['maxsize']*1000){ 
                $re .= '\\n El tamaño máximo de archivo debe ser: '. $imgset['maxsize']. ' KB.'; 
            } 
        } 
    }else{ 
        $re .= 'El archivo: '. $_FILES['upload']['name']. ' no tiene el tipo de extensión permitido.'; 
    } 
     
    // ruta de carga del archivo
    $f_name = setFName($_SERVER['DOCUMENT_ROOT'] .'/'. $upload_dir, F_NAME, ".$type", 0); 
    $uploadpath = $upload_dir . $f_name; 
 
    // Si no hay errores, carga la imagen, de lo contrario, genera los errores
    if($re == ''){ 
        if(move_uploaded_file($_FILES['upload']['tmp_name'], $uploadpath)) { 
            $CKEditorFuncNum = $_GET['CKEditorFuncNum']; 
            //$url = 'http://'.$validaservidor.'/pruebas/'. $upload_dir . $f_name; 
            $url = 'https://'.$validaservidor.'/sie/vista/apps/AcuerdosEscritos/'. $upload_dir . $f_name;
            $msg = F_NAME .'.'. $type .' Cargado con éxito: \\n- Tamaño: '. number_format($_FILES['upload']['size']/1024, 2, '.', '') .' KB'; 
            $re = in_array($type, $imgset['type']) ? "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>":'<script>var cke_ob = window.parent.CKEDITOR; for(var ckid in cke_ob.instances) { if(cke_ob.instances[ckid].focusManager.hasFocus) break;} cke_ob.instances[ckid].insertHtml(\' \', \'unfiltered_html\'); alert("'. $msg .'"); var dialog = cke_ob.dialog.getCurrent();dialog.hide();</script>'; 
        }else{ 
            $re = '<script>alert("No se puede cargar el archivo")</script>'; 
        } 
    }else{ 
        $re = '<script>alert("'. $re .'")</script>'; 
    } 
} 
 
// Render HTML output 
@header('Content-type: text/html; charset=utf-8'); 
echo $re;