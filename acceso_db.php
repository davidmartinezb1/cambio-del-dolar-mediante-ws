 <?php
    $host_db = "localhost"; // Host de la BD
    $usuario_db = "root"; // Usuario de la BD
    $clave_db = "3007158444"; // Contraseña de la BD
    $nombre_db = "tasa_de_cambio"; // Nombre de la BD
    
    //conectamos y seleccionamos db
    $conexion = @mysql_connect($host_db, $usuario_db, $clave_db);
				// si la conexion falla
				if(!$conexion)
					{
						$mensaje="<p>Error: No se puede conectar al servidor</p>\n";
						exit();
					}
    $bd = @mysql_select_db($nombre_db);
	if(!$bd)
		{
			echo"Error de Conexion Intente Mas Tarde";
			exit();
		}
?> 