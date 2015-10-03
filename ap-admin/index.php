<?php
include_once '../require/comun.php';
$err = 0;
$err = Leer::get("er");
include '../includes/admin-head.php';
?>
<body>

    <header id="cabecera" class="padded">
        <div class="container">
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
    <div id="container">
        <?php if ($err != 0) { ?>
            <p class="message dismissible red">La contraseña introducida no es correcta</p>
        <?php } ?>
        <div id="sec-login">
            <h2>Admin-login</h2>
            <form name="loginform" action="../usuario/phplogin.php" method="POST" >
                <div class="row">
                    <div class="one half padded">
                        <label for="login">Nombre</label>
                        <input id="login" name="login" type="text" placeholder="Nombre de usuario" required>
                    </div>
                    <div class="one half padded">
                        <label for="password">Clave:</label>
                        <input id="password" type="password" name="key" placeholder="*****">
                    </div>
                </div>
                <div class="row" style="text-align: right; padding-right: 11px;">
                    <input type="submit" value="Conectar" class=""  />
                </div>
            </form>
        </div>
        <footer></footer>
    </div>

</body>
</html>
<?php
if ($autentificado) {
    if ($sesion->isAdminLogin()) {
        header("Location: panel.php");
    } else {
        
    }
}
?>
