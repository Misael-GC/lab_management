 const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');

    if (status === 'password_success') {
        Swal.fire({ icon: 'success', title: 'Updated!', text: 'Password changed successfully.', timer: 3000 });
    } else if (status === 'invalid_current') {
        Swal.fire({ icon: 'error', title: 'Denied', text: 'Current password is incorrect.' });
    } else if (status === 'password_mismatch') {
        Swal.fire({ icon: 'warning', title: 'Mismatch', text: 'New passwords do not match.' });
    }