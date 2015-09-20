<?php

/**
 * Clase que abstrae la subida de archivos en PHP
 * @copyright (c) 2014, Pedro Hernández
 * @version 1.0
 * 
 * @author PTHDC
 */
class Subir {

    private $files, $input, $destino, $nombre, $accion, $maximo, $tipos, $extensiones, $crearCarpeta;
    private $errorPHP, $error, $mensaje_error, $destinos;

    const IGNORAR = 0, RENOMBRAR = 1, REEMPLAZAR = 2;
    const ERROR_INPUT = -1;

    function __construct($input) {
        $this->input = $input;
        $this->destino = "./";
        $this->nombre = array();
        $this->accion = Subir::IGNORAR;
        $this->maximo = 2 * 1024 * 1024;
        $this->crearCarpeta = false;
        $this->tipos = array();
        $this->extensiones = array();
        $this->errorPHP = UPLOAD_ERR_OK;
        $this->error = 0;
        $this->mensaje_error = "";
        $this->nombre[0] = "";
        $this->destinos[0] = "";
    }

    function getErrorPHP() {
        return $this->errorPHP;
    }

    function getError() {
        return $this->error;
    }

    private function setErrorMensaje() {
        switch ($this->errorPHP) {
            case UPLOAD_ERR_OK:
                $this->mensaje_error = "Archivo Subido Correctamente";
                break;
            case UPLOAD_ERR_INI_SIZE:
                $this->mensaje_error = "Error de tamaño ini";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $this->mensaje_error = "Error de tamaño del formulario";
                break;
            case UPLOAD_ERR_PARTIAL:
                $this->mensaje_error = "Error Parcial";
                break;
            case UPLOAD_ERR_NO_FILE:
                $this->mensaje_error = "Error: No hay archivo";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $this->mensaje_error = "Error en arvhivo temporal";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $this->mensaje_error = "Error de escritura";
                break;
            case UPLOAD_ERR_EXTENSION:
                $this->mensaje_error = "Error de extension";
                break;
        }
    }

    function getMensajeError() {
        if ($this->mensaje_error == "") {
            $this->setErrorMensaje();
            return $this->mensaje_error;
        } else {
            return $this->mensaje_error;
        }
    }

    function setCrearCarpeta($crearCarpeta) {
        $this->crearCarpeta = $crearCarpeta;
    }

    function setDestino($destino) {
        $caracter = substr($destino, -1);
        if ($caracter != "/")
            $destino.="/";
        $this->destino = $destino;
    }

//
    /**
     * Este metodo solo da un nombre personalizado al elemento que haya en la posicion
     * @param String $nombreInput 
     */
    function setNombre($nombreInput, $pos) {
        $this->nombre[$pos - 1] = $nombreInput;
    }

    /**
     * 
     * @param String $nombreInput nombre del array que viene del formulario
     */
    function setNombres($nombreInput) {
        if (isset($_POST[$nombreInput])) {
            if (is_array($_POST[$nombreInput])) {
                if (sizeof($_POST[$nombreInput]) > sizeof($this->files)) {
                    $i = 0;
                    foreach ($_POST[$nombreInput] as $valor) {
                        $this->nombre[$i] = $valor;
                        $i++;
                    }
                }
            }
        } else {
            return false;
        }
    }

//
    /**
     * Esto es nuestra politica de acción con las imagenes.
     * @param String $accion
     */
    function setAccion($accion) {
        $this->accion = $accion;
    }

//
    /**
     * Con este metodo asignamos el tamaño maximo en bytes
     * @param type $maximo
     */
    function setMaximo($maximo) {
        $this->maximo = $maximo;
    }

//

    function addTipo($tipo) {
        if (is_array($tipo)) {
            $this->tipos = array_merge($this->tipos, $tipo);
        } else {
            $this->tipos[] = $tipo;
        }
    }

//
    /**
     * Nos permite meter extensiones que NO seran permitidas
     * @param String $extension
     */
    function setExtension($extension) {
        if (is_array($extension)) {
            $this->extensiones = $extension;
        } else {
            unset($this->extensiones);
            $this->extensiones[] = $extension;
        }
    }

//

    function addExtension($extension) {
        if (is_array($extension)) {
            $this->extensiones = array_merge($this->extensiones, $extension);
        } else {
            $this->extensiones[] = $extension;
        }
    }

//

    function isInput() {
        if (!isset($_FILES[$this->input])) {
            $this->error = -1;
            return false;
        }
        return true;
    }

//

    private function isError() {
        if ($this->errorPHP != UPLOAD_ERR_OK) {
            return true;
        }
        return false;
    }

//
    /**
     * Nos dice si el archivo tiene un tamaño menor del máximo permitido
     * @param int $pos
     * @return boolean
     */
    private function isTamano($pos) {
        if ($this->files["size"][$pos] > $this->maximo) {
            $this->error = -2;
            return false;
        }
        return true;
    }

//
    /**
     * Nos indica si la extension esta dentro o no de la lista de excluidas
     * @param type $extension
     * @return boolean
     */
    private function isExtension($extension) {
        if (sizeof($this->extensiones) > 0 && !in_array($extension, $this->extensiones)) {
            $this->error = -3;
            return false;
        }
        return true;
    }

//

    private function isCarpeta() {
        if (!file_exists($this->destino) && !is_dir($this->destino)) {
            $this->error = -4;
            return false;
        }
        return true;
    }

    /**
     * 
     * @return type
     */
    function getNombres() {
        return $this->nombre;
    }

    function getDestinos() {
        return $this->destinos;
    }

    private function crearCarpeta() {
        return mkdir($this->destino, Configuracion::PERMISOS, true);
    }

    /**
     * El metodo subir sube los archivos al servidor y comprueba todo lo necesario para ello, 
     * sigueiendo las configuraciones aplicadas con los metodos de la clase
     * @return boolean si falla algo devuelve false
     */
    function subir() {
        $this->error = 0;
        $a = 0;
        if (!$this->isInput()) {
            return false;
        }
        $this->files = $_FILES[$this->input];
        foreach ($this->files["name"] as $indice) {
            if ($this->isTamano($a)) {
                $this->errorPHP = $this->files["error"][$a];
                $partes = pathinfo($this->files["name"][$a]);
                $extension = $partes['extension'];
                $nombreOriginal = $partes['filename'];
                if (!$this->isExtension($extension)) {
                    if (empty($this->nombre[$a])) {
                        $this->nombre[$a] = $nombreOriginal;
                    }
                    $origen = $this->files["tmp_name"][$a];
                    $destino = $this->destino . $this->nombre[$a] . "." . $extension;
                    $this->destinos[$a] = $destino;
                    if ($this->accion == Subir::REEMPLAZAR) {
                        $a++;
                        move_uploaded_file($origen, $destino);
                    } elseif ($this->accion == Subir::IGNORAR) {
                        if (file_exists($destino)) {
                            $this->error = -5;
                            return false;
                        }
                        $a++;
                        move_uploaded_file($origen, $destino);
                    } elseif ($this->accion == Subir::RENOMBRAR) {
                        $i = 1;
                        while (file_exists($destino)) {
                            $destino = $destino = $this->destino . $this->nombre[$a] . "_$i." . $extension;
                            $i++;
                        }
                        $this->destinos[$a] = $destino;
                        $a++;
                        move_uploaded_file($origen, $destino);
                    }

                    $this->error = -6;
                }
            } else {
                $a++;
            }
        }
    }

}
