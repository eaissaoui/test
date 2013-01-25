<?php
$titre = 'Création d\'un ticket d\'incident';


// Vérification des droits d'accès de la page
if (utilisateur_est_connecte()) {

	// Ne pas oublier d'inclure la librarie Form
	include CHEMIN_LIB.'form.php';
	include CHEMIN_MODELE.'membres.php';
	include CHEMIN_MODELE.'database.php';

	// 'form_ticket' est l'ID unique du formulaire
	$form_ticket = new Form('creer_ticket');
	
	$form_ticket->method('POST');

	$form_ticket->add('Text', 'titre')
				->label('Nom du ticket');

	$form_ticket->add('Textarea', 'contenu')
				->cols(35)
				->rows(15)
				->label('Contenu du ticket');

	$priorites = getPriorite();
	
	$form_ticket->add('Select', 'categorie')
				->choices(getCategorie())
				->required(false)
				->label('Categorie du ticket');	

	$form_ticket->add('Select', 'priorite')
				->choices(getPriorite())
				->required(false)
				->label('Priorite du ticket');
				
	date_default_timezone_set("Europe/Paris");
	$today = date('Y-m-d H:i:s');     
	$form_ticket->add('Date', 'date')
				->format('yyyy-mm-dd HH:MM:SS')
				->required(false)
				->readonly(true)
				->value($today)	
				->label('Date du ticket');

	$form_ticket->add('Submit', 'submit')
				->value('Soumettre ticket');
		
	// Pré-remplissage avec les valeurs précédemment entrées (s'il y en a)
	$form_ticket->bound($_POST);

	// Création d'un tableau des erreurs
	$erreurs_creation = array();

	// Validation des champs suivant les règles en utilisant les données du tableau $_POST
	if ($form_ticket->is_valid($_POST)) {

	// Si d'autres erreurs ne sont pas survenues
		if (empty($erreurs_creation)) {
						
			// Tentative d'ajout du ticket dans la base de donnees
			$data = $form_ticket->get_cleaned_data('titre', 'contenu', 'date','categorie', 'priorite');
			$data[3]++;
			$data[4]++;
			$data[] = $_SESSION['id'];  
			$data2 = array('titre_ticket' => $data[0], 'contenu_ticket' => $data[1], 'date_creation_ticket' => $data[2], 'id_categorie' => $data[3], 'id_priorite' => $data[4], 'id_utilisateur' => $data[5], 'nom_etat' => 'en attente' );
				
			// On veut utiliser le modele de la création (~/modeles/ticket.php)
			include CHEMIN_MODELE.'ticket.php';

			// creerTicket() est défini dans ~/modeles/ticket.php
			$ticket = new Ticket($data2);
			$ticket->creerTicket();
			include CHEMIN_VUE.'creation_effectuee.php';	
		}
		 else {
			// On affiche à nouveau le formulaire d'inscription
			include CHEMIN_VUE.'formulaire_creer_ticket.php';
		}
	}
	 else {
		// On affiche à nouveau le formulaire d'inscription
		include CHEMIN_VUE.'formulaire_creer_ticket.php';
	}
}
	
else{
	// On affiche la page d'erreur comme quoi l'utilisateur n'est pas connecté 
	include CHEMIN_VUE_GLOBALE.'erreur_non_connecte.php';
} 
?>
