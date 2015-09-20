<?php
require './require/comun.php';
$usuario = $sesion->getUsuario();
// creamos base de datos y modelos
$bd = new BaseDatos();
$modelo = new modeloInmueble($bd);
$modeloFoto = new modeloFoto($bd);
$inicio = 0;
$filas = $modelo->getList($inicio, $rpp = 10, "1=1", "fecha asc");
$filasfotos = $modeloFoto->getList($inicio, $rpp = 10);
//
$adminpanel = "<a href='adminpanel.php'>Panel</a>";
//
$idinsertadas[] = array();
foreach ($filasfotos as $indice => $foto) {
    if (!in_array($foto->getIdinmueble(), $idinsertadas)) {
        $rutas[] = substr($foto->getRuta(), 1);
        $idinsertadas[] = $foto->getIdinmueble();
    }
}
?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <?php
        include 'includes/head.php';
        ?>
    </head>

    <body>
        <header id="cabecera">
            <div class="centrado">
                <section id="logo">
                    <img src="img/logo.png" alt="logo" />               
                </section>
                <nav id="menu" class="">
                    <ul>
                        <li><a href="#">Home</a>
                        </li>
                        <li><a href="buscador.php">Buscador</a>
                        </li>
                        <li><a href="adminlogin.php">Login</a>
                        </li>
                        <li> <?php if ($usuario) {
            echo $adminpanel;
        }
        ?></li>
                    </ul>

                </nav>
            </div>
            <div class="separador"></div>
        </header>
        <section id="index-cuerpo">
            <div class="centrado">
                <p class="destacado"><strong>Top 10 por fecha</strong></p>
                <div id="cuerpo-tabla">
                    <table id="tabla-index">
                        <?php
                        if (!$filas) {
                            ?>
                            <p class="message dismissible green">No hay ninguna Casa para mostrar.</p>  
                            <?php
                        } else {
                            foreach ($filas as $indice => $objeto) {
                                ?>
                                <tr>    
                                    <td>
                                        <img class="miniatura" src="<?php echo $rutas[$indice] ?>" alt=""/>

                                    </td>
                                    <td class="contenido-tabla">
                                        <ul>
                                            <li><?php echo $objeto->getTitulo(); ?></li> 
                                            <li><?php
                                                echo number_format($objeto->getPrecio(), 2, ',', '.');
                                                echo "€";
                                                ?></li>
                                        </ul>
                                    </td>
                                    <td> <?php echo $objeto->getProvincia(); ?> </td>
                                </tr>
                                <?php
                            }//fin del foreach
                        }
                        ?>
                    </table>
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
<?php ?>