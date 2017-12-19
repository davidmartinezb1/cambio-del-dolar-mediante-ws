<?php
require_once("acceso_db.php");

$consulta="select * from dolar";
$results=mysql_query($consulta,$conexion);

while($row=mysql_fetch_array($results))

{
   $data[] = $row[0].$row[1];
}

?>
