<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Foto
 *
 * @author Tomas
 */
class Foto {

    private $id, $idinmueble, $ruta;

    function __construct($id = null, $idinmueble = null, $ruta = null) {
        $this->id = $id;
        $this->idinmueble = $idinmueble;
        $this->ruta = $ruta;
    }
function set($datos, $inicio = 0) {       
        $this->id = $datos[0 + $inicio];
        $this->idinmueble = $datos[1 + $inicio];
         $this->ruta = $datos[2 + $inicio];
    }
    function getId() {
        return $this->id;
    }

    function getIdinmueble() {
        return $this->idinmueble;
    }

    function getRuta() {
        return $this->ruta;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdinmueble($idinmueble) {
        $this->idinmueble = $idinmueble;
    }

    function setRuta($ruta) {
        $this->ruta = $ruta;
    }
    function deleteArchivo(){
        return unlink($this->ruta);
    }
}
