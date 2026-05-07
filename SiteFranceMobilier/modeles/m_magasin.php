<?php
	require_once "m_generique.php";
	require_once "metiers/Magasin.php";
	class m_magasin extends m_generique
	{
		public function GetListe()
		{
			$resultat=array();
			$this->connexion();
			$req="select * from magasin order by mag_nom";
			$res=mysqli_query($this->GetCnx(),$req);
			$ligne=mysqli_fetch_assoc($res);
			while ($ligne)
			{
				$categ=new Magasin($ligne["mag_code"],$ligne["mag_nom"],$ligne["mag_adresseRue"],$ligne["mag_cpVille"]);
				$resultat[]=$categ;
				$ligne=mysqli_fetch_assoc($res);
			}
			$this->deconnexion();
			return $resultat;
		}
	}
?>