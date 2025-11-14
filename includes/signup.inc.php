<?php

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $espec = $_POST["espec"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {
        
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        //ERROR HANDLERS

        $errors = []; //si hay un error en estas condiciones, le asignamos a $errors un valor por cada error

        if (is_input_empty($nombre, $apellido, $espec, $pwd, $email)) {
            $errors["empty_input"] = "Rellene todos los campos!" . "<br>"; //le asigno un valor llave al array con un mensaje de error.
        }

        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Email invalido usado!" . "<br>"; 
        }

        // if (is_username_taken($pdo, $username)) {
        //     $errors["username_taken"] = "Username already taken!"; 
        // }

        if (is_email_registered($pdo,  $email)) {
            $errors["email_used"] = "Email already used!"; 
        }

        require_once 'config_session.inc.php'; //empiezo la sesion de config con el require

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;
            header("Location: ../login.php");
            die();
        }

        create_user($pdo, $nombre, $apellido, $espec, $pwd, $email);

        header("Location: ../main.html?signup=success");

        $pdo = null;
        $stmt = null;
        die();

    } catch (PDOException $e) {
    die("Conexion fallida: " . $e->getMessage());   
    }

} else {
    header("Location: ../login.php");
    die();
}
