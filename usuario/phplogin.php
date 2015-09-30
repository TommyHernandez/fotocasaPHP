<?php

require '../require/comun.php';
$login = Leer::post("login");
$clave = sha1(Leer::post("key"));
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$objeto = $modelo->login($login, $clave);
if ($objeto) {
    $sesion->setUsuario($objeto);
    header("Location: ../ap-admin/adminpanel.php");
} else {
    $sesion->cerrar();
    header("Location: ../index.php?er=1");
}