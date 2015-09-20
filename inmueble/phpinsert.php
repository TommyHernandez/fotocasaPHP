<?php
require '../require/comun.php';
//este metodo comprueba que estas atuentificado en la sesion como ROOT en caso negativo te manda al index
$sesion->administrador("../index.php");
/* Primeros validamos si alguna cosa no esta en su sitio no abrimos la base de dato ni creamos el modelo.
 * 
 */
$objeto = new Inmueble();
$titulo = LEER::post("titulo");
$descripcion = LEER::post("descripcion");
$estado = strtolower(LEER::post("estado"));
$precio = (double) LEER::post("precio");
$localidad = LEER::post("localidad");
$provincia = LEER::post("provincia");
$tipo = strtolower(LEER::post("tipo"));
$calle = LEER::post("calle");
$superficie = (int) LEER::post("superficie");
$cp = (int) LEER::post("cp");
$objetivo = strtolower(LEER::post("objetivo"));

//validamos y añadimos
$objeto->setEstado($estado);
$objeto->setObjetivo($objetivo);
$objeto->setTipo($tipo);
$objeto->setDescripcion($descripcion);
if (Validar::isLongitudMinima($titulo, 6)) {
    $objeto->setTitulo($titulo);
} else {
    exit();
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
$r = $modelo->add($objeto);
//Evitamos subir fotos y crear lso objetos correspondientees si la insercion no se hace correctamente
if ($r != -1) {
    //subimos las fotos
    $subida = new Subir("fotos");
    $subida->setDestino("../fotos");
    $subida->setAccion(Subir::RENOMBRAR);
    $subida->addExtension("pdf");
    $subida->subir();
//creamos el objeto foto
    $foto = new Foto();
    $destino = $subida->getDestinos();
    $modeloFoto = new modeloFoto($bd);
    for ($a = 0; $a < sizeof($destino); $a++) {
        $foto->setRuta($destino[$a]);
        $foto->setIdinmueble($r);
        $r1 = $modeloFoto->add($foto);
    }
}
header("Location: ../adminpanel.php?operation=$r$r1");
