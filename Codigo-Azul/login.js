document.getElementById("loginBtn").addEventListener("click", function() {
      const email = document.getElementById("email").value.trim();
      const password = document.getElementById("password").value.trim();

      if (email && password === "1234") {
        window.location.href = "main.html";
      } else {
        alert("Correo o contraseña incorrectos");
      }
    });
