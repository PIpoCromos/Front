<?php
class ArduinoSerial {
    private $puerto;
    private $baudios;
    
    public function __construct($puerto = 'COM3', $baudios = 9600) {
        $this->puerto = $puerto;
        $this->baudios = $baudios;
    }
    
    public function enviarComando($comando) {
        // En sistemas Windows
        $comandoCompleto = "echo " . escapeshellarg($comando) . " > " . $this->puerto;
        
        // En sistemas Linux (descomenta la línea siguiente y comenta la anterior)
        // $comandoCompleto = "echo " . escapeshellarg($comando) . " > /dev/ttyUSB0";
        
        shell_exec($comandoCompleto);
        usleep(100000); // Esperar 100ms para que Arduino procese
    }
    
    public function leerEstado() {
        // Este método es más complejo y puede requerir librerías específicas
        // Para simplificar, usaremos el estado guardado en la base de datos
        return null;
    }
}

// Uso del script
if (isset($_GET['accion'])) {
    $arduino = new ArduinoSerial('COM3', 9600); // Cambia COM3 por tu puerto
    
    switch ($_GET['accion']) {
        case 'ocupado':
            $arduino->enviarComando("OCUPADO");
            echo "Estado cambiado a OCUPADO";
            break;
        case 'libre':
            $arduino->enviarComando("LIBRE");
            echo "Estado cambiado a LIBRE";
            break;
        case 'estado':
            $arduino->enviarComando("ESTADO");
            echo "Solicitado estado actual";
            break;
    }
}
?>