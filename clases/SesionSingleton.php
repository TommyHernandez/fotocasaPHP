<?php

/**
 * Description of SesionSingleton
 *
 * @author Pedrothdc
 */
class SesionSingleton {

    private static $instancia;

    function __construct($nombre = "") {
        if ($nombre != "") {
            session_name($nombre);
        }
        session_start();
    }

    function cerrar() {
        session_unset();
        session_destroy();
    }

    function delete($variable = "") {
        if ($variable === "") {
            unset($_SESSION);
        } else {
            unset($_SESSION[$variable]);
        }
    }

    function get($variable) {
        if (isset($_SESSION[$variable]))
            return $_SESSION[$variable];
        return null;
    }

    function getNombres() {
        $array = array();
        foreach ($_SESSION as $key => $value) {
            $array[] = $key;
        }
        return $array;
    }

    public static function getSesion($nombre = "") {
        if (is_null(self::$instancia)) {
            self::$instancia = new self($nombre);
        }
        return self::$instancia;
    }

    function getUsuario() {
        if ($this->get("__usuario") != null)
            return $this->get("__usuario");
        return null;
    }

    function isAutentificado() {
        return isset($_SESSION["__usuario"]);
    }

    function isSesion() {
        return count($_SESSION) > 0;
    }

    function redirigir($destino = "index.php") {
        header("Location:" . $destino);
        exit;
    }

    function setUsuario($usuario) {
        if ($usuario instanceof Usuario) {
            $this->set("__usuario", $usuario);
        }
    }

    function set($variable, $valor) {
        $_SESSION[$variable] = $valor;
    }

    function autentificado($url ="index.php") {
        if (!$this->isAutentificado()) {
            $this->redirigir($url);
        }else{
            
        }
        
    }
     function administrador($url ="index.php") {
       $usuario =  $this->getUsuario();
        if ($usuario->getIsRoot() != 1) {
            $this->redirigir($url);
        }else{
            
        }
        
    }

}
