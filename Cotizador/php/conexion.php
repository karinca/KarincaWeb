<?php
	$host = "186.64.116.50";
	$user = "karincac_usuario";
	$pwd = "Karinca123.";

	$conexion = mysql_connect( $host, $user, $pwd ) or die( "Error de conexión: " . mysql_error() );
	mysql_database("karincac_desarrollo",$conexion);
	$q = mysql_query("select * from Servicio",$conexion);
	$resultado =  mysql_result(mysql_query("select * from Servicio"),1);
	echo $resultado;
	echo "Conexión exitosa!";
	mysql_close( $conexion ); 
?>