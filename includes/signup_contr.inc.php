<?php

declare(strict_types=1);

function is_input_empty(string $nombre, string $apellido, string $espec, string $pwd, string $email) {
    if (empty($nombre) || empty($pwd) || empty($email) || empty($apellido) || empty($espec)) {
        return true;
    } else {
        return false;
    }
}

function is_email_invalid(string $email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //Si FILTER_VALIDATE_EMAIL devuelve false, ejecutar
        return true;
    } else {
        return false;
    }
}

function is_username_taken(object $pdo, string $nombre) {
    if (get_username( $pdo, $nombre)) {
        return true; //es un error
    } else {
        return false; //no es un error
    }
}

function is_email_registered(object $pdo, string $email) {
    if (get_email( $pdo,  $email)) { 
        return true; //es un error 
    } else {
        return false; //no es un error
    }
}

function create_user(object $pdo, string $nombre, string $apellido, string $espec, string $pwd, string $email) {
    set_user($pdo, $nombre, $apellido, $espec, $pwd, $email);
}