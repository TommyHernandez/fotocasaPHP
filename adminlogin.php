<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login-Admin</title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <script src="js/valform.js"></script>
</head>
<body>
    <div id="contenedora">
        <header id="cabecera">
            <div class="centrado">
                <section id="logo">
                    <img src="img/logo.png" alt="logo" />
                </section>
                <nav id="menu">
                    <ul>
                        <li><a href="#">Home</a>
                        </li>
                        <li><a href="buscador.php">Buscador</a>
                        </li>
                        <li><a href="adminlogin.php">Login</a>
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
                    <label for="login">
                        Login:
                        <input type="text" id="login" name="login" value="" />
                    </label>
                    <label for="key">
                        Clave:
                        <input type="password" id="key" name="key" value="" />
                    </label>
                    <input type="submit" value="login" />
                </form>
            </div>
        </div>
        <footer></footer>
    </div>

</body>

</html>
