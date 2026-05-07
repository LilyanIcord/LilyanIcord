<?php
	class Gamme
	{
		private $gam_id;
		private $gam_libelle;
		public function __construct($id,$libelle)
		{
			$this->gam_id=$id;
			$this->gam_libelle=$libelle;
		}
		public function GetId()
		{
			return $this->gam_id;
		}
		public function GetLibelle()
		{
			return $this->gam_libelle;
		}
	}
?>