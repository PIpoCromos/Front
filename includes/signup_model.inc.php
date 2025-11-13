<?php

declare(strict_types=1);

// function get_username(object $pdo, string $username) {
//     $query = "SELECT nombre FROM personal WHERE nombre = :nombre;";
//     $stmt = $pdo->prepare($query);
    
//     $stmt->bindParam(":nombre", $nombre);

//     $stmt->execute();

//     $result = $stmt->fetch(PDO::FETCH_ASSOC);
//     return $result;
// }

function get_email(object $pdo, string $email) {
    $query = "SELECT email FROM personal WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(":email", $email);

    $stmt->execute();

    $result = $stmt -> fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(object $pdo, string $nombre, string $apellido, string $espec, string $pwd, string $email) {
    $query = "INSERT INTO personal (nombre, apellido, especialidad, pwd, email) VALUES (:nombre, :apellido, :espec, :pwd, :email);";
    $stmt = $pdo->prepare($query);

    $options = [
        'cost' => 12
    ];
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);
    
    $stmt->bindParam(":nombre", $nombre);
    $stmt->bindParam(":apellido", $apellido);
    $stmt->bindParam(":espec", $espec);
    $stmt->bindParam(":pwd", $hashedPwd);
    $stmt->bindParam(":email", $email);

    $stmt->execute();
}