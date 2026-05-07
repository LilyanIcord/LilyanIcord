<?php
	require_once "m_generique.php";
	require_once "metiers/Categorie.php";
	class m_categorie extends m_generique
	{
		public function GetListe()
		{
			$resultat=array();
			$this->connexion();
			$req="select * from categorie order by cat_libelle";
			$res=mysqli_query($this->GetCnx(),$req);
			$ligne=mysqli_fetch_assoc($res);
			while ($ligne)
			{
				$categ=new Categorie($ligne["cat_id"],$ligne["cat_libelle"]);
				$resultat[]=$categ;
				$ligne=mysqli_fetch_assoc($res);
			}
			$this->deconnexion();
			return $resultat;
		}
		public function GetCateg($id)
		{
			$resultat=null;
			$this->connexion();
			$req="select * from categorie where cat_id=".$id;
			$res=mysqli_query($this->GetCnx(),$req);
			$ligne=mysqli_fetch_assoc($res);
			if($ligne)
			{
				$categ=new Categorie($ligne["cat_id"],$ligne["cat_libelle"]);
				$resultat=$categ;
			}
			$this->deconnexion();
			return $resultat;
		}
	}
?>