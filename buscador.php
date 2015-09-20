<?php
require './require/comun.php';
$usuario = $sesion->getUsuario();
// creamos base de datos y modelos
$bd = new BaseDatos();
$modelo = new modeloInmueble($bd);
$modeloFoto = new modeloFoto($bd);
if (Leer::get("p")) {
    $inicio = Leer::get("p");
} else {
    $inicio = 0;
}

if (Leer::post("rpp")) {
    $rpp = Leer::post("rpp");
} else {
    $rpp = 10;
}
$ids = array();
if (Leer::post("token")) {
    $tipo = strtolower(Leer::post("tipo"));
    $estado = strtolower(Leer::post("estado"));
    $voa = strtolower(Leer::post("voa"));
    $orden = "precio " . Leer::post("orden");
    if ($voa != "") {
        $condicion = "tipo = '$tipo' AND estado= '$estado' AND objetivo= '$voa'";
        $filas = $modelo->getList($inicio, $rpp, $condicion);
    } else {
        $condicion = "tipo = '$tipo' AND estado= '$estado'";
        $filas = $modelo->getList($inicio, $rpp, $condicion);
    }
    foreach ($filas as $indice => $object) {
        $ids[] = $object->getId();
    }
    $filasfotos = $modeloFoto->getListDe($ids);
} else {
    $filas = $modelo->getList($inicio, $rpp);
    $filasfotos = $modeloFoto->getList($inicio, $rpp * 2);
}
//
$adminpanel = "<a href='adminpanel.php'>Panel</a>";

?>
<!doctype html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Inmocasa-Busqueda</title>
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/terceros/slimbox.css" type="text/css" media="screen" />
        <script type="text/javascript" src="js/terceros/mootools.js"></script>
        <script type="text/javascript" src="js/terceros/slimbox.js"></script>
    </head>

    <body>
        <header id="cabecera">
            <div class="centrado">
                <section id="logo">
                    <img src="img/logo.png" alt="logo" />               
                </section>
                <nav id="menu">
                    <ul>
                        <li><a href="index.php">Home</a>
                        </li>
                        <li><a href="buscador.php">Buscador</a>
                        </li>
                        <li><a href="adminlogin.php">Login</a>
                        </li>
                        <li> <?php
                            if ($usuario) {
                                echo $adminpanel;
                            }
                            ?></li>
                    </ul>

                </nav>
            </div>
            <div class="separador"></div>
        </header>

        <div id="index-cuerpo">
            <div class="centrado">

                <div id="cuerpo-tabla">
                    <table id="tabla-index">
                        <?php
                        foreach ($filas as $indice => $objeto) {
                            ?>
                            <tr>    
                                <td>
                                    <?php
                                    $continuar = true;
                                    $total = sizeof($filasfotos);
                                    $isFirst = TRUE;
                                    for ($o = $indice; $o < $total; $o++) {
                                        $foto = $filasfotos[$o];
                                        if ($foto->getIdinmueble() == $objeto->getId()) {
                                            $ruta = substr($foto->getRuta(), 1);
                                            if ($isFirst) {
                                                $isFirst = FALSE;
                                                ?>
                                                <a href="<?php echo $ruta ?>" class="image-link" rel="lightbox-grupo<?php echo$foto->getIdinmueble(); ?>" title="Foto">
                                                    <img src="<?php echo $ruta ?>" class="image miniatura" alt="Foto" />
                                                </a>

                                                <?php
                                            } else {
                                                ?>
                                                <a class="oculto" href="<?php echo $ruta ?>" class="image-link" rel="lightbox-grupo<?php echo$foto->getIdinmueble(); ?>" title="Foto">
                                                    <img class="oculto" src="<?php $ruta ?>" class="image" alt="Foto" />
                                                </a>
                                                <?php
                                            }
                                        } else {
                                            
                                        }
                                    }
                                    ?>
                                </td>
                                <td class="contenido-tabla">
                                    <ul>
                                        <li><?php echo $objeto->getTitulo(); ?></li> 
                                        <li><?php
                                            echo number_format($objeto->getPrecio(), 2, ',', '.');
                                            echo "€";
                                            ?></li>
                                        <li><?php echo $objeto->getObjetivo(); ?></li>
                                    </ul>
                                </td>
                                <td><?php echo $objeto->getDescripcion(); ?></td>
                                <td> <?php echo $objeto->getProvincia(); ?> </td>
                            </tr>
                            <?php
                        }//fin del foreach
                        ?>
                    </table>
                   
                </div>
            </div>
            <form action="" method="post">
                <fieldset>
                    <legend>Buscador</legend>
                    <br/>
                    <label>Tipo</label>
                    <select name="tipo">
                        <option>Casa</option>
                        <option>Piso</option>
                        <option>Terreno</option>
                    </select>
                    <label>Estado
                        <select name="estado">
                            <option>Nuevo</option>
                            <option>Segunda Mano</option>
                        </select>
                    </label>
                    <br/>
                    <label>Venta / Alquiler</label>
                    <select name="voa">
                        <option></option>
                        <option>venta</option>
                        <option>Alquiler</option>
                    </select>
                    <label>Ordenar por precio:</label>
                    <input type="radio" name="orden" value="asc" checked="checked"/>Ascendente
                    <br/>
                    <input type="radio" name="orden" value="dsc" />Descendente
                    <br/>
                    <label>
                        Lista por pagina:<select name="rpp">
                            <option>5</option>
                            <option>10</option>
                            <option>15</option>
                            <option>20</option>
                            <option>30</option>
                            <option>40</option>
                            <option>50</option>
                            <option>60</option>
                            <option>80</option>
                            <option>100</option>
                        </select>
                    </label>
                    <input type="text" name="token" value="seteado" hidden="">
                    <input type="submit" value="Buscar" />
                    <input type="reset" value="limpiar" />
                </fieldset>
            </form>

        </div>

    </div>



</body>

</html>