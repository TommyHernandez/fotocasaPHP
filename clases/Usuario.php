<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author PedroTHDC
 */
class Usuario {

    private $login, $clave, $nombre, $apellidos, $email, $fechaAlta, $isActive, $isRoot, $rol, $fechaLogin;

    function __construct($login = null, $clave = null, $nombre = null, $apellidos = null, $email = null, $fechaAlta = null, $isActive = 0, $isRoot = 0, $rol = "usuario", $fechaLogin = null) {
        $this->login = $login;
        $this->clave = $clave;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->fechaAlta = $fechaAlta;
        $this->isActive = $isActive;
        $this->isRoot = $isRoot;
        $this->rol = $rol;
        $this->fechaLogin = $fechaLogin;
    }

    function set($datos, $inicio = 0) {
        $this->login = $datos[0 + $inicio];
        $this->clave = $datos[1 + $inicio];
        $this->nombre = $datos[2 + $inicio];
        $this->apellidos = $datos[3 + $inicio];
        $this->email = $datos[4 + $inicio];
        $this->fechaAlta = $datos[5 + $inicio];
        $this->isActive = $datos[6 + $inicio];
        $this->isRoot = $datos[7 + $inicio];
        $this->rol = $datos[8 + $inicio];
        $this->fechaLogin = $datos[9 + $inicio];
    }

    function getLogin() {
        return $this->login;
    }

    function getClave() {
        return $this->clave;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getEmail() {
        return $this->email;
    }

    function getFechaAlta() {
        return $this->fechaAlta;
    }

    function getIsActive() {
        return $this->isActive;
    }

    function getIsRoot() {
        return $this->isRoot;
    }

    function getRol() {
        return $this->rol;
    }

    function getFechaLogin() {
        return $this->fechaLogin;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setFechaAlta($fechaAlta) {
        $this->fechaAlta = $fechaAlta;
    }

    function setIsActive($isActive) {
        $this->isActive = $isActive;
    }

    function setIsRoot($isRoot) {
        $this->isRoot = $isRoot;
    }

    function setRol($rol) {
        $this->rol = $rol;
    }

    function setFechaLogin($fechaLogin) {
        $this->fechaLogin = $fechaLogin;
    }

}
