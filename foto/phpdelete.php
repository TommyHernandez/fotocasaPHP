<?php
require '../require/comun.php';
//este metodo comprueba que estas atuentificado en la sesion como ROOT en caso negativo te manda al index
$sesion->administrador("../index.php");
$id= LEER::get("id");
$bd = new BaseDatos();
$modelo = new modeloFoto($bd);
$condicion = "id=$id";
$foto = $modelo->get($condicion);
$r1 = $foto->deleteArchivo();
$r = $modelo->delete($id);
header("Location: ../adminpanel.php?result=$r");