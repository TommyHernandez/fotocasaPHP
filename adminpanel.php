<?php
require './require/comun.php';
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
//este metodo comprueba que estas atuentificado en la sesion como ROOT 
$sesion->administrador("index.php");
$usuario = $sesion->getUsuario();
$bd = new BaseDatos();
$modelo = new modeloInmueble($bd);
$inicio = 0;
$filas = $modelo->getList($inicio, $rpp = 10);
?>
<!DOCTYPE html>
<html lang="es">
<?php include './includes/head.php'; ?>
  <script src="js/backend.js"></script>
    
    <body>
        <header id="superior">
            <div id="conected">
                <p>Conectado como:
                    <?php echo $usuario->getRol(); ?>
                    Hola:
                    <?php echo $usuario->getNombre() . " " . $usuario->getApellidos(); ?></p>
            </div>
        </header>
        <section id="panel">
            <p>
                <span id="inmuebles-ad" >Inmuebles</span>
            <ul id="lista-acc" class="oculto">
                <li id="m-add">Añadir</li>
                <li id="m-edit">Editar</li>
            </ul>
        </p>
        <p>
            <span>Usuaios</span>

        </p>
        <p><span><a href="index.php">Index</a></span>
        </p>


    </section>
    <section id="cuerpo">
        <div id="cuerpo-inicial"> 
            <h3>Total de inmuebles</h3>          
            <table id="admin-table">
                <tr>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th>Precio</th>
                    <th>Localidad</th>
                    <th>Provincia</th>
                    <th>Tipo</th>
                    <th>Calle</th>
                    <th>Superficie (m)</th>
                    <th>CP</th>
                    <th>Objetivo</th>
                    <th>Fecha Anuncio</th>
                    <th>Eliminar</th>
                    <th>Modificar Fotos</th>
                    <th>Edtar</th>

                </tr>
                <?php
                foreach ($filas as $indice => $objeto) {
                    ?>
                    <tr>
                        <td><?php echo $objeto->getTitulo(); ?></td>
                        <td> <?php echo $objeto->getDescripcion(); ?> </td>
                        <td> <?php echo $objeto->getEstado(); ?></td>
                        <td> <?php echo $objeto->getPrecio(); ?> </td>
                        <td> <?php echo $objeto->getLocalidad(); ?></td>
                        <td> <?php echo $objeto->getProvincia(); ?></td>
                        <td> <?php echo $objeto->getTipo(); ?> </td>
                        <td> <?php echo $objeto->getCalle(); ?></td>
                        <td> <?php echo $objeto->getSuperficie(); ?></td>
                        <td><?php echo $objeto->getCp(); ?></td>
                        <td><?php echo $objeto->getObjetivo(); ?></td>
                        <td><?php echo $objeto->getFecha(); ?></td>
                        <td><a class ="eliminador" href="<?php echo "inmueble/phpdelete.php?id=" . $objeto->getId() ?>" ><img src="img/delete48.png" title="eliminar foto" alt="borrar"/></a></td>
                        <td><a class ="fotoedit" href="<?php echo "foto/viewfoto.php?id=" . $objeto->getId() ?>" >Ir a fotos</a></td>
                        <td><a class ="editador" href="<?php echo "inmueble/viewedit.php?id=" . $objeto->getId() ?>" >Editar</a></td>

                    </tr>  
                    <?php
                }
                ?>
            </table>
        </div>
        <div id="aniadir" class="oculto">
            <hr>
            <h3>Insercion de inmuebles</h3>
            <form name="insert" action="inmueble/phpinsert.php" method="POST" enctype="multipart/form-data">
                <label for="titulo">
                    Titulo:
                    <input type="text" id="titulo" name="titulo" value="" required autofocus minlenght="6"/>
                </label>
                <br/>
                <label for="descripcion">
                    Descripción:
                    <textarea id="descripcion" name="descripcion"></textarea>
                </label>
                <br/>
                <label for="estado">
                    Estado:
                    <select id="estado" name="estado">
                        <option>Nuevo</option>
                        <option>Segunda Mano</option>
                    </select>
                </label>
                <br/>
                <label for="precio">
                    Precio:
                    <input type="number" id="precio" name="precio" value="" required /><span></span>
                </label>
                <br/>
                <label for="localidad">
                    Localidad:
                    <input type="text" id="localidad" name="localidad" value="" required/>
                </label>
                <br/>
                <label for="provincia">
                    Provincia:
                    <input type="text" id="provincia"  name="provincia" list="provincias" value="" />
                    <datalist>
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
                <label for="tipo">
                    Estado:
                    <select id ="tipo" name="tipo">
                        <option>Casa</option>
                        <option>Piso</option>
                        <option>Terreno</option>
                    </select>
                </label>
                <br/>
                <label for="calle">
                    Calle:
                    <input type="text" id="calle" name="calle" value="" required/>
                </label>
                <br/>
                <label for="cp">
                    Codigo Postal:
                    <input type="number"  id="cp" name="cp" maxlength="5" value="" /><span></span>
                </label>
                <br/>
                <label for="superficie">
                    Superficie:
                    <input type="number" id="superficie" name="superficie" value="" required/><span></span>
                </label>
                <br/>
                <label for="objetivo">
                    Objetivo:
                    <select id ="objetivo" name="objetivo">
                        <option>Venta</option>
                        <option>Alquiler</option>
                    </select>
                </label>
                <br/>
                <label>
                    Fotos:
                    <input type="file" name="fotos[]" value="" />
                    <input type="file" name="fotos[]" value="" />
                </label>
                <br/>
                <input type="submit" id="enviar" class="boton" value="Añadir" />
                <input type="reset" id="reinicio" class="boton" value="Limpiar" />
            </form>
            <article class="row">
                <section class="two small-tablet thirds padded bounceInDown animated">
                    <h1>Contact Us</h1>
                    <p>We love to hear from you and welcome your feedback. Use the form below to send us an email:</p>
                    <form>
                        <fieldset>
                            <legend>Contact Form</legend>
                            <div class="row">
                                <div class="one small-tablet fourth padded no-pad-bottom-mobile">
                                    <label for="name">Your Name</label>
                                </div>
                                <div class="three small-tablet fourths padded no-pad-top-mobile">
                                    <input id="name" name="name" type="text" placeholder="Your Name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="one small-tablet fourth padded no-pad-bottom-mobile">
                                    <label for="email">Your Email</label>
                                </div>
                                <div class="three small-tablet fourths padded no-pad-top-mobile">
                                    <input id="email" name="email" type="text" placeholder="you@example.com">
                                </div>
                            </div>
                            <div class="row">
                                <div class="one whole pad-left pad-right pad-top">
                                    <label for="message">Your Message</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="one whole pad-left pad-right pad-bottom">
                                    <textarea id="message" name="message" placeholder="Write us a message here..."></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="one whole padded align-right">
                                    <button type="submit" class="asphalt">Send Message</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </section>
                <aside class="one small-tablet third padded border-left no-border-mobile bounceInRight animated">
                    <h3>Our Location</h3>
                    <h5>
                        <address>12345 Some Street<br>San Francisco, CA 94018</address>
                    </h5>
                    <p class="double-gap-bottom"><a href="https://maps.google.com/maps?f=d&amp;source=s_q&amp;hl=en&amp;geocode=%3BCWTrT4dujQbzFYZxQAIdei-0-Cl7MGKmg4CFgDFQ-cEtDAGZ_Q&amp;q=SOMA+san+francisco&amp;aq=&amp;sll=37.77493,-122.419416&amp;sspn=0.292536,0.657463&amp;t=h&amp;ie=UTF8&amp;hq=&amp;hnear=South+of+Market,+San+Francisco,+California&amp;z=14&amp;vpsrc=0&amp;iwloc=A&amp;daddr=South+of+Market,+San+Francisco,+CA" role="button" target="_blank" class="green noicon"><i class="icon-map-marker gap-right"></i>Get Directions</a></p>
                    <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=SOMA+san+francisco&amp;aq=&amp;sll=37.77493,-122.419416&amp;sspn=0.292536,0.657463&amp;t=h&amp;ie=UTF8&amp;hq=&amp;hnear=South+of+Market,+San+Francisco,+California&amp;z=14&amp;ll=37.777798,-122.409094&amp;output=embed"></iframe>
                </aside>
            </article>
        </div>

    </section>
    <footer>
        <div class="centrado">
            <p>Copyright inmocasa 2014</p>
        </div>
    </footer>
</body>

</html>
