<?php include 'v_entete.php'; ?>

<div class="container-fluid min-vh-100 d-flex flex-column">
    <div class="row flex-grow-1">

        <!-- Menu gauche -->
        <?php include 'v_menu.php'; ?>

        <!-- Contenu principal -->
        <main class="col-12 col-md-9 col-lg-10 p-5">
            <h1 class="mb-4 text-success">Liste des produits</h1>

            <?php
            if (is_null($this->data['laCategorie']) && is_null($this->data['laGamme']))
            {
                echo '<h2 class="h5 mb-4 text-muted">Tous les produits</h2>';
            }

           else if (is_null($this->data['laCategorie']) && !is_null($this->data['laGamme']))
            {
                echo '<h2 class="h5 mb-4">Catégorie : '.$this->data['laGamme']->GetLibelle().'</h2>';          
            }


            else if (!is_null($this->data['laCategorie']) && !is_null($this->data['laGamme']))
            {
                echo '<h2 class="h5 mb-4">Catégorie : '.$this->data['laCategorie']->GetLibelle().  ' -  Gamme :'.$this->data['laGamme']->GetLibelle().'</h2>';          
            }


            else
            {
                echo '<h2 class="h5 mb-4">Catégorie : '.$this->data['laCategorie']->GetLibelle().'</h2>';
            }
            ?>

            <!-- Tableau Bootstrap -->
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-success">
                        <tr>
                            <th>Réf.</th>
                            <th>Photo</th>
                            <th>Désignation</th>
                            <th>Prix TTC</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->data['lesProduits'] as $unProduit): ?>
                            <tr>
                                <td><?= $unProduit->GetReference(); ?></td>
                                <td>
                                    <img
                                        src="photos/<?= $unProduit->GetPhoto(); ?>"
                                        alt="<?= $unProduit->GetDesignation(); ?>"
                                        class="img-thumbnail"
                                        style="max-width: 80px;"
                                    >
                                </td>
                                <td><?= $unProduit->GetDesignation(); ?></td>
                                <td>
                                    <strong><?= number_format($unProduit->GetPrixTTC(), 2, ',', ' '); ?> €</strong>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
	<?php include 'v_piedPage.php'; ?>
</div>
