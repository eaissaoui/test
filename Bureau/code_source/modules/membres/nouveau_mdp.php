<?php
	$titre = 'Réinitialisation du mot de passe';


// Vérification des droits d'accès de la page
if (utilisateur_est_connecte()) {

	// On affiche la page d'erreur comme quoi l'utilisateur est déjà connecté   
	include CHEMIN_VUE_GLOBALE.'erreur_deja_connecte.php';
	
} else {

	// inclure la librairie Form
	include CHEMIN_LIB.'form.php';
	include CHEMIN_MODELE.'membres.php';

	// "formulaire_nouveau_mdp" est l'ID unique du formulaire
	$form_nouveau_mdp = new Form('formulaire_nouveau_mdp');

	$form_nouveau_mdp->method('POST');

	$form_nouveau_mdp->add('Password', 'newpass') 
					 ->label("Votre nouveau mot de passe");

	$form_nouveau_mdp->add('Password', 'confirmnewpass') 
					 ->label("Votre nouveau mot de passe (vérification)");

	$form_nouveau_mdp->add('Submit', 'submit') 
					 ->value("Valider");
	
	$id = $_GET['id'];
	

	if ($form_nouveau_mdp->is_valid($_POST)){
		
		$mdp = $form_nouveau_mdp->get_cleaned_data('newpass');
		$confirmmdp = $form_nouveau_mdp->get_cleaned_data('confirmnewpass');

		// On veut utiliser le modèle des membres (~/modeles/membres.php)
	

		// si le nouveau mot de passe correspond à confirmation mot de passe

		if ($mdp == $confirmmdp){

			maj_mot_de_passe_membre($id, $mdp);
			
			include CHEMIN_VUE.'reinit_mdp_ok.php';
		}

	   else {
			
			$erreurs_nouveau_mdp[] = "mot de passe / confirmer mot de passe différent";
			
			// On réaffiche le formulaire de nouveau mot de passe
			include CHEMIN_VUE.'formulaire_nouveau_mdp.php';
		}
		
	} 
	else {

		// On réaffiche le formulaire de nouveau mot de passe
		include CHEMIN_VUE.'formulaire_nouveau_mdp.php';
	}
}

