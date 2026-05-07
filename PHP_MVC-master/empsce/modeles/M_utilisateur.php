<?php
class M_utilisateur {
    private $pdo;

    public function __construct() 
    {
        try 
        {
            $dsn = "mysql:host=localhost;dbname=empsce;charset=utf8";
            $this->pdo = new PDO($dsn, "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch (PDOException $e) 
        {
            echo("Échec lors de la connexion : " . $e->getMessage());
        }
    }

    public function getUtilisateurParLogin($login) {
        $res = $this->pdo->prepare("SELECT * FROM utilisateur WHERE login = :login");
        $res->bindValue(':login', $login, PDO::PARAM_STR);
        $res->execute();
        return $res->fetch(PDO::FETCH_ASSOC);
    }

    public function utilisateurExiste($login) {
        $res = $this->pdo->prepare("SELECT COUNT(*) FROM utilisateur WHERE login = :login");
        $res->bindValue(':login', $login, PDO::PARAM_STR);
        $res->execute();
        return $res->fetchColumn() > 0;
    }

    public function ajouterUtilisateur($login, $mdp_hashed) {
        $res = $this->pdo->prepare("INSERT INTO utilisateur (login, mdp) VALUES (:login, :mdp)");
        $res->bindValue(':login', $login, PDO::PARAM_STR);
        $res->bindValue(':mdp', $mdp_hashed, PDO::PARAM_STR);
        return $res->execute();
    }
}
?>
