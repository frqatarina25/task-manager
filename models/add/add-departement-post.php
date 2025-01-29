<?php
include("../connexion/connexion.php");
if (isset($_POST["valider"])) {
    $depart = htmlspecialchars($_POST["pseudonyme"]);
    $descript = htmlspecialchars($_POST["description"]);
    if (!empty($depart) && !empty($descript)) {
        $req = $connexion->prepare("INSERT INTO `departement`(`nom_Departement`, `denomination`, `statut`) VALUES (?,?,?)");
        $test = $req->execute(array($depart, $descript));
        if ($test == true) {
            $_SESSION['msg'] = "Enregistrement reussi !";
            header("location:../../views/departement.php");
        } else {
            $_SESSION['msg'] = "Enregistrement reussi !";
            header("location:../../views/departement.php");
        }
    }
} else {
    header("location:../../views/departement.php");
}
