document.addEventListener('DOMContentLoaded', function () {

    // Récupération des blocs et des liens du menu
    const formapp = document.getElementById('formapp');
    const tableapp = document.getElementById('tableapp');

    const menuLinks = document.querySelectorAll('#menu a');
    const lienAjouter = menuLinks[0];   // "Ajouter une facture"
    const lienListe   = menuLinks[1];   // "Liste des factures"

    // Affiche le tableau et masque le formulaire
    function afficherTableau() {
        tableapp.style.display = 'block';
        formapp.style.display  = 'none';
        lienListe.classList.add('active');
        lienAjouter.classList.remove('active');
    }

    // Affiche le formulaire et masque le tableau
    function afficherFormulaire() {
        formapp.style.display  = 'block';
        tableapp.style.display = 'none';
        lienAjouter.classList.add('active');
        lienListe.classList.remove('active');
    }

    // Par défaut : on affiche le tableau
    afficherTableau();

    // Clic sur "Ajouter une facture" -> formulaire
    lienAjouter.addEventListener('click', function (e) {
        e.preventDefault();
        afficherFormulaire();
    });

    // Clic sur "Liste des factures" -> tableau
    lienListe.addEventListener('click', function (e) {
        e.preventDefault();
        afficherTableau();
    });

});