<?php include 'v_entete.php'; ?>

<div class="container-fluid min-vh-100 d-flex flex-column">
    <div class="row flex-grow-1">

        <!-- Menu gauche -->
        <?php include 'v_menu.php'; ?>

        <!-- Contenu -->
        <main class="col-12 col-md-9 col-lg-10 p-5 text-center">
            <h1 class="mb-4 text-success">France-Mobilier, les pros du meuble...</h1>
			<h2 class="mb-4">Abonnement à la newsletter</h2>

            <div class="card shadow-sm p-4 mx-auto text-start" style="max-width: 600px;">
                <form action="index.php" method="get">
                    
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Saisissez votre adresse email :</label>
                        <input type="email"
                               name="email"
                               id="email"
                               class="form-control"
                               placeholder="ex : nom@exemple.com"
                               required>

                        <label for="gamme" class="form-label fw-bold mt-3">Choisissez votre gamme :</label>
                        <select name="gamme" id="gamme" class="form-select">
                            <option selected value="0">Toutes les gammes</option>
							<?php
							foreach ($this->data['lesGammes'] as $uneGamme)
							{
								echo '<option value="'.$uneGamme->GetId().'">'.$uneGamme->GetLibelle().'</option>';
							}
							?>       
                        </select>
                    </div>

                    <input type="hidden" name="page" value="ajoutAbonne" />

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success px-4">
                            S'abonner
                        </button>
                    </div>

                </form>
            </div>

        </main>

    </div>
	<?php include 'v_piedPage.php'; ?>
</div>
