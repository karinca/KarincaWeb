<?php    
    require_once dirname( __FILE__ ).'/../controller/SessionControllerClass.php';
    $session = new SessionController();
?>
    <!-- Image Background Page Header -->
    <!-- Note: The background image is set within the business-casual.css file. -->
    <header class="business-header">
        <div class="container">
            <div class="row">
             
            </div>
        </div>
    </header>

    <!-- Page Content -->
    
    <div class="main col-md-12" >
            <div class="slides">
                <img src="img/1.jpg" alt="">
                <img src="img/2.jpg" alt="">
                <img src="img/3.jpg" alt="">

            </div>
        </div>
        <script>
            $(function(){
            $(".slides").slidesjs({
              play: {
                active: true,
                  // [boolean] Generate the play and stop buttons.
                  // You cannot use your own buttons. Sorry.
                effect: "slide",
                  // [string] Can be either "slide" or "fade".
                interval: 1500,
                  // [number] Time spent on each slide in milliseconds.
                auto: true,
                  // [boolean] Start playing the slideshow on load.
                swap: true,
                  // [boolean] show/hide stop and play buttons
                pauseOnHover: false,
                  // [boolean] pause a playing slideshow on hover
                restartDelay: 2500
                  // [number] restart delay on inactive slideshow
              }
            });
          });
        </script>    
        <div class="container">
        <hr>

        <div class="row">
            <div class="col-md-1"2>
                <h2>¿Qué nos mueve?</h2>
                <p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
                <p>
                    <a class="btn btn-default btn-lg" href="index.php?vista=registro">Regístrate &raquo;</a>
                </p>
            </div>
            <div class="col-sm-4" id="contacto">
                <!--<h2>Contacto</h2>
                <address>
                    <strong>Av. Qwerty Asdf</strong>
                    <br>Lorem ipsum 1234
                    <br>Región Metropolitana. Santiago
                    <br>
                </address>
                <address>
                    <abbr title="Phone">P:</abbr>(+56 9) 1234-5678
                    <br>
                    <abbr title="Email">E:</abbr> <a href="mailto:#">lorem.ipusm@asdf.cl</a>
                </address>-->
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <div class="row" id="circuitos">
            <div class="col-sm-4">
                <img class="img-circle img-responsive img-center" src="img/php.jpg" alt="">
                <h2>¿QUÉ ES PHP?</h2>
                <p>PHP es un lenguaje de código abierto muy popular, adecuado para desarrollo web y que puede ser incrustado en HTML. Es popular porque un gran número de páginas y portales web están creadas con PHP. Código abierto significa que es de uso libre y gratuito para todos los programadores que quieran usarlo. Incrustado en HTML significa que en un mismo archivo vamos a poder combinar código PHP con código HTML</p>
            </div>
            <div class="col-sm-4">
                <img class="img-circle img-responsive img-center" src="img/java.jpg" alt="">
                <h2>¿Qué es la tecnología Java?</h2>
                <p>Java es un lenguaje de programación y una plataforma informática comercializada por primera vez en 1995 por Sun Microsystems. Hay muchas aplicaciones y sitios web que no funcionarán a menos que tenga Java instalado y cada día se crean más. Java es rápido, seguro y fiable. Desde portátiles hasta centros de datos, desde consolas para juegos hasta súper computadoras, desde teléfonos móviles hasta Internet, Java está en todas partes.</p>
            </div>
            <div class="col-sm-4">
                <img class="img-circle img-responsive img-center" src="img/html5.jpg" alt="">
                <h2>¿QUÉ ES HTML?</h2>
                <p>HTML son las siglas designadas para “Hyper Text Markup Language”, que traducido al español significa “Lenguaje de Marcas de Hipertexto”. HTML es un lenguaje utilizado en la informática, cuyo fin es el desarrollo de las páginas web, indicando cuales son los elementos que la compondrán, orientando hacia cuál será su estructura y también su contenido, básicamente es su definición; por medio del HTML se indica tanto el texto como las imágenes pertenecientes a cada página de internet.</p>
            </div>
        </div>
       
        <!-- ==================== Contacto ====================-->


        <style type="text/css">
        .jumbotron {
        background: #358CCE;
        color: #FFF;
        border-radius: 0px;
        }
        .jumbotron-sm { padding-top: 24px;
        padding-bottom: 24px; }
        .jumbotron small {
        color: #FFF;
        }
        .h1 small {
        font-size: 24px;
        }
        </style>


        <div class="jumbotron jumbotron-sm">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <h1 class="h1">
                            Contactenos <small>Sientase libre de hablar con nosotros</small></h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="well well-sm">
                        <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">
                                        Nombre</label>
                                    <input type="text" class="form-control" id="nombre" placeholder="Ingrese Nombre" required="required" />
                                </div>
                                <div class="form-group">
                                    <label for="email">
                                        Email</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                        </span>
                                        <input type="email" class="form-control" id="email" placeholder="Ingrese Email" required="required" /></div>
                                </div>
                                <div class="form-group">
                                    <label for="tipo">
                                        Tipo Contacto</label>
                                    <select id="tipo" name="tipo" class="form-control" required="required">
                                        <option value="-1" selected="">Seleccione una</option>
                                        <option value="0">General</option>
                                        <option value="1">Consulta</option>
                                        <option value="2">Cotización</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Mensaje">
                                        Mensaje</label>
                                    <textarea name="Mensaje" id="Mensaje" class="form-control" rows="9" cols="25" required="required"
                                        placeholder="Mensaje"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right" id="btnContacto">
                                    Enviar</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <form>
                    <legend><span class="glyphicon glyphicon-globe"></span>Nuestras oficias</legend>
                    <address>
                        <strong>Karinca</strong><br>
                        Avenida Siempre viva, 123<br>
                        Springfield<br>
                        <abbr title="telefono">
                            P:</abbr>
                        (+569)42632431
                    </address>
                    <address>
                        <strong>Karinca, soluciones tecnológicas</strong><br>
                        <a href="mailto:#">Contacto@karinca.cl</a>
                    </address>
                    </form>
                </div>
            </div>
        </div>


        <!-- ======================= Fin Contacto ========================-->





    </div>

</body>

</html>
