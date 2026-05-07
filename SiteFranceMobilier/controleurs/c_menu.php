<?php
	require_once "modeles/m_categorie.php";
	require_once "modeles/m_magasin.php";
	require_once "modeles/m_gamme.php";
	class c_menu
	{
		// modèle utilisé pour obtenir les données du menu
		private $modele_categorie;
		private $modele_magasin;
		private $modele_gamme;
		public function __construct()
		{
			$this->modele_categorie=new m_categorie();
			$this->modele_magasin=new m_magasin();
			$this->modele_gamme=new m_gamme();
		}
		public function FillData(&$data)
		{
			$data['lesCategories']=$this->modele_categorie->GetListe();
			$data['lesGammes']=$this->modele_gamme->GetListe();
			$data['lesMagasin']=$this->modele_magasin->GetListe();

		}
	}
?>