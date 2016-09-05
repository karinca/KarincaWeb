<?php
    
    require_once dirname( __FILE__ ).'/../controller/PostulanteControllerClass.php';   
    require_once dirname( __FILE__ ).'/../controller/SessionControllerClass.php';
    
    $controller = new PostulanteController();
    $session = new SessionController();            

?>
<script>

                jQuery(document).ready(function(){

                        jQuery("button[name='agregar']").click(function(){
                                window.location.href = "index.php?vista=agregar";
                        });

                        jQuery("button[name='editar']").click(function(){
                                var idCliente = jQuery(this).data("id-cliente");
                                window.location.href = "index.php?vista=editar&rutCliente="+idCliente;
                        });                

                        jQuery("button[name='eliminar']").click(function(){
                                var idCliente = jQuery(this).data("id-cliente");
                                jQuery("input[name='rutClienteElimina']").val(idCliente);
                        });
                        

                        jQuery(".table tbody tr td:first-child").each(function() { 
                            var mantisa = jQuery(this).text();
                            var rut = mantisa +'-'+ jQuery.Rut.getDigito(mantisa)
                            var rutFormateado = jQuery.Rut.formatear(rut,true);
                            jQuery(this).text(rutFormateado);
                        }); 
                        
                        

                 /*  jQuery("select[name='usuarios']").change(function(){
                        jQuery("div.ajax-loading").css("visibility","visible");
                        
                        var sirut)jQuery().Rut.quitarFormato(rur);
                        jQuery.getJSON("ajax.php?json=user", {rut:sirut}, function(jsonResponse){
                        jQuery.each(jsonResponse, function(clave, valor){ 
                        //console.log("<option value=\""+valor.codigo+"\">"+valor.nombre+"</option>\n");
                        var newRow =
			"<tr>"
			+"<td>"+jQuery.Rut.formatear(cliente.rut+jQuery.Rut.getDigito(cliente.rut),true)+"</td>"
			+"<td>"+cliente.nombre+"</td>"
			+"<td>"+cliente.apellidoPaterno+"</td>"
			+"<td>"+cliente.apellidoMaterno+"</td>"
			+"<td>"+cliente.email+"</td>"
			+"<td>"+cliente.fechaNacimiento+"</td>"
                        +"<td>"+cliente.comuna.provincia.region.nombre+"</td>"
			+"<td>"+cliente.comuna.nombre+"</td>"
                        
                        +"</tr>";
                       
                 	$(newRow).appendTo("#tablajson");
                    });

                    jQuery("div.ajax-loading").css("visibility","hidden");
                });
            });*/
                        		
                 /*      $.ajax({  
                            url: 'usuario.php',  
                            success: function(data) {  
                                $('#div_dinamico_anim').html(data);  
                                $('#div_dinamico_anim true').slideDown(1000);  
                            }  
                        });  
*/
                })            

        </script>

        <?php
        if(!$session->isLogged())
        {
       ?>
        <script>
            jQuery(document).ready(function(){

                        
                                window.location.href = "index.php?vista=inicio";
                        
                        });

        </script>
        <?php   
        } 
        ?>
        ?>
        <div class="container"  style="width: 1700pX;">
        <!-- Page Content -->
        

            <hr>

                <header>
                    <h1>Listado de Miembros</h1>
                </header>
           
            
            
    <?php
            if($controller->getIndicadorExito()) {
    ?>            
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <b><?= $controller->getMensajeExito() ?></b>
                </div>
    <?php
            }
    ?>     
    <?php 
            if($controller->getIndicadorError()) {
    ?>            
                <div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <b><?= $controller->getMensajeError() ?></b>
                </div>
    <?php 
            }
    ?>             
                <section  style="float: left; margin-left:150px;">

                    <table class="table" id="tablajson">
                        <div>
                        <thead>
                            <tr style="padding-top: 10px;">
                                <th>RUT</th>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>E-Mail</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Region</th>
                                <th>Comuna</th>
                                
                                
                                                           
                            </tr>
                        </thead>
                        </table>  
                    <table >
    
                            <script>

			$(document).ready(function(){
			var url="ajax.php?json=usuarios";
                        
			$("#tablajson tbody").html("");
			$.getJSON(url,function(clientes){
			$.each(clientes, function(i,cliente){
                         
			var newRow =
			"<tr>"
                        +"<td>"+jQuery.Rut.formatear(cliente.rut+jQuery.Rut.getDigito(cliente.rut),true)+"</td>"
			+"<td>"+cliente.nombre+"</td>"
			+"<td>"+cliente.apellidoPaterno+"</td>"
			+"<td>"+cliente.apellidoMaterno+"</td>"
			+"<td style='padding-top: 2px;'>"+cliente.email+"</td>"
			+"<td>"+cliente.fechaNacimiento+"</td>"
                        +"<td>"+cliente.comuna.provincia.region.nombre+"</td>"
			+"<td>"+cliente.comuna.nombre+"</td>"
                        
                        /*+"<td style='padding-top: 1px;'>"+"<button  id='edita' class='btn btn-primary' name='editar' data-id-cliente="+cliente.rut+">"
                        +"<span class='glyphicon glyphicon-pencil'></span>"+
                        "</button>"*/
                        +"</tr>"
                        
                           
                
			$(newRow).appendTo("#tablajson");
                        
			});
			});
			});

			</script>
                    
                    </table>



                </section>
        
   
        
            <section style="margin-top: 45px;   ">
                <table>
                    
       <?php
        foreach ($controller->getListaPostulante() as $miembro) {
            /* @var $miembro Postulante */
    ?>        
                        
    <?php
        if($session->isEditor() || $session->isAdministrador()||$session->isUsuario() && $session->getRutUsuario()==$miembro->getRut() ) {
            ?>                  <tr >       
                                    <td style="padding-top: 4px;"><button  id="edita" class="btn btn-primary" name="editar" data-id-cliente="<?= $miembro->getRut() ?>">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                        </button>
                    
    <?php
        }

        if($session->isAdministrador()) {
        ?>                                 
                                        <button  class="btn btn-danger" name="eliminar" data-id-cliente="<?= $miembro->getRut() ?>"  data-toggle="modal" data-target="#confirmarEliminar" >
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                        
        <?php
            }
        ?>                                 
                    
    <?php							
            if($session->isEditor() || $session->isAdministrador()) {
    ?>
                    <a>Acción</a>
    <?php		
            }
    ?>      
                    
    <?php							
            if($session->isUsuario() && $session->getRutUsuario()==$miembro->getRut()) {
    ?>
                    <label>Editar <?= $miembro->getNombre()." ".$miembro->getApellidoPaterno() ?> </label>
    <?php		
            }
    ?>      
                    
                                    </td>
                                   </tr>
                                      <?php
        }
    ?>    
                        </tbody>
                        <tfoot>
                            <tr>
                                <td  style="padding-top: 20px;" colspan="7">
    <?php
        if($session->isPublicador() || $session->isAdministrador()) {
    ?>                                
                                    <button  class="btn btn-primary" name="agregar" >
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>  <a>Agregar Usuarios</a>
    <?php
        }
    ?>    
                                </td>
                            </tr>
                        </tfoot>

                        </tbody>
                    
                                            <div class="modal fade" id="confirmarEliminar" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Eliminar Usuario</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger">
                                        ¿Está seguro de eliminar el usuario?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="index.php?vista=usuarios">
                                        <input type="hidden" name="operacion" value="eliminar" />
                                        <input type="hidden" name="rutClienteElimina" value="" />
                                        <input name="confirmacionEliminar" type="submit" class="btn btn-default"  value="Si" />
                                        <input type="button" class="btn btn-primary"  data-dismiss="modal" value="No" />
                                    </form>                                
                                </div>
                            </div>
                        </div>
                    </div>

                </table>
            </section>
       
        </div>        
        
        