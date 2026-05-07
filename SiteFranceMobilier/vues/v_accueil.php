<?php include 'v_entete.php'; ?>

<div class="container-fluid min-vh-100 d-flex flex-column">
    <div class="row flex-grow-1">

        <?php include 'v_menu.php'; ?>	

		<main class="col-12 col-md-9 col-lg-10 p-5">
			<div class="text-center">
				<h1 class="mb-4">France-Mobilier, les pros du meuble...</h1>

				<p class="text-muted">
					Sélectionnez une catégorie et/ou une gamme pour afficher les résultats.
				</p>


				<?php
				foreach ($this->data['lesMagasin'] as $unMagasin)
				{
					echo $unMagasin->GetInfos().'<br>';
				}
				?>
			</div>

			<!-- Carrousel Bootstrap -->
			<div id="carouselMeubles" class="carousel slide mb-4" data-bs-ride="carousel">

				<!-- Contenu -->
				<div class="carousel-inner">

					<!-- Slide 1 -->
					<div class="carousel-item active">
						<div class="d-flex justify-content-center position-relative">
							<img src="images_caroussel/livingroom.jpg"
								alt="Salon moderne"
								style="object-fit:cover;"
								class="rounded shadow">

							<div class="position-absolute bottom-0 start-50 translate-middle-x w-100" style="max-width:450px;">
								<div class="p-3"
									style="background:rgba(0,0,0,0.6); color:white; border-radius:0 0 0.5rem 0.5rem;">
									<h5 class="mb-1">Salon moderne</h5>
									<p class="mb-0 small">Un espace convivial et élégant pour votre quotidien</p>
								</div>
							</div>
						</div>
					</div>

					<!-- Slide 2 -->
					<div class="carousel-item">
						<div class="d-flex justify-content-center position-relative">
							<img src="images_caroussel/diningroom.jpg"
								alt="Salle à manger"
								style="object-fit:cover;"
								class="rounded shadow">

							<div class="position-absolute bottom-0 start-50 translate-middle-x w-100" style="max-width:450px;">
								<div class="p-3"
									style="background:rgba(0,0,0,0.6); color:white; border-radius:0 0 0.5rem 0.5rem;">
									<h5 class="mb-1">Salle à manger</h5>
									<p class="mb-0 small">Des meubles pensés pour partager des moments uniques</p>
								</div>
							</div>
						</div>
					</div>

					<!-- Slide 3 -->
					<div class="carousel-item">
						<div class="d-flex justify-content-center position-relative">
							<img src="images_caroussel/bedroom.jpg"
								alt="Chambre confortable"
								style="object-fit:cover;"
								class="rounded shadow">

							<div class="position-absolute bottom-0 start-50 translate-middle-x w-100" style="max-width:450px;">
								<div class="p-3"
									style="background:rgba(0,0,0,0.6); color:white; border-radius:0 0 0.5rem 0.5rem;">
									<h5 class="mb-1">Chambre confortable</h5>
									<p class="mb-0 small">Repos et bien-être dans un cadre chaleureux</p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Navigation -->
				<button class="carousel-control-prev" type="button" data-bs-target="#carouselMeubles" data-bs-slide="prev">
					<span class="d-flex align-items-center justify-content-center bg-dark bg-opacity-75 rounded-circle" style="width:48px; height:48px;">
        				<i class="bi bi-chevron-left text-white fs-3"></i>
    				</span>
				</button>

				<button class="carousel-control-next" type="button" data-bs-target="#carouselMeubles" data-bs-slide="next">
					<span class="d-flex align-items-center justify-content-center bg-dark bg-opacity-75 rounded-circle" style="width:48px; height:48px;">
        				<i class="bi bi-chevron-right text-white fs-3"></i>
    				</span>
				</button>
			</div>							
		</main>
	</div>
	<?php include 'v_piedPage.php'; ?>
</div>

