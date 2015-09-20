<?php
require '../require/comun.php';
//este metodo comprueba que estas atuentificado en la sesion como ROOT en caso negativo te manda al index
$sesion->administrador("../index.php");
//creamos la base de datos y los modelos
$bd = new BaseDatos();
$modelo = new modeloFoto($bd);
$id = LEER::get("id");
$condicion = "idinmueble=$id";
$filas = $modelo->getList(0, 5, $condicion);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Vista de fotos</title>
        <link rel="stylesheet" href="../css/style.css" type="text/css" media="screen"/>
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
               <div id="cuerpo-tabla">
                    <table id="tabla-index">
                        <tr>
                        <th>Foto</th>
                        <th>Eliminar</th>
                        </tr>
                        <?php
                        foreach ($filas as $indice => $objeto) {
                            ?>
                            <tr>    
                                <td class="contenido-tabla">
                                    <img src="<?php echo $objeto->getRuta(); ?>" alt="foto" />
                                </td>
                                <td><a id="eliminador" href="phpdelete.php?id=<?php echo $objeto->getId(); ?>" ><img src="../img/delete48.png" title="eliminar foto" alt="borrar"/></a></td>
                            </tr>
                            <?php
                        }//fin del foreach
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
