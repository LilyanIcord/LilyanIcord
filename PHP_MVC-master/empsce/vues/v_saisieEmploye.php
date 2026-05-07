<?php include_once('v_entete.php'); ?>

<div class="container">
    <h2>Ajout d'un employé</h2>

    <form action="index.php?page=ajoutEmploye" method="post">
        <div class="mb-3">
            <label for="matricule" class="form-label">Matricule :</label>
            <input 
                type="text" 
                class="form-control" 
                name="matricule" 
                id="matricule" 
                size="4" 
            />
        </div>

        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input 
                type="text" 
                class="form-control" 
                name="nom" 
                id="nom" 
                size="50" 
            />
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom :</label>
            <input 
                type="text" 
                class="form-control" 
                name="prenom" 
                id="prenom" 
                size="50" 
            />
        </div>

        <div class="mb-3">
            <label for="service" class="form-label">Service :</label>
            <select class="form-control" name="service" id="service" size="1">
                <?php
                foreach ($this->data['lesServices'] as $unService) {
                    echo '<option value="' . $unService->GetCode() . '">' . $unService->GetDesignation() . '</option>';
                }
                ?>
            </select>
        </div>

        <br />

        <input type="submit" class="btn btn-success" value="Enregistrer" />
    </form>
</div>

<?php include_once('v_piedPage.php'); ?>
