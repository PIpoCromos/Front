<?php
// leer_estado.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

function leerEstadoArduino() {
    // Intentar leer del archivo de estado
    if (file_exists('estado_actual.txt')) {
        $estado = trim(file_get_contents('estado_actual.txt'));
        return $estado;
    }
    return 'LIBRE'; // Estado por defecto
}

$estado = leerEstadoArduino();
echo json_encode([
    'estado' => $estado,
    'success' => true
]);
?>