<?php
    require_once"M_generique.php";
    require_once"metiers/Employe.php";

    class M_employe extends M_generique
    {
        public function GetListe()
        {
            $resultat=array();
            $this->Connexion();
            $req="select * from employe";
            $res=mysqli_query($this->GetCnx(),$req);
            $ligne=mysqli_fetch_assoc($res);
            while ($ligne)
            {
                $employe=new Employe($ligne["emp_matricule"],$ligne["emp_nom"],$ligne["emp_prenom"],$ligne["emp_service"]);
                $resultat[]=$employe;
                $ligne=mysqli_fetch_assoc($res);
            }
            $this->Deconnexion();
            return $resultat;
        }

          
        public function GetListeService($code)
        {
            $resultat=array();
            $this->Connexion();
            $req="select * from employe where emp_service ='".$code."'";
            $res=mysqli_query($this->GetCnx(),$req);
            $ligne=mysqli_fetch_assoc($res);
            while ($ligne)
            {
                $employe=new Employe($ligne["emp_matricule"],$ligne["emp_nom"],$ligne["emp_prenom"],$ligne["emp_service"]);
                $resultat[]=$employe;
                $ligne=mysqli_fetch_assoc($res);
               
            }
            $this->Deconnexion();
            return $resultat;
        }

        public function GetEmploye($matricule)
        {
            $this->connexion();
            $req="select * from employe where emp_matricule ='".$matricule."'";
            $res=mysqli_query($this->GetCnx(),$req);
            $ligne=mysqli_fetch_assoc($res);
            if($ligne)
            {
                $resultat=new Employe($ligne["emp_matricule"],$ligne["emp_nom"],$ligne["emp_prenom"],$ligne["emp_service"]);
            }
            else
            {
                $resultat=null;
            }
            $this->deconnexion();
            return $resultat;
        
        }

        public function Ajouter($matricule, $nom, $prenom, $service)
        {
            $this->connexion();
            $matricule = mysqli_real_escape_string($this->GetCnx(), $matricule);
            $nom = mysqli_real_escape_string($this->GetCnx(), $nom);
            $prenom = mysqli_real_escape_string($this->GetCnx(), $prenom);
            $service = mysqli_real_escape_string($this->GetCnx(), $service);
        
            $employe = new Employe($matricule, $nom, $prenom, $service);
        
            $req = "INSERT INTO employe (emp_matricule, emp_nom, emp_prenom, emp_service)
                    VALUES ('$matricule', '$nom', '$prenom', '$service')";
        
            $ok = mysqli_query($this->GetCnx(), $req);
        
            if (!$ok) {
                $employe = null; 
            }
        
            $this->deconnexion();
            return $employe;
        }
        
        public function ModifierEmploye($matricule, $nom, $prenom, $service)
        {
            $this->connexion();


            $matricule = mysqli_real_escape_string($this->GetCnx(), $matricule);
            $nom = mysqli_real_escape_string($this->GetCnx(), $nom);
            $prenom = mysqli_real_escape_string($this->GetCnx(), $prenom);
            $service = mysqli_real_escape_string($this->GetCnx(), $service);

            $req = "UPDATE employe SET 
                        emp_nom = '$nom', 
                        emp_prenom = '$prenom', 
                        emp_service = '$service' 
                    WHERE emp_matricule = '$matricule'";

            $ok = mysqli_query($this->GetCnx(), $req);

            $this->deconnexion();
            return $ok;
        }

        public function SupprimerEmploye($matricule)
        {
            $this->connexion();

            $matricule = mysqli_real_escape_string($this->GetCnx(), $matricule);

            $req = "DELETE FROM employe WHERE emp_matricule = '$matricule'";

            $ok = mysqli_query($this->GetCnx(), $req);

            $this->deconnexion();
            return $ok;
        }

        
    }
?>