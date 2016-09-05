<?php

    require_once dirname( __FILE__ ).'/../../controller/SessionControllerClass.php';

    $session = new SessionController();
?>
<!-- Navigation -->


  
<div id="wrapper">    
        <nav class="navbar navbar-inverse navbar-fixed-top" id="menu-rex" role="navigation">
      <div class="navbar-header">
          <!--<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>-->
           <!-- <button type="button" class="navbar-toggle"  id="menu-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">-->
           <button type="button" class="navbar-toggle"  id="menu-toggle" href="#menu-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Navegación</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php?vista=inicio">Inicio</a>
        </div>
       </nav>
    
  <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper" id="bs-example-navbar-collapse-1" >
            <ul class="sidebar-nav ">
               
                <li class="sidebar-brand" style="margin-bottom: 35px;margin-top: 25px;">
                    <a href="#">
                        <img src="img/karinca_png.ico" style="width: 80%;height: 80%">
                        
                    </a>
                </li>
                <li >
                    <a href="index.php?vista=inicio">Inicio</a>
                </li>
                <li>
                    <a href="#">¿Quienes Somos?</a>
                </li>
               
                <li>
                    <a href="#">Portaflio</a>
                </li>
                <li>
                    <a href="#">Tecnologias</a>
                </li>
                <li>
                    <a href="#">Servicios</a>
                </li>
                <li>
                    <a href="#">Contactenos</a>
                </li>
            </ul>

        </div>
               
        </div>
    </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->

        
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
 </script>
        <!-- /#page-content-wrapper -->

    



<?php
    include dirname( __FILE__ )."/login.php";
?>