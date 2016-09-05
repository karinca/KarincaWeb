<!-- Navigation -->

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Cotizacio&oacutte;n</title>
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

        <!-- Plugin jQuery para RUT -->
        <script src="js/jquery.Rut.min.js"></script>
         <!-- Plugin jQuery para Slides -->
        <script src="js/jquery.slides.js"></script>
        <!--<script src="js/jquery.slides.min.js"></script>-->
 </head>
 <body>
 	<div class="container">
    <div class="row">          
                     <div class="col-md-offset-4 col-md-4" id="box">
                      <h2>Formulario de cotización</h2>                       
                      <h4 id="sub">(*) Campo obligatorio</h4> 
                            <hr>
                            <form class="form-horizontal" action=" " method="" id="formulario-cotizacion">
                                    <fieldset>
                                    <div class="form-group">                                    
                                        <div class="col-md-12">
                                            <label for="Entidad"> *Tipo entidad </label>
                                            <select id="Entidad" name="Entidad" class="form-control" required="required">
                                                <option value="na" selected="">Seleccione</option>
                                                <option value="1">Persona Natural</option>
                                                <option value="2">Persona Jurídica</option>
                                            </select>
                                        </div>
                                    </div>     
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="nombre"> *Nombre o razón social </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                    <input name="nombre" placeholder="Nombre o razón social" class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>                                  
                                        <!-- Text input-->
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="nombre"> *Rut </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                                    <input name="rut" placeholder="Rut" class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Text input-->
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="nombre"> *Teléfono </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                                    <input name="telefono" placeholder="Teléfono" class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Text input-->
                                         <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="nombre"> *Email </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                                    <input name="email" placeholder="E-Mail" class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Text input-->
                                        <div class="form-group">                                    
                                            <div class="col-md-12">
                                                <label for="Entidad"> *Servicio </label>
                                                <select id="Entidad" name="Entidad" class="form-control" required="required">
                                                    <option value="na" selected="">Seleccione</option>
                                                    <option value="1">Aplicación de Escritorio</option>
                                                    <option value="2">Aplicacion Móvil</option>
                                                    <option value="3">Aplicacion Web</option>
                                                    <option value="4">Otros</option>
                                                </select>
                                            </div>
                                        </div>  
                                        <!-- Text input-->
                                        <div class="form-group">
                                            <div class="col-md-12 inputGroupContainer">
                                            <label for="comentario"> *Comentario </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-comment"></i></span>
                                                    <textarea class="form-control" id="comentario" name="comentario" placeholder="Comentario"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-warning pull-right">Enviar <span class="glyphicon glyphicon-send"></span></button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form> 
    </div>
</div>
 </body>
 </html>