<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once __DIR__ . "/../../../source/dao/clases/LoggedinTime.php";
$catalogo = new Catalogo();

$tipo_acuerdo = isset($_GET['tipo_acuerdo']) ? $_GET['tipo_acuerdo'] : false;

$ejeid = isset($_GET['ejeid']) ? $_GET['ejeid'] : false;

if ((isset($_GET['tipoPerfil']) && $_GET['tipoPerfil'] != "")) {
    $tipoPerfil = $_GET["tipoPerfil"];
} else {
    $tipoPerfil = '';
}

if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
    $nombreUsuario = $_GET["nombreUsuario"];
} else {
    $nombreUsuario = '';
}
if ((isset($_GET['idUsuario']) && $_GET['idUsuario'] != "")) {
    $idUsuario = $_GET["idUsuario"];
} else {
    $idUsuario = '';
}

/*$FiltroEjeAño=""; //Se inicializa la variable
if ((isset($_GET['ejeaño']) && $_GET['ejeaño'] != "")) //Si el parametro existe se procesa
{   if ($_GET['ejeaño']!="0") {$FiltroEjeAño =" AND a.Periodo= ".$_GET['ejeaño'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $FiltroEjeAño="  AND isnull(aa.id_proyecto)"; } //Si el parametro es igual a 0 se buscan los NULOS
}*/

$FiltroEjeAño = "";
if (isset($_GET['ejeaño']) && $_GET['ejeaño'] != "") {
    if ($_GET['ejeaño'] == "Sin información") {
        $FiltroEjeAño = " AND isnull(a.Periodo) ";
    } //Para fechas nulas
    elseif ($_GET['ejeaño'] == "Todos" || $_GET['ejeaño'] == "1") //Para todos los años
    {
        $FiltroEjeAño = " = 1 ";
    } else {
        $FiltroEjeAño = " AND a.Periodo='" . $_GET['ejeaño'] . "' ";
    }
} else {
    $FiltroEjeAño = "";
}

$FiltroEje = ""; //Se inicializa la variable
$FiltroEjeUnico = ""; //para que no se muestren mas ejes 
if ((isset($_GET['ejeid']) && $_GET['ejeid'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['ejeid'] != "0") {
        $FiltroEje = " AND aa.id_proyecto= " . $_GET['ejeid'] . " " . $FiltroEjeAño;
        $ejeconsultado = $_GET['ejeid'];
        $numeroAcuerdos = $_GET['numeroAcuerdos'];
        $FiltroEjeUnico = " AND a.id_proyecto= " . $_GET['ejeid'] . " ";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroEje = "  AND isnull(aa.id_proyecto)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroEjeRealizado = ""; //Se inicializa la variable
if ((isset($_GET['ejeidrealizado']) && $_GET['ejeidrealizado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['ejeidrealizado'] != "0") {
        $FiltroEjeRealizado = " AND aa.id_proyecto= " . $_GET['ejeidrealizado'] . " AND aa.Id_acuerdoestatus=2 " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroEjeRealizado = "AND isnull(aa.id_proyecto)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroEjeRealizadoTotal = ""; //Se inicializa la variable
if ((isset($_GET['idejerealizadostotal']) && $_GET['idejerealizadostotal'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idejerealizadostotal'] != "0") {
        $FiltroEjeRealizadoTotal = " AND aa.Id_acuerdoestatus= " . $_GET['idejerealizadostotal'];
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroEjeRealizadoTotal = "AND isnull(aa.Id_acuerdoestatus)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroEjeNoRealizado = ""; //Se inicializa la variable
if ((isset($_GET['ejeidnorealizado']) && $_GET['ejeidnorealizado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['ejeidnorealizado'] != "0") {
        $FiltroEjeNoRealizado = " AND aa.id_proyecto= " . $_GET['ejeidnorealizado'] . " AND aa.Id_acuerdoestatus=1 " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroEjeNoRealizado = "AND isnull(aa.id_proyecto)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroEjeNoRealizadoTotal = ""; //pediente de valor 0
if ((isset($_GET['idejenorealizadostotal']) && $_GET['idejenorealizadostotal'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idejenorealizadostotal'] != "0") {
        $FiltroEjeNoRealizadoTotal = " AND aa.Id_acuerdoestatus= 1 ";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroEjeNoRealizadoTotal = "AND isnull(aa.Id_acuerdoestatus)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

//nueva
$FiltroEjeCancelado = ""; //Se inicializa la variable
if ((isset($_GET['ejeidcancelado']) && $_GET['ejeidcancelado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['ejeidcancelado'] != "0") {
        $FiltroEjeCancelado = " AND aa.id_proyecto= " . $_GET['ejeidcancelado'] . " AND aa.Id_acuerdoestatus=3 " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroEjeCancelado = "AND isnull(aa.id_proyecto)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroEjeCanceladoTotal = ""; //pediente de valor 0
if ((isset($_GET['idejecanceladototal']) && $_GET['idejecanceladototal'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idejecanceladototal'] != "0") {
        $FiltroEjeCanceladoTotal = " AND aa.Id_acuerdoestatus= 3 ";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroEjeCanceladoTotal = "AND isnull(aa.Id_acuerdoestatus)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroAreaConvoca = ""; //Se inicializa la variable
if ((isset($_GET['idArea']) && $_GET['idArea'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idArea'] != "0") {
        $FiltroAreaConvoca = " AND p.id_area= " . $_GET['idArea'] . " " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroAreaConvoca = "AND isnull(p.id_area)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroAreaInvita = ""; //Se inicializa la variable
if ((isset($_GET['idAreainvita']) && $_GET['idAreainvita'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idAreainvita'] != "0") {
        $FiltroAreaInvita = " AND aarea.id_Area_invitada= " . $_GET['idAreainvita'] . " " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroAreaInvita = "AND isnull(aarea.id_Area_invitada)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroAreaRealizado = ""; //Se inicializa la variable
if ((isset($_GET['idArearealizado']) && $_GET['idArearealizado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idArearealizado'] != "0") {
        $FiltroAreaRealizado = " AND p.id_area= " . $_GET['idArearealizado'] . " AND aa.Id_acuerdoestatus=2 " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroAreaRealizado = "AND isnull(p.id_area)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroAreaNoRealizado = ""; //Se inicializa la variable
if ((isset($_GET['idAreanorealizado']) && $_GET['idAreanorealizado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idAreanorealizado'] != "0") {
        $FiltroAreaNoRealizado = " AND p.id_area= " . $_GET['idAreanorealizado'] . " AND aa.Id_acuerdoestatus=1 " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroAreaNoRealizado = "AND isnull(p.id_area)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroAreaCancelado = ""; //Se inicializa la variable
if ((isset($_GET['idAreacancelado']) && $_GET['idAreacancelado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idAreacancelado'] != "0") {
        $FiltroAreaCancelado = " AND p.id_area= " . $_GET['idAreacancelado'] . " AND aa.Id_acuerdoestatus=3 " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroAreaCancelado = "AND isnull(p.id_area)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroAreaInvitadosTotal = ""; //Se inicializa la variable
if ((isset($_GET['idAreainvitatotal']) && $_GET['idAreainvitatotal'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idAreainvitatotal'] != "0") {
        $FiltroAreaInvitadosTotal = " AND ( SELECT COUNT(*) FROM k_acuerdoactividad acu JOIN c_acuerdospdf a2 ON a2.id_acuerdo_escrito=acu.id_acuerdo JOIN k_acuerdoarea k ON k.id_Acuerdo=a2.id_acuerdo_escrito WHERE k.id_Area_invitada = k.Id_Area ) " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroAreaInvitadosTotal = "AND isnull(aa.Id_acuerdoestatus)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroAreaRealizadoTotal = ""; //Se inicializa la variable
if ((isset($_GET['idArearealizadototal']) && $_GET['idArearealizadototal'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idArearealizadototal'] != "0") {
        $FiltroAreaNoRealizado = " AND p.id_area = k.Id_Area AND aa.Id_acuerdoestatus = " . $_GET['idArearealizadototal'];
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroAreaNoRealizado = "AND isnull(aa.Id_acuerdoestatus)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroAreaNoRealizadoTotal = ""; //Se inicializa la variable
if ((isset($_GET['idAreanorealizadototal']) && $_GET['idAreanorealizadototal'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idAreanorealizadototal'] != "0") {
        $FiltroAreaNoRealizadoTotal = " AND p.id_area = k.Id_Area AND aa.Id_acuerdoestatus = 1";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroAreaNoRealizadoTotal = "AND isnull(aa.Id_acuerdoestatus)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroAreaCanceladoTotal = ""; //Se inicializa la variable
if ((isset($_GET['idAreacanceladototal']) && $_GET['idAreacanceladototal'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idAreacanceladototal'] != "0") {
        $FiltroAreaCanceladoTotal = " AND p.id_area = k.Id_Area AND aa.Id_acuerdoestatus = 3";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroAreaCanceladoTotal = "AND isnull(aa.Id_acuerdoestatus)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroAñoConvocado = ""; //Se inicializa la variable
if ((isset($_GET['idPeriodo']) && $_GET['idPeriodo'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idPeriodo'] != "0") {
        $FiltroAñoConvocado = " AND a.Id_Periodo= " . $_GET['idPeriodo'];
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroAñoConvocado = "AND isnull(a.Id_Periodo)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroAñoRealizado = ""; //Se inicializa la variable
if ((isset($_GET['idPeriodorealizado']) && $_GET['idPeriodorealizado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idPeriodorealizado'] != "0") {
        $FiltroAñoRealizado = " AND p.anio= " . $_GET['idPeriodorealizado'] . " AND aa.Id_acuerdoestatus=2";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroAñoRealizado = "AND isnull(p.anio)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroAñoNoRealizado = ""; //Se inicializa la variable
if ((isset($_GET['idPeriodonorealizado']) && $_GET['idPeriodonorealizado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idPeriodonorealizado'] != "0") {
        $FiltroAñoRealizado = " AND p.anio= " . $_GET['idPeriodonorealizado'] . " AND aa.Id_acuerdoestatus=1";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroAñoRealizado = "AND isnull(p.anio)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroAñoCancelado = ""; //Se inicializa la variable
if ((isset($_GET['idPeriodocancelado']) && $_GET['idPeriodocancelado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idPeriodocancelado'] != "0") {
        $FiltroAñoCancelado = " AND p.anio= " . $_GET['idPeriodocancelado'] . " AND aa.Id_acuerdoestatus=3";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroAñoCancelado = "AND isnull(p.anio)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroAñoRealizadoTotal = ""; //Se inicializa la variable
if ((isset($_GET['anototalrealizados']) && $_GET['anototalrealizados'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['anototalrealizados'] != "0") {
        $FiltroAñoRealizadoTotal = " AND aa.Id_acuerdoestatus= " . $_GET['anototalrealizados'];
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroAñoRealizadoTotal = "AND isnull(aa.Id_acuerdoestatus)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroAñoNoRealizadoTotal = ""; //Se inicializa la variable
if ((isset($_GET['anototalnorealizados']) && $_GET['anototalnorealizados'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['anototalnorealizados'] != "0") {
        $FiltroAñoNoRealizadoTotal = " AND aa.Id_acuerdoestatus= 1";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroAñoNoRealizadoTotal = "AND isnull(aa.Id_acuerdoestatus)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroAñoCanceladoTotal = ""; //Se inicializa la variable
if ((isset($_GET['anototalcancelado']) && $_GET['anototalcancelado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['anototalcancelado'] != "0") {
        $FiltroAñoCanceladoTotal = " AND aa.Id_acuerdoestatus= 3";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroAñoCanceladoTotal = "AND isnull(aa.Id_acuerdoestatus)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroExposicion = ""; //Se inicializa la variable
if ((isset($_GET['idExposicion']) && $_GET['idExposicion'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idExposicion'] != "0") {
        $FiltroExposicion = " AND aa.id_exposicion=" . $_GET['idExposicion'] . " " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroExposicion = "AND isnull(aa.id_exposicion)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroExposicionrealizado = ""; //Se inicializa la variable
if ((isset($_GET['idExposicionrealizado']) && $_GET['idExposicionrealizado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idExposicionrealizado'] != "0") {
        $FiltroExposicionrealizado = " AND aa.id_exposicion=" . $_GET['idExposicionrealizado'] . " AND aa.Id_acuerdoestatus=2 " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroExposicionrealizado = "AND isnull(aa.id_exposicion)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroExposicionNorealizado = ""; //Se inicializa la variable
if ((isset($_GET['idExposicionnorealizado']) && $_GET['idExposicionnorealizado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idExposicionnorealizado'] != "0") {
        $FiltroExposicionNorealizado = " AND aa.id_exposicion=" . $_GET['idExposicionnorealizado'] . " AND aa.Id_acuerdoestatus=1 " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroExposicionNorealizado = "AND isnull(aa.id_exposicion)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroExposicionCancelado = ""; //Se inicializa la variable
if ((isset($_GET['idExposicioncancelado']) && $_GET['idExposicioncancelado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idExposicioncancelado'] != "0") {
        $FiltroExposicionCancelado = " AND aa.id_exposicion=" . $_GET['idExposicioncancelado'] . " AND aa.Id_acuerdoestatus=3 " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroExposicionCancelado = "AND isnull(aa.id_exposicion)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroExposicionTotal = ""; //Se inicializa la variable
if ((isset($_GET['exposiciontotal']) && $_GET['exposiciontotal'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['exposiciontotal'] != "0") {
        $FiltroExposicionTotal = " AND ex.idExposicion=aa.id_exposicion";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroExposicionTotal = "AND isnull(aa.id_exposicion)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroExposicionTotalRealizado = ""; //Se inicializa la variable
if ((isset($_GET['exposiciontotalrealizado']) && $_GET['exposiciontotalrealizado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['exposiciontotalrealizado'] != "0") {
        $FiltroExposicionTotalRealizado = " AND ex.idExposicion=aa.id_exposicion AND aa.Id_acuerdoestatus=2";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroExposicionTotalRealizado = "AND isnull(aa.id_exposicion)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroExposicionTotalNoRealizado = ""; //Se inicializa la variable
if ((isset($_GET['exposiciontotalnorealizado']) && $_GET['exposiciontotalnorealizado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['exposiciontotalnorealizado'] != "0") {
        $FiltroExposicionTotalNoRealizado = " AND ex.idExposicion=aa.id_exposicion AND aa.Id_acuerdoestatus=1";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroExposicionTotalNoRealizado = "AND isnull(aa.id_exposicion)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroExposicionTotalCancelado = ""; //Se inicializa la variable
if ((isset($_GET['exposiciontotalnorealizado']) && $_GET['exposiciontotalnorealizado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['exposiciontotalnorealizado'] != "0") {
        $FiltroExposicionTotalCancelado = " AND ex.idExposicion=aa.id_exposicion AND aa.Id_acuerdoestatus=3";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $$FiltroExposicionTotalCancelado = "AND isnull(aa.id_exposicion)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroTipoAcuerdo = ""; //Se inicializa la variable
if ((isset($_GET['TipoAcuerdo']) && $_GET['TipoAcuerdo'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['TipoAcuerdo'] != "0") {
        $FiltroTipoAcuerdo = " AND aa.TipoAcuerdo='" . $_GET['TipoAcuerdo'] . "'";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroTipoAcuerdo = "AND isnull(aa.TipoAcuerdo)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroTipoAcuerdoRealizado = ""; //Se inicializa la variable
if ((isset($_GET['TipoAcuerdorealizado']) && $_GET['TipoAcuerdorealizado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['TipoAcuerdorealizado'] != "0") {
        $FiltroTipoAcuerdoRealizado = " AND aa.TipoAcuerdo='" . $_GET['TipoAcuerdorealizado'] . "' AND aa.Id_acuerdoestatus=2";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroTipoAcuerdoRealizado = "AND isnull(aa.TipoAcuerdo)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroTipoAcuerdoNoRealizado = ""; //Se inicializa la variable
if ((isset($_GET['TipoAcuerdonorealizado']) && $_GET['TipoAcuerdonorealizado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['TipoAcuerdonorealizado'] != "0") {
        $FiltroTipoAcuerdoNoRealizado = " AND aa.TipoAcuerdo='" . $_GET['TipoAcuerdonorealizado'] . "' AND aa.Id_acuerdoestatus=1";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroTipoAcuerdoNoRealizado = "AND isnull(aa.TipoAcuerdo)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroTipoAcuerdoCancelado = ""; //Se inicializa la variable
if ((isset($_GET['TipoAcuerdocancelado']) && $_GET['TipoAcuerdocancelado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['TipoAcuerdocancelado'] != "0") {
        $FiltroTipoAcuerdoCancelado = " AND aa.TipoAcuerdo='" . $_GET['TipoAcuerdocancelado'] . "' AND aa.Id_acuerdoestatus=3";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroTipoAcuerdoNoRealizado = "AND isnull(aa.TipoAcuerdo)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroTipoAcuerdoTotal = ""; //Se inicializa la variable
if ((isset($_GET['TipoAcuerdototal']) && $_GET['TipoAcuerdototal'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['TipoAcuerdototal'] != "0") {
        $FiltroTipoAcuerdoTotal = " AND aa.TipoAcuerdo=aa.TipoAcuerdo";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroTipoAcuerdoCancelado = "AND isnull(aa.TipoAcuerdo)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroTipoAcuerdoRealizadoTotal = ""; //Se inicializa la variable
if ((isset($_GET['TipoAcuerdototalrealizados']) && $_GET['TipoAcuerdototalrealizados'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['TipoAcuerdototalrealizados'] != "0") {
        $FiltroTipoAcuerdoRealizadoTotal = " AND aa.Id_acuerdoestatus = 2 AND aa.id_acuerdo = p.id_acuerdo_escrito AND aa.TipoAcuerdo=aa.TipoAcuerdo";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroTipoAcuerdoRealizadoTotal = "AND isnull(aa.TipoAcuerdo)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroTipoAcuerdoNoRealizadoTotal = ""; //Se inicializa la variable
if ((isset($_GET['TipoAcuerdototalnorealizados']) && $_GET['TipoAcuerdototalnorealizados'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['TipoAcuerdototalnorealizados'] != "0") {
        $FiltroTipoAcuerdoNoRealizadoTotal = " AND aa.Id_acuerdoestatus = 1 AND aa.id_acuerdo = p.id_acuerdo_escrito AND aa.TipoAcuerdo=aa.TipoAcuerdo";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroTipoAcuerdoNoRealizadoTotal = "AND isnull(aa.TipoAcuerdo)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}


$FiltroTipoAcuerdoCanceladoTotal = ""; //Se inicializa la variable
if ((isset($_GET['TipoAcuerdototalcancelado']) && $_GET['TipoAcuerdototalcancelado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['TipoAcuerdototalcancelado'] != "0") {
        $FiltroTipoAcuerdoCanceladoTotal = " AND aa.Id_acuerdoestatus = 3 AND aa.id_acuerdo = p.id_acuerdo_escrito AND aa.TipoAcuerdo=aa.TipoAcuerdo";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroTipoAcuerdoCanceladoTotal = "AND isnull(aa.TipoAcuerdo)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}


//Tipo de Documento Interno o Externo
$FiltroTipoDoc = ""; //Se inicializa la variable
if ((isset($_GET['TipoDocumento']) && $_GET['TipoDocumento'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['TipoDocumento'] != "0") {
        $FiltroTipoDoc = " AND p.id_tipo=" . $_GET['TipoDocumento'] . " " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroTipoDoc = "AND isnull(p.id_tipo)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroTipoDocrealizado = ""; //Se inicializa la variable
if ((isset($_GET['TipoDocumentorealizado']) && $_GET['TipoDocumentorealizado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['TipoDocumentorealizado'] != "0") {
        $FiltroTipoDocrealizado = " AND p.id_tipo=" . $_GET['TipoDocumentorealizado'] . " AND aa.Id_acuerdoestatus=2 " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroTipoDocrealizado = "AND isnull(p.id_tipo)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroTipoDocNorealizado = ""; //Se inicializa la variable
if ((isset($_GET['TipoDocumentonorealizado']) && $_GET['TipoDocumentonorealizado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['TipoDocumentonorealizado'] != "0") {
        $FiltroTipoDocNorealizado = " AND p.id_tipo=" . $_GET['TipoDocumentonorealizado'] . " AND aa.Id_acuerdoestatus=1 " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroTipoDocNorealizado = "AND isnull(p.id_tipo)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroTipoDocCancelado = ""; //Se inicializa la variable
if ((isset($_GET['TipoDocumentocancelado']) && $_GET['TipoDocumentocancelado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['TipoDocumentocancelado'] != "0") {
        $FiltroTipoDocCancelado = " AND p.id_tipo=" . $_GET['TipoDocumentocancelado'] . " AND aa.Id_acuerdoestatus=3 " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroTipoDocCancelado = "AND isnull(p.id_tipo)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroTipoDocTotal = ""; //Se inicializa la variable
if ((isset($_GET['TipoDocumentototal']) && $_GET['TipoDocumentototal'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['TipoDocumentototal'] != "0") {
        $FiltroTipoDocTotal = " AND d.id_tipo=p.id_tipo";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroExposicionTotal = "AND isnull(p.id_tipo)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroTipoDocTotalRealizado = ""; //Se inicializa la variable
if ((isset($_GET['TipoDocumentototalrealizados']) && $_GET['TipoDocumentototalrealizados'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['TipoDocumentototalrealizados'] != "0") {
        $FiltroTipoDocTotalRealizado = " AND d.id_tipo=p.id_tipo AND aa.Id_acuerdoestatus=2";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroTipoDocTotalRealizado = "AND isnull(p.id_tipo)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroTipoDocTotalNoRealizado = ""; //Se inicializa la variable
if ((isset($_GET['TipoDocumentototalnorealizados']) && $_GET['TipoDocumentototalnorealizados'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['TipoDocumentototalnorealizados'] != "0") {
        $FiltroTipoDocTotalNoRealizado = " AND d.id_tipo=p.id_tipo AND aa.Id_acuerdoestatus=1";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroTipoDocTotalNoRealizado = "AND isnull(p.id_tipo)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroTipoDocTotalCancelado = ""; //Se inicializa la variable
if ((isset($_GET['TipoDocumentototalcancelado']) && $_GET['TipoDocumentototalcancelado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['TipoDocumentototalcancelado'] != "0") {
        $FiltroTipoDocTotalCancelado = " AND d.id_tipo=p.id_tipo AND aa.Id_acuerdoestatus=3";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroTipoDocTotalCancelado = "AND isnull(p.id_tipo)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

//Responsable
$FiltroResponsable = ""; //Se inicializa la variable
if ((isset($_GET['personaid']) && $_GET['personaid'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['personaid'] != "0") {
        $FiltroResponsable = " AND aa.Id_persona=" . $_GET['personaid'] . " " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroResponsable = "AND isnull(aa.Id_persona)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroResponsablerealizado = ""; //Se inicializa la variable
if ((isset($_GET['personaidrealizado']) && $_GET['personaidrealizado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['personaidrealizado'] != "0") {
        $FiltroResponsablerealizado = " AND aa.Id_persona=" . $_GET['personaidrealizado'] . " AND aa.Id_acuerdoestatus=2 " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroResponsablerealizado = "AND isnull(aa.Id_persona)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroResponsableNorealizado = ""; //Se inicializa la variable
if ((isset($_GET['personaidnorealizado']) && $_GET['personaidnorealizado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['personaidnorealizado'] != "0") {
        $FiltroResponsableNorealizado = " AND aa.Id_persona=" . $_GET['personaidnorealizado'] . " AND aa.Id_acuerdoestatus=1 " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroResponsableNorealizado = "AND isnull(aa.Id_persona)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroResponsableCancelado = ""; //Se inicializa la variable
if ((isset($_GET['personaidcancelado']) && $_GET['personaidcancelado'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['personaidcancelado'] != "0") {
        $FiltroResponsableCancelado = " AND aa.Id_persona=" . $_GET['personaidcancelado'] . " AND aa.Id_acuerdoestatus=3 " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroResponsableCancelado = "AND isnull(aa.Id_persona)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroResponsableTotal = ""; //Se inicializa la variable
if ((isset($_GET['idpersonatotal']) && $_GET['idpersonatotal'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idpersonatotal'] != "0") {
        $FiltroResponsableTotal = " AND aa.Id_persona=res.id_Personas";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroResponsableTotal = "AND isnull(aa.Id_persona)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroResponsableTotalRealizado = ""; //Se inicializa la variable
if ((isset($_GET['idpersonarealizadostotal']) && $_GET['idpersonarealizadostotal'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idpersonarealizadostotal'] != "0") {
        $FiltroResponsableTotalRealizado = " AND aa.Id_persona=res.id_Personas AND aa.Id_acuerdoestatus=2";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroResponsableTotalRealizado = "AND isnull(aa.Id_persona)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroResponsableTotalNoRealizado = ""; //Se inicializa la variable
if ((isset($_GET['idpersonanorealizadostotal']) && $_GET['idpersonanorealizadostotal'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idpersonanorealizadostotal'] != "0") {
        $FiltroResponsableTotalNoRealizado = " AND aa.Id_persona=res.id_Personas AND aa.Id_acuerdoestatus=1";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroResponsableTotalNoRealizado = "AND isnull(aa.Id_persona)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroResponsableTotalCancelado = ""; //Se inicializa la variable
if ((isset($_GET['idpersonacanceladototal']) && $_GET['idpersonacanceladototal'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idpersonacanceladototal'] != "0") {
        $FiltroResponsableTotalCancelado = " AND aa.Id_persona=res.id_Personas AND aa.Id_acuerdoestatus=3";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroResponsableTotalCancelado = "AND isnull(aa.Id_persona)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}


//Para grafica pastel
$FiltroejeareabusquedaPastel = ""; //Se inicializa la variable
if ((isset($_GET['ejeareabusqueda']) && $_GET['ejeareabusqueda'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['ejeareabusqueda'] != "0") {
        $FiltroejeareabusquedaPastel = " AND aa.id_proyecto= " . $_GET['ejeareabusqueda'] . " " . $FiltroEjeAño;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroejeareabusquedaPastel = "";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroAreaConvocaPastel = ""; //Se inicializa la variable
if ((isset($_GET['idAreaeje']) && $_GET['idAreaeje'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idAreaeje'] != "0") {
        $FiltroAreaConvocaPastel = " AND p.id_area= " . $_GET['idAreaeje'] . " " . $FiltroejeareabusquedaPastel;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroAreaConvocaPastel = "AND isnull(p.id_area)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroAreaRealizadoPastel = ""; //Se inicializa la variable
if ((isset($_GET['idArearealizadoeje']) && $_GET['idArearealizadoeje'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idArearealizadoeje'] != "0") {
        $FiltroAreaRealizadoPastel = " AND p.id_area= " . $_GET['idArearealizadoeje'] . " AND aa.Id_acuerdoestatus=2 " . $FiltroejeareabusquedaPastel . " ";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroAreaRealizadoPastel = "AND isnull(p.id_area)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroAreaNoRealizadoPastel = ""; //Se inicializa la variable
if ((isset($_GET['idAreanorealizadoeje']) && $_GET['idAreanorealizadoeje'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idAreanorealizadoeje'] != "0") {
        $FiltroAreaNoRealizadoPastel = " AND p.id_area = k.Id_Area AND aa.Id_acuerdoestatus = 1 " . $FiltroejeareabusquedaPastel;
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroAreaNoRealizadoPastel = "AND isnull(aa.Id_acuerdoestatus)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroAreaCanceladoPastel = ""; //Se inicializa la variable
if ((isset($_GET['idAreacanceladoeje']) && $_GET['idAreacanceladoeje'] != "")) //Si el parametro existe se procesa
{
    if ($_GET['idAreacanceladoeje'] != "0") {
        $FiltroAreaCanceladoPastel = " AND p.id_area = k.Id_Area AND aa.Id_acuerdoestatus = 3";
    } //Si el parametro es diferente de 0 se busca el valor
    else {
        $FiltroAreaCanceladoPastel = "AND isnull(aa.Id_acuerdoestatus)";
    } //Si el parametro es igual a 0 se buscan los NULOS
}

if (!isset($_SESSION['user_session'])) {
?>
    <script>
        top.location.href = "../../login.php";
        window.reload();
    </script>
    <?php
}
if (isset($_SESSION["user_session"])) {
    if (isLoginSessionExpired()) {
    ?>
        <script>
            top.location.href = "../../logout.php?session_expired=1";
        </script>
<?php
    }
}

?>
<?php 
if(isset($_GET['directo'])){
    if($_GET['directo'] == "1"){
        $ejeañoTodos = $_GET['ejeaño'];
        $ejeidTodos = $_GET['ejeid'];
        $varFiltro = $_GET['varFiltro'];
        if(isset($_GET['indicador'])) {
            $indicador = $_GET['indicador'];
        }else {
            $indicador = "";
        }
        
        $ruta_edita_todos = "Alta_acuerdo.php?accion=editar&id=0&usuario=" . $nombreUsuario . "&tipoPerfil=" . $tipoPerfil . "&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $idUsuario . "&portada=1&tipo_acuerdo=" . $tipo_acuerdo . "&ejeid=" . $ejeid . "&tipoPerfil=" . $tipoPerfil . "&ejeañoTodos=" . $ejeañoTodos . "&ejeidTodos=" . $ejeidTodos . "&varFiltro=" . $varFiltro . "&indicador=" . $indicador;
        $editar = "onclick='edita($idUsuario,9,\"$ruta_edita_todos\")'";
?>
        <script>
            window.location.href = "<?php echo $ruta_edita_todos; ?>";
        </script>
<?php
    }
}

?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link href="../../../resources/css/bootstrap-select.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="../../../resources/js/bootstrap-select.js"></script>
    <script src="../../../resources/js/sweetAlert.js"></script>
    <script src="../../../resources/js/bootstrap/bootstrapValidator.js"></script>
    <script src="../../../resources/js/aplicaciones/Permisos.js"></script>
    <script src="../../../resources/js/aplicaciones/AcuedosEscritos/Alta_acuerdo.js"></script>
    <title>::.ACUERDOS ESCRITOS.::</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Aplicaciones</a> /
        <a style="color:#fefefe;" href="Vista.php?usuario=<?php echo $nombreUsuario; ?>&nombreUsuario=<?= $nombreUsuario ?>&tipoPerfil=<?= $tipoPerfil ?>&idUsuario=<?= $idUsuario ?>">Acuerdos</a> /
        <a style="color:#fefefe;" href="Vista.php?usuario=<?php echo $nombreUsuario; ?>&nombreUsuario=<?= $nombreUsuario ?>&tipoPerfil=<?= $tipoPerfil ?>&idUsuario=<?= $idUsuario ?>">Indicadores</a> /
        <a style="color: #fbff00;text-decoration: underline;" href="javascript:window.location.reload(true)">Lista Acuerdos</a> /
      <!--  <a style="color:#fefefe;" href="Acuerdosfocos.php?usuario=<?php echo $nombreUsuario; ?>&nombreUsuario=<?= $nombreUsuario ?>&tipoPerfil=<?= $tipoPerfil ?>&idUsuario=<?= $idUsuario ?>">Focos</a> / -->
        <a style="color:#fefefe;" href="Alta_acuerdo.php?accion=guardar&tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Acuerdo Nuevo</a>
        <i onclick="history.back()" data-toggle="tooltip" data-placement="bottom" title="" style="position: absolute;right: 73px;cursor:pointer;" class="fa fa-undo" aria-hidden="true" data-original-title="Regresar"></i>
    </div>
    <div class="well2 wr">
   
    </div>
    <div class="container-fluid">
        <?php if($FiltroEje != ""){
             $ejeañoTodos = $_GET['ejeaño'];
             $ejeidTodos = $_GET['ejeid'];
             $ruta_edita_todos = "Alta_acuerdo.php?accion=editar&id=0&usuario=" . $nombreUsuario . "&tipoPerfil=" . $tipoPerfil . "&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $idUsuario . "&portada=1&tipo_acuerdo=" . $tipo_acuerdo . "&ejeid=" . $ejeid . "&tipoPerfil=" . $tipoPerfil . "&ejeañoTodos=" . $ejeañoTodos . "&ejeidTodos=" . $ejeidTodos;
             $editar = "onclick='edita($idUsuario,9,\"$ruta_edita_todos\")'";
            ?>
            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 14px; margin-left: 2px;">
               <a href="<?php echo $ruta_edita_todos; ?>" style="color:black;font-weight: bold;cursor:pointer;border-radius: 5px;background-color: #d7d7d7;" ' . $editar . '><span class="glyphicon glyphicon-pencil" style="font-weight: bold;"> Ver los <?php echo $numeroAcuerdos; ?> acuerdos del eje <?php echo $ejeconsultado; ?>  </span></a>
            </div>
        <?php }?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table id="tAcuerdos" class="table table-striped table-bordered" style="width:100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Acuerdo</th>
                            <th>Convoca</th>
                            <th>Eje</th>
                            <th>AcMe</th>
                            <th>Fecha</th>
                            <th>Periodo</th>
                            <th>Tipo</th>
                            <th>Invitados</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $consulta = "SELECT DISTINCT p.id_acuerdo_escrito, p.pdf as pdf, p.pdfid as pdfid, p.descripcion, a.Periodo AS ano, k.Nombre AS Area, p.fecha_convocado,
                        DATEDIFF(NOW(),p.fecha_convocado) diferencia_fecha, p.fecha_realizado, d.tipo,
                        CONCAT(b.Apellido_Paterno,' ',b.Apellido_Materno,' ',b.Nombre) AS persona
                        FROM c_acuerdospdf AS p
                        LEFT JOIN c_periodo AS a ON a.Id_Periodo = p.anio
                        LEFT JOIN c_area AS k ON k.Id_Area = p.id_area
                        LEFT JOIN c_tipo_documento AS d ON d.id_tipo = p.id_tipo
                        LEFT JOIN c_personas AS b ON b.id_Personas = p.id_usuario
                        LEFT JOIN k_acuerdoactividad aa ON aa.id_acuerdo=p.id_acuerdo_escrito
                        LEFT JOIN k_acuerdoarea aarea ON aarea.id_Acuerdo=p.id_acuerdo_escrito
                        LEFT JOIN c_exposicionTemporal ex ON ex.idExposicion=aa.id_exposicion
                        LEFT JOIN c_personas res on res.id_Personas=aa.Id_persona 
                        WHERE 1 $FiltroEjeAño $FiltroEje $FiltroEjeRealizado $FiltroEjeNoRealizado $FiltroEjeRealizadoTotal $FiltroEjeNoRealizadoTotal $FiltroEjeCancelado $FiltroEjeCanceladoTotal
                        $FiltroAreaConvoca $FiltroAreaInvita $FiltroAreaRealizado $FiltroAreaNoRealizado $FiltroAreaCancelado $FiltroAreaInvitadosTotal $FiltroAreaRealizadoTotal $FiltroAreaNoRealizadoTotal $FiltroAreaCanceladoTotal $FiltroAñoConvocado $FiltroAñoRealizado $FiltroAñoNoRealizado $FiltroAñoCancelado $FiltroAñoRealizadoTotal $FiltroAñoNoRealizadoTotal $FiltroAñoCanceladoTotal $FiltroExposicion $FiltroExposicionrealizado $FiltroExposicionNorealizado $FiltroExposicionTotal $FiltroExposicionTotal $FiltroExposicionTotalRealizado $FiltroExposicionTotalNoRealizado $FiltroExposicionTotalCancelado $FiltroTipoAcuerdo $FiltroTipoAcuerdoRealizado $FiltroTipoAcuerdoNoRealizado $FiltroTipoAcuerdoCancelado $FiltroTipoAcuerdoTotal $FiltroTipoAcuerdoRealizadoTotal $FiltroTipoAcuerdoNoRealizadoTotal $FiltroTipoAcuerdoCanceladoTotal $FiltroTipoDoc $FiltroTipoDocrealizado $FiltroTipoDocNorealizado $FiltroTipoDocTotal $FiltroTipoDocTotal $FiltroTipoDocTotalRealizado $FiltroTipoDocTotalNoRealizado $FiltroTipoDocTotalCancelado $FiltroResponsable $FiltroResponsablerealizado $FiltroResponsableNorealizado $FiltroResponsableCancelado $FiltroResponsableTotal $FiltroResponsableTotalRealizado $FiltroResponsableTotalNoRealizado $FiltroResponsableTotalCancelado $FiltroejeareabusquedaPastel $FiltroAreaConvocaPastel $FiltroAreaRealizadoPastel $FiltroAreaNoRealizadoPastel $FiltroAreaCanceladoPastel
                        ORDER BY p.fecha_convocado desc";
                       // echo $consulta;
                        $resultConsulta = $catalogo->obtenerLista($consulta);

                        while ($row = mysqli_fetch_array($resultConsulta)) {
                            $id_acuerdo = $row['id_acuerdo_escrito'];
                            $ruta_edita = "Alta_acuerdo.php?accion=editar&id=" . $id_acuerdo . "&usuario=" . $nombreUsuario . "&tipoPerfil=" . $tipoPerfil . "&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $idUsuario . "&portada=1&tipo_acuerdo=" . $tipo_acuerdo . "&ejeid=" . $ejeid . "&tipoPerfil=" . $tipoPerfil;
                            $ruta_eliminar = "Alta_acuerdo.php?accion=eliminar&id=" . $id_acuerdo . "&usuario=" . $nombreUsuario . "&tipoPerfil=1&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $idUsuario . "&portada=1&tipo_acuerdo=" . $tipo_acuerdo . "&ejeid=" . $ejeid;
                            $editar = "onclick='edita($idUsuario,9,\"$ruta_edita\")'";
                            $eliminar = "onclick='eliminar($idUsuario,9,$id_acuerdo);'";

                            $ruta = '../../../resources/aplicaciones/PDF/AcuerdosEscritos/' . $row['pdf'];
                            $ruta1 = '../../../resources/aplicaciones/PDF/AcuerdosEscritos/' . $row['pdfid'];


                            echo '<tr>';
                            echo '<td>';
                            echo '<a style="color:black;cursor:pointer" onclick="eliminar(' . $row['id_acuerdo_escrito'] . ')"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;
                            <a href="' . $ruta_edita . '" style="color:black;cursor:pointer" ' . $editar . '><span class="glyphicon glyphicon-pencil"></span></a><br><br>';
                            if ($row['pdfid'] != "") {
                                echo '<a href="pdf.php?rutapdf='. $ruta1 .'" style="text-decoration:none;color:black;" target="_self"><i class="glyphicon glyphicon-file" style="color: #195df5;"></i>C</a><br>';
                            } else {
                            }
                            if ($row['pdf'] != "") {
                                echo '<a href="pdf.php?rutapdf='. $ruta .'" style="text-decoration:none;color:black;" target="_self"><i class="glyphicon glyphicon-file" style="color: #195df5;"></i>S</a>';
                            } else {
                            }
                            echo '</td>';
                            //echo '<a href="cambiarestatus.php?accion=editarcheck&idacuerdo='.$id_acuerdo.'&tipoPerfil=1&nombreUsuario='.$nombreUsuario.'&idUsuario='.$idUsuario.'" style="color:black;cursor:pointer"><span class="glyphicon glyphicon-ok"></span></a>';
                            echo '<td>' . $row['descripcion'] . '</td>';
                            echo '<td>' . $row['Area'] . '<br>' . $row['persona'] . '</td>';
                            echo '<td>';
                            $area_eje = "SELECT distinct a.id_proyecto,p.Nombre FROM k_acuerdoactividad as a INNER JOIN c_eje as p on p.idEje=a.id_proyecto where a.id_Acuerdo=" . $id_acuerdo . $FiltroEjeUnico . " ORDER BY a.id_proyecto asc";
                            $area_eje;
                            $resultarea_eje = $catalogo->obtenerLista($area_eje);
                            $totalEjes = mysqli_num_rows($resultarea_eje);
                            if($totalEjes == "1") {
                                $tituloEjes = " Eje";
                            } else {
                                $tituloEjes = " Ejes";
                            }
                            
                            echo '<p style="color: red; font-weight: bold;"> ' . $totalEjes . $tituloEjes . ' </p>';
                            while ($row2 = mysqli_fetch_array($resultarea_eje)) {
                                echo $row2["id_proyecto"] . "." . $row2["Nombre"] . "<br>";
                            }
                            echo '</p>';
                            echo '<td>';
                            $consultaactiv = "SELECT p.IdTipoActividad,CASE WHEN a.id_actividad4 IS NOT NULL AND a.id_actividad3 IS NOT NULL AND a.id_actividad2 IS NOT NULL AND a.id_actividad1 IS NOT NULL THEN CONCAT(l.Numeracion,l.Nombre) WHEN a.id_actividad4 IS NULL AND a.id_actividad3 IS not NULL AND a.id_actividad2 IS NOT NULL AND a.id_actividad1 IS NOT NULL THEN CONCAT(b.Numeracion,b.Nombre) WHEN a.id_actividad4 IS NULL AND a.id_actividad3 IS NULL AND a.id_actividad2 IS NOT NULL AND a.id_actividad1 IS NOT NULL THEN CONCAT(o.Numeracion,o.Nombre) WHEN a.id_actividad4 IS NULL AND a.id_actividad3 IS NULL AND a.id_actividad2 IS NULL AND a.id_actividad1 IS NOT NULL THEN CONCAT(p.Numeracion,p.Nombre) END as Nombre,IF(a.Id_acuerdoestatus=2,'Realizado',IF(a.Id_acuerdoestatus=1,'En proceso','Cancelado')) estatus, a.id_actividad1, a.id_actividad2, a.id_actividad3, a.id_actividad4 FROM k_acuerdoactividad AS a LEFT JOIN c_actividad AS p ON p.IdActividad = a.id_actividad1 LEFT JOIN c_actividad AS o ON o.IdActividad = a.id_actividad2 LEFT JOIN c_actividad AS b ON b.IdActividad = a.id_actividad3 LEFT JOIN c_actividad AS l ON l.IdActividad = a.id_actividad4 WHERE a.id_Acuerdo =" . $id_acuerdo . $FiltroEjeUnico .";";
                            //echo$consultaactiv;
                            $result_actividad = $catalogo->obtenerLista($consultaactiv);
                            while ($row3 = mysqli_fetch_array($result_actividad)) {
                                if ($row3['IdTipoActividad'] == 1) {
                                    echo "A-";
                                } else {
                                    echo "M-";
                                }
                                echo $row3["Nombre"] . "(" . $row3['estatus'] . ")<br>";
                            }
                            echo '</td>';

                            if ($row['fecha_realizado'] == '0000-00-00' || $row['fecha_realizado'] == NULL || $row['fecha_realizado'] == "") { //si no ha sido realizado
                                if ($row['diferencia_fecha'] <= "7") //verde si es menor a 7 dias
                                    echo '<td style="background-color: #e34040;color:white;">' . $row['fecha_convocado'] . '<br>Sin realizar</td>';
                                else if ($row['diferencia_fecha'] > "7" && $row['diferencia_fecha'] < "14") //amarillo si es menor a 14 dias y mayor a 7
                                    echo '<td style="background-color: #e34040;color:white;">' . $row['fecha_convocado'] . '<br>Sin realizar</td>';
                                else if ($row['diferencia_fecha'] >= "14") //rojo si es mayor a 14 dias
                                    echo '<td style="background-color: #e34040;color:white;">' . $row['fecha_convocado'] . '<br>Sin realizar</td>';
                            } else {
                                echo '<td style="background-color: #80c741;">' . $row['fecha_convocado'] . '<br>' . $row['fecha_realizado'] . '</td>';
                            }

                            echo '<td>' . $row['ano'] . '</td>';
                            echo '<td>' . $row['tipo'] . '</td>';
                            echo '<td>';
                            $area_invitada = "SELECT a.id_Area_invitada,p.Nombre, a.firma FROM k_acuerdoarea as a INNER JOIN c_area as p on p.Id_Area=a.id_Area_invitada where a.id_Acuerdo=" . $id_acuerdo;
                            $resultarea_area_invitada = $catalogo->obtenerLista($area_invitada);
                            while ($row4 = mysqli_fetch_array($resultarea_area_invitada)) {
                                if($row4["firma"] != ""){
                                    echo $row4["Nombre"] . "(Firmado)" . "<br>";
                                }else {
                                    echo $row4["Nombre"] . " (Sin Firma)" . "<br>";
                                }  
                               // echo $row4["Nombre"] . "<br>";
                            }
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        var table = $('#tAcuerdos').DataTable();
        table.destroy();
        table = $('#tAcuerdos').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
            },
            "order": [
                [0, "asc"]
            ]
            //"ordering": false
        });

    });
</script>

</html>