<?php
require_once "C_menu.php";
require_once "modeles/M_service.php";
require_once "modeles/M_employe.php";

class C_consulterEmployes
{
    private $data;
    private $modeleEmploye;
    private $modeleService;
    private $controleurMenu;
    public function __construct()
    {
        $this->data = array();
        $this->controleurMenu= new C_menu();
        $this->modeleService= new M_service();
        $this->modeleEmploye = new M_employe();
    }

    public function action_listeEmployes($codeService)
    {
        $this->controleurMenu->FillData($this->data);
        if (is_null($codeService) || $codeService=="all")
        {
            $this->data['leService']=null;
            $this->data['lesEmployes'] = $this->modeleEmploye->GetListe();
        }
        else
        {
            $this->data['leService']=$this->modeleService->GetService($codeService);
            $this->data['lesEmployes'] = $this->modeleEmploye->GetListeService($codeService);
        }
        require_once "vues/v_listeEmployes.php";
    }


    public function action_modifierEmploye($matricule)
    {
        $this->controleurMenu->FillData($this->data);
        $employe = $this->modeleEmploye->GetEmploye($matricule);
        if (!$employe) 
        {
            $this->data['leMessage'] = "Employe non trouve.";
            require_once "vues/v_message.php";
            return;
        }

        $this->data['employe'] = $employe;
        require_once "vues/v_modifierEmploye.php";
    }

    public function action_modifier($matricule, $nom, $prenom, $service)
    {
        $this->controleurMenu->FillData($this->data);
        $employe = $this->modeleEmploye->GetEmploye($matricule);
        if (is_null($employe))
        {
            $this->data['leMessage'] = "Employe non trouve.";
            require_once "vues/v_message.php";
            return;
        }

        $ok = $this->modeleEmploye->ModifierEmploye($matricule, $nom, $prenom, $service);
        if ($ok)
        {
            header("Location: index.php?page=listeEmployes&service=all");
            exit;
        }

        $this->data['leMessage'] = "La modification de l'employe a echoue.";
        require_once "vues/v_message.php";
    }

    public function action_supprimerEmploye($matricule)
    {
        $this->modeleEmploye->SupprimerEmploye($matricule);
        header("Location: index.php?page=listeEmployes&service=all");
        exit;
    }
}
?>