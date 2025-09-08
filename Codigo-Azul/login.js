

function login () {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    if (email && password ===   "1234") {
        window.location.href = "main.html";
    } else {
        alert ("Correo o contraseña incorrectos");
    }
}
