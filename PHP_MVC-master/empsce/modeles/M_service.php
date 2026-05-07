<?php
    require_once"M_generique.php";
    require_once"metiers/Service.php";

    class M_service extends M_generique
    {
        public function GetListe()
        {
            $resultat=array();
            $this->Connexion();
            $req="select * from service";
            $res=mysqli_query($this->GetCnx(),$req);
            $ligne=mysqli_fetch_assoc($res);
            while ($ligne)
            {
                $sce=new Service($ligne["sce_code"],$ligne["sce_designation"]);
                $resultat[]=$sce;
                $ligne=mysqli_fetch_assoc($res);
            }
            $this->Deconnexion();
            return $resultat;
        }

        
        public function GetService($code)
        {
            $resultat=null;
            $this->Connexion();
            $req="select * from service where sce_code ='".$code."'";
            $res=mysqli_query($this->GetCnx(),$req);
            $ligne=mysqli_fetch_assoc($res);
            while ($ligne)
            {
                $sce=new Service($ligne["sce_code"],$ligne["sce_designation"]);
                $resultat[]=$sce;
                $ligne = mysqli_fetch_assoc($res);

            }
            $this->Deconnexion();
            return $resultat;
        }

    }
?>