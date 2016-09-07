<?php 
	
	$entidad = $_POST['entidad'];
	$nombre = $_POST['nombre'];
	$rut = $_POST['rut'];
	$telefono = $_POST['telefono'];
	$email = $_POST['email'];
	$servicio = $_POST['servicio'];
	$comentario = $_POST['comentario'];
	$emailContacto = "contacto@karinca.cl";

	if (($entidad!='')&&($nombre!='')&&($rut!='')&&($telefono!='')&&($email!='')&&($servicio!='')&&($comentario!='')) {
		$titulo = "Contacto Karinca";
		$cuerpo1 = $nombre." se ah puesto en contacto \r\n";
		$cuerpo1 .= "RUT: ".$rut."\r\n";
		$cuerpo1 .= "Email: ".$email."\r\n";
		$cuerpo1 .= "Télefono: ".$telefono."\r\n";
		$cuerpo1 .= "Comentario: ".$comentario."\r\n";

		$cuerpo = // cuerpo en formato HTML. falta darle correcto formato
		'
		 <html>
		 <head>
		 	<title>'.$titulo.'</title>
		 </head>
		 <body>
		 	<h1>'.$nombre.'gener&oacute; una cotizaci&oacute;n </h1>
		 	<hr>
		 	<table>
		 		<tr>
		 			<td>Entidad</td><td>'.$entidad.'</td>
		 		</tr>
		 		<tr>
		 			<td>RUT</td><td>'.$rut.'</td>
		 		</tr>
		 		<tr>
		 			<td>Nombre</td><td>'.$nombre.'</td>
		 		</tr>
		 		<tr>
		 			<td>Email</td><td>'.$email.'</td>
		 		</tr>
		 		<tr>
		 			<td>Servicio</td><td>'.$servicio.'</td>
		 		</tr>
		 		<tr>
		 			<td>Comentario</td><td>'.$comentario.'</td>
		 		</tr> 		
		 	</table>
		 </body>
		 </html>
		';
		$encabezado = "MINE-VERSION: 1.0 \r\n";
		$encabezado.= "Content_type: text/html; charset=UTF-8\r\n";
		$encabezado.= "From: www.karinca.cl <cotizacion@karinca.cl/> \r\n";
		$encabezado.= "Reply-To: cotizacion@karinca.cl \r\n";

		$envio = mail($emailContacto,$titulo,$cuerpo1,$encabezado);
		if ($envio) {
			echo "ok";
		}else{
			echo "error";
		}

		}
	else{
		echo "error";
	}
 ?>

