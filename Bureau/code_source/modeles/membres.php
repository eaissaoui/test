<?php

function maj_mot_de_passe_membre($id_utilisateur , $mdp) {

	$pdo = PDO2::getInstance();

	$requete = $pdo->prepare("UPDATE gsb_utilisateur SET
		mdp_utilisateur = :mot_de_passe
		WHERE
		id_utilisateur = :id_utilisateur");

	$requete->bindValue(':id_utilisateur', $id_utilisateur);
	$requete->bindValue(':mot_de_passe',   sha1($mdp));

	return $requete->execute();
}

function combinaison_connexion_valide($email, $mot_de_passe) {

	$pdo = PDO2::getInstance();

	$requete = $pdo->prepare("SELECT id_utilisateur FROM gsb_utilisateur
		WHERE
		mail_utilisateur = :mail_utilisateur AND 
		mdp_utilisateur = :mot_de_passe");

	$requete->bindValue(':mail_utilisateur', $email);
	$requete->bindValue(':mot_de_passe', $mot_de_passe);
	$requete->execute();
	
	if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
	
		$requete->closeCursor();
		return $result['id_utilisateur'];
	}
	return false;
}

function lire_infos_utilisateur($id_utilisateur) {

	$pdo = PDO2::getInstance();

	$requete = $pdo->prepare("SELECT nom_utilisateur, prenom_utilisateur, mdp_utilisateur, mail_utilisateur
		FROM gsb_utilisateur
		WHERE
		id_utilisateur = :id_utilisateur");

	$requete->bindValue(':id_utilisateur', $id_utilisateur);
	$requete->execute();
	
	if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
	
		$requete->closeCursor();
		return $result;
	}
	return false;
}

function mail_existe($mail) {

        $pdo = PDO2::getInstance();

        $requete = $pdo->prepare("SELECT id_utilisateur FROM gsb_utilisateur WHERE mail_utilisateur = :adresse_email");

        $requete->bindValue(':adresse_email', $mail);
        $requete->execute();
        
        if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {        
                $requete->closeCursor();
                return $result['id_utilisateur'];
        }
        return false;
}

?>
