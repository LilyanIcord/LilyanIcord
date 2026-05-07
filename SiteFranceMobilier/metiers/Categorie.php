<?php
	class Categorie
	{
		private $cat_id;
		private $cat_libelle;
		public function __construct($id,$libelle)
		{
			$this->cat_id=$id;
			$this->cat_libelle=$libelle;
		}
		public function GetId()
		{
			return $this->cat_id;
		}
		public function GetLibelle()
		{
			return $this->cat_libelle;
		}
	}
?>