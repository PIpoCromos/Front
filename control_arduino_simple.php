<?php
// control_arduino_simple.php
if (isset($_GET['accion'])) {
    $accion = strtoupper($_GET['accion']);
    
    if ($accion == 'LIBRE' || $accion == 'OCUPADO') {
        // Guardar estado
        file_put_contents('estado_actual.txt', $accion);
        
        // Ejecutar batch
        $output = shell_exec("enviar_comando.bat $accion");
        
        echo "Comando $accion enviado";
    }
}
?>