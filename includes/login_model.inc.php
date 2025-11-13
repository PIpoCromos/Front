<?php

declare(strict_types=1);


function get_user(object $pdo, string $email) {

    $query = "SELECT * FROM personal WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(":email", $email);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); //agarramos la primer fila
    return $result;
}