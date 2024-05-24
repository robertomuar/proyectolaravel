/* document.querySelectorAll('.btn-eliminar').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('confirmacion-overlay').style.display = 'block';
        const id = this.dataset.id;
        const confirmarEliminarBtn = document.getElementById('confirmar-eliminar');
        const cancelarEliminarBtn = document.getElementById('cancelar-eliminar');
        
        confirmarEliminarBtn.addEventListener('click', function() {
            // Redirigir al usuario a la ruta de eliminar
            window.location.href = '/socios/' + id;
        });

        cancelarEliminarBtn.addEventListener('click', function() {
            document.getElementById('confirmacion-overlay').style.display = 'none';
        });
    });
});
 */