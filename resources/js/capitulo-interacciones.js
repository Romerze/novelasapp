/**
 * Script para manejar las interacciones de "me gusta" y "guardar" en los capítulos
 */
document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Función para manejar los botones de "me gusta"
    document.querySelectorAll('.btn-like-capitulo').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const form = this.closest('form');
            const url = form.getAttribute('action');
            const iconElement = this.querySelector('i');
            const countElement = this.querySelector('.like-count');
            
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                // Actualizar la clase del botón según el estado
                if (data.liked) {
                    this.classList.remove('bg-gray-100', 'text-gray-700');
                    this.classList.add('bg-red-100', 'text-red-700');
                    iconElement.classList.remove('far');
                    iconElement.classList.add('fas');
                } else {
                    this.classList.remove('bg-red-100', 'text-red-700');
                    this.classList.add('bg-gray-100', 'text-gray-700');
                    iconElement.classList.remove('fas');
                    iconElement.classList.add('far');
                }
                
                // Actualizar el contador de likes
                if (countElement) {
                    countElement.textContent = data.count;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
    
    // Función para manejar los botones de "guardar"
    document.querySelectorAll('.btn-guardar-capitulo').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const form = this.closest('form');
            const url = form.getAttribute('action');
            const iconElement = this.querySelector('i');
            
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                // Actualizar la clase del botón según el estado
                if (data.guardado) {
                    this.classList.remove('bg-gray-100', 'text-gray-700');
                    this.classList.add('bg-blue-100', 'text-blue-700');
                    iconElement.classList.remove('far');
                    iconElement.classList.add('fas');
                } else {
                    this.classList.remove('bg-blue-100', 'text-blue-700');
                    this.classList.add('bg-gray-100', 'text-gray-700');
                    iconElement.classList.remove('fas');
                    iconElement.classList.add('far');
                }
                
                // Mostrar una notificación temporal
                const message = data.guardado ? 'Capítulo guardado correctamente' : 'Capítulo eliminado de guardados';
                showNotification(message);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
    
    // Función para mostrar notificaciones temporales
    function showNotification(message) {
        // Crear el elemento de notificación
        const notification = document.createElement('div');
        notification.classList.add('fixed', 'bottom-4', 'right-4', 'bg-gray-800', 'text-white', 'px-4', 'py-2', 'rounded-lg', 'shadow-lg', 'z-50');
        notification.innerText = message;
        
        // Añadir al DOM
        document.body.appendChild(notification);
        
        // Eliminar después de 3 segundos
        setTimeout(() => {
            notification.classList.add('opacity-0', 'transition-opacity', 'duration-500');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 500);
        }, 3000);
    }
});
