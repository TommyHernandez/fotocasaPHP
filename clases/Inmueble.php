<?php

/**
 * Description of Inmueble
 *
 * @author Tomas
 */
class Inmueble {

    private $id = null, $titulo, $descripcion, $precio, $estado, $localidad, $provincia, $tipo, $calle, $superficie, $cp, $objetivo, $fecha;
    function __construct($id=NULL, $titulo =NULL, $descripcion=NULL, $precio=0.0, $estado=NULL, $localidad=NULL, $provincia=NULL, $tipo=NULL, $calle=NULL, $superficie=NULL, $cp=NULL, $objetivo=NULL, $fecha='2014-12-1') {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->estado = $estado;
        $this->localidad = $localidad;
        $this->provincia = $provincia;
        $this->tipo = $tipo;
        $this->calle = $calle;
        $this->superficie = $superficie;
        $this->cp = $cp;
        $this->objetivo = $objetivo;
        $this->fecha = $fecha;
    }
     function set($datos, $inicio = 0) {       
        $this->id = $datos[0 + $inicio];
        $this->titulo = $datos[1 + $inicio];
        $this->descripcion = $datos[2 + $inicio];
        $this->estado = $datos[3 + $inicio];
        $this->precio = $datos[4 + $inicio];
        $this->localidad = $datos[5 + $inicio];
        $this->provincia = $datos[6 + $inicio];
        $this->tipo = $datos[7 + $inicio];
        $this->calle = $datos[8 + $inicio];
        $this->superficie = $datos[9 + $inicio];
        $this->cp = $datos[10 + $inicio];
        $this->objetivo = $datos[11 + $inicio];
        $this->fecha = $datos[12 + $inicio];
    }
    function getFecha() {
        return $this->fecha;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

        function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getEstado() {
        return $this->estado;
    }

    function getLocalidad() {
        return $this->localidad;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getCalle() {
        return $this->calle;
    }

    function getNumero() {
        return $this->numero;
    }

    function getSuperficie() {
        return $this->superficie;
    }

    function getCp() {
        return $this->cp;
    }

    function getObjetivo() {
        return $this->objetivo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }

    function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setCalle($calle) {
        $this->calle = $calle;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setSuperficie($superficie) {
        $this->superficie = $superficie;
    }

    function setCp($cp) {
        $this->cp = $cp;
    }

    function setObjetivo($objetivo) {
        $this->objetivo = $objetivo;
    }


}
