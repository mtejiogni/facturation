document.addEventListener('DOMContentLoaded', function () {

    // Récupération des blocs et des liens du menu
    const formapp = document.querySelector('#formapp');
    const tableapp = document.querySelector('#tableapp');

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
    //  UTILITAIRES
    // ─────────────────────────────────────────────────────────────
    function setField(name, value) {
        const el = document.querySelector(`[name="${name}"]`);
        if (el) el.value = value;
    }
    
    function clearForm() {
        document.querySelector('#form_add').reset();
        setField('idfacture', '');
        document.querySelector('#valider').value = 'Valider';
    }

    function showSection(target) {
        formapp.style.display  = target === 'form'  ? 'block' : 'none';
        tableapp.style.display = target === 'table' ? 'block' : 'none';
        menuLinks.forEach(l => {
            l.classList.toggle('active', l.dataset.target === target);
        });
    }

    function formatDate(dateStr) {
        if (!dateStr) return '';
        const [y, m, d] = dateStr.split('-');
        return `${d}/${m}/${y}`;
    }


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
            console.log('response data : ', root);
            // On recupere les donnees
            const status= root?.querySelector('status')?.textContent
            const content= root?.querySelector('content')?.textContent
            sendMessage(status, content);

            if (status === 'success') {
                clearForm();
                showSection('table');
                readAll();
            }
        }
        xhttp.onerror= function() {
            animOff();
            sendMessage('error', 'Impossible de joindre le serveur!!!');
        }

        return false;
    }




    // Liste des factures
    function readAll() {
        animOn();
        const formdata= new FormData();
        formdata.append('action', 'readall');

        const xhttp= new XMLHttpRequest();
        xhttp.open('POST', API_URL, true);
        xhttp.send(formdata);
        xhttp.onload= function() {
            animOff();
            // On recupere la reponse XML
            const xml= xhttp.responseXML;
            // On recupere la balise racine
            const root= xml?.documentElement;
            console.log('response data : ', root);
            
            // On recupere les donnees
            const status= root?.querySelector('status')?.textContent ?? '';
            const content= root?.querySelector('content')?.textContent ?? '';
            if (status === 'warning') {
                sendMessage(status, content);
            }

            const factures= Array.from(root?.querySelectorAll('facture') ?? []);
            const tbody= document.querySelector('#tableapp table tbody');
            tbody.innerHTML= '';
            if(factures.length === 0) {
                tbody.innerHTML= `
                    <tr>
                        <td colspan="10" style="text-align:center;padding:20px;color:#888">
                            Aucune facture trouvée
                        </td>
                    </tr>
                `;
            }
            else {
                for(let i= 0; i< factures.length; i++) {
                    let idfacture= parseInt(factures[i].querySelector('idfacture').textContent);
                    let reference= factures[i].querySelector('reference').textContent;
                    let client= factures[i].querySelector('client').textContent;
                    let telephone= factures[i].querySelector('telephone').textContent;
                    let produit= factures[i].querySelector('produit').textContent;
                    let pu= parseFloat(factures[i].querySelector('pu').textContent);
                    let qte= parseInt(factures[i].querySelector('qte').textContent);
                    let montant= pu * qte;
                    let datefacture= formatDate(factures[i].querySelector('datefacture').textContent);

                    const tr= document.createElement('tr');
                    tr.innerHTML= `
                        <td>${i+1}</td>
                        <td>${reference}</td>
                        <td>${client}</td>
                        <td>${telephone}</td>
                        <td>${produit}</td>
                        <td>${pu}</td>
                        <td>${qte}</td>
                        <td>${montant}</td>
                        <td>${datefacture}</td>
                        <td>
                            <a class="btn-edit" href="#">
                                Modifier
                            </a>
                            <a class="btn-delete" href="#">
                                Supprimer
                            </a>
                        </td>
                    `;
                    tbody.appendChild(tr);
                }
            }
        }
        xhttp.onerror= function() {
            animOff();
            sendMessage('error', 'Impossible de joindre le serveur!!!');
        }
    }

    readAll();

});