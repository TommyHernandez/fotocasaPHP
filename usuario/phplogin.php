<?php

require '../require/comun.php';
$login = Leer::post("login");
$clave = sha1(Leer::post("key"));
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$objeto = $modelo->login($login, $clave);
if ($objeto instanceof Usuario ) {
    $sesion->setUsuario($objeto);
    header("Location: ../ap-admin/panel.php");
} else if ($objeto == -2){
    header("Location: ../ap-admin?er=$r");
}else {
    $sesion->destroy();
    header("Location: ../index.php?er=$r");
}