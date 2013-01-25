<?php
$titre = 'Suivi des tickets';

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

		// On veut utiliser le modèle des tickets (~/modeles/ticket.php)
		include CHEMIN_MODELE.'ticket.php';
		
		// histo_ticket() est défini dans ~/modeles/ticket.php
		$monTicket = new Ticket();
		$histo_tickets = $monTicket->recupHistoTickets($_GET['id']);
		
		// Si le ticket existe
		if (!empty($histo_tickets)) {

			include CHEMIN_VUE.'afficher_histo_ticket.php';

		} else {

			include CHEMIN_VUE.'erreur_histo_inexistant.php';
		}
	}
}
?>
