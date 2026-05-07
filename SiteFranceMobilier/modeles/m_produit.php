<?php
	require_once "m_generique.php";
	require_once "metiers/Produit.php";
	class m_produit extends m_generique
	{
		public function GetListe($categ,$gamme)
		{
			$resultat=array();
			$this->connexion();

			$req = "SELECT * FROM produit";
			$where = "";

			if ($categ != 0 && $gamme == 0) 
			{
				$where .= "pro_categorie = " . $categ;
			}

			else if ($categ == 0 && $gamme != 0) 
			{
				$where .= "pro_gamme = " . $gamme;
			}

			else if ($categ != 0 && $gamme != 0) 
			{
				$where .= "pro_gamme = " . $gamme . " AND pro_categorie = " . $categ ;
				
				
			}

			if ($where != "") 
			{
				$req .= " WHERE " . $where;
			}
			
			$res=mysqli_query($this->GetCnx(),$req);
			$ligne=mysqli_fetch_assoc($res);
			while ($ligne)
			{
				$produit=new Produit($ligne["pro_id"],$ligne["pro_reference"],$ligne["pro_designation"],$ligne["pro_prixTTC"],$ligne["pro_photo"]);
				$resultat[]=$produit;
				$ligne=mysqli_fetch_assoc($res);
			}
			$this->deconnexion();
			return $resultat;
		}
	}
?>