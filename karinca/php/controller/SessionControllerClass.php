<?php


class SessionController {
    private $esUsuario = false;
    private $esEditor = false;
    private $esPublicador = false;
    private $esAdministrador = false;
    private $maximoTiempoVida = 3600; //una hora
    
    function __construct() {
        
        if(session_status() != PHP_SESSION_ACTIVE) {
            session_set_cookie_params($this->maximoTiempoVida);
            session_start();
        }

        $this->verificarPerfilUsuario();
    }

    private function verificarPerfilUsuario() {
        if(isset($_SESSION['postulante.perfil'])) {
            if($_SESSION['postulante.perfil'] == "editor") {
                $this->esEditor = true;
            } else if($_SESSION['postulante.perfil'] == "publicador") {
                $this->esPublicador = true;
            }else if($_SESSION['postulante.perfil'] == "admin") {
                $this->esAdministrador = true;
            }else if($_SESSION['postulante.perfil'] == "usuario") {
                $this->esUsuario = true;
        }
    }
    }
    
    function isUsuario() {
        return $this->esUsuario;
    }
    
    function isEditor() {
        return $this->esEditor;
    }

    function isPublicador() {
        return $this->esPublicador;
    }

    function isAdministrador() {
        return $this->esAdministrador;
    }

    function isLogged() {
        return isset($_SESSION['postulante.perfil']);
    }
    
    function getRutUsuario() {
        if(isset($_SESSION['postulante.rut'])) {
            return $_SESSION['postulante.rut'];
        } else {
            return "";
        }        
    }
    
    function getNombreUsuario() {
        if(isset($_SESSION['postulante.nombre'])) {
            return $_SESSION['postulante.nombre'];
        } else {
            return "";
        }        
    }
    
    function getEmailUsuario() {
        if(isset($_SESSION['postulante.email'])) {
            return $_SESSION['usuario.email'];
        } else {
            return "";
        }        
    }
    
    function finalizar() {
        session_destroy();
    }
    
    function inicializar($nombreUsuario, $perfilUsuario, $emailUsuario, $rutUsuario) {
        $_SESSION['postulante.nombre'] = $nombreUsuario;
        $_SESSION['postulante.perfil'] = $perfilUsuario;
        $_SESSION['postulante.email'] = $emailUsuario;
        $_SESSION['postulante.rut'] = $rutUsuario;
        
        $this->verificarPerfilUsuario();
    }

}
    
