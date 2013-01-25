<?php
$titre = 'Mon compte';

// Vérification des droits d'accès de la page
if (!utilisateur_est_connecte()) {

	// On affiche la page d'erreur comme quoi l'utilisateur doit être connecté pour voir la page
	include CHEMIN_VUE_GLOBALE.'erreur_non_connecte.php';
	
} 

else {
	
	// Ne pas oublier d'inclure la librairie Form
	include CHEMIN_LIB.'form.php';
	
	// "form_modif_mdp" est l'ID unique du formulaire
	$form_modif_mdp = new Form("form_modif_mdp");

	$form_modif_mdp->method('POST');
	$form_modif_mdp->classForm('form');

	$form_modif_mdp->add('Text', 'nom')
				   ->label('Votre nom')
				   ->value($_SESSION['nom'])
				   ->required(false)
				   ->readonly(true);

	$form_modif_mdp->add('Text', 'prenom')
		       ->label('Votre prénom')
		       ->value($_SESSION['prenom'])
		       ->required(false)
		       ->readonly(true);

	$form_modif_mdp->add('Email', 'adresse_email')
				   ->label("Votre adresse email")
				   ->value($_SESSION['email'])
				   ->readonly(true)
				   ->required(false);
	
	$form_modif_mdp->add('Password', 'mdp_ancien')
				   ->label("Votre ancien mot de passe");
	
	$form_modif_mdp->add('Password', 'mdp')
				   ->label("Votre nouveau mot de passe");
	
	$form_modif_mdp->add('Password', 'mdp_verif')
				   ->label("Votre nouveau mot de passe (vérification)");
	
	$form_modif_mdp->add('Submit', 'submit')
				   ->initial("Modifier mon mot de passe !");
	
	// Création des tableaux des erreurs (un par formulaire)
	$erreurs_form_modif_mdp   = array();
	
	// et d'un tableau des messages de confirmation
	$msg_confirm = array();
	
	if ($form_modif_mdp->is_valid($_POST)) {
	
		// On vérifie si les 2 mots de passe correspondent
		if ($form_modif_mdp->get_cleaned_data('mdp') != $form_modif_mdp->get_cleaned_data('mdp_verif')) {

			$erreurs_form_modif_mdp[] = "Les deux mots de passes entrés sont différents !";

		// C'est bon, on peut modifier la valeur dans la BDD
		} else {

			$mdp = $form_modif_mdp->get_cleaned_data('mdp');
			// On veut utiliser le modèle de l'inscription (~/modules/membres.php)
			include CHEMIN_MODELE.'membres.php';
			maj_mot_de_passe_membre($_SESSION['id'], $mdp);

			$msg_confirm[] = "Votre mot de passe a été modifié avec succès !";
		}

	}
}

// Affichage des formulaires de modification du profil
include CHEMIN_VUE.'formulaires_modifier_profil.php';

?>
