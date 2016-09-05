<?php

require_once dirname( __FILE__ ).'/ConexionClass.php';
require_once dirname( __FILE__ ).'/../dao/ComunaDAOClass.php';
require_once dirname( __FILE__ ).'/../model/PostulanteClass.php';

class PostulanteDAO {
    
    /**
     *
     * @var Conexion
     */
    private $conexion;
   
    
    /**
     * 
     * @param ComunaDAO
     */
    private $daoComuna;
    
   
    function __construct($conexion) {
        $this->conexion = $conexion;
        $this->daoComuna = new ComunaDAO($conexion);
        
    }
    
    
    function listar() {
        $query = "SELECT rut, nombre, apellido_paterno, apellido_materno, fecha_nacimiento, sexo,  clave, email, perfil, comuna FROM postulante";
        $resultado = $this->conexion->getConexion()->query($query);
        
        $listadoPostulante = Array();
                
        while($fila = $resultado->fetch_array()) {
            $comuna = $this->daoComuna->buscarPorId($fila["comuna"]);
            $postulante = new Postulante($fila["rut"],$fila["nombre"], $fila["apellido_paterno"], $fila["apellido_materno"], $fila["fecha_nacimiento"], $fila["sexo"], $fila["clave"], $fila["email"], $fila["perfil"], $comuna);
            
            array_push($listadoPostulante,$postulante);

        }
        
        return $listadoPostulante;
    }
    
    function buscarPorId($id) {
        $query = "SELECT rut, nombre, apellido_paterno, apellido_materno, fecha_nacimiento, sexo,  clave, email, perfil, comuna FROM postulante WHERE rut = ? ";
        $consulta_preparada = $this->conexion->getConexion()->prepare($query);
        $consulta_preparada->bind_param("i", $id);
        $consulta_preparada->execute();
        $consulta_preparada->bind_result($rut, $nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $sexo, $clave, $email, $perfil, $codigoComuna);
        $ok = $consulta_preparada->fetch();
        
        if(!$ok) {
            return false;
        }
        
        $consulta_preparada->close();
        $comuna = $this->daoComuna->buscarPorId($codigoComuna);
        $postulante = new Postulante($rut, $nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $sexo, $clave, $email, $perfil, $comuna);

        return $postulante;
    }
    
     
     function autenticar($rut, $clave) {
        
        $postulante = $this->buscarPorId($rut);
        
        if(!$postulante) {
            return FALSE;
        }
        
        if($postulante->isClaveValida($clave)) {
            return TRUE;
        } else {
            return FALSE;
        }
        
    }
    
    function actualizar($postulante) {
       /* @var $postulante Postulante*/   
        
        $nombre=$postulante->getNombre();
        $paterno=$postulante->getApellidoPaterno();
        $materno=$postulante->getApellidoMaterno();
        $email=$postulante->getEmail();
        $nacimiento=$postulante->getFechaNacimiento();
        $sexo=$postulante->getSexo();
        $comuna=$postulante->getComuna()->getCodigo();
        $perfil=$postulante->getPerfil();
        $rut=$postulante->getRut();
        
        
        if(!is_null($postulante->getClave())){
                    $clave=  $this->encriptarClave($postulante->getClave());
            if(!$this->autenticar($postulante->getRut(),$postulante->getClave())){
                $query="update postulante  set nombre=?,apellido_paterno=?,apellido_materno=?,
                clave=?,email=?,fecha_nacimiento=?,sexo=?,comuna=?,perfil=?
                where rut=?";
               $consulta_preparada=  $this->conexion->getConexion()->prepare($query);
               $consulta_preparada->bind_param("ssssssiisi", 
                       $nombre,
                       $paterno,
                       $materno,
                       $clave,
                       $email,
                       $nacimiento,
                       $sexo,
                       $comuna,
                       $perfil,
                       $rut);
               if($consulta_preparada->execute()==0){
                   return false;
                    };
            
               }
               ELSE
               {return FALSE;}
        }
        else if(is_null($postulante->getClave())){
                $query="update postulante  set nombre=?,apellido_paterno=?,apellido_materno=?,
                    email=?,fecha_nacimiento=?,sexo=?,comuna=?,perfil=?
               where rut=?";
              $consulta_preparada=  $this->conexion->getConexion()->prepare($query);
              $consulta_preparada->bind_param("sssssiisi", 
                      $nombre,
                      $paterno,
                      $materno,
                      $email,
                      $nacimiento,
                      $sexo,
                      $comuna,
                      $perfil,
                      $rut);
              if($consulta_preparada->execute()==0){
                  return false;
              };   
        }
        
        
        return TRUE;
    }
    
    private function encriptarClave($clave) {
        
        $version = phpversion();
        $numero = str_replace(".", "", $version);
        $numeroVersion = substr($numero, 0, 3);
        $claveEncriptada = "";
       
        
        if($numeroVersion < 550) {             
            $claveEncriptada = sha1($clave);
        } else {
            $claveEncriptada = password_hash($clave,PASSWORD_DEFAULT);
        }
        
        return $claveEncriptada;
    }
    
    function eliminar($rut) {
        $query="delete from postulante where rut=?";
        $consulta_preparada = $this->conexion->getConexion()->prepare($query);
        $consulta_preparada->bind_param("i",$rut);
         
        if($consulta_preparada->execute()==0){
            return FALSE;
        }
         
         return TRUE;
        
    }
    
    
    function agregar($postulante) {
        /* @var $postulante Postulante*/   
        
        $nombre=$postulante->getNombre();
        $paterno=$postulante->getApellidoPaterno();
        $materno=$postulante->getApellidoMaterno();
        $email=$postulante->getEmail();
        $nacimiento=$postulante->getFechaNacimiento();
        $sexo=$postulante->getSexo();
        $clave= $this->encriptarClave($postulante->getClave());
        $comuna=$postulante->getComuna()->getCodigo();
        $perfil=$postulante->getPerfil();
        $rut=$postulante->getRut();
        
        /*
        $nombre="prueba";
        $paterno="prueba";
        $materno="prueba";
        $email="a@a.cl ";
        $nacimiento="01/01/2001";
        $sexo=0;
        $clave= "1234";
        $comuna=15101;
        $perfil="admin";
        $rut=15586864;*/
        $query="insert into postulante 
            (rut,nombre,apellido_paterno,apellido_materno,clave,email,fecha_nacimiento,sexo,comuna,perfil)
             values(?,?,?,?,?,?,?,?,?,?)";
       $consulta_preparada=  $this->conexion->getConexion()->prepare($query);
       $consulta_preparada->bind_param("issssssiis", 
               $rut,
               $nombre,
               $paterno,
               $materno,
               $clave,
               $email,
               $nacimiento,
               $sexo,
               $comuna,
               $perfil);
       if($consulta_preparada->execute()==0){
           return false;
       };
        
        return TRUE;
    }
}
