<?php 
    include '../includes/admin-head.php';
?>
    <body>
        <div id="contenedora">
            <header id="cabecera">
                <div class="centrado">
                    <section id="logo">
                        <img src="../img/logo.png" alt="logo" />
                    </section>
                    <nav id="menu">
                        <ul>
                            <li><a href="../">Home</a>                                
                            </li>
                            <li><a href="buscador.php">Buscador</a>
                            </li>
                        </ul>

                    </nav>
                </div>
                <div class="separador"></div>
            </header>
            <div id="index-cuerpo" class="centrado relleno">
                <div id="sec-login">
                    <h2>Admin-login</h2>
                    <form name="loginform" action="usuario/phplogin.php" method="POST">
                        <div class="row">
                            <div class="one half padded">
                                <label for="name">Nombre</label>
                                <input id="login" name="login" type="text" placeholder="Nombre de usuario">
                            </div>
                            <div class="one half padded">
                                <label for="email">Clave:</label>
                                <input id="password" type="password" name="key" placeholder="*****">
                            </div>
                        </div>
                        <input type="submit" value="login" />
                    </form>
                </div>
            </div>
            <footer></footer>
        </div>

    </body>

</html>
