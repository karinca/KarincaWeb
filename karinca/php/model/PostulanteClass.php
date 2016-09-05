<?php

require_once dirname( __FILE__ ).'/ComunaClass.php';

/**
 * Description of UsuarioClass
 *
 * @author cetecom
 */
class Postulante implements JsonSerializable {
    
    private $rut;
    private $nombre;
    private $apellidoPaterno;
    private $apellidoMaterno;
    private $fechaNacimiento;
    private $sexo;
    private $clave;
    private $email;
    /**
     *
     * @var Comuna
     */
    private $comuna;
    private $perfil;    
    
    public function __construct($rut, $nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $sexo, $clave, $email, $perfil, $comuna) {
        $this->nombre = $nombre;
        $this->rut = $rut;
        $this->email = $email;
        $this->clave = $clave;
        $this->perfil = $perfil;
        $this->apellidoPaterno = $apellidoPaterno;
        $this->apellidoMaterno = $apellidoMaterno;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->sexo = $sexo;
        $this->comuna = $comuna;
    }
    
    function getRut() {
        return $this->rut;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getClave() {
        return $this->clave;
    }

    function getEmail() {
        return $this->email;
    }

    function getPerfil() {
        return $this->perfil;
    }

    function setRut($rut) {
        $this->rut = $rut;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPerfil($perfil) {
        $this->perfil = $perfil;
    }
    
    function getApellidoPaterno() {
        return $this->apellidoPaterno;
    }

    function getApellidoMaterno() {
        return $this->apellidoMaterno;
    }

    function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    function isHombre() {
        return ($this->sexo == 0);
    }
    
    function isMujer() {
        return ($this->sexo == 1);
    }

    function setApellidoPaterno($apellidoPaterno) {
        $this->apellidoPaterno = $apellidoPaterno;
    }

    function setApellidoMaterno($apellidoMaterno) {
        $this->apellidoMaterno = $apellidoMaterno;
    }

    function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    function getComuna() {
        return $this->comuna;
    }

    function setComuna(Comuna $comuna) {
        $this->comuna = $comuna;
    }
    
    function setSexoMasculino() {
        $this->sexo = 0;
    }
    
    function getSexo() {
        return $this->sexo;
    }

        function setSexoFemenino() {
        $this->sexo = 1;
    }

    function isClaveValida($clave) {        
        $version = phpversion();
        $numero= str_replace(".", "", $version);
        $numeroVersion = substr($numero, 0, 3);
        
        if($numeroVersion < 550) {
            return (sha1($clave) == $this->clave);   
        } else {
            return password_verify($clave, $this->clave);
        }        
    }

    public function jsonSerialize() {
        return ["rut" => $this->rut, 
                "nombre" => $this->nombre, 
                "apellidoPaterno" => $this->apellidoPaterno,
                "apellidoMaterno" => $this->apellidoMaterno,
                "fechaNacimiento" => $this->fechaNacimiento,
                "sexo" => $this->sexo,
                "clave" => $this->clave, 
                "email" => $this->email, 
                "comuna" => $this->comuna,
                "perfil" => $this->perfil];
    }

}
