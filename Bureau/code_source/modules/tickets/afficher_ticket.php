<?php
include $_SERVER['DOCUMENT_ROOT'].'/gsb_final/global/init.php';

$titre = 'Détails de votre ticket d\'incident';

// Vérification des droits d'accès de la page
if (!utilisateur_est_connecte()) {
	// On affiche la page d'erreur comme quoi l'utilisateur est déjà connecté   
	include CHEMIN_VUE_GLOBALE.'erreur_non_connecte.php';	
}
else
{ 

	// Si le paramètre id est manquant ou invalide
	if (empty($_GET['id']) or !is_numeric($_GET['id'])) {

		include CHEMIN_VUE.'erreur_parametre_ticket.php';

	} else {

		// On veut utiliser le modèle des tickets (~/modules/tickets.php)
		include CHEMIN_MODELE.'ticket.php';
		
		// lire_infos_ticket() est défini dans ~/modules/tickets.php
		$monTicket = new Ticket();
		$found = $monTicket->getTicket($_GET['id']);
		$histo_statuts = $monTicket->getHistoStatut();
		
		// Si le ticket existe
		if (false !== $found) {

			// Ne pas oublier d'inclure la librairie Form
			include CHEMIN_LIB.'form.php';
			
			// "afficher_ticket" est l'ID unique du formulaire
			$afficher_ticket = new Form("afficher_ticket");

			$afficher_ticket->method('POST');
			$afficher_ticket->classForm('form');

			$afficher_ticket->add('Text', 'id')
							->label('Numéro du ticket')
							->value($monTicket->getId())
							->readonly(true);

			$afficher_ticket->add('Text', 'titre')
							->label('Titre du ticket')
							->value($monTicket->getTitre())
							->readonly(true);

			$afficher_ticket->add('Textarea', 'contenu')
							->label('Contenu du ticket')
							->rows(15)
							->cols(33)
							->value($monTicket->getContenu())
							->readonly(true);
							
			$afficher_ticket->add('Date', 'date')
							->label("Date de création du ticket")
							->value($monTicket->getDate())
							->readonly(true);
							
			$afficher_ticket->add('Text', 'categorie')
							->label('Catégorie du ticket')
							->value($monTicket->getIdCat())
							->readonly(true);
			
			$afficher_ticket->add('Text', 'priorite')
							->label('Priorité du ticket')
							->value($monTicket->getIdPrio())
							->readonly(true);
		
			include CHEMIN_VUE.'afficher_ticket_incident.php';

		} else {

			include CHEMIN_VUE.'erreur_ticket_inexistant.php';
		}
	}
}
?>
