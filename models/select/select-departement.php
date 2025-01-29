<?php
if (isset($_GET["idModif"])) {
    $id = $_GET["idModif"];
    $getdepart = $connexion->prepare("SELECT * FROM departement WHERE id=?");
    $getdepart->execute([$id]);
    $AfichDepartement = $getdepart->fetch();
    $title = "Modifier departement " . $AfichDepartement['nom_Departement'];
    $btn = "Modifier";
    $action = "../models/updat/update-Departement-post.php?idModif=" . $id;
} else {
    $title = "Ajouter un nouveau département";
    $btn = "Enregistrer";
    $action = "../models/add/add-departement-post.php";
}
$statut=0;
$getData = $connexion->prepare("SELECT * FROM departement WHERE statut=? ORDER BY `departement`.`id` DESC");
$getData->execute([$statut]);
