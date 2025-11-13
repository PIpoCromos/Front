<?php

declare(strict_types=1);

function is_input_empty(string $email, string $pwd) {
    if (empty($email) || empty($pwd)) {
        return true;
    } else {
        return false;
    }
}

function is_username_wrong(bool|array $result) { //La variable que puede salir es bool o array (el username)

    if (!$result) { //si result es = false
        return true; //No encontramos ningun nombre
    } else {
        return false; //se encontro nombre
    }

}



function is_password_wrong(string $pwd, string $hashedPwd) {
        if (!password_verify($pwd, $hashedPwd)) { //si las contras no coinciden
        return true;
    } else {
        return false; 
    }
}