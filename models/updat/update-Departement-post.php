<?php
include("../../connexion/connexion.php");
if (isset($_POST["valider"])) {
    if (isset($_GET["idModif"])) {
        $id = $_GET["idModif"];
        $nom_departement = htmlspecialchars($_POST["nom_departement"]);
        $denomination = htmlspecialchars($_POST["denomination"]);
        if (!empty($nom_departement) && !empty($denomination)) {
            $req = $connexion->prepare("UPDATE `departement` SET `nom_Departement`=?,`denomination`=? WHERE id=?");
            $test = $req->execute(array($nom_departement, $denomination,$id));
            if ($test == true) {
                $_SESSION['msg'] = "Modification reussi !";
                header("location:../../views/departement.php");
            } else {
                $_SESSION['msg'] = "Echec de modification !";
                header("location:../../views/departement.php");
            }
        } else {
            $_SESSION['msg'] = "Veillez remplir tous les champs!";
            header("location:../../views/departement.php");
        }
    }
} else {
    header("location:../../views/departement.php");
}
