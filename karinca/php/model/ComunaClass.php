<?php

require_once dirname( __FILE__ ).'/ProvinciaClass.php';

class Comuna implements JsonSerializable{
    
    private $codigo;
    private $nombre;
    
    /**
     * 
     * @var Provincia
     */
    private $provincia;
    
    function __construct($codigo, $nombre, $provincia) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->provincia = $provincia;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function setProvincia(Provincia $provincia) {
        $this->provincia = $provincia;
    }

    
    public function __toString() {
        return "Region {codigo: ".$this->codigo.", nombre: ".$this->nombre.", provincia: ".$this->provincia."}";
    }
    

    public function jsonSerialize() {
        return ["codigo" => $this->codigo, "nombre" => $this->nombre, "provincia" => $this->provincia];
    }

}

