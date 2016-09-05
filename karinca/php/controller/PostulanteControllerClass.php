<?php
        
require_once dirname( __FILE__ ).'/../model/PostulanteClass.php';
require_once dirname( __FILE__ ).'/../dao/ConexionClass.php';
require_once dirname( __FILE__ ).'/../dao/PostulanteDAOClass.php';
require_once dirname( __FILE__ ).'/../dao/ComunaDAOClass.php';

class PostulanteController {
     
    /**
     *
     * @var Conexion
     */
    private $conexion; 
    
    /**
     *
     * @var ArrayObject
     */
    private $listaUsuarios;
    
     /**
     *
     * @var PostulanteDAO 
     * 
     */
    private $daoPostulante;
    
    /**
     *
     * @var ComunaDAO 
     */
    private $daoComuna;
    
    private $indicadorExito = false;
    private $indicadorError = false;
    private $mensajeExito = "";
    private $mensajeError = "";
    private $perfilPredeterminado = "usuario";
    
    function __construct() {
        $this->conexion = new Conexion();
        $this->daoPostulante = new PostulanteDAO($this->conexion);
        $this->daoComuna = new ComunaDAO($this->conexion);
        $this->execute();
    }

    function __destruct() {
        $this->conexion->closeConexion();
    }
    
    private function execute() {
    
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["operacion"]) && $_POST["operacion"]=="editar") {
                $this->actualizarPostulante();

            } else if(isset($_POST["operacion"]) && $_POST["operacion"]=="agregar") {
                $this->agregarPostulante();
                
            } else if(isset($_POST["operacion"]) && $_POST["operacion"]=="eliminar") {
                $this->eliminarPostulante();            
            }
        }
        
       $this->listaUsuarios = $this->listarPostulante();
    }
    
    
    private function agregarPostulante() {
        /* $usuario = $this->daoUsuario->buscarPorId($_POST["id"]);
        
        if(!$usuario) {
            $this->indicadorError = true;
            $this->mensajeError = "El usuario que desea ingresar los datos no existe!";
            return false;
        }*/
        
        if(isset($_POST["id"])) {
            $rut=$_POST["id"];
           
        }
     
        if(isset($_POST["nombre"])) {
            $nombre=$_POST["nombre"];
        }
        
        if(isset($_POST["apellidoPaterno"])) {        
            $paterno=$_POST["apellidoPaterno"];
        }
        
        if(isset($_POST["apellidoMaterno"])) {  
            $materno=$_POST["apellidoMaterno"];
        }
        
        if(isset($_POST["email"])) {  
            $email=$_POST["email"];
        }
        
        if(isset($_POST["fecha_nacimiento"])) { 
            $fecha=$_POST["fecha_nacimiento"];        
        }
        
        if($_POST["sexo"] == "M") {
            /*@var $usuaruio Postulante*/
            $sexo=0;
        } else {
            /*@var $usuaruio Postulante*/
            $sexo=1;
        }
        
        if(isset($_POST["perfil"]) && !empty($_POST["perfil"])) {
            $perfil=$_POST["perfil"];
        } else {
            $perfil=$this->perfilPredeterminado;
        }
        
        if(isset($_POST["comuna"]) && !empty($_POST["comuna"])) { 
            $comuna = $this->daoComuna->buscarPorId($_POST["comuna"]);
            
        }

        // si el formulario viene con una clave, entonce se actualiza
        if(isset($_POST["clave"]) && !empty($_POST["clave"])) {
            $clave=$_POST["clave"];
        } else {
            // de lo contrario se setea nula para que se mantenga la existente            
            $clave=null;
        }
               
        $postulante=new Postulante($rut,$nombre,$paterno,$materno,$fecha,$sexo,$clave,$email,$perfil,$comuna);
        if($this->daoPostulante->agregar($postulante)) {            
            $this->indicadorExito = true;
            $this->mensajeExito = "El cliente se ha ingresado exitosamente";
        } else {
            $this->indicadorError = true;
            $this->mensajeError = "No se pudo ingresar el cliente";
        }
    }
    
    private function actualizarPostulante() {
        $postulante = $this->daoPostulante->buscarPorId($_POST["id"]);
        
        if(!$postulante) {
            $this->indicadorError = true;
            $this->mensajeError = "El usuario al que desea actualizar los datos no existe!";
            return false;
        }
        
        if(isset($_POST["nombre"])) {
            $postulante->setNombre($_POST["nombre"]);
        }
        
        if(isset($_POST["apellidoPaterno"])) {        
            $postulante->setApellidoPaterno($_POST["apellidoPaterno"]);
        }
        
        if(isset($_POST["apellidoMaterno"])) {  
            $postulante->setApellidoMaterno($_POST["apellidoMaterno"]);
        }
        
        if(isset($_POST["email"])) {  
            $postulante->setEmail($_POST["email"]);
        }
        
        if(isset($_POST["fecha_nacimiento"])) { 
            $postulante->setFechaNacimiento($_POST["fecha_nacimiento"]);        
        }
        
        if($_POST["sexo"] == "M") {
            $postulante->setSexoMasculino();
        } else {
            $postulante->setSexoFemenino();
        }
        
        if(isset($_POST["perfil"]) && !empty($_POST["perfil"])) {
            $postulante->setPerfil($_POST["perfil"]);
        } else {
            $postulante->setPerfil($this->perfilPredeterminado);
        }
        
        if(isset($_POST["comuna"]) && !empty($_POST["comuna"])) { 
            $comuna = $this->daoComuna->buscarPorId($_POST["comuna"]);
            $postulante->setComuna($comuna);
        }

        // si el formulario viene con una clave, entonce se actualiza
        if(isset($_POST["clave"]) && !empty($_POST["clave"])) {
            $postulante->setClave($_POST["clave"]);
        } else {
            // de lo contrario se setea nula para que se mantenga la existente            
            $postulante->setClave(null);
        }
        
        if($this->daoPostulante->actualizar($postulante)) {
            $this->indicadorExito = true;
            $this->mensajeExito = "Los datos del cliente han sido actualizados exitosamente";
        } else {
            $this->indicadorError = true;
            $this->mensajeError = "No se pudo actualizar los datos del cliente";
        }
    }
    
    private function eliminarPostulante() {
        $id = $_POST["rutClienteElimina"];            

        if($this->daoPostulante->eliminar($id)) {            
            $this->indicadorExito = true;
            $this->mensajeExito = "El cliente ha sido eliminado";
        } else {
            $this->indicadorError = true;
            $this->mensajeError = "No se pudo eliminar el cliente";
        } 
    }
    
    private function listarPostulante() {        
        return $this->daoPostulante->listar();    
    }
    
    function getListaPostulante() {
        return $this->listaUsuarios;
    }

    function gePostulantePorId($rut) {
        return $this->daoPostulante->buscarPorId($rut);
    }
    
    function getIndicadorExito() {
        return $this->indicadorExito;
    }

    function getIndicadorError() {
        return $this->indicadorError;
    }

    function getMensajeExito() {
        return $this->mensajeExito;
    }

    function getMensajeError() {
        return $this->mensajeError;
    }


}