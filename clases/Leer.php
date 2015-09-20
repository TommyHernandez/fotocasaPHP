<?php

/**
 * 
 * 
 * @version 0.9 
 * @author PedroTHDC
 * @copyright (c) 2014, IZV
 * 
 * Esta calse se compone de metodos estaticos que se encarga de leer y procesar de manera sencilla la recepcion de datos GET y POST
 */
class Leer {

    /**
     * @access public
     * @param String $param cadena con el nombre del parametro.
     * @return String|array|false  Devuelve una cadena con el valor del parametro, null si el parametro no se ha pasado y un array 
     * si el parametro es multiple.
     */
    public static function get($param, $filtrar = true) {
        if (is_array($param)) {
            return Leer::leerArray($param);
        } else {
            if (isset($_GET[$param])) {
                if ($filtrar) {
                    return leer::limpiar($_GET[$param]);
                } else {
                    return $_GET[$param];
                }
            } else {
                return false;
            }
        }
    }

    /**
     * 
     * @param type $param
     * @return null
     */
    public static function post($param, $filtrar = true) {
        if (isset($_POST[$param])) {
            if ($filtrar) {
                return leer::limpiar($_POST[$param]);
            } else {
                return $_POST[$param];
            }
        } else {
            return null;
        }
    }

    /**
     * 
     * @param type $param
     * @return type
     */
    public static function request($param, $filtrar = true) {
        $v = Leer::get($param);
        if ($v == null) {
            $v = leer::limpiar($_POST[$param]);
        } else {
            
        }
        return $v;
    }

    private static function limpiar($param) {

        return htmlspecialchars($param);
    }

    private static function leerArray($param, $filtrar = true) {

        $array = Array();
        foreach ($param as $indice->$valor) {

            $array[] = Leer::limpiar($valor);
        }
        return $array;
    }

    public static function isArray($param) {
        if (isset($_GET[$param])) {
            return is_array($param);
        } else {
            if (isset($_POST[$param])) {
                return is_array($param);
            }
        }

        return NULL;
    }

    public static function isArrayV2($param) {
        return is_array(Leer::request($param));
    }

    public static function fileExist($carpeta, $nombre) {

        if (file_exists($carpeta . "/" . $nombre)) {
            return true;
        } else {
            return false;
        }
    }

}
