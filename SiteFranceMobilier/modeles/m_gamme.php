<?php
	require_once "m_generique.php";
	require_once "metiers/Gamme.php";
	class m_gamme extends m_generique
	{
		public function GetListe()
		{
			$resultat=array();
			$this->connexion();
			$req="select * from gamme order by gam_libelle";
			$res=mysqli_query($this->GetCnx(),$req);
			$ligne=mysqli_fetch_assoc($res);
			while ($ligne)
			{
				$gamme=new Categorie($ligne["gam_id"],$ligne["gam_libelle"]);
				$resultat[]=$gamme;
				$ligne=mysqli_fetch_assoc($res);
			}
			$this->deconnexion();
			return $resultat;
		}
		public function GetGamme($id)
		{
			$resultat=null;
			$this->connexion();
			$req="select * from gamme where gam_id=".$id;
			$res=mysqli_query($this->GetCnx(),$req);
			$ligne=mysqli_fetch_assoc($res);
			if($ligne)
			{
				$gamme=new Categorie($ligne["gam_id"],$ligne["gam_libelle"]);
				$resultat=$gamme;
			}
			$this->deconnexion();
			return $resultat;
		}
	}
?>