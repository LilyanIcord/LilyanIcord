<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <title>Gestion du personnel</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="fr" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u3@0Kp6M/tr1iBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
        crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU®Gzau9q]J11fW4pNL1hNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN95405Q"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>

<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-success mb-3">
    <div class="container-fluid">

      <a class="navbar-brand fw-bold fs-4" href="index.php?page=accueil">Gestion Personnel</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">


          <li class="nav-item">
            <a class="navbar-brand  fs-5" href="index.php?page=saisieEmploye">Ajouter un employé</a>
          </li>

          <li class="nav-item dropdown">
            <a class="navbar-brand  dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Liste des employés
            </a>
            <ul class="dropdown-menu">
              <?php
              foreach ($this->data["lesServices"] as $unService) {
                echo '<li><a class="dropdown-item fs-5" href="index.php?service=' . htmlspecialchars($unService->GetCode()) . '&page=listeEmployes">' .
                  htmlspecialchars($unService->GetDesignation()) . '</a></li>';
              }
              ?>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item fs-5" href="index.php?service=all&page=listeEmployes">Tous les services</a></li>
            </ul>
          </li>
        </ul>

        <a class="btn btn-danger fs-5" href="index.php?page=deconnexion" role="button">Déconnexion</a>
      </div>
    </div>
  </nav>
</header>

<main>
  <div class="container-fluid">
    <?php
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    if (!empty($_SESSION['message'])) : ?>
      <div class="alert alert-info text-center my-3">
        <?php
        echo htmlspecialchars($_SESSION['message']);
        unset($_SESSION['message']);
        ?>
      </div>
    <?php endif; ?>


  </div>
</main>

</body>
</html>
