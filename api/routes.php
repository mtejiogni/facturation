<?php
require_once 'header.php';
require_once 'Database.php';

$db= new Database();
$pdo= $db->getConnexion();
$method= $_SERVER['REQUEST_METHOD'];
$action= $_REQUEST['action'] ?? '';




// Lire une information
if($action == 'read') {
    $idfacture= $_REQUEST['idfacture'] ?? 0;
    if($idfacture == 0) {
        echo Database::getMessageXML('Error', 'ID invalide ou manquant');
        exit();
    }

    $req= $pdo->prepare("select * from facture where idfacture=?");
    $req->execute([$idfacture]);
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $facture= $req->fetch();

    if($facture != false) {
        echo Database::getDataXML('facture', $facture);
    }
    else {
        echo Database::getMessageXML('Error', 'Facture introuvable');
    }
}





// Lire plusieurs informations
if($action == 'readall') {
    $req= $pdo->prepare("select * from facture order by datefacture desc");
    $req->execute();
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $factures= $req->fetchAll();

    if(empty($factures) == true) {
        echo Database::getMessageXML('success', 'Aucune facture trouvée');
    }
    else {
        echo Database::getAllDatasXML('facture', $factures);
    }
}




// Ajouter
if($action == 'create') {
    $reference= $_REQUEST['reference'];
    $client= $_REQUEST['client'];
    $telehone= $_REQUEST['telephone'];
    $produit= $_REQUEST['produit'];
    $pu= $_REQUEST['pu'];
    $qte= $_REQUEST['qte'];
    $datefacture= $_REQUEST['datefacture'];

    $req= $pdo->prepare("insert into facture (reference, client, telephone, produit, pu, qte, datefacture) values (?, ?, ?, ?, ?, ?, ?)");
    $req->execute([$reference, $client, $telehone, $produit, $pu, $qte, $datefacture]);
    echo Database::getMessageXML("success", "Facture #$reference a été ajoutée avec succès");
}



// Modifier
if($action == 'update') {
    $idfacture= $_REQUEST['idfacture'];
    $client= $_REQUEST['client'];
    $telehone= $_REQUEST['telephone'];
    $produit= $_REQUEST['produit'];
    $pu= $_REQUEST['pu'];
    $qte= $_REQUEST['qte'];
    $datefacture= $_REQUEST['datefacture'];

    $req= $pdo->prepare("update facture set client= ?, telephone= ?, produit= ?, pu= ?, qte= ?, datefacture= ? where idfacture= ?");
    $req->execute([$client, $telehone, $produit, $pu, $qte, $datefacture, $idfacture]);
    echo Database::getMessageXML("success", "La facture a été modifiée avec succès");
}




// Supprimer
if($action == 'delete') {
    $idfacture= $_REQUEST['idfacture'] ?? 0;
    if($idfacture == 0) {
        echo Database::getMessageXML('Error', 'ID invalide ou manquant');
        exit();
    }

    $req= $pdo->prepare("delete from facture where idfacture= ?");
    $req->execute([$idfacture]);
    echo Database::getMessageXML("success", "La facture a été supprimée avec succès");
}

?>