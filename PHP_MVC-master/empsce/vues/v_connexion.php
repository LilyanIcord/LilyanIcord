<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-LN+7fdVzj6u52u3@0Kp6M/tr1iBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-ndDqU®Gzau9q]J11fW4pNL1hNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN95405Q" crossorigin="anonymous"></script>
</head>

<body>

<div class="container mt-5">
    <h2>Connexion</h2>

    <form action="" method="post">
        <div class="mb-3">
            <label for="login" class="form-label">Login :</label>
            <input type="text" class="form-control" id="login" name="login" required />
        </div>

        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe :</label>
            <input type="password" class="form-control" id="mdp" name="mdp" required />
        </div>

        <button type="submit" class="btn btn-success">Se Connecter </button>
    </form>
</div>

    </body>
<?php include_once('v_piedPage.php'); ?>

</html>
