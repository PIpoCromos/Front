<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form action="includes/login.inc.php" method = 'post'>
    <input type="text" name="email" placeholder="Email">
    <input type="password" name="pwd" placeholder="Contraseña">
    <button>Login</button>

<?php 
    check_login_errors();
?>

    </form action="includes/signup.inc.php">

            <div class="regisForm">
                <h2>Registrarse</h2>
                <!-- <label for="email">Correo Electrónico:</label> -->
                <input type="email" name="email" id="email" placeholder="Ingrese su email">
            </div>
            <div class="regisForm">
                <!-- <label for="password">Contraseña:</label> -->
                <input type="password" name="pwd" id="password" placeholder="Ingrese su contraseña">
            </div>
            <button id="loginBtn">Registrarse</button>
    <script src="login.js"></script>
</body>
</html>

    <?php
    check_signup_errors(); 
    ?>


