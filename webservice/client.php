<?php
/**
 * Created by PhpStorm.
 * User: garrapato
 * Date: 26/08/14
 * Time: 06:41
 */

require_once('nusoap/lib/nusoap.php');

date_default_timezone_set('America/Bogota');

$oSoapClient = new nusoap_client('http://obiee.banrep.gov.co/analytics/saw.dll?wsdl', 'wsdl');

if ($sError = $oSoapClient->getError()) {
    echo "No se pudo realizar la operación [" . $sError . "]";
    die();
}

$aParametros = array('name' => 'publico', 'password'=> 'publico');
$sessionID = $oSoapClient->call("logon", $aParametros, "", "", "", "", "rpc", "http://schemas.xmlsoap.org/soap/encoding/", "encoded");

// Alguno de los dos parámetros (reportPath o reportXml) debe ser diferente de null
$reportRef = array (
// Historico para un rango de fechas, como pasar el rango?, si no se pasa el rango funciona como el historico
    'reportPath' => '/shared/Consulta Series Estadisticas desde Excel/1. Tasa de Cambio Peso Colombiano/1.1 TRM - Disponible desde el 27 de noviembre de 1991/1.1.3 Serie historica para un rango de fechas dado',
    'reportXml' => null
);

$xmlOpts = array (
    'async' => 'false', // Importante, debe ser false
    'maxRowsPerPage' => '100',
    'refresh' => 'true',
    'presentationInfo' => 'true'
);

$aParametros = array(
    'report' => $reportRef,
    'outputFormat' => 'SAWRowsetData',
    'executionOptions' => $xmlOpts,
    $sessionID
);

$query = $oSoapClient->call("executeXMLQuery", $aParametros, "", "", "", "", "rpc", "http://schemas.xmlsoap.org/soap/encoding/", "encoded");

$xml = new SimpleXMLElement($query['return']['rowset'], 0, false);
/*print "<pre>";
//var_dump($xml);
foreach ($xml as $value) {
    print_r($value);

}

$fecha=(string)$xml->Row[0]->Column1;
$tc=(string)$xml->Row[0]->Column2;*/

$oSoapClient->call("logoff", $sessionID, "", "", "", "", "rpc", "http://schemas.xmlsoap.org/soap/encoding/", "encoded");

// Existe alguna falla en el servicio?
if ($oSoapClient->fault) { // Si
    echo 'No se pudo completar la operación';
    die();
} else { // No
    $sError = $oSoapClient->getError();
    // Hay algun error ?
    if ($sError) { // Si
        echo 'Error:' . $sError;
        die();
    }

}
?>