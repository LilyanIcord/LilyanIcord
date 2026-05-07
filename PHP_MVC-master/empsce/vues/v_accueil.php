

<?php include_once('v_entete.php'); ?>

<div class="container py-4">
    <div class="p-4 p-md-5 mb-4 rounded-3 bg-light border">
        <div class="row align-items-center g-4">
            <div class="col-md-7">
                <h1 class="display-6 fw-bold mb-3">Bienvenue sur l'espace de gestion des employes</h1>
                <p class="lead mb-3">
                    Centralisez la gestion de vos collaborateurs: consultation des effectifs,
                    mise a jour des informations et suivi par service.
                </p>
                <p class="text-muted mb-4">
                    Cette interface vous permet d'assurer des donnees fiables et un pilotage RH simple au quotidien.
                </p>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="index.php?page=listeEmployes&service=all" class="btn btn-primary">
                        Consulter les employes
                    </a>
                    <a href="index.php?page=saisieEmploye" class="btn btn-outline-secondary">
                        Ajouter un employe
                    </a>
                </div>
            </div>
            <div class="col-md-5 text-center">
                <img src="./Images/accueil.jpg" class="img-fluid rounded shadow-sm" alt="Gestion des employes" />
            </div>
        </div>
    </div>

</div>

<?php include_once('v_piedPage.php'); ?>
