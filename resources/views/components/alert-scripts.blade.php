<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Función para confirmar eliminación
    function confirmarEliminacion(formElement, tieneRelaciones = false) {
        Swal.fire({
            title: '¿Estás seguro?',
            html: tieneRelaciones 
                ? '<div class="text-left"><p class="text-red-600 font-bold">⚠️ Advertencia:</p><p>Esta sala tiene funciones programadas.</p><p>Se recomienda no eliminar salas con funciones asociadas ya que podría afectar a:</p><ul class="list-disc pl-5"><li>Reservas existentes</li><li>Historial de ventas</li><li>Programación de funciones</li></ul><p class="mt-2">Considera reasignar o cancelar las funciones antes de eliminar la sala.</p></div>'
                : '¿Deseas eliminar esta sala?',
            icon: tieneRelaciones ? 'warning' : 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: tieneRelaciones ? 'Sí, eliminar de todas formas' : 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            width: tieneRelaciones ? '500px' : '400px'
        }).then((result) => {
            if (result.isConfirmed) {
                formElement.submit();
            }
        });
    }
</script>