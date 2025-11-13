<?php
// control_arduino.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Para evitar problemas CORS

// Verificar si estamos recibiendo el parámetro
if (isset($_GET['accion'])) {
    $accion = strtoupper($_GET['accion']);
    
    if ($accion == 'LIBRE' || $accion == 'OCUPADO') {
        
        // Guardar el estado en un archivo para referencia
        if (file_put_contents('estado_actual.txt', $accion) === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Error al guardar estado en archivo'
            ]);
            exit;
        }
        
        // Enviar comando al Arduino
        $puerto = 'COM3'; // ⚠️ CAMBIA ESTO POR TU PUERTO REAL
        
        try {
            // Configurar puerto serial
            $modeCommand = "mode $puerto BAUD=9600 PARITY=n DATA=8 STOP=1";
            $echoCommand = "echo $accion > $puerto";
            
            // Ejecutar comandos
            $output1 = shell_exec($modeCommand);
            sleep(1); // Esperar 1 segundo para configuración
            $output2 = shell_exec($echoCommand);
            
            echo json_encode([
                'success' => true,
                'message' => "Comando $accion enviado a Arduino",
                'estado' => $accion,
                'debug' => [
                    'mode_output' => $output1,
                    'echo_output' => $output2
                ]
            ]);
            
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Error al enviar comando: ' . $e->getMessage()
            ]);
        }
        
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Acción no válida. Use: LIBRE o OCUPADO'
        ]);
    }
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'No se especificó acción (parámetro: accion)'
    ]);
}
?>