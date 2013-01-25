<?php
$titre = 'Page de connexion';

// Vérification des droits d'accès de la page
if (utilisateur_est_connecte()) {

	// On affiche la page d'erreur comme quoi l'utilisateur est déjà connecté   
	include CHEMIN_VUE_GLOBALE.'erreur_deja_connecte.php';
	
} else {

	// Ne pas oublier d'inclure la librairie Form
	include CHEMIN_LIB.'form.php';

	// "formulaire_connexion" est l'ID unique du formulaire
	$form_connexion = new Form('formulaire_connexion');

	$form_connexion->method('POST');

	$form_connexion->add('Email', 'email')
				   ->label("Votre adresse e-mail");

	$form_connexion->add('Password', 'mot_de_passe')
				   ->label("Votre mot de passe");

	$form_connexion->add('Submit', 'submit')
				   ->value("Connexion");

	// Pré-remplissage avec les valeurs précédemment entrées (s'il y en a)
	$form_connexion->bound($_POST);

	// Création d'un tableau des erreurs
	$erreurs_connexion = array();

	// Validation des champs suivant les règles
	if ($form_connexion->is_valid($_POST)) {
		
		list($email, $mot_de_passe) =
			$form_connexion->get_cleaned_data('email', 'mot_de_passe');
		
		// On veut utiliser le modèle des membres (~/modeles/membres.php)
		include CHEMIN_MODELE.'membres.php';
		
		// combinaison_connexion_valide() est définit dans ~/modeles/membres.php
		$id_utilisateur = combinaison_connexion_valide($email, sha1($mot_de_passe));
		
		// Si les identifiants sont valides
		if (false !== $id_utilisateur) {

			$infos_utilisateur = lire_infos_utilisateur($id_utilisateur);
			
			// On enregistre les informations dans la session
			$_SESSION['id']     = $id_utilisateur;
			$_SESSION['nom'] = $infos_utilisateur['nom_utilisateur'];
			$_SESSION['prenom'] = $infos_utilisateur['prenom_utilisateur'];
			$_SESSION['email']  = $email;
			
			// Affichage de la confirmation de la connexion
			include CHEMIN_VUE.'connexion_ok.php';
		
		} else {

			$erreurs_connexion[] = "Nom d'utilisateur ou mot de passe incorrect.";
			
			// On réaffiche le formulaire de connexion
			include CHEMIN_VUE.'formulaire_connexion.php';
		}
		
	} else {

		// On réaffiche le formulaire de connexion
		include CHEMIN_VUE.'formulaire_connexion.php';
	}
}

?>
