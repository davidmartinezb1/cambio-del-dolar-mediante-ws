<?php
require_once("acceso_db.php");
$data=date('Y');
print $data=$data."-0-0";
/*
$consulta="select * from dolar WHERE fecha >= ''";
$results=mysql_query($consulta,$conexion);

while($row=mysql_fetch_array($results))

{
   $data[] = $row[0].$row[1];
}
*/
$consulta2="SELECT * FROM dolar ORDER BY fecha DESC LIMIT 16";
$results2=mysql_query($consulta2,$conexion);
$dolar=array();
$dolar['precio']=array();
$dolar['fecha']=array();
while($row2=mysql_fetch_array($results2))
{
    array_push($dolar['precio'],$row2[1]);
    array_push($dolar['fecha'],$row2[0]);
}
print "<pre>";
print $dolar['precio'][0];
print_r($dolar);
//s$data=replace_character($data2[0],$data2[1]);

created_xml_data($dolar);



function created_xml_data($data){

    $doc = new DOMDocument('1.0', 'UTF-8');
    $newnode = $doc->createElement("dolar");
    $newnode = $doc->appendChild($newnode);  


    $nodo_otros = $doc->createElement("otros");
    $nodo_otros = $newnode->appendChild($nodo_otros);

    for ($i = 0; $i < 16; $i++) {
        $precio = $doc->createElement("precio",$data['precio'][$i]);
        $precio = $nodo_otros->appendChild($precio);

        $fecha = $doc->createElement("fecha",$data['fecha'][$i]);
        $fecha = $nodo_otros->appendChild($fecha);
    }    

    $doc->formatOutput = true;  
    $strings_xml = $doc->saveXML(); 
    $doc->save("datos.xml");
    chmod("datos.xml", 0777);

    
}


?>
