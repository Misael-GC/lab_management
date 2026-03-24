document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('status') === 'success') {
            Swal.fire({
                icon: 'success',
                title: '¡Completado!',
                text: 'El cliente ha sido registrado exitosamente.',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
            //  para que no se repita el alert al recargar
            window.history.replaceState({}, document.title, "/clients");
        }
    });