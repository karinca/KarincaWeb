
<?php
    
    require_once dirname( __FILE__ ).'/../controller/UsuarioControllerClass.php';   
    require_once dirname( __FILE__ ).'/../controller/LoginControllerClass.php'; 
    require_once dirname( __FILE__ ).'/../controller/SessionControllerClass.php';
    require_once dirname( __FILE__ ).'/../dao/UsuarioDAOClass.php'; 
    
    $controller = new PostulanteController();
    $session = new SessionController(); 
    $login=new LoginController();
    
    if(isset($_GET["rutCliente"])) {
        $rut = $_GET["rutCliente"];
        
        /* @var $usuario Postulante */
        $usuario = $controller->gePostulantePorId($rut);
    }
   
?>  

        <script>

            jQuery(document).ready(function() {
                jQuery("input[name='rut']").each(function() { 
                        var mantisa = jQuery(this).val();
                        var rut = mantisa +'-'+ jQuery.Rut.getDigito(mantisa)
                        var rutFormateado = jQuery.Rut.formatear(rut,true);
                        jQuery(this).val(rutFormateado);
                });
            })

        </script>
 <?php
 if($session->isUsuario()){
 ?>       
        <script>

            jQuery(document).ready(function() {
                
                if(jQuery("#perfilUser").val()=="usuario"){
                $(":input").attr('readonly',true);
                $(":radio:not(:checked)").attr('disabled',true);
                $("input[name='clave']").attr('readonly',false);
                $("input[name='clave2']").attr('readonly',false);
            }
                });
            
        </script>
       <?php
 }
       ?>
    <script>

        jQuery(document).ready(function() {

            jQuery.getJSON("ajax.php?json=regiones",{},function(jsonResponse){
                jQuery.each(jsonResponse, function(clave, valor){                        
                    //console.log("<option value=\""+valor.codigo+"\">"+valor.nombre+"</option>\n");
                    jQuery("<option>").attr("value",valor.codigo).text(valor.nombre).appendTo("select[name='region']");
                })
            });

            jQuery("select[name='region']").change(function(){
                jQuery("div.ajax-loading").css("visibility","visible");
                var codigoRegion = jQuery(this).val();
                jQuery("select[name='provincia'] option").remove();
                jQuery("<option>").attr("value","").text("-- Seleccione una Provincia --").appendTo("select[name='provincia']");
                jQuery("select[name='comuna'] option").remove();
                jQuery("<option>").attr("value","").text("-- Seleccione una Comuna --").appendTo("select[name='comuna']");

                jQuery.getJSON("ajax.php?json=provincias", {region:codigoRegion}, function(jsonResponse){
                    jQuery.each(jsonResponse, function(clave, valor){ 
                        //console.log("<option value=\""+valor.codigo+"\">"+valor.nombre+"</option>\n");
                        jQuery("<option>").attr("value",valor.codigo).text(valor.nombre).appendTo("select[name='provincia']");
                    });
                    
                    
                    

                    jQuery("div.ajax-loading").css("visibility","hidden");
                });
                
            });
            
            jQuery("select[name='provincia']").change(function(){
                jQuery("div.ajax-loading").css("visibility","visible");
                var codigoProvincia = jQuery(this).val();
                jQuery("select[name='comuna'] option").remove();
                jQuery("<option>").attr("value","").text("-- Seleccione una Comuna --").appendTo("select[name='comuna']");

                jQuery.getJSON("ajax.php?json=comunas", {provincia:codigoProvincia}, function(jsonResponse){
                    jQuery.each(jsonResponse, function(clave, valor){ 
                        //console.log("<option value=\""+valor.codigo+"\">"+valor.nombre+"</option>\n");
                        jQuery("<option>").attr("value",valor.codigo).text(valor.nombre).appendTo("select[name='comuna']");
                    });
                    
                    
                    

                    jQuery("div.ajax-loading").css("visibility","hidden");
                });
                
            });
        })

    </script>
    
      
    <script>
        function validarPass(){
         var rut=document.getElementById("idcliente").value;
         var pass1=document.getElementById("clave1").value;
          var pass2=document.getElementById("clave22").value;
          var espacios = false;
          var cont = 0;
          
                while (!espacios && (cont < pass1.length)) {
                  if (pass1.charAt(cont) == " ")
                    espacios = true;
                  cont++;
                }

                if (espacios) {
                  alert ("La contraseña no puede contener espacios en blanco");
                  return false;
                }
                /*
            if (pass1.length == 0 || pass2.length == 0) {
                    alert("Los campos de la password no pueden quedar vacios");
                    return false;
                } */   
                
             if (pass1 != pass2) {
                    alert("Las passwords deben de coincidir");
                    return false;
                  } else {
                
                    return true; 
                  }   
                  
                  
        };
    </script>
    
    
  
    <div class="container">
<?php        
        if($session->isPublicador() || $session->isAdministrador()||$session->isUsuario()) {        
?>
    
		
            <header>
                <h1>Editar Usuario</h1>
            </header>

            <div class="ajax-loading">
                <img src="img/ajax-loader.gif" />
            </div>
            
            <section>
                
                <form action="index.php?vista=usuarios" onSubmit="return validarPass()" method="POST" class="form-horizontal" role="form">
                    <fieldset>
                        <legend>Datos del Usuario</legend>
                        <input type="hidden" name="operacion" value="editar" />
                        
                        <div class="form-group-sm has-feedback">
                            <div class="col-sm-4">
                                 <label for="idcliente">RUT</label>
                                <input class="form-control" type="hidden" name="id" value="<?= $usuario->getRut() ?>" />
                                <input id="idcliente" readonly class="form-control" type="text" name="rut" value="<?= $usuario->getRut() ?>" />
                            </div>                    
                            <div class="col-sm-4">
                                <label for="nombre">Nombre</label>
                                <input required id="nombre" class="form-control" type="text" name="nombre" value="<?= $usuario->getNombre() ?>" />
                            </div>
                            <div class="col-sm-4">
                                <label for="apellidoPaterno">Apellido Paterno</label>
                                <input required id="apellidoPaterno" class="form-control" type="text" name="apellidoPaterno" value="<?= $usuario->getApellidoPaterno() ?>" />
                            </div>
                        </div>
                        
                        <div class="form-group-sm">
                            <div class="col-sm-4">
                                <label for="apellidoMaterno">Apellido Materno</label>
                                <input required id="apellidoMaterno" class="form-control" type="text" name="apellidoMaterno" value="<?= $usuario->getApellidoMaterno() ?>" />
                            </div>
                            <div class="col-sm-4">
                                <label for="email">E-Mail</label>
                                <input required id="email" class="form-control" type="email" name="email" value="<?= $usuario->getEmail() ?>" />
                            </div>
                            <div class="col-sm-4">
                                <label for="fechanacimiento">Fecha de Nacimiento</label>
                                <input required id="fechanacimiento" class="form-control" type="date" name="fecha_nacimiento" value="<?= $usuario->getFechaNacimiento() ?>" />
                            </div>
                        </div>
                        
                        <div class="form-group-sm">
                            <div class="col-sm-12">
                                <label>Comuna de residencia</label>
                                <div class="col-sm-12">                            
                                   <div class="col-sm-4">
                                       <select name="region" class="form-control">
                                           <option value=""><?= $usuario->getComuna()->getProvincia()->getRegion()->getNombre() ?></option>
                                       </select>
                                   </div>
                                   <div class="col-sm-4">
                                       <select name="provincia" class="form-control">
                                           <option value=""><?= $usuario->getComuna()->getProvincia()->getNombre() ?></option>
                                       </select>
                                   </div>
                                   <div class="col-sm-4">
                                       <select name="comuna" class="form-control">
                                           <option value=""><?= $usuario->getComuna()->getNombre() ?></option>
                                       </select>
                                   </div>                            
                                </div>
                            </div>  
                        </div>
                        
                        

                        <div class="form-group-sm col-sm-12">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3">                                
                                <label>Sexo</label> 
                                <div class="col-sm-12">
                                    <input type="radio" id="sexom" name="sexo" value="M" <?= ($usuario->isHombre())?"checked":"" ?> />
                                    <label for="sexom">Masculino</label>  
                                </div>
                                <div class="col-sm-12">
                                    <input type="radio" id="sexof" name="sexo" value="F" <?= ($usuario->isMujer())?"checked":"" ?> />
                                    <label for="sexof">Femenino</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label>Perfil</label> 
                                <div class="col-sm-12">
                                    <input type="radio" id="admin" name="perfil" value="admin" <?= ($usuario->getPerfil()=="admin")?"checked":"" ?>  />
                                    <label for="admin">Administrador</label>  
                                </div>
                                <div class="col-sm-12">
                                    <input type="radio" id="perfilUser" name="perfil" value="usuario" <?= ($usuario->getPerfil()=="usuario")?"checked":"" ?> />
                                    <label for="perfilUser">Usuario</label>
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>        
                        
                        <div class="form-group-sm col-sm-12">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3">
                                <label for="clave1">Contraseña</label>
                                <input  id="clave1" class="form-control" type="password" name="clave" value="" /> 
                            </div>
                            <div class="col-sm-3">
                                <label for="clave22">Repetir Contraseña</label>
                                <input id="clave22" class="form-control" type="password" name="clave2" value="" />
                            </div>
                          

                            <div class="col-sm-3"></div>
                        </div>
                        
                    </fieldset>
                  
                    <br />
                    
                    <div class="form-group-sm text-center">
                        <input class="btn btn-default" type="button" name="cancelar" value="Cancelar" onclick="location.href='index.php?vista=usuarios'" />
                        <input class="btn btn-primary" id="btn-autenticar" type="submit" onclick="" name="guardar" value="Guardar" />
                    </div>
                </form>
                
                <div class="modal fade" id="mostrar-errores" role="dialog">
                    <div class="modal-dialog">
                      <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Agregar Miembro</h4>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-danger">
                                    <p>El RUT no es válido</p>
                                </div>
                            </div>
                            <div class="modal-footer">                                
                                <input type="button" class="btn btn-primary"  data-dismiss="modal" value="Aceptar" />                           
                            </div>
                        </div>
                    </div>
                </div>
                
            </section>
            

<?php
        } else {
?>

            <div class="alert alert-danger fade in">				
                <b>Error: </b> usted no dispone de privilegios para acceder a esta página.
            </div>
<?php 
        }
?>
    </div>        
                