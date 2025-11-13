<?php

declare(strict_types=1);

function check_login_errors() {
    if (isset($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];

        echo "<br>";

        foreach ($errors as $error) {
            echo $error;
        }

        unset($_SESSION["errors_login"]);
    }
    elseif (isset($_GET['login']) && $_GET['login'] === "success"); 
}