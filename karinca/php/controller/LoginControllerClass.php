<?php

require_once dirname( __FILE__ ).'/SessionControllerClass.php';
require_once dirname( __FILE__ ).'/../model/PostulanteClass.php';
require_once dirname( __FILE__ ).'/../dao/ConexionClass.php';
require_once dirname( __FILE__ ).'/../dao/PostulanteDAOClass.php';


class LoginController {
    
    /**
     *
     * @var Conexion
     */
    private $conexion;
    
    /**
     *
     * @var PostulanteDAO
     */
    private $daoPostulante;
    
    public function __construct() {
        $this->conexion = new Conexion();
        $this->daoPostulante = new PostulanteDAO($this->conexion);
    }
    
    public function __destruct() {
        $this->conexion->closeConexion();
    }
    
    public function autenticar($rut, $clave) {
        
        $postulante = $this->daoPostulante->buscarPorId($rut);
        
        if(!$postulante) {
            return false;
        }
        
        if($postulante->isClaveValida($clave)) {
            $session = new SessionController();
            $session->inicializar($postulante->getNombre(). " ". $postulante->getApellidoPaterno(), $postulante->getPerfil(), $postulante->getEmail(),$postulante->getRut());
            return true;
        } else {
            return false;
        }
        
    }
}
