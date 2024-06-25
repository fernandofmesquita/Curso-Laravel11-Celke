// Receber o seletor apagar e percorrer e lista de registro
document.querySelectorAll('.btnDelete').forEach(function (button) {

    // Aguardar o clique do usuário no botão apagar
    button.addEventListener('click', function (event) {

        // Bloquear o recarregamento da página
        event.preventDefault();

        // Receber o atributo que possui o id do registro que deve ser excluído
        var deleteId = this.getAttribute('data-delete-id');

        // SweetAlert
        Swal.fire({
            title: 'Tem certeza?',
            text: 'Você não poderá reverter isso!',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#0d6efd',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Sim, excluir!',
        }).then((result) => {

            // Carregar a página responsável em excluír se o usuário confirmar a exclusão
            if (result.isConfirmed) {
                document.getElementById(`formExcluir${deleteId}`).submit();
            }
        });

    });

});