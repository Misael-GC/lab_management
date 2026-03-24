function confirmClearData() {
    Swal.fire({
        title: 'Are you absolutely sure?',
        text: "This will TRUNCATE all sample data. We strongly advise you to export the data first!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6e7881',
        confirmButtonText: 'Yes, clear all!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Creamos un formulario dinámico para enviar el POST de borrado
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/users/clear-samples';
            document.body.appendChild(form);
            form.submit();
        }
    });
}

// Manejo de respuestas del servidor
const params = new URLSearchParams(window.location.search);
if(params.get('status') === 'cleared') {
    Swal.fire('Deleted!', 'All samples have been removed.', 'success');
} else if(params.get('status') === 'imported') {
    Swal.fire('Imported!', 'Data has been loaded successfully.', 'success');
}