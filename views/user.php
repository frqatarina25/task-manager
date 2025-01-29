<?php
# Se connecter à la BD
require_once('../connexion/connexion.php');
require_once('../models/select/select-User.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>User</title>
    <?php require_once('style.php'); ?>

</head>

<body>

    <!-- Appel de menues  -->
    <?php require_once('aside.php') ?>

    <main id="main" class="main">
        <div class="row">
            <div class="col-12">
                <h4>Administrateurs</h4>
            </div>
            <!-- pour afficher les massage  -->

            <?php
            if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { ?>
                <div class="col-xl-12 mt-3">
                    <div class="alert-info alert text-center"><?= $_SESSION['msg'] ?></div>
                </div>
            <?php }
            #Cette ligne permet de vider la valeur qui se trouve dans la session message
            unset($_SESSION['msg']);

            if (isset($_GET["NewUser"])) {
            ?>
                <!-- Le form qui enregistrer les données  -->
                <div class="col-xl-12 ">
                    <form action="<?= $action ?>" method="POST" class="shadow p-3">
                        <div class="row">
                            <h4 class="text-center"><?= $title ?></h4>
                            <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                <label for="">Nom <span class="text-danger">*</span></label>
                                <input required autocomplete="off" type="text" name="nom" class="form-control" placeholder="Entrez le nom" <?php if (isset($_GET['idclient'])) { ?>value="<?= $element['nom'] ?>" <?php } ?>>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                <label for="">Postnom <span class="text-danger">*</span></label>
                                <input required autocomplete="off" type="text" name="postnom" class="form-control" placeholder="Entrez le postnom" <?php if (isset($_GET['idclient'])) { ?>value="<?= $element['postnom'] ?>" <?php } ?>>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                <label for="">Prenom <span class="text-danger">*</span></label>
                                <input required autocomplete="off" type="text" name="prenom" class="form-control" placeholder="Entrez le prenom" <?php if (isset($_GET['idclient'])) { ?>value="<?= $element['prenom'] ?>" <?php } ?>>
                            </div>                            
                            <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                <label for="">Adresse <span class="text-danger">*</span></label>
                                <input required autocomplete="off" type="text" name="adress" class="form-control" placeholder="Entrez l'adresse" <?php if (isset($_GET['idclient'])) { ?>value="<?= $element['adresse'] ?>" <?php } ?>>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                <label for="">Telephone <span class="text-danger">*</span></label>
                                <input required autocomplete="off" type="text" name="telephone" class="form-control" placeholder="Entrez le N° Tel" <?php if (isset($_GET['idclient'])) { ?>value="<?= $element['telephone'] ?>" <?php } ?>>
                            </div>
                           
                            <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                <label for="">Département <span class="text-danger">*</span></label>
                                <select required id="" name="fonction" class="form-control select2">
                                    <option value="" desabled>Choisir un département</option>
                                    <option value="">Exemple</option>
                                    <option value="">Exemple</option>
                                </select>
                            </div>                            
                            <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                <label for="">Mot de passe <span class="text-danger">*</span></label>
                                <input required autocomplete="off" type="password" name="telephone" class="form-control" placeholder="Entrez le N° Tel" <?php if (isset($_GET['idclient'])) { ?>value="<?= $element['telephone'] ?>" <?php } ?>>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4  col-sm-6 p-3">
                                <label for="">Photo <span class="text-danger">*</span></label>
                                <input autocomplete="off" value="" name="photo" class="img-fluid" type="file" class="form-control" placeholder="Aucun fichier">
                            </div>

                            <?php if (isset($_GET['idUser'])) {
                            ?>
                                <div class="col-xl-6 col-lg-6 col-md-6 mt-4 col-sm-6 p-3 ">
                                    <input type="submit" name="valider" class="btn btn-dark w-100" value="Modifier">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 mt-4 col-sm-6 p-3 ">
                                    <a href="client.php" class="btn btn-danger w-100">Annuler</a>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">
                                    <input type="submit" name="valider" class="btn btn-dark w-100" value="<?= $btn ?>">
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </form>
                </div>
            <?php
            } else {
            ?>
                <a href="user.php?NewUser" class="btn btn-dark w-100">Nouvel Administrateur</a>
            <?php
            }
            ?>

            <!-- La table qui affiche les données  -->
            <div class="col-xl-12 table-responsive px-3 card mt-4 px-4 pt-3">
                <h6 class="text-center">Listes des Administrateurs</h6>
                <table class="table table-borderless datatable ">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Noms</th>
                            <th>Adresse</th>
                            <th>Telephone</th>
                            <th>Profil</th>
                            <th>Mot de passe</th>                            
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Exemple</td>
                            <td>Exemple</td>
                            <td>Exemple</td>
                            <td>Ex: +243 ...</td>
                            <td>Ex: +243 ...</td>
                            <td>
                                <a href="client.php?idclient=" class="btn btn-dark btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')" href="../models/delete/deleteClient.php?idclient=" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main><!-- End #main -->
    <?php require_once('script.php') ?>

</body>

</html>