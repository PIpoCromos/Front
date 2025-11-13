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

    <!-- <div class="formulario">
        <h2>Iniciar sesion</h2>
        <form action="includes/login.inc.php" method='post'>
            <div class="regisForm">
                <input type="email" name="email" id="email" placeholder="Ingrese su email">
                <input type="password" name="pwd" id="password" placeholder="Ingrese su contraseña">
                <button class="boton">Login</button>
            </div>
        </form>
    </div> -->

<?php 
    check_login_errors();
?>

    <div class="formulario">
        <h2>Crear cuenta</h2>
        <form action="includes/signup.inc.php" method='post'>
            <div class="regisForm">
                <input type="text" name='nombre' placeholder="Nombre del personal">
                <input type="text" name='apellido' placeholder="Apellido del personal">
                <label for="espec">Especialidad del personal</label>
                <div type="select1" class="select-css">
                    <select name="espec" id="select-form">
                    <option value="Doctor">Doctor</option>
                    <option value="Enfermera">Enfermero</option>
                </select>
                </div>

                <input type="email" name="email" id="email" placeholder="Ingrese su email">
                <input type="password" name="pwd" id="password" placeholder="Ingrese su contraseña">
                <button class="boton">Registrarse</button>
            </div>
        </form>
    </div>
    <script src="login.js"></script>
</body>
</html>

    <?php
    check_signup_errors(); 
    ?>


