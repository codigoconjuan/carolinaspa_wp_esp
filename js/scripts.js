$ = jQuery.noConflict();

$(document).ready(function() {
    var formulario = $('#formulario-contacto');
    
    
    formulario.on('submit', function(event) {
        event.preventDefault();
        
        var errores = [];
        // Validar el nombre
        var nombre = $('#nombre').val();
        var campoNombre = $('#nombre');
        var divNombre = campoNombre.parent();
        if(nombre.length > 4 ) {
            campoNombre.addClass('form-control-success').removeClass('form-control-danger');
            divNombre.addClass('has-success').removeClass('has-danger').find('small').html('');
        } else {
            campoNombre.addClass('form-control-danger').removeClass('form-control-success');
            divNombre.addClass('has-danger').removeClass('has-success').find('small').html('El nombre debe ser más largo');
            errores.push("1");
        }
        
        // Validar el email
        var email = $('#email').val();
        var campoEmail = $('#email');
        var divEmail = campoEmail.parent();
        if(email.length > 4 ) {
            campoEmail.addClass('form-control-success').removeClass('form-control-danger');
            divEmail.addClass('has-success').removeClass('has-danger');
        } else {
            campoEmail.addClass('form-control-danger').removeClass('form-control-success');
            divEmail.addClass('has-danger').removeClass('has-success').find('small').html('El Correo debe ser válido');
            errores.push("2");
        }
        
        // Validar el email
        var mensaje = $('#mensaje').val();
        var campoMensaje = $('#mensaje');
        var divMensaje = campoMensaje.parent();
        if(mensaje.length > 4 ) {
            campoMensaje.addClass('form-control-success').removeClass('form-control-danger');
            divMensaje.addClass('has-success').removeClass('has-danger');
        } else {
            campoMensaje.addClass('form-control-danger').removeClass('form-control-success');
            divMensaje.addClass('has-danger').removeClass('has-success').find('small').html('El Mensaje no debe ir vacio');
            errores.push("3");
        }
        
        if(errores.length > 0) {
            alert("Hay errores en el formulario");
        } else {
            $.ajax({
                type: formulario.attr('method'),
                url: formulario.attr('action'),
                data: formulario.serialize()
            }).done(function(data) {
                var resultado = data;
                console.log(resultado);
                var respuesta = JSON.parse(resultado);
                console.log(respuesta);
                console.log(respuesta.mensaje);
                $('#resultado').html(respuesta.mensaje).fadeIn();
            });
        }
        
        
    });
});

