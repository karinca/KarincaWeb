<?php
    
    require_once dirname( __FILE__ ).'/../controller/PostulanteControllerClass.php';   
    require_once dirname( __FILE__ ).'/../controller/SessionControllerClass.php';
      require_once dirname( __FILE__ ).'/../dao/PostulanteDAOClass.php'; 
      
    $controller = new PostulanteController();
    $session = new SessionController();            

?>

    <script>

        jQuery(document).ready(function() {

            jQuery("input[name='rut']").Rut({
                format_on: 'keyup',
              
            });

            jQuery("input[type='submit']").click(function(event){
                var rutFormateado = jQuery("#rutFormart").val();
                 if(!jQuery.Rut.validar(rutFormateado)){
                     event.preventDefault();
                     $('#mostrar-errores').modal('show');
                 }
                 var rut = jQuery.Rut.quitarFormato(rutFormateado);
                 var mantisa = rut.substr(0,rut.length-1);
                 jQuery("input[name='id']").val(mantisa);
                                        
                
            });



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
                
            if (pass1.length == 0 || pass2.length == 0) {
                    alert("Los campos de la password no pueden quedar vacios");
                    return false;
                }    
                
             if (pass1 != pass2) {
                    alert("Las passwords deben de coincidir");
                    return false;
                  } else {
                    alert("Todo esta correcto");
                    return true; 
                  }   
        };
    </script>
    
    <div class="container">
<?php        
        if($session->isPublicador() || $session->isAdministrador()||$session->isLogged()==FALSE) {        
?>
            <header>
<?php
    if($session->isLogged()){
?>		      
                <h1>Agregar Usuario</h1>            
<?php
        } else {
?>         		
                <h1>Registro de Usuarios</h1>         
<?php
        }
?> 
        </header>
        

            <div class="ajax-loading">
                <img src="img/ajax-loader.gif" />
            </div>
            
            <section>
                
                <form action="index.php?vista=usuarios" onSubmit="return validarPass()" method="POST" class="form-horizontal" role="form">
                    <fieldset>
                        <legend>Datos del Nuevo Miembro</legend>
                        <input type="hidden" name="operacion" value="agregar" />
                        
                        <div class="form-group-sm has-feedback">
                            <div class="col-sm-4">
                                <label for="rut">RUT</label>
                                <input class="form-control" type="hidden" name="id" value="" />
                                <input required id="rutFormart" class="form-control" type="text" name="rut" value="" maxlength="12"/>
                                <span class="glyphicon glyphicon-ok form-control-feedback hidden"></span>
                                <span class="glyphicon glyphicon-remove form-control-feedback hidden"></span>
                            </div>                    
                            <div class="col-sm-4">
                                <label for="nombre">Nombre</label>
                                <input required id="nombre" class="form-control" type="text" name="nombre" value="" />
                            </div>
                            <div class="col-sm-4">
                                <label for="apellidoPaterno">Apellido Paterno</label>
                                <input required id="apellidoPaterno" class="form-control" type="text" name="apellidoPaterno" value="" />
                            </div>
                        </div>
                        
                        <div class="form-group-sm">
                            <div class="col-sm-4">
                                <label for="apellidoMaterno">Apellido Materno</label>
                                <input required id="apellidoMaterno" class="form-control" type="text" name="apellidoMaterno" value="" />
                            </div>
                            <div class="col-sm-4">
                                <label for="email">E-Mail</label>
                                <input required id="email" class="form-control" type="email" name="email" value="" />
                            </div>
                            <div class="col-sm-4">
                                <label for="fechanacimiento">Fecha de Nacimiento</label>
                                <input required id="fechanacimiento" class="form-control" type="date" name="fecha_nacimiento" value="" />
                            </div>
                        </div>
                        
                        <div class="form-group-sm">
                            <div class="col-sm-12">
                                <label>Comuna de residencia</label>
                                <div class="col-sm-12">                            
                                   <div class="col-sm-4">
                                       <select name="region" class="form-control">
                                           <option value="">-- Seleccione una Región --</option>
                                       </select>
                                   </div>
                                   <div class="col-sm-4">
                                       <select name="provincia" class="form-control">
                                           <option value="">-- Seleccione una Provincia --</option>
                                       </select>
                                   </div>
                                   <div class="col-sm-4">
                                       <select name="comuna" class="form-control">
                                           <option value="">-- Seleccione una Comuna --</option>
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
                                    <input type="radio" id="sexom" name="sexo" value="M" checked />
                                    <label for="sexom">Masculino</label>  
                                </div>
                                <div class="col-sm-12">
                                    <input type="radio" id="sexof" name="sexo" value="F" />
                                    <label for="sexof">Femenino</label>
                                </div>
                            </div>
<?php
    if($session->isLogged()){
?>
                            <div class="col-sm-3">
                                <label>Perfil</label> 
                                <div class="col-sm-12">
                                    <input type="radio" id="admin" name="perfil" value="admin"  />
                                    <label for="admin">Administrador</label>  
                                </div>
                                <div class="col-sm-12">
                                    <input type="radio" id="sexof" name="perfil" value="usuario" checked />
                                    <label for="sexof">Usuario</label>
                                </div>
                            </div>
<?php
        }
?>
                            <div class="col-sm-3"></div>
                        </div>        
                        
                        <div class="form-group-sm col-sm-12">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3">
                                <label for="clave1">Contraseña</label>
                                <input required id="clave1" class="form-control" type="password" name="clave" value="" /> 
                            </div>
                            <div class="col-sm-3">
                                <label for="clave22">Repetir Contraseña</label>
                                <input required id="clave22" class="form-control" type="password" name="clave2" value="" />
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        
                    </fieldset>
                  
                    <br />
                    
                    <div class="form-group-sm text-center">
                        <input class="btn btn-default" type="button" name="cancelar" value="Cancelar" onclick="location.href='index.php?vista=usuarios'" />
                        <input class="btn btn-primary" type="submit" name="guardar" value="Guardar" />
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
        