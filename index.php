<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des factures</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <div id="logo">
                Facturation
            </div>

            <div id="menu">
                <a href="#">Ajouter une facture</a>
                <a href="#">Liste des factures</a>
            </div>
        </div>
    </header>



    <main>
        <div class="container">
            <div id="formapp">
                <h1>Ajouter une facture</h1>
                <hr />
                <form name="form_add" metod="POST" action="#">
                    <p class="field">
                        <label for="client">Client <span class="required">*</span></label>
                        <br />
                        <input type="text" name="client" id="client" placeholder="Entrez le nom du client..." required />
                        <div class="msg_error">
                            Nom du client invalide
                        </div>
                    </p>

                    <p class="field">
                        <label for="telephone">Téléphone <span class="required">*</span></label>
                        <br />
                        <input type="tel" name="telephone" id="telephone" placeholder="Ex: 693909121" required />
                        <div class="msg_error">
                            Numéro de téléphone invalide
                        </div>
                    </p>

                    <p class="field">
                        <label for="produit">Sélectionnez le produit <span class="required">*</span></label>
                        <br />
                        <select name="produit" id="produit">
                            <option value="Clé USB" seelcted>Clé USB</option>
                            <option value="Clavier USB">Clavier USB</option>
                            <option value="Souris USB">Souris USB</option>
                            <option value="PC HP proliant">PC HP proliant</option>
                        </select>
                    </p>

                    <p class="field">
                        <label for="pu">Prix Unitaire (FCFA) <span class="required">*</span></label>
                        <br />
                        <input type="number" name="pu" id="pu" value="1000" min="1000" required />
                        <div class="msg_error">
                            Prix unitaire invalide
                        </div>
                    </p>

                    <p class="field">
                        <label for="qte">Quantité <span class="required">*</span></label>
                        <br />
                        <input type="number" name="qte" id="qte" value="1" min="1" required />
                        <div class="msg_error">
                            Quantité invalide
                        </div>
                    </p>

                    <p class="field">
                        <label for="datefacture">Date <span class="required">*</span></label>
                        <br />
                        <input type="date" name="datefacture" id="facture" placeholder="JJ/MM/AAAA" min="2026-01-01" required />
                        <div class="msg_error">
                            Date de facturation invalide
                        </div>
                    </p>

                    <p class="submit">
                        <input type="reset" name="annuler" id="annuler" value="Annuler" />
                        <input type="submit" name="valider" id="valider" value="Valider" />
                    </p>
                </form>
            </div>



            
            <div id="tableapp">
                <h1>Liste des factures</h1>
                <hr />
                <table border="1" cellspacing="0" cellpadding="4">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>REF</th>
                            <th>CLIENT</th>
                            <th>TELEPHONE</th>
                            <th>PRODUIT</th>
                            <th>PU (FCFA)</th>
                            <th>QTE</th>
                            <th>MONTANT (FCFA)</th>
                            <th>DATE</th>
                            <th>OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>#INSAM23</td>
                            <td>TOTO</td>
                            <td>693909121</td>
                            <td>CLE USB</td>
                            <td>2000</td>
                            <td>2</td>
                            <td>4000</td>
                            <td>26/05/2026</td>
                            <td>
                                <a href="#">Modifier</a>
                                <a href="#">Supprimer</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>



    <footer>
        <div class="container">
            <div class="social">
                <a href="#">Facebook</a>
                <a href="#">Twitter</a>
                <a href="#">Instagram</a>
            </div>

            <div class="copyright">
                &copy; Copyright 2026 | IUEs/INSAM
            </div>
        </div>
    </footer>

    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>