<?php
require '../require/comun.php';
//este metodo comprueba que estas atuentificado en la sesion como ROOT
$sesion->administrador("../usuario/viewalta.php");
//
$objeto = new Inmueble();
$id = Leer::post("id");
$titulo = LEER::post("titulo");
$descripcion = LEER::post("descripcion");
$estado = strtolower(LEER::post("estado"));
$precio = (double) LEER::post("precio");
$localidad = LEER::post("localidad");
$provincia = LEER::post("provincia");
$tipo = strtolower(LEER::post("tipo"));
$calle = LEER::post("superficie");
$superficie = (int) LEER::post("superficie");
$cp = (int) LEER::post("cp");
$objetivo = strtolower(LEER::post("objetivo"));
//validamos y añadimos
$objeto->setId($id);
$objeto->setEstado($estado);
$objeto->setObjetivo($objetivo);
$objeto->setTipo($tipo);
$objeto->setDescripcion($descripcion);
if (Validar::isLongitudMinima($titulo, 6)) {
    $objeto->setTitulo($titulo);
} else {
    
}
if (Validar::isLongitudMinima($localidad, 3)) {
    $objeto->setLocalidad($localidad);
} else {
    
}
if (Validar::isLongitudMinima($provincia, 2)) {
    $objeto->setProvincia($provincia);
} else {
    
}
if (Validar::isNumero($precio)) {
    $objeto->setPrecio($precio);
} else {
    
}

if (Validar::isEntero($superficie)) {
    $objeto->setSuperficie($superficie);
} else {
    
}
if (Validar::isCP($cp)) {
    $objeto->setCp($cp);
} else {
    
}
if (Validar::isLongitudMinima($calle, 4)) {
    $objeto->setCalle($calle);
} else {
    
}
//Creamos la base de datos y el modelo
$bd = new BaseDatos();
$modelo = new modeloInmueble($bd);
$r = $modelo->edit($objeto);
header("Location: ../adminpanel.php?correcto=$r");