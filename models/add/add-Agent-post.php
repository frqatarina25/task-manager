<?php
#inclusion de la page de connexion
include('../../connexion/connexion.php');
require_once('../../fonctions/fonctions.php');
// creation de l'evenement sur le bouton valider
if (isset($_POST['valider'])) {
  $nom = htmlspecialchars($_POST['nom']);
  $postnom = htmlspecialchars($_POST['postnom']);
  $prenom = htmlspecialchars($_POST['prenom']);
  $genre = htmlspecialchars($_POST['genre']);
  $adresse = htmlspecialchars($_POST['adresse']);
  $telephoneParent = htmlspecialchars($_POST['telephoneParent']);
  $telephone = htmlspecialchars($_POST['telephone']);
  $Fonction = htmlspecialchars($_POST['fonction']);
  $pwd = htmlspecialchars($_POST['pwd']);
  $statut = 0;
  $fichier_tmp = $_FILES['picture']['tmp_name'];
  $nom_original = $_FILES['picture']['name'];
  $destination = "../../assets/img/profiles/";
  // fonction permettant de recuperer la photo
  $newimage = RecuperPhoto($fichier_tmp, $nom_original, $destination);
  /**
   *  “Here, we have hashed the password. So, for a new user, you first need to create a file that will allow you to hash the password in order to log in. Please create this file outside of this ‘Eka_task_manager’ project.”
   * for example
   * $pwd=1234;
   * $hash = password_hash($pwd, PASSWORD_DEFAULT);
   * print $hash;
   */

  // password hashing
  $passwordh = $pwd;
  $passwordhacher = password_hash($passwordh, PASSWORD_DEFAULT);

  if (is_numeric($telephone)) {
    #verifier si l'utilisateur existe ou pas dans la bd
    $getUserDeplicant = $connexion->prepare("SELECT * FROM `agents` WHERE telephone=? AND statut=?");
    $getUserDeplicant->execute([$telephone, $statut]);
    $tab = $getUserDeplicant->fetch();
    if ($tab > 0) {
      $_SESSION['msg'] = "Cet Agent existe deja dans a BD!";
      header("location:../../views/agent.php");
    } else {
      # verify pwd vadity
      if ($pwd != "") {
        # Insertion data from database
        $req = $connexion->prepare("INSERT INTO `agents`(`nom`, `postnom`, `prenom`, `genre`, `telephone`, `adresse`, `fonction`, `telephoneReferant`, `pwd`, `profil`, `statut`) VALUES  (?,?,?,?,?,?,?,?,?,?,?)");
        $resultat = $req->execute([$nom, $postnom, $prenom, $genre, $telephone, $adresse, $Fonction, $telephoneParent,  $pwd, $newimage, $statut]);
        if ($resultat == true) {
          $_SESSION['msg'] = "Enregistrement reussi !";
          header("location:../../views/agent.php");
        } else {
          $_SESSION['msg'] = "Echec d'enregistrement !";
          header("location:../../views/agent.php");
        }
      } else {
        $_SESSION['msg'] = "Ajouter les modifications";
        header("location:../../views/agent.php");
      }
    }
  } else {
    $_SESSION['msg'] = "Le numero de téléphone ne doit containir des lettres !";
    header("location:../../views/agent.php");
  }
} else {
  header("location:../../views/agent.php");
}
