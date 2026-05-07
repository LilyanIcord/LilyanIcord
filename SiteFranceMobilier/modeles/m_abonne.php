<?php
	require_once "m_generique.php";
	require_once "metiers/Abonne.php";
	class m_abonne extends m_generique
	{
		public function Ajouter($id,$email,$date,$ok,$gamme)
		{
			$this->connexion();
			$email=mysqli_real_escape_string($this->GetCnx(),$email);
			$abonne=new Abonne($id,$email,$date,$ok,$gamme);
			$req="insert into abonne values ('".$id."','".$email."','".$date."',".$ok.",".$gamme.")";
			$ok=mysqli_query($this->GetCnx(), $req);
			if (!$ok)
			{
				$abonne=null;
			}
			$this->deconnexion();
			return $abonne;
		}
		public function Valider($id)
		{
			$this->connexion();
			$req="update abonne set abo_ok=1 where abo_id='".$id."'";
			$ok=mysqli_query($this->GetCnx(), $req);
			$this->deconnexion();
			return $ok;
		}
		public function Supprimer($id)
		{
			$this->connexion();
			$req="delete from abonne where abo_id='".$id."'";
			$ok=mysqli_query($this->GetCnx(), $req);
			$this->deconnexion();
		}
	}
?>