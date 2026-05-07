<?php include_once('v_entete.php'); ?>

<div class="container">
    <h2>Modifier un employe</h2>

    <form action="index.php?page=modifierEmploye&matricule=<?php echo urlencode($this->data['employe']->GetMatricule()); ?>" method="post">
        <div class="mb-3">
            <label for="matricule" class="form-label">Matricule :</label>
            <input
                type="text"
                class="form-control"
                name="matricule"
                id="matricule"
                value="<?php echo htmlspecialchars($this->data['employe']->GetMatricule()); ?>"
                readonly
            />
        </div>

        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input
                type="text"
                class="form-control"
                name="nom"
                id="nom"
                value="<?php echo htmlspecialchars($this->data['employe']->GetNom()); ?>"
                required
            />
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prenom :</label>
            <input
                type="text"
                class="form-control"
                name="prenom"
                id="prenom"
                value="<?php echo htmlspecialchars($this->data['employe']->GetPrenom()); ?>"
                required
            />
        </div>

        <div class="mb-3">
            <label for="service" class="form-label">Service :</label>
            <select class="form-control" name="service" id="service">
                <?php
                foreach ($this->data['lesServices'] as $unService) {
                    $selected = ($unService->GetCode() === $this->data['employe']->GetService()) ? 'selected' : '';
                    echo '<option value="' . htmlspecialchars($unService->GetCode()) . '" ' . $selected . '>' .
                        htmlspecialchars($unService->GetDesignation()) .
                        '</option>';
                }
                ?>
            </select>
        </div>

        <input type="submit" class="btn btn-primary" value="Enregistrer les modifications" />
        <a href="index.php?page=listeEmployes&service=all" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php include_once('v_piedPage.php'); ?>
