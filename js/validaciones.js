document.addEventListener("DOMContentLoaded", function () {
    // Seleccionamos el formulario
    const formulario = document.querySelector("form");

    formulario.addEventListener("submit", function (event) {
        let valido = true; // Variable para comprobrar si el formulario es válido.

        // Capturamos los valores de los campos
        const nombre = document.getElementById("nombre").value.trim();
        const email = document.getElementById("email").value.trim();
        const mensaje = document.getElementById("mensaje").value.trim();

        // Validamos el nombre
        if (nombre.length < 3) {
            alert("El nombre debe tener al menos 3 caracteres.");
            valido = false;
        }

        // Validamos el correo con una expresión regular
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert("Introduce un correo electrónico válido.");
            valido = false;
        }

        // Validamos el mensaje
        if (mensaje.length < 10) {
            alert("El mensaje debe tener al menos 10 caracteres.");
            valido = false;
        }

        // Si alguna validación falla, evitamos que el formulario se envíe
        if (!valido) {
            event.preventDefault();
        }
    });
});








