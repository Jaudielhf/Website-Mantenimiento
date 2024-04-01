
    // Script para manejar el evento clic en el botón Eliminar
    document.addEventListener('DOMContentLoaded', function () {
        // Seleccionar todos los botones de clase 'eliminar'
        var botonesEliminar = document.querySelectorAll('.eliminar');
        
        // Agregar un evento clic a cada botón Eliminar
        botonesEliminar.forEach(function (boton) {
            boton.addEventListener('click', function () {
                // Obtener el ID del registro a eliminar desde el atributo data-id del botón
                var id = this.getAttribute('data-id');
                
                // Confirmar si el usuario realmente quiere eliminar el registro
                if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                    // Si confirma, enviar una solicitud al servidor para eliminar el registro
                    eliminarRegistro(id);
                }
            });
        });

        // Función para enviar una solicitud al servidor para eliminar el registro
        function eliminarRegistro(id_empleado) {
            // Enviar una solicitud AJAX al servidor para eliminar el registro
            var xhr = new XMLHttpRequest();
            xhr.open('POST', './eliminar_registro.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                // Manejar la respuesta del servidor
                if (xhr.status == 200) {
                    // Recargar la página después de eliminar el registro
                    location.reload();
                } else {
                    // Mostrar un mensaje de error si hay un problema al eliminar el registro
                    alert('Error al eliminar el registro.');
                }
            };
            // Enviar el ID del registro como datos de formulario
            xhr.send('id_empleado=' + id_empleado);
        }


    });

