document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');

        if (status === 'error') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo crear el cliente. Inténtalo más tarde.',
                confirmButtonColor: '#0d6efd'
            });
        } else if (status === 'empty') {
            Swal.fire({
                icon: 'warning',
                title: 'Campos incompletos',
                text: 'Por favor, rellena los campos obligatorios.',
                confirmButtonColor: '#0d6efd'
            });
        }
    });