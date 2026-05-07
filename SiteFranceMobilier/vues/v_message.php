<?php include 'v_entete.php'; ?>

<div class="container-fluid min-vh-100 d-flex flex-column">
    <div class="row flex-grow-1">

        <!-- Menu gauche -->
        <?php include 'v_menu.php'; ?>

        <!-- Contenu -->
        <main class="col-12 col-md-9 col-lg-10 p-5">
            <h1 class="mb-4 text-success">France-Mobilier, les pros du meuble...</h1>
           	<hr/>
			<h2 class="mb-4"><?php echo $this->data['leMessage']; ?></h2>
			<hr/>
        </main>
    </div>
	<?php include 'v_piedPage.php'; ?>
</div>
