 // Seleccionamos todos los spans con clase 'libre' o 'ocupado'
document.querySelectorAll("span.libre, span.ocupado").forEach(span => {
  
  // Cargar estado guardado en localStorage
  const saved = localStorage.getItem("span-" + span.id);
  if (saved) {
    span.className = saved; // aplicar la clase guardada
    span.textContent = saved === "libre" ? "Libre" : "Ocupado";
  }

  // Cambiar estado al hacer clic
  span.addEventListener("click", () => {
    if (span.className === "libre") {
      span.className = "ocupado";
      span.textContent = "Ocupado";
    } else {
      span.className = "libre";
      span.textContent = "Libre";
    }
    // Guardar estado en localStorage
    localStorage.setItem("span-" + span.id, span.className);
  });
});

