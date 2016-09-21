<?php 
    $host = "localhost";
    //$user = "root"; $pwd = "";
    $user = "karincac_sparra";  $pwd = "karinca123";
    $BD = "karincac_desarrollo";
    $consultaServicio = "SELECT codigo, desscripcion FROM Servicio ORDER BY 1 ASC";
    $consultaEntidad = "SELECT codigo, descripcion FROM Tipo_entidad ORDER BY 1 ASC";
    $conexion = new mysqli($host, $user, $pwd,$BD);
    if ($conexion->connect_errno) {
        printf("Conexión fallida: %s\n", $conexion->connect_error);
        exit();
    }
    else
    {
        echo '<script type="text/javascript">console.log("Conexion establecida")</script>';
    }    
 ?>