<?php

require '../require/comun.php';
$login = Leer::post("login");
$clave = sha1(Leer::post("key"));
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$objeto = $modelo->login($login, $clave);
if ($objeto) {
    $sesion->setUsuario($objeto);
    header("Location: ../adminpanel.php");
} else {
    $sesion->cerrar();
    header("Location: ../adminlogin.php?er=1");
}