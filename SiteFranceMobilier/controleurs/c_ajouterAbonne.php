<?php
	require_once "c_menu.php";
	require_once "modeles/m_abonne.php";
	require_once "incPhp/PHPMailer/PHPMailer.php";
	require_once "incPhp/PHPMailer/Exception.php";
	require_once "incPhp/PHPMailer/SMTP.php";
	use PHPMailer\PHPMailer\PHPMailer;
	class c_ajouterAbonne
	{
		// sous controleur destiné à fournir les données nécessaires à la vue v_menu.php
		private $controleur_menu;
		// modèle nécessaire à la manipulation des données
		private $modele_abonne;
		// tableau associatif contenant les données à transmettre aux vues
		private $data;
		public function __construct()
		{
			$this->data=array();
			$this->controleur_menu=new c_menu();
			$this->modele_abonne=new m_abonne();
		}
		public function action_saisie()
		{
			$this->controleur_menu->FillData($this->data);
			require_once "vues/v_saisieAbonne.php";
		}
		public function action_ajout($email,$gamme)
		{	
			try
			{
				$this->controleur_menu->FillData($this->data);
				if (filter_var($email, FILTER_VALIDATE_EMAIL)) //le format de l'adresse mail est correct
				{
					$id=uniqid('',true);
					$date=date("Y-m-d");
					$ok=0;
					$abonne=$this->modele_abonne->Ajouter($id,$email,$date,$ok,$gamme);
					if ($abonne)
					{
						$mail=new PHPMailer();
						$mail->isSMTP();
						$mail->isHTML(true);
						$mail->CharSet="utf-8";
						$mail->Host = 'localhost';
						$mail->Port = 2525;
						$mail->setFrom('francemobilier@orange.fr');
						$mail->Subject = 'Inscription newsletter France Mobilier';
						$mail->addAddress($abonne->GetEmail());

						// Corps du mail HTML avec lien cliquable
						$lienValidation = "http://localhost/SiteFranceMobilier/index.php?page=validationAbonne&id=".$abonne->GetId();
						$mail->Body = '
							<p>Merci de vous intéresser à notre newsletter.</p>
							<p>Cliquez sur le lien ci-dessous pour valider votre inscription :</p>
							<p><a href="'.$lienValidation.'" target="_blank">'.$lienValidation.'</a></p>
							<p>Cordialement,<br>France-Mobilier</p>
						';

						// Version texte alternative pour les clients non-HTML
						$mail->AltBody = "Merci de vous intéresser à notre newsletter.\n\n"
							."Copiez-collez ce lien dans votre navigateur pour valider votre inscription :\n"
							. $lienValidation . "\n\nCordialement,\nFrance-Mobilier";

						if($mail->Send())
						{
							$this->data['leMessage']="Un mail vous a été envoyé, consultez-le et cliquez sur le lien de confirmation pour valider votre inscription.";
						}
						else 
						{
							$this->data['leMessage']="L'envoi du mail a échoué, merci de réessayer ultérieurement...";
							$this->modele_abonne->Supprimer($id);
						}
					}
					else
					{
						$this->data['leMessage']="L'ajout de l'Adresse ".$email." a échoué, vous êtes sans doute déjà inscrit...";
					}
				}
				else
				{
					$this->data['leMessage']="L'Adresse ".$email." est incorrecte.";
				}
				require_once "vues/v_message.php";
			}
			catch(Exception $e){
				$this->data['leMessage']="Erreur : ".$e->getMessage();
				require_once "vues/v_message.php";
			}

			
		}
		public function action_validation($id)
		{
			$this->controleur_menu->FillData($this->data);
			$ok=$this->modele_abonne->Valider($id);
			if ($ok)
			{
				$this->data['leMessage']="Votre inscription à notre newsletter a bien été validée.";
			}
			else
			{
				$this->data['leMessage']="Votre inscription à notre newsletter n'a pas pu être validée.";
			}
			require_once "vues/v_message.php";
		}
	}
?>