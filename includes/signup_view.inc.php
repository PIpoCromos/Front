<?php

declare(strict_types=1);

function check_signup_errors() {
    if (isset($_SESSION["errors_signup"])) {
        $errors = $_SESSION["errors_signup"];

        echo "<br>";

        foreach ($errors as $error ) {
            echo $error;
        }

        unset($_SESSION["errors_signup"]); //borro los datos que ya no necesito
    } else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo "<br>";
        echo "<p> Signup success! </p>";
    }
}