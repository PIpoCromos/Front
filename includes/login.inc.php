<?php

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    try {
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        //ERROR HANDLERS

        $errors = []; //si hay un error en estas condiciones, le asignamos a $errors un valor por cada error

        if (is_input_empty($email, $pwd)) {
            $errors["empty_input"] = "Fill in all fields!"; //le asigno un valor llave al array con un mensaje de error.
        }

        $result = get_user($pdo, $email); //variable que contiene lo agarrado del user (tambien errors)

        if (is_username_wrong($result)) {
            $errors["login_incorrect"] = "Info de logeo incorrecta!";
        }

        if (!is_username_wrong($result) && is_password_wrong($pwd, $result["pwd"])) {
            $errors["login_incorrect"] = "Info de logeo incorrecta!";
        }

        require_once 'config_session.inc.php'; //empiezo la sesion de config con el require

        if ($errors) {
            $_SESSION["errors_login"] = $errors;
            header("Location: ../login.php");
            die();
        }
        
        $newSessionId = session_create_id();
        $sessionId = $newSession . "_" . $result[$id];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_email"] = htmlspecialchars($result["email"]);

        $_SESSION["last_regeneration"] = time();

        header("Location: ../login.php");
        $stmt = null;
        $pdo = null;

        die();
    } catch (PDOException $e) {
    die("Conexion fallida: " . $e->getMessage()); 
    }

} else {
    header("Location: ../login.php");
    die();
}