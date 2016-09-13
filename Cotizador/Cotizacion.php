<!-- Navigation -->

<?php 
    $host = "localhost";
    //$user = "root";
    //$pwd = "";
    $user = "karincac";    
    $pwd = "eliaz.119_";
    
    $BD = "karincac_desarrollo";
    $consultaServicio = "SELECT codigo, desscripcion FROM servicio ORDER BY 1 ASC";
    $consultaEntidad = "SELECT codigo, descripcion FROM tipo_entidad ORDER BY 1 ASC";
    $conexion = new mysqli($host, $user, $pwd,$BD);
    $resultadoServicio = $conexion->query($consultaServicio);
    $resultadoEntidad = $conexion->query($consultaEntidad);
    //$fila = mysqli_fetch_assoc($resultado);
    //echo $fila['desscripcion'];    
    //echo "Conexión exitosa!";
?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>Cotizaci&oacute;n</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="AppDemo de PHP">
        <meta name="author" content="o.rodriguezv@profesor.duoc.cl">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="icon" href="img/ant3.ico" />

        <title>KARINCA</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/custom.css" rel="stylesheet">
        <link href="css/simple-sidebar.css" rel="stylesheet">
        <link href="css/fonts.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
        <!--Codigo de cotizacion-->
        <script src="js/Cotizacion.js"></script>

        <!-- Plugin jQuery para RUT -->
        <script src="js/jquery.Rut.min.js"></script>
         <!-- Plugin jQuery para Slides -->
        <script src="js/jquery.slides.js"></script>
        <!--<script src="js/jquery.slides.min.js"></script>-->
 </head>
 <body id="cotizacion">

    <button  id="cotizar" class="btn btn-warning pull-right">Cotizar <span class="glyphicon glyphicon-send"></span></button>
 
 </body>


<!-- Modal Cotizacion -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

<div id="modal-cotizacion" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cotizaci&oacute;n</h4>
      </div>
      <div class="modal-body" >
                <div id="box">
                    <h2>Formulario de cotización</h2>                       
                    <h4 id="sub">(*) Campo obligatorio</h4> 
                    <label for="Entidad"> *Tipo entidad </label>
                    <select id="Entidad" name="Entidad" class="form-control input-modal" required="required">
                        <?php 
                             while($filaEntidad = $resultadoEntidad->fetch_assoc()){                           
                                    printf ('<option value="%s">%s</option>',$filaEntidad['codigo'],$filaEntidad['descripcion']); 
                                    //$resultadoEntidad->free();
                             }
                         ?>                                             
                    </select>
                    <script type="text/javascript"></script>
                    <div class="form-group has-feedback">
                        <label class="control-label">*Nombre o razón social</label>                        
                        <i class="glyphicon glyphicon-user form-control-feedback"></i>
                        <input name="nombre" id="nombre" type="text" class="form-control" placeholder="Nombre o razón social" />
                    </div>
                    <div class="form-group has-feedback">
                        <label class="control-label"> *Rut </label>
                        <i class="glyphicon form-control-feedback glyphicon-pencil"></i>
                        <input name="rut" id="rut" placeholder="Rut" class="form-control" type="text">
                    </div>
                     <div class="form-group has-feedback">
                        <label class="control-label"> *Teléfono  </label>
                        <i class="glyphicon glyphicon-earphone form-control-feedback"></i>
                        <input name="telefono" id="telefono" placeholder="Teléfono" class="form-control" type="text">
                    </div>
                    <div class="form-group has-feedback">
                        <label class="control-label"> *Email   </label>
                        <i class="glyphicon glyphicon-envelope form-control-feedback"></i>
                        <input name="email" id="email" placeholder="E-Mail" class="form-control" type="text">
                    </div>
                    <label > *Servicio </label>
                    <select id="servicio" name="servicio" class="form-control" required="required">
                        <?php 
                             while($filaservicio = $resultadoServicio->fetch_assoc()){                                
                                printf ('<option value="%s">%s</option>',$filaservicio['codigo'],$filaservicio['desscripcion']);                                  
                             }                             
                             //$resultadoServicio->free();
                             $conexion->close();
                         ?>                                             
                    </select>
                    <div class="form-group has-feedback">
                        <label class="control-label"> *Comentario   </label>
                        <i class="glyphicon glyphicon-comment form-control-feedback"></i>
                        <textarea class="form-control" id="comentario" name="comentario" placeholder="Comentario"></textarea>
                    </div>
                </div>
      </div>
      <div class="modal-footer">
        <button  id="enviar" class="btn btn-warning pull-right">Enviar <span class="glyphicon glyphicon-send"></span></button>
        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cerras</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal Informacion -->
<div class="modal fade" id="modal" tabindex="-1" data-backdrop=”static” role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div id="modal-cabecera" class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </button>            
        </div>
        <div  class="modal-body cuerpo centre">     
                </div>
        <div class="modal-footer texto-centrado">     
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button id="volverEI" type="button" class="btn btn-danger btn-lg" style="width: 100%;">
                <span class="glyphicon glyphicon-repeat"></span> 
                Volver
                </button>
            </div>
        </div>
  </div>
  </div>
  </div>
 </html>
