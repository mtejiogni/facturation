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


    // ─────────────────────────────────────────────────────────────
    //  LOADER
    // ─────────────────────────────────────────────────────────────
    const loader = document.querySelector('#loader');
    function animOn()  { 
        loader.classList.add('active'); 
    }
    function animOff() { 
        loader.classList.remove('active'); 
    }

    // ─────────────────────────────────────────────────────────────
    //  TOAST
    // ─────────────────────────────────────────────────────────────
    const toast = document.querySelector('#toast');
    let toastTimer;

    function sendMessage(status, content) {
        clearTimeout(toastTimer);
        toast.textContent = content;
        toast.className   = 'show ' + (status === 'success' ? 'success' : 'error');
        toastTimer = setTimeout(() => { 
            toast.className = ''; 
        }, 5000);
    }







    // Consommation de l'API PHP
    // ==========================
    const API_URL= 'http://localhost/facturation/api/routes.php';



    // Ajouter une facture
    document.querySelector('#form_add').onsubmit= function() {
        animOn();
        const formdata= new FormData(this);
        formdata.append('action', 'create');

        const xhttp= new XMLHttpRequest();
        xhttp.open('POST', API_URL, true);
        xhttp.send(formdata);
        xhttp.onload= function() {
            animOff();
            // On recupere la reponse XML
            const xml= xhttp.responseXML;
            // On recupere la balise racine
            const root= xml?.documentElement;
            console.log(root);
            // On recupere les donnees
            const status= root?.querySelector('status')?.textContent
            const content= root?.querySelector('content')?.textContent
            sendMessage(status, content);
        }
        xhttp.onerror= function() {
            sendMessage('error', 'Impossible de joindre le serveur!!!');
        }

        return false;
    }

});