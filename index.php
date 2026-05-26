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