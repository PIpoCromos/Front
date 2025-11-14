// Estado global
let estadoGlobal = 'libre';

// Función para enviar comando a Arduino
function controlarArduino(estado) {
    const accion = estado === 'libre' ? 'LIBRE' : 'OCUPADO';
    
    console.log('Enviando comando:', accion);
    
    fetch(`control_arduino.php?accion=${accion}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            console.log('Respuesta Arduino:', data);
            if (data.success) {
                estadoGlobal = estado;
                actualizarInterfaz();
                alert(`Estado cambiado a: ${accion}`);
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error de conexión: ' + error.message);
        });
}

// Función para leer estado actual
function leerEstadoArduino() {
    fetch('leer_estado.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                estadoGlobal = data.estado.toLowerCase();
                actualizarInterfaz();
            }
        })
        .catch(error => console.error('Error leyendo estado:', error));
}

// Actualizar interfaz según estado global
function actualizarInterfaz() {
    document.querySelectorAll("span.libre, span.ocupado").forEach(span => {
        if (estadoGlobal === 'ocupado') {
            span.className = "ocupado";
            span.textContent = "Ocupado";
        } else {
            span.className = "libre";
            span.textContent = "Libre";
        }
        // Guardar en localStorage
        localStorage.setItem("span-" + span.id, span.className);
    });
}

// Configurar eventos
document.querySelectorAll("span.libre, span.ocupado").forEach(span => {
    // Cargar estado guardado
    const saved = localStorage.getItem("span-" + span.id);
    if (saved) {
        span.className = saved;
        span.textContent = saved === "libre" ? "Libre" : "Ocupado";
        estadoGlobal = saved;
    }

    // Al hacer clic
    span.addEventListener("click", () => {
        const nuevoEstado = span.className === "libre" ? "ocupado" : "libre";
        controlarArduino(nuevoEstado);
    });
});

// Leer estado al cargar y cada 5 segundos
document.addEventListener('DOMContentLoaded', function() {
    console.log('Página cargada - iniciando sistema Arduino');
    leerEstadoArduino();
    setInterval(leerEstadoArduino, 5000);
});