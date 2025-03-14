document.addEventListener("DOMContentLoaded", function () {
    // Seleccionamos el formulario
    const formulario = document.querySelector("form");

    formulario.addEventListener("submit", function (event) {
        let valido = true; // Variable para comprobrar si el formulario es válido.

        // Capturamos los valores de los campos
        const nombre = document.getElementById("nombre").value.trim();
        const email = document.getElementById("email").value.trim();
        const mensaje = document.getElementById("mensaje").value.trim();
        const captcha = grecaptcha.getResponse();

        const errorNombre = document.getElementById("error-nombre");
        const errorEmail = document.getElementById("error-email");
        const errorMensaje = document.getElementById("error-mensaje");
        const errorCaptcha = document.getElementById("error-captcha");

        //Reiniciar mensaje de error
        errorNombre.textContent = "";
        errorEmail.textContent = "";
        errorMensaje.textContent = "";
        errorCaptcha.textContent = "";

        // Validamos el nombre
        if (nombre.length < 3) {
            errorNombre.textContent = "El nombre debe tener al menos 3 caracteres.";
            valido = false;
        }

        // Validamos el correo con una expresión regular
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            errorEmail.textContent = "Introduce un correo electrónico válido.";
            valido = false;
        }

        // Validamos el mensaje
        if (mensaje.length < 10) {
            errorMensaje.textContent = "El mensaje debe tener al menos 10 caracteres.";
            valido = false;
        }

        // Validamos reCAPTCHA
        if (captcha.length === 0) {
            errorCaptcha.textContent = "Por favor, verifica que no eres un robot.";
            valido = false;
        } else {
            //Agregar el captcha como un campo oculto en el formulario
            let inputCaptcha = document.getElementById("captcha_valido");
            if (!inputCaptcha) {
                inputCaptcha = document.createElement("input");
                inputCaptcha.type = "hidden";
                inputCaptcha.name = "captcha_valido";
                inputCaptcha.id = "captcha_valido";
                formulario.appendChild(inputCaptcha);
            }
            inputCaptcha.value = captcha;
        }

        // Si alguna validación falla, evitamos que el formulario se envíe
        if (!valido) {
            event.preventDefault();
        }
    });
});








