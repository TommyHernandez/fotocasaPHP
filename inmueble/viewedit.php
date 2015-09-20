<?php
require '../require/comun.php';
//este metodo comprueba que estas atuentificado en la sesion como ROOT
$sesion->administrador("../index.php");
//Creamos la base de datos
$bd = new BaseDatos();
$modelo = new modeloInmueble($bd);
$id = LEER::get("id");
$condicion = "id=$id";
$fila = $modelo->getList(0, 1, $condicion);
$objeto = $fila[0];
if ($objeto->getEstado() == "nuevo") {
    $actual = "Nuevo";
    $siguiente ="Segunda Mano";
}else{
    $actual = "Segunda Mano";
    $siguiente = "Nuevo";
}
if ($objeto->getObjetivo() == "venta") {
    $objetivoAc = "Venta";
    $objetivoSig ="Alquiler";
}else{
    $objetivoAc = "Alquiler";
    $objetivoSig = "Venta";
}
$bd->closeConexion();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edicion</title>
        <!--link rel="stylesheet" href="../css/style.css" type="text/css" media="screen" /-->
    </head>
    <body>
        <header id="cabecera">
            <div class="centrado">
                <section id="logo">
                    <img src="../img/logo.png" alt="logo" />               
                </section>
                <nav id="menu">
                    <ul>
                        <li><a href="../index.php">Home</a>
                        </li>
                        <li><a href="../buscador.php">Buscador</a>
                        </li>
                        <li><a href="../adminlogin.php">Login</a>
                        </li>
                        <li><a href="../adminpanel.php" >Panel</a></li>
                    </ul>
                </nav>
            </div>
            <div class="separador"></div>
        </header>
        <section id="index-cuerpo">
            <div class="centrado">
                <h1>Formulario de Edicion</h1>
                <div id="aniadir" class="oculto">
                    <hr>
                    <h3>Insercion de inmuebles</h3>
                    <form name="insert" action="phpupdate.php" method="POST">
                        <label for="titulo">
                            Titulo:
                            <input type="text" id="titulo" name="titulo" value="<?php echo $objeto->getTitulo(); ?>" required autofocus/>
                        </label>
                        <br/>
                        <label 
                            Descripción:
                            <textarea  name="descripcion" rows="10" cols="50" >
                                <?php echo $objeto->getDescripcion();?>
                            </textarea>
                        </label>
                        <br/>
                        <input name="tipo" value="<?php echo $objeto->getTipo()?>" hidden/>
                        <label for="estado">
                            Estado:
                            <select id="estado" name="estado">
                                <option><?php echo $actual; ?></option>
                                <option><?php echo $siguiente; ?></option>
                            </select>
                            ( saldra marcada la opcion atual)
                        </label>
                        <br/>
                        <label for="precio">
                            Precio:
                            <input type="number" id="precio" name="precio" value="<?php echo $objeto->getPrecio(); ?>" />
                        </label>
                        <br/>
                        <label for="localidad">
                            Localidad:
                            <input type="text" id="localidad" name="localidad" value="<?php echo $objeto->getLocalidad(); ?>" />
                        </label>
                        <br/>
                        <label for="provincia">
                            Provincia:
                            <input type="text" id="provincia"  name="provincia" list="provincias" value="<?php echo $objeto->getProvincia(); ?>" />
                            <datalist id="provincias">
                                <option>Granada</option>
                                <option>Almeria</option>
                                <option>Cordoba</option>
                                <option>Jaen</option>
                                <option>Sevilla</option>
                                <option>Malaga</option>
                                <option>Cadiz</option>
                                <option>Huelva</option>
                                <option>Madrid</option>
                                <option>Barcelona</option>
                            </datalist>
                        </label>
                        <br/>
                        <br/>
                        <label for="calle">
                            Calle:
                            <input type="text" id="calle" name="calle" value="<?php echo $objeto->getCalle(); ?>" required/>
                        </label>
                        <br/>
                        <label for="cp">
                            Codigo Postal:
                            <input type="number"  id="cp" name="cp" maxlength="5" value="<?php echo $objeto->getCp(); ?>" />
                        </label>
                        <br/>
                        <label for="superficie">
                            Superficie:
                            <input type="number" id="superficie" name="superficie" value="<?php echo $objeto->getSuperficie(); ?>" required/>
                        </label>
                        <br/>
                        <label for="objetivo">
                            Objetivo:
                            <select id ="objetivo" name="objetivo">( saldra marcada la opcion atual)
                                <option><?php echo $objetivoAc; ?></option>
                                <option><?php echo $objetivoSig; ?></option>
                            </select>
                        </label>
                        <br/>
                        <br/>
                        <input type="number" name="id" value="<?php echo $objeto->getId(); ?>" hidden/>
                        <input type="submit" class="boton" id="enviar" class="boton" value="Editar" />
                    </form>

                </div>
            </div>
            <div class="separador"></div>
            <hr>
        </section>
        <footer id="pie">
            <div class="centrado">
            </div>
        </footer>      
    </body>
</html>
