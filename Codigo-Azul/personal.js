document.querySelector('.alarm-btn').addEventListener('click', function(e) {
    e.preventDefault();
    alert('¡Alerta activada! El personal ha sido notificado.');
});

 document.querySelectorAll("input[type=checkbox]").forEach(checkbox => {
      
      const saved = localStorage.getItem("checkbox-" + checkbox.id);
      if (saved === "true") {
        checkbox.checked = true;
      }

      checkbox.addEventListener("change", () => {
        localStorage.setItem("checkbox-" + checkbox.id, checkbox.checked);
      });
    });