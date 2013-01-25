<?php

// Vérification des droits d'accès de la page
if (utilisateur_est_connecte()) {

	// On affiche la page d'erreur comme quoi l'utilisateur est déjà connecté   
	include CHEMIN_VUE_GLOBALE.'erreur_deja_connecte.php';
	
} else {

	// Ne pas oublier d'inclure la librairie Form
	include CHEMIN_LIB.'form.php';

	// "formulaire_mdp_oublie" est l'ID unique du formulaire
	$form_mdp_oublie = new Form('formulaire_mdp_oublie');

	$form_mdp_oublie->method('POST');

	$form_mdp_oublie->add('Text', 'mail') -> label("Votre adresse e-mail");

	$form_mdp_oublie->add('Submit', 'submit') -> value("Valider");
	
	if ($form_mdp_oublie->is_valid($_POST)){
		
		$mail = $form_mdp_oublie->get_cleaned_data('mail');
		
		// On veut utiliser le modèle des membres (~/modeles/membres.php)
		include CHEMIN_MODELE.'membres.php';
	
	
	// si le mot de passe est trouvé, envoie du mail
	if (mail_existe($mail) != false){


		$id = mail_existe($mail);
							
		$lien = 'http://btssio.davidung.fr/index.php?module=membres&action=nouveau_mdp&id='.$id;

		// chemin du lien à modifier quand le site sera hébergé
		$message_mail = 'Bonjour, cliquez sur ce lien pour réinitialiser votre mot de passe : '.$lien."\r\n".' Merci de ne pas répondre à ce mail, ce message vous a été envoyé automatiquement.';
		
		$headers = 'From: noreply@gsb.com';

		mail($mail, 'GSB - Réinitialisation de votre mot de passe', $message_mail, $headers);
		
		include CHEMIN_VUE.'mail_ok.php';	 
		}

		else {
			
			$erreurs_mdp_oublie[] = "mail introuvable";
			
			// On réaffiche le formulaire de connexion
			include CHEMIN_VUE.'formulaire_mdp_oublie.php';
		}
		
	} 
	else {

		// On réaffiche le formulaire de connexion
		include CHEMIN_VUE.'formulaire_mdp_oublie.php';
	}
}

?>
