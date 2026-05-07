<?php
	if (!empty($_GET['page']))
	{
		$page=$_GET['page'];
	}
	else
	{
		$page="accueil";
	}
	switch ($page)
	{
		case "accueil":
			require_once "controleurs/c_consulterProduits.php";
			$controleur=new c_consulterProduits();
			$controleur->action_accueil();
			break;
		case "listePdt":
			require_once "controleurs/c_consulterProduits.php";
			$controleur=new c_consulterProduits();
			$controleur->action_listeProduits($_GET['categ'],$_GET['gamme']);
			break;
		case "saisieAbonne":
			require_once "controleurs/c_ajouterAbonne.php";
			$controleur=new c_ajouterAbonne();
			$controleur->action_saisie();
			break;
		case "ajoutAbonne":
			require_once "controleurs/c_ajouterAbonne.php";
			$controleur=new c_ajouterAbonne();
			$controleur->action_ajout($_GET['email'],$_GET['gamme']);
			break;
		case "validationAbonne":
			require_once "controleurs/c_ajouterAbonne.php";
			$controleur=new c_ajouterAbonne();
			$controleur->action_validation($_GET['id']);
			break;
		default:
			require_once "controleurs/c_consulterProduits.php";
			$controleur=new c_consulterProduits();
			$controleur->action_accueil();
			break;
	}	
?>