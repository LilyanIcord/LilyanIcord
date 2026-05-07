<?php
	class Abonne
	{
		private $abo_id;
		private $abo_email;
		private $abo_date;
		private $abo_ok;
		private $abo_gamme;
		public function __construct($id,$email,$date,$ok,$gamme)
		{
			$this->abo_id=$id;
			$this->abo_email=$email;
			$this->abo_date=$date;
			$this->abo_ok=$ok;
			$this->abo_gamme=$gamme;
		}
		public function GetId()
		{
			return $this->abo_id;
		}
		public function GetEmail()
		{
			return $this->abo_email;
		}

	}
?>