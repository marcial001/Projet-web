document.addEventListener('DOMContentLoaded', function () {
    // Recherche en temps réel
    const searchInput = document.getElementById('searchInput');
    const employeeTable = document.getElementById('employeeTable');

    searchInput.addEventListener('input', function () {
        const searchTerm = this.value.toLowerCase();
        const rows = employeeTable.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            let text = rows[i].textContent.toLowerCase();
            rows[i].style.display = text.includes(searchTerm) ? '' : 'none';
        }
    });

    // Remplir les modals avec les données
    const modals = {
        'viewModal': ['nom', 'prenom', 'email', 'position', 'chef'],
        'editModal': ['editNom', 'editPrenom', 'editEmail', 'editPosition', 'editChef']
    };

    document.querySelectorAll('[data-bs-target]').forEach(button => {
        button.addEventListener('click', function () {
            const modalId = this.getAttribute('data-bs-target');
            const employeeId = this.getAttribute('data-id');
            const row = document.querySelector(`#employeeTable tr:nth-child(${employeeId})`);
            const cells = row.getElementsByTagName('td');

            if (modalId === '#deleteModal') return;

            const fields = modals[modalId.replace('#', '')];
            fields.forEach((field, index) => {
                const input = document.getElementById(field);
                if (input) input.value = cells[index + 1].textContent;
            });
        });
    });

    // Sauvegarder les modifications
    document.getElementById('saveEdit').addEventListener('click', function () {
        const modal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
        modal.hide();
        alert('Modifications enregistrées avec succès !'); // Remplacez par une logique serveur si nécessaire
    });

    // Confirmer la suppression
    document.getElementById('confirmDelete').addEventListener('click', function () {
        const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
        modal.hide();
        alert('Employé supprimé avec succès !'); // Remplacez par une logique serveur si nécessaire
    });
});

  document.querySelectorAll('.input-group-text').forEach(function (span) {
            span.addEventListener('click', function () {
                let input = span.parentElement.querySelector('input, select');
                if (input) input.focus();
            });
        });