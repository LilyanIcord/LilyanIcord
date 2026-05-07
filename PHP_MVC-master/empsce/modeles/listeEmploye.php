<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xthml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <title>Liste des employés</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Language" content="fr" />
    <link rel="stylesheet" type="text/css"² href="empsce.css"/>
</head>
<body>
<?php
         $connexion= mysqli_connect("localhost", "root", "","empsce");
         if ($connexion)
         {
            mysqli_set_charset ($connexion,'utf-8');
            $requete="select * from employe;";
            $resultat= mysqli_query($connexion,$requete);
            $ligne=mysqli_fetch_assoc($resultat);
            while($ligne)
            {
                echo $ligne["emp_matricule"];echo",";
                echo $ligne["emp_nom"];echo",";
                echo $ligne["emp_prenom"];echo",";
                echo $ligne["emp_service"];echo",";
                $ligne=mysqli_fetch_assoc($resultat);
            }
            mysqli_close($connexion);
         }
         else
         {
            echo"problème à la connexion <br/>";
         }
?>
</body>
</html>