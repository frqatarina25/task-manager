<?php
if (isset($_GET["idAgent"])) {
    $id = $_GET["idAgent"];
    $getDataMod = $connexion->prepare("SELECT * FROM agents WHERE id=?");
    $getDataMod->execute([$id]);
    $tab = $getDataMod->fetch();
    $departementModif = $tab['fonction'];
    $title = "Modifier identité de l'agent " . $tab['nom'] . " " . $tab['postnom'];
    $btn = "Modifier";
    $action = "../models/updat/update-Agent-post.php?idAgent=" . $id;
} else {
    $title = "Enregister un nouvel agent";
    $btn = "Enregistrer";
    $action = "../models/add/add-Agent-post.php";
}
# Selection des departement de la DB
$statut = 0;
$getDepartement = $connexion->prepare("SELECT * FROM `departement` WHERE departement.statut=?;");
$getDepartement->execute([$statut]);

# Selection Des données des agents
$getData = $connexion->prepare("SELECT `agents`.*, departement.denomination FROM `agents`, `departement` WHERE agents.fonction=departement.id AND agents.statut=? ORDER BY `agents`.`id` DESC;");
$getData->execute([$statut]);
