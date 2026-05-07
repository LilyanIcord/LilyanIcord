<?php
	class m_generique
	{
		private $cnx;
		public function GetCnx()
		{
			return $this->cnx;
		}
		public function connexion()
		{
			$this->cnx=mysqli_connect("127.0.0.1","root","","francemobilier");
			mysqli_set_charset($this->cnx, "utf8");
		}
		public function deconnexion()
		{
			mysqli_close($this->cnx);
		}
	}
?>