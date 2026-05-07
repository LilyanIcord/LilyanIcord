<?php
require_once "C_menu.php";
require_once __DIR__ . '/../modeles/M_utilisateur.php';

class C_inscription
{
    private $data;
    private $controleurMenu;
    private $modelUtilisateur;

    public function __construct()
    {
        $this->data = array();
        $this->controleurMenu = new C_menu();
        $this->modelUtilisateur = new M_utilisateur();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function action_afficher()
    {
        $this->controleurMenu->FillData($this->data);
        require_once "vues/v_inscription.php";
    }

    public function action_ajouterUtilisateur($login, $mdp, $mdpConf)
    {
        $this->controleurMenu->FillData($this->data);

        if ($mdp !== $mdpConf) {
            $this->data['leMessage'] = "Les mots de passe ne correspondent pas.";
            require_once "vues/v_message.php";
            return;
        }

        if ($this->modelUtilisateur->utilisateurExiste($login)) {
            $this->data['leMessage'] = "Ce login est déjà utilisé.";
            require_once "vues/v_message.php";
            return;
        }

        $mdp_hashed = password_hash($mdp, PASSWORD_DEFAULT);

        if ($this->modelUtilisateur->ajouterUtilisateur($login, $mdp_hashed)) {
            header("Location: index.php?page=connexion");
            exit();
        } else {
            $this->data['leMessage'] = "Erreur lors de l'enregistrement.";
            require_once "vues/v_message.php";
        }
    }
}
?>
