$(document).ready(function() {
    // Capturamos el formulario
    var form = $('#myForm');

    // Capturamos el div donde se mostrará el mensaje de éxito
    var alertSuccess = $('.alert-success');

    // Capturamos el div donde se mostrará el mensaje de error
    var alertError = $('.alert-danger');

    // Ocultamos los mensajes de éxito y error
    alertSuccess.hide();
    alertError.hide();

    // Validamos los campos del formulario
    function validateForm() {
        var isValid = true;

        // Validamos el campo "Fecha"
        var fecha = $('#fecha').val();
        if (!fecha) {
            $('#fechaError').html('La fecha es requerida');
            isValid = false;
        } else {
            $('#fechaError').html('');
        }

        // Validamos el campo "Humedad"
        var humedad = $('#humedad').val();
        if (!humedad) {
            $('#humedadError').html('La humedad es requerida');
            isValid = false;
        } else if (isNaN(humedad)) {
            $('#humedadError').html('La humedad debe ser un número');
            isValid = false;
        } else {
            $('#humedadError').html('');
        }

        // Validamos el campo "Temperatura"
        var temperatura = $('#temperatura').val();
        if (!temperatura) {
            $('#temperaturaError').html('La temperatura es requerida');
            isValid = false;
        } else if (isNaN(temperatura)) {
            $('#temperaturaError').html('La temperatura debe ser un número');
            isValid = false;
        } else {
            $('#temperaturaError').html('');
        }

        return isValid;
    }

    // Enviamos el formulario mediante AJAX
    form.submit(function(event) {
        event.preventDefault();

        if (!validateForm()) {
            alertError.html('Por favor, corrija los errores en el formulario');
            alertError.show();
            alertSuccess.hide();
        } else {
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function() {
                    alertSuccess.html('Los datos se han enviado correctamente');
                    alertSuccess.show();
                    alertError.hide();
                },
                error: function() {
                    alertError.html('Ha ocurrido un error al enviar los datos');
                    alertError.show();
                    alertSuccess.hide();
                }
            });
        }
    });
});
