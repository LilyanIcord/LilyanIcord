<aside class="col-12 col-md-3 col-lg-2 bg-light p-4">

	<!-- Boutons de navigation -->
    <div class="mb-4">
        <a href="index.php?page=accueil" class="btn btn-outline-success w-100 mb-2">
            Accueil
        </a>
        <a href="index.php?page=saisieAbonne" class="btn btn-outline-success w-100">
            S’abonner à la Newsletter
        </a>
    </div>

	<!-- Recherche des produits -->
    <h5 class="mb-4">Meubles</h5>

    <form action="index.php"method="get">
        <!-- Catégorie -->
        <div class="mb-3">
            <label for="categorie" class="form-label">Catégorie</label>
            <select name="categ" id="categ" class="form-select">
                <option selected value="0">Toutes les catégories</option>
				<?php
				foreach ($this->data['lesCategories'] as $uneCategorie)
				{
					echo '<option value="'.$uneCategorie->GetId().'">'.$uneCategorie->GetLibelle().'</option>';
				}
				?>       
            </select>
        </div>

        <div class="mb-3">
            <label for="gamme" class="form-label">Gamme</label>
            <select name="gamme" id="gamme" class="form-select">
                <option selected value="0">Toutes les gamme</option>
				<?php
				foreach ($this->data['lesGammes'] as $uneGamme)
				{
					echo '<option value="'.$uneGamme->GetId().'">'.$uneGamme->GetLibelle().'</option>';
				}
				?>       
            </select>
        </div>

		<input type="hidden" name="page" value="listePdt" />		
        <button type="submit" class="btn btn-warning w-100">
            Rechercher
        </button>
    </form>
</aside>