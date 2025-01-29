<?php
# Se connecter à la BD
require_once('../connexion/connexion.php');
# Selection Querry
require_once('../models/select/select-departement.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Département</title>
    <?php require_once('style.php'); ?>

</head>

<body>

    <!-- Appel de menues  -->
    <?php require_once('aside.php') ?>

    <main id="main" class="main">
        <div class="row">
            <div class="col-12">
                <h4>Département</h4>
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

            if (isset($_GET["NewDepartement"])) {
            ?>
                <!-- Le form qui enregistre les données  -->
                <div class="col-xl-12 ">
                    <form action="<?= $action ?>" method="POST" class="shadow p-3">
                        <div class="row">
                            <h4 class="text-center"><?= $title ?></h4>
                            <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                <label for="">Description <span class="text-danger">*</span></label>
                                <input required type="text" name="nom_departement" <?php if (isset($_GET['idModif'])) { ?>value="<?= $AfichDepartement['nom_Departement'] ?>" <?php } ?>class="form-control" placeholder="Entrez le nom du departement ">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                <label for="">Dénomination <span class="text-danger">*</span></label>
                                <input required type="text" name="denomination" <?php if (isset($_GET['idModif'])) { ?>value="<?= $AfichDepartement['denomination'] ?>" <?php } ?> class="form-control" placeholder="Entrer le une denomination ">
                            </div>

                            <?php if (isset($_GET['idModif'])) {
                            ?>
                                <div class="col-xl-6 col-lg-6 col-md-6 mt-4 col-sm-6 p-3 ">
                                    <input type="submit" name="valider" class="btn btn-dark w-100" value="Modifier">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 mt-4 col-sm-6 p-3 ">
                                    <a href="departement.php" class="btn btn-danger w-100">Annuler</a>
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
                <a href="departement.php?NewDepartement" class="btn btn-dark w-100">Nouveau Département</a>
            <?php
            }
            ?>


            <!-- La table qui affiche les données  -->
            <div class="col-xl-12 table-responsive px-3 card mt-4 px-4 pt-3">
                <h6 class="text-center">Listes des departements</h6>
                <table class="table table-borderless datatable ">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Description</th>
                            <th>Pseudonyme</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $num = 0;
                        while ($departement = $getData->fetch()) {
                            $num++;
                        ?>
                            <tr>
                                <!--<th scope="row">1</th> -->
                                <td><?php echo $num ?></td>
                                <td><?php echo $departement["nom_Departement"] ?></td>
                                <td><?php echo $departement["denomination"] ?></td>
                                <td>
                                    <a href="departement.php?NewDepartement&idModif=<?php echo $departement[0] ?>" class="btn btn-dark btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')" href="../models/delete/delete-Departement.php?idSupDepar=<?php echo $departement[0] ?>" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash3-fill"></i>
                                    </a>
                                </td>

                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main><!-- End #main -->
    <?php require_once('script.php') ?>

</body>

</html>