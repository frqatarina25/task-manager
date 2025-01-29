<?php
# Se connecter à la BD
require_once('../connexion/connexion-Temp.php');
# Selection Querries
require_once("../models/select/select-Sortie.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Finances</title>
    <?php require_once('style.php'); ?>

</head>

<body>

    <!-- Appel de menues  -->
    <?php require_once('aside.php') ?>

    <main id="main" class="main">
        <div class="row">
            <div class="col-12">
                <h4>Sorties en caisse</h4>
            </div>
        </div>
        <?php
        # Confirmation de la suppression
        if (isset($_GET['SupTer'])) {
            $id = $_GET["SupTer"];
        ?>
            <div class="col-xl-12 px-3 card mt-4 px-4 pt-3">
                <h3 class="bi bi-shield-exclamation text-danger text-center"> Zone Dangereuse</h3> <br>
                <p class="text-center">
                    Voule-Vous vraiment supprimer ce terrain ?? c'est dangereux ! <br>
                    Cette action est irreverssible, Assurez-vous que c'est l'action que vous souhaiter
                    réaliser ! Elle permet de supprimer un Terain de la base de données et toutes les données liées à ce terrain .
                </p>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                        <a href="terrain.php" class="btn btn-dark  w-100"> Annler</a>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                        <a href="../models/delete/delete-terrain.php?SupTer=<?= $id ?>" class="btn btn-danger bi bi-trash w-100"> Supprimer un partenaire</a>
                    </div>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="row">
                <!-- pour afficher les massage  -->
                <?php
                if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { ?>
                    <div class="col-xl-12 mt-3">
                        <div class="alert-info alert text-center"><?= $_SESSION['msg'] ?></div>
                    </div>
                <?php }
                #Cette ligne permet de vider la valeur qui se trouve dans la session message
                unset($_SESSION['msg']);

                if (isset($_GET["dollar"])) {
                ?>
                    <!-- Le form qui enregistrer les Sorties en dollard  -->
                    <div class="col-xl-12 ">
                        <form action="<?= $action ?>" method="POST" class="shadow p-3">
                            <div class="row">
                                <h4 class="text-center"><?= $title ?></h4>
                                <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                    <label for="">Libelle <span class="text-danger">*</span></label>
                                    <input required autocomplete="off" type="text" name="libelle" class="form-control" placeholder="Entrez la déscription" <?php if (isset($_GET['idTerrain'])) { ?>value="<?= $terMod['description'] ?>" <?php } ?>>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                    <label for="">Montant <span class="text-danger">*</span></label>
                                    <input required autocomplete="off" type="text" name="montant" class="form-control" placeholder="EX: 5000" <?php if (isset($_GET['idTerrain'])) { ?>value="<?= $terMod['lieu'] ?>" <?php } ?>>
                                </div>

                                <?php if (isset($_GET['idTerrain'])) {
                                ?>
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 mt-4 col-sm-6 p-3 ">
                                            <input type="submit" name="valider" class="btn btn-dark w-100" value="Modifier">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 mt-4 col-sm-6 p-3 ">
                                            <a href="client.php" class="btn btn-danger w-100">Annuler</a>
                                        </div>
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
                    <!-- La table qui affiche les sorties en dollard  -->
                    <div class="col-xl-12 table-responsive px-3 card mt-4 px-4 pt-3">
                        <h6 class="text-center">Listes des Sorties en Dollars</h6>
                        <table class="table table-borderless datatable ">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Montant</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $num = 0;
                                while ($SortieDolar = $getSortieDolar->fetch()) {
                                    $num = $num + 1 ?>
                                    <tr>
                                        <th scope="row"><?= $num ?></th>
                                        <td><?= $SortieDolar["date"] ?></td>
                                        <td><?= $SortieDolar["libelle"] ?></td>
                                        <td><?= $SortieDolar["montant"] . " " . "$" ?></td>
                                        <td>
                                            <a href="entree.php?dollar&idEntree=<?= $SortieDolar["id"] ?>" class="btn btn-dark btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="entree.php?SupTer=<?= $SortieDolar["id"] ?>" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash3-fill"></i>
                                            </a>
                                        </td>
                                    </tr>
                            </tbody>
                        <?php
                                }
                        ?>
                        </table>
                    </div>
                <?php
                } elseif (isset($_GET["Franc"])) {
                ?>
                    <!-- Le form qui enregistrer les sorties en franc  -->
                    <div class="col-xl-12 ">
                        <form action="<?= $action ?>" method="POST" class="shadow p-3">
                            <div class="row">
                                <h4 class="text-center"><?= $title ?></h4>
                                <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                    <label for="">Libelle <span class="text-danger">*</span></label>
                                    <input required autocomplete="off" type="text" name="libelle" class="form-control" placeholder="Entrez la déscription du mouvement" <?php if (isset($_GET['idTerrain'])) { ?>value="<?= $terMod['description'] ?>" <?php } ?>>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                    <label for="">Montant <span class="text-danger">*</span></label>
                                    <input required autocomplete="off" type="text" name="montant" class="form-control" placeholder="EX: 1000" <?php if (isset($_GET['idTerrain'])) { ?>value="<?= $terMod['lieu'] ?>" <?php } ?>>
                                </div>

                                <?php if (isset($_GET['idTerrain'])) {
                                ?>
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 mt-4 col-sm-6 p-3 ">
                                            <input type="submit" name="valider" class="btn btn-dark w-100" value="Modifier">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 mt-4 col-sm-6 p-3 ">
                                            <a href="client.php" class="btn btn-danger w-100">Annuler</a>
                                        </div>
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
                    <!-- La table qui affiche les sorties en Franc -->
                    <div class="col-xl-12 table-responsive px-3 card mt-4 px-4 pt-3">
                        <h6 class="text-center">Listes des sortie en Francs</h6>
                        <table class="table table-borderless datatable ">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Montant</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $num = 0;
                                while ($SortieFranc = $getSortieFranc->fetch()) {
                                    $num = $num + 1 ?>
                                    <tr>
                                        <th scope="row"><?= $num ?></th>
                                        <td><?= $SortieFranc["date"] ?></td>
                                        <td><?= $SortieFranc["libelle"] ?></td>
                                        <td><?= $SortieFranc["montant"] . " " . "Fc" ?></td>
                                        <td>
                                            <a href="entree.php?dollar&idEntree=<?= $SortieFranc["id"] ?>" class="btn btn-dark btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="entree.php?SupTer=<?= $SortieFranc["id"] ?>" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash3-fill"></i>
                                            </a>
                                        </td>
                                    </tr>
                            </tbody>
                        <?php
                                }
                        ?>
                        </table>
                    </div>
                <?php
                } else {
                ?>
                    <div class="col-lg-12">
                        <!-- Carte du choix de la devise -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">Vous devez choisir une dévise !</h5>
                                <h6 class="card-subtitle mb-2 text-muted text-center">Entrée en '$' / 'Fc'</h6>
                                <p class="card-text text-center">
                                    Pour Enregister un mouvement de caisse vous devez choisir avant la devise
                                    pour permettre au système de déterminer le solde exacte.
                                </p>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="card-text">
                                            <a href="sortie.php?dollar" class="btn btn-dark btn-sm w-100">Dollars / "$"</a>
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="card-text">
                                            <a href="sortie.php?Franc" class="btn btn-dark btn-sm w-100">Francs / "Fc"</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Carte du choix de la devise -->
                    </div>
                    <!-- La table qui affiche toutes les sorties  -->
                    <div class="col-xl-12 table-responsive px-3 card mt-4 px-4 pt-3">
                        <h5 class="text-center">Listes des Entrées</h5>
                        <table class="table table-borderless datatable ">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Montant</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $num = 0;
                                while ($Sortie = $getSortie->fetch()) {
                                    $num = $num + 1;
                                    $getDevise = "";
                                    $getDevise = $Sortie["devise"];
                                    if ($getDevise == "Dollard") {
                                        $EntreeDevise = "$";
                                    } else {
                                        $EntreeDevise = "Fc";
                                    }
                                ?>
                                    <tr>
                                        <th scope="row"><?= $num ?></th>
                                        <td><?= $Sortie["date"] ?></td>
                                        <td><?= $Sortie["libelle"] ?></td>
                                        <td><?= $Sortie["montant"] . "" . $EntreeDevise ?></td>
                                        <td>
                                            <a href="entree.php?dollar&idEntree=<?= $Sortie["id"] ?>" class="btn btn-dark btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="entree.php?SupTer=<?= $Sortie["id"] ?>" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash3-fill"></i>
                                            </a>
                                        </td>
                                    </tr>
                            </tbody>
                        <?php
                                }
                        ?>
                        </table>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php
        }
        ?>
    </main><!-- End #main -->
    <?php require_once('script.php') ?>

</body>

</html>