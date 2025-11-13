// Estado inicial
let estadoArduino = "libre";

// Función para actualizar estado en Arduino
function actualizarEstadoArduino(nuevoEstado) {
    fetch(`serial_handler.php?accion=${nuevoEstado}`)
        .then(response => response.text())
        .then(data => {
            console.log('Arduino:', data);
        })
        .catch(error => {
            console.error('Error comunicándose con Arduino:', error);
        });
}

// Función para sincronizar estado
function sincronizarEstado() {
    fetch('serial_handler.php?accion=estado')
        .then(response => response.text())
        .then(data => {
            console.log('Estado Arduino:', data);
        })
        .catch(error => {
            console.error('Error sincronizando estado:', error);
        });
}

// Seleccionamos todos los spans con clase 'libre' o 'ocupado'
document.querySelectorAll("span.libre, span.ocupado").forEach(span => {
  
    // Cargar estado guardado en localStorage
    const saved = localStorage.getItem("span-" + span.id);
    if (saved) {
        span.className = saved;
        span.textContent = saved === "libre" ? "Libre" : "Ocupado";
    }

    // Cambiar estado al hacer clic
    span.addEventListener("click", () => {
        if (span.className === "libre") {
            span.className = "ocupado";
            span.textContent = "Ocupado";
            // Enviar comando a Arduino
            actualizarEstadoArduino('ocupado');
        } else {
            span.className = "libre";
            span.textContent = "Libre";
            // Enviar comando a Arduino
            actualizarEstadoArduino('libre');
        }
        // Guardar estado en localStorage
        localStorage.setItem("span-" + span.id, span.className);
    });
});

// Sincronizar estado al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    sincronizarEstado();
    
    // Sincronizar cada 30 segundos
    setInterval(sincronizarEstado, 30000);
});