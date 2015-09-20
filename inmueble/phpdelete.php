<?php
/**
 * PHP delete de inmueble es el encargado de borrar el inmueble de la base dedatos, ademas al haber una
 * clave foranea en la imagen tambien borrará las tuplas de las imaagenes en la tabla foto
 * pero OJO no del disco, del disco la borraremos ocn unlink.
 */
require '../require/comun.php';
//este metodo comprueba que estas atuentificado en la sesion como ROOT
$sesion->administrador("../index.php");
//Creamos la base de datos
$bd = new BaseDatos();
//creamos el usuario y su modelo
$modelo = new modeloInmueble($bd);
$id = Leer::get("id");
//
$r = $modelo->delete($id);
$modeloFoto = new modeloFoto($bd);
$condicion= "idinmueble=$id";
$filas = $modeloFoto->getList(0, 5, $condicion);
foreach ($filas as $indice => $objeto){
   $un = $objeto->deleteArchivo();
   
}
header("Location: ../adminpanel.php?completado=$r$un");
