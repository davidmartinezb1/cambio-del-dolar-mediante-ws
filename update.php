<?php
include("acceso_db.php");
require_once('webservice/client.php');

//cliclo para insertar el historico del trm
/*foreach ($xml as $value) {
    //print_r($value);
	$fecha_texto=(string)$value->Column4." ".$value->Column3." de ".$value->Column0;
	$fecha=(string)$value->Column1;
	$valor=(string)$value->Column2;
	$valor=convert_trm($valor);
	insert($fecha,$valor,$fecha_texto);
}*/

// insert del trm del dia
$fecha_texto=(string)$xml->Row[0]->Column4." ".$xml->Row[0]->Column3." de ".$xml->Row[0]->Column0;
$fecha=(string)$xml->Row[0]->Column1;
$valor=(string)$xml->Row[0]->Column2;
$valor=convert_trm($valor);
insert($fecha,$valor,$fecha_texto);

function convert_trm($valor){
	$valor=explode(".",$valor);
	$centavos=(int)$valor[1];
	$num=strlen($centavos);
	if($num==1){$centavos="0".$centavos;}
	$num2=strlen($valor[0]);
	if($num2==4){
		$valor=$valor[0];
		$valor_1=substr($valor,0,1);
		$valor_2=substr($valor,1,$num2);
		print $valor=$valor_1.".".$valor_2.",".$centavos;
	}else{
		print $valor=$valor[0].",".$centavos;
	}
	return $valor;
}

function insert($fecha_trm,$trm,$fecha_texto){
	$sqlinsert="insert  into dolar (fecha,precio,fecha_texto) values ('$fecha_trm','$trm','$fecha_texto')";
	mysql_query($sqlinsert) or die('Error en el sistema: ' . mysql_error());
	if($sqlinsert) 
		{
			echo "Ingreso Exitoso<br>";
			
		}
	else 
		{
			echo "Falla en ingreso<br>";
		}
}
// insert de los datos del trm del dia
?>