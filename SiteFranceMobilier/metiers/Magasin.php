<?php
	class Magasin
	{
		private $mag_id;
		private $mag_nom;
		private $mag_adresse;
		private $mag_cpville;
		
		public function __construct($id,$nom,$adresse,$cpville)
		{
			$this->mag_id=$id;
			$this->mag_nom=$nom;
			$this->mag_adresse=$adresse;
			$this->mag_cpville=$cpville;
		}

		public function GetId()
		{
			return $this->mag_id;
		}
		
		public function GetInfos()
		{
			return $this->mag_nom.' '.$this->mag_adresse.' '.$this->mag_cpville;
			
		}
	}
?>