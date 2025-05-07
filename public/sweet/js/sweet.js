function advertencia(e) {
    e.preventDefault();
    var url = e.currentTarget.getAttribute("href");

    Swal.fire({
        title: '¿Está seguro?',
        text: '¡No podrá recuperar este registro!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2CB073',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'No, salir',
        reverseButtons: true,
        padding: '20px',
        backdrop: true,
        position: 'top',
        allowOutsideClick: true,
        allowEscapeKey: true,
        allowEnterKey: false,
    }).then((result) => {
        if (result.isConfirmed) {
            // ✅ Redirige correctamente
            window.location.href = url;
        }
    });
}
