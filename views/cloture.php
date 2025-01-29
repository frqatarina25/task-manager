<?php
# Se connecter à la BD
require_once('../connexion/connexion.php');
# Selection Querry
require_once('../models/select/select-Home.php');
require_once('../models/select/select-cloture.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Accueil</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <?php
    require_once('style.php');
    ?>
    <style>
        .carte {
            margin-right: 8px;
        }
    </style>

</head>

<body>

    <?php require_once('aside.php') ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Situation Finacieres</h1>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">
                        <?php
                        # Affichage du message d'alerte
                         if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { ?>
                            <div class="col-xl-12 mt-3">
                                <div class="alert-info alert text-center"><?= $_SESSION['msg'] ?></div>
                            </div>
                        <?php }
                        #Cette ligne permet de vider la valeur qui se trouve dans la session message
                        unset($_SESSION['msg']);
                        # Confiramtion de cloture
                        if (isset($_GET['cloture'])) {
                        ?>
                            <div class="col-xl-12 px-3 card mt-4 px-4 pt-3">
                                <h3 class="bi bi-shield-exclamation text-danger text-center"> Zone Dangereuse</h3> <br>
                                <p class="text-center">
                                    Voule-Vous vraiment les récents mouvemennts de caisse ?? <br>
                                    Cette action est irreverssible, Assurez-vous que c'est l'action que vous souhaiter
                                    réaliser ! Elle permet de cloturer tout les recents mouvement de caisse, les entrées comme les sorties.
                                </p>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <a href="cloture.php" class="btn btn-dark  w-100"> Annler</a>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <a href="../models/add/add-cloture.php?valider&sldD=<?= $soldeDol ?>&sldF=<?= $soldeFranc ?>" class="btn btn-danger bi bi-trash w-100"> Cloturé</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <!-- Total Entrées non cloturé Card -->
                            <div class="col-xxl-4 col-md-6">
                                <div class="card info-card sales-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Entrées <span>|<?= $mois_actuel_nom ?></span></h5>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="ps-3">
                                                        <h6><?= $TotalEntreeDol ?></h6> <span>$</span>
                                                        <span class="text-muted small pt-2 ps-1">Dollars</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="ps-3">
                                                        <h6><?= $TotalEntreeFranc ?></h6> <span>Fc</span>
                                                        <span class="text-muted small pt-2 ps-1">Francs</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                    </div>

                                </div>
                            </div>
                            <!-- Total Sorties non cloturé Card -->
                            <div class="col-xxl-4 col-md-6">
                                <div class="card info-card sales-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Sorties <span>|<?= $mois_actuel_nom ?></span></h5>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="ps-3">
                                                        <h6><?= $TotalSortieDol ?></h6> <span>$</span>
                                                        <span class="text-muted small pt-2 ps-1">Dollars</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="ps-3">
                                                        <h6><?= $TotalSortieFranc ?></h6> <span>Fc</span>
                                                        <span class="text-muted small pt-2 ps-1">Francs</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                    </div>

                                </div>
                            </div>
                            <!-- Soldes Card -->
                            <div class="col-xxl-8 col-md-12">
                                <div class="card info-card sales-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Soldes <span>| <?= $mois_actuel_nom ?></span></h5>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-coin"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <h6><?= $soldeDol ?></h6>
                                                        <span class="text-success small pt-1 fw-bold">Solde en $</span> <span class="text-muted small pt-2 ps-1">Dollards</span>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-facebook"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <h6><?= $soldeFranc ?></h6>
                                                        <span class="text-success small pt-1 fw-bold">Solde en Franc</span> <span class="text-muted small pt-2 ps-1">Franc</span>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 pt-3">
                                                <a href="cloture.php?cloture" class="btn btn-dark btn-sm w-100">Cloturé</a>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="col-lg-12">

                        </div>


                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">
                    <!-- Recent Terrain -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Terrain Recent <span>| Today</span></h5>

                            <div class="activity">
                                <?php
                                while ($Terrain = $getTerrain->fetch()) {
                                ?>
                                    <div class="activity-item d-flex">
                                        <div class="activite-label"><?= $Terrain["date"] ?></div>
                                        <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                        <div class="activity-content">
                                            <?= $Terrain["description"] . " à " . $Terrain["lieu"] ?> avec<a href="#" class="fw-bold text-dark"> <?= $Terrain["Denomination"] ?></a>
                                        </div>
                                    </div><!-- End terrain item-->
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div><!-- End Recent Activity -->

                </div><!-- End Right side columns -->

            </div>
        </section>

    </main><!-- End #main -->

    <?php require_once('script.php') ?>

</body>

</html>