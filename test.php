<?php
$xml= new SimpleXMLElement("http://localhost/dolar/datos.xml", null, true);
$hoy=(string)$xml->otros->precio[0];
$ayer=(string)$xml->otros->precio[0];
print "-->".substr($hoy*1.99,0,5);
print "<pre>";
print_r($xml);
foreach ($xml as $value) {
    print_r($value);
}


?>